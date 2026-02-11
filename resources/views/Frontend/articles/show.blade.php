@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-[60vh] md:min-h-[75vh] flex items-end overflow-hidden">
    <!-- Background Image -->
    <div class="absolute inset-0 z-0">
        <!-- Premium Dual Overlay -->
        <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-black/20 z-10"></div>
        <div class="absolute inset-0 bg-blue-900/10 mix-blend-overlay z-10"></div>
        
        <img src="{{ $article->featured_image ? asset('storage/' . $article->featured_image) : 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80' }}" 
             alt="{{ $article->title }}" 
             class="w-full h-full object-cover transform scale-105 hover:scale-100 transition-transform duration-[10s] ease-out">
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-20 w-full pb-12 sm:pb-20 px-4">
        <div class="container mx-auto max-w-5xl">
            <!-- Breadcrumb -->
            <nav class="mb-8 hidden sm:block" data-aos="fade-up">
                <ol class="flex items-center space-x-2 text-white/70 text-sm font-medium">
                    <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a></li>
                    <li><i class="fas fa-chevron-right text-[10px]"></i></li>
                    <li><a href="{{ route('articles.index') }}" class="hover:text-white transition-colors">Artikel</a></li>
                    <li><i class="fas fa-chevron-right text-[10px]"></i></li>
                    <li class="text-white truncate max-w-[200px]">{{ $article->title }}</li>
                </ol>
            </nav>
            
            <div class="max-w-4xl">
                <!-- Category Badge -->
                <div class="mb-6" data-aos="fade-up" data-aos-delay="100">
                    <span class="inline-block bg-orange-500 text-white px-5 py-2 rounded-xl text-xs sm:text-sm font-bold uppercase tracking-widest shadow-lg shadow-orange-500/30">
                        {{ $article->category }}
                    </span>
                </div>
                
                <!-- Title -->
                <h1 class="text-3xl md:text-5xl lg:text-6xl font-black text-white mb-8 leading-[1.15] tracking-tight" data-aos="fade-up" data-aos-delay="200">
                    {{ $article->title }}
                </h1>
                
                <!-- Article Meta (Glassmorphism) -->
                <div class="flex flex-wrap items-center gap-4 sm:gap-8 bg-white/10 backdrop-blur-md border border-white/20 p-4 sm:p-6 rounded-2xl sm:inline-flex" data-aos="fade-up" data-aos-delay="300">
                    <div class="flex items-center text-white">
                        <div class="w-10 h-10 bg-gradient-to-br from-teal-400 to-blue-500 rounded-lg flex items-center justify-center mr-3 shadow-inner">
                            <i class="fas fa-user-edit text-sm"></i>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold tracking-wider text-white/60 mb-0.5">Penulis</p>
                            <p class="text-sm font-bold">{{ $article->author_name ?? 'Admin JustTrip' }}</p>
                        </div>
                    </div>
                    
                    <div class="hidden sm:block w-px h-10 bg-white/20"></div>
                    
                    <div class="flex items-center text-white">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-calendar-alt text-sm text-orange-400"></i>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold tracking-wider text-white/60 mb-0.5">Tanggal</p>
                            <p class="text-sm font-bold">{{ $article->published_at ? $article->published_at->format('d M Y') : $article->created_at->format('d M Y') }}</p>
                        </div>
                    </div>

                    <div class="hidden sm:block w-px h-10 bg-white/20"></div>

                    <div class="flex items-center text-white">
                        <div class="w-10 h-10 bg-white/10 rounded-lg flex items-center justify-center mr-3">
                            <i class="fas fa-clock text-sm text-teal-400"></i>
                        </div>
                        <div>
                            <p class="text-[10px] uppercase font-bold tracking-wider text-white/60 mb-0.5">Waktu Baca</p>
                            <p class="text-sm font-bold">{{ $article->read_time ?? 5 }} Menit</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Page Layout -->
<section class="py-12 md:py-20 bg-gray-50">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-12 gap-8 lg:gap-16">
            
            <!-- Left Content Column -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[2rem] p-6 md:p-12 shadow-xl shadow-gray-200/50 border border-gray-100">
                    
                    <!-- Lead/Excerpt -->
                    @if($article->excerpt)
                    <div class="relative mb-12" data-aos="fade-up">
                        <div class="absolute -left-6 md:-left-12 top-0 bottom-0 w-2 bg-gradient-to-b from-teal-500 to-blue-500 rounded-full opacity-50"></div>
                        <p class="text-xl md:text-2xl text-gray-800 font-bold leading-relaxed italic">
                            "{{ $article->excerpt }}"
                        </p>
                    </div>
                    @endif

                    <!-- Article Body Content -->
                    <div class="article-content-wrapper prose prose-lg prose-teal max-w-none" data-aos="fade-up" data-aos-delay="100">
                        <div class="text-gray-700 leading-relaxed text-lg">
                            {!! $article->content !!}
                        </div>
                    </div>

                    <!-- Photo Gallery Section Removed - gallery_images field no longer exists -->

                    <!-- Bottom Tags & Share -->
                    <div class="mt-16 pt-12 border-t border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-8" data-aos="fade-up">
                        <!-- Tags -->
                        <div>
                            <h4 class="text-sm font-black uppercase tracking-wider text-gray-400 mb-4">Topik Terkait</h4>
                            <div class="flex flex-wrap gap-2">
                                <span class="bg-gray-100 text-gray-700 px-4 py-2 rounded-xl text-sm font-bold uppercase">{{ $article->category }}</span>
                            </div>
                        </div>

                        <!-- Share -->
                        <div>
                            <h4 class="text-sm font-black uppercase tracking-wider text-gray-400 mb-4 md:text-right">Bagikan Cerita</h4>
                            <div class="flex items-center gap-3">
                                <a href="https://wa.me/?text={{ urlencode($article->title . ' - ' . request()->url()) }}" target="_blank" class="w-12 h-12 bg-green-500 hover:bg-green-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-green-200 transition-transform hover:-translate-y-1">
                                    <i class="fab fa-whatsapp text-xl"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->url()) }}" target="_blank" class="w-12 h-12 bg-blue-600 hover:bg-blue-700 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-blue-200 transition-transform hover:-translate-y-1">
                                    <i class="fab fa-facebook-f text-xl"></i>
                                </a>
                                <button onclick="copyToClipboard('{{ request()->url() }}')" class="w-12 h-12 bg-gray-800 hover:bg-black text-white rounded-2xl flex items-center justify-center shadow-lg shadow-gray-200 transition-transform hover:-translate-y-1 share-copy-btn">
                                    <i class="fas fa-link text-xl"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Sidebar Column -->
            <div class="lg:col-span-4 space-y-8">
                
                <!-- Author Card (No Photo version) -->
                <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-gray-200/50 border border-gray-100" data-aos="fade-left">
                    <h3 class="text-xs uppercase tracking-[0.2em] font-black text-teal-600 mb-6">Tentang Penulis</h3>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-2 h-8 bg-teal-500 rounded-full"></div>
                            <h4 class="text-xl font-black text-gray-900">{{ $article->author_name ?? 'Admin JustTrip' }}</h4>
                        </div>
                        <p class="text-gray-500 text-sm font-bold uppercase tracking-wide">Travel Writer & Content Specialist</p>
                        <p class="text-gray-600 leading-relaxed text-sm">
                            Berdedikasi untuk memberikan inspirasi dan panduan perjalanan terbaik untuk Anda. Menjelajahi setiap sudut nusantara dengan penuh semangat.
                        </p>
                    </div>
                </div>

                <!-- Stats Sidebar -->
                <div class="bg-navy-900 bg-gray-900 rounded-[2rem] p-8 text-white shadow-2xl overflow-hidden relative" data-aos="fade-left" data-aos-delay="100">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-teal-500/20 rounded-full blur-3xl -mr-16 -mt-16"></div>
                    <h3 class="text-xs uppercase tracking-[0.2em] font-black text-teal-400 mb-8 relative z-10">Statistik Artikel</h3>
                    
                    <div class="space-y-6 relative z-10">
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center gap-3 text-gray-400 font-bold text-sm">
                                <i class="fas fa-eye w-5"></i>
                                Total Pembaca
                            </div>
                            <span class="text-lg font-black text-white">{{ number_format($article->views) }}</span>
                        </div>
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center gap-3 text-gray-400 font-bold text-sm">
                                <i class="fas fa-clock w-5"></i>
                                Estimasi Baca
                            </div>
                            <span class="text-lg font-black text-white">{{ $article->read_time ?? 5 }} Menit</span>
                        </div>
                        <div class="flex items-center justify-between group">
                            <div class="flex items-center gap-3 text-gray-400 font-bold text-sm">
                                <i class="fas fa-folder-open w-5"></i>
                                Kategori
                            </div>
                            <span class="text-lg font-black text-teal-400">{{ $article->category }}</span>
                        </div>
                    </div>
                </div>

                <!-- Related Sidebar -->
                @if($relatedArticles->count() > 0)
                <div class="bg-white rounded-[2rem] p-8 shadow-xl shadow-gray-200/50 border border-gray-100" data-aos="fade-left" data-aos-delay="200">
                    <h3 class="text-xs uppercase tracking-[0.2em] font-black text-orange-500 mb-8">Artikel Terkait</h3>
                    <div class="space-y-8">
                        @foreach($relatedArticles->take(3) as $related)
                        <a href="{{ route('articles.show', $related->slug) }}" class="group block">
                            <div class="flex gap-4">
                                <div class="relative flex-shrink-0 w-20 h-20 overflow-hidden rounded-2xl">
                                    <img src="{{ $related->featured_image ? asset('storage/' . $related->featured_image) : 'https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80' }}" 
                                         alt="{{ $related->title }}" 
                                         class="w-full h-full object-cover transform transition-transform duration-500 group-hover:scale-125">
                                </div>
                                <div class="flex flex-col justify-center">
                                    <h4 class="text-sm font-black text-gray-900 group-hover:text-teal-600 transition-colors line-clamp-2 mb-1">
                                        {{ $related->title }}
                                    </h4>
                                    <p class="text-[10px] uppercase font-bold text-gray-400 tracking-wider">
                                        {{ $related->published_at ? $related->published_at->format('d M Y') : $related->created_at->format('d M Y') }}
                                    </p>
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

<!-- Bottom Navigation Section -->
<section class="py-16 bg-white border-t border-gray-100">
    <div class="container mx-auto px-4 max-w-5xl">
        <div class="flex flex-col sm:flex-row items-center justify-between gap-8">
            <div class="text-center sm:text-left">
                <h2 class="text-2xl font-black text-gray-900 mb-2">Ingin tahu lebih banyak?</h2>
                <p class="text-gray-500 font-medium">Jelajahi ratusan artikel dan tips perjalanan lainnya.</p>
            </div>
            <a href="{{ route('articles.index') }}" class="group inline-flex items-center px-8 py-4 bg-teal-600 text-white rounded-2xl font-black shadow-xl shadow-teal-200 transition-all hover:bg-teal-700 hover:scale-105 active:scale-95">
                Lihat Semua Artikel
                <i class="fas fa-long-arrow-alt-right ml-3 transition-transform group-hover:translate-x-2"></i>
            </a>
        </div>
    </div>
</section>

<!-- Image Modal -->
<div id="imageModal" class="fixed inset-0 bg-black/95 z-[99] hidden items-center justify-center p-4 backdrop-blur-sm">
    <div class="relative w-full max-w-6xl max-h-full">
        <button onclick="closeImageModal()" class="absolute -top-12 right-0 text-white text-3xl hover:text-gray-300 transition-all">
            <i class="fas fa-times"></i>
        </button>
        <div class="flex items-center justify-center h-full">
            <img id="modalImage" src="" alt="Fullscreen view" class="max-w-full max-h-[85vh] object-contain rounded-xl shadow-2xl">
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(function() {
        const btn = document.querySelector('.share-copy-btn');
        const icon = btn.querySelector('i');
        const originalClass = icon.className;
        
        icon.className = 'fas fa-check';
        btn.classList.add('bg-green-600');
        
        setTimeout(() => {
            icon.className = originalClass;
            btn.classList.remove('bg-green-600');
        }, 2000);
    });
}

function openImageModal(imgSrc) {
    const modal = document.getElementById('imageModal');
    const modalImg = document.getElementById('modalImage');
    modalImg.src = imgSrc;
    modal.classList.remove('hidden');
    modal.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeImageModal() {
    const modal = document.getElementById('imageModal');
    modal.classList.add('hidden');
    modal.classList.remove('flex');
    document.body.style.overflow = '';
}

// Close on escape key
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape') closeImageModal();
});
</script>

<style>
/* Reset Prose for Custom Travel Styling */
.article-content-wrapper {
    color: #334155; /* slate-700 */
}
.article-content-wrapper h2, 
.article-content-wrapper h3, 
.article-content-wrapper h4 {
    color: #0f172a; /* slate-900 */
    font-weight: 900;
    margin-top: 2.5rem;
    margin-bottom: 1.25rem;
    line-height: 1.2;
}
.article-content-wrapper h2 { font-size: 2rem; }
.article-content-wrapper h3 { font-size: 1.5rem; }

.article-content-wrapper p {
    margin-bottom: 1.75rem;
    line-height: 1.8;
}

.article-content-wrapper ul, 
.article-content-wrapper ol {
    margin-bottom: 2rem;
    padding-left: 1.5rem;
}

.article-content-wrapper li {
    margin-bottom: 0.75rem;
    position: relative;
}

.article-content-wrapper blockquote {
    border-left: 6px solid #14b8a6;
    background: #f0fdfa;
    padding: 2rem;
    margin: 3rem 0;
    font-style: italic;
    font-weight: 600;
    font-size: 1.25rem;
    color: #0d9488;
    border-radius: 0 1.5rem 1.5rem 0;
}

.article-content-wrapper img {
    border-radius: 1.5rem;
    margin: 3rem 0;
    box-shadow: 0 20px 25px -5px rgb(0 0 0 / 0.1);
}

.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endsection