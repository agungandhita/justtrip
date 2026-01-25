@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative w-full">
    <img src="{{ asset('image/TRAVEL-BLOG.png') }}" alt="Paket Tour Background" class="w-full h-auto">
</section>

<!-- Featured Article Section -->
@if($featuredArticles->count() > 0)
<section class="py-16 md:py-24 bg-gray-50 overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6" data-aos="fade-up">
            <div>
                <span class="text-orange-500 font-black uppercase tracking-[0.2em] text-xs mb-3 block">Top Picks</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight">Artikel Pilihan</h2>
            </div>
            <p class="text-gray-500 font-medium max-w-md md:text-right">
                Inspirasi dan panduan terbaik yang kami kurasi khusus untuk petualangan Anda selanjutnya.
            </p>
        </div>

        <!-- Featured Layout -->
        <div class="grid lg:grid-cols-12 gap-8">
            @php $mainFeatured = $featuredArticles->first(); @endphp
            
            <!-- Main Featured Article (Larger) -->
            <div class="lg:col-span-12 group" data-aos="fade-up">
                <a href="{{ route('articles.show', $mainFeatured->slug) }}" class="relative block bg-white rounded-[2.5rem] overflow-hidden shadow-2xl shadow-gray-200/50 border border-gray-100 h-full">
                    <div class="grid md:grid-cols-2 h-full">
                        <div class="relative overflow-hidden h-80 md:h-full">
                            <img src="{{ $mainFeatured->featured_image ? asset('storage/' . $mainFeatured->featured_image) : 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' }}" 
                                 alt="{{ $mainFeatured->title }}" 
                                 class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute top-6 left-6">
                                <span class="bg-orange-500 text-white px-4 py-1.5 rounded-xl text-xs font-bold uppercase tracking-widest shadow-lg shadow-orange-500/30">
                                    {{ $mainFeatured->category ?? 'Featured' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-8 md:p-12 lg:p-16 flex flex-col justify-center">
                            <div class="flex items-center gap-4 mb-6 text-gray-400 text-sm font-bold uppercase tracking-widest">
                                <span>{{ ($mainFeatured->published_at ?? $mainFeatured->created_at)->format('d M Y') }}</span>
                                <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                <span>{{ $mainFeatured->read_time ?? 5 }} min read</span>
                            </div>
                            <h3 class="text-3xl md:text-4xl lg:text-5xl font-black text-gray-900 mb-6 group-hover:text-teal-600 transition-colors leading-tight">
                                {{ $mainFeatured->title }}
                            </h3>
                            <p class="text-gray-600 text-lg md:text-xl leading-relaxed mb-8 line-clamp-3">
                                {{ $mainFeatured->excerpt }}
                            </p>
                            <div class="flex items-center justify-between mt-auto pt-6 border-t border-gray-50">
                                <div class="flex flex-col">
                                    <span class="text-[10px] uppercase font-bold text-gray-400 tracking-wider mb-1">Dibuat Oleh</span>
                                    <span class="text-gray-900 font-black">{{ $mainFeatured->author_name ?? 'Admin JustTrip' }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-teal-600 font-black uppercase text-sm group-hover:translate-x-2 transition-transform">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </a>
            </div>

            <!-- Other Featured (Optional second/third) -->
            @foreach($featuredArticles->skip(1)->take(2) as $index => $featured)
            <div class="lg:col-span-6 group" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <a href="{{ route('articles.show', $featured->slug) }}" class="block bg-white rounded-[2rem] overflow-hidden shadow-xl shadow-gray-200/50 border border-gray-100 h-full">
                    <div class="relative h-64 overflow-hidden">
                        <img src="{{ $featured->featured_image ? asset('storage/' . $featured->featured_image) : 'https://images.unsplash.com/photo-1506929562872-bb421503ef21?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                             alt="{{ $featured->title }}" 
                             class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                        <div class="absolute top-4 left-4">
                            <span class="bg-white/90 backdrop-blur-md text-gray-900 px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg">
                                {{ $featured->category }}
                            </span>
                        </div>
                    </div>
                    <div class="p-8">
                        <div class="flex items-center gap-3 mb-4 text-xs font-bold text-gray-400 uppercase tracking-widest">
                            <span>{{ ($featured->published_at ?? $featured->created_at)->format('d M Y') }}</span>
                            <span>•</span>
                            <span>{{ $featured->read_time ?? 5 }} min read</span>
                        </div>
                        <h3 class="text-2xl font-black text-gray-900 mb-4 group-hover:text-teal-600 transition-colors line-clamp-2">
                            {{ $featured->title }}
                        </h3>
                        <div class="flex items-center justify-between mt-6 pt-6 border-t border-gray-50">
                            <span class="text-gray-900 font-bold text-sm">{{ $featured->author_name ?? 'Admin JustTrip' }}</span>
                            <i class="fas fa-long-arrow-alt-right text-teal-600 transform group-hover:translate-x-2 transition-transform"></i>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<!-- Article Categories -->
<section class="py-20 bg-white relative overflow-hidden">
    <!-- Decorative Elements -->
    <div class="absolute top-0 left-0 w-64 h-64 bg-teal-50 rounded-full blur-[100px] -ml-32 -mt-32 opacity-60"></div>
    <div class="absolute bottom-0 right-0 w-80 h-80 bg-orange-50 rounded-full blur-[120px] -mr-40 -mb-40 opacity-60"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="text-teal-600 font-black uppercase tracking-[0.2em] text-xs mb-3 block">Explore</span>
            <h2 class="text-4xl md:text-5xl font-black text-gray-900 mb-4">Kategori Populer</h2>
            <div class="w-20 h-1.5 bg-gradient-to-r from-teal-500 to-blue-500 mx-auto rounded-full"></div>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 md:gap-8">
            @php
                $colorSets = [
                    ['bg' => 'from-teal-500 to-emerald-500', 'light' => 'bg-teal-50', 'text' => 'text-teal-600'],
                    ['bg' => 'from-orange-500 to-red-500', 'light' => 'bg-orange-50', 'text' => 'text-orange-600'],
                    ['bg' => 'from-blue-500 to-indigo-500', 'light' => 'bg-blue-50', 'text' => 'text-blue-600'],
                    ['bg' => 'from-purple-500 to-pink-500', 'light' => 'bg-purple-50', 'text' => 'text-purple-600'],
                ];
            @endphp

            @forelse($categoryStats as $i => $stat)
            <a href="{{ route('articles.index', ['category' => $stat->category]) }}" 
               class="group relative bg-white rounded-[2rem] p-6 lg:p-8 shadow-xl shadow-gray-100 border border-gray-100 flex flex-col items-center text-center transition-all duration-500 hover:scale-105 hover:shadow-2xl hover:border-teal-100" 
               data-aos="fade-up" 
               data-aos-delay="{{ ($i % 4) * 100 }}">
                <div class="w-20 h-20 rounded-3xl bg-gradient-to-br {{ $colorSets[$i % count($colorSets)]['bg'] }} flex items-center justify-center mb-6 shadow-lg transform group-hover:rotate-6 transition-all duration-500">
                    <i class="fas fa-paper-plane text-white text-3xl"></i>
                </div>
                <h3 class="text-lg lg:text-xl font-black text-gray-900 mb-2 truncate w-full">{{ $stat->category }}</h3>
                <div class="flex items-baseline gap-1 {{ $colorSets[$i % count($colorSets)]['text'] }}">
                    <span class="text-3xl font-black">{{ $stat->total }}</span>
                    <span class="text-sm font-bold uppercase tracking-widest opacity-60">Artikel</span>
                </div>
            </a>
            @empty
            <div class="col-span-full py-12 text-center bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200">
                <p class="text-gray-400 font-bold uppercase tracking-widest">Belum Ada Kategori</p>
            </div>
            @endforelse
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-16 gap-6" data-aos="fade-up">
            <div>
                <span class="text-orange-500 font-black uppercase tracking-[0.2em] text-xs mb-3 block">Freshly Published</span>
                <h2 class="text-4xl md:text-5xl font-black text-gray-900 tracking-tight">Artikel Terbaru</h2>
            </div>
            @if(request('category'))
                <div class="bg-teal-100 text-teal-700 px-6 py-2 rounded-2xl font-black uppercase text-sm flex items-center gap-3">
                    Filtered: {{ request('category') }}
                    <a href="{{ route('articles.index') }}" class="hover:text-teal-900"><i class="fas fa-times-circle"></i></a>
                </div>
            @endif
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 lg:gap-12">
            @forelse($articles as $index => $article)
            <article class="group bg-white rounded-[2rem] overflow-hidden shadow-xl shadow-gray-200/40 border border-gray-100 flex flex-col" data-aos="fade-up" data-aos-delay="{{ $index % 3 * 100 }}">
                <a href="{{ route('articles.show', $article->slug) }}" class="relative h-64 overflow-hidden">
                    <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80' }}" 
                         alt="{{ $article->title }}" 
                         class="w-full h-full object-cover transform transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-teal-500 text-white px-4 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-teal-500/30">
                            {{ $article->category }}
                        </span>
                    </div>
                </a>
                <div class="p-8 flex flex-col flex-grow">
                    <div class="flex items-center gap-3 mb-6">
                        <div class="w-1 h-3 bg-orange-500 rounded-full"></div>
                        <span class="text-xs font-bold text-gray-400 mt-0.5 uppercase tracking-widest">
                            {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                        </span>
                    </div>
                    <h3 class="text-2xl font-black text-gray-900 mb-4 group-hover:text-teal-600 transition-colors leading-snug line-clamp-2">
                        <a href="{{ route('articles.show', $article->slug) }}">{{ $article->title }}</a>
                    </h3>
                    <p class="text-gray-500 leading-relaxed mb-8 line-clamp-3 text-sm font-medium">
                        {{ $article->excerpt }}
                    </p>
                    
                    <div class="mt-auto pt-6 border-t border-gray-50 flex items-center justify-between">
                        <div class="flex flex-col">
                            <span class="text-[9px] uppercase font-black text-gray-400 tracking-wider mb-0.5">Penulis</span>
                            <span class="text-gray-900 font-extrabold text-sm">{{ $article->author_name ?? 'Admin JustTrip' }}</span>
                        </div>
                        <div class="flex items-center gap-3 text-gray-400 text-xs font-bold">
                            <span class="flex items-center gap-1.5">
                                <i class="far fa-eye text-teal-500 text-sm"></i>
                                {{ number_format($article->views) }}
                            </span>
                        </div>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full py-20 text-center bg-white rounded-[3rem] shadow-inner">
                <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-newspaper text-3xl text-gray-300"></i>
                </div>
                <h3 class="text-2xl font-black text-gray-900 mb-2">Belum Ada Artikel</h3>
                <p class="text-gray-500 font-medium">Kami sedang menyiapkan cerita menarik untuk Anda. Pantau terus!</p>
            </div>
            @endforelse
        </div>
        
        <!-- Pagination -->
        @if($articles->hasPages())
        <div class="mt-20 flex justify-center" data-aos="fade-up">
            <div class="inline-block bg-white p-2 rounded-2xl shadow-xl border border-gray-100">
                {{ $articles->links() }}
            </div>
        </div>
        @endif
    </div>
</section>

<style>
/* Custom Pagination Styling Overrides */
.pagination {
    display: flex;
    gap: 0.5rem;
}
.page-item .page-link {
    border: none;
    border-radius: 0.75rem;
    padding: 0.75rem 1rem;
    font-weight: 800;
    color: #475569;
    transition: all 0.3s;
}
.page-item.active .page-link {
    background-color: #0d9488;
    color: white;
    box-shadow: 0 10px 15px -3px rgb(13 148 136 / 0.3);
}
.page-item:hover:not(.active) .page-link {
    background-color: #f1f5f9;
    color: #0d9488;
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
</style>

@endsection