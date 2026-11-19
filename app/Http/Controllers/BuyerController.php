<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuyerController extends Controller
{
    /**
     * Data mock katalog layanan dan model kuku Amanails.
     */
    private function getServicesData(): array
    {
        return [
            [
                'id' => 1,
                'name' => 'Basic Gel Polish',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'price' => 75000,
                'duration' => 60,
                'image' => asset('img/gallery-1.jpg'),
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Admin (Mayang)',
                'uploader_avatar' => asset('img/tech-2.jpg'),
                'description' => 'Aplikasi base, 2 lapis kutek gel solid tahan lama, dan glossy top coat.',
            ],
            [
                'id' => 2,
                'name' => 'Russian Manicure + Gel',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'price' => 125000,
                'duration' => 75,
                'image' => asset('img/gallery-2.jpg'),
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Admin (Mayang)',
                'uploader_avatar' => asset('img/tech-2.jpg'),
                'description' => 'Pembersihan kutikula elektrik mendalam gaya Rusia + pewarnaan gel rapi.',
            ],
            [
                'id' => 3,
                'name' => 'Handpainted Custom Nail Art',
                'category' => 'nail-art-custom',
                'category_label' => 'Nail art custom',
                'price' => 180000,
                'duration' => 90,
                'image' => asset('img/gallery-3.jpg'),
                'uploaded_by' => 'Aurel',
                'uploader_role' => 'Nail Artist (Aurel)',
                'uploader_avatar' => asset('img/tech-1.jpg'),
                'description' => 'Lukisan tangan bebas custom (floral, abstract, kartun, motif geometri) 10 jari.',
            ],
            [
                'id' => 4,
                'name' => '3D Floral & Gem Nail Art',
                'category' => 'nail-art-custom',
                'category_label' => 'Nail art custom',
                'price' => 210000,
                'duration' => 100,
                'image' => asset('img/gallery-4.jpg'),
                'uploaded_by' => 'Aurel',
                'uploader_role' => 'Nail Artist (Aurel)',
                'uploader_avatar' => asset('img/tech-1.jpg'),
                'description' => 'Desain timbul 3D clay/akrilik aksen bunga dan taburan permata kristal mewah.',
            ],
            [
                'id' => 5,
                'name' => 'Soft Gel Extensions',
                'category' => 'nail-extension',
                'category_label' => 'Nail Extension',
                'price' => 250000,
                'duration' => 90,
                'image' => asset('img/gallery-5.jpg'),
                'uploaded_by' => 'Aurel',
                'uploader_role' => 'Nail Artist (Aurel)',
                'uploader_avatar' => asset('img/tech-1.jpg'),
                'description' => 'Penyambungan kuku tipis dan fleksibel menggunakan full-cover soft gel tips.',
            ],
            [
                'id' => 6,
                'name' => 'Polygel Extension Set',
                'category' => 'nail-extension',
                'category_label' => 'Nail Extension',
                'price' => 300000,
                'duration' => 120,
                'image' => asset('img/gallery-6.jpg'),
                'uploaded_by' => 'Nadia',
                'uploader_role' => 'Nail Artist (Nadia)',
                'uploader_avatar' => asset('img/tech-3.jpg'),
                'description' => 'Sambung kuku kombinasi akrilik dan gel kuat, kokoh untuk kuku panjang.',
            ],
            [
                'id' => 7,
                'name' => 'Cat Eye & Metallic Chrome',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'price' => 135000,
                'duration' => 70,
                'image' => asset('img/gallery-7.jpg'),
                'uploaded_by' => 'Nadia',
                'uploader_role' => 'Nail Artist (Nadia)',
                'uploader_avatar' => asset('img/tech-3.jpg'),
                'description' => 'Efek magnetik kilau cat eye galaksi dengan sentuhan bubuk mirror chrome.',
            ],
            [
                'id' => 8,
                'name' => 'French Ombre Aura Nails',
                'category' => 'nail-art-custom',
                'category_label' => 'Nail art custom',
                'price' => 165000,
                'duration' => 80,
                'image' => asset('img/gallery-8.jpg'),
                'uploaded_by' => 'Aurel',
                'uploader_role' => 'Nail Artist (Aurel)',
                'uploader_avatar' => asset('img/tech-1.jpg'),
                'description' => 'Gradasi warna lembut gaya Korea/aura dengan ujung kuku french modern.',
            ],
            [
                'id' => 9,
                'name' => 'Express Gel Pedicure',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'price' => 110000,
                'duration' => 50,
                'image' => asset('img/gallery-9.jpg'),
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Admin (Mayang)',
                'uploader_avatar' => asset('img/tech-2.jpg'),
                'description' => 'Perawatan kuku kaki, kikir, pembersihan kutikula, dan kutek gel kilau.',
            ],
        ];
    }

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

        $services = $this->getServicesData();

        return view('katalog', compact('categories', 'services'));
    }

    /**
     * Tampilkan jadwal ketersediaan (POV Buyer - Liat Jadwal Avail).
     */
    public function jadwal(Request $request)
    {
        $services = $this->getServicesData();

        // Parameter layanan yang dipilih (jika dikirim dari katalog via query params)
        $selectedServicesRaw = $request->query('services', '3');
        $selectedServiceIds = array_filter(explode(',', (string) $selectedServicesRaw));

        // Ambil layanan utama yang dipilih
        $primaryServiceId = ! empty($selectedServiceIds) ? (int) $selectedServiceIds[0] : 3;
        $primaryService = collect($services)->firstWhere('id', $primaryServiceId) ?? $services[0];

        $creator = $primaryService['uploaded_by']; // misal 'Aurel', 'Mayang', atau 'Nadia'

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
        // Aturan bisnis: Jika model kuku di-upload oleh Nail Artist dan di jam itu dia kosong -> otomatis dia.
        // Jika sedang booked/penuh di jam itu atau jika uploader adalah Admin -> sistem mengacak/mengalokasikan artist yang sedang kosong.
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

        return view('jadwal', compact('timeSlots', 'selectedServiceIds', 'primaryService'));
    }

    /**
     * Halaman Bantuan / FAQ Buyer.
     */
    public function bantuan()
    {
        return view('bantuan');
    }
}
