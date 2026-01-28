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
                            <a href="https://wa.me/6281234567890" class="flex items-center gap-2 px-4 py-2.5 bg-green-500 text-white rounded-xl text-sm font-bold hover:bg-green-600 transition-all shadow-md">
                                <i class="fab fa-whatsapp"></i>
                                WhatsApp
                            </a>
                            <a href="tel:+6281234567890" class="flex items-center gap-2 px-4 py-2.5 bg-blue-500 text-white rounded-xl text-sm font-bold hover:bg-blue-600 transition-all shadow-md">
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
        } catch(e) {}
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

    jumlahPesertaSelect.addEventListener('change', updateCostSummary);
    
    // Initial calculation
    updateCostSummary();
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
@endsection
