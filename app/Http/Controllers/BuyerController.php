<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\AppointmentItem;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class BuyerController extends Controller
{
    /**
     * Daftar slot jam standar studio per hari.
     *
     * @return array<int, string>
     */
    private function studioTimeSlots(): array
    {
        return [
            '09:00 - 10:00 WIB',
            '10:15 - 11:30 WIB',
            '11:45 - 13:00 WIB',
            '13:30 - 14:45 WIB',
            '15:00 - 16:30 WIB',
            '16:45 - 18:00 WIB',
            '18:30 - 19:45 WIB',
        ];
    }

    /**
     * Tampilkan katalog layanan (POV Buyer - Sela).
     */
    public function katalog(Request $request): View
    {
        $categories = [
            ['id' => 'all', 'name' => 'Semua'],
            ['id' => 'gel-polish', 'name' => 'Gel Polish'],
            ['id' => 'nail-art-custom', 'name' => 'Nail art custom'],
            ['id' => 'nail-extension', 'name' => 'Nail Extension'],
        ];

        $services = Service::where('is_active', true)
            ->where('service_type', 'catalog')
            ->get();

        return view('buyer.katalog', compact('categories', 'services'));
    }

    /**
     * Tampilkan jadwal ketersediaan (POV Buyer - Liat Jadwal Avail).
     */
    public function jadwal(Request $request): View
    {
        $allServices = Service::where('is_active', true)
            ->where('service_type', 'catalog')
            ->get();

        $manicureServices = Service::where('is_active', true)
            ->where('service_type', 'manicure')
            ->get();

        $removeServices = Service::where('is_active', true)
            ->where('service_type', 'remove')
            ->get();

        $selectedServicesRaw = $request->query('services', '3');
        $selectedServiceIds = array_filter(explode(',', (string) $selectedServicesRaw));

        $primaryServiceId = ! empty($selectedServiceIds) ? (int) $selectedServiceIds[0] : 3;
        $primaryService = $allServices->firstWhere('id', $primaryServiceId) ?? $allServices->first();

        if (! $primaryService) {
            $primaryService = new Service([
                'id' => 3,
                'name' => 'Handpainted Custom Nail Art',
                'service_type' => 'catalog',
                'price' => 180000,
                'duration' => 90,
                'uploaded_by' => 'Aurel',
                'image' => 'nails/gallery-3.jpg',
                'is_active' => true,
            ]);
        }

        // Ambil roster Nail Artist & Admin dari database users
        $staffUsers = User::whereIn('role', ['nail_artist', 'admin'])->get();
        $roster = [];
        foreach ($staffUsers as $staff) {
            $roster[$staff->name] = [
                'id' => $staff->id,
                'name' => $staff->name,
                'role' => $staff->role === 'admin' ? 'Admin & Lead Technician' : 'Nail Artist',
                'specialty' => $staff->specialty ?? 'Nail Art Specialist',
                'avatar' => asset($staff->avatar ?? 'img/tech-1.jpg'),
            ];
        }

        // Ambil semua appointment aktif dari database untuk menghitung slot terpakai & tanggal penuh
        $today = Carbon::today()->toDateString();
        $activeAppointments = Appointment::with('artist')
            ->where('appointment_date', '>=', $today)
            ->where('status', '!=', 'Dibatalkan')
            ->get();

        $studioSlots = $this->studioTimeSlots();
        $bookedSlotsByDate = [];
        $fullyBookedDates = [];

        foreach ($activeAppointments->groupBy(fn ($a) => $a->appointment_date->toDateString()) as $dateStr => $apptsOnDate) {
            $bookedTimes = $apptsOnDate->pluck('time_slot')->unique()->values()->all();
            $bookedSlotsByDate[$dateStr] = $bookedTimes;

            if (count($bookedTimes) >= count($studioSlots)) {
                $fullyBookedDates[] = $dateStr;
            }
        }

        $creator = $primaryService ? $primaryService->uploaded_by : 'Aurel';
        $todayBooked = $bookedSlotsByDate[$today] ?? [];
        $timeSlots = $this->buildSlotsForDate($todayBooked, $creator, $roster);

        $dpPerGuest = 50000;

        return view('buyer.jadwal', compact(
            'timeSlots',
            'selectedServiceIds',
            'primaryService',
            'allServices',
            'manicureServices',
            'removeServices',
            'roster',
            'dpPerGuest',
            'bookedSlotsByDate',
            'fullyBookedDates',
            'studioSlots',
            'today'
        ));
    }

    /**
     * Endpoint JSON untuk mengecek ketersediaan slot pada tanggal tertentu dari database.
     */
    public function availability(Request $request): JsonResponse
    {
        $date = $request->query('date', Carbon::today()->toDateString());
        $creator = $request->query('creator', 'Aurel');

        $bookedTimes = Appointment::whereDate('appointment_date', $date)
            ->where('status', '!=', 'Dibatalkan')
            ->pluck('time_slot')
            ->unique()
            ->values()
            ->all();

        $staffUsers = User::whereIn('role', ['nail_artist', 'admin'])->get();
        $roster = [];
        foreach ($staffUsers as $staff) {
            $roster[$staff->name] = [
                'id' => $staff->id,
                'name' => $staff->name,
                'role' => $staff->role === 'admin' ? 'Admin & Lead Technician' : 'Nail Artist',
                'specialty' => $staff->specialty ?? 'Nail Art Specialist',
                'avatar' => asset($staff->avatar ?? 'img/tech-1.jpg'),
            ];
        }

        $slots = $this->buildSlotsForDate($bookedTimes, $creator, $roster);

        return response()->json([
            'date' => $date,
            'slots' => $slots,
        ]);
    }

    /**
     * Simpan reservasi baru (Booking + Items + Custom Design + Bukti DP) ke database.
     */
    public function storeBooking(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'client_name' => ['required', 'string', 'max:255'],
            'client_phone' => ['required', 'string', 'max:50'],
            'appointment_date' => ['required', 'date'],
            'time_slot' => ['required', 'string', 'max:50'],
            'guests' => ['required', 'integer', 'min:1', 'max:4'],
            'manicure_id' => ['nullable', 'integer', 'exists:services,id'],
            'design_type' => ['required', 'in:catalog,custom'],
            'nail_art_id' => ['nullable', 'integer', 'exists:services,id'],
            'remove_id' => ['nullable', 'integer', 'exists:services,id'],
            'custom_design_image' => ['required_if:design_type,custom', 'nullable', 'image', 'max:5120'],
            'custom_design_note' => ['nullable', 'string', 'max:1000'],
            'dp_payment_method' => ['required', 'in:qris,bank_transfer'],
            'dp_payment_proof' => ['nullable', 'image', 'max:5120'],
        ]);

        // Simpan file upload jika ada
        $customDesignPath = null;
        if ($request->hasFile('custom_design_image')) {
            $customDesignPath = $request->file('custom_design_image')->store('custom-designs', 'public');
        }

        $dpProofPath = null;
        if ($request->hasFile('dp_payment_proof')) {
            $dpProofPath = $request->file('dp_payment_proof')->store('payment-proofs', 'public');
        }

        // Tentukan Nail Artist yang bertugas
        $nailArtists = User::where('role', 'nail_artist')->get();
        $assignedArtist = $nailArtists->first();

        if ($validated['design_type'] === 'custom') {
            // Randomly assign nail artist untuk request desain sendiri
            if ($nailArtists->isNotEmpty()) {
                $assignedArtist = $nailArtists->random();
            }
        } elseif (! empty($validated['nail_art_id'])) {
            $catalogService = Service::find($validated['nail_art_id']);
            if ($catalogService) {
                $creatorUser = User::where('name', $catalogService->uploaded_by)->first();
                if ($creatorUser && $creatorUser->role === 'nail_artist') {
                    $assignedArtist = $creatorUser;
                } elseif ($nailArtists->isNotEmpty()) {
                    $assignedArtist = $nailArtists->random();
                }
            }
        }

        $appointment = DB::transaction(function () use ($validated, $customDesignPath, $dpProofPath, $assignedArtist): Appointment {
            $guests = (int) $validated['guests'];
            $dpAmount = 50000 * $guests;

            $bookingCode = 'APT-'.strtoupper(substr(uniqid(), -5));

            $appointment = Appointment::create([
                'booking_code' => $bookingCode,
                'user_id' => Auth::id(),
                'artist_id' => $assignedArtist?->id,
                'client_name' => $validated['client_name'],
                'client_phone' => $validated['client_phone'],
                'client_type' => Auth::check() ? 'Member' : 'Pelanggan Baru',
                'appointment_date' => $validated['appointment_date'],
                'time_slot' => $validated['time_slot'],
                'station' => 'Station 01',
                'guests' => $guests,
                'design_type' => $validated['design_type'],
                'custom_design_image' => $customDesignPath,
                'custom_design_note' => $validated['custom_design_note'] ?? null,
                'dp_amount' => $dpAmount,
                'dp_payment_method' => $validated['dp_payment_method'],
                'dp_payment_proof' => $dpProofPath,
                'dp_status' => 'verified',
                'status' => 'Menunggu',
                'notes' => $validated['custom_design_note'] ?? 'Reservasi online via Amanails.',
            ]);

            // Tambahkan item Manicure
            if (! empty($validated['manicure_id'])) {
                $mani = Service::find($validated['manicure_id']);
                if ($mani) {
                    AppointmentItem::create([
                        'appointment_id' => $appointment->id,
                        'service_id' => $mani->id,
                        'item_name' => $mani->name,
                        'item_type' => 'manicure',
                        'price' => $mani->price,
                        'duration' => $mani->duration,
                        'is_addon' => false,
                    ]);
                }
            }

            // Tambahkan item Nail Art (Katalog atau Custom Request)
            if ($validated['design_type'] === 'custom') {
                AppointmentItem::create([
                    'appointment_id' => $appointment->id,
                    'service_id' => null,
                    'item_name' => 'Request Desain Sendiri (Custom Request)',
                    'item_type' => 'nail_art',
                    'price' => 160000,
                    'duration' => 90,
                    'is_addon' => false,
                ]);
            } elseif (! empty($validated['nail_art_id'])) {
                $art = Service::find($validated['nail_art_id']);
                if ($art) {
                    AppointmentItem::create([
                        'appointment_id' => $appointment->id,
                        'service_id' => $art->id,
                        'item_name' => $art->name,
                        'item_type' => 'nail_art',
                        'price' => $art->price,
                        'duration' => $art->duration,
                        'is_addon' => false,
                    ]);
                }
            }

            // Tambahkan item Remove
            if (! empty($validated['remove_id'])) {
                $rem = Service::find($validated['remove_id']);
                if ($rem) {
                    AppointmentItem::create([
                        'appointment_id' => $appointment->id,
                        'service_id' => $rem->id,
                        'item_name' => $rem->name,
                        'item_type' => 'remove',
                        'price' => $rem->price,
                        'duration' => $rem->duration,
                        'is_addon' => false,
                    ]);
                }
            }

            $appointment->recalculateTotals();

            return $appointment;
        });

        return response()->json([
            'success' => true,
            'booking_code' => $appointment->booking_code,
            'dp_amount' => $appointment->dp_amount,
            'final_total' => $appointment->final_total,
            'remaining_balance' => max(0, $appointment->final_total - $appointment->dp_amount),
            'artist_name' => $assignedArtist?->name ?? 'Aurel',
            'message' => 'Reservasi berhasil disimpan ke database! Kode Booking: '.$appointment->booking_code,
        ], 201);
    }

    /**
     * Halaman Bantuan / FAQ Buyer.
     */
    public function bantuan(): View
    {
        return view('buyer.bantuan');
    }

    /**
     * Bangun daftar slot jam beserta penugasan artist berdasarkan slot yang sudah terbooking di DB.
     *
     * @param  array<int, string>  $bookedTimes
     * @param  array<string, array<string, mixed>>  $roster
     * @return array<int, array<string, mixed>>
     */
    private function buildSlotsForDate(array $bookedTimes, string $creator, array $roster): array
    {
        $artistNames = array_keys($roster);
        $fallbackList = array_values(array_filter($artistNames, fn ($n) => $n !== 'Admin'));
        if (empty($fallbackList)) {
            $fallbackList = $artistNames;
        }

        $slots = [];
        foreach ($this->studioTimeSlots() as $index => $time) {
            $isBooked = in_array($time, $bookedTimes, true);
            $fallbackName = $fallbackList[$index % max(1, count($fallbackList))] ?? 'Aurel';

            if (! $isBooked) {
                if (isset($roster[$creator]) && $creator !== 'Admin') {
                    $assigned = $roster[$creator];
                    $assignmentType = 'creator';
                } else {
                    $assigned = $roster[$fallbackName] ?? reset($roster);
                    $assignmentType = 'auto';
                }
            } else {
                $assigned = $roster[$fallbackName] ?? reset($roster);
                $assignmentType = 'booked';
            }

            $slots[] = [
                'time' => $time,
                'status' => $isBooked ? 'booked' : 'available',
                'assigned_artist' => $assigned,
                'assignment_type' => $assignmentType,
            ];
        }

        return $slots;
    }
}
