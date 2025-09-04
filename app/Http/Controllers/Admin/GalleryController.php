<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Gallery::query();

        // Search functionality
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where('title', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('destination', 'like', "%{$search}%");
        }

        // Filter by destination
        if ($request->filled('destination')) {
            $query->byDestination($request->destination);
        }

        // Filter by category
        if ($request->filled('category')) {
            $query->byCategory($request->category);
        }

        // Filter by visibility
        if ($request->filled('visibility')) {
            if ($request->visibility === 'public') {
                $query->public();
            } elseif ($request->visibility === 'private') {
                $query->where('is_public', false);
            }
        }

        // Filter by featured
        if ($request->filled('featured')) {
            $query->featured();
        }

        $galleries = $query->latest()->paginate(12);

        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.gallery.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'destination' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'images' => 'nullable|array|max:20', // Batasi maksimal 20 foto, nullable untuk update
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120', // Maksimal 5MB per foto
            'trip_date' => 'required|date',
            'participants_count' => 'nullable|integer|min:1',
            'trip_highlights' => 'nullable|string',
            'tags' => 'nullable|string',
            'alt_text' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
            'featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:255',
            'photographer' => 'nullable|string|max:255',
            'date_taken' => 'nullable|date',
            'is_public' => 'nullable|boolean'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['photographer'] = $request->photographer ?: (Auth::user()->name ?? 'Admin');

        // Set default values for boolean fields
        $data['featured'] = $request->boolean('is_featured') || $request->boolean('featured');
        $data['is_public'] = $request->has('is_public') ? $request->boolean('is_public') : true;
        $data['status'] = $request->status ?: 'active';
        $data['sort_order'] = $request->sort_order ?: 0;

        // Process tags
        if ($request->filled('tags')) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        }

        // Handle image uploads
        $imagePaths = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $image) {
                if ($image && $image->isValid()) {
                    try {
                        $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
                        $path = $image->storeAs('galleries', $filename, 'public');
                        $imagePaths[] = $path;
                    } catch (\Exception $e) {
                        Log::error('Image upload failed', ['error' => $e->getMessage(), 'file_index' => $index]);
                        return back()->withErrors(['images.' . $index => 'Failed to upload image: ' . $e->getMessage()])->withInput();
                    }
                } else {
                    return back()->withErrors(['images.' . $index => 'Invalid image file'])->withInput();
                }
            }
        }

        if (empty($imagePaths)) {
            Alert::error('Error', 'No images were uploaded successfully.');
            return redirect()->back()->withInput();
        }

        $data['images'] = $imagePaths;

        // Set main image (first uploaded image)
        if (!empty($imagePaths)) {
            $data['main_image'] = $imagePaths[0];
        }

        Gallery::create($data);

        Alert::success('Success', 'Gallery berhasil dibuat dengan ' . count($data['images']) . ' foto!');
        return redirect()->route('admin.galleries.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Gallery $gallery)
    {
        // Increment views count
        $gallery->increment('views');

        // Get previous and next galleries for navigation
        $previousImage = Gallery::where('id', '<', $gallery->id)
            ->orderBy('id', 'desc')
            ->first();

        $nextImage = Gallery::where('id', '>', $gallery->id)
            ->orderBy('id', 'asc')
            ->first();

        return view('admin.gallery.show', compact('gallery', 'previousImage', 'nextImage'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Gallery $gallery)
    {
        return view('admin.gallery.edit', compact('gallery'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'destination' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'images' => 'required|array|min:1|max:20', // Batasi maksimal 20 foto
            'images.*' => 'required|image|mimes:jpeg,png,jpg,webp|max:5120', // Maksimal 5MB per foto
            'trip_date' => 'required|date',
            'participants_count' => 'nullable|integer|min:1',
            'trip_highlights' => 'nullable|string',
            'tags' => 'nullable|string',
            'alt_text' => 'nullable|string|max:255',
            'caption' => 'nullable|string|max:255',
            'status' => 'nullable|string|in:active,inactive',
            'featured' => 'nullable|boolean',
            'sort_order' => 'nullable|integer|min:0',
            'location' => 'nullable|string|max:255',
            'photographer' => 'nullable|string|max:255',
            'date_taken' => 'nullable|date',
            'is_public' => 'nullable|boolean',
            'keep_existing_images' => 'boolean' // Option to keep existing images
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->title);
        $data['photographer'] = $request->photographer ?: $gallery->photographer;

        // Set default values for boolean fields
        $data['featured'] = $request->boolean('is_featured') || $request->boolean('featured');
        $data['is_public'] = $request->has('is_public') ? $request->boolean('is_public') : $gallery->is_public;
        $data['status'] = $request->status ?: $gallery->status ?: 'active';
        $data['sort_order'] = $request->sort_order ?: $gallery->sort_order ?: 0;

        // Process tags
        if ($request->filled('tags')) {
            $data['tags'] = array_map('trim', explode(',', $request->tags));
        }

        // Handle images upload
        $oldImages = $gallery->images ?? [];
        $oldMainImage = $gallery->main_image;
        
        if ($request->hasFile('images')) {
            // Only delete old images if not keeping them
            if (!$request->boolean('keep_existing_images')) {
                $this->deleteImages($oldImages);
                if ($oldMainImage) {
                    Storage::disk('public')->delete($oldMainImage);
                }
                $images = [];
                $mainImage = null;
            } else {
                // Keep existing images and add new ones
                $images = $oldImages;
                $mainImage = $oldMainImage;
            }

            // Process new images
            foreach ($request->file('images') as $index => $imageFile) {
                if ($imageFile && $imageFile->isValid()) {
                    try {
                        $filename = time() . '_' . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                        $path = $imageFile->storeAs('galleries', $filename, 'public');
                        $images[] = $path;

                        // Set first new image as main image if no existing main image
                        if (!$mainImage && $index === 0) {
                            $mainImage = $path;
                        }
                    } catch (\Exception $e) {
                        Log::error('Image upload failed in update', ['error' => $e->getMessage(), 'file_index' => $index]);
                        Alert::error('Error', 'Failed to upload some images: ' . $e->getMessage());
                        return redirect()->back()->withInput();
                    }
                }
            }

            $data['images'] = $images;
            $data['main_image'] = $mainImage;
        } else {
            // No new images uploaded, handle based on keep_existing_images option
            if (!$request->boolean('keep_existing_images')) {
                // User wants to remove all images
                $this->deleteImages($oldImages);
                if ($oldMainImage) {
                    Storage::disk('public')->delete($oldMainImage);
                }
                $data['images'] = [];
                $data['main_image'] = null;
            } else {
                // Keep existing images as they are
                $data['images'] = $oldImages;
                $data['main_image'] = $oldMainImage;
            }
        }

        $gallery->update($data);

        Alert::success('Success', 'Gallery berhasil diupdate dengan ' . count($gallery->images) . ' foto!');
        return redirect()->route('admin.galleries.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Gallery $gallery)
    {
        // Delete associated images
        if ($gallery->images) {
            foreach ($gallery->images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $gallery->delete();

        Alert::success('Success', 'Gallery deleted successfully!');
        return redirect()->route('admin.galleries.index');
    }

    /**
     * Toggle like for a gallery item
     */
    public function toggleLike(Gallery $gallery)
    {
        $gallery->increment('likes');

        return response()->json([
            'success' => true,
            'likes' => $gallery->likes
        ]);
    }

    /**
     * Delete individual image from gallery
     */
    public function deleteImage(Gallery $gallery, Request $request)
    {
        $request->validate([
            'image_path' => 'required|string'
        ]);

        $imagePath = $request->image_path;
        $images = $gallery->images ?? [];

        // Check if image exists in gallery
        if (!in_array($imagePath, $images)) {
            return response()->json([
                'success' => false,
                'message' => 'Image tidak ditemukan dalam gallery'
            ], 404);
        }

        // Remove image from array
        $updatedImages = array_values(array_filter($images, function($img) use ($imagePath) {
            return $img !== $imagePath;
        }));

        // Delete physical file
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        // Update main_image if deleted image was the main image
        $mainImage = $gallery->main_image;
        if ($mainImage === $imagePath) {
            $mainImage = !empty($updatedImages) ? $updatedImages[0] : null;
        }

        // Update gallery
        $gallery->update([
            'images' => $updatedImages,
            'main_image' => $mainImage
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Image berhasil dihapus',
            'remaining_images' => count($updatedImages)
        ]);
    }

    /**
     * Add new images to existing gallery
     */
    public function addImages(Gallery $gallery, Request $request)
    {
        $request->validate([
            'images' => 'required|array|min:1|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,webp|max:5120'
        ]);

        $existingImages = $gallery->images ?? [];
        $newImages = [];

        // Check total images limit
        if (count($existingImages) + count($request->file('images')) > 20) {
            return response()->json([
                'success' => false,
                'message' => 'Maksimal 20 foto per gallery. Saat ini ada ' . count($existingImages) . ' foto.'
            ], 422);
        }

        // Process new images
        foreach ($request->file('images') as $index => $imageFile) {
            try {
                $filename = time() . '_' . (count($existingImages) + $index) . '_' . Str::random(10) . '.jpg';
                $path = 'galleries/' . $filename;

                // Compress image
                $compressedImage = $this->compressImage($imageFile->getPathname(), 80);

                // Store compressed image
                Storage::disk('public')->put($path, $compressedImage);
                $newImages[] = $path;
            } catch (\Exception $e) {
                // If compression fails, store original
                $newImages[] = $imageFile->store('galleries', 'public');
            }
        }

        // Merge with existing images
        $allImages = array_merge($existingImages, $newImages);

        // Set main image if none exists
        $mainImage = $gallery->main_image ?: ($allImages[0] ?? null);

        // Update gallery
        $gallery->update([
            'images' => $allImages,
            'main_image' => $mainImage
        ]);

        return response()->json([
            'success' => true,
            'message' => count($newImages) . ' foto berhasil ditambahkan',
            'total_images' => count($allImages),
            'new_images' => $newImages
        ]);
    }

    /**
     * Cleanup orphaned files that are not referenced in any gallery
     */
    public function cleanupOrphanedFiles()
    {
        try {
            // Get all image files in galleries directory
            $allFiles = Storage::disk('public')->files('galleries');

            // Get all images referenced in galleries
            $referencedImages = Gallery::whereNotNull('images')
                ->get()
                ->pluck('images')
                ->flatten()
                ->toArray();

            // Get all main images
            $mainImages = Gallery::whereNotNull('main_image')
                ->pluck('main_image')
                ->toArray();

            // Combine all referenced images
            $allReferencedImages = array_unique(array_merge($referencedImages, $mainImages));

            // Find orphaned files
            $orphanedFiles = array_diff($allFiles, $allReferencedImages);

            $deletedCount = 0;
            $deletedSize = 0;

            foreach ($orphanedFiles as $file) {
                if (Storage::disk('public')->exists($file)) {
                    $fileSize = Storage::disk('public')->size($file);
                    Storage::disk('public')->delete($file);
                    $deletedCount++;
                    $deletedSize += $fileSize;
                }
            }

            $deletedSizeMB = round($deletedSize / 1024 / 1024, 2);

            return response()->json([
                'success' => true,
                'message' => "Cleanup selesai! {$deletedCount} file orphaned dihapus, menghemat {$deletedSizeMB} MB space.",
                'deleted_files' => $deletedCount,
                'freed_space_mb' => $deletedSizeMB
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error saat cleanup: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Get storage statistics
     */
    public function getStorageStats()
    {
        try {
            $allFiles = Storage::disk('public')->files('galleries');
            $totalFiles = count($allFiles);
            $totalSize = 0;

            foreach ($allFiles as $file) {
                if (Storage::disk('public')->exists($file)) {
                    $totalSize += Storage::disk('public')->size($file);
                }
            }

            $totalSizeMB = round($totalSize / 1024 / 1024, 2);
            $totalGalleries = Gallery::count();
            $totalImages = Gallery::whereNotNull('images')->get()->sum(function($gallery) {
                return count($gallery->images ?? []);
            });

            return response()->json([
                'success' => true,
                'stats' => [
                    'total_files' => $totalFiles,
                    'total_size_mb' => $totalSizeMB,
                    'total_galleries' => $totalGalleries,
                    'total_images' => $totalImages,
                    'avg_images_per_gallery' => $totalGalleries > 0 ? round($totalImages / $totalGalleries, 1) : 0
                ]
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error getting stats: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Delete multiple images from storage
     */
    private function deleteImages($images)
    {
        if (!$images || !is_array($images)) {
            return;
        }

        foreach ($images as $image) {
            if ($image && Storage::disk('public')->exists($image)) {
                Storage::disk('public')->delete($image);
            }
        }
    }

    /**
     * Compress image using GD library
     */
    private function compressImage($source, $quality = 80)
    {
        $info = getimagesize($source);

        if ($info['mime'] == 'image/jpeg') {
            $image = imagecreatefromjpeg($source);
        } elseif ($info['mime'] == 'image/gif') {
            $image = imagecreatefromgif($source);
        } elseif ($info['mime'] == 'image/png') {
            $image = imagecreatefrompng($source);
        } else {
            return file_get_contents($source);
        }

        // Get original dimensions
        $width = imagesx($image);
        $height = imagesy($image);

        // Calculate new dimensions (max 1200px width)
        $maxWidth = 1200;
        if ($width > $maxWidth) {
            $newWidth = $maxWidth;
            $newHeight = ($height * $maxWidth) / $width;
        } else {
            $newWidth = $width;
            $newHeight = $height;
        }

        // Create new image with new dimensions
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Preserve transparency for PNG
        if ($info['mime'] == 'image/png') {
            imagealphablending($newImage, false);
            imagesavealpha($newImage, true);
        }

        // Resize image
        imagecopyresampled($newImage, $image, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);

        // Start output buffering
        ob_start();

        // Output compressed image
        imagejpeg($newImage, null, $quality);
        $compressedData = ob_get_contents();

        // Clean up
        ob_end_clean();
        imagedestroy($image);
        imagedestroy($newImage);

        return $compressedData;
    }
}
