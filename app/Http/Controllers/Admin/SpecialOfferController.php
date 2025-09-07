<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SpecialOffer;
use App\Models\Layanan;
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive',
            'featured' => 'nullable|boolean',
            'terms_conditions' => 'nullable|string',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160'
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

        SpecialOffer::create($data);

        Alert::success('Success', 'Special offer created successfully!');
        return redirect()->route('admin.special-offers.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(SpecialOffer $specialOffer)
    {
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
        $request->validate([
            'layanan_id' => 'required|exists:layanan,layanan_id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:10240',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'status' => 'required|in:active,inactive',
            'featured' => 'nullable|boolean',
            'terms_conditions' => 'nullable|string',
            'meta_title' => 'nullable|string|max:60',
            'meta_description' => 'nullable|string|max:160'
        ]);

        // Get layanan data
        $layanan = Layanan::findOrFail($request->layanan_id);
        
        // Prepare data for update
        $data = [
            'layanan_id' => $request->layanan_id,
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'description' => $request->description,
            'discount_percentage' => $request->discount_percentage,
            'valid_from' => $request->start_date,
            'valid_until' => $request->end_date,
            'is_active' => $request->status === 'active',
            'is_featured' => $request->has('featured'),
            'terms_conditions' => $request->terms_conditions,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description
        ];

        // Calculate prices based on layanan and discount percentage
        $data['original_price'] = $layanan->harga_mulai;
        $discountAmount = ($layanan->harga_mulai * $request->discount_percentage) / 100;
        $data['discounted_price'] = $layanan->harga_mulai - $discountAmount;

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image
            if ($specialOffer->main_image) {
                Storage::disk('public')->delete($specialOffer->main_image);
            }
            $data['main_image'] = $request->file('image')->store('special-offers', 'public');
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
}
