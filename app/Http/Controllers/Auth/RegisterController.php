<?php

namespace App\Http\Controllers\Auth;

use App\DTOs\Auth\RegisterUserDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Services\Auth\AuthServiceInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;

class RegisterController extends Controller
{
    public function __construct(
        private readonly AuthServiceInterface $authService
    ) {}

    /**
     * Show the registration form
     */
    public function showRegistrationForm(): View
    {
        return view('auth.Register.register');
    }

    /**
     * Handle registration request
     */
    public function register(RegisterRequest $request): RedirectResponse
    {
        try {
            $dto = RegisterUserDTO::fromRequest($request);
            $user = $this->authService->register($dto);

            Alert::success('Selamat Datang!', 'Akun berhasil dibuat. Selamat bergabung di JustTrip, ' . $user->name . '!');
            return redirect()->intended('/');
        } catch (Throwable $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.');
            return back()->withInput($request->except('password', 'password_confirmation'));
        }
    }
}
