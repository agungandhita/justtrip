@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Article Details</h1>
                    </div>
                    <p class="text-gray-600 pl-11">View article information</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.news.edit', $news->id) }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('admin.news.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                        </svg>
                        Back to News
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content -->
                <div class="lg:col-span-2 space-y-6">
                    <!-- Article Header -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <div class="flex items-start justify-between mb-4">
                            <div class="flex-1">
                                <h2 class="text-2xl font-bold text-gray-900 mb-2">{{ $news->title }}</h2>
                                <div class="flex items-center space-x-4 text-sm text-gray-500">
                                    <span>By {{ $news->author_name ?? 'Admin' }}</span>
                                    <span>•</span>
                                    <span>{{ $news->published_at ? $news->published_at->format('M d, Y \\a\\t g:i A') : 'Not Published' }}</span>
                                    @if($news->category)
                                        <span>•</span>
                                        <span class="bg-gray-100 text-gray-800 px-2 py-1 rounded-full text-xs">{{ ucwords(str_replace('-', ' ', $news->category)) }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $news->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($news->status) }}
                                </span>
                                @if($news->is_featured)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                        Featured
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        @if($news->excerpt)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h3 class="text-sm font-medium text-gray-700 mb-2">Excerpt</h3>
                                <p class="text-gray-600 italic">{{ $news->excerpt }}</p>
                            </div>
                        @endif
                    </div>

                    <!-- Featured Image -->
                    @if($news->featured_image)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Featured Image</h3>
                            <img src="{{ asset('storage/' . $news->featured_image) }}" alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-lg border">
                        </div>
                    @endif

                    <!-- Article Content -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Content</h3>
                        <div class="prose max-w-none">
                            <div class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $news->content }}</div>
                        </div>
                    </div>

                    <!-- SEO Information -->
                    @if($news->meta_title || $news->meta_description)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">SEO Information</h3>
                            <div class="space-y-4">
                                @if($news->meta_title)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Meta Title</label>
                                        <p class="text-gray-900">{{ $news->meta_title }}</p>
                                    </div>
                                @endif
                                @if($news->meta_description)
                                    <div>
                                        <label class="block text-sm font-medium text-gray-500 mb-1">Meta Description</label>
                                        <p class="text-gray-900">{{ $news->meta_description }}</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar -->
                <div class="space-y-6">
                    <!-- Article Info -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Article Information</h3>
                        <div class="space-y-3">
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $news->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ ucfirst($news->status) }}
                                </span>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Author</label>
                                <p class="text-gray-900">{{ $news->author_name ?? 'Admin' }}</p>
                            </div>
                            @if($news->category)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Category</label>
                                    <p class="text-gray-900">{{ ucwords(str_replace('-', ' ', $news->category)) }}</p>
                                </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Featured</label>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium {{ $news->is_featured ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                    {{ $news->is_featured ? 'Yes' : 'No' }}
                                </span>
                            </div>
                            @if($news->slug)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">URL Slug</label>
                                    <p class="text-gray-900 text-sm font-mono bg-gray-50 px-2 py-1 rounded">{{ $news->slug }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Timestamps -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Timestamps</h3>
                        <div class="space-y-3">
                            @if($news->published_at)
                                <div>
                                    <label class="block text-sm font-medium text-gray-500 mb-1">Published At</label>
                                    <p class="text-gray-900 text-sm">{{ $news->published_at->format('M d, Y \\a\\t g:i A') }}</p>
                                </div>
                            @endif
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Created At</label>
                                <p class="text-gray-900 text-sm">{{ $news->created_at->format('M d, Y \\a\\t g:i A') }}</p>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-500 mb-1">Last Updated</label>
                                <p class="text-gray-900 text-sm">{{ $news->updated_at->format('M d, Y \\a\\t g:i A') }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Actions -->
                    <div class="bg-white rounded-xl shadow-md p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Actions</h3>
                        <div class="space-y-3">
                            <a href="{{ route('admin.news.edit', $news->id) }}" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                                </svg>
                                Edit Article
                            </a>
                            @if($news->status == 'draft')
                                <form action="{{ route('admin.news.update', $news->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="published">
                                    <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M11,16.5L18,9.5L16.59,8.09L11,13.67L7.91,10.59L6.5,12L11,16.5Z"/>
                                        </svg>
                                        Publish Article
                                    </button>
                                </form>
                            @endif
                            <form action="{{ route('admin.news.destroy', $news->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                                    </svg>
                                    Delete Article
                                </button>
                            </form>
                        </div>
                    </div>

                    <!-- Preview Link -->
                    @if($news->status == 'published' && $news->slug)
                        <div class="bg-white rounded-xl shadow-md p-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-4">Public View</h3>
                            <a href="#" target="_blank" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M14,3V5H17.59L7.76,14.83L9.17,16.24L19,6.41V10H21V3M19,19H5V5H12V3H5C3.89,3 3,3.9 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V12H19V19Z"/>
                                </svg>
                                View on Website
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection