<?php

namespace Tests\Feature;

use Database\Seeders\DatabaseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DatabaseSeeder::class);
    }

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Amanails');
        $response->assertSee('Pilih Jasa &amp; Layanan', false);
    }

    public function test_buyer_catalog_page_returns_successful_response(): void
    {
        $response = $this->get('/katalog');

        $response->assertStatus(200);
        $response->assertSee('Amanails');
        $response->assertSee('Pilih Jasa &amp; Layanan', false);
        $response->assertSee('Lanjut Pilih Jadwal');
    }

    public function test_buyer_schedule_page_returns_successful_response(): void
    {
        $response = $this->get('/jadwal');

        $response->assertStatus(200);
        $response->assertSee('Amanails');
        $response->assertSee('Reservasi Kursi Anda');
        $response->assertSee('Tanggal Kunjungan');
        $response->assertSee('Nail Artist Bertugas');
        $response->assertSee('Ringkasan Reservasi');
        $response->assertSee('amanails-calendar', false);
        $response->assertSee('QRIS');
        $response->assertSee('Transfer Bank');
        $response->assertSee('8735 0921 44');
        $response->assertSee('142 00 1982736 1');
        $response->assertSee('Upload Bukti Pembayaran');
        $response->assertSee('Request Desain Sendiri');
        $response->assertSee('Pembersihan / Remove');
        $response->assertSee('Sisa Pelunasan di Studio');
        $response->assertDontSee('Auto-Assign');
        $response->assertDontSee('Pilihan Terapis');
    }

    public function test_services_page_returns_a_successful_response(): void
    {
        $response = $this->get('/services');

        $response->assertStatus(200);
    }

    public function test_terapis_dashboard_page_returns_a_successful_response(): void
    {
        $response = $this->get('/terapis/dashboard');

        $response->assertStatus(200);
        $response->assertSee('Amanails');
        $response->assertSee('Mia Alvarez');
        $response->assertSee('Sela (Buyer)');
        $response->assertSee('Detail &amp; Kasir Pelunasan', false);
        $response->assertSee('Tambahan Layanan Hari-H');
    }
}
