@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10 antialiased text-gray-900 px-4 md:px-8">
        <!-- Header Section -->
        <div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Penawaran Khusus</h1>
                <p class="text-gray-500 font-medium mt-1">Kelola kampanye promosi dan diskon eksklusif.</p>
            </div>
            <div class="flex flex-wrap items-center gap-3">
                <a href="{{ route('admin.special-offers.create-standalone') }}" class="inline-flex items-center gap-2 bg-white hover:bg-gray-50 text-gray-700 px-6 py-3 rounded-2xl font-bold transition-all duration-300 shadow-sm border border-gray-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    Penawaran Mandiri
                </a>
                <a href="{{ route('admin.special-offers.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold transition-all duration-300 shadow-lg shadow-indigo-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    Buat Penawaran
                </a>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Total Promo</p>
                        <p class="text-xl font-bold text-gray-900">{{ $specialOffers->total() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Aktif Saat Ini</p>
                        <p class="text-xl font-bold text-gray-900">{{ $specialOffers->where('is_active', true)->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.382-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Unggulan</p>
                        <p class="text-xl font-bold text-gray-900">{{ $specialOffers->where('is_featured', true)->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-gray-100 hover:shadow-md transition-shadow duration-300">
                <div class="flex items-center gap-4">
                    <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-black uppercase tracking-widest text-gray-400">Mendatang</p>
                        <p class="text-xl font-bold text-gray-900">{{ $specialOffers->where('valid_from', '>', now())->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Bar -->
        <div class="bg-white p-4 rounded-[2rem] shadow-sm border border-gray-100 mb-8">
            <form action="{{ route('admin.special-offers.index') }}" method="GET" class="flex flex-col md:flex-row gap-4">
                <div class="flex-1 relative group">
                    <div class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-400 group-focus-within:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari penawaran..." 
                           class="w-full pl-12 pr-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all outline-none font-medium">
                </div>
                <div class="md:w-48">
                    <select name="status" class="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all outline-none font-bold text-gray-700">
                        <option value="">Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Nonaktif</option>
                    </select>
                </div>
                <div class="md:w-48">
                    <select name="featured" class="w-full px-5 py-3 bg-gray-50 border-none rounded-2xl focus:ring-2 focus:ring-indigo-500/20 focus:bg-white transition-all outline-none font-bold text-gray-700">
                        <option value="">Jenis</option>
                        <option value="1" {{ request('featured') == '1' ? 'selected' : '' }}>Unggulan</option>
                        <option value="0" {{ request('featured') == '0' ? 'selected' : '' }}>Reguler</option>
                    </select>
                </div>
                <button type="submit" class="bg-gray-900 text-white px-8 py-3 rounded-2xl font-bold hover:bg-black transition-all">Filter</button>
                @if(request()->anyFilled(['search', 'status', 'featured']))
                    <a href="{{ route('admin.special-offers.index') }}" class="flex items-center justify-center p-3 text-gray-400 hover:text-rose-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </a>
                @endif
            </form>
        </div>

        <!-- Data Table -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Info Penawaran</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Tipe & Diskon</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">Masa Berlaku</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-center">Status</th>
                            <th class="px-8 py-6 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($specialOffers as $item)
                        <tr class="group hover:bg-indigo-50/30 transition-colors duration-300">
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="relative w-16 h-16 rounded-2xl overflow-hidden border-2 border-white shadow-sm flex-shrink-0">
                                        @if($item->main_image)
                                            <img src="{{ asset('storage/' . $item->main_image) }}" alt="{{ $item->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-indigo-50 flex items-center justify-center text-indigo-300 text-[10px] font-bold">
                                                N/A
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.special-offers.show', $item) }}" class="text-sm font-bold text-gray-900 hover:text-indigo-600 transition-colors block mb-1">
                                            {{ $item->title }}
                                        </a>
                                        <div class="flex items-center gap-2 text-[10px] text-gray-400 font-bold uppercase tracking-wider">
                                            @if($item->is_featured)
                                                <span class="text-amber-500 flex items-center gap-1">
                                                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                                    Unggulan
                                                </span>
                                            @else
                                                Reguler
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="space-y-1">
                                    <div class="inline-flex items-center gap-1 px-2.5 py-1 rounded-lg bg-emerald-50 text-emerald-600 text-[10px] font-black">
                                        {{ $item->discount_percentage }}% OFF
                                    </div>
                                    <p class="text-xs font-bold text-gray-500 lowercase tracking-tight">
                                        {{ $item->layanan_id ? 'Paket Layanan' : 'Promosi Mandiri' }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-sm">
                                <div class="flex flex-col">
                                    <span class="font-bold text-gray-900">{{ $item->valid_from ? $item->valid_from->format('d M Y') : 'N/A' }}</span>
                                    <span class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mt-1">Hingga {{ $item->valid_until ? $item->valid_until->format('d M Y') : 'N/A' }}</span>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                @if($item->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-emerald-50 text-emerald-600 text-[10px] font-black uppercase tracking-widest">
                                        <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full bg-gray-50 text-gray-400 text-[10px] font-black uppercase tracking-widest">
                                        Nonaktif
                                    </span>
                                @endif
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2 transition-opacity duration-300">
                                    <a href="{{ route('admin.special-offers.show', $item) }}" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-indigo-50 hover:text-indigo-600 rounded-xl transition-all duration-300 shadow-sm" title="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.special-offers.edit', $item) }}" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-amber-50 hover:text-amber-600 rounded-xl transition-all duration-300 shadow-sm" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00 2 2h11a2 2 0 00 2-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.special-offers.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Hapus penawaran ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-rose-50 hover:text-rose-600 rounded-xl transition-all duration-300 shadow-sm" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-20 h-20 bg-gray-50 rounded-[2rem] flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 01-2 2H6a2 2 0 01-2-2m16 0l-8 8-8-8"/></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Penawaran</h3>
                                    <p class="text-sm text-gray-500 max-w-xs mx-auto">Mulai buat kampanye promosi menarik untuk menarik lebih banyak pelanggan.</p>
                                    <a href="{{ route('admin.special-offers.create') }}" class="mt-6 inline-flex items-center gap-2 bg-indigo-600 text-white px-6 py-3 rounded-2xl font-bold shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all">
                                        Buat Penawaran Pertama
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination -->
            @if($specialOffers->hasPages())
            <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100">
                {{ $specialOffers->appends(request()->query())->links() }}
            </div>
            @endif
        </div>
    </div>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        .pagination {
            display: flex;
            gap: 0.5rem;
            align-items: center;
        }

        .pagination > * {
            height: 2.5rem;
            min-width: 2.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.75rem;
            font-weight: 700;
            font-size: 0.875rem;
            transition: all 0.2s;
            background: white;
            border: 1px solid #f1f5f9;
            color: #64748b;
        }

        .pagination > .active {
            background: #4f46e5;
            border-color: #4f46e5;
            color: white;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }

        .pagination > a:hover {
            border-color: #4f46e5;
            color: #4f46e5;
            background: #f8fafc;
        }
    </style>
@endsection