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
                                <span class="text-sm font-bold text-gray-900 ml-1">Penawaran Mandiri</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Baru: Penawaran Mandiri</h1>
                <p class="text-gray-500 font-medium mt-1">Buat kampanye promosi kustom tanpa terikat paket layanan.</p>
            </div>
            <a href="{{ route('admin.special-offers.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-2xl font-bold transition-all duration-300 shadow-sm border border-gray-100 group">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5m7 7l-7-7 7-7"/></svg>
                Batal & Kembali
            </a>
        </div>

        <form action="{{ route('admin.special-offers.store-standalone') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Main Content (Left) -->
                <div class="lg:col-span-2 space-y-6">
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-sm">1</span>
                            Informasi Kampanye
                        </h2>

                        <div class="space-y-6">
                            <!-- Title -->
                            <div class="group">
                                <label for="title" class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Nama Promosi <span class="text-rose-500">*</span></label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" required 
                                       class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none @error('title') border-rose-500 @enderror" 
                                       placeholder="Contoh: Flash Sale Ramadhan 2024">
                                @error('title')
                                    <p class="text-rose-500 text-xs font-bold mt-2 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                                        {{ $message }}
                                    </p>
                                @enderror
                            </div>

                            <!-- Pricing Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                                <div class="bg-gray-50 p-6 rounded-[1.5rem] border border-gray-100/50 group">
                                    <label for="original_price" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Harga Normal <span class="text-rose-500">*</span></label>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xl font-bold text-gray-400">Rp</span>
                                        <input type="number" id="original_price" name="original_price" value="{{ old('original_price') }}" 
                                               required min="0" step="0.01" 
                                               class="w-full text-xl font-bold text-gray-900 bg-transparent outline-none p-0 border-none focus:ring-0" 
                                               placeholder="0">
                                    </div>
                                </div>
                                <div class="bg-emerald-50 p-6 rounded-[1.5rem] border border-emerald-100/50 group">
                                    <label for="discounted_price" class="block text-[10px] font-black uppercase tracking-widest text-emerald-400 mb-2">Harga Promo <span class="text-rose-500">*</span></label>
                                    <div class="flex items-center gap-2">
                                        <span class="text-xl font-bold text-emerald-400">Rp</span>
                                        <input type="number" id="discounted_price" name="discounted_price" value="{{ old('discounted_price') }}" 
                                               required min="0" step="0.01" 
                                               class="w-full text-xl font-bold text-emerald-600 bg-transparent outline-none p-0 border-none focus:ring-0" 
                                               placeholder="0">
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Discount Badge & Calculated Display -->
                            <div class="flex items-center justify-center -mt-3">
                                <div id="discount-badge" class="px-6 py-2 bg-white border border-gray-100 shadow-sm rounded-full text-sm font-black text-indigo-600 opacity-0 transition-opacity">
                                    HEBAT! DISKON <span id="discount_percentage_display">0%</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <span class="w-8 h-8 bg-amber-50 text-amber-600 rounded-lg flex items-center justify-center text-sm">2</span>
                            Narasi Promosi
                        </h2>
                        
                        <div class="space-y-6">
                            <div class="group">
                                <label for="description" class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Deskripsi Menarik <span class="text-rose-500">*</span></label>
                                <textarea id="description" name="description" rows="5" required 
                                          class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none resize-none" 
                                          placeholder="Tuliskan deskripsi yang memikat calon pelanggan...">{{ old('description') }}</textarea>
                            </div>

                            <div class="group">
                                <label for="terms_conditions" class="block text-sm font-bold text-gray-700 mb-2 group-focus-within:text-indigo-600 transition-colors">Syarat & Ketentuan</label>
                                <textarea id="terms_conditions" name="terms_conditions" rows="4" 
                                          class="w-full px-5 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all outline-none resize-none" 
                                          placeholder="Misal: Minimal 2 orang, Tidak termasuk tiket pesawat...">{{ old('terms_conditions') }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar (Right) -->
                <div class="space-y-6">
                    <!-- Status & Schedule -->
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                        <h3 class="text-lg font-bold text-gray-900 mb-6">Penjadwalan</h3>
                        
                        <div class="space-y-5">
                            <div>
                                <label for="status" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Aktivasi</label>
                                <select id="status" name="status" required 
                                        class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none appearance-none font-bold">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Langsung Aktif</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Draft / Nonaktif</option>
                                </select>
                            </div>

                            <div class="pt-2">
                                <label class="relative inline-flex items-center cursor-pointer group">
                                    <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-indigo-600"></div>
                                    <span class="ml-3 text-sm font-bold text-gray-700 group-hover:text-indigo-600 transition-colors">Muncul di Hero Page</span>
                                </label>
                            </div>

                            <div class="border-t border-gray-50 pt-5 space-y-4">
                                <div>
                                    <label for="start_date" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Tanggal Mulai</label>
                                    <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required 
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none font-medium">
                                </div>
                                <div>
                                    <label for="end_date" class="block text-xs font-black uppercase tracking-widest text-gray-400 mb-2">Hingga Tanggal</label>
                                    <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required 
                                           class="w-full px-4 py-3 bg-gray-50 border border-gray-100 rounded-xl focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 outline-none font-medium">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modern Multi-Image Upload -->
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-bold text-gray-900">Galeri Foto</h3>
                            <span class="text-[10px] font-black uppercase tracking-widest text-indigo-400">Multiupload</span>
                        </div>
                        <div class="space-y-4">
                            <div class="relative group min-h-[160px] bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200 hover:border-indigo-400 transition-all flex flex-col items-center justify-center p-6 text-center">
                                <svg class="w-10 h-10 text-gray-300 mb-2 group-hover:text-indigo-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                <p class="text-xs font-bold text-gray-400 group-hover:text-indigo-600 transition-colors">Tarik foto ke sini atau klik</p>
                                <input type="file" id="gallery_images" name="gallery_images[]" accept="image/*" multiple class="absolute inset-0 opacity-0 cursor-pointer z-20">
                            </div>
                            
                            <!-- Dynamic Preview Area -->
                            <div id="image-preview-container" class="grid grid-cols-3 gap-3"></div>
                            
                            <p class="text-[10px] text-gray-400 font-medium text-center italic">Foto pertama akan digunakan sebagai thumbnail utama.</p>
                        </div>
                    </div>

                </div>
            </div>

            <!-- Sticky Save Bar -->
            <div class="sticky bottom-8 mt-12 bg-white/80 backdrop-blur-md border border-white p-4 rounded-3xl shadow-2xl flex items-center justify-end gap-4 z-50">
                <a href="{{ route('admin.special-offers.index') }}" class="px-8 py-3 text-sm font-bold text-gray-500 hover:text-gray-900 transition-colors">Simpan Draft</a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-10 py-3 rounded-[1.25rem] font-bold shadow-lg shadow-indigo-100 transition-all active:scale-95">
                    Tayangkan Promo
                </button>
            </div>
        </form>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        input[type="date"]::-webkit-calendar-picker-indicator {
            filter: invert(0.5);
            cursor: pointer;
        }
    </style>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    function calculateDiscount() {
        const original = parseFloat($('#original_price').val()) || 0;
        const discounted = parseFloat($('#discounted_price').val()) || 0;
        
        if (original > 0 && discounted > 0) {
            const savings = original - discounted;
            const percentage = ((savings / original) * 100);
            
            if (percentage > 0) {
                $('#discount-badge').removeClass('opacity-0');
                $('#discount_percentage_display').text(Math.round(percentage) + '%');
            } else {
                $('#discount-badge').addClass('opacity-0');
            }
        } else {
            $('#discount-badge').addClass('opacity-0');
        }
    }

    $('#original_price, #discounted_price').on('input', calculateDiscount);

    // Modern Multi-Image Preview
    $('#gallery_images').on('change', function() {
        const files = this.files;
        const container = $('#image-preview-container');
        container.empty();
        
        Array.from(files).slice(0, 6).forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const html = `
                    <div class="relative aspect-square rounded-xl overflow-hidden shadow-sm border-2 border-white">
                        <img src="${e.target.result}" class="w-full h-full object-cover">
                        ${index === 0 ? '<div class="absolute inset-x-0 bottom-0 py-1 bg-emerald-500/80 backdrop-blur text-[8px] font-black text-white text-center uppercase tracking-widest">Main</div>' : ''}
                    </div>
                `;
                container.append(html);
            }
            reader.readAsDataURL(file);
        });
    });
});
</script>
@endpush