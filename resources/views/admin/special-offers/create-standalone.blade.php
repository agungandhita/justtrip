@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-purple-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Tambah Penawaran Khusus Mandiri</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Buat penawaran khusus mandiri yang tidak terkait dengan layanan tertentu</p>
                </div>
                <a href="{{ route('admin.special-offers.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                    </svg>
                    Kembali ke Penawaran Khusus
                </a>
            </div>
        </div>

        <!-- Form -->
        <div class="px-4">
            <div class="bg-white rounded-xl shadow-md p-8">
                <form action="{{ route('admin.special-offers.store-standalone') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <!-- Left Column -->
                        <div class="space-y-6">
                            <!-- Title -->
                            <div>
                                <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Penawaran *</label>
                                <input type="text" id="title" name="title" value="{{ old('title') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('title') border-red-500 @enderror" placeholder="Masukkan judul penawaran">
                                @error('title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Original Price -->
                            <div>
                                <label for="original_price" class="block text-sm font-medium text-gray-700 mb-2">Harga Asli *</label>
                                <input type="number" id="original_price" name="original_price" value="{{ old('original_price') }}" required min="0" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('original_price') border-red-500 @enderror" placeholder="Masukkan harga asli">
                                @error('original_price')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Discounted Price -->
                            <div>
                                <label for="discounted_price" class="block text-sm font-medium text-gray-700 mb-2">Harga Setelah Diskon *</label>
                                <input type="number" id="discounted_price" name="discounted_price" value="{{ old('discounted_price') }}" required min="0" step="0.01" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('discounted_price') border-red-500 @enderror" placeholder="Masukkan harga setelah diskon">
                                @error('discounted_price')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Discount Percentage Display -->
                            <div>
                                <label for="discount_percentage_display" class="block text-sm font-medium text-gray-700 mb-2">Persentase Diskon</label>
                                <input type="text" id="discount_percentage_display" readonly class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50" placeholder="Akan dihitung otomatis">
                            </div>

                            <!-- Start Date -->
                            <div>
                                <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai *</label>
                                <input type="date" id="start_date" name="start_date" value="{{ old('start_date') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('start_date') border-red-500 @enderror">
                                @error('start_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- End Date -->
                            <div>
                                <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Berakhir *</label>
                                <input type="date" id="end_date" name="end_date" value="{{ old('end_date') }}" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('end_date') border-red-500 @enderror">
                                @error('end_date')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Status -->
                            <div>
                                <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                                <select id="status" name="status" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('status') border-red-500 @enderror">
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                                </select>
                                @error('status')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Right Column -->
                        <div class="space-y-6">
                            <!-- Gallery Images -->
                            <div>
                                <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Gambar Galeri</label>
                                <input type="file" id="gallery_images" name="gallery_images[]" accept="image/png,image/jpg,image/jpeg,image/gif,image/webp" multiple class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('gallery_images.*') border-red-500 @enderror">
                                <p class="text-sm text-gray-500 mt-1">Format yang didukung: PNG, JPG, GIF, WebP. Ukuran maksimal: 5MB per gambar. Gambar pertama akan menjadi gambar utama.</p>
                                @error('gallery_images.*')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Featured -->
                            <div>
                                <label class="flex items-center">
                                    <input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }} class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                                    <span class="ml-2 text-sm text-gray-700">Penawaran Unggulan</span>
                                </label>
                                @error('featured')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Terms and Conditions -->
                            <div>
                                <label for="terms_conditions" class="block text-sm font-medium text-gray-700 mb-2">Syarat & Ketentuan</label>
                                <textarea id="terms_conditions" name="terms_conditions" rows="6" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('terms_conditions') border-red-500 @enderror" placeholder="Masukkan syarat dan ketentuan">{{ old('terms_conditions') }}</textarea>
                                @error('terms_conditions')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Meta Title -->
                            <div>
                                <label for="meta_title" class="block text-sm font-medium text-gray-700 mb-2">Judul Meta</label>
                                <input type="text" id="meta_title" name="meta_title" value="{{ old('meta_title') }}" maxlength="60" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('meta_title') border-red-500 @enderror" placeholder="Judul meta SEO (maksimal 60 karakter)">
                                @error('meta_title')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Meta Description -->
                            <div>
                                <label for="meta_description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Meta</label>
                                <textarea id="meta_description" name="meta_description" rows="3" maxlength="160" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('meta_description') border-red-500 @enderror" placeholder="Deskripsi meta SEO (maksimal 160 karakter)">{{ old('meta_description') }}</textarea>
                                @error('meta_description')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mt-8">
                        <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi *</label>
                        <textarea id="description" name="description" rows="6" required class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('description') border-red-500 @enderror" placeholder="Masukkan deskripsi penawaran">{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Submit Buttons -->
                    <div class="mt-8 flex items-center justify-end space-x-4">
                        <a href="{{ route('admin.special-offers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit" class="bg-purple-600 hover:bg-purple-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Buat Penawaran Mandiri
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    // Function to format number as currency
    function formatCurrency(amount) {
        return 'Rp ' + new Intl.NumberFormat('id-ID').format(amount);
    }

    // Function to calculate discount percentage
    function calculateDiscountPercentage() {
        const originalPrice = parseFloat($('#original_price').val()) || 0;
        const discountedPrice = parseFloat($('#discounted_price').val()) || 0;
        
        if (originalPrice > 0 && discountedPrice > 0 && discountedPrice < originalPrice) {
            const discountPercentage = ((originalPrice - discountedPrice) / originalPrice) * 100;
            $('#discount_percentage_display').val(discountPercentage.toFixed(2) + '%');
        } else {
            $('#discount_percentage_display').val('');
        }
    }

    // Event listeners
    $('#original_price, #discounted_price').on('input', function() {
        calculateDiscountPercentage();
    });

    // Initial calculation if values are already entered
    calculateDiscountPercentage();

    // Validate that discounted price is less than original price
    $('#discounted_price').on('blur', function() {
        const originalPrice = parseFloat($('#original_price').val()) || 0;
        const discountedPrice = parseFloat($(this).val()) || 0;
        
        if (discountedPrice >= originalPrice && originalPrice > 0) {
            alert('Harga setelah diskon harus lebih kecil dari harga asli!');
            $(this).focus();
        }
    });

    // Preview uploaded images
    $('#gallery_images').on('change', function() {
        const files = this.files;
        const previewContainer = $('#image-preview');
        
        // Remove existing preview container if exists
        previewContainer.remove();
        
        if (files.length > 0) {
            // Create preview container
            const previewHtml = '<div id="image-preview" class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4"></div>';
            $(this).parent().append(previewHtml);
            
            // Add each image preview
            Array.from(files).forEach((file, index) => {
                if (file.type.startsWith('image/')) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        const imageHtml = `
                            <div class="relative">
                                <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-24 object-cover rounded-lg border">
                                <span class="absolute top-1 left-1 bg-purple-600 text-white text-xs px-2 py-1 rounded">${index + 1}</span>
                                ${index === 0 ? '<span class="absolute top-1 right-1 bg-green-600 text-white text-xs px-2 py-1 rounded">Utama</span>' : ''}
                            </div>
                        `;
                        $('#image-preview').append(imageHtml);
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    });
});
</script>
@endpush