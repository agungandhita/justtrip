@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-[70vh] flex items-end overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent z-10"></div>
        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80' }}" 
             alt="{{ $article->title }}" 
             class="w-full h-full object-cover">
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-20 w-full pb-16 px-4">
        <div class="container mx-auto max-w-4xl">
            <!-- Breadcrumb -->
            <nav class="mb-6" data-aos="fade-up">
                <ol class="flex items-center space-x-2 text-white/80">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-white transition-colors">Artikel</a></li>
                    <li><i class="fas fa-chevron-right text-xs"></i></li>
                    <li class="text-white">{{ $article->title }}</li>
                </ol>
            </nav>
            
            <!-- Category Badge -->
            <div class="mb-4" data-aos="fade-up" data-aos-delay="100">
                <span class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-4 py-2 rounded-full text-sm font-semibold">
                    {{ $article->category }}
                </span>
            </div>
            
            <!-- Title -->
            <h1 class="text-3xl md:text-5xl font-bold text-white mb-6 leading-tight" data-aos="fade-up" data-aos-delay="200">
                {{ $article->title }}
            </h1>
            
            <!-- Article Meta -->
            <div class="flex flex-wrap items-center gap-6 text-white/90" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center">
                    <img src="{{ $article->author_image ? asset('storage/' . $article->author_image) : 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80' }}" 
                         alt="{{ $article->author_name }}" 
                         class="w-10 h-10 rounded-full mr-3 border-2 border-white/20">
                    <div>
                        <p class="font-semibold">{{ $article->author_name ?? 'Admin' }}</p>
                        <p class="text-sm text-white/70">Travel Writer</p>
                    </div>
                </div>
                <div class="flex items-center text-sm">
                    <i class="fas fa-calendar-alt mr-2"></i>
                    {{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}
                </div>
                <div class="flex items-center text-sm">
                    <i class="fas fa-clock mr-2"></i>
                    {{ $article->read_time ?? 5 }} min read
                </div>
                <div class="flex items-center text-sm">
                    <i class="fas fa-eye mr-2"></i>
                    {{ number_format($article->views) }} views
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Article Content -->
            <div class="lg:col-span-2">
                <!-- Article Excerpt -->
                @if($article->excerpt)
                <div class="bg-gradient-to-r from-teal-50 to-cyan-50 p-6 rounded-2xl mb-8 border-l-4 border-teal-500" data-aos="fade-up">
                    <p class="text-lg text-gray-700 font-medium leading-relaxed">
                        {{ $article->excerpt }}
                    </p>
                </div>
                @endif
                
                <!-- Social Share -->
                <div class="flex items-center justify-between mb-8 pb-6 border-b border-gray-200" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-lg font-semibold text-gray-800">Bagikan Artikel</h3>
                    <div class="flex items-center space-x-3">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" 
                           target="_blank" 
                           class="w-10 h-10 bg-blue-600 text-white rounded-full flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->url()) }}&text={{ urlencode($article->title) }}" 
                           target="_blank" 
                           class="w-10 h-10 bg-sky-500 text-white rounded-full flex items-center justify-center hover:bg-sky-600 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->url()) }}" 
                           target="_blank" 
                           class="w-10 h-10 bg-green-500 text-white rounded-full flex items-center justify-center hover:bg-green-600 transition-colors">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <button onclick="copyToClipboard('{{ request()->url() }}')" 
                                class="w-10 h-10 bg-gray-600 text-white rounded-full flex items-center justify-center hover:bg-gray-700 transition-colors">
                            <i class="fas fa-link"></i>
                        </button>
                    </div>
                </div>
                
                <!-- Article Content -->
                <div class="prose prose-lg max-w-none" data-aos="fade-up" data-aos-delay="200">
                    <div class="text-gray-700 leading-relaxed space-y-6">
                        {!! nl2br(e($article->content)) !!}
                    </div>
                </div>
                
                <!-- Gallery Images -->
                @if($article->gallery_images && count($article->gallery_images) > 0)
                <div class="mt-12" data-aos="fade-up">
                    <h3 class="text-2xl font-bold text-gray-800 mb-6">Galeri Foto</h3>
                    <div class="grid md:grid-cols-2 gap-4">
                        @foreach($article->gallery_images as $image)
                        <div class="group cursor-pointer" onclick="openImageModal('{{ asset('storage/' . $image) }}')">>
                            <img src="{{ asset('storage/' . $image) }}" 
                                 alt="Gallery Image" 
                                 class="w-full h-64 object-cover rounded-xl group-hover:scale-105 transition-transform duration-300">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Tags -->
                @if($article->tags && count($article->tags) > 0)
                <div class="mt-12 pt-8 border-t border-gray-200" data-aos="fade-up">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Tags</h3>
                    <div class="flex flex-wrap gap-2">
                        @foreach($article->tags as $tag)
                        <span class="bg-gray-100 text-gray-700 px-3 py-1 rounded-full text-sm hover:bg-teal-100 hover:text-teal-700 transition-colors cursor-pointer">
                            #{{ $tag }}
                        </span>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
            
            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Author Info -->
                <div class="bg-gradient-to-br from-teal-50 to-cyan-50 p-6 rounded-2xl mb-8" data-aos="fade-up">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Tentang Penulis</h3>
                    <div class="flex items-center mb-4">
                        <img src="{{ $article->author_image ? asset('storage/' . $article->author_image) : 'https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80' }}" 
                             alt="{{ $article->author_name }}" 
                             class="w-16 h-16 rounded-full mr-4 border-3 border-white shadow-lg">
                        <div>
                            <h4 class="font-semibold text-gray-800">{{ $article->author_name ?? 'Admin' }}</h4>
                            <p class="text-sm text-teal-600">Travel Writer & Blogger</p>
                        </div>
                    </div>
                    <p class="text-gray-600 text-sm leading-relaxed">
                        {{ $article->author_bio ?? 'Passionate travel writer yang suka berbagi pengalaman dan tips perjalanan untuk menginspirasi traveler lainnya.' }}
                    </p>
                </div>
                
                <!-- Article Stats -->
                <div class="bg-white border border-gray-200 p-6 rounded-2xl mb-8" data-aos="fade-up" data-aos-delay="100">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Statistik Artikel</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Dibaca</span>
                            <span class="font-semibold text-teal-600">{{ number_format($article->views) }}x</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Waktu Baca</span>
                            <span class="font-semibold text-teal-600">{{ $article->read_time ?? 5 }} menit</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Kategori</span>
                            <span class="font-semibold text-teal-600">{{ $article->category }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Dipublikasi</span>
                            <span class="font-semibold text-teal-600">{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Related Articles Sidebar -->
                @if($relatedArticles->count() > 0)
                <div class="bg-white border border-gray-200 p-6 rounded-2xl" data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-xl font-bold text-gray-800 mb-6">Artikel Terkait</h3>
                    <div class="space-y-4">
                        @foreach($relatedArticles as $related)
                        <a href="{{ route('articles.show', $related->slug) }}" class="block group">
                            <div class="flex space-x-3">
                                <img src="{{ $related->featured_image ? asset('storage/' . $related->featured_image) : 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                                     alt="{{ $related->title }}" 
                                     class="w-20 h-20 object-cover rounded-lg group-hover:scale-105 transition-transform duration-300">
                                <div class="flex-1">
                                    <h4 class="font-semibold text-gray-800 group-hover:text-teal-600 transition-colors line-clamp-2 mb-1">
                                        {{ $related->title }}
                                    </h4>
                                    <p class="text-xs text-gray-500">
                                        {{ $related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y') }}
                                    </p>
                                    <div class="flex items-center text-xs text-gray-400 mt-1">
                                        <i class="fas fa-eye mr-1"></i>
                                        {{ number_format($related->views) }}
                                    </div>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>

<!-- Related Articles Section -->
@if($relatedArticles->count() > 0)
<section class="py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12" data-aos="fade-up">
            <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Artikel Lainnya</h2>
            <p class="text-xl text-gray-600">Jelajahi artikel menarik lainnya seputar travel</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($relatedArticles as $index => $related)
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-shadow duration-300 group" 
                     data-aos="fade-up" 
                     data-aos-delay="{{ $index * 100 }}">
                <a href="{{ route('articles.show', $related->slug) }}" class="block">
                    <div class="relative overflow-hidden">
                        <img src="{{ $related->featured_image ? asset('storage/' . $related->featured_image) : 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80' }}" 
                             alt="{{ $related->title }}" 
                             class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">
                                {{ $related->category }}
                            </span>
                        </div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-teal-600 transition-colors line-clamp-2">
                            {{ $related->title }}
                        </h3>
                        @if($related->excerpt)
                        <p class="text-gray-600 mb-4 line-clamp-3">
                            {{ $related->excerpt }}
                        </p>
                        @endif
                        <div class="flex items-center justify-between text-sm text-gray-500">
                            <span>{{ $related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y') }}</span>
                            <div class="flex items-center">
                                <i class="fas fa-eye mr-1"></i>
                                {{ number_format($related->views) }}
                            </div>
                        </div>
                    </div>
                </a>
            </article>
            @endforeach
        </div>
        
        <div class="text-center mt-12" data-aos="fade-up">
            <a href="{{ route('articles.index') }}" 
               class="inline-flex items-center bg-gradient-to-r from-teal-600 to-cyan-600 text-white px-8 py-3 rounded-full font-semibold hover:from-teal-700 hover:to-cyan-700 transition-all duration-300 transform hover:scale-105">
                Lihat Semua Artikel
                <i class="fas fa-arrow-right ml-2"></i>
            </a>
        </div>
    </div>
</section>
@endif

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden items-center justify-center p-4">
    <div class="relative max-w-4xl max-h-full">
        <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300 z-10">
            <i class="fas fa-times"></i>
        </button>
        <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
    </div>
</div>

<script>
// Copy to clipboard function
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        // Show success message
        const button = event.target.closest('button');
        const originalIcon = button.innerHTML;
        button.innerHTML = '<i class="fas fa-check"></i>';
        button.classList.remove('bg-gray-600', 'hover:bg-gray-700');
        button.classList.add('bg-green-600', 'hover:bg-green-700');
        
        setTimeout(() => {
            button.innerHTML = originalIcon;
            button.classList.remove('bg-green-600', 'hover:bg-green-700');
            button.classList.add('bg-gray-600', 'hover:bg-gray-700');
        }, 2000);
    });
}

// Image modal functions
function openImageModal(imageSrc) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModal').classList.remove('hidden');
    document.getElementById('imageModal').classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    document.getElementById('imageModal').classList.add('hidden');
    document.getElementById('imageModal').classList.remove('flex');
    document.body.style.overflow = 'auto';
}

// Close modal when clicking outside
document.getElementById('imageModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeImageModal();
    }
});

// Initialize AOS
AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
});
</script>

<style>
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

.prose {
    color: #374151;
    line-height: 1.75;
}

.prose h1, .prose h2, .prose h3, .prose h4, .prose h5, .prose h6 {
    color: #1f2937;
    font-weight: 700;
    margin-top: 2rem;
    margin-bottom: 1rem;
}

.prose p {
    margin-bottom: 1.5rem;
}

.prose ul, .prose ol {
    margin-bottom: 1.5rem;
    padding-left: 1.5rem;
}

.prose li {
    margin-bottom: 0.5rem;
}

.prose blockquote {
    border-left: 4px solid #14b8a6;
    padding-left: 1rem;
    margin: 2rem 0;
    font-style: italic;
    background: #f0fdfa;
    padding: 1rem;
    border-radius: 0.5rem;
}
</style>
@endsection