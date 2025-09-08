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
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Detail Layanan Travel</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Informasi lengkap layanan travel: {{ $layanan->nama_layanan }}</p>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.layanan.edit', $layanan) }}" class="bg-yellow-600 hover:bg-yellow-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                        </svg>
                        Edit
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

        <!-- Service Details -->
        <div class="px-4">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Main Information -->
                <div class="lg:col-span-2">
                    <div class="bg-white rounded-xl shadow-md p-8">
                        <div class="flex items-center justify-between mb-6">
                            <h2 class="text-2xl font-bold text-gray-800">{{ $layanan->nama_layanan }}</h2>
                            <span class="inline-flex px-3 py-1 text-sm font-semibold rounded-full {{ $layanan->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                {{ ucfirst($layanan->status) }}
                            </span>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                            <!-- Jenis Layanan -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,2A2,2 0 0,1 14,4V8A2,2 0 0,1 12,10A2,2 0 0,1 10,8V4A2,2 0 0,1 12,2Z"/>
                                    </svg>
                                    <h3 class="font-semibold text-gray-700">Jenis Layanan</h3>
                                </div>
                                <span class="inline-flex px-2 py-1 text-sm font-medium rounded-full bg-blue-100 text-blue-800">
                                    {{ $layanan->jenis_layanan_label }}
                                </span>
                            </div>

                            <!-- Harga -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M7,15H9C9,16.08 10.37,17 12,17C13.63,17 15,16.08 15,15C15,13.9 13.96,13.5 11.76,12.97C9.64,12.44 7,11.78 7,9C7,7.21 8.47,5.69 10.5,5.18V3H13.5V5.18C15.53,5.69 17,7.21 17,9H15C15,7.92 13.63,7 12,7C10.37,7 9,7.92 9,9C9,10.1 10.04,10.5 12.24,11.03C14.36,11.56 17,12.22 17,15C17,16.79 15.53,18.31 13.5,18.82V21H10.5V18.82C8.47,18.31 7,16.79 7,15Z"/>
                                    </svg>
                                    <h3 class="font-semibold text-gray-700">Harga</h3>
                                </div>
                                <p class="text-lg font-bold text-green-600">{{ $layanan->harga_format }}</p>
                            </div>

                            <!-- Durasi -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22C6.47,22 2,17.5 2,12A10,10 0 0,1 12,2M12.5,7V12.25L17,14.92L16.25,16.15L11,13V7H12.5Z"/>
                                    </svg>
                                    <h3 class="font-semibold text-gray-700">Durasi Perjalanan</h3>
                                </div>
                                <p class="text-lg font-bold text-purple-600">{{ $layanan->durasi_format }}</p>
                            </div>

                            <!-- Maksimal Orang -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-blue-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M16,4C18.11,4 20,5.89 20,8C20,10.11 18.11,12 16,12C13.89,12 12,10.11 12,8C12,5.89 13.89,4 16,4M16,14C20.42,14 24,15.79 24,18V20H8V18C8,15.79 11.58,14 16,14M6,6C7.11,6 8,6.89 8,8C8,9.11 7.11,10 6,10C4.89,10 4,9.11 4,8C4,6.89 4.89,6 6,6M6,12C8.67,12 10,12.67 10,14V16H0V14C0,12.67 1.33,12 6,12Z"/>
                                    </svg>
                                    <h3 class="font-semibold text-gray-700">Kapasitas Maksimal</h3>
                                </div>
                                <p class="text-lg font-bold text-blue-600">{{ $layanan->maks_orang }} orang</p>
                            </div>

                            <!-- Tanggal Dibuat -->
                            <div class="bg-gray-50 rounded-lg p-4">
                                <div class="flex items-center gap-3 mb-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-gray-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19,3H18V1H16V3H8V1H6V3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M19,19H5V8H19V19Z"/>
                                    </svg>
                                    <h3 class="font-semibold text-gray-700">Tanggal Dibuat</h3>
                                </div>
                                <p class="text-sm text-gray-600">{{ $layanan->created_at->format('d F Y, H:i') }}</p>
                            </div>
                        </div>

                        <!-- Lokasi Tujuan -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-red-600" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,11.5A2.5,2.5 0 0,1 9.5,9A2.5,2.5 0 0,1 12,6.5A2.5,2.5 0 0,1 14.5,9A2.5,2.5 0 0,1 12,11.5M12,2A7,7 0 0,0 5,9C5,14.25 12,22 12,22C12,22 19,14.25 19,9A7,7 0 0,0 12,2Z"/>
                                </svg>
                                Lokasi Tujuan
                            </h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed">{{ $layanan->lokasi_tujuan }}</p>
                            </div>
                        </div>

                        <!-- Gambar Destinasi -->
                        @if($layanan->gambar_destinasi && count($layanan->gambar_destinasi) > 0)
                            <div class="mb-6">
                                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z"/>
                                    </svg>
                                    Gambar Destinasi ({{ count($layanan->gambar_destinasi) }} foto)
                                </h3>
                                <div class="bg-gray-50 rounded-lg p-4">
                                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                                        @foreach($layanan->gambar_destinasi as $index => $gambar)
                                            <div class="relative group">
                                                <img src="{{ Storage::url($gambar) }}"
                                                     alt="Gambar Destinasi {{ $index + 1 }}"
                                                     class="w-full h-48 object-cover rounded-lg shadow-md hover:shadow-lg transition-shadow duration-200 cursor-pointer"
                                                     onclick="openImageModal('{{ Storage::url($gambar) }}', 'Gambar Destinasi {{ $index + 1 }}')">
                                                <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-all duration-200 rounded-lg flex items-center justify-center">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M12,9A3,3 0 0,0 9,12A3,3 0 0,0 12,15A3,3 0 0,0 15,12A3,3 0 0,0 12,9M12,17A5,5 0 0,1 7,12A5,5 0 0,1 12,7A5,5 0 0,1 17,12A5,5 0 0,1 12,17M12,4.5C7,4.5 2.73,7.61 1,12C2.73,16.39 7,19.5 12,19.5C17,19.5 21.27,16.39 23,12C21.27,7.61 17,4.5 12,4.5Z"/>
                                                    </svg>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                        <!-- Fasilitas -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-600" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M11,16.5L18,9.5L16.59,8.09L11,13.67L7.91,10.59L6.5,12L11,16.5Z"/>
                                </svg>
                                Fasilitas
                            </h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                @if(is_array($layanan->fasilitas) && !empty($layanan->fasilitas))
                                    <ul class="text-gray-700 leading-relaxed list-disc list-inside space-y-1">
                                        @foreach($layanan->fasilitas as $fasilitas)
                                            <li>{{ $fasilitas }}</li>
                                        @endforeach
                                    </ul>
                                @else
                                    <p class="text-gray-700 leading-relaxed">{{ is_string($layanan->fasilitas) ? $layanan->fasilitas : 'Tidak ada fasilitas yang tersedia' }}</p>
                                @endif
                            </div>
                        </div>

                        <!-- Deskripsi -->
                        <div class="mb-6">
                            <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                </svg>
                                Deskripsi Layanan
                            </h3>
                            <div class="bg-gray-50 rounded-lg p-4">
                                <p class="text-gray-700 leading-relaxed">{{ $layanan->deskripsi }}</p>
                            </div>
                        </div>

                        <!-- Catatan -->
                        @if($layanan->catatan)
                            <div>
                                <h3 class="text-lg font-semibold text-gray-800 mb-3 flex items-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-orange-600" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M20,2H4A2,2 0 0,0 2,4V22L6,18H20A2,2 0 0,0 22,16V4A2,2 0 0,0 20,2M20,16H5.17L4,17.17V4H20V16Z"/>
                                    </svg>
                                    Catatan Tambahan
                                </h3>
                                <div class="bg-orange-50 border-l-4 border-orange-400 rounded-lg p-4">
                                    <p class="text-gray-700 leading-relaxed">{{ $layanan->catatan }}</p>
                                </div>
                            </div>
                        @endif


                    </div>
                </div>

                <!-- Action Panel -->
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-xl shadow-md p-6 sticky top-24">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Aksi Layanan</h3>

                        <div class="space-y-3">
                            <!-- Edit Button -->
                            <a href="{{ route('admin.layanan.edit', $layanan) }}" class="w-full bg-yellow-600 hover:bg-yellow-700 text-white px-4 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                                </svg>
                                Edit Layanan
                            </a>

                            <!-- Toggle Status -->
                            <form action="{{ route('admin.layanan.toggle-status', $layanan) }}" method="POST" class="w-full">
                                @csrf
                                <button type="submit" class="w-full {{ $layanan->status == 'aktif' ? 'bg-red-600 hover:bg-red-700' : 'bg-green-600 hover:bg-green-700' }} text-white px-4 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    @if($layanan->status == 'aktif')
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6Z"/>
                                        </svg>
                                        Nonaktifkan
                                    @else
                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                            <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z"/>
                                        </svg>
                                        Aktifkan
                                    @endif
                                </button>
                            </form>

                            <!-- Delete Button -->
                            <form action="{{ route('admin.layanan.destroy', $layanan) }}" method="POST" class="w-full" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini? Tindakan ini tidak dapat dibatalkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full bg-red-600 hover:bg-red-700 text-white px-4 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                                    </svg>
                                    Hapus Layanan
                                </button>
                            </form>

                            <!-- Back Button -->
                            <a href="{{ route('admin.layanan.index') }}" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center justify-center gap-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                                </svg>
                                Kembali ke Daftar
                            </a>
                        </div>

                        <!-- Service Info Summary -->
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <h4 class="text-sm font-semibold text-gray-700 mb-3">Ringkasan Layanan</h4>
                            <div class="space-y-2 text-sm">
                                <div class="flex justify-between">
                                    <span class="text-gray-600">ID Layanan:</span>
                                    <span class="font-medium">#{{ $layanan->layanan_id }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Dibuat:</span>
                                    <span class="font-medium">{{ $layanan->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-600">Diperbarui:</span>
                                    <span class="font-medium">{{ $layanan->updated_at->diffForHumans() }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal untuk melihat gambar -->
    <div id="imageModal" class="fixed inset-0 bg-black bg-opacity-75 z-50 hidden flex items-center justify-center p-4">
        <div class="relative max-w-4xl max-h-full">
            <button onclick="closeImageModal()" class="absolute top-4 right-4 text-white hover:text-gray-300 z-10">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M19,6.41L17.59,5L12,10.59L6.41,5L5,6.41L10.59,12L5,17.59L6.41,19L12,13.41L17.59,19L19,17.59L13.41,12L19,6.41Z"/>
                </svg>
            </button>
            <img id="modalImage" src="" alt="" class="max-w-full max-h-full object-contain rounded-lg">
            <div class="absolute bottom-4 left-4 right-4 text-center">
                <p id="modalCaption" class="text-white text-lg font-medium bg-black bg-opacity-50 rounded px-4 py-2"></p>
            </div>
        </div>
    </div>

    <script>
        function openImageModal(imageSrc, caption) {
            document.getElementById('modalImage').src = imageSrc;
            document.getElementById('modalCaption').textContent = caption;
            document.getElementById('imageModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            document.getElementById('imageModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close modal when clicking outside the image
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeImageModal();
            }
        });

        // Close modal with Escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                closeImageModal();
            }
        });
    </script>
@endsection
