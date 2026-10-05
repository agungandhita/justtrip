@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative w-full">
    <img src="{{ asset('image/PROMO.png') }}" alt="Paket Tour Background" class="w-full h-auto">
</section>

<!-- Main Content Area -->
<div class="bg-[#F8FAFC] min-h-screen pb-24">
    <!-- Search & Filter Bar -->
    <section class="relative -mt-8 sm:-mt-12 z-20 px-4">
        <div class="container mx-auto">
            <div class="bg-white/80 backdrop-blur-xl rounded-[2rem] shadow-2xl shadow-gray-200/50 p-4 sm:p-6 border border-white/50">
                <div class="flex flex-col lg:flex-row gap-4 items-center">
                    <!-- Search Input -->
                    <div class="w-full lg:flex-1 relative group">
                        <div class="absolute inset-y-0 left-5 flex items-center pointer-events-none">
                            <i class="fas fa-search text-gray-400 group-focus-within:text-red-500 transition-colors"></i>
                        </div>
                        <input type="text" id="searchOffers" 
                            placeholder="Cari destinasi atau paket promo..." 
                            class="w-full pl-12 pr-6 py-4 bg-gray-50/50 border-none rounded-2xl focus:ring-2 focus:ring-red-500/20 text-gray-700 placeholder-gray-400 transition-all">
                    </div>

                    <!-- Filters Group -->
                    <div class="w-full lg:w-auto flex flex-col sm:flex-row gap-3">
                        <div class="relative">
                            <select id="filterCategory" class="w-full sm:w-48 appearance-none pl-5 pr-10 py-4 bg-gray-50/50 border-none rounded-2xl focus:ring-2 focus:ring-red-500/20 text-gray-700 font-medium cursor-pointer">
                                <option value="all">Semua Kategori</option>
                                <option value="open_trip">Open Trip</option>
                                <option value="corporate_trip">Corporate Trip</option>
                                <option value="edu_trip">Edu Trip</option>
                            </select>
                            <i class="fas fa-chevron-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                        
                        <div class="relative">
                            <select id="sortBy" class="w-full sm:w-48 appearance-none pl-5 pr-10 py-4 bg-gray-50/50 border-none rounded-2xl focus:ring-2 focus:ring-red-500/20 text-gray-700 font-medium cursor-pointer">
                                <option value="newest">Terbaru</option>
                                <option value="discount">Diskon Terbesar</option>
                                <option value="price_low">Harga Terendah</option>
                                <option value="price_high">Harga Tertinggi</option>
                            </select>
                            <i class="fas fa-sort-amount-down absolute right-4 top-1/2 -translate-y-1/2 text-gray-400 pointer-events-none"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Offers Section -->
    @if(isset($featuredOffers) && $featuredOffers->count() > 0)
    <section class="py-16 px-4">
        <div class="container mx-auto">
            <div class="flex items-end justify-between mb-10" data-aos="fade-up">
                <div>
                    <h2 class="text-3xl md:text-4xl font-black text-slate-900 tracking-tight">
                        <span class="text-red-500 leading-tight">PROMO</span> UNGGULAN
                    </h2>
                    <p class="text-slate-500 mt-2 font-medium">Penawaran terbaik pilihan kami hanya untuk Anda</p>
                </div>
                <div class="hidden md:block">
                    <div class="flex gap-2">
                        <div class="w-12 h-1 bg-red-500 rounded-full"></div>
                        <div class="w-4 h-1 bg-red-200 rounded-full"></div>
                    </div>
                </div>
            </div>

            <div class="grid lg:grid-cols-2 gap-8">
                @foreach($featuredOffers as $offer)
                <div class="offer-card group relative bg-white rounded-[2.5rem] shadow-xl shadow-gray-200/50 overflow-hidden hover:shadow-2xl transition-all duration-500" 
                    data-aos="fade-up" 
                    data-aos-delay="{{ $loop->index * 100 }}"
                    data-category="{{ $offer->category }}">
                    <div class="flex flex-col md:flex-row h-full">
                        <!-- Image Container -->
                        <div class="md:w-2/5 relative h-64 md:h-auto overflow-hidden">
                            @php $displayImageUrl = $offer->display_image_url; @endphp
                        @if($displayImageUrl)
                                <img src="{{ $displayImageUrl }}" alt="{{ $offer->title }}" 
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-red-400 to-pink-500 flex items-center justify-center">
                                    <i class="fas fa-image text-white text-4xl"></i>
                                </div>
                            @endif
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4 z-10 flex flex-col gap-2">
                                @if($offer->discount_percentage)
                                    <span class="px-4 py-1.5 bg-red-600 text-white text-[10px] font-black rounded-full uppercase tracking-wider shadow-lg">
                                        SAVE {{ round($offer->discount_percentage) }}%
                                    </span>
                                @endif
                                <span class="px-4 py-1.5 bg-white/90 backdrop-blur-md text-red-600 text-[10px] font-black rounded-full uppercase tracking-wider shadow-lg">
                                    FEATURED
                                </span>
                            </div>

                            <!-- Countdown Mini -->
                            @php
                                $validUntil = \Carbon\Carbon::parse($offer->valid_until);
                                $now = \Carbon\Carbon::now();
                                $totalSeconds = $validUntil->gt($now) ? $now->diffInSeconds($validUntil) : 0;
                            @endphp
                            @if($totalSeconds > 0)
                                <div class="absolute bottom-4 left-4 right-4 bg-black/40 backdrop-blur-md px-4 py-2 rounded-xl text-white flex items-center justify-between">
                                    <span class="text-[10px] font-black uppercase tracking-widest opacity-80">Berakhir dalam</span>
                                    <span class="text-xs font-bold font-mono">{{ $validUntil->diffForHumans(['parts' => 2, 'short' => true]) }}</span>
                                </div>
                            @endif
                        </div>

                        <!-- Content Area -->
                        <div class="md:w-3/5 p-6 sm:p-8 flex flex-col">
                            <div class="flex-1">
                                <div class="flex items-center gap-2 mb-3">
                                    <i class="fas fa-map-marker-alt text-red-500 text-xs"></i>
                                    <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">{{ $offer->layanan->lokasi_tujuan ?? 'Destinasi' }}</span>
                                </div>
                                <h3 class="text-xl sm:text-2xl font-black text-gray-900 mb-3 group-hover:text-red-600 transition-colors line-clamp-2 leading-tight">
                                    {{ $offer->title }}
                                </h3>
                                <p class="text-gray-500 text-sm line-clamp-3 mb-6 leading-relaxed">
                                    {{ $offer->description }}
                                </p>
                            </div>

                            <div class="mt-auto">
                                <div class="flex items-center justify-between mb-6">
                                    <div class="flex flex-col">
                                        <span class="text-xs text-gray-400 line-through font-medium">Rp {{ number_format($offer->original_price, 0, ',', '.') }}</span>
                                        <span class="text-2xl font-black text-red-600">Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}</span>
                                    </div>
                                    @if($offer->max_bookings)
                                        <div class="flex flex-col items-end">
                                            @php $progress = ($offer->current_bookings / $offer->max_bookings) * 100; @endphp
                                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">{{ $offer->current_bookings }}/{{ $offer->max_bookings }} TERJUAL</span>
                                            <div class="w-24 h-1.5 bg-gray-100 rounded-full overflow-hidden">
                                                <div class="h-full bg-red-500 rounded-full" style="width: {{ $progress }}%"></div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                                <a href="{{ route('special-offers.show', $offer->slug) }}" class="flex items-center justify-center w-full py-4 bg-red-600 hover:bg-red-700 text-white font-black uppercase tracking-[0.2em] text-[10px] rounded-2xl transition-all transform hover:-translate-y-1 shadow-lg shadow-red-200">
                                    Lihat Detail Promo
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    <!-- All Offers Section -->
    <section class="py-12 px-4">
        <div class="container mx-auto">
            <div class="flex items-center gap-4 mb-10" data-aos="fade-up">
                <span class="h-px bg-gray-200 flex-1"></span>
                <h2 class="text-2xl font-black text-slate-800 tracking-tight uppercase">Semua Promo Spesial</h2>
                <span class="h-px bg-gray-200 flex-1"></span>
            </div>

            <div id="offersGrid" class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($specialOffers as $offer)
                <div class="offer-card group bg-white rounded-[2rem] shadow-lg shadow-gray-100 border border-transparent hover:border-red-100 hover:shadow-2xl transition-all duration-500 overflow-hidden flex flex-col" 
                    data-aos="fade-up" 
                    data-aos-delay="{{ $loop->index * 50 }}"
                    data-category="{{ $offer->category }}">
                    
                    <!-- Top Container -->
                    <div class="relative h-56 overflow-hidden">
                        @php $displayImageUrl = $offer->display_image_url; @endphp
                        @if($displayImageUrl)
                            <img src="{{ $displayImageUrl }}" alt="{{ $offer->title }}" 
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <i class="fas fa-image text-gray-400 text-3xl"></i>
                            </div>
                        @endif

                        <!-- Badge Overlay -->
                        @if($offer->discount_percentage)
                            <div class="absolute top-4 left-4 px-3 py-1 bg-red-600 text-white text-[10px] font-black rounded-lg uppercase tracking-widest shadow-lg">
                                -{{ round($offer->discount_percentage) }}%
                            </div>
                        @endif

                        <div class="absolute bottom-4 left-4 right-4 flex justify-between items-end">
                            <div class="px-3 py-1 bg-white/90 backdrop-blur-md rounded-lg shadow-sm">
                                <span class="text-[10px] font-black text-red-600 uppercase tracking-widest">{{ $offer->layanan->lokasi_tujuan ?? 'Destinasi' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="p-6 flex flex-col flex-1">
                        <h3 class="text-lg font-black text-gray-900 mb-3 group-hover:text-red-600 transition-colors line-clamp-2 leading-tight">
                            {{ $offer->title }}
                        </h3>
                        <p class="text-gray-500 text-xs mb-6 line-clamp-2 leading-relaxed">
                            {{ $offer->description }}
                        </p>

                        <div class="mt-auto flex items-center justify-between border-t border-gray-50 pt-4">
                            <div class="flex flex-col">
                                <span class="text-[10px] text-gray-400 line-through font-bold">Rp {{ number_format($offer->original_price, 0, ',', '.') }}</span>
                                <span class="text-base font-black text-gray-900">Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}</span>
                            </div>
                            <a href="{{ route('special-offers.show', $offer->slug) }}" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-red-600 hover:text-white rounded-xl transition-all transform hover:rotate-45">
                                <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-24 text-center">
                    <div class="w-32 h-32 bg-gray-100 rounded-[3rem] flex items-center justify-center mx-auto mb-6">
                        <i class="fas fa-gift text-4xl text-gray-300"></i>
                    </div>
                    <h3 class="text-2xl font-black text-gray-800 mb-2">Belum Ada Promo</h3>
                    <p class="text-gray-500 max-w-sm mx-auto">Kami sedang menyiapkan promo-promo menarik untuk petualangan Anda berikutnya. Tetap pantau!</p>
                </div>
                @endforelse
            </div>

            <!-- Pagination -->
            @if(isset($specialOffers) && $specialOffers->hasPages())
            <div class="mt-16 flex justify-center">
                <div class="bg-white px-6 py-4 rounded-3xl shadow-lg shadow-gray-100 border border-gray-50">
                    {{ $specialOffers->links() }}
                </div>
            </div>
            @endif
        </div>
    </section>
</div>

<!-- Scripts -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const searchInput = document.getElementById('searchOffers');
    const sortSelect = document.getElementById('sortBy');
    const categorySelect = document.getElementById('filterCategory');
    const grid = document.getElementById('offersGrid');
    const offerCards = document.querySelectorAll('.offer-card');

    function filterOffers() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categorySelect.value;

        offerCards.forEach(card => {
            const title = card.querySelector('h3').textContent.toLowerCase();
            const location = card.querySelector('.fa-map-marker-alt')?.nextElementSibling?.textContent?.toLowerCase() || 
                           card.querySelector('.text-red-600')?.textContent?.toLowerCase() || '';
            const cardCategory = card.getAttribute('data-category');

            const matchesSearch = title.includes(searchTerm) || location.includes(searchTerm);
            const matchesCategory = selectedCategory === 'all' || cardCategory === selectedCategory;

            if (matchesSearch && matchesCategory) {
                card.style.display = 'flex';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            } else {
                card.style.display = 'none';
                card.style.opacity = '0';
                card.style.transform = 'translateY(20px)';
            }
        });
    }

    searchInput.addEventListener('input', filterOffers);
    categorySelect.addEventListener('change', filterOffers);

    sortSelect.addEventListener('change', function() {
        const sortBy = this.value;
        const cardsArray = Array.from(grid.children).filter(child => !child.classList.contains('col-span-full'));

        cardsArray.sort((a, b) => {
            const getPrice = (el) => parseFloat(el.querySelector('.text-base.font-black, .text-2xl.font-black')?.textContent?.replace(/[^\d]/g, '') || 0);
            const getDiscount = (el) => parseFloat(el.querySelector('.bg-red-600.text-white')?.textContent?.replace(/[^\d]/g, '') || 0);

            switch(sortBy) {
                case 'discount': return getDiscount(b) - getDiscount(a);
                case 'price_low': return getPrice(a) - getPrice(b);
                case 'price_high': return getPrice(b) - getPrice(a);
                default: return 0; // Newest is default by DB order
            }
        });

        cardsArray.forEach(card => grid.appendChild(card));
    });
});
</script>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@200;300;400;500;600;700;800;900&display=swap');
    
    body {
        font-family: 'Plus_Jakarta_Sans', sans-serif;
    }

    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    /* Custom Pagination Styling */
    .pagination {
        display: flex;
        gap: 0.5rem;
    }
    .page-item.active .page-link {
        background-color: #EF4444;
        border-color: #EF4444;
        color: white;
    }
    .page-link {
        border-radius: 0.75rem;
        padding: 0.5rem 1rem;
        color: #4B5563;
        border: 1px solid #F3F4F6;
        transition: all 0.2s;
    }
    .page-link:hover {
        background-color: #FEF2F2;
        color: #EF4444;
    }
</style>
@endsection
