<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display the articles page.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = News::where('is_published', true);

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%")
                  ->orWhere('excerpt', 'like', "%{$search}%");
            });
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
            case 'title':
                $query->orderBy('title', 'asc');
                break;
            default:
                $query->latest();
                break;
        }

        $articles = $query->paginate(12);

        // Get featured articles for hero section
        $featuredArticles = News::where('is_published', true)
                               ->where('is_featured', true)
                               ->latest()
                               ->take(3)
                               ->get();

        // Get filter options
        $categories = News::where('is_published', true)
                         ->distinct()
                         ->pluck('category')
                         ->filter()
                         ->sort()
                         ->values();

        return view('Frontend.articles.index', compact('articles', 'featuredArticles', 'categories'));
    }

    /**
     * Display the specified article.
     */
    public function show($slug)
    {
        $article = News::where('slug', $slug)
                      ->where('is_published', true)
                      ->firstOrFail();

        // Increment views
        $article->increment('views');

        // Get related articles
        $relatedArticles = News::where('is_published', true)
                              ->where('id', '!=', $article->id)
                              ->where('category', $article->category)
                              ->latest()
                              ->take(3)
                              ->get();

        return view('Frontend.articles.show', compact('article', 'relatedArticles'));
    }
}