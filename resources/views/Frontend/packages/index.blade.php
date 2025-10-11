@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Background Images with Parallax Effect -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/70 via-teal-600/70 to-cyan-600/70 z-10"></div>
        <div class="bg-cover bg-center h-full" style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-20 text-center text-white px-4 max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold mb-4 sm:mb-6 bg-gradient-to-r from-white to-emerald-100 bg-clip-text text-transparent">
            Paket Tour Terbaik
        </h1>
        <p class="text-sm sm:text-base md:text-lg mb-6 sm:mb-8 text-emerald-100 font-medium" data-aos="fade-up" data-aos-delay="200">
            Nikmati liburan impian dengan paket tour all-inclusive yang dirancang khusus untuk Anda
        </p>
    </div>
</section>



<!-- Package Categories -->
<section class="py-24 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 sm:mb-16" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-3 sm:mb-4">Kategori Paket Tour</h2>
            <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-3xl mx-auto px-4">Pilih paket tour sesuai dengan preferensi dan budget Anda</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Honeymoon Package -->
            <div class="group bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 sm:mb-4 text-center">Honeymoon Package</h3>
                <p class="text-sm sm:text-base text-gray-600 text-center mb-4 sm:mb-6">Paket romantis untuk pasangan yang baru menikah dengan destinasi eksotis</p>
                <div class="text-center">
                    <span class="text-lg sm:text-xl md:text-2xl font-bold text-pink-600">Mulai Rp 8.500.000</span>
                    <p class="text-gray-500 text-xs sm:text-sm">/couple</p>
                </div>
            </div>

            <!-- Family Package -->
            <div class="group bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 sm:mb-4 text-center">Family Package</h3>
                <p class="text-sm sm:text-base text-gray-600 text-center mb-4 sm:mb-6">Paket liburan keluarga dengan aktivitas menyenangkan untuk semua usia</p>
                <div class="text-center">
                    <span class="text-lg sm:text-xl md:text-2xl font-bold text-blue-600">Mulai Rp 3.200.000</span>
                    <p class="text-gray-500 text-xs sm:text-sm">/orang</p>
                </div>
            </div>

            <!-- Adventure Package -->
            <div class="group bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 sm:mb-4 text-center">Adventure Package</h3>
                <p class="text-sm sm:text-base text-gray-600 text-center mb-4 sm:mb-6">Paket petualangan untuk pencinta adrenalin dan aktivitas outdoor</p>
                <div class="text-center">
                    <span class="text-lg sm:text-xl md:text-2xl font-bold text-emerald-600">Mulai Rp 2.800.000</span>
                    <p class="text-gray-500 text-xs sm:text-sm">/orang</p>
                </div>
            </div>

            <!-- Luxury Package -->
            <div class="group bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-3 sm:mb-4 text-center">Luxury Package</h3>
                <p class="text-sm sm:text-base text-gray-600 text-center mb-4 sm:mb-6">Paket mewah dengan akomodasi dan layanan premium terbaik</p>
                <div class="text-center">
                    <span class="text-lg sm:text-xl md:text-2xl font-bold text-orange-600">Mulai Rp 15.000.000</span>
                    <p class="text-gray-500 text-xs sm:text-sm">/orang</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Packages -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-slate-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-12 sm:mb-16" data-aos="fade-up">
            <h2 class="text-2xl sm:text-3xl md:text-4xl font-bold text-gray-800 mb-3 sm:mb-4">Paket Tour Populer</h2>
            <p class="text-base sm:text-lg md:text-xl text-gray-600 max-w-3xl mx-auto px-4">Paket tour terlaris yang dipilih oleh ribuan pelanggan JustTrip</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($regularPackages as $index => $package)
             <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                 <div class="relative overflow-hidden">
                     @if($package->gambar_destinasi && count($package->gambar_destinasi) > 0)
                         <img src="{{ asset('storage/' . $package->gambar_destinasi[0]) }}" alt="{{ $package->nama_layanan }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                     @else
                         <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $package->nama_layanan }}" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                     @endif
                     <div class="absolute top-4 left-4">
                         <span class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">{{ ucfirst($package->jenis_layanan) }}</span>
                     </div>
                     <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                 </div>
                 <div class="p-4 sm:p-6">
                     <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2">{{ $package->nama_layanan }}</h3>
                     <p class="text-sm sm:text-base text-gray-600 mb-3 sm:mb-4">
                         {{ $package->durasi_hari }} Hari • {{ $package->lokasi_tujuan }}
                         • Maks {{ $package->maks_orang }} orang
                         <br>{{ Str::limit($package->deskripsi, 50) }}
                     </p>
                     <div class="flex items-center justify-between mb-3 sm:mb-4">
                         <div>
                             <span class="text-lg sm:text-xl md:text-2xl font-bold text-emerald-600">Rp {{ number_format($package->harga_mulai, 0, ',', '.') }}</span>
                             <span class="text-gray-500 text-xs sm:text-sm">/orang</span>
                         </div>
                         <div class="flex items-center">
                             <span class="text-yellow-400 mr-1 text-sm">★★★★★</span>
                             <span class="text-gray-600 text-xs sm:text-sm">(4.8)</span>
                         </div>
                     </div>
                     <ul class="text-gray-600 text-xs sm:text-sm mb-3 sm:mb-4 space-y-1">
                         @if($package->fasilitas && is_array($package->fasilitas))
                             @foreach(array_slice($package->fasilitas, 0, 4) as $fasilitas)
                                 <li>✓ {{ trim($fasilitas) }}</li>
                             @endforeach
                         @elseif($package->fasilitas && is_string($package->fasilitas))
                             @foreach(array_slice(explode(',', $package->fasilitas), 0, 4) as $fasilitas)
                                 <li>✓ {{ trim($fasilitas) }}</li>
                             @endforeach
                         @else
                             <li>✓ Paket lengkap</li>
                             <li>✓ Tour guide berpengalaman</li>
                             <li>✓ Transportasi nyaman</li>
                             <li>✓ Akomodasi terbaik</li>
                         @endif
                     </ul>
                     <a href="{{ route('packages.show', $package->slug) }}" class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105 block text-center">
                         Lihat Detail
                     </a>
                 </div>
             </div>
            @empty
            <div class="col-span-3 text-center py-12">
                <p class="text-gray-500 text-lg">Belum ada paket tour tersedia</p>
            </div>
            @endforelse
        </div>

        <div class="text-center mt-8 sm:mt-12" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('packages.index') }}" class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-3 px-6 sm:py-4 sm:px-8 rounded-xl text-base sm:text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl inline-block">
                Lihat Semua Paket Tour
            </a>
        </div>
    </div>
</section>

<!-- CTA Newsletter -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-fuchsia-500 via-purple-500 to-indigo-500">
    <div class="container mx-auto px-4">
        <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-6 sm:p-8 md:p-12 text-center text-white relative overflow-hidden" data-aos="fade-up">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <h3 class="text-xl sm:text-2xl md:text-3xl lg:text-4xl font-bold mb-3 sm:mb-4">Dapatkan Notifikasi Promo Terbaru!</h3>
                <p class="text-sm sm:text-base md:text-lg lg:text-xl mb-6 sm:mb-8 opacity-90">Subscribe newsletter kami dan jadi yang pertama tahu promo eksklusif</p>
                <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 justify-center max-w-md mx-auto">
                    <input type="email" placeholder="Masukkan email Anda" class="flex-1 px-4 py-2 sm:px-6 sm:py-3 rounded-full text-gray-800 text-sm sm:text-base focus:outline-none focus:ring-4 focus:ring-white/30">
                    <button class="bg-white text-purple-600 font-bold px-6 py-2 sm:px-8 sm:py-3 rounded-full text-sm sm:text-base hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
