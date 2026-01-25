@extends('auth.layouts.main')

@section('container')
<div class="min-h-screen bg-gradient-to-br from-slate-900 via-blue-900 to-indigo-900 flex items-center justify-center p-4 relative overflow-hidden">
    
    <!-- Animated Background -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="absolute top-0 left-0 w-full h-full opacity-20">
            <div class="absolute top-[10%] left-[5%] w-72 h-72 bg-cyan-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
            <div class="absolute top-[40%] right-[10%] w-80 h-80 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
            <div class="absolute bottom-[10%] left-[20%] w-72 h-72 bg-pink-500 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-4000"></div>
        </div>
        <!-- Subtle Grid Pattern -->
        <div class="absolute inset-0" style="background-image: radial-gradient(rgba(255, 255, 255, 0.03) 1px, transparent 1px); background-size: 40px 40px;"></div>
    </div>

    <!-- Back to Home -->
    <a href="{{ route('home') }}" class="absolute top-6 left-6 z-20 flex items-center gap-2 text-white/70 hover:text-white transition-colors group text-sm font-medium">
        <div class="w-10 h-10 rounded-full bg-white/10 backdrop-blur-md flex items-center justify-center group-hover:bg-white/20 transition-colors">
            <i class="fas fa-arrow-left"></i>
        </div>
        <span class="hidden sm:inline">Kembali</span>
    </a>

    <!-- Main Card -->
    <div class="w-full max-w-md relative z-10">
        <!-- Header -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}">
                <img src="{{ asset('image/logo6.png') }}" alt="JustTrip" class="w-16 h-16 mx-auto mb-4 drop-shadow-2xl">
            </a>
            <h1 class="text-3xl font-black text-white tracking-tight mb-2">Buat Akun Baru</h1>
            <p class="text-blue-200/80 text-sm">Daftar dan mulai petualanganmu bersama JustTrip</p>
        </div>

        <!-- Form Card -->
        <div class="bg-white/10 backdrop-blur-xl rounded-3xl p-8 border border-white/20 shadow-2xl">
            
            @if ($errors->any())
                <div class="bg-red-500/20 border border-red-500/30 text-red-100 rounded-2xl p-4 mb-6 text-sm">
                    <div class="flex items-center gap-2 font-bold mb-2">
                        <i class="fas fa-exclamation-triangle"></i>
                        <span>Terjadi Kesalahan</span>
                    </div>
                    <ul class="list-disc list-inside space-y-1 text-red-200/90">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" class="space-y-5">
                @csrf
                
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-semibold text-white/90 mb-2">
                        <i class="fas fa-user mr-2 text-cyan-400"></i>Nama Lengkap
                    </label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required autocomplete="name"
                           class="w-full px-5 py-3.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/30 transition-all"
                           placeholder="Masukkan nama lengkap">
                    @error('name')
                        <p class="mt-2 text-red-300 text-xs flex items-center gap-1"><i class="fas fa-times-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-semibold text-white/90 mb-2">
                        <i class="fas fa-envelope mr-2 text-cyan-400"></i>Alamat Email
                    </label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="email"
                           class="w-full px-5 py-3.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/30 transition-all"
                           placeholder="contoh@email.com">
                    @error('email')
                        <p class="mt-2 text-red-300 text-xs flex items-center gap-1"><i class="fas fa-times-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Phone (Optional) -->
                <div>
                    <label for="phone" class="block text-sm font-semibold text-white/90 mb-2">
                        <i class="fas fa-phone mr-2 text-cyan-400"></i>No. Telepon <span class="text-white/40 font-normal">(opsional)</span>
                    </label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" autocomplete="tel"
                           class="w-full px-5 py-3.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/30 transition-all"
                           placeholder="081xxxxxxxxx">
                    @error('phone')
                        <p class="mt-2 text-red-300 text-xs flex items-center gap-1"><i class="fas fa-times-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-semibold text-white/90 mb-2">
                        <i class="fas fa-lock mr-2 text-cyan-400"></i>Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required autocomplete="new-password"
                               class="w-full px-5 py-3.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/30 transition-all pr-12"
                               placeholder="Minimal 6 karakter">
                        <button type="button" onclick="togglePassword('password', 'eye-password')" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/50 hover:text-white transition-colors">
                            <i id="eye-password" class="fas fa-eye"></i>
                        </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-red-300 text-xs flex items-center gap-1"><i class="fas fa-times-circle"></i> {{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-semibold text-white/90 mb-2">
                        <i class="fas fa-shield-alt mr-2 text-cyan-400"></i>Konfirmasi Password
                    </label>
                    <div class="relative">
                        <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                               class="w-full px-5 py-3.5 rounded-xl bg-white/10 border border-white/20 text-white placeholder-white/40 focus:outline-none focus:border-cyan-400 focus:ring-2 focus:ring-cyan-400/30 transition-all pr-12"
                               placeholder="Ulangi password">
                        <button type="button" onclick="togglePassword('password_confirmation', 'eye-confirm')" class="absolute right-4 top-1/2 -translate-y-1/2 text-white/50 hover:text-white transition-colors">
                            <i id="eye-confirm" class="fas fa-eye"></i>
                        </button>
                    </div>
                </div>

                <!-- Submit -->
                <button type="submit" class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-bold text-sm tracking-wide shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/50 transition-all active:scale-[0.98] flex items-center justify-center gap-2 mt-8">
                    <i class="fas fa-user-plus"></i>
                    DAFTAR SEKARANG
                </button>
            </form>

            <!-- Divider -->
            <div class="flex items-center gap-4 my-6">
                <div class="flex-1 h-px bg-white/20"></div>
                <span class="text-white/40 text-xs font-medium">atau</span>
                <div class="flex-1 h-px bg-white/20"></div>
            </div>

            <!-- Login Link -->
            <p class="text-center text-white/70 text-sm">
                Sudah punya akun?
                <a href="{{ route('login') }}" class="text-cyan-400 hover:text-cyan-300 font-bold ml-1 transition-colors">
                    Masuk Sekarang
                </a>
            </p>
        </div>

        <!-- Footer -->
        <p class="text-center text-white/30 text-xs mt-8">
            &copy; {{ date('Y') }} JustTrip. All rights reserved.
        </p>
    </div>
</div>

<style>
    @keyframes blob {
        0% { transform: translate(0px, 0px) scale(1); }
        33% { transform: translate(30px, -50px) scale(1.1); }
        66% { transform: translate(-20px, 20px) scale(0.9); }
        100% { transform: translate(0px, 0px) scale(1); }
    }
    .animate-blob { animation: blob 7s infinite; }
    .animation-delay-2000 { animation-delay: 2s; }
    .animation-delay-4000 { animation-delay: 4s; }
</style>

<script>
    function togglePassword(inputId, iconId) {
        const input = document.getElementById(inputId);
        const icon = document.getElementById(iconId);
        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.remove('fa-eye');
            icon.classList.add('fa-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.remove('fa-eye-slash');
            icon.classList.add('fa-eye');
        }
    }
</script>
@endsection
