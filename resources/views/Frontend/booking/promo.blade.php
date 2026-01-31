@extends('Frontend.layouts.main')

@section('title', 'Booking Promo - ' . $specialOffer->title)

@section('container')
<div class="min-h-screen bg-gradient-to-b from-slate-50 to-slate-100">
    <!-- Hero Header -->
    <div class="relative bg-gradient-to-r from-slate-900 via-slate-800 to-slate-900 overflow-hidden">
        <div class="absolute inset-0 opacity-20">
            @if($specialOffer->main_image)
                <img src="{{ Storage::url($specialOffer->main_image) }}" alt="" class="w-full h-full object-cover">
            @endif
        </div>
        <div class="absolute inset-0 bg-gradient-to-r from-slate-900/90 to-slate-900/70"></div>
        
        <div class="relative container mx-auto px-4 py-8 md:py-12">
            <!-- Breadcrumb -->
            <nav class="flex items-center gap-2 text-xs font-medium text-slate-400 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">
                    <i class="fas fa-home"></i>
                </a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <a href="{{ route('special-offers.index') }}" class="hover:text-white transition-colors">Special Offers</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <a href="{{ route('special-offers.show', $specialOffer->slug) }}" class="hover:text-white transition-colors">{{ Str::limit($specialOffer->title, 25) }}</a>
                <i class="fas fa-chevron-right text-[8px]"></i>
                <span class="text-white">Booking</span>
            </nav>

            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-3">
                        <span class="px-3 py-1 bg-gradient-to-r from-red-500 to-pink-500 text-white text-[10px] font-black uppercase tracking-wider rounded-full shadow-lg">
                            <i class="fas fa-tag mr-1"></i> Promo Spesial
                        </span>
                        @if($specialOffer->discount_percentage)
                            <span class="px-3 py-1 bg-yellow-400 text-yellow-900 text-[10px] font-black uppercase tracking-wider rounded-full">
                                Hemat {{ round($specialOffer->discount_percentage) }}%
                            </span>
                        @endif
                    </div>
                    <h1 class="text-2xl md:text-3xl lg:text-4xl font-black text-white leading-tight">
                        {{ $specialOffer->title }}
                    </h1>
                    <p class="text-slate-300 mt-2 text-sm md:text-base">
                        <i class="fas fa-map-marker-alt text-red-400 mr-2"></i>
                        {{ $specialOffer->layanan->lokasi_tujuan ?? 'Destinasi Eksotis' }}
                    </p>
                </div>
                <a href="{{ route('special-offers.show', $specialOffer->slug) }}" 
                   class="inline-flex items-center gap-2 px-5 py-3 bg-white/10 backdrop-blur border border-white/20 text-white rounded-2xl hover:bg-white/20 transition-all text-sm font-bold">
                    <i class="fas fa-arrow-left"></i>
                    Kembali ke Detail
                </a>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container mx-auto px-4 py-8 md:py-12">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">
            <!-- Left Column: Booking Form -->
            <div class="lg:col-span-2 space-y-6">
                <form action="{{ route('booking.promo.store') }}" method="POST" id="promoBookingForm">
                    @csrf
                    <input type="hidden" name="special_offer_id" value="{{ $specialOffer->id }}">
                    <input type="hidden" name="layanan_id" value="{{ $specialOffer->layanan_id }}">

                    <!-- Step 1: Data Pemesan -->
                    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 overflow-hidden">
                        <div class="bg-gradient-to-r from-slate-800 to-slate-700 px-6 md:px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-red-500 rounded-xl flex items-center justify-center shadow-lg shadow-red-500/30">
                                    <span class="text-white font-black">1</span>
                                </div>
                                <div>
                                    <h2 class="text-white font-bold text-lg">Data Pemesan</h2>
                                    <p class="text-slate-400 text-xs">Informasi kontak untuk pemesanan</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 md:p-8 space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Nama Lengkap -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">
                                        Nama Lengkap <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                            <i class="fas fa-user"></i>
                                        </span>
                                        <input type="text" name="nama_lengkap" value="{{ $user->name ?? old('nama_lengkap') }}" required
                                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-medium text-slate-700 @error('nama_lengkap') border-red-500 @enderror"
                                            placeholder="Masukkan nama lengkap">
                                    </div>
                                    @error('nama_lengkap')
                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Email -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">
                                        Email <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <input type="email" name="email" value="{{ $user->email ?? old('email') }}" required
                                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-medium text-slate-700 @error('email') border-red-500 @enderror"
                                            placeholder="contoh@email.com">
                                    </div>
                                    @error('email')
                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Nomor Telepon -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">
                                        No. WhatsApp <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                            <i class="fab fa-whatsapp"></i>
                                        </span>
                                        <input type="tel" name="nomor_telepon" value="{{ $user->phone ?? old('nomor_telepon') }}" required
                                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-medium text-slate-700 @error('nomor_telepon') border-red-500 @enderror"
                                            placeholder="08xxxxxxxxxx">
                                    </div>
                                    @error('nomor_telepon')
                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Alamat -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">
                                        Alamat
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </span>
                                        <input type="text" name="alamat" value="{{ old('alamat') }}"
                                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-medium text-slate-700 @error('alamat') border-red-500 @enderror"
                                            placeholder="Alamat lengkap (opsional)">
                                    </div>
                                    @error('alamat')
                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Step 2: Detail Keberangkatan -->
                    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 overflow-hidden mt-6">
                        <div class="bg-gradient-to-r from-red-600 to-pink-600 px-6 md:px-8 py-5">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center shadow-lg">
                                    <span class="text-red-600 font-black">2</span>
                                </div>
                                <div>
                                    <h2 class="text-white font-bold text-lg">Detail Perjalanan</h2>
                                    <p class="text-white/70 text-xs">Tentukan jadwal dan jumlah peserta</p>
                                </div>
                            </div>
                        </div>
                        <div class="p-6 md:p-8 space-y-5">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                                <!-- Tanggal Keberangkatan -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">
                                        Tanggal Berangkat <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                            <i class="fas fa-calendar-alt"></i>
                                        </span>
                                        <input type="date" name="tanggal_keberangkatan" id="tanggal_keberangkatan" required
                                            min="{{ \Carbon\Carbon::parse($specialOffer->valid_from)->format('Y-m-d') }}"
                                            max="{{ \Carbon\Carbon::parse($specialOffer->valid_until)->format('Y-m-d') }}"
                                            value="{{ old('tanggal_keberangkatan') }}"
                                            class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-medium text-slate-700 @error('tanggal_keberangkatan') border-red-500 @enderror">
                                    </div>
                                    <p class="text-xs text-slate-500">
                                        <i class="fas fa-info-circle text-blue-500 mr-1"></i>
                                        Promo berlaku: {{ \Carbon\Carbon::parse($specialOffer->valid_from)->format('d M') }} - {{ \Carbon\Carbon::parse($specialOffer->valid_until)->format('d M Y') }}
                                    </p>
                                    @error('tanggal_keberangkatan')
                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Jumlah Peserta -->
                                <div class="space-y-2">
                                    <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">
                                        Jumlah Peserta <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <select name="jumlah_peserta" id="jumlah_peserta" required
                                            class="w-full pl-12 pr-10 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-medium text-slate-700 appearance-none cursor-pointer @error('jumlah_peserta') border-red-500 @enderror">
                                            <option value="">Pilih jumlah peserta</option>
                                            @for($i = 1; $i <= 50; $i++)
                                                <option value="{{ $i }}" {{ old('jumlah_peserta') == $i ? 'selected' : '' }}>{{ $i }} Orang</option>
                                            @endfor
                                        </select>
                                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none">
                                            <i class="fas fa-chevron-down"></i>
                                        </span>
                                    </div>
                                    @error('jumlah_peserta')
                                        <p class="text-red-500 text-xs">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Catatan Khusus -->
                            <div class="space-y-2">
                                <label class="text-xs font-bold text-slate-600 uppercase tracking-wide">
                                    Catatan Khusus
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-4 text-slate-400">
                                        <i class="fas fa-sticky-note"></i>
                                    </span>
                                    <textarea name="catatan" id="catatan" rows="3"
                                        class="w-full pl-12 pr-4 py-4 bg-slate-50 border border-slate-200 rounded-xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-medium text-slate-700 resize-none @error('catatan') border-red-500 @enderror"
                                        placeholder="Contoh: Ada peserta vegetarian, butuh kursi roda, permintaan khusus lainnya...">{{ old('catatan') }}</textarea>
                                </div>
                                @error('catatan')
                                    <p class="text-red-500 text-xs">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Terms & Submit (Mobile) -->
                    <div class="lg:hidden mt-6 space-y-4">
                        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start gap-3">
                            <i class="fas fa-info-circle text-amber-500 mt-0.5"></i>
                            <p class="text-sm text-amber-800">
                                Dengan melanjutkan pemesanan, Anda menyetujui 
                                <a href="#" class="font-bold underline">syarat & ketentuan</a> yang berlaku.
                            </p>
                        </div>
                        <button type="submit" class="w-full py-5 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-black uppercase tracking-wider text-sm rounded-2xl transition-all shadow-xl shadow-red-200 transform hover:scale-[1.02] active:scale-[0.98]">
                            <i class="fas fa-check-circle mr-2"></i>
                            Konfirmasi Pemesanan
                        </button>
                    </div>
                </form>
            </div>

            <!-- Right Column: Order Summary (Sticky) -->
            <div class="lg:col-span-1">
                <div class="sticky top-24 space-y-6">
                    <!-- Promo Card Summary -->
                    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 overflow-hidden">
                        <div class="relative h-40 overflow-hidden">
                            @if($specialOffer->main_image)
                                <img src="{{ Storage::url($specialOffer->main_image) }}" alt="{{ $specialOffer->title }}" 
                                    class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-red-500 to-pink-600 flex items-center justify-center">
                                    <i class="fas fa-gift text-white text-4xl"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent"></div>
                            @if($specialOffer->discount_percentage)
                                <div class="absolute top-3 left-3 px-3 py-1 bg-red-600 text-white text-xs font-black rounded-lg shadow-lg">
                                    -{{ round($specialOffer->discount_percentage) }}%
                                </div>
                            @endif
                            <div class="absolute bottom-3 left-3 right-3">
                                <h3 class="text-white font-bold text-lg leading-tight line-clamp-2">{{ $specialOffer->title }}</h3>
                            </div>
                        </div>
                        
                        <div class="p-5 space-y-4">
                            <!-- Package Info -->
                            @if($specialOffer->layanan)
                            <div class="flex flex-wrap gap-3 text-xs text-slate-600">
                                @if($specialOffer->layanan->durasi)
                                <div class="flex items-center gap-1.5 bg-slate-100 px-3 py-1.5 rounded-lg">
                                    <i class="fas fa-clock text-red-500"></i>
                                    <span>{{ $specialOffer->layanan->durasi }}</span>
                                </div>
                                @endif
                                <div class="flex items-center gap-1.5 bg-slate-100 px-3 py-1.5 rounded-lg">
                                    <i class="fas fa-map-marker-alt text-red-500"></i>
                                    <span>{{ $specialOffer->layanan->lokasi_tujuan ?? 'Destinasi' }}</span>
                                </div>
                            </div>
                            @endif
                            
                            <!-- Price Breakdown -->
                            <div class="border-t border-dashed border-slate-200 pt-4 space-y-2">
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500">Harga Normal</span>
                                    <span class="text-slate-400 line-through">Rp {{ number_format($specialOffer->original_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="flex justify-between items-center text-sm">
                                    <span class="text-slate-500">Harga Promo</span>
                                    <span class="font-bold text-green-600">Rp {{ number_format($specialOffer->discounted_price, 0, ',', '.') }}/orang</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Cost Summary -->
                    <div class="bg-white rounded-[2rem] shadow-xl shadow-slate-200/50 overflow-hidden">
                        <div class="bg-slate-900 px-5 py-4">
                            <h3 class="text-white font-bold flex items-center gap-2">
                                <i class="fas fa-receipt text-red-400"></i>
                                Rincian Biaya
                            </h3>
                        </div>
                        <div class="p-5 space-y-3">
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500">Harga per orang</span>
                                <span class="font-medium">Rp {{ number_format($specialOffer->discounted_price, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-slate-500">Jumlah Peserta</span>
                                <span class="font-medium" id="display_peserta">-</span>
                            </div>
                            <div class="border-t border-slate-100 pt-3 flex justify-between items-center text-sm">
                                <span class="text-slate-500">Subtotal</span>
                                <span class="font-medium" id="display_subtotal">Rp 0</span>
                            </div>
                            <div class="border-t-2 border-slate-900 pt-4 mt-2">
                                <div class="flex justify-between items-center">
                                    <span class="font-bold text-slate-900">Total Bayar</span>
                                    <span class="text-xl font-black text-red-600" id="display_total">Rp 0</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Terms & Submit (Desktop) -->
                    <div class="hidden lg:block space-y-4">
                        <div class="bg-amber-50 border border-amber-200 rounded-2xl p-4 flex items-start gap-3">
                            <i class="fas fa-info-circle text-amber-500 mt-0.5"></i>
                            <p class="text-sm text-amber-800">
                                Dengan melanjutkan, Anda menyetujui 
                                <a href="#" class="font-bold underline">syarat & ketentuan</a>.
                            </p>
                        </div>
                        <button type="submit" form="promoBookingForm" class="w-full py-5 bg-gradient-to-r from-red-600 to-pink-600 hover:from-red-700 hover:to-pink-700 text-white font-black uppercase tracking-wider text-sm rounded-2xl transition-all shadow-xl shadow-red-200 transform hover:scale-[1.02] active:scale-[0.98]">
                            <i class="fas fa-check-circle mr-2"></i>
                            Konfirmasi Pemesanan
                        </button>
                    </div>

                    <!-- Help Box -->
                    <div class="bg-gradient-to-br from-slate-100 to-slate-50 rounded-2xl p-5 text-center border border-slate-200">
                        <p class="text-sm text-slate-600 mb-4">Ada pertanyaan?</p>
                        <div class="flex justify-center gap-3">
                            <a href="https://wa.me/6282266478147?text={{ urlencode('Halo Admin JustTrip, saya ingin berkonsultasi mengenai booking promo. Bisakah Anda membantu saya?') }}" target="_blank" class="flex items-center gap-2 px-4 py-2.5 bg-green-500 text-white rounded-xl text-sm font-bold hover:bg-green-600 transition-all shadow-md">
                                <i class="fab fa-whatsapp"></i>
                                WhatsApp
                            </a>
                            <a href="tel:+6282266478147" class="flex items-center gap-2 px-4 py-2.5 bg-blue-500 text-white rounded-xl text-sm font-bold hover:bg-blue-600 transition-all shadow-md">
                                <i class="fas fa-phone-alt"></i>
                                Telepon
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const hargaPaket = {{ (float)$specialOffer->discounted_price }};
    const jumlahPesertaSelect = document.getElementById('jumlah_peserta');
    const tanggalInput = document.getElementById('tanggal_keberangkatan');
    const catatanInput = document.getElementById('catatan');
    const form = document.getElementById('promoBookingForm');
    const submitButtons = document.querySelectorAll('button[type="submit"]');
    
    // Load data from sessionStorage if available
    const savedData = sessionStorage.getItem('promo_preview_data');
    if (savedData) {
        try {
            const data = JSON.parse(savedData);
            if (data.tanggal_keberangkatan && tanggalInput) {
                tanggalInput.value = data.tanggal_keberangkatan;
            }
            if (data.jumlah_peserta && jumlahPesertaSelect) {
                jumlahPesertaSelect.value = data.jumlah_peserta;
            }
        } catch(e) {
            console.error('Failed to load saved data:', e);
        }
        // Clear sessionStorage after loading
        sessionStorage.removeItem('promo_preview_data');
    }

    function formatRupiah(number) {
        return 'Rp ' + number.toLocaleString('id-ID');
    }

    function updateCostSummary() {
        const jumlahPeserta = parseInt(jumlahPesertaSelect.value) || 0;
        
        document.getElementById('display_peserta').textContent = jumlahPeserta > 0 ? jumlahPeserta + ' Orang' : '-';
        
        const subtotal = hargaPaket * jumlahPeserta;
        const total = subtotal;
        
        document.getElementById('display_subtotal').textContent = formatRupiah(subtotal);
        document.getElementById('display_total').textContent = formatRupiah(Math.round(total));
    }

    if (jumlahPesertaSelect) {
        jumlahPesertaSelect.addEventListener('change', updateCostSummary);
    }
    
    // Initial calculation
    updateCostSummary();

    // Form submission handling with improved protection
    if (form) {
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
                    field.classList.add('border-red-500');
                } else {
                    field.classList.remove('border-red-500');
                }
            });

            if (!allValid) {
                e.preventDefault();
                alert('Mohon lengkapi semua field yang wajib diisi.');
                return false;
            }

            // Set submitting state
            isSubmitting = true;

            // Disable all submit buttons
            submitButtons.forEach(btn => {
                btn.disabled = true;
                const originalContent = btn.innerHTML;
                btn.setAttribute('data-original-content', originalContent);
                btn.innerHTML = `
                    <svg class="animate-spin h-5 w-5 inline-block mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                    Memproses Pesanan...
                `;
            });

            // Add visual feedback to form
            form.style.opacity = '0.7';
            form.style.pointerEvents = 'none';

            // Show loading overlay
            const loadingOverlay = document.createElement('div');
            loadingOverlay.id = 'booking-loading-overlay';
            loadingOverlay.className = 'fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50';
            loadingOverlay.innerHTML = `
                <div class="bg-white rounded-2xl p-8 max-w-sm mx-4 text-center shadow-2xl">
                    <svg class="animate-spin h-12 w-12 mx-auto mb-4 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
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

            submitButtons.forEach(btn => {
                btn.disabled = false;
                const originalContent = btn.getAttribute('data-original-content');
                if (originalContent) {
                    btn.innerHTML = originalContent;
                }
            });

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

<style>
    input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        cursor: pointer;
        position: absolute;
        right: 0;
        width: 100%;
        height: 100%;
    }
    
    /* Line clamp utility */
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

{{-- Success Booking Modal --}}
@if(session('booking_success'))
<div id="bookingSuccessModal" class="fixed inset-0 z-50 flex items-center justify-center p-4" role="dialog" aria-modal="true">
    <!-- Backdrop -->
    <div class="absolute inset-0 bg-gray-900/60 backdrop-blur-sm" onclick="closeBookingModal()"></div>
    
    <!-- Modal Content -->
    <div class="relative bg-white rounded-3xl shadow-2xl max-w-lg w-full overflow-hidden transform transition-all animate-modal-in">
        <!-- Header with Gradient -->
        <div class="bg-gradient-to-r from-red-600 via-pink-600 to-purple-600 p-8 text-center relative overflow-hidden">
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
                <p class="text-white/90 text-sm">Pemesanan promo Anda telah berhasil dibuat</p>
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
                        <span class="text-slate-500 text-sm">Paket Promo</span>
                        <span class="font-bold text-slate-800 text-right">{{ session('booking_data')['promo_title'] ?? 'Promo Special' }}</span>
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
                        <span class="text-2xl font-black text-red-600">Rp {{ number_format(session('booking_data')['total_amount'] ?? 0, 0, ',', '.') }}</span>
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
                        class="flex-1 py-4 bg-gradient-to-r from-red-600 to-pink-600 text-white font-bold rounded-2xl hover:from-red-700 hover:to-pink-700 transition-all shadow-lg shadow-red-200">
                    Tutup
                </button>
            </div>
        </div>

        <!-- Decorative Elements -->
        <div class="absolute -top-4 -right-4 w-32 h-32 bg-pink-50 rounded-full blur-3xl opacity-60 -z-10"></div>
        <div class="absolute -bottom-4 -left-4 w-40 h-40 bg-purple-50 rounded-full blur-3xl opacity-60 -z-10"></div>
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
            const form = document.getElementById('promoBookingForm');
            if (form) {
                form.reset();
                // Recalculate totals
                if (typeof updateCostSummary === 'function') {
                    updateCostSummary();
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
