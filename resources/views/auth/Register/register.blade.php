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

    <div class="min-h-screen flex flex-col items-center justify-center py-12 px-4">
        <div class="max-w-xl w-full">
            <div class="text-center mb-8">
                <img src="{{ asset('image/logo6.png') }}" alt="JustTrip Logo" class='w-20 mx-auto mb-4' />
                <h1 class="text-3xl font-black text-gray-800 tracking-tight mb-2">Buat Akun Baru</h1>
                <p class="text-gray-600 uppercase text-[10px] font-black tracking-widest">Daftar dan mulai petualanganmu bersama Justtrip</p>
            </div>

            <div class="p-8 rounded-2xl bg-white/95 backdrop-blur-sm shadow-2xl border border-cyan-100/50 relative overflow-hidden">
                <!-- Travel-themed decorative elements -->
                <div class="absolute top-0 right-0 w-20 h-20 bg-gradient-to-br from-cyan-100 to-blue-100 rounded-full -translate-y-10 translate-x-10 opacity-30"></div>
                <div class="absolute bottom-0 left-0 w-16 h-16 bg-gradient-to-tr from-teal-100 to-cyan-100 rounded-full translate-y-8 -translate-x-8 opacity-30"></div>
                
                <form class="space-y-6 relative z-10" action="{{ route('register.post') }}" method="POST">
                    @csrf
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Name -->
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block font-medium flex items-center">
                                <svg class="w-4 h-4 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                                </svg>
                                Nama Lengkap
                            </label>
                            <div class="relative flex items-center">
                                <input name="name" type="text" required value="{{ old('name') }}"
                                       class="w-full text-gray-800 text-sm border border-cyan-200 px-4 py-3 rounded-lg outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all duration-300 bg-gradient-to-r from-white to-cyan-50/30"
                                       placeholder="Nama Lengkap" />
                            </div>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
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
                                       placeholder="contoh@email.com" />
                            </div>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Phone -->
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block font-medium flex items-center">
                                <svg class="w-4 h-4 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                                </svg>
                                No. Telepon
                            </label>
                            <div class="relative flex items-center">
                                <input name="phone" type="tel" value="{{ old('phone') }}"
                                       class="w-full text-gray-800 text-sm border border-cyan-200 px-4 py-3 rounded-lg outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all duration-300 bg-gradient-to-r from-white to-cyan-50/30"
                                       placeholder="0812xxxxxxxx" />
                            </div>
                            @error('phone')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block font-medium flex items-center">
                                <svg class="w-4 h-4 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zM9 6c0-1.66 1.34-3 3-3s3 1.34 3 3v2H9V6z"/>
                                </svg>
                                Password
                            </label>
                            <div class="relative flex items-center leading-none">
                                <input id="password" name="password" type="password" required
                                       class="w-full text-gray-800 text-sm border border-cyan-200 px-4 py-3 rounded-lg outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all duration-300 pr-12 bg-gradient-to-r from-white to-cyan-50/30"
                                       placeholder="••••••••" />
                                <button type="button" onclick="togglePass('password')" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-cyan-500 hover:text-cyan-700 transition-colors">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                </button>
                            </div>
                            @error('password')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label class="text-gray-800 text-sm mb-2 block font-medium flex items-center">
                                <svg class="w-4 h-4 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 1L3 5v6c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V5l-9-4zm0 10.99h7c-.53 4.12-3.28 7.79-7 8.94V12H5V6.3l7-3.11v8.8z"/>
                                </svg>
                                Konfirmasi Password
                            </label>
                            <div class="relative flex items-center">
                                <input id="password_confirmation" name="password_confirmation" type="password" required
                                       class="w-full text-gray-800 text-sm border border-cyan-200 px-4 py-3 rounded-lg outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all duration-300 bg-gradient-to-r from-white to-cyan-50/30"
                                       placeholder="••••••••" />
                            </div>
                        </div>

                        <!-- Address -->
                        <div class="md:col-span-2">
                            <label class="text-gray-800 text-sm mb-2 block font-medium flex items-center">
                                <svg class="w-4 h-4 mr-2 text-cyan-600" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5c-1.38 0-2.5-1.12-2.5-2.5s1.12-2.5 2.5-2.5 2.5 1.12 2.5 2.5-1.12 2.5-2.5 2.5z"/>
                                </svg>
                                Alamat Lengkap
                            </label>
                            <div class="relative flex items-start">
                                <textarea name="address" required rows="2"
                                          class="w-full text-gray-800 text-sm border border-cyan-200 px-4 py-3 rounded-lg outline-none focus:border-cyan-500 focus:ring-2 focus:ring-cyan-200 transition-all duration-300 bg-gradient-to-r from-white to-cyan-50/30"
                                          placeholder="Masukkan alamat lengkap Anda">{{ old('address') }}</textarea>
                            </div>
                            @error('address')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="!mt-8">
                        <button type="submit" class="w-full py-4 px-4 text-sm font-black tracking-widest rounded-xl text-white bg-gradient-to-r from-cyan-600 via-blue-600 to-teal-600 hover:from-cyan-700 hover:via-blue-700 hover:to-teal-700 focus:outline-none transition-all duration-300 transform hover:scale-[1.02] shadow-xl hover:shadow-cyan-200 flex items-center justify-center group uppercase">
                            <svg class="w-5 h-5 mr-3 group-hover:translate-x-1 transition-transform duration-300" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M21 16v-2l-8-5V3.5c0-.83-.67-1.5-1.5-1.5S10 2.67 10 3.5V9l-8 5v2l8-2.5V19l-2 1.5V22l3.5-1 3.5 1v-1.5L13 19v-5.5l8 2.5z"/>
                            </svg>
                            Daftar Sekarang
                        </button>
                    </div>
                </form>

                <p class="text-gray-800 text-sm !mt-8 text-center">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-transparent bg-clip-text bg-gradient-to-r from-cyan-600 to-blue-600 hover:from-cyan-700 hover:to-blue-700 ml-1 whitespace-nowrap font-bold transition-all duration-300 border-b border-blue-200">
                        Masuk Petualangan
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>

<script>
    function togglePass(id) {
        const input = document.getElementById(id);
        if (input.type === 'password') {
            input.type = 'text';
        } else {
            input.type = 'password';
        }
    }
</script>
@endsection
