@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10 antialiased text-gray-900 px-4 md:px-8">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li>
                            <a href="{{ route('admin.special-offers.index') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors">Penawaran Khusus</a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-sm font-bold text-gray-900 ml-1">Edit Penawaran</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="flex items-center gap-4">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Edit Penawaran</h1>
                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-widest {{ $specialOffer->layanan_id ? 'bg-blue-50 text-blue-600' : 'bg-purple-50 text-purple-600' }}">
                        {{ $specialOffer->layanan_id ? 'Paket Layanan' : 'Promosi Mandiri' }}
                    </span>
                </div>
                <p class="text-gray-500 font-medium mt-1">Perbarui rincian kampanye "{{ $specialOffer->title }}".</p>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.special-offers.show', $specialOffer->id) }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-2xl font-bold transition-all duration-300 shadow-sm border border-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    Detail
                </a>
                <a href="{{ route('admin.special-offers.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-2xl font-bold transition-all duration-300 shadow-sm border border-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5m7 7l-7-7 7-7"/></svg>
                    Kembali
                </a>
            </div>
        </div>

        <form action="{{ route('admin.special-offers.update', $specialOffer->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (Left) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-sm">1</span>
                            Informasi Promo
                        </h2>

                        <div class="space-y-6">
                            <!-- Title -->
                            <div class="group">
                                <label for="title" class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Judul Penawaran <span class="text-rose-500">*</span></label>
                                <input type="text" id="title" name="title" value="{{ old('title', $specialOffer->title) }}" required 
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none @error('title') border-rose-500 @enderror" 
                                       placeholder="Judul promosi...">
                                @error('title')
                                    <p class="text-rose-500 text-xs font-bold mt-2 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            @if($specialOffer->layanan_id)
                                <!-- Layanan Selection -->
                                <div class="group">
                                    <label for="layanan_id" class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Paket Layanan Terkait <span class="text-rose-500">*</span></label>
                                    <div class="relative">
                                        <select id="layanan_id" name="layanan_id" required 
                                                class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none appearance-none">
                                            @foreach($layananList as $layanan)
                                                <option value="{{ $layanan->layanan_id }}" 
                                                        data-price="{{ $layanan->harga_mulai }}"
                                                        {{ old('layanan_id', $specialOffer->layanan_id) == $layanan->layanan_id ? 'selected' : '' }}>
                                                    {{ $layanan->nama_layanan }} (Mulai dari Rp {{ number_format($layanan->harga_mulai, 0, ',', '.') }})
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="absolute inset-y-0 right-0 pr-5 flex items-center pointer-events-none">
                                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Discount & Pricing Grid (Linked) -->
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 pt-4">
                                    <div class="bg-indigo-50/50 p-6 rounded-[1.5rem] border border-indigo-100/50 text-center">
                                        <label for="discount_percentage" class="block text-[10px] font-black uppercase tracking-widest text-indigo-400 mb-2">Persentase Diskon</label>
                                        <div class="relative inline-flex items-center">
                                            <input type="number" id="discount_percentage" name="discount_percentage" value="{{ old('discount_percentage', $specialOffer->discount_percentage) }}" 
                                                   required min="0" max="100" step="0.01" 
                                                   class="w-24 text-center text-2xl font-black text-indigo-600 bg-transparent outline-none p-0 inline">
                                            <span class="text-xl font-black text-indigo-300">%</span>
                                        </div>
                                    </div>
                                    <div class="bg-gray-50 p-6 rounded-[1.5rem] border border-gray-100/50 text-center">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Harga Normal</label>
                                        <div id="original_price_display" class="text-xl font-bold text-gray-400 line-through">Rp 0</div>
                                    </div>
                                    <div class="bg-emerald-50 p-6 rounded-[1.5rem] border border-emerald-100/50 text-center">
                                        <label class="block text-[10px] font-black uppercase tracking-widest text-emerald-400 mb-2">Harga Promo</label>
                                        <div id="discounted_price_display" class="text-2xl font-black text-emerald-600 tracking-tight">Rp 0</div>
                                    </div>
                                </div>
                            @else
                                <!-- Standalone Pricing Grid -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                                    <div class="bg-gray-50 p-6 rounded-[1.5rem] border border-gray-100/50 group">
                                        <label for="original_price" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Harga Normal <span class="text-rose-500">*</span></label>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xl font-bold text-gray-400">Rp</span>
                                            <input type="number" id="original_price" name="original_price" value="{{ old('original_price', $specialOffer->original_price) }}" 
                                                   required min="0" step="0.01" 
                                                   class="w-full text-xl font-bold text-gray-900 bg-transparent outline-none p-0 border-none focus:ring-0">
                                        </div>
                                    </div>
                                    <div class="bg-emerald-50 p-6 rounded-[1.5rem] border border-emerald-100/50 group">
                                        <label for="discounted_price" class="block text-[10px] font-black uppercase tracking-widest text-emerald-400 mb-2">Harga Promo <span class="text-rose-500">*</span></label>
                                        <div class="flex items-center gap-2">
                                            <span class="text-xl font-bold text-emerald-400">Rp</span>
                                            <input type="number" id="discounted_price" name="discounted_price" value="{{ old('discounted_price', $specialOffer->discounted_price) }}" 
                                                   required min="0" step="0.01" 
                                                   class="w-full text-xl font-bold text-emerald-600 bg-transparent outline-none p-0 border-none focus:ring-0">
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="discount_percentage" id="discount_percentage" value="{{ $specialOffer->discount_percentage }}">
                                <div class="flex justify-center -mt-3">
                                    <div id="discount-badge" class="px-6 py-2 bg-white border border-gray-100 shadow-sm rounded-full text-sm font-black text-indigo-600">
                                        DISKON <span id="discount_percentage_display">{{ round($specialOffer->discount_percentage) }}%</span>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Narasi & Syarat -->
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span class="w-8 h-8 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center text-sm">2</span>
                            Narasi & Syarat
                        </h2>
                        
                        <div class="space-y-6">
                            <div class="group">
                                <label for="description" class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Deskripsi Promosi <span class="text-rose-500">*</span></label>
                                <textarea id="description" name="description" rows="5" required 
                                          class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none resize-none">{{ old('description', $specialOffer->description) }}</textarea>
                            </div>

                            <div class="group">
                                <label for="terms_conditions" class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Syarat & Ketentuan</label>
                                <textarea id="terms_conditions" name="terms_conditions" rows="4" 
                                          class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none resize-none">{{ old('terms_conditions', $specialOffer->terms_conditions) }}</textarea>
                            </div>
                        </div>
                    </div>

                    @if(!$specialOffer->layanan_id)
                        <!-- Multi-Image Gallery (Standalone Only) -->
                        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                            <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                                <span class="w-8 h-8 bg-purple-50 text-purple-600 rounded-lg flex items-center justify-center text-sm">3</span>
                                Galeri Gambar
                            </h2>

                            <div class="space-y-6">
                                <!-- Existing Gallery -->
                                @if($specialOffer->galleries->count() > 0)
                                    <div>
                                        <p class="text-xs font-black uppercase tracking-widest text-gray-400 mb-4">Galeri Saat Ini</p>
                                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                                            @foreach($specialOffer->galleries as $gallery)
                                                <div class="relative group aspect-square rounded-2xl overflow-hidden border border-gray-100 shadow-sm">
                                                    <img src="{{ asset('storage/' . $gallery->image_path) }}" class="w-full h-full object-cover">
                                                    @if($gallery->is_main)
                                                        <div class="absolute top-2 left-2 px-2 py-0.5 bg-indigo-600 text-[8px] font-black text-white uppercase tracking-tighter rounded-full">Utama</div>
                                                    @endif
                                                </div>
                                            @endforeach
                                        </div>
                                        <p class="text-[10px] text-amber-500 font-bold mt-3 bg-amber-50 p-3 rounded-xl border border-amber-100">
                                            Catatan: Mengupload gambar baru akan menggantikan seluruh galeri saat ini.
                                        </p>
                                    </div>
                                @endif

                                <!-- Upload New Gallery -->
                                <div class="group">
                                    <label class="block text-sm font-bold text-gray-700 mb-4">Upload Galeri Baru (Opsional)</label>
                                    <div id="dropzone" class="relative group min-h-[200px] bg-gray-50 rounded-[2rem] border-2 border-dashed border-gray-200 hover:border-purple-400 transition-all flex flex-col items-center justify-center p-8">
                                        <div id="gallery-placeholder" class="text-center group-hover:scale-110 transition-transform duration-500">
                                            <div class="w-16 h-16 bg-white rounded-2xl shadow-sm flex items-center justify-center mb-4 mx-auto group-hover:shadow-purple-100 transition-all">
                                                <svg class="w-8 h-8 text-gray-300 group-hover:text-purple-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                            <p class="text-xs font-black text-gray-400 uppercase tracking-widest group-hover:text-purple-600 transition-colors">Pilih Beberapa Gambar</p>
                                        </div>
                                        <input type="file" id="gallery_images" name="gallery_images[]" multiple accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-20">
                                        
                                        <!-- Preview Container -->
                                        <div id="gallery-preview" class="hidden grid grid-cols-2 md:grid-cols-4 gap-4 w-full mt-4 z-30"></div>
                                    </div>
                                    <p class="text-[10px] text-gray-400 font-medium mt-3 italic">Pilih minimal 1 gambar. Gambar pertama akan otomatis menjadi gambar utama display.</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Sidebar (Right) -->
                <div class="space-y-6">
                    <!-- Status & Schedule -->
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Pengaturan</h3>
                        
                        <div class="space-y-5">
                            <div>
                                <label for="status" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Aktivasi</label>
                                <select id="status" name="status" required 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none appearance-none font-bold">
                                    <option value="active" {{ old('status', $specialOffer->is_active ? 'active' : 'inactive') == 'active' ? 'selected' : '' }}>Aktif Sekarang</option>
                                    <option value="inactive" {{ old('status', $specialOffer->is_active ? 'active' : 'inactive') == 'inactive' ? 'selected' : '' }}>Nonaktif / Draft</option>
                                </select>
                            </div>

                            <div class="pt-2">
                                <label class="relative inline-flex items-center cursor-pointer group">
                                    <input type="checkbox" name="featured" value="1" {{ old('featured', $specialOffer->is_featured) ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                    <span class="ml-3 text-sm font-bold text-gray-700 group-hover:text-indigo-600 transition-colors">Tampilkan di Hero</span>
                                </label>
                            </div>

                            <div class="border-t border-gray-50 pt-5 space-y-4">
                                <div>
                                    <label for="start_date" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Tanggal Mulai</label>
                                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date', $specialOffer->valid_from ? $specialOffer->valid_from->format('Y-m-d') : '') }}" required 
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none font-medium">
                                </div>
                                <div>
                                    <label for="end_date" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Hingga Tanggal</label>
                                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date', $specialOffer->valid_until ? $specialOffer->valid_until->format('Y-m-d') : '') }}" required 
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none font-medium">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Image Preview -->
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-4">Gambar Utama</h3>
                        <div class="space-y-4">
                            <div class="relative group h-48 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 hover:border-indigo-400 transition-all flex flex-col items-center justify-center overflow-hidden">
                                @if($specialOffer->main_image)
                                    <img id="image-preview" src="{{ asset('storage/' . $specialOffer->main_image) }}" class="absolute inset-0 w-full h-full object-cover">
                                @else
                                    <div id="upload-icon" class="text-center">
                                        <svg class="w-10 h-10 text-gray-200 mb-2 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Ganti Foto</p>
                                    </div>
                                @endif
                                <input type="file" id="image" name="image" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-20">
                            </div>
                            <p class="text-[10px] text-gray-400 font-medium text-center italic">Kosongkan jika tidak ingin mengubah gambar.</p>
                        </div>
                    </div>

                </div>
            </div>

            <div class="sticky bottom-8 mt-12 bg-white/80 backdrop-blur-md border border-white p-4 rounded-3xl shadow-2xl flex items-center justify-end gap-4 z-50">
                <a href="{{ route('admin.special-offers.index') }}" class="px-8 py-3 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">Batal</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-3 rounded-[1.25rem] font-bold shadow-lg shadow-indigo-100 transition-all active:scale-95">
                    Update Kampanye
                </button>
            </div>
        </form>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #f8fafc; }
    </style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    function formatCurrency(amount) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(Math.round(amount));
    }

    function calculateDiscount() {
        const isStandalone = {{ $specialOffer->layanan_id ? 'false' : 'true' }};
        
        if (!isStandalone) {
            const selectedOption = $('#layanan_id option:selected');
            const originalPrice = parseFloat(selectedOption.data('price')) || 0;
            const discountPercentage = parseFloat($('#discount_percentage').val()) || 0;
            
            if (originalPrice > 0) {
                $('#original_price_display').text(formatCurrency(originalPrice));
                const discountedPrice = originalPrice - (originalPrice * discountPercentage / 100);
                $('#discounted_price_display').text(formatCurrency(discountedPrice));
            }
        } else {
            const original = parseFloat($('#original_price').val()) || 0;
            const discounted = parseFloat($('#discounted_price').val()) || 0;
            if (original > 0 && discounted > 0) {
                const perc = ((original - discounted) / original * 100);
                $('#discount_percentage_display').text(Math.round(perc) + '%');
                $('#discount_percentage').val(perc);
            }
        }
    }

    $('#layanan_id, #discount_percentage, #original_price, #discounted_price').on('input change', calculateDiscount);
    calculateDiscount();

    $('#image').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) { $('#image-preview').attr('src', e.target.result).removeClass('hidden'); }
            reader.readAsDataURL(file);
        }
    });

    // Gallery Multi-Image Preview
    $('#gallery_images').on('change', function() {
        const files = this.files;
        const previewContainer = $('#gallery-preview');
        const placeholder = $('#gallery-placeholder');
        
        previewContainer.empty();
        
        if (files.length > 0) {
            placeholder.addClass('hidden');
            previewContainer.removeClass('hidden');
            
            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const html = `
                        <div class="relative group aspect-square rounded-xl overflow-hidden border border-gray-100 shadow-sm">
                            <img src="${e.target.result}" class="w-full h-full object-cover">
                            <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <span class="text-[8px] font-black text-white uppercase tracking-tighter">${index === 0 ? 'Utama' : 'Galeri'}</span>
                            </div>
                        </div>
                    `;
                    previewContainer.append(html);
                }
                reader.readAsDataURL(file);
            });
        } else {
            placeholder.removeClass('hidden');
            previewContainer.addClass('hidden');
        }
    });
});
</script>
@endpush