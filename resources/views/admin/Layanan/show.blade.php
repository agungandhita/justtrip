@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10 antialiased text-gray-900">
        <!-- Breadcrumbs & Navigation -->
        <div class="mb-8 px-6">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div class="flex items-center gap-2 text-sm text-gray-500 mb-2 md:mb-0">
                    <a href="{{ route('admin.layanan.index') }}" class="hover:text-amber-600 transition-colors">Daftar Layanan</a>
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    <span class="text-gray-800 font-medium">Detail Layanan</span>
                </div>
                <div class="flex items-center gap-3">
                    <a href="{{ route('admin.layanan.index') }}" class="group flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-xl text-gray-700 hover:bg-gray-50 hover:border-amber-200 transition-all duration-300 shadow-sm">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                        Kembali
                    </a>
                    <a href="{{ route('admin.layanan.edit', $layanan) }}" class="flex items-center gap-2 bg-amber-500 hover:bg-amber-600 px-6 py-2 rounded-xl text-white font-semibold transition-all duration-300 shadow-lg shadow-amber-200">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                        Edit Layanan
                    </a>
                </div>
            </div>
        </div>

        <!-- Hero Section -->
        <div class="px-6 mb-8">
            <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-blue-900 to-indigo-800 rounded-3xl p-8 md:p-12 text-white shadow-2xl">
                <!-- Background Decoration -->
                <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-white opacity-10 rounded-full blur-3xl"></div>
                <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-blue-400 opacity-10 rounded-full blur-3xl"></div>
                
                <div class="relative z-10 flex flex-col md:flex-row md:items-end justify-between gap-6">
                    <div>
                        <div class="flex items-center gap-3 mb-4">
                            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md {{ $layanan->status == 'aktif' ? 'bg-emerald-500/20 text-emerald-300 border border-emerald-500/30' : 'bg-rose-500/20 text-rose-300 border border-rose-500/30' }}">
                                {{ $layanan->status }}
                            </span>
                            <span class="px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider backdrop-blur-md bg-white/10 text-blue-200 border border-white/20">
                                {{ $layanan->jenis_layanan_label }}
                            </span>
                        </div>
                        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-2">{{ $layanan->nama_layanan }}</h1>
                        <p class="text-blue-100 flex items-center gap-2 opacity-80">
                            <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>
                            {{ $layanan->lokasi_tujuan }}
                        </p>
                    </div>
                    <div class="text-left md:text-right">
                        <div class="text-blue-200 text-sm font-medium mb-1">Mulai Dari</div>
                        <div class="text-4xl md:text-5xl font-black text-amber-400 font-mono tracking-tighter">
                            {{ $layanan->harga_format }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content Grid -->
        <div class="px-6 grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Column: Primary Narrative -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Gallery Section -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-xl font-bold flex items-center gap-2">
                            <svg class="w-6 h-6 text-amber-500" fill="currentColor" viewBox="0 0 24 24"><path d="M21 19V5c0-1.1-.9-2-2-2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2zM8.5 13.5l2.5 3.01L14.5 12l4.5 6H5l3.5-4.5z"/></svg>
                            Visual Destinasi
                        </h3>
                        @if($layanan->gambar_destinasi && count($layanan->gambar_destinasi) > 0)
                            <span class="text-sm text-gray-400 font-medium">{{ count($layanan->gambar_destinasi) }} Galeri Media</span>
                        @endif
                    </div>
                    
                    @if($layanan->gambar_destinasi && count($layanan->gambar_destinasi) > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            @foreach($layanan->gambar_destinasi as $index => $gambar)
                                <div class="relative group aspect-square overflow-hidden rounded-2xl cursor-pointer {{ $index === 0 ? 'col-span-2 row-span-2' : '' }}"
                                     onclick="openImageModal('{{ Storage::url($gambar) }}', '{{ $layanan->nama_layanan }} - Photo {{ $index + 1 }}')">
                                    <img src="{{ Storage::url($gambar) }}"
                                         class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-black/0 group-hover:bg-black/30 transition-all duration-300 flex items-center justify-center">
                                        <svg class="w-10 h-10 text-white opacity-0 group-hover:opacity-100 transition-opacity" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/></svg>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="flex flex-col items-center justify-center py-12 bg-gray-50 rounded-2xl border-2 border-dashed border-gray-200">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            <p class="text-gray-500 font-medium">Belum ada gambar destinasi</p>
                        </div>
                    @endif
                </div>

                <!-- Description & Destinations -->
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <h3 class="text-xl font-bold mb-6 flex items-center gap-2 text-indigo-900">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                        Deskripsi & Destinasi
                    </h3>
                    <div class="prose prose-indigo max-w-none text-gray-600 leading-relaxed whitespace-pre-line mb-8">
                        {{ $layanan->deskripsi }}
                    </div>

                    @if(!empty($layanan->destinations))
                    <div class="mt-10 pt-8 border-t border-gray-50">
                        <h4 class="text-[10px] font-black text-gray-400 uppercase tracking-[0.2em] mb-4">Destinasi Utama</h4>
                        <div class="flex flex-wrap gap-2">
                            @foreach($layanan->destinations as $dest)
                                <span class="px-4 py-2 bg-indigo-50 text-indigo-700 rounded-xl text-sm font-bold border border-indigo-100 flex items-center gap-2 transition-all hover:bg-indigo-100 hover:scale-105 cursor-default">
                                    <svg class="w-4 h-4 text-indigo-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>
                                    {{ $dest }}
                                </span>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>

                <!-- Itinerary Section -->
                @if(!empty($layanan->itinerary))
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8 pb-6 border-b border-gray-50">
                        <h3 class="text-xl font-bold flex items-center gap-2 text-indigo-900">
                            <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Itinerary Perjalanan
                        </h3>
                        <div class="flex items-center gap-4">
                            <div class="px-4 py-2 bg-gray-50 rounded-xl text-[10px] font-black text-gray-500 uppercase flex items-center gap-2 border border-gray-100">
                                <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Mulai: {{ $layanan->start_time ?? '08:00' }}
                            </div>
                            <div class="px-4 py-2 bg-gray-50 rounded-xl text-[10px] font-black text-gray-500 uppercase flex items-center gap-2 border border-gray-100">
                                <svg class="w-4 h-4 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                Selesai: {{ $layanan->finish_time ?? '17:00' }}
                            </div>
                        </div>
                    </div>

                    <div class="space-y-8 relative">
                        <!-- Timeline Line -->
                        <div class="absolute left-5 top-2 bottom-2 w-0.5 bg-gray-100"></div>

                        @foreach($layanan->itinerary as $day)
                        <div class="relative pl-12">
                            <!-- Bullet Point -->
                            <div class="absolute left-0 top-1 w-10 h-10 rounded-2xl bg-white border-4 border-amber-500 shadow-sm flex items-center justify-center z-10">
                                <span class="text-xs font-black text-amber-600">{{ $day['day'] }}</span>
                            </div>
                            
                            <div class="bg-gray-50/50 p-6 rounded-2xl border border-gray-100 hover:bg-white hover:shadow-xl hover:-translate-y-1 transition-all duration-300">
                                <h4 class="font-black text-indigo-900 mb-4 text-xs uppercase tracking-widest flex items-center justify-between">
                                    <span>Hari Ke-{{ $day['day'] }}</span>
                                    <span class="w-12 h-0.5 bg-gray-200"></span>
                                </h4>
                                <ul class="grid grid-cols-1 md:grid-cols-2 gap-3">
                                    @foreach($day['activities'] ?? [] as $activity)
                                    <li class="flex items-start gap-3 text-sm text-gray-600 bg-white p-3 rounded-xl border border-gray-50 shadow-sm group hover:border-amber-200 transition-colors">
                                        <div class="w-5 h-5 bg-amber-50 text-amber-500 rounded-lg flex items-center justify-center shrink-0 mt-0.5 group-hover:bg-amber-500 group-hover:text-white transition-colors">
                                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        </div>
                                        <span class="font-medium">{{ $activity }}</span>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    @if($layanan->itinerary_note)
                    <div class="mt-8 p-6 bg-amber-50/50 border border-amber-100 rounded-2xl">
                        <p class="text-xs text-amber-800 font-bold italic flex items-center gap-3">
                            <div class="w-8 h-8 bg-amber-500 text-white rounded-lg flex items-center justify-center shrink-0">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            "{{ $layanan->itinerary_note }}"
                        </p>
                    </div>
                    @endif
                </div>
                @endif


            </div>

            <!-- Right Column: Sidebar Actions -->
            <div class="lg:col-span-4 space-y-6 lg:sticky lg:top-24">
                <!-- Trip quick stats -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center transition-all hover:shadow-md">
                        <div class="w-10 h-10 bg-amber-50 rounded-xl flex items-center justify-center text-amber-600 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Durasi</span>
                        <span class="text-sm font-bold text-gray-900">{{ $layanan->durasi_format }}</span>
                    </div>
                    <div class="bg-white p-5 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center transition-all hover:shadow-md">
                        <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600 mb-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                        </div>
                        <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Kapasitas</span>
                        <span class="text-sm font-bold text-gray-900">{{ $layanan->maks_orang }} Pax</span>
                    </div>
                </div>

                <!-- Action Card -->
                <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                    <h3 class="font-black text-gray-900 mb-6 pb-2 border-b border-gray-50 text-xs uppercase tracking-[0.2em]">Kontrol Admin</h3>
                    
                    <div class="space-y-4">
                        <form action="{{ route('admin.layanan.toggle-status', $layanan) }}" method="POST">
                            @csrf
                            <button type="submit" class="w-full flex items-center justify-between p-4 rounded-2xl transition-all duration-300 {{ $layanan->status == 'aktif' ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-100' : 'bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-100' }}">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-full flex items-center justify-center {{ $layanan->status == 'aktif' ? 'bg-emerald-500 text-white' : 'bg-rose-500 text-white' }}">
                                        @if($layanan->status == 'aktif')
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                        @else
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 00-2 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                                        @endif
                                    </div>
                                    <div class="text-left">
                                        <div class="text-[11px] font-black uppercase">{{ $layanan->status == 'aktif' ? 'Layanan Terbit' : 'Layanan Draft' }}</div>
                                        <div class="text-[9px] uppercase tracking-wider opacity-60 font-bold">Ubah Status</div>
                                    </div>
                                </div>
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                            </button>
                        </form>

                        <a href="{{ route('admin.layanan.edit', $layanan) }}" class="w-full flex items-center justify-between p-4 bg-amber-50 rounded-2xl border border-amber-100 text-amber-700 hover:bg-amber-100 transition-all duration-300">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 bg-amber-500 text-white rounded-full flex items-center justify-center">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                </div>
                                <div class="text-left">
                                    <div class="text-[11px] font-black uppercase">Edit Informasi</div>
                                    <div class="text-[9px] uppercase tracking-wider opacity-60 font-bold">Ubah Data</div>
                                </div>
                            </div>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                        </a>
                    </div>
                </div>

                <!-- Include & Exclude Services (Stacked in Sidebar) -->
                <div class="space-y-4">
                    <div class="bg-indigo-900 rounded-[2.5rem] p-8 shadow-xl text-white overflow-hidden relative border border-white/10">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-emerald-500/20 rounded-full blur-2xl"></div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                             <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                             Harga Termasuk
                        </h4>
                        <div class="space-y-3">
                            @if(!empty($layanan->include_services))
                                @foreach($layanan->include_services as $service)
                                    <div class="flex items-start gap-3 p-3 rounded-xl bg-white/5 border border-white/5 text-[11px] font-bold">
                                        <svg class="w-3.5 h-3.5 text-emerald-400 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        {{ $service }}
                                    </div>
                                @endforeach
                            @elseif(!empty($layanan->fasilitas))
                                @foreach($layanan->fasilitas as $fas)
                                    <div class="flex items-start gap-3 p-3 rounded-xl bg-white/5 border border-white/5 text-[11px] font-bold">
                                        <svg class="w-3.5 h-3.5 text-emerald-400 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                        {{ $fas }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <div class="bg-gray-950 rounded-[2.5rem] p-8 shadow-xl text-white overflow-hidden relative border border-white/5">
                        <div class="absolute -right-6 -top-6 w-24 h-24 bg-rose-500/20 rounded-full blur-2xl"></div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                             <span class="w-1.5 h-1.5 bg-rose-500 rounded-full"></span>
                             Tidak Termasuk
                        </h4>
                        <div class="space-y-3">
                            @if(!empty($layanan->exclude_services))
                                @foreach($layanan->exclude_services as $service)
                                    <div class="flex items-start gap-3 p-3 rounded-xl bg-white/5 border border-white/5 text-[11px] font-bold opacity-60">
                                        <svg class="w-3.5 h-3.5 text-rose-500 shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"/></svg>
                                        {{ $service }}
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Info Box -->
                @if($layanan->catatan)
                <div class="bg-amber-50 rounded-[2rem] p-8 border border-amber-100 relative overflow-hidden">
                    <div class="absolute -left-4 -bottom-4 w-20 h-20 bg-amber-500/10 rounded-full"></div>
                    <h4 class="text-amber-800 font-black mb-3 flex items-center gap-2 uppercase tracking-widest text-[10px]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Catatan Internal
                    </h4>
                    <p class="text-amber-700 text-xs italic font-medium leading-relaxed">
                        "{{ $layanan->catatan }}"
                    </p>
                </div>
                @endif

                <!-- Audit Trail -->
                <div class="bg-white rounded-[2rem] p-8 shadow-sm border border-gray-100">
                    <h3 class="font-black text-gray-900 mb-6 uppercase tracking-widest text-[10px]">Log Aktivitas</h3>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="relative">
                                <div class="w-2 h-2 bg-emerald-500 rounded-full mt-2 ring-4 ring-emerald-100"></div>
                                <div class="absolute top-6 bottom-0 left-[3px] w-[2px] bg-gray-100"></div>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-800 uppercase tracking-tighter">Dibuat</p>
                                <p class="text-[10px] text-gray-400 font-bold mb-1">{{ $layanan->created_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                        <div class="flex gap-4">
                            <div class="relative">
                                <div class="w-2 h-2 bg-blue-500 rounded-full mt-2 ring-4 ring-blue-100"></div>
                            </div>
                            <div>
                                <p class="text-[10px] font-black text-gray-800 uppercase tracking-tighter">Diperbarui</p>
                                <p class="text-[10px] text-gray-400 font-bold mb-1">{{ $layanan->updated_at->format('d M Y, H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Full Width: Pricing & Policy Footer -->
        <div class="px-6 mb-12">
            <div class="bg-indigo-950 rounded-[3rem] p-8 md:p-12 shadow-2xl relative overflow-hidden border border-white/5">
                <div class="absolute top-0 left-0 w-full h-full opacity-10 pointer-events-none">
                    <div class="absolute top-10 right-10 w-80 h-80 bg-amber-400 rounded-full blur-[120px]"></div>
                    <div class="absolute bottom-10 left-10 w-80 h-80 bg-blue-400 rounded-full blur-[120px]"></div>
                </div>

                <div class="relative z-10 grid grid-cols-1 lg:grid-cols-12 gap-12">
                    <!-- Pricing Details (5/12) -->
                    <div class="lg:col-span-5">
                        <h3 class="text-2xl font-black text-white mb-8 flex items-center gap-4">
                            <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            </div>
                            Kategori Harga
                        </h3>
                        
                        <div class="space-y-4">
                            @if(!empty($layanan->pricing_options))
                                @foreach($layanan->pricing_options as $price)
                                    <div class="p-6 rounded-3xl bg-white/5 border border-white/10 hover:bg-white/10 hover:border-amber-500/30 transition-all duration-300 group">
                                        <div class="flex justify-between items-center">
                                            <div>
                                                <span class="px-3 py-1 bg-amber-500/20 text-amber-400 text-[10px] font-black uppercase tracking-widest rounded-full border border-amber-500/30 mb-2 inline-block">
                                                    {{ $price['type'] }}
                                                </span>
                                                <div class="text-white/60 text-[10px] font-black uppercase tracking-tighter">Biaya Per Pax</div>
                                            </div>
                                            <div class="text-3xl font-black text-white font-mono tracking-tighter group-hover:text-amber-400 transition-colors">
                                                Rp {{ number_format($price['price'], 0, ',', '.') }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="p-6 rounded-3xl bg-white/5 border border-white/10">
                                    <div class="flex justify-between items-center">
                                        <div class="text-white/60 font-medium">Harga Mulai (Default)</div>
                                        <div class="text-3xl font-black text-amber-400 font-mono tracking-tighter">
                                            {{ $layanan->harga_format }}
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($layanan->information_image)
                            <div class="mt-8 rounded-3xl overflow-hidden border border-white/10 shadow-2xl group cursor-pointer" 
                                 onclick="openImageModal('{{ Storage::url($layanan->information_image) }}', 'Panduan Informasi Paket')">
                                <div class="relative aspect-video">
                                    <img src="{{ Storage::url($layanan->information_image) }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                                    <div class="absolute inset-0 bg-gradient-to-t from-indigo-950/80 to-transparent flex items-end p-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 bg-white/10 backdrop-blur-md rounded-xl flex items-center justify-center text-white">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                            </div>
                                            <span class="text-xs font-black text-white uppercase tracking-wider">Tab Informasi Lengkap</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Terms & Conditions (7/12) -->
                    <div class="lg:col-span-7">
                        <h3 class="text-2xl font-black text-white mb-8 flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-500 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            Syarat & Ketentuan
                        </h3>

                        @php $terms = $layanan->terms_conditions ?? []; @endphp

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                            <!-- Registration -->
                            <div class="space-y-4">
                                <h4 class="text-amber-400 text-xs font-black uppercase tracking-[0.2em] flex items-center gap-2">
                                    <span class="w-2 h-2 rounded-full bg-amber-400"></span>
                                    Pendaftaran & Bayar
                                </h4>
                                <ul class="space-y-4">
                                    @foreach($terms['registration_payment'] ?? ['Informasi tidak tersedia.'] as $term)
                                        <li class="text-sm font-medium text-blue-100/60 leading-relaxed flex items-start gap-3">
                                            <div class="w-1.5 h-1.5 bg-white/20 rounded-full mt-2 shrink-0"></div>
                                            {{ $term }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>

                            <!-- Cancellation & Resp -->
                            <div class="space-y-8">
                                <div class="space-y-4">
                                    <h4 class="text-rose-400 text-xs font-black uppercase tracking-[0.2em] flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-rose-400"></span>
                                        Ketentuan Batal
                                    </h4>
                                    <ul class="space-y-4">
                                        @foreach($terms['cancelation'] ?? ['Informasi tidak tersedia.'] as $term)
                                            <li class="text-sm font-medium text-blue-100/60 leading-relaxed flex items-start gap-3">
                                                <div class="w-1.5 h-1.5 bg-white/20 rounded-full mt-2 shrink-0"></div>
                                                {{ $term }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>

                                <div class="p-6 rounded-3xl bg-blue-500/10 border border-blue-500/20">
                                    <h4 class="text-blue-400 text-xs font-black uppercase tracking-[0.2em] mb-4">Penting Diketahui</h4>
                                    <ul class="space-y-3">
                                        @foreach($terms['not_responsible_for'] ?? ['Penyelenggara berhak menyesuaikan itinerary demi keselamatan.'] as $term)
                                            <li class="text-[11px] font-bold text-blue-200/50 leading-relaxed flex items-start gap-3 italic">
                                                <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                                                {{ $term }}
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Enhanced Image Modal -->
    <div id="imageModal" class="fixed inset-0 bg-indigo-950/95 backdrop-blur-md z-[100] hidden flex flex-col items-center justify-center p-8 transition-all duration-300">
        <button onclick="closeImageModal()" class="absolute top-6 right-6 text-white hover:text-amber-400 transition-colors p-3 bg-white/5 rounded-full hover:bg-white/10">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M18 6L6 18M6 6l12 12"/></svg>
        </button>
        <div class="relative max-w-5xl w-full h-full flex flex-col items-center justify-center">
            <img id="modalImage" src="" alt="" class="max-w-full max-h-[80vh] object-contain rounded-2xl shadow-[0_0_100px_rgba(0,0,0,0.5)]">
            <div class="mt-8 text-center max-w-2xl">
                <h4 id="modalCaption" class="text-white text-2xl font-bold mb-2"></h4>
                <div class="w-24 h-1 bg-amber-500 mx-auto rounded-full"></div>
            </div>
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .prose p {
            margin-bottom: 1.5rem;
        }

        scrollbar-width: thin;
        scrollbar-color: #f59e0b transparent;
    </style>

    <script>
        function openImageModal(imageSrc, caption) {
            const modal = document.getElementById('imageModal');
            const img = document.getElementById('modalImage');
            const cap = document.getElementById('modalCaption');
            
            img.src = imageSrc;
            cap.textContent = caption;
            
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeImageModal() {
            const modal = document.getElementById('imageModal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        // Close on click backdrop
        document.getElementById('imageModal').addEventListener('click', function(e) {
            if (e.target === this || e.target.closest('.flex-col')) {
                // Check if not clicking the image
                if (e.target.tagName !== 'IMG' && e.target.tagName !== 'H4') {
                    closeImageModal();
                }
            }
        });

        // ESC to close
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeImageModal();
        });
    </script>
@endsection

