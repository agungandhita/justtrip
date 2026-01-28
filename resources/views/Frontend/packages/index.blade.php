@extends('Frontend.layouts.main')

@section('container')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
    
    :root {
        --primary: #4f46e5;
        --secondary: #10b981;
        --accent: #f59e0b;
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
    }

    .hero-glass {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(16px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .package-card {
        transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    }

    @media (min-width: 768px) {
        .package-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 40px 70px -15px rgba(0, 0, 0, 0.1);
        }
    }

    .cta-gradient {
        background: linear-gradient(135deg, var(--primary) 0%, #6366f1 100%);
    }

    .badge-premium {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(4px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<!-- Refined Responsive Hero Section -->
<section class="relative min-h-[85vh] md:h-[80vh] flex items-center justify-center overflow-hidden bg-gray-900 pt-20">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('img/paket.png') }}" alt="Explorer" class="w-full h-full object-cover scale-105">
        <div class="absolute inset-0 bg-gradient-to-b from-indigo-900/60 via-indigo-950/85 to-indigo-950"></div>
    </div>

    <div class="relative z-10 container mx-auto px-4 md:px-6 text-center" data-aos="fade-up">
        <span class="inline-flex px-4 py-1.5 mb-6 rounded-full badge-premium text-indigo-300 text-[10px] md:text-xs font-black uppercase tracking-widest leading-none">
            Jelajahi Dunia Bersama JustTrip
        </span>
        <h1 class="text-3xl sm:text-5xl md:text-7xl font-black text-white mb-6 tracking-tight leading-[1.1]">
            Temukan <span class="text-transparent bg-clip-text bg-gradient-to-r from-amber-400 to-orange-500">Petualangan</span><br class="hidden sm:block"> Terbaik Anda
        </h1>
        <p class="max-w-2xl mx-auto text-indigo-100/70 text-base md:text-lg font-medium mb-10 px-4">
            Pilih dari koleksi paket wisata eksklusif kami yang dirancang khusus untuk kenyamanan dan pengalaman tak terlupakan.
        </p>
        
        <!-- Search Bar: Optimized for Mobile -->
        <div class="max-w-4xl mx-auto hero-glass p-2 rounded-2xl md:rounded-[2rem] flex flex-col md:flex-row gap-2 shadow-2xl">
            <div class="flex-1 px-4 py-3 flex items-center gap-3 border-b md:border-b-0 md:border-r border-white/10 text-left">
                <i class="fas fa-map-marker-alt text-amber-500"></i>
                <input type="text" placeholder="Mau kemana hari ini?" class="bg-transparent border-none focus:ring-0 text-white placeholder-indigo-100/40 w-full font-bold text-sm">
            </div>
            <div class="flex-1 px-4 py-3 flex items-center gap-3 border-b md:border-b-0 md:border-r border-white/10 text-left">
                <i class="fas fa-calendar-alt text-amber-500"></i>
                <select class="bg-transparent border-none focus:ring-0 text-white w-full font-bold text-sm cursor-pointer">
                    <option class="text-gray-900">Kapan Saja</option>
                    <option class="text-gray-900">High Season</option>
                    <option class="text-gray-900">Low Season</option>
                </select>
            </div>
            <button class="bg-amber-500 hover:bg-amber-600 active:scale-95 text-indigo-950 font-black px-8 py-4 rounded-xl md:rounded-2xl transition-all uppercase tracking-widest text-[10px] md:text-xs">
                Cari Paket
            </button>
        </div>
    </div>
</section>

<!-- Package Categories: Refined Spacing -->
<section class="py-16 md:py-24 bg-white">
    <div class="container px-4 md:px-6 mx-auto">
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 md:mb-16 gap-6" data-aos="fade-up">
            <div class="max-w-xl">
                <h4 class="text-indigo-600 font-black uppercase tracking-[0.2em] text-[10px] mb-3">Kategori Wisata</h4>
                <h2 class="text-3xl md:text-5xl font-black text-indigo-950 leading-tight">Pilih Gaya <span class="text-indigo-500">Perjalanan</span></h2>
            </div>
            <p class="text-gray-500 font-medium max-w-sm text-sm md:text-base">Dapatkan pengalaman yang disesuaikan dengan kebutuhan Anda, dari rombongan besar hingga wisata edukasi.</p>
        </div>

        <div class="grid gap-6 md:gap-8 grid-cols-1 md:grid-cols-3">
            <!-- Open Trip -->
            <a href="{{ route('packages.index', ['category' => 'open_trip']) }}#paket-wisata" class="group p-8 md:p-10 rounded-3xl md:rounded-[2.5rem] {{ $currentCategory == 'open_trip' ? 'bg-indigo-600 ring-4 ring-indigo-200' : 'bg-indigo-50 border border-indigo-100 hover:bg-indigo-600' }} transition-all duration-500 block" data-aos="fade-up">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-white rounded-2xl flex items-center justify-center text-indigo-600 mb-6 md:mb-8 shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-users text-xl md:text-2xl"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-black {{ $currentCategory == 'open_trip' ? 'text-white' : 'text-indigo-950' }} mb-4 group-hover:text-white transition-colors">Open Trip</h3>
                <p class="text-sm md:text-base {{ $currentCategory == 'open_trip' ? 'text-indigo-100' : 'text-indigo-900/60' }} mb-6 md:mb-8 group-hover:text-indigo-100 transition-colors">Bergabunglah dengan sesama penjelajah dan temukan teman baru di destinasi impian.</p>
                <div class="flex items-center justify-between pt-6 border-t {{ $currentCategory == 'open_trip' ? 'border-white/20' : 'border-indigo-200/50' }} group-hover:border-white/20">
                    <span class="text-[10px] font-black {{ $currentCategory == 'open_trip' ? 'text-indigo-200' : 'text-indigo-400' }} uppercase tracking-widest group-hover:text-indigo-200">Mulai Dari</span>
                    <span class="text-lg md:text-xl font-black {{ $currentCategory == 'open_trip' ? 'text-white' : 'text-indigo-600' }} group-hover:text-white">Rp 1.5jt</span>
                </div>
            </a>

            <!-- Corporate Trip -->
            <a href="{{ route('packages.index', ['category' => 'corporate_trip']) }}#paket-wisata" class="group p-8 md:p-10 rounded-3xl md:rounded-[2.5rem] {{ $currentCategory == 'corporate_trip' ? 'bg-emerald-600 ring-4 ring-emerald-200' : 'bg-emerald-50 border border-emerald-100 hover:bg-emerald-600' }} transition-all duration-500 block" data-aos="fade-up" data-aos-delay="100">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-white rounded-2xl flex items-center justify-center text-emerald-600 mb-6 md:mb-8 shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-building text-xl md:text-2xl"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-black {{ $currentCategory == 'corporate_trip' ? 'text-white' : 'text-emerald-950' }} mb-4 group-hover:text-white transition-colors">Corporate</h3>
                <p class="text-sm md:text-base {{ $currentCategory == 'corporate_trip' ? 'text-emerald-100' : 'text-emerald-900/60' }} mb-6 md:mb-8 group-hover:text-emerald-100 transition-colors">Solusi gathering dan outbound profesional untuk meningkatkan produktivitas tim Anda.</p>
                <div class="flex items-center justify-between pt-6 border-t {{ $currentCategory == 'corporate_trip' ? 'border-white/20' : 'border-emerald-200/50' }} group-hover:border-white/20">
                    <span class="text-[10px] font-black {{ $currentCategory == 'corporate_trip' ? 'text-emerald-200' : 'text-emerald-400' }} uppercase tracking-widest group-hover:text-emerald-200">Mulai Dari</span>
                    <span class="text-lg md:text-xl font-black {{ $currentCategory == 'corporate_trip' ? 'text-white' : 'text-emerald-600' }} group-hover:text-white">Rp 2.5jt</span>
                </div>
            </a>

            <!-- Edu Trip -->
            <a href="{{ route('packages.index', ['category' => 'edu_trip']) }}#paket-wisata" class="group p-8 md:p-10 rounded-3xl md:rounded-[2.5rem] {{ $currentCategory == 'edu_trip' ? 'bg-amber-600 ring-4 ring-amber-200' : 'bg-amber-50 border border-amber-100 hover:bg-amber-600' }} transition-all duration-500 block" data-aos="fade-up" data-aos-delay="200">
                <div class="w-14 h-14 md:w-16 md:h-16 bg-white rounded-2xl flex items-center justify-center text-amber-600 mb-6 md:mb-8 shadow-sm group-hover:scale-110 transition-transform">
                    <i class="fas fa-graduation-cap text-xl md:text-2xl"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-black {{ $currentCategory == 'edu_trip' ? 'text-white' : 'text-amber-950' }} mb-4 group-hover:text-white transition-colors">Edu Trip</h3>
                <p class="text-sm md:text-base {{ $currentCategory == 'edu_trip' ? 'text-amber-100' : 'text-amber-900/60' }} mb-6 md:mb-8 group-hover:text-amber-100 transition-colors">Pembelajaran di luar kelas yang edukatif dan menyenangkan untuk siswa & mahasiswa.</p>
                <div class="flex items-center justify-between pt-6 border-t {{ $currentCategory == 'edu_trip' ? 'border-white/20' : 'border-amber-200/50' }} group-hover:border-white/20">
                    <span class="text-[10px] font-black {{ $currentCategory == 'edu_trip' ? 'text-amber-200' : 'text-amber-400' }} uppercase tracking-widest group-hover:text-amber-200">Mulai Dari</span>
                    <span class="text-lg md:text-xl font-black {{ $currentCategory == 'edu_trip' ? 'text-white' : 'text-amber-600' }} group-hover:text-white">Rp 800rb</span>
                </div>
            </a>
        </div>
    </div>
</section>

<!-- Popular Packages: Optimized Grid -->
<section id="paket-wisata" class="py-16 md:py-24 bg-gray-50 overflow-hidden">
    <div class="container px-4 md:px-6 mx-auto">
        <div class="text-center mb-12 md:mb-20" data-aos="fade-up">
            <h4 class="text-indigo-600 font-bold uppercase tracking-[0.3em] text-[10px] mb-4">Must-Visit Destinations</h4>
            <h2 class="text-3xl md:text-6xl font-black text-indigo-950 mb-6">Paket Tour <span class="italic text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-purple-600">Terlaris</span></h2>
            <div class="w-16 md:w-24 h-1.5 bg-amber-400 mx-auto rounded-full"></div>
        </div>

        <div class="grid gap-6 md:gap-10 grid-cols-1 sm:grid-cols-2 lg:grid-cols-3">
            @forelse($regularPackages as $index => $package)
             <div class="package-card bg-white rounded-3xl md:rounded-[2.5rem] overflow-hidden shadow-sm border border-gray-100 group" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                 <!-- Image Wrapper -->
                 <div class="relative h-60 md:h-72 overflow-hidden">
                    @if($package->gambar_destinasi && count($package->gambar_destinasi) > 0)
                        <img src="{{ asset('storage/' . $package->gambar_destinasi[0]) }}" alt="{{ $package->nama_layanan }}" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    @else
                        <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Destination" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                    @endif
                    
                    <!-- Badges on Image -->
                    <div class="absolute top-4 left-4 md:top-6 md:left-6 flex flex-col gap-2">
                        <span class="px-3 py-1 bg-white/10 backdrop-blur-md rounded-full text-white text-[9px] md:text-[10px] font-black uppercase tracking-widest border border-white/20">
                            {{ $package->jenis_layanan_label }}
                        </span>
                    </div>
                    
                    <div class="absolute bottom-4 left-4 right-4 md:bottom-6 md:left-6 md:right-6 flex justify-between items-end">
                        <div class="bg-indigo-950/40 backdrop-blur-md px-3 py-1.5 md:px-4 md:py-2 rounded-xl md:rounded-2xl border border-white/10 text-white flex items-center gap-2">
                            <i class="far fa-clock text-amber-400 text-[10px] md:text-xs"></i>
                            <span class="text-[10px] md:text-xs font-bold leading-none">{{ $package->durasi_format }}</span>
                        </div>
                    </div>
                 </div>

                 <!-- Content -->
                 <div class="p-6 md:p-8">
                    <h3 class="text-xl md:text-2xl font-black text-indigo-950 leading-snug group-hover:text-indigo-600 transition-colors mb-4 line-clamp-1">{{ $package->nama_layanan }}</h3>
                    
                    <div class="flex flex-wrap items-center gap-x-4 gap-y-2 mb-6 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                        <span class="flex items-center gap-2">
                            <i class="fas fa-map-marker-alt text-amber-500"></i> {{ $package->lokasi_tujuan }}
                        </span>
                        <span class="flex items-center gap-2">
                            <i class="fas fa-user-friends text-emerald-500"></i> Max {{ $package->maks_orang }} Pax
                        </span>
                    </div>

                    <div class="mb-6 md:mb-8 flex flex-wrap gap-2">
                        @if($package->fasilitas && is_array($package->fasilitas))
                            @foreach(array_slice($package->fasilitas, 0, 2) as $fasilitas)
                                <span class="px-3 py-1 bg-gray-50 text-gray-500 text-[9px] md:text-[10px] font-black uppercase rounded-lg border border-gray-100 italic">
                                    {{ trim($fasilitas) }}
                                </span>
                            @endforeach
                        @endif
                    </div>

                    <div class="flex items-end justify-between pt-6 border-t border-gray-50">
                        <div>
                            <p class="text-[9px] text-gray-400 font-black uppercase tracking-widest mb-1 leading-none">Mulai Dari</p>
                            <p class="text-2xl md:text-3xl font-black text-indigo-950 font-mono tracking-tighter">
                                <span class="text-xs font-bold text-gray-300">Rp</span> {{ number_format($package->harga_mulai / 1000, 0) }}<span class="text-indigo-400">k</span>
                             </p>
                        </div>
                        <a href="{{ route('packages.show', $package->slug) }}" class="w-12 h-12 md:w-14 md:h-14 cta-gradient rounded-xl md:rounded-2xl flex items-center justify-center text-white shadow-lg shadow-indigo-200 hover:scale-110 active:scale-95 transition-all">
                            <i class="fas fa-arrow-right text-sm md:text-base"></i>
                        </a>
                    </div>
                 </div>
             </div>
            @empty
            <div class="col-span-full py-24 text-center">
                <div class="w-20 h-20 md:w-24 md:h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6 text-gray-300">
                    <i class="fas fa-umbrella-beach text-3xl md:text-4xl"></i>
                </div>
                <h3 class="text-xl md:text-2xl font-black text-gray-900 mb-2">Belum Ada Paket</h3>
                <p class="text-sm md:text-base text-gray-500">Kami sedang menyiapkan petualangan baru untuk Anda.</p>
            </div>
            @endforelse
        </div>

        <div class="mt-12 md:mt-20 text-center" data-aos="fade-up">
            <a href="{{ route('packages.index') }}" class="inline-flex items-center gap-4 px-8 py-4 md:px-10 md:py-5 bg-white border border-gray-200 text-indigo-950 font-black rounded-2xl hover:bg-gray-50 hover:border-indigo-200 transition-all shadow-sm hover:shadow-xl group text-xs md:text-sm">
                JELAJAHI SEMUA PAKET
                <i class="fas fa-compass text-amber-500 group-hover:rotate-45 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

<!-- Call to Action Section: Refined for Mobile -->
<section class="py-16 md:py-24 bg-indigo-950 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-1/4 right-0 w-64 h-64 md:w-96 md:h-96 bg-indigo-500 rounded-full blur-[80px] md:blur-[120px]"></div>
        <div class="absolute bottom-1/4 left-0 w-64 h-64 md:w-96 md:h-96 bg-amber-500 rounded-full blur-[80px] md:blur-[120px]"></div>
    </div>
    
    <div class="container px-4 md:px-6 mx-auto relative z-10 text-center">
        <h2 class="text-3xl md:text-6xl font-black text-white mb-6 md:mb-8 tracking-tight">Siap Untuk <span class="text-amber-400">Berangkat?</span></h2>
        <p class="max-w-xl mx-auto text-indigo-200 mb-8 md:mb-12 text-base md:text-lg">Hubungi konsultan perjalanan kami dan dapatkan penawaran khusus untuk grup atau solo traveler.</p>
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
            <a href="#" class="w-full sm:w-auto px-10 py-5 bg-amber-500 text-indigo-950 font-black rounded-2xl hover:bg-amber-600 transition-all uppercase tracking-widest text-xs">WhatsApp Admin</a>
            <a href="#" class="w-full sm:w-auto px-10 py-5 bg-white/10 text-white font-black rounded-2xl border border-white/20 hover:bg-white/20 transition-all uppercase tracking-widest text-xs">Pelajari Lebih Lanjut</a>
        </div>
    </div>
</section>
@endsection
