@extends('Frontend.layouts.main')

@section('container')
<div class="min-h-screen bg-gray-50 py-4 sm:py-8">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-6 sm:mb-8">
            <div class="flex flex-wrap items-center space-x-2 text-xs sm:text-sm text-gray-500 mb-3 sm:mb-4">
                <a href="{{ route('guest-booking.index') }}" class="hover:text-blue-500 transition-colors">Pencarian</a>
                <i class="fas fa-chevron-right text-xs"></i>
                <span class="break-words">Hasil untuk "{{ $destinasi }}"</span>
            </div>
            
            <h1 class="text-xl sm:text-2xl lg:text-3xl font-bold text-gray-800 break-words">
                Hasil Pencarian untuk "{{ $destinasi }}"
            </h1>
        </div>

        @if($isAvailable && $layananTersedia->count() > 0)
            <!-- Paket Tersedia -->
            <div class="mb-6 sm:mb-8">
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 sm:p-6 mb-4 sm:mb-6">
                    <div class="flex items-start sm:items-center space-x-3">
                        <i class="fas fa-check-circle text-green-500 text-xl sm:text-2xl flex-shrink-0 mt-1 sm:mt-0"></i>
                        <div class="min-w-0 flex-1">
                            <h2 class="text-lg sm:text-xl font-bold text-green-800 mb-1">Paket Wisata Tersedia!</h2>
                            <p class="text-sm sm:text-base text-green-700">Kami menemukan {{ $layananTersedia->count() }} paket wisata yang sesuai dengan pencarian Anda.</p>
                        </div>
                    </div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-6 mb-6 sm:mb-8">
                    @foreach($layananTersedia as $layanan)
                        <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                            @if($layanan->gambar_destinasi)
                                @php
                                    $gambar = is_string($layanan->gambar_destinasi) 
                                        ? json_decode($layanan->gambar_destinasi, true) 
                                        : $layanan->gambar_destinasi;
                                @endphp
                                @if($gambar && is_array($gambar) && count($gambar) > 0)
                                     <img src="{{ asset('storage/' . $gambar[0]) }}" alt="{{ $layanan->nama_layanan }}" class="w-full h-40 sm:h-48 object-cover">
                                 @else
                                     <div class="w-full h-40 sm:h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                         <i class="fas fa-image text-white text-3xl sm:text-4xl"></i>
                                     </div>
                                 @endif
                             @else
                                <div class="w-full h-40 sm:h-48 bg-gradient-to-br from-blue-400 to-purple-500 flex items-center justify-center">
                                    <i class="fas fa-image text-white text-3xl sm:text-4xl"></i>
                                </div>
                            @endif
                            
                            <div class="p-4 sm:p-6">
                                <h3 class="font-bold text-base sm:text-lg text-gray-800 mb-2 line-clamp-2">{{ $layanan->nama_layanan }}</h3>
                                <p class="text-gray-600 text-xs sm:text-sm mb-3 line-clamp-2">{{ Str::limit($layanan->deskripsi, 100) }}</p>
                                
                                <div class="space-y-2 mb-4">
                                    <div class="flex items-center text-xs sm:text-sm text-gray-600">
                                        <i class="fas fa-map-marker-alt w-3 sm:w-4 flex-shrink-0"></i>
                                        <span class="ml-2 truncate">{{ $layanan->lokasi_tujuan }}</span>
                                    </div>
                                    <div class="flex items-center text-xs sm:text-sm text-gray-600">
                                        <i class="fas fa-calendar w-3 sm:w-4 flex-shrink-0"></i>
                                        <span class="ml-2">{{ $layanan->durasi_hari }} hari</span>
                                    </div>
                                    <div class="flex items-center text-xs sm:text-sm text-gray-600">
                                        <i class="fas fa-users w-3 sm:w-4 flex-shrink-0"></i>
                                        <span class="ml-2">Maks {{ $layanan->maks_orang }} orang</span>
                                    </div>
                                </div>
                                
                                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between space-y-3 sm:space-y-0">
                                    <div class="flex-1">
                                        <span class="text-xs sm:text-sm text-gray-500">Mulai dari</span>
                                        <div class="text-lg sm:text-xl font-bold text-blue-600">
                                            Rp {{ number_format($layanan->harga_mulai, 0, ',', '.') }}
                                        </div>
                                    </div>
                                    <a href="{{ route('guest-booking.form', ['destinasi' => $destinasi, 'layanan_id' => $layanan->layanan_id]) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white px-3 sm:px-4 py-2 rounded-lg text-xs sm:text-sm font-medium transition-colors text-center w-full sm:w-auto">
                                        Pilih Paket
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <!-- Divider -->
            <div class="flex items-center my-6 sm:my-8">
                <div class="flex-1 border-t border-gray-300"></div>
                <span class="px-3 sm:px-4 text-sm sm:text-base text-gray-500 font-medium">ATAU</span>
                <div class="flex-1 border-t border-gray-300"></div>
            </div>
        @else
            <!-- Tidak Ada Paket -->
            <div class="mb-6 sm:mb-8">
                <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 sm:p-6 mb-4 sm:mb-6">
                    <div class="flex items-start sm:items-center space-x-3">
                        <i class="fas fa-exclamation-triangle text-yellow-500 text-xl sm:text-2xl flex-shrink-0 mt-1 sm:mt-0"></i>
                        <div class="min-w-0 flex-1">
                            <h2 class="text-lg sm:text-xl font-bold text-yellow-800 mb-1">Paket Belum Tersedia</h2>
                            <p class="text-sm sm:text-base text-yellow-700">Maaf, kami belum memiliki paket wisata untuk destinasi "{{ $destinasi }}". Tapi jangan khawatir!</p>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <!-- Custom Request Option -->
        <div class="bg-white rounded-xl shadow-lg p-4 sm:p-6 lg:p-8">
            <div class="text-center mb-6">
                <div class="w-12 h-12 sm:w-16 sm:h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-magic text-purple-500 text-lg sm:text-2xl"></i>
                </div>
                <h2 class="text-xl sm:text-2xl font-bold text-gray-800 mb-2">Buat Permintaan Khusus</h2>
                <p class="text-sm sm:text-base text-gray-600 px-2">
                    @if($isAvailable)
                        Tidak cocok dengan paket yang tersedia? Atau ingin sesuatu yang lebih personal?
                    @else
                        Kami akan buatkan paket wisata khusus sesuai keinginan Anda!
                    @endif
                </p>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 mb-6 sm:mb-8">
                <div class="space-y-4">
                    <h3 class="font-bold text-base sm:text-lg text-gray-800">Keuntungan Custom Request:</h3>
                    <ul class="space-y-2 sm:space-y-3">
                        <li class="flex items-start text-sm sm:text-base text-gray-600">
                            <i class="fas fa-check text-green-500 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Itinerary disesuaikan dengan keinginan</span>
                        </li>
                        <li class="flex items-start text-sm sm:text-base text-gray-600">
                            <i class="fas fa-check text-green-500 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Budget fleksibel sesuai kemampuan</span>
                        </li>
                        <li class="flex items-start text-sm sm:text-base text-gray-600">
                            <i class="fas fa-check text-green-500 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Tanggal keberangkatan bebas</span>
                        </li>
                        <li class="flex items-start text-sm sm:text-base text-gray-600">
                            <i class="fas fa-check text-green-500 mr-3 mt-1 flex-shrink-0"></i>
                            <span>Konsultasi gratis dengan travel expert</span>
                        </li>
                    </ul>
                </div>
                
                <div class="space-y-4">
                    <h3 class="font-bold text-base sm:text-lg text-gray-800">Proses Custom Request:</h3>
                    <div class="space-y-3">
                        <div class="flex items-start text-sm sm:text-base text-gray-600">
                            <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">1</div>
                            <span>Isi form permintaan</span>
                        </div>
                        <div class="flex items-start text-sm sm:text-base text-gray-600">
                            <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">2</div>
                            <span>Tim kami akan menghubungi Anda</span>
                        </div>
                        <div class="flex items-start text-sm sm:text-base text-gray-600">
                            <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">3</div>
                            <span>Diskusi detail dan finalisasi</span>
                        </div>
                        <div class="flex items-start text-sm sm:text-base text-gray-600">
                            <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 flex-shrink-0 mt-0.5">4</div>
                            <span>Nikmati perjalanan impian!</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="{{ route('guest-booking.form', ['destinasi' => $destinasi, 'is_custom' => true]) }}" 
                   class="inline-block bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-bold py-3 sm:py-4 px-6 sm:px-8 rounded-xl text-sm sm:text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200 w-full sm:w-auto">
                    <i class="fas fa-paper-plane mr-2"></i>
                    Buat Permintaan Khusus
                </a>
            </div>
        </div>

        <!-- Back Button -->
        <div class="mt-6 sm:mt-8 text-center">
            <a href="{{ route('guest-booking.index') }}" 
               class="inline-flex items-center text-sm sm:text-base text-gray-600 hover:text-blue-500 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali ke Pencarian
            </a>
        </div>
    </div>
</div>
@endsection