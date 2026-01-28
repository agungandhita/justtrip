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
            @if($specialOffer->main_image)
                <img src="{{ Storage::url($specialOffer->main_image) }}" alt="{{ $specialOffer->title }}" class="object-cover w-full h-full scale-105 animate-slow-zoom">
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

                                    @auth
                                        <a href="{{ route('booking.promo', $specialOffer->slug) }}" 
                                           id="btn-promo-booking"
                                           onclick="savePreviewData()"
                                           class="flex items-center justify-center w-full py-6 bg-red-600 hover:bg-red-700 text-white font-black uppercase tracking-[0.2em] text-[10px] rounded-[2rem] shadow-2xl shadow-red-200 transition-all transform hover:-translate-y-1 active:scale-95">
                                            <i class="fas fa-shopping-cart mr-3"></i>
                                            Lanjutkan Pemesanan
                                        </a>
                                    @else
                                        <a href="{{ route('login', ['redirect' => url()->current()]) }}" 
                                           class="flex items-center justify-center w-full py-6 bg-slate-900 hover:bg-black text-white font-black uppercase tracking-[0.2em] text-[10px] rounded-[2rem] transition-all">
                                            <i class="fas fa-sign-in-alt mr-3"></i>
                                            Login untuk Reservasi
                                        </a>
                                    @endauth
                                </div>

                                <div class="pt-8 border-t border-slate-100 flex items-center justify-between">
                                    <div class="flex gap-4">
                                        <a href="https://wa.me/6281234567890" class="w-10 h-10 bg-green-50 text-green-600 flex items-center justify-center rounded-xl hover:bg-green-600 hover:text-white transition-all shadow-sm">
                                            <i class="fab fa-whatsapp"></i>
                                        </a>
                                        <a href="tel:+6281234567890" class="w-10 h-10 bg-blue-50 text-blue-600 flex items-center justify-center rounded-xl hover:bg-blue-600 hover:text-white transition-all shadow-sm">
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
                        @if($related->main_image)
                            <img src="{{ Storage::url($related->main_image) }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
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
@endsection