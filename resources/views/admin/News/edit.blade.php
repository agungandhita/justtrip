@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Edit Article</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Update article information</p>
                </div>
                <a href="{{ route('admin.news.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                    </svg>
                    Back to News
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="px-4">
            <div class="bg-white rounded-xl shadow-md p-8">
                <form action="{{ route('admin.news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                        <!-- Main Content -->
                        <div class="lg:col-span-2 space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Article Title *</label>
                                <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('title') border-red-500 @enderror" placeholder="Enter article title">
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Slug -->
                            <div>
                                <label for="slug" class="block text-sm font-medium text-gray-700 mb-2">URL Slug *</label>
                                <input type="text" id="slug" name="slug" value="{{ old('slug', $news->slug) }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('slug') border-red-500 @enderror" placeholder="article-url-slug">
                                <p class="text-sm text-gray-500 mt-1">URL-friendly version of the title</p>
                                @error('slug')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Excerpt -->
                            <div>
                                <label for="excerpt" class="block text-sm font-medium text-gray-700 mb-2">Excerpt *</label>
                                <textarea id="excerpt" name="excerpt" rows="3" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('excerpt') border-red-500 @enderror" placeholder="Brief summary of the article">{{ old('excerpt', $news->excerpt) }}</textarea>
                                @error('excerpt')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Content -->
                            <div>
                                <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Content *</label>
                                <textarea id="content" name="content" rows="15" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('content') border-red-500 @enderror" placeholder="Write your article content here...">{{ old('content', $news->content) }}</textarea>
                                @error('content')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- SEO Section -->
                            <div class="border-t pt-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">SEO Settings</h3>
                                <div class="space-y-4">
                                    <!-- Meta Title -->
                                    <div>
                                        <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Meta Title</label>
                                        <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title', $news->meta_title) }}" maxlength="60" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('meta_title') border-red-500 @enderror" placeholder="SEO meta title (max 60 characters)">
                                        @error('meta_title')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>

                                    <!-- Meta Description -->
                                    <div>
                                        <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Meta Description</label>
                                        <textarea id="meta_description" name="meta_description" rows="3" maxlength="160" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('meta_description') border-red-500 @enderror" placeholder="SEO meta description (max 160 characters)">{{ old('meta_description', $news->meta_description) }}</textarea>
                                        @error('meta_description')
                                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Sidebar -->
                        <div class="space-y-6">
                            <!-- Publishing Options -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Publishing Options</h3>
                                
                                <!-- Status -->
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                                    <select id="status" name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                        <option value="draft" {{ old('status', $news->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="published" {{ old('status', $news->status) == 'published' ? 'selected' : '' }}>Published</option>
                                    </select>
                                    @error('status')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Published Date -->
                                <div class="mb-4">
                                    <label for="published_at" class="block text-sm font-medium text-gray-700 mb-2">Published Date</label>
                                    <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('published_at') border-red-500 @enderror">
                                    <p class="text-sm text-gray-500 mt-1">Leave empty to use current date/time</p>
                                    @error('published_at')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Author -->
                                <div class="mb-4">
                                    <label for="author_name" class="block text-sm font-medium text-gray-700 mb-2">Author</label>
                                    <input type="text" id="author_name" name="author_name" value="{{ old('author_name', $news->author_name) }}" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('author_name') border-red-500 @enderror" placeholder="Article author">
                                    @error('author_name')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Featured -->
                                <div>
                                    <label class="flex items-center">
                                        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }} class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700">Featured Article</span>
                                    </label>
                                    @error('is_featured')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Featured Image -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Featured Image</h3>
                                
                                @if($news->featured_image)
                                    <div class="mb-4">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">Current Image</label>
                                        <img src="{{ asset('storage/' . $news->featured_image) }}" alt="Current featured image" class="w-full h-48 object-cover rounded-lg border">
                                    </div>
                                @endif
                                
                                <div>
                                    <label for="featured_image" class="block text-sm font-medium text-gray-700 mb-2">{{ $news->featured_image ? 'Replace Image' : 'Featured Image' }}</label>
                                    <input type="file" id="featured_image" name="featured_image" accept="image/png,image/jpg,image/jpeg,image/gif" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('featured_image') border-red-500 @enderror">
                                    <p class="text-sm text-gray-500 mt-1">Supported formats: PNG, JPG, GIF. Max size: 10MB</p>
                                    @error('featured_image')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <!-- Categories/Tags -->
                            <div class="bg-gray-50 rounded-lg p-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-4">Categories</h3>
                                <div>
                                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Category</label>
                                    <select id="category" name="category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('category') border-red-500 @enderror">
                                        <option value="">Select Category</option>
                                        <option value="travel-tips" {{ old('category', $news->category) == 'travel-tips' ? 'selected' : '' }}>Travel Tips</option>
                                        <option value="destinations" {{ old('category', $news->category) == 'destinations' ? 'selected' : '' }}>Destinations</option>
                                        <option value="company-news" {{ old('category', $news->category) == 'company-news' ? 'selected' : '' }}>Company News</option>
                                        <option value="travel-guides" {{ old('category', $news->category) == 'travel-guides' ? 'selected' : '' }}>Travel Guides</option>
                                        <option value="promotions" {{ old('category', $news->category) == 'promotions' ? 'selected' : '' }}>Promotions</option>
                                    </select>
                                    @error('category')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Buttons -->
                    <div class="mt-8 flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.news.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Cancel
                        </a>
                        <button type="submit" name="action" value="save_draft" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Save as Draft
                        </button>
                        <button type="submit" name="action" value="update" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Update Article
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Froala Editor CSS -->
    <link href="https://cdn.jsdelivr.net/npm/froala-editor@latest/css/froala_editor.pkgd.min.css" rel="stylesheet" type="text/css" />
    
    <!-- Froala Editor JS -->
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/froala-editor@latest/js/froala_editor.pkgd.min.js"></script>
    <script>
        // Initialize Froala Editor
        new FroalaEditor('#content', {
            // Set the editor height
            height: 400,
            
            // Toolbar buttons
            toolbarButtons: {
                'moreText': {
                    'buttons': ['bold', 'italic', 'underline', 'strikeThrough', 'subscript', 'superscript', 'fontFamily', 'fontSize', 'textColor', 'backgroundColor', 'inlineClass', 'inlineStyle', 'clearFormatting']
                },
                'moreParagraph': {
                    'buttons': ['alignLeft', 'alignCenter', 'alignRight', 'alignJustify', 'formatOLSimple', 'formatOL', 'formatUL', 'paragraphFormat', 'paragraphStyle', 'lineHeight', 'outdent', 'indent', 'quote']
                },
                'moreRich': {
                    'buttons': ['insertLink', 'insertImage', 'insertVideo', 'insertTable', 'emoticons', 'fontAwesome', 'specialCharacters', 'embedly', 'insertFile', 'insertHR']
                },
                'moreMisc': {
                    'buttons': ['undo', 'redo', 'fullscreen', 'print', 'getPDF', 'spellChecker', 'selectAll', 'html', 'help'],
                    'align': 'right',
                    'buttonsVisible': 2
                }
            },
            
            // Plugin options
            pluginsEnabled: ['align', 'charCounter', 'codeBeautifier', 'codeView', 'colors', 'draggable', 'emoticons', 'entities', 'file', 'fontFamily', 'fontSize', 'fullscreen', 'image', 'imageManager', 'inlineStyle', 'lineBreaker', 'link', 'lists', 'paragraphFormat', 'paragraphStyle', 'quickInsert', 'quote', 'save', 'table', 'url', 'video', 'wordPaste'],
            
            // Image upload settings
            imageUploadURL: '/upload_image',
            imageUploadParams: {
                _token: '{{ csrf_token() }}'
            },
            
            // Theme
            theme: 'royal',
            
            // Language
            language: 'en',
            
            // Placeholder
            placeholderText: 'Edit konten artikel di sini...',
            
            // Character counter
            charCounterCount: true,
            
            // Quick insert
            quickInsertEnabled: true,
            
            // Paste settings
            pastePlain: false,
            
            // Enter behavior
            enter: FroalaEditor.ENTER_BR
        });

        // Auto-generate slug from title
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slug = title.toLowerCase()
                .replace(/[^\w\s-]/g, '') // Remove special characters
                .replace(/[\s_-]+/g, '-') // Replace spaces and underscores with hyphens
                .replace(/^-+|-+$/g, ''); // Remove leading/trailing hyphens
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection