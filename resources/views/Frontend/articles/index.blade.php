@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Background Images with Parallax Effect -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-teal-600/70 via-cyan-600/70 to-blue-600/70 z-10"></div>
        <div class="bg-cover bg-center h-full" style="background-image: url('https://images.unsplash.com/photo-1455390582262-044cdead277a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-20 text-center text-white px-4 max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-teal-100 bg-clip-text text-transparent">
            Travel Blog & Tips
        </h1>
        <p class="text-lg md:text-xl mb-8 text-teal-100 font-medium" data-aos="fade-up" data-aos-delay="200">
            Inspirasi perjalanan, tips travel, dan cerita menarik dari seluruh dunia
        </p>
    </div>
</section>

<!-- Featured Articles -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Artikel Pilihan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Artikel terbaru dan terpopuler untuk menginspirasi perjalanan Anda</p>
        </div>
        
        <div class="grid lg:grid-cols-2 gap-12 mb-16">
            <!-- Featured Article 1 -->
            <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="100">
                <div class="relative overflow-hidden rounded-2xl mb-6">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bali Hidden Gems" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Destinasi</span>
                    </div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <p class="text-sm opacity-80 mb-2">15 Januari 2024</p>
                        <h3 class="text-2xl font-bold mb-2">10 Hidden Gems di Bali yang Wajib Dikunjungi</h3>
                        <p class="text-sm opacity-90">Temukan tempat-tempat tersembunyi di Bali yang belum banyak diketahui wisatawan</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-semibold text-gray-800">Sarah Wijaya</p>
                            <p class="text-gray-500 text-sm">Travel Writer</p>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-500 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        5 min read
                    </div>
                </div>
            </div>
            
            <!-- Featured Article 2 -->
            <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                <div class="relative overflow-hidden rounded-2xl mb-6">
                    <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Budget Travel Tips" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Tips</span>
                    </div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <p class="text-sm opacity-80 mb-2">12 Januari 2024</p>
                        <h3 class="text-2xl font-bold mb-2">Cara Traveling Hemat dengan Budget Minim</h3>
                        <p class="text-sm opacity-90">Tips dan trik untuk menikmati perjalanan menarik tanpa menguras kantong</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-semibold text-gray-800">Andi Pratama</p>
                            <p class="text-gray-500 text-sm">Travel Expert</p>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-500 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        8 min read
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Categories -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-slate-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Kategori Artikel</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Jelajahi artikel berdasarkan kategori yang Anda minati</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-8">
            <!-- Travel Tips -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Travel Tips</h3>
                <p class="text-gray-600 text-center mb-6">Tips praktis untuk perjalanan yang lebih nyaman dan hemat</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-cyan-600">32</span>
                    <p class="text-gray-500 text-sm">artikel</p>
                </div>
            </div>
            
            <!-- Destinations -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Destinations</h3>
                <p class="text-gray-600 text-center mb-6">Panduan lengkap destinasi wisata menarik di seluruh dunia</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-emerald-600">45</span>
                    <p class="text-gray-500 text-sm">artikel</p>
                </div>
            </div>
            
            <!-- Company News -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-indigo-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Company News</h3>
                <p class="text-gray-600 text-center mb-6">Berita terbaru dan update dari perusahaan travel</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-purple-600">18</span>
                    <p class="text-gray-500 text-sm">artikel</p>
                </div>
            </div>
            
            <!-- Travel Guides -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-emerald-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Travel Guides</h3>
                <p class="text-gray-600 text-center mb-6">Panduan perjalanan lengkap untuk berbagai destinasi</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-green-600">28</span>
                    <p class="text-gray-500 text-sm">artikel</p>
                </div>
            </div>
            
            <!-- Promotions -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="500">
                <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Promotions</h3>
                <p class="text-gray-600 text-center mb-6">Promo dan penawaran menarik untuk perjalanan Anda</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-orange-600">15</span>
                    <p class="text-gray-500 text-sm">artikel</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Artikel Terbaru</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Update terbaru dari dunia travel dan tips perjalanan</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($articles as $index => $article)
            <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <a href="{{ route('articles.show', $article->slug) }}" class="block">
                    <div class="relative overflow-hidden">
                        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $article->category }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <p class="text-gray-500 text-sm mb-2">
                            {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                        </p>
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-emerald-600 transition-colors line-clamp-2">
                            {{ $article->title }}
                        </h3>
                        @if($article->excerpt)
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $article->excerpt }}
                        </p>
                        @endif
                        <div class="flex items-center justify-between">
                            <div class="flex items-center">
                                <img src="{{ $article->author_image ? asset('storage/' . $article->author_image) : 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80' }}" 
                                     alt="{{ $article->author_name }}" 
                                     class="w-8 h-8 rounded-full mr-2">
                                <span class="text-gray-700 text-sm font-medium">{{ $article->author_name ?? 'Admin' }}</span>
                            </div>
                            <div class="flex items-center text-gray-500 text-sm space-x-3">
                                <span>{{ $article->read_time ?? 5 }} min read</span>
                                <div class="flex items-center">
                                    <i class="fas fa-eye mr-1"></i>
                                    {{ number_format($article->views) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            @empty
            <div class="col-span-full text-center py-12">
                <div class="text-gray-400 mb-4">
                    <i class="fas fa-newspaper text-6xl"></i>
                </div>
                <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Artikel</h3>
                <p class="text-gray-500">Artikel akan segera hadir. Pantau terus untuk update terbaru!</p>
            </div>
            @endforelse
            
        </div>
        
        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="mt-12" data-aos="fade-up">
            {{ $articles->links() }}
        </div>
        @endif
    </div>
</section>

<!-- Newsletter Subscription -->
<section class="py-20 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
    <div class="container mx-auto px-4">
        <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden" data-aos="fade-up">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <h3 class="text-3xl md:text-4xl font-bold mb-4">Jangan Lewatkan Artikel Terbaru!</h3>
                <p class="text-xl mb-8 opacity-90">Subscribe newsletter kami dan dapatkan tips travel terbaru langsung di inbox Anda</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                    <input type="email" placeholder="Masukkan email Anda" class="flex-1 px-6 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-4 focus:ring-white/30">
                    <button class="bg-white text-purple-600 font-bold px-8 py-3 rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                        Subscribe
                    </button>
                </div>
                <p class="text-sm opacity-75 mt-4">Gratis dan bisa unsubscribe kapan saja</p>
            </div>
        </div>
    </div>
</section>
@endsection