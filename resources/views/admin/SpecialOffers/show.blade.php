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
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Special Offer Details</h1>
                    </div>
                    <p class="text-gray-600 pl-11">View special offer information</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.special-offers.edit', $specialOffer->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('admin.special-offers.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                        </svg>
                        Back to Special Offers
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Basic Information -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h2 class="text-xl font-semibold text-gray-800 mb-4">Basic Information</h2>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Title</label>
                                <p class="text-gray-900 font-medium">{{ $specialOffer->title }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $specialOffer->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($specialOffer->status) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Discount Type</label>
                                <p class="text-gray-900">{{ ucfirst($specialOffer->discount_type) }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Discount Value</label>
                                <p class="text-gray-900 font-medium">
                                    {{ $specialOffer->discount_value }}
                                    {{ $specialOffer->discount_type == 'percentage' ? '%' : '$' }}
                                </p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Start Date</label>
                                <p class="text-gray-900">{{ $specialOffer->start_date ? $specialOffer->start_date->format('M d, Y') : 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">End Date</label>
                                <p class="text-gray-900">{{ $specialOffer->end_date ? $specialOffer->end_date->format('M d, Y') : 'N/A' }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Featured</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $specialOffer->featured ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $specialOffer->featured ? 'Yes' : 'No' }}
                                </span>
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    @if($specialOffer->description)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Description</h2>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 leading-relaxed">{{ $specialOffer->description }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- Terms and Conditions -->
                    @if($specialOffer->terms_conditions)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">Terms & Conditions</h2>
                            <div class="prose max-w-none">
                                <p class="text-gray-700 leading-relaxed">{{ $specialOffer->terms_conditions }}</p>
                            </div>
                        </div>
                    @endif

                    <!-- SEO Information -->
                    @if($specialOffer->meta_title || $specialOffer->meta_description)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h2 class="text-xl font-semibold text-gray-800 mb-4">SEO Information</h2>
                            <div class="space-y-4">
                                @if($specialOffer->meta_title)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Meta Title</label>
                                        <p class="text-gray-900">{{ $specialOffer->meta_title }}</p>
                                    </div>
                                @endif
                                @if($specialOffer->meta_description)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Meta Description</label>
                                        <p class="text-gray-900">{{ $specialOffer->meta_description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Image -->
                    @if($specialOffer->image)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Offer Image</h3>
                            <img src="{{ asset('storage/' . $specialOffer->image) }}" alt="{{ $specialOffer->title }}" class="w-full h-64 object-cover rounded-lg border">
                        </div>
                    @endif

                    <!-- Timestamps -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Timestamps</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Created At</label>
                                <p class="text-gray-900 text-sm">{{ $specialOffer->created_at->format('M d, Y \\a\\t g:i A') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                                <p class="text-gray-900 text-sm">{{ $specialOffer->updated_at->format('M d, Y \\a\\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.special-offers.edit', $specialOffer->id) }}" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                                </svg>
                                Edit Special Offer
                            </a>
                            <form action="{{ route('admin.special-offers.destroy', $specialOffer->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this special offer?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                                    </svg>
                                    Delete Special Offer
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection