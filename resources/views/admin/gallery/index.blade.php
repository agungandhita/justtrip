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
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Gallery Management</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Manage your gallery collection</p>
                </div>
                <a href="{{ route('admin.galleries.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                    </svg>
                    Add New Gallery
                </a>
            </div>
        </div>

        <!-- Search and Filters -->
        <div class="mb-6 px-4">
            <div class="bg-white rounded-xl shadow-md p-6">
                <form method="GET" action="{{ route('admin.galleries.index') }}" class="space-y-4">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                        <!-- Search by Title/Description -->
                        <div>
                            <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search by title or description..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                        </div>

                        <!-- Filter by Category -->
                        <div>
                            <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                            <select id="category" name="category" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Categories</option>
                                <option value="destinations" {{ request('category') == 'destinations' ? 'selected' : '' }}>Destinations</option>
                                <option value="activities" {{ request('category') == 'activities' ? 'selected' : '' }}>Activities</option>
                                <option value="accommodations" {{ request('category') == 'accommodations' ? 'selected' : '' }}>Accommodations</option>
                                <option value="food" {{ request('category') == 'food' ? 'selected' : '' }}>Food & Dining</option>
                                <option value="culture" {{ request('category') == 'culture' ? 'selected' : '' }}>Culture</option>
                                <option value="nature" {{ request('category') == 'nature' ? 'selected' : '' }}>Nature</option>
                                <option value="events" {{ request('category') == 'events' ? 'selected' : '' }}>Events</option>
                                <option value="other" {{ request('category') == 'other' ? 'selected' : '' }}>Other</option>
                            </select>
                        </div>

                        <!-- Filter by Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                            <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Status</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <!-- Filter by Featured -->
                        <div>
                            <label for="featured" class="block text-sm font-medium text-gray-700 mb-2">Featured</label>
                            <select id="featured" name="featured" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                <option value="">All Images</option>
                                <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured Only</option>
                                <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Non-Featured</option>
                            </select>
                        </div>
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/>
                                </svg>
                                Search
                            </button>
                            <a href="{{ route('admin.galleries.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                                </svg>
                                Clear
                            </a>
                        </div>
                        <div class="text-sm text-gray-600">
                            Showing {{ $galleries->firstItem() ?? 0 }} to {{ $galleries->lastItem() ?? 0 }} of {{ $galleries->total() }} results
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Gallery Grid -->
        <div class="px-4">
            @if($galleries->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                    @foreach($galleries as $gallery)
                        <div class="bg-white rounded-xl shadow-md overflow-hidden hover:shadow-lg transition-shadow duration-200">
                            <!-- Gallery Images -->
                            <div class="relative aspect-square">
                                @if($gallery->main_image || (is_array($gallery->images) && count($gallery->images) > 0))
                                    @php
                                        $mainImage = $gallery->main_image ?: (is_array($gallery->images) ? $gallery->images[0] : null);
                                    @endphp
                                    @if($mainImage)
                                        <img src="{{ asset('storage/' . $mainImage) }}" alt="{{ $gallery->title }}" class="w-full h-full object-cover">
                                        <!-- Image Count Badge -->
                                        @if(is_array($gallery->images) && count($gallery->images) > 1)
                                            <div class="absolute bottom-2 right-2">
                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-black bg-opacity-70 text-white">
                                                    {{ count($gallery->images) }} images
                                                </span>
                                            </div>
                                        @endif
                                    @else
                                        <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z"/>
                                            </svg>
                                        </div>
                                    @endif
                                @else
                                    <div class="w-full h-full bg-gray-200 flex items-center justify-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z"/>
                                        </svg>
                                    </div>
                                @endif

                                <!-- Status Badge -->
                                <div class="absolute top-2 left-2">
                                    <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium {{ $gallery->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                        {{ ucfirst($gallery->status) }}
                                    </span>
                                </div>

                                <!-- Featured Badge -->
                                @if($gallery->featured)
                                    <div class="absolute top-2 right-2">
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">
                                            Featured
                                        </span>
                                    </div>
                                @endif

                                <!-- Actions Overlay -->
                                <div class="absolute inset-0 bg-black bg-opacity-0 hover:bg-opacity-50 transition-all duration-200 flex items-center justify-center opacity-0 hover:opacity-100">
                                    <div class="flex items-center space-x-2">
                                        <a href="{{ route('admin.galleries.show', $gallery->id) }}" class="bg-white text-gray-800 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" title="View">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z"/>
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.galleries.edit', $gallery->id) }}" class="bg-white text-gray-800 p-2 rounded-full hover:bg-gray-100 transition-colors duration-200" title="Edit">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.galleries.destroy', $gallery->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this gallery and all its images?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="bg-white text-red-600 p-2 rounded-full hover:bg-red-50 transition-colors duration-200" title="Delete Gallery">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <!-- Content -->
                            <div class="p-4">
                                <h3 class="font-semibold text-gray-900 mb-1 truncate">{{ $gallery->title }}</h3>
                                @if($gallery->description)
                                    <p class="text-sm text-gray-600 mb-2 line-clamp-2">{{ Str::limit($gallery->description, 80) }}</p>
                                @endif
                                <div class="flex items-center justify-between text-xs text-gray-500">
                                    <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full">{{ ucwords(str_replace('-', ' ', $gallery->category ?? 'Other')) }}</span>
                                    <span>{{ $gallery->created_at->format('M d, Y') }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $galleries->withQueryString()->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-16 h-16 text-gray-400 mx-auto mb-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z"/>
                    </svg>
                    <h3 class="text-xl font-semibold text-gray-900 mb-2">No Galleries Found</h3>
                    <p class="text-gray-600 mb-6">{{ request()->hasAny(['search', 'category', 'status', 'featured']) ? 'No galleries match your search criteria.' : 'You haven\'t created any galleries yet.' }}</p>
                    @if(request()->hasAny(['search', 'category', 'status', 'featured']))
                        <a href="{{ route('admin.galleries.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                            </svg>
                            Clear Filters
                        </a>
                    @else
                        <a href="{{ route('admin.galleries.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 inline-flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                            </svg>
                            Create Your First Gallery
                        </a>
                    @endif
                </div>
            @endif
        </div>
    </div>

    <style>
        .line-clamp-2 {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }
    </style>
@endsection
