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
                  ->orWhere('content', 'like', "%{$search}%");
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
                $query->where('status', 'draft');
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
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category' => 'required|string|max:100',
                'featured_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:draft,published',
                'is_featured' => 'boolean',
                'published_at' => 'nullable|date'
            ]);
            
            $data = [
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'category' => $validated['category'],
                'author_name' => Auth::user()->name ?? 'Admin',
                'status' => $validated['status'],
                'is_featured' => $request->boolean('is_featured'),
                'published_at' => $validated['status'] === 'published' 
                    ? ($validated['published_at'] ?? now()) 
                    : $validated['published_at']
            ];
            
            // Handle featured image upload
            if ($request->hasFile('featured_image')) {
                $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
            }
            
            $news = News::create($data);
            
            $statusText = $validated['status'] === 'published' ? 'published' : 'saved as draft';
            Alert::success('Berhasil!', "Artikel '{$news->title}' berhasil {$statusText}!")
                ->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.news.index');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Validasi Gagal!', 'Mohon periksa kembali data yang Anda masukkan.')
                ->persistent(true);
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal membuat artikel. Silakan coba lagi.')
                ->persistent(true);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        try {
            $news->increment('views');
            return view('admin.news.show', compact('news'));
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal memuat artikel.')
                ->persistent(true);
            return redirect()->route('admin.news.index');
        }
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
        try {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'content' => 'required|string',
                'category' => 'required|string|max:100',
                'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'status' => 'required|in:draft,published',
                'is_featured' => 'boolean',
                'published_at' => 'nullable|date'
            ]);
            
            $data = [
                'title' => $validated['title'],
                'slug' => Str::slug($validated['title']),
                'content' => $validated['content'],
                'category' => $validated['category'],
                'status' => $validated['status'],
                'is_featured' => $request->boolean('is_featured')
            ];
            
            if ($validated['status'] === 'published') {
                if (isset($validated['published_at'])) {
                    $data['published_at'] = $validated['published_at'];
                }
                elseif (!$news->published_at) {
                    $data['published_at'] = now();
                }
            } elseif ($validated['status'] === 'draft') {
            }
            
            
            if ($request->hasFile('featured_image')) {
                if ($news->featured_image) {
                    Storage::disk('public')->delete($news->featured_image);
                }
                $data['featured_image'] = $request->file('featured_image')->store('news', 'public');
            }
            
            $news->update($data);
            
            $statusText = $validated['status'] === 'published' ? 'dipublikasikan' : 'disimpan sebagai draft';
            Alert::success('Berhasil Diperbarui!', "Artikel '{$news->title}' berhasil {$statusText}!")
                ->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.news.index');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Validasi Gagal!', 'Mohon periksa kembali data yang Anda masukkan.')
                ->persistent(true);
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal memperbarui artikel.')
                ->persistent(true);
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(News $news)
    {
        try {
            $newsTitle = $news->title;
            
            // Delete associated image
            if ($news->featured_image) {
                Storage::disk('public')->delete($news->featured_image);
            }
            
            $news->delete();
            
            Alert::success('Berhasil Dihapus!', "Artikel '{$newsTitle}' berhasil dihapus!")
                ->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.news.index');
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal menghapus artikel.')
                ->persistent(true);
            return back();
        }
    }
    
    /**
     * Toggle publish status of news article
     */
    public function togglePublish(News $news)
    {
        try {
            $news->status = $news->status === 'published' ? 'draft' : 'published';
            
            if ($news->status === 'published' && !$news->published_at) {
                $news->published_at = now();
            }
            
            $news->save();
            
            $status = $news->status === 'published' ? 'dipublikasikan' : 'dijadikan draft';
            Alert::success('Status Berubah!', "Artikel '{$news->title}' berhasil {$status}!")
                ->autoClose(4000);
            
            return back();
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengubah status publikasi.')
                ->persistent(true);
            return back();
        }
    }
    
    /**
     * Toggle featured status of news article
     */
    public function toggleFeatured(News $news)
    {
        try {
            $news->is_featured = !$news->is_featured;
            $news->save();
            
            $status = $news->is_featured ? 'ditandai sebagai unggulan' : 'dihapus dari unggulan';
            Alert::success('Status Unggulan Berubah!', "Artikel '{$news->title}' berhasil {$status}!")
                ->autoClose(4000);
            
            return back();
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengubah status unggulan.')
                ->persistent(true);
            return back();
        }
    }
    
    /**
     * Bulk delete selected news articles
     */
    public function bulkDelete(Request $request)
    {
        try {
            $request->validate([
                'selected_news' => 'required|array|min:1',
                'selected_news.*' => 'exists:news,id'
            ]);
            
            $newsArticles = News::whereIn('id', $request->selected_news)->get();
            $count = $newsArticles->count();
            
            // Delete associated images
            foreach ($newsArticles as $news) {
                if ($news->featured_image) {
                    Storage::disk('public')->delete($news->featured_image);
                }
            }
            
            News::whereIn('id', $request->selected_news)->delete();
            
            Alert::success('Berhasil Dihapus!', "{$count} artikel berhasil dihapus!")
                ->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.news.index');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Validasi Gagal!', 'Mohon pilih minimal satu artikel.')
                ->persistent(true);
            return back();
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal menghapus artikel yang dipilih.')
                ->persistent(true);
            return back();
        }
    }
}

