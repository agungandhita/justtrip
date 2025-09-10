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
        @elseif($booking->status === 'approved')
            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-blue-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-blue-800">Booking Disetujui</h3>
                        <div class="mt-2 text-sm text-blue-700">
                            <p>Booking Anda telah disetujui! Silakan lakukan pembayaran untuk melanjutkan proses booking.</p>
                            @if($booking->admin_notes)
                                <p class="mt-1"><strong>Catatan Admin:</strong> {{ $booking->admin_notes }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @elseif($booking->status === 'rejected')
            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-6">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-red-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                    <div class="ml-3">
                        <h3 class="text-sm font-medium text-red-800">Booking Ditolak</h3>
                        <div class="mt-2 text-sm text-red-700">
                            <p>Maaf, booking Anda tidak dapat diproses.</p>
                            @if($booking->admin_notes)
                                <p class="mt-1"><strong>Alasan:</strong> {{ $booking->admin_notes }}</p>
                            @endif
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
                                @elseif($booking->status === 'approved') bg-blue-100 text-blue-800
                                @elseif($booking->status === 'rejected') bg-red-100 text-red-800
                                @elseif($booking->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status === 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800 @endif">
                                @if($booking->status === 'approved') Disetujui
                                @elseif($booking->status === 'rejected') Ditolak
                                @else {{ ucfirst($booking->status) }}
                                @endif
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

                <!-- Payment Upload Section -->
                @if($booking->status === 'approved')
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                            <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path>
                            </svg>
                            Upload Bukti Pembayaran
                        </h3>

                        @if($booking->admin_notes)
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                <p class="text-green-800">
                                    <strong>Catatan Admin:</strong> {{ $booking->admin_notes }}
                                </p>
                            </div>
                        @endif

                        @if($booking->invoice && $booking->invoice->status === 'payment_uploaded')
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                <p class="text-yellow-800">
                                    <i class="fas fa-clock mr-2"></i>
                                    Bukti pembayaran Anda sedang diverifikasi oleh admin.
                                </p>
                            </div>
                        @elseif($booking->invoice && $booking->invoice->status === 'paid')
                            <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                <p class="text-green-800">
                                    <i class="fas fa-check-circle mr-2"></i>
                                    Pembayaran Anda telah dikonfirmasi. Terima kasih!
                                </p>
                            </div>
                        @else
                            <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                <p class="text-blue-800">
                                    <i class="fas fa-info-circle mr-2"></i>
                                    Silakan upload bukti pembayaran Anda untuk melanjutkan proses booking.
                                </p>
                            </div>

                            <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                                
                                <!-- Payment Method Selection -->
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Metode Pembayaran
                                    </label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <input type="radio" id="bank_transfer" name="payment_method" value="bank_transfer" 
                                                   class="sr-only peer" checked>
                                            <label for="bank_transfer" 
                                                   class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                                <i class="fas fa-university text-blue-600 mr-3"></i>
                                                <span class="font-medium">Transfer Bank</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input type="radio" id="e_wallet" name="payment_method" value="e_wallet" 
                                                   class="sr-only peer">
                                            <label for="e_wallet" 
                                                   class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                                <i class="fas fa-mobile-alt text-green-600 mr-3"></i>
                                                <span class="font-medium">E-Wallet</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input type="radio" id="cash" name="payment_method" value="cash" 
                                                   class="sr-only peer">
                                            <label for="cash" 
                                                   class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                                <i class="fas fa-money-bill-wave text-green-600 mr-3"></i>
                                                <span class="font-medium">Tunai</span>
                                            </label>
                                        </div>
                                        <div>
                                            <input type="radio" id="other" name="payment_method" value="other" 
                                                   class="sr-only peer">
                                            <label for="other" 
                                                   class="flex items-center p-4 border-2 border-gray-200 rounded-lg cursor-pointer hover:bg-gray-50 peer-checked:border-blue-500 peer-checked:bg-blue-50">
                                                <i class="fas fa-ellipsis-h text-gray-600 mr-3"></i>
                                                <span class="font-medium">Lainnya</span>
                                            </label>
                                        </div>
                                    </div>
                                    @error('payment_method')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Bank Transfer Details -->
                                <div id="bank_details" class="payment-details space-y-4">
                                    <h4 class="font-medium text-gray-900">Detail Transfer Bank</h4>
                                    
                                    <!-- Bank Account Information -->
                                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-4">
                                        <h5 class="font-semibold text-blue-900 mb-3">Rekening Tujuan Transfer:</h5>
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-blue-800 font-medium">Bank BCA</span>
                                                <span class="text-blue-900 font-bold">1234567890</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-blue-800 font-medium">Bank Mandiri</span>
                                                <span class="text-blue-900 font-bold">0987654321</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-blue-800 font-medium">Bank BNI</span>
                                                <span class="text-blue-900 font-bold">1122334455</span>
                                            </div>
                                            <div class="text-center mt-3 pt-2 border-t border-blue-300">
                                                <span class="text-blue-900 font-semibold">a.n. JustTrip Travel</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="bank_name" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nama Bank
                                            </label>
                                            <input type="text" id="bank_name" name="bank_name" 
                                                   placeholder="Contoh: BCA, Mandiri, BNI"
                                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('bank_name') border-red-500 @enderror"
                                                   value="{{ old('bank_name') }}">
                                            @error('bank_name')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="account_number" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nomor Rekening Pengirim
                                            </label>
                                            <input type="text" id="account_number" name="account_number" 
                                                   placeholder="Nomor rekening Anda"
                                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('account_number') border-red-500 @enderror"
                                                   value="{{ old('account_number') }}">
                                            @error('account_number')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                    <div>
                                        <label for="account_holder_name" class="block text-sm font-medium text-gray-700 mb-2">
                                            Nama Pemilik Rekening
                                        </label>
                                        <input type="text" id="account_holder_name" name="account_holder_name" 
                                               placeholder="Nama sesuai rekening bank"
                                               class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('account_holder_name') border-red-500 @enderror"
                                               value="{{ old('account_holder_name') }}">
                                        @error('account_holder_name')
                                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>

                                <!-- E-Wallet Details -->
                                <div id="ewallet_details" class="payment-details space-y-4 hidden">
                                    <h4 class="font-medium text-gray-900">Detail E-Wallet</h4>
                                    
                                    <!-- E-Wallet Account Information -->
                                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                                        <h5 class="font-semibold text-green-900 mb-3">E-Wallet Tujuan Transfer:</h5>
                                        <div class="space-y-2">
                                            <div class="flex justify-between items-center">
                                                <span class="text-green-800 font-medium">OVO</span>
                                                <span class="text-green-900 font-bold">081234567890</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-green-800 font-medium">GoPay</span>
                                                <span class="text-green-900 font-bold">081234567890</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-green-800 font-medium">DANA</span>
                                                <span class="text-green-900 font-bold">081234567890</span>
                                            </div>
                                            <div class="flex justify-between items-center">
                                                <span class="text-green-800 font-medium">ShopeePay</span>
                                                <span class="text-green-900 font-bold">081234567890</span>
                                            </div>
                                            <div class="text-center mt-3 pt-2 border-t border-green-300">
                                                <span class="text-green-900 font-semibold">a.n. JustTrip Travel</span>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <div>
                                            <label for="e_wallet_type" class="block text-sm font-medium text-gray-700 mb-2">
                                                Jenis E-Wallet
                                            </label>
                                            <select id="e_wallet_type" name="e_wallet_type" 
                                                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('e_wallet_type') border-red-500 @enderror">
                                                <option value="">Pilih E-Wallet</option>
                                                <option value="OVO" {{ old('e_wallet_type') == 'OVO' ? 'selected' : '' }}>OVO</option>
                                                <option value="GoPay" {{ old('e_wallet_type') == 'GoPay' ? 'selected' : '' }}>GoPay</option>
                                                <option value="DANA" {{ old('e_wallet_type') == 'DANA' ? 'selected' : '' }}>DANA</option>
                                                <option value="ShopeePay" {{ old('e_wallet_type') == 'ShopeePay' ? 'selected' : '' }}>ShopeePay</option>
                                                <option value="LinkAja" {{ old('e_wallet_type') == 'LinkAja' ? 'selected' : '' }}>LinkAja</option>
                                            </select>
                                            @error('e_wallet_type')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                        <div>
                                            <label for="e_wallet_number" class="block text-sm font-medium text-gray-700 mb-2">
                                                Nomor E-Wallet
                                            </label>
                                            <input type="text" id="e_wallet_number" name="e_wallet_number" 
                                                   placeholder="Nomor HP/ID E-Wallet"
                                                   class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('e_wallet_number') border-red-500 @enderror"
                                                   value="{{ old('e_wallet_number') }}">
                                            @error('e_wallet_number')
                                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <!-- Payment Amount -->
                                <div>
                                    <label for="payment_amount" class="block text-sm font-medium text-gray-700 mb-2">
                                        Jumlah Pembayaran
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-500">Rp</span>
                                        <input type="number" id="payment_amount" name="payment_amount" 
                                               placeholder="{{ number_format($booking->total_amount, 0, ',', '.') }}"
                                               value="{{ old('payment_amount', $booking->total_amount) }}"
                                               min="0" step="0.01" required
                                               class="block w-full pl-10 rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('payment_amount') border-red-500 @enderror">
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Total yang harus dibayar: Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>
                                    @error('payment_amount')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Payment Date -->
                                <div>
                                    <label for="payment_date" class="block text-sm font-medium text-gray-700 mb-2">
                                        Tanggal Pembayaran
                                    </label>
                                    <input type="datetime-local" id="payment_date" name="payment_date" 
                                           value="{{ old('payment_date', now()->format('Y-m-d\TH:i')) }}"
                                           max="{{ now()->format('Y-m-d\TH:i') }}" required
                                           class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('payment_date') border-red-500 @enderror">
                                    @error('payment_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Payment Proof Upload -->
                                <div>
                                    <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-2">
                                        Upload Bukti Pembayaran *
                                    </label>
                                    <input type="file" 
                                           id="payment_proof" 
                                           name="payment_proof" 
                                           accept="image/*,.pdf" 
                                           required
                                           class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 @error('payment_proof') border-red-500 @enderror">
                                    <p class="mt-1 text-sm text-gray-500">Format yang didukung: JPG, PNG, PDF (Maksimal 2MB)</p>
                                    @error('payment_proof')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <!-- Payment Notes -->
                                <div>
                                    <label for="payment_notes" class="block text-sm font-medium text-gray-700 mb-2">
                                        Catatan Pembayaran (Opsional)
                                    </label>
                                    <textarea id="payment_notes" 
                                              name="payment_notes" 
                                              rows="3" 
                                              placeholder="Tambahkan catatan tentang pembayaran Anda..."
                                              class="block w-full rounded-md border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500 @error('payment_notes') border-red-500 @enderror">{{ old('payment_notes') }}</textarea>
                                    @error('payment_notes')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-medium">
                                    <i class="fas fa-upload mr-2"></i>Upload Bukti Pembayaran
                                </button>
                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
                                    const bankDetails = document.getElementById('bank_details');
                                    const ewalletDetails = document.getElementById('ewallet_details');
                                    
                                    function togglePaymentDetails() {
                                        const selectedMethod = document.querySelector('input[name="payment_method"]:checked').value;
                                        
                                        // Hide all details
                                        bankDetails.classList.add('hidden');
                                        ewalletDetails.classList.add('hidden');
                                        
                                        // Show relevant details
                                        if (selectedMethod === 'bank_transfer') {
                                            bankDetails.classList.remove('hidden');
                                        } else if (selectedMethod === 'e_wallet') {
                                            ewalletDetails.classList.remove('hidden');
                                        }
                                    }
                                    
                                    paymentMethods.forEach(method => {
                                        method.addEventListener('change', togglePaymentDetails);
                                    });
                                    
                                    // Initialize on page load
                                    togglePaymentDetails();
                                });
                            </script>
                        @endif
                    </div>
                @endif

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

                    <!-- Invoice Actions -->
                    @if($booking->invoice)
                        <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-lg">
                            <h5 class="font-medium text-blue-900 mb-3 flex items-center">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Invoice Actions
                            </h5>
                            <div class="space-y-3">
                                <!-- Download Invoice Button -->
                                <a href="{{ route('invoice.download', $booking->invoice->invoice_id) }}" 
                                   class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                    Download Invoice PDF
                                </a>
                                
                                <!-- View Invoice Button -->
                                <a href="{{ route('invoice.view', $booking->invoice->invoice_id) }}" 
                                   target="_blank"
                                   class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-600 hover:bg-gray-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                    Lihat Invoice
                                </a>
                                
                                <!-- Send to WhatsApp Admin Button -->
                                <button onclick="sendInvoiceToWhatsApp({{ $booking->invoice->invoice_id }})" 
                                        class="w-full inline-flex items-center justify-center px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-colors duration-200">
                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.097"/>
                                    </svg>
                                    Kirim ke WhatsApp Admin
                                </button>
                            </div>
                        </div>
                    @endif

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

@push('scripts')
<script>
    // Function to send invoice to WhatsApp admin
    function sendInvoiceToWhatsApp(invoiceId) {
        if (confirm('Apakah Anda yakin ingin mengirim invoice ini ke WhatsApp admin?')) {
            // Show loading state
            const button = event.target;
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<svg class="w-4 h-4 mr-2 animate-spin" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="m4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Mengirim...';
            
            // Send AJAX request
            fetch(`/invoice/${invoiceId}/send-whatsapp`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Invoice berhasil dikirim ke WhatsApp admin.',
                        confirmButtonColor: '#3085d6'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Terjadi kesalahan saat mengirim invoice.',
                        confirmButtonColor: '#d33'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan sistem. Silakan coba lagi.',
                    confirmButtonColor: '#d33'
                });
            })
            .finally(() => {
                // Restore button state
                button.disabled = false;
                button.innerHTML = originalText;
            });
        }
    }

    // Payment method toggle functionality
    document.addEventListener('DOMContentLoaded', function() {
        const paymentMethods = document.querySelectorAll('input[name="payment_method"]');
        const paymentDetails = document.querySelectorAll('.payment-details');
        
        paymentMethods.forEach(method => {
            method.addEventListener('change', function() {
                // Hide all payment details
                paymentDetails.forEach(detail => {
                    detail.classList.add('hidden');
                });
                
                // Show selected payment method details
                if (this.value === 'bank_transfer') {
                    document.getElementById('bank_details').classList.remove('hidden');
                } else if (this.value === 'e_wallet') {
                    document.getElementById('ewallet_details').classList.remove('hidden');
                }
            });
        });
    });
</script>
@endpush
