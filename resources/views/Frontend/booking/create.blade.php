@extends('Frontend.layouts.main')

@section('title', 'Booking - ' . $layanan->nama_layanan)

@section('container')
<div class="min-h-screen bg-[#f8fafc]">
    <!-- Hero Section with Minimal Design -->
    <div class="bg-blue-600 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <nav class="flex mb-4" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2 text-sm text-blue-100">
                            <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                            <li><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2"/></svg></li>
                            <li><a href="{{ route('layanan.index') }}" class="hover:text-white transition-colors">Paket Wisata</a></li>
                            <li><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2"/></svg></li>
                            <li class="text-white font-bold">Booking</li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-4xl font-black text-white leading-tight">
                        Lengkapi Detail Perjalanan
                    </h1>
                    <p class="mt-2 text-blue-100 text-lg">Hanya selangkah lagi menuju petualangan impian Anda di {{ $layanan->nama_layanan }}</p>
                </div>
                <div class="flex items-center space-x-4">
                    <div class="hidden md:flex flex-col items-end">
                        <span class="text-blue-100 text-sm">Butuh bantuan?</span>
                        <a href="https://wa.me/6282266478147?text={{ urlencode('Halo Admin JustTrip, saya membutuhkan bantuan untuk melakukan booking. Bisakah Anda membantu saya?') }}" target="_blank" class="text-white font-bold hover:underline">Hubungi Kami</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Stepper Navigation (Visual Only) -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-6">
        <div class="bg-white rounded-2xl shadow-lg p-4 mb-8 border border-gray-100">
            <div class="flex items-center justify-around max-w-2xl mx-auto">
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center font-bold shadow-lg shadow-blue-200">1</div>
                    <span class="mt-2 text-xs font-bold text-gray-900">Detail Booking</span>
                </div>
                <div class="flex-1 h-0.5 bg-gray-100 mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center font-bold">2</div>
                    <span class="mt-2 text-xs font-bold text-gray-400">Pembayaran</span>
                </div>
                <div class="flex-1 h-0.5 bg-gray-100 mx-4"></div>
                <div class="flex flex-col items-center">
                    <div class="w-10 h-10 bg-gray-100 text-gray-400 rounded-full flex items-center justify-center font-bold">3</div>
                    <span class="mt-2 text-xs font-bold text-gray-400">Selesai</span>
                </div>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-20">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Side: Form -->
            <div class="lg:col-span-8 space-y-8">
                <form action="{{ route('booking.store') }}" method="POST" id="bookingForm" class="space-y-8">
                    @csrf
                    <input type="hidden" name="layanan_id" value="{{ $layanan->layanan_id }}">
                    @if($specialOffer)
                        <input type="hidden" name="special_offer_id" value="{{ $specialOffer->id }}">
                    @endif

                    <!-- Section: Traveler Info -->
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 md:p-10 transition-all hover:shadow-md">
                        <div class="flex items-center space-x-4 mb-8">
                            <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-black text-gray-900">Informasi Pemesan</h2>
                                <p class="text-gray-500 font-medium">Data ini akan digunakan untuk dokumen perjalanan Anda</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="customer_name" class="text-sm font-bold text-gray-700 ml-1">Nama Lengkap</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                                    </div>
                                    <input type="text" id="customer_name" name="customer_name"
                                           value="{{ old('customer_name', auth()->user()->name ?? '') }}"
                                           placeholder="Nama sesuai identitas"
                                           class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none font-medium text-gray-900"
                                           required>
                                </div>
                                @error('customer_name') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="customer_email" class="text-sm font-bold text-gray-700 ml-1">Email Aktif</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                                    </div>
                                    <input type="email" id="customer_email" name="customer_email"
                                           value="{{ old('customer_email', auth()->user()->email ?? '') }}"
                                           placeholder="Email untuk kirim invoice"
                                           class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none font-medium text-gray-900"
                                           required>
                                </div>
                                @error('customer_email') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div class="space-y-2">
                                <label for="customer_phone" class="text-sm font-bold text-gray-700 ml-1">Nomor WhatsApp</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <span class="text-gray-400 font-bold group-focus-within:text-blue-500 transition-colors">+62</span>
                                    </div>
                                    <input type="tel" id="customer_phone" name="customer_phone"
                                           value="{{ old('customer_phone', auth()->user()->phone ?? '') }}"
                                           placeholder="8xxxxxxxxxx"
                                           class="w-full pl-14 pr-4 py-3.5 bg-gray-50 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none font-medium text-gray-900"
                                           required>
                                </div>
                                @error('customer_phone') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2 space-y-2">
                                <label for="customer_address" class="text-sm font-bold text-gray-700 ml-1">Alamat Lengkap</label>
                                <textarea id="customer_address" name="customer_address" rows="3"
                                          placeholder="Alamat untuk keperluan administrasi"
                                          class="w-full px-6 py-4 bg-gray-50 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none font-medium text-gray-900"
                                          required>{{ old('customer_address', auth()->user()->address ?? '') }}</textarea>
                                @error('customer_address') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Section: Trip Details -->
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 md:p-10 transition-all hover:shadow-md">
                        <div class="flex items-center space-x-4 mb-8">
                            <div class="p-3 bg-indigo-50 text-indigo-600 rounded-2xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-black text-gray-900">Detail Perjalanan</h2>
                                <p class="text-gray-500 font-medium">Tentukan waktu dan jumlah rombongan Anda</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <div class="space-y-4">
                                <label class="text-sm font-bold text-gray-700 ml-1">Jumlah Peserta</label>
                                <div class="flex items-center justify-between p-2 bg-gray-50 border-gray-200 rounded-2xl w-full md:w-48">
                                    <button type="button" onclick="changeParticipants(-1)" class="w-12 h-12 flex items-center justify-center bg-white rounded-xl shadow-sm text-gray-600 hover:text-blue-600 active:scale-95 transition-all">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12H4"/></svg>
                                    </button>
                                    <input type="number" id="jumlah_peserta" name="jumlah_peserta" value="{{ old('jumlah_peserta', 1) }}" 
                                           class="w-12 text-center bg-transparent border-none font-black text-xl text-gray-900 focus:ring-0" 
                                           readonly onchange="calculateTotal()">
                                    <button type="button" onclick="changeParticipants(1)" class="w-12 h-12 flex items-center justify-center bg-white rounded-xl shadow-sm text-gray-600 hover:text-blue-600 active:scale-95 transition-all">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                    </button>
                                </div>
                                <p class="text-xs text-gray-400 font-medium italic">* Maksimal 50 peserta per booking</p>
                            </div>

                            <div class="space-y-4">
                                <label for="tanggal_keberangkatan" class="text-sm font-bold text-gray-700 ml-1">Tanggal Keberangkatan</label>
                                <div class="relative group">
                                    <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                                        <svg class="h-5 w-5 text-gray-400 group-focus-within:text-blue-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <input type="date" id="tanggal_keberangkatan" name="tanggal_keberangkatan"
                                           value="{{ old('tanggal_keberangkatan') }}"
                                           min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                           class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none font-black text-gray-900"
                                           required>
                                </div>
                                @error('tanggal_keberangkatan') <p class="mt-1 text-xs text-red-600 font-medium">{{ $message }}</p> @enderror
                            </div>

                            <div class="md:col-span-2 space-y-2">
                                <label for="catatan_khusus" class="text-sm font-bold text-gray-700 ml-1">Catatan Tambahan (Opsional)</label>
                                <textarea id="catatan_khusus" name="catatan_khusus" rows="3"
                                          placeholder="Contoh: Permintaan makanan khusus, kursi roda, atau kejutan ulang tahun..."
                                          class="w-full px-6 py-4 bg-gray-50 border-gray-200 rounded-2xl focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all outline-none font-medium text-gray-900">{{ old('catatan_khusus') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- Terms & Submit -->
                    <div class="bg-blue-50 rounded-[2rem] p-8 border border-blue-100 space-y-6">
                        <div class="flex items-start">
                            <div class="flex items-center h-6">
                                <input id="terms" name="terms" type="checkbox"
                                       class="w-5 h-5 text-blue-600 border-gray-300 rounded-lg focus:ring-blue-500" required>
                            </div>
                            <div class="ml-4 text-sm font-medium text-gray-700 leading-snug">
                                <label for="terms">
                                    Saya telah membaca dan menyetujui <a href="#" class="text-blue-600 font-bold hover:underline">Syarat & Ketentuan</a> serta Kebijakan Privasi JustTrip Travel.
                                </label>
                            </div>
                        </div>

                        <button type="submit" id="submitBtn"
                                class="w-full bg-blue-600 text-white font-black py-5 rounded-2xl text-lg shadow-xl shadow-blue-200 hover:bg-blue-700 hover:scale-[1.01] active:scale-95 transition-all flex items-center justify-center group overflow-hidden relative">
                            <span class="relative z-10 flex items-center">
                                Konfirmasi & Buat Pesanan
                                <svg class="w-6 h-6 ml-2 transform group-hover:translate-x-2 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7-7 7"/></svg>
                            </span>
                            <div class="absolute inset-0 bg-white opacity-0 group-hover:opacity-10 transition-opacity"></div>
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Side: Sticky Summary -->
            <div class="lg:col-span-4 lg:sticky lg:top-8">
                <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden">
                    <!-- Package Info -->
                    <div class="relative h-48">
                        <img src="{{ asset($layanan->gambar_utama ? 'storage/' . $layanan->gambar_utama : 'img/placeholder-trip.jpg') }}"
                             alt="{{ $layanan->nama_layanan }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent"></div>
                        <div class="absolute bottom-6 left-6 right-6">
                            <p class="text-xs font-bold text-blue-400 uppercase tracking-widest mb-1">{{ $layanan->lokasi }}</p>
                            <h3 class="text-white text-xl font-black leading-tight">{{ $layanan->nama_layanan }}</h3>
                        </div>
                    </div>

                    <div class="p-8 space-y-8">
                        <!-- Quick Stats -->
                        <div class="flex items-center justify-between text-sm py-4 border-b border-gray-100 font-bold">
                            <div class="flex items-center text-gray-500">
                                <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Durasi
                            </div>
                            <div class="text-gray-900">{{ $layanan->durasi ?? 'Sesuai Paket' }}</div>
                        </div>

                        <!-- Price Tiers -->
                        <div class="space-y-4">
                            <h4 class="text-sm font-black text-gray-900 uppercase tracking-widest">Rincian Biaya</h4>
                            <div class="space-y-3">
                                <div class="flex justify-between text-gray-500 font-medium">
                                    <span>Harga per Orang</span>
                                    <span class="text-gray-900 font-bold text-right" id="price-per-person">Rp {{ number_format($layanan->harga_mulai, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between text-gray-500 font-medium">
                                    <span>Total Peserta</span>
                                    <span class="text-gray-900 font-bold" id="summary-participants">1 Orang</span>
                                </div>
                                <div class="flex justify-between text-gray-500 font-medium pb-4 border-b border-dashed border-gray-200">
                                    <span>Subtotal</span>
                                    <span class="text-gray-900 font-bold" id="summary-subtotal">Rp {{ number_format($layanan->harga_mulai, 0, ',', '.') }}</span>
                                </div>

                                @if($specialOffer)
                                    <div class="flex justify-between items-center p-3 bg-green-50 rounded-xl border border-green-100">
                                        <div class="flex flex-col">
                                            <span class="text-green-800 text-[10px] font-black uppercase tracking-tight">Potongan Promo</span>
                                            <span class="text-xs text-green-600 font-bold">{{ $specialOffer->title }}</span>
                                        </div>
                                        <span class="text-green-700 font-black" id="summary-discount">- Rp 0</span>
                                    </div>
                                @endif


                            </div>
                        </div>

                        <div class="pt-6 border-t-4 border-double border-gray-100">
                            <div class="flex justify-between items-center bg-gray-50 p-4 rounded-2xl">
                                <span class="text-sm font-black text-gray-400 uppercase tracking-widest">Total Bayar</span>
                                <span class="text-2xl font-black text-blue-600" id="summary-total">Rp {{ number_format($layanan->harga_mulai, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Trust Badges -->
                        <div class="pt-4 grid grid-cols-2 gap-4 opacity-50 contrast-50 grayscale">
                            <div class="flex flex-col items-center">
                                <div class="p-2 border border-gray-200 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <span class="text-[8px] font-bold mt-1 uppercase">Safe Payment</span>
                            </div>
                            <div class="flex flex-col items-center">
                                <div class="p-2 border border-gray-200 rounded-lg">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/></svg>
                                </div>
                                <span class="text-[8px] font-bold mt-1 uppercase">Instant Booking</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function changeParticipants(delta) {
    const input = document.getElementById('jumlah_peserta');
    let value = parseInt(input.value) + delta;
    if (value < 1) value = 1;
    if (value > 50) value = 50;
    input.value = value;
    calculateTotal();
}

function calculateTotal() {
    const participants = parseInt(document.getElementById('jumlah_peserta').value) || 1;
    const basePrice = {{ $layanan->harga_mulai }};
    const discountPercentage = {{ $specialOffer->discount_percentage ?? 0 }};

    const subtotal = basePrice * participants;
    const discountAmount = subtotal * (discountPercentage / 100);
    const total = subtotal - discountAmount; // No PPN

    // Format utility
    const fmt = (num) => 'Rp ' + num.toLocaleString('id-ID');

    // Update Summary Side
    document.getElementById('summary-participants').textContent = participants + ' Orang';
    document.getElementById('summary-subtotal').textContent = fmt(subtotal);
    
    if (document.getElementById('summary-discount')) {
        document.getElementById('summary-discount').textContent = '- ' + fmt(discountAmount);
    }

    document.getElementById('summary-total').textContent = fmt(Math.round(total));
    
    // Animate total update
    const totalEl = document.getElementById('summary-total');
    totalEl.classList.remove('scale-110', 'text-blue-400');
    void totalEl.offsetWidth; // Trigger reflow
    totalEl.classList.add('scale-110', 'text-blue-400', 'transition-all');
    setTimeout(() => {
        totalEl.classList.remove('scale-110', 'text-blue-400');
    }, 200);
}

document.addEventListener('DOMContentLoaded', function() {
    calculateTotal();
    
    // Form submission with improved protection
    const form = document.getElementById('bookingForm');
    const submitBtn = document.getElementById('submitBtn');

    if (form && submitBtn) {
        let isSubmitting = false;
        let submissionTimeout = null;

        form.addEventListener('submit', function(e) {
            // Prevent double submission
            if (isSubmitting) {
                e.preventDefault();
                console.warn('Form submission blocked - already submitting');
                return false;
            }

            // Basic validation check
            const requiredFields = form.querySelectorAll('[required]');
            let allValid = true;
            requiredFields.forEach(field => {
                if (!field.value || field.value.trim() === '') {
                    allValid = false;
                    field.classList.add('border-red-500', 'ring-2', 'ring-red-500');
                } else {
                    field.classList.remove('border-red-500', 'ring-2', 'ring-red-500');
                }
            });

            if (!allValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi.');
                // Scroll to first invalid field
                const firstInvalid = form.querySelector('.border-red-500');
                if (firstInvalid) {
                    firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    firstInvalid.focus();
                }
                return false;
            }

            // Set submitting state
            isSubmitting = true;
            submitBtn.disabled = true;
            
            const originalBtnContent = submitBtn.innerHTML;
            submitBtn.setAttribute('data-original-content', originalBtnContent);
            submitBtn.innerHTML = `
                <svg class="animate-spin h-6 w-6 text-white inline-block" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="ml-3">Sedang Memproses...</span>
            `;

            // Add visual feedback to form
            form.style.opacity = '0.7';
            form.style.pointerEvents = 'none';

            // Show loading overlay
            const loadingOverlay = document.createElement('div');
            loadingOverlay.id = 'booking-loading-overlay';
            loadingOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            loadingOverlay.innerHTML = `
                <div class="bg-white rounded-2xl p-8 max-w-sm mx-4 text-center shadow-2xl">
                    <svg class="animate-spin h-12 w-12 mx-auto mb-4 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Memproses Pemesanan</h3>
                    <p class="text-sm text-gray-600">Mohon tunggu sebentar...</p>
                </div>
            `;
            document.body.appendChild(loadingOverlay);

            // Safety timeout - re-enable after 45 seconds if no response
            submissionTimeout = setTimeout(() => {
                if (isSubmitting) {
                    console.error('Form submission timeout - re-enabling form');
                    resetForm();
                    alert('Permintaan memakan waktu terlalu lama. Silakan periksa koneksi Anda dan coba lagi.');
                }
            }, 45000);
        });

        // Function to reset form state (in case of errors)
        function resetForm() {
            isSubmitting = false;
            
            if (submissionTimeout) {
                clearTimeout(submissionTimeout);
                submissionTimeout = null;
            }

            submitBtn.disabled = false;
            const originalContent = submitBtn.getAttribute('data-original-content');
            if (originalContent) {
                submitBtn.innerHTML = originalContent;
            }

            form.style.opacity = '1';
            form.style.pointerEvents = 'auto';

            const overlay = document.getElementById('booking-loading-overlay');
            if (overlay) {
                overlay.remove();
            }
        }

        // Reset on page unload (if user navigates back)
        window.addEventListener('pageshow', function(event) {
            if (event.persisted || (window.performance && window.performance.navigation.type === 2)) {
                resetForm();
            }
        });
    }
});
</script>

{{-- Success Booking Modal --}}
@if(session('booking_success'))
<div id="bookingSuccessModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeBookingModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden transform transition-all animate-modal-in">
        <!-- Header with Gradient -->
        <div class="bg-gradient-to-r from-blue-600 via-indigo-600 to-purple-600 p-8 text-center relative overflow-hidden">
            <div class="absolute top-0 left-0 w-full h-full opacity-20">
                <div class="absolute top-2 right-10 w-20 h-20 bg-white/30 rounded-full blur-xl"></div>
                <div class="absolute bottom-2 left-10 w-16 h-16 bg-white/30 rounded-full blur-xl"></div>
            </div>
            <div class="relative z-10">
                <div class="w-20 h-20 bg-white/20 backdrop-blur rounded-2xl flex items-center justify-center mx-auto mb-4">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <h2 class="text-3xl font-black text-white mb-2">Booking Berhasil Tercatat!</h2>
                <p class="text-white/90 text-sm">Pemesanan Anda telah berhasil dibuat</p>
            </div>
        </div>

        <div class="p-8 space-y-6">
            <!-- Booking Details Card -->
            <div class="bg-slate-50 rounded-2xl p-6 space-y-4">
                <h3 class="text-xs font-black text-slate-400 uppercase tracking-widest">Detail Pemesanan</h3>
                
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500 text-sm">Nomor Booking</span>
                        <span class="font-black text-slate-800">{{ session('booking_number') }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500 text-sm">Paket Wisata</span>
                        <span class="font-bold text-slate-800 text-right">{{ session('booking_data')['layanan_name'] ?? 'Paket Wisata' }}</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500 text-sm">Jumlah Peserta</span>
                        <span class="font-bold text-slate-800">{{ session('booking_data')['jumlah_peserta'] ?? '-' }} Orang</span>
                    </div>
                    
                    <div class="flex justify-between items-center">
                        <span class="text-slate-500 text-sm">Tanggal Berangkat</span>
                        <span class="font-bold text-slate-800">{{ \Carbon\Carbon::parse(session('booking_data')['tanggal_keberangkatan'] ?? now())->format('d M Y') }}</span>
                    </div>

                    <div class="pt-3 border-t-2 border-slate-200 flex justify-between items-center">
                        <span class="text-sm font-bold text-slate-700">Total Pembayaran</span>
                        <span class="text-2xl font-black text-blue-600">Rp {{ number_format(session('booking_data')['total_amount'] ?? 0, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="pt-3 border-t border-dashed border-slate-200">
                    <div class="flex items-center justify-center gap-2 text-center">
                        <svg class="w-4 h-4 text-amber-500 animate-pulse" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                        </svg>
                        <span class="text-xs font-bold text-amber-700">Status: Menunggu Konfirmasi Admin</span>
                    </div>
                </div>
            </div>

            <!-- Info Alert -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4 flex items-start gap-3">
                <svg class="w-5 h-5 text-blue-500 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <div class="text-sm text-blue-800">
                    <p class="font-bold mb-2">Langkah Selanjutnya:</p>
                    <ul class="space-y-1 text-xs">
                        <li class="flex items-start gap-2">
                            <svg class="w-3 h-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>Admin akan memverifikasi pemesanan Anda</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-3 h-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>Anda akan menerima email konfirmasi</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <svg class="w-3 h-3 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                            <span>Lakukan pembayaran setelah booking dikonfirmasi</span>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Action Buttons -->
            <div class="flex gap-3">
                <a href="{{ route('booking.show', session('booking_id')) }}" 
                   class="flex-1 py-4 bg-slate-100 text-slate-700 text-center font-bold rounded-2xl hover:bg-slate-200 transition-all">
                    Lihat Detail Booking
                </a>
                <button type="button" onclick="closeBookingModal()" 
                        class="flex-1 py-4 bg-gradient-to-r from-blue-600 to-indigo-600 text-white font-bold rounded-2xl hover:from-blue-700 hover:to-indigo-700 transition-all shadow-lg shadow-blue-200">
                    Tutup
                </button>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute -top-4 -right-4 w-32 h-32 bg-blue-50 rounded-full blur-3xl opacity-60 -z-10"></div>
        <div class="absolute -bottom-4 -left-4 w-40 h-40 bg-indigo-50 rounded-full blur-3xl opacity-60 -z-10"></div>
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
            // Reset form after closing modal
            const form = document.getElementById('bookingForm');
            if (form) {
                form.reset();
                // Reset participants to default
                const participantsInput = document.getElementById('jumlah_peserta');
                if (participantsInput) {
                    participantsInput.value = 1;
                }
                // Recalculate totals
                if (typeof calculateTotal === 'function') {
                    calculateTotal();
                }
            }
        }, 200);
    }
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeBookingModal();
    }
});

// Auto-scroll to top when modal appears
document.addEventListener('DOMContentLoaded', function() {
    const modal = document.getElementById('bookingSuccessModal');
    if (modal) {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    }
});
</script>
@endif
@endsection
