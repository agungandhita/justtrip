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
            'information_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'catatan' => 'nullable|string',
            // New fields
            'start_time' => 'nullable|string|max:50',
            'finish_time' => 'nullable|string|max:50',
            'itinerary_note' => 'nullable|string',
            'itinerary' => 'nullable|array',
            'include_services' => 'nullable|array',
            'exclude_services' => 'nullable|array',
            'destinations' => 'nullable|array',
            'pricing_types' => 'nullable|array',
            'pricing_prices' => 'nullable|array',
            'terms_registration' => 'nullable|array',
            'terms_cancelation' => 'nullable|array',
            'terms_not_responsible' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'nama_layanan', 'jenis_layanan', 'deskripsi', 'harga_mulai',
            'durasi_hari', 'maks_orang', 'lokasi_tujuan', 'status', 'catatan',
            'start_time', 'finish_time', 'itinerary_note'
        ]);

        // Handle fasilitas (legacy)
        if ($request->has('fasilitas')) {
            $data['fasilitas'] = array_values(array_filter($request->fasilitas));
        }

        // Handle gambar destinasi upload
        if ($request->hasFile('gambar_destinasi')) {
            $gambarPaths = [];
            $files = $request->file('gambar_destinasi');

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

        // Handle information image upload
        if ($request->hasFile('information_image')) {
            $data['information_image'] = $request->file('information_image')->store('layanan/info', 'public');
        }

        // Handle itinerary
        if ($request->has('itinerary')) {
            $itinerary = [];
            foreach ($request->itinerary as $dayData) {
                if (isset($dayData['day']) && isset($dayData['activities'])) {
                    $activities = array_values(array_filter($dayData['activities']));
                    if (!empty($activities)) {
                        $itinerary[] = [
                            'day' => (int) $dayData['day'],
                            'activities' => $activities
                        ];
                    }
                }
            }
            $data['itinerary'] = $itinerary;
        }

        // Handle include services
        if ($request->has('include_services')) {
            $data['include_services'] = array_values(array_filter($request->include_services));
        }

        // Handle exclude services
        if ($request->has('exclude_services')) {
            $data['exclude_services'] = array_values(array_filter($request->exclude_services));
        }

        // Handle destinations
        if ($request->has('destinations')) {
            $data['destinations'] = array_values(array_filter($request->destinations));
        }

        // Handle pricing options
        if ($request->has('pricing_types') && $request->has('pricing_prices')) {
            $pricingOptions = [];
            foreach ($request->pricing_types as $index => $type) {
                if (!empty($type) && isset($request->pricing_prices[$index])) {
                    $pricingOptions[] = [
                        'type' => $type,
                        'price' => (float) $request->pricing_prices[$index]
                    ];
                }
            }
            $data['pricing_options'] = $pricingOptions;
        }

        // Handle terms & conditions
        $termsConditions = [];
        if ($request->has('terms_registration')) {
            $termsConditions['registration_payment'] = array_values(array_filter($request->terms_registration));
        }
        if ($request->has('terms_cancelation')) {
            $termsConditions['cancelation'] = array_values(array_filter($request->terms_cancelation));
        }
        if ($request->has('terms_not_responsible')) {
            $termsConditions['not_responsible_for'] = array_values(array_filter($request->terms_not_responsible));
        }
        if (!empty($termsConditions)) {
            $data['terms_conditions'] = $termsConditions;
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
            'information_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:aktif,nonaktif',
            'catatan' => 'nullable|string',
            'start_time' => 'nullable|string|max:50',
            'finish_time' => 'nullable|string|max:50',
            'itinerary_note' => 'nullable|string',
            'itinerary' => 'nullable|array',
            'include_services' => 'nullable|array',
            'exclude_services' => 'nullable|array',
            'destinations' => 'nullable|array',
            'pricing_types' => 'nullable|array',
            'pricing_prices' => 'nullable|array',
            'terms_registration' => 'nullable|array',
            'terms_cancelation' => 'nullable|array',
            'terms_not_responsible' => 'nullable|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $data = $request->only([
            'nama_layanan', 'jenis_layanan', 'deskripsi', 'harga_mulai',
            'durasi_hari', 'maks_orang', 'lokasi_tujuan', 'status', 'catatan',
            'start_time', 'finish_time', 'itinerary_note'
        ]);

        if ($request->has('fasilitas')) {
            $data['fasilitas'] = array_values(array_filter($request->fasilitas));
        }

        // Handle gambar destinasi
        $finalGambarPaths = [];
        if ($request->has('existing_images') && is_array($request->existing_images)) {
            $finalGambarPaths = array_filter($request->existing_images);
        }

        if ($request->hasFile('gambar_destinasi')) {
            $files = $request->file('gambar_destinasi');
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

        if ($layanan->gambar_destinasi) {
            foreach ($layanan->gambar_destinasi as $oldImage) {
                if (!in_array($oldImage, $finalGambarPaths)) {
                    Storage::disk('public')->delete($oldImage);
                }
            }
        }
        $data['gambar_destinasi'] = $finalGambarPaths;

        // Handle information image
        if ($request->hasFile('information_image')) {
            if ($layanan->information_image) {
                Storage::disk('public')->delete($layanan->information_image);
            }
            $data['information_image'] = $request->file('information_image')->store('layanan/info', 'public');
        }

        // Handle itinerary
        if ($request->has('itinerary')) {
            $itinerary = [];
            foreach ($request->itinerary as $dayData) {
                if (isset($dayData['day']) && isset($dayData['activities'])) {
                    $activities = array_values(array_filter($dayData['activities']));
                    if (!empty($activities)) {
                        $itinerary[] = [
                            'day' => (int) $dayData['day'],
                            'activities' => $activities
                        ];
                    }
                }
            }
            $data['itinerary'] = $itinerary;
        }

        // Handle services
        $data['include_services'] = $request->has('include_services') ? array_values(array_filter($request->include_services)) : [];
        $data['exclude_services'] = $request->has('exclude_services') ? array_values(array_filter($request->exclude_services)) : [];
        $data['destinations'] = $request->has('destinations') ? array_values(array_filter($request->destinations)) : [];

        // Handle pricing options
        if ($request->has('pricing_types') && $request->has('pricing_prices')) {
            $pricingOptions = [];
            foreach ($request->pricing_types as $index => $type) {
                if (!empty($type) && isset($request->pricing_prices[$index])) {
                    $pricingOptions[] = [
                        'type' => $type,
                        'price' => (float) $request->pricing_prices[$index]
                    ];
                }
            }
            $data['pricing_options'] = $pricingOptions;
        }

        // Handle terms & conditions
        $termsConditions = [];
        if ($request->has('terms_registration')) {
            $termsConditions['registration_payment'] = array_values(array_filter($request->terms_registration));
        }
        if ($request->has('terms_cancelation')) {
            $termsConditions['cancelation'] = array_values(array_filter($request->terms_cancelation));
        }
        if ($request->has('terms_not_responsible')) {
            $termsConditions['not_responsible_for'] = array_values(array_filter($request->terms_not_responsible));
        }
        $data['terms_conditions'] = !empty($termsConditions) ? $termsConditions : null;

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
