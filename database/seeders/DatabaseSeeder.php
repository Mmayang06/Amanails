<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\AppointmentItem;
use App\Models\LeaveRequest;
use App\Models\Service;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Seed Akun Pengguna Sesuai Pembagian Tim PROBIS
        $users = [
            [
                'name' => 'Admin',
                'email' => 'admin@amanails.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '0812-1111-2222',
                'avatar' => 'img/tech-2.jpg',
                'specialty' => 'Russian Manicure & Color Specialist',
            ],
            [
                'name' => 'Aurel',
                'email' => 'aurel@amanails.com',
                'password' => Hash::make('password'),
                'role' => 'nail_artist',
                'phone' => '0812-3333-4444',
                'avatar' => 'img/tech-1.jpg',
                'specialty' => 'Handpainted Art, 3D Sculpting & Extensions',
            ],
            [
                'name' => 'Mayang',
                'email' => 'mayang@amanails.com',
                'password' => Hash::make('password'),
                'role' => 'nail_artist',
                'phone' => '0812-5555-6666',
                'avatar' => 'img/tech-3.jpg',
                'specialty' => 'Ombre, Chrome & Express Care',
            ],
            [
                'name' => 'Sela',
                'email' => 'sela@amanails.com',
                'password' => Hash::make('password'),
                'role' => 'nail_artist',
                'phone' => '0812-9876-5432',
                'avatar' => 'img/tech-4.jpg',
                'specialty' => 'Cat Eye Design, 3D art, Glitery Design',
            ],
            [
                'name' => 'Amanda',
                'email' => 'amanda@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'buyer',
                'phone' => '0812-9876-5432',
                'avatar' => 'img/client-1.jpg',
                'specialty' => null,
            ],
        ];

        $userModels = [];
        foreach ($users as $u) {
            $userModels[$u['name']] = User::updateOrCreate(
                ['email' => $u['email']],
                $u
            );
        }

        // 2. Seed Semua Layanan (Katalog Nail Art, Manicure, Remove, & Add-on Hari-H)
        $services = [
            // --- KATALOG NAIL ART & DESAIN ---
            [
                'id' => 1,
                'name' => 'Basic Gel Polish',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'service_type' => 'catalog',
                'price' => 75000,
                'duration' => 60,
                'image' => 'nails/gallery-1.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Nail Artist (Mayang)',
                'description' => 'Aplikasi base coat, 2 lapis kutek gel solid warna pilihan tahan lama hingga 3-4 minggu, dan glossy top coat.',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Russian Manicure + Gel',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'service_type' => 'catalog',
                'price' => 125000,
                'duration' => 75,
                'image' => 'nails/gallery-2.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Nail Artist (Mayang)',
                'description' => 'Pembersihan kutikula elektrik mendalam gaya Rusia yang ultra rapi dan tahan lama sebelum pewarnaan gel.',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => 'Handpainted Custom Nail Art',
                'category' => 'nail-art-custom',
                'category_label' => 'Nail art custom',
                'service_type' => 'catalog',
                'price' => 180000,
                'duration' => 90,
                'image' => 'nails/gallery-3.jpg',
                'uploaded_by' => 'Aurel',
                'uploader_role' => 'Nail Artist (Aurel)',
                'description' => 'Lukisan tangan bebas custom (motif floral, abstract, kartun, atau geometri) untuk 10 jari Anda.',
                'is_active' => true,
            ],
            [
                'id' => 4,
                'name' => '3D Floral & Gem Nail Art',
                'category' => 'nail-art-custom',
                'category_label' => 'Nail art custom',
                'service_type' => 'catalog',
                'price' => 210000,
                'duration' => 100,
                'image' => 'nails/gallery-4.jpg',
                'uploaded_by' => 'Aurel',
                'uploader_role' => 'Nail Artist (Aurel)',
                'description' => 'Desain timbul 3D clay akrilik aksen bunga elegan dengan taburan permata kristal mewah.',
                'is_active' => true,
            ],
            [
                'id' => 5,
                'name' => 'Soft Gel Extensions',
                'category' => 'nail-extension',
                'category_label' => 'Nail Extension',
                'service_type' => 'catalog',
                'price' => 250000,
                'duration' => 90,
                'image' => 'nails/gallery-5.jpg',
                'uploaded_by' => 'Aurel',
                'uploader_role' => 'Nail Artist (Aurel)',
                'description' => 'Penyambungan kuku tipis, ringan, dan fleksibel menggunakan full-cover soft gel tips alami.',
                'is_active' => true,
            ],
            [
                'id' => 6,
                'name' => 'Polygel Extension Set',
                'category' => 'nail-extension',
                'category_label' => 'Nail Extension',
                'service_type' => 'catalog',
                'price' => 300000,
                'duration' => 120,
                'image' => 'nails/gallery-6.jpg',
                'uploaded_by' => 'Sela',
                'uploader_role' => 'Nail Artist (Sela)',
                'description' => 'Sambung kuku kombinasi akrilik dan gel yang kuat, kokoh untuk bentuk kuku panjang idaman.',
                'is_active' => true,
            ],
            [
                'id' => 7,
                'name' => 'Cat Eye & Metallic Chrome',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'service_type' => 'catalog',
                'price' => 135000,
                'duration' => 70,
                'image' => 'nails/gallery-7.jpg',
                'uploaded_by' => 'Sela',
                'uploader_role' => 'Nail Artist (Sela)',
                'description' => 'Efek kilau magnetik mata kucing galaksi dengan sentuhan bubuk mirror chrome berkilauan.',
                'is_active' => true,
            ],
            [
                'id' => 8,
                'name' => 'French Ombre Aura Nails',
                'category' => 'nail-art-custom',
                'category_label' => 'Nail art custom',
                'service_type' => 'catalog',
                'price' => 165000,
                'duration' => 80,
                'image' => 'nails/gallery-8.jpg',
                'uploaded_by' => 'Aurel',
                'uploader_role' => 'Nail Artist (Aurel)',
                'description' => 'Gradasi warna lembut gaya Korea/aura dengan ujung kuku french modern yang memikat.',
                'is_active' => true,
            ],
            [
                'id' => 9,
                'name' => 'Express Gel Pedicure',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'service_type' => 'catalog',
                'price' => 110000,
                'duration' => 50,
                'image' => 'nails/gallery-9.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Nail Artist (Mayang)',
                'description' => 'Perawatan kuku kaki, kikir, pembersihan kutikula, dan kutek gel berkilau tahan lama.',
                'is_active' => true,
            ],

            // --- KATALOG NAIL ART & DESAIN BY ADMIN ---
            [
                'id' => 22,
                'name' => 'Pearl Glazed Gel Polish',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'service_type' => 'catalog',
                'price' => 95000,
                'duration' => 60,
                'image' => 'img/gallery-5.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Kutek gel bernuansa mutiara mengkilap elegan (glazed donut look) cocok untuk acara formal maupun harian.',
                'is_active' => true,
            ],
            [
                'id' => 23,
                'name' => 'Velvet Blush Gel Manicure',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'service_type' => 'catalog',
                'price' => 115000,
                'duration' => 70,
                'image' => 'img/gallery-2.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Kombinasi perawatan manikur bersih dengan warna sheer blush pink lembut tahan hingga 4 minggu.',
                'is_active' => true,
            ],
            [
                'id' => 24,
                'name' => 'Minimalist Ribbon & Foil Art',
                'category' => 'nail-art-custom',
                'category_label' => 'Nail art custom',
                'service_type' => 'catalog',
                'price' => 160000,
                'duration' => 85,
                'image' => 'img/gallery-4.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Desain coquette minimalis motif pita halus dengan aksen gold foil pada base nude transparan.',
                'is_active' => true,
            ],
            [
                'id' => 25,
                'name' => 'Rose Quartz Marble Art',
                'category' => 'nail-art-custom',
                'category_label' => 'Nail art custom',
                'service_type' => 'catalog',
                'price' => 190000,
                'duration' => 95,
                'image' => 'img/gallery-8.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Efek batu kristal rose quartz marble dengan serat putih susu dan kilau emas lembut.',
                'is_active' => true,
            ],
            [
                'id' => 26,
                'name' => 'Natural Almond Gel Extension',
                'category' => 'nail-extension',
                'category_label' => 'Nail Extension',
                'service_type' => 'catalog',
                'price' => 240000,
                'duration' => 90,
                'image' => 'img/gallery-6.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Ekstensi kuku bentuk almond yang ringan dan natural lengkap dengan pewarnaan gel solid pilihan.',
                'is_active' => true,
            ],
            [
                'id' => 27,
                'name' => 'Luxury Glass Tip Extension',
                'category' => 'nail-extension',
                'category_label' => 'Nail Extension',
                'service_type' => 'catalog',
                'price' => 285000,
                'duration' => 110,
                'image' => 'img/gallery-9.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Sambung kuku transparan ala glass nails dengan sentuhan glitter halus dan top coat high-gloss.',
                'is_active' => true,
            ],

            // --- KATEGORI MANICURE / PERAWATAN KUKU ---
            [
                'id' => 10,
                'name' => 'Russian Manicure (Deep Cuticle Care)',
                'category' => 'manicure',
                'category_label' => 'Manicure',
                'service_type' => 'manicure',
                'price' => 65000,
                'duration' => 45,
                'image' => 'img/services/russian-manicure.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Nail Artist (Mayang)',
                'description' => 'Pembersihan kutikula elektrik mendalam gaya Rusia yang ultra rapi dan bersih.',
                'is_active' => true,
            ],
            [
                'id' => 11,
                'name' => 'Express Manicure & Shaping',
                'category' => 'manicure',
                'category_label' => 'Manicure',
                'service_type' => 'manicure',
                'price' => 45000,
                'duration' => 30,
                'image' => 'img/services/express-manicure.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Nail Artist (Mayang)',
                'description' => 'Pemotongan, pembentukan kuku simetris, dan perapian kutikula ringan.',
                'is_active' => true,
            ],
            [
                'id' => 12,
                'name' => 'Spa Deluxe Hand & Warm Towel Care',
                'category' => 'manicure',
                'category_label' => 'Manicure',
                'service_type' => 'manicure',
                'price' => 85000,
                'duration' => 50,
                'image' => 'img/services/spa-deluxe-hand.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Nail Artist (Mayang)',
                'description' => 'Scrub organik tangan, masker pelembap kutikula, dan relaksasi handuk hangat.',
                'is_active' => true,
            ],
            [
                'id' => 13,
                'name' => 'Tanpa Manicure (Hanya Nail Art / Remove)',
                'category' => 'manicure',
                'category_label' => 'Manicure',
                'service_type' => 'manicure',
                'price' => 0,
                'duration' => 0,
                'image' => 'img/services/no-manicure-natural.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Nail Artist (Mayang)',
                'description' => 'Hanya fokus pada pewarnaan atau pembersihan kuku.',
                'is_active' => true,
            ],

            // --- KATEGORI REMOVE NAIL ART LAMA ---
            [
                'id' => 14,
                'name' => 'Tanpa Remove (Kuku Bersih/Alami)',
                'category' => 'remove',
                'category_label' => 'Remove',
                'service_type' => 'remove',
                'price' => 0,
                'duration' => 0,
                'image' => 'img/services/tanpa-remove.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Nail Artist (Mayang)',
                'description' => 'Kuku siap diaplikasikan treatment baru tanpa perlu pembersihan kutek lama.',
                'is_active' => true,
            ],
            [
                'id' => 15,
                'name' => 'Remove Kutek Gel Lama',
                'category' => 'remove',
                'category_label' => 'Remove',
                'service_type' => 'remove',
                'price' => 30000,
                'duration' => 20,
                'image' => 'img/services/remove-gel-polish.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Pelepasan kutek gel aman tanpa merusak lapisan keratin kuku alami.',
                'is_active' => true,
            ],
            [
                'id' => 16,
                'name' => 'Remove Akrilik / Extension Lama',
                'category' => 'remove',
                'category_label' => 'Remove',
                'service_type' => 'remove',
                'price' => 50000,
                'duration' => 35,
                'image' => 'img/services/remove-acrylic.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Proses pelarutan dan pembersihan sambungan kuku akrilik/tip terdahulu.',
                'is_active' => true,
            ],

            // --- KATEGORI TAMBAHAN HARI-H (ADD-ON KASIR) ---
            [
                'id' => 17,
                'name' => 'Aksesoris Charm 3D / Kristal Swarovski',
                'category' => 'addon',
                'category_label' => 'Tambahan Hari-H',
                'service_type' => 'addon',
                'price' => 25000,
                'duration' => 10,
                'image' => 'img/services/addon-3d-charm.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Penambahan charm 3D atau kristal permata saat sesi pengerjaan.',
                'is_active' => true,
            ],
            [
                'id' => 18,
                'name' => 'Ekstra Layer Builder Gel (BIAB)',
                'category' => 'addon',
                'category_label' => 'Tambahan Hari-H',
                'service_type' => 'addon',
                'price' => 40000,
                'duration' => 15,
                'image' => 'img/services/addon-biab.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Penguatan struktur kuku alami dengan builder gel ekstra.',
                'is_active' => true,
            ],
            [
                'id' => 19,
                'name' => 'Aksen Chrome / Aurora Powder',
                'category' => 'addon',
                'category_label' => 'Tambahan Hari-H',
                'service_type' => 'addon',
                'price' => 30000,
                'duration' => 10,
                'image' => 'img/services/addon-chrome-aurora.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Tambahan efek kilau chrome atau aurora di atas warna gel.',
                'is_active' => true,
            ],
            [
                'id' => 20,
                'name' => 'Nail Tip Extension Tambahan (2 Jari)',
                'category' => 'addon',
                'category_label' => 'Tambahan Hari-H',
                'service_type' => 'addon',
                'price' => 35000,
                'duration' => 15,
                'image' => 'img/services/addon-nail-tip.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Perbaikan / penyambungan kuku patah menggunakan soft gel tip.',
                'is_active' => true,
            ],
            [
                'id' => 21,
                'name' => 'Spa Hand Massage & Pelembap',
                'category' => 'addon',
                'category_label' => 'Tambahan Hari-H',
                'service_type' => 'addon',
                'price' => 30000,
                'duration' => 15,
                'image' => 'img/services/addon-hand-massage.jpg',
                'uploaded_by' => 'Admin',
                'uploader_role' => 'Admin',
                'description' => 'Pijat relaksasi tangan dengan lotion aroma terapi.',
                'is_active' => true,
            ],
        ];

        $serviceModels = [];
        foreach ($services as $svc) {
            $serviceModels[$svc['id']] = Service::updateOrCreate(
                ['id' => $svc['id']],
                $svc
            );
        }

        // 3. Seed Data Janji Temu (Appointments & AppointmentItems)
        $today = Carbon::today()->toDateString();
        $tomorrow = Carbon::today()->addDay()->toDateString();
        $fullDay = Carbon::today()->addDays(2)->toDateString();

        $appointmentsData = [
            [
                'booking_code' => 'APT-000',
                'user_id' => $userModels['Amanda']->id,
                'artist_id' => $userModels['Aurel']->id,
                'client_name' => 'Amanda (Buyer)',
                'client_phone' => '0812-9876-5432',
                'client_type' => 'Pelanggan Baru',
                'appointment_date' => $today,
                'time_slot' => '10:15 - 11:30 WIB',
                'station' => 'Station 01',
                'guests' => 1,
                'design_type' => 'custom',
                'custom_design_image' => 'nails/gallery-3.jpg',
                'custom_design_note' => 'Request custom design kuku via upload foto (Lilac floral & aksen emas). DP Rp 50.000 sudah lunas.',
                'dp_amount' => 50000,
                'dp_payment_method' => 'qris',
                'dp_status' => 'verified',
                'initial_total' => 275000,
                'addons_total' => 0,
                'final_total' => 275000,
                'final_payment_status' => 'unpaid',
                'status' => 'Sedang Berlangsung',
                'total_duration' => 155,
                'notes' => 'Request custom design kuku via upload foto (Lilac floral & aksen emas). DP Rp 50.000 sudah lunas.',
                'items' => [
                    ['service_id' => 10, 'item_name' => 'Russian Manicure (Deep Cuticle Care)', 'item_type' => 'manicure', 'price' => 65000, 'duration' => 45, 'is_addon' => false],
                    ['service_id' => 3, 'item_name' => 'Handpainted Custom Nail Art (Request Desain Sendiri)', 'item_type' => 'nail_art', 'price' => 180000, 'duration' => 90, 'is_addon' => false],
                    ['service_id' => 15, 'item_name' => 'Remove Kutek Gel Lama', 'item_type' => 'remove', 'price' => 30000, 'duration' => 20, 'is_addon' => false],
                ],
            ],
            [
                'booking_code' => 'APT-001',
                'user_id' => null,
                'artist_id' => $userModels['Aurel']->id,
                'client_name' => 'Amanda Putri',
                'client_phone' => '0812-9876-1111',
                'client_type' => 'Member',
                'appointment_date' => $today,
                'time_slot' => '15:00 - 16:30 WIB',
                'station' => 'Station 01',
                'guests' => 1,
                'design_type' => 'catalog',
                'custom_design_image' => null,
                'custom_design_note' => null,
                'dp_amount' => 50000,
                'dp_payment_method' => 'bank_transfer',
                'dp_status' => 'verified',
                'initial_total' => 225000,
                'addons_total' => 25000,
                'final_total' => 250000,
                'final_payment_method' => 'qris',
                'final_payment_status' => 'paid',
                'status' => 'Selesai',
                'total_duration' => 105,
                'notes' => 'Minta aksen bunga daisy warna lilac di jari manis & telunjuk.',
                'items' => [
                    ['service_id' => 11, 'item_name' => 'Express Manicure & Shaping', 'item_type' => 'manicure', 'price' => 45000, 'duration' => 30, 'is_addon' => false],
                    ['service_id' => 3, 'item_name' => 'Handpainted Custom Nail Art', 'item_type' => 'nail_art', 'price' => 180000, 'duration' => 90, 'is_addon' => false],
                    ['service_id' => 17, 'item_name' => 'Aksesoris Charm 3D / Kristal Swarovski', 'item_type' => 'addon', 'price' => 25000, 'duration' => 10, 'is_addon' => true],
                ],
            ],
            [
                'booking_code' => 'APT-002',
                'user_id' => null,
                'artist_id' => $userModels['Sela']->id,
                'client_name' => 'Clara Sitorus',
                'client_phone' => '0818-7766-5544',
                'client_type' => 'Member',
                'appointment_date' => $tomorrow,
                'time_slot' => '11:45 - 13:00 WIB',
                'station' => 'Station 02',
                'guests' => 1,
                'design_type' => 'catalog',
                'custom_design_image' => null,
                'custom_design_note' => null,
                'dp_amount' => 50000,
                'dp_payment_method' => 'qris',
                'dp_status' => 'verified',
                'initial_total' => 180000,
                'addons_total' => 0,
                'final_total' => 180000,
                'final_payment_status' => 'unpaid',
                'status' => 'Menunggu',
                'total_duration' => 100,
                'notes' => 'Bawa contoh foto ujung almond sedang.',
                'items' => [
                    ['service_id' => 11, 'item_name' => 'Express Manicure & Shaping', 'item_type' => 'manicure', 'price' => 45000, 'duration' => 30, 'is_addon' => false],
                    ['service_id' => 7, 'item_name' => 'Cat Eye & Metallic Chrome', 'item_type' => 'nail_art', 'price' => 135000, 'duration' => 70, 'is_addon' => false],
                ],
            ],
        ];

        // Buat 1 hari penuh (semua 7 slot terisi) di H+2 agar kalender otomatis menandai tanggal tsb "Penuh" dari DB
        $allSlots = [
            '09:00 - 10:00 WIB',
            '10:15 - 11:30 WIB',
            '11:45 - 13:00 WIB',
            '13:30 - 14:45 WIB',
            '15:00 - 16:30 WIB',
            '16:45 - 18:00 WIB',
            '18:30 - 19:45 WIB',
        ];
        $nailArtistIds = [
            $userModels['Aurel']->id,
            $userModels['Mayang']->id,
            $userModels['Sela']->id,
        ];

        foreach ($allSlots as $idx => $slotName) {
            $appointmentsData[] = [
                'booking_code' => 'APT-FULL-'.($idx + 1),
                'user_id' => null,
                'artist_id' => $nailArtistIds[$idx % count($nailArtistIds)],
                'client_name' => 'Tamu Studio '.($idx + 1),
                'client_phone' => '0813-0000-000'.($idx + 1),
                'client_type' => 'Member',
                'appointment_date' => $fullDay,
                'time_slot' => $slotName,
                'station' => 'Station 0'.(($idx % 2) + 1),
                'guests' => 1,
                'design_type' => 'catalog',
                'custom_design_image' => null,
                'custom_design_note' => null,
                'dp_amount' => 50000,
                'dp_payment_method' => 'qris',
                'dp_status' => 'verified',
                'initial_total' => 140000,
                'addons_total' => 0,
                'final_total' => 140000,
                'final_payment_status' => 'unpaid',
                'status' => 'Menunggu',
                'total_duration' => 60,
                'notes' => 'Booking jadwal studio terkonfirmasi.',
                'items' => [
                    ['service_id' => 10, 'item_name' => 'Russian Manicure (Deep Cuticle Care)', 'item_type' => 'manicure', 'price' => 65000, 'duration' => 45, 'is_addon' => false],
                    ['service_id' => 1, 'item_name' => 'Basic Gel Polish', 'item_type' => 'nail_art', 'price' => 75000, 'duration' => 60, 'is_addon' => false],
                ],
            ];
        }

        foreach ($appointmentsData as $apptData) {
            $items = $apptData['items'];
            unset($apptData['items']);

            $appointment = Appointment::updateOrCreate(
                ['booking_code' => $apptData['booking_code']],
                $apptData
            );

            // Reset & seed items cleanly
            $appointment->items()->delete();
            foreach ($items as $item) {
                AppointmentItem::create(array_merge($item, ['appointment_id' => $appointment->id]));
            }
        }

        // 4. Seed Pengajuan Cuti Nail Artist
        $leaveSeedData = [
            [
                'id' => 1,
                'user_id' => $userModels['Aurel']->id,
                'artist_name' => 'Aurel',
                'leave_type' => 'Keperluan Keluarga',
                'start_date' => Carbon::today()->addDays(4)->toDateString(),
                'end_date' => Carbon::today()->addDays(6)->toDateString(),
                'duration_days' => 3,
                'reason' => 'Acara keluarga di luar kota.',
                'status' => 'menunggu',
                'admin_note' => null,
                'reviewed_by' => null,
                'reviewed_at' => null,
            ],
            [
                'id' => 2,
                'user_id' => $userModels['Mayang']->id,
                'artist_name' => 'Mayang',
                'leave_type' => 'Izin Sakit',
                'start_date' => Carbon::today()->addDays(8)->toDateString(),
                'end_date' => Carbon::today()->addDays(8)->toDateString(),
                'duration_days' => 1,
                'reason' => 'Kontrol kesehatan rutin ke dokter.',
                'status' => 'menunggu',
                'admin_note' => null,
                'reviewed_by' => null,
                'reviewed_at' => null,
            ],
            [
                'id' => 3,
                'user_id' => $userModels['Sela']->id,
                'artist_name' => 'Sela',
                'leave_type' => 'Cuti Khusus',
                'start_date' => Carbon::today()->subDays(5)->toDateString(),
                'end_date' => Carbon::today()->subDays(5)->toDateString(),
                'duration_days' => 1,
                'reason' => 'Menghadiri acara wisuda keluarga.',
                'status' => 'disetujui',
                'admin_note' => 'Disetujui, slot meja kerja sudah dialihkan sementara.',
                'reviewed_by' => $userModels['Admin']->id,
                'reviewed_at' => Carbon::today()->subDays(6),
            ],
        ];

        foreach ($leaveSeedData as $leave) {
            LeaveRequest::updateOrCreate(
                ['id' => $leave['id']],
                $leave
            );
        }
    }
}
