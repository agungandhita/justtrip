@extends('auth.layouts.main')

@section('container')
<div class="bg-gradient-to-br from-blue-50 via-purple-50 to-violet-50 font-[sans-serif] min-h-screen">
    <div class="min-h-screen flex flex-col items-center justify-center py-6">
        <div class="max-w-md w-full">
            <div class="text-center mb-8">
                <img src="{{ asset('image/logo6.png') }}" alt="JustTrip Logo" class='w-20 mx-auto mb-4' />
                <h1 class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 via-purple-600 to-violet-600 text-3xl font-bold">
                    JustTrip
                </h1>
                <p class="text-gray-600 mt-2">Daftar akun baru</p>
            </div>

            <div class="p-8 rounded-2xl bg-white/90 backdrop-blur-sm shadow-xl border border-white/20">
                @if(session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                        {{ session('success') }}
                    </div>
                @endif

                @if(session('error'))
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                        {{ session('error') }}
                    </div>
                @endif

                <form class="space-y-4" action="{{ route('register.post') }}" method="POST">
                    @csrf
                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Nama Lengkap</label>
                        <div class="relative flex items-center">
                            <input name="nama" type="text" required value="{{ old('nama') }}"
                                   class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                                   placeholder="Masukkan Nama Lengkap" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 24 24">
                                <circle cx="10" cy="7" r="6" data-original="#000000"></circle>
                                <path d="M14 15H6a5 5 0 0 0-5 5 3 3 0 0 0 3 3h12a3 3 0 0 0 3-3 5 5 0 0 0-5-5zm8-4h-2.59l.3-.29a1 1 0 0 0-1.42-1.42l-2 2a1 1 0 0 0 0 1.42l2 2a1 1 0 0 0 1.42 0 1 1 0 0 0 0-1.42l-.3-.29H22a1 1 0 0 0 0-2z" data-original="#000000"></path>
                            </svg>
                        </div>
                        @error('nama')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Email</label>
                        <div class="relative flex items-center">
                            <input name="email" type="email" required value="{{ old('email') }}"
                                   class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                                   placeholder="Masukkan Email" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 24 24">
                                <path d="M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z"/>
                            </svg>
                        </div>
                        @error('email')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Nomor Telepon (Opsional)</label>
                        <div class="relative flex items-center">
                            <input name="phone" type="tel" value="{{ old('phone') }}"
                                   class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300"
                                   placeholder="Masukkan Nomor Telepon" />
                            <svg xmlns="http://www.w3.org/2000/svg" fill="#bbb" stroke="#bbb" class="w-4 h-4 absolute right-4" viewBox="0 0 24 24">
                                <path d="M6.62 10.79c1.44 2.83 3.76 5.14 6.59 6.59l2.2-2.2c.27-.27.67-.36 1.02-.24 1.12.37 2.33.57 3.57.57.55 0 1 .45 1 1V20c0 .55-.45 1-1 1-9.39 0-17-7.61-17-17 0-.55.45-1 1-1h3.5c.55 0 1 .45 1 1 0 1.25.2 2.45.57 3.57.11.35.03.74-.25 1.02l-2.2 2.2z"/>
                            </svg>
                        </div>
                        @error('phone')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Alamat (Opsional)</label>
                        <div class="relative flex items-center">
                            <textarea name="address" rows="3"
                                      class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 resize-none"
                                      placeholder="Masukkan Alamat Lengkap">{{ old('address') }}</textarea>
                        </div>
                        @error('address')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Password</label>
                        <div class="relative flex items-center">
                            <input id="password" name="password" type="password" required
                                   class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 pr-10"
                                   placeholder="Masukkan Password (min. 6 karakter)" />
                            <button type="button" id="togglePassword" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
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
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="text-gray-800 text-sm mb-2 block">Konfirmasi Password</label>
                        <div class="relative flex items-center">
                            <input id="password_confirmation" name="password_confirmation" type="password" required
                                   class="w-full text-gray-800 text-sm border border-gray-300 px-4 py-3 rounded-md outline-blue-500 focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all duration-300 pr-10"
                                   placeholder="Konfirmasi Password" />
                            <button type="button" id="togglePasswordConfirmation" class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500 hover:text-gray-700">
                                <svg id="eyeOpenConfirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.036 12.322a1.012 1.012 0 010-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <svg id="eyeClosedConfirm" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 hidden">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3.98 8.223A10.477 10.477 0 001.934 12C3.226 16.338 7.244 19.5 12 19.5c.993 0 1.953-.138 2.863-.395M6.228 6.228A10.45 10.45 0 0112 4.5c4.756 0 8.773 3.162 10.065 7.498a10.523 10.523 0 01-4.293 5.774M6.228 6.228L3 3m3.228 3.228l3.65 3.65m7.894 7.894L21 21m-3.228-3.228l-3.65-3.65m0 0a3 3 0 11-4.243-4.243m4.242 4.242L9.88 9.88" />
                                </svg>
                            </button>
                        </div>
                        @error('password_confirmation')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="!mt-8">
                        <button type="submit" class="w-full py-3 px-4 text-sm tracking-wide rounded-lg text-white bg-gradient-to-r from-blue-600 via-purple-600 to-violet-600 hover:from-blue-700 hover:via-purple-700 hover:to-violet-700 focus:outline-none transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                            Daftar Akun
                        </button>
                    </div>
                </form>

                <p class="text-gray-800 text-sm !mt-8 text-center">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-purple-600 hover:from-blue-700 hover:to-purple-700 ml-1 whitespace-nowrap font-semibold transition-all duration-300">
                        Masuk disini
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Toggle password visibility
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

        // Toggle password confirmation visibility
        const togglePasswordConfirmation = document.getElementById('togglePasswordConfirmation');
        const passwordConfirmationInput = document.getElementById('password_confirmation');
        const eyeOpenConfirm = document.getElementById('eyeOpenConfirm');
        const eyeClosedConfirm = document.getElementById('eyeClosedConfirm');

        togglePasswordConfirmation.addEventListener('click', function() {
            const type = passwordConfirmationInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordConfirmationInput.setAttribute('type', type);
            
            eyeOpenConfirm.classList.toggle('hidden');
            eyeClosedConfirm.classList.toggle('hidden');
        });
    });
</script>
