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

        $response
            ->assertStatus(200)
            ->assertSeeText('Greater Noida West')
            ->assertSeeText('Front office')
            ->assertSeeText('Pay fees')
            ->assertSeeText('Careers');
    }

    public function test_assets_follow_https_forwarded_by_the_local_tunnel(): void
    {
        $this->withServerVariables([
            'REMOTE_ADDR' => '127.0.0.1',
            'HTTP_X_FORWARDED_PROTO' => 'https',
            'HTTP_X_FORWARDED_HOST' => 'demo.ngrok-free.dev',
            'HTTP_X_FORWARDED_PORT' => '443',
        ])->get('/')
            ->assertOk()
            ->assertSee('https://demo.ngrok-free.dev/css/app.css');
    }
}
