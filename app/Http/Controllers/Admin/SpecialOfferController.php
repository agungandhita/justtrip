<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\SpecialOfferNotification;
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

        return view('admin.special-offers.index', compact('specialOffers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $layananList = Layanan::where('status', 'aktif')->get();
        return view('admin.special-offers.create', compact('layananList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'layanan_id' => 'required|exists:layanan,layanan_id',
            'title' => 'required|string|max:255|unique:special_offers,title',
            'description' => 'required|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive',
            'featured' => 'nullable|boolean',
            'terms_conditions' => 'nullable|string',
        ]);

        // Get layanan data
        $layanan = Layanan::findOrFail($request->layanan_id);
        
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        // Map form fields to database fields
        $data['valid_from'] = $request->start_date;
        $data['valid_until'] = $request->end_date;
        $data['is_active'] = $request->status === 'active';
        $data['is_featured'] = $request->has('featured') ? true : false;
        
        // Calculate prices based on layanan and discount percentage
        $data['original_price'] = $layanan->harga_mulai;
        $discountAmount = ($layanan->harga_mulai * $request->discount_percentage) / 100;
        $data['discounted_price'] = $layanan->harga_mulai - $discountAmount;

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['main_image'] = $request->file('image')->store('special-offers', 'public');
        }
        
        // Remove form-specific fields that don't exist in database
        unset($data['start_date'], $data['end_date'], $data['status'], $data['featured'], $data['image']);

        $specialOffer = SpecialOffer::create($data);
        // Kirim email ke semua subscribe user yang belum unsubscribe
        $subscribers = \App\Models\SubscribeUser::subscribed()->get();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->queue(new SpecialOfferNotification($specialOffer));
        }

        Alert::success('Success', 'Special offer created successfully! Email notifikasi dikirim ke subscriber.');
        return redirect()->route('admin.special-offers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialOffer $specialOffer)
    {
        // Load galleries for standalone offers
        $specialOffer->load(['galleries' => function($query) {
            $query->orderedBySort();
        }]);
        
        return view('admin.special-offers.show', compact('specialOffer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SpecialOffer $specialOffer)
    {
        // Load the special offer with its related layanan
        $specialOffer->load('layanan');
        $layananList = Layanan::where('status', 'aktif')
                             ->orderBy('nama_layanan')
                             ->get();
        return view('admin.special-offers.edit', compact('specialOffer', 'layananList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SpecialOffer $specialOffer)
    {
        $rules = [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive',
            'featured' => 'nullable|boolean',
            'terms_conditions' => 'nullable|string',
        ];

        if ($specialOffer->layanan_id) {
            $rules['layanan_id'] = 'required|exists:layanan,layanan_id';
            $rules['discount_percentage'] = 'required|numeric|min:0|max:100';
            $rules['image'] = 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240';
        } else {
            $rules['original_price'] = 'required|numeric|min:0';
            $rules['discounted_price'] = 'required|numeric|min:0|lt:original_price';
            $rules['gallery_images.*'] = 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120';
        }

        $request->validate($rules);

        $data = [
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'valid_from' => $request->start_date,
            'valid_until' => $request->end_date,
            'is_active' => $request->status === 'active',
            'is_featured' => $request->has('featured'),
            'terms_conditions' => $request->terms_conditions,
        ];

        if ($specialOffer->layanan_id) {
            $layanan = Layanan::findOrFail($request->layanan_id);
            $data['layanan_id'] = $request->layanan_id;
            $data['discount_percentage'] = $request->discount_percentage;
            $data['original_price'] = $layanan->harga_mulai;
            $discountAmount = ($layanan->harga_mulai * $request->discount_percentage) / 100;
            $data['discounted_price'] = $layanan->harga_mulai - $discountAmount;

            if ($request->hasFile('image')) {
                if ($specialOffer->main_image) {
                    Storage::disk('public')->delete($specialOffer->main_image);
                }
                $data['main_image'] = $request->file('image')->store('special-offers', 'public');
            }
        } else {
            $data['original_price'] = $request->original_price;
            $data['discounted_price'] = $request->discounted_price;
            $data['discount_percentage'] = (($request->original_price - $request->discounted_price) / $request->original_price) * 100;

            if ($request->hasFile('gallery_images')) {
                // Delete old galleries
                foreach ($specialOffer->galleries as $gallery) {
                    Storage::disk('public')->delete($gallery->image_path);
                    $gallery->delete();
                }

                $galleryImages = $request->file('gallery_images');
                foreach ($galleryImages as $index => $image) {
                    $imagePath = $image->store('special-offers/gallery', 'public');
                    $specialOffer->galleries()->create([
                        'image_path' => $imagePath,
                        'title' => $request->title . ' - Gambar ' . ($index + 1),
                        'is_main' => $index === 0,
                        'sort_order' => $index + 1
                    ]);
                }

                $firstGalleryImage = $specialOffer->galleries()->where('is_main', true)->first();
                if ($firstGalleryImage) {
                    $data['main_image'] = $firstGalleryImage->image_path;
                }
            }
        }

        $specialOffer->update($data);

        Alert::success('Success', 'Special offer updated successfully!');
        return redirect()->route('admin.special-offers.index');
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
        return redirect()->route('admin.special-offers.index');
    }

    /**
     * Show the form for creating a standalone special offer.
     */
    public function createStandalone()
    {
        return view('admin.special-offers.create-standalone');
    }

    /**
     * Store a newly created standalone special offer.
     */
    public function storeStandalone(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'original_price' => 'required|numeric|min:0',
            'discounted_price' => 'required|numeric|min:0|lt:original_price',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive',
            'featured' => 'nullable|boolean',
            'terms_conditions' => 'nullable|string'
        ]);
        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        
        // Map form fields to database fields
        $data['valid_from'] = $request->start_date;
        $data['valid_until'] = $request->end_date;
        $data['is_active'] = $request->status === 'active';
        $data['is_featured'] = $request->has('featured') ? true : false;
        
        // Calculate discount percentage for standalone offers
        $data['discount_percentage'] = (($request->original_price - $request->discounted_price) / $request->original_price) * 100;
        
        // Set layanan_id to null for standalone offers
        $data['layanan_id'] = null;
        
        // Remove form-specific fields that don't exist in database
        unset($data['start_date'], $data['end_date'], $data['status'], $data['featured'], $data['gallery_images']);

        // Create the special offer
        $specialOffer = SpecialOffer::create($data);

        // Handle gallery images upload
        if ($request->hasFile('gallery_images')) {
            $galleryImages = $request->file('gallery_images');
            
            foreach ($galleryImages as $index => $image) {
                // Store the image
                $imagePath = $image->store('special-offers/gallery', 'public');
                
                // Create gallery record
                $specialOffer->galleries()->create([
                    'image_path' => $imagePath,
                    'title' => $request->title . ' - Gambar ' . ($index + 1),
                    'description' => 'Gambar galeri untuk ' . $request->title,
                    'alt_text' => $request->title . ' - Gambar ' . ($index + 1),
                    'is_main' => $index === 0, // First image is main image
                    'sort_order' => $index + 1
                ]);
            }
            
            // Set main_image from first gallery image if exists
            $firstGalleryImage = $specialOffer->galleries()->where('is_main', true)->first();
            if ($firstGalleryImage) {
                $specialOffer->update(['main_image' => $firstGalleryImage->image_path]);
            }
        }

        // Kirim email ke semua subscribe user yang belum unsubscribe
        $subscribers = \App\Models\SubscribeUser::subscribed()->get();
        foreach ($subscribers as $subscriber) {
            Mail::to($subscriber->email)->queue(new SpecialOfferNotification($specialOffer));
        }

        Alert::success('Success', 'Standalone special offer created successfully! Email notifikasi dikirim ke subscriber.');
        return redirect()->route('admin.special-offers.index');
    }
}
