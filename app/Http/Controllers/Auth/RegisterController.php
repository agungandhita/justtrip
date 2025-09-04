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
        // Validasi input
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:500',
            'password' => 'required|string|min:6|confirmed',
        ], [
            'nama.required' => 'Nama wajib diisi',
            'nama.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'email.unique' => 'Email sudah terdaftar',
            'phone.max' => 'Nomor telepon maksimal 20 karakter',
            'address.max' => 'Alamat maksimal 500 karakter',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter',
            'password.confirmed' => 'Konfirmasi password tidak cocok',
        ]);

        try {
            // Create new user
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'phone' => $request->phone,
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'role' => 'user', // Default role is user
            ]);

            // Auto login after registration
            Auth::login($user);

            Alert::success('Berhasil!', 'Akun berhasil dibuat. Selamat datang ' . $user->name);
            return redirect()->intended('/');
            
        } catch (\Exception $e) {
            Alert::error('Gagal!', 'Terjadi kesalahan saat membuat akun');
            return back()->withInput($request->except('password', 'password_confirmation'));
        }
    }
}