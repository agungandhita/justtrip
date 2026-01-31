<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class RegisterController extends Controller
{
    /**
     * Show the registration form
     */
    public function showRegistrationForm()
    {
        return view('auth.Register.register');
    }

    /**
     * Handle registration request
     */
    public function register(Request $request)
    {
        // Validasi input - menggunakan 'name' sesuai dengan form field
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:500',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'name.required' => 'Nama lengkap wajib diisi',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar, gunakan email lain atau login',
            'phone.required' => 'Nomor WhatsApp/Telepon wajib diisi',
            'phone.max' => 'Nomor telepon maksimal 20 karakter',
            'address.required' => 'Alamat lengkap wajib diisi',
            'address.max' => 'Alamat maksimal 500 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        try {
            // Create new user
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'role' => 'user',
            ]);

            // Auto login after registration
            Auth::login($user);

            Alert::success('Selamat Datang!', 'Akun berhasil dibuat. Selamat bergabung di JustTrip, ' . $user->name . '!');
            return redirect()->intended('/');
            
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat membuat akun. Silakan coba lagi.');
            return back()->withInput($request->except('password', 'password_confirmation'));
        }
    }
}