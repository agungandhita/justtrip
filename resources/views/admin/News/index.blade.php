@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20,11H23V13H20V11M1,11H4V13H1V11M13,1V4H11V1H13M4.92,3.5L7.05,5.64L5.63,7.05L3.5,4.93L4.92,3.5M16.95,5.63L19.07,3.5L20.5,4.93L18.37,7.05L16.95,5.63M12,6A6,6 0 0,1 18,12C18,14.22 16.79,16.16 15,17.2V19A1,1 0 0,1 14,20H10A1,1 0 0,1 9,19V17.2C7.21,16.16 6,14.22 6,12A6,6 0 0,1 12,6M14,21V22A1,1 0 0,1 13,23H11A1,1 0 0,1 10,22V21H14M11,16H13V8H11V16Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">News Management</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Manage news articles and blog posts</p>
                </div>
                <a href="{{ route('admin.news.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                    </svg>
                    Add News Article
                </a>
            </div>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="mb-6 px-4">
                <div class="bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-lg">
                    {{ session('success') }}
                </div>
            </div>
        @endif

        <!-- Filters -->
        <div class="mb-6 px-4">
            <div class="bg-white rounded-xl shadow-md p-6">
                <form action="{{ route('admin.news.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                    <div>
                        <label for="search" class="block text-sm font-medium text-gray-700 mb-2">Search</label>
                        <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Search by title or content..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div>
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">All Status</option>
                            <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                        </select>
                    </div>
                    <div>
                        <label for="featured" class="block text-sm font-medium text-gray-700 mb-2">Featured</label>
                        <select id="featured" name="featured" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">All Articles</option>
                            <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Featured</option>
                            <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Not Featured</option>
                        </select>
                    </div>
                    <div class="flex items-end">
                        <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- News Table -->
        <div class="px-4">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Article</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Author</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Featured</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Published Date</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($news as $article)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center">
                                            @if($article->featured_image)
                                                <img src="{{ asset('storage/' . $article->featured_image) }}" alt="{{ $article->title }}" class="w-16 h-16 object-cover rounded-lg mr-4">
                                            @else
                                                <div class="w-16 h-16 bg-gray-200 rounded-lg mr-4 flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                                    </svg>
                                                </div>
                                            @endif
                                            <div>
                                                <div class="text-sm font-medium text-gray-900">{{ Str::limit($article->title, 50) }}</div>
                                                <div class="text-sm text-gray-500">{{ Str::limit($article->excerpt, 80) }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <div class="text-sm text-gray-900">{{ $article->author_name ?? 'Admin' }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->status == 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                            {{ ucfirst($article->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $article->is_featured ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-800' }}">
                                                {{ $article->is_featured ? 'Featured' : 'Regular' }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $article->published_at ? $article->published_at->format('M d, Y') : 'Not Published' }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.news.show', $article->id) }}" class="text-indigo-600 hover:text-indigo-900 bg-indigo-50 hover:bg-indigo-100 px-3 py-1 rounded-md transition-colors duration-200">
                                                View
                                            </a>
                                            <a href="{{ route('admin.news.edit', $article->id) }}" class="text-yellow-600 hover:text-yellow-900 bg-yellow-50 hover:bg-yellow-100 px-3 py-1 rounded-md transition-colors duration-200">
                                                Edit
                                            </a>
                                            <form action="{{ route('admin.news.destroy', $article->id) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this article?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 bg-red-50 hover:bg-red-100 px-3 py-1 rounded-md transition-colors duration-200">
                                                    Delete
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mb-4" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                            </svg>
                                            <h3 class="text-lg font-medium text-gray-900 mb-2">No news articles found</h3>
                                            <p class="text-gray-500 mb-4">Get started by creating your first news article.</p>
                                            <a href="{{ route('admin.news.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg font-medium transition-colors duration-200">
                                                Add News Article
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                @if($news->hasPages())
                    <div class="bg-white px-4 py-3 border-t border-gray-200">
                        {{ $news->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection