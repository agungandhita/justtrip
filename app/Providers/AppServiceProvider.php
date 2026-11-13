<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Vite;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\SweetAlertServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->register(SweetAlertServiceProvider::class);
        $this->app->alias('alert', \RealRashid\SweetAlert\Facades\Alert::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ─────────────────────────────────────────────────────────────────────
        // 1. Safeguard: Prevent Vite Dev Server URL leakage in production
        // ─────────────────────────────────────────────────────────────────────
        if ($this->app->isProduction() || config('app.env') === 'production') {
            Vite::useHotFile(storage_path('framework/production_vite.hot'));

            if (file_exists(public_path('hot'))) {
                @unlink(public_path('hot'));
            }
        }

        // ─────────────────────────────────────────────────────────────────────
        // 2. View Composers
        // ─────────────────────────────────────────────────────────────────────
        view()->composer('Frontend.partials.navbar', \App\Http\View\Composers\NavbarComposer::class);

        // ─────────────────────────────────────────────────────────────────────
        // 3. Security: Rate Limiters (Login, Register, Sensitive Actions)
        // ─────────────────────────────────────────────────────────────────────
        $this->configureRateLimiting();
    }

    /**
     * Configure rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        // Rate limiter for login: 5 attempts per minute per email + IP
        RateLimiter::for('login', function (Request $request) {
            $email = (string) $request->input('email', '');
            $throttleKey = Str::transliterate(Str::lower(trim($email)) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey)->response(function (Request $request, array $headers) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Terlalu banyak percobaan login. Akun terkunci sementara demi keamanan. Silakan coba lagi dalam 1 menit.',
                    ], 429, $headers);
                }

                return response()->view('errors.429', [
                    'message' => 'Terlalu banyak percobaan login. Demi keamanan, silakan tunggu 1 menit sebelum mencoba kembali.',
                ], 429, $headers);
            });
        });

        // Rate limiter for register: 3 attempts per minute per IP
        RateLimiter::for('register', function (Request $request) {
            return Limit::perMinute(3)->by($request->ip())->response(function (Request $request, array $headers) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Terlalu banyak percobaan registrasi. Silakan coba lagi dalam 1 menit.',
                    ], 429, $headers);
                }

                return response()->view('errors.429', [
                    'message' => 'Terlalu banyak percobaan pendaftaran akun. Silakan coba lagi dalam 1 menit.',
                ], 429, $headers);
            });
        });

        // Rate limiter for WhatsApp Inquiry: 5 requests per minute per IP
        RateLimiter::for('inquiry', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip())->response(function (Request $request, array $headers) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Terlalu banyak permintaan inquiry. Silakan tunggu 1 menit.',
                    ], 429, $headers);
                }

                return response()->view('errors.429', [
                    'message' => 'Terlalu banyak permintaan pemesanan via WhatsApp. Silakan tunggu 1 menit.',
                ], 429, $headers);
            });
        });

        // Rate limiter for Guest Booking: 5 requests per minute per IP
        RateLimiter::for('booking', function (Request $request) {
            return Limit::perMinute(5)->by($request->ip())->response(function (Request $request, array $headers) {
                if ($request->expectsJson()) {
                    return response()->json([
                        'message' => 'Terlalu banyak permintaan booking. Silakan tunggu 1 menit.',
                    ], 429, $headers);
                }

                return response()->view('errors.429', [
                    'message' => 'Terlalu banyak pengiriman data booking. Silakan tunggu 1 menit.',
                ], 429, $headers);
            });
        });
    }
}
