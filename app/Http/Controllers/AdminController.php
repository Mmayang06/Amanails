<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\LeaveRequest;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AdminController extends Controller
{
    public function dashboard(Request $request): View
    {
        $activeTab = $request->query('tab', 'appointment');
        $appointments = Appointment::with(['items', 'artist'])
            ->orderBy('appointment_date')
            ->orderBy('time_slot')
            ->get();

        $appointmentsByDate = [];
        foreach ($appointments as $appt) {
            $dateKey = $appt->appointment_date->toDateString();
            $layananNames = $appt->items
                ->where('is_addon', false)
                ->pluck('item_name')
                ->implode(' + ');

            $appointmentsByDate[$dateKey][] = [
                'id' => $appt->id,
                'booking_code' => $appt->booking_code,
                'jam' => $appt->time_slot,
                'pelanggan' => $appt->client_name,
                'layanan' => $layananNames !== '' ? $layananNames : 'Perawatan Studio',
                'artist' => $appt->artist?->name ?? 'Aurel',
                'status' => $appt->status,
                'dp_amount' => $appt->dp_amount,
                'final_total' => $appt->final_total,
                'final_payment_status' => $appt->final_payment_status,
            ];
        }

        $todayDate = Carbon::today()->toDateString();
        $todayShort = Carbon::today()->format('d M');
        $todayFullShort = Carbon::today()->format('d M Y');

        $addonServices = Service::where('is_active', true)
            ->where('service_type', 'addon')
            ->get();

        return view('admin.dashboard', compact(
            'activeTab',
            'appointments',
            'appointmentsByDate',
            'todayDate',
            'todayShort',
            'todayFullShort',
            'addonServices'
        ));
    }

    /**
     * Tampilkan halaman persetujuan & verifikasi pembayaran DP buyer.
     */
    public function pembayaran(): View
    {
        $appointments = Appointment::with(['items', 'artist', 'user'])
            ->orderByRaw("CASE dp_status WHEN 'pending' THEN 0 WHEN 'verified' THEN 1 ELSE 2 END")
            ->orderByDesc('created_at')
            ->get();

        $pembayaranList = $appointments->map(function (Appointment $appt): array {
            $nonAddonNames = $appt->items
                ->where('is_addon', false)
                ->pluck('item_name')
                ->implode(' + ');

            $methodLabel = match ($appt->dp_payment_method) {
                'qris' => 'QRIS Amanails',
                'bank_transfer' => 'Transfer Bank',
                default => strtoupper((string) ($appt->dp_payment_method ?: '-')),
            };

            $dpStatus = $appt->dp_status ?: 'pending';

            return [
                'id' => $appt->id,
                'booking_code' => $appt->booking_code,
                'tanggal' => $appt->appointment_date->format('d M Y'),
                'tanggal_raw' => $appt->appointment_date->toDateString(),
                'jam' => $appt->time_slot,
                'pelanggan' => $appt->client_name,
                'telepon' => $appt->client_phone,
                'tipe_klien' => $appt->client_type,
                'email' => $appt->user?->email ?? '-',
                'artist' => $appt->artist?->name ?? 'Aurel',
                'station' => $appt->station,
                'layanan' => $nonAddonNames !== '' ? $nonAddonNames : 'Perawatan Studio',
                'items' => $appt->items->map(fn ($i) => [
                    'name' => $i->item_name,
                    'type' => $i->item_type,
                    'price' => $i->price,
                    'is_addon' => (bool) $i->is_addon,
                ])->values()->all(),
                'dp_amount' => $appt->dp_amount,
                'initial_total' => $appt->initial_total,
                'addons_total' => $appt->addons_total,
                'final_total' => $appt->final_total,
                'sisa_tagihan' => max(0, $appt->final_total - $appt->dp_amount),
                'dp_payment_method' => $appt->dp_payment_method,
                'dp_payment_method_label' => $methodLabel,
                'dp_proof_url' => $appt->dp_proof_url,
                'has_proof' => ! empty($appt->dp_payment_proof),
                'dp_status' => $dpStatus,
                'status' => $appt->status,
                'notes' => $appt->notes,
                'created_at' => $appt->created_at?->format('d M Y, H:i') ?? '-',
            ];
        })->values()->all();

        $stats = [
            'total' => count($pembayaranList),
            'pending' => collect($pembayaranList)->where('dp_status', 'pending')->count(),
            'verified' => collect($pembayaranList)->where('dp_status', 'verified')->count(),
            'rejected' => collect($pembayaranList)->where('dp_status', 'rejected')->count(),
        ];

        return view('admin.pembayaran', compact('pembayaranList', 'stats'));
    }

    /**
     * Setujui (verifikasi) bukti pembayaran DP buyer.
     */
    public function approvePembayaran(Appointment $appointment): JsonResponse
    {
        $appointment->dp_status = 'verified';
        if ($appointment->status === 'Dibatalkan') {
            $appointment->status = 'Menunggu';
        }
        $appointment->save();

        return response()->json([
            'success' => true,
            'dp_status' => $appointment->dp_status,
            'status' => $appointment->status,
            'message' => 'Pembayaran DP untuk '.$appointment->booking_code.' berhasil disetujui.',
        ]);
    }

    /**
     * Tolak bukti pembayaran DP (misal bukti bodong / nominal tidak sesuai).
     */
    public function rejectPembayaran(Request $request, Appointment $appointment): JsonResponse
    {
        $validated = $request->validate([
            'reason' => ['nullable', 'string', 'max:500'],
        ]);

        $appointment->dp_status = 'rejected';
        $appointment->status = 'Dibatalkan';

        $reason = trim((string) ($validated['reason'] ?? ''));
        if ($reason !== '') {
            $baseNotes = preg_replace('/\s*\[Ditolak Admin:[^\]]*\]$/', '', (string) $appointment->notes);
            $appointment->notes = trim($baseNotes.($baseNotes !== '' ? "\n" : '').'[Ditolak Admin: '.$reason.']');
        }

        $appointment->save();

        return response()->json([
            'success' => true,
            'dp_status' => $appointment->dp_status,
            'status' => $appointment->status,
            'notes' => $appointment->notes,
            'message' => 'Pembayaran DP untuk '.$appointment->booking_code.' ditolak dan jadwal dibatalkan.',
        ]);
    }

    /**
     * Tampilkan daftar pengajuan cuti nail artist dari database.
     */
    public function cuti(): View
    {
        $requests = LeaveRequest::with('user')
            ->orderByRaw("CASE status WHEN 'menunggu' THEN 0 WHEN 'disetujui' THEN 1 ELSE 2 END")
            ->orderByDesc('created_at')
            ->orderByDesc('id')
            ->get();

        $cutiList = $requests->map(function (LeaveRequest $item): array {
            $statusLabel = match ($item->status) {
                'disetujui' => 'Disetujui',
                'ditolak' => 'Ditolak',
                default => 'Menunggu',
            };

            return [
                'id' => $item->id,
                'artist_name' => $item->artist_name,
                'leave_type' => $item->leave_type,
                'tanggal' => $item->formatted_date_range,
                'durasi' => $item->duration_days.' hari',
                'reason' => $item->reason,
                'status' => $item->status,
                'status_label' => $statusLabel,
                'admin_note' => $item->admin_note,
                'created_at' => $item->created_at?->format('d M Y, H:i') ?? '-',
            ];
        })->values()->all();

        $stats = [
            'total' => count($cutiList),
            'menunggu' => collect($cutiList)->where('status', 'menunggu')->count(),
            'disetujui' => collect($cutiList)->where('status', 'disetujui')->count(),
            'ditolak' => collect($cutiList)->where('status', 'ditolak')->count(),
        ];

        return view('admin.cuti', compact('cutiList', 'stats'));
    }

    /**
     * Setujui pengajuan cuti nail artist.
     */
    public function approveCuti(Request $request, LeaveRequest $leaveRequest): JsonResponse
    {
        $validated = $request->validate([
            'admin_note' => ['nullable', 'string', 'max:500'],
        ]);

        $leaveRequest->status = 'disetujui';
        if (! empty($validated['admin_note'])) {
            $leaveRequest->admin_note = trim((string) $validated['admin_note']);
        }
        $leaveRequest->reviewed_by = Auth::id();
        $leaveRequest->reviewed_at = now();
        $leaveRequest->save();

        return response()->json([
            'success' => true,
            'status' => $leaveRequest->status,
            'admin_note' => $leaveRequest->admin_note,
            'pending_count' => LeaveRequest::where('status', 'menunggu')->count(),
            'message' => 'Pengajuan cuti '.$leaveRequest->artist_name.' telah disetujui.',
        ]);
    }

    /**
     * Tolak pengajuan cuti nail artist.
     */
    public function rejectCuti(Request $request, LeaveRequest $leaveRequest): JsonResponse
    {
        $validated = $request->validate([
            'admin_note' => ['nullable', 'string', 'max:500'],
        ]);

        $leaveRequest->status = 'ditolak';
        if (! empty($validated['admin_note'])) {
            $leaveRequest->admin_note = trim((string) $validated['admin_note']);
        }
        $leaveRequest->reviewed_by = Auth::id();
        $leaveRequest->reviewed_at = now();
        $leaveRequest->save();

        return response()->json([
            'success' => true,
            'status' => $leaveRequest->status,
            'admin_note' => $leaveRequest->admin_note,
            'pending_count' => LeaveRequest::where('status', 'menunggu')->count(),
            'message' => 'Pengajuan cuti '.$leaveRequest->artist_name.' telah ditolak.',
        ]);
    }

    public function katalog(): View
    {
        $categories = [
            ['id' => 'all', 'name' => 'Semua'],
            ['id' => 'catalog', 'name' => 'Katalog'],
            ['id' => 'remove', 'name' => 'Remove'],
            ['id' => 'addon', 'name' => 'Tambahan Hari-H'],
        ];

        $services = Service::where('is_active', true)
            ->where('uploader_role', 'like', '%Admin%')
            ->orderByRaw("CASE service_type WHEN 'catalog' THEN 0 WHEN 'remove' THEN 1 WHEN 'addon' THEN 2 ELSE 3 END")
            ->orderBy('id')
            ->get()
            ->map(function (Service $svc): array {
                return [
                    'id' => $svc->id,
                    'name' => $svc->name,
                    'category' => $svc->category,
                    'category_label' => $svc->category_label,
                    'service_type' => $svc->service_type,
                    'price' => $svc->price,
                    'duration' => $svc->duration,
                    'image' => $svc->image_url,
                    'uploaded_by' => $svc->uploaded_by,
                    'uploader_role' => $svc->uploader_role,
                    'uploader_avatar' => asset('img/tech-2.jpg'),
                    'description' => $svc->description,
                ];
            })
            ->all();

        return view('admin.katalog', compact('categories', 'services'));
    }

    /**
     * Simpan layanan / desain katalog baru dari Admin ke tabel services.
     */
    public function storeKatalog(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category' => ['required', 'in:gel-polish,nail-art-custom,nail-extension,remove,addon,manicure'],
            'duration' => ['required', 'integer', 'min:0', 'max:600'],
            'price' => ['required', 'integer', 'min:0'],
            'image' => ['required', 'image', 'max:5120'],
            'description' => ['nullable', 'string', 'max:2000'],
        ], [
            'name.required' => 'Nama model / layanan wajib diisi.',
            'category.required' => 'Kategori layanan wajib dipilih.',
            'duration.required' => 'Durasi pengerjaan wajib diisi.',
            'price.required' => 'Harga layanan wajib diisi.',
            'image.required' => 'Foto model / layanan wajib diunggah.',
            'image.image' => 'File harus berupa gambar (JPG, PNG, WEBP).',
        ]);

        $categoryLabelMap = [
            'gel-polish' => 'Gel Polish',
            'nail-art-custom' => 'Nail art custom',
            'nail-extension' => 'Nail Extension',
            'remove' => 'Remove',
            'addon' => 'Tambahan Hari-H',
            'manicure' => 'Manicure',
        ];

        $serviceTypeMap = [
            'gel-polish' => 'catalog',
            'nail-art-custom' => 'catalog',
            'nail-extension' => 'catalog',
            'remove' => 'remove',
            'addon' => 'addon',
            'manicure' => 'manicure',
        ];

        $imagePath = $request->file('image')->store('nails', 'public');

        Service::create([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'category_label' => $categoryLabelMap[$validated['category']] ?? ucwords(str_replace('-', ' ', $validated['category'])),
            'service_type' => $serviceTypeMap[$validated['category']] ?? 'catalog',
            'price' => (int) $validated['price'],
            'duration' => (int) $validated['duration'],
            'image' => $imagePath,
            'uploaded_by' => Auth::user()?->name ?? 'Admin',
            'uploader_role' => 'Admin',
            'description' => $validated['description'] ?? null,
            'is_active' => true,
        ]);

        return redirect()
            ->route('admin.katalog')
            ->with('success', 'Layanan "'.$validated['name'].'" berhasil disimpan dan ditampilkan ke halaman pelanggan!');
    }
}
