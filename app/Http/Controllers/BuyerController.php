<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Tampilkan katalog layanan (POV Buyer - Sela).
     */
    public function katalog(Request $request)
    {
        $categories = [
            ['id' => 'all', 'name' => 'Semua'],
            ['id' => 'gel-polish', 'name' => 'Gel Polish'],
            ['id' => 'nail-art-custom', 'name' => 'Nail art custom'],
            ['id' => 'nail-extension', 'name' => 'Nail Extension'],
        ];

        // Ambil data dari database melalui model Service
        $services = Service::where('is_active', true)->get();

        return view('buyer.katalog', compact('categories', 'services'));
    }

    /**
     * Tampilkan jadwal ketersediaan (POV Buyer - Liat Jadwal Avail).
     */
    public function jadwal(Request $request)
    {
        // Ambil semua layanan aktif dari database
        $allServices = Service::where('is_active', true)->get();

        // Parameter layanan yang dipilih (jika dikirim dari katalog via query params)
        $selectedServicesRaw = $request->query('services', '3');
        $selectedServiceIds = array_filter(explode(',', (string) $selectedServicesRaw));

        // Ambil layanan utama dari database
        $primaryServiceId = ! empty($selectedServiceIds) ? (int) $selectedServiceIds[0] : 3;
        $primaryService = $allServices->firstWhere('id', $primaryServiceId) ?? $allServices->first();

        $creator = $primaryService ? $primaryService->uploaded_by : 'Mayang';

        // Roster Nail Artists bertugas di studio
        $roster = [
            'Aurel' => [
                'name' => 'Aurel',
                'role' => 'Senior Nail Artist',
                'specialty' => 'Handpainted Art, 3D Sculpting & Extensions',
                'avatar' => asset('img/tech-1.jpg'),
            ],
            'Mayang' => [
                'name' => 'Mayang',
                'role' => 'Admin & Lead Technician',
                'specialty' => 'Russian Manicure & Color Specialist',
                'avatar' => asset('img/tech-2.jpg'),
            ],
            'Nadia' => [
                'name' => 'Nadia',
                'role' => 'Nail Artist',
                'specialty' => 'Ombre, Chrome & Express Care',
                'avatar' => asset('img/tech-3.jpg'),
            ],
        ];

        // Simulasi slot jam dan auto-assign artist
        $rawSlots = [
            ['time' => '09:00 - 10:00 WIB', 'status' => 'available', 'creator_busy' => false, 'fallback' => 'Mayang'],
            ['time' => '10:15 - 11:30 WIB', 'status' => 'booked', 'creator_busy' => true, 'fallback' => 'Mayang'],
            ['time' => '11:45 - 13:00 WIB', 'status' => 'available', 'creator_busy' => true, 'fallback' => 'Nadia'],
            ['time' => '13:30 - 14:45 WIB', 'status' => 'available', 'creator_busy' => false, 'fallback' => 'Mayang'],
            ['time' => '15:00 - 16:30 WIB', 'status' => 'booked', 'creator_busy' => true, 'fallback' => 'Aurel'],
            ['time' => '16:45 - 18:00 WIB', 'status' => 'available', 'creator_busy' => true, 'fallback' => 'Mayang'],
            ['time' => '18:30 - 19:45 WIB', 'status' => 'available', 'creator_busy' => false, 'fallback' => 'Nadia'],
        ];

        $timeSlots = [];
        foreach ($rawSlots as $slot) {
            $isCreatorNailArtist = in_array($creator, ['Aurel', 'Nadia']);

            if ($slot['status'] === 'available') {
                if ($isCreatorNailArtist && ! $slot['creator_busy']) {
                    $assigned = $roster[$creator];
                    $assignmentType = 'creator';
                    $assignmentNote = 'Otomatis ditugaskan ke '.$creator.' (Kreator yang mengunggah model kuku ini)';
                } else {
                    $fallbackArtist = $slot['fallback'];
                    $assigned = $roster[$fallbackArtist] ?? $roster['Mayang'];
                    $assignmentType = 'auto';
                    $assignmentNote = 'Dialokasikan oleh sistem ke '.$assigned['name'].' (Nail Artist yang sedang kosong)';
                }
            } else {
                $assigned = $roster['Mayang'];
                $assignmentType = 'booked';
                $assignmentNote = 'Slot jam ini sudah penuh.';
            }

            $timeSlots[] = [
                'time' => $slot['time'],
                'status' => $slot['status'],
                'assigned_artist' => $assigned,
                'assignment_type' => $assignmentType,
                'assignment_note' => $assignmentNote,
            ];
        }

        // Kategori Layanan Terpisah: Manicure & Perawatan Dasar
        $manicureServices = [
            ['id' => 'mani-russian', 'name' => 'Russian Manicure (Deep Cuticle Care)', 'price' => 65000, 'duration' => 45, 'desc' => 'Pembersihan kutikula elektrik mendalam gaya Rusia yang ultra rapi dan bersih.'],
            ['id' => 'mani-express', 'name' => 'Express Manicure & Shaping', 'price' => 45000, 'duration' => 30, 'desc' => 'Pemotongan, pembentukan kuku simetris, dan perapian kutikula ringan.'],
            ['id' => 'mani-spa', 'name' => 'Spa Deluxe Hand & Warm Towel Care', 'price' => 85000, 'duration' => 50, 'desc' => 'Scrub organik tangan, masker pelembap kutikula, dan relaksasi handuk hangat.'],
            ['id' => 'mani-none', 'name' => 'Tanpa Manicure (Hanya Nail Art / Remove)', 'price' => 0, 'duration' => 0, 'desc' => 'Hanya fokus pada pewarnaan atau pembersihan kuku.'],
        ];

        // Kategori Layanan Terpisah: Remove Nail Art Lama
        $removeServices = [
            ['id' => 'remove-none', 'name' => 'Tanpa Remove (Kuku Bersih/Alami)', 'price' => 0, 'duration' => 0, 'desc' => 'Kuku siap diaplikasikan treatment baru tanpa perlu pembersihan kutek lama.'],
            ['id' => 'remove-gel', 'name' => 'Remove Kutek Gel Lama', 'price' => 30000, 'duration' => 20, 'desc' => 'Pelepasan kutek gel aman tanpa merusak lapisan keratin kuku alami.'],
            ['id' => 'remove-ext', 'name' => 'Remove Akrilik / Extension Lama', 'price' => 50000, 'duration' => 35, 'desc' => 'Proses pelarutan dan pembersihan sambungan kuku akrilik/tip terdahulu.'],
        ];

        $dpPerGuest = 50000;

        return view('buyer.jadwal', compact(
            'timeSlots',
            'selectedServiceIds',
            'primaryService',
            'allServices',
            'manicureServices',
            'removeServices',
            'roster',
            'dpPerGuest'
        ));
    }

    /**
     * Halaman Bantuan / FAQ Buyer.
     */
    public function bantuan()
    {
        return view('buyer.bantuan');
    }
}
