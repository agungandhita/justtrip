<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Layanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class LayananController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Layanan::query();

        // Search functionality
        if ($request->filled('search')) {
            $query->search($request->search);
        }

        // Filter by jenis layanan
        if ($request->filled('jenis_layanan')) {
            $query->jenisLayanan($request->jenis_layanan);
        }

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $layanan = $query->latest()->paginate(10);
        $jenisLayananOptions = Layanan::getJenisLayananOptions();

        return view('admin.Layanan.index', compact('layanan', 'jenisLayananOptions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenisLayananOptions = Layanan::getJenisLayananOptions();
        return view('admin.Layanan.create', compact('jenisLayananOptions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'jenis_layanan' => 'required|in:' . implode(',', array_keys(Layanan::getJenisLayananOptions())),
            'deskripsi' => 'nullable|string',
            'harga_mulai' => 'required|numeric|min:0',
            'durasi_hari' => 'required|integer|min:1',
            'maks_orang' => 'required|integer|min:1',
            'lokasi_tujuan' => 'required|string|max:255',
            'fasilitas' => 'nullable|array',
            'gambar_destinasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        if ($request->has('fasilitas')) {
            $data['fasilitas'] = array_filter($request->fasilitas);
        }

        // Handle gambar destinasi upload
        if ($request->hasFile('gambar_destinasi')) {
            $gambarPaths = [];
            $files = $request->file('gambar_destinasi');

            // Validasi maksimal 5 gambar
            if (count($files) > 5) {
                Alert::error('Error', 'Maksimal 5 gambar destinasi yang diizinkan!');
                return redirect()->back()->withInput();
            }

            foreach ($files as $file) {
                $path = $file->store('layanan/destinasi', 'public');
                $gambarPaths[] = $path;
            }
            $data['gambar_destinasi'] = $gambarPaths;
        }

        Layanan::create($data);

        Alert::success('Success', 'Layanan berhasil ditambahkan!');
        return redirect()->route('admin.layanan.index');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $layanan = Layanan::findOrFail($id);
        return view('admin.Layanan.show', compact('layanan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $layanan = Layanan::findOrFail($id);
        $jenisLayananOptions = Layanan::getJenisLayananOptions();
        $existingSizes = collect(); // Initialize as empty collection since there's no size relationship
        return view('admin.Layanan.edit', compact('layanan', 'jenisLayananOptions', 'existingSizes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'nama_layanan' => 'required|string|max:255',
            'jenis_layanan' => 'required|in:' . implode(',', array_keys(Layanan::getJenisLayananOptions())),
            'deskripsi' => 'nullable|string',
            'harga_mulai' => 'required|numeric|min:0',
            'durasi_hari' => 'required|integer|min:1',
            'maks_orang' => 'required|integer|min:1',
            'lokasi_tujuan' => 'required|string|max:255',
            'fasilitas' => 'nullable|array',
            'gambar_destinasi.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'existing_images' => 'nullable|array',
            'existing_images.*' => 'nullable|string',
            'status' => 'required|in:aktif,nonaktif',
            'catatan' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->all();
        if ($request->has('fasilitas')) {
            $data['fasilitas'] = array_filter($request->fasilitas);
        }

        // Handle gambar destinasi
        $finalGambarPaths = [];

        // Get existing images that are kept (not removed)
        if ($request->has('existing_images') && is_array($request->existing_images)) {
            $finalGambarPaths = array_filter($request->existing_images);
        }

        // Handle new uploaded images
        if ($request->hasFile('gambar_destinasi')) {
            $files = $request->file('gambar_destinasi');

            // Validasi maksimal 5 gambar total (existing + new)
            $totalImages = count($finalGambarPaths) + count($files);
            if ($totalImages > 5) {
                Alert::error('Error', 'Maksimal 5 gambar destinasi yang diizinkan!');
                return redirect()->back()->withInput();
            }

            foreach ($files as $file) {
                $path = $file->store('layanan/destinasi', 'public');
                $finalGambarPaths[] = $path;
            }
        }

        // Delete images that are no longer used
        if ($layanan->gambar_destinasi) {
            foreach ($layanan->gambar_destinasi as $oldImage) {
                if (!in_array($oldImage, $finalGambarPaths)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }

        $data['gambar_destinasi'] = $finalGambarPaths;

        $layanan->update($data);

        Alert::success('Success', 'Layanan berhasil diperbarui!');
        return redirect()->route('admin.layanan.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $layanan = Layanan::findOrFail($id);

        // Delete associated images
        if ($layanan->gambar_destinasi) {
            foreach ($layanan->gambar_destinasi as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        $layanan->delete();

        Alert::success('Success', 'Layanan berhasil dihapus!');
        return redirect()->route('admin.layanan.index');
    }

    /**
     * Toggle status layanan
     */
    public function toggleStatus($id)
    {
        $layanan = Layanan::findOrFail($id);
        $layanan->status = $layanan->status === 'aktif' ? 'nonaktif' : 'aktif';
        $layanan->save();

        return redirect()->route('admin.layanan.index')
            ->with('success', 'Status layanan berhasil diubah!');
    }
}
