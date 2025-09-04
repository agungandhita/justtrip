<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutUs = AboutUs::latest()->paginate(10);
        return view('admin.AboutUs.index', compact('aboutUs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.AboutUs..create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'story' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'happy_customers' => 'nullable|integer|min:0',
            'years_experience' => 'nullable|integer|min:0',
            'destinations' => 'nullable|integer|min:0',
            'satisfaction_rate' => 'nullable|integer|min:0|max:100',
            'values' => 'nullable|array',
            'team_members' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        // Handle file uploads
        if ($request->hasFile('hero_image')) {
            $validated['hero_image'] = $request->file('hero_image')->store('about-us/hero', 'public');
        }

        if ($request->hasFile('about_image')) {
            $validated['about_image'] = $request->file('about_image')->store('about-us/about', 'public');
        }

        AboutUs::create($validated);

        Alert::success('Success', 'About Us content created successfully!');
        return redirect()->route('admin.AboutUs..index');
    }

    /**
     * Display the specified resource.
     */
    public function show(AboutUs $aboutUs)
    {
        return view('admin.AboutUs..show', compact('aboutUs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(AboutUs $aboutUs)
    {
        return view('admin.AboutUs..edit', compact('aboutUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, AboutUs $aboutUs)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'story' => 'nullable|string',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'happy_customers' => 'nullable|integer|min:0',
            'years_experience' => 'nullable|integer|min:0',
            'destinations' => 'nullable|integer|min:0',
            'satisfaction_rate' => 'nullable|integer|min:0|max:100',
            'values' => 'nullable|array',
            'team_members' => 'nullable|array',
            'is_active' => 'boolean'
        ]);

        // Handle file uploads
        if ($request->hasFile('hero_image')) {
            // Delete old image if exists
            if ($aboutUs->hero_image) {
                Storage::disk('public')->delete($aboutUs->hero_image);
            }
            $validated['hero_image'] = $request->file('hero_image')->store('about-us/hero', 'public');
        }

        if ($request->hasFile('about_image')) {
            // Delete old image if exists
            if ($aboutUs->about_image) {
                Storage::disk('public')->delete($aboutUs->about_image);
            }
            $validated['about_image'] = $request->file('about_image')->store('about-us/about', 'public');
        }

        $aboutUs->update($validated);

        Alert::success('Success', 'About Us content updated successfully!');
        return redirect()->route('admin.AboutUs..index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(AboutUs $aboutUs)
    {
        // Delete associated images
        if ($aboutUs->hero_image) {
            Storage::disk('public')->delete($aboutUs->hero_image);
        }
        if ($aboutUs->about_image) {
            Storage::disk('public')->delete($aboutUs->about_image);
        }

        $aboutUs->delete();

        Alert::success('Success', 'About Us content deleted successfully!');
        return redirect()->route('admin.AboutUs..index');
    }
}
