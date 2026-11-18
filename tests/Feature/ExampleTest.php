<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
