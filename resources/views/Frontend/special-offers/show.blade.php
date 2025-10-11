@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative bg-gray-900 py-16">
    <!-- Background Image -->
    <div class="absolute inset-0">
        @if($specialOffer->main_image)
        <img src="{{ Storage::url($specialOffer->main_image) }}" alt="{{ $specialOffer->title }}" class="w-full h-full object-cover opacity-50">
        @else
        <div class="w-full h-full bg-gradient-to-br from-red-400 to-pink-600 opacity-50"></div>
        @endif
    </div>

    <!-- Content -->
    <div class="relative container mx-auto px-4 text-white">
        <div class="max-w-3xl mx-auto text-center">
            <!-- Badges - Mobile Optimized -->
            <div class="flex justify-center gap-2 mb-4" data-aos="fade-down">
                @if($specialOffer->discount_percentage)
                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs sm:text-sm font-semibold">
                    {{ $specialOffer->discount_percentage }}% OFF
                </span>
                @endif
                @if($specialOffer->layanan)
                <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-xs sm:text-sm font-semibold">
                    {{ $specialOffer->layanan->lokasi_tujuan ?? 'Destinasi' }}
                </span>
                @endif
            </div>

            <!-- Title - Mobile Optimized -->
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-6" data-aos="fade-up" data-aos-delay="200">
                {{ $specialOffer->title }}
            </h1>

            <!-- Price - Mobile Optimized -->
            @if($specialOffer->original_price && $specialOffer->discounted_price)
            <div class="mb-6" data-aos="fade-up" data-aos-delay="400">
                <div class="flex flex-col sm:flex-row justify-center items-center gap-2 sm:gap-4 mb-2">
                    <span class="text-sm sm:text-lg text-gray-300 line-through">
                        Rp {{ number_format($specialOffer->original_price, 0, ',', '.') }}
                    </span>
                    <span class="text-2xl sm:text-3xl md:text-4xl font-bold text-yellow-400">
                        Rp {{ number_format($specialOffer->discounted_price, 0, ',', '.') }}
                    </span>
                </div>
                <p class="text-green-400 font-medium text-sm sm:text-base">
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
            <div class="bg-black/30 backdrop-blur-sm rounded-xl p-4 mb-6 max-w-md mx-auto" data-aos="fade-up" data-aos-delay="600">
                <p class="text-white/90 mb-3 text-sm text-center">Promo berakhir:</p>
                <div id="countdown-timer" class="grid grid-cols-4 gap-2 text-center" data-end-time="{{ $validUntil->toISOString() }}">
                    <div class="bg-white/10 rounded-lg p-2">
                        <div class="text-lg sm:text-xl font-bold text-yellow-400" id="days">00</div>
                        <div class="text-xs text-white/80">Hari</div>
                    </div>
                    <div class="bg-white/10 rounded-lg p-2">
                        <div class="text-lg sm:text-xl font-bold text-yellow-400" id="hours">00</div>
                        <div class="text-xs text-white/80">Jam</div>
                    </div>
                    <div class="bg-white/10 rounded-lg p-2">
                        <div class="text-lg sm:text-xl font-bold text-yellow-400" id="minutes">00</div>
                        <div class="text-xs text-white/80">Menit</div>
                    </div>
                    <div class="bg-white/10 rounded-lg p-2">
                        <div class="text-lg sm:text-xl font-bold text-yellow-400" id="seconds">00</div>
                        <div class="text-xs text-white/80">Detik</div>
                    </div>
                </div>
                <div class="text-xs sm:text-sm text-white/80 text-center mt-2">
                    {{ $validUntil->format('d M Y, H:i') }} WIB
                </div>
            </div>
            @endif

            <!-- CTA Buttons - Simplified -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="800">
                <a href="#booking-section" class="bg-red-500 hover:bg-red-600 text-white px-8 py-3 rounded-lg font-semibold transition-all transform hover:scale-105">
                    Pesan Sekarang
                </a>
                <a href="#details" class="border-2 border-white/80 text-white hover:bg-white hover:text-gray-900 px-8 py-3 rounded-lg font-semibold transition-all">
                    Lihat Detail
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Offer Details -->
<section id="details" class="py-12 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-8">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Description -->
                <div class="mb-8" data-aos="fade-up">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Deskripsi Promo</h2>
                    <div class="text-gray-700 leading-relaxed">
                        {!! nl2br(e($specialOffer->description)) !!}
                    </div>
                </div>

                <!-- Gallery Section -->
                @if($specialOffer->isStandalone() && $specialOffer->galleries->count() > 0)
                <!-- Gallery for Standalone Special Offers from Database -->
                <div class="mb-8" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Galeri</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($specialOffer->galleries->take(6) as $gallery)
                        <div class="relative group cursor-pointer" onclick="openLightbox('{{ asset('storage/' . $gallery->image_path) }}', '{{ $gallery->title }}')">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" 
                                 alt="{{ $gallery->alt_text }}" 
                                 class="w-full h-48 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 rounded-lg flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                            </div>
                            @if($gallery->is_main)
                            <div class="absolute top-2 left-2 bg-red-500 text-white px-2 py-1 rounded text-xs font-semibold">
                                Utama
                            </div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                    
                    @if($specialOffer->galleries->count() > 6)
                    <div class="text-center mt-4">
                        <button onclick="showAllGallery()" class="text-red-600 hover:text-red-700 font-semibold">
                            Lihat Semua Foto ({{ $specialOffer->galleries->count() }})
                        </button>
                    </div>
                    @endif
                </div>
                @elseif($specialOffer->layanan && $specialOffer->layanan->gambar_destinasi && is_array($specialOffer->layanan->gambar_destinasi) && count($specialOffer->layanan->gambar_destinasi) > 0)
                <!-- Gallery for Service-related Special Offers -->
                <div class="mb-8" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Galeri</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($specialOffer->layanan->gambar_destinasi as $index => $image)
                        <div class="relative group cursor-pointer" onclick="openLightbox('{{ asset('storage/' . $image) }}', 'Gallery Image {{ $index + 1 }}')">
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="Gallery Image {{ $index + 1 }}" 
                                 class="w-full h-48 object-cover rounded-lg transition-transform duration-300 group-hover:scale-105"
                                 onerror="this.src='https://picsum.photos/400/400?random={{ $specialOffer->id + $index }}'">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-30 transition-all duration-300 rounded-lg flex items-center justify-center">
                                <i class="fas fa-search-plus text-white text-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></i>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Package Details -->
                @if($specialOffer->layanan)
                <div class="mb-8" data-aos="fade-up" data-aos-delay="100">
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Detail Paket</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-map-marker-alt text-red-600 mr-2"></i>
                                <h3 class="font-semibold text-gray-800">Destinasi</h3>
                            </div>
                            <p class="text-gray-600">{{ $specialOffer->layanan->lokasi_tujuan }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-clock text-blue-600 mr-2"></i>
                                <h3 class="font-semibold text-gray-800">Durasi</h3>
                            </div>
                            <p class="text-gray-600">{{ $specialOffer->layanan->durasi ?? 'Sesuai paket' }}</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-users text-green-600 mr-2"></i>
                                <h3 class="font-semibold text-gray-800">Kapasitas</h3>
                            </div>
                            <p class="text-gray-600">{{ $specialOffer->layanan->kapasitas ?? 'Fleksibel' }} orang</p>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="flex items-center mb-2">
                                <i class="fas fa-star text-yellow-500 mr-2"></i>
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
                    <h2 class="text-2xl font-bold text-gray-800 mb-4">Syarat & Ketentuan</h2>
                    <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4">
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
                <div id="booking-section" class="sticky top-24 bg-white border border-gray-200 rounded-xl shadow-lg p-6 mb-6" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Pesan Sekarang</h3>

                    <!-- Price Summary -->
                    @if($specialOffer->original_price && $specialOffer->discounted_price)
                    <div class="bg-gradient-to-r from-red-50 to-orange-50 rounded-lg p-4 mb-4">
                        <div class="text-center">
                            <div class="text-sm text-gray-500 line-through mb-1">
                                Rp {{ number_format($specialOffer->original_price, 0, ',', '.') }}
                            </div>
                            <div class="text-2xl font-bold text-red-600 mb-1">
                                Rp {{ number_format($specialOffer->discounted_price, 0, ',', '.') }}
                            </div>
                            <div class="text-sm text-green-600 font-semibold">
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
                        <div class="flex justify-between text-sm text-gray-600 mb-2">
                            <span>Tersisa {{ $remaining }} slot</span>
                            @if($remaining <= 5)
                            <span class="text-red-600 font-semibold">
                                <i class="fas fa-fire mr-1"></i>Terbatas!
                        </p>
                        @endif
                    </div>
                    @endif

                    <!-- Validity Period -->
                    <div class="mb-4 p-3 bg-blue-50 rounded-lg">
                        <h4 class="font-semibold text-gray-800 mb-1 text-sm">
                            <i class="fas fa-calendar text-blue-500 mr-1"></i>Periode Berlaku
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
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Keberangkatan</label>
                            <input type="date" name="tanggal_keberangkatan" required
                                   min="{{ \Carbon\Carbon::parse($specialOffer->valid_from)->format('Y-m-d') }}"
                                   max="{{ \Carbon\Carbon::parse($specialOffer->valid_until)->format('Y-m-d') }}"
                                   class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Peserta</label>
                            <select name="jumlah_peserta" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm">
                                <option value="">Pilih jumlah peserta</option>
                                @for($i = 1; $i <= 20; $i++)
                                    <option value="{{ $i }}">{{ $i }} orang</option>
                                @endfor
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Khusus (Opsional)</label>
                            <textarea name="catatan" rows="2" placeholder="Permintaan khusus, alergi makanan, dll."
                                      class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent text-sm"></textarea>
                        </div>

                        @auth
                            <button type="submit" class="w-full bg-red-500 text-white font-bold py-3 rounded-lg hover:bg-red-600 transition-colors">
                                <i class="fas fa-calendar-check mr-2"></i>Book Sekarang
                            </button>
                        @else
                            <a href="{{ route('login') }}" class="block w-full bg-red-500 text-white font-bold py-3 rounded-lg hover:bg-red-600 text-center transition-colors">
                                <i class="fas fa-sign-in-alt mr-2"></i>Login untuk Book
                            </a>
                        @endauth
                    </form>

                    <!-- Contact Info -->
                    <div class="mt-4 pt-4 border-t border-gray-200">
                        <h4 class="font-semibold text-gray-800 mb-2 text-sm">Butuh Bantuan?</h4>
                        <div class="space-y-1 text-xs">
                            <a href="tel:+6281234567890" class="flex items-center text-gray-600 hover:text-red-600 transition-colors">
                                <i class="fas fa-phone mr-2"></i>+62 812-3456-7890
                            </a>
                            <a href="mailto:info@justtrip.com" class="flex items-center text-gray-600 hover:text-red-600 transition-colors">
                                <i class="fas fa-envelope mr-2"></i>info@justtrip.com
                            </a>
                            <a href="https://wa.me/6281234567890" class="flex items-center text-gray-600 hover:text-red-600 transition-colors">
                                <i class="fab fa-whatsapp mr-2"></i>WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Share -->
                <div class="bg-gray-50 rounded-xl p-6" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-lg font-bold text-gray-800 mb-4">Bagikan Promo</h3>
                    <div class="flex gap-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" 
                           target="_blank" 
                           class="flex-1 bg-blue-600 text-white text-center py-2 rounded-lg hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($specialOffer->title) }}" 
                           target="_blank" 
                           class="flex-1 bg-blue-400 text-white text-center py-2 rounded-lg hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($specialOffer->title . ' - ' . request()->fullUrl()) }}" 
                           target="_blank" 
                           class="flex-1 bg-green-500 text-white text-center py-2 rounded-lg hover:bg-green-600 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <button onclick="copyLink()" class="flex-1 bg-gray-600 text-white text-center py-2 rounded-lg hover:bg-gray-700 transition-colors">
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
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl font-bold text-gray-800 mb-4">Promo Lainnya</h2>
            <p class="text-lg text-gray-600">Jangan lewatkan promo menarik lainnya</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedOffers as $relatedOffer)
            <div class="bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <!-- Image -->
                <div class="relative h-48 overflow-hidden">
                    @if($relatedOffer->main_image)
                        <img src="{{ Storage::url($relatedOffer->main_image) }}" alt="{{ $relatedOffer->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-red-400 to-pink-600 flex items-center justify-center">
                            <i class="fas fa-image text-white text-3xl"></i>
                        </div>
                    @endif

                    @if($relatedOffer->discount_percentage)
                        <div class="absolute top-3 left-3 bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm font-bold px-3 py-1 rounded-full">
                            -{{ $relatedOffer->discount_percentage }}%
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2">{{ $relatedOffer->title }}</h3>

                    @if($relatedOffer->layanan)
                        <p class="text-gray-600 text-sm mb-3">
                            <i class="fas fa-map-marker-alt mr-1 text-red-500"></i>
                            {{ $relatedOffer->layanan->lokasi_tujuan }}
                        </p>
                    @endif

                    @if($relatedOffer->discounted_price)
                        <div class="mb-4">
                            <span class="text-lg font-bold text-red-600">
                                Rp {{ number_format($relatedOffer->discounted_price, 0, ',', '.') }}
                            </span>
                            @if($relatedOffer->original_price)
                                <span class="text-sm text-gray-400 line-through ml-2">
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
    }});
});
</script>

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 bg-black bg-opacity-90 z-50 hidden flex items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeLightbox()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
            <i class="fas fa-times text-2xl"></i>
        </button>
        <img id="lightbox-img" src="" alt="" class="max-w-full max-h-[80vh] object-contain">
        <div id="lightbox-title" class="absolute bottom-4 left-4 right-4 text-white text-center bg-black bg-opacity-50 p-2 rounded"></div>
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