<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LayananFormRequest;
use App\Http\Controllers\Controller;
use App\Models\Layanan;
use App\Services\LayananImportService;
use Illuminate\Http\Request;
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

        $stats = [
            'total' => Layanan::count(),
            'aktif' => Layanan::where('status', 'aktif')->count(),
            'nonaktif' => Layanan::where('status', 'nonaktif')->count(),
            'avg_price' => Layanan::avg('harga_mulai') ?? 0,
        ];

        return view('admin.Layanan.index', compact('layanan', 'jenisLayananOptions', 'stats'));
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
    public function store(LayananFormRequest $request)
    {
        $data = $request->validated();

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

        // Handle Edukasi special pricing
        if ($request->jenis_layanan === 'edu_trip') {
            $eduPricing = [];
            if ($request->filled('edu_harga_per_orang')) {
                $eduPricing[] = [
                    'type' => 'Per Orang',
                    'price' => (float) $request->edu_harga_per_orang
                ];
            }
            if ($request->filled('edu_harga_per_kelompok')) {
                $note = $request->filled('edu_catatan_kelompok') ? ' (' . trim($request->edu_catatan_kelompok) . ')' : '';
                $eduPricing[] = [
                    'type' => 'Per Kelompok' . $note,
                    'price' => (float) $request->edu_harga_per_kelompok
                ];
            }
            if (!empty($eduPricing)) {
                $existing = $data['pricing_options'] ?? [];
                $existingTypes = array_column($existing, 'type');
                foreach ($eduPricing as $ep) {
                    if (!in_array($ep['type'], $existingTypes)) {
                        $existing[] = $ep;
                    }
                }
                $data['pricing_options'] = $existing;
            }
        }

        // Handle Adventure trip metadata
        if ($request->jenis_layanan === 'adventure_trip') {
            $advNotes = [];
            if ($request->filled('adventure_difficulty')) {
                $advNotes[] = "Tingkat Kesulitan: " . $request->adventure_difficulty;
            }
            if ($request->filled('adventure_activity_type')) {
                $advNotes[] = "Aktivitas: " . $request->adventure_activity_type;
            }
            if ($request->filled('adventure_gear')) {
                $advNotes[] = "Perlengkapan Wajib: " . $request->adventure_gear;
            }
            if ($request->filled('adventure_meeting_point')) {
                $advNotes[] = "Titik Kumpul: " . $request->adventure_meeting_point;
            }
            if (!empty($advNotes)) {
                $advMeta = "[Adventure Trip Info] " . implode(" | ", $advNotes);
                $data['catatan'] = !empty($data['catatan']) ? $data['catatan'] . "\n\n" . $advMeta : $advMeta;
            }
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
    public function update(LayananFormRequest $request, $id)
    {
        $layanan = Layanan::findOrFail($id);

        $data = $request->validated();

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

        // Handle Edukasi special pricing
        if ($request->jenis_layanan === 'edu_trip') {
            $eduPricing = [];
            if ($request->filled('edu_harga_per_orang')) {
                $eduPricing[] = [
                    'type' => 'Per Orang',
                    'price' => (float) $request->edu_harga_per_orang
                ];
            }
            if ($request->filled('edu_harga_per_kelompok')) {
                $note = $request->filled('edu_catatan_kelompok') ? ' (' . trim($request->edu_catatan_kelompok) . ')' : '';
                $eduPricing[] = [
                    'type' => 'Per Kelompok' . $note,
                    'price' => (float) $request->edu_harga_per_kelompok
                ];
            }
            if (!empty($eduPricing)) {
                $existing = $data['pricing_options'] ?? [];
                $existingTypes = array_column($existing, 'type');
                foreach ($eduPricing as $ep) {
                    if (!in_array($ep['type'], $existingTypes)) {
                        $existing[] = $ep;
                    }
                }
                $data['pricing_options'] = $existing;
            }
        }

        // Handle Adventure trip metadata
        if ($request->jenis_layanan === 'adventure_trip') {
            $advNotes = [];
            if ($request->filled('adventure_difficulty')) {
                $advNotes[] = "Tingkat Kesulitan: " . $request->adventure_difficulty;
            }
            if ($request->filled('adventure_activity_type')) {
                $advNotes[] = "Aktivitas: " . $request->adventure_activity_type;
            }
            if ($request->filled('adventure_gear')) {
                $advNotes[] = "Perlengkapan Wajib: " . $request->adventure_gear;
            }
            if ($request->filled('adventure_meeting_point')) {
                $advNotes[] = "Titik Kumpul: " . $request->adventure_meeting_point;
            }
            if (!empty($advNotes)) {
                $advMeta = "[Adventure Trip Info] " . implode(" | ", $advNotes);
                $data['catatan'] = !empty($data['catatan']) ? $data['catatan'] . "\n\n" . $advMeta : $advMeta;
            }
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

    /**
     * Download Excel Import Template
     */
    public function downloadTemplate(LayananImportService $importService)
    {
        while (ob_get_level()) {
            ob_end_clean();
        }

        $tempPath = $importService->generateTemplate();
        $filename = 'template_import_layanan_justtrip_' . date('Ymd_His') . '.xlsx';

        return response()->download($tempPath, $filename, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
            'Cache-Control' => 'max-age=0',
        ])->deleteFileAfterSend(true);
    }

    /**
     * Import Layanan from Excel File
     */
    public function importExcel(Request $request, LayananImportService $importService)
    {
        $request->validate([
            'excel_file' => 'required|file|mimes:xlsx,xls,csv|max:20480',
        ], [
            'excel_file.required' => 'Silakan pilih berkas Excel (.xlsx / .xls) untuk diimpor.',
            'excel_file.mimes' => 'Format berkas harus berupa Excel (.xlsx, .xls) atau CSV.',
            'excel_file.max' => 'Ukuran berkas maksimal 20 MB.',
        ]);

        try {
            $result = $importService->importFromExcel($request->file('excel_file'));

            if ($result['success_count'] > 0) {
                $msg = "Berhasil mengimpor {$result['success_count']} paket layanan baru!";
                if ($result['skipped_count'] > 0) {
                    $msg .= " ({$result['skipped_count']} baris dilewati karena format tidak sesuai).";
                }
                Alert::success('Import Berhasil', $msg);
            } else {
                $errorMsg = !empty($result['errors']) ? implode('<br>', array_slice($result['errors'], 0, 3)) : 'Tidak ada data valid yang dapat diimpor.';
                Alert::warning('Tidak Ada Data Diimpor', $errorMsg);
            }

            return redirect()->route('admin.layanan.index')
                ->with('import_errors', $result['errors'] ?? []);
        } catch (\Throwable $e) {
            Alert::error('Gagal Import', 'Terjadi kesalahan saat memproses berkas Excel: ' . $e->getMessage());
            return redirect()->back();
        }
    }
}