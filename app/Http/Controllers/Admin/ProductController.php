<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Product::query();
        
        // Filter by type if provided
        if ($request->filled('type')) {
            $query->where('type', $request->type);
        }
        
        // Search functionality
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('destination', 'like', '%' . $request->search . '%');
        }
        
        $products = $query->latest()->paginate(10);
        return view('admin.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:international,domestic',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'duration' => 'required|string|max:100',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'itinerary' => 'nullable|array',
            'includes' => 'nullable|array',
            'excludes' => 'nullable|array',
            'terms_conditions' => 'nullable|string',
            'max_participants' => 'nullable|integer|min:1',
            'min_participants' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'difficulty_level' => 'nullable|in:easy,moderate,challenging,extreme',
            'rating' => 'nullable|numeric|min:0|max:5',
            'total_reviews' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        // Generate slug
        $validated['slug'] = Str::slug($validated['name']);

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('products/main', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('products/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryImages;
        }

        Product::create($validated);

        Alert::success('Success', 'Product created successfully!');
        return redirect()->route('admin.products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return view('admin.products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'type' => 'required|in:international,domestic',
            'destination' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'nullable|numeric|min:0',
            'duration' => 'required|string|max:100',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'itinerary' => 'nullable|array',
            'includes' => 'nullable|array',
            'excludes' => 'nullable|array',
            'terms_conditions' => 'nullable|string',
            'max_participants' => 'nullable|integer|min:1',
            'min_participants' => 'nullable|integer|min:1',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'difficulty_level' => 'nullable|in:easy,moderate,challenging,extreme',
            'rating' => 'nullable|numeric|min:0|max:5',
            'total_reviews' => 'nullable|integer|min:0',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        // Update slug if name changed
        if ($product->name !== $validated['name']) {
            $validated['slug'] = Str::slug($validated['name']);
        }

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            // Delete old image if exists
            if ($product->main_image) {
                Storage::disk('public')->delete($product->main_image);
            }
            $validated['main_image'] = $request->file('main_image')->store('products/main', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images if exists
            if ($product->gallery_images) {
                foreach ($product->gallery_images as $image) {
                    Storage::disk('public')->delete($image);
                }
            }
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('products/gallery', 'public');
            }
            $validated['gallery_images'] = $galleryImages;
        }

        $product->update($validated);

        Alert::success('Success', 'Product updated successfully!');
        return redirect()->route('admin.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Delete associated images
        if ($product->main_image) {
            Storage::disk('public')->delete($product->main_image);
        }
        if ($product->gallery_images) {
            foreach ($product->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $product->delete();

        Alert::success('Success', 'Product deleted successfully!');
        return redirect()->route('admin.products.index');
    }
}
