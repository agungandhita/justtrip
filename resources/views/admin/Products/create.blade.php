@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,2A3,3 0 0,1 15,5V7H20A1,1 0 0,1 21,8V19A1,1 0 0,1 20,20H4A1,1 0 0,1 3,19V8A1,1 0 0,1 4,7H9V5A3,3 0 0,1 12,2M12,4A1,1 0 0,0 11,5V7H13V5A1,1 0 0,0 12,4Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Add New Product</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Create a new travel product or package</p>
                </div>
                <a href="{{ route('admin.products.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                    </svg>
                    Back to Products
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="px-4">
            <div class="bg-white rounded-xl shadow-md p-8">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Product Name -->
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Product Name *</label>
                                <input type="text" id="name" name="name" value="{{ old('name') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('name') border-red-500 @enderror" placeholder="Enter product name">
                                @error('name')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Product Type -->
                            <div>
                                <label for="type" class="block text-sm font-medium text-gray-700 mb-2">Product Type *</label>
                                <select id="type" name="type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('type') border-red-500 @enderror">
                                    <option value="">Select Product Type</option>
                                    <option value="international" {{ old('type') == 'international' ? 'selected' : '' }}>International</option>
                                    <option value="domestic" {{ old('type') == 'domestic' ? 'selected' : '' }}>Domestic</option>
                                </select>
                                @error('type')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Price -->
                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700 mb-2">Price (USD) *</label>
                                <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('price') border-red-500 @enderror" placeholder="0.00">
                                @error('price')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Duration -->
                            <div>
                                <label for="duration" class="block text-sm font-medium text-gray-700 mb-2">Duration (Days) *</label>
                                <input type="number" id="duration" name="duration" value="{{ old('duration') }}" required min="1" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('duration') border-red-500 @enderror" placeholder="Number of days">
                                @error('duration')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Destination -->
                            <div>
                                <label for="destination" class="block text-sm font-medium text-gray-700 mb-2">Destination *</label>
                                <input type="text" id="destination" name="destination" value="{{ old('destination') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('destination') border-red-500 @enderror" placeholder="Enter destination">
                                @error('destination')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                                <select id="status" name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Main Image -->
                            <div>
                                <label for="main_image" class="block text-sm font-medium text-gray-700 mb-2">Main Image</label>
                                <input type="file" id="main_image" name="main_image" accept="image/png,image/jpg,image/jpeg,image/gif" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('main_image') border-red-500 @enderror">
                                <p class="text-sm text-gray-500 mt-1">Supported formats: PNG, JPG, GIF. Max size: 10MB</p>
                                @error('main_image')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Gallery Images -->
                            <div>
                                <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Gallery Images</label>
                                <input type="file" id="gallery_images" name="gallery_images[]" accept="image/png,image/jpg,image/jpeg,image/gif" multiple class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('gallery_images') border-red-500 @enderror">
                                <p class="text-sm text-gray-500 mt-1">Select multiple images. Supported formats: PNG, JPG, GIF. Max size: 10MB each</p>
                                @error('gallery_images')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Featured -->
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Featured Product</span>
                                </label>
                                @error('featured')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Meta Title -->
                            <div>
                                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" maxlength="60" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('meta_title') border-red-500 @enderror" placeholder="SEO meta title (max 60 characters)">
                                @error('meta_title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Meta Description -->
                            <div>
                                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                <textarea id="meta_description" name="meta_description" rows="3" maxlength="160" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('meta_description') border-red-500 @enderror" placeholder="SEO meta description (max 160 characters)">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-8">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="description" name="description" rows="6" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('description') border-red-500 @enderror" placeholder="Enter product description">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Itinerary -->
                    <div class="mt-8">
                        <label for="itinerary" class="block text-sm font-medium text-gray-700 mb-2">Itinerary</label>
                        <textarea id="itinerary" name="itinerary" rows="8" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('itinerary') border-red-500 @enderror" placeholder="Enter detailed itinerary">{{ old('itinerary') }}</textarea>
                        @error('itinerary')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Includes -->
                    <div class="mt-8">
                        <label for="includes" class="block text-sm font-medium text-gray-700 mb-2">What's Included</label>
                        <textarea id="includes" name="includes" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('includes') border-red-500 @enderror" placeholder="List what's included in the package">{{ old('includes') }}</textarea>
                        @error('includes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Excludes -->
                    <div class="mt-8">
                        <label for="excludes" class="block text-sm font-medium text-gray-700 mb-2">What's Excluded</label>
                        <textarea id="excludes" name="excludes" rows="4" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('excludes') border-red-500 @enderror" placeholder="List what's excluded from the package">{{ old('excludes') }}</textarea>
                        @error('excludes')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="mt-8 flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.products.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Create Product
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection