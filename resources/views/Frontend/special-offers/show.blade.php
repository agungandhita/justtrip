@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative py-16 bg-gray-900">
    <!-- Background Image -->
    <div class="absolute inset-0">
        @if($specialOffer->main_image)
        <img src="{{ Storage::url($specialOffer->main_image) }}" alt="{{ $specialOffer->title }}" class="object-cover w-full h-full opacity-50">
        @else
        <div class="w-full h-full opacity-50 bg-gradient-to-br from-red-400 to-pink-600"></div>
        @endif
    </div>

    <!-- Content -->
    <div class="container relative px-4 mx-auto text-white">
        <div class="max-w-3xl mx-auto text-center">
            <!-- Badges - Mobile Optimized -->
            <div class="flex justify-center gap-2 mb-4" data-aos="fade-down">
                @if($specialOffer->discount_percentage)
                <span class="px-3 py-1 text-xs font-semibold text-white bg-red-500 rounded-full sm:text-sm">
                    {{ $specialOffer->discount_percentage }}% OFF
                </span>
                @endif
                @if($specialOffer->layanan)
                <span class="px-3 py-1 text-xs font-semibold text-white bg-blue-500 rounded-full sm:text-sm">
                    {{ $specialOffer->layanan->lokasi_tujuan ?? 'Destinasi' }}
                </span>
                @endif
            </div>

            <!-- Title - Mobile Optimized -->
            <h1 class="mb-6 text-2xl font-bold sm:text-3xl md:text-4xl lg:text-5xl" data-aos="fade-up" data-aos-delay="200">
                {{ $specialOffer->title }}
            </h1>

            <!-- Price - Mobile Optimized -->
            @if($specialOffer->original_price && $specialOffer->discounted_price)
            <div class="mb-6" data-aos="fade-up" data-aos-delay="400">
                <div class="flex flex-col items-center justify-center gap-2 mb-2 sm:flex-row sm:gap-4">
                    <span class="text-sm text-gray-300 line-through sm:text-lg">
                        Rp {{ number_format($specialOffer->original_price, 0, ',', '.') }}
                    </span>
                    <span class="text-2xl font-bold text-yellow-400 sm:text-3xl md:text-4xl">
                        Rp {{ number_format($specialOffer->discounted_price, 0, ',', '.') }}
                    </span>
                </div>
                <p class="text-sm font-medium text-green-400 sm:text-base">
                    Hemat Rp {{ number_format($specialOffer->original_price - $specialOffer->discounted_price, 0, ',', '.') }}
                </p>
            </div>
            @endif

            <!-- Countdown Timer - Real-time -->
            @php
                $validUntil = \Carbon\Carbon::parse($specialOffer->valid_until);
                $now = \Carbon\Carbon::now();
                $isValid = $validUntil->gt($now);
            @endphp
            @if($isValid)
            <div class="max-w-md p-4 mx-auto mb-6 bg-black/30 backdrop-blur-sm rounded-xl" data-aos="fade-up" data-aos-delay="600">
                <p class="mb-3 text-sm text-center text-white/90">Promo berakhir:</p>
                <div id="countdown-timer" class="grid grid-cols-4 gap-2 text-center" data-end-time="{{ $validUntil->toISOString() }}">
                    <div class="p-2 rounded-lg bg-white/10">
                        <div class="text-lg font-bold text-yellow-400 sm:text-xl" id="days">00</div>
                        <div class="text-xs text-white/80">Hari</div>
                    </div>
                    <div class="p-2 rounded-lg bg-white/10">
                        <div class="text-lg font-bold text-yellow-400 sm:text-xl" id="hours">00</div>
                        <div class="text-xs text-white/80">Jam</div>
                    </div>
                    <div class="p-2 rounded-lg bg-white/10">
                        <div class="text-lg font-bold text-yellow-400 sm:text-xl" id="minutes">00</div>
                        <div class="text-xs text-white/80">Menit</div>
                    </div>
                    <div class="p-2 rounded-lg bg-white/10">
                        <div class="text-lg font-bold text-yellow-400 sm:text-xl" id="seconds">00</div>
                        <div class="text-xs text-white/80">Detik</div>
                    </div>
                </div>
                <div class="mt-2 text-xs text-center sm:text-sm text-white/80">
                    {{ $validUntil->format('d M Y, H:i') }} WIB
                </div>
            </div>
            @endif

            <!-- CTA Buttons - Simplified -->
            <div class="flex flex-col justify-center gap-4 sm:flex-row" data-aos="fade-up" data-aos-delay="800">
                <a href="#booking-section" class="px-8 py-3 font-semibold text-white transition-all transform bg-red-500 rounded-lg hover:bg-red-600 hover:scale-105">
                    Pesan Sekarang
                </a>
                <a href="#details" class="px-8 py-3 font-semibold text-white transition-all border-2 rounded-lg border-white/80 hover:bg-white hover:text-gray-900">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Offer Details -->
<section id="details" class="py-12 bg-white">
    <div class="container px-4 mx-auto">
        <div class="grid gap-8 lg:grid-cols-3">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Description -->
                <div class="mb-8" data-aos="fade-up">
                    <h2 class="mb-4 text-2xl font-bold text-gray-800">Deskripsi Promo</h2>
                    <div class="leading-relaxed text-gray-700">
                        {!! nl2br(e($specialOffer->description)) !!}
                    </div>
                </div>

                <!-- Gallery Section -->
                @if($specialOffer->isStandalone() && $specialOffer->galleries->count() > 0)
                <!-- Gallery for Standalone Special Offers from Database -->
                <div class="mb-8" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="mb-4 text-2xl font-bold text-gray-800">Galeri</h2>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($specialOffer->galleries->take(6) as $gallery)
                        <div class="relative cursor-pointer group" onclick="openLightbox('{{ asset('storage/' . $gallery->image_path) }}', '{{ $gallery->title }}')">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                 alt="{{ $gallery->alt_text }}" 
                                 class="object-cover w-full h-48 transition-transform duration-300 rounded-lg group-hover:scale-105">
                            <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 bg-black bg-opacity-0 rounded-lg group-hover:bg-opacity-30">
                                <i class="text-2xl text-white transition-opacity duration-300 opacity-0 fas fa-search-plus group-hover:opacity-100"></i>
                            </div>
                            @if($gallery->is_main)
                            <div class="absolute px-2 py-1 text-xs font-semibold text-white bg-red-500 rounded top-2 left-2">
                                Utama
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    
                    @if($specialOffer->galleries->count() > 6)
                    <div class="mt-4 text-center">
                        <button onclick="showAllGallery()" class="font-semibold text-red-600 hover:text-red-700">
                            Lihat Semua Foto ({{ $specialOffer->galleries->count() }})
                        </button>
                    </div>
                    @endif
                </div>
                @elseif($specialOffer->layanan && $specialOffer->layanan->gambar_destinasi && is_array($specialOffer->layanan->gambar_destinasi) && count($specialOffer->layanan->gambar_destinasi) > 0)
                <!-- Gallery for Service-related Special Offers -->
                <div class="mb-8" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="mb-4 text-2xl font-bold text-gray-800">Galeri</h2>
                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
                        @foreach($specialOffer->layanan->gambar_destinasi as $index => $image)
                        <div class="relative cursor-pointer group" onclick="openLightbox('{{ asset('storage/' . $image) }}', 'Gallery Image {{ $index + 1 }}')">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="Gallery Image {{ $index + 1 }}" 
                                 class="object-cover w-full h-48 transition-transform duration-300 rounded-lg group-hover:scale-105"
                                 onerror="this.src='https://picsum.photos/400/400?random={{ $specialOffer->id + $index }}'">
                            <div class="absolute inset-0 flex items-center justify-center transition-all duration-300 bg-black bg-opacity-0 rounded-lg group-hover:bg-opacity-30">
                                <i class="text-2xl text-white transition-opacity duration-300 opacity-0 fas fa-search-plus group-hover:opacity-100"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Package Details -->
                @if($specialOffer->layanan)
                <div class="mb-8" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="mb-4 text-2xl font-bold text-gray-800">Detail Paket</h2>
                    <div class="grid gap-4 md:grid-cols-2">
                        <div class="p-4 rounded-lg bg-gray-50">
                            <div class="flex items-center mb-2">
                                <i class="mr-2 text-red-600 fas fa-map-marker-alt"></i>
                                <h3 class="font-semibold text-gray-800">Destinasi</h3>
                            </div>
                            <p class="text-gray-600">{{ $specialOffer->layanan->lokasi_tujuan }}</p>
                        </div>
                        <div class="p-4 rounded-lg bg-gray-50">
                            <div class="flex items-center mb-2">
                                <i class="mr-2 text-blue-600 fas fa-clock"></i>
                                <h3 class="font-semibold text-gray-800">Durasi</h3>
                            </div>
                            <p class="text-gray-600">{{ $specialOffer->layanan->durasi ?? 'Sesuai paket' }}</p>
                        </div>
                        <div class="p-4 rounded-lg bg-gray-50">
                            <div class="flex items-center mb-2">
                                <i class="mr-2 text-green-600 fas fa-users"></i>
                                <h3 class="font-semibold text-gray-800">Kapasitas</h3>
                            </div>
                            <p class="text-gray-600">{{ $specialOffer->layanan->kapasitas ?? 'Fleksibel' }} orang</p>
                        </div>
                        <div class="p-4 rounded-lg bg-gray-50">
                            <div class="flex items-center mb-2">
                                <i class="mr-2 text-yellow-500 fas fa-star"></i>
                                <h3 class="font-semibold text-gray-800">Rating</h3>
                            </div>
                            <p class="text-gray-600">{{ $specialOffer->layanan->rating ?? '4.5' }}/5</p>
                        </div>
                    </div>
                </div>
                @endif



                <!-- Terms & Conditions -->
                @if($specialOffer->terms_conditions)
                <div class="mb-8" data-aos="fade-up" data-aos-delay="300">
                    <h2 class="mb-4 text-2xl font-bold text-gray-800">Syarat & Ketentuan</h2>
                    <div class="p-4 border border-yellow-200 rounded-lg bg-yellow-50">
                        <div class="text-gray-700">
                            {!! nl2br(e($specialOffer->terms_conditions)) !!}
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Booking Card -->
                {{-- Booking alert / validation messages (shown when controller sets scroll_to_booking) --}}
                @if(session('scroll_to_booking'))
                    <div id="booking-alert" class="p-4 mb-4 text-sm text-red-700 border border-red-200 rounded bg-red-50">
                        @if($errors->any())
                            <div class="mb-2 font-semibold">Terdapat kesalahan pada form:</div>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $err)
                                    <li>{{ $err }}</li>
                                @endforeach
                            </ul>
                        @elseif(session('booking_message'))
                            <div>{{ session('booking_message') }}</div>
                        @else
                            <div>Silakan periksa kembali data pemesanan Anda.</div>
                        @endif
                    </div>
                    <script>
                        // Ensure URL contains anchor and scroll to booking-section
                        document.addEventListener('DOMContentLoaded', function() {
                            try {
                                if (location.hash !== '#booking-section') {
                                    history.replaceState(null, null, location.pathname + location.search + '#booking-section');
                                }
                                document.getElementById('booking-section')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                            } catch (e) { /* ignore */ }
                        });
                    </script>
                @endif
                <div id="booking-section" class="sticky p-6 mb-6 bg-white border border-gray-200 shadow-lg top-24 rounded-xl" data-aos="fade-up">
                    <h3 class="mb-4 text-xl font-bold text-gray-800">Pesan Sekarang</h3>

                    <!-- Price Summary -->
                    @if($specialOffer->original_price && $specialOffer->discounted_price)
                    <div class="p-4 mb-4 rounded-lg bg-gradient-to-r from-red-50 to-orange-50">
                        <div class="text-center">
                            <div class="mb-1 text-sm text-gray-500 line-through">
                                Rp {{ number_format($specialOffer->original_price, 0, ',', '.') }}
                            </div>
                            <div class="mb-1 text-2xl font-bold text-red-600">
                                Rp {{ number_format($specialOffer->discounted_price, 0, ',', '.') }}
                            </div>
                            <div class="text-sm font-semibold text-green-600">
                                Hemat Rp {{ number_format($specialOffer->original_price - $specialOffer->discounted_price, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Availability -->
                    @if($specialOffer->max_bookings)
                    <div class="mb-4">
                        @php
                            $progress = ($specialOffer->current_bookings / $specialOffer->max_bookings) * 100;
                            $remaining = $specialOffer->max_bookings - $specialOffer->current_bookings;
                        @endphp
                        <div class="flex justify-between mb-2 text-sm text-gray-600">
                            <span>Tersisa {{ $remaining }} slot</span>
                            @if($remaining <= 5)
                            <span class="font-semibold text-red-600">
                                <i class="mr-1 fas fa-fire"></i>Terbatas!
                        </p>
                        @endif
                    </div>
                    @endif

                    <!-- Validity Period -->
                    <div class="p-3 mb-4 rounded-lg bg-blue-50">
                        <h4 class="mb-1 text-sm font-semibold text-gray-800">
                            <i class="mr-1 text-blue-500 fas fa-calendar"></i>Periode Berlaku
                        </h4>
                        <p class="text-xs text-gray-600">
                            {{ \Carbon\Carbon::parse($specialOffer->valid_from)->format('d M Y') }} -
                            {{ \Carbon\Carbon::parse($specialOffer->valid_until)->format('d M Y') }}
                        </p>
                    </div>

                    <!-- Booking Form -->
                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-3">
                        @csrf
                        <input type="hidden" name="special_offer_id" value="{{ $specialOffer->id }}">
                        <input type="hidden" name="layanan_id" value="{{ $specialOffer->layanan_id }}">

                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Tanggal Keberangkatan</label>
                            <input type="date" name="tanggal_keberangkatan" required
                                   min="{{ \Carbon\Carbon::parse($specialOffer->valid_from)->format('Y-m-d') }}"
                                   max="{{ \Carbon\Carbon::parse($specialOffer->valid_until)->format('Y-m-d') }}"
                                   class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Jumlah Peserta</label>
                            <select name="jumlah_peserta" required class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                                <option value="">Pilih jumlah peserta</option>
                                @for($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }} orang</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block mb-1 text-sm font-medium text-gray-700">Catatan Khusus (Opsional)</label>
                            <textarea name="catatan" rows="2" placeholder="Permintaan khusus, alergi makanan, dll."
                                      class="w-full px-3 py-2 text-sm border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent"></textarea>
                        </div>

                        @auth
                            <button type="submit" class="w-full py-3 font-bold text-white transition-colors bg-red-500 rounded-lg hover:bg-red-600">
                                <i class="mr-2 fas fa-calendar-check"></i>Book Sekarang
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block w-full py-3 font-bold text-center text-white transition-colors bg-red-500 rounded-lg hover:bg-red-600">
                                <i class="mr-2 fas fa-sign-in-alt"></i>Login untuk Book
                            </a>
                        @endauth
                    </form>

                    <!-- Contact Info -->
                    <div class="pt-4 mt-4 border-t border-gray-200">
                        <h4 class="mb-2 text-sm font-semibold text-gray-800">Butuh Bantuan?</h4>
                        <div class="space-y-1 text-xs">
                            <a href="tel:+6281234567890" class="flex items-center text-gray-600 transition-colors hover:text-red-600">
                                <i class="mr-2 fas fa-phone"></i>+62 812-3456-7890
                            </a>
                            <a href="mailto:info@justtrip.com" class="flex items-center text-gray-600 transition-colors hover:text-red-600">
                                <i class="mr-2 fas fa-envelope"></i>info@justtrip.com
                            </a>
                            <a href="https://wa.me/6281234567890" class="flex items-center text-gray-600 transition-colors hover:text-red-600">
                                <i class="mr-2 fab fa-whatsapp"></i>WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Share -->
                <div class="p-6 bg-gray-50 rounded-xl" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="mb-4 text-lg font-bold text-gray-800">Bagikan Promo</h3>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" 
                           class="flex-1 py-2 text-center text-white transition-colors bg-blue-600 rounded-lg hover:bg-blue-700">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($specialOffer->title) }}" 
                           target="_blank" 
                           class="flex-1 py-2 text-center text-white transition-colors bg-blue-400 rounded-lg hover:bg-blue-500">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($specialOffer->title . ' - ' . request()->fullUrl()) }}" 
                           target="_blank" 
                           class="flex-1 py-2 text-center text-white transition-colors bg-green-500 rounded-lg hover:bg-green-600">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <button onclick="copyLink()" class="flex-1 py-2 text-center text-white transition-colors bg-gray-600 rounded-lg hover:bg-gray-700">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Related Offers -->
@if(isset($relatedOffers) && $relatedOffers->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container px-4 mx-auto">
        <div class="mb-12 text-center" data-aos="fade-up">
            <h2 class="mb-4 text-2xl font-bold text-gray-800 sm:text-3xl">Promo Lainnya</h2>
            <p class="text-lg text-gray-600">Jangan lewatkan promo menarik lainnya</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @foreach($relatedOffers as $relatedOffer)
            <div class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg rounded-xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- Image -->
                <div class="relative h-48 overflow-hidden">
                    @if($relatedOffer->main_image)
                        <img src="{{ Storage::url($relatedOffer->main_image) }}" alt="{{ $relatedOffer->title }}" class="object-cover w-full h-full">
                    @else
                        <div class="flex items-center justify-center w-full h-full bg-gradient-to-br from-red-400 to-pink-600">
                            <i class="text-3xl text-white fas fa-image"></i>
                        </div>
                    @endif

                    @if($relatedOffer->discount_percentage)
                        <div class="absolute px-3 py-1 text-sm font-bold text-white rounded-full top-3 left-3 bg-gradient-to-r from-red-500 to-pink-500">
                            -{{ $relatedOffer->discount_percentage }}%
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="mb-2 text-lg font-bold text-gray-900 line-clamp-2">{{ $relatedOffer->title }}</h3>

                    @if($relatedOffer->layanan)
                        <p class="mb-3 text-sm text-gray-600">
                            <i class="mr-1 text-red-500 fas fa-map-marker-alt"></i>
                            {{ $relatedOffer->layanan->lokasi_tujuan }}
                        </p>
                    @endif

                    @if($relatedOffer->discounted_price)
                        <div class="mb-4">
                            <span class="text-lg font-bold text-red-600">
                                Rp {{ number_format($relatedOffer->discounted_price, 0, ',', '.') }}
                            </span>
                            @if($relatedOffer->original_price)
                                <span class="ml-2 text-sm text-gray-400 line-through">
                                    Rp {{ number_format($relatedOffer->original_price, 0, ',', '.') }}
                                </span>
                            @endif
                        </div>
                    @endif

                    <a href="{{ route('special-offers.show', $relatedOffer->slug) }}" class="block w-full bg-gradient-to-r from-red-500 to-pink-500 text-white text-center font-semibold py-2.5 rounded-lg hover:from-red-600 hover:to-pink-600 transition-all duration-300">
                        Lihat Detail
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Countdown Timer
    const countdownTimer = document.getElementById('countdown-timer');
    if (countdownTimer) {
        const endTime = new Date(countdownTimer.getAttribute('data-end-time')).getTime();
        
        function updateCountdown() {
            const now = new Date().getTime();
            const distance = endTime - now;

            if (distance > 0) {
                const days = Math.floor(distance / (1000 * 60 * 60 * 24));
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                document.getElementById('days').textContent = String(days).padStart(2, '0');
                document.getElementById('hours').textContent = String(hours).padStart(2, '0');
                document.getElementById('minutes').textContent = String(minutes).padStart(2, '0');
                document.getElementById('seconds').textContent = String(seconds).padStart(2, '0');
            } else {
                // Timer expired
                document.getElementById('days').textContent = '00';
                document.getElementById('hours').textContent = '00';
                document.getElementById('minutes').textContent = '00';
                document.getElementById('seconds').textContent = '00';
                
                // Add expired styling
                countdownTimer.classList.add('opacity-50');
                const expiredText = document.createElement('div');
                expiredText.className = 'text-red-400 text-sm font-semibold mt-2 text-center';
                expiredText.textContent = 'Promo Berakhir';
                countdownTimer.appendChild(expiredText);
            }
        }

        updateCountdown();
        setInterval(updateCountdown, 1000);
    }

    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
});

// Copy link function
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(function() {
        alert('Link berhasil disalin!');
    });
}

// Gallery lightbox functions
function openLightbox(imageSrc, imageTitle) {
    const lightbox = document.getElementById('lightbox');
    const lightboxImg = document.getElementById('lightbox-img');
    const lightboxTitle = document.getElementById('lightbox-title');
    
    lightboxImg.src = imageSrc;
    lightboxTitle.textContent = imageTitle;
    lightbox.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeLightbox() {
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    document.body.style.overflow = 'auto';
}

function showAllGallery() {
    // This could open a modal with all gallery images
    // For now, we'll just scroll to the gallery section
    document.querySelector('.gallery-section')?.scrollIntoView({
        behavior: 'smooth',
        block: 'start'
    });
}

// Close lightbox when clicking outside the image
document.addEventListener('click', function(e) {
    if (e.target.id === 'lightbox') {
        closeLightbox();
    }
});

// Close lightbox with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeLightbox();
    }
});
</script>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-50 flex items-center justify-center hidden p-4 bg-black bg-opacity-90">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeLightbox()" class="absolute z-10 text-white top-4 right-4 hover:text-gray-300">
            <i class="text-2xl fas fa-times"></i>
        </button>
        <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[80vh] object-contain">
        <div id="lightbox-title" class="absolute p-2 text-center text-white bg-black bg-opacity-50 rounded bottom-4 left-4 right-4"></div>
    </div>
</div>

<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.prose {
    max-width: none;
}

.prose p {
    margin-bottom: 1rem;
}
</style>
@endsection