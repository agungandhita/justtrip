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
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Add New Gallery</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Create a new gallery with multiple images</p>
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
            <form action="{{ route('admin.galleries.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf

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
                                    <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('title') border-red-500 @enderror" placeholder="Enter gallery title">
                                    @error('title')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div>
                                    <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description</label>
                                    <textarea id="description" name="description" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('description') border-red-500 @enderror" placeholder="Enter gallery description">{{ old('description') }}</textarea>
                                    @error('description')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Destination -->
                                <div>
                                    <label for="destination" class="block text-sm font-medium text-gray-700 mb-2">Destination <span class="text-red-500">*</span></label>
                                    <input type="text" id="destination" name="destination" value="{{ old('destination') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('destination') border-red-500 @enderror" placeholder="Enter destination name">
                                    @error('destination')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Trip Date -->
                                <div>
                                    <label for="trip_date" class="block text-sm font-medium text-gray-700 mb-2">Trip Date <span class="text-red-500">*</span></label>
                                    <input type="date" id="trip_date" name="trip_date" value="{{ old('trip_date') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('trip_date') border-red-500 @enderror">
                                    @error('trip_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Category -->
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category <span class="text-red-500">*</span></label>
                                    <select id="category" name="category" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('category') border-red-500 @enderror">
                                        <option value="">Select Category</option>
                                        <option value="trip" {{ old('category') == 'trip' ? 'selected' : '' }}>Trip</option>
                                        <option value="destination" {{ old('category') == 'destination' ? 'selected' : '' }}>Destination</option>
                                        <option value="activity" {{ old('category') == 'activity' ? 'selected' : '' }}>Activity</option>
                                        <option value="accommodation" {{ old('category') == 'accommodation' ? 'selected' : '' }}>Accommodation</option>
                                        <option value="food" {{ old('category') == 'food' ? 'selected' : '' }}>Food & Dining</option>
                                        <option value="culture" {{ old('category') == 'culture' ? 'selected' : '' }}>Culture</option>
                                        <option value="nature" {{ old('category') == 'nature' ? 'selected' : '' }}>Nature</option>
                                        <option value="other" {{ old('category') == 'other' ? 'selected' : '' }}>Other</option>
                                    </select>
                                    @error('category')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Multiple Images Upload -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Images Upload</h2>

                            <div>
                                <label for="images" class="block text-sm font-medium text-gray-700 mb-2">Select Images <span class="text-red-500">*</span></label>
                                <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-lg hover:border-indigo-400 transition-colors duration-200">
                                    <div class="space-y-1 text-center">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="flex text-sm text-gray-600">
                                            <label for="images" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                                <span>Upload multiple files</span>
                                                <input id="images" name="images[]" type="file" accept="image/*" multiple required class="sr-only" onchange="previewImages(this)">
                                            </label>
                                            <p class="pl-1">or drag and drop</p>
                                        </div>
                                        <p class="text-xs text-gray-500">PNG, JPG, JPEG, WebP up to 5MB each (max 20 images)</p>
                                    </div>
                                </div>
                                @error('images')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                @error('images.*')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror

                                <!-- Images Preview -->
                                <div id="imagesPreview" class="mt-4 hidden">
                                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4" id="previewContainer">
                                        <!-- Preview images will be inserted here -->
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Trip Information -->
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-6">Trip Information</h2>

                            <div class="space-y-4">
                                <!-- Participants Count -->
                                <div>
                                    <label for="participants_count" class="block text-sm font-medium text-gray-700 mb-2">Participants Count</label>
                                    <input type="number" id="participants_count" name="participants_count" value="{{ old('participants_count') }}" min="1" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('participants_count') border-red-500 @enderror" placeholder="Number of participants">
                                    @error('participants_count')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Trip Highlights -->
                                <div>
                                    <label for="trip_highlights" class="block text-sm font-medium text-gray-700 mb-2">Trip Highlights</label>
                                    <textarea id="trip_highlights" name="trip_highlights" rows="3" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('trip_highlights') border-red-500 @enderror" placeholder="Describe the highlights of this trip">{{ old('trip_highlights') }}</textarea>
                                    @error('trip_highlights')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Tags -->
                                <div>
                                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Tags</label>
                                    <input type="text" id="tags" name="tags" value="{{ old('tags') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('tags') border-red-500 @enderror" placeholder="Enter tags separated by commas">
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
                                    <input type="text" id="alt_text" name="alt_text" value="{{ old('alt_text') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('alt_text') border-red-500 @enderror" placeholder="Describe the image for accessibility">
                                    <p class="mt-1 text-sm text-gray-500">Used for screen readers and when image fails to load</p>
                                    @error('alt_text')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Caption -->
                                <div>
                                    <label for="caption" class="block text-sm font-medium text-gray-700 mb-2">Caption</label>
                                    <input type="text" id="caption" name="caption" value="{{ old('caption') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('caption') border-red-500 @enderror" placeholder="Image caption (optional)">
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
                                        <option value="active" {{ old('status', 'active') == 'active' ? 'selected' : '' }}>Active</option>
                                        <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                    </select>
                                </div>

                                <!-- Featured -->
                                <div>
                                    <div class="flex items-center">
                                        <input type="checkbox" id="featured" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded">
                                        <label for="featured" class="ml-2 block text-sm text-gray-700">Featured Image</label>
                                    </div>
                                    <p class="mt-1 text-sm text-gray-500">Featured images appear prominently on the website</p>
                                </div>

                                <!-- Sort Order -->
                                <div>
                                    <label for="sort_order" class="block text-sm font-medium text-gray-700 mb-2">Sort Order</label>
                                    <input type="number" id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
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
                                    <input type="text" id="location" name="location" value="{{ old('location') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Where was this photo taken?">
                                </div>

                                <!-- Photographer -->
                                <div>
                                    <label for="photographer" class="block text-sm font-medium text-gray-700 mb-2">Photographer</label>
                                    <input type="text" id="photographer" name="photographer" value="{{ old('photographer') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Photo credit (optional)">
                                </div>

                                <!-- Date Taken -->
                                <div>
                                    <label for="date_taken" class="block text-sm font-medium text-gray-700 mb-2">Date Taken</label>
                                    <input type="date" id="date_taken" name="date_taken" value="{{ old('date_taken') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
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
                                    Upload Image
                                </button>
                                <a href="{{ route('admin.galleries.index') }}" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
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
                            <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-32 object-cover rounded-lg border">
                            <div class="absolute top-2 right-2 bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                                ${index + 1}
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

        // Auto-generate alt text from title
        document.getElementById('title').addEventListener('input', function() {
            const altTextInput = document.getElementById('alt_text');
            if (!altTextInput.value) {
                altTextInput.value = this.value;
            }
        });
    </script>
@endsection
