<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Review::query();
        
        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('customer_name', 'like', "%{$search}%")
                  ->orWhere('destination', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
        }
        
        // Filter by status
        if ($request->filled('status')) {
            $query->where('is_active', $request->status === 'active');
        }
        
        // Filter by rating
        if ($request->filled('rating')) {
            $query->where('rating', $request->rating);
        }
        
        $reviews = $query->ordered()->paginate(10);
        
        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.reviews.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_position' => 'nullable|string|max:255',
                'customer_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'destination' => 'required|string|max:255',
                'content' => 'required|string|max:1000',
                'rating' => 'required|integer|min:1|max:5',
                'is_active' => 'boolean',
                'order' => 'nullable|integer|min:0',
            ]);
            
            $data = [
                'customer_name' => $validated['customer_name'],
                'customer_position' => $validated['customer_position'] ?? null,
                'destination' => $validated['destination'],
                'content' => $validated['content'],
                'rating' => $validated['rating'],
                'is_active' => $request->boolean('is_active'),
                'order' => $validated['order'] ?? 0,
            ];
            
            // Handle avatar upload
            if ($request->hasFile('customer_avatar')) {
                $data['customer_avatar'] = $request->file('customer_avatar')->store('reviews', 'public');
            }
            
            $review = Review::create($data);
            
            Alert::success('Berhasil!', "Review dari '{$review->customer_name}' berhasil ditambahkan!")
                ->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.reviews.index');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Validasi Gagal!', 'Mohon periksa kembali data yang Anda masukkan.')
                ->persistent(true);
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal menambahkan review. Silakan coba lagi.')
                ->persistent(true);
            return back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        return view('admin.reviews.show', compact('review'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Review $review)
    {
        return view('admin.reviews.edit', compact('review'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        try {
            $validated = $request->validate([
                'customer_name' => 'required|string|max:255',
                'customer_position' => 'nullable|string|max:255',
                'customer_avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
                'destination' => 'required|string|max:255',
                'content' => 'required|string|max:1000',
                'rating' => 'required|integer|min:1|max:5',
                'is_active' => 'boolean',
                'order' => 'nullable|integer|min:0',
            ]);
            
            $data = [
                'customer_name' => $validated['customer_name'],
                'customer_position' => $validated['customer_position'] ?? null,
                'destination' => $validated['destination'],
                'content' => $validated['content'],
                'rating' => $validated['rating'],
                'is_active' => $request->boolean('is_active'),
                'order' => $validated['order'] ?? 0,
            ];
            
            // Handle avatar upload
            if ($request->hasFile('customer_avatar')) {
                // Delete old avatar
                if ($review->customer_avatar) {
                    Storage::disk('public')->delete($review->customer_avatar);
                }
                $data['customer_avatar'] = $request->file('customer_avatar')->store('reviews', 'public');
            }
            
            $review->update($data);
            
            Alert::success('Berhasil Diperbarui!', "Review dari '{$review->customer_name}' berhasil diperbarui!")
                ->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.reviews.index');
            
        } catch (\Illuminate\Validation\ValidationException $e) {
            Alert::error('Validasi Gagal!', 'Mohon periksa kembali data yang Anda masukkan.')
                ->persistent(true);
            return back()->withErrors($e->errors())->withInput();
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal memperbarui review.')
                ->persistent(true);
            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        try {
            $customerName = $review->customer_name;
            
            // Delete associated avatar
            if ($review->customer_avatar) {
                Storage::disk('public')->delete($review->customer_avatar);
            }
            
            $review->delete();
            
            Alert::success('Berhasil Dihapus!', "Review dari '{$customerName}' berhasil dihapus!")
                ->persistent(true)->autoClose(5000);
            
            return redirect()->route('admin.reviews.index');
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal menghapus review.')
                ->persistent(true);
            return back();
        }
    }
    
    /**
     * Toggle active status of review
     */
    public function toggleActive(Review $review)
    {
        try {
            $review->is_active = !$review->is_active;
            $review->save();
            
            $status = $review->is_active ? 'diaktifkan' : 'dinonaktifkan';
            Alert::success('Status Berubah!', "Review dari '{$review->customer_name}' berhasil {$status}!")
                ->autoClose(4000);
            
            return back();
            
        } catch (\Exception $e) {
            Alert::error('Terjadi Kesalahan!', 'Gagal mengubah status review.')
                ->persistent(true);
            return back();
        }
    }
}
