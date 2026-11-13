<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\LoginDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    public function __construct(
        private readonly AuthServiceInterface $authService
    ) {}

    /**
     * Show the login form
     */
    public function showLoginForm(Request $request): View
    {
        // Store redirect URL if provided (for special offers booking)
        if ($request->has('redirect')) {
            $request->session()->put('url.intended', $request->redirect);
        }

        return view('auth.Login.login');
    }

    /**
     * Handle login request
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $ip = (string) $request->ip();
        $email = (string) $request->validated('email');

        // Check if locked out before attempting
        if ($this->authService->isLockedOut($email, $ip)) {
            $seconds = $this->authService->availableIn($email, $ip);
            Alert::error('Akun Terkunci!', "Terlalu banyak percobaan login gagal. Silakan coba lagi dalam {$seconds} detik.");

            return back()->withInput($request->only('email'))->withErrors([
                'email' => "Terlalu banyak percobaan login gagal. Silakan coba lagi dalam {$seconds} detik.",
            ])->setStatusCode(429);
        }

        $dto = LoginDTO::fromRequest($request);

        if ($this->authService->login($dto, $ip)) {
            $user = Auth::user();

            if ($user && $user->role === 'admin') {
                Alert::success('Berhasil!', 'Selamat datang Admin ' . $user->name);
                return redirect()->intended('/admin/dashboard');
            }

            Alert::success('Berhasil!', 'Selamat datang ' . ($user?->name ?? ''));
            return redirect()->intended('/');
        }

        // If locked out after this failed attempt
        if ($this->authService->isLockedOut($email, $ip)) {
            $seconds = $this->authService->availableIn($email, $ip);
            Alert::error('Akun Terkunci!', "Terlalu banyak percobaan login gagal. Akun dikunci sementara selama {$seconds} detik.");

            return back()->withInput($request->only('email'))->withErrors([
                'email' => "Terlalu banyak percobaan login gagal. Akun dikunci sementara selama {$seconds} detik.",
            ])->setStatusCode(429);
        }

        // Login failed
        Alert::error('Gagal!', 'Email atau password salah');
        return back()->withInput($request->only('email'));
    }

    /**
     * Handle logout request
     */
    public function logout(): RedirectResponse
    {
        $this->authService->logout();

        Alert::success('Berhasil!', 'Anda telah logout');
        return redirect('/login');
    }
}
