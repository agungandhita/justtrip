@extends('Frontend.layouts.main')

@section('container')
<!-- Gallery Detail Header -->
<section class="relative w-full">
    <img src="{{ asset('image/GALLERY.png') }}" alt="Paket Tour Background" class="w-full h-auto">
</section>
<!-- Gallery Images -->
<section class="py-8 sm:py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4">
        @if($gallery->images && count($gallery->images) > 0)
            <!-- Main Image Display -->
            <div class="max-w-6xl mx-auto mb-8 sm:mb-12">
                <div class="relative rounded-2xl overflow-hidden shadow-2xl" data-aos="fade-up">
                    <img id="main-image" src="{{ Storage::url($gallery->main_image) }}" 
                         alt="{{ $gallery->title }}" 
                         class="w-full h-[40vh] sm:h-[50vh] md:h-[60vh] object-cover">
                    
                    <!-- Image Navigation -->
                    @if(count($gallery->images) > 1)
                        <button id="prev-btn" class="absolute left-2 sm:left-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 sm:p-3 rounded-full transition-all duration-300">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button id="next-btn" class="absolute right-2 sm:right-4 top-1/2 transform -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white p-2 sm:p-3 rounded-full transition-all duration-300">
                            <svg class="w-4 h-4 sm:w-5 sm:h-5 md:w-6 md:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    @endif
                    
                    <!-- Image Counter -->
                    @if(count($gallery->images) > 1)
                        <div class="absolute bottom-2 sm:bottom-4 right-2 sm:right-4 bg-black/70 text-white px-2 sm:px-3 md:px-4 py-1 sm:py-2 rounded-lg">
                            <span id="image-counter" class="text-xs sm:text-sm">1 / {{ count($gallery->images) }}</span>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Thumbnail Grid -->
            @if(count($gallery->images) > 1)
                <div class="max-w-6xl mx-auto mb-8 sm:mb-12" data-aos="fade-up" data-aos-delay="200">
                    <div class="grid grid-cols-4 sm:grid-cols-6 md:grid-cols-8 lg:grid-cols-10 gap-2 sm:gap-3 md:gap-4">
                        @foreach($gallery->images as $index => $image)
                            <div class="thumbnail cursor-pointer rounded-lg overflow-hidden shadow-md hover:shadow-lg transition-all duration-300 transform hover:scale-105 {{ $index === 0 ? 'ring-2 ring-teal-500' : '' }}" 
                                 data-index="{{ $index }}" data-image="{{ Storage::url($image) }}">
                                <img src="{{ Storage::url($image) }}" alt="Gallery {{ $index + 1 }}" class="w-full h-16 sm:h-18 md:h-20 object-cover">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endif
        
        <!-- Gallery Description -->
        @if($gallery->description)
            <div class="max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="300">
                <div class="bg-gradient-to-br from-gray-50 to-slate-100 rounded-2xl p-4 sm:p-6 md:p-8">
                    <h3 class="text-lg sm:text-xl md:text-2xl font-bold text-gray-800 mb-3 sm:mb-4">Tentang Gallery Ini</h3>
                    <div class="prose prose-sm sm:prose-base md:prose-lg max-w-none text-gray-700">
                        {!! nl2br(e($gallery->description)) !!}
                    </div>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Related Galleries -->
@if($relatedGalleries && $relatedGalleries->count() > 0)
<section class="py-8 sm:py-12 md:py-16 bg-gradient-to-br from-gray-50 to-slate-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-8 sm:mb-10 md:mb-12" data-aos="fade-up">
            <h2 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold text-gray-800 mb-3 sm:mb-4">Gallery Terkait</h2>
            <p class="text-sm sm:text-base md:text-lg text-gray-600">Jelajahi gallery lainnya yang mungkin Anda sukai</p>
        </div>
        
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-5 md:gap-6">
            @foreach($relatedGalleries as $related)
                <div class="group bg-white rounded-xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative overflow-hidden">
                        @if($related->main_image)
                            <img src="{{ Storage::url($related->main_image) }}" 
                                 alt="{{ $related->title }}" 
                                 class="w-full h-40 sm:h-44 md:h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                        @else
                            <div class="w-full h-40 sm:h-44 md:h-48 bg-gradient-to-br from-gray-200 to-gray-300 flex items-center justify-center">
                                <svg class="w-8 h-8 sm:w-10 sm:h-10 md:w-12 md:h-12 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                            </div>
                        @endif
                        
                        @if($related->featured)
                            <div class="absolute top-2 sm:top-3 left-2 sm:left-3">
                                <span class="bg-gradient-to-r from-yellow-400 to-orange-500 text-white px-1.5 sm:px-2 py-0.5 sm:py-1 rounded-full text-xs font-semibold">
                                    Featured
                                </span>
                            </div>
                        @endif
                    </div>
                    
                    <div class="p-3 sm:p-4">
                        <h3 class="text-sm sm:text-base md:text-lg font-bold text-gray-800 mb-2 line-clamp-2">{{ $related->title }}</h3>
                        <div class="flex items-center text-gray-600 mb-2 sm:mb-3">
                            <svg class="w-3 h-3 sm:w-4 sm:h-4 mr-1 sm:mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            </svg>
                            <span class="text-xs sm:text-sm">{{ $related->destination }}</span>
                        </div>
                        
                        <div class="flex items-center justify-end">
                            <a href="{{ route('gallery.show', $related->slug) }}" 
                               class="bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-2 sm:px-3 py-1 rounded-lg text-xs font-medium transition-all duration-300">
                                Lihat
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<script>
// Gallery Images Data
const galleryImages = @json($gallery->images ? array_map(function($image) { return Storage::url($image); }, $gallery->images) : []);
let currentImageIndex = 0;

// Image Navigation
function showImage(index) {
    if (galleryImages.length === 0) return;
    
    currentImageIndex = index;
    const mainImage = document.getElementById('main-image');
    const imageCounter = document.getElementById('image-counter');
    
    if (mainImage) {
        mainImage.src = galleryImages[index];
    }
    
    if (imageCounter) {
        imageCounter.textContent = `${index + 1} / ${galleryImages.length}`;
    }
    
    // Update thumbnail selection
    document.querySelectorAll('.thumbnail').forEach((thumb, i) => {
        if (i === index) {
            thumb.classList.add('ring-2', 'ring-teal-500');
        } else {
            thumb.classList.remove('ring-2', 'ring-teal-500');
        }
    });
}

// Previous/Next Navigation
document.getElementById('prev-btn')?.addEventListener('click', () => {
    const newIndex = currentImageIndex > 0 ? currentImageIndex - 1 : galleryImages.length - 1;
    showImage(newIndex);
});

document.getElementById('next-btn')?.addEventListener('click', () => {
    const newIndex = currentImageIndex < galleryImages.length - 1 ? currentImageIndex + 1 : 0;
    showImage(newIndex);
});

// Thumbnail Click
document.querySelectorAll('.thumbnail').forEach((thumb, index) => {
    thumb.addEventListener('click', () => {
        showImage(index);
    });
});

// Keyboard Navigation
document.addEventListener('keydown', (e) => {
    if (e.key === 'ArrowLeft') {
        document.getElementById('prev-btn')?.click();
    } else if (e.key === 'ArrowRight') {
        document.getElementById('next-btn')?.click();
    }
});



// Share Functionality
function shareGallery() {
    if (navigator.share) {
        navigator.share({
            title: '{{ $gallery->title }}',
            text: 'Lihat gallery perjalanan yang menakjubkan ini!',
            url: window.location.href
        });
    } else {
        // Fallback: copy to clipboard
        navigator.clipboard.writeText(window.location.href).then(() => {
            alert('Link gallery telah disalin ke clipboard!');
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
});
</script>
@endsection