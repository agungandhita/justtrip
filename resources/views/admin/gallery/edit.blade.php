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
            <form action="{{ route('admin.galleries.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
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

                        <!-- Current Images -->
                        @if($gallery->images && count($gallery->images) > 0)
                            <div class="bg-white rounded-xl shadow-md p-6">
                                <h2 class="text-xl font-semibold text-gray-800 mb-6">Current Images ({{ count($gallery->images) }})</h2>
                                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                                    @foreach($gallery->images as $index => $image)
                                        <div class="relative group" id="image-{{ $index }}">
                                            <img src="{{ asset('storage/' . $image) }}" alt="{{ $gallery->title }} - Image {{ $index + 1 }}" class="w-full h-32 object-cover rounded-lg border">
                                            <div class="absolute top-2 left-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                                {{ $index + 1 }}
                                            </div>
                                            @if($gallery->main_image === $image)
                                                <div class="absolute top-2 right-2 bg-green-500 text-white text-xs px-2 py-1 rounded">
                                                    Main
                                                </div>
                                            @endif
                                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-50 transition-all duration-200 rounded-lg flex items-center justify-center">
                                                <div class="opacity-0 group-hover:opacity-100 transition-opacity duration-200 flex gap-2">
                                                    <button type="button" onclick="setMainImage('{{ $image }}')" class="bg-green-600 hover:bg-green-700 text-white px-2 py-1 rounded text-xs">
                                                        Set Main
                                                    </button>
                                                    <button type="button" onclick="deleteImage('{{ $image }}', {{ $index }})" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">
                                                        Delete
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                                <div class="mt-4 p-3 bg-blue-50 rounded-lg">
                                    <p class="text-sm text-blue-700">You can set a main image and delete individual images. Use the options below to add more images or replace existing ones.</p>
                                </div>
                            </div>
                        @endif

                        <!-- Image Management Options -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Image Management</h2>
                            
                            <div class="space-y-4">
                                <!-- Keep Existing Images Option -->
                                <div class="flex items-center p-3 bg-gray-50 rounded-lg">
                                    <input type="checkbox" id="keep_existing_images" name="keep_existing_images" value="1" checked class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                    <label for="keep_existing_images" class="ml-2 block text-sm text-gray-700">Keep existing images</label>
                                    <p class="ml-auto text-xs text-gray-500">Uncheck to replace all images</p>
                                </div>
                                
                                <!-- Upload New Images -->
                                <div>
                                    <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Add New Images (Optional)</label>
                                    <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition-colors duration-200">
                                        <div class="space-y-1 text-center">
                                            <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            <div class="flex text-sm text-gray-600">
                                                <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                    <span>Upload new images</span>
                                                    <input id="images" name="images[]" type="file" accept="image/*" multiple class="sr-only" onchange="previewImages(this)">
                                                </label>
                                                <p class="pl-1">or drag and drop</p>
                                            </div>
                                            <p class="text-xs text-gray-500">PNG, JPG, JPEG, WebP up to 5MB each (max 20 total images)</p>
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
                                        <h4 class="text-sm font-medium text-gray-700 mb-2">New Images Preview:</h4>
                                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="previewContainer">
                                            <!-- Preview images will be inserted here -->
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

                        <!-- SEO Information -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">SEO Information</h2>

                            <div class="space-y-4">
                                <!-- Alt Text -->
                                <div>
                                    <label for="alt_text" class="block text-sm font-medium text-gray-700 mb-2">Alt Text</label>
                                    <input type="text" id="alt_text" name="alt_text" value="{{ old('alt_text', $gallery->alt_text) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('alt_text') border-red-500 @enderror" placeholder="Describe the image for accessibility">
                                    <p class="mt-1 text-sm text-gray-500">Used for screen readers and when image fails to load</p>
                                    @error('alt_text')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Caption -->
                                <div>
                                    <label for="caption" class="block text-sm font-medium text-gray-700 mb-2">Caption</label>
                                    <input type="text" id="caption" name="caption" value="{{ old('caption', $gallery->caption) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('caption') border-red-500 @enderror" placeholder="Image caption (optional)">
                                    @error('caption')
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

                        <!-- Location Information -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Location Information</h2>

                            <div class="space-y-4">
                                <!-- Location -->
                                <div>
                                    <label for="location" class="block text-sm font-medium text-gray-700 mb-2">Location</label>
                                    <input type="text" id="location" name="location" value="{{ old('location', $gallery->location) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Where was this photo taken?">
                                </div>

                                <!-- Photographer -->
                                <div>
                                    <label for="photographer" class="block text-sm font-medium text-gray-700 mb-2">Photographer</label>
                                    <input type="text" id="photographer" name="photographer" value="{{ old('photographer', $gallery->photographer) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Photo credit (optional)">
                                </div>

                                <!-- Date Taken -->
                                <div>
                                    <label for="date_taken" class="block text-sm font-medium text-gray-700 mb-2">Date Taken</label>
                                    <input type="date" id="date_taken" name="date_taken" value="{{ old('date_taken', $gallery->date_taken ? $gallery->date_taken->format('Y-m-d') : '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                </div>
                            </div>
                        </div>

                        <!-- Image Information -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Image Information</h2>

                            <div class="space-y-3 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Created:</span>
                                    <span class="text-gray-900">{{ $gallery->created_at->format('M d, Y \\a\\t g:i A') }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-500">Last Updated:</span>
                                    <span class="text-gray-900">{{ $gallery->updated_at->format('M d, Y \\a\\t g:i A') }}</span>
                                </div>
                                @if($gallery->image_path)
                                    <div class="flex justify-between">
                                        <span class="text-gray-500">File Size:</span>
                                        <span class="text-gray-900">{{ number_format(Storage::size('public/' . $gallery->image_path) / 1024, 2) }} KB</span>
                                    </div>
                                @endif
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

    <script>
        function previewImages(input) {
            const preview = document.getElementById('imagesPreview');
            const previewContainer = document.getElementById('previewContainer');
            
            // Clear previous previews
            previewContainer.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                // Check file count limit
                if (input.files.length > 20) {
                    alert('Maximum 20 images allowed');
                    input.value = '';
                    preview.classList.add('hidden');
                    return;
                }
                
                preview.classList.remove('hidden');
                
                Array.from(input.files).forEach((file, index) => {
                    // Check file size (5MB limit)
                    if (file.size > 5 * 1024 * 1024) {
                        alert(`File ${file.name} is too large. Maximum size is 5MB.`);
                        return;
                    }
                    
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        const imageDiv = document.createElement('div');
                        imageDiv.className = 'relative group';
                        
                        imageDiv.innerHTML = `
                            <img src="${e.target.result}" alt="New Image ${index + 1}" class="w-full h-32 object-cover rounded-lg border">
                            <div class="absolute top-2 right-2 bg-blue-500 text-white text-xs px-2 py-1 rounded">
                                New ${index + 1}
                            </div>
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-200 rounded-lg flex items-center justify-center">
                                <span class="text-white text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                                    ${file.name}
                                </span>
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

        function setMainImage(imagePath) {
            if (confirm('Set this image as the main image?')) {
                // Create a hidden input to send the main image path
                const existingInput = document.querySelector('input[name="main_image"]');
                if (existingInput) {
                    existingInput.remove();
                }
                
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'main_image';
                input.value = imagePath;
                document.querySelector('form').appendChild(input);
                
                // Update UI to show which image is main
                document.querySelectorAll('.bg-green-500').forEach(el => {
                    el.classList.remove('bg-green-500');
                    el.classList.add('bg-gray-500');
                    el.textContent = 'Set Main';
                });
                
                // Find and update the clicked image
                const images = document.querySelectorAll('[id^="image-"]');
                images.forEach(imageDiv => {
                    const img = imageDiv.querySelector('img');
                    if (img.src.includes(imagePath.replace('galleries/', ''))) {
                        const mainBadge = imageDiv.querySelector('.bg-gray-500, .bg-green-500');
                        if (mainBadge && mainBadge.textContent !== 'Main') {
                            mainBadge.classList.remove('bg-gray-500');
                            mainBadge.classList.add('bg-green-500');
                            mainBadge.textContent = 'Main';
                        }
                    }
                });
                
                alert('Main image updated! Save the form to apply changes.');
            }
        }

        function deleteImage(imagePath, index) {
            if (confirm('Are you sure you want to delete this image?')) {
                // Create a hidden input to mark image for deletion
                const input = document.createElement('input');
                input.type = 'hidden';
                input.name = 'delete_images[]';
                input.value = imagePath;
                document.querySelector('form').appendChild(input);
                
                // Hide the image from UI
                const imageDiv = document.getElementById(`image-${index}`);
                if (imageDiv) {
                    imageDiv.style.opacity = '0.5';
                    imageDiv.style.pointerEvents = 'none';
                    
                    // Add deleted overlay
                    const overlay = document.createElement('div');
                    overlay.className = 'absolute inset-0 bg-red-500 bg-opacity-75 flex items-center justify-center rounded-lg';
                    overlay.innerHTML = '<span class="text-white font-bold">DELETED</span>';
                    imageDiv.appendChild(overlay);
                }
                
                alert('Image marked for deletion! Save the form to apply changes.');
            }
        }

        // Auto-generate alt text from title if alt text is empty
        document.getElementById('title').addEventListener('input', function() {
            const altTextInput = document.getElementById('alt_text');
            if (altTextInput && !altTextInput.value) {
                altTextInput.value = this.value;
            }
        });
    </script>
@endsection
