@extends('Frontend.layouts.main')

@section('title', 'Detail Booking #' . $booking->booking_id)

@section('container')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Detail Booking</h1>
                    <p class="text-gray-600 mt-1">Booking ID: #{{ $booking->booking_id }}</p>
                </div>
                <div class="flex space-x-3">
                    @if($booking->status === 'confirmed')
                        <a href="{{ route('booking.invoice', $booking->booking_id) }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            Download Invoice
                        </a>
                    @endif
                    <a href="{{ route('booking.index') }}"
                       class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Kembali ke Daftar Booking
                    </a>
                </div>
            </div>
        </div>

        <!-- Status Alert -->
        @if($booking->status === 'pending')
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-yellow-800">Booking Menunggu Konfirmasi</h3>
                        <div class="mt-2 text-sm text-yellow-700">
                            <p>Booking Anda sedang dalam proses verifikasi. Tim kami akan menghubungi Anda dalam 1x24 jam untuk konfirmasi.</p>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($booking->status === 'confirmed')
            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-green-800">Booking Dikonfirmasi</h3>
                        <div class="mt-2 text-sm text-green-700">
                            <p>Selamat! Booking Anda telah dikonfirmasi. Invoice telah dikirim ke email Anda.</p>
                        </div>
                    </div>
                </div>
            </div>
        @elseif($booking->status === 'cancelled')
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Booking Dibatalkan</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p>Booking ini telah dibatalkan. Jika ada pertanyaan, silakan hubungi customer service kami.</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Booking Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Customer Information -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Informasi Pemesan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Nama Lengkap</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->customer_info['name'] }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Email</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->customer_info['email'] }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Nomor Telepon</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->customer_info['phone'] }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-500">Alamat</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->customer_info['address'] }}</p>
                        </div>
                    </div>
                </div>

                <!-- Trip Details -->
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        Detail Perjalanan
                    </h3>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Jumlah Peserta</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->jumlah_peserta }} orang</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Keberangkatan</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->tanggal_keberangkatan->format('d F Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Tanggal Booking</label>
                            <p class="mt-1 text-sm text-gray-900">{{ $booking->created_at->format('d F Y H:i') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-500">Status</label>
                            <span class="mt-1 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                @if($booking->status === 'pending') bg-yellow-100 text-yellow-800
                                @elseif($booking->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>
                        @if($booking->catatan_khusus)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-500">Catatan Khusus</label>
                                <p class="mt-1 text-sm text-gray-900">{{ $booking->catatan_khusus }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Actions -->
                @if($booking->status === 'pending')
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Aksi</h3>
                        <div class="flex space-x-3">
                            <form action="{{ route('booking.cancel', $booking->booking_id) }}" method="POST"
                                  onsubmit="return confirm('Apakah Anda yakin ingin membatalkan booking ini?')">
                                @csrf
                                @method('PATCH')
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 border border-red-300 rounded-md shadow-sm text-sm font-medium text-red-700 bg-white hover:bg-red-50">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                    Batalkan Booking
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Booking Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Booking</h3>

                    <!-- Destination Info -->
                    <div class="mb-6">
                        @if($booking->layanan->gambar_utama)
                            <img src="{{ asset('storage/' . $booking->layanan->gambar_utama) }}"
                                 alt="{{ $booking->layanan->nama_layanan }}"
                                 class="w-full h-32 object-cover rounded-lg mb-3">
                        @endif
                        <h4 class="font-semibold text-gray-900">{{ $booking->layanan->nama_layanan }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ $booking->layanan->lokasi }}</p>
                        @if($booking->layanan->durasi)
                            <p class="text-sm text-gray-600">Durasi: {{ $booking->layanan->durasi }}</p>
                        @endif
                    </div>

                    <!-- Special Offer -->
                    @if($booking->specialOffer)
                        <div class="mb-6 p-3 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                </svg>
                                <span class="text-sm font-medium text-green-800">Special Offer</span>
                            </div>
                            <p class="text-sm text-green-700 mt-1">{{ $booking->specialOffer->title }}</p>
                            <p class="text-sm font-semibold text-green-800">Diskon {{ $booking->specialOffer->discount_percentage }}%</p>
                        </div>
                    @endif

                    <!-- Price Breakdown -->
                    <div class="border-t pt-4">
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>Harga per orang:</span>
                                <span>Rp {{ number_format($booking->layanan->harga_mulai, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Jumlah peserta:</span>
                                <span>{{ $booking->jumlah_peserta }} orang</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Subtotal:</span>
                                <span>Rp {{ number_format($booking->layanan->harga_mulai * $booking->jumlah_peserta, 0, ',', '.') }}</span>
                            </div>
                            @if($booking->specialOffer)
                                @php
                                    $subtotal = $booking->layanan->harga_mulai * $booking->jumlah_peserta;
                                    $discount = $subtotal * ($booking->specialOffer->discount_percentage / 100);
                                @endphp
                                <div class="flex justify-between text-sm text-green-600">
                                    <span>Diskon ({{ $booking->specialOffer->discount_percentage }}%):</span>
                                    <span>- Rp {{ number_format($discount, 0, ',', '.') }}</span>
                                </div>
                            @endif
                            @php
                                $finalSubtotal = $booking->layanan->harga_mulai * $booking->jumlah_peserta;
                                if($booking->specialOffer) {
                                    $finalSubtotal -= $finalSubtotal * ($booking->specialOffer->discount_percentage / 100);
                                }
                                $tax = $finalSubtotal * 0.11;
                            @endphp
                            <div class="flex justify-between text-sm">
                                <span>Pajak (PPN 11%):</span>
                                <span>Rp {{ number_format($tax, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t pt-2 flex justify-between font-semibold text-lg">
                                <span>Total:</span>
                                <span class="text-blue-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="mt-6 p-4 bg-gray-50 rounded-lg">
                        <h5 class="font-medium text-gray-900 mb-2">Butuh Bantuan?</h5>
                        <p class="text-sm text-gray-600 mb-2">Hubungi customer service kami:</p>
                        <div class="space-y-1 text-sm">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                <span class="text-gray-600">+62 21 1234 5678</span>
                            </div>
                            <div class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                </svg>
                                <span class="text-gray-600">info@justtrip.com</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
