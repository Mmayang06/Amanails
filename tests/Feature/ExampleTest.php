<?php

namespace Tests\Feature;

use App\Models\Appointment;
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
        $response->assertSee('Amanda (Buyer)');
        $response->assertSee('Detail &amp; Kasir Pelunasan', false);
        $response->assertSee('Tambahan Layanan Hari-H');
    }

    public function test_availability_endpoint_returns_slots_from_database(): void
    {
        $response = $this->getJson('/jadwal/availability?date='.now()->toDateString());

        $response->assertStatus(200)
            ->assertJsonStructure(['date', 'slots']);
    }

    public function test_buyer_can_store_booking_into_database(): void
    {
        $response = $this->postJson('/booking', [
            'client_name' => 'Sela Test',
            'client_phone' => '0812-0000-1111',
            'appointment_date' => now()->addDays(5)->toDateString(),
            'time_slot' => '09:00 - 10:00 WIB',
            'guests' => 2,
            'manicure_id' => 10,
            'design_type' => 'catalog',
            'nail_art_id' => 3,
            'remove_id' => 15,
            'dp_payment_method' => 'qris',
        ]);

        $response->assertStatus(201)
            ->assertJson([
                'success' => true,
                'dp_amount' => 100000,
                'final_total' => 550000,
                'remaining_balance' => 450000,
            ]);

        $this->assertDatabaseHas('appointments', [
            'client_name' => 'Sela Test',
            'guests' => 2,
            'dp_amount' => 100000,
            'final_total' => 550000,
        ]);
    }

    public function test_terapis_can_add_addon_and_complete_appointment_in_database(): void
    {
        $appointment = Appointment::where('booking_code', 'APT-000')->firstOrFail();

        $addonResponse = $this->postJson('/appointments/'.$appointment->id.'/addons', [
            'service_id' => 17, // Charm 3D (+25.000)
        ]);

        $addonResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'addons_total' => 25000,
                'final_total' => 300000,
                'remaining_balance' => 250000,
            ]);

        $completeResponse = $this->patchJson('/appointments/'.$appointment->id.'/complete', [
            'payment_method' => 'qris',
        ]);

        $completeResponse->assertStatus(200)
            ->assertJson([
                'success' => true,
                'status' => 'Selesai',
                'final_total' => 300000,
            ]);

        $this->assertDatabaseHas('appointments', [
            'id' => $appointment->id,
            'status' => 'Selesai',
            'final_payment_status' => 'paid',
            'final_payment_method' => 'qris',
            'final_total' => 300000,
        ]);
    }

    public function test_login_redirects_each_role_to_their_dashboard(): void
    {
        // Admin -> /admin/dashboard
        $this->post('/login', [
            'email' => 'admin@amanails.com',
            'password' => 'password',
        ])->assertRedirect(route('admin.dashboard'));
        $this->post('/logout');

        // Nail Artist -> /terapis/dashboard
        $this->post('/login', [
            'email' => 'sela@amanails.com',
            'password' => 'password',
        ])->assertRedirect(route('terapis.dashboard'));
        $this->post('/logout');

        // Buyer -> /
        $this->post('/login', [
            'email' => 'amanda@gmail.com',
            'password' => 'password',
        ])->assertRedirect(route('home'));
    }

    public function test_admin_dashboard_uses_database_appointments_and_current_date(): void
    {
        $response = $this->get('/admin/dashboard');

        $response->assertStatus(200);
        $response->assertSee(now()->format('d M'));
        $response->assertSee('Amanda (Buyer)');
        $response->assertSee('Keluar');
        $response->assertDontSee('21 Nov');
        $response->assertDontSee('Angelina');
    }
}
