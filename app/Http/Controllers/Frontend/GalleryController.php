<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    /**
     * Display a listing of public galleries.
     */
    public function index(Request $request)
    {
        $query = Gallery::where('is_public', true)
                       ->where('status', 'active');

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('destination', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        // Filter by destination
        if ($request->filled('destination')) {
            $query->byDestination($request->destination);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter by featured
        if ($request->filled('featured') && $request->featured == '1') {
            $query->featured();
        }

        // Sort options
        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'popular':
                $query->orderBy('views', 'desc');
                break;
            case 'liked':
                $query->orderBy('likes', 'desc');
                break;
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $galleries = $query->paginate(12);

        // Get filter options
        $destinations = Gallery::where('is_public', true)
                              ->where('status', 'active')
                              ->distinct()
                              ->pluck('destination')
                              ->filter()
                              ->sort()
                              ->values();

        $categories = Gallery::where('is_public', true)
                            ->where('status', 'active')
                            ->distinct()
                            ->pluck('category')
                            ->filter()
                            ->sort()
                            ->values();

        return view('Frontend.gallery.index', compact('galleries', 'destinations', 'categories'));
    }

    /**
     * Display the specified gallery.
     */
    public function show($slug)
    {
        $gallery = Gallery::where('slug', $slug)
                         ->where('is_public', true)
                         ->where('status', 'active')
                         ->firstOrFail();

        // Increment views count
        $gallery->increment('views');

        // Get related galleries (same destination or category)
        $relatedGalleries = Gallery::where('is_public', true)
                                  ->where('status', 'active')
                                  ->where('id', '!=', $gallery->id)
                                  ->where(function($query) use ($gallery) {
                                      $query->where('destination', $gallery->destination)
                                            ->orWhere('category', $gallery->category);
                                  })
                                  ->limit(6)
                                  ->get();

        // Get previous and next galleries for navigation
        $previousGallery = Gallery::where('is_public', true)
                                 ->where('status', 'active')
                                 ->where('id', '<', $gallery->id)
                                 ->orderBy('id', 'desc')
                                 ->first();

        $nextGallery = Gallery::where('is_public', true)
                             ->where('status', 'active')
                             ->where('id', '>', $gallery->id)
                             ->orderBy('id', 'asc')
                             ->first();

        return view('Frontend.gallery.show', compact('gallery', 'relatedGalleries', 'previousGallery', 'nextGallery'));
    }

    /**
     * Toggle like for a gallery item (AJAX)
     */
    public function toggleLike(Gallery $gallery)
    {
        // Check if gallery is public and active
        if (!$gallery->is_public || $gallery->status !== 'active') {
            return response()->json([
                'success' => false,
                'message' => 'Gallery tidak tersedia'
            ], 404);
        }

        $gallery->increment('likes');

        return response()->json([
            'success' => true,
            'likes' => $gallery->likes,
            'message' => 'Terima kasih atas like Anda!'
        ]);
    }

    /**
     * Get featured galleries for homepage or other sections
     */
    public function getFeatured($limit = 6)
    {
        $featuredGalleries = Gallery::where('is_public', true)
                                   ->where('status', 'active')
                                   ->featured()
                                   ->latest()
                                   ->limit($limit)
                                   ->get();

        return $featuredGalleries;
    }

    /**
     * Get popular galleries based on views
     */
    public function getPopular($limit = 6)
    {
        $popularGalleries = Gallery::where('is_public', true)
                                  ->where('status', 'active')
                                  ->orderBy('views', 'desc')
                                  ->limit($limit)
                                  ->get();

        return $popularGalleries;
    }

    /**
     * Search galleries (for AJAX search)
     */
    public function search(Request $request)
    {
        $query = $request->get('q', '');
        
        if (strlen($query) < 2) {
            return response()->json([
                'success' => false,
                'message' => 'Query terlalu pendek'
            ]);
        }

        $galleries = Gallery::where('is_public', true)
                           ->where('status', 'active')
                           ->where(function($q) use ($query) {
                               $q->where('title', 'like', "%{$query}%")
                                 ->orWhere('description', 'like', "%{$query}%")
                                 ->orWhere('destination', 'like', "%{$query}%")
                                 ->orWhere('location', 'like', "%{$query}%");
                           })
                           ->limit(10)
                           ->get(['id', 'title', 'slug', 'destination', 'main_image']);

        return response()->json([
            'success' => true,
            'galleries' => $galleries
        ]);
    }
}