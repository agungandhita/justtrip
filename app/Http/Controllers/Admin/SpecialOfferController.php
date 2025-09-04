<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class SpecialOfferController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = SpecialOffer::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%");
        }

        // Filter by status
        if ($request->filled('status')) {
            if ($request->status === 'active') {
                $query->active();
            } elseif ($request->status === 'inactive') {
                $query->where('is_active', false);
            }
        }

        // Filter by featured
        if ($request->filled('featured')) {
            $query->featured();
        }

        $specialOffers = $query->latest()->paginate(10);

        return view('admin.SpecialOffers.index', compact('specialOffers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.SpecialOffers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'discounted_price' => 'required|numeric|min:0|lt:original_price',
            'main_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'terms_conditions' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Calculate discount percentage
        $data['discount_percentage'] = round((($request->original_price - $request->discounted_price) / $request->original_price) * 100, 2);

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            $data['main_image'] = $request->file('main_image')->store('special-offers', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('special-offers/gallery', 'public');
            }
            $data['gallery_images'] = $galleryImages;
        }

        SpecialOffer::create($data);

        Alert::success('Success', 'Special offer created successfully!');
        return redirect()->route('admin.SpecialOffers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialOffer $specialOffer)
    {
        return view('admin.SpecialOffers.show', compact('specialOffer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialOffer $specialOffer)
    {
        return view('admin.SpecialOffers.edit', compact('specialOffer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecialOffer $specialOffer)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'discounted_price' => 'required|numeric|min:0|lt:original_price',
            'main_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after:valid_from',
            'terms_conditions' => 'nullable|string',
            'is_featured' => 'boolean',
            'is_active' => 'boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);

        // Calculate discount percentage
        $data['discount_percentage'] = round((($request->original_price - $request->discounted_price) / $request->original_price) * 100, 2);

        // Handle main image upload
        if ($request->hasFile('main_image')) {
            // Delete old image
            if ($specialOffer->main_image) {
                Storage::disk('public')->delete($specialOffer->main_image);
            }
            $data['main_image'] = $request->file('main_image')->store('special-offers', 'public');
        }

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            // Delete old gallery images
            if ($specialOffer->gallery_images) {
                foreach ($specialOffer->gallery_images as $oldImage) {
                    Storage::disk('public')->delete($oldImage);
                }
            }

            $galleryImages = [];
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('special-offers/gallery', 'public');
            }
            $data['gallery_images'] = $galleryImages;
        }

        $specialOffer->update($data);

        Alert::success('Success', 'Special offer updated successfully!');
        return redirect()->route('admin.SpecialOffers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SpecialOffer $specialOffer)
    {
        // Delete associated images
        if ($specialOffer->main_image) {
            Storage::disk('public')->delete($specialOffer->main_image);
        }

        if ($specialOffer->gallery_images) {
            foreach ($specialOffer->gallery_images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $specialOffer->delete();

        Alert::success('Success', 'Special offer deleted successfully!');
        return redirect()->route('admin.SpecialOffers.index');
    }
}
