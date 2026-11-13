<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\RateLimiter;
use Tests\TestCase;

class AuthRateLimitTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        RateLimiter::clear('login');
        RateLimiter::clear('register');
    }

    public function test_security_headers_are_attached_to_responses(): void
    {
        $response = $this->get('/login');

        $response->assertHeader('X-Frame-Options', 'SAMEORIGIN');
        $response->assertHeader('X-Content-Type-Options', 'nosniff');
        $response->assertHeader('X-XSS-Protection', '1; mode=block');
        $response->assertHeader('Referrer-Policy', 'strict-origin-when-cross-origin');
    }

    public function test_login_throttles_and_returns_429_after_exceeding_attempts(): void
    {
        // 5 allowed attempts
        for ($i = 0; $i < 5; $i++) {
            $response = $this->post('/login', [
                'email'    => 'bruteforce@test.com',
                'password' => 'wrongpassword123',
            ]);

            // First 5 attempts might fail validation/auth (302/redirect or 422), but NOT 429
            $this->assertNotEquals(429, $response->getStatusCode(), "Attempt {$i} should not be throttled yet");
        }

        // 6th attempt MUST be throttled with HTTP 429
        $throttledResponse = $this->post('/login', [
            'email'    => 'bruteforce@test.com',
            'password' => 'wrongpassword123',
        ]);

        $this->assertEquals(429, $throttledResponse->getStatusCode(), '6th attempt must return HTTP 429 Too Many Requests');
        $throttledResponse->assertSee('Terlalu Banyak Permintaan');
    }

    public function test_register_throttles_and_returns_429_after_three_attempts(): void
    {
        // 3 allowed attempts per minute per IP
        for ($i = 0; $i < 3; $i++) {
            $response = $this->post('/register', [
                'name'                  => 'Bot Tester',
                'email'                 => "bot{$i}@test.com",
                'phone'                 => '08123456789',
                'address'               => 'Test Address',
                'password'              => 'password123',
                'password_confirmation' => 'password123',
            ]);

            $this->assertNotEquals(429, $response->getStatusCode(), "Register attempt {$i} should not be throttled yet");
        }

        // 4th attempt MUST return HTTP 429
        $throttledResponse = $this->post('/register', [
            'name'                  => 'Bot Tester',
            'email'                 => 'bot4@test.com',
            'phone'                 => '08123456789',
            'address'               => 'Test Address',
            'password'              => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $this->assertEquals(429, $throttledResponse->getStatusCode(), '4th register attempt must return HTTP 429 Too Many Requests');
    }
}
