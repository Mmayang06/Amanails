<?php

namespace Tests\Feature;

use Tests\TestCase;

class ExampleTest extends TestCase
{
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
        $response->assertSee('Jadwal Ketersediaan Jam');
        $response->assertSee('Pilih Tanggal Kunjungan');
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
    }

    public function test_terapis_karya_page_returns_a_successful_response(): void
    {
        $response = $this->get('/terapis/karya');

        $response->assertStatus(200);
        $response->assertSee('Amanails');
        $response->assertSee('Portofolio Terapis');
        $response->assertSee('Kembali ke Dashboard');
        $response->assertSee('Almond');
        $response->assertSee('Coffin');
        $response->assertSee('Stiletto');
    }

    public function test_terapis_cuti_page_returns_a_successful_response(): void
    {
        $response = $this->get('/terapis/cuti');

        $response->assertStatus(200);
        $response->assertSee('Amanails');
        $response->assertSee('Pengajuan &amp; Kuota Cuti', false);
        $response->assertSee('Kembali ke Dashboard');
        $response->assertSee('Riwayat Pengajuan Cuti');
    }
}
