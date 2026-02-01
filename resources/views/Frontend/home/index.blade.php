@extends('Frontend.layouts.main')

@section('container')

@if($pendingBooking)
    <!-- Payment Notification Banner -->
    <div class="relative bg-orange-600 z-[60] animate-banner-slide-down" id="paymentBanner">
        <div class="max-w-7xl mx-auto px-4 py-3 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <div class="flex-1 flex items-center min-w-0">
                    <span class="flex p-2 rounded-xl bg-orange-700/50 backdrop-blur-sm border border-orange-400/30">
                        <i class="fas fa-credit-card text-white"></i>
                    </span>
                    <p class="ml-3 font-bold text-white truncate text-sm sm:text-base">
                        <span class="md:hidden">Bayar booking #{{ $pendingBooking->booking_id }} segera!</span>
                        <span class="hidden md:inline">Pesanan ke {{ $pendingBooking->layanan->nama_layanan }} sedang menunggu pembayaran. Selesaikan sekarang!</span>
                    </p>
                </div>
                <div class="flex flex-shrink-0 gap-3">
                    <a href="{{ route('booking.show', $pendingBooking->booking_id) }}" class="flex items-center justify-center px-6 py-2 rounded-xl shadow-xl text-xs sm:text-sm font-black text-orange-600 bg-white hover:bg-orange-50 hover:scale-105 transition-all outline-none">
                        Lanjut Bayar
                    </a>
                    <button type="button" onclick="document.getElementById('paymentBanner').remove()" class="flex items-center justify-center p-2 rounded-xl hover:bg-orange-700/50 transition-colors">
                        <i class="fas fa-times text-white"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <style>
        @keyframes banner-slide-down {
            from { transform: translateY(-100%); }
            to { transform: translateY(0); }
        }
        .animate-banner-slide-down {
            animation: banner-slide-down 0.5s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
@endif

<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Slider -->
    <div class="absolute inset-0 z-0" id="heroSlider">
        <!-- Premium Dual Gradient Overlay -->
        <div class="absolute inset-0 bg-gradient-to-b from-black/40 via-blue-950/60 to-black/80 z-10"></div>
        <div class="absolute inset-0 bg-blue-900/10 mix-blend-overlay z-10"></div>

        <!-- Slider Images -->
        <div class="slider-container h-full relative overflow-hidden">
            <div class="slide active bg-cover bg-center" style="background-image: url('{{ asset('image/1-SLIDE.png') }}')"></div>
            <div class="slide bg-cover bg-center" style="background-image: url('{{ asset('image/2-SLIDE.png') }}')"></div>
            <div class="slide bg-cover bg-center" style="background-image: url('{{ asset('image/3-SLIDE.png') }}')"></div>
        </div>

        <!-- Modern Slider Navigation Dots -->
        <div class="absolute bottom-24 sm:bottom-20 left-1/2 transform -translate-x-1/2 z-20 flex space-x-4">
            <button class="slider-dot group relative w-10 h-1.5 rounded-full bg-white/30 transition-all duration-500 overflow-hidden active" data-slide="0">
                <span class="absolute inset-0 bg-white w-0 transition-all duration-500 group-[.active]:w-full"></span>
            </button>
            <button class="slider-dot group relative w-10 h-1.5 rounded-full bg-white/30 transition-all duration-500 overflow-hidden" data-slide="1">
                <span class="absolute inset-0 bg-white w-0 transition-all duration-500 group-[.active]:w-full"></span>
            </button>
            <button class="slider-dot group relative w-10 h-1.5 rounded-full bg-white/30 transition-all duration-500 overflow-hidden" data-slide="2">
                <span class="absolute inset-0 bg-white w-0 transition-all duration-500 group-[.active]:w-full"></span>
            </button>
        </div>

        <!-- Premium Navigation Arrows (Desktop Only) -->
        <button class="hidden md:flex absolute left-8 top-1/2 transform -translate-y-1/2 z-30 w-14 h-14 items-center justify-center rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white hover:bg-white hover:text-blue-900 transition-all duration-500 group" id="prevSlide">
            <svg class="w-6 h-6 transform transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button class="hidden md:flex absolute right-8 top-1/2 transform -translate-y-1/2 z-30 w-14 h-14 items-center justify-center rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white hover:bg-white hover:text-blue-900 transition-all duration-500 group" id="nextSlide">
            <svg class="w-6 h-6 transform transition-transform group-hover:translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <!-- Hero Content -->
    <div class="relative z-20 w-full px-4 max-w-7xl mx-auto pt-20 md:pt-0">
        <div class="max-w-4xl mx-auto text-center mb-4 md:mb-10">
            <div class="flex flex-col items-center">
                <div class="relative inline-block mt-12" data-aos="fade-down" data-aos-duration="1200">
                    <img src="{{ asset('image/TITLE.png') }}" 
                         alt="Justtrip Title" 
                         class="w-full max-w-[200px] sm:max-w-[240px] md:max-w-[280px] h-auto drop-shadow-[0_5px_10px_rgba(0,0,0,0.2)] hover:scale-105 transition-all duration-500">
                </div>
                <p class="text-sm sm:text-base md:text-lg text-blue-50/90 font-medium max-w-2xl mx-auto leading-relaxed" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1000">
                    Temukan destinasi impian Anda dan nikmati perjalanan tak terlupakan dengan pelayanan terbaik dari <span class="text-orange-400 font-bold">Justtrip</span>.
                </p>
            </div>            
            <div class="mt-4 flex flex-wrap gap-3 justify-center" data-aos="zoom-in" data-aos-delay="400">
                <a href="{{ route('special-offers.index') }}" class="group relative px-5 sm:px-8 py-2.5 sm:py-3.5 bg-orange-500 rounded-xl text-white font-bold text-sm sm:text-base transition-all duration-500 hover:bg-orange-600 hover:shadow-[0_0_20px_rgba(249,115,22,0.4)] overflow-hidden">
                    <span class="relative z-10 flex items-center">
                        <i class="fas fa-tags mr-2 group-hover:rotate-12 transition-transform"></i>
                        Promo Spesial
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-transparent via-white/20 to-transparent -translate-x-full group-hover:translate-x-full transition-transform duration-1000"></div>
                </a>
                <a href="{{ route('packages.index') }}" class="px-5 sm:px-8 py-2.5 sm:py-3.5 bg-white/10 backdrop-blur-md border border-white/30 rounded-xl text-white font-bold text-sm sm:text-base hover:bg-white hover:text-blue-900 transition-all duration-500">
                    <span class="flex items-center">
                        <i class="fas fa-plane mr-2"></i>
                        Jelajahi Paket
                    </span>
                </a>
            </div>
        </div>

        <!-- Premium Glassmorphism Search Form -->
        <div class="max-w-5xl mx-auto" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1200">
            <div class="relative group">
                <!-- Background Glow Effect -->
                <div class="absolute -inset-1 bg-gradient-to-r from-orange-500/20 to-blue-500/20 rounded-[2.5rem] blur-2xl opacity-75 group-hover:opacity-100 transition duration-1000"></div>
                
                <div class="relative bg-white/10 backdrop-blur-2xl border border-white/20 rounded-[2.5rem] p-5 sm:p-6 md:p-8 shadow-2xl transition-all duration-500 hover:bg-white/[0.15]">
                    <h2 class="text-lg sm:text-xl font-bold text-white mb-6 text-center tracking-wide">Cari Perjalanan Impian Anda</h2>
                    
                    <form action="{{ route('guest-booking.search') }}" method="POST">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-12 gap-4 lg:gap-6">
                            <!-- Destinasi -->
                            <div class="md:col-span-4 group/input">
                                <label class="block text-blue-100 text-xs font-bold uppercase tracking-wider mb-2 ml-1">Destinasi</label>
                                <div class="relative">
                                    <input type="text" name="destinasi" placeholder="Mau ke mana?" value="{{ old('destinasi') }}" 
                                        class="w-full bg-white/10 border border-white/10 rounded-2xl py-3.5 sm:py-4 pl-12 pr-4 text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:bg-white/20 transition-all" required>
                                    <i class="fas fa-map-marker-alt absolute left-4 top-1/2 -translate-y-1/2 text-orange-400 group-hover/input:scale-110 transition-transform"></i>
                                </div>
                                @error('destinasi')
                                    <p class="mt-2 text-xs text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Tanggal -->
                            <div class="md:col-span-4 group/input">
                                <label class="block text-blue-100 text-xs font-bold uppercase tracking-wider mb-2 ml-1">Tanggal Keberangkatan</label>
                                <div class="relative">
                                    <input type="date" name="departure_date" value="{{ old('departure_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}"
                                        class="w-full bg-white/10 border border-white/10 rounded-2xl py-3.5 sm:py-4 pl-12 pr-4 text-white placeholder-blue-200/50 focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:bg-white/20 transition-all color-scheme-dark" required>
                                    <i class="fas fa-calendar-alt absolute left-4 top-1/2 -translate-y-1/2 text-orange-400 group-hover/input:scale-110 transition-transform"></i>
                                </div>
                                @error('departure_date')
                                    <p class="mt-2 text-xs text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Peserta -->
                            <div class="md:col-span-4 group/input">
                                <label class="block text-blue-100 text-xs font-bold uppercase tracking-wider mb-2 ml-1">Jumlah Peserta</label>
                                <div class="relative lg:flex lg:gap-4">
                                    <div class="relative flex-grow mb-4 lg:mb-0">
                                        <select name="participants" class="w-full bg-white/10 border border-white/10 rounded-2xl py-3.5 sm:py-4 pl-12 pr-10 text-white appearance-none focus:outline-none focus:ring-2 focus:ring-orange-500/50 focus:bg-white/20 transition-all cursor-pointer" required>
                                            <option value="" class="bg-blue-900">Pilih orang</option>
                                            <option value="1" {{ old('participants') == '1' ? 'selected' : '' }} class="bg-blue-900">1 Orang</option>
                                            <option value="2" {{ old('participants') == '2' ? 'selected' : '' }} class="bg-blue-900">2 Orang</option>
                                            <option value="3-5" {{ old('participants') == '3-5' ? 'selected' : '' }} class="bg-blue-900">3-5 Orang</option>
                                            <option value="6+" {{ old('participants') == '6+' ? 'selected' : '' }} class="bg-blue-900">6+ Orang</option>
                                        </select>
                                        <i class="fas fa-users absolute left-4 top-1/2 -translate-y-1/2 text-orange-400 group-hover/input:scale-110 transition-transform"></i>
                                        <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-white/50 text-xs pointer-events-none"></i>
                                    </div>
                                    
                                    <button type="submit" class="w-full lg:w-auto px-8 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-black rounded-2xl transition-all duration-300 transform hover:scale-[1.02] active:scale-95 shadow-lg flex items-center justify-center whitespace-nowrap min-w-[140px] py-3.5 sm:py-0">
                                        <i class="fas fa-search mr-2"></i>
                                        Cari
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Animated Scroll Hint -->
    <a href="#why-choose" class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20 flex flex-col items-center group">
        <span class="text-white/50 text-[10px] uppercase tracking-[0.2em] font-bold mb-2 group-hover:text-white transition-colors">Scroll</span>
        <div class="w-6 h-10 border-2 border-white/30 rounded-full flex justify-center p-1 group-hover:border-white transition-colors">
            <div class="w-1.5 h-1.5 bg-white rounded-full animate-scroll"></div>
        </div>
    </a>
</section>

<style>
@keyframes scroll {
    0% { transform: translateY(0); opacity: 1; }
    100% { transform: translateY(18px); opacity: 0; }
}
.animate-scroll {
    animation: scroll 2s cubic-bezier(.76,.11,.24,.88) infinite;
}
.color-scheme-dark::-webkit-calendar-picker-indicator {
    filter: invert(1);
    cursor: pointer;
}
.slide {
    position: absolute;
    inset: 0;
    opacity: 0;
    transition: opacity 1s ease-in-out, transform 10s ease-in-out;
    transform: scale(1.1);
}
.slide.active {
    opacity: 1;
    transform: scale(1);
}
</style>

</section>

<!-- Why Choose JustTrip Section -->
<section id="why-choose" class="bg-white overflow-hidden scroll-mt-20">
    <div class="flex flex-col lg:flex-row">
        <!-- Left Side: Copywriting (10 Points) -->
        <div class="w-full lg:w-3/5 bg-[#1a56db] p-8 md:p-12 lg:p-16 text-white relative flex flex-col justify-center">
            <!-- Decorative Grid Pattern -->
            <div class="absolute inset-0 opacity-[0.08]" style="background-image: linear-gradient(#fff 1px, transparent 1px), linear-gradient(90deg, #fff 1px, transparent 1px); background-size: 40px 40px;"></div>
            
            <div class="relative z-10" data-aos="fade-right">
                <h2 class="text-2xl md:text-3xl font-black mb-10 tracking-tight uppercase">Kenapa Memilih <span class="text-orange-400">JustTrip?</span></h2>
                
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-8 gap-y-8">
                    @php
                        $points = [
                            ['title' => 'Sudah Berlegalitas PT', 'desc' => 'Keamanan transaksi terjamin dengan payung hukum resmi PT Justtrip Indonesia.', 'icon' => 'fa-shield-alt'],
                            ['title' => 'Tim Bersertifikat LSP & BNSP', 'desc' => 'Dikawal oleh tenaga ahli yang kompeten dan diakui secara nasional.', 'icon' => 'fa-user-check'],
                            ['title' => 'Trip Penuh Kesan & Makna', 'desc' => 'Fokus membangun hubungan dan kebersamaan, bukan sekadar jalan-jalan.', 'icon' => 'fa-heart'],
                            ['title' => 'Jaminan & Keuntungan di MOU', 'desc' => 'Kepastian layanan tertulis jelas dalam kontrak kerja sama yang transparan.', 'icon' => 'fa-file-signature'],
                            ['title' => 'Tenaga Ahli Berkompeten', 'desc' => 'Tim fasilitator berpengalaman yang ahli di bidang manajemen acara dan SDM.', 'icon' => 'fa-users'],
                            ['title' => 'Fleksibel & Customizable', 'desc' => 'Program dapat disesuaikan sepenuhnya dengan budget dan kebutuhan Anda.', 'icon' => 'fa-adjust'],
                            ['title' => 'Trip Kekinian & Up to Date', 'desc' => 'Destinasi dan konten acara yang selalu mengikuti tren terbaru (Instagrammable).', 'icon' => 'fa-camera-retro'],
                            ['title' => 'Perencanaan Sistematis', 'desc' => 'Alur kerja yang rapi dan laporan berkala yang transparan kepada klien.', 'icon' => 'fa-tasks'],
                            ['title' => 'Mitra Terpercaya', 'desc' => 'Bekerja sama dengan vendor hotel, transport, dan katering pilihan terbaik.', 'icon' => 'fa-handshake'],
                            ['title' => 'Harga Dapat Dinegosiasi', 'desc' => 'Penawaran harga yang kompetitif dan fleksibel sesuai kebutuhan paket Anda.', 'icon' => 'fa-tags'],
                        ];
                    @endphp

                    @foreach($points as $point)
                    <div class="flex gap-4 group">
                        <div class="flex-shrink-0 w-10 h-10 border border-white/20 rounded-lg flex items-center justify-center bg-white/5 group-hover:bg-orange-500 group-hover:border-orange-500 transition-all duration-300">
                            <i class="fas {{ $point['icon'] }} text-sm text-orange-400 group-hover:text-white transition-colors"></i>
                        </div>
                        <div class="flex flex-col">
                            <h3 class="font-bold text-sm md:text-base text-white mb-1 group-hover:text-orange-400 transition-colors uppercase tracking-wide">{{ $point['title'] }}</h3>
                            <p class="text-blue-100/70 text-xs leading-relaxed">{{ $point['desc'] }}</p>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Right Side: Visual Image/Slider -->
        <div class="w-full lg:w-2/5 relative min-h-[450px] lg:min-h-full group overflow-hidden">
            <!-- Text Overlay on Image -->
            <div class="absolute inset-x-0 top-0 p-8 z-20 text-center bg-gradient-to-b from-black/60 to-transparent">
                <p class="text-orange-400 font-bold text-xs md:text-sm uppercase tracking-[0.3em] mb-1">Kenapa Harus Pilih</p>
                <h2 class="text-white text-3xl md:text-4xl font-black italic tracking-tighter uppercase mb-1">JustTrip Tour</h2>
                <p class="text-orange-400 font-bold text-xs md:text-sm tracking-wide">Sebagai Travel & Event Organizer Anda?</p>
            </div>

            <!-- Slider Container -->
            <div class="absolute inset-0">
                @foreach(range(1, 8) as $i)
                <div class="why-slide-alt absolute inset-0 opacity-0 transition-opacity duration-1000 ease-in-out {{ $i == 1 ? 'active opacity-100' : '' }}">
                    <img src="{{ asset('image/' . $i . '.jpg') }}" alt="JustTrip Moment {{ $i }}" class="w-full h-full object-cover grayscale-[15%] group-hover:grayscale-0 transition-all duration-700">
                    <div class="absolute inset-0 bg-blue-900/10 mix-blend-multiply"></div>
                </div>
                @endforeach
            </div>

            <!-- Slider Indicators -->
            <div class="absolute bottom-6 left-1/2 -translate-x-1/2 flex items-center gap-2 z-20">
                @foreach(range(1, 8) as $i)
                <button class="why-dot-alt h-1 rounded-full bg-white/30 transition-all duration-300 {{ $i == 1 ? 'active bg-orange-500 w-8' : 'w-2' }}" data-index="{{ $i - 1 }}"></button>
                @endforeach
            </div>
        </div>
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const slides = document.querySelectorAll('.why-slide-alt');
        const dots = document.querySelectorAll('.why-dot-alt');
        let currentSlide = 0;
        let slideInterval;

        function showSlide(index) {
            slides.forEach((s, i) => {
                s.classList.toggle('active', i === index);
                s.style.opacity = i === index ? '1' : '0';
            });
            dots.forEach((d, i) => {
                d.classList.toggle('active', i === index);
                if (i === index) {
                    d.classList.add('bg-orange-500', 'w-8');
                    d.classList.remove('bg-white/30', 'w-2');
                } else {
                    d.classList.add('bg-white/30', 'w-2');
                    d.classList.remove('bg-orange-500', 'w-8');
                }
            });
        }

        function nextSlide() {
            currentSlide = (currentSlide + 1) % slides.length;
            showSlide(currentSlide);
        }

        function startAutoplay() {
            stopAutoplay();
            slideInterval = setInterval(nextSlide, 4000);
        }

        function stopAutoplay() {
            if (slideInterval) clearInterval(slideInterval);
        }

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                currentSlide = index;
                showSlide(currentSlide);
                startAutoplay();
            });
        });

        startAutoplay();
    });
</script>

<!-- Customer Reviews Section -->
@if(isset($reviews) && $reviews->count() > 0)
<section id="customer-reviews" class="py-12 sm:py-16 md:py-20 bg-gradient-to-br from-teal-50 to-cyan-50">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-8 sm:mb-12 md:mb-16" data-aos="fade-up">
            <p class="text-xs sm:text-sm font-semibold text-teal-600 uppercase tracking-widest mb-2">Testimoni Pelanggan</p>
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-3 sm:mb-4">Apa Kata Mereka?</h2>
            <p class="text-sm sm:text-base md:text-lg text-gray-600 max-w-2xl mx-auto">Pengalaman nyata dari pelanggan yang telah menikmati perjalanan bersama JustTrip</p>
        </div>

        <!-- Reviews Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 sm:gap-8">
            @foreach($reviews as $index => $review)
            <div class="group bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 overflow-hidden" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <!-- Card Content -->
                <div class="p-6 sm:p-8">
                    <!-- Quote Icon -->
                    <div class="mb-4">
                        <svg class="w-8 h-8 sm:w-10 sm:h-10 text-teal-400/50" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M14.017 21v-7.391c0-5.704 3.731-9.57 8.983-10.609l.995 2.151c-2.432.917-3.995 3.638-3.995 5.849h4v10h-9.983zm-14.017 0v-7.391c0-5.704 3.748-9.57 9-10.609l.996 2.151c-2.433.917-3.996 3.638-3.996 5.849h3.983v10h-9.983z"/>
                        </svg>
                    </div>
                    
                    <!-- Rating -->
                    <div class="mb-4">
                        <span class="text-yellow-400 text-lg sm:text-xl">{{ $review->formatted_rating }}</span>
                    </div>

                    <!-- Review Content -->
                    <p class="text-gray-700 text-sm sm:text-base leading-relaxed mb-6 line-clamp-4">"{{ $review->content }}"</p>

                    <!-- Customer Info -->
                    <div class="flex items-center border-t border-gray-100 pt-6">
                        <img src="{{ $review->avatar_url }}" alt="{{ $review->customer_name }}" class="w-12 h-12 sm:w-14 sm:h-14 rounded-full object-cover border-2 border-teal-100 mr-4 group-hover:border-teal-400 transition-colors">
                        <div class="flex-1 min-w-0">
                            <h4 class="font-bold text-gray-800 text-sm sm:text-base truncate">{{ $review->customer_name }}</h4>
                            @if($review->customer_position)
                                <p class="text-gray-500 text-xs sm:text-sm truncate">{{ $review->customer_position }}</p>
                            @endif
                        </div>
                    </div>

                    <!-- Destination Badge -->
                    <div class="mt-4">
                        <span class="inline-flex items-center gap-1.5 bg-gradient-to-r from-teal-50 to-cyan-50 text-teal-700 px-3 py-1.5 rounded-full text-xs sm:text-sm font-medium border border-teal-100">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            {{ $review->destination }}
                        </span>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Partner Slider Section -->
<section id="partner-slider" class="py-10 sm:py-12 overflow-hidden">
    <div class="container mx-auto px-4 mb-6 text-center" data-aos="fade-up">
        <p class="text-xs sm:text-sm font-semibold text-teal-600 uppercase tracking-widest mb-2">Our Trusted Partners</p>
        <h2 class="text-xl sm:text-2xl md:text-3xl font-bold text-gray-800">Bekerja Sama Dengan Yang Terbaik</h2>
    </div>

    <div class="partner-marquee">
        <div class="partner-track">
            @php
                $partners = [
                    'img_0353.png', 'img_0354.jpg', 'img_0355.png', 'img_0356.png',
                    'img_0357.png', 'img_0358.jpg', 'img_0359.png', 'img_0360.png',
                    'img_0361.png', 'img_0362.png', 'img_0363.png', 'img_0364.png',
                    'img_0365.png', 'img_0366.png', 'img_0367.jpg', 'img_0368.jpg'
                ];
            @endphp
            
            {{-- Original Set --}}
            @foreach($partners as $partner)
                <img src="{{ asset('img/' . $partner) }}" alt="Partner" class="partner-logo">
            @endforeach
            
            {{-- Duplicate for seamless loop --}}
            @foreach($partners as $partner)
                <img src="{{ asset('img/' . $partner) }}" alt="Partner" class="partner-logo">
            @endforeach
        </div>
    </div>
</section>

<style>
.partner-marquee {
    overflow: hidden;
    width: 100%;
}

.partner-track {
    display: flex;
    gap: 2rem;
    animation: scroll-left 25s linear infinite;
    width: max-content;
}

.partner-logo {
    height: 40px;
    width: auto;
    object-fit: contain;
    flex-shrink: 0;
    transition: transform 0.3s ease;
}

.partner-logo:hover {
    transform: scale(1.1);
}

.partner-marquee:hover .partner-track {
    animation-play-state: paused;
}

@keyframes scroll-left {
    0% { transform: translateX(0); }
    100% { transform: translateX(-50%); }
}

@media (min-width: 640px) {
    .partner-logo { height: 48px; }
    .partner-track { gap: 3rem; }
}

@media (min-width: 768px) {
    .partner-logo { height: 56px; }
    .partner-track { gap: 4rem; }
}
</style>

<!-- Featured Gallery Section -->
@if($featuredGallery->count() > 0)
<section id="featured-gallery" class="py-12 sm:py-16 md:py-20 bg-gradient-to-br from-slate-50 to-gray-100">
    <div class="container mx-auto px-4">
        <!-- Section Header -->
        <div class="text-center mb-8 sm:mb-12 md:mb-16" data-aos="fade-up">
            <p class="text-xs sm:text-sm font-semibold text-teal-600 uppercase tracking-widest mb-2">Dokumentasi Perjalanan</p>
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-3 sm:mb-4">Galeri Momen Terbaik</h2>
            <p class="text-sm sm:text-base md:text-lg text-gray-600 max-w-2xl mx-auto">Kumpulan momen-momen tak terlupakan dari setiap perjalanan bersama JustTrip</p>
        </div>

        <!-- Gallery Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-3 sm:gap-4 md:gap-5" data-aos="fade-up" data-aos-delay="100">
            @foreach($featuredGallery as $index => $gallery)
                <a href="{{ route('gallery.show', $gallery->slug) }}" 
                   class="gallery-card group relative overflow-hidden rounded-xl sm:rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-1 {{ $index === 0 ? 'sm:col-span-2 sm:row-span-2' : '' }}">
                    <!-- Image -->
                    @if($gallery->main_image)
                        <img src="{{ asset('storage/' . $gallery->main_image) }}" 
                             alt="{{ $gallery->title }}" 
                             class="w-full {{ $index === 0 ? 'h-48 sm:h-full sm:min-h-[400px]' : 'h-40 sm:h-48 md:h-52' }} object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full {{ $index === 0 ? 'h-48 sm:h-full sm:min-h-[400px]' : 'h-40 sm:h-48 md:h-52' }} bg-gradient-to-br from-teal-400 to-cyan-500 flex items-center justify-center">
                            <svg class="w-12 h-12 text-white/50" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                    @endif

                    <!-- Gradient Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/30 to-transparent opacity-60 group-hover:opacity-90 transition-opacity duration-300"></div>

                    <!-- Content Overlay -->
                    <div class="absolute bottom-0 left-0 right-0 p-3 sm:p-4 md:p-5 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                        <h3 class="text-white font-bold text-sm sm:text-base md:text-lg mb-1 line-clamp-2">{{ $gallery->title }}</h3>
                        @if($gallery->destination)
                            <div class="flex items-center text-white/80 text-xs sm:text-sm">
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <span>{{ $gallery->destination }}</span>
                            </div>
                        @endif
                        
                        <!-- View Button (visible on hover) -->
                        <div class="mt-2 sm:mt-3 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="inline-flex items-center text-xs sm:text-sm text-teal-300 font-medium">
                                Lihat Galeri
                                <svg class="w-3 h-3 sm:w-4 sm:h-4 ml-1 transform group-hover:translate-x-1 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                </svg>
                            </span>
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- View All Button -->
        <div class="text-center mt-8 sm:mt-10 md:mt-12" data-aos="fade-up" data-aos-delay="200">
            <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white font-bold py-3 sm:py-4 px-6 sm:px-8 rounded-xl text-sm sm:text-base transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
                Lihat Semua Galeri
            </a>
        </div>
    </div>
</section>
@endif

@if($testimonials->count() > 0)
<!-- Testimonials Section -->
<section class="py-12 sm:py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8 sm:mb-12 md:mb-16" data-aos="fade-up">
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-2 sm:mb-3 md:mb-4">Testimoni Pelanggan</h2>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-600">Pengalaman nyata dari pelanggan yang telah menggunakan layanan sewa bus Justtrip</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($testimonials as $testimonial)
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="{{ ($loop->index + 1) * 100 }}">
                    <div class="flex items-center mb-6">
                        <img src="{{ $testimonial->featured_image ? asset('storage/' . $testimonial->featured_image) : 'https://ui-avatars.com/api/?name='.urlencode($testimonial->title) }}" alt="{{ $testimonial->title }}" class="w-16 h-16 rounded-full object-cover mr-4">
                        <div>
                            <h4 class="font-bold text-gray-800">{{ $testimonial->title }}</h4>
                            <p class="text-gray-600">{{ $testimonial->excerpt ?? 'Pelanggan Setia' }}</p>
                        </div>
                    </div>
                    <div class="flex mb-4">
                        <span class="text-yellow-400">★★★★★</span>
                    </div>
                    <p class="text-gray-700 italic">"{{ Str::limit(strip_tags($testimonial->content), 150) }}"</p>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($popularPackages->count() > 0)
<!-- Destinations Section -->
<section class="py-12 sm:py-16 md:py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8 sm:mb-12 md:mb-16" data-aos="fade-up">
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-2 sm:mb-3 md:mb-4">Destinasi Populer</h2>
            <p class="text-sm sm:text-base md:text-lg lg:text-xl text-gray-600 max-w-3xl mx-auto">Jelajahi destinasi menakjubkan dengan paket tour terbaik dari Justtrip</p>
        </div>

        <!-- Tabs -->
        <div class="flex justify-center mb-12" data-aos="fade-up" data-aos-delay="100">
            <div class="bg-white rounded-full p-2 shadow-lg flex flex-wrap justify-center gap-1">
                <button class="tab-btn active px-4 sm:px-6 py-2 sm:py-3 rounded-full font-semibold transition-all duration-300 text-sm sm:text-base" data-tab="open-trip">Open Trip</button>
                <button class="tab-btn px-4 sm:px-6 py-2 sm:py-3 rounded-full font-semibold transition-all duration-300 text-sm sm:text-base" data-tab="corporate">Corporate Trip</button>
                <button class="tab-btn px-4 sm:px-6 py-2 sm:py-3 rounded-full font-semibold transition-all duration-300 text-sm sm:text-base" data-tab="edu">Edu Trip</button>
            </div>
        </div>

        @php
            $openTripPackages = $popularPackages->filter(fn($p) => $p->jenis_layanan === 'open_trip');
            $corporateTripPackages = $popularPackages->filter(fn($p) => $p->jenis_layanan === 'corporate_trip');
            $eduTripPackages = $popularPackages->filter(fn($p) => $p->jenis_layanan === 'edu_trip');
        @endphp

        <!-- Open Trip Destinations -->
        <div id="open-trip" class="tab-content active">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
                @forelse($openTripPackages->take(3) as $index => $pkg)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="relative overflow-hidden">
                        @if($pkg->gambar_utama)
                            <img src="{{ asset('storage/' . $pkg->gambar_utama) }}" alt="{{ $pkg->nama_layanan }}" class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $pkg->nama_layanan }}" class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        @endif
                        <div class="absolute top-3 left-3 sm:top-4 sm:left-4">
                            <span class="bg-gradient-to-r from-teal-500 to-teal-600 text-white px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-semibold">Open Trip</span>
                        </div>
                        @if($pkg->hasActiveSpecialOffers())
                            <div class="absolute top-3 right-3 sm:top-4 sm:right-4">
                                <span class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-semibold">Promo</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-4 sm:p-5 md:p-6">
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-800 mb-1 sm:mb-2">{{ $pkg->nama_layanan }}</h3>
                        <p class="text-xs sm:text-sm md:text-base text-gray-600 mb-3 sm:mb-4">{{ $pkg->durasi_format }} • {{ $pkg->lokasi_tujuan }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                @php $offer = $pkg->getCurrentSpecialOffer(); @endphp
                                @if($offer)
                                    <span class="text-gray-400 line-through text-xs sm:text-sm md:text-base">Rp {{ number_format($pkg->harga_mulai, 0, ',', '.') }}</span>
                                    <span class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600 ml-2">Rp {{ number_format($pkg->getDiscountedPrice(), 0, ',', '.') }}</span>
                                @else
                                    <span class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600">Rp {{ number_format($pkg->harga_mulai, 0, ',', '.') }}</span>
                                @endif
                                <span class="text-gray-500 text-xs sm:text-sm">/person</span>
                            </div>
                            <a href="{{ route('packages.show', $pkg->slug) }}" class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-3 py-1 sm:px-4 sm:py-2 md:px-6 md:py-2 rounded-full text-xs sm:text-sm md:text-base font-semibold transition-all duration-300 transform hover:scale-105">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-gray-600">Belum ada paket Open Trip populer.</div>
                @endforelse
            </div>
        </div>

        <!-- Corporate Trip Destinations -->
        <div id="corporate" class="tab-content hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
                @forelse($corporateTripPackages->take(3) as $index => $pkg)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="relative overflow-hidden">
                        @if($pkg->gambar_utama)
                            <img src="{{ asset('storage/' . $pkg->gambar_utama) }}" alt="{{ $pkg->nama_layanan }}" class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $pkg->nama_layanan }}" class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        @endif
                        <div class="absolute top-3 left-3 sm:top-4 sm:left-4">
                            <span class="bg-gradient-to-r from-indigo-500 to-indigo-600 text-white px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-semibold">Corporate</span>
                        </div>
                        @if($pkg->hasActiveSpecialOffers())
                            <div class="absolute top-3 right-3 sm:top-4 sm:right-4">
                                <span class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-semibold">Promo</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-4 sm:p-5 md:p-6">
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-800 mb-1 sm:mb-2">{{ $pkg->nama_layanan }}</h3>
                        <p class="text-xs sm:text-sm md:text-base text-gray-600 mb-3 sm:mb-4">{{ $pkg->durasi_format }} • {{ $pkg->lokasi_tujuan }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                @php $offer = $pkg->getCurrentSpecialOffer(); @endphp
                                @if($offer)
                                    <span class="text-gray-400 line-through text-xs sm:text-sm md:text-base">Rp {{ number_format($pkg->harga_mulai, 0, ',', '.') }}</span>
                                    <span class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600 ml-2">Rp {{ number_format($pkg->getDiscountedPrice(), 0, ',', '.') }}</span>
                                @else
                                    <span class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600">Rp {{ number_format($pkg->harga_mulai, 0, ',', '.') }}</span>
                                @endif
                                <span class="text-gray-500 text-xs sm:text-sm">/person</span>
                            </div>
                            <a href="{{ route('packages.show', $pkg->slug) }}" class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-3 py-1 sm:px-4 sm:py-2 md:px-6 md:py-2 rounded-full text-xs sm:text-sm md:text-base font-semibold transition-all duration-300 transform hover:scale-105">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-gray-600">Belum ada paket Corporate Trip populer.</div>
                @endforelse
            </div>
        </div>

        <!-- Edu Trip Destinations -->
        <div id="edu" class="tab-content hidden">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 md:gap-8">
                @forelse($eduTripPackages->take(3) as $index => $pkg)
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                    <div class="relative overflow-hidden">
                        @if($pkg->gambar_utama)
                            <img src="{{ asset('storage/' . $pkg->gambar_utama) }}" alt="{{ $pkg->nama_layanan }}" class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $pkg->nama_layanan }}" class="w-full h-48 sm:h-56 md:h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        @endif
                        <div class="absolute top-3 left-3 sm:top-4 sm:left-4">
                            <span class="bg-gradient-to-r from-amber-500 to-amber-600 text-white px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-semibold">Edu Trip</span>
                        </div>
                        @if($pkg->hasActiveSpecialOffers())
                            <div class="absolute top-3 right-3 sm:top-4 sm:right-4">
                                <span class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-2 py-1 sm:px-3 sm:py-1 rounded-full text-xs sm:text-sm font-semibold">Promo</span>
                            </div>
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-4 sm:p-5 md:p-6">
                        <h3 class="text-base sm:text-lg md:text-xl font-bold text-gray-800 mb-1 sm:mb-2">{{ $pkg->nama_layanan }}</h3>
                        <p class="text-xs sm:text-sm md:text-base text-gray-600 mb-3 sm:mb-4">{{ $pkg->durasi_format }} • {{ $pkg->lokasi_tujuan }}</p>
                        <div class="flex items-center justify-between">
                            <div>
                                @php $offer = $pkg->getCurrentSpecialOffer(); @endphp
                                @if($offer)
                                    <span class="text-gray-400 line-through text-xs sm:text-sm md:text-base">Rp {{ number_format($pkg->harga_mulai, 0, ',', '.') }}</span>
                                    <span class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600 ml-2">Rp {{ number_format($pkg->getDiscountedPrice(), 0, ',', '.') }}</span>
                                @else
                                    <span class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600">Rp {{ number_format($pkg->harga_mulai, 0, ',', '.') }}</span>
                                @endif
                                <span class="text-gray-500 text-xs sm:text-sm">/person</span>
                            </div>
                            <a href="{{ route('packages.show', $pkg->slug) }}" class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-3 py-1 sm:px-4 sm:py-2 md:px-6 md:py-2 rounded-full text-xs sm:text-sm md:text-base font-semibold transition-all duration-300 transform hover:scale-105">Detail</a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full text-center text-gray-600">Belum ada paket Edu Trip populer.</div>
                @endforelse
            </div>
        </div>

        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('packages.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl inline-block">
                Lihat Semua Paket Tour
            </a>
        </div>
    </div>
</section>
@endif


@if($featuredOffers->count() > 0)
{{-- Special Offers Section --}}
<section class="py-12 bg-gradient-to-br from-orange-50 to-yellow-50">
    <div class="container mx-auto px-4">

        {{-- Section Header --}}
        <div class="text-center mb-10">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-3">
                Penawaran Spesial
            </h2>
            <p class="text-gray-600 text-lg">
                Jangan lewatkan promo terbatas dan penawaran eksklusif dari JustTrip
            </p>
        </div>

        {{-- Offers Grid --}}
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">

            @foreach($featuredOffers->take(3) as $index => $offer)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">

                    {{-- Discount Badge --}}
                    <div class="relative">
                        <div class="absolute top-4 right-4 bg-orange-500 text-white px-4 py-2 rounded-full font-bold text-lg shadow-lg z-10">
                            {{ $offer->discount_percentage }}% OFF
                        </div>

                        {{-- Offer Image --}}
                        @if($offer->image)
                            <img src="{{ asset('storage/' . $offer->image) }}"
                                 alt="{{ $offer->title }}"
                                 class="w-full h-64 object-cover">
                        @else
                            <div class="w-full h-64 bg-gradient-to-br from-gray-300 to-gray-400 flex items-center justify-center">
                                <span class="text-white text-xl font-semibold">Coming Soon</span>
                            </div>
                        @endif
                    </div>

                    {{-- Offer Content --}}
                    <div class="p-6">

                        {{-- Title & Subtitle --}}
                        <h3 class="text-2xl font-bold text-gray-800 mb-2">
                            {{ $offer->title }}
                        </h3>
                        <p class="text-orange-600 font-semibold mb-4">
                            {{ $offer->subtitle ?? 'Penawaran Terbatas!' }}
                        </p>

                        {{-- Price --}}
                        <div class="mb-4">
                            <span class="text-gray-400 line-through text-lg mr-2">
                                Rp {{ number_format($offer->original_price, 0, ',', '.') }}
                            </span>
                            <span class="text-orange-600 font-bold text-2xl">
                                Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}
                            </span>
                        </div>

                        {{-- Description --}}
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($offer->description, 80) }}
                        </p>

                        {{-- Time Left Calculation --}}
                        @php
                            $now = \Carbon\Carbon::now();
                            $timeLeftLabel = null;
                            $labelClass = 'text-gray-500';

                            if ($offer->valid_from && $offer->valid_until) {
                                $validFrom = $offer->valid_from instanceof \Carbon\Carbon
                                    ? $offer->valid_from
                                    : \Carbon\Carbon::parse($offer->valid_from);

                                $validUntil = $offer->valid_until instanceof \Carbon\Carbon
                                    ? $offer->valid_until->endOfDay()
                                    : \Carbon\Carbon::parse($offer->valid_until)->endOfDay();

                                // Promo belum dimulai
                                if ($now->lt($validFrom)) {
                                    $daysToStart = (int) $now->diffInDays($validFrom);

                                    if ($daysToStart > 0) {
                                        $timeLeftLabel = 'Mulai dalam ' . $daysToStart . ' hari';
                                    } else {
                                        $timeLeftLabel = 'Mulai hari ini';
                                    }
                                    $labelClass = 'text-blue-500';

                                // Promo sudah berakhir
                                } elseif ($now->gt($validUntil)) {
                                    $timeLeftLabel = 'Promo berakhir';
                                    $labelClass = 'text-gray-500';

                                // Promo sedang berjalan
                                } else {
                                    $daysLeft = (int) $now->diffInDays($validUntil);

                                    if ($daysLeft > 0) {
                                        $timeLeftLabel = $daysLeft . ' hari lagi';
                                    } else {
                                        $timeLeftLabel = 'Berakhir hari ini';
                                    }
                                    $labelClass = 'text-red-500';
                                }
                            } else {
                                $timeLeftLabel = 'Periode promo belum ditentukan';
                            }
                        @endphp

                        {{-- Time Left Display --}}
                        @if($timeLeftLabel)
                            <div class="flex items-center mb-4 {{ $labelClass }}">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                </svg>
                                <span class="font-semibold">{{ $timeLeftLabel }}</span>
                            </div>
                        @endif

                        {{-- CTA Button --}}
                        <a href="{{ route('special-offers.show', $offer->slug) }}"
                           class="block w-full bg-orange-500 hover:bg-orange-600 text-white text-center font-bold py-3 px-6 rounded-xl transition-colors duration-300">
                            Ambil Promo
                        </a>
                    </div>
                </div>

            @endforeach

        </div>

        {{-- View All Button --}}
        <div class="text-center">
            <a href="{{ route('special-offers.index') }}"
               class="inline-block bg-white text-orange-500 border-2 border-orange-500 hover:bg-orange-500 hover:text-white font-bold py-3 px-8 rounded-xl transition-colors duration-300">
                Lihat Semua Promo
            </a>
        </div>

    </div>
</section>
@endif


@if($latestNews->count() > 0)
<!-- News/Articles Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Artikel & Tips Travel</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Dapatkan inspirasi dan tips terbaik untuk perjalanan Anda dari para ahli travel</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($latestNews->take(3) as $index => $article)
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="relative overflow-hidden">
                    @if($article->featured_image)
                        <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    @else
                        <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $article->title }}" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="bg-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">{{ $article->category ?? 'Travel' }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $article->created_at->format('d M Y') }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $article->read_time ?? '5' }} min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-teal-600 transition-colors duration-300">
                        {{ $article->title }}
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($article->content), 120) }}
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @if($article->author_image)
                                <img src="{{ asset('storage/' . $article->author_image) }}" alt="{{ $article->author }}" class="w-8 h-8 rounded-full object-cover mr-3">
                            @else
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" alt="{{ $article->author }}" class="w-8 h-8 rounded-full object-cover mr-3">
                            @endif
                            <span class="text-gray-600 text-sm">{{ $article->author ?? 'Admin' }}</span>
                        </div>
                        <a href="{{ route('articles.show', $article->slug) }}" class="text-teal-600 hover:text-teal-800 font-semibold text-sm transition-colors duration-300">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- View All Articles Button -->
        <div class="text-center mt-12">
            <a href="{{ route('articles.index') }}" class="inline-block bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                Lihat Semua Artikel
            </a>
        </div>
    </div>
</section>
@endif


<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    const prevBtn = document.getElementById('prevSlide');
    const nextBtn = document.getElementById('nextSlide');
    let currentSlide = 0;
    let slideInterval;

    function showSlide(index) {
        slides.forEach(slide => {
            slide.classList.remove('active');
        });

        dots.forEach(dot => {
            dot.classList.remove('active');
        });

        slides[index].classList.add('active');
        dots[index].classList.add('active');

        currentSlide = index;
    }

    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    function prevSlide() {
        const prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    }

    function startAutoSlide() {
        slideInterval = setInterval(nextSlide, 5000);
    }

    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    nextBtn.addEventListener('click', () => {
        stopAutoSlide();
        nextSlide();
        startAutoSlide();
    });

    prevBtn.addEventListener('click', () => {
        stopAutoSlide();
        prevSlide();
        startAutoSlide();
    });

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            stopAutoSlide();
            showSlide(index);
            startAutoSlide();
        });
    });

    const sliderContainer = document.getElementById('heroSlider');
    sliderContainer.addEventListener('mouseenter', stopAutoSlide);
    sliderContainer.addEventListener('mouseleave', startAutoSlide);

    showSlide(0);
    startAutoSlide();

    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const targetId = button.dataset.tab;

            tabButtons.forEach(btn => {
                btn.classList.remove('active');
            });
            button.classList.add('active');

            tabContents.forEach(content => {
                if (content.id === targetId) {
                    content.classList.remove('hidden');
                    content.classList.add('active');
                } else {
                    content.classList.add('hidden');
                    content.classList.remove('active');
                }
            });
        });
    });
});
</script>

@endsection
