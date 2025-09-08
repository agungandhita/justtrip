@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative h-96 bg-gradient-to-r from-blue-600 to-purple-600 overflow-hidden">
    <div class="absolute inset-0 bg-black/30"></div>
    @if($type === 'special_offer')
        @if($package->image)
            <img src="{{ asset('storage/' . $package->image) }}" alt="{{ $package->title }}" class="absolute inset-0 w-full h-full object-cover">
        @endif
    @else
        @if($package->gambar_destinasi && count($package->gambar_destinasi) > 0)
            <img src="{{ asset('storage/' . $package->gambar_destinasi[0]) }}" alt="{{ $package->nama_layanan }}" class="absolute inset-0 w-full h-full object-cover">
        @endif
    @endif
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

    <div class="relative z-10 container mx-auto px-4 h-full flex items-center">
        <div class="text-white max-w-2xl">
            @if($type === 'special_offer')
                <div class="mb-4">
                    <span class="bg-red-500 text-white px-4 py-2 rounded-full text-sm font-semibold">{{ $package->badge ?? 'Special Offer' }}</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $package->title }}</h1>
                <p class="text-xl mb-6">{{ $package->discount_percentage }}% OFF - Hemat Rp {{ number_format($package->original_price - $package->discounted_price, 0, ',', '.') }}</p>
            @else
                <div class="mb-4">
                    <span class="bg-blue-500 text-white px-4 py-2 rounded-full text-sm font-semibold">{{ ucfirst($package->jenis_layanan) }}</span>
                </div>
                <h1 class="text-4xl md:text-6xl font-bold mb-4">{{ $package->nama_layanan }}</h1>
                <p class="text-xl mb-6">
                    {{ $package->durasi_hari }} Hari di {{ $package->lokasi_tujuan }}
                    • Maks {{ $package->maks_orang }} Orang
                </p>
            @endif

            <div class="flex items-center space-x-6">
                <div class="flex items-center">
                    <span class="text-yellow-400 mr-2">★★★★★</span>
                    <span class="text-lg">(4.8) • 150+ Reviews</span>
                </div>
                <div class="flex items-center">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <span class="text-lg">{{ $type === 'special_offer' ? $package->layanan->lokasi_tujuan : $package->lokasi_tujuan }}</span>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Package Details -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-3 gap-12">
            <!-- Main Content -->
            <div class="lg:col-span-2">
                <!-- Price & Booking Card -->
                <div class="bg-gradient-to-r from-emerald-50 to-teal-50 rounded-2xl p-8 mb-8 border border-emerald-100">
                    <div class="flex flex-col md:flex-row md:items-center justify-between">
                        <div class="mb-4 md:mb-0">
                            @if($type === 'special_offer')
                                <div class="flex items-center space-x-4 mb-2">
                                    <span class="text-gray-400 line-through text-2xl">Rp {{ number_format($package->original_price, 0, ',', '.') }}</span>
                                    <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">-{{ $package->discount_percentage }}%</span>
                                </div>
                                <div class="text-4xl font-bold text-emerald-600">Rp {{ number_format($package->discounted_price, 0, ',', '.') }}</div>
                                <p class="text-gray-600">per orang</p>
                                <p class="text-sm text-red-600 font-semibold mt-2">⏰ Berakhir {{ $package->valid_until->format('d M Y') }}</p>
                            @else
                                <div class="text-4xl font-bold text-emerald-600">Rp {{ number_format($package->harga_mulai, 0, ',', '.') }}</div>
                                <p class="text-gray-600">per orang</p>
                                @if($package->maks_orang)
                                    <p class="text-sm text-blue-600 font-semibold mt-1">👥 Kapasitas maksimal: {{ $package->maks_orang }} orang</p>
                                @endif
                                <p class="text-sm text-green-600 font-semibold mt-2">✅ Tersedia setiap hari</p>
                            @endif
                        </div>
                        <div class="flex space-x-4">
                            @auth
                                @if($type === 'special_offer')
                                    <a href="{{ route('booking.create-from-offer', $package->id) }}" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                                        Book Sekarang
                                    </a>
                                @else
                                    <a href="{{ route('booking.create', $package->layanan_id) }}" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                                        Book Sekarang
                                    </a>
                                @endif
                            @else
                                <a href="{{ route('login') }}" class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                                    Login untuk Book
                                </a>
                            @endauth
                            <button class="bg-white border-2 border-emerald-500 text-emerald-500 hover:bg-emerald-50 font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300">
                                💬 Chat Admin
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Deskripsi Paket</h2>
                    <div class="prose prose-lg max-w-none text-gray-600">
                        @if($type === 'special_offer')
                            <p>{{ $package->description }}</p>
                            @if($package->layanan)
                                <h3 class="text-xl font-semibold mt-6 mb-4">Detail Layanan:</h3>
                                <p>{{ $package->layanan->deskripsi }}</p>
                            @endif
                        @else
                            <p>{{ $package->deskripsi }}</p>
                        @endif
                    </div>
                </div>

                <!-- Facilities -->
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Fasilitas Termasuk</h2>
                    <div class="grid md:grid-cols-2 gap-4">
                        @if($type === 'special_offer' && $package->layanan && $package->layanan->fasilitas)
                            @php
                                $fasilitasArray = is_array($package->layanan->fasilitas) ? $package->layanan->fasilitas : explode(',', $package->layanan->fasilitas);
                            @endphp
                            @foreach($fasilitasArray as $fasilitas)
                                <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 font-medium">{{ trim($fasilitas) }}</span>
                                </div>
                            @endforeach
                        @elseif($type === 'layanan' && $package->fasilitas)
                            @php
                                $fasilitasArray = is_array($package->fasilitas) ? $package->fasilitas : explode(',', $package->fasilitas);
                            @endphp
                            @foreach($fasilitasArray as $fasilitas)
                                <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg">
                                    <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-gray-700 font-medium">{{ trim($fasilitas) }}</span>
                                </div>
                            @endforeach
                        @else
                            <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Paket tour lengkap</span>
                            </div>
                            <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Tour guide berpengalaman</span>
                            </div>
                            <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Transportasi nyaman</span>
                            </div>
                            <div class="flex items-center space-x-3 p-4 bg-green-50 rounded-lg">
                                <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <span class="text-gray-700 font-medium">Akomodasi terbaik</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Gallery -->
                @if(($type === 'layanan' && $package->gambar_destinasi && count($package->gambar_destinasi) > 1) || ($type === 'special_offer' && $package->layanan && $package->layanan->gambar_destinasi && count($package->layanan->gambar_destinasi) > 1))
                <div class="mb-8">
                    <h2 class="text-3xl font-bold text-gray-800 mb-6">Galeri Foto</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @php
                            $images = $type === 'special_offer' ? $package->layanan->gambar_destinasi : $package->gambar_destinasi;
                        @endphp
                        @foreach($images as $image)
                            <div class="relative group overflow-hidden rounded-lg">
                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                                <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-colors duration-300"></div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar -->
            <div class="lg:col-span-1">
                <!-- Quick Info -->
                <div class="bg-white rounded-2xl shadow-lg p-6 mb-8 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Info Singkat</h3>
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Durasi</span>
                            <span class="font-semibold">{{ $type === 'special_offer' ? $package->layanan->durasi_hari : $package->durasi_hari }} Hari</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Destinasi</span>
                            <span class="font-semibold">{{ $type === 'special_offer' ? $package->layanan->lokasi_tujuan : $package->lokasi_tujuan }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Jenis</span>
                            <span class="font-semibold">{{ $type === 'special_offer' ? ucfirst($package->layanan->jenis_layanan) : ucfirst($package->jenis_layanan) }}</span>
                        </div>
                        <div class="flex items-center justify-between">
                            <span class="text-gray-600">Status</span>
                            @if($type === 'special_offer')
                                @if($package->valid_until >= now())
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-semibold">Tersedia</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm font-semibold">Berakhir</span>
                                @endif
                            @else
                                @if($package->status === 'aktif')
                                    <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-sm font-semibold">Aktif</span>
                                @else
                                    <span class="bg-red-100 text-red-800 px-2 py-1 rounded-full text-sm font-semibold">Nonaktif</span>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Contact Info -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 mb-8 border border-blue-100">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Butuh Bantuan?</h3>
                    <div class="space-y-3">
                        <a href="tel:+6281234567890" class="flex items-center space-x-3 p-3 bg-white rounded-lg hover:bg-blue-50 transition-colors">
                            <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">Telepon</div>
                                <div class="text-sm text-gray-600">+62 812-3456-7890</div>
                            </div>
                        </a>
                        <a href="https://wa.me/6281234567890" class="flex items-center space-x-3 p-3 bg-white rounded-lg hover:bg-green-50 transition-colors">
                            <div class="w-10 h-10 bg-green-500 rounded-full flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488"/>
                                </svg>
                            </div>
                            <div>
                                <div class="font-semibold text-gray-800">WhatsApp</div>
                                <div class="text-sm text-gray-600">Chat langsung</div>
                            </div>
                        </a>
                    </div>
                </div>

                <!-- Related Packages -->
                @if($relatedPackages && count($relatedPackages) > 0)
                <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100">
                    <h3 class="text-xl font-bold text-gray-800 mb-4">Paket Lainnya</h3>
                    <div class="space-y-4">
                        @foreach($relatedPackages->take(3) as $related)
                            <a href="{{ route('packages.show', $related->slug) }}" class="block group">
                                <div class="flex space-x-3 p-3 rounded-lg hover:bg-gray-50 transition-colors">
                                    @if($related->gambar_destinasi && count($related->gambar_destinasi) > 0)
                                        <img src="{{ asset('storage/' . $related->gambar_destinasi[0]) }}" alt="{{ $related->nama_layanan ?? $related->title }}" class="w-16 h-16 object-cover rounded-lg">
                                    @else
                                        <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                            <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                            </svg>
                                        </div>
                                    @endif
                                    <div class="flex-1">
                                        <h4 class="font-semibold text-gray-800 group-hover:text-blue-600 transition-colors">{{ $related->nama_layanan ?? $related->title }}</h4>
                                        <p class="text-sm text-gray-600">{{ $related->lokasi_tujuan ?? ($related->layanan ? $related->layanan->lokasi_tujuan : '') }}</p>
                                        <p class="text-sm font-semibold text-emerald-600">
                                            @if(isset($related->discounted_price))
                                                Rp {{ number_format($related->discounted_price, 0, ',', '.') }}
                                            @else
                                                Rp {{ number_format($related->harga_mulai, 0, ',', '.') }}
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
