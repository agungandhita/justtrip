@extends('Frontend.layouts.main')

@section('container')
    <div class="antialiased text-slate-900 font-['Plus_Jakarta_Sans',sans-serif]">
        <!-- Hero Section: Immersive Design -->
        <section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
            <!-- Dynamic Background -->
            <div class="absolute inset-0 z-0">
                @if($specialOffer->main_image)
                    <img src="{{ Storage::url($specialOffer->main_image) }}" alt="{{ $specialOffer->title }}" class="object-cover w-full h-full scale-105 animate-slow-zoom">
                @else
                    <div class="w-full h-full bg-gradient-to-br from-indigo-900 via-purple-900 to-slate-900"></div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-slate-950/40 to-transparent"></div>
            </div>

            <div class="container relative z-10 px-4 mx-auto pt-20">
                <div class="max-w-4xl mx-auto text-center">
                    <!-- Category & Status Badge -->
                    <div class="flex flex-wrap justify-center items-center gap-3 mb-6" data-aos="fade-down">
                        <span class="px-4 py-1.5 bg-indigo-600 text-white rounded-full text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-indigo-500/30">
                            PENAWARAN KHUSUS
                        </span>
                        @if($specialOffer->discount_percentage)
                            <span class="px-4 py-1.5 bg-rose-500 text-white rounded-full text-[10px] font-black uppercase tracking-[0.2em] shadow-lg shadow-rose-500/30">
                                HEMAT {{ round($specialOffer->discount_percentage) }}%
                            </span>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl md:text-6xl font-black text-white mb-6 leading-tight tracking-tighter" data-aos="zoom-out" data-aos-delay="100">
                        {{ $specialOffer->title }}
                    </h1>

                    <!-- Location / Subtitle -->
                    @if($specialOffer->layanan)
                    <div class="flex items-center justify-center gap-2 mb-8 text-white/80 font-medium" data-aos="fade-up" data-aos-delay="200">
                        <svg class="w-5 h-5 text-rose-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                        <span>{{ $specialOffer->layanan->lokasi_tujuan }}</span>
                        <span class="mx-2 text-white/20">|</span>
                        <span>{{ $specialOffer->layanan->durasi ?? 'Sesuai Paket' }}</span>
                    </div>
                    @endif

                    <!-- Countdown: Premium Glassmorphism -->
                    @php
                        $validUntil = \Carbon\Carbon::parse($specialOffer->valid_until);
                        $now = \Carbon\Carbon::now();
                        $isValid = $validUntil->gt($now);
                    @endphp

                    @if($isValid)
                    <div class="inline-flex flex-col items-center bg-white/5 backdrop-blur-xl border border-white/10 p-6 md:p-8 rounded-[2.5rem] shadow-2xl" data-aos="fade-up" data-aos-delay="300">
                        <p class="text-[10px] font-black uppercase tracking-[0.3em] text-white/60 mb-6">PENAWARAN BERAKHIR DALAM</p>
                        <div id="countdown-timer" class="flex gap-4 md:gap-8" data-end-time="{{ $validUntil->toISOString() }}">
                            <div class="flex flex-col">
                                <span class="text-3xl md:text-5xl font-black text-white" id="days">00</span>
                                <span class="text-[9px] font-black text-white/40 uppercase tracking-widest mt-1">HARI</span>
                            </div>
                            <div class="text-3xl md:text-5xl font-light text-white/20">:</div>
                            <div class="flex flex-col">
                                <span class="text-3xl md:text-5xl font-black text-white" id="hours">00</span>
                                <span class="text-[9px] font-black text-white/40 uppercase tracking-widest mt-1">JAM</span>
                            </div>
                            <div class="text-3xl md:text-5xl font-light text-white/20">:</div>
                            <div class="flex flex-col">
                                <span class="text-3xl md:text-5xl font-black text-white" id="minutes">00</span>
                                <span class="text-[9px] font-black text-white/40 uppercase tracking-widest mt-1">MENIT</span>
                            </div>
                            <div class="text-3xl md:text-5xl font-light text-white/20">:</div>
                            <div class="flex flex-col">
                                <span class="text-3xl md:text-5xl font-black text-white" id="seconds">00</span>
                                <span class="text-[9px] font-black text-white/40 uppercase tracking-widest mt-1">DETIK</span>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="inline-block px-8 py-4 bg-rose-500/10 backdrop-blur-md border border-rose-500/20 rounded-2xl">
                        <span class="text-rose-500 font-black uppercase tracking-[0.2em]">PROMO TELAH BERAKHIR</span>
                    </div>
                    @endif
                </div>
            </div>
        </section>

        <!-- Product Content -->
        <section class="relative bg-slate-50 py-16">
            <div class="container px-4 mx-auto">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-12">
                    
                    <!-- Content Area (Left) -->
                    <div class="lg:col-span-8 space-y-12">
                        <!-- Overview Card -->
                        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 p-8 md:p-12" data-aos="fade-up">
                            <h2 class="text-2xl font-black text-slate-900 mb-8 flex items-center gap-4 uppercase tracking-tight">
                                <span class="w-1.5 h-8 bg-indigo-600 rounded-full"></span>
                                Rincian Penawaran
                            </h2>
                            <div class="prose prose-slate max-w-none prose-p:text-slate-600 prose-p:leading-relaxed prose-p:text-lg">
                                {!! nl2br(e($specialOffer->description)) !!}
                            </div>
                        </div>

                        <!-- Gallery Section -->
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
                        <div class="space-y-6" data-aos="fade-up">
                            <h3 class="text-xl font-black text-slate-900 uppercase tracking-tight flex items-center gap-4">
                                <span class="w-1.5 h-6 bg-indigo-600 rounded-full"></span>
                                Galeri & Visual
                            </h3>
                            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                @foreach($galleryItems as $index => $item)
                                    @php
                                        $imagePath = is_object($item) ? asset('storage/' . $item->image_path) : asset('storage/' . $item);
                                        $title = is_object($item) ? $item->title : "Gallery Image ".($index + 1);
                                    @endphp
                                    <div class="group relative aspect-[4/3] rounded-[2rem] overflow-hidden cursor-pointer shadow-lg shadow-slate-200/50" onclick="openLightbox('{{ $imagePath }}', '{{ $title }}')">
                                        <img src="{{ $imagePath }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                        <div class="absolute inset-0 bg-indigo-900/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                            <div class="w-12 h-12 bg-white/20 backdrop-blur-md rounded-full flex items-center justify-center">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <!-- Terms & Conditions Glass Card -->
                        @if($specialOffer->terms_conditions)
                        <div class="bg-amber-50 rounded-[2.5rem] border border-amber-100 p-8 md:p-12" data-aos="fade-up">
                            <h3 class="text-lg font-black text-amber-900 uppercase tracking-widest mb-6 flex items-center gap-3">
                                <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                Syarat & Ketentuan
                            </h3>
                            <div class="text-amber-800/80 leading-relaxed space-y-2">
                                {!! nl2br(e($specialOffer->terms_conditions)) !!}
                            </div>
                        </div>
                        @endif
                    </div>

                    <!-- Booking Sidebar (Right) -->
                    <div class="lg:col-span-4 lg:relative">
                        <div class="sticky top-24 space-y-8">
                            <!-- Premium Price Card -->
                            <div class="bg-white rounded-[3rem] shadow-2xl shadow-slate-200 border border-slate-100 overflow-hidden" data-aos="fade-left">
                                <div class="bg-indigo-600 p-8 text-center text-white">
                                    <p class="text-[10px] font-black uppercase tracking-[0.3em] opacity-60 mb-2">HARGA MULAI DARI</p>
                                    <div class="flex items-center justify-center gap-3">
                                        <span class="text-lg text-white/40 line-through font-medium">Rp {{ number_format($specialOffer->original_price, 0, ',', '.') }}</span>
                                        <span class="text-3xl md:text-4xl font-black tracking-tighter">Rp {{ number_format($specialOffer->discounted_price, 0, ',', '.') }}</span>
                                    </div>
                                    <div class="mt-4 px-4 py-1.5 bg-white/10 backdrop-blur-md rounded-full inline-block text-[10px] font-black uppercase tracking-widest">
                                        Hemat Rp {{ number_format($specialOffer->original_price - $specialOffer->discounted_price, 0, ',', '.') }}
                                    </div>
                                </div>

                                <div class="p-8 space-y-6">
                                    @if(session('scroll_to_booking') && session('booking_message'))
                                        <div class="p-4 text-xs font-bold text-rose-500 bg-rose-50 border border-rose-100 rounded-2xl">
                                            {{ session('booking_message') }}
                                        </div>
                                    @endif

                                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-5">
                                        @csrf
                                        <input type="hidden" name="special_offer_id" value="{{ $specialOffer->id }}">
                                        <input type="hidden" name="layanan_id" value="{{ $specialOffer->layanan_id }}">

                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Tanggal Keberangkatan</label>
                                            <div class="relative">
                                                <input type="date" name="tanggal_keberangkatan" required
                                                       min="{{ \Carbon\Carbon::parse($specialOffer->valid_from)->format('Y-m-d') }}"
                                                       max="{{ \Carbon\Carbon::parse($specialOffer->valid_until)->format('Y-m-d') }}"
                                                       class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all font-bold text-slate-700">
                                            </div>
                                        </div>

                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Jumlah Peserta</label>
                                            <select name="jumlah_peserta" required class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all font-bold text-slate-700 appearance-none">
                                                <option value="">Pilih</option>
                                                @for($i = 1; $i <= 20; $i++)
                                                    <option value="{{ $i }}">{{ $i }} Orang</option>
                                                @endfor
                                            </select>
                                        </div>

                                        <div class="space-y-2">
                                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Catatan</label>
                                            <textarea name="catatan" rows="3" placeholder="Kebutuhan khusus..." class="w-full px-5 py-4 bg-slate-50 border border-slate-100 rounded-2xl focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 outline-none transition-all font-bold text-slate-700 resize-none"></textarea>
                                        </div>

                                        @auth
                                            <button type="submit" class="w-full py-5 bg-indigo-600 hover:bg-indigo-700 text-white font-black uppercase tracking-widest rounded-3xl shadow-xl shadow-indigo-100 transition-all transform hover:-translate-y-1 active:scale-95">
                                                Reservasi Sekarang
                                            </button>
                                        @else
                                            <a href="{{ route('login') }}" class="block w-full py-5 bg-slate-100 hover:bg-slate-200 text-slate-900 text-center font-black uppercase tracking-widest rounded-3xl transition-all">
                                                Login untuk Book
                                            </a>
                                        @endauth
                                    </form>

                                    <div class="pt-6 border-t border-slate-50 flex items-center justify-center gap-6">
                                        <a href="https://wa.me/6281234567890" class="text-slate-400 hover:text-green-500 transition-colors">
                                            <i class="fab fa-whatsapp text-2xl"></i>
                                        </a>
                                        <a href="tel:+6281234567890" class="text-slate-400 hover:text-blue-500 transition-colors">
                                            <i class="fas fa-phone-alt text-xl"></i>
                                        </a>
                                        <button onclick="copyURL()" class="text-slate-400 hover:text-indigo-500 transition-colors">
                                            <i class="fas fa-link text-xl"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Related Offers Section -->
        @if(isset($relatedOffers) && $relatedOffers->count() > 0)
        <section class="py-24 bg-white border-t border-slate-100">
            <div class="container px-4 mx-auto">
                <div class="text-center max-w-2xl mx-auto mb-16">
                    <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 tracking-tighter">PENAWARAN MENARIK LAINNYA</h2>
                    <p class="text-slate-500 font-medium text-lg">Jelajahi petualangan lain yang tak kalah seru dengan harga spesial.</p>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach($relatedOffers as $related)
                    <div class="group relative bg-white rounded-[2.5rem] border border-slate-100 overflow-hidden hover:shadow-2xl transition-all duration-500 shadow-xl shadow-slate-100/50" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <div class="aspect-[16/10] overflow-hidden">
                            @if($related->main_image)
                                <img src="{{ Storage::url($related->main_image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-slate-200"></div>
                            @endif
                        </div>
                        <div class="p-8">
                            <h3 class="text-xl font-bold text-slate-900 mb-3 line-clamp-2 leading-snug">{{ $related->title }}</h3>
                            <div class="flex items-center justify-between mt-auto">
                                <div class="text-slate-400 text-xs font-black uppercase tracking-widest">
                                    {{ $related->layanan->lokasi_tujuan ?? 'Destinasi' }}
                                </div>
                                <div class="text-indigo-600 font-black">
                                    Rp {{ number_format($related->discounted_price, 0, ',', '.') }}
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
        <div id="lightbox" class="fixed inset-0 z-[100] bg-slate-950/95 backdrop-blur-xl hidden flex flex-col items-center justify-center p-4">
            <button onclick="closeLightbox()" class="absolute top-8 right-8 text-white/50 hover:text-white transition-colors">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
            </button>
            <div class="max-w-5xl w-full h-[80vh] flex flex-col items-center gap-6">
                <img id="lightbox-img" class="max-w-full max-h-full object-contain rounded-2xl shadow-2xl">
                <h4 id="lightbox-title" class="text-white font-black uppercase tracking-[0.2em] text-sm"></h4>
            </div>
        </div>
    </div>

    <!-- Scripts -->
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
                        timer.innerHTML = '<span class="text-rose-500 font-black">EXPIRED</span>';
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
            alert('Link berhasil disalin!');
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800;900&display=swap');
        
        @keyframes slow-zoom {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        .animate-slow-zoom {
            animation: slow-zoom 20s infinite alternate ease-in-out;
        }

        /* Custom scrollbar for a cleaner look */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #94a3b8;
        }
    </style>
@endsection