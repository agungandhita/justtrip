<?php

namespace App\Services;

use App\Models\Layanan;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;
use PhpOffice\PhpSpreadsheet\Style\Protection;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\MemoryDrawing;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LayananImportService
{
    /**
     * Generate an Excel template (.xlsx) with guidelines and sample data.
     *
     * @return string Temporary file path
     */
    public function generateTemplate(): string
    {
        $spreadsheet = new Spreadsheet();

        // -------------------------------------------------------------
        // SHEET 1: Data Template
        // -------------------------------------------------------------
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Layanan');

        // Main Title Banner
        $sheet->setCellValue('A1', 'FORMAT IMPORT DATA LAYANAN JUSTTRIP');
        $sheet->mergeCells('A1:AD1');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('312E81'); // Dark Indigo
        $sheet->getStyle('A1')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(1)->setRowHeight(36);

        // Subtitle / Instruction Row
        $sheet->setCellValue('A2', 'Petunjuk: Kolom bertanda (*) Wajib diisi. Baris 4 adalah 1 contoh data (bisa diedit/dihapus). Format kolom & judul dikunci agar tidak rusak.');
        $sheet->mergeCells('A2:AD2');
        $sheet->getStyle('A2')->getFont()->setItalic(true)->setSize(9)->getColor()->setRGB('475569');
        $sheet->getStyle('A2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F1F5F9');
        $sheet->getStyle('A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getRowDimension(2)->setRowHeight(22);

        // Header Columns
        $headers = [
            'A3' => 'Nama Layanan *',
            'B3' => 'Jenis Layanan *',
            'C3' => 'Lokasi Tujuan *',
            'D3' => 'Deskripsi',
            'E3' => 'Harga Mulai (Rp) *',
            'F3' => 'Durasi (Hari) *',
            'G3' => 'Maksimal Pax *',
            'H3' => 'Status',
            'I3' => 'Jam Mulai Trip',
            'J3' => 'Jam Selesai Trip',
            'K3' => 'Catatan Itinerary',
            'L3' => 'Itinerary Per Hari',
            'M3' => 'Include (Termasuk)',
            'N3' => 'Exclude (Tidak Termasuk)',
            'O3' => 'Destinasi Dikunjungi',
            'P3' => 'Opsi Variasi Harga',
            'Q3' => 'Fasilitas Tambahan',
            'R3' => 'Syarat Pendaftaran',
            'S3' => 'Kebijakan Pembatalan',
            'T3' => 'Di Luar Tanggung Jawab',
            'U3' => 'Catatan Internal Admin',
            'V3' => 'URL Foto Destinasi',
            'W3' => 'Sisipkan Foto (Insert Image)',
            'X3' => 'Adventure: Tingkat Kesulitan',
            'Y3' => 'Adventure: Tipe Aktivitas',
            'Z3' => 'Adventure: Perlengkapan Wajib',
            'AA3' => 'Adventure: Titik Kumpul',
            'AB3' => 'Edukasi: Harga Per Orang (Rp)',
            'AC3' => 'Edukasi: Harga Per Kelompok (Rp)',
            'AD3' => 'Edukasi: Keterangan Kelompok',
        ];

        foreach ($headers as $cell => $text) {
            $sheet->setCellValue($cell, $text);
        }

        $sheet->getStyle('A3:AD3')->getFont()->setBold(true)->setSize(10)->getColor()->setRGB('FFFFFF');
        $sheet->getStyle('A3:AD3')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('4F46E5'); // Indigo 600
        $sheet->getStyle('A3:AD3')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER)->setVertical(Alignment::VERTICAL_CENTER)->setWrapText(true);
        $sheet->getRowDimension(3)->setRowHeight(32);

        // Exactly 1 Sample Data Row (Row 4)
        $sample = [
            'Phinisi Superior 3D2N Labuan Bajo',
            'Open Trip (Per orang)',
            'Labuan Bajo, NTT',
            'Jelajahi keindahan Kepulauan Komodo dengan kapal Phinisi superior berfasilitas lengkap dan pemandangan laut spektakuler.',
            2500000,
            3,
            14,
            'aktif',
            '10:00 AM',
            '12:00 PM',
            'Itinerary dapat berubah sewaktu-waktu tergantung kondisi cuaca dan ombak laut.',
            'Hari 1: Penjemputan Bandara Komodo, Check-in Kapal, Sunset di Pulau Kelor | Hari 2: Trekking Sunrise Pulau Padar, Snorkeling Pink Beach, Melihat Komodo | Hari 3: Manta Point, Taka Makassar, Drop Bandara',
            'Penjemputan & Pengantaran Bandara | Makan 3x Sehari Selama Trip | Tiket Masuk Taman Nasional Komodo | Pelampung & Alat Snorkeling | Dokumentasi Drone & Kamera',
            'Tiket Pesawat PP | Keperluan Pribadi | Tipping Guide & Kru Kapal',
            'Pulau Kelor | Pulau Padar | Pink Beach | Pulau Komodo | Manta Point | Taka Makassar',
            'Share Cabin (4 Pax): 2500000 | Private Cabin (2 Pax): 3500000',
            'Air Mineral | P3K Standar | Coffee & Tea Bar',
            'Pendaftaran wajib DP minimal 50% | Pelunasan H-7 sebelum keberangkatan',
            'Pembatalan H-14 uang muka hangus 50% | Pembatalan H-7 hangus 100%',
            'Keterlambatan penerbangan maskapai | Kehilangan barang bawaan pribadi',
            'Vendor kapal: Phinisi Samudra Jaya, Kapten Wayan.',
            'https://images.unsplash.com/photo-1516426122078-c23e76319801?w=800; https://drive.google.com/file/d/1exampleGoogleDriveFileId/view?usp=sharing',
            '(Bisa paste foto langsung di sini)',
            '',
            '',
            '',
            '',
            '',
            '',
            '',
        ];

        $colIdx = 1;
        foreach ($sample as $value) {
            $sheet->setCellValueExplicit(
                Coordinate::stringFromColumnIndex($colIdx) . '4',
                $value,
                is_numeric($value) ? \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_NUMERIC : \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING
            );
            $colIdx++;
        }

        // Apply borders and styling for sample row (Row 4) and pre-formatted blank rows (Rows 5 to 25)
        $sheet->getStyle('A4:AD25')->getBorders()->getAllBorders()->setBorderStyle(Border::BORDER_THIN)->getColor()->setRGB('E2E8F0');
        $sheet->getStyle('A4:AD25')->getAlignment()->setVertical(Alignment::VERTICAL_CENTER);
        $sheet->getStyle('A4:AD4')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('F8FAFC');
        $sheet->getRowDimension(4)->setRowHeight(26);

        // Auto-fit column widths
        foreach (range(1, 30) as $col) {
            $colLetter = Coordinate::stringFromColumnIndex($col);
            $sheet->getColumnDimension($colLetter)->setWidth(24);
        }
        $sheet->getColumnDimension('A')->setWidth(34); // Nama
        $sheet->getColumnDimension('B')->setWidth(26); // Jenis
        $sheet->getColumnDimension('D')->setWidth(40); // Deskripsi
        $sheet->getColumnDimension('L')->setWidth(45); // Itinerary
        $sheet->getColumnDimension('M')->setWidth(35); // Include
        $sheet->getColumnDimension('N')->setWidth(35); // Exclude
        $sheet->getColumnDimension('O')->setWidth(30); // Destinasi
        $sheet->getColumnDimension('P')->setWidth(35); // Opsi Harga
        $sheet->getColumnDimension('V')->setWidth(38); // URL Foto
        $sheet->getColumnDimension('W')->setWidth(26); // Sisipkan Foto

        // Freeze panes so header is always visible when scrolling
        $sheet->freezePane('A4');

        // LOCK header & instruction cells (Rows 1 to 3)
        $sheet->getStyle('A1:AD3')->getProtection()->setLocked(Protection::PROTECTION_PROTECTED);

        // UNLOCK user editable data area (Row 4 onwards)
        $sheet->getStyle('A4:AD100')->getProtection()->setLocked(Protection::PROTECTION_UNPROTECTED);

        // PROTECT sheet structure so headers & titles cannot be accidentally edited or broken
        $sheet->getProtection()->setPassword('');
        $sheet->getProtection()->setSheet(true);
        $sheet->getProtection()->setSort(true);
        $sheet->getProtection()->setInsertRows(true);
        $sheet->getProtection()->setFormatCells(true);
        $sheet->getProtection()->setSelectLockedCells(true);
        $sheet->getProtection()->setSelectUnlockedCells(true);

        // -------------------------------------------------------------
        // SHEET 2: Panduan & Dokumentasi
        // -------------------------------------------------------------
        $guideSheet = $spreadsheet->createSheet();
        $guideSheet->setTitle('Panduan Pengisian');

        $guideSheet->setCellValue('A1', 'PANDUAN & PETUNJUK LENGKAP PENGISIAN EXCEL');
        $guideSheet->mergeCells('A1:C1');
        $guideSheet->getStyle('A1')->getFont()->setBold(true)->setSize(13)->getColor()->setRGB('FFFFFF');
        $guideSheet->getStyle('A1')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('1E1B4B');
        $guideSheet->getRowDimension(1)->setRowHeight(30);

        $guideRows = [
            ['Kolom', 'Format / Nilai yang Diterima', 'Penjelasan & Contoh'],
            ['Nama Layanan *', 'Teks Bebas', 'Wajib diisi. Contoh: "Paket Liburan Bromo Midnight 2D1N"'],
            ['Jenis Layanan *', 'Pilihan: Corporate, Adventure, Edukasi, Open Trip', 'Sistem otomatis mengenali kata kunci seperti "Corporate", "Adventure", "Edukasi", atau "Open Trip"'],
            ['Lokasi Tujuan *', 'Teks Bebas', 'Wajib diisi. Contoh: "Labuan Bajo, NTT" atau "Gunung Bromo, Jawa Timur"'],
            ['Deskripsi', 'Teks Bebas / Paragraf', 'Penjelasan menarik mengenai keunggulan paket liburan'],
            ['Harga Mulai (Rp) *', 'Angka Saja (Tanpa titik/Rp)', 'Wajib diisi. Contoh: 2500000'],
            ['Durasi (Hari) *', 'Angka (Hari)', 'Wajib diisi bilangan bulat. Contoh: 3 (akan otomatis ditampilkan sebagai 3 Hari 2 Malam)'],
            ['Maksimal Pax *', 'Angka (Kapasitas)', 'Wajib diisi kapasitas maksimal peserta. Contoh: 15'],
            ['Status', 'aktif atau nonaktif', 'Default adalah "aktif". Jika diisi "nonaktif", paket disimpan sebagai draft'],
            ['Itinerary Per Hari', 'Pisahkan hari dengan tanda (|) dan aktivitas dengan koma (,)', 'Contoh: Hari 1: Jemput Bandara, Hotel | Hari 2: Sunrise Bromo, Kawah Bromo | Hari 3: Drop Bandara'],
            ['Include / Exclude', 'Pisahkan poin dengan tanda tegak (|)', 'Contoh: Antar Jemput Bandara | Makan 3x Sehari | Tiket Masuk | Guide Lokal'],
            ['Destinasi', 'Pisahkan spot wisata dengan tanda tegak (|)', 'Contoh: Pulau Padar | Pink Beach | Pulau Komodo'],
            ['Opsi Variasi Harga', 'Format: Nama: Harga | Nama: Harga', 'Contoh: Share Cabin: 2400000 | Private Cabin: 3500000. Untuk Edukasi: Per Orang: 250000 | Per Kelompok: 2000000'],
            ['Foto Destinasi (3 Pilihan Bebas)', "1. Link Google Drive (Pastikan sharing: 'Siapa saja yang memiliki link dapat melihat')\n2. Link URL Foto Online (.jpg / .png)\n3. Paste/Sisipkan Gambar Langsung di Kolom W", 'Sistem otomatis mengunduh & menyimpan foto ke server saat diimpor. Anda juga bisa mengedit/mengganti foto kapan saja lewat web admin!'],
            ['Karakteristik Adventure', 'Tingkat Kesulitan, Tipe, Perlengkapan, Titik Kumpul', 'Khusus jika jenis layanan Adventure. Contoh: Sedang / Moderate, Trekking & Hiking, Sepatu gunung, Basecamp Sembalun.'],
            ['Skema Harga Edukasi', 'Harga Per Orang, Harga Per Kelompok, Keterangan', 'Khusus jika jenis layanan Edukasi. Memungkinkan penetapan harga satuan per siswa dan tarif flat per rombongan kelompok.'],
            ['Edit Lewat Web Admin', 'Bisa Diedit Kapan Saja', 'Semua paket yang diimpor akan langsung masuk ke database dan dapat diubah, ditambah foto, atau disesuaikan lewat menu Edit di web admin.'],
        ];

        $gRow = 2;
        foreach ($guideRows as $item) {
            $guideSheet->setCellValue('A' . $gRow, $item[0]);
            $guideSheet->setCellValue('B' . $gRow, $item[1]);
            $guideSheet->setCellValue('C' . $gRow, $item[2]);
            if ($gRow === 2) {
                $guideSheet->getStyle('A2:C2')->getFont()->setBold(true)->getColor()->setRGB('FFFFFF');
                $guideSheet->getStyle('A2:C2')->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setRGB('4F46E5');
            }
            $guideSheet->getStyle('A' . $gRow . ':C' . $gRow)->getAlignment()->setWrapText(true)->setVertical(Alignment::VERTICAL_CENTER);
            $gRow++;
        }

        $guideSheet->getColumnDimension('A')->setWidth(26);
        $guideSheet->getColumnDimension('B')->setWidth(35);
        $guideSheet->getColumnDimension('C')->setWidth(55);

        // Protect guide sheet from accidental edits
        $guideSheet->getProtection()->setPassword('');
        $guideSheet->getProtection()->setSheet(true);

        // Set active sheet back to Data Layanan
        $spreadsheet->setActiveSheetIndex(0);

        // Save to temporary file
        $tempPath = tempnam(sys_get_temp_dir(), 'layanan_template_') . '.xlsx';
        $writer = new Xlsx($spreadsheet);
        $writer->save($tempPath);

        return $tempPath;
    }

    /**
     * Import Layanan data from an uploaded Excel file.
     *
     * @param UploadedFile $file
     * @return array [success_count, skipped_count, errors, created_items]
     */
    public function importFromExcel(UploadedFile $file): array
    {
        $reader = IOFactory::createReaderForFile($file->getPathname());
        $spreadsheet = $reader->load($file->getPathname());
        $sheet = $spreadsheet->getActiveSheet();

        // -------------------------------------------------------------
        // Step 1: Extract Embedded Photos from Excel Sheet (if any)
        // -------------------------------------------------------------
        $drawingsByRow = [];
        try {
            foreach ($sheet->getDrawingCollection() as $drawing) {
                $coords = $drawing->getCoordinates(); // e.g. "W4"
                preg_match('/(\d+)/', $coords, $matches);
                $rowNumber = isset($matches[1]) ? (int) $matches[1] : null;

                if ($rowNumber) {
                    if ($drawing instanceof Drawing) {
                        $sourcePath = $drawing->getPath();
                        if (file_exists($sourcePath)) {
                            $ext = pathinfo($sourcePath, PATHINFO_EXTENSION) ?: 'jpg';
                            $targetPath = 'layanan/destinasi/' . Str::uuid() . '.' . strtolower($ext);
                            Storage::disk('public')->put($targetPath, file_get_contents($sourcePath));
                            $drawingsByRow[$rowNumber][] = $targetPath;
                        }
                    } elseif ($drawing instanceof MemoryDrawing) {
                        ob_start();
                        call_user_func($drawing->getRenderingFunction(), $drawing->getImageResource());
                        $imageBinary = ob_get_contents();
                        ob_end_clean();

                        if (!empty($imageBinary)) {
                            $ext = match ($drawing->getMimeType()) {
                                MemoryDrawing::MIMETYPE_PNG => 'png',
                                MemoryDrawing::MIMETYPE_GIF => 'gif',
                                default => 'jpg',
                            };
                            $targetPath = 'layanan/destinasi/' . Str::uuid() . '.' . $ext;
                            Storage::disk('public')->put($targetPath, $imageBinary);
                            $drawingsByRow[$rowNumber][] = $targetPath;
                        }
                    }
                }
            }
        } catch (\Throwable $e) {
            // Silently continue if drawings cannot be parsed
        }

        // -------------------------------------------------------------
        // Step 2: Read Data Rows (Starting from Row 4)
        // -------------------------------------------------------------
        $highestRow = $sheet->getHighestRow();
        $importedCount = 0;
        $skippedCount = 0;
        $errors = [];
        $createdItems = [];

        for ($row = 4; $row <= $highestRow; $row++) {
            $namaLayanan = trim((string) $sheet->getCell('A' . $row)->getValue());

            // Skip empty rows
            if (empty($namaLayanan) || $namaLayanan === 'Nama Layanan *') {
                continue;
            }

            // Extract cells
            $jenisRaw = trim((string) $sheet->getCell('B' . $row)->getValue());
            $lokasi = trim((string) $sheet->getCell('C' . $row)->getValue());
            $deskripsi = trim((string) $sheet->getCell('D' . $row)->getValue());
            $hargaMulai = (float) $sheet->getCell('E' . $row)->getValue();
            $durasiHari = (int) $sheet->getCell('F' . $row)->getValue();
            $maksOrang = (int) $sheet->getCell('G' . $row)->getValue();
            $statusRaw = strtolower(trim((string) $sheet->getCell('H' . $row)->getValue()));
            $startTime = trim((string) $sheet->getCell('I' . $row)->getValue());
            $finishTime = trim((string) $sheet->getCell('J' . $row)->getValue());
            $itineraryNote = trim((string) $sheet->getCell('K' . $row)->getValue());
            $itineraryRaw = trim((string) $sheet->getCell('L' . $row)->getValue());
            $includeRaw = trim((string) $sheet->getCell('M' . $row)->getValue());
            $excludeRaw = trim((string) $sheet->getCell('N' . $row)->getValue());
            $destinasiRaw = trim((string) $sheet->getCell('O' . $row)->getValue());
            $pricingRaw = trim((string) $sheet->getCell('P' . $row)->getValue());
            $fasilitasRaw = trim((string) $sheet->getCell('Q' . $row)->getValue());
            $regTermsRaw = trim((string) $sheet->getCell('R' . $row)->getValue());
            $cancelTermsRaw = trim((string) $sheet->getCell('S' . $row)->getValue());
            $notRespTermsRaw = trim((string) $sheet->getCell('T' . $row)->getValue());
            $catatanInternal = trim((string) $sheet->getCell('U' . $row)->getValue());
            $fotoUrlRaw = trim((string) $sheet->getCell('V' . $row)->getValue());
            // Column W is for embedded photos (handled in Step 1)
            $advDifficulty = trim((string) $sheet->getCell('X' . $row)->getValue());
            $advActivity = trim((string) $sheet->getCell('Y' . $row)->getValue());
            $advGear = trim((string) $sheet->getCell('Z' . $row)->getValue());
            $advMeetingPoint = trim((string) $sheet->getCell('AA' . $row)->getValue());
            $eduHargaOrang = (float) $sheet->getCell('AB' . $row)->getValue();
            $eduHargaKelompok = (float) $sheet->getCell('AC' . $row)->getValue();
            $eduCatatanKelompok = trim((string) $sheet->getCell('AD' . $row)->getValue());

            // Basic Validation
            if (empty($lokasi)) {
                $skippedCount++;
                $errors[] = "Baris {$row} ({$namaLayanan}): Lokasi tujuan wajib diisi.";
                continue;
            }

            if ($hargaMulai <= 0 && $eduHargaOrang <= 0 && $eduHargaKelompok <= 0) {
                $skippedCount++;
                $errors[] = "Baris {$row} ({$namaLayanan}): Harga mulai wajib diisi angka lebih dari 0.";
                continue;
            }

            // Map jenis_layanan
            $jenisLayanan = $this->parseJenisLayanan($jenisRaw);

            // Defaults if missing
            $durasiHari = $durasiHari > 0 ? $durasiHari : 1;
            $maksOrang = $maksOrang > 0 ? $maksOrang : 10;
            $status = in_array($statusRaw, ['aktif', 'nonaktif']) ? $statusRaw : 'aktif';
            if ($hargaMulai <= 0 && $eduHargaOrang > 0) {
                $hargaMulai = $eduHargaOrang;
            }

            // Parse Itinerary
            $itinerary = $this->parseItinerary($itineraryRaw, $durasiHari);

            // Parse Pipe-separated Lists
            $includeServices = $this->parsePipeList($includeRaw);
            $excludeServices = $this->parsePipeList($excludeRaw);
            $destinations = $this->parsePipeList($destinasiRaw);
            $fasilitas = $this->parsePipeList($fasilitasRaw);

            // Parse Pricing Options
            $pricingOptions = $this->parsePricingOptions($pricingRaw);

            // Handle Edukasi Pricing additions
            if ($jenisLayanan === 'edu_trip') {
                if ($eduHargaOrang > 0) {
                    $pricingOptions[] = ['type' => 'Per Orang', 'price' => $eduHargaOrang];
                }
                if ($eduHargaKelompok > 0) {
                    $note = !empty($eduCatatanKelompok) ? ' (' . $eduCatatanKelompok . ')' : '';
                    $pricingOptions[] = ['type' => 'Per Kelompok' . $note, 'price' => $eduHargaKelompok];
                }
            }

            // Parse Terms & Conditions
            $termsConditions = [];
            $regTerms = $this->parsePipeList($regTermsRaw);
            $cancelTerms = $this->parsePipeList($cancelTermsRaw);
            $notRespTerms = $this->parsePipeList($notRespTermsRaw);
            if (!empty($regTerms)) $termsConditions['registration_payment'] = $regTerms;
            if (!empty($cancelTerms)) $termsConditions['cancelation'] = $cancelTerms;
            if (!empty($notRespTerms)) $termsConditions['not_responsible_for'] = $notRespTerms;

            // Handle Adventure Metadata into catatan
            if ($jenisLayanan === 'adventure_trip') {
                $advNotes = [];
                if (!empty($advDifficulty)) $advNotes[] = "Tingkat Kesulitan: " . $advDifficulty;
                if (!empty($advActivity)) $advNotes[] = "Aktivitas: " . $advActivity;
                if (!empty($advGear)) $advNotes[] = "Perlengkapan Wajib: " . $advGear;
                if (!empty($advMeetingPoint)) $advNotes[] = "Titik Kumpul: " . $advMeetingPoint;
                if (!empty($advNotes)) {
                    $metaStr = "[Adventure Trip Info] " . implode(" | ", $advNotes);
                    $catatanInternal = !empty($catatanInternal) ? $catatanInternal . "\n\n" . $metaStr : $metaStr;
                }
            }

            // ---------------------------------------------------------
            // Handle Photos: Embedded Drawings + URL Downloads
            // ---------------------------------------------------------
            $gambarPaths = $drawingsByRow[$row] ?? [];

            if (!empty($fotoUrlRaw)) {
                $urls = preg_split('/[;|\n]/', $fotoUrlRaw);
                foreach ($urls as $url) {
                    $url = trim($url);
                    if (empty($url)) continue;

                    $downloadUrl = $this->normalizeImageUrl($url);
                    if (filter_var($downloadUrl, FILTER_VALIDATE_URL) && count($gambarPaths) < 5) {
                        try {
                            $response = Http::timeout(10)
                                ->withHeaders([
                                    'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36'
                                ])
                                ->get($downloadUrl);

                            if ($response->successful()) {
                                $body = $response->body();
                                $imageInfo = @getimagesizefromstring($body);
                                if ($imageInfo !== false) {
                                    $mime = $imageInfo['mime'] ?? 'image/jpeg';
                                    $ext = match ($mime) {
                                        'image/png' => 'png',
                                        'image/webp' => 'webp',
                                        'image/gif' => 'gif',
                                        default => 'jpg',
                                    };

                                    $filePath = 'layanan/destinasi/' . Str::uuid() . '.' . $ext;
                                    Storage::disk('public')->put($filePath, $body);
                                    $gambarPaths[] = $filePath;
                                }
                            }
                        } catch (\Throwable $e) {
                            // Skip download error and continue
                        }
                    }
                }
            }

            // Cap at 5 images
            $gambarPaths = array_slice($gambarPaths, 0, 5);

            // Generate unique slug
            $baseSlug = Str::slug($namaLayanan);
            $slug = $baseSlug;
            $counter = 1;
            while (Layanan::where('slug', $slug)->exists()) {
                $slug = $baseSlug . '-' . $counter;
                $counter++;
            }

            // Create Layanan Model
            try {
                $item = Layanan::create([
                    'nama_layanan' => $namaLayanan,
                    'slug' => $slug,
                    'jenis_layanan' => $jenisLayanan,
                    'lokasi_tujuan' => $lokasi,
                    'deskripsi' => $deskripsi ?: null,
                    'harga_mulai' => $hargaMulai,
                    'durasi_hari' => $durasiHari,
                    'maks_orang' => $maksOrang,
                    'status' => $status,
                    'start_time' => $startTime ?: null,
                    'finish_time' => $finishTime ?: null,
                    'itinerary_note' => $itineraryNote ?: null,
                    'itinerary' => !empty($itinerary) ? $itinerary : null,
                    'include_services' => !empty($includeServices) ? $includeServices : null,
                    'exclude_services' => !empty($excludeServices) ? $excludeServices : null,
                    'destinations' => !empty($destinations) ? $destinations : null,
                    'pricing_options' => !empty($pricingOptions) ? $pricingOptions : null,
                    'terms_conditions' => !empty($termsConditions) ? $termsConditions : null,
                    'fasilitas' => !empty($fasilitas) ? $fasilitas : null,
                    'catatan' => $catatanInternal ?: null,
                    'gambar_destinasi' => !empty($gambarPaths) ? $gambarPaths : null,
                ]);

                $importedCount++;
                $createdItems[] = $item;
            } catch (\Throwable $e) {
                $skippedCount++;
                $errors[] = "Baris {$row} ({$namaLayanan}): Gagal menyimpan ke database. Error: " . $e->getMessage();
            }
        }

        return [
            'success_count' => $importedCount,
            'skipped_count' => $skippedCount,
            'errors' => $errors,
            'created_items' => $createdItems,
        ];
    }

    /**
     * Map arbitrary text to valid jenis_layanan key.
     */
    protected function parseJenisLayanan(string $raw): string
    {
        $lower = strtolower($raw);
        if (str_contains($lower, 'corporate') || str_contains($lower, 'perusahaan')) {
            return 'corporate_trip';
        }
        if (str_contains($lower, 'adventure') || str_contains($lower, 'petualang') || str_contains($lower, 'gunung')) {
            return 'adventure_trip';
        }
        if (str_contains($lower, 'edu') || str_contains($lower, 'sekolah') || str_contains($lower, 'studi')) {
            return 'edu_trip';
        }
        return 'open_trip';
    }

    /**
     * Parse itinerary string into structured array.
     */
    protected function parseItinerary(string $raw, int $durationDays): array
    {
        if (empty($raw)) {
            return [];
        }

        $result = [];
        $dayBlocks = preg_split('/[|\n]/', $raw);

        $dayNumber = 1;
        foreach ($dayBlocks as $block) {
            $block = trim($block);
            if (empty($block)) continue;

            // Extract Day and Activities
            if (preg_match('/Hari\s*(\d+)[\s:]+(.*)/i', $block, $matches)) {
                $dNum = (int) $matches[1];
                $activityStr = $matches[2];
            } else {
                $dNum = $dayNumber;
                $activityStr = $block;
            }

            $activities = array_values(array_filter(array_map('trim', explode(',', $activityStr))));
            if (!empty($activities)) {
                $result[] = [
                    'day' => $dNum,
                    'activities' => $activities,
                ];
            }
            $dayNumber++;
        }

        return $result;
    }

    /**
     * Parse pipe or newline separated string into simple array.
     */
    protected function parsePipeList(string $raw): array
    {
        if (empty($raw)) return [];
        $items = preg_split('/[|\n]/', $raw);
        return array_values(array_filter(array_map('trim', $items)));
    }

    /**
     * Parse pricing options (e.g. "Share Cabin: 2400000 | Private Cabin: 3500000").
     */
    protected function parsePricingOptions(string $raw): array
    {
        if (empty($raw)) return [];
        $options = [];
        $items = preg_split('/[|\n]/', $raw);
        foreach ($items as $item) {
            $item = trim($item);
            if (empty($item)) continue;
            if (str_contains($item, ':')) {
                [$type, $price] = explode(':', $item, 2);
                $cleanPrice = (float) preg_replace('/[^\d.]/', '', $price);
                if (!empty(trim($type)) && $cleanPrice > 0) {
                    $options[] = [
                        'type' => trim($type),
                        'price' => $cleanPrice,
                    ];
                }
            }
        }
        return $options;
    }

    /**
     * Normalize image URLs including Google Drive sharing links.
     */
    protected function normalizeImageUrl(string $url): string
    {
        $url = trim($url);

        // 1. Google Drive view link: https://drive.google.com/file/d/{FILE_ID}/view...
        if (preg_match('/drive\.google\.com\/file\/d\/([a-zA-Z0-9_-]+)/i', $url, $matches)) {
            return "https://lh3.googleusercontent.com/d/{$matches[1]}";
        }

        // 2. Google Drive open/uc link: https://drive.google.com/open?id={FILE_ID} or uc?id={FILE_ID}
        if (preg_match('/drive\.google\.com\/(?:open|uc)\?(?:.*&)?id=([a-zA-Z0-9_-]+)/i', $url, $matches)) {
            return "https://lh3.googleusercontent.com/d/{$matches[1]}";
        }

        return $url;
    }
}
