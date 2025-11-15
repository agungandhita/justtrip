@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Background Images with Parallax Effect -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 z-10 bg-gradient-to-r from-emerald-600/70 via-teal-600/70 to-cyan-600/70"></div>
        <div class="h-full bg-center bg-cover" style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
    </div>

    <!-- Hero Content -->
    <div class="relative z-20 max-w-4xl px-4 mx-auto text-center text-white" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="mb-4 text-2xl font-bold text-transparent sm:text-3xl md:text-4xl lg:text-5xl sm:mb-6 bg-gradient-to-r from-white to-emerald-100 bg-clip-text">
            Paket Tour Terbaik
        </h1>
        <p class="mb-6 text-sm font-medium sm:text-base md:text-lg sm:mb-8 text-emerald-100" data-aos="fade-up" data-aos-delay="200">
            Nikmati liburan impian dengan paket tour all-inclusive yang dirancang khusus untuk Anda
        </p>
    </div>
</section>



<!-- Package Categories -->
<section class="py-24 bg-white">
    <div class="container px-4 mx-auto">
        <div class="mb-12 text-center sm:mb-16" data-aos="fade-up">
            <h2 class="mb-3 text-2xl font-bold text-gray-800 sm:text-3xl md:text-4xl sm:mb-4">Kategori Paket Tour</h2>
            <p class="max-w-3xl px-4 mx-auto text-base text-gray-600 sm:text-lg md:text-xl">Pilih paket tour sesuai dengan preferensi dan budget Anda</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-4">
            <!-- Honeymoon Package -->
            <div class="p-8 transition-all duration-500 transform shadow-lg group bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition-transform duration-300 rounded-full bg-gradient-to-r from-pink-500 to-rose-500 group-hover:scale-110">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-bold text-center text-gray-800 sm:text-xl sm:mb-4">Honeymoon Package</h3>
                <p class="mb-4 text-sm text-center text-gray-600 sm:text-base sm:mb-6">Paket romantis untuk pasangan yang baru menikah dengan destinasi eksotis</p>
                <div class="text-center">
                    <span class="text-lg font-bold text-pink-600 sm:text-xl md:text-2xl">Mulai Rp 8.500.000</span>
                    <p class="text-xs text-gray-500 sm:text-sm">/couple</p>
                </div>
            </div>

            <!-- Family Package -->
            <div class="p-8 transition-all duration-500 transform shadow-lg group bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition-transform duration-300 rounded-full bg-gradient-to-r from-blue-500 to-indigo-500 group-hover:scale-110">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-bold text-center text-gray-800 sm:text-xl sm:mb-4">Family Package</h3>
                <p class="mb-4 text-sm text-center text-gray-600 sm:text-base sm:mb-6">Paket liburan keluarga dengan aktivitas menyenangkan untuk semua usia</p>
                <div class="text-center">
                    <span class="text-lg font-bold text-blue-600 sm:text-xl md:text-2xl">Mulai Rp 3.200.000</span>
                    <p class="text-xs text-gray-500 sm:text-sm">/orang</p>
                </div>
            </div>

            <!-- Adventure Package -->
            <div class="p-8 transition-all duration-500 transform shadow-lg group bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition-transform duration-300 rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 group-hover:scale-110">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-bold text-center text-gray-800 sm:text-xl sm:mb-4">Adventure Package</h3>
                <p class="mb-4 text-sm text-center text-gray-600 sm:text-base sm:mb-6">Paket petualangan untuk pencinta adrenalin dan aktivitas outdoor</p>
                <div class="text-center">
                    <span class="text-lg font-bold sm:text-xl md:text-2xl text-emerald-600">Mulai Rp 2.800.000</span>
                    <p class="text-xs text-gray-500 sm:text-sm">/orang</p>
                </div>
            </div>

            <!-- Luxury Package -->
            <div class="p-8 transition-all duration-500 transform shadow-lg group bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
                <div class="flex items-center justify-center w-16 h-16 mx-auto mb-6 transition-transform duration-300 rounded-full bg-gradient-to-r from-yellow-500 to-orange-500 group-hover:scale-110">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="mb-3 text-lg font-bold text-center text-gray-800 sm:text-xl sm:mb-4">Luxury Package</h3>
                <p class="mb-4 text-sm text-center text-gray-600 sm:text-base sm:mb-6">Paket mewah dengan akomodasi dan layanan premium terbaik</p>
                <div class="text-center">
                    <span class="text-lg font-bold text-orange-600 sm:text-xl md:text-2xl">Mulai Rp 15.000.000</span>
                    <p class="text-xs text-gray-500 sm:text-sm">/orang</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Packages -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-slate-100">
    <div class="container px-4 mx-auto">
        <div class="mb-12 text-center sm:mb-16" data-aos="fade-up">
            <h2 class="mb-3 text-2xl font-bold text-gray-800 sm:text-3xl md:text-4xl sm:mb-4">Paket Tour Populer</h2>
            <p class="max-w-3xl px-4 mx-auto text-base text-gray-600 sm:text-lg md:text-xl">Paket tour terlaris yang dipilih oleh ribuan pelanggan JustTrip</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($regularPackages as $index => $package)
             <div class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg group rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                 <div class="relative overflow-hidden">
                     @if($package->gambar_destinasi && count($package->gambar_destinasi) > 0)
                         <img src="{{ asset('storage/' . $package->gambar_destinasi[0]) }}" alt="{{ $package->nama_layanan }}" class="object-cover w-full h-64 transition-transform duration-500 group-hover:scale-110">
                     @else
                         <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $package->nama_layanan }}" class="object-cover w-full h-64 transition-transform duration-500 group-hover:scale-110">
                     @endif
                     <div class="absolute top-4 left-4">
                         <span class="px-3 py-1 text-sm font-semibold text-white rounded-full bg-gradient-to-r from-blue-500 to-purple-500">{{ ucfirst($package->jenis_layanan) }}</span>
                     </div>
                     <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/50 to-transparent group-hover:opacity-100"></div>
                 </div>
                 <div class="p-4 sm:p-6">
                     <h3 class="mb-2 text-lg font-bold text-gray-800 sm:text-xl">{{ $package->nama_layanan }}</h3>
                     <p class="mb-3 text-sm text-gray-600 sm:text-base sm:mb-4">
                         {{ $package->durasi_hari }} Hari • {{ $package->lokasi_tujuan }}
                         • Maks {{ $package->maks_orang }} orang
                         <br>{{ Str::limit($package->deskripsi, 50) }}
                     </p>
                     <div class="flex items-center justify-between mb-3 sm:mb-4">
                         <div>
                             <span class="text-lg font-bold sm:text-xl md:text-2xl text-emerald-600">Rp {{ number_format($package->harga_mulai, 0, ',', '.') }}</span>
                             <span class="text-xs text-gray-500 sm:text-sm">/orang</span>
                         </div>
                         <div class="flex items-center">
                             <span class="mr-1 text-sm text-yellow-400">★★★★★</span>
                             <span class="text-xs text-gray-600 sm:text-sm">(4.8)</span>
                         </div>
                     </div>
                     <ul class="mb-3 space-y-1 text-xs text-gray-600 sm:text-sm sm:mb-4">
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
                     <a href="{{ route('packages.show', $package->slug) }}" class="block w-full py-3 font-semibold text-center text-white transition-all duration-300 transform rounded-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 hover:scale-105">
                         Lihat Detail
                     </a>
                 </div>
             </div>
            @empty
            <div class="col-span-3 py-12 text-center">
                <p class="text-lg text-gray-500">Belum ada paket tour tersedia</p>
            </div>
            @endforelse
        </div>

        <div class="mt-8 text-center sm:mt-12" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('packages.index') }}" class="inline-block px-6 py-3 text-base font-bold text-white transition-all duration-300 transform bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 sm:py-4 sm:px-8 rounded-xl sm:text-lg hover:scale-105 hover:shadow-xl">
                Lihat Semua Paket Tour
            </a>
        </div>
    </div>
</section>

<!-- CTA Newsletter -->
<section class="py-16 sm:py-20 bg-gradient-to-r from-fuchsia-500 via-purple-500 to-indigo-500">
    <div class="container px-4 mx-auto">
        <div class="relative p-6 overflow-hidden text-center text-white bg-white/10 backdrop-blur-sm rounded-3xl sm:p-8 md:p-12" data-aos="fade-up">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <h3 class="mb-3 text-xl font-bold sm:text-2xl md:text-3xl lg:text-4xl sm:mb-4">Dapatkan Notifikasi Promo Terbaru!</h3>
                <p class="mb-6 text-sm sm:text-base md:text-lg lg:text-xl sm:mb-8 opacity-90">Subscribe newsletter kami dan jadi yang pertama tahu promo eksklusif</p>
                @if(session('success'))
                    <div class="px-4 py-2 mb-4 font-semibold text-green-200 rounded-lg bg-green-700/80">{{ session('success') }}</div>
                @elseif($errors->any())
                    <div class="px-4 py-2 mb-4 font-semibold text-red-200 rounded-lg bg-red-700/80">{{ $errors->first() }}</div>
                @endif
                <form method="POST" action="{{ route('subscribe-users.store-frontend') }}" class="flex flex-col justify-center max-w-md gap-3 mx-auto sm:flex-row sm:gap-4">
                    @csrf
                    <input type="email" name="email" placeholder="Masukkan email Anda" required class="flex-1 px-4 py-2 sm:px-6 sm:py-3 rounded-full text-gray-800 text-sm sm:text-base focus:outline-none focus:ring-4 focus:ring-white/30 @error('email') border-red-500 @enderror" value="{{ old('email') }}">
                    <button type="submit" class="px-6 py-2 text-sm font-bold text-purple-600 transition-all duration-300 transform bg-white rounded-full sm:px-8 sm:py-3 sm:text-base hover:bg-gray-100 hover:scale-105">
                        Subscribe
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
