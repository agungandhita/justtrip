@extends('Frontend.layouts.main')

@section('container')
<!-- Lightbox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
    
    :root { 
        --trip-primary: #4f46e5; 
        --trip-secondary: #0ea5e9; 
    }
    
    body { font-family: 'Plus Jakarta Sans', sans-serif; }

    .glass-header { 
        background: rgba(255, 255, 255, 0.1); 
        backdrop-filter: blur(12px); 
        border: 1px solid rgba(255, 255, 255, 0.2); 
    }
    
    .hero-gradient { 
        background: linear-gradient(180deg, rgba(0,0,0,0) 0%, rgba(0,0,0,0.4) 50%, rgba(15, 23, 42, 0.95) 100%); 
    }

    .tab-btn { 
        transition: all 0.4s cubic-bezier(0.23, 1, 0.32, 1);
        position: relative;
    }
    
    .tab-btn.active { 
        background: var(--trip-primary);
        color: white;
        box-shadow: 0 10px 25px -5px rgba(79, 70, 229, 0.4);
    }

    .tab-content { 
        display: none; 
        animation: slideUp 0.6s cubic-bezier(0.23, 1, 0.32, 1); 
    }
    
    .tab-content.active { display: block; }

    @keyframes slideUp { 
        from { opacity: 0; transform: translateY(20px); } 
        to { opacity: 1; transform: translateY(0); } 
    }

    .day-card {
        border-left: 3px solid #e2e8f0;
        transition: all 0.3s ease;
    }
    
    .day-card:hover {
        border-left-color: var(--trip-primary);
        background: #f8fafc;
    }

    .booking-sidebar {
        box-shadow: 0 50px 100px -20px rgba(0,0,0,0.12), 0 30px 60px -30px rgba(0,0,0,0.15);
    }

    @media (max-width: 640px) {
        .hero-title {
            font-size: 2.5rem !important;
            line-height: 1.1 !important;
        }
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

@php
    $source = $type === 'special_offer' && $package->layanan ? $package->layanan : $package;
@endphp

<!-- Elegant Hero Section: Responsive Heights -->
<section class="relative h-[65vh] md:h-[80vh] w-full overflow-hidden bg-slate-900 pt-16">
    <div class="absolute inset-0 z-0">
        @php
            $heroImage = $type === 'special_offer' 
                ? ($package->main_image ? asset('storage/' . $package->main_image) : '')
                : ($package->gambar_destinasi && count($package->gambar_destinasi) > 0 ? asset('storage/' . $package->gambar_destinasi[0]) : '');
        @endphp
        <img src="{{ $heroImage }}" alt="{{ $package->nama_layanan ?? $package->title }}" class="w-full h-full object-cover opacity-80 scale-105">
        <div class="absolute inset-0 hero-gradient"></div>
    </div>

    <div class="relative z-10 w-full h-full container mx-auto px-4 md:px-6 flex flex-col justify-end pb-12 md:pb-20">
        <div class="max-w-5xl" data-aos="fade-up">
            <!-- Breadcrumbs: Hidden on very small screens -->
            <nav class="hidden sm:flex mb-6 md:mb-8 text-indigo-200/60 text-[10px] font-black uppercase tracking-[0.3em]">
                <ol class="flex items-center space-x-3">
                    <li><a href="/" class="hover:text-white transition-colors">Home</a></li>
                    <li><span class="w-1 h-1 bg-white/30 rounded-full"></span></li>
                    <li><a href="/packages" class="hover:text-white transition-colors">Paket Tour</a></li>
                    <li><span class="w-1 h-1 bg-white/30 rounded-full"></span></li>
                    <li class="text-white">Detail Trip</li>
                </ol>
            </nav>

            <div class="flex flex-wrap gap-2 md:gap-3 mb-6 md:mb-8">
                @if($type === 'special_offer')
                    <span class="inline-flex items-center px-4 py-1.5 md:px-5 md:py-2 rounded-xl md:rounded-2xl bg-rose-600 text-white text-[9px] md:text-[10px] font-black uppercase tracking-widest shadow-xl shadow-rose-900/40">
                        <i class="fas fa-bolt mr-2 text-[10px]"></i> PROMO {{ $package->discount_percentage }}%
                    </span>
                @endif
                <span class="inline-flex items-center px-4 py-1.5 md:px-5 md:py-2 rounded-xl md:rounded-2xl glass-header text-white text-[9px] md:text-[10px] font-black uppercase tracking-widest">
                    <i class="fas fa-map-marker-alt text-amber-400 mr-2"></i> {{ $package->lokasi_tujuan ?? ($package->layanan->lokasi_tujuan ?? 'Destinasi') }}
                </span>
                <span class="inline-flex items-center px-4 py-1.5 md:px-5 md:py-2 rounded-xl md:rounded-2xl glass-header text-white text-[9px] md:text-[10px] font-black uppercase tracking-widest">
                    {{ $type === 'special_offer' ? ($package->layanan->jenis_layanan_label ?? 'Special') : $package->jenis_layanan_label }}
                </span>
            </div>

            <h1 class="hero-title text-4xl md:text-7xl lg:text-8xl font-black text-white leading-none mb-6 md:mb-8 tracking-tighter">
                {{ $package->nama_layanan ?? $package->title }}
            </h1>

            <div class="flex flex-wrap items-center gap-6 md:gap-10 text-white/80">
                <div class="flex items-center gap-3 md:gap-4">
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl glass-header flex items-center justify-center text-base md:text-xl text-amber-400">
                        <i class="far fa-clock"></i>
                    </div>
                    <div>
                        <p class="text-[8px] md:text-[10px] font-black uppercase tracking-widest text-white/40 mb-0.5 md:mb-1">Durasi</p>
                        <p class="text-sm md:text-lg font-bold text-white">{{ ($type === 'special_offer' ? $package->layanan->durasi_hari : $package->durasi_hari) }} Hari</p>
                    </div>
                </div>
                <div class="flex items-center gap-3 md:gap-4">
                    <div class="w-10 h-10 md:w-14 md:h-14 rounded-xl md:rounded-2xl glass-header flex items-center justify-center text-base md:text-xl text-emerald-400">
                        <i class="fas fa-user-friends"></i>
                    </div>
                    <div>
                        <p class="text-[8px] md:text-[10px] font-black uppercase tracking-widest text-white/40 mb-0.5 md:mb-1">Kapasitas</p>
                        <p class="text-sm md:text-lg font-bold text-white">Maks {{ ($type === 'special_offer' ? $package->layanan->maks_orang : $package->maks_orang) }} Orang</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Main Page Content: Refined Layout -->
<section class="relative z-20 bg-white pb-20 md:pb-24 pt-4 md:pt-8">
    <div class="container mx-auto px-4 md:px-6">
        <div class="flex flex-col lg:flex-row gap-10 md:gap-20">
            
            <!-- Left Side: Content & Tabs -->
            <div class="flex-1 space-y-8 md:space-y-12">
                <!-- Tab Menu: Mobile Scrollable Indicator -->
                <div class="sticky top-20 md:top-24 z-30 bg-white/80 backdrop-blur-md py-4 border-b border-gray-100 flex items-center gap-2 overflow-x-auto no-scrollbar">
                    <button onclick="showTab('information')" class="tab-btn active px-6 md:px-8 py-2.5 md:py-3 rounded-xl md:rounded-2xl font-black text-[10px] md:text-xs uppercase tracking-widest whitespace-nowrap">Informasi</button>
                    <button onclick="showTab('itinerary')" class="tab-btn px-6 md:px-8 py-2.5 md:py-3 rounded-xl md:rounded-2xl font-black text-[10px] md:text-xs uppercase tracking-widest whitespace-nowrap">Itinerary</button>
                    <button onclick="showTab('services')" class="tab-btn px-6 md:px-8 py-2.5 md:py-3 rounded-xl md:rounded-2xl font-black text-[10px] md:text-xs uppercase tracking-widest whitespace-nowrap">Layanan</button>
                    <button onclick="showTab('terms')" class="tab-btn px-6 md:px-8 py-2.5 md:py-3 rounded-xl md:rounded-2xl font-black text-[10px] md:text-xs uppercase tracking-widest whitespace-nowrap">Syarat & Ketentuan</button>
                </div>

                <div class="min-h-[300px] md:min-h-[400px]">
                    <!-- Information Tab Content -->
                    <div id="tab-information" class="tab-content active space-y-8 md:space-y-10">
                        @if($source->deskripsi)
                        <div class="prose prose-lg md:prose-xl max-w-none text-gray-500 leading-relaxed font-medium">
                            {!! nl2br(e($source->deskripsi)) !!}
                        </div>
                        @endif

                        @if($type === 'special_offer' && $package->description)
                        <div class="bg-indigo-50 p-6 md:p-8 rounded-3xl md:rounded-[2.5rem] border border-indigo-100 flex items-start gap-4 md:gap-6 text-sm md:text-lg">
                            <div class="w-10 h-10 md:w-12 md:h-12 bg-indigo-600 rounded-xl md:rounded-2xl flex items-center justify-center text-white shrink-0 shadow-lg shadow-indigo-200">
                                <i class="fas fa-star text-sm md:text-base"></i>
                            </div>
                            <p class="text-indigo-900 font-bold leading-relaxed">{{ $package->description }}</p>
                        </div>
                        @endif

                        @if($source->information_image)
                        <div class="rounded-3xl md:rounded-[3rem] overflow-hidden shadow-2xl shadow-gray-200 border border-gray-100">
                            <img src="{{ asset('storage/' . $source->information_image) }}" alt="Experience" class="w-full">
                        </div>
                        @endif
                    </div>

                    <!-- Itinerary Tab Content -->
                    <div id="tab-itinerary" class="tab-content space-y-8 md:space-y-10">
                        @if($source->itinerary && count($source->itinerary) > 0)
                        <div class="space-y-6 md:space-y-8">
                            @foreach($source->itinerary as $day)
                            <div class="day-card p-6 md:p-8 rounded-2xl md:rounded-3xl bg-gray-50/50">
                                <div class="flex items-center gap-4 mb-4 md:mb-6">
                                    <span class="w-8 h-8 md:w-10 md:h-10 bg-indigo-600 rounded-lg md:rounded-xl flex items-center justify-center text-white font-black text-[10px] md:text-xs">0{{ $day['day'] }}</span>
                                    <h4 class="text-lg md:text-xl font-black text-indigo-950 uppercase tracking-tight">Hari {{ $day['day'] }}</h4>
                                </div>
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-6">
                                    @foreach($day['activities'] ?? [] as $activity)
                                    <div class="flex items-start gap-3 md:gap-4 p-3 md:p-4 bg-white rounded-xl md:rounded-2xl shadow-sm border border-gray-100">
                                        <div class="w-1.5 h-1.5 mt-2 rounded-full bg-amber-400 shrink-0"></div>
                                        <span class="text-gray-600 font-medium leading-relaxed text-xs md:text-sm">{{ $activity }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endforeach
                        </div>

                        <div class="flex flex-wrap gap-3 md:gap-4 pt-4 md:pt-8">
                            @if($source->start_time)
                            <div class="px-4 py-2 md:px-6 md:py-3 bg-white border border-gray-100 rounded-xl md:rounded-2xl shadow-sm flex items-center gap-3">
                                <i class="far fa-play-circle text-emerald-500 text-sm"></i>
                                <span class="text-xs md:text-sm font-bold text-gray-900">Mulai: {{ $source->start_time }}</span>
                            </div>
                            @endif
                            @if($source->finish_time)
                            <div class="px-4 py-2 md:px-6 md:py-3 bg-white border border-gray-100 rounded-xl md:rounded-2xl shadow-sm flex items-center gap-3">
                                <i class="far fa-stop-circle text-rose-500 text-sm"></i>
                                <span class="text-xs md:text-sm font-bold text-gray-900">Selesai: {{ $source->finish_time }}</span>
                            </div>
                            @endif
                        </div>
                        @else
                        <div class="py-20 text-center bg-gray-50 rounded-[3rem]">
                            <p class="text-gray-400 font-bold uppercase tracking-widest text-[10px]">Belum tersedia.</p>
                        </div>
                        @endif
                    </div>

                    <!-- Services Tab Content: Multi-column Mobile optimized -->
                    <div id="tab-services" class="tab-content space-y-10 md:space-y-12">
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 md:gap-10">
                            <!-- Included -->
                            <div class="space-y-4 md:space-y-6">
                                <h4 class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.3em] flex items-center gap-3">
                                    <span class="w-6 md:w-8 h-[2px] bg-emerald-600"></span>
                                    Included
                                </h4>
                                <ul class="space-y-3 md:space-y-4">
                                    @forelse($source->include_services ?? $source->fasilitas ?? [] as $item)
                                    <li class="flex items-start gap-3 md:gap-4 p-4 md:p-5 bg-emerald-50 border border-emerald-100 rounded-2xl md:rounded-3xl">
                                        <i class="fas fa-check-circle text-emerald-500 mt-1 text-sm"></i>
                                        <span class="text-emerald-900 font-bold leading-relaxed text-xs md:text-sm">{{ $item }}</span>
                                    </li>
                                    @empty
                                    <li class="text-gray-300 italic text-xs">Informasi tidak tersedia</li>
                                    @endforelse
                                </ul>
                            </div>

                            <!-- Excluded -->
                            <div class="space-y-4 md:space-y-6">
                                <h4 class="text-[10px] font-black text-rose-500 uppercase tracking-[0.3em] flex items-center gap-3">
                                    <span class="w-6 md:w-8 h-[2px] bg-rose-500"></span>
                                    Excluded
                                </h4>
                                <ul class="space-y-3 md:space-y-4">
                                    @forelse($source->exclude_services ?? [] as $item)
                                    <li class="flex items-start gap-3 md:gap-4 p-4 md:p-5 bg-rose-50 border border-rose-100 rounded-2xl md:rounded-3xl">
                                        <i class="fas fa-times-circle text-rose-400 mt-1 text-sm"></i>
                                        <span class="text-rose-900 font-bold leading-relaxed text-xs md:text-sm">{{ $item }}</span>
                                    </li>
                                    @empty
                                    <li class="text-gray-300 italic text-xs">Informasi tidak tersedia</li>
                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Terms Tab Content -->
                    <div id="tab-terms" class="tab-content space-y-10 md:space-y-12">
                        @php $terms = $source->terms_conditions ?? []; @endphp

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 md:gap-12">
                            @if(isset($terms['registration_payment']))
                            <div class="space-y-4 md:space-y-6 text-gray-600">
                                <h5 class="text-indigo-950 font-black text-base md:text-lg flex items-center gap-3 italic">
                                    <i class="fas fa-file-invoice-dollar text-indigo-500"></i> Pendaftaran & Bayar
                                </h5>
                                <ul class="space-y-3 md:space-y-4">
                                    @foreach($terms['registration_payment'] as $item)
                                    <li class="text-xs md:text-sm font-medium leading-relaxed pl-4 border-l-2 border-indigo-100">{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif

                            @if(isset($terms['cancelation']))
                            <div class="space-y-4 md:space-y-6 text-gray-600">
                                <h5 class="text-indigo-950 font-black text-base md:text-lg flex items-center gap-3 italic">
                                    <i class="fas fa-undo-alt text-rose-500"></i> Pembatalan
                                </h5>
                                <ul class="space-y-3 md:space-y-4">
                                    @foreach($terms['cancelation'] as $item)
                                    <li class="text-xs md:text-sm font-medium leading-relaxed pl-4 border-l-2 border-rose-100">{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Grand Photo Gallery: Responsive Columns -->
                @php $imgs = $type === 'special_offer' ? ($package->layanan->gambar_destinasi ?? []) : ($package->gambar_destinasi ?? []); @endphp
                @if(count($imgs) > 0)
                <div class="space-y-8 md:space-y-10" data-aos="fade-up">
                    <div class="flex items-end justify-between">
                        <div>
                            <h4 class="text-indigo-600 font-black uppercase tracking-[0.2em] text-[10px] mb-2 md:mb-3">Dokumentasi</h4>
                            <h2 class="text-2xl md:text-5xl font-black text-indigo-950">Intip <span class="text-indigo-500">Keseruannya</span></h2>
                        </div>
                        <div class="hidden sm:block text-right">
                            <span class="text-4xl md:text-5xl font-black text-gray-100 leading-none">{{ count($imgs) }}</span>
                            <p class="text-[8px] md:text-[10px] font-black uppercase tracking-widest text-gray-400">Items</p>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 md:gap-4">
                        @foreach($imgs as $idx => $img)
                        <a href="{{ asset('storage/' . $img) }}" class="glightbox block relative group overflow-hidden rounded-2xl md:rounded-[2rem] shadow-lg shadow-gray-200 aspect-square {{ $idx === 0 ? 'col-span-2 row-span-2' : '' }}">
                            <img src="{{ asset('storage/' . $img) }}" alt="Travel" class="w-full h-full object-cover transition-transform duration-1000 group-hover:scale-110">
                            <div class="absolute inset-0 bg-indigo-950/20 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center">
                                <i class="fas fa-expand text-white text-2xl md:text-3xl"></i>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Side: Booking Card -->
            <div class="w-full lg:w-[400px]">
                <div class="lg:sticky lg:top-32 space-y-8 md:space-y-10">
                    <!-- Booking Card -->
                    <div class="booking-sidebar bg-white rounded-3xl md:rounded-[3.5rem] overflow-hidden border border-gray-100" data-aos="fade-left">
                        <div class="p-8 md:p-10 flex flex-col items-center text-center">
                            <span class="px-4 py-1.5 bg-indigo-50 text-indigo-600 rounded-full text-[9px] md:text-[10px] font-black uppercase tracking-widest mb-6 border border-indigo-100">
                                Trusted Travel Agency
                            </span>
                            
                            @if($type === 'special_offer')
                                <div class="flex flex-col items-center gap-2 mb-8">
                                    <div class="flex items-center gap-2 md:gap-3">
                                        <span class="text-gray-300 line-through font-black text-xl md:text-2xl font-mono">Rp{{ number_format($package->original_price / 1000, 0) }}k</span>
                                        <span class="bg-rose-500 text-white text-[8px] md:text-[9px] font-black px-3 py-1 rounded-full uppercase tracking-widest">{{ $package->discount_percentage }}% OFF</span>
                                    </div>
                                    <div class="text-6xl md:text-7xl font-black text-indigo-950 tracking-tighter font-mono leading-none">
                                        <span class="text-xl md:text-2xl text-indigo-300 font-bold align-top">Rp</span>{{ number_format($package->discounted_price / 1000, 0) }}<span class="text-2xl md:text-3xl text-indigo-400">k</span>
                                    </div>
                                    <p class="text-rose-500 text-[9px] font-black uppercase tracking-widest mt-4">Ends {{ $package->valid_until->format('d M') }}</p>
                                </div>
                            @else
                                <div class="mb-10">
                                    <div class="text-[9px] text-gray-400 font-black uppercase tracking-widest mb-4">Start From</div>
                                    <div class="text-6xl md:text-7xl font-black text-indigo-950 tracking-tighter font-mono leading-none">
                                        <span class="text-xl md:text-2xl text-indigo-300 font-bold align-top">Rp</span>{{ number_format($package->harga_mulai / 1000, 0) }}<span class="text-2xl md:text-3xl text-indigo-400">k</span>
                                    </div>
                                    <p class="text-[10px] text-gray-400 font-bold mt-4 uppercase tracking-widest">Harga Per Orang</p>
                                </div>
                            @endif

                            <div class="w-full space-y-3 md:space-y-4">
                                @auth
                                    @php
                                        $bookUrl = $type === 'special_offer' 
                                            ? route('booking.create-from-offer', $package->id)
                                            : route('booking.create', $package->layanan_id ?? $package->id);
                                    @endphp
                                    <a href="{{ $bookUrl }}" class="block w-full py-5 md:py-6 rounded-2xl md:rounded-3xl bg-indigo-600 hover:bg-indigo-700 text-white font-black text-center shadow-xl shadow-indigo-100 transition-all uppercase tracking-widest text-xs">Pesan Sekarang</a>
                                @else
                                    <a href="{{ route('login') }}" class="block w-full py-5 md:py-6 rounded-2xl md:rounded-3xl bg-indigo-950 text-white font-black text-center transition-all uppercase tracking-widest text-xs">Login Untuk Pesan</a>
                                @endauth
                                
                                <a href="https://wa.me/6281234567890?text=Halo%20JustTrip%2C%20saya%20tertarik%20dengan%20paket%20{{ urlencode($package->nama_layanan ?? $package->title) }}" target="_blank" class="block w-full py-4 rounded-2xl md:rounded-3xl border-2 border-emerald-500 text-emerald-600 font-black text-center text-[10px] md:text-xs uppercase tracking-widest">
                                   WA Konsultasi
                                </a>
                            </div>
                        </div>
                    </div>

                    <!-- Trust Cards -->
                    <div class="bg-indigo-950 rounded-3xl md:rounded-[3rem] p-8 md:p-10 text-white relative overflow-hidden group">
                        <div class="absolute -top-10 -right-10 w-32 h-32 md:w-40 md:h-40 bg-indigo-500/20 rounded-full blur-[80px]"></div>
                        <h3 class="text-xl md:text-2xl font-black mb-8 relative z-10 italic">Kenapa Kami?</h3>
                        <div class="space-y-6 md:space-y-8 relative z-10">
                            <div class="flex items-center gap-4 md:gap-6">
                                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-white/10 flex items-center justify-center text-lg md:text-xl text-amber-400"><i class="fas fa-shield-alt"></i></div>
                                <div>
                                    <h5 class="font-black text-[10px] uppercase tracking-widest text-indigo-300">Aman & Terpercaya</h5>
                                    <p class="text-xs text-white/60 leading-relaxed font-medium">Pembayaran aman dengan verifikasi sistem terbaik.</p>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 md:gap-6">
                                <div class="w-12 h-12 md:w-14 md:h-14 rounded-xl bg-white/10 flex items-center justify-center text-lg md:text-xl text-emerald-400"><i class="fas fa-gem"></i></div>
                                <div>
                                    <h5 class="font-black text-[10px] uppercase tracking-widest text-indigo-300">Layanan Premium</h5>
                                    <p class="text-xs text-white/60 leading-relaxed font-medium">Pengalaman VIP di setiap momen perjalanan Anda.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Mobile Fixed Action Bar: Ultra Refined -->
<div class="fixed bottom-0 left-0 right-0 z-[100] lg:hidden p-4 md:p-6 bg-white/95 backdrop-blur-xl border-t border-gray-100 shadow-[0_-15px_40px_rgba(0,0,0,0.1)]">
    <div class="flex items-center gap-4 max-w-lg mx-auto">
        <div class="flex-shrink-0">
            <p class="text-[8px] text-gray-400 font-black uppercase tracking-widest">Price From</p>
            <p class="text-xl md:text-2xl font-black text-indigo-950 font-mono">
                Rp{{ number_format(($type === 'special_offer' ? $package->discounted_price : $package->harga_mulai) / 1000, 0) }}k
            </p>
        </div>
        @auth
            <a href="{{ $bookUrl ?? '#' }}" class="flex-1 bg-indigo-600 text-white font-black py-4 md:py-5 rounded-2xl text-center text-[10px] md:text-xs uppercase tracking-widest shadow-xl shadow-indigo-100">BOOK NOW</a>
        @else
            <a href="{{ route('login') }}" class="flex-1 bg-indigo-950 text-white font-black py-4 md:py-5 rounded-2xl text-center text-[10px] md:text-xs uppercase tracking-widest">SIGN IN</a>
        @endauth
    </div>
</div>

<!-- Lightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        GLightbox({ 
            selector: '.glightbox', 
            touchNavigation: true, 
            loop: true, 
            zoomable: true,
            autoplayVideos: true
        });
    });

    function showTab(tabName) {
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(content => content.classList.remove('active'));
        
        event.currentTarget.classList.add('active');
        const content = document.getElementById('tab-' + tabName);
        content.classList.add('active');
        
        if(window.innerWidth < 1024) {
            const headerOffset = 100;
            const elementPosition = content.getBoundingClientRect().top;
            const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

            window.scrollTo({
                top: offsetPosition,
                behavior: "smooth"
            });
        }
    }
</script>
@endsection
