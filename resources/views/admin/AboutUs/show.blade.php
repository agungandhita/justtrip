@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">About Us Details</h1>
                    </div>
                    <p class="text-gray-600 pl-11">View about us content details</p>
                </div>
                <div class="flex items-center space-x-3">
                    <a href="{{ route('admin.about-us.edit', $aboutUs) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                        </svg>
                        Edit
                    </a>
                    <a href="{{ route('admin.about-us.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                        </svg>
                        Back
                    </a>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="px-4">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Header Info -->
                <div class="px-8 py-6 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <h2 class="text-2xl font-bold text-gray-900">{{ $aboutUs->title }}</h2>
                            <div class="flex items-center space-x-4 mt-2">
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst($aboutUs->section) }}
                                </span>
                                <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $aboutUs->status == 'active' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ ucfirst($aboutUs->status) }}
                                </span>
                                @if($aboutUs->order)
                                    <span class="text-sm text-gray-500">Order: {{ $aboutUs->order }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="text-right text-sm text-gray-500">
                            <p>Created: {{ $aboutUs->created_at->format('M d, Y H:i') }}</p>
                            <p>Updated: {{ $aboutUs->updated_at->format('M d, Y H:i') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Image -->
                @if($aboutUs->image)
                    <div class="px-8 py-6 border-b border-gray-200">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Image</h3>
                        <div class="flex justify-center">
                            <img src="{{ Storage::url($aboutUs->image) }}" alt="{{ $aboutUs->title }}" class="max-w-full h-auto rounded-lg shadow-md">
                        </div>
                    </div>
                @endif

                <!-- Content -->
                <div class="px-8 py-6 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Content</h3>
                    <div class="prose max-w-none text-gray-700">
                        {!! nl2br(e($aboutUs->content)) !!}
                    </div>
                </div>

                <!-- SEO Information -->
                @if($aboutUs->meta_title || $aboutUs->meta_description)
                    <div class="px-8 py-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">SEO Information</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            @if($aboutUs->meta_title)
                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $aboutUs->meta_title }}</p>
                                </div>
                            @endif
                            @if($aboutUs->meta_description)
                                <div class="md:col-span-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                    <p class="text-gray-900 bg-gray-50 p-3 rounded-lg">{{ $aboutUs->meta_description }}</p>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection