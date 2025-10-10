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
        try {
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
            
            $news = News::create($data);
            
            // Enhanced SweetAlert with more details
            $statusText = $request->status === 'published' ? 'published' : 'saved as draft';
            Alert::success(
                'Berhasil!', 
                "Artikel berita '{$news->title}' berhasil dibuat dan {$statusText}!"
            )->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.news.index');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error(
                'Validasi Gagal!', 
                'Mohon periksa kembali data yang Anda masukkan.'
            )->persistent(true);
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Alert::error(
                'Terjadi Kesalahan!', 
                'Gagal membuat artikel berita. Silakan coba lagi.'
            )->persistent(true);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(News $news)
    {
        try {
            // Increment views count
            $news->increment('views');
            
            // Optional: Show info about view increment (can be disabled if too intrusive)
            if (request()->has('show_view_info')) {
                Alert::info(
                    'Artikel Dibaca!', 
                    "Jumlah pembaca artikel '{$news->title}' bertambah menjadi {$news->views} kali."
                )->autoClose(3000);
            }
            
            return view('admin.news.show', compact('news'));
            
        } catch (\Exception $e) {
            Alert::error(
                'Terjadi Kesalahan!', 
                'Gagal memuat artikel berita. Silakan coba lagi.'
            )->persistent(true);
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
            
            $oldTitle = $news->title;
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
            
            // Enhanced SweetAlert with more details
            $statusText = $request->status === 'published' ? 'dipublikasikan' : 'disimpan sebagai draft';
            Alert::success(
                'Berhasil Diperbarui!', 
                "Artikel berita '{$news->title}' berhasil diperbarui dan {$statusText}!"
            )->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.news.index');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error(
                'Validasi Gagal!', 
                'Mohon periksa kembali data yang Anda masukkan.'
            )->persistent(true);
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Alert::error(
                'Terjadi Kesalahan!', 
                'Gagal memperbarui artikel berita. Silakan coba lagi.'
            )->persistent(true);
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
            
            // Enhanced SweetAlert with more details
            Alert::success(
                'Berhasil Dihapus!', 
                "Artikel berita '{$newsTitle}' berhasil dihapus dari sistem!"
            )->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.news.index');
            
        } catch (\Exception $e) {
            Alert::error(
                'Terjadi Kesalahan!', 
                'Gagal menghapus artikel berita. Silakan coba lagi.'
            )->persistent(true);
            return back();
        }
    }
    
    /**
     * Show confirmation before deleting news article
     */
    public function confirmDelete(News $news)
    {
        Alert::warning(
            'Konfirmasi Hapus!',
            "Apakah Anda yakin ingin menghapus artikel '{$news->title}'? Tindakan ini tidak dapat dibatalkan!"
        )->showConfirmButton('Ya, Hapus!')
         ->showCancelButton('Batal')
         ->confirmButtonColor('#d33')
         ->cancelButtonColor('#3085d6');
         
        return back();
    }
    
    /**
     * Toggle publish status of news article
     */
    public function togglePublish(News $news)
    {
        try {
            $news->is_published = !$news->is_published;
            
            if ($news->is_published && !$news->published_at) {
                $news->published_at = now();
            }
            
            $news->save();
            
            $status = $news->is_published ? 'dipublikasikan' : 'dijadikan draft';
            Alert::success(
                'Status Berubah!', 
                "Artikel '{$news->title}' berhasil {$status}!"
            )->autoClose(4000);
            
            return back();
            
        } catch (\Exception $e) {
            Alert::error(
                'Terjadi Kesalahan!', 
                'Gagal mengubah status publikasi artikel.'
            )->persistent(true);
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
            Alert::success(
                'Status Unggulan Berubah!', 
                "Artikel '{$news->title}' berhasil {$status}!"
            )->autoClose(4000);
            
            return back();
            
        } catch (\Exception $e) {
            Alert::error(
                'Terjadi Kesalahan!', 
                'Gagal mengubah status unggulan artikel.'
            )->persistent(true);
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
            
            $newsIds = $request->selected_news;
            $newsArticles = News::whereIn('id', $newsIds)->get();
            $count = $newsArticles->count();
            
            // Delete associated images for each article
            foreach ($newsArticles as $news) {
                if ($news->featured_image) {
                    Storage::disk('public')->delete($news->featured_image);
                }
                
                if ($news->gallery_images) {
                    foreach ($news->gallery_images as $image) {
                        Storage::disk('public')->delete($image);
                    }
                }
            }
            
            // Delete the articles
            News::whereIn('id', $newsIds)->delete();
            
            Alert::success(
                'Berhasil Dihapus!', 
                "{$count} artikel berita berhasil dihapus dari sistem!"
            )->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.news.index');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error(
                'Validasi Gagal!', 
                'Mohon pilih minimal satu artikel untuk dihapus.'
            )->persistent(true);
            return back();
            
        } catch (\Exception $e) {
            Alert::error(
                'Terjadi Kesalahan!', 
                'Gagal menghapus artikel berita yang dipilih.'
            )->persistent(true);
            return back();
        }
    }
}
