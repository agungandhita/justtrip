@extends('admin.layouts.main')

@section('container')
<div class="mt-20 pb-16 antialiased text-gray-900 px-4 md:px-8">
    <!-- Breadcrumbs & Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-xs text-gray-400 font-bold uppercase tracking-wider mb-3">
            <a href="{{ route('admin.layanan.index') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-1.5">
                <i class="fa-solid fa-layer-group text-xs"></i>
                Daftar Layanan
            </a>
            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            <span class="text-indigo-600 font-extrabold">Tambah Layanan Baru</span>
        </div>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 bg-white p-6 md:p-8 rounded-3xl border border-gray-100 shadow-sm">
            <div class="space-y-1">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white flex items-center justify-center shadow-md shadow-indigo-100">
                        <i class="fa-solid fa-plus text-base"></i>
                    </div>
                    <h1 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">Buat Paket Tour Baru</h1>
                </div>
                <p class="text-gray-500 text-sm font-medium pl-13">Konfigurasi paket perjalanan lengkap dengan pilihan kategori, itinerary, dan opsi harga.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.layanan.download-template') }}" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-bold text-xs border border-emerald-200 transition-all shadow-sm" title="Unduh Format Template Excel">
                    <i class="fa-solid fa-file-excel text-emerald-600 text-sm"></i>
                    <span>Unduh Format Excel</span>
                </a>
                <button type="button" onclick="openImportModal()" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-indigo-50 hover:bg-indigo-100 text-indigo-700 font-bold text-xs border border-indigo-200 transition-all shadow-sm" title="Import Data via Excel">
                    <i class="fa-solid fa-cloud-arrow-up text-indigo-600 text-sm"></i>
                    <span>Import Excel</span>
                </button>
                <a href="{{ route('admin.layanan.index') }}" class="inline-flex items-center justify-center gap-2 text-gray-600 hover:text-gray-900 font-bold transition-all px-4 py-2.5 rounded-2xl bg-gray-50 hover:bg-gray-100 border border-gray-200/80 text-xs">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Batal & Kembali
                </a>
            </div>
        </div>
    </div>

    <!-- Wizard Steps Indicator -->
    <div class="max-w-5xl mx-auto mb-10">
        <div class="bg-white p-4 md:p-6 rounded-3xl border border-gray-100 shadow-sm">
            <div class="flex items-center justify-between relative px-4 md:px-10">
                <!-- Background Line -->
                <div class="absolute left-10 right-10 top-1/2 h-1 bg-gray-100 -translate-y-1/2 z-0"></div>
                <!-- Active Progress Line -->
                <div class="absolute left-10 top-1/2 h-1 bg-gradient-to-r from-indigo-500 to-indigo-600 -translate-y-1/2 z-0 transition-all duration-500" id="progress-bar" style="width: 0%"></div>
                
                <!-- Step 1 -->
                <div class="wizard-step active relative z-10 flex flex-col items-center cursor-pointer group" onclick="goToStep(1)">
                    <div class="step-circle w-12 h-12 md:w-13 md:h-13 rounded-2xl flex items-center justify-center font-black text-base transition-all duration-300">
                        <span class="step-num">1</span>
                        <i class="fa-solid fa-check hidden text-base"></i>
                    </div>
                    <span class="step-label mt-2.5 text-xs font-black uppercase tracking-wider text-center">Info Dasar</span>
                </div>

                <!-- Step 2 -->
                <div class="wizard-step relative z-10 flex flex-col items-center cursor-pointer group" onclick="goToStep(2)">
                    <div class="step-circle w-12 h-12 md:w-13 md:h-13 rounded-2xl flex items-center justify-center font-black text-base transition-all duration-300">
                        <span class="step-num">2</span>
                        <i class="fa-solid fa-check hidden text-base"></i>
                    </div>
                    <span class="step-label mt-2.5 text-xs font-bold uppercase tracking-wider text-center">Itinerary</span>
                </div>

                <!-- Step 3 -->
                <div class="wizard-step relative z-10 flex flex-col items-center cursor-pointer group" onclick="goToStep(3)">
                    <div class="step-circle w-12 h-12 md:w-13 md:h-13 rounded-2xl flex items-center justify-center font-black text-base transition-all duration-300">
                        <span class="step-num">3</span>
                        <i class="fa-solid fa-check hidden text-base"></i>
                    </div>
                    <span class="step-label mt-2.5 text-xs font-bold uppercase tracking-wider text-center">Fasilitas & Harga</span>
                </div>

                <!-- Step 4 -->
                <div class="wizard-step relative z-10 flex flex-col items-center cursor-pointer group" onclick="goToStep(4)">
                    <div class="step-circle w-12 h-12 md:w-13 md:h-13 rounded-2xl flex items-center justify-center font-black text-base transition-all duration-300">
                        <span class="step-num">4</span>
                        <i class="fa-solid fa-check hidden text-base"></i>
                    </div>
                    <span class="step-label mt-2.5 text-xs font-bold uppercase tracking-wider text-center">Ketentuan</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Wizard Form -->
    <form action="{{ route('admin.layanan.store') }}" method="POST" enctype="multipart/form-data" id="wizard-form" class="max-w-5xl mx-auto">
        @csrf

        <!-- ========================================== -->
        <!-- STEP 1: Basic Information & Service Category -->
        <!-- ========================================== -->
        <div class="wizard-panel" id="step-1">
            <div class="bg-white rounded-[2.5rem] p-6 md:p-10 shadow-sm border border-gray-100 mb-6 space-y-8">
                <!-- Step Header -->
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center font-black text-lg">
                            <i class="fa-solid fa-compass"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-gray-900">Kategori & Informasi Dasar</h3>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Tentukan tipe perjalanan, nama layanan, tarif dasar, dan berkas media</p>
                        </div>
                    </div>
                    <span class="hidden md:inline-flex px-3 py-1 bg-indigo-50 text-indigo-600 text-xs font-black rounded-full uppercase tracking-wider">
                        Langkah 1 / 4
                    </span>
                </div>

                <!-- SELECTION: JENIS LAYANAN (Visual Interactive Cards) -->
                <div>
                    <div class="flex items-center justify-between mb-3">
                        <label class="block text-xs font-black uppercase tracking-wider text-gray-600">
                            Pilih Jenis Layanan <span class="text-rose-500">*</span>
                        </label>
                        <span class="text-[11px] text-gray-400 font-medium">Klik salah satu kategori di bawah</span>
                    </div>

                    <!-- Hidden / Fallback Select Element -->
                    <select name="jenis_layanan" id="jenis_layanan_select" required class="sr-only">
                        <option value="">Pilih Jenis Layanan</option>
                        <option value="corporate_trip" {{ old('jenis_layanan') == 'corporate_trip' ? 'selected' : '' }}>Corporate (Per orang)</option>
                        <option value="adventure_trip" {{ old('jenis_layanan') == 'adventure_trip' ? 'selected' : '' }}>Adventure (Per orang)</option>
                        <option value="edu_trip" {{ old('jenis_layanan') == 'edu_trip' ? 'selected' : '' }}>Edukasi (Per orang / Per Kelompok*)</option>
                        <option value="open_trip" {{ old('jenis_layanan', 'open_trip') == 'open_trip' ? 'selected' : '' }}>Open Trip (Per orang)</option>
                    </select>

                    <!-- Interactive 4-Grid Service Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4" id="service-type-grid">
                        <!-- 1. Corporate Trip -->
                        <div class="service-card group cursor-pointer p-5 rounded-2xl border-2 transition-all relative overflow-hidden {{ old('jenis_layanan') == 'corporate_trip' ? 'border-emerald-500 bg-emerald-50/40 ring-4 ring-emerald-100 shadow-md' : 'border-gray-100 bg-gray-50/60 hover:bg-emerald-50/20 hover:border-emerald-200' }}"
                             onclick="selectServiceType('corporate_trip')">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-building text-base"></i>
                                </div>
                                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-emerald-100 text-emerald-700">
                                    Per orang
                                </span>
                            </div>
                            <h4 class="font-extrabold text-gray-900 text-base mb-1 group-hover:text-emerald-700 transition-colors">Corporate</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">Gathering, outing, dan incentive trip khusus perusahaan & korporat.</p>
                            <div class="mt-3 flex items-center gap-1.5 text-[11px] font-bold text-emerald-600">
                                <span>Tarif Per Orang</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </div>
                        </div>

                        <!-- 2. Adventure Trip -->
                        <div class="service-card group cursor-pointer p-5 rounded-2xl border-2 transition-all relative overflow-hidden {{ old('jenis_layanan') == 'adventure_trip' ? 'border-amber-500 bg-amber-50/40 ring-4 ring-amber-100 shadow-md' : 'border-gray-100 bg-gray-50/60 hover:bg-amber-50/20 hover:border-amber-200' }}"
                             onclick="selectServiceType('adventure_trip')">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-mountain-sun text-base"></i>
                                </div>
                                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-amber-100 text-amber-800">
                                    Per orang
                                </span>
                            </div>
                            <h4 class="font-extrabold text-gray-900 text-base mb-1 group-hover:text-amber-700 transition-colors">Adventure</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">Penjelajahan alam bebas, trekking, diving & petualangan outdoor.</p>
                            <div class="mt-3 flex items-center gap-1.5 text-[11px] font-bold text-amber-600">
                                <span>Tarif Per Orang</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </div>
                        </div>

                        <!-- 3. Edukasi Trip (Per orang / Per Kelompok*) -->
                        <div class="service-card group cursor-pointer p-5 rounded-2xl border-2 transition-all relative overflow-hidden {{ old('jenis_layanan') == 'edu_trip' ? 'border-indigo-500 bg-indigo-50/40 ring-4 ring-indigo-100 shadow-md' : 'border-gray-100 bg-gray-50/60 hover:bg-indigo-50/20 hover:border-indigo-200' }}"
                             onclick="selectServiceType('edu_trip')">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 rounded-xl bg-indigo-50 text-indigo-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-graduation-cap text-base"></i>
                                </div>
                                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-indigo-100 text-indigo-700">
                                    Per Orang / Kelompok*
                                </span>
                            </div>
                            <h4 class="font-extrabold text-gray-900 text-base mb-1 group-hover:text-indigo-700 transition-colors">Edukasi</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">Wisata edukatif & studi tur dengan skema tarif individu atau rombongan kelompok.</p>
                            <div class="mt-3 flex items-center gap-1.5 text-[11px] font-bold text-indigo-600">
                                <span>Harga Fleksibel</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </div>
                        </div>

                        <!-- 4. Open Trip -->
                        <div class="service-card group cursor-pointer p-5 rounded-2xl border-2 transition-all relative overflow-hidden {{ old('jenis_layanan', 'open_trip') == 'open_trip' ? 'border-purple-500 bg-purple-50/40 ring-4 ring-purple-100 shadow-md' : 'border-gray-100 bg-gray-50/60 hover:bg-purple-50/20 hover:border-purple-200' }}"
                             onclick="selectServiceType('open_trip')">
                            <div class="flex items-center justify-between mb-3">
                                <div class="w-10 h-10 rounded-xl bg-purple-50 text-purple-600 flex items-center justify-center group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-users text-base"></i>
                                </div>
                                <span class="px-2 py-0.5 text-[10px] font-black uppercase tracking-wider rounded-md bg-purple-100 text-purple-700">
                                    Per orang
                                </span>
                            </div>
                            <h4 class="font-extrabold text-gray-900 text-base mb-1 group-hover:text-purple-700 transition-colors">Open Trip</h4>
                            <p class="text-xs text-gray-500 leading-relaxed font-medium">Trip wisata gabungan publik terjadwal bersama traveler lain.</p>
                            <div class="mt-3 flex items-center gap-1.5 text-[11px] font-bold text-purple-600">
                                <span>Tarif Per Orang</span>
                                <i class="fa-solid fa-arrow-right text-[10px]"></i>
                            </div>
                        </div>
                    </div>
                    @error('jenis_layanan')<p class="mt-2 text-xs font-bold text-rose-500">{{ $message }}</p>@enderror
                </div>

                <!-- DYNAMIC PANEL A: KHUSUS EDUKASI (SKEMA HARGA BERBEDA PER ORANG & PER KELOMPOK) -->
                <div id="edu-pricing-box" class="{{ old('jenis_layanan') == 'edu_trip' ? '' : 'hidden' }} transition-all duration-300">
                    <div class="p-6 md:p-8 rounded-3xl bg-gradient-to-br from-indigo-50/90 via-sky-50/50 to-blue-50/80 border-2 border-indigo-200/80 shadow-sm relative overflow-hidden">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-10 h-10 rounded-2xl bg-indigo-600 text-white flex items-center justify-center font-bold shrink-0 shadow-md shadow-indigo-200">
                                <i class="fa-solid fa-calculator text-base"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-base font-black text-indigo-950">Skema Harga Khusus Edukasi</h4>
                                    <span class="px-2.5 py-0.5 bg-indigo-600 text-white text-[10px] font-black rounded-full uppercase tracking-wider">Per Orang & Per Kelompok*</span>
                                </div>
                                <p class="text-xs text-indigo-900/70 font-medium mt-1 leading-relaxed">
                                    Paket Edukasi mendukung dua tipe tarif. Anda dapat mengisi harga <strong>Per Orang</strong> (untuk peserta satuan) dan harga <strong>Per Kelompok*</strong> (flat untuk satu rombongan kelas/kelompok).
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Tipe 1: Per Orang -->
                            <div class="p-5 bg-white rounded-2xl border border-indigo-100 shadow-sm space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black uppercase tracking-wider text-indigo-600 flex items-center gap-1.5">
                                        <i class="fa-solid fa-user"></i>
                                        Tipe 1: Tarif Per Orang
                                    </span>
                                    <span class="text-[10px] font-bold text-gray-400 bg-gray-50 px-2 py-0.5 rounded-md">Individu / Siswa</span>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Harga Satuan (Rp) *</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-gray-400 text-sm">Rp</span>
                                        <input type="number" name="edu_harga_per_orang" id="edu_harga_per_orang" value="{{ old('edu_harga_per_orang') }}" min="0"
                                               class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none font-mono font-bold text-indigo-600 focus:bg-white focus:border-indigo-500 text-sm"
                                               placeholder="Contoh: 150000" oninput="syncEduPricing()">
                                    </div>
                                    <p class="text-[11px] text-gray-400 mt-1" id="preview-edu-per-orang">Preview: Rp 0</p>
                                </div>
                            </div>

                            <!-- Tipe 2: Per Kelompok -->
                            <div class="p-5 bg-white rounded-2xl border border-indigo-100 shadow-sm space-y-3">
                                <div class="flex items-center justify-between">
                                    <span class="text-xs font-black uppercase tracking-wider text-indigo-600 flex items-center gap-1.5">
                                        <i class="fa-solid fa-users-rectangle"></i>
                                        Tipe 2: Tarif Per Kelompok*
                                    </span>
                                    <span class="text-[10px] font-bold text-amber-700 bg-amber-50 px-2 py-0.5 rounded-md">1 Rombongan</span>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Harga Paket Kelompok (Rp) *</label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 font-bold text-gray-400 text-sm">Rp</span>
                                        <input type="number" name="edu_harga_per_kelompok" id="edu_harga_per_kelompok" value="{{ old('edu_harga_per_kelompok') }}" min="0"
                                               class="w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none font-mono font-bold text-indigo-600 focus:bg-white focus:border-indigo-500 text-sm"
                                               placeholder="Contoh: 1500000" oninput="syncEduPricing()">
                                    </div>
                                    <p class="text-[11px] text-gray-400 mt-1" id="preview-edu-per-kelompok">Preview: Rp 0</p>
                                </div>
                                <div>
                                    <label class="block text-[11px] font-bold text-gray-500 mb-1">Catatan Kuota / Kapasitas Kelompok</label>
                                    <input type="text" name="edu_catatan_kelompok" id="edu_catatan_kelompok" value="{{ old('edu_catatan_kelompok', 'Kapasitas s/d 10-15 Siswa per Kelompok') }}"
                                           class="w-full px-4 py-2 bg-gray-50 border border-gray-200 rounded-xl outline-none text-xs text-gray-700 focus:bg-white focus:border-indigo-500"
                                           placeholder="Contoh: Kapasitas s/d 10-15 Siswa per Kelompok" oninput="syncEduPricing()">
                                </div>
                            </div>
                        </div>

                        <div class="mt-4 flex items-center gap-2 text-xs font-medium text-indigo-800 bg-white/70 px-4 py-2.5 rounded-xl border border-indigo-100">
                            <i class="fa-solid fa-circle-info text-indigo-500"></i>
                            <span>Skema ini akan disinkronkan otomatis ke opsi harga paket (Step 3) dan tarif dasar awal paket.</span>
                        </div>
                    </div>
                </div>

                <!-- DYNAMIC PANEL B: KHUSUS ADVENTURE TRIP (INPUT PERJALANAN PETUALANGAN) -->
                <div id="adventure-box" class="{{ old('jenis_layanan') == 'adventure_trip' ? '' : 'hidden' }} transition-all duration-300">
                    <div class="p-6 md:p-8 rounded-3xl bg-gradient-to-br from-amber-50/90 via-orange-50/50 to-amber-50/80 border-2 border-amber-200/80 shadow-sm relative overflow-hidden">
                        <div class="flex items-start gap-4 mb-6">
                            <div class="w-10 h-10 rounded-2xl bg-amber-600 text-white flex items-center justify-center font-bold shrink-0 shadow-md shadow-amber-200">
                                <i class="fa-solid fa-mountain text-base"></i>
                            </div>
                            <div>
                                <div class="flex items-center gap-2">
                                    <h4 class="text-base font-black text-amber-950">Detail Karakteristik Adventure Trip</h4>
                                    <span class="px-2.5 py-0.5 bg-amber-600 text-white text-[10px] font-black rounded-full uppercase tracking-wider">Outdoor Exploration</span>
                                </div>
                                <p class="text-xs text-amber-900/70 font-medium mt-1 leading-relaxed">
                                    Lengkapi spesifikasi perjalanan petualangan alam terbuka untuk memudahkan briefing dan persiapan traveler.
                                </p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Tingkat Kesulitan -->
                            <div class="p-5 bg-white rounded-2xl border border-amber-100 shadow-sm space-y-3">
                                <label class="block text-xs font-black uppercase tracking-wider text-amber-800">
                                    Tingkat Kesulitan / Difficulty
                                </label>
                                <div class="grid grid-cols-2 gap-2">
                                    <button type="button" onclick="setAdventureDifficulty('Mudah / Easy')" class="adv-diff-btn px-3 py-2 text-xs font-bold rounded-xl border border-gray-200 bg-gray-50 text-gray-700 hover:border-emerald-500 hover:text-emerald-700 hover:bg-emerald-50 transition-all text-left">
                                        🟢 Mudah (Easy)
                                    </button>
                                    <button type="button" onclick="setAdventureDifficulty('Sedang / Moderate')" class="adv-diff-btn px-3 py-2 text-xs font-bold rounded-xl border border-gray-200 bg-gray-50 text-gray-700 hover:border-amber-500 hover:text-amber-700 hover:bg-amber-50 transition-all text-left">
                                        🟡 Sedang (Moderate)
                                    </button>
                                    <button type="button" onclick="setAdventureDifficulty('Menantang / Challenging')" class="adv-diff-btn px-3 py-2 text-xs font-bold rounded-xl border border-gray-200 bg-gray-50 text-gray-700 hover:border-orange-500 hover:text-orange-700 hover:bg-orange-50 transition-all text-left">
                                        🟠 Menantang (Challenging)
                                    </button>
                                    <button type="button" onclick="setAdventureDifficulty('Ekstrem / Advanced')" class="adv-diff-btn px-3 py-2 text-xs font-bold rounded-xl border border-gray-200 bg-gray-50 text-gray-700 hover:border-rose-500 hover:text-rose-700 hover:bg-rose-50 transition-all text-left">
                                        🔴 Ekstrem (Advanced)
                                    </button>
                                </div>
                                <input type="text" name="adventure_difficulty" id="adventure_difficulty" value="{{ old('adventure_difficulty', 'Sedang / Moderate') }}"
                                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl outline-none text-xs font-semibold text-gray-800 focus:bg-white focus:border-amber-500"
                                       placeholder="Tingkat kesulitan trek">
                            </div>

                            <!-- Tipe Aktivitas Adventure -->
                            <div class="p-5 bg-white rounded-2xl border border-amber-100 shadow-sm space-y-3">
                                <label class="block text-xs font-black uppercase tracking-wider text-amber-800">
                                    Tipe Aktivitas Adventure
                                </label>
                                <div class="flex flex-wrap gap-1.5">
                                    <span onclick="setAdventureActivity('Trekking & Hiking')" class="cursor-pointer px-2.5 py-1 text-[11px] font-bold rounded-lg bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100">
                                        + Trekking & Hiking
                                    </span>
                                    <span onclick="setAdventureActivity('Rafting / Arung Jeram')" class="cursor-pointer px-2.5 py-1 text-[11px] font-bold rounded-lg bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100">
                                        + Rafting
                                    </span>
                                    <span onclick="setAdventureActivity('Diving & Snorkeling')" class="cursor-pointer px-2.5 py-1 text-[11px] font-bold rounded-lg bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100">
                                        + Diving & Snorkeling
                                    </span>
                                    <span onclick="setAdventureActivity('Caving / Susur Gua')" class="cursor-pointer px-2.5 py-1 text-[11px] font-bold rounded-lg bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100">
                                        + Caving
                                    </span>
                                    <span onclick="setAdventureActivity('Camping Alam Bebas')" class="cursor-pointer px-2.5 py-1 text-[11px] font-bold rounded-lg bg-amber-50 text-amber-800 border border-amber-200 hover:bg-amber-100">
                                        + Camping
                                    </span>
                                </div>
                                <input type="text" name="adventure_activity_type" id="adventure_activity_type" value="{{ old('adventure_activity_type', 'Trekking & Hiking') }}"
                                       class="w-full px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl outline-none text-xs font-semibold text-gray-800 focus:bg-white focus:border-amber-500"
                                       placeholder="Contoh: Trekking, Arung Jeram, Camping">
                            </div>

                            <!-- Perlengkapan Wajib / Disarankan -->
                            <div class="p-5 bg-white rounded-2xl border border-amber-100 shadow-sm space-y-2">
                                <label class="block text-xs font-black uppercase tracking-wider text-amber-800">
                                    Perlengkapan Wajib Peserta
                                </label>
                                <input type="text" name="adventure_gear" id="adventure_gear" value="{{ old('adventure_gear') }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none text-xs text-gray-800 focus:bg-white focus:border-amber-500"
                                       placeholder="Contoh: Sepatu trekking anti-selip, jaket tebal, dry bag, senter kepala">
                            </div>

                            <!-- Titik Kumpul / Basecamp -->
                            <div class="p-5 bg-white rounded-2xl border border-amber-100 shadow-sm space-y-2">
                                <label class="block text-xs font-black uppercase tracking-wider text-amber-800">
                                    Titik Kumpul / Basecamp Petualangan
                                </label>
                                <input type="text" name="adventure_meeting_point" id="adventure_meeting_point" value="{{ old('adventure_meeting_point') }}"
                                       class="w-full px-4 py-3 bg-gray-50 border border-gray-200 rounded-xl outline-none text-xs text-gray-800 focus:bg-white focus:border-amber-500"
                                       placeholder="Contoh: Basecamp Desa Sembalun / Pelabuhan Marina Labuan Bajo">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- FORM FIELDS: GENERAL DETAILS -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 pt-4">
                    <!-- Left Column -->
                    <div class="space-y-6">
                        <!-- Nama Layanan -->
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2">
                                Nama Layanan Paket <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fa-solid fa-suitcase-rolling"></i>
                                </span>
                                <input type="text" name="nama_layanan" value="{{ old('nama_layanan') }}" required
                                       class="w-full pl-11 pr-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none font-medium transition-all text-sm @error('nama_layanan') border-rose-500 bg-rose-50/20 @enderror"
                                       placeholder="Contoh: Phinisi Superior Labuan Bajo 3D2N">
                            </div>
                            @error('nama_layanan')<p class="mt-1.5 text-xs font-bold text-rose-500">{{ $message }}</p>@enderror
                        </div>

                        <!-- Lokasi Tujuan -->
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2">
                                Lokasi / Destinasi Utama <span class="text-rose-500">*</span>
                            </label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                                    <i class="fa-solid fa-location-dot"></i>
                                </span>
                                <input type="text" name="lokasi_tujuan" value="{{ old('lokasi_tujuan') }}" required
                                       class="w-full pl-11 pr-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none font-medium transition-all text-sm @error('lokasi_tujuan') border-rose-500 @enderror"
                                       placeholder="Contoh: Labuan Bajo, Nusa Tenggara Timur">
                            </div>
                            @error('lokasi_tujuan')<p class="mt-1.5 text-xs font-bold text-rose-500">{{ $message }}</p>@enderror
                        </div>

                        <!-- Deskripsi Layanan -->
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2">
                                Deskripsi Lengkap Paket <span class="text-rose-500">*</span>
                            </label>
                            <textarea name="deskripsi" rows="4" required
                                      class="w-full px-5 py-4 bg-gray-50 border border-gray-200 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none font-medium transition-all text-sm @error('deskripsi') border-rose-500 @enderror"
                                      placeholder="Jelaskan daya tarik, keunggulan, dan pengalaman yang didapatkan oleh peserta...">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')<p class="mt-1.5 text-xs font-bold text-rose-500">{{ $message }}</p>@enderror
                        </div>

                        <!-- Grid 3 Kolom: Harga, Durasi, Pax -->
                        <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                            <!-- Harga Mulai -->
                            <div class="bg-gray-50/70 p-4 rounded-2xl border border-gray-100">
                                <label class="block text-[11px] font-black uppercase tracking-wider text-gray-500 mb-1.5">
                                    Harga Mulai (Rp) <span class="text-rose-500">*</span>
                                </label>
                                <input type="number" name="harga_mulai" id="harga_mulai_input" value="{{ old('harga_mulai') }}" required min="0"
                                       class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-xl outline-none font-mono font-black text-indigo-600 focus:border-indigo-500 text-sm"
                                       placeholder="2500000" oninput="formatPricePreview(this.value)">
                                <p class="text-[10px] text-gray-400 mt-1 font-bold" id="harga-format-preview">Rp 0</p>
                            </div>

                            <!-- Durasi Hari -->
                            <div class="bg-gray-50/70 p-4 rounded-2xl border border-gray-100">
                                <label class="block text-[11px] font-black uppercase tracking-wider text-gray-500 mb-1.5">
                                    Durasi (Hari) <span class="text-rose-500">*</span>
                                </label>
                                <input type="number" name="durasi_hari" id="durasi_hari_input" value="{{ old('durasi_hari', 3) }}" required min="1"
                                       class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-xl outline-none font-black text-center text-gray-900 focus:border-indigo-500 text-sm">
                                <p class="text-[10px] text-gray-400 mt-1 text-center" id="durasi-format-preview">3 Hari 2 Malam</p>
                            </div>

                            <!-- Maks Pax -->
                            <div class="bg-gray-50/70 p-4 rounded-2xl border border-gray-100">
                                <label class="block text-[11px] font-black uppercase tracking-wider text-gray-500 mb-1.5">
                                    Kapasitas Pax <span class="text-rose-500">*</span>
                                </label>
                                <input type="number" name="maks_orang" value="{{ old('maks_orang', 15) }}" required min="1"
                                       class="w-full px-3 py-2.5 bg-white border border-gray-200 rounded-xl outline-none font-black text-center text-gray-900 focus:border-indigo-500 text-sm">
                                <p class="text-[10px] text-gray-400 mt-1 text-center">Maks Peserta</p>
                            </div>
                        </div>

                        <!-- Status Publikasi -->
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-2">Status Publikasi</label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="aktif" class="sr-only peer" {{ old('status', 'aktif') == 'aktif' ? 'checked' : '' }}>
                                    <div class="p-4 rounded-2xl border-2 border-gray-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50/50 flex items-center justify-between transition-all">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            <span class="text-xs font-black text-gray-800">AKTIF / TAMPIL</span>
                                        </div>
                                        <i class="fa-solid fa-check text-emerald-600 opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="status" value="nonaktif" class="sr-only peer" {{ old('status') == 'nonaktif' ? 'checked' : '' }}>
                                    <div class="p-4 rounded-2xl border-2 border-gray-200 peer-checked:border-rose-500 peer-checked:bg-rose-50/50 flex items-center justify-between transition-all">
                                        <div class="flex items-center gap-2.5">
                                            <span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span>
                                            <span class="text-xs font-black text-gray-800">NONAKTIF / DRAFT</span>
                                        </div>
                                        <i class="fa-solid fa-check text-rose-600 opacity-0 peer-checked:opacity-100 transition-opacity"></i>
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>

                    <!-- Right Column: Media Uploads -->
                    <div class="space-y-6">
                        <!-- Galeri Media Destinasi (Maks 5) -->
                        <div class="bg-gray-50/60 p-6 rounded-3xl border border-gray-100 space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-wider text-gray-700">
                                        Galeri Foto Destinasi
                                    </label>
                                    <span class="text-[11px] text-gray-400 font-medium">Unggah hingga maksimal 5 foto</span>
                                </div>
                                <span class="text-[10px] font-bold px-2.5 py-1 bg-indigo-50 text-indigo-600 rounded-full" id="gallery-count">
                                    0 / 5 Foto
                                </span>
                            </div>

                            <input type="file" id="gambar_destinasi" name="gambar_destinasi[]" multiple accept="image/*" class="hidden" onchange="previewImages(this)">
                            <label for="gambar_destinasi" class="flex flex-col items-center justify-center w-full h-36 bg-white border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:bg-indigo-50/40 hover:border-indigo-300 transition-all group">
                                <div class="w-10 h-10 rounded-2xl bg-indigo-50 text-indigo-500 flex items-center justify-center mb-2 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-cloud-arrow-up text-base"></i>
                                </div>
                                <span class="text-xs font-bold text-gray-600 group-hover:text-indigo-600">Klik untuk Pilih Foto Galeri</span>
                                <span class="text-[10px] text-gray-400 mt-0.5">JPG, PNG, WEBP (Maks. 5 MB / file)</span>
                            </label>

                            <!-- Size Recommendation Alert -->
                            <div class="flex items-start gap-2.5 p-3 bg-indigo-50/60 border border-indigo-100 rounded-xl text-[11px] text-indigo-800 leading-relaxed">
                                <i class="fa-solid fa-circle-info text-indigo-500 mt-0.5 shrink-0"></i>
                                <div>
                                    <span class="font-bold">Rekomendasi ukuran:</span> Format landscape <strong>1920 × 1080 px (16:9)</strong> untuk hasil terbaik di website.
                                </div>
                            </div>

                            <!-- Preview Grid -->
                            <div id="image-preview" class="grid grid-cols-3 sm:grid-cols-5 gap-2.5 empty:hidden"></div>
                        </div>

                        <!-- Gambar Tab Information -->
                        <div class="bg-gray-50/60 p-6 rounded-3xl border border-gray-100 space-y-4">
                            <div class="flex items-center justify-between">
                                <div>
                                    <label class="block text-xs font-black uppercase tracking-wider text-gray-700">
                                        Gambar Banner / Informasi Tab
                                    </label>
                                    <span class="text-[11px] text-gray-400 font-medium">Tampil di header detail tab informasi</span>
                                </div>
                                <span class="text-[10px] font-bold px-2 py-0.5 bg-amber-50 text-amber-700 rounded-md">Opsional</span>
                            </div>

                            <input type="file" id="information_image" name="information_image" accept="image/*" class="hidden" onchange="previewInfoImage(this)">
                            <label for="information_image" class="flex flex-col items-center justify-center w-full h-28 bg-white border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:bg-amber-50/40 hover:border-amber-300 transition-all group">
                                <div class="w-8 h-8 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center mb-1.5 group-hover:scale-110 transition-transform">
                                    <i class="fa-solid fa-image text-sm"></i>
                                </div>
                                <span class="text-xs font-bold text-gray-600 group-hover:text-amber-700">Pilih Banner Informasi</span>
                                <span class="text-[10px] text-gray-400 mt-0.5">Rekomendasi 1200 × 600 px (Landscape)</span>
                            </label>

                            <div id="info-image-preview" class="empty:hidden"></div>
                        </div>

                        <!-- Catatan Internal Admin -->
                        <div class="bg-slate-900 rounded-3xl p-6 text-white space-y-3">
                            <div class="flex items-center justify-between">
                                <h4 class="text-xs font-black uppercase tracking-wider text-amber-400 flex items-center gap-2">
                                    <i class="fa-solid fa-lock"></i>
                                    Catatan Internal Admin
                                </h4>
                                <span class="text-[10px] text-slate-400">Tidak tampil di publik</span>
                            </div>
                            <textarea name="catatan" rows="3" class="w-full bg-white/10 border border-white/10 rounded-2xl p-3.5 text-xs placeholder-white/30 text-white outline-none focus:border-amber-400/50" placeholder="Tuliskan catatan vendor, kontak pemandu, atau instruksi internal...">{{ old('catatan') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- STEP 2: Itinerary (Jadwal & Rute Hari)    -->
        <!-- ========================================== -->
        <div class="wizard-panel hidden" id="step-2">
            <div class="bg-white rounded-[2.5rem] p-6 md:p-10 shadow-sm border border-gray-100 mb-6 space-y-8">
                <!-- Header -->
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center font-black text-lg">
                            <i class="fa-solid fa-calendar-days"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-gray-900">Jadwal & Itinerary Per Hari</h3>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Rangkaian aktivitas harian yang otomatis tersinkron dengan durasi perjalanan</p>
                        </div>
                    </div>
                    <span class="hidden md:inline-flex px-3 py-1 bg-amber-50 text-amber-700 text-xs font-black rounded-full uppercase tracking-wider">
                        Langkah 2 / 4
                    </span>
                </div>

                <!-- Jam Mulai & Selesai -->
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-1.5 flex items-center gap-1.5">
                            <i class="fa-regular fa-clock text-indigo-500"></i>
                            Waktu Mulai Trip (Start Time)
                        </label>
                        <input type="text" name="start_time" value="{{ old('start_time', '10:00 AM') }}"
                               class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none font-bold text-gray-900 text-sm focus:border-indigo-500"
                               placeholder="Contoh: 10:00 AM">
                    </div>
                    <div class="p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <label class="block text-xs font-black uppercase tracking-wider text-gray-500 mb-1.5 flex items-center gap-1.5">
                            <i class="fa-regular fa-clock text-amber-500"></i>
                            Waktu Selesai Trip (Finish Time)
                        </label>
                        <input type="text" name="finish_time" value="{{ old('finish_time', '12:00 PM') }}"
                               class="w-full px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none font-bold text-gray-900 text-sm focus:border-amber-500"
                               placeholder="Contoh: 12:00 PM">
                    </div>
                </div>

                <!-- Itinerary Container (Auto Generated) -->
                <div id="itinerary-container" class="space-y-6">
                    <!-- Dynamic itinerary days will be injected here -->
                </div>

                <!-- Catatan Itinerary -->
                <div class="p-4 bg-amber-50/80 rounded-2xl border border-amber-200/70">
                    <label class="block text-xs font-black uppercase tracking-wider text-amber-900 mb-1.5 flex items-center gap-1.5">
                        <i class="fa-solid fa-triangle-exclamation text-amber-600"></i>
                        Catatan Itinerary (Tampil di Website)
                    </label>
                    <input type="text" name="itinerary_note" value="{{ old('itinerary_note', 'Itinerary Can Be Changed Due To Weather Conditions or Local Circumstances') }}"
                           class="w-full px-4 py-3 bg-white border border-amber-200 rounded-xl outline-none text-xs font-medium text-amber-900 focus:border-amber-500"
                           placeholder="Catatan penyesuaian jadwal cuaca dsb...">
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- STEP 3: Services & Pricing Options        -->
        <!-- ========================================== -->
        <div class="wizard-panel hidden" id="step-3">
            <div class="bg-white rounded-[2.5rem] p-6 md:p-10 shadow-sm border border-gray-100 mb-6 space-y-8">
                <!-- Header -->
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center font-black text-lg">
                            <i class="fa-solid fa-tags"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-gray-900">Fasilitas & Opsi Harga</h3>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Kelola paket include, exclude, titik destinasi, dan opsi variasi tarif</p>
                        </div>
                    </div>
                    <span class="hidden md:inline-flex px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-black rounded-full uppercase tracking-wider">
                        Langkah 3 / 4
                    </span>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <!-- 1. Include Services -->
                    <div class="p-6 rounded-3xl bg-emerald-50/50 border border-emerald-100 space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="text-xs font-black uppercase tracking-wider text-emerald-700 flex items-center gap-2">
                                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                                Include (Sudah Termasuk)
                            </label>
                            <span class="text-[10px] text-emerald-600 font-bold bg-white px-2 py-0.5 rounded-md border border-emerald-200">Fasilitas</span>
                        </div>
                        <div id="include-container" class="space-y-2.5">
                            <div class="include-item flex gap-2">
                                <input type="text" name="include_services[]" class="flex-1 px-4 py-3 bg-white border border-emerald-200 rounded-xl outline-none text-xs font-medium focus:ring-2 focus:ring-emerald-400/20" placeholder="Contoh: Pick Up & Drop Off Airport">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                            </div>
                            <div class="include-item flex gap-2">
                                <input type="text" name="include_services[]" class="flex-1 px-4 py-3 bg-white border border-emerald-200 rounded-xl outline-none text-xs font-medium focus:ring-2 focus:ring-emerald-400/20" placeholder="Contoh: Makan & Minum Selama Trip">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                            </div>
                        </div>
                        <button type="button" onclick="addInclude()" class="inline-flex items-center gap-1.5 text-xs font-black text-emerald-700 hover:text-emerald-800 bg-white px-4 py-2 rounded-xl border border-emerald-200 transition-all shadow-sm">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                            Tambah Poin Include
                        </button>
                    </div>

                    <!-- 2. Exclude Services -->
                    <div class="p-6 rounded-3xl bg-rose-50/50 border border-rose-100 space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="text-xs font-black uppercase tracking-wider text-rose-700 flex items-center gap-2">
                                <i class="fa-solid fa-circle-xmark text-rose-600"></i>
                                Exclude (Tidak Termasuk)
                            </label>
                            <span class="text-[10px] text-rose-600 font-bold bg-white px-2 py-0.5 rounded-md border border-rose-200">Biaya Luar</span>
                        </div>
                        <div id="exclude-container" class="space-y-2.5">
                            <div class="exclude-item flex gap-2">
                                <input type="text" name="exclude_services[]" class="flex-1 px-4 py-3 bg-white border border-rose-200 rounded-xl outline-none text-xs font-medium focus:ring-2 focus:ring-rose-400/20" placeholder="Contoh: Tiket Pesawat PP">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                            </div>
                            <div class="exclude-item flex gap-2">
                                <input type="text" name="exclude_services[]" class="flex-1 px-4 py-3 bg-white border border-rose-200 rounded-xl outline-none text-xs font-medium focus:ring-2 focus:ring-rose-400/20" placeholder="Contoh: Pengeluaran Pribadi & Tip Pemandu">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                            </div>
                        </div>
                        <button type="button" onclick="addExclude()" class="inline-flex items-center gap-1.5 text-xs font-black text-rose-700 hover:text-rose-800 bg-white px-4 py-2 rounded-xl border border-rose-200 transition-all shadow-sm">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                            Tambah Poin Exclude
                        </button>
                    </div>

                    <!-- 3. Destinations -->
                    <div class="p-6 rounded-3xl bg-sky-50/50 border border-sky-100 space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="text-xs font-black uppercase tracking-wider text-sky-700 flex items-center gap-2">
                                <i class="fa-solid fa-map-pin text-sky-600"></i>
                                Titik Destinasi Dikunjungi
                            </label>
                            <span class="text-[10px] text-sky-600 font-bold bg-white px-2 py-0.5 rounded-md border border-sky-200">Spot Wisata</span>
                        </div>
                        <div id="destinations-container" class="space-y-2.5">
                            <div class="destination-item flex gap-2">
                                <input type="text" name="destinations[]" class="flex-1 px-4 py-3 bg-white border border-sky-200 rounded-xl outline-none text-xs font-medium focus:ring-2 focus:ring-sky-400/20" placeholder="Contoh: Pulau Padar">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                            </div>
                            <div class="destination-item flex gap-2">
                                <input type="text" name="destinations[]" class="flex-1 px-4 py-3 bg-white border border-sky-200 rounded-xl outline-none text-xs font-medium focus:ring-2 focus:ring-sky-400/20" placeholder="Contoh: Pink Beach">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                            </div>
                        </div>
                        <button type="button" onclick="addDestination()" class="inline-flex items-center gap-1.5 text-xs font-black text-sky-700 hover:text-sky-800 bg-white px-4 py-2 rounded-xl border border-sky-200 transition-all shadow-sm">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                            Tambah Destinasi
                        </button>
                    </div>

                    <!-- 4. Pricing Options / Variasi Harga -->
                    <div class="p-6 rounded-3xl bg-indigo-50/50 border border-indigo-100 space-y-4">
                        <div class="flex items-center justify-between">
                            <label class="text-xs font-black uppercase tracking-wider text-indigo-700 flex items-center gap-2">
                                <i class="fa-solid fa-coins text-indigo-600"></i>
                                Opsi Harga / Variasi Tipe
                            </label>
                            <span class="text-[10px] text-indigo-600 font-bold bg-white px-2 py-0.5 rounded-md border border-indigo-200">Opsional</span>
                        </div>
                        <p class="text-[11px] text-gray-500 leading-relaxed font-medium">
                            Dapat diisi pilihan cabin, jenis kamar, atau skema tarif per rombongan kelompok.
                        </p>
                        <div id="pricing-container" class="space-y-2.5">
                            <div class="pricing-item flex gap-2">
                                <input type="text" name="pricing_types[]" class="flex-1 px-4 py-3 bg-white border border-indigo-200 rounded-xl outline-none text-xs font-medium" placeholder="Tipe / Nama Opsi (Contoh: Share Cabin 4 Pax)">
                                <input type="number" name="pricing_prices[]" class="w-36 px-4 py-3 bg-white border border-indigo-200 rounded-xl outline-none text-xs font-mono font-bold text-indigo-600" placeholder="Harga (Rp)">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                            </div>
                        </div>
                        <button type="button" onclick="addPricing()" class="inline-flex items-center gap-1.5 text-xs font-black text-indigo-700 hover:text-indigo-800 bg-white px-4 py-2 rounded-xl border border-indigo-200 transition-all shadow-sm">
                            <i class="fa-solid fa-plus text-[10px]"></i>
                            Tambah Opsi Harga
                        </button>
                    </div>
                </div>

                <!-- Fasilitas Umum (Legacy Support) -->
                <div class="pt-6 border-t border-gray-100">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-3">Fasilitas Umum Lainnya (Opsional)</label>
                    <div id="fasilitas-container" class="space-y-2">
                        <div class="fasilitas-item flex gap-2">
                            <input type="text" name="fasilitas[]" class="flex-1 px-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl outline-none text-xs font-medium" placeholder="Contoh: Air Mineral, P3K, Dokumentasi Foto">
                            <button type="button" onclick="removeItem(this)" class="w-9 h-9 bg-gray-100 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                        </div>
                    </div>
                    <button type="button" onclick="addFasilitas()" class="mt-2 text-xs font-bold text-gray-500 hover:text-gray-700">+ Tambah Fasilitas</button>
                </div>
            </div>
        </div>

        <!-- ========================================== -->
        <!-- STEP 4: Terms & Conditions                -->
        <!-- ========================================== -->
        <div class="wizard-panel hidden" id="step-4">
            <div class="bg-white rounded-[2.5rem] p-6 md:p-10 shadow-sm border border-gray-100 mb-6 space-y-8">
                <!-- Header -->
                <div class="flex items-center justify-between pb-6 border-b border-gray-100">
                    <div class="flex items-center gap-4">
                        <div class="w-12 h-12 bg-cyan-50 text-cyan-600 rounded-2xl flex items-center justify-center font-black text-lg">
                            <i class="fa-solid fa-file-contract"></i>
                        </div>
                        <div>
                            <h3 class="text-xl font-extrabold text-gray-900">Ketentuan & Kebijakan Tour</h3>
                            <p class="text-xs text-gray-400 font-medium mt-0.5">Syarat pendaftaran, kebijakan pembatalan, dan batasan tanggung jawab</p>
                        </div>
                    </div>
                    <span class="hidden md:inline-flex px-3 py-1 bg-cyan-50 text-cyan-700 text-xs font-black rounded-full uppercase tracking-wider">
                        Langkah 4 / 4
                    </span>
                </div>

                <div class="space-y-6">
                    <!-- Registration & Payment -->
                    <div class="p-6 rounded-3xl bg-cyan-50/40 border border-cyan-100 space-y-3">
                        <label class="block text-xs font-black uppercase tracking-wider text-cyan-800 flex items-center gap-2">
                            <i class="fa-solid fa-clipboard-check text-cyan-600"></i>
                            Pendaftaran & Pembayaran (Registration & Payment)
                        </label>
                        <div id="registration-container" class="space-y-2">
                            <div class="reg-item flex gap-2">
                                <input type="text" name="terms_registration[]" class="flex-1 px-4 py-3 bg-white border border-cyan-200 rounded-xl outline-none text-xs font-medium" placeholder="Once you book the trip, we assume you already understand our policy.">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                            </div>
                        </div>
                        <button type="button" onclick="addRegistration()" class="text-xs font-bold text-cyan-700 hover:text-cyan-800">+ Tambah Poin Pendaftaran</button>
                    </div>

                    <!-- Cancelation -->
                    <div class="p-6 rounded-3xl bg-amber-50/40 border border-amber-100 space-y-3">
                        <label class="block text-xs font-black uppercase tracking-wider text-amber-800 flex items-center gap-2">
                            <i class="fa-solid fa-triangle-exclamation text-amber-600"></i>
                            Kebijakan Pembatalan (Cancelation Policy)
                        </label>
                        <div id="cancelation-container" class="space-y-2">
                            <div class="cancel-item flex gap-2">
                                <input type="text" name="terms_cancelation[]" class="flex-1 px-4 py-3 bg-white border border-amber-200 rounded-xl outline-none text-xs font-medium" placeholder="Pembatalan sebelum H-7 dikenakan biaya administrasi 50%.">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                            </div>
                        </div>
                        <button type="button" onclick="addCancelation()" class="text-xs font-bold text-amber-700 hover:text-amber-800">+ Tambah Poin Pembatalan</button>
                    </div>

                    <!-- Not Responsible For -->
                    <div class="p-6 rounded-3xl bg-slate-50 border border-slate-200 space-y-3">
                        <label class="block text-xs font-black uppercase tracking-wider text-slate-700 flex items-center gap-2">
                            <i class="fa-solid fa-ban text-slate-500"></i>
                            Di Luar Tanggung Jawab (We Are Not Responsible For)
                        </label>
                        <div id="notresponsible-container" class="space-y-2">
                            <div class="notresp-item flex gap-2">
                                <input type="text" name="terms_not_responsible[]" class="flex-1 px-4 py-3 bg-white border border-slate-200 rounded-xl outline-none text-xs font-medium" placeholder="Keterlambatan / perubahan jadwal akibat faktor cuaca buruk atau force majeure.">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                            </div>
                        </div>
                        <button type="button" onclick="addNotResponsible()" class="text-xs font-bold text-slate-600 hover:text-slate-800">+ Tambah Poin Tanggung Jawab</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sticky Wizard Navigation Controls -->
        <div class="sticky bottom-6 z-30 bg-white/95 backdrop-blur-md p-4 md:p-5 rounded-3xl border border-gray-200 shadow-xl flex items-center justify-between gap-4">
            <button type="button" id="prev-btn" onclick="prevStep()" class="hidden px-6 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-2xl font-black text-xs uppercase tracking-wider transition-all flex items-center gap-2">
                <i class="fa-solid fa-arrow-left"></i>
                Sebelumnya
            </button>
            
            <div class="flex items-center gap-2 text-xs font-bold text-gray-400">
                <span id="step-counter-text">Langkah 1 dari 4: Info Dasar</span>
            </div>

            <div class="flex items-center gap-3">
                <button type="button" id="next-btn" onclick="nextStep()" class="px-8 py-3.5 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-black text-xs uppercase tracking-wider shadow-lg shadow-indigo-200 transition-all flex items-center gap-2">
                    <span>Selanjutnya</span>
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                <button type="submit" id="submit-btn" class="hidden px-8 py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-black text-xs uppercase tracking-wider shadow-lg shadow-emerald-200 transition-all flex items-center gap-2">
                    <i class="fa-solid fa-check"></i>
                    Simpan Layanan
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    /* Inactive / Default Step Circle (Sharp, crisp, high contrast) */
    .wizard-step .step-circle {
        background-color: #ffffff !important;
        border: 2.5px solid #cbd5e1 !important;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }
    .wizard-step .step-circle .step-num {
        color: #1e293b !important; /* Slate-800: sharp & dark */
        font-weight: 900 !important;
        font-size: 1.1rem !important;
        display: block !important;
        line-height: 1 !important;
        -webkit-font-smoothing: antialiased;
    }
    .wizard-step .step-circle i {
        display: none !important;
    }
    .wizard-step .step-label {
        color: #64748b !important; /* Slate-500 */
        font-weight: 700 !important;
    }

    /* Active Step Circle */
    .wizard-step.active .step-circle {
        background: #4f46e5 !important;
        border-color: #4338ca !important;
        box-shadow: 0 10px 25px -4px rgba(79, 70, 229, 0.5), 0 0 0 5px rgba(99, 102, 241, 0.2) !important;
        transform: scale(1.08);
    }
    .wizard-step.active .step-circle .step-num {
        color: #ffffff !important; /* Bright pure white on purple/indigo */
        font-weight: 900 !important;
        font-size: 1.15rem !important;
        display: block !important;
        line-height: 1 !important;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.25);
    }
    .wizard-step.active .step-label {
        color: #4338ca !important;
        font-weight: 900 !important;
    }

    /* Completed Step Circle */
    .wizard-step.completed .step-circle {
        background: #059669 !important;
        border-color: #047857 !important;
        box-shadow: 0 4px 12px rgba(5, 150, 105, 0.3) !important;
        transform: scale(1);
    }
    .wizard-step.completed .step-circle .step-num {
        display: none !important;
    }
    .wizard-step.completed .step-circle i {
        display: block !important;
        color: #ffffff !important;
        font-size: 1rem !important;
        line-height: 1 !important;
    }
    .wizard-step.completed .step-label {
        color: #059669 !important;
        font-weight: 800 !important;
    }
</style>

<script>
let currentStep = 1;
const totalSteps = 4;
const stepTitles = [
    'Info Dasar & Kategori',
    'Jadwal & Itinerary',
    'Fasilitas & Opsi Harga',
    'Ketentuan & Kebijakan'
];

// Service Type Selector Function
function selectServiceType(type) {
    const select = document.getElementById('jenis_layanan_select');
    select.value = type;

    // Update Visual Cards
    document.querySelectorAll('#service-type-grid .service-card').forEach(card => {
        card.classList.remove('border-emerald-500', 'border-amber-500', 'border-indigo-500', 'border-purple-500', 'ring-4', 'ring-emerald-100', 'ring-amber-100', 'ring-indigo-100', 'ring-purple-100', 'shadow-md');
        card.classList.add('border-gray-100');
    });

    const activeIndex = {
        'corporate_trip': 0,
        'adventure_trip': 1,
        'edu_trip': 2,
        'open_trip': 3
    }[type];

    const cards = document.querySelectorAll('#service-type-grid .service-card');
    if (cards[activeIndex]) {
        const themeConfig = {
            'corporate_trip': ['border-emerald-500', 'ring-emerald-100'],
            'adventure_trip': ['border-amber-500', 'ring-amber-100'],
            'edu_trip': ['border-indigo-500', 'ring-indigo-100'],
            'open_trip': ['border-purple-500', 'ring-purple-100']
        }[type];
        cards[activeIndex].classList.remove('border-gray-100');
        cards[activeIndex].classList.add(themeConfig[0], 'ring-4', themeConfig[1], 'shadow-md');
    }

    // Toggle Dynamic Panels
    const eduBox = document.getElementById('edu-pricing-box');
    const advBox = document.getElementById('adventure-box');

    if (type === 'edu_trip') {
        eduBox.classList.remove('hidden');
        advBox.classList.add('hidden');
        syncEduPricing();
    } else if (type === 'adventure_trip') {
        advBox.classList.remove('hidden');
        eduBox.classList.add('hidden');
    } else {
        eduBox.classList.add('hidden');
        advBox.classList.add('hidden');
    }
}

// Helper: sync Edukasi prices to Step 3 and base price
function syncEduPricing() {
    const perOrang = parseFloat(document.getElementById('edu_harga_per_orang').value) || 0;
    const perKelompok = parseFloat(document.getElementById('edu_harga_per_kelompok').value) || 0;
    const catatan = document.getElementById('edu_catatan_kelompok').value.trim();

    // Format previews
    document.getElementById('preview-edu-per-orang').textContent = 'Preview: Rp ' + perOrang.toLocaleString('id-ID');
    document.getElementById('preview-edu-per-kelompok').textContent = 'Preview: Rp ' + perKelompok.toLocaleString('id-ID');

    // Auto set base price if empty or Edukasi active
    const hargaMulaiInput = document.getElementById('harga_mulai_input');
    if (perOrang > 0 && (!hargaMulaiInput.value || hargaMulaiInput.value == 0)) {
        hargaMulaiInput.value = perOrang;
        formatPricePreview(perOrang);
    }

    // Sync to pricing options in Step 3
    const container = document.getElementById('pricing-container');
    if (document.getElementById('jenis_layanan_select').value === 'edu_trip' && (perOrang > 0 || perKelompok > 0)) {
        let html = '';
        if (perOrang > 0) {
            html += `
                <div class="pricing-item flex gap-2">
                    <input type="text" name="pricing_types[]" value="Per Orang" class="flex-1 px-4 py-3 bg-white border border-indigo-200 rounded-xl outline-none text-xs font-bold text-indigo-900">
                    <input type="number" name="pricing_prices[]" value="${perOrang}" class="w-36 px-4 py-3 bg-white border border-indigo-200 rounded-xl outline-none text-xs font-mono font-bold text-indigo-600">
                    <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                </div>
            `;
        }
        if (perKelompok > 0) {
            const label = 'Per Kelompok' + (catatan ? ' (' + catatan + ')' : '');
            html += `
                <div class="pricing-item flex gap-2">
                    <input type="text" name="pricing_types[]" value="${label}" class="flex-1 px-4 py-3 bg-white border border-indigo-200 rounded-xl outline-none text-xs font-bold text-indigo-900">
                    <input type="number" name="pricing_prices[]" value="${perKelompok}" class="w-36 px-4 py-3 bg-white border border-indigo-200 rounded-xl outline-none text-xs font-mono font-bold text-indigo-600">
                    <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                </div>
            `;
        }
        container.innerHTML = html;
    }
}

// Adventure Helpers
function setAdventureDifficulty(diff) {
    document.getElementById('adventure_difficulty').value = diff;
}
function setAdventureActivity(act) {
    const input = document.getElementById('adventure_activity_type');
    input.value = act;
}

// Price and Duration Previews
function formatPricePreview(val) {
    const num = parseFloat(val) || 0;
    document.getElementById('harga-format-preview').textContent = 'Rp ' + num.toLocaleString('id-ID');
}

document.getElementById('durasi_hari_input').addEventListener('input', function() {
    const days = parseInt(this.value) || 1;
    const nights = Math.max(0, days - 1);
    document.getElementById('durasi-format-preview').textContent = `${days} Hari ${nights} Malam`;
});

// Wizard Functions
function updateWizard() {
    // Update panels
    document.querySelectorAll('.wizard-panel').forEach((p, i) => {
        p.classList.toggle('hidden', i + 1 !== currentStep);
    });
    
    // Update step indicators
    document.querySelectorAll('.wizard-step').forEach((s, i) => {
        s.classList.remove('active', 'completed');
        if (i + 1 < currentStep) s.classList.add('completed');
        if (i + 1 === currentStep) s.classList.add('active');
    });
    
    // Update progress bar
    document.getElementById('progress-bar').style.width = ((currentStep - 1) / (totalSteps - 1) * 100) + '%';
    
    // Update navigation text & buttons
    document.getElementById('step-counter-text').textContent = `Langkah ${currentStep} dari ${totalSteps}: ${stepTitles[currentStep - 1]}`;
    document.getElementById('prev-btn').classList.toggle('hidden', currentStep === 1);
    document.getElementById('next-btn').classList.toggle('hidden', currentStep === totalSteps);
    document.getElementById('submit-btn').classList.toggle('hidden', currentStep !== totalSteps);

    // Scroll to top of form
    window.scrollTo({ top: 120, behavior: 'smooth' });
}

function nextStep() {
    // Basic validation before advancing from Step 1
    if (currentStep === 1) {
        const nama = document.querySelector('input[name="nama_layanan"]').value.trim();
        const lokasi = document.querySelector('input[name="lokasi_tujuan"]').value.trim();
        const jenis = document.getElementById('jenis_layanan_select').value;
        const harga = document.querySelector('input[name="harga_mulai"]').value;

        if (!nama || !lokasi || !jenis || !harga) {
            alert('Mohon lengkapi Nama Layanan, Lokasi Tujuan, Jenis Layanan, dan Harga Mulai sebelum lanjut.');
            return;
        }
    }

    if (currentStep < totalSteps) {
        currentStep++;
        updateWizard();
        if (currentStep === 2) generateItinerary();
    }
}

function prevStep() {
    if (currentStep > 1) {
        currentStep--;
        updateWizard();
    }
}

function goToStep(step) {
    if (step <= currentStep || step === currentStep + 1) {
        currentStep = step;
        updateWizard();
        if (currentStep === 2) generateItinerary();
    }
}

// Generate Itinerary per Day
function generateItinerary() {
    const days = parseInt(document.getElementById('durasi_hari_input').value) || 3;
    const container = document.getElementById('itinerary-container');
    if (container.children.length === days) return;
    
    container.innerHTML = '';
    for (let d = 1; d <= days; d++) {
        container.innerHTML += `
            <div class="itinerary-day bg-gray-50/70 border border-gray-100 rounded-3xl p-6 md:p-8 space-y-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <span class="px-4 py-1.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-black rounded-xl text-xs uppercase tracking-wider shadow-sm">
                            Hari Ke-${d}
                        </span>
                        <span class="text-xs text-gray-400 font-bold">Rangkaian Aktivitas Hari ${d}</span>
                    </div>
                </div>
                <div id="day-${d}-activities" class="space-y-2.5">
                    <div class="activity-item flex gap-2">
                        <input type="text" name="itinerary[${d-1}][activities][]" class="flex-1 px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none text-xs font-medium focus:border-amber-500 focus:ring-2 focus:ring-amber-200" placeholder="Aktivitas (Contoh: Penjemputan di Bandara & Check-in)">
                        <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
                    </div>
                </div>
                <input type="hidden" name="itinerary[${d-1}][day]" value="${d}">
                <button type="button" onclick="addActivity(${d})" class="inline-flex items-center gap-1.5 text-xs font-bold text-amber-700 hover:text-amber-800 bg-white px-4 py-2 rounded-xl border border-amber-200 transition-all shadow-sm">
                    <i class="fa-solid fa-plus text-[10px]"></i>
                    Tambah Aktivitas Hari Ke-${d}
                </button>
            </div>
        `;
    }
}

function addActivity(day) {
    const container = document.getElementById(`day-${day}-activities`);
    const div = document.createElement('div');
    div.className = 'activity-item flex gap-2';
    div.innerHTML = `
        <input type="text" name="itinerary[${day-1}][activities][]" class="flex-1 px-4 py-3 bg-white border border-gray-200 rounded-xl outline-none text-xs font-medium focus:border-amber-500 focus:ring-2 focus:ring-amber-200" placeholder="Aktivitas berikutnya...">
        <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
    `;
    container.appendChild(div);
}

function removeItem(btn) {
    const container = btn.closest('[id$="-container"], [id^="day-"]');
    if (container.children.length > 1) {
        btn.parentElement.remove();
    } else {
        const input = btn.previousElementSibling;
        if (input) input.value = '';
    }
}

// Dynamic Add Item Helpers
function addInclude() { addDynamicItem('include-container', 'include_services[]', 'include-item', 'border-emerald-200 focus:ring-emerald-400/20', 'Layanan yang termasuk...'); }
function addExclude() { addDynamicItem('exclude-container', 'exclude_services[]', 'exclude-item', 'border-rose-200 focus:ring-rose-400/20', 'Layanan yang tidak termasuk...'); }
function addDestination() { addDynamicItem('destinations-container', 'destinations[]', 'destination-item', 'border-sky-200 focus:ring-sky-400/20', 'Destinasi yang dikunjungi...'); }
function addFasilitas() { addDynamicItem('fasilitas-container', 'fasilitas[]', 'fasilitas-item', 'border-gray-200', 'Fasilitas tambahan...'); }
function addRegistration() { addDynamicItem('registration-container', 'terms_registration[]', 'reg-item', 'border-cyan-200', 'Ketentuan pendaftaran...'); }
function addCancelation() { addDynamicItem('cancelation-container', 'terms_cancelation[]', 'cancel-item', 'border-amber-200', 'Ketentuan pembatalan...'); }
function addNotResponsible() { addDynamicItem('notresponsible-container', 'terms_not_responsible[]', 'notresp-item', 'border-slate-200', 'Bukan tanggung jawab kami...'); }

function addPricing() {
    const container = document.getElementById('pricing-container');
    const div = document.createElement('div');
    div.className = 'pricing-item flex gap-2';
    div.innerHTML = `
        <input type="text" name="pricing_types[]" class="flex-1 px-4 py-3 bg-white border border-indigo-200 rounded-xl outline-none text-xs font-medium" placeholder="Tipe / Opsi...">
        <input type="number" name="pricing_prices[]" class="w-36 px-4 py-3 bg-white border border-indigo-200 rounded-xl outline-none text-xs font-mono font-bold text-indigo-600" placeholder="Harga (Rp)">
        <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
    `;
    container.appendChild(div);
}

function addDynamicItem(containerId, inputName, itemClass, borderClass, placeholder) {
    const container = document.getElementById(containerId);
    const div = document.createElement('div');
    div.className = itemClass + ' flex gap-2';
    div.innerHTML = `
        <input type="text" name="${inputName}" class="flex-1 px-4 py-3 bg-white border ${borderClass} rounded-xl outline-none text-xs font-medium focus:ring-2" placeholder="${placeholder}">
        <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-white text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl border border-gray-100 transition-all font-bold">×</button>
    `;
    container.appendChild(div);
}

// Media Preview Functions
function previewImages(input) {
    const preview = document.getElementById('image-preview');
    const countBadge = document.getElementById('gallery-count');
    preview.innerHTML = '';
    
    if (input.files && input.files.length > 0) {
        if (input.files.length > 5) {
            alert('Maksimal 5 foto destinasi yang diizinkan!');
            input.value = '';
            countBadge.textContent = '0 / 5 Foto';
            return;
        }

        countBadge.textContent = `${input.files.length} / 5 Foto`;
        Array.from(input.files).forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = e => {
                preview.innerHTML += `
                    <div class="relative aspect-video rounded-xl overflow-hidden border border-gray-200 shadow-sm group">
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white text-[10px] font-bold">
                            Foto #${idx + 1}
                        </div>
                    </div>
                `;
            };
            reader.readAsDataURL(file);
        });
    } else {
        countBadge.textContent = '0 / 5 Foto';
    }
}

function previewInfoImage(input) {
    const preview = document.getElementById('info-image-preview');
    preview.innerHTML = '';
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            preview.innerHTML = `
                <div class="relative rounded-2xl overflow-hidden border border-amber-200 h-28 shadow-sm">
                    <img src="${e.target.result}" class="w-full h-full object-cover">
                </div>
            `;
        };
        reader.readAsDataURL(input.files[0]);
    }
}

// On Page Load Initialization
document.addEventListener('DOMContentLoaded', () => {
    // Initial service type selection
    const initialType = '{{ old("jenis_layanan", "open_trip") }}';
    selectServiceType(initialType);

    // Initial price preview
    const initialPrice = document.getElementById('harga_mulai_input').value;
    if (initialPrice) formatPricePreview(initialPrice);

    // Initial duration preview
    const initialDays = document.getElementById('durasi_hari_input').value;
    if (initialDays) {
        const nights = Math.max(0, parseInt(initialDays) - 1);
        document.getElementById('durasi-format-preview').textContent = `${initialDays} Hari ${nights} Malam`;
    }

    updateWizard();
});
</script>

@include('admin.Layanan.partials.import-modal')
@endsection
