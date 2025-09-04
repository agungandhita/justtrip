@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Edit Special Offer</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Update special offer information</p>
                </div>
                <a href="{{ route('admin.special-offers.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                    </svg>
                    Back to Special Offers
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="px-4">
            <div class="bg-white rounded-xl shadow-md p-8">
                <form action="{{ route('admin.special-offers.update', $specialOffer->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Offer Title *</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $specialOffer->title) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-500 @enderror" placeholder="Enter offer title">
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Discount Type -->
                            <div>
                                <label for="discount_type" class="block text-sm font-medium text-gray-700 mb-2">Discount Type *</label>
                                <select id="discount_type" name="discount_type" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('discount_type') border-red-500 @enderror">
                                    <option value="">Select Discount Type</option>
                                    <option value="percentage" {{ old('discount_type', $specialOffer->discount_type) == 'percentage' ? 'selected' : '' }}>Percentage (%)</option>
                                    <option value="fixed" {{ old('discount_type', $specialOffer->discount_type) == 'fixed' ? 'selected' : '' }}>Fixed Amount ($)</option>
                                </select>
                                @error('discount_type')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Discount Value -->
                            <div>
                                <label for="discount_value" class="block text-sm font-medium text-gray-700 mb-2">Discount Value *</label>
                                <input type="number" id="discount_value" name="discount_value" value="{{ old('discount_value', $specialOffer->discount_value) }}" required min="0" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('discount_value') border-red-500 @enderror" placeholder="Enter discount value">
                                @error('discount_value')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Start Date -->
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Start Date *</label>
                                <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $specialOffer->start_date ? $specialOffer->start_date->format('Y-m-d') : '') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('start_date') border-red-500 @enderror">
                                @error('start_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">End Date *</label>
                                <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $specialOffer->end_date ? $specialOffer->end_date->format('Y-m-d') : '') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('end_date') border-red-500 @enderror">
                                @error('end_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                                <select id="status" name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                    <option value="active" {{ old('status', $specialOffer->status) == 'active' ? 'selected' : '' }}>Active</option>
                                    <option value="inactive" {{ old('status', $specialOffer->status) == 'inactive' ? 'selected' : '' }}>Inactive</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Current Image -->
                            @if($specialOffer->image)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                                    <div class="mb-4">
                                        <img src="{{ asset('storage/' . $specialOffer->image) }}" alt="Current offer image" class="w-full h-48 object-cover rounded-lg border">
                                    </div>
                                </div>
                            @endif

                            <!-- Image -->
                            <div>
                                <label for="image" class="block text-sm font-medium text-gray-700 mb-2">{{ $specialOffer->image ? 'Replace Image' : 'Offer Image' }}</label>
                                <input type="file" id="image" name="image" accept="image/png,image/jpg,image/jpeg,image/gif" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('image') border-red-500 @enderror">
                                <p class="text-sm text-gray-500 mt-1">Supported formats: PNG, JPG, GIF. Max size: 10MB</p>
                                @error('image')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Featured -->
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="featured" value="1" {{ old('featured', $specialOffer->featured) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Featured Offer</span>
                                </label>
                                @error('featured')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Terms and Conditions -->
                            <div>
                                <label for="terms_conditions" class="block text-sm font-medium text-gray-700 mb-2">Terms & Conditions</label>
                                <textarea id="terms_conditions" name="terms_conditions" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('terms_conditions') border-red-500 @enderror" placeholder="Enter terms and conditions">{{ old('terms_conditions', $specialOffer->terms_conditions) }}</textarea>
                                @error('terms_conditions')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Meta Title -->
                            <div>
                                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $specialOffer->meta_title) }}" maxlength="60" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('meta_title') border-red-500 @enderror" placeholder="SEO meta title (max 60 characters)">
                                @error('meta_title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Meta Description -->
                            <div>
                                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                <textarea id="meta_description" name="meta_description" rows="3" maxlength="160" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('meta_description') border-red-500 @enderror" placeholder="SEO meta description (max 160 characters)">{{ old('meta_description', $specialOffer->meta_description) }}</textarea>
                                @error('meta_description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-8">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Description *</label>
                        <textarea id="description" name="description" rows="6" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('description') border-red-500 @enderror" placeholder="Enter offer description">{{ old('description', $specialOffer->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="mt-8 flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.special-offers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Update Special Offer
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection