<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentItem;
use App\Models\Service;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TerapisController extends Controller
{
    /**
     * Tampilkan Dashboard Terapis dengan data dari database.
     */
    public function dashboard()
    {
        $user = Auth::user();
        $isArtist = $user && $user->role === 'nail_artist';

        $terapis = [
            'nama' => $isArtist ? $user->name : 'Mia Alvarez',
            'role' => $isArtist ? 'Nail Artist' : 'Nail Art Lead & Senior Technician',
            'spesialisasi' => ($isArtist && $user->specialty) ? $user->specialty : 'Freehand Florals, Chrome & Micro-Detailing',
            'foto' => asset(($isArtist && $user->avatar) ? $user->avatar : 'img/tech-1.jpg'),
            'rating' => '4.95',
            'total_ulasan' => 148,
            'status' => 'Tersedia', // Tersedia, Sedang Melayani, Istirahat
            'bergabung_sejak' => 'Maret 2021',
            'meja_kerja' => 'Station 01',
        ];

        $today = Carbon::today()->toDateString();

        // Ambil semua appointment dari database
        $allAppointments = Appointment::with(['items', 'artist'])
            ->orderBy('appointment_date')
            ->orderBy('time_slot')
            ->get();

        // Format appointment dari DB untuk UI terapis
        $mapAppointment = function (Appointment $appt): array {
            $initialItems = $appt->items->where('is_addon', false)->values();
            $addonItems = $appt->items->where('is_addon', true)->values();

            $layananNames = $initialItems->pluck('item_name')->implode(' + ');
            if ($layananNames === '') {
                $layananNames = 'Konsultasi Perawatan Studio';
            }

            return [
                'db_id' => $appt->id,
                'id' => $appt->booking_code,
                'jam' => $appt->time_slot,
                'tanggal' => $appt->appointment_date->toDateString(),
                'klien' => $appt->client_name,
                'kontak' => $appt->client_phone,
                'layanan' => $layananNames,
                'durasi' => $appt->total_duration.' Menit',
                'status' => $appt->status,
                'catatan' => $appt->custom_design_note ?? $appt->notes,
                'tipe_klien' => $appt->client_type,
                'kursi' => $appt->station,
                'artist_name' => $appt->artist?->name ?? 'Aurel',
                'has_website_reference' => $initialItems->isNotEmpty(),
                'layanan_awal' => $initialItems->map(fn ($i) => [
                    'id' => $i->id,
                    'nama' => $i->item_name,
                    'harga' => $i->price,
                ])->all(),
                'addons' => $addonItems->map(fn ($i) => [
                    'id' => $i->id,
                    'name' => $i->item_name,
                    'price' => $i->price,
                ])->all(),
                'dp_terbayar' => $appt->dp_amount,
                'final_total' => $appt->final_total,
                'final_payment_status' => $appt->final_payment_status,
                'foto_desain' => $appt->custom_design_url,
            ];
        };

        $todayAppts = $allAppointments->filter(fn ($a) => $a->appointment_date->toDateString() === $today);
        if ($todayAppts->isEmpty()) {
            $todayAppts = $allAppointments->take(5);
        }

        $jadwalHariIni = $todayAppts->map($mapAppointment)->values()->all();

        $jadwalSatuBulan = [];
        foreach ($allAppointments->groupBy(fn ($a) => $a->appointment_date->toDateString()) as $dateKey => $group) {
            $jadwalSatuBulan[$dateKey] = $group->map($mapAppointment)->values()->all();
        }

        // Ambil daftar layanan tambahan hari-h (add-on) dari database
        $addonServices = Service::where('is_active', true)
            ->where('service_type', 'addon')
            ->get();

        // Ringkasan Statistik Kinerja dari DB
        $statistik = [
            'janji_hari_ini' => count($jadwalHariIni),
            'total_pelanggan_bulan_ini' => $allAppointments->count(),
            'klien_baru_bulan_ini' => $allAppointments->where('client_type', 'Pelanggan Baru')->count(),
            'layanan_selesai_minggu_ini' => $allAppointments->where('status', 'Selesai')->count(),
            'estimasi_komisi_mingguan' => 'Rp '.number_format((int) $allAppointments->sum('final_total'), 0, ',', '.'),
        ];

        // Data Kuota & Riwayat Pengajuan Cuti Terapis (Jatah Cuti 8 Hari Sebulan)
        $dataCuti = [
            'kuota_bulanan' => 8,
            'cuti_terpakai' => 2,
            'sisa_cuti' => 6,
            'periode' => 'Bulan Ini ('.date('F Y').')',
            'riwayat' => [
                [
                    'id' => 'CUTI-02',
                    'tipe' => 'Cuti Bulanan',
                    'tanggal' => '10 Nov 2026',
                    'durasi' => '1 Hari',
                    'alasan' => 'Keperluan keluarga mendesak.',
                    'status' => 'Selesai',
                    'tanggal_pengajuan' => '08 Nov 2026',
                ],
                [
                    'id' => 'CUTI-01',
                    'tipe' => 'Izin Sakit',
                    'tanggal' => '02 Nov 2026',
                    'durasi' => '1 Hari',
                    'alasan' => 'Istirahat flu dan demam (surat dokter terlampir).',
                    'status' => 'Selesai',
                    'tanggal_pengajuan' => '02 Nov 2026',
                ],
            ],
        ];

        // Karya Unggulan Terapis (dengan bentuk kuku / Nail Shape & Estimasi Pengerjaan)
        $karyaTerapis = [
            [
                'id' => 1,
                'judul' => 'Pressed Florals',
                'gaya' => 'Floral Art',
                'nail_shape' => 'Almond',
                'durasi' => '90 Menit',
                'img' => asset('img/gallery-3.jpg'),
                'suka' => 420,
                'tanggal' => '18 Nov 2026',
                'deskripsi' => 'Lukisan tangan bunga daisy dengan aksen foil emas di kuku bentuk Almond.',
            ],
            [
                'id' => 2,
                'judul' => 'Rose Gold Chrome',
                'gaya' => 'Chrome Mirror',
                'nail_shape' => 'Coffin',
                'durasi' => '75 Menit',
                'img' => asset('img/gallery-6.jpg'),
                'suka' => 380,
                'tanggal' => '15 Nov 2026',
                'deskripsi' => 'Bubuk mirror chrome rose gold dengan base coat nude di kuku bentuk Coffin.',
            ],
            [
                'id' => 3,
                'judul' => 'Glazed Nude Shimmer',
                'gaya' => 'Glazed Gel',
                'nail_shape' => 'Oval',
                'durasi' => '60 Menit',
                'img' => asset('img/gallery-5.jpg'),
                'suka' => 512,
                'tanggal' => '12 Nov 2026',
                'deskripsi' => 'Efek glazed donut shimmer lembut di atas kuku bentuk Oval alami.',
            ],
            [
                'id' => 4,
                'judul' => 'Modern French Tips',
                'gaya' => 'Classic French',
                'nail_shape' => 'Square',
                'durasi' => '60 Menit',
                'img' => asset('img/gallery-1.jpg'),
                'suka' => 295,
                'tanggal' => '08 Nov 2026',
                'deskripsi' => 'Garis micro French putih bersih pada kuku bentuk Square yang rapi.',
            ],
            [
                'id' => 5,
                'judul' => 'Emerald Velvet Cat Eye',
                'gaya' => 'Cat Eye',
                'nail_shape' => 'Stiletto',
                'durasi' => '90 Menit',
                'img' => asset('img/gallery-7.jpg'),
                'suka' => 340,
                'tanggal' => '05 Nov 2026',
                'deskripsi' => 'Efek magnetik velvet hijau zamrud dramatis pada bentuk kuku Stiletto tajam.',
            ],
            [
                'id' => 6,
                'judul' => 'Soft Blush Squoval',
                'gaya' => 'Minimalist',
                'nail_shape' => 'Squoval',
                'durasi' => '45 Menit',
                'img' => asset('img/gallery-2.jpg'),
                'suka' => 260,
                'tanggal' => '01 Nov 2026',
                'deskripsi' => 'Warna blush natural 10-free pada bentuk kuku Squoval yang nyaman untuk harian.',
            ],
        ];

        return view('terapis.dashboard', compact('terapis', 'statistik', 'jadwalHariIni', 'dataCuti', 'karyaTerapis', 'jadwalSatuBulan', 'addonServices'));
    }

    /**
     * Halaman Khusus Lookbook Karya Terapis (Galeri Lengkap Hasil Nail Art).
     */
    public function karya()
    {
        $terapis = [
            'nama' => 'Mia Alvarez',
            'role' => 'Nail Art Lead & Senior Technician',
            'spesialisasi' => 'Freehand Florals, Chrome & Micro-Detailing',
            'rating' => '4.95',
            'total_ulasan' => 148,
            'status' => 'Tersedia',
            'meja_kerja' => 'Station 01',
        ];

        $karyaTerapis = [
            [
                'id' => 1,
                'judul' => 'Pressed Florals',
                'gaya' => 'Floral Art',
                'nail_shape' => 'Almond',
                'durasi' => '90 Menit',
                'img' => asset('img/gallery-3.jpg'),
                'suka' => 420,
                'tanggal' => '18 Nov 2026',
                'deskripsi' => 'Lukisan tangan bunga daisy dengan aksen foil emas di kuku bentuk Almond.',
            ],
            [
                'id' => 2,
                'judul' => 'Rose Gold Chrome',
                'gaya' => 'Chrome Mirror',
                'nail_shape' => 'Coffin',
                'durasi' => '75 Menit',
                'img' => asset('img/gallery-6.jpg'),
                'suka' => 380,
                'tanggal' => '15 Nov 2026',
                'deskripsi' => 'Bubuk mirror chrome rose gold dengan base coat nude di kuku bentuk Coffin.',
            ],
            [
                'id' => 3,
                'judul' => 'Glazed Nude Shimmer',
                'gaya' => 'Glazed Gel',
                'nail_shape' => 'Oval',
                'durasi' => '60 Menit',
                'img' => asset('img/gallery-5.jpg'),
                'suka' => 512,
                'tanggal' => '12 Nov 2026',
                'deskripsi' => 'Efek glazed donut shimmer lembut di atas kuku bentuk Oval alami.',
            ],
            [
                'id' => 4,
                'judul' => 'Modern French Tips',
                'gaya' => 'Classic French',
                'nail_shape' => 'Square',
                'durasi' => '60 Menit',
                'img' => asset('img/gallery-1.jpg'),
                'suka' => 295,
                'tanggal' => '08 Nov 2026',
                'deskripsi' => 'Garis micro French putih bersih pada kuku bentuk Square yang rapi.',
            ],
            [
                'id' => 5,
                'judul' => 'Emerald Velvet Cat Eye',
                'gaya' => 'Cat Eye',
                'nail_shape' => 'Stiletto',
                'durasi' => '90 Menit',
                'img' => asset('img/gallery-7.jpg'),
                'suka' => 340,
                'tanggal' => '05 Nov 2026',
                'deskripsi' => 'Efek magnetik velvet hijau zamrud dramatis pada bentuk kuku Stiletto tajam.',
            ],
            [
                'id' => 6,
                'judul' => 'Soft Blush Squoval',
                'gaya' => 'Minimalist',
                'nail_shape' => 'Squoval',
                'durasi' => '45 Menit',
                'img' => asset('img/gallery-2.jpg'),
                'suka' => 260,
                'tanggal' => '01 Nov 2026',
                'deskripsi' => 'Warna blush natural 10-free pada bentuk kuku Squoval yang nyaman untuk harian.',
            ],
            [
                'id' => 7,
                'judul' => 'Milky White Clean',
                'gaya' => 'Minimalist',
                'nail_shape' => 'Round',
                'durasi' => '45 Menit',
                'img' => asset('img/gallery-8.jpg'),
                'suka' => 310,
                'tanggal' => '28 Okt 2026',
                'deskripsi' => 'Warna milky white semi-transparan yang bersih dan rapi untuk kuku pendek Round.',
            ],
            [
                'id' => 8,
                'judul' => 'Tortoiseshell & Gold Leaf',
                'gaya' => 'Floral Art',
                'nail_shape' => 'Almond',
                'durasi' => '105 Menit',
                'img' => asset('img/gallery-9.jpg'),
                'suka' => 475,
                'tanggal' => '24 Okt 2026',
                'deskripsi' => 'Motif tempurung kura-kura amber dengan sentuhan serpihan emas 24k di kuku Almond.',
            ],
        ];

        // Daftar 7 Bentuk Kuku Resmi Sesuai Nail Shape Guide
        $nailShapes = ['Square', 'Squoval', 'Round', 'Oval', 'Almond', 'Coffin', 'Stiletto'];

        return view('terapis.karya', compact('terapis', 'karyaTerapis', 'nailShapes'));
    }

    /**
     * Halaman Khusus Pengajuan & Manajemen Cuti Terapis.
     */
    public function cuti()
    {
        $terapis = [
            'nama' => 'Mia Alvarez',
            'role' => 'Nail Art Lead & Senior Technician',
            'meja_kerja' => 'Station 01',
        ];

        $dataCuti = [
            'kuota_bulanan' => 8,
            'cuti_terpakai' => 2,
            'sisa_cuti' => 6,
            'periode' => 'Bulan Ini ('.date('F Y').')',
            'riwayat' => [
                [
                    'id' => 'CUTI-02',
                    'tipe' => 'Cuti Bulanan',
                    'tanggal' => '10 Nov 2026',
                    'durasi' => '1 Hari',
                    'alasan' => 'Keperluan keluarga mendesak.',
                    'status' => 'Selesai',
                    'tanggal_pengajuan' => '08 Nov 2026',
                ],
                [
                    'id' => 'CUTI-01',
                    'tipe' => 'Izin Sakit',
                    'tanggal' => '02 Nov 2026',
                    'durasi' => '1 Hari',
                    'alasan' => 'Istirahat flu dan demam (surat dokter terlampir).',
                    'status' => 'Selesai',
                    'tanggal_pengajuan' => '02 Nov 2026',
                ],
            ],
        ];

        return view('terapis.cuti', compact('terapis', 'dataCuti'));
    }

    /**
     * Tambahkan layanan ekstra hari-h ke appointment di database.
     */
    public function addAddon(Request $request, Appointment $appointment): JsonResponse
    {
        $validated = $request->validate([
            'service_id' => ['nullable', 'integer', 'exists:services,id'],
            'item_name' => ['required_without:service_id', 'nullable', 'string', 'max:255'],
            'price' => ['required_without:service_id', 'nullable', 'integer', 'min:0'],
        ]);

        if (! empty($validated['service_id'])) {
            $service = Service::findOrFail($validated['service_id']);
            $name = $service->name;
            $price = $service->price;
            $duration = $service->duration;
            $serviceId = $service->id;
        } else {
            $name = (string) $validated['item_name'];
            $price = (int) $validated['price'];
            $duration = 15;
            $serviceId = null;
        }

        $item = AppointmentItem::create([
            'appointment_id' => $appointment->id,
            'service_id' => $serviceId,
            'item_name' => $name,
            'item_type' => 'addon',
            'price' => $price,
            'duration' => $duration,
            'is_addon' => true,
        ]);

        $appointment->recalculateTotals();

        return response()->json([
            'success' => true,
            'item' => [
                'id' => $item->id,
                'nama' => $item->item_name,
                'harga' => $item->price,
            ],
            'initial_total' => $appointment->initial_total,
            'addons_total' => $appointment->addons_total,
            'final_total' => $appointment->final_total,
            'remaining_balance' => max(0, $appointment->final_total - $appointment->dp_amount),
        ]);
    }

    /**
     * Hapus layanan tambahan hari-h dari appointment di database.
     */
    public function removeAddon(Appointment $appointment, AppointmentItem $item): JsonResponse
    {
        if ($item->appointment_id !== $appointment->id || ! $item->is_addon) {
            return response()->json(['success' => false, 'message' => 'Item tidak valid.'], 422);
        }

        $item->delete();
        $appointment->recalculateTotals();

        return response()->json([
            'success' => true,
            'initial_total' => $appointment->initial_total,
            'addons_total' => $appointment->addons_total,
            'final_total' => $appointment->final_total,
            'remaining_balance' => max(0, $appointment->final_total - $appointment->dp_amount),
        ]);
    }

    /**
     * Mulai layanan appointment di database.
     */
    public function startAppointment(Appointment $appointment): JsonResponse
    {
        $appointment->status = 'Sedang Berlangsung';
        $appointment->save();

        return response()->json([
            'success' => true,
            'status' => $appointment->status,
        ]);
    }

    /**
     * Selesaikan appointment & catat pelunasan di database.
     */
    public function completeAppointment(Request $request, Appointment $appointment): JsonResponse
    {
        $validated = $request->validate([
            'payment_method' => ['required', 'in:cash,qris,edc'],
        ]);

        $appointment->recalculateTotals();
        $appointment->final_payment_method = $validated['payment_method'];
        $appointment->final_payment_status = 'paid';
        $appointment->status = 'Selesai';
        $appointment->save();

        return response()->json([
            'success' => true,
            'status' => $appointment->status,
            'final_total' => $appointment->final_total,
            'remaining_balance' => max(0, $appointment->final_total - $appointment->dp_amount),
        ]);
    }
}
