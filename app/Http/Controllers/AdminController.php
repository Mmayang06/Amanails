<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
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

    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function katalog()
    {
        $categories = [
            ['id' => 'all', 'name' => 'Semua'],
            ['id' => 'gel-polish', 'name' => 'Gel Polish'],
            ['id' => 'nail-art-custom', 'name' => 'Nail art custom'],
            ['id' => 'nail-extension', 'name' => 'Nail Extension'],
        ];

        // Katalog admin: Hanya menampilkan katalog yang dibuat oleh Admin
        $services = array_values(array_filter($this->getServicesData(), function ($item) {
            return str_contains($item['uploader_role'], 'Admin');
        }));

        return view('admin.katalog', compact('categories', 'services'));
    }
}
