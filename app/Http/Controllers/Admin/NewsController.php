<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = News::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
        }
        
        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }
        
        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->published();
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }
        
        // Filter by featured
        if ($request->filled('featured')) {
            $query->featured();
        }
        
        $news = $query->latest()->paginate(10);
        
        return view('admin.news.index', compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.news.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'read_time' => 'nullable|integer|min:1',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'is_published' => 'boolean'
        ]);
        
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['author_name'] = Auth::user()->name ?? 'Admin';
        
        // Process tags
        if ($request->filled('tags')) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        }
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }
        
        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('news/gallery', 'public');
            }
            $data['gallery_images'] = $galleryImages;
        }
        
        // Set is_published based on status
        $data['is_published'] = ($request->status === 'published');
        
        // Set published_at if publishing
        if ($request->status === 'published' && !$request->published_at) {
            $data['published_at'] = now();
        }
        
        News::create($data);
        
        Alert::success('Success', 'News article created successfully!');
        return redirect()->route('admin.news.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        // Increment views count
        $news->increment('views');
        
        return view('admin.news.show', compact('news'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(News $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'excerpt' => 'required|string|max:500',
            'content' => 'required|string',
            'category' => 'required|string|max:100',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'tags' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'read_time' => 'nullable|integer|min:1',
            'published_at' => 'nullable|date',
            'status' => 'required|in:draft,published',
            'is_featured' => 'boolean',
            'is_published' => 'boolean'
        ]);
        
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        // Process tags
        if ($request->filled('tags')) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        }
        
        // Handle featured image upload
        if ($request->hasFile('featured_image')) {
            // Delete old image
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
        }
        
        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images
            if ($news->gallery_images) {
                foreach ($news->gallery_images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
            
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('news/gallery', 'public');
            }
            $data['gallery_images'] = $galleryImages;
        }
        
        // Set is_published based on status
        $data['is_published'] = ($request->status === 'published');
        
        // Set published_at if publishing for the first time
        if ($request->status === 'published' && !$news->published_at && !$request->published_at) {
            $data['published_at'] = now();
        }
        
        $news->update($data);
        
        Alert::success('Success', 'News article updated successfully!');
        return redirect()->route('admin.news.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        // Delete associated images
        if ($news->featured_image) {
            Storage::disk('public')->delete($news->featured_image);
        }
        
        if ($news->gallery_images) {
            foreach ($news->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $news->delete();
        
        Alert::success('Success', 'News article deleted successfully!');
        return redirect()->route('admin.news.index');
    }
}
