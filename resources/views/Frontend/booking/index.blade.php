@extends('Frontend.layouts.main')

@section('title', 'Daftar Booking Saya')

@section('container')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Daftar Booking Saya</h1>
                    <p class="text-gray-600 mt-1">Kelola semua booking perjalanan Anda</p>
                </div>
                <a href="{{ route('layanan.index') }}"
                   class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Booking Baru
                </a>
            </div>
        </div>

        <!-- Filter and Search -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <form method="GET" action="{{ route('booking.index') }}" class="flex flex-wrap gap-4">
                <div class="flex-1 min-w-64">
                    <label for="search" class="block text-sm font-medium text-gray-700 mb-1">Cari Booking</label>
                    <input type="text" id="search" name="search"
                           value="{{ request('search') }}"
                           placeholder="Cari berdasarkan ID booking, nama destinasi..."
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-48">
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select id="status" name="status"
                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    </select>
                </div>
                <div class="w-48">
                    <label for="date_from" class="block text-sm font-medium text-gray-700 mb-1">Dari Tanggal</label>
                    <input type="date" id="date_from" name="date_from"
                           value="{{ request('date_from') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="w-48">
                    <label for="date_to" class="block text-sm font-medium text-gray-700 mb-1">Sampai Tanggal</label>
                    <input type="date" id="date_to" name="date_to"
                           value="{{ request('date_to') }}"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                </div>
                <div class="flex items-end">
                    <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Cari
                    </button>
                    @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                        <a href="{{ route('booking.index') }}"
                           class="ml-2 inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                            Reset
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Booking List -->
        @if($bookings->count() > 0)
            <div class="space-y-4">
                @foreach($bookings as $booking)
                    <div class="bg-white rounded-lg shadow-sm border border-gray-200 hover:shadow-md transition-shadow">
                        <div class="p-6">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <div class="flex items-center space-x-3 mb-3">
                                        <h3 class="text-lg font-semibold text-gray-900">
                                            {{ $booking->layanan->nama_layanan }}
                                        </h3>
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                            @elseif($booking->status === 'confirmed') bg-green-100 text-green-800
                                            @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                            @else bg-gray-100 text-gray-800 @endif">
                                            {{ ucfirst($booking->status) }}
                                        </span>
                                        @if($booking->specialOffer)
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                                </svg>
                                                Special Offer
                                            </span>
                                        @endif
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4 text-sm text-gray-600">
                                        <div>
                                            <span class="font-medium text-gray-900">Booking ID:</span><br>
                                            #{{ $booking->booking_id }}
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-900">Tanggal Keberangkatan:</span><br>
                                            {{ $booking->tanggal_keberangkatan->format('d M Y') }}
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-900">Jumlah Peserta:</span><br>
                                            {{ $booking->jumlah_peserta }} orang
                                        </div>
                                        <div>
                                            <span class="font-medium text-gray-900">Total:</span><br>
                                            <span class="text-lg font-semibold text-blue-600">
                                                Rp {{ number_format($booking->total_amount, 0, ',', '.') }}
                                            </span>
                                        </div>
                                    </div>

                                    <div class="mt-4 text-sm text-gray-500">
                                        <span class="font-medium">Lokasi:</span> {{ $booking->layanan->lokasi }} |
                                        <span class="font-medium">Dibuat:</span> {{ $booking->created_at->format('d M Y H:i') }}
                                    </div>
                                </div>

                                @if($booking->layanan->gambar_utama)
                                    <div class="ml-6 flex-shrink-0">
                                        <img src="{{ asset('storage/' . $booking->layanan->gambar_utama) }}"
                                             alt="{{ $booking->layanan->nama_layanan }}"
                                             class="w-24 h-24 object-cover rounded-lg">
                                    </div>
                                @endif
                            </div>

                            <!-- Actions -->
                            <div class="mt-6 flex items-center justify-between border-t pt-4">
                                <div class="flex space-x-3">
                                    <a href="{{ route('booking.show', $booking->booking_id) }}"
                                       class="inline-flex items-center px-3 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                        </svg>
                                        Detail
                                    </a>

                                    @if($booking->status === 'confirmed')
                                        <a href="{{ route('booking.invoice', $booking->booking_id) }}"
                                           class="inline-flex items-center px-3 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
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
                                                    class="inline-flex items-center px-3 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                </svg>
                                                Batalkan
                                            </button>
                                        </form>
                                    @endif
                                </div>

                                <!-- Quick Info -->
                                <div class="text-sm text-gray-500">
                                    @if($booking->status === 'pending')
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                                            </svg>
                                            Menunggu konfirmasi
                                        </span>
                                    @elseif($booking->status === 'confirmed')
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                            </svg>
                                            Booking dikonfirmasi
                                        </span>
                                    @elseif($booking->status === 'cancelled')
                                        <span class="flex items-center">
                                            <svg class="w-4 h-4 mr-1 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                                            </svg>
                                            Booking dibatalkan
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if($bookings->hasPages())
                <div class="mt-8">
                    {{ $bookings->appends(request()->query())->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-lg shadow-sm p-12 text-center">
                <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                </svg>
                <h3 class="mt-4 text-lg font-medium text-gray-900">Belum ada booking</h3>
                <p class="mt-2 text-gray-500">
                    @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                        Tidak ada booking yang sesuai dengan filter pencarian Anda.
                    @else
                        Anda belum memiliki booking perjalanan. Mulai jelajahi destinasi menarik kami!
                    @endif
                </p>
                <div class="mt-6">
                    @if(request()->hasAny(['search', 'status', 'date_from', 'date_to']))
                        <a href="{{ route('booking.index') }}"
                           class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 mr-3">
                            Reset Filter
                        </a>
                    @endif
                    <a href="{{ route('layanan.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Jelajahi Destinasi
                    </a>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection
