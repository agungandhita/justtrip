@extends('admin.layouts.main')

@section('container')
    <div class="min-h-screen bg-gray-50 pt-20 pb-12">
        <!-- Dashboard Header -->
        <div class="mb-10 px-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-8">
                <div class="flex items-center gap-4 mb-3">
                    <div class="bg-gradient-to-br from-indigo-500 to-purple-600 p-3 rounded-xl shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M13 21V11H21V21H13ZM3 13V3H11V13H3ZM3 21V15H11V21H3ZM13 9V3H21V9H13ZM5 5V11H9V5H5ZM15 5V7H19V5H15ZM15 13V19H19V13H15ZM5 17V19H9V17H5Z" />
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900 mb-1">Dashboard Admin JustTrip</h1>
                        <p class="text-gray-600 text-lg">Sistem Informasi Manajemen Travel Online</p>
                    </div>
                </div>
                <div class="mt-6 flex items-center gap-4 text-sm text-gray-500">
                    <div class="flex items-center gap-2">
                        <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                        <span>Sistem Online</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        <span>Terakhir diperbarui: {{ now()->format('d M Y, H:i') }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10 px-6">
            <!-- Total Users -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-blue-200 transition-all duration-300 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-blue-50 p-3 rounded-xl group-hover:bg-blue-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 14V16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z"/>
                        </svg>
                    </div>
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded-full">0</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Pengguna</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">0</h3>
                    <div class="text-sm text-gray-500 space-y-1">
                        <div><span class="text-gray-600">0 terverifikasi</span></div>
                    </div>
                </div>
            </div>

            <!-- Total Destinasi -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-green-200 transition-all duration-300 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-green-50 p-3 rounded-xl group-hover:bg-green-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5M12,2A7,7 0 0,1 19,9C19,14.25 12,22 12,22C12,22 5,14.25 5,9A7,7 0 0,1 12,2Z"/>
                        </svg>
                    </div>
                    <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">0 aktif</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Destinasi</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">0</h3>
                    <div class="text-sm text-gray-500 space-y-1">
                        <div><span class="text-green-600">0 aktif</span> • <span class="text-red-600">0 nonaktif</span></div>
                    </div>
                </div>
            </div>

            <!-- Total Booking -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-amber-200 transition-all duration-300 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-amber-50 p-3 rounded-xl group-hover:bg-amber-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-amber-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7,4V2A1,1 0 0,1 8,1H16A1,1 0 0,1 17,2V4H20A1,1 0 0,1 21,5V19A1,1 0 0,1 20,20H4A1,1 0 0,1 3,19V5A1,1 0 0,1 4,4H7M9,3V4H15V3H9M5,6V18H19V6H5Z"/>
                        </svg>
                    </div>
                    <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded-full">0 pending</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Booking</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">0</h3>
                    <div class="text-sm text-gray-500 space-y-1">
                        <div>
                            <span class="text-amber-600">0 pending</span> •
                            <span class="text-blue-600">0 konfirmasi</span> •
                            <span class="text-purple-600">0 diproses</span>
                        </div>
                        <div>
                            <span class="text-green-600">0 selesai</span> •
                            <span class="text-red-600">0 dibatalkan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Pendapatan -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-purple-200 transition-all duration-300 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-purple-50 p-3 rounded-xl group-hover:bg-purple-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-purple-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7,15H9C9,16.08 10.37,17 12,17C13.63,17 15,16.08 15,15C15,13.9 13.96,13.5 11.76,12.97C9.64,12.44 7,11.78 7,9C7,7.21 8.47,5.69 10.5,5.18V3H13.5V5.18C15.53,5.69 17,7.21 17,9H15C15,7.92 13.63,7 12,7C10.37,7 9,7.92 9,9C9,10.1 10.04,10.5 12.24,11.03C14.36,11.56 17,12.22 17,15C17,16.79 15.53,18.31 13.5,18.82V21H10.5V18.82C8.47,18.31 7,16.79 7,15Z"/>
                        </svg>
                    </div>
                    @if(($perubahanPendapatan ?? 0) > 0)
                        <span class="bg-green-100 text-green-800 text-xs font-medium px-2.5 py-1 rounded-full">+{{ $perubahanPendapatan }}%</span>
                    @elseif(($perubahanPendapatan ?? 0) < 0)
                        <span class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-1 rounded-full">{{ $perubahanPendapatan }}%</span>
                    @else
                        <span class="bg-gray-100 text-gray-800 text-xs font-medium px-2.5 py-1 rounded-full">0%</span>
                    @endif
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Pendapatan Bulan Ini</p>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">Rp {{ number_format($pendapatanBulanIni ?? 0, 0, ',', '.') }}</h3>
                    <div class="text-sm text-gray-500 space-y-1">
                        @if(($perubahanPendapatan ?? 0) > 0)
                            <div><span class="text-green-600">↗ Naik {{ $perubahanPendapatan }}% dari bulan lalu</span></div>
                        @elseif(($perubahanPendapatan ?? 0) < 0)
                            <div><span class="text-red-600">↘ Turun {{ abs($perubahanPendapatan) }}% dari bulan lalu</span></div>
                        @endif
                        <div><span class="text-blue-600">Rp {{ number_format($pendapatanHariIni ?? 0, 0, ',', '.') }} hari ini</span></div>
                        <div><span class="text-purple-600">Rp {{ number_format($totalPendapatanKeseluruhan ?? 0, 0, ',', '.') }} total</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Additional Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10 px-6">
            <!-- Total Layanan -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-indigo-200 transition-all duration-300 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-indigo-50 p-3 rounded-xl group-hover:bg-indigo-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,2A2,2 0 0,1 14,4C14,4.74 13.6,5.39 13,5.73V7H14A7,7 0 0,1 21,14H22A1,1 0 0,1 23,15V18A1,1 0 0,1 22,19H21V20A2,2 0 0,1 19,22H5A2,2 0 0,1 3,20V19H2A1,1 0 0,1 1,18V15A1,1 0 0,1 2,14H3A7,7 0 0,1 10,7H11V5.73C10.4,5.39 10,4.74 10,4A2,2 0 0,1 12,2M7.5,13A2.5,2.5 0 0,0 5,15.5A2.5,2.5 0 0,0 7.5,18A2.5,2.5 0 0,0 10,15.5A2.5,2.5 0 0,0 7.5,13M16.5,13A2.5,2.5 0 0,0 14,15.5A2.5,2.5 0 0,0 16.5,18A2.5,2.5 0 0,0 19,15.5A2.5,2.5 0 0,0 16.5,13Z"/>
                        </svg>
                    </div>
                    <span class="bg-indigo-100 text-indigo-800 text-xs font-medium px-2.5 py-1 rounded-full">{{ $layananAktif ?? 0 }} aktif</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Layanan</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($totalLayanan ?? 0) }}</h3>
                    <div class="text-sm text-gray-500 space-y-1">
                        <div><span class="text-indigo-600">{{ $layananAktif ?? 0 }} aktif</span> • <span class="text-red-600">{{ $layananNonaktif ?? 0 }} nonaktif</span></div>
                        <div><span class="text-blue-600">{{ $totalLayananUkuran ?? 0 }} variasi ukuran</span></div>
                    </div>
                </div>
            </div>

            <!-- Total Ukuran -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-teal-200 transition-all duration-300 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-teal-50 p-3 rounded-xl group-hover:bg-teal-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-teal-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M21,16.5C21,16.88 20.79,17.21 20.47,17.38L12.57,21.82C12.41,21.94 12.21,22 12,22C11.79,22 11.59,21.94 11.43,21.82L3.53,17.38C3.21,17.21 3,16.88 3,16.5V7.5C3,7.12 3.21,6.79 3.53,6.62L11.43,2.18C11.59,2.06 11.79,2 12,2C12.21,2 12.41,2.06 12.57,2.18L20.47,6.62C20.79,6.79 21,7.12 21,7.5V16.5M12,4.15L6.04,7.5L12,10.85L17.96,7.5L12,4.15Z"/>
                        </svg>
                    </div>
                    <span class="bg-teal-100 text-teal-800 text-xs font-medium px-2.5 py-1 rounded-full">{{ $ukuranAktif ?? 0 }} aktif</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Total Ukuran</p>
                    <h3 class="text-3xl font-bold text-gray-900 mb-2">{{ number_format($totalUkuran ?? 0) }}</h3>
                    <div class="text-sm text-gray-500 space-y-1">
                        <div><span class="text-teal-600">{{ $ukuranAktif ?? 0 }} aktif</span> • <span class="text-red-600">{{ $ukuranNonaktif ?? 0 }} nonaktif</span></div>
                        @if(isset($ukuranPerKategori) && count($ukuranPerKategori) > 0)
                            <div>
                                @foreach($ukuranPerKategori as $kategori => $jumlah)
                                    <span class="text-gray-600">{{ $kategori }}: {{ $jumlah }}</span>
                                    @if(!$loop->last) • @endif
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Performance Metrics -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 hover:shadow-lg hover:border-pink-200 transition-all duration-300 group">
                <div class="flex items-start justify-between mb-4">
                    <div class="bg-pink-50 p-3 rounded-xl group-hover:bg-pink-100 transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-pink-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M16,6L18.29,8.29L13.41,13.17L9.41,9.17L2,16.59L3.41,18L9.41,12L13.41,16L19.71,9.71L22,12V6H16Z"/>
                        </svg>
                    </div>
                    <span class="bg-pink-100 text-pink-800 text-xs font-medium px-2.5 py-1 rounded-full">Metrik</span>
                </div>
                <div>
                    <p class="text-sm font-medium text-gray-600 mb-1">Performa Bisnis</p>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">{{ number_format($averageOrdersPerDay ?? 0, 1) }}/hari</h3>
                    <div class="text-sm text-gray-500 space-y-1">
                        <div><span class="text-pink-600">Rp {{ number_format($averageRevenuePerOrder ?? 0, 0, ',', '.') }} rata-rata per pesanan</span></div>
                        <div><span class="text-green-600">{{ number_format($conversionRate ?? 0, 1) }}% tingkat konversi</span></div>
                        <div><span class="text-red-600">{{ number_format($cancellationRate ?? 0, 1) }}% tingkat pembatalan</span></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="px-6">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="bg-indigo-50 p-2 rounded-xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                            </svg>
                        </div>
                        <h2 class="text-xl font-bold text-gray-900">Aksi Cepat</h2>
                    </div>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="#" class="flex items-center gap-3 p-4 bg-blue-50 rounded-xl hover:bg-blue-100 transition-all duration-200 border border-blue-200">
                        <div class="bg-blue-100 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12 14V16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Tambah User</p>
                            <p class="text-sm text-gray-600">Kelola pengguna baru</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-3 p-4 bg-green-50 rounded-xl hover:bg-green-100 transition-all duration-200 border border-green-200">
                        <div class="bg-green-100 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5M12,2A7,7 0 0,1 19,9C19,14.25 12,22 12,22C12,22 5,14.25 5,9A7,7 0 0,1 12,2Z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Tambah Destinasi</p>
                            <p class="text-sm text-gray-600">Kelola destinasi wisata</p>
                        </div>
                    </a>
                    <a href="#" class="flex items-center gap-3 p-4 bg-purple-50 rounded-xl hover:bg-purple-100 transition-all duration-200 border border-purple-200">
                        <div class="bg-purple-100 p-2 rounded-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7,4V2A1,1 0 0,1 8,1H16A1,1 0 0,1 17,2V4H20A1,1 0 0,1 21,5V19A1,1 0 0,1 20,20H4A1,1 0 0,1 3,19V5A1,1 0 0,1 4,4H7M9,3V4H15V3H9M5,6V18H19V6H5Z"/>
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-900">Lihat Booking</p>
                            <p class="text-sm text-gray-600">Kelola pemesanan</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>



        <!-- Quick Actions Section -->
        <div class="mt-10 px-6">
            <div class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 rounded-2xl shadow-lg p-8 text-white">
                <div class="flex flex-col md:flex-row items-center justify-between">
                    <div class="mb-6 md:mb-0">
                        <h3 class="text-2xl font-bold mb-2">Aksi Cepat</h3>
                        <p class="text-indigo-100 text-lg">Kelola bisnis Anda dengan mudah</p>
                    </div>
                    <div class="flex flex-wrap gap-4">
                        <a href="#" class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center gap-2 border border-white/20">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd"></path>
                            </svg>
                            Tambah Produk
                        </a>
                        <a href="" class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center gap-2 border border-white/20">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Kelola Pesanan
                        </a>
                        <a href="" class="bg-white/20 backdrop-blur-sm hover:bg-white/30 text-white px-6 py-3 rounded-xl font-semibold transition-all duration-200 flex items-center gap-2 border border-white/20">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                            </svg>
                            Kelola User
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer Info -->
        <div class="mt-8 px-6 pb-8">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <div class="flex flex-col md:flex-row items-center justify-between text-sm text-gray-500">
                    <div class="flex items-center gap-4 mb-4 md:mb-0">
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Sistem berjalan normal</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                            </svg>
                            <span>Server aktif</span>
                        </div>
                    </div>
                    <div class="text-center md:text-right">
                        <p>© {{ date('Y') }} E-Jahit Dashboard</p>
                        <p class="text-xs mt-1">Versi 1.0.0 - Build {{ date('Ymd') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        /* Custom scrollbar */
        .overflow-y-auto::-webkit-scrollbar {
            width: 6px;
        }
        .overflow-y-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
            border-radius: 3px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }
        .overflow-y-auto::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }

        /* Smooth animations */
        .group:hover .group-hover\:bg-blue-100 {
            transition: background-color 0.2s ease;
        }

        /* Gradient animation */
        @keyframes gradient {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        .bg-gradient-to-r {
            background-size: 200% 200%;
            animation: gradient 6s ease infinite;
        }
    </style>
@endsection

    @push('scripts')
        <script>
            document.getElementById('statisticPeriod').addEventListener('change', function() {
                // You can implement AJAX call here to update statistics based on selected period
                const period = this.value;

                // Example AJAX call
                /*
                fetch(`/admin/dashboard/statistics?period=${period}`, {
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Update the statistics section with new data
                    console.log(data);
                });
                */
            });
        </script>
    @endpush
