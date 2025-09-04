@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,2A2,2 0 0,1 14,4V8A2,2 0 0,1 12,10A2,2 0 0,1 10,8V4A2,2 0 0,1 12,2M21,9V7L15,1H5A2,2 0 0,0 3,3V21A2,2 0 0,0 5,23H19A2,2 0 0,0 21,21V9Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Edit Layanan Travel</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Edit data layanan travel: {{ $layanan->nama_layanan }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.layanan.show', $layanan) }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5S21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12S9.24 7 12 7S17 9.24 17 12S14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12S10.34 15 12 15S15 13.66 15 12S13.66 9 12 9Z"/>
                        </svg>
                        Lihat Detail
                    </a>
                    <a href="{{ route('admin.layanan.index') }}" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                        </svg>
                        Kembali
                    </a>
                </div>
            </div>
        </div>

        <!-- Form -->
        <div class="px-4">
            <div class="bg-white rounded-xl shadow-md p-8">
                <form action="{{ route('admin.layanan.update', $layanan) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nama Layanan -->
                        <div class="md:col-span-2">
                            <label for="nama_layanan" class="block text-sm font-medium text-gray-700 mb-2">Nama Layanan *</label>
                            <input type="text" id="nama_layanan" name="nama_layanan" value="{{ old('nama_layanan', $layanan->nama_layanan) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('nama_layanan') border-red-500 @enderror"
                                   placeholder="Masukkan nama layanan" required>
                            @error('nama_layanan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Jenis Layanan -->
                        <div>
                            <label for="jenis_layanan" class="block text-sm font-medium text-gray-700 mb-2">Jenis Layanan *</label>
                            <select id="jenis_layanan" name="jenis_layanan"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('jenis_layanan') border-red-500 @enderror" required>
                                <option value="">Pilih Jenis Layanan</option>
                                @foreach($jenisLayananOptions as $key => $label)
                                    <option value="{{ $key }}" {{ old('jenis_layanan', $layanan->jenis_layanan) == $key ? 'selected' : '' }}>{{ $label }}</option>
                                @endforeach
                            </select>
                            @error('jenis_layanan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div>
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status *</label>
                            <select id="status" name="status"
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('status') border-red-500 @enderror" required>
                                <option value="aktif" {{ old('status', $layanan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="nonaktif" {{ old('status', $layanan->status) == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                            </select>
                            @error('status')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Harga Mulai -->
                        <div>
                            <label for="harga_mulai" class="block text-sm font-medium text-gray-700 mb-2">Harga Mulai (Rp) *</label>
                            <input type="number" id="harga_mulai" name="harga_mulai" value="{{ old('harga_mulai', $layanan->harga_mulai) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('harga_mulai') border-red-500 @enderror"
                                   placeholder="0" min="0" step="1000" required>
                            @error('harga_mulai')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>



                        <!-- Durasi Perjalanan -->
                        <div>
                            <label for="durasi_hari" class="block text-sm font-medium text-gray-700 mb-2">Durasi Perjalanan (Hari) *</label>
                            <input type="number" id="durasi_hari" name="durasi_hari" value="{{ old('durasi_hari', $layanan->durasi_hari) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('durasi_hari') border-red-500 @enderror"
                                   placeholder="1" min="1" required>
                            @error('durasi_hari')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi Tujuan -->
                        <div>
                            <label for="lokasi_tujuan" class="block text-sm font-medium text-gray-700 mb-2">Lokasi Tujuan *</label>
                            <input type="text" id="lokasi_tujuan" name="lokasi_tujuan" value="{{ old('lokasi_tujuan', $layanan->lokasi_tujuan) }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('lokasi_tujuan') border-red-500 @enderror"
                                   placeholder="Masukkan lokasi tujuan" required>
                            @error('lokasi_tujuan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fasilitas -->
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">Fasilitas</label>
                            <div id="fasilitas-container">
                                @php
                                    $fasilitasData = old('fasilitas', $layanan->fasilitas ?? []);
                                    if (is_string($fasilitasData)) {
                                        $fasilitasData = json_decode($fasilitasData, true) ?? [];
                                    }
                                    if (empty($fasilitasData)) {
                                        $fasilitasData = [''];
                                    }
                                @endphp
                                @foreach($fasilitasData as $index => $fasilitas)
                                <div class="fasilitas-item flex items-center gap-2 mb-2">
                                    <input type="text" name="fasilitas[]" value="{{ $fasilitas }}"
                                           class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                                           placeholder="Contoh: Hotel berbintang">
                                    <button type="button" onclick="removeFasilitas(this)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-3 rounded-lg transition-colors duration-200">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                                        </svg>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                            <button type="button" onclick="addFasilitas()" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2 mt-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M19,13H13V19H11V13H5V11H11V5H13V11H19V13Z"/>
                                </svg>
                                Tambah Fasilitas
                            </button>
                            @error('fasilitas')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('fasilitas.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div class="md:col-span-2">
                            <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-2">Deskripsi Layanan *</label>
                            <textarea id="deskripsi" name="deskripsi" rows="4"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('deskripsi') border-red-500 @enderror"
                                      placeholder="Deskripsi layanan travel..." required>{{ old('deskripsi', $layanan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Gambar Destinasi -->
                        <div class="md:col-span-2">
                            <label for="gambar_destinasi" class="block text-sm font-medium text-gray-700 mb-2">Gambar Destinasi (Maksimal 5 gambar)</label>
                            
                            <!-- Existing Images -->
                            @if($layanan->gambar_destinasi && count($layanan->gambar_destinasi) > 0)
                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Gambar yang sudah ada:</p>
                                    <div id="existing-images" class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4 mb-4">
                                        @foreach($layanan->gambar_destinasi as $index => $image)
                                            <div class="relative group existing-image-item" data-index="{{ $index }}">
                                                <img src="{{ asset('storage/' . $image) }}" class="w-full h-24 object-cover rounded-lg border border-gray-200">
                                                <button type="button" onclick="removeExistingImage({{ $index }})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                                    ×
                                                </button>
                                                <p class="text-xs text-gray-500 mt-1 truncate">{{ basename($image) }}</p>
                                                <input type="hidden" name="existing_images[]" value="{{ $image }}">
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                            
                            <!-- Upload New Images -->
                            <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-indigo-400 transition-colors duration-200">
                                <input type="file" id="gambar_destinasi" name="gambar_destinasi[]" multiple accept="image/*" class="hidden" onchange="previewImages(this)">
                                <div id="upload-area" class="cursor-pointer" onclick="document.getElementById('gambar_destinasi').click()">
                                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <p class="mt-2 text-sm text-gray-600">Klik untuk upload gambar baru atau drag & drop</p>
                                    <p class="text-xs text-gray-500">PNG, JPG, JPEG, GIF hingga 2MB per file</p>
                                </div>
                            </div>
                            <div id="image-preview" class="mt-4 grid grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-4"></div>
                            @error('gambar_destinasi')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                            @error('gambar_destinasi.*')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Catatan -->
                        <div class="md:col-span-2">
                            <label for="catatan" class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan</label>
                            <textarea id="catatan" name="catatan" rows="3"
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent @error('catatan') border-red-500 @enderror"
                                      placeholder="Catatan tambahan (opsional)">{{ old('catatan', $layanan->catatan) }}</textarea>
                            @error('catatan')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Legacy Ukuran Section - Hidden as not applicable to current Layanan model -->
                    <div class="mt-8 pt-8 border-t border-gray-200 hidden">
                        <!-- Size management functionality removed as it's not relevant to travel services -->
                    </div>

                    <!-- Submit Buttons -->
                    <div class="flex items-center justify-end gap-4 mt-8 pt-6 border-t border-gray-200">
                        <a href="{{ route('admin.layanan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-3 rounded-lg font-medium transition-colors duration-200">
                            Batal
                        </a>
                        <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M17,9H7V7H17M17,13H7V11H17M14,17H7V15H14M12,3A1,1 0 0,1 13,4A1,1 0 0,1 12,5A1,1 0 0,1 11,4A1,1 0 0,1 12,3M19,3H14.82C14.4,1.84 13.3,1 12,1C10.7,1 9.6,1.84 9.18,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3Z"/>
                            </svg>
                            Update Layanan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            console.log('Edit layanan travel form loaded');
        });
        
        function addFasilitas() {
            addFasilitasItem('');
        }
        
        function addFasilitasItem(value = '') {
            const container = document.getElementById('fasilitas-container');
            const div = document.createElement('div');
            div.className = 'fasilitas-item flex items-center gap-2 mb-2';
            div.innerHTML = `
                <input type="text" name="fasilitas[]" value="${value}"
                       class="flex-1 px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent"
                       placeholder="Contoh: Hotel berbintang">
                <button type="button" onclick="removeFasilitas(this)" class="bg-red-500 hover:bg-red-600 text-white px-3 py-3 rounded-lg transition-colors duration-200">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                    </svg>
                </button>
            `;
            container.appendChild(div);
        }
        
        function removeFasilitas(button) {
            const container = document.getElementById('fasilitas-container');
            if (container.children.length > 1) {
                button.parentElement.remove();
            } else {
                // If it's the last item, just clear the input
                const input = button.parentElement.querySelector('input');
                input.value = '';
            }
        }
        
        function previewImages(input) {
            const previewContainer = document.getElementById('image-preview');
            const uploadArea = document.getElementById('upload-area');
            const existingImagesCount = document.querySelectorAll('.existing-image-item:not(.removed)').length;
            
            // Clear previous previews
            previewContainer.innerHTML = '';
            
            if (input.files && input.files.length > 0) {
                // Check total images (existing + new)
                const totalImages = existingImagesCount + input.files.length;
                if (totalImages > 5) {
                    alert(`Total gambar tidak boleh lebih dari 5! Anda sudah memiliki ${existingImagesCount} gambar.`);
                    input.value = '';
                    return;
                }
                
                // Hide upload area when files are selected
                uploadArea.style.display = 'none';
                
                Array.from(input.files).forEach((file, index) => {
                    if (file.type.startsWith('image/')) {
                        const reader = new FileReader();
                        reader.onload = function(e) {
                            const imageDiv = document.createElement('div');
                            imageDiv.className = 'relative group';
                            imageDiv.innerHTML = `
                                <img src="${e.target.result}" class="w-full h-24 object-cover rounded-lg border border-gray-200">
                                <button type="button" onclick="removeNewImage(${index})" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full w-6 h-6 flex items-center justify-center text-xs hover:bg-red-600 opacity-0 group-hover:opacity-100 transition-opacity">
                                    ×
                                </button>
                                <p class="text-xs text-gray-500 mt-1 truncate">${file.name}</p>
                            `;
                            previewContainer.appendChild(imageDiv);
                        };
                        reader.readAsDataURL(file);
                    }
                });
                
                // Add upload more button if total less than 5 images
                if (totalImages < 5) {
                    const addMoreDiv = document.createElement('div');
                    addMoreDiv.className = 'flex items-center justify-center h-24 border-2 border-dashed border-gray-300 rounded-lg cursor-pointer hover:border-indigo-400 transition-colors';
                    addMoreDiv.onclick = () => input.click();
                    addMoreDiv.innerHTML = `
                        <div class="text-center">
                            <svg class="mx-auto h-6 w-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <p class="text-xs text-gray-500 mt-1">Tambah</p>
                        </div>
                    `;
                    previewContainer.appendChild(addMoreDiv);
                }
            } else {
                // Show upload area when no files
                uploadArea.style.display = 'block';
            }
        }
        
        function removeNewImage(index) {
            const input = document.getElementById('gambar_destinasi');
            const dt = new DataTransfer();
            
            Array.from(input.files).forEach((file, i) => {
                if (i !== index) {
                    dt.items.add(file);
                }
            });
            
            input.files = dt.files;
            previewImages(input);
        }
        
        function removeExistingImage(index) {
            const imageItem = document.querySelector(`.existing-image-item[data-index="${index}"]`);
            if (imageItem) {
                imageItem.classList.add('removed');
                imageItem.style.display = 'none';
                // Remove the hidden input so the image will be deleted
                const hiddenInput = imageItem.querySelector('input[name="existing_images[]"]');
                if (hiddenInput) {
                    hiddenInput.remove();
                }
            }
        }
    </script>

@endsection
