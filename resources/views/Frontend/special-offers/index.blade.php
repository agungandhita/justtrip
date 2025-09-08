@extends('Frontend.main')

@section('container')
<!-- Hero Section -->
<section class="relative h-96 bg-gradient-to-r from-red-600 to-pink-600 overflow-hidden">
    <div class="absolute inset-0 bg-black/30"></div>
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
    
    <div class="relative z-10 container mx-auto px-4 h-full flex items-center">
        <div class="text-white max-w-3xl">
            <div class="mb-6">
                <span class="bg-red-500 text-white px-6 py-3 rounded-full text-lg font-bold animate-pulse">🔥 SPECIAL OFFERS</span>
            </div>
            <h1 class="text-5xl md:text-7xl font-bold mb-6">Penawaran Terbaik</h1>
            <p class="text-xl md:text-2xl mb-8 leading-relaxed">Dapatkan diskon hingga 70% untuk paket tour pilihan. Jangan sampai terlewat!</p>
            
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-6">
                <div class="flex items-center">
                    <span class="text-yellow-400 mr-2 text-2xl">⏰</span>
                    <span class="text-lg font-semibold">Penawaran Terbatas</span>
                </div>
                <div class="flex items-center">
                    <span class="text-green-400 mr-2 text-2xl">💰</span>
                    <span class="text-lg font-semibold">Hemat Jutaan Rupiah</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Filter & Search Section -->
<section class="py-8 bg-gray-50">
    <div class="container mx-auto px-4">
        <form method="GET" action="{{ route('special-offers.index') }}" class="bg-white rounded-2xl shadow-lg p-6">
            <div class="grid md:grid-cols-4 gap-4">
                <!-- Search -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-medium text-gray-700 mb-2">Cari Penawaran</label>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari destinasi atau paket..." class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                </div>
                
                <!-- Sort -->
                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-2">Urutkan</label>
                    <select name="sort" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                        <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Terbaru</option>
                        <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                        <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
                        <option value="discount" {{ request('sort') == 'discount' ? 'selected' : '' }}>Diskon Terbesar</option>
                        <option value="ending_soon" {{ request('sort') == 'ending_soon' ? 'selected' : '' }}>Segera Berakhir</option>
                    </select>
                </div>
                
                <!-- Filter Button -->
                <div class="flex items-end">
                    <button type="submit" class="w-full bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                        🔍 Filter
                    </button>
                </div>
            </div>
            
            <!-- Quick Filters -->
            <div class="mt-4 flex flex-wrap gap-2">
                <a href="{{ route('special-offers.index') }}" class="px-4 py-2 rounded-full text-sm {{ !request()->hasAny(['featured', 'ending_soon']) ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors">
                    Semua
                </a>
                <a href="{{ route('special-offers.index', ['featured' => '1']) }}" class="px-4 py-2 rounded-full text-sm {{ request('featured') == '1' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors">
                    ⭐ Featured
                </a>
                <a href="{{ route('special-offers.index', ['sort' => 'ending_soon']) }}" class="px-4 py-2 rounded-full text-sm {{ request('sort') == 'ending_soon' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors">
                    ⏰ Segera Berakhir
                </a>
                <a href="{{ route('special-offers.index', ['sort' => 'discount']) }}" class="px-4 py-2 rounded-full text-sm {{ request('sort') == 'discount' ? 'bg-red-500 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors">
                    💥 Diskon Terbesar
                </a>
            </div>
        </form>
    </div>
</section>

<!-- Special Offers Grid -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        @if($specialOffers->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($specialOffers as $offer)
                    <div class="group bg-white rounded-2xl shadow-lg overflow-hidden hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border border-gray-100">
                        <!-- Image -->
                        <div class="relative overflow-hidden">
                            @if($offer->image)
                                <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                            @else
                                <div class="w-full h-64 bg-gradient-to-br from-red-400 to-pink-400 flex items-center justify-center">
                                    <svg class="w-16 h-16 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                            @endif
                            
                            <!-- Badges -->
                            <div class="absolute top-4 left-4 flex flex-col space-y-2">
                                @if($offer->is_featured)
                                    <span class="bg-yellow-500 text-white px-3 py-1 rounded-full text-xs font-bold">⭐ FEATURED</span>
                                @endif
                                <span class="bg-red-500 text-white px-3 py-1 rounded-full text-xs font-bold">-{{ $offer->discount_percentage }}%</span>
                            </div>
                            
                            <!-- Countdown Timer -->
                            @php
                                $daysLeft = now()->diffInDays($offer->valid_until, false);
                            @endphp
                            @if($daysLeft <= 7 && $daysLeft > 0)
                                <div class="absolute top-4 right-4">
                                    <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-xs font-bold animate-pulse">
                                        ⏰ {{ $daysLeft }} hari lagi
                                    </span>
                                </div>
                            @elseif($daysLeft <= 0)
                                <div class="absolute top-4 right-4">
                                    <span class="bg-red-600 text-white px-3 py-1 rounded-full text-xs font-bold">
                                        ❌ BERAKHIR
                                    </span>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Content -->
                        <div class="p-6">
                            <h3 class="text-xl font-bold text-gray-800 mb-2 group-hover:text-red-600 transition-colors">{{ $offer->title }}</h3>
                            <p class="text-gray-600 mb-4 line-clamp-2">{{ Str::limit($offer->description, 100) }}</p>
                            
                            <!-- Destination -->
                            @if($offer->layanan)
                                <div class="flex items-center text-gray-500 mb-4">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-sm">{{ $offer->layanan->lokasi_tujuan }}</span>
                                </div>
                            @endif
                            
                            <!-- Price -->
                            <div class="mb-4">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="text-gray-400 line-through text-lg">Rp {{ number_format($offer->original_price, 0, ',', '.') }}</span>
                                    <span class="bg-red-100 text-red-600 px-2 py-1 rounded text-xs font-semibold">HEMAT {{ number_format($offer->original_price - $offer->discounted_price, 0, ',', '.') }}</span>
                                </div>
                                <div class="text-2xl font-bold text-red-600">Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}</div>
                                <p class="text-sm text-gray-500">per orang</p>
                            </div>
                            
                            <!-- Valid Until -->
                            <div class="mb-4 p-3 bg-red-50 rounded-lg">
                                <div class="flex items-center justify-between">
                                    <span class="text-sm text-red-600 font-semibold">Berlaku hingga:</span>
                                    <span class="text-sm font-bold text-red-700">{{ $offer->valid_until->format('d M Y') }}</span>
                                </div>
                            </div>
                            
                            <!-- Action Buttons -->
                            <div class="flex space-x-2">
                                <a href="{{ route('packages.show', $offer->slug) }}" class="flex-1 bg-gradient-to-r from-red-500 to-pink-500 hover:from-red-600 hover:to-pink-600 text-white text-center py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                                    Lihat Detail
                                </a>
                                @auth
                                    <a href="{{ route('booking.create-from-offer', $offer->id) }}" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white text-center py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                                        Book Now
                                    </a>
                                @else
                                    <a href="{{ route('login') }}" class="flex-1 bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white text-center py-3 rounded-lg font-semibold transition-all duration-300 transform hover:scale-105">
                                        Login
                                    </a>
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <!-- Pagination -->
            @if($specialOffers->hasPages())
                <div class="mt-12 flex justify-center">
                    {{ $specialOffers->appends(request()->query())->links() }}
                </div>
            @endif
        @else
            <!-- Empty State -->
            <div class="text-center py-16">
                <div class="max-w-md mx-auto">
                    <div class="w-24 h-24 bg-gray-200 rounded-full flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.172 16.172a4 4 0 015.656 0M9 12h6m-6-4h6m2 5.291A7.962 7.962 0 0112 15c-2.34 0-4.47-.881-6.08-2.33l-.147-.15C5.23 11.97 5 11.47 5 10.929V7a2 2 0 012-2h10a2 2 0 012 2v3.929c0 .54-.23 1.04-.773 1.521l-.147.15A7.962 7.962 0 0112 15z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold text-gray-800 mb-2">Tidak Ada Penawaran</h3>
                    <p class="text-gray-600 mb-6">Maaf, tidak ada penawaran khusus yang tersedia saat ini. Silakan coba lagi nanti atau ubah filter pencarian Anda.</p>
                    <a href="{{ route('packages.index') }}" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                        Lihat Paket Regular
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- CTA Section -->
<section class="py-16 bg-gradient-to-r from-red-600 to-pink-600">
    <div class="container mx-auto px-4 text-center">
        <div class="max-w-3xl mx-auto text-white">
            <h2 class="text-4xl font-bold mb-4">Jangan Sampai Terlewat!</h2>
            <p class="text-xl mb-8">Dapatkan notifikasi untuk penawaran terbaru dan eksklusif langsung ke email Anda.</p>
            
            <form class="flex flex-col sm:flex-row max-w-md mx-auto space-y-4 sm:space-y-0 sm:space-x-4">
                <input type="email" placeholder="Masukkan email Anda" class="flex-1 px-6 py-4 rounded-lg text-gray-800 focus:outline-none focus:ring-4 focus:ring-white/30">
                <button type="submit" class="bg-white text-red-600 font-bold py-4 px-8 rounded-lg hover:bg-gray-100 transition-colors">
                    Subscribe
                </button>
            </form>
            
            <p class="text-sm mt-4 opacity-80">* Kami tidak akan mengirim spam. Unsubscribe kapan saja.</p>
        </div>
    </div>
</section>
@endsection