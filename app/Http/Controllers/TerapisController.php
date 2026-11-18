<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TerapisController extends Controller
{
    /**
     * Tampilkan Dashboard Terapis dengan data simulasi (Mock Data tanpa DB).
     */
    public function dashboard()
    {
        // Profil terapis aktif (simulasi data)
        $terapis = [
            'nama' => 'Mia Alvarez',
            'role' => 'Nail Art Lead & Senior Technician',
            'spesialisasi' => 'Freehand Florals, Chrome & Micro-Detailing',
            'foto' => asset('img/tech-1.jpg'),
            'rating' => '4.95',
            'total_ulasan' => 148,
            'status' => 'Tersedia', // Tersedia, Sedang Melayani, Istirahat
            'bergabung_sejak' => 'Maret 2021',
            'meja_kerja' => 'Station 01',
        ];

        // Ringkasan Statistik Kinerja
        $statistik = [
            'janji_hari_ini' => 5,
            'total_pelanggan_bulan_ini' => 118,
            'klien_baru_bulan_ini' => 14,
            'layanan_selesai_minggu_ini' => 28,
            'estimasi_komisi_mingguan' => 'Rp 2.450.000',
        ];

        // Jadwal Janji Temu Hari Ini
        $jadwalHariIni = [
            [
                'id' => 'APT-001',
                'jam' => '10:00 - 11:00 WIB',
                'klien' => 'Amanda Putri',
                'kontak' => '0812-9876-5432',
                'layanan' => 'Manikur Gel Lengkap + Floral Nail Art',
                'durasi' => '60 Menit',
                'status' => 'Selesai',
                'catatan' => 'Minta aksen bunga daisy warna lilac di jari manis & telunjuk.',
                'tipe_klien' => 'Member',
                'kursi' => 'Station 01',
            ],
            [
                'id' => 'APT-002',
                'jam' => '11:30 - 12:30 WIB',
                'klien' => 'Jessica Tan',
                'kontak' => '0813-1122-3344',
                'layanan' => 'BIAB Overlay (Builder Gel) + Nude Glazed',
                'durasi' => '60 Menit',
                'status' => 'Sedang Berlangsung',
                'catatan' => 'Kuku alami sedikit rapuh setelah pelepasan akrilik lama.',
                'tipe_klien' => 'Pelanggan Baru',
                'kursi' => 'Station 01',
            ],
            [
                'id' => 'APT-003',
                'jam' => '14:00 - 15:30 WIB',
                'klien' => 'Clara Sitorus',
                'kontak' => '0818-7766-5544',
                'layanan' => 'Soft Gel Extensions + French Chrome Tips',
                'durasi' => '85 Menit',
                'status' => 'Menunggu',
                'catatan' => 'Bawa contoh foto dari Instagram (ujung almond sedang).',
                'tipe_klien' => 'Member',
                'kursi' => 'Station 02',
            ],
            [
                'id' => 'APT-004',
                'jam' => '16:00 - 17:00 WIB',
                'klien' => 'Diana Permata',
                'kontak' => '0857-3344-9988',
                'layanan' => 'Spa Manikur Deluxe + Parafin Lilin Hangat',
                'durasi' => '55 Menit',
                'status' => 'Menunggu',
                'catatan' => 'Kulit tangan kering, pijatan ekstra lembut.',
                'tipe_klien' => 'Pelanggan Baru',
                'kursi' => 'Station 01',
            ],
            [
                'id' => 'APT-005',
                'jam' => '17:30 - 18:30 WIB',
                'klien' => 'Nadira Alatas',
                'kontak' => '0821-4455-6677',
                'layanan' => 'Infill & Retouch Gel + Kristal Swarovski',
                'durasi' => '60 Menit',
                'status' => 'Menunggu',
                'catatan' => 'Persiapan acara pesta akhir pekan.',
                'tipe_klien' => 'Member',
                'kursi' => 'Station 01',
            ],
        ];

        // Data Kuota & Riwayat Pengajuan Cuti Terapis (Jatah Cuti 8 Hari Sebulan)
        $dataCuti = [
            'kuota_bulanan' => 8,
            'cuti_terpakai' => 2,
            'sisa_cuti' => 6,
            'periode' => 'Bulan Ini (' . date('F Y') . ')',
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

        // Karya Unggulan Terapis
        $karyaTerapis = [
            ['judul' => 'Pressed Florals', 'gaya' => 'Floral Art', 'img' => asset('img/gallery-3.jpg'), 'suka' => 420],
            ['judul' => 'Rose Gold Chrome', 'gaya' => 'Chrome Mirror', 'img' => asset('img/gallery-6.jpg'), 'suka' => 380],
            ['judul' => 'Glazed Nude Shimmer', 'gaya' => 'Glazed Gel', 'img' => asset('img/gallery-5.jpg'), 'suka' => 512],
            ['judul' => 'Modern French Tips', 'gaya' => 'Classic French', 'img' => asset('img/gallery-1.jpg'), 'suka' => 295],
        ];

        return view('terapis.dashboard', compact('terapis', 'statistik', 'jadwalHariIni', 'dataCuti', 'karyaTerapis'));
    }
}
