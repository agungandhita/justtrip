@extends('auth.layouts.main')

@section('container')
<div class="bg-gradient-to-br from-cyan-50 via-blue-50 to-teal-50 font-[sans-serif] min-h-screen relative overflow-hidden">
    <!-- Travel-themed background elements -->
    <div class="absolute inset-0 opacity-5">
        <svg class="absolute top-10 left-10 w-32 h-32 text-cyan-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
        </svg>
        <svg class="absolute top-32 right-20 w-24 h-24 text-blue-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
        </svg>
        <svg class="absolute bottom-20 left-20 w-28 h-28 text-teal-400" fill="currentColor" viewBox="0 0 24 24">
            <path d="M14 6V4h-4v2h4zM4 8v11h16V8H4zm16-2c1.11 0 2 .89 2 2v11c0 1.11-.89 2-2 2H4c-1.11 0-2-.89-2-2V8c0-1.11.89-2 2-2h16z"/>
        </svg>
    </div>
    
    <!-- Back to Home Button -->
    <div class="absolute top-6 left-6 z-10">
        <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 bg-white/80 backdrop-blur-sm text-cyan-700 rounded-full hover:bg-white/90 transition-all duration-300 shadow-lg hover:shadow-xl group">
            <svg class="w-5 h-5 mr-2 group-hover:-translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
            </svg>
            <span class="font-medium">Kembali ke Home</span>
        </a>
    </div>

    <div class="min-h-screen flex flex-col items-center justify-center py-6">
        <div class="max-w-md w-full">
            <div class="text-center mb-8">
                <img src="{{ asset('image/logo6.png') }}" alt="JustTrip Logo" class='w-20 mx-auto mb-4' />
                <h1 class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 via-blue-600 to-teal-600 text-3xl font-bold">
                    JustTrip
                </h1>
                <p class="text-gray-600 mt-2">Selamat Datang Kembali, Traveler!</p>
                <p class="text-gray-500 text-sm mt-1">Masuk dan lanjutkan petualangan Anda</p>
            </div>

            <div class="p-8 rounded-2xl bg-white/95 backdrop-blur-sm shadow-2xl border border-cyan-100/50 relative overflow-hidden">
                <!-- Travel-themed decorative elements -->
                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-cyan-100 to-blue-100 rounded-full -translate-y-10 translate-x-10 opacity-30"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-teal-100 to-cyan-100 rounded-full translate-y-8 -translate-x-8 opacity-30"></div>
                
                @if(session('success'))
                    <div class="bg-gradient-to-r from-emerald-50 to-teal-50 border border-emerald-200 text-emerald-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                        </svg>
                        {{ session('error') }}
                    </div>
                @endif

                <form class="space-y-6 relative z-10" action="{{ route('login.post') }}" method="POST">
                    @csrf
                    <div>
                        <label class="text-gray-800 text-sm mb-2 block font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                            Email
                        </label>
                        <div class="relative flex items-center">
                            <input name="email" type="email" required value="{{ old('email') }}"
                                   class="w-full text-gray-800 text-sm border border-cyan-200 px-4 py-3 rounded-lg outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all duration-300 bg-gradient-to-r from-white to-cyan-50/30"
                                   placeholder="Masukkan email Anda" />
                            <svg class="w-5 h-5 absolute right-4 text-cyan-400" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                            </svg>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-800 text-sm mb-2 block font-medium flex items-center">
                            <svg class="w-4 h-4 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6z"/>
                            </svg>
                            Password
                        </label>
                        <div class="relative flex items-center">
                            <input id="password" name="password" type="password" required
                                   class="w-full text-gray-800 text-sm border border-cyan-200 px-4 py-3 rounded-lg outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all duration-300 pr-12 bg-gradient-to-r from-white to-cyan-50/30"
                                   placeholder="Masukkan password Anda" />
                            <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-cyan-500 hover:text-cyan-700 transition-colors duration-300">
                                <svg id="eyeOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg id="eyeClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 11-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="text-red-500 text-xs mt-1 flex items-center">
                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <div class="!mt-8">
                        <button type="submit" class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-gradient-to-r from-cyan-600 via-blue-600 to-teal-600 hover:from-cyan-700 hover:via-blue-700 hover:to-teal-700 focus:outline-none transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl flex items-center justify-center group">
                            <svg class="w-5 h-5 mr-2 group-hover:translate-x-1 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                            </svg>
                            Mulai Perjalanan
                        </button>
                    </div>
                </form>

                <p class="text-gray-800 text-sm !mt-8 text-center">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 ml-1 whitespace-nowrap font-semibold transition-all duration-300">
                        Bergabung sekarang
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        const eyeOpen = document.getElementById('eyeOpen');
        const eyeClosed = document.getElementById('eyeClosed');

        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            
            eyeOpen.classList.toggle('hidden');
            eyeClosed.classList.toggle('hidden');
        });
    });
</script>
