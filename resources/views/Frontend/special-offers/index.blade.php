@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Background Images with Parallax Effect -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-red-500/70 via-pink-500/70 to-red-600/70 z-10"></div>
        <div class="bg-cover bg-center h-full" style="background-image: url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-20 text-center text-white px-4 max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <!-- Badge -->
        <div class="inline-block bg-white/20 rounded-full px-3 py-1 sm:px-4 sm:py-2 mb-4 sm:mb-6" data-aos="fade-down">
            <span class="text-xs sm:text-sm font-medium">Penawaran Terbatas</span>
        </div>

        <!-- Main Title -->
        <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-red-100 bg-clip-text text-transparent" data-aos="fade-up" data-aos-delay="200">
            Promo Spesial JustTrip
        </h1>

        <!-- Subtitle -->
        <p class="text-lg md:text-xl mb-8 text-red-100 font-medium" data-aos="fade-up" data-aos-delay="400">
            Dapatkan diskon hingga 50% untuk paket tour pilihan terbaik. Jangan sampai terlewat!
        </p>

        <!-- Countdown Timer -->
        <div class="bg-white/10 rounded-lg p-3 sm:p-4 mb-6 sm:mb-8 max-w-sm sm:max-w-md mx-auto" data-aos="fade-up" data-aos-delay="600">
            <p class="text-xs sm:text-sm mb-2 sm:mb-3">Berakhir dalam:</p>
            <div id="countdown" class="flex justify-center space-x-1 sm:space-x-2 text-center">
                <div class="bg-white/20 rounded p-1 sm:p-2 min-w-[40px] sm:min-w-[50px]">
                    <div class="text-base sm:text-lg md:text-xl font-bold" id="days">0</div>
                    <div class="text-xs">Hari</div>
                </div>
                <div class="bg-white/20 rounded p-1 sm:p-2 min-w-[40px] sm:min-w-[50px]">
                    <div class="text-base sm:text-lg md:text-xl font-bold" id="hours">0</div>
                    <div class="text-xs">Jam</div>
                </div>
                <div class="bg-white/20 rounded p-1 sm:p-2 min-w-[40px] sm:min-w-[50px]">
                    <div class="text-base sm:text-lg md:text-xl font-bold" id="minutes">0</div>
                    <div class="text-xs">Menit</div>
                </div>
                <div class="bg-white/20 rounded p-1 sm:p-2 min-w-[40px] sm:min-w-[50px]">
                    <div class="text-base sm:text-lg md:text-xl font-bold" id="seconds">0</div>
                    <div class="text-xs">Detik</div>
                </div>
            </div>
        </div>

        <!-- CTA Buttons -->
        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-8" data-aos="fade-up" data-aos-delay="800">
            <a href="#featured-offers" class="bg-white text-red-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                Lihat Promo
            </a>
            <a href="#all-offers" class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-red-600 transition-colors">
                Jelajahi Semua
            </a>
        </div>
    </div>
</section>

<!-- Filter Section -->
<section class="py-12 bg-gradient-to-r from-gray-50 to-white border-b border-gray-100">
    <div class="container mx-auto px-4">
        <div class="flex flex-col lg:flex-row gap-3 sm:gap-4 items-center justify-between">
            <!-- Search -->
            <div class="w-full lg:flex-1 lg:max-w-md">
                <div class="relative">
                    <input type="text" id="searchOffers" placeholder="Cari promo..." class="w-full pl-8 sm:pl-10 pr-4 py-2 sm:py-3 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <i class="fas fa-search absolute left-2 sm:left-3 top-1/2 transform -translate-y-1/2 text-gray-400 text-sm"></i>
                </div>
            </div>

            <!-- Filters -->
            <div class="flex flex-col sm:flex-row w-full lg:w-auto gap-2 sm:gap-3">
                <select id="sortBy" class="px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <option value="newest">Terbaru</option>
                    <option value="discount">Diskon Terbesar</option>
                    <option value="price_low">Harga Terendah</option>
                    <option value="price_high">Harga Tertinggi</option>
                    <option value="ending_soon">Berakhir Segera</option>
                </select>

                <select id="filterCategory" class="px-3 sm:px-4 py-2 text-sm sm:text-base border border-gray-200 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                    <option value="all">Semua Kategori</option>
                    <option value="domestic">Domestik</option>
                    <option value="international">Internasional</option>
                    <option value="adventure">Adventure</option>
                    <option value="family">Family</option>
                    <option value="honeymoon">Honeymoon</option>
                </select>
            </div>
        </div>
    </div>
</section>

<!-- Special Offers Grid -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <!-- Featured Offers -->
        @if(isset($featuredOffers) && $featuredOffers->count() > 0)
        <div class="mb-16">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                    <span class="bg-gradient-to-r from-red-500 to-pink-500 text-white text-sm rounded-full px-3 py-1 mr-3">
                        <i class="fas fa-star"></i>
                    </span>
                    Promo Unggulan
                </h2>
                <p class="text-xl text-gray-600 max-w-3xl mx-auto">Penawaran terbaik yang tidak boleh Anda lewatkan</p>
            </div>

            <div class="grid lg:grid-cols-2 gap-4 sm:gap-6 lg:gap-8 mb-12">
                @foreach($featuredOffers as $offer)
                <div class="group relative bg-white rounded-xl sm:rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 overflow-hidden" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <!-- Image -->
                    <div class="relative h-48 sm:h-56 md:h-64 overflow-hidden">
                        @if($offer->main_image)
                            <img src="{{ Storage::url($offer->main_image) }}" alt="{{ $offer->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-red-400 to-pink-600 flex items-center justify-center">
                                <i class="fas fa-image text-white text-3xl sm:text-4xl"></i>
                            </div>
                        @endif

                        <!-- Badges -->
                        <div class="absolute top-2 sm:top-4 left-2 sm:left-4 flex flex-col gap-1 sm:gap-2">
                            @if($offer->discount_percentage)
                                <span class="bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs sm:text-sm font-bold px-2 py-1 sm:px-3 rounded-full animate-pulse">
                                    -{{ $offer->discount_percentage }}%
                                </span>
                            @endif
                            @if($offer->badge_text)
                                <span class="bg-{{ $offer->badge_color }}-500 text-white text-xs font-bold px-2 py-1 sm:px-3 rounded-full">
                                    {{ $offer->badge_text }}
                                </span>
                            @endif
                        </div>

                        <!-- Time Left -->
                        @php
                            $validUntil = \Carbon\Carbon::parse($offer->valid_until);
                            $now = \Carbon\Carbon::now();
                            $totalSeconds = $validUntil->gt($now) ? $now->diffInSeconds($validUntil) : 0;
                            $daysLeft = floor($totalSeconds / 86400);
                            $hoursLeft = floor(($totalSeconds % 86400) / 3600);
                            $minutesLeft = floor(($totalSeconds % 3600) / 60);
                        @endphp
                        @if($totalSeconds > 0)
                        <div class="absolute top-2 sm:top-4 right-2 sm:right-4 bg-black/70 backdrop-blur-sm text-white text-xs font-bold px-2 py-1 sm:px-3 rounded-full">
                            <i class="fas fa-clock mr-1"></i>
                            @if($daysLeft > 0)
                                {{ $daysLeft }}d {{ $hoursLeft }}h
                            @elseif($hoursLeft > 0)
                                {{ $hoursLeft }}h {{ $minutesLeft }}m
                            @else
                                {{ $minutesLeft }}m
                            @endif
                        </div>
                        @else
                        <div class="absolute top-2 sm:top-4 right-2 sm:right-4 bg-red-500 text-white text-xs font-bold px-2 py-1 sm:px-3 rounded-full">
                            <i class="fas fa-fire mr-1"></i>Berakhir!
                        </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-4 sm:p-6">
                        <div class="flex items-start justify-between mb-3 sm:mb-4">
                            <div class="flex-1">
                                <h3 class="text-lg sm:text-xl font-bold text-gray-900 mb-2 group-hover:text-red-600 transition-colors duration-300 line-clamp-2">
                                    {{ $offer->title }}
                                </h3>
                                @if($offer->layanan)
                                    <p class="text-gray-600 text-xs sm:text-sm mb-2">
                                        <i class="fas fa-map-marker-alt mr-2 text-red-500"></i>
                                        {{ $offer->layanan->lokasi_tujuan }}
                                    </p>
                                @endif
                                <p class="text-gray-600 text-xs sm:text-sm line-clamp-2">{{ $offer->description }}</p>
                            </div>
                        </div>

                        <!-- Pricing -->
                        <div class="flex items-center justify-between mb-3 sm:mb-4">
                            <div>
                                @if($offer->original_price && $offer->discounted_price)
                                    <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2">
                                        <span class="text-sm sm:text-base text-gray-400 line-through">
                                            Rp {{ number_format($offer->original_price, 0, ',', '.') }}
                                        </span>
                                        <span class="text-lg sm:text-xl lg:text-2xl font-bold text-red-600">
                                            Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}
                                        </span>
                                    </div>
                                    <span class="text-xs sm:text-sm text-green-600 font-semibold">
                                        Hemat Rp {{ number_format($offer->original_price - $offer->discounted_price, 0, ',', '.') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Booking Progress -->
                        @if($offer->max_bookings)
                            <div class="mb-3 sm:mb-4">
                                @php
                                    $progress = ($offer->current_bookings / $offer->max_bookings) * 100;
                                @endphp
                                <div class="flex justify-between text-xs sm:text-sm text-gray-600 mb-1">
                                    <span>{{ $offer->current_bookings }}/{{ $offer->max_bookings }} terjual</span>
                                    <span>{{ number_format($progress, 0) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-red-500 to-pink-500 h-2 rounded-full transition-all duration-500" style="width: {{ $progress }}%"></div>
                                </div>
                            </div>
                        @endif

                        <!-- Action Button -->
                        <a href="{{ route('special-offers.show', $offer->slug) }}" class="block w-full bg-gradient-to-r from-red-500 to-pink-500 text-white text-center font-semibold py-2 sm:py-3 rounded-lg hover:from-red-600 hover:to-pink-600 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl text-sm sm:text-base">
                            <i class="fas fa-eye mr-2"></i>Lihat Detail
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif

        <!-- All Offers -->
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Semua Promo Spesial</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Jelajahi semua penawaran menarik kami</p>
        </div>

        <div id="offersGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 lg:gap-8">
            @forelse($specialOffers as $offer)
            <div class="offer-card bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                <!-- Image -->
                <div class="relative h-40 sm:h-48">
                    @if($offer->main_image)
                        <img src="{{ Storage::url($offer->main_image) }}" alt="{{ $offer->title }}" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-red-400 to-pink-600 flex items-center justify-center">
                            <i class="fas fa-image text-white text-2xl sm:text-3xl"></i>
                        </div>
                    @endif

                    <!-- Discount Badge -->
                    @if($offer->discount_percentage)
                        <div class="absolute top-2 sm:top-3 left-2 sm:left-3 bg-red-500 text-white text-xs sm:text-sm font-medium px-2 py-1 sm:px-3 rounded">
                            -{{ $offer->discount_percentage }}%
                        </div>
                    @endif

                    <!-- Time Badge -->
                    @php
                        $validUntil = \Carbon\Carbon::parse($offer->valid_until);
                        $now = \Carbon\Carbon::now();
                        $totalSeconds = $validUntil->gt($now) ? $now->diffInSeconds($validUntil) : 0;
                        $daysLeft = floor($totalSeconds / 86400);
                        $hoursLeft = floor(($totalSeconds % 86400) / 3600);
                        $minutesLeft = floor(($totalSeconds % 3600) / 60);
                    @endphp
                    @if($totalSeconds > 0)
                    <div class="absolute top-2 sm:top-3 right-2 sm:right-3 bg-black/70 text-white text-xs font-medium px-2 py-1 rounded">
                        @if($daysLeft > 0)
                            {{ $daysLeft }}d {{ $hoursLeft }}h
                        @elseif($hoursLeft > 0)
                            {{ $hoursLeft }}h {{ $minutesLeft }}m
                        @else
                            {{ $minutesLeft }}m
                        @endif
                    </div>
                    @else
                    <div class="absolute top-2 sm:top-3 right-2 sm:right-3 bg-red-500 text-white text-xs font-medium px-2 py-1 rounded">
                        Berakhir!
                    </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-3 sm:p-4">
                    <h3 class="text-base sm:text-lg font-semibold text-gray-900 mb-2 line-clamp-2">
                        {{ $offer->title }}
                    </h3>

                    @if($offer->layanan)
                        <p class="text-gray-600 text-xs sm:text-sm mb-2 sm:mb-3">
                            <i class="fas fa-map-marker-alt mr-1 text-red-500"></i>
                            {{ $offer->layanan->lokasi_tujuan }}
                        </p>
                    @endif

                    <p class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4 line-clamp-2">{{ $offer->description }}</p>

                    <!-- Pricing -->
                    @if($offer->original_price && $offer->discounted_price)
                        <div class="mb-3 sm:mb-4">
                            <div class="flex flex-col sm:flex-row sm:items-center gap-1 sm:gap-2 mb-1">
                                <span class="text-xs sm:text-sm text-gray-400 line-through">
                                    Rp {{ number_format($offer->original_price, 0, ',', '.') }}
                                </span>
                                <span class="text-base sm:text-lg font-bold text-red-600">
                                    Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}
                                </span>
                            </div>
                            <span class="text-xs text-green-600 font-medium">
                                Hemat Rp {{ number_format($offer->original_price - $offer->discounted_price, 0, ',', '.') }}
                            </span>
                        </div>
                    @endif

                    <!-- Action Button -->
                    <a href="{{ route('special-offers.show', $offer->slug) }}" class="block w-full bg-red-600 text-white text-center font-medium py-2 rounded-lg hover:bg-red-700 transition-colors text-sm sm:text-base">
                        <i class="fas fa-eye mr-2"></i>Lihat Detail
                    </a>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-16">
                <div class="max-w-md mx-auto">
                    <i class="fas fa-gift text-gray-300 text-6xl mb-4"></i>
                    <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Promo</h3>
                    <p class="text-gray-500">Promo spesial akan segera hadir. Pantau terus halaman ini!</p>
                </div>
            </div>
            @endforelse
        </div>

        <!-- Pagination -->
        @if(isset($specialOffers) && $specialOffers->hasPages())
        <div class="mt-12 flex justify-center">
            {{ $specialOffers->links() }}
        </div>
        @endif
    </div>
</section>

<!-- Newsletter Section -->
<section class="py-16 bg-gradient-to-r from-red-500 to-pink-500">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-2xl mx-auto" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">Jangan Lewatkan Promo Terbaru!</h2>
            <p class="text-red-100 mb-8">Daftarkan email Anda untuk mendapatkan notifikasi promo spesial dan penawaran eksklusif</p>

            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto">
                <input type="email" placeholder="Masukkan email Anda" class="flex-1 px-4 py-3 rounded-lg border-0 focus:ring-2 focus:ring-white focus:outline-none">
                <button type="submit" class="bg-white text-red-500 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition-colors duration-300">
                    <i class="fas fa-bell mr-2"></i>Berlangganan
                </button>
            </form>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Countdown Timer
    function updateCountdown() {
        const now = new Date().getTime();
        @if(isset($longestValidUntil) && $longestValidUntil)
            // Use the longest valid_until date from database
            const endTime = new Date('{{ $longestValidUntil->toISOString() }}').getTime();
        @else
            // Fallback to 30 days from now if no offers available
            const endTime = new Date(now + (30 * 24 * 60 * 60 * 1000)).getTime();
        @endif
        const distance = endTime - now;

        const days = Math.floor(distance / (1000 * 60 * 60 * 24));
        const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        const seconds = Math.floor((distance % (1000 * 60)) / 1000);

        // Update individual elements
        if (document.getElementById('days')) {
            document.getElementById('days').textContent = days;
        }
        if (document.getElementById('hours')) {
            document.getElementById('hours').textContent = hours;
        }
        if (document.getElementById('minutes')) {
            document.getElementById('minutes').textContent = minutes;
        }
        if (document.getElementById('seconds')) {
            document.getElementById('seconds').textContent = seconds;
        }

        if (distance < 0) {
            const countdownElement = document.getElementById('countdown');
            if (countdownElement) {
                countdownElement.innerHTML = '<div class="text-red-500 font-bold">Promo Berakhir</div>';
            }
        }
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);

    // Search and Filter functionality
    const searchInput = document.getElementById('searchOffers');
    const sortSelect = document.getElementById('sortBy');
    const categorySelect = document.getElementById('filterCategory');
    const offerCards = document.querySelectorAll('.offer-card');

    function filterOffers() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categorySelect.value;

        offerCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const location = card.querySelector('.fa-map-marker-alt')?.parentElement?.textContent?.toLowerCase() || '';

            const matchesSearch = title.includes(searchTerm) || location.includes(searchTerm);
            const matchesCategory = selectedCategory === 'all' || card.dataset.category === selectedCategory;

            if (matchesSearch && matchesCategory) {
                card.style.display = 'block';
                card.classList.remove('hidden');
            } else {
                card.style.display = 'none';
                card.classList.add('hidden');
            }
        });
    }

    searchInput.addEventListener('input', filterOffers);
    categorySelect.addEventListener('change', filterOffers);

    // Sort functionality
    sortSelect.addEventListener('change', function() {
        const sortBy = this.value;
        const grid = document.getElementById('offersGrid');
        const cards = Array.from(grid.children);

        cards.sort((a, b) => {
            switch(sortBy) {
                case 'discount':
                    const discountA = parseFloat(a.querySelector('.animate-pulse')?.textContent?.replace(/[^\d]/g, '') || 0);
                    const discountB = parseFloat(b.querySelector('.animate-pulse')?.textContent?.replace(/[^\d]/g, '') || 0);
                    return discountB - discountA;
                case 'price_low':
                    const priceA = parseFloat(a.querySelector('.text-red-600')?.textContent?.replace(/[^\d]/g, '') || 0);
                    const priceB = parseFloat(b.querySelector('.text-red-600')?.textContent?.replace(/[^\d]/g, '') || 0);
                    return priceA - priceB;
                case 'price_high':
                    const priceHighA = parseFloat(a.querySelector('.text-red-600')?.textContent?.replace(/[^\d]/g, '') || 0);
                    const priceHighB = parseFloat(b.querySelector('.text-red-600')?.textContent?.replace(/[^\d]/g, '') || 0);
                    return priceHighB - priceHighA;
                default:
                    return 0;
            }
        });

        cards.forEach(card => grid.appendChild(card));
    });
});
</script>

<style>
.line-clamp-1 {
    display: -webkit-box;
    -webkit-line-clamp: 1;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection
