<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
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
                'name' => 'Mayang',
                'email' => 'admin@amanails.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'phone' => '0812-1111-2222',
                'avatar' => 'img/tech-2.jpg',
                'specialty' => 'Admin & Lead Technician',
            ],
            [
                'name' => 'Aurel',
                'email' => 'aurel@amanails.com',
                'password' => Hash::make('password'),
                'role' => 'nail_artist',
                'phone' => '0812-3333-4444',
                'avatar' => 'img/tech-1.jpg',
                'specialty' => 'Senior Nail Artist (Handpainted & 3D Art)',
            ],
            [
                'name' => 'Nadia',
                'email' => 'nadia@amanails.com',
                'password' => Hash::make('password'),
                'role' => 'nail_artist',
                'phone' => '0812-5555-6666',
                'avatar' => 'img/tech-3.jpg',
                'specialty' => 'Nail Artist (Ombre, Chrome & Express Care)',
            ],
            [
                'name' => 'Sela',
                'email' => 'sela@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'buyer',
                'phone' => '0812-9876-5432',
                'avatar' => 'img/client-1.jpg',
                'specialty' => null,
            ],
        ];

        foreach ($users as $u) {
            User::updateOrCreate(
                ['email' => $u['email']],
                $u
            );
        }

        // 2. Seed Katalog Layanan & Model Kuku (File Gambar di Render via Storage Link)
        $services = [
            [
                'id' => 1,
                'name' => 'Basic Gel Polish',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'price' => 75000,
                'duration' => 60,
                'image' => 'nails/gallery-1.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Admin (Mayang)',
                'description' => 'Aplikasi base coat, 2 lapis kutek gel solid warna pilihan tahan lama hingga 3-4 minggu, dan glossy top coat.',
                'is_active' => true,
            ],
            [
                'id' => 2,
                'name' => 'Russian Manicure + Gel',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'price' => 125000,
                'duration' => 75,
                'image' => 'nails/gallery-2.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Admin (Mayang)',
                'description' => 'Pembersihan kutikula elektrik mendalam gaya Rusia yang ultra rapi dan tahan lama sebelum pewarnaan gel.',
                'is_active' => true,
            ],
            [
                'id' => 3,
                'name' => 'Handpainted Custom Nail Art',
                'category' => 'nail-art-custom',
                'category_label' => 'Nail art custom',
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
                'price' => 300000,
                'duration' => 120,
                'image' => 'nails/gallery-6.jpg',
                'uploaded_by' => 'Nadia',
                'uploader_role' => 'Nail Artist (Nadia)',
                'description' => 'Sambung kuku kombinasi akrilik dan gel yang kuat, kokoh untuk bentuk kuku panjang idaman.',
                'is_active' => true,
            ],
            [
                'id' => 7,
                'name' => 'Cat Eye & Metallic Chrome',
                'category' => 'gel-polish',
                'category_label' => 'Gel Polish',
                'price' => 135000,
                'duration' => 70,
                'image' => 'nails/gallery-7.jpg',
                'uploaded_by' => 'Nadia',
                'uploader_role' => 'Nail Artist (Nadia)',
                'description' => 'Efek kilau magnetik mata kucing galaksi dengan sentuhan bubuk mirror chrome berkilauan.',
                'is_active' => true,
            ],
            [
                'id' => 8,
                'name' => 'French Ombre Aura Nails',
                'category' => 'nail-art-custom',
                'category_label' => 'Nail art custom',
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
                'price' => 110000,
                'duration' => 50,
                'image' => 'nails/gallery-9.jpg',
                'uploaded_by' => 'Mayang',
                'uploader_role' => 'Admin (Mayang)',
                'description' => 'Perawatan kuku kaki, kikir, pembersihan kutikula, dan kutek gel berkilau tahan lama.',
                'is_active' => true,
            ],
        ];

        foreach ($services as $svc) {
            Service::updateOrCreate(
                ['id' => $svc['id']],
                $svc
            );
        }
    }
}
