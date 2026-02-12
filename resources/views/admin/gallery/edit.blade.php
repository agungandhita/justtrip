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
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Edit Gallery</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Update gallery information and manage images</p>
                </div>
                <a href="{{ route('admin.galleries.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                    </svg>
                    Back to Gallery
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="px-4">
            <form id="galleryForm" action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                    <!-- Main Content -->
                    <div class="lg:col-span-2 space-y-6">
                        <!-- Basic Information -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Basic Information</h2>

                            <div class="space-y-4">
                                <!-- Title -->
                                <div>
                                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Gallery Title <span class="text-red-500">*</span></label>
                                    <input type="text" id="title" name="title" value="{{ old('title', $gallery->title) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror" placeholder="Enter gallery title">
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror" placeholder="Enter gallery description">{{ old('description', $gallery->description) }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                                    <select id="category" name="category" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('category') border-red-500 @enderror">
                                        <option value="">Select Category</option>
                                        <option value="trip" {{ old('category', $gallery->category) == 'trip' ? 'selected' : '' }}>Trip</option>
                                        <option value="destination" {{ old('category', $gallery->category) == 'destination' ? 'selected' : '' }}>Destination</option>
                                        <option value="activity" {{ old('category', $gallery->category) == 'activity' ? 'selected' : '' }}>Activity</option>
                                        <option value="accommodation" {{ old('category', $gallery->category) == 'accommodation' ? 'selected' : '' }}>Accommodation</option>
                                    </select>
                                    @error('category')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Current Images Section -->
                        <div class="bg-white rounded-xl shadow-md p-6" id="currentImagesSection">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-xl font-semibold text-gray-800">
                                    Current Images (<span id="imageCount">{{ $gallery->images ? count($gallery->images) : 0 }}</span>)
                                </h2>
                                <span class="text-sm text-gray-500">Click image to manage</span>
                            </div>

                            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="imagesGrid">
                                @if($gallery->images && count($gallery->images) > 0)
                                    @foreach($gallery->images as $index => $image)
                                        <div class="relative group rounded-xl overflow-hidden shadow-sm border-2 border-transparent hover:border-indigo-400 transition-all duration-300" 
                                             id="image-card-{{ $index }}" 
                                             data-image-path="{{ $image }}">
                                            <div class="aspect-square">
                                                <img src="{{ asset('storage/' . $image) }}" 
                                                     alt="{{ $gallery->title }} - Image {{ $index + 1 }}" 
                                                     class="w-full h-full object-cover">
                                            </div>
                                            
                                            <!-- Image Number Badge -->
                                            <div class="absolute top-2 left-2 bg-black/60 backdrop-blur-sm text-white text-xs font-bold px-2.5 py-1 rounded-full">
                                                {{ $index + 1 }}
                                            </div>
                                            
                                            <!-- Main Image Badge -->
                                            @if($gallery->main_image === $image)
                                                <div class="absolute top-2 right-2 bg-emerald-500 text-white text-xs font-bold px-2.5 py-1 rounded-full flex items-center gap-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-3 h-3" viewBox="0 0 24 24" fill="currentColor"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.63L12,2L9.19,8.63L2,9.24L7.46,13.97L5.82,21L12,17.27Z"/></svg>
                                                    Main
                                                </div>
                                            @endif

                                            <!-- Hover Overlay with Actions -->
                                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-all duration-300 flex flex-col justify-end p-3">
                                                <div class="flex gap-2">
                                                    @if($gallery->main_image !== $image)
                                                        <button type="button" 
                                                                onclick="setMainImage('{{ $image }}')" 
                                                                class="flex-1 bg-emerald-500 hover:bg-emerald-600 text-white text-xs font-medium py-2 px-3 rounded-lg transition-colors duration-200 flex items-center justify-center gap-1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.63L12,2L9.19,8.63L2,9.24L7.46,13.97L5.82,21L12,17.27Z"/></svg>
                                                            Set Main
                                                        </button>
                                                    @endif
                                                    <button type="button" 
                                                            onclick="deleteImageAjax('{{ $image }}', {{ $index }})" 
                                                            class="flex-1 bg-red-500 hover:bg-red-600 text-white text-xs font-medium py-2 px-3 rounded-lg transition-colors duration-200 flex items-center justify-center gap-1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-3.5 h-3.5" viewBox="0 0 24 24" fill="currentColor"><path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/></svg>
                                                        Hapus
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="col-span-full text-center py-8">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-gray-300 mb-3" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z"/>
                                        </svg>
                                        <p class="text-gray-500">No images yet. Upload images below.</p>
                                    </div>
                                @endif
                            </div>

                            <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                <p class="text-sm text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 inline mr-1" viewBox="0 0 24 24" fill="currentColor"><path d="M13,9H11V7H13M13,17H11V11H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/></svg>
                                    Hover gambar untuk set sebagai utama atau menghapus. Penghapusan bersifat langsung dan permanen.
                                </p>
                            </div>
                        </div>

                        <!-- Add New Images -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Tambah Gambar Baru</h2>
                            
                            <div class="space-y-4">
                                <!-- Keep Existing Images Option -->
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <input type="checkbox" id="keep_existing_images" name="keep_existing_images" value="1" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="keep_existing_images" class="ml-2 block text-sm text-gray-700">Pertahankan gambar yang ada</label>
                                    <p class="ml-auto text-xs text-gray-500">Hapus centang untuk mengganti semua gambar</p>
                                </div>

                                <!-- Upload New Images -->
                                <div>
                                    <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar Baru (Opsional)</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition-colors duration-200">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload gambar baru</span>
                                                    <input id="images" name="images[]" type="file" accept="image/*" multiple class="sr-only" onchange="previewImages(this)">
                                                </label>
                                                <p class="pl-1">atau drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, JPEG, WebP maksimal 2MB per gambar (max 20 total)</p>
                                        </div>
                                    </div>
                                    @error('images')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                    @error('images.*')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror

                                    <!-- New Images Preview -->
                                    <div id="imagesPreview" class="mt-4 hidden">
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">Preview Gambar Baru:</h4>
                                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="previewContainer">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Trip Information -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Trip Information</h2>

                            <div class="space-y-4">
                                <!-- Destination -->
                                <div>
                                    <label for="destination" class="block text-sm font-medium text-gray-700 mb-2">Destination</label>
                                    <input type="text" id="destination" name="destination" value="{{ old('destination', $gallery->destination) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('destination') border-red-500 @enderror" placeholder="Trip destination">
                                    @error('destination')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Trip Date -->
                                <div>
                                    <label for="trip_date" class="block text-sm font-medium text-gray-700 mb-2">Trip Date</label>
                                    <input type="date" id="trip_date" name="trip_date" value="{{ old('trip_date', $gallery->trip_date ? $gallery->trip_date->format('Y-m-d') : '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('trip_date') border-red-500 @enderror">
                                    @error('trip_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Participants Count -->
                                <div>
                                    <label for="participants_count" class="block text-sm font-medium text-gray-700 mb-2">Participants Count</label>
                                    <input type="number" id="participants_count" name="participants_count" value="{{ old('participants_count', $gallery->participants_count) }}" min="1" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('participants_count') border-red-500 @enderror" placeholder="Number of participants">
                                    @error('participants_count')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Trip Highlights -->
                                <div>
                                    <label for="trip_highlights" class="block text-sm font-medium text-gray-700 mb-2">Trip Highlights</label>
                                    <textarea id="trip_highlights" name="trip_highlights" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('trip_highlights') border-red-500 @enderror" placeholder="Describe the highlights of this trip">{{ old('trip_highlights', $gallery->trip_highlights) }}</textarea>
                                    @error('trip_highlights')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Tags -->
                                <div>
                                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                                    <input type="text" id="tags" name="tags" value="{{ old('tags', is_array($gallery->tags) ? implode(', ', $gallery->tags) : $gallery->tags) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('tags') border-red-500 @enderror" placeholder="Enter tags separated by commas">
                                    <p class="mt-1 text-sm text-gray-500">Separate tags with commas (e.g., beach, sunset, vacation)</p>
                                    @error('tags')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- Sidebar -->
                    <div class="space-y-6">
                        <!-- Publishing Options -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Publishing Options</h2>

                            <div class="space-y-4">
                                <!-- Status -->
                                <div>
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                    <select id="status" name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                        <option value="active" {{ old('status', $gallery->status) == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status', $gallery->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <!-- Featured -->
                                <div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured', $gallery->featured) ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="featured" class="ml-2 block text-sm text-gray-700">Featured Image</label>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Featured images appear prominently on the website</p>
                                </div>

                                <!-- Sort Order -->
                                <div>
                                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', $gallery->sort_order ?? 0) }}" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <p class="mt-1 text-sm text-gray-500">Lower numbers appear first</p>
                                </div>
                            </div>
                        </div>

                        <!-- Photographer -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Photographer</h2>

                            <div class="space-y-4">
                                <div>
                                    <label for="photographer" class="block text-sm font-medium text-gray-700 mb-2">Photographer</label>
                                    <input type="text" id="photographer" name="photographer" value="{{ old('photographer', $gallery->photographer) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Photo credit (optional)">
                                </div>
                            </div>
                        </div>

                        <!-- Image Information -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Image Information</h2>

                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Total Images:</span>
                                    <span class="text-gray-900 font-medium" id="sidebarImageCount">{{ $gallery->images ? count($gallery->images) : 0 }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Created:</span>
                                    <span class="text-gray-900">{{ $gallery->created_at->format('M d, Y \\a\\t g:i A') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Last Updated:</span>
                                    <span class="text-gray-900">{{ $gallery->updated_at->format('M d, Y \\a\\t g:i A') }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <div class="space-y-3">
                                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M15,9H5V5H15M12,19A3,3 0 0,1 9,16A3,3 0 0,1 12,13A3,3 0 0,1 15,16A3,3 0 0,1 12,19M17,3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V7L17,3Z"/>
                                    </svg>
                                    Update Gallery
                                </button>
                                <a href="{{ route('admin.galleries.show', $gallery->id) }}" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z"/>
                                    </svg>
                                    View Gallery
                                </a>
                                <a href="{{ route('admin.galleries.index') }}" class="w-full bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                                    </svg>
                                    Cancel
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div id="confirmModal" class="fixed inset-0 z-[120] hidden items-center justify-center">
        <div class="absolute inset-0 bg-black/30 backdrop-blur-sm"></div>
        <div class="relative w-full max-w-md mx-4 sm:mx-auto rounded-xl bg-white shadow-2xl">
            <button id="confirmClose" type="button" class="absolute right-3 top-3 text-gray-400 hover:text-gray-600 transition-colors" aria-label="Close">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="currentColor"><path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/></svg>
            </button>
            <div class="p-6">
                <div class="flex items-center gap-3 mb-3">
                    <div class="h-10 w-10 rounded-full bg-red-50 flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-red-500" viewBox="0 0 24 24" fill="currentColor"><path d="M13,13H11V7H13M13,17H11V15H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/></svg>
                    </div>
                    <h3 id="confirmTitle" class="text-lg font-semibold text-gray-900">Konfirmasi</h3>
                </div>
                <p id="confirmMessage" class="text-gray-600 mb-5 pl-[52px]">Apakah Anda yakin?</p>
                <div class="flex justify-end gap-3">
                    <button id="confirmCancel" type="button" class="px-5 py-2.5 rounded-lg border border-gray-300 bg-white text-gray-700 font-medium hover:bg-gray-50 transition-colors">Batal</button>
                    <button id="confirmProceed" type="button" class="px-5 py-2.5 rounded-lg bg-red-600 hover:bg-red-700 text-white font-medium transition-colors">Hapus</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Loading overlay -->
    <div id="loadingOverlay" class="fixed inset-0 z-[130] hidden items-center justify-center bg-black/40 backdrop-blur-sm">
        <div class="bg-white rounded-xl p-8 shadow-2xl flex flex-col items-center gap-4">
            <div class="w-10 h-10 border-4 border-indigo-200 border-t-indigo-600 rounded-full animate-spin"></div>
            <p class="text-gray-700 font-medium" id="loadingText">Memproses...</p>
        </div>
    </div>

    <script>
        const GALLERY_ID = '{{ $gallery->id }}';
        const CSRF_TOKEN = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        // ==========================================
        // Confirmation Modal
        // ==========================================
        const confirmModalEl = document.getElementById('confirmModal');
        const confirmTitleEl = document.getElementById('confirmTitle');
        const confirmMessageEl = document.getElementById('confirmMessage');
        const confirmProceedBtn = document.getElementById('confirmProceed');
        const confirmCancelBtn = document.getElementById('confirmCancel');
        const confirmCloseBtn = document.getElementById('confirmClose');

        function closeConfirmModal() {
            confirmModalEl.classList.add('hidden');
            confirmModalEl.classList.remove('flex');
            confirmProceedBtn.onclick = null;
            confirmCancelBtn.onclick = null;
            confirmCloseBtn.onclick = null;
            const overlay = confirmModalEl.querySelector('.absolute.inset-0');
            if (overlay) overlay.onclick = null;
            if (window.__escHandler) {
                document.removeEventListener('keydown', window.__escHandler);
                delete window.__escHandler;
            }
        }

        function openConfirmModal({ title, message, confirmText = 'Konfirmasi', confirmColor = 'red', onConfirm }) {
            confirmTitleEl.textContent = title || 'Konfirmasi';
            confirmMessageEl.textContent = message || 'Apakah Anda yakin?';
            confirmProceedBtn.textContent = confirmText || 'Konfirmasi';

            confirmProceedBtn.classList.remove('bg-red-600','hover:bg-red-700','bg-indigo-600','hover:bg-indigo-700','bg-green-600','hover:bg-green-700');
            const colorCls = confirmColor === 'green' ? ['bg-green-600','hover:bg-green-700'] :
                             (confirmColor === 'indigo' ? ['bg-indigo-600','hover:bg-indigo-700'] : ['bg-red-600','hover:bg-red-700']);
            colorCls.forEach(c => confirmProceedBtn.classList.add(c));

            confirmModalEl.classList.remove('hidden');
            confirmModalEl.classList.add('flex');

            confirmProceedBtn.onclick = () => { closeConfirmModal(); if (typeof onConfirm === 'function') onConfirm(); };
            confirmCancelBtn.onclick = closeConfirmModal;
            confirmCloseBtn.onclick = closeConfirmModal;
            const overlay = confirmModalEl.querySelector('.absolute.inset-0');
            if (overlay) overlay.onclick = closeConfirmModal;

            function escHandler(e){ if(e.key === 'Escape'){ closeConfirmModal(); } }
            window.__escHandler = escHandler;
            document.addEventListener('keydown', escHandler);
        }

        // ==========================================
        // Loading overlay
        // ==========================================
        function showLoading(text = 'Memproses...') {
            document.getElementById('loadingText').textContent = text;
            document.getElementById('loadingOverlay').classList.remove('hidden');
            document.getElementById('loadingOverlay').classList.add('flex');
        }

        function hideLoading() {
            document.getElementById('loadingOverlay').classList.add('hidden');
            document.getElementById('loadingOverlay').classList.remove('flex');
        }

        // ==========================================
        // Delete Image via AJAX (immediate)
        // ==========================================
        function deleteImageAjax(imagePath, index) {
            openConfirmModal({
                title: 'Hapus Gambar',
                message: 'Yakin ingin menghapus gambar ini? Tindakan ini bersifat permanen dan tidak dapat dibatalkan.',
                confirmText: 'Hapus',
                confirmColor: 'red',
                onConfirm: () => {
                    showLoading('Menghapus gambar...');

                    fetch(`/admin/galleries/${GALLERY_ID}/delete-image`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ image_path: imagePath })
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideLoading();

                        if (data.success) {
                            // Remove the image card with animation
                            const imageCard = document.getElementById(`image-card-${index}`);
                            if (imageCard) {
                                imageCard.style.transition = 'all 0.4s ease';
                                imageCard.style.transform = 'scale(0.8)';
                                imageCard.style.opacity = '0';
                                setTimeout(() => {
                                    imageCard.remove();
                                    updateImageCount(data.remaining_images);
                                    reindexImageCards();
                                }, 400);
                            }

                            showToast('success', 'Gambar berhasil dihapus!');
                        } else {
                            showToast('error', data.message || 'Gagal menghapus gambar.');
                        }
                    })
                    .catch(error => {
                        hideLoading();
                        console.error('Error:', error);
                        showToast('error', 'Terjadi kesalahan saat menghapus gambar.');
                    });
                }
            });
        }

        // ==========================================
        // Set Main Image via AJAX
        // ==========================================
        function setMainImage(imagePath) {
            openConfirmModal({
                title: 'Set Gambar Utama',
                message: 'Yakin menjadikan gambar ini sebagai gambar utama gallery?',
                confirmText: 'Set Utama',
                confirmColor: 'indigo',
                onConfirm: () => {
                    showLoading('Mengubah gambar utama...');

                    fetch(`{{ route('admin.galleries.set-main-image', $gallery->id) }}`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': CSRF_TOKEN,
                            'Accept': 'application/json'
                        },
                        body: JSON.stringify({ image_path: imagePath })
                    })
                    .then(response => response.json())
                    .then(data => {
                        hideLoading();

                        if (data.success) {
                            // Reload the page to reflect changes in Server-rendered blade
                            showToast('success', 'Gambar utama berhasil diubah!');
                            setTimeout(() => location.reload(), 1000);
                        } else {
                            showToast('error', data.message || 'Gagal mengubah gambar utama.');
                        }
                    })
                    .catch(error => {
                        hideLoading();
                        console.error('Error:', error);
                        showToast('error', 'Terjadi kesalahan.');
                    });
                }
            });
        }

        // ==========================================
        // Update image count displays
        // ==========================================
        function updateImageCount(count) {
            document.getElementById('imageCount').textContent = count;
            document.getElementById('sidebarImageCount').textContent = count;

            // Show empty state if no images left 
            if (count === 0) {
                const grid = document.getElementById('imagesGrid');
                grid.innerHTML = `
                    <div class="col-span-full text-center py-8">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 mx-auto text-gray-300 mb-3" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z"/>
                        </svg>
                        <p class="text-gray-500">Semua gambar dihapus. Upload gambar baru di bawah.</p>
                    </div>
                `;
            }
        }

        // Reindex remaining image cards after deletion
        function reindexImageCards() {
            const cards = document.querySelectorAll('#imagesGrid [id^="image-card-"]');
            cards.forEach((card, newIndex) => {
                card.id = `image-card-${newIndex}`;
                // Update number badge
                const badge = card.querySelector('.bg-black\\/60');
                if (badge) badge.textContent = newIndex + 1;
                // Update delete button onclick
                const deleteBtn = card.querySelector('button[onclick*="deleteImageAjax"]');
                if (deleteBtn) {
                    const imgPath = card.dataset.imagePath;
                    deleteBtn.setAttribute('onclick', `deleteImageAjax('${imgPath}', ${newIndex})`);
                }
            });
        }

        // ==========================================
        // Toast notifications
        // ==========================================
        function showToast(type, message) {
            // Use SweetAlert if available
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: type,
                    title: type === 'success' ? 'Berhasil!' : 'Error!',
                    text: message,
                    timer: 2500,
                    showConfirmButton: false,
                    toast: true,
                    position: 'top-end'
                });
                return;
            }

            // Fallback: custom toast
            const toast = document.createElement('div');
            const bgColor = type === 'success' ? 'bg-emerald-500' : 'bg-red-500';
            const icon = type === 'success' 
                ? '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.5 2 2 6.5 2 12S6.5 22 12 22 22 17.5 22 12 17.5 2 12 2M10 17L5 12L6.41 10.59L10 14.17L17.59 6.58L19 8L10 17Z"/></svg>'
                : '<svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor"><path d="M13,13H11V7H13M13,17H11V15H13M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2Z"/></svg>';
            
            toast.className = `fixed top-6 right-6 z-[200] ${bgColor} text-white px-5 py-3 rounded-xl shadow-2xl flex items-center gap-3 transform translate-x-full transition-transform duration-300`;
            toast.innerHTML = `${icon}<span class="font-medium">${message}</span>`;
            document.body.appendChild(toast);

            requestAnimationFrame(() => {
                toast.style.transform = 'translateX(0)';
            });

            setTimeout(() => {
                toast.style.transform = 'translateX(120%)';
                setTimeout(() => toast.remove(), 300);
            }, 3000);
        }

        // ==========================================
        // Preview new images
        // ==========================================
        function previewImages(input) {
            const preview = document.getElementById('imagesPreview');
            const previewContainer = document.getElementById('previewContainer');
            
            previewContainer.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                if (input.files.length > 20) {
                    showToast('error', 'Maksimal 20 gambar diperbolehkan');
                    input.value = '';
                    preview.classList.add('hidden');
                    return;
                }
                
                preview.classList.remove('hidden');
                
                Array.from(input.files).forEach((file, index) => {
                    if (file.size > 2 * 1024 * 1024) {
                        showToast('error', `File ${file.name} terlalu besar. Maksimal 2MB.`);
                        return;
                    }
                    
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const imageDiv = document.createElement('div');
                        imageDiv.className = 'relative group rounded-xl overflow-hidden shadow-sm border-2 border-blue-300';
                        
                        imageDiv.innerHTML = `
                            <div class="aspect-square">
                                <img src="${e.target.result}" alt="New Image ${index + 1}" class="w-full h-full object-cover">
                            </div>
                            <div class="absolute top-2 right-2 bg-blue-500 text-white text-xs font-bold px-2.5 py-1 rounded-full">
                                New ${index + 1}
                            </div>
                            <div class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-black/60 to-transparent p-2">
                                <span class="text-white text-xs truncate block">${file.name}</span>
                            </div>
                        `;
                        
                        previewContainer.appendChild(imageDiv);
                    }
                    
                    reader.readAsDataURL(file);
                });
            } else {
                preview.classList.add('hidden');
            }
        }
    </script>
@endsection
