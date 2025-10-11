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
                    <p class="text-gray-600 pl-11">Buat penawaran khusus tanpa terkait dengan layanan tertentu</p>
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

                            <!-- Price Fields -->
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="original_price" class="block text-sm font-medium text-gray-700 mb-2">Harga Asli *</label>
                                    <input type="number" id="original_price" name="original_price" value="{{ old('original_price') }}" required min="0" step="1000" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('original_price') border-red-500 @enderror" placeholder="Masukkan harga asli">
                                    @error('original_price')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div>
                                    <label for="discounted_price" class="block text-sm font-medium text-gray-700 mb-2">Harga Setelah Diskon *</label>
                                    <input type="number" id="discounted_price" name="discounted_price" value="{{ old('discounted_price') }}" required min="0" step="1000" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent @error('discounted_price') border-red-500 @enderror" placeholder="Masukkan harga diskon">
                                    @error('discounted_price')
                                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
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
                                <label for="gallery_images" class="block text-sm font-medium text-gray-700 mb-2">Galeri Gambar *</label>
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-purple-400 transition-colors duration-200">
                                    <input type="file" id="gallery_images" name="gallery_images[]" multiple accept="image/png,image/jpg,image/jpeg,image/gif,image/webp" class="hidden" required>
                                    <label for="gallery_images" class="cursor-pointer">
                                        <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                            <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        <div class="mt-4">
                                            <p class="text-sm text-gray-600">
                                                <span class="font-medium text-purple-600 hover:text-purple-500">Klik untuk upload</span> atau drag & drop
                                            </p>
                                            <p class="text-xs text-gray-500 mt-1">PNG, JPG, GIF, WEBP hingga 5MB per file (maksimal 10 gambar)</p>
                                        </div>
                                    </label>
                                </div>
                                
                                <!-- Preview Container -->
                                <div id="image-preview-container" class="mt-4 grid grid-cols-2 md:grid-cols-3 gap-4 hidden">
                                    <!-- Preview images will be inserted here -->
                                </div>
                                
                                @error('gallery_images')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
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
                            Buat Penawaran Khusus Mandiri
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
    let selectedFiles = [];
    let mainImageIndex = 0;

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

    // Function to update file input with selected files
    function updateFileInput() {
        const dt = new DataTransfer();
        selectedFiles.forEach(file => dt.items.add(file));
        document.getElementById('gallery_images').files = dt.files;
    }

    // Function to render image previews
    function renderPreviews() {
        const container = $('#image-preview-container');
        container.empty();
        
        if (selectedFiles.length === 0) {
            container.addClass('hidden');
            return;
        }
        
        container.removeClass('hidden');
        
        // Create placeholder divs first to maintain order
        const previewElements = [];
        selectedFiles.forEach((file, index) => {
            const placeholderDiv = $('<div class="relative group"></div>');
            container.append(placeholderDiv);
            previewElements.push(placeholderDiv);
        });
        
        // Then load images asynchronously
        selectedFiles.forEach((file, index) => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const isMain = index === mainImageIndex;
                const previewHtml = `
                    <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-32 object-cover rounded-lg border-2 ${isMain ? 'border-purple-500' : 'border-gray-200'}">
                    <div class="absolute inset-0 bg-black bg-opacity-50 opacity-0 group-hover:opacity-100 transition-opacity duration-200 rounded-lg flex items-center justify-center">
                        <div class="flex space-x-2">
                            ${!isMain ? `<button type="button" onclick="setMainImage(${index})" class="bg-purple-600 hover:bg-purple-700 text-white px-2 py-1 rounded text-xs">Set Utama</button>` : ''}
                            <button type="button" onclick="removeImage(${index})" class="bg-red-600 hover:bg-red-700 text-white px-2 py-1 rounded text-xs">Hapus</button>
                        </div>
                    </div>
                    ${isMain ? '<div class="absolute top-2 left-2 bg-purple-600 text-white px-2 py-1 rounded text-xs">Utama</div>' : ''}
                    <div class="absolute bottom-2 left-2 bg-black bg-opacity-75 text-white px-2 py-1 rounded text-xs">${index + 1}</div>
                `;
                previewElements[index].html(previewHtml);
            };
            reader.readAsDataURL(file);
        });
    }

    // Function to set main image
    window.setMainImage = function(index) {
        mainImageIndex = index;
        renderPreviews();
    };

    // Function to remove image
    window.removeImage = function(index) {
        selectedFiles.splice(index, 1);
        if (mainImageIndex >= selectedFiles.length) {
            mainImageIndex = Math.max(0, selectedFiles.length - 1);
        }
        updateFileInput();
        renderPreviews();
    };

    // Handle file selection
    $('#gallery_images').on('change', function(e) {
        const files = Array.from(e.target.files);
        
        // Validate file count
        if (files.length > 10) {
            alert('Maksimal 10 gambar yang dapat diupload');
            return;
        }
        
        // Validate file size and type
        const validFiles = files.filter(file => {
            if (file.size > 5 * 1024 * 1024) { // 5MB
                alert(`File ${file.name} terlalu besar. Maksimal 5MB per file.`);
                return false;
            }
            if (!file.type.match(/^image\/(png|jpg|jpeg|gif|webp)$/)) {
                alert(`File ${file.name} bukan format gambar yang didukung.`);
                return false;
            }
            return true;
        });
        
        selectedFiles = validFiles;
        mainImageIndex = 0;
        updateFileInput();
        renderPreviews();
    });

    // Drag and drop functionality
    const dropZone = $('.border-dashed').parent();
    
    dropZone.on('dragover', function(e) {
        e.preventDefault();
        $(this).find('.border-dashed').addClass('border-purple-400 bg-purple-50');
    });
    
    dropZone.on('dragleave', function(e) {
        e.preventDefault();
        $(this).find('.border-dashed').removeClass('border-purple-400 bg-purple-50');
    });
    
    dropZone.on('drop', function(e) {
        e.preventDefault();
        $(this).find('.border-dashed').removeClass('border-purple-400 bg-purple-50');
        
        const files = Array.from(e.originalEvent.dataTransfer.files);
        
        // Validate file count
        if (files.length > 10) {
            alert('Maksimal 10 gambar yang dapat diupload');
            return;
        }
        
        // Validate file size and type
        const validFiles = files.filter(file => {
            if (file.size > 5 * 1024 * 1024) { // 5MB
                alert(`File ${file.name} terlalu besar. Maksimal 5MB per file.`);
                return false;
            }
            if (!file.type.match(/^image\/(png|jpg|jpeg|gif|webp)$/)) {
                alert(`File ${file.name} bukan format gambar yang didukung.`);
                return false;
            }
            return true;
        });
        
        selectedFiles = validFiles;
        mainImageIndex = 0;
        updateFileInput();
        renderPreviews();
    });

    // Event listeners
    $('#original_price, #discounted_price').on('input', function() {
        calculateDiscountPercentage();
    });

    // Initial calculation if values are already filled
    calculateDiscountPercentage();
});
</script>
@endpush