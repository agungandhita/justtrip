@extends('layouts.app')

@section('title', 'Riwayat Booking - JustTrip')

@section('content')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Riwayat Booking</h1>
            <p class="text-gray-600 mt-2">Kelola dan lihat semua booking perjalanan Anda</p>
        </div>

        <!-- Booking List -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
            <div class="p-6">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-xl font-semibold text-gray-900">Daftar Booking</h2>
                    <div class="flex items-center space-x-4">
                        <select class="border border-gray-300 rounded-lg px-3 py-2 text-sm">
                            <option value="all">Semua Status</option>
                            <option value="pending">Pending</option>
                            <option value="confirmed">Dikonfirmasi</option>
                            <option value="completed">Selesai</option>
                            <option value="cancelled">Dibatalkan</option>
                        </select>
                    </div>
                </div>

                <!-- Empty State -->
                <div class="text-center py-12">
                    <div class="w-24 h-24 mx-auto mb-4 bg-gray-100 rounded-full flex items-center justify-center">
                        <i class="fas fa-calendar-times text-gray-400 text-2xl"></i>
                    </div>
                    <h3 class="text-lg font-medium text-gray-900 mb-2">Belum Ada Booking</h3>
                    <p class="text-gray-500 mb-6">Anda belum memiliki riwayat booking. Mulai jelajahi paket tour kami!</p>
                    <a href="{{ route('paket-tour') }}" class="inline-flex items-center px-6 py-3 bg-teal-600 text-white font-medium rounded-lg hover:bg-teal-700 transition-colors duration-200">
                        <i class="fas fa-search mr-2"></i>
                        Jelajahi Paket Tour
                    </a>
                </div>

                <!-- Booking Items (when data exists) -->
                <!-- This section will be populated with actual booking data -->
            </div>
        </div>
    </div>
</div>
@endsection