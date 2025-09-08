@extends('Frontend.layouts.main')

@section('title', 'Booking - ' . $layanan->nama_layanan)

@section('container')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
            <div class="flex items-center justify-between">
                <div>
                    <h1 class="text-2xl font-bold text-gray-900">Booking Destinasi</h1>
                    <p class="text-gray-600 mt-1">Lengkapi data booking untuk melanjutkan pemesanan</p>
                </div>
                <a href="{{ route('layanan.show', $layanan->layanan_id) }}"
                   class="inline-flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Booking Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-lg shadow-sm p-6">
                    <form action="{{ route('booking.store') }}" method="POST" id="bookingForm">
                        @csrf
                        <input type="hidden" name="layanan_id" value="{{ $layanan->layanan_id }}">
                        @if($specialOffer)
                            <input type="hidden" name="special_offer_id" value="{{ $specialOffer->id }}">
                        @endif

                        <!-- Customer Information -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                </svg>
                                Informasi Pemesan
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="customer_name" class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap *</label>
                                    <input type="text" id="customer_name" name="customer_name"
                                           value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                           required>
                                    @error('customer_name')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="customer_email" class="block text-sm font-medium text-gray-700 mb-1">Email *</label>
                                    <input type="email" id="customer_email" name="customer_email"
                                           value="{{ old('customer_email', auth()->user()->email ?? '') }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                           required>
                                    @error('customer_email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="customer_phone" class="block text-sm font-medium text-gray-700 mb-1">Nomor Telepon *</label>
                                    <input type="tel" id="customer_phone" name="customer_phone"
                                           value="{{ old('customer_phone') }}"
                                           placeholder="08xxxxxxxxxx"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                           required>
                                    @error('customer_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="customer_address" class="block text-sm font-medium text-gray-700 mb-1">Alamat Lengkap *</label>
                                    <textarea id="customer_address" name="customer_address" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                              required>{{ old('customer_address') }}</textarea>
                                    @error('customer_address')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Trip Details -->
                        <div class="mb-8">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4 flex items-center">
                                <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Detail Perjalanan
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label for="jumlah_peserta" class="block text-sm font-medium text-gray-700 mb-1">Jumlah Peserta *</label>
                                    <select id="jumlah_peserta" name="jumlah_peserta"
                                            class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                            required onchange="calculateTotal()">
                                        @for($i = 1; $i <= 20; $i++)
                                            <option value="{{ $i }}" {{ old('jumlah_peserta', 1) == $i ? 'selected' : '' }}>
                                                {{ $i }} {{ $i == 1 ? 'Orang' : 'Orang' }}
                                            </option>
                                        @endfor
                                    </select>
                                    @error('jumlah_peserta')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label for="tanggal_keberangkatan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Keberangkatan *</label>
                                    <input type="date" id="tanggal_keberangkatan" name="tanggal_keberangkatan"
                                           value="{{ old('tanggal_keberangkatan') }}"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                                           required>
                                    @error('tanggal_keberangkatan')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="md:col-span-2">
                                    <label for="catatan_khusus" class="block text-sm font-medium text-gray-700 mb-1">Catatan Khusus</label>
                                    <textarea id="catatan_khusus" name="catatan_khusus" rows="3"
                                              placeholder="Permintaan khusus, alergi makanan, kebutuhan aksesibilitas, dll."
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500">{{ old('catatan_khusus') }}</textarea>
                                    @error('catatan_khusus')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Terms and Conditions -->
                        <div class="mb-6">
                            <div class="flex items-start">
                                <div class="flex items-center h-5">
                                    <input id="terms" name="terms" type="checkbox"
                                           class="focus:ring-blue-500 h-4 w-4 text-blue-600 border-gray-300 rounded"
                                           required>
                                </div>
                                <div class="ml-3 text-sm">
                                    <label for="terms" class="font-medium text-gray-700">
                                        Saya menyetujui
                                        <a href="#" class="text-blue-600 hover:text-blue-500">syarat dan ketentuan</a>
                                        yang berlaku
                                    </label>
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="flex justify-end">
                            <button type="submit"
                                    class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed"
                                    id="submitBtn">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                Konfirmasi Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Booking Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-lg shadow-sm p-6 sticky top-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Ringkasan Booking</h3>

                    <!-- Destination Info -->
                    <div class="mb-6">
                        @if($layanan->gambar_utama)
                            <img src="{{ asset('storage/' . $layanan->gambar_utama) }}"
                                 alt="{{ $layanan->nama_layanan }}"
                                 class="w-full h-32 object-cover rounded-lg mb-3">
                        @endif
                        <h4 class="font-semibold text-gray-900">{{ $layanan->nama_layanan }}</h4>
                        <p class="text-sm text-gray-600 mt-1">{{ $layanan->lokasi }}</p>
                        @if($layanan->durasi)
                            <p class="text-sm text-gray-600">Durasi: {{ $layanan->durasi }}</p>
                        @endif
                    </div>

                    <!-- Special Offer -->
                    @if($specialOffer)
                        <div class="mb-6 p-3 bg-green-50 border border-green-200 rounded-lg">
                            <div class="flex items-center">
                                <svg class="w-5 h-5 text-green-600 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                                </svg>
                                <span class="text-sm font-medium text-green-800">Special Offer</span>
                            </div>
                            <p class="text-sm text-green-700 mt-1">{{ $specialOffer->title }}</p>
                            <p class="text-sm font-semibold text-green-800">Diskon {{ $specialOffer->discount_percentage }}%</p>
                        </div>
                    @endif

                    <!-- Price Calculation -->
                    <div class="border-t pt-4">
                        <div class="space-y-2">
                            <div class="flex justify-between text-sm">
                                <span>Harga per orang:</span>
                                <span>Rp {{ number_format($layanan->harga_mulai, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Jumlah peserta:</span>
                                <span id="participant-count">1 orang</span>
                            </div>
                            <div class="flex justify-between text-sm">
                                <span>Subtotal:</span>
                                <span id="subtotal">Rp {{ number_format($layanan->harga_mulai, 0, ',', '.') }}</span>
                            </div>
                            @if($specialOffer)
                                <div class="flex justify-between text-sm text-green-600">
                                    <span>Diskon ({{ $specialOffer->discount_percentage }}%):</span>
                                    <span id="discount">- Rp 0</span>
                                </div>
                            @endif
                            <div class="flex justify-between text-sm">
                                <span>Pajak (PPN 11%):</span>
                                <span id="tax">Rp {{ number_format($layanan->harga_mulai * 0.11, 0, ',', '.') }}</span>
                            </div>
                            <div class="border-t pt-2 flex justify-between font-semibold text-lg">
                                <span>Total:</span>
                                <span id="total" class="text-blue-600">Rp {{ number_format($layanan->harga_mulai * 1.11, 0, ',', '.') }}</span>
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

<script>
function calculateTotal() {
    const participants = parseInt(document.getElementById('jumlah_peserta').value) || 1;
    const basePrice = {{ $layanan->harga_mulai }};
    const discountPercentage = {{ $specialOffer->discount_percentage ?? 0 }};

    const subtotal = basePrice * participants;
    const discountAmount = subtotal * (discountPercentage / 100);
    const afterDiscount = subtotal - discountAmount;
    const taxAmount = afterDiscount * 0.11;
    const total = afterDiscount + taxAmount;

    // Update display
    document.getElementById('participant-count').textContent = participants + ' orang';
    document.getElementById('subtotal').textContent = 'Rp ' + subtotal.toLocaleString('id-ID');

    @if($specialOffer)
        document.getElementById('discount').textContent = '- Rp ' + discountAmount.toLocaleString('id-ID');
    @endif

    document.getElementById('tax').textContent = 'Rp ' + taxAmount.toLocaleString('id-ID');
    document.getElementById('total').textContent = 'Rp ' + total.toLocaleString('id-ID');
}

// Initialize calculation on page load
document.addEventListener('DOMContentLoaded', function() {
    calculateTotal();

    // Form validation
    const form = document.getElementById('bookingForm');
    const submitBtn = document.getElementById('submitBtn');

    form.addEventListener('submit', function(e) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = '<svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>Memproses...';
    });
});
</script>
@endsection
