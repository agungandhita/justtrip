@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10 antialiased text-gray-900 px-4 md:px-8">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <nav class="flex mb-4" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li>
                            <a href="{{ route('admin.special-offers.index') }}" class="text-sm font-medium text-gray-500 hover:text-indigo-600 transition-colors">Penawaran Khusus</a>
                        </li>
                        <li aria-current="page">
                            <div class="flex items-center">
                                <svg class="w-4 h-4 text-gray-400 mx-1" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                                <span class="text-sm font-bold text-gray-900 ml-1">Detail Penawaran</span>
                            </div>
                        </li>
                    </ol>
                </nav>
                <div class="flex items-center gap-4">
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">{{ $specialOffer->title }}</h1>
                    <span class="px-4 py-1.5 rounded-full text-xs font-black uppercase tracking-widest border {{ $specialOffer->is_active ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-rose-50 text-rose-600 border-rose-100' }}">
                        {{ $specialOffer->is_active ? 'Aktif' : 'Nonaktif' }}
                    </span>
                </div>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.special-offers.edit', $specialOffer->id) }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold transition-all duration-300 shadow-lg shadow-indigo-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00 2 2h11a2 2 0 00 2-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                    Edit
                </a>
                <a href="{{ route('admin.special-offers.index') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-2xl font-bold transition-all duration-300 shadow-sm border border-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 12H5m7 7l-7-7 7-7"/></svg>
                    Kembali
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Main Content (Left) -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Summary Card -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-8 md:p-10">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                            <div class="space-y-6">
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Layanan Terkait</p>
                                    <p class="text-xl font-bold text-gray-900">
                                        {{ $specialOffer->layanan ? $specialOffer->layanan->nama_layanan : 'Penawaran Mandiri' }}
                                    </p>
                                    @if($specialOffer->layanan)
                                    <div class="flex items-center gap-2 mt-2 text-sm font-medium text-gray-500">
                                        <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path></svg>
                                        {{ $specialOffer->layanan->lokasi_tujuan }}
                                    </div>
                                    @endif
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-indigo-50/50 p-4 rounded-3xl border border-indigo-100/50">
                                        <p class="text-[9px] font-black uppercase tracking-widest text-indigo-400 mb-1">Diskon</p>
                                        <p class="text-2xl font-black text-indigo-600">{{ $specialOffer->discount_percentage }}%</p>
                                    </div>
                                    <div class="bg-emerald-50 p-4 rounded-3xl border border-emerald-100/50">
                                        <p class="text-[9px] font-black uppercase tracking-widest text-emerald-400 mb-1">Status Unggulan</p>
                                        <p class="text-sm font-black text-emerald-600 uppercase tracking-tight">
                                            {{ $specialOffer->is_featured ? 'Unggulan' : 'Reguler' }}
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-6">
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-2">Periode Promo</p>
                                    <div class="flex items-center gap-4">
                                        <div class="flex-1 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                            <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Mulai</p>
                                            <p class="font-bold text-gray-900">{{ $specialOffer->valid_from ? $specialOffer->valid_from->format('d M Y') : 'N/A' }}</p>
                                        </div>
                                        <svg class="w-5 h-5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3"/></svg>
                                        <div class="flex-1 bg-gray-50 p-4 rounded-2xl border border-gray-100">
                                            <p class="text-[9px] font-black uppercase tracking-widest text-gray-400 mb-1">Berakhir</p>
                                            <p class="font-bold text-gray-900">{{ $specialOffer->valid_until ? $specialOffer->valid_until->format('d M Y') : 'N/A' }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Description & Terms -->
                <div class="space-y-6">
                    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8 md:p-10">
                        <h2 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7"/></svg>
                            Deskripsi Penawaran
                        </h2>
                        <div class="prose prose-indigo max-w-none text-gray-600 font-medium leading-relaxed">
                            {!! nl2br(e($specialOffer->description)) !!}
                        </div>
                    </div>

                    @if($specialOffer->terms_conditions)
                    <div class="bg-amber-50/30 rounded-[2.5rem] border border-amber-100/50 p-8 md:p-10">
                        <h2 class="text-xl font-bold text-amber-800 mb-6 flex items-center gap-3">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                            Syarat & Ketentuan
                        </h2>
                        <div class="text-amber-700/80 font-medium text-sm leading-relaxed">
                            {!! nl2br(e($specialOffer->terms_conditions)) !!}
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Gallery for Standalone -->
                @if($specialOffer->isStandalone() && $specialOffer->galleries->count() > 0)
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
                    <h2 class="text-xl font-bold text-gray-900 mb-6">Galeri Penawaran</h2>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($specialOffer->galleries as $gallery)
                        <div class="group relative aspect-square rounded-3xl overflow-hidden border-2 border-white shadow-sm hover:shadow-xl transition-all duration-500">
                            <img src="{{ asset('storage/' . $gallery->image_path) }}" alt="{{ $gallery->alt_text }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            @if($gallery->is_main)
                            <div class="absolute top-4 left-4 px-3 py-1 bg-indigo-600 text-white text-[10px] font-black uppercase tracking-widest rounded-full shadow-lg">Utama</div>
                            @endif
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

            <!-- Sidebar (Right) -->
            <div class="space-y-8">
                <!-- Main Image -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-6">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-4 text-center">Visual Penawaran</p>
                    <div class="aspect-[4/3] rounded-3xl overflow-hidden shadow-2xl shadow-indigo-100">
                        @if($specialOffer->main_image)
                            <img src="{{ asset('storage/' . $specialOffer->main_image) }}" alt="{{ $specialOffer->title }}" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gray-50 flex flex-col items-center justify-center text-gray-300 italic p-6 text-center">
                                <span class="text-xs">Gambar penawaran tidak tersedia</span>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Statistics / Trace -->
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 p-8">
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-6">Jejak Data</p>
                    <div class="space-y-4">
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-50 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Dibuat</p>
                                <p class="text-xs font-bold text-gray-900">{{ $specialOffer->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-8 h-8 bg-gray-50 rounded-lg flex items-center justify-center">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                            </div>
                            <div>
                                <p class="text-[9px] font-black text-gray-400 uppercase tracking-widest">Terakhir Diupdate</p>
                                <p class="text-xs font-bold text-gray-900">{{ $specialOffer->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="border-t border-gray-50 mt-8 pt-6">
                        <form action="{{ route('admin.special-offers.destroy', $specialOffer->id) }}" method="POST" onsubmit="return confirm('Hapus penawaran ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="w-full py-4 text-xs font-black text-rose-500 hover:text-rose-600 uppercase tracking-[0.2em] transition-colors">Hapus Penawaran</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }
    </style>
@endsection