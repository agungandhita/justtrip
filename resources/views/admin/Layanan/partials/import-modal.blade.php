<!-- Modal Import Excel Layanan -->
<div id="importExcelModal" class="fixed inset-0 z-[99999] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <!-- Backdrop with High Z-Index & Blur -->
    <div class="fixed inset-0 bg-slate-950/75 backdrop-blur-md transition-opacity" onclick="closeImportModal()"></div>

    <!-- Centering & Viewport Wrapper -->
    <div class="flex min-h-full items-center justify-center p-3 sm:p-5 md:p-6 text-center">
        <!-- Modal Card: Constrained max-height so it never overflows top/bottom -->
        <div class="relative transform overflow-hidden rounded-3xl md:rounded-[2rem] bg-white text-left shadow-2xl transition-all w-full max-w-2xl border border-gray-100 flex flex-col max-h-[92vh] sm:max-h-[88vh] my-auto">
            
            <!-- Modal Header (Fixed at top of dialog) -->
            <div class="shrink-0 bg-gradient-to-r from-emerald-600 via-teal-600 to-emerald-700 px-6 py-5 md:px-8 md:py-6 text-white relative shadow-sm">
                <button type="button" onclick="closeImportModal()" class="absolute right-5 top-5 w-8 h-8 rounded-full bg-white/10 hover:bg-white/20 text-white flex items-center justify-center transition-all cursor-pointer">
                    <i class="fa-solid fa-xmark text-sm"></i>
                </button>
                <div class="flex items-center gap-2.5 mb-2">
                    <div class="w-9 h-9 rounded-2xl bg-white/20 text-white flex items-center justify-center text-base shadow-sm">
                        <i class="fa-solid fa-file-excel"></i>
                    </div>
                    <span class="px-2.5 py-0.5 rounded-full bg-white/20 text-[10px] font-black uppercase tracking-wider">
                        Fitur Import Cepat
                    </span>
                </div>
                <h3 class="text-xl md:text-2xl font-black text-white tracking-tight">Import Layanan via Excel (.xlsx)</h3>
                <p class="text-emerald-100 text-xs font-medium mt-1 leading-relaxed">
                    Unduh format resmi, lengkapi data paket wisata & foto, lalu unggah untuk menyimpan ke sistem secara otomatis.
                </p>
            </div>

            <!-- Form Wrapper containing scrollable body & fixed footer -->
            <form action="{{ route('admin.layanan.import-excel') }}" method="POST" enctype="multipart/form-data" id="import-excel-form" class="flex flex-col flex-1 overflow-hidden" onsubmit="handleImportSubmit()">
                @csrf
                
                <!-- Modal Body (Scrollable if viewport is small) -->
                <div class="p-5 md:p-7 space-y-4 overflow-y-auto flex-1 text-slate-800">
                    
                    <!-- Step 1: Download Template Card -->
                    <div class="p-4 md:p-5 rounded-2xl bg-emerald-50/70 border border-emerald-200/80 space-y-2.5">
                        <div class="flex items-start justify-between gap-4">
                            <div class="space-y-1">
                                <span class="text-xs font-black uppercase tracking-wider text-emerald-800 flex items-center gap-1.5">
                                    <i class="fa-solid fa-download text-emerald-600"></i>
                                    Langkah 1: Unduh Format Excel
                                </span>
                                <p class="text-xs text-gray-600 leading-relaxed font-medium">
                                    Template telah disesuaikan dengan skema database JustTrip, lengkap dengan contoh pengisian untuk Open Trip, Adventure, dan Edukasi.
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('admin.layanan.download-template') }}"
                           class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white text-xs font-black shadow-sm shadow-emerald-200 transition-all">
                            <i class="fa-solid fa-file-arrow-down text-sm"></i>
                            <span>Unduh Format Template (.xlsx)</span>
                        </a>
                    </div>

                    <!-- Step 2: Information on Photos & Self Adjustment -->
                    <div class="p-4 md:p-5 rounded-2xl bg-slate-50 border border-slate-200 space-y-2.5 text-xs text-slate-700">
                        <span class="font-black text-slate-900 uppercase tracking-wider flex items-center gap-1.5 text-[11px]">
                            <i class="fa-solid fa-circle-info text-indigo-500"></i>
                            Petunjuk Foto & Fleksibilitas Data
                        </span>
                        <ul class="space-y-2 list-none text-[11px] leading-relaxed">
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-image text-emerald-600 mt-0.5 shrink-0"></i>
                                <div>
                                    <strong>Memasukkan Foto Destinasi:</strong> Anda bisa mencantumkan <u>link Google Drive</u> (pastikan izin link <em>"Siapa saja yang memiliki link dapat melihat"</em>), link URL gambar online, ATAU <u>paste foto langsung</u> ke dalam sel Excel di kolom <em>Sisipkan Foto</em>.
                                </div>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-pen-to-square text-indigo-600 mt-0.5 shrink-0"></i>
                                <div>
                                    <strong>Bisa Diedit Lewat Web:</strong> Setelah diimpor, semua paket tour dan foto langsung tersimpan di database dan <u>bisa diedit kapan saja lewat halaman admin</u> (ubah harga, ganti foto, ubah itinerary, dll).
                                </div>
                            </li>
                            <li class="flex items-start gap-2">
                                <i class="fa-solid fa-tags text-amber-600 mt-0.5 shrink-0"></i>
                                <div>
                                    <strong>Daftar Kolom Jamak:</strong> Untuk <em>Include</em>, <em>Exclude</em>, dan <em>Destinasi</em>, pisahkan masing-masing poin dengan tanda garis tegak (<code>|</code>).
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Step 3: Upload File Area -->
                    <div class="space-y-2">
                        <label class="block text-xs font-black uppercase tracking-wider text-gray-700">
                            Langkah 2: Pilih Berkas Excel (.xlsx, .xls, .csv)
                        </label>
                        <input type="file" name="excel_file" id="excel_file_input" accept=".xlsx,.xls,.csv" required class="hidden" onchange="displaySelectedExcel(this)">
                        
                        <label for="excel_file_input" class="flex flex-col items-center justify-center w-full h-32 bg-gray-50 border-2 border-dashed border-gray-300 hover:border-emerald-500 hover:bg-emerald-50/40 rounded-2xl cursor-pointer transition-all group p-3">
                            <div class="w-10 h-10 rounded-2xl bg-white border border-gray-200 text-emerald-600 flex items-center justify-center mb-1.5 group-hover:scale-110 transition-transform shadow-sm">
                                <i class="fa-solid fa-cloud-arrow-up text-base"></i>
                            </div>
                            <span class="text-xs font-bold text-gray-700 group-hover:text-emerald-700 text-center" id="excel-file-label">
                                Klik untuk Memilih Berkas Excel
                            </span>
                            <span class="text-[10px] text-gray-400 mt-0.5 text-center" id="excel-file-hint">
                                Format didukung: .xlsx, .xls, .csv (Maks. 20 MB)
                            </span>
                        </label>
                    </div>

                </div>

                <!-- Modal Footer (Fixed at bottom of dialog) -->
                <div class="shrink-0 px-6 py-4 bg-gray-50/90 border-t border-gray-100 flex items-center justify-end gap-3">
                    <button type="button" onclick="closeImportModal()" class="px-5 py-2.5 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold text-xs uppercase tracking-wider transition-all cursor-pointer">
                        Batal
                    </button>
                    <button type="submit" id="btn-submit-import" class="inline-flex items-center gap-2 px-6 py-2.5 rounded-xl bg-emerald-600 hover:bg-emerald-700 text-white font-black text-xs uppercase tracking-wider shadow-md shadow-emerald-200 transition-all cursor-pointer">
                        <i class="fa-solid fa-file-import" id="btn-import-icon"></i>
                        <span id="btn-import-text">Mulai Import Layanan</span>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<script>
function openImportModal() {
    const modal = document.getElementById('importExcelModal');
    if (modal) {
        if (modal.parentElement !== document.body) {
            document.body.appendChild(modal);
        }
        modal.classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }
}

function closeImportModal() {
    const modal = document.getElementById('importExcelModal');
    if (modal) {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }
}

function displaySelectedExcel(input) {
    const label = document.getElementById('excel-file-label');
    const hint = document.getElementById('excel-file-hint');
    if (input.files && input.files[0]) {
        const file = input.files[0];
        label.textContent = file.name;
        label.classList.add('text-emerald-700', 'font-black');
        hint.textContent = (file.size / 1024 / 1024).toFixed(2) + ' MB • Siap untuk diimpor';
    } else {
        label.textContent = 'Klik untuk Memilih Berkas Excel';
        label.classList.remove('text-emerald-700', 'font-black');
        hint.textContent = 'Format didukung: .xlsx, .xls, .csv (Maks. 20 MB)';
    }
}

function handleImportSubmit() {
    const btn = document.getElementById('btn-submit-import');
    const icon = document.getElementById('btn-import-icon');
    const text = document.getElementById('btn-import-text');
    if (btn && icon && text) {
        btn.disabled = true;
        btn.classList.add('opacity-75', 'cursor-not-allowed');
        icon.className = 'fa-solid fa-circle-notch fa-spin';
        text.textContent = 'Sedang Mengimpor...';
    }
}

// Close modal on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeImportModal();
    }
});
</script>
