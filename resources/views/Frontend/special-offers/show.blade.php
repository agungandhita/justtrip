@extends('Frontend.layouts.main')

@section('container')
<div class="antialiased text-slate-900 font-['Plus_Jakarta_Sans',sans-serif] bg-white">
    <!-- Breadcrumbs & Back Button -->
    <div class="bg-white border-b border-slate-100">
        <div class="container mx-auto px-4 py-4">
            <div class="flex items-center justify-between">
                <nav class="flex text-xs font-bold uppercase tracking-widest text-slate-400 gap-2">
                    <a href="{{ route('home') }}" class="hover:text-red-500 transition-colors">Home</a>
                    <span>/</span>
                    <a href="{{ route('special-offers.index') }}" class="hover:text-red-500 transition-colors">Special Offers</a>
                    <span>/</span>
                    <span class="text-slate-900">{{ $specialOffer->title }}</span>
                </nav>
                <a href="{{ route('special-offers.index') }}" class="text-xs font-black uppercase tracking-widest text-red-600 flex items-center gap-2 hover:gap-3 transition-all">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Hero Section: Immersive Design -->
    <section class="relative min-h-[70vh] flex items-center justify-center overflow-hidden">
        <!-- Dynamic Background -->
        <div class="absolute inset-0 z-0">
            @php $displayImageUrl = $specialOffer->display_image_url; @endphp
            @if($displayImageUrl)
                <img src="{{ $displayImageUrl }}" alt="{{ $specialOffer->title }}" class="object-cover w-full h-full scale-105 animate-slow-zoom">
            @else
                <div class="w-full h-full bg-gradient-to-br from-slate-900 via-red-900 to-black"></div>
            @endif
            <div class="absolute inset-0 bg-gradient-to-t from-white via-slate-950/40 to-transparent"></div>
            <div class="absolute inset-x-0 bottom-0 h-32 bg-gradient-to-t from-white to-transparent"></div>
        </div>

        <div class="container relative z-10 px-4 mx-auto pt-20">
            <div class="max-w-5xl mx-auto text-center">
                <!-- Badges -->
                <div class="flex flex-wrap justify-center items-center gap-3 mb-8" data-aos="fade-down">
                    <span class="px-6 py-2 bg-red-600 text-white rounded-full text-[10px] font-black uppercase tracking-[0.3em] shadow-xl shadow-red-500/30">
                        OFFER EXCLUSIVE
                    </span>
                    @if($specialOffer->discount_percentage)
                        <span class="px-6 py-2 bg-white text-red-600 rounded-full text-[10px] font-black uppercase tracking-[0.3em] shadow-xl shadow-black/10">
                            SAVE {{ round($specialOffer->discount_percentage) }}%
                        </span>
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-7xl font-black text-white mb-8 leading-[1.1] tracking-tighter drop-shadow-2xl" data-aos="zoom-out" data-aos-delay="100">
                    {{ $specialOffer->title }}
                </h1>

                <!-- Location & Highlights -->
                @if($specialOffer->layanan)
                <div class="flex flex-wrap items-center justify-center gap-6 mb-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20 text-white font-bold text-sm">
                        <i class="fas fa-map-marker-alt text-red-500"></i>
                        {{ $specialOffer->layanan->lokasi_tujuan }}
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20 text-white font-bold text-sm">
                        <i class="fas fa-calendar-alt text-red-500"></i>
                        {{ $specialOffer->layanan->durasi ?? 'Sesuai Paket' }}
                    </div>
                    <div class="flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20 text-white font-bold text-sm">
                        <i class="fas fa-bolt text-red-500"></i>
                        Instant Confirmation
                    </div>
                </div>
                @endif

                <!-- Countdown: Industrial Glassmorphism -->
                @php
                    $validUntil = \Carbon\Carbon::parse($specialOffer->valid_until);
                    $now = \Carbon\Carbon::now();
                    $isValid = $validUntil->gt($now);
                @endphp

                @if($isValid)
                <div class="inline-flex flex-col items-center bg-white/80 backdrop-blur-2xl border border-white p-8 md:p-10 rounded-[3rem] shadow-2xl shadow-black/5" data-aos="fade-up" data-aos-delay="300">
                    <p class="text-[9px] font-black uppercase tracking-[0.4em] text-slate-400 mb-8">PENAWARAN BERAKHIR DALAM</p>
                    <div id="countdown-timer" class="flex gap-6 md:gap-12" data-end-time="{{ $validUntil->toISOString() }}">
                        <div class="flex flex-col items-center">
                            <span class="text-4xl md:text-6xl font-black text-slate-900 tabular-nums" id="days">00</span>
                            <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest mt-2">HARI</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-4xl md:text-6xl font-black text-slate-900 tabular-nums" id="hours">00</span>
                            <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest mt-2">JAM</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-4xl md:text-6xl font-black text-slate-900 tabular-nums" id="minutes">00</span>
                            <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest mt-2">MENIT</span>
                        </div>
                        <div class="flex flex-col items-center">
                            <span class="text-4xl md:text-6xl font-black text-slate-900 tabular-nums" id="seconds">00</span>
                            <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest mt-2">DETIK</span>
                        </div>
                    </div>
                </div>
                @else
                <div class="inline-block px-10 py-5 bg-red-600 text-white rounded-[2rem] shadow-2xl shadow-red-500/40">
                    <span class="text-sm font-black uppercase tracking-[0.3em]">PROMO TELAH BERAKHIR</span>
                </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Product Content Area -->
    <section class="relative py-24 bg-white">
        <div class="container px-4 mx-auto">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-16">
                <!-- Left Content Area -->
                <div class="lg:col-span-8 space-y-20">
                    <!-- Overview -->
                    <div class="space-y-8" data-aos="fade-up">
                        <div class="flex items-center gap-4">
                            <span class="w-12 h-1 bg-red-600 rounded-full"></span>
                            <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Rincian Penawaran</h2>
                        </div>
                        <div class="prose prose-slate max-w-none text-slate-600 leading-loose text-lg font-medium">
                            {!! nl2br(e($specialOffer->description)) !!}
                        </div>

                        {{-- Destinasi & Fasilitas Layanan yang ditautkan --}}
                        @if($specialOffer->layanan)
                            @if(!empty($specialOffer->layanan->destinations) && count($specialOffer->layanan->destinations) > 0)
                            <div class="space-y-4 pt-4 border-t border-slate-100">
                                <h3 class="text-[10px] font-black uppercase tracking-[0.3em] text-red-600 flex items-center gap-3">
                                    <span class="w-6 h-[2px] bg-red-600"></span>
                                    Destinasi & Spot yang Dikunjungi
                                </h3>
                                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-3">
                                    @foreach($specialOffer->layanan->destinations as $dest)
                                    <div class="flex items-center gap-3 p-4 bg-slate-50 border border-slate-100 rounded-2xl">
                                        <div class="w-8 h-8 rounded-xl bg-red-600 text-white flex items-center justify-center text-xs shrink-0 shadow-sm">
                                            <i class="fas fa-map-pin"></i>
                                        </div>
                                        <span class="text-xs md:text-sm font-bold text-slate-800">{{ $dest }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif

                            @if(!empty($specialOffer->layanan->include_services) || !empty($specialOffer->layanan->exclude_services))
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100">
                                @if(!empty($specialOffer->layanan->include_services))
                                <div class="space-y-3">
                                    <h4 class="text-[10px] font-black text-emerald-600 uppercase tracking-widest flex items-center gap-2">
                                        <i class="fas fa-check-circle"></i> Fasilitas Included
                                    </h4>
                                    <ul class="space-y-2">
                                        @foreach($specialOffer->layanan->include_services as $inc)
                                        <li class="flex items-start gap-2.5 text-xs text-slate-700 font-semibold p-3 bg-emerald-50/60 border border-emerald-100 rounded-xl">
                                            <i class="fas fa-check text-emerald-500 mt-0.5 text-xs"></i>
                                            <span>{{ $inc }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                @if(!empty($specialOffer->layanan->exclude_services))
                                <div class="space-y-3">
                                    <h4 class="text-[10px] font-black text-rose-500 uppercase tracking-widest flex items-center gap-2">
                                        <i class="fas fa-times-circle"></i> Excluded
                                    </h4>
                                    <ul class="space-y-2">
                                        @foreach($specialOffer->layanan->exclude_services as $exc)
                                        <li class="flex items-start gap-2.5 text-xs text-slate-700 font-semibold p-3 bg-rose-50/60 border border-rose-100 rounded-xl">
                                            <i class="fas fa-times text-rose-400 mt-0.5 text-xs"></i>
                                            <span>{{ $exc }}</span>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                            </div>
                            @endif

                            @if($specialOffer->layanan->catatan)
                            <div class="p-6 rounded-2xl bg-amber-50/80 border border-amber-200/70 flex items-start gap-4 shadow-sm">
                                <div class="w-8 h-8 rounded-xl bg-amber-400 text-amber-950 flex items-center justify-center shrink-0 text-sm shadow-sm">
                                    <i class="fas fa-info-circle"></i>
                                </div>
                                <div>
                                    <h5 class="text-xs font-black uppercase tracking-widest text-amber-900 mb-1">Catatan Trip</h5>
                                    <p class="text-xs text-amber-900/80 font-medium leading-relaxed whitespace-pre-line">{!! nl2br(e($specialOffer->layanan->catatan)) !!}</p>
                                </div>
                            </div>
                            @endif
                        @endif
                    </div>

                    <!-- Trust Signals Bar -->
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 py-10 border-y border-slate-100" data-aos="fade-up">
                        <div class="text-center space-y-2">
                            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center mx-auto text-red-600">
                                <i class="fas fa-shield-alt text-xl"></i>
                            </div>
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-900">Secure Payment</h4>
                        </div>
                        <div class="text-center space-y-2">
                            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center mx-auto text-red-600">
                                <i class="fas fa-headset text-xl"></i>
                            </div>
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-900">24/7 Support</h4>
                        </div>
                        <div class="text-center space-y-2">
                            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center mx-auto text-red-600">
                                <i class="fas fa-star text-xl"></i>
                            </div>
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-900">Best Price</h4>
                        </div>
                        <div class="text-center space-y-2">
                            <div class="w-12 h-12 bg-red-50 rounded-2xl flex items-center justify-center mx-auto text-red-600">
                                <i class="fas fa-check-circle text-xl"></i>
                            </div>
                            <h4 class="text-[10px] font-black uppercase tracking-widest text-slate-900">Verified Trip</h4>
                        </div>
                    </div>

                    <!-- Gallery -->
                    @php
                        $hasGallery = false;
                        $galleryItems = [];
                        if($specialOffer->isStandalone() && $specialOffer->galleries->count() > 0) {
                            $hasGallery = true;
                            $galleryItems = $specialOffer->galleries;
                        } elseif($specialOffer->layanan && $specialOffer->layanan->gambar_destinasi && count((array)$specialOffer->layanan->gambar_destinasi) > 0) {
                            $hasGallery = true;
                            $galleryItems = (array)$specialOffer->layanan->gambar_destinasi;
                        }
                    @endphp

                    @if($hasGallery)
                    <div class="space-y-10" data-aos="fade-up">
                        <div class="flex items-center gap-4">
                            <span class="w-12 h-1 bg-red-600 rounded-full"></span>
                            <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Galeri Visual</h2>
                        </div>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                            @foreach($galleryItems as $index => $item)
                                @php
                                    $imagePath = is_object($item) ? asset('storage/' . $item->image_path) : asset('storage/' . $item);
                                    $title = is_object($item) ? $item->title : "Gallery Image ".($index + 1);
                                @endphp
                                <div class="group relative aspect-square rounded-[2.5rem] overflow-hidden cursor-pointer shadow-2xl shadow-slate-200" onclick="openLightbox('{{ $imagePath }}', '{{ $title }}')">
                                    <img src="{{ $imagePath }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-125">
                                    <div class="absolute inset-0 bg-red-600/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                        <div class="w-14 h-14 bg-white/20 backdrop-blur-xl rounded-full flex items-center justify-center transform translate-y-4 group-hover:translate-y-0 transition-transform">
                                            <i class="fas fa-expand-alt text-white"></i>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <!-- Terms -->
                    @if($specialOffer->terms_conditions)
                    <div class="bg-slate-50 rounded-[3rem] p-10 md:p-14" data-aos="fade-up">
                        <h3 class="text-sm font-black text-red-600 uppercase tracking-[0.4em] mb-8">Syarat & Ketentuan</h3>
                        <div class="prose prose-slate prose-sm max-w-none text-slate-500 font-medium">
                            {!! nl2br(e($specialOffer->terms_conditions)) !!}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Right Sidebar: Floating Booking Card -->
                <div class="lg:col-span-4 relative">
                    <div class="sticky top-24 space-y-8">
                        <div class="bg-white rounded-[3.5rem] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.1)] border border-slate-50 overflow-hidden transform transition-all hover:-translate-y-2" data-aos="fade-left">
                            <!-- Price Header -->
                            <div class="bg-slate-900 p-10 text-center text-white relative overflow-hidden">
                                <div class="absolute top-0 right-0 p-4 opacity-10">
                                    <i class="fas fa-paper-plane text-8xl rotate-12"></i>
                                </div>
                                <p class="text-[9px] font-black uppercase tracking-[0.4em] text-slate-400 mb-4">Mulai Dari</p>
                                <div class="flex flex-col items-center gap-2">
                                    <span class="text-sm text-slate-500 line-through font-bold">Rp {{ number_format($specialOffer->original_price, 0, ',', '.') }}</span>
                                    <span class="text-4xl md:text-5xl font-black tracking-tighter tabular-nums">Rp {{ number_format($specialOffer->discounted_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="mt-6 inline-flex items-center gap-2 px-4 py-2 bg-red-600 rounded-full text-[9px] font-black uppercase tracking-widest text-white shadow-lg shadow-red-500/30">
                                    <i class="fas fa-tag"></i>
                                    Limited Time Deal
                                </div>
                            </div>

                            <!-- Booking Form -->
                            <div class="p-10 space-y-8">
                                <div class="space-y-6">
                                    <div class="space-y-3">
                                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Pilih Keberangkatan</label>
                                        <div class="relative group">
                                            <input type="date" id="preview_tanggal" 
                                                min="{{ \Carbon\Carbon::parse($specialOffer->valid_from)->format('Y-m-d') }}"
                                                max="{{ \Carbon\Carbon::parse($specialOffer->valid_until)->format('Y-m-d') }}"
                                                class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-[1.5rem] focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-bold text-slate-700 appearance-none">
                                            <i class="fas fa-calendar absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-red-500 transition-colors pointer-events-none"></i>
                                        </div>
                                    </div>

                                    <div class="space-y-3">
                                        <label class="text-[9px] font-black text-slate-400 uppercase tracking-widest ml-1">Jumlah Petualang</label>
                                        <div class="relative group">
                                            <select id="preview_peserta" class="w-full px-6 py-5 bg-slate-50 border border-slate-100 rounded-[1.5rem] focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none transition-all font-bold text-slate-700 appearance-none cursor-pointer">
                                                <option value="">Pilih</option>
                                                @for($i = 1; $i <= 20; $i++)
                                                    <option value="{{ $i }}">{{ $i }} Orang</option>
                                                @endfor
                                            </select>
                                            <i class="fas fa-users absolute right-6 top-1/2 -translate-y-1/2 text-slate-300 group-focus-within:text-red-500 transition-colors pointer-events-none"></i>
                                        </div>
                                    </div>

                                    <button type="button" 
                                       id="btn-promo-booking"
                                       onclick="openInquiryModal()"
                                       class="flex items-center justify-center w-full py-6 bg-red-600 hover:bg-red-700 text-white font-black uppercase tracking-[0.2em] text-[10px] rounded-[2rem] shadow-2xl shadow-red-200 transition-all transform hover:-translate-y-1 active:scale-95">
                                        <i class="fab fa-whatsapp mr-3 text-lg"></i>
                                        Pesan Promo via WhatsApp
                                    </button>
                                </div>

                                <div class="pt-8 border-t border-slate-100 flex items-center justify-between">
                                    <div class="flex gap-4">
                                        <a href="https://wa.me/6282266478147?text={{ urlencode('Halo Admin Jussttrip, saya tertarik dengan promo ' . $specialOffer->title . '. Bisakah saya mendapatkan informasi lebih lanjut?') }}" target="_blank" class="w-10 h-10 bg-green-50 text-green-600 flex items-center justify-center rounded-xl hover:bg-green-600 hover:text-white transition-all shadow-sm">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="tel:+6282266478147" class="w-10 h-10 bg-blue-50 text-blue-600 flex items-center justify-center rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
                                            <i class="fas fa-phone-alt text-sm"></i>
                                        </a>
                                    </div>
                                    <button onclick="copyURL()" class="group flex items-center gap-2 text-[9px] font-black text-slate-400 uppercase tracking-widest hover:text-red-600 transition-colors">
                                        <i class="fas fa-link group-hover:rotate-45 transition-transform"></i>
                                        Copy Link
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Secondary Info -->
                        <div class="px-8 text-center" data-aos="fade-up">
                            <p class="text-xs text-slate-400 font-medium italic">Butuh bantuan khusus? Hubungi tim support kami.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Related Offers -->
    @if(isset($relatedOffers) && $relatedOffers->count() > 0)
    <section class="py-32 bg-slate-50">
        <div class="container px-4 mx-auto">
            <div class="flex items-end justify-between mb-16 px-4">
                <div class="max-w-2xl">
                    <h2 class="text-3xl md:text-5xl font-black text-slate-900 tracking-tight leading-none mb-6">PETUALANGAN LAINNYA</h2>
                    <p class="text-slate-500 font-medium text-lg">Jangan lewatkan penawaran spesial untuk destinasi impian Anda yang lain.</p>
                </div>
                <a href="{{ route('special-offers.index') }}" class="hidden md:flex items-center gap-3 text-sm font-black text-red-600 uppercase tracking-widest hover:gap-5 transition-all">
                    Lihat Semua
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                @foreach($relatedOffers as $related)
                <div class="group relative bg-white rounded-[3rem] border border-slate-100 overflow-hidden hover:shadow-2xl transition-all duration-700 shadow-xl shadow-slate-200/50" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="aspect-[1.2/1] overflow-hidden">
                        @php $relatedImageUrl = $related->display_image_url; @endphp
                        @if($relatedImageUrl)
                            <img src="{{ $relatedImageUrl }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-slate-100"></div>
                        @endif
                    </div>
                    <div class="p-10">
                        <div class="text-[9px] font-black text-red-600 uppercase tracking-[0.3em] mb-4">
                            {{ $related->layanan->lokasi_tujuan ?? 'Destinasi' }}
                        </div>
                        <h3 class="text-xl font-black text-slate-900 mb-6 line-clamp-2 leading-tight group-hover:text-red-600 transition-colors">{{ $related->title }}</h3>
                        <div class="flex items-center justify-between pt-6 border-t border-slate-50">
                            <div class="text-2xl font-black text-slate-900 leading-none">
                                <span class="text-[10px] text-slate-400 block mb-1">HARGA</span>
                                Rp {{ number_format($related->discounted_price, 0, ',', '.') }}
                            </div>
                            <div class="w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center transform group-hover:rotate-45 transition-transform shadow-lg shadow-black/20">
                                <i class="fas fa-arrow-right"></i>
                            </div>
                        </div>
                        <a href="{{ route('special-offers.show', $related->slug) }}" class="absolute inset-0 z-10"></a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- Lightbox -->
    <div id="lightbox" class="fixed inset-0 z-[100] bg-slate-950/98 backdrop-blur-2xl hidden flex flex-col items-center justify-center p-6">
        <button onclick="closeLightbox()" class="absolute top-8 right-8 w-14 h-14 bg-white/5 border border-white/10 text-white flex items-center justify-center rounded-2xl hover:bg-red-600 transition-colors">
            <i class="fas fa-times text-xl"></i>
        </button>
        <div class="max-w-6xl w-full h-full flex flex-col items-center justify-center gap-10">
            <img id="lightbox-img" class="max-w-full max-h-[80vh] object-contain rounded-[2rem] shadow-2xl">
            <h4 id="lightbox-title" class="text-white font-black uppercase tracking-[0.5em] text-xs"></h4>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Countdown Implementation
        const timer = document.getElementById('countdown-timer');
        if (timer) {
            const endTime = new Date(timer.getAttribute('data-end-time')).getTime();
            
            const update = () => {
                const now = new Date().getTime();
                const diff = endTime - now;

                if (diff <= 0) {
                    timer.innerHTML = '<span class="text-red-600 font-black">EXPIRED</span>';
                    return;
                }

                const d = Math.floor(diff / (1000 * 60 * 60 * 24));
                const h = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const m = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
                const s = Math.floor((diff % (1000 * 60)) / 1000);

                document.getElementById('days').innerText = d.toString().padStart(2, '0');
                document.getElementById('hours').innerText = h.toString().padStart(2, '0');
                document.getElementById('minutes').innerText = m.toString().padStart(2, '0');
                document.getElementById('seconds').innerText = s.toString().padStart(2, '0');
            };

            setInterval(update, 1000);
            update();
        }
    });

    function openLightbox(src, title) {
        const el = document.getElementById('lightbox');
        document.getElementById('lightbox-img').src = src;
        document.getElementById('lightbox-title').innerText = title;
        el.classList.remove('hidden');
        el.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox() {
        const el = document.getElementById('lightbox');
        el.classList.add('hidden');
        el.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    function copyURL() {
        navigator.clipboard.writeText(window.location.href);
        const btn = event.currentTarget;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<i class="fas fa-check"></i> Copied!';
        btn.classList.add('text-green-600');
        setTimeout(() => {
            btn.innerHTML = originalText;
            btn.classList.remove('text-green-600');
        }, 2000);
    }

    // Save preview data to sessionStorage before navigating to booking page
    function savePreviewData() {
        const tanggal = document.getElementById('preview_tanggal').value;
        const peserta = document.getElementById('preview_peserta').value;
        
        sessionStorage.setItem('promo_preview_data', JSON.stringify({
            tanggal_keberangkatan: tanggal,
            jumlah_peserta: peserta
        }));
    }
</script>

<style>
    @keyframes slow-zoom {
        0% { transform: scale(1.05); }
        100% { transform: scale(1.15); }
    }
    .animate-slow-zoom {
        animation: slow-zoom 30s infinite alternate ease-in-out;
    }

    /* Selection Color */
    ::selection {
        background: #ef4444;
        color: white;
    }

    /* Custom Input Date Icon Removal */
    input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        cursor: pointer;
    }
</style>

    <!-- Modal Inquiry Pemesanan Promo WhatsApp -->
    <div id="inquiry-modal"
        class="fixed inset-0 z-[120] bg-slate-950/80 backdrop-blur-md flex items-center justify-center p-4 opacity-0 pointer-events-none transition-all duration-300">
        <div id="inquiry-panel"
            class="bg-white rounded-[2.5rem] max-w-2xl w-full max-h-[92vh] overflow-y-auto shadow-2xl border border-slate-100 transform scale-95 transition-all duration-300">
            
            {{-- Modal Header --}}
            <div class="sticky top-0 bg-white/95 backdrop-blur-md px-8 py-6 border-b border-slate-100 flex items-center justify-between z-10">
                <div>
                    <span class="text-[9px] font-black uppercase tracking-widest text-red-600">Pemesanan Promo Tanpa Login</span>
                    <h3 class="text-xl md:text-2xl font-black text-slate-900 leading-tight">{{ $specialOffer->title }}</h3>
                </div>
                <button type="button" onclick="closeInquiryModal()"
                    class="w-10 h-10 rounded-2xl bg-slate-100 hover:bg-red-50 hover:text-red-600 text-slate-500 flex items-center justify-center transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>

            {{-- Form Inquiry --}}
            <form action="{{ route('inquiry.send') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <input type="hidden" name="special_offer_id" value="{{ $specialOffer->id }}">
                @if($specialOffer->layanan)
                    <input type="hidden" name="layanan_id" value="{{ $specialOffer->layanan->layanan_id }}">
                @endif

                {{-- Section 1: Biodata Pemesan --}}
                <div class="space-y-4">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-xs font-black">1</span>
                        <h4 class="text-xs font-black uppercase tracking-widest text-slate-800">Biodata Pemesan</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_lengkap" required
                                placeholder="Contoh: Budi Santoso"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none text-sm font-semibold transition-all">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">
                                Nomor WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="tel" name="nomor_whatsapp" required
                                placeholder="Contoh: 081234567890"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none text-sm font-semibold transition-all">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">
                                Email (Opsional)
                            </label>
                            <input type="email" name="email"
                                placeholder="email@domain.com"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none text-sm font-semibold transition-all">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">
                                Kota / Alamat Asal
                            </label>
                            <input type="text" name="alamat"
                                placeholder="Contoh: Surabaya"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none text-sm font-semibold transition-all">
                        </div>
                    </div>
                </div>

                {{-- Section 2: Jadwal & Peserta --}}
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-xs font-black">2</span>
                        <h4 class="text-xs font-black uppercase tracking-widest text-slate-800">Jadwal & Peserta</h4>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">
                                Tanggal Keberangkatan <span class="text-red-500">*</span>
                            </label>
                            <input type="date" name="tanggal_keberangkatan" id="inquiry-tanggal" required
                                min="{{ \Carbon\Carbon::parse($specialOffer->valid_from)->format('Y-m-d') }}"
                                max="{{ \Carbon\Carbon::parse($specialOffer->valid_until)->format('Y-m-d') }}"
                                class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none text-sm font-semibold transition-all">
                        </div>

                        <div>
                            <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">
                                Jumlah Peserta <span class="text-red-500">*</span>
                            </label>
                            <div class="relative">
                                <select name="jumlah_peserta" id="inquiry-peserta" required onchange="updatePromoPricePreview()"
                                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none text-sm font-semibold transition-all appearance-none cursor-pointer">
                                    @for($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}">{{ $i }} Orang</option>
                                    @endfor
                                </select>
                                <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-slate-400 pointer-events-none text-xs"></i>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Section 3: Add-on & Service Tambahan --}}
                @if($specialOffer->layanan && !empty($specialOffer->layanan->pricing_options))
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                            <span class="w-6 h-6 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-xs font-black">3</span>
                            <h4 class="text-xs font-black uppercase tracking-widest text-slate-800">Add-On & Service Tambahan</h4>
                        </div>
                        <span class="text-[9px] text-slate-400 uppercase font-black tracking-widest">Opsional</span>
                    </div>

                    <div class="space-y-2">
                        @foreach($specialOffer->layanan->pricing_options as $option)
                        <label class="promo-addon-option flex items-center justify-between p-4 rounded-2xl border border-slate-100 hover:border-red-200 hover:bg-red-50/30 cursor-pointer transition-all"
                            data-price="{{ $option['price'] }}">
                            <div class="flex items-center gap-3">
                                <input type="checkbox" name="selected_options[]" value="{{ $option['type'] }}"
                                    class="promo-addon-checkbox w-4 h-4 rounded text-red-600 focus:ring-red-500 border-slate-300"
                                    onchange="updatePromoPricePreview()">
                                <div>
                                    <span class="text-sm font-bold text-slate-800 block">{{ $option['type'] }}</span>
                                    <span class="text-[10px] text-slate-400">Harga per orang</span>
                                </div>
                            </div>
                            <span class="text-sm font-black font-mono text-red-600">
                                +Rp{{ number_format($option['price'], 0, ',', '.') }}
                            </span>
                        </label>
                        @endforeach
                    </div>
                </div>
                @endif

                {{-- Section 4: Request Service Tambahan & Catatan --}}
                <div class="space-y-4 pt-4 border-t border-slate-100">
                    <div class="flex items-center gap-2">
                        <span class="w-6 h-6 rounded-full bg-red-100 text-red-600 flex items-center justify-center text-xs font-black">4</span>
                        <h4 class="text-xs font-black uppercase tracking-widest text-slate-800">Request Service Tambahan</h4>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">
                            Request Khusus (Contoh: Sewa Drone, Upgrade Hotel, Menu Vegetarian, dll.)
                        </label>
                        <textarea name="request_tambahan" rows="2"
                            placeholder="Tuliskan permintaan layanan atau fasilitas khusus yang Anda inginkan..."
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none text-sm transition-all"></textarea>
                    </div>

                    <div>
                        <label class="block text-[10px] font-black uppercase tracking-widest text-slate-500 mb-1">
                            Catatan Lainnya
                        </label>
                        <textarea name="catatan_tambahan" rows="2"
                            placeholder="Catatan tambahan untuk tim Justtrip..."
                            class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-2xl focus:bg-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 outline-none text-sm transition-all"></textarea>
                    </div>
                </div>

                {{-- Estimasi Harga --}}
                <div class="rounded-3xl bg-slate-900 text-white p-6">
                    <p class="text-[9px] font-black uppercase tracking-widest text-red-400 mb-4">Estimasi Total Biaya Promo</p>
                    <div class="space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-slate-300">Harga Promo / orang</span>
                            <span class="font-black font-mono text-red-400" id="promo-preview-base">
                                Rp{{ number_format($specialOffer->discounted_price, 0, ',', '.') }}
                            </span>
                        </div>
                        <div id="promo-preview-addons-row" class="hidden justify-between">
                            <span class="text-slate-300">Add-On</span>
                            <span class="font-black font-mono text-amber-400" id="promo-preview-addons">Rp0</span>
                        </div>
                    </div>
                    <div class="border-t border-white/10 pt-3 mt-4 flex justify-between items-center">
                        <span class="text-white font-black text-sm">Total Estimasi</span>
                        <span class="font-black font-mono text-2xl text-amber-300" id="promo-preview-total">
                            Rp{{ number_format($specialOffer->discounted_price, 0, ',', '.') }}
                        </span>
                    </div>
                    <p class="text-[9px] text-slate-400 text-center mt-3">*Harga final akan dikonfirmasi oleh admin via WhatsApp</p>
                </div>

                {{-- Submit --}}
                <button type="submit"
                    class="w-full py-5 rounded-2xl bg-emerald-500 hover:bg-emerald-600 text-white font-black uppercase tracking-widest text-sm flex items-center justify-center gap-3 shadow-xl shadow-emerald-200 transition-all">
                    <i class="fab fa-whatsapp text-xl"></i>
                    Kirim Pesanan ke WhatsApp Admin
                </button>
                <p class="text-center text-[9px] text-slate-400 font-medium pb-2">
                    Langsung terhubung dengan Admin Justtrip di WhatsApp tanpa perlu login.
                </p>
            </form>
        </div>
    </div>

<script>
// Modal Inquiry Special Offer
const inquiryModal = document.getElementById('inquiry-modal');
const inquiryPanel = document.getElementById('inquiry-panel');
const PROMO_BASE_PRICE = {{ (int) $specialOffer->discounted_price }};

function openInquiryModal() {
    // Sync preview values if filled
    const prevTgl = document.getElementById('preview_tanggal')?.value;
    const prevPeserta = document.getElementById('preview_peserta')?.value;
    if (prevTgl) document.getElementById('inquiry-tanggal').value = prevTgl;
    if (prevPeserta) document.getElementById('inquiry-peserta').value = prevPeserta;

    inquiryModal.classList.remove('opacity-0', 'pointer-events-none');
    inquiryModal.classList.add('opacity-100');
    inquiryPanel.classList.remove('scale-95');
    inquiryPanel.classList.add('scale-100');
    document.body.style.overflow = 'hidden';
    updatePromoPricePreview();
}

function closeInquiryModal() {
    inquiryModal.classList.remove('opacity-100');
    inquiryModal.classList.add('opacity-0', 'pointer-events-none');
    inquiryPanel.classList.remove('scale-100');
    inquiryPanel.classList.add('scale-95');
    document.body.style.overflow = '';
}

document.addEventListener('keydown', (e) => { if (e.key === 'Escape') closeInquiryModal(); });

function updatePromoPricePreview() {
    const peserta = parseInt(document.getElementById('inquiry-peserta')?.value) || 1;
    const totalBase = PROMO_BASE_PRICE * peserta;

    let totalAddons = 0;
    document.querySelectorAll('.promo-addon-checkbox:checked').forEach(cb => {
        const label = cb.closest('.promo-addon-option');
        const price = parseFloat(label?.dataset.price || 0);
        totalAddons += price * peserta;
    });

    const total = totalBase + totalAddons;
    const fmt = (n) => 'Rp' + Math.round(n).toLocaleString('id-ID');

    document.getElementById('promo-preview-base').innerHTML = fmt(PROMO_BASE_PRICE) + '<span class="text-slate-400 text-xs"> / orang</span>';
    document.getElementById('promo-preview-total').textContent = fmt(total);

    const addonRow = document.getElementById('promo-preview-addons-row');
    if (totalAddons > 0) {
        document.getElementById('promo-preview-addons').textContent = fmt(totalAddons);
        addonRow.classList.remove('hidden');
        addonRow.classList.add('flex');
    } else {
        addonRow.classList.add('hidden');
        addonRow.classList.remove('flex');
    }
}
</script>

@endsection