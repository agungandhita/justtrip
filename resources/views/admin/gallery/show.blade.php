@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Gallery Details</h1>
                    </div>
                    <p class="text-gray-600 pl-11">View gallery information</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('admin.galleries.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                        </svg>
                        Back to Galleries
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Gallery Images Display -->
                    <div class="bg-white rounded-xl shadow-md overflow-hidden">
                        @if($gallery->images && count($gallery->images) > 0)
                            <!-- Main Image -->
                            @php
                                $mainImage = $gallery->main_image ?? $gallery->images[0];
                            @endphp
                            <div class="relative">
                                <img src="{{ asset('storage/' . $mainImage) }}" alt="{{ $gallery->alt_text ?? $gallery->title }}" class="w-full h-auto max-h-96 object-contain bg-gray-50" id="mainImage">

                                <!-- Gallery Overlay Info -->
                                <div class="absolute top-4 left-4 flex flex-wrap gap-2">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $gallery->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($gallery->status) }}
                                    </span>
                                    @if($gallery->featured)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                            Featured
                                        </span>
                                    @endif
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                        {{ ucwords(str_replace('-', ' ', $gallery->category ?? 'Other')) }}
                                    </span>
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                        {{ count($gallery->images) }} {{ count($gallery->images) == 1 ? 'Image' : 'Images' }}
                                    </span>
                                </div>

                                <!-- Download Button -->
                                <div class="absolute top-4 right-4">
                                    <a href="{{ asset('storage/' . $mainImage) }}" download class="bg-white bg-opacity-90 hover:bg-opacity-100 text-gray-800 p-2 rounded-full transition-all duration-200" title="Download Main Image">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M5,20H19V18H5M19,9H15V3H9V9H5L12,16L19,9Z"/>
                                        </svg>
                                    </a>
                                </div>
                            </div>

                            <!-- Image Thumbnails -->
                            @if(count($gallery->images) > 1)
                                <div class="p-4 bg-gray-50 border-t">
                                    <h4 class="text-sm font-medium text-gray-700 mb-3">Gallery Images ({{ count($gallery->images) }})</h4>
                                    <div class="grid grid-cols-6 gap-2">
                                        @foreach($gallery->images as $index => $image)
                                            <div class="relative group cursor-pointer" onclick="changeMainImage('{{ asset('storage/' . $image) }}')">
                                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery Image {{ $index + 1 }}" class="w-full h-16 object-cover rounded border-2 {{ $image == $mainImage ? 'border-blue-500' : 'border-gray-200 hover:border-gray-300' }} transition-all duration-200">
                                                @if($image == $mainImage)
                                                    <div class="absolute top-1 right-1 bg-blue-500 text-white text-xs px-1 rounded">
                                                        Main
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        @else
                            <div class="h-96 bg-gray-200 flex items-center justify-center">
                                <div class="text-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mx-auto mb-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z"/>
                                    </svg>
                                    <p class="text-gray-500">No images available</p>
                                </div>
                            </div>
                        @endif

                        <!-- Gallery Caption -->
                        @if($gallery->caption)
                            <div class="p-4 bg-gray-50 border-t">
                                <p class="text-gray-700 italic text-center">{{ $gallery->caption }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Gallery Information -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-6">Gallery Information</h2>

                        <div class="space-y-4">
                            <!-- Title -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Title</label>
                                <h3 class="text-lg font-semibold text-gray-900">{{ $gallery->title }}</h3>
                            </div>

                            <!-- Description -->
                            @if($gallery->description)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Description</label>
                                    <p class="text-gray-700 leading-relaxed">{{ $gallery->description }}</p>
                                </div>
                            @endif

                            <!-- Category -->
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Category</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-gray-100 text-gray-800">
                                    {{ ucwords(str_replace('-', ' ', $gallery->category ?? 'Other')) }}
                                </span>
                            </div>

                            <!-- Alt Text -->
                            @if($gallery->alt_text)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Alt Text</label>
                                    <p class="text-gray-700">{{ $gallery->alt_text }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Location & Credit Information -->
                    @if($gallery->location || $gallery->photographer || $gallery->date_taken)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Location & Credit</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @if($gallery->location)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Location</label>
                                        <p class="text-gray-900 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"/>
                                            </svg>
                                            {{ $gallery->location }}
                                        </p>
                                    </div>
                                @endif

                                @if($gallery->photographer)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Photographer</label>
                                        <p class="text-gray-900 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M9,2V7.38L10.5,8.88L12,7.38V2H9M15,7.38V2H18V7.38L16.5,8.88L15,7.38M12,9L10.5,10.5L9,9H3A1,1 0 0,0 2,10V20A1,1 0 0,0 3,21H21A1,1 0 0,0 22,20V10A1,1 0 0,0 21,9H15L13.5,10.5L12,9Z"/>
                                            </svg>
                                            {{ $gallery->photographer }}
                                        </p>
                                    </div>
                                @endif

                                @if($gallery->date_taken)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Date Taken</label>
                                        <p class="text-gray-900 flex items-center gap-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M19,19H5V8H19M16,1V3H8V1H6V3H5C3.89,3 3,3.89 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5C21,3.89 20.1,3 19,3H18V1M17,12H12V17H17V12Z"/>
                                            </svg>
                                            {{ $gallery->date_taken->format('M d, Y') }}
                                        </p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Status & Settings -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Status & Settings</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $gallery->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($gallery->status) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Featured</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $gallery->featured ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $gallery->featured ? 'Yes' : 'No' }}
                                </span>
                            </div>
                            @if($gallery->sort_order !== null)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Sort Order</label>
                                    <p class="text-gray-900">{{ $gallery->sort_order }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Gallery Statistics -->
                    @if($gallery->images && count($gallery->images) > 0)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Gallery Statistics</h3>
                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Total Images:</span>
                                    <span class="text-gray-900">{{ count($gallery->images) }}</span>
                                </div>
                                @php
                                    $totalSize = 0;
                                    $fileTypes = [];
                                    foreach($gallery->images as $image) {
                                        if (Storage::exists('public/' . $image)) {
                                            $totalSize += Storage::size('public/' . $image);
                                            $ext = strtoupper(pathinfo($image, PATHINFO_EXTENSION));
                                            $fileTypes[$ext] = ($fileTypes[$ext] ?? 0) + 1;
                                        }
                                    }
                                @endphp
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Total Size:</span>
                                    <span class="text-gray-900">{{ number_format($totalSize / 1024, 2) }} KB</span>
                                </div>
                                @if(!empty($fileTypes))
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">File Types:</span>
                                        <span class="text-gray-900">
                                            @foreach($fileTypes as $type => $count)
                                                {{ $type }}({{ $count }}){{ !$loop->last ? ', ' : '' }}
                                            @endforeach
                                        </span>
                                    </div>
                                @endif
                                @if($gallery->main_image)
                                    @php
                                        $mainImagePath = storage_path('app/public/' . $gallery->main_image);
                                        if (file_exists($mainImagePath)) {
                                            $mainImageSize = getimagesize($mainImagePath);
                                        }
                                    @endphp
                                    @if(isset($mainImageSize))
                                        <div class="flex justify-between">
                                            <span class="text-gray-500">Main Image Size:</span>
                                            <span class="text-gray-900">{{ $mainImageSize[0] }} × {{ $mainImageSize[1] }} px</span>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Timestamps -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Timestamps</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Created At</label>
                                <p class="text-gray-900 text-sm">{{ $gallery->created_at->format('M d, Y \\a\\t g:i A') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                                <p class="text-gray-900 text-sm">{{ $gallery->updated_at->format('M d, Y \\a\\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                                </svg>
                                Edit Gallery
                            </a>
                            @if($gallery->images && count($gallery->images) > 0)
                                @php
                                    $mainImage = $gallery->main_image ?? $gallery->images[0];
                                @endphp
                                <a href="{{ asset('storage/' . $mainImage) }}" download class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M5,20H19V18H5M19,9H15V3H9V9H5L12,16L19,9Z"/>
                                    </svg>
                                    Download Main Image
                                </a>
                                @if(count($gallery->images) > 1)
                                    <button onclick="downloadAllImages()" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                        </svg>
                                        Download All Images
                                    </button>
                                @endif
                            @endif
                            @if($gallery->status == 'inactive')
                                <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="active">
                                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M11,16.5L18,9.5L16.59,8.09L11,13.67L7.91,10.59L6.5,12L11,16.5Z"/>
                                        </svg>
                                        Activate Gallery
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this gallery and all its images?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                                    </svg>
                                    Delete Gallery
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Navigation -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Navigation</h3>
                        <div class="space-y-3">
                            @if($previousImage)
                                <a href="{{ route('admin.galleries.show', $previousImage->id) }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M15.41,16.58L10.83,12L15.41,7.41L14,6L8,12L14,18L15.41,16.58Z"/>
                                    </svg>
                                    Previous Gallery
                                </a>
                            @endif
                            @if($nextImage)
                                <a href="{{ route('admin.galleries.show', $nextImage->id) }}" class="w-full bg-gray-100 hover:bg-gray-200 text-gray-800 px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    Next Gallery
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M8.59,16.58L13.17,12L8.59,7.41L10,6L16,12L10,18L8.59,16.58Z"/>
                                    </svg>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function changeMainImage(imageSrc) {
            const mainImage = document.getElementById('mainImage');
            if (mainImage) {
                mainImage.src = imageSrc;
                
                // Update download link
                const downloadLink = document.querySelector('a[download]');
                if (downloadLink && downloadLink.textContent.includes('Main Image')) {
                    downloadLink.href = imageSrc;
                }
                
                // Update thumbnail borders
                document.querySelectorAll('.grid img').forEach(img => {
                    if (img.src === imageSrc) {
                        img.classList.remove('border-gray-200', 'hover:border-gray-300');
                        img.classList.add('border-blue-500');
                        
                        // Update main badge
                        const parent = img.parentElement;
                        let mainBadge = parent.querySelector('.bg-blue-500');
                        if (!mainBadge) {
                            mainBadge = document.createElement('div');
                            mainBadge.className = 'absolute top-1 right-1 bg-blue-500 text-white text-xs px-1 rounded';
                            mainBadge.textContent = 'Main';
                            parent.appendChild(mainBadge);
                        }
                    } else {
                        img.classList.remove('border-blue-500');
                        img.classList.add('border-gray-200', 'hover:border-gray-300');
                        
                        // Remove main badge
                        const parent = img.parentElement;
                        const mainBadge = parent.querySelector('.bg-blue-500');
                        if (mainBadge) {
                            mainBadge.remove();
                        }
                    }
                });
            }
        }
        
        function downloadAllImages() {
            const images = @json($gallery->images ?? []);
            
            if (images.length === 0) {
                alert('No images to download');
                return;
            }
            
            // Create a temporary link for each image and trigger download
            images.forEach((image, index) => {
                setTimeout(() => {
                    const link = document.createElement('a');
                    link.href = `{{ asset('storage/') }}/${image}`;
                    link.download = `{{ $gallery->title }}_image_${index + 1}.${image.split('.').pop()}`;
                    document.body.appendChild(link);
                    link.click();
                    document.body.removeChild(link);
                }, index * 500); // Delay each download by 500ms to avoid browser blocking
            });
            
            alert(`Downloading ${images.length} images. Please check your downloads folder.`);
        }
    </script>
@endsection
