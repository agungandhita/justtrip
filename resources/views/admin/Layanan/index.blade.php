@extends('admin.layouts.main')

@section('container')
<div class="mt-20 pb-16 antialiased text-gray-900 px-4 md:px-8">
    <!-- Breadcrumb & Top Bar -->
    <div class="mb-8">
        <div class="flex items-center gap-2 text-xs text-gray-400 font-bold uppercase tracking-wider mb-3">
            <a href="{{ route('admin.dashboard') }}" class="hover:text-indigo-600 transition-colors flex items-center gap-1.5">
                <i class="fa-solid fa-house text-xs"></i>
                Dashboard
            </a>
            <svg class="w-3.5 h-3.5 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5l7 7-7 7"/></svg>
            <span class="text-indigo-600 font-extrabold">Manajemen Layanan</span>
        </div>

        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6 bg-white p-6 md:p-8 rounded-3xl border border-gray-100 shadow-sm">
            <div class="space-y-1.5">
                <div class="flex items-center gap-3">
                    <div class="w-11 h-11 rounded-2xl bg-gradient-to-tr from-indigo-600 to-violet-500 text-white flex items-center justify-center shadow-md shadow-indigo-100">
                        <i class="fa-solid fa-layer-group text-lg"></i>
                    </div>
                    <div>
                        <h1 class="text-2xl md:text-3xl font-black text-gray-900 tracking-tight">Manajemen Layanan & Paket Tour</h1>
                    </div>
                </div>
                <p class="text-gray-500 text-sm font-medium pl-14">
                    Kelola paket wisata, spesifikasi perjalanan, status publikasi, dan skema harga travel JustTrip.
                </p>
            </div>

            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('layanan.index') }}" target="_blank" class="inline-flex items-center gap-2 px-4 py-3 rounded-2xl bg-gray-50 hover:bg-gray-100 text-gray-700 font-bold text-sm border border-gray-200 transition-all">
                    <i class="fa-solid fa-arrow-up-right-from-square text-xs text-gray-400"></i>
                    <span>Katalog</span>
                </a>
                <button type="button" onclick="openImportModal()" class="inline-flex items-center gap-2 px-5 py-3 rounded-2xl bg-emerald-50 hover:bg-emerald-100 text-emerald-800 font-black text-sm border border-emerald-200 transition-all shadow-sm">
                    <i class="fa-solid fa-file-excel text-emerald-600 text-base"></i>
                    <span>Import Excel</span>
                </button>
                <a href="{{ route('admin.layanan.create') }}" class="inline-flex items-center gap-2 bg-gradient-to-r from-indigo-600 to-indigo-700 hover:from-indigo-700 hover:to-indigo-800 text-white px-5 py-3 rounded-2xl font-black text-sm transition-all duration-300 shadow-lg shadow-indigo-200 hover:shadow-indigo-300 group">
                    <i class="fa-solid fa-plus text-xs group-hover:rotate-90 transition-transform duration-300"></i>
                    <span>Tambah Layanan Baru</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Alert / Feedback Hasil Import jika ada baris dilewati -->
    @if(session('import_errors') && count(session('import_errors')) > 0)
    <div class="mb-6 p-5 rounded-3xl bg-amber-50 border border-amber-200/80 text-amber-950 text-xs shadow-sm">
        <div class="flex items-center gap-2.5 font-black text-sm text-amber-900 mb-2">
            <i class="fa-solid fa-triangle-exclamation text-amber-600 text-base"></i>
            <span>Catatan Baris yang Dilewati / Butuh Penyesuaian:</span>
        </div>
        <ul class="list-disc list-inside space-y-1 text-amber-800 pl-1 font-medium">
            @foreach(session('import_errors') as $err)
                <li>{{ $err }}</li>
            @endforeach
        </ul>
        <p class="mt-2 text-[11px] text-amber-700 font-bold">
            Tips: Anda dapat mengedit paket yang berhasil diimpor kapan saja melalui tombol Edit pada daftar tabel di bawah.
        </p>
    </div>
    @endif

    <!-- Metrics KPI Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
        <!-- Card 1: Total Layanan -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-shadow">
            <div class="space-y-1">
                <span class="text-[11px] font-black uppercase tracking-wider text-gray-400">Total Paket Tour</span>
                <h3 class="text-3xl font-black text-gray-900 font-mono tracking-tight">{{ $stats['total'] ?? $layanan->total() }}</h3>
                <span class="text-xs text-gray-400 font-medium">Terdaftar di sistem</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-indigo-50/80 text-indigo-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-suitcase-rolling"></i>
            </div>
        </div>

        <!-- Card 2: Layanan Aktif -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-shadow">
            <div class="space-y-1">
                <span class="text-[11px] font-black uppercase tracking-wider text-emerald-600 flex items-center gap-1.5">
                    <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                    Paket Aktif (Live)
                </span>
                <h3 class="text-3xl font-black text-emerald-600 font-mono tracking-tight">{{ $stats['aktif'] ?? 0 }}</h3>
                <span class="text-xs text-gray-400 font-medium">Tampil di website</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-emerald-50/80 text-emerald-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-circle-check"></i>
            </div>
        </div>

        <!-- Card 3: Layanan Nonaktif -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-shadow">
            <div class="space-y-1">
                <span class="text-[11px] font-black uppercase tracking-wider text-rose-500">Draft / Nonaktif</span>
                <h3 class="text-3xl font-black text-rose-600 font-mono tracking-tight">{{ $stats['nonaktif'] ?? 0 }}</h3>
                <span class="text-xs text-gray-400 font-medium">Disembunyikan</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-rose-50/80 text-rose-500 flex items-center justify-center text-xl">
                <i class="fa-solid fa-pause"></i>
            </div>
        </div>

        <!-- Card 4: Kategori Tersedia -->
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100/80 flex items-center justify-between hover:shadow-md transition-shadow">
            <div class="space-y-1">
                <span class="text-[11px] font-black uppercase tracking-wider text-gray-400">Jenis Layanan</span>
                <h3 class="text-3xl font-black text-gray-900 font-mono tracking-tight">{{ count($jenisLayananOptions) }}</h3>
                <span class="text-xs text-indigo-600 font-bold">Termasuk Adventure</span>
            </div>
            <div class="w-14 h-14 rounded-2xl bg-amber-50/80 text-amber-600 flex items-center justify-center text-xl">
                <i class="fa-solid fa-shapes"></i>
            </div>
        </div>
    </div>

    <!-- Category Tabs Navigation -->
    <div class="flex items-center gap-2 overflow-x-auto pb-3 mb-4 scrollbar-none">
        <a href="{{ route('admin.layanan.index', array_merge(request()->except(['jenis_layanan', 'page']))) }}"
           class="px-5 py-2.5 rounded-2xl text-xs font-black transition-all flex items-center gap-2 shrink-0 {{ !request('jenis_layanan') ? 'bg-indigo-600 text-white shadow-md shadow-indigo-100' : 'bg-white text-gray-600 hover:bg-gray-50 border border-gray-200/80' }}">
            <i class="fa-solid fa-globe text-xs"></i>
            <span>Semua Layanan</span>
        </a>

        <!-- Corporate -->
        <a href="{{ route('admin.layanan.index', array_merge(request()->except('page'), ['jenis_layanan' => 'corporate_trip'])) }}"
           class="px-5 py-2.5 rounded-2xl text-xs font-black transition-all flex items-center gap-2 shrink-0 {{ request('jenis_layanan') == 'corporate_trip' ? 'bg-emerald-600 text-white shadow-md shadow-emerald-100' : 'bg-white text-gray-600 hover:bg-emerald-50 hover:text-emerald-700 border border-gray-200/80' }}">
            <i class="fa-solid fa-building text-xs"></i>
            <span>Corporate (Per orang)</span>
        </a>

        <!-- Adventure -->
        <a href="{{ route('admin.layanan.index', array_merge(request()->except('page'), ['jenis_layanan' => 'adventure_trip'])) }}"
           class="px-5 py-2.5 rounded-2xl text-xs font-black transition-all flex items-center gap-2 shrink-0 {{ request('jenis_layanan') == 'adventure_trip' ? 'bg-amber-600 text-white shadow-md shadow-amber-100' : 'bg-white text-gray-600 hover:bg-amber-50 hover:text-amber-700 border border-gray-200/80' }}">
            <i class="fa-solid fa-mountain-sun text-xs"></i>
            <span>Adventure (Per orang)</span>
        </a>

        <!-- Edukasi -->
        <a href="{{ route('admin.layanan.index', array_merge(request()->except('page'), ['jenis_layanan' => 'edu_trip'])) }}"
           class="px-5 py-2.5 rounded-2xl text-xs font-black transition-all flex items-center gap-2 shrink-0 {{ request('jenis_layanan') == 'edu_trip' ? 'bg-indigo-600 text-white shadow-md shadow-indigo-100' : 'bg-white text-gray-600 hover:bg-indigo-50 hover:text-indigo-700 border border-gray-200/80' }}">
            <i class="fa-solid fa-graduation-cap text-xs"></i>
            <span>Edukasi (Per orang / Kelompok*)</span>
        </a>

        <!-- Open Trip -->
        <a href="{{ route('admin.layanan.index', array_merge(request()->except('page'), ['jenis_layanan' => 'open_trip'])) }}"
           class="px-5 py-2.5 rounded-2xl text-xs font-black transition-all flex items-center gap-2 shrink-0 {{ request('jenis_layanan') == 'open_trip' ? 'bg-purple-600 text-white shadow-md shadow-purple-100' : 'bg-white text-gray-600 hover:bg-purple-50 hover:text-purple-700 border border-gray-200/80' }}">
            <i class="fa-solid fa-users text-xs"></i>
            <span>Open Trip (Per orang)</span>
        </a>
    </div>

    <!-- Search & Filter Bar -->
    <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-5 mb-6">
        <form action="{{ route('admin.layanan.index') }}" method="GET" class="space-y-3">
            @if(request('jenis_layanan'))
                <input type="hidden" name="jenis_layanan" value="{{ request('jenis_layanan') }}">
            @endif

            <div class="flex flex-col md:flex-row items-center gap-3">
                <!-- Search Field -->
                <div class="flex-1 w-full relative">
                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400">
                        <i class="fa-solid fa-magnifying-glass text-sm"></i>
                    </span>
                    <input type="text" name="search" value="{{ request('search') }}"
                           class="w-full pl-11 pr-10 py-3 bg-gray-50/70 border border-gray-200 rounded-2xl text-sm font-medium outline-none focus:bg-white focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 transition-all"
                           placeholder="Cari berdasarkan nama layanan, destinasi, atau deskripsi...">
                    @if(request('search'))
                        <a href="{{ route('admin.layanan.index', request()->except('search')) }}" class="absolute right-3.5 top-1/2 -translate-y-1/2 text-gray-400 hover:text-gray-600">
                            <i class="fa-solid fa-circle-xmark text-sm"></i>
                        </a>
                    @endif
                </div>

                <!-- Status Filter -->
                <div class="w-full md:w-48 relative">
                    <select name="status" onchange="this.form.submit()"
                            class="w-full px-4 py-3 bg-gray-50/70 border border-gray-200 text-gray-700 text-sm font-bold rounded-2xl outline-none focus:bg-white focus:border-indigo-500 transition-all appearance-none cursor-pointer">
                        <option value="">Semua Status</option>
                        <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>🟢 Aktif</option>
                        <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>🔴 Nonaktif</option>
                    </select>
                    <span class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-gray-400 text-xs">
                        <i class="fa-solid fa-chevron-down"></i>
                    </span>
                </div>

                <!-- Submit / Filter Button -->
                <button type="submit" class="w-full md:w-auto px-6 py-3 bg-gray-900 hover:bg-black text-white text-sm font-black rounded-2xl transition-all shadow-sm flex items-center justify-center gap-2">
                    <i class="fa-solid fa-filter text-xs"></i>
                    <span>Terapkan</span>
                </button>

                <!-- Reset Filter Button -->
                @if(request()->anyFilled(['search', 'jenis_layanan', 'status']))
                <a href="{{ route('admin.layanan.index') }}" class="w-full md:w-auto px-4 py-3 bg-rose-50 hover:bg-rose-100 text-rose-600 text-sm font-black rounded-2xl transition-all flex items-center justify-center gap-1.5" title="Reset Semua Filter">
                    <i class="fa-solid fa-rotate-left text-xs"></i>
                    <span>Reset</span>
                </a>
                @endif
            </div>

            <!-- Active Filter Chips -->
            @if(request()->anyFilled(['search', 'jenis_layanan', 'status']))
            <div class="flex flex-wrap items-center gap-2 pt-2 border-t border-gray-100 text-xs">
                <span class="text-gray-400 font-bold">Filter Aktif:</span>
                @if(request('search'))
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-100 text-gray-700 rounded-xl font-medium">
                        Cari: "{{ request('search') }}"
                        <a href="{{ route('admin.layanan.index', request()->except('search')) }}" class="hover:text-rose-500"><i class="fa-solid fa-xmark text-[10px]"></i></a>
                    </span>
                @endif
                @if(request('jenis_layanan'))
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-indigo-50 text-indigo-700 rounded-xl font-bold">
                        Kategori: {{ $jenisLayananOptions[request('jenis_layanan')] ?? request('jenis_layanan') }}
                        <a href="{{ route('admin.layanan.index', request()->except('jenis_layanan')) }}" class="hover:text-rose-500"><i class="fa-solid fa-xmark text-[10px]"></i></a>
                    </span>
                @endif
                @if(request('status'))
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 rounded-xl font-bold">
                        Status: {{ ucfirst(request('status')) }}
                        <a href="{{ route('admin.layanan.index', request()->except('status')) }}" class="hover:text-rose-500"><i class="fa-solid fa-xmark text-[10px]"></i></a>
                    </span>
                @endif
            </div>
            @endif
        </form>
    </div>

    <!-- Services Table Card -->
    <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/70 border-b border-gray-100">
                        <th class="px-6 py-4 text-[11px] font-black uppercase tracking-wider text-gray-400">Identitas Layanan</th>
                        <th class="px-6 py-4 text-[11px] font-black uppercase tracking-wider text-gray-400">Kategori & Durasi</th>
                        <th class="px-6 py-4 text-[11px] font-black uppercase tracking-wider text-gray-400 text-right">Harga Mulai</th>
                        <th class="px-6 py-4 text-[11px] font-black uppercase tracking-wider text-gray-400 text-center">Status Publikasi</th>
                        <th class="px-6 py-4 text-[11px] font-black uppercase tracking-wider text-gray-400 text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100 text-sm">
                    @forelse($layanan as $item)
                    <tr class="hover:bg-slate-50/60 transition-colors duration-200 group">
                        <!-- Identitas Paket -->
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-4">
                                <div class="relative w-20 h-14 rounded-2xl overflow-hidden border border-gray-200/80 shadow-sm shrink-0 bg-gray-100 group-hover:scale-105 transition-transform duration-300">
                                    @if($item->gambar_utama)
                                        <img src="{{ asset('storage/' . $item->gambar_utama) }}" alt="{{ $item->nama_layanan }}" class="w-full h-full object-cover">
                                    @elseif($item->gambar_destinasi && count($item->gambar_destinasi) > 0)
                                        <img src="{{ asset('storage/' . $item->gambar_destinasi[0]) }}" alt="{{ $item->nama_layanan }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-gray-300">
                                            <i class="fa-solid fa-mountain-city text-lg"></i>
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <a href="{{ route('admin.layanan.show', $item) }}" class="font-extrabold text-gray-900 hover:text-indigo-600 transition-colors block text-sm leading-snug">
                                        {{ $item->nama_layanan }}
                                    </a>
                                    <div class="flex items-center gap-2 mt-1 text-xs text-gray-400 font-medium">
                                        <span class="flex items-center gap-1 text-rose-500 font-semibold">
                                            <i class="fa-solid fa-location-dot text-[11px]"></i>
                                            {{ $item->lokasi_tujuan }}
                                        </span>
                                        <span class="w-1 h-1 rounded-full bg-gray-300"></span>
                                        <span>Dibuat {{ $item->created_at->format('d M Y') }}</span>
                                    </div>
                                </div>
                            </div>
                        </td>

                        <!-- Kategori & Spesifikasi -->
                        <td class="px-6 py-5">
                            <div class="space-y-1.5">
                                @php
                                    $badgeStyles = [
                                        'corporate_trip' => 'bg-emerald-50 text-emerald-700 border-emerald-200/80',
                                        'adventure_trip' => 'bg-amber-50 text-amber-800 border-amber-200/80',
                                        'edu_trip' => 'bg-indigo-50 text-indigo-700 border-indigo-200/80',
                                        'open_trip' => 'bg-purple-50 text-purple-700 border-purple-200/80',
                                    ];
                                    $badgeIcons = [
                                        'corporate_trip' => 'fa-building',
                                        'adventure_trip' => 'fa-mountain-sun',
                                        'edu_trip' => 'fa-graduation-cap',
                                        'open_trip' => 'fa-users',
                                    ];
                                    $currentStyle = $badgeStyles[$item->jenis_layanan] ?? 'bg-blue-50 text-blue-700 border-blue-200';
                                    $currentIcon = $badgeIcons[$item->jenis_layanan] ?? 'fa-compass';
                                @endphp
                                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-xl text-xs font-bold border {{ $currentStyle }}">
                                    <i class="fa-solid {{ $currentIcon }} text-[11px]"></i>
                                    {{ $item->jenis_layanan_label }}
                                </span>

                                <div class="flex items-center gap-2 text-xs text-gray-500 font-medium">
                                    <span class="flex items-center gap-1">
                                        <i class="fa-regular fa-clock text-gray-400 text-[11px]"></i>
                                        {{ $item->durasi_format }}
                                    </span>
                                    <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                    <span class="flex items-center gap-1">
                                        <i class="fa-solid fa-user-group text-gray-400 text-[11px]"></i>
                                        Maks {{ $item->maks_orang }} Pax
                                    </span>
                                </div>
                            </div>
                        </td>

                        <!-- Harga Mulai -->
                        <td class="px-6 py-5 text-right">
                            <div class="font-mono font-black text-indigo-700 text-base">
                                {{ $item->harga_format }}
                            </div>
                            <span class="text-[11px] text-gray-400 font-medium">
                                @if($item->jenis_layanan === 'edu_trip')
                                    Tarif dasar paket
                                @else
                                    Per orang
                                @endif
                            </span>
                        </td>

                        <!-- Status Publikasi & Quick Toggle -->
                        <td class="px-6 py-5 text-center">
                            <form action="{{ route('admin.layanan.toggle-status', $item) }}" method="POST" class="inline-block">
                                @csrf
                                <button type="submit"
                                        class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full text-xs font-black transition-all cursor-pointer {{ $item->status == 'aktif' ? 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200 border border-gray-200' }}"
                                        title="Klik untuk mengubah status">
                                    <span class="w-2 h-2 rounded-full {{ $item->status == 'aktif' ? 'bg-emerald-500 animate-pulse' : 'bg-gray-400' }}"></span>
                                    <span>{{ $item->status == 'aktif' ? 'AKTIF' : 'NONAKTIF' }}</span>
                                    <i class="fa-solid fa-repeat text-[10px] opacity-60"></i>
                                </button>
                            </form>
                        </td>

                        <!-- Aksi -->
                        <td class="px-6 py-5 text-right">
                            <div class="flex items-center justify-end gap-1.5">
                                <!-- Detail -->
                                <a href="{{ route('admin.layanan.show', $item) }}"
                                   class="w-9 h-9 rounded-xl flex items-center justify-center text-gray-400 hover:text-indigo-600 hover:bg-indigo-50 transition-all border border-transparent hover:border-indigo-100"
                                   title="Lihat Detail Lengkap">
                                    <i class="fa-regular fa-eye text-sm"></i>
                                </a>

                                <!-- Edit -->
                                <a href="{{ route('admin.layanan.edit', $item) }}"
                                   class="w-9 h-9 rounded-xl flex items-center justify-center text-gray-400 hover:text-amber-600 hover:bg-amber-50 transition-all border border-transparent hover:border-amber-100"
                                   title="Edit Paket">
                                    <i class="fa-regular fa-pen-to-square text-sm"></i>
                                </a>

                                <!-- Hapus -->
                                <form action="{{ route('admin.layanan.destroy', $item) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket layanan ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="w-9 h-9 rounded-xl flex items-center justify-center text-gray-400 hover:text-rose-600 hover:bg-rose-50 transition-all border border-transparent hover:border-rose-100"
                                            title="Hapus Paket">
                                        <i class="fa-regular fa-trash-can text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-20 text-center">
                            <div class="max-w-md mx-auto space-y-4">
                                <div class="w-16 h-16 rounded-3xl bg-gray-50 text-gray-300 flex items-center justify-center mx-auto text-2xl border border-gray-100">
                                    <i class="fa-solid fa-map-location-dot"></i>
                                </div>
                                <div class="space-y-1">
                                    <h4 class="text-base font-black text-gray-800">Tidak ada paket layanan ditemukan</h4>
                                    <p class="text-xs text-gray-400 font-medium">
                                        Sesuaikan kata kunci pencarian atau bersihkan filter kategori Anda.
                                    </p>
                                </div>
                                <div class="flex items-center justify-center gap-2 pt-2">
                                    <a href="{{ route('admin.layanan.index') }}" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-xl transition-all">
                                        Reset Filter
                                    </a>
                                    <a href="{{ route('admin.layanan.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white text-xs font-bold rounded-xl transition-all">
                                        + Buat Paket Baru
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination Section -->
        @if($layanan->hasPages())
        <div class="px-8 py-5 bg-gray-50/60 border-t border-gray-100 flex flex-col sm:flex-row items-center justify-between gap-4">
            <div class="text-xs text-gray-500 font-medium">
                Menampilkan <span class="font-bold text-gray-900">{{ $layanan->firstItem() }}</span> - <span class="font-bold text-gray-900">{{ $layanan->lastItem() }}</span> dari <span class="font-bold text-gray-900">{{ $layanan->total() }}</span> paket tour
            </div>
            <div>
                {{ $layanan->appends(request()->query())->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

@include('admin.Layanan.partials.import-modal')
@endsection
