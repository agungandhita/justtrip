<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use RealRashid\SweetAlert\Facades\Alert;

class LoginController extends Controller
{
    /**
     * Show the login form
     */
    public function showLoginForm()
    {
        return view('auth.Login.login');
    }

    /**
     * Handle login request
     */
    public function login(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
            'password.min' => 'Password minimal 6 karakter'
        ]);

        $credentials = $request->only('email', 'password');

        // Attempt to login
        if (Auth::attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            
            $user = Auth::user();
            
            // Redirect based on role
            if ($user->role === 'admin') {
                Alert::success('Berhasil!', 'Selamat datang Admin ' . $user->name);
                return redirect()->intended('/admin/dashboard');
            } else {
                Alert::success('Berhasil!', 'Selamat datang ' . $user->name);
                return redirect()->intended('/');
            }
        }

        // Login failed
        Alert::error('Gagal!', 'Email atau password salah');
        return back()->withInput($request->only('email'));
    }

    /**
     * Handle logout request
     */
    public function logout(Request $request)
    {
        Auth::logout();
        
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        Alert::success('Berhasil!', 'Anda telah logout');
        return redirect('/login');
    }
}