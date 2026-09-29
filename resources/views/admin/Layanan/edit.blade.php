@extends('admin.layouts.main')

@section('container')
<div class="mt-20 pb-10 antialiased text-gray-900 px-4 md:px-8">
    <!-- Breadcrumbs & Header -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-sm text-gray-400 font-bold uppercase tracking-wider mb-4">
            <a href="{{ route('admin.layanan.index') }}" class="hover:text-indigo-600 transition-colors">Daftar Layanan</a>
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            <span class="text-gray-900">Edit: {{ $layanan->nama_layanan }}</span>
        </div>
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">Edit Layanan</h1>
                <p class="text-gray-500 font-medium">Perbarui informasi paket travel.</p>
            </div>
            <a href="{{ route('admin.layanan.index') }}" class="inline-flex items-center gap-2 text-gray-500 hover:text-gray-900 font-bold transition-all px-4 py-2 rounded-xl hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                Batal
            </a>
        </div>
    </div>

    <!-- Wizard Steps Indicator -->
    <div class="max-w-5xl mx-auto mb-10">
        <div class="flex items-center justify-between relative">
            <div class="absolute left-0 right-0 top-1/2 h-1 bg-gray-200 -translate-y-1/2 z-0"></div>
            <div class="absolute left-0 top-1/2 h-1 bg-indigo-500 -translate-y-1/2 z-0 transition-all duration-500" id="progress-bar" style="width: 0%"></div>
            
            @foreach(['Info Dasar', 'Itinerary', 'Services', 'Terms'] as $i => $label)
            <div class="wizard-step {{ $i === 0 ? 'active' : '' }} relative z-10 flex flex-col items-center cursor-pointer" onclick="goToStep({{ $i + 1 }})">
                <div class="step-circle w-12 h-12 rounded-full {{ $i === 0 ? 'bg-indigo-600 text-white' : 'bg-gray-200 text-gray-500' }} flex items-center justify-center font-black text-lg shadow-lg">{{ $i + 1 }}</div>
                <span class="mt-2 text-xs font-bold {{ $i === 0 ? 'text-indigo-600' : 'text-gray-400' }} uppercase tracking-wider hidden sm:block">{{ $label }}</span>
            </div>
            @endforeach
        </div>
    </div>

    <form action="{{ route('admin.layanan.update', $layanan->layanan_id) }}" method="POST" enctype="multipart/form-data" id="wizard-form" class="max-w-5xl mx-auto">
        @csrf
        @method('PUT')

        <!-- STEP 1: Basic Information -->
        <div class="wizard-panel" id="step-1">
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 mb-6">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center font-black">01</div>
                    <h3 class="text-xl font-extrabold text-gray-900">Informasi Dasar & Media</h3>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div class="space-y-6">
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Nama Layanan <span class="text-rose-500">*</span></label>
                            <input type="text" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}" required
                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none font-medium">
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Jenis Layanan <span class="text-rose-500">*</span></label>
                                <select name="jenis_layanan" required class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none font-medium">
                                    @foreach($jenisLayananOptions as $key => $label)
                                        <option value="{{ $key }}" {{ old('jenis_layanan', $layanan->jenis_layanan) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Lokasi <span class="text-rose-500">*</span></label>
                                <input type="text" name="lokasi_tujuan" value="{{ old('lokasi_tujuan', $layanan->lokasi_tujuan) }}" required class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none font-medium">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Deskripsi</label>
                            <textarea name="deskripsi" rows="4" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none font-medium">{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                        </div>

                        <div class="grid grid-cols-3 gap-4">
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Harga (Rp)</label>
                                <input type="number" name="harga_mulai" value="{{ old('harga_mulai', $layanan->harga_mulai) }}" required min="0" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none font-mono font-bold text-indigo-600">
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Durasi</label>
                                <input type="number" name="durasi_hari" id="durasi_hari_input" value="{{ old('durasi_hari', $layanan->durasi_hari) }}" required min="1" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none font-bold text-center">
                            </div>
                            <div>
                                <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Maks Pax</label>
                                <input type="number" name="maks_orang" value="{{ old('maks_orang', $layanan->maks_orang) }}" required min="1" class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl outline-none font-bold text-center">
                            </div>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Status</label>
                            <select name="status" class="w-full px-5 py-4 bg-gray-900 text-white rounded-2xl outline-none font-bold">
                                <option value="aktif" {{ old('status', $layanan->status) == 'aktif' ? 'selected' : '' }}>🟢 AKTIF</option>
                                <option value="nonaktif" {{ old('status', $layanan->status) == 'nonaktif' ? 'selected' : '' }}>🔴 NONAKTIF</option>
                            </select>
                        </div>
                    </div>

                    <div class="space-y-6">
                        <!-- Existing Images -->
                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Galeri Saat Ini</label>
                            <div id="existing-images" class="grid grid-cols-3 gap-2 mb-3">
                                @if($layanan->gambar_destinasi)
                                    @foreach($layanan->gambar_destinasi as $img)
                                    <div class="relative aspect-square rounded-xl overflow-hidden border group">
                                        <img src="{{ asset('storage/' . $img) }}" class="w-full h-full object-cover">
                                        <input type="hidden" name="existing_images[]" value="{{ $img }}">
                                        <button type="button" onclick="removeExistingImage(this)" class="absolute top-1 right-1 w-6 h-6 bg-rose-500 text-white rounded-full opacity-0 group-hover:opacity-100 transition-opacity text-xs">×</button>
                                    </div>
                                    @endforeach
                                @endif
                            </div>
                            <input type="file" id="gambar_destinasi" name="gambar_destinasi[]" multiple accept="image/*" class="hidden" onchange="previewImages(this)">
                            <label for="gambar_destinasi" class="flex flex-col items-center justify-center w-full h-24 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:bg-indigo-50/50 hover:border-indigo-200 transition-all">
                                <span class="text-xs font-bold text-gray-400 uppercase">+ Tambah Foto</span>
                                <span class="text-[10px] text-gray-300 mt-1">Maks. 5 foto total</span>
                            </label>
                            <!-- Note ukuran gambar destinasi -->
                            <div class="mt-2 flex items-start gap-2 px-3 py-2 bg-indigo-50 border border-indigo-100 rounded-xl">
                                <svg class="w-4 h-4 text-indigo-400 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div class="text-[10px] text-indigo-700 leading-relaxed">
                                    <span class="font-black">Rekomendasi ukuran:</span> Lebar <span class="font-bold">1920 &times; 1080 px</span> (landscape/16:9) atau <span class="font-bold">1080 &times; 1080 px</span> (kotak). Format: JPG/PNG/WEBP. Maks. <span class="font-bold">2 MB</span> per foto.
                                </div>
                            </div>
                            <div id="image-preview" class="grid grid-cols-3 gap-2 mt-2"></div>
                        </div>

                        <div>
                            <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Gambar Tab Information</label>
                            @if($layanan->information_image)
                            <div class="rounded-xl overflow-hidden border h-24 mb-2">
                                <img src="{{ asset('storage/' . $layanan->information_image) }}" class="w-full h-full object-cover">
                            </div>
                            @endif
                            <input type="file" id="information_image" name="information_image" accept="image/*" class="hidden" onchange="previewInfoImage(this)">
                            <label for="information_image" class="flex flex-col items-center justify-center w-full h-20 bg-gray-50 border-2 border-dashed border-gray-200 rounded-2xl cursor-pointer hover:bg-amber-50/50 hover:border-amber-200 transition-all">
                                <span class="text-xs font-bold text-gray-400 uppercase">Ganti Gambar Info</span>
                            </label>
                            <!-- Note ukuran gambar info -->
                            <div class="mt-2 flex items-start gap-2 px-3 py-2 bg-amber-50 border border-amber-100 rounded-xl">
                                <svg class="w-4 h-4 text-amber-500 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                <div class="text-[10px] text-amber-700 leading-relaxed">
                                    <span class="font-black">Gambar informasi</span> ditampilkan full-width di tab Informasi. Rekomendasi: <span class="font-bold">1200 &times; 600 px</span> (landscape/2:1). Format: JPG/PNG/WEBP. Maks. <span class="font-bold">2 MB</span>.
                                </div>
                            </div>
                            <div id="info-image-preview" class="mt-2"></div>
                        </div>

                        <div class="bg-indigo-900 rounded-2xl p-6 text-white">
                            <h4 class="text-sm font-bold mb-3">Catatan Internal</h4>
                            <textarea name="catatan" rows="3" class="w-full bg-white/10 border-none rounded-xl p-3 text-sm placeholder-white/30 outline-none">{{ old('catatan', $layanan->catatan) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- STEP 2: Itinerary -->
        <div class="wizard-panel hidden" id="step-2">
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 mb-6">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-amber-50 text-amber-600 rounded-xl flex items-center justify-center font-black">02</div>
                    <h3 class="text-xl font-extrabold text-gray-900">Itinerary Per Hari</h3>
                </div>

                <div class="grid grid-cols-2 gap-4 mb-6">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Start Trip</label>
                        <input type="text" name="start_time" value="{{ old('start_time', $layanan->start_time ?? '10 AM') }}" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-xl outline-none font-medium">
                    </div>
                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Finish Trip</label>
                        <input type="text" name="finish_time" value="{{ old('finish_time', $layanan->finish_time ?? '12 AM') }}" class="w-full px-5 py-3 bg-gray-50 border border-gray-100 rounded-xl outline-none font-medium">
                    </div>
                </div>

                <div id="itinerary-container" class="space-y-6"></div>

                <div class="mt-6">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-2">Catatan Itinerary</label>
                    <input type="text" name="itinerary_note" value="{{ old('itinerary_note', $layanan->itinerary_note ?? 'Itinerary Can Be Change Due To Weather Conditions') }}" class="w-full px-5 py-3 bg-amber-50 border border-amber-100 rounded-xl outline-none font-medium text-amber-700">
                </div>
            </div>
        </div>

        <!-- STEP 3: Services -->
        <div class="wizard-panel hidden" id="step-3">
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 mb-6">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center font-black">03</div>
                    <h3 class="text-xl font-extrabold text-gray-900">Services & Pricing</h3>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-emerald-600 mb-3">✓ Include</label>
                        <div id="include-container" class="space-y-2">
                            @forelse($layanan->include_services ?? [] as $item)
                            <div class="include-item flex gap-2">
                                <input type="text" name="include_services[]" value="{{ $item }}" class="flex-1 px-4 py-3 bg-emerald-50 border border-emerald-100 rounded-xl outline-none text-sm">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @empty
                            <div class="include-item flex gap-2">
                                <input type="text" name="include_services[]" class="flex-1 px-4 py-3 bg-emerald-50 border border-emerald-100 rounded-xl outline-none text-sm" placeholder="Include...">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addInclude()" class="mt-3 text-sm font-bold text-emerald-600">+ Tambah</button>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-rose-600 mb-3">✗ Exclude</label>
                        <div id="exclude-container" class="space-y-2">
                            @forelse($layanan->exclude_services ?? [] as $item)
                            <div class="exclude-item flex gap-2">
                                <input type="text" name="exclude_services[]" value="{{ $item }}" class="flex-1 px-4 py-3 bg-rose-50 border border-rose-100 rounded-xl outline-none text-sm">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @empty
                            <div class="exclude-item flex gap-2">
                                <input type="text" name="exclude_services[]" class="flex-1 px-4 py-3 bg-rose-50 border border-rose-100 rounded-xl outline-none text-sm" placeholder="Exclude...">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addExclude()" class="mt-3 text-sm font-bold text-rose-600">+ Tambah</button>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-blue-600 mb-3">📍 Destinations</label>
                        <div id="destinations-container" class="space-y-2">
                            @forelse($layanan->destinations ?? [] as $item)
                            <div class="destination-item flex gap-2">
                                <input type="text" name="destinations[]" value="{{ $item }}" class="flex-1 px-4 py-3 bg-blue-50 border border-blue-100 rounded-xl outline-none text-sm">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @empty
                            <div class="destination-item flex gap-2">
                                <input type="text" name="destinations[]" class="flex-1 px-4 py-3 bg-blue-50 border border-blue-100 rounded-xl outline-none text-sm" placeholder="Destination...">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addDestination()" class="mt-3 text-sm font-bold text-blue-600">+ Tambah</button>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-indigo-600 mb-3">💰 Pricing Options</label>
                        <div id="pricing-container" class="space-y-2">
                            @forelse($layanan->pricing_options ?? [] as $opt)
                            <div class="pricing-item flex gap-2">
                                <input type="text" name="pricing_types[]" value="{{ $opt['type'] }}" class="flex-1 px-4 py-3 bg-indigo-50 border border-indigo-100 rounded-xl outline-none text-sm">
                                <input type="number" name="pricing_prices[]" value="{{ $opt['price'] }}" class="w-32 px-4 py-3 bg-indigo-50 border border-indigo-100 rounded-xl outline-none text-sm font-mono">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @empty
                            <div class="pricing-item flex gap-2">
                                <input type="text" name="pricing_types[]" class="flex-1 px-4 py-3 bg-indigo-50 border border-indigo-100 rounded-xl outline-none text-sm" placeholder="Type...">
                                <input type="number" name="pricing_prices[]" class="w-32 px-4 py-3 bg-indigo-50 border border-indigo-100 rounded-xl outline-none text-sm font-mono" placeholder="Price">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addPricing()" class="mt-3 text-sm font-bold text-indigo-600">+ Tambah</button>
                    </div>
                </div>

                <!-- Fasilitas Legacy -->
                <div class="mt-8 pt-8 border-t border-gray-100">
                    <label class="block text-xs font-black uppercase tracking-wider text-gray-400 mb-3">Fasilitas (Legacy)</label>
                    <div id="fasilitas-container" class="space-y-2">
                        @forelse($layanan->fasilitas ?? [] as $f)
                        <div class="fasilitas-item flex gap-2">
                            <input type="text" name="fasilitas[]" value="{{ $f }}" class="flex-1 px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl outline-none text-sm">
                            <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                        </div>
                        @empty
                        <div class="fasilitas-item flex gap-2">
                            <input type="text" name="fasilitas[]" class="flex-1 px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl outline-none text-sm" placeholder="Fasilitas...">
                            <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                        </div>
                        @endforelse
                    </div>
                    <button type="button" onclick="addFasilitas()" class="mt-3 text-sm font-bold text-gray-500">+ Tambah</button>
                </div>
            </div>
        </div>

        <!-- STEP 4: Terms & Conditions -->
        <div class="wizard-panel hidden" id="step-4">
            <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100 mb-6">
                <div class="flex items-center gap-3 mb-8">
                    <div class="w-10 h-10 bg-cyan-50 text-cyan-600 rounded-xl flex items-center justify-center font-black">04</div>
                    <h3 class="text-xl font-extrabold text-gray-900">Terms & Conditions</h3>
                </div>

                @php $terms = $layanan->terms_conditions ?? []; @endphp

                <div class="space-y-6">
                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-cyan-600 mb-3">📋 Registration & Payment</label>
                        <div id="registration-container" class="space-y-2">
                            @forelse($terms['registration_payment'] ?? [] as $item)
                            <div class="reg-item flex gap-2">
                                <input type="text" name="terms_registration[]" value="{{ $item }}" class="flex-1 px-4 py-3 bg-cyan-50 border border-cyan-100 rounded-xl outline-none text-sm">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @empty
                            <div class="reg-item flex gap-2">
                                <input type="text" name="terms_registration[]" class="flex-1 px-4 py-3 bg-cyan-50 border border-cyan-100 rounded-xl outline-none text-sm" placeholder="Registration...">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addRegistration()" class="mt-3 text-sm font-bold text-cyan-600">+ Tambah</button>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-amber-600 mb-3">⚠️ Cancelation</label>
                        <div id="cancelation-container" class="space-y-2">
                            @forelse($terms['cancelation'] ?? [] as $item)
                            <div class="cancel-item flex gap-2">
                                <input type="text" name="terms_cancelation[]" value="{{ $item }}" class="flex-1 px-4 py-3 bg-amber-50 border border-amber-100 rounded-xl outline-none text-sm">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @empty
                            <div class="cancel-item flex gap-2">
                                <input type="text" name="terms_cancelation[]" class="flex-1 px-4 py-3 bg-amber-50 border border-amber-100 rounded-xl outline-none text-sm" placeholder="Cancelation...">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addCancelation()" class="mt-3 text-sm font-bold text-amber-600">+ Tambah</button>
                    </div>

                    <div>
                        <label class="block text-xs font-black uppercase tracking-wider text-gray-600 mb-3">🚫 Not Responsible For</label>
                        <div id="notresponsible-container" class="space-y-2">
                            @forelse($terms['not_responsible_for'] ?? [] as $item)
                            <div class="notresp-item flex gap-2">
                                <input type="text" name="terms_not_responsible[]" value="{{ $item }}" class="flex-1 px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl outline-none text-sm">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @empty
                            <div class="notresp-item flex gap-2">
                                <input type="text" name="terms_not_responsible[]" class="flex-1 px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl outline-none text-sm" placeholder="Not responsible for...">
                                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                            </div>
                            @endforelse
                        </div>
                        <button type="button" onclick="addNotResponsible()" class="mt-3 text-sm font-bold text-gray-600">+ Tambah</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation -->
        <div class="flex justify-between items-center mt-8">
            <button type="button" id="prev-btn" onclick="prevStep()" class="hidden px-8 py-4 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-2xl font-bold transition-all">← Sebelumnya</button>
            <div class="flex-1"></div>
            <button type="button" id="next-btn" onclick="nextStep()" class="px-8 py-4 bg-indigo-600 hover:bg-indigo-700 text-white rounded-2xl font-bold shadow-lg transition-all">Selanjutnya →</button>
            <button type="submit" id="submit-btn" class="hidden px-8 py-4 bg-emerald-600 hover:bg-emerald-700 text-white rounded-2xl font-bold shadow-lg transition-all">✓ Update Layanan</button>
        </div>
    </form>
</div>

<style>
    .wizard-step.active .step-circle { background-color: #4f46e5; color: white; }
    .wizard-step.completed .step-circle { background-color: #10b981; color: white; }
    .wizard-step.active span { color: #4f46e5; }
    .wizard-step.completed span { color: #10b981; }
</style>

<script>
let currentStep = 1;
const totalSteps = 4;
const existingItinerary = @json($layanan->itinerary ?? []);

function updateWizard() {
    document.querySelectorAll('.wizard-panel').forEach((p, i) => p.classList.toggle('hidden', i + 1 !== currentStep));
    document.querySelectorAll('.wizard-step').forEach((s, i) => {
        s.classList.remove('active', 'completed');
        if (i + 1 < currentStep) s.classList.add('completed');
        if (i + 1 === currentStep) s.classList.add('active');
    });
    document.getElementById('progress-bar').style.width = ((currentStep - 1) / (totalSteps - 1) * 100) + '%';
    document.getElementById('prev-btn').classList.toggle('hidden', currentStep === 1);
    document.getElementById('next-btn').classList.toggle('hidden', currentStep === totalSteps);
    document.getElementById('submit-btn').classList.toggle('hidden', currentStep !== totalSteps);
}

function nextStep() { if (currentStep < totalSteps) { currentStep++; updateWizard(); if (currentStep === 2) generateItinerary(); } }
function prevStep() { if (currentStep > 1) { currentStep--; updateWizard(); } }
function goToStep(step) { if (step <= currentStep || step === currentStep + 1) { currentStep = step; updateWizard(); if (currentStep === 2) generateItinerary(); } }

function generateItinerary() {
    const days = parseInt(document.getElementById('durasi_hari_input').value) || 3;
    const container = document.getElementById('itinerary-container');
    container.innerHTML = '';
    
    for (let d = 1; d <= days; d++) {
        const dayData = existingItinerary.find(i => i.day === d) || {activities: []};
        let activitiesHtml = '';
        
        if (dayData.activities && dayData.activities.length > 0) {
            dayData.activities.forEach(act => {
                activitiesHtml += `<div class="activity-item flex gap-2">
                    <input type="text" name="itinerary[${d-1}][activities][]" value="${act}" class="flex-1 px-4 py-3 bg-white border border-gray-100 rounded-xl outline-none text-sm">
                    <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
                </div>`;
            });
        } else {
            activitiesHtml = `<div class="activity-item flex gap-2">
                <input type="text" name="itinerary[${d-1}][activities][]" class="flex-1 px-4 py-3 bg-white border border-gray-100 rounded-xl outline-none text-sm" placeholder="Activity...">
                <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>
            </div>`;
        }
        
        container.innerHTML += `<div class="itinerary-day bg-gray-50 rounded-2xl p-6">
            <div class="flex items-center gap-3 mb-4"><span class="px-4 py-2 bg-amber-500 text-white font-black rounded-lg text-sm">Day ${d}</span></div>
            <div id="day-${d}-activities" class="space-y-2">${activitiesHtml}</div>
            <input type="hidden" name="itinerary[${d-1}][day]" value="${d}">
            <button type="button" onclick="addActivity(${d})" class="mt-3 text-sm font-bold text-amber-600">+ Tambah Aktivitas</button>
        </div>`;
    }
}

function addActivity(day) {
    const container = document.getElementById(`day-${day}-activities`);
    const div = document.createElement('div');
    div.className = 'activity-item flex gap-2';
    div.innerHTML = `<input type="text" name="itinerary[${day-1}][activities][]" class="flex-1 px-4 py-3 bg-white border border-gray-100 rounded-xl outline-none text-sm" placeholder="Activity...">
        <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>`;
    container.appendChild(div);
}

function removeItem(btn) {
    const container = btn.closest('[id$="-container"], [id^="day-"]');
    if (container && container.children.length > 1) btn.parentElement.remove();
    else if (btn.previousElementSibling) btn.previousElementSibling.value = '';
}

function removeExistingImage(btn) { btn.closest('div').remove(); }

function addInclude() { addDynamicItem('include-container', 'include_services[]', 'include-item', 'bg-emerald-50 border-emerald-100'); }
function addExclude() { addDynamicItem('exclude-container', 'exclude_services[]', 'exclude-item', 'bg-rose-50 border-rose-100'); }
function addDestination() { addDynamicItem('destinations-container', 'destinations[]', 'destination-item', 'bg-blue-50 border-blue-100'); }
function addFasilitas() { addDynamicItem('fasilitas-container', 'fasilitas[]', 'fasilitas-item', 'bg-gray-50 border-gray-100'); }
function addRegistration() { addDynamicItem('registration-container', 'terms_registration[]', 'reg-item', 'bg-cyan-50 border-cyan-100'); }
function addCancelation() { addDynamicItem('cancelation-container', 'terms_cancelation[]', 'cancel-item', 'bg-amber-50 border-amber-100'); }
function addNotResponsible() { addDynamicItem('notresponsible-container', 'terms_not_responsible[]', 'notresp-item', 'bg-gray-50 border-gray-100'); }

function addPricing() {
    const container = document.getElementById('pricing-container');
    const div = document.createElement('div');
    div.className = 'pricing-item flex gap-2';
    div.innerHTML = `<input type="text" name="pricing_types[]" class="flex-1 px-4 py-3 bg-indigo-50 border border-indigo-100 rounded-xl outline-none text-sm" placeholder="Type...">
        <input type="number" name="pricing_prices[]" class="w-32 px-4 py-3 bg-indigo-50 border border-indigo-100 rounded-xl outline-none text-sm font-mono" placeholder="Price">
        <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>`;
    container.appendChild(div);
}

function addDynamicItem(containerId, inputName, itemClass, bgClass) {
    const container = document.getElementById(containerId);
    const div = document.createElement('div');
    div.className = itemClass + ' flex gap-2';
    div.innerHTML = `<input type="text" name="${inputName}" class="flex-1 px-4 py-3 ${bgClass} rounded-xl outline-none text-sm" placeholder="">
        <button type="button" onclick="removeItem(this)" class="w-10 h-10 bg-rose-50 text-rose-500 hover:bg-rose-500 hover:text-white rounded-xl transition-all">×</button>`;
    container.appendChild(div);
}

function previewImages(input) {
    const preview = document.getElementById('image-preview');
    preview.innerHTML = '';
    if (input.files && input.files.length > 0) {
        const existing = document.querySelectorAll('#existing-images input').length;
        if (existing + input.files.length > 5) { alert('Maksimal 5 gambar!'); input.value = ''; return; }
        Array.from(input.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = e => { preview.innerHTML += `<div class="aspect-square rounded-xl overflow-hidden border"><img src="${e.target.result}" class="w-full h-full object-cover"></div>`; };
            reader.readAsDataURL(file);
        });
    }
}

function previewInfoImage(input) {
    const preview = document.getElementById('info-image-preview');
    preview.innerHTML = '';
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { preview.innerHTML = `<div class="rounded-xl overflow-hidden border h-24"><img src="${e.target.result}" class="w-full h-full object-cover"></div>`; };
        reader.readAsDataURL(input.files[0]);
    }
}

document.addEventListener('DOMContentLoaded', () => updateWizard());
</script>
@endsection
