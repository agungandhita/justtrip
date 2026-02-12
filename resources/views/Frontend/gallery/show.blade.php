@extends('Frontend.layouts.main')

@section('container')

<!-- Minimalist Hero Banner -->
<!-- Hero Section -->
<section class="relative w-full">
    <img src="{{ asset('image/GALLERY.png') }}" alt="Paket Tour Background" class="w-full h-auto">
</section>


<!-- Gallery Detail Content -->
<section class="pb-20 bg-white">
    <!-- Main Content Container -->
    <div class="container mx-auto px-4 max-w-7xl -mt-10 md:-mt-16 relative z-10">
        
        <!-- Main Image Card -->
        @if($gallery->images && count($gallery->images) > 0)
            <div class="mb-10" data-aos="zoom-in">
                <div class="relative rounded-[2rem] md:rounded-[3rem] overflow-hidden shadow-[0_25px_80px_rgba(0,0,0,0.15)] group cursor-pointer" onclick="openLightbox(currentImageIndex)">
                    <img id="main-image" src="{{ Storage::url($gallery->main_image ?? $gallery->images[0]) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-full h-[40vh] md:h-[70vh] object-cover transition-all duration-1000 group-hover:scale-105">
                    
                    <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gradient-to-t from-black/60 to-transparent"></div>
                    
                    <div class="absolute bottom-6 left-6 md:bottom-10 md:left-10 text-white">
                        <p class="text-[10px] md:text-xs font-black uppercase tracking-[0.3em] opacity-70 mb-2">Wonderful Journey</p>
                        <p class="text-xl md:text-3xl font-black tracking-tight">{{ $gallery->title }}</p>
                    </div>

                    <div class="absolute bottom-6 right-6 md:bottom-10 md:right-10 flex items-center gap-3">
                        <div class="bg-white/10 backdrop-blur-xl border border-white/20 px-4 py-2 rounded-2xl text-[10px] md:text-xs font-black text-white tracking-widest">
                            <span id="image-counter">1 / {{ count($gallery->images) }}</span>
                        </div>
                        <div class="w-10 h-10 md:w-12 md:h-12 bg-teal-500 rounded-2xl flex items-center justify-center text-white shadow-xl hover:rotate-12 transition-transform">
                            <i class="fas fa-expand"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Thumbnail Strip -->
            <div class="mb-16 -mt-4" data-aos="fade-up">
                <div class="flex gap-3 md:gap-5 overflow-x-auto pb-6 scrollbar-thin px-2 justify-start md:justify-center" id="thumbnailStrip">
                    @foreach($gallery->images as $index => $image)
                        <div class="thumbnail flex-shrink-0 cursor-pointer rounded-xl md:rounded-2xl overflow-hidden transition-all duration-500 border-2 {{ $index === 0 ? 'border-teal-500 scale-110 shadow-lg shadow-teal-500/20' : 'border-transparent opacity-60 grayscale hover:grayscale-0 hover:opacity-100 ring-4 ring-transparent' }}" 
                             data-index="{{ $index }}" 
                             data-image="{{ Storage::url($image) }}"
                             onclick="showImage({{ $index }})">
                            <img src="{{ Storage::url($image) }}" alt="Foto {{ $index + 1 }}" class="w-20 h-16 md:w-36 md:h-24 object-cover">
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <!-- Rest of the Info Sections -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 md:gap-16 items-start">
            
            <!-- Left Side: Content -->
            <div class="lg:col-span-8 space-y-12">
                <!-- About Description -->
                <div class="relative" data-aos="fade-up">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-1.5 h-10 bg-teal-500 rounded-full"></div>
                        <h3 class="text-2xl md:text-4xl font-black text-gray-900 tracking-tight italic">Cerita Perjalanan</h3>
                    </div>
                    <div class="prose prose-lg max-w-none text-gray-600 leading-[1.8] font-medium">
                        @if($gallery->description)
                            {!! nl2br(e($gallery->description)) !!}
                        @else
                            <p class="italic text-gray-400 font-normal">Belum ada deskripsi yang ditambahkan untuk galeri ini.</p>
                        @endif
                    </div>
                </div>

                <!-- Highlights Section -->
                @if($gallery->trip_highlights)
                <div class="bg-gray-50 rounded-[2.5rem] p-8 md:p-14 border border-gray-100 relative overflow-hidden" data-aos="fade-up">
                    <div class="absolute top-0 right-0 p-10 opacity-5">
                        <i class="fas fa-quote-right text-9xl"></i>
                    </div>
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-teal-500 rounded-2xl flex items-center justify-center text-white shadow-lg">
                            <i class="fas fa-star text-lg"></i>
                        </div>
                        <h3 class="text-xl md:text-2xl font-black text-gray-900 tracking-tight">Highlight Trip</h3>
                    </div>
                    <div class="text-gray-700 leading-[1.8] text-lg font-bold">
                        {!! nl2br(e($gallery->trip_highlights)) !!}
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Side: Trip Details -->
            <div class="lg:col-span-4" data-aos="fade-up">
                <div class="bg-gray-50/50 rounded-[2.5rem] p-8 md:p-10 border border-gray-100 sticky top-10">
                    <h3 class="text-xl font-black text-gray-900 mb-8 pb-4 border-b border-gray-200/50">Detail Perjalanan</h3>

                    <div class="space-y-4 mb-10">
                        @php
                            $details = [
                                ['icon' => 'fa-map-marker-alt', 'label' => 'Destinasi', 'value' => $gallery->destination, 'color' => 'text-red-500', 'bg' => 'bg-red-50'],
                                ['icon' => 'fa-calendar-alt', 'label' => 'Waktu', 'value' => $gallery->trip_date ? $gallery->trip_date->translatedFormat('d F Y') : '-', 'color' => 'text-blue-500', 'bg' => 'bg-blue-50'],
                                ['icon' => 'fa-th-large', 'label' => 'Kategori', 'value' => ucfirst($gallery->category), 'color' => 'text-purple-500', 'bg' => 'bg-purple-50'],
                                ['icon' => 'fa-users', 'label' => 'Peserta', 'value' => ($gallery->participants_count ?? 0) . ' Orang', 'color' => 'text-green-500', 'bg' => 'bg-green-50'],
                                ['icon' => 'fa-camera', 'label' => 'Fotografer', 'value' => $gallery->photographer ?? '-', 'color' => 'text-amber-500', 'bg' => 'bg-amber-50'],
                            ];
                        @endphp

                        @foreach($details as $detail)
                            <div class="flex items-center gap-4 p-4 bg-white rounded-2xl border border-gray-100 shadow-sm hover:shadow-md transition-shadow">
                                <div class="w-12 h-12 {{ $detail['bg'] }} {{ $detail['color'] }} rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas {{ $detail['icon'] }} text-lg"></i>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-[9px] text-gray-400 uppercase tracking-[0.2em] font-black mb-0.5">{{ $detail['label'] }}</p>
                                    <p class="text-gray-900 font-bold text-sm truncate">{{ $detail['value'] }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Tags -->
                    <div class="space-y-4 mb-8">
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-black">Tags Perjalanan</p>
                        <div class="flex flex-wrap gap-2">
                            @if($gallery->tags && count($gallery->tags) > 0)
                                @foreach($gallery->tags as $tag)
                                    <span class="bg-white border border-gray-100 text-gray-500 px-4 py-2 rounded-xl text-xs font-bold hover:border-teal-500 hover:text-teal-600 transition-all cursor-default shadow-sm">
                                        #{{ $tag }}
                                    </span>
                                @endforeach
                            @else
                                <span class="text-xs text-gray-400 italic">No tags listed</span>
                            @endif
                        </div>
                    </div>

                    <!-- Action -->
                    <button onclick="shareGallery()" class="w-full bg-gray-900 hover:bg-teal-600 text-white py-5 rounded-3xl font-black transition-all duration-300 shadow-xl flex items-center justify-center gap-3 group">
                        <i class="fas fa-share-alt group-hover:rotate-12 transition-transform"></i>
                        <span>Bagikan Momen</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Navigation (Prev/Next) -->
@if($previousGallery || $nextGallery)
    <div class="max-w-7xl mx-auto px-4 mb-20" data-aos="fade-up">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
            @if($previousGallery)
                <a href="{{ route('gallery.show', $previousGallery->slug) }}" class="group flex items-center gap-6 bg-white hover:bg-[#F0FFF4]/30 rounded-[2.5rem] p-6 shadow-sm hover:shadow-2xl border border-gray-100 transition-all duration-500">
                    <div class="flex-shrink-0">
                        <div class="w-14 h-14 bg-gray-50 group-hover:bg-white rounded-2xl flex items-center justify-center transition-all duration-500 shadow-sm">
                            <i class="fas fa-arrow-left text-gray-400 group-hover:text-[#38B2AC] text-lg transition-colors"></i>
                        </div>
                    </div>
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-2">Sebelumnya</p>
                        <p class="text-gray-800 font-extrabold text-lg truncate group-hover:text-[#38B2AC] transition-colors">{{ $previousGallery->title }}</p>
                    </div>
                    @if($previousGallery->main_image)
                        <img src="{{ Storage::url($previousGallery->main_image) }}" alt="{{ $previousGallery->title }}" class="w-20 h-20 rounded-[1.5rem] object-cover flex-shrink-0 ring-4 ring-transparent group-hover:ring-[#B2F5EA] transition-all">
                    @endif
                </a>
            @else
                <div></div>
            @endif
            
            @if($nextGallery)
                <a href="{{ route('gallery.show', $nextGallery->slug) }}" class="group flex items-center gap-6 bg-white hover:bg-[#F0FFF4]/30 rounded-[2.5rem] p-6 shadow-sm hover:shadow-2xl border border-gray-100 transition-all duration-500 text-right">
                    @if($nextGallery->main_image)
                        <img src="{{ Storage::url($nextGallery->main_image) }}" alt="{{ $nextGallery->title }}" class="w-20 h-20 rounded-[1.5rem] object-cover flex-shrink-0 ring-4 ring-transparent group-hover:ring-[#B2F5EA] transition-all">
                    @endif
                    <div class="flex-1 min-w-0">
                        <p class="text-[10px] text-gray-400 uppercase tracking-widest font-bold mb-2">Selanjutnya</p>
                        <p class="text-gray-800 font-extrabold text-lg truncate group-hover:text-[#38B2AC] transition-colors">{{ $nextGallery->title }}</p>
                    </div>
                    <div class="flex-shrink-0">
                        <div class="w-14 h-14 bg-gray-50 group-hover:bg-white rounded-2xl flex items-center justify-center transition-all duration-500 shadow-sm">
                            <i class="fas fa-arrow-right text-gray-400 group-hover:text-[#38B2AC] text-lg transition-colors"></i>
                        </div>
                    </div>
                </a>
            @endif
        </div>
    </div>
@endif

<!-- Related Galleries -->
@if($relatedGalleries && $relatedGalleries->count() > 0)
<section class="py-10 sm:py-14 md:py-20 bg-gradient-to-br from-gray-50 via-slate-50 to-gray-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8 sm:mb-12" data-aos="fade-up">
            <span class="inline-block bg-gradient-to-r from-teal-100 to-cyan-100 text-teal-700 px-4 py-1.5 rounded-full text-xs sm:text-sm font-semibold mb-3 uppercase tracking-wider">Galeri Lainnya</span>
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-extrabold text-gray-800 mb-3">Gallery Terkait</h2>
            <p class="text-sm sm:text-base text-gray-500 max-w-lg mx-auto">Jelajahi momen-momen seru lainnya dari perjalanan kami</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 sm:gap-6 max-w-7xl mx-auto">
            @foreach($relatedGalleries as $related)
                <a href="{{ route('gallery.show', $related->slug) }}" class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 border border-gray-100" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative overflow-hidden">
                        @if($related->main_image)
                            <img src="{{ Storage::url($related->main_image) }}" 
                                 alt="{{ $related->title }}" 
                                 class="w-full h-44 sm:h-48 object-cover group-hover:scale-110 transition-transform duration-700">
                        @else
                            <div class="w-full h-44 sm:h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <i class="fas fa-image text-4xl text-gray-400"></i>
                            </div>
                        @endif
                        
                        <!-- Overlay gradient -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        
                        @if($related->featured)
                            <div class="absolute top-3 left-3">
                                <span class="bg-gradient-to-r from-amber-400 to-orange-500 text-white px-2.5 py-1 rounded-full text-xs font-semibold shadow-lg">
                                    <i class="fas fa-star mr-1"></i> Featured
                                </span>
                            </div>
                        @endif

                        <!-- Image count badge -->
                        @if($related->images && count($related->images) > 0)
                            <div class="absolute bottom-3 right-3 bg-black/60 backdrop-blur-sm text-white px-2.5 py-1 rounded-lg text-xs font-medium">
                                <i class="fas fa-images mr-1"></i> {{ count($related->images) }}
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-4 sm:p-5">
                        <h3 class="text-sm sm:text-base font-bold text-gray-800 mb-2.5 line-clamp-2 group-hover:text-teal-600 transition-colors duration-300">{{ $related->title }}</h3>
                        
                        <div class="flex items-center gap-4 text-gray-500 text-xs sm:text-sm">
                            @if($related->destination)
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-map-marker-alt text-teal-400"></i>
                                    <span class="truncate">{{ $related->destination }}</span>
                                </div>
                            @endif
                            @if($related->trip_date)
                                <div class="flex items-center gap-1">
                                    <i class="fas fa-calendar text-teal-400"></i>
                                    <span>{{ $related->trip_date->format('M Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </a>
            @endforeach
        </div>

        <!-- Back to Gallery -->
        <div class="text-center mt-10" data-aos="fade-up">
            <a href="{{ route('gallery') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 border border-gray-200 hover:border-teal-300 px-6 py-3 rounded-xl font-medium transition-all duration-300 shadow-sm hover:shadow-md">
                <i class="fas fa-th-large"></i>
                Lihat Semua Gallery
            </a>
        </div>
    </div>
</section>
@endif

<!-- Lightbox Modal -->
<div id="lightbox" class="fixed inset-0 z-[100] hidden items-center justify-center bg-black/95" onclick="closeLightbox(event)">
    <!-- Close Button -->
    <button onclick="closeLightbox()" class="absolute top-4 right-4 sm:top-6 sm:right-6 text-white/70 hover:text-white p-2 rounded-full hover:bg-white/10 transition-all duration-300 z-10">
        <svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Counter -->
    <div class="absolute top-4 left-4 sm:top-6 sm:left-6 text-white/70 text-sm sm:text-base font-medium z-10">
        <span id="lightbox-counter"></span>
    </div>

    <!-- Navigation -->
    <button onclick="event.stopPropagation(); lightboxNavigate(-1)" class="absolute left-2 sm:left-6 top-1/2 -translate-y-1/2 text-white/70 hover:text-white p-2 sm:p-3 rounded-full hover:bg-white/10 transition-all duration-300 z-10">
        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
        </svg>
    </button>
    <button onclick="event.stopPropagation(); lightboxNavigate(1)" class="absolute right-2 sm:right-6 top-1/2 -translate-y-1/2 text-white/70 hover:text-white p-2 sm:p-3 rounded-full hover:bg-white/10 transition-all duration-300 z-10">
        <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
        </svg>
    </button>

    <!-- Lightbox Image -->
    <img id="lightbox-image" src="" alt="" class="max-w-[92vw] max-h-[88vh] object-contain rounded-lg shadow-2xl" onclick="event.stopPropagation()">
</div>

<!-- Custom scrollbar style -->
<style>
    .scrollbar-thin::-webkit-scrollbar {
        height: 6px;
    }
    .scrollbar-thin::-webkit-scrollbar-track {
        background: #f1f5f9;
        border-radius: 9999px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 9999px;
    }
    .scrollbar-thin::-webkit-scrollbar-thumb:hover {
        background: #94a3b8;
    }
</style>

<script>
// Gallery Images Data
const galleryImages = @json($gallery->images ? array_map(function($image) { return Storage::url($image); }, $gallery->images) : []);
let currentImageIndex = 0;

// Show Image
function showImage(index) {
    if (galleryImages.length === 0) return;
    
    currentImageIndex = index;
    const mainImage = document.getElementById('main-image');
    const imageCounter = document.getElementById('image-counter');
    
    if (mainImage) {
        mainImage.style.opacity = '0';
        setTimeout(() => {
            mainImage.src = galleryImages[index];
            mainImage.style.opacity = '1';
        }, 200);
    }
    
    if (imageCounter) {
        imageCounter.textContent = `${index + 1} / ${galleryImages.length}`;
    }
    
    // Update thumbnail selection
    document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
        if (i === index) {
            thumb.classList.add('border-teal-500', 'scale-110', 'shadow-lg', 'shadow-teal-500/20');
            thumb.classList.remove('border-transparent', 'opacity-60', 'grayscale');
            // Scroll thumbnail into view
            thumb.scrollIntoView({ behavior: 'smooth', inline: 'center', block: 'nearest' });
        } else {
            thumb.classList.remove('border-teal-500', 'scale-110', 'shadow-lg', 'shadow-teal-500/20');
            thumb.classList.add('border-transparent', 'opacity-60', 'grayscale');
        }
    });
}

// Navigate Image
function navigateImage(direction) {
    let newIndex = currentImageIndex + direction;
    if (newIndex < 0) newIndex = galleryImages.length - 1;
    if (newIndex >= galleryImages.length) newIndex = 0;
    showImage(newIndex);
}

// ==========================================
// Lightbox
// ==========================================
let lightboxIndex = 0;

function openLightbox(index) {
    lightboxIndex = index;
    const lightbox = document.getElementById('lightbox');
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCounter = document.getElementById('lightbox-counter');
    
    lightboxImage.src = galleryImages[index];
    lightboxCounter.textContent = `${index + 1} / ${galleryImages.length}`;
    
    lightbox.classList.remove('hidden');
    lightbox.classList.add('flex');
    document.body.style.overflow = 'hidden';
}

function closeLightbox(event) {
    if (event && event.target !== document.getElementById('lightbox')) return;
    const lightbox = document.getElementById('lightbox');
    lightbox.classList.add('hidden');
    lightbox.classList.remove('flex');
    document.body.style.overflow = '';
}

function lightboxNavigate(direction) {
    lightboxIndex += direction;
    if (lightboxIndex < 0) lightboxIndex = galleryImages.length - 1;
    if (lightboxIndex >= galleryImages.length) lightboxIndex = 0;
    
    const lightboxImage = document.getElementById('lightbox-image');
    const lightboxCounter = document.getElementById('lightbox-counter');
    
    lightboxImage.style.opacity = '0';
    setTimeout(() => {
        lightboxImage.src = galleryImages[lightboxIndex];
        lightboxImage.style.opacity = '1';
    }, 150);
    lightboxCounter.textContent = `${lightboxIndex + 1} / ${galleryImages.length}`;
}

// ==========================================
// Keyboard Navigation
// ==========================================
document.addEventListener('keydown', (e) => {
    const lightbox = document.getElementById('lightbox');
    const isLightboxOpen = !lightbox.classList.contains('hidden');
    
    if (e.key === 'Escape' && isLightboxOpen) {
        closeLightbox();
    } else if (e.key === 'ArrowLeft') {
        if (isLightboxOpen) {
            lightboxNavigate(-1);
        } else {
            navigateImage(-1);
        }
    } else if (e.key === 'ArrowRight') {
        if (isLightboxOpen) {
            lightboxNavigate(1);
        } else {
            navigateImage(1);
        }
    }
});

// ==========================================
// Share
// ==========================================
function shareGallery() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $gallery->title }}',
            text: 'Lihat gallery perjalanan yang menakjubkan ini!',
            url: window.location.href
        });
    } else {
        navigator.clipboard.writeText(window.location.href).then(() => {
            // Show toast
            const toast = document.createElement('div');
            toast.className = 'fixed bottom-6 left-1/2 transform -translate-x-1/2 bg-gray-800 text-white px-5 py-3 rounded-xl shadow-2xl z-50 flex items-center gap-2 text-sm transition-all duration-300';
            toast.innerHTML = '<i class="fas fa-check-circle text-green-400"></i> Link tersalin ke clipboard!';
            document.body.appendChild(toast);
            setTimeout(() => {
                toast.style.opacity = '0';
                setTimeout(() => toast.remove(), 300);
            }, 2500);
        });
    }
}

// AOS Animation
document.addEventListener('DOMContentLoaded', function() {
    if (typeof AOS !== 'undefined') {
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    }

    // Add smooth transition to main image
    const mainImage = document.getElementById('main-image');
    if (mainImage) {
        mainImage.style.transition = 'opacity 0.3s ease';
    }

    // Add smooth transition to lightbox image
    const lightboxImage = document.getElementById('lightbox-image');
    if (lightboxImage) {
        lightboxImage.style.transition = 'opacity 0.2s ease';
    }
});
</script>
@endsection