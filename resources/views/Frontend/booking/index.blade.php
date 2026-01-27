@extends('Frontend.layouts.main')

@section('title', 'Daftar Booking Saya')

@section('container')
<div class="min-h-screen bg-gray-50/50">
    <!-- Premium Header & Stats -->
    <div class="bg-blue-600 pt-12 pb-24">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="md:flex md:items-center md:justify-between mb-8">
                <div class="flex-1 min-w-0">
                    <h2 class="text-3xl font-bold leading-7 text-white sm:text-4xl sm:truncate">
                        Daftar Booking Saya
                    </h2>
                    <p class="mt-2 text-blue-100 flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Kelola perjalanan seru Anda bersama JustTrip
                    </p>
                </div>
                <div class="mt-4 flex md:mt-0 md:ml-4">
                    <a href="{{ route('layanan.index') }}"
                       class="inline-flex items-center px-6 py-3 border border-transparent rounded-xl shadow-lg text-sm font-bold text-blue-600 bg-white hover:bg-blue-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-white transition-all transform hover:scale-105">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Jelajahi Paket Wisata
                    </a>
                </div>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
                    <p class="text-blue-100 text-sm font-medium">Total Booking</p>
                    <p class="text-white text-2xl font-bold mt-1">{{ $bookings->total() }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
                    <p class="text-blue-100 text-sm font-medium">Aktif</p>
                    <p class="text-white text-2xl font-bold mt-1">{{ count($bookings->whereIn('status', ['pending', 'approved', 'awaiting_payment', 'payment_uploaded', 'confirmed'])) }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
                    <p class="text-blue-100 text-sm font-medium">Selesai</p>
                    <p class="text-white text-2xl font-bold mt-1">{{ count($bookings->where('status', 'completed')) }}</p>
                </div>
                <div class="bg-white/10 backdrop-blur-md rounded-2xl p-4 border border-white/20">
                    <p class="text-blue-100 text-sm font-medium">Dibatalkan</p>
                    <p class="text-white text-2xl font-bold mt-1">{{ count($bookings->where('status', 'cancelled')) }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-12">
        <!-- Filter Bar -->
        <div class="bg-white rounded-2xl shadow-xl p-4 md:p-6 mb-8 border border-gray-100">
            <form method="GET" action="{{ route('booking.index') }}" class="grid grid-cols-1 md:grid-cols-4 lg:grid-cols-5 gap-4">
                <div class="lg:col-span-2">
                    <div class="relative">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center text-gray-400">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}"
                               placeholder="Cari ID Booking atau Destinasi..."
                               class="block w-full pl-10 pr-3 py-2.5 border border-gray-200 rounded-xl leading-5 bg-gray-50 placeholder-gray-400 focus:outline-none focus:bg-white focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm transition-all">
                    </div>
                </div>
                <div>
                    <select name="status" class="block w-full py-2.5 pl-3 pr-10 border border-gray-200 bg-gray-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm transition-all">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="approved" {{ request('status') === 'approved' ? 'selected' : '' }}>Disetujui</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                        <option value="completed" {{ request('status') === 'completed' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                <div>
                    <input type="date" name="date_from" value="{{ request('date_from') }}"
                           class="block w-full py-2.5 px-3 border border-gray-200 bg-gray-50 rounded-xl focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent sm:text-sm transition-all">
                </div>
                <div class="flex space-x-2">
                    <button type="submit" class="flex-1 bg-blue-600 text-white font-bold py-2.5 px-4 rounded-xl hover:bg-blue-700 transition-all shadow-md hover:shadow-lg focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Filter
                    </button>
                    @if(request()->hasAny(['search', 'status', 'date_from']))
                        <a href="{{ route('booking.index') }}" class="p-2.5 bg-gray-100 text-gray-500 rounded-xl hover:bg-gray-200 transition-all">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path>
                            </svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Booking Cards -->
        @if($bookings->count() > 0)
            <div class="space-y-6">
                @foreach($bookings as $booking)
                    <div class="group bg-white rounded-3xl shadow-sm hover:shadow-2xl transition-all duration-300 border border-gray-100 overflow-hidden">
                        <div class="p-1 md:p-2">
                            <div class="flex flex-col md:flex-row gap-6">
                                <!-- Trip Image -->
                                <div class="relative w-full md:w-64 h-48 md:h-auto overflow-hidden rounded-2xl">
                                    <img src="{{ asset($booking->layanan->gambar_utama ? 'storage/' . $booking->layanan->gambar_utama : 'img/placeholder-trip.jpg') }}"
                                         alt="{{ $booking->layanan->nama_layanan }}"
                                         class="w-full h-full object-cover transform group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute top-4 left-4">
                                        <span class="px-3 py-1.5 rounded-full text-[10px] font-black uppercase tracking-wider shadow-sm bg-white/90 backdrop-blur-sm
                                            @if($booking->status_color === 'warning') text-yellow-700
                                            @elseif($booking->status_color === 'success') text-green-700
                                            @elseif($booking->status_color === 'danger') text-red-700
                                            @elseif($booking->status_color === 'blue') text-blue-700
                                            @else text-gray-700 @endif border border-white">
                                            {{ $booking->status_label }}
                                        </span>
                                    </div>
                                    @if($booking->specialOffer)
                                        <div class="absolute bottom-4 right-4">
                                            <span class="flex items-center px-3 py-1 bg-yellow-400 text-yellow-900 rounded-lg text-xs font-black italic shadow-lg">
                                                <svg class="w-3 h-3 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M5 5a3 3 0 015-2.24A3 3 0 0115 5v2a2 2 0 012 2v4a2 2 0 01-2 2H5a2 2 0 01-2-2V9a2 2 0 012-2V5zm8 7V7a3 3 0 00-6 0v5h6z" clip-rule="evenodd"></path>
                                                </svg>
                                                Special Deal
                                            </span>
                                        </div>
                                    @endif
                                </div>

                                <!-- Trip Content -->
                                <div class="flex-1 p-4 md:py-6 md:pr-8">
                                    <div class="flex flex-col h-full justify-between">
                                        <div>
                                            <div class="flex justify-between items-start mb-2">
                                                <div>
                                                    <p class="text-xs font-bold text-blue-600 uppercase tracking-widest mb-1">{{ $booking->layanan->lokasi }}</p>
                                                    <h3 class="text-xl font-black text-gray-900 leading-tight group-hover:text-blue-600 transition-colors">
                                                        {{ $booking->layanan->nama_layanan }}
                                                    </h3>
                                                </div>
                                                <div class="text-right">
                                                    <p class="text-[10px] font-medium text-gray-400 uppercase tracking-widest">Total Bayar</p>
                                                    <p class="text-xl font-black text-blue-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>
                                                </div>
                                            </div>

                                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-6">
                                                <div class="flex items-center space-x-3 bg-gray-50 p-3 rounded-2xl">
                                                    <div class="p-2 bg-white rounded-xl shadow-sm">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-tighter">Booking ID</p>
                                                        <p class="text-xs font-black text-gray-700">#{{ $booking->booking_id }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-3 bg-gray-50 p-3 rounded-2xl">
                                                    <div class="p-2 bg-white rounded-xl shadow-sm">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-tighter">Keberangkatan</p>
                                                        <p class="text-xs font-black text-gray-700">{{ $booking->tanggal_keberangkatan->format('d M Y') }}</p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-3 bg-gray-50 p-3 rounded-2xl">
                                                    <div class="p-2 bg-white rounded-xl shadow-sm">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-tighter">Peserta</p>
                                                        <p class="text-xs font-black text-gray-700">{{ $booking->jumlah_peserta }} Orang</p>
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-3 bg-gray-50 p-3 rounded-2xl">
                                                    <div class="p-2 bg-white rounded-xl shadow-sm">
                                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                                        </svg>
                                                    </div>
                                                    <div>
                                                        <p class="text-[10px] uppercase font-bold text-gray-400 tracking-tighter">Pembayaran</p>
                                                        <p class="text-xs font-black text-gray-700">{{ $booking->payment_status_label }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Payment Validation Pending Badge -->
                                        @if($booking->paymentConfirmations()->where('status', 'pending')->exists())
                                            <div class="mt-4 flex items-center gap-2 p-3 bg-amber-50 border border-amber-200 rounded-2xl">
                                                <div class="flex-shrink-0">
                                                    <svg class="w-5 h-5 text-amber-500 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                    </svg>
                                                </div>
                                                <p class="text-xs font-bold text-amber-700">
                                                    <span class="uppercase tracking-wider">Sedang Validasi Pembayaran</span>
                                                    <span class="font-normal text-amber-600">- Silahkan menunggu konfirmasi dari admin</span>
                                                </p>
                                            </div>
                                        @endif

                                        <!-- Actions -->
                                        <div class="flex items-center justify-between mt-8 pt-6 border-t border-gray-100">
                                            <div class="flex flex-wrap gap-2">
                                                <a href="{{ route('booking.show', $booking->booking_id) }}"
                                                   class="inline-flex items-center px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest bg-blue-600 text-white hover:bg-blue-700 shadow-md hover:shadow-xl transition-all">
                                                    Lihat Detail
                                                </a>
                                                
                                                @if($booking->status === 'approved' || $booking->status === 'awaiting_payment')
                                                    <a href="{{ route('booking.show', $booking->booking_id) }}#payment"
                                                       class="inline-flex items-center px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest bg-yellow-400 text-yellow-900 hover:bg-yellow-500 shadow-md hover:shadow-xl transition-all">
                                                        Upload Pembayaran
                                                    </a>
                                                @endif

                                                @if(in_array($booking->status, ['confirmed', 'completed']))
                                                    <a href="{{ route('booking.invoice', $booking->booking_id) }}"
                                                       class="inline-flex items-center px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest border border-gray-200 text-gray-600 hover:bg-gray-50 transition-all">
                                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                        </svg>
                                                        Invoice
                                                    </a>
                                                @endif

                                                @if($booking->status === 'pending')
                                                    <form action="{{ route('booking.cancel', $booking->booking_id) }}" method="POST"
                                                          onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')"
                                                          class="inline">
                                                        @csrf
                                                        @method('PATCH')
                                                        <button type="submit"
                                                                class="inline-flex items-center px-5 py-2.5 rounded-xl text-xs font-black uppercase tracking-widest text-red-600 hover:bg-red-50 transition-all border border-red-100">
                                                            Batalkan
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>
                                            
                                            <div class="hidden lg:block">
                                                <p class="text-[10px] font-medium text-gray-400 text-right uppercase tracking-widest">Dipesan pada</p>
                                                <p class="text-xs font-bold text-gray-600 text-right">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
                <div class="mt-12 mb-8">
                    <div class="bg-white px-4 py-3 rounded-2xl border border-gray-100 shadow-sm">
                        {{ $bookings->appends(request()->query())->links() }}
                    </div>
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-[40px] shadow-2xl p-12 md:p-20 text-center border border-gray-100 mb-20 overflow-hidden relative">
                <div class="absolute top-0 left-0 w-full h-2 bg-gradient-to-r from-blue-400 via-indigo-500 to-purple-600"></div>
                <div class="relative z-10">
                    <div class="w-32 h-32 bg-blue-50 rounded-full flex items-center justify-center mx-auto mb-8 shadow-inner">
                        <svg class="h-16 w-16 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                        </svg>
                    </div>
                    <h3 class="text-3xl font-black text-gray-900 mb-4">
                        {{ request()->hasAny(['search', 'status', 'date_from']) ? 'Pencarian Tidak Ditemukan' : 'Belum Ada Petualangan' }}
                    </h3>
                    <p class="text-gray-500 text-lg max-w-lg mx-auto mb-10 leading-relaxed font-medium">
                        {{ request()->hasAny(['search', 'status', 'date_from']) 
                            ? 'Kami tidak menemukan booking yang sesuai dengan kriteria yang Anda cari. Coba ubah filter atau kata kunci Anda.' 
                            : 'Halaman ini menyimpan kenangan perjalanan Anda. Mulailah membuat kenangan baru dengan menjelajahi pilihan paket wisata terbaik kami.' }}
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                        @if(request()->hasAny(['search', 'status', 'date_from']))
                            <a href="{{ route('booking.index') }}"
                               class="w-full sm:w-auto px-8 py-4 bg-gray-100 text-gray-700 font-bold rounded-2xl hover:bg-gray-200 transition-all transition-transform active:scale-95">
                                Atur Ulang Filter
                            </a>
                        @endif
                        <a href="{{ route('layanan.index') }}"
                           class="w-full sm:w-auto px-8 py-4 bg-blue-600 text-white font-black rounded-2xl hover:bg-blue-700 transition-all shadow-xl hover:shadow-blue-200 transition-transform active:scale-95">
                            Cari Paket Wisata
                        </a>
                    </div>
                </div>

                <!-- Abstract decorations -->
                <div class="absolute -bottom-10 -right-10 w-40 h-40 bg-blue-50 rounded-full blur-3xl opacity-50"></div>
                <div class="absolute -top-10 -left-10 w-40 h-40 bg-indigo-50 rounded-full blur-3xl opacity-50"></div>
            </div>
        @endif
    </div>
</div>

<!-- Success Booking Modal -->
@if(session('show_booking_success_modal'))
<div id="bookingSuccessModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeBookingModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 transform transition-all animate-modal-in">
        <!-- Success Icon -->
        <div class="w-20 h-20 bg-gradient-to-br from-green-400 to-emerald-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-green-200">
            <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
            </svg>
        </div>
        
        <!-- Title -->
        <h2 class="text-2xl font-black text-gray-900 text-center mb-3">
            Booking Berhasil Terdata!
        </h2>
        
        <!-- Booking Number Badge -->
        <div class="flex justify-center mb-4">
            <span class="inline-flex items-center px-4 py-2 bg-blue-50 text-blue-700 rounded-xl text-sm font-bold">
                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 20l4-16m2 16l4-16M6 9h14M4 15h14"></path>
                </svg>
                {{ session('new_booking_number') }}
            </span>
        </div>
        
        <!-- Message -->
        <p class="text-gray-600 text-center mb-8 leading-relaxed">
            Booking Anda telah berhasil dicatat. <strong class="text-gray-800">Silahkan menunggu konfirmasi dari admin.</strong> Kami akan segera menghubungi Anda.
        </p>
        
        <!-- Action Button -->
        <button type="button" onclick="closeBookingModal()" 
                class="w-full py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg shadow-blue-200 transform hover:scale-[1.02] active:scale-[0.98]">
            Mengerti, Tutup
        </button>
        
        <!-- Decorative Elements -->
        <div class="absolute -top-4 -right-4 w-24 h-24 bg-blue-50 rounded-full blur-2xl opacity-60 -z-10"></div>
        <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-green-50 rounded-full blur-2xl opacity-60 -z-10"></div>
    </div>
</div>

<style>
@keyframes modal-in {
    from {
        opacity: 0;
        transform: scale(0.9) translateY(20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}
.animate-modal-in {
    animation: modal-in 0.3s ease-out forwards;
}
</style>

<script>
function closeBookingModal() {
    const modal = document.getElementById('bookingSuccessModal');
    if (modal) {
        modal.classList.add('opacity-0');
        modal.style.transition = 'opacity 0.2s ease-out';
        setTimeout(() => {
            modal.remove();
        }, 200);
    }
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeBookingModal();
    }
});
</script>
@endif

<!-- Payment Validation Pending Modal -->
@if(session('payment_validation_pending'))
<div id="paymentValidationModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closePaymentValidationModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white rounded-3xl shadow-2xl max-w-md w-full p-8 transform transition-all animate-modal-in">
        <!-- Pending Icon -->
        <div class="w-20 h-20 bg-gradient-to-br from-amber-400 to-orange-500 rounded-full flex items-center justify-center mx-auto mb-6 shadow-lg shadow-amber-200">
            <svg class="w-10 h-10 text-white animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        
        <!-- Title -->
        <h2 class="text-2xl font-black text-gray-900 text-center mb-3">
            Bukti Pembayaran Terkirim!
        </h2>
        
        <!-- Message -->
        <p class="text-gray-600 text-center mb-6 leading-relaxed">
            Bukti pembayaran Anda telah berhasil dikirim. <strong class="text-gray-800">Pembayaran sedang dalam proses validasi oleh admin.</strong>
        </p>
        
        <!-- Info Box -->
        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 mb-6">
            <div class="flex items-start gap-3">
                <svg class="w-5 h-5 text-amber-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <p class="text-sm text-amber-800">
                    Silahkan menunggu konfirmasi dari admin. Kami akan segera memproses pembayaran Anda dalam waktu <strong>1x24 jam</strong>.
                </p>
            </div>
        </div>
        
        <!-- Action Button -->
        <button type="button" onclick="closePaymentValidationModal()" 
                class="w-full py-4 bg-gradient-to-r from-amber-500 to-orange-500 text-white font-bold rounded-2xl hover:from-amber-600 hover:to-orange-600 transition-all shadow-lg shadow-amber-200 transform hover:scale-[1.02] active:scale-[0.98]">
            Mengerti, Tutup
        </button>
        
        <!-- Decorative Elements -->
        <div class="absolute -top-4 -right-4 w-24 h-24 bg-amber-50 rounded-full blur-2xl opacity-60 -z-10"></div>
        <div class="absolute -bottom-4 -left-4 w-32 h-32 bg-orange-50 rounded-full blur-2xl opacity-60 -z-10"></div>
    </div>
</div>

<style>
@keyframes modal-in {
    from {
        opacity: 0;
        transform: scale(0.9) translateY(20px);
    }
    to {
        opacity: 1;
        transform: scale(1) translateY(0);
    }
}
.animate-modal-in {
    animation: modal-in 0.3s ease-out forwards;
}
</style>

<script>
function closePaymentValidationModal() {
    const modal = document.getElementById('paymentValidationModal');
    if (modal) {
        modal.classList.add('opacity-0');
        modal.style.transition = 'opacity 0.2s ease-out';
        setTimeout(() => {
            modal.remove();
        }, 200);
    }
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closePaymentValidationModal();
    }
});
</script>
@endif
@endsection
