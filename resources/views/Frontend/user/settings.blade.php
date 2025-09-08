@extends('Frontend.layouts.main')

@section('title', 'Pengaturan - JustTrip')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Pengaturan Akun</h1>
            <p class="text-gray-600 mt-2">Kelola preferensi dan pengaturan akun Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Sidebar Navigation -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                    <nav class="space-y-2">
                        <a href="#profile" class="flex items-center px-3 py-2 text-teal-600 bg-teal-50 rounded-lg font-medium">
                            <i class="fas fa-user mr-3"></i>
                            Profil
                        </a>
                        <a href="#security" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg font-medium transition-colors duration-200">
                            <i class="fas fa-shield-alt mr-3"></i>
                            Keamanan
                        </a>
                        <a href="#notifications" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg font-medium transition-colors duration-200">
                            <i class="fas fa-bell mr-3"></i>
                            Notifikasi
                        </a>
                        <a href="#privacy" class="flex items-center px-3 py-2 text-gray-700 hover:bg-gray-50 rounded-lg font-medium transition-colors duration-200">
                            <i class="fas fa-lock mr-3"></i>
                            Privasi
                        </a>
                    </nav>
                </div>
            </div>

            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Profile Settings -->
                <div id="profile" class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Informasi Profil</h2>
                        <p class="text-gray-600 mt-1">Update informasi profil dan alamat email Anda</p>
                    </div>
                    <div class="p-6">
                        <form class="space-y-6">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Depan</label>
                                    <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent" value="{{ Auth::user()->name ?? '' }}">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Nama Belakang</label>
                                    <input type="text" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                                </div>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                                <input type="email" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent" value="{{ Auth::user()->email ?? '' }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon</label>
                                <input type="tel" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-2 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-colors duration-200">
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Security Settings -->
                <div id="security" class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Keamanan</h2>
                        <p class="text-gray-600 mt-1">Kelola password dan pengaturan keamanan akun</p>
                    </div>
                    <div class="p-6">
                        <form class="space-y-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Saat Ini</label>
                                <input type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Password Baru</label>
                                <input type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Konfirmasi Password Baru</label>
                                <input type="password" class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:ring-2 focus:ring-teal-500 focus:border-transparent">
                            </div>
                            <div class="flex justify-end">
                                <button type="submit" class="px-6 py-2 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-colors duration-200">
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Notification Settings -->
                <div id="notifications" class="bg-white rounded-lg shadow-sm border border-gray-200">
                    <div class="p-6 border-b border-gray-200">
                        <h2 class="text-xl font-semibold text-gray-900">Notifikasi</h2>
                        <p class="text-gray-600 mt-1">Atur preferensi notifikasi Anda</p>
                    </div>
                    <div class="p-6">
                        <div class="space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">Email Booking</h3>
                                    <p class="text-sm text-gray-500">Terima notifikasi email untuk booking baru</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer" checked>
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600"></div>
                                </label>
                            </div>
                            <div class="flex items-center justify-between">
                                <div>
                                    <h3 class="text-sm font-medium text-gray-900">Promosi & Penawaran</h3>
                                    <p class="text-sm text-gray-500">Terima email tentang promosi dan penawaran khusus</p>
                                </div>
                                <label class="relative inline-flex items-center cursor-pointer">
                                    <input type="checkbox" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-teal-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-teal-600"></div>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
