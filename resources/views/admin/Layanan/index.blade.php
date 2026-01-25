@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10 antialiased text-gray-900 px-4 md:px-8">
        <!-- Header Section -->
        <div class="mb-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight mb-2">Manajemen Layanan</h1>
                    <p class="text-gray-500 font-medium">Kelola seluruh paket perjalanan dan layanan travel JustTrip.</p>
                </div>
                <a href="{{ route('admin.layanan.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-2xl font-bold transition-all duration-300 shadow-lg shadow-indigo-100 group">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M12 5v14M5 12h14"/></svg>
                    Tambah Layanan Baru
                </a>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 mb-8">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Total Layanan</p>
                    <p class="text-2xl font-black text-gray-900 leading-none">{{ $layanan->total() }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Layanan Aktif</p>
                    <p class="text-2xl font-black text-gray-900 leading-none">
                        {{ $layanan->filter(fn($item) => $item->status == 'aktif')->count() }}
                        <span class="text-xs font-medium text-gray-400">di halaman ini</span>
                    </p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Jenis Layanan</p>
                    <p class="text-2xl font-black text-gray-900 leading-none">{{ count($jenisLayananOptions) }}</p>
                </div>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex items-center gap-4">
                <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                </div>
                <div>
                    <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Avg. Harga Mulai</p>
                    <p class="text-2xl font-black text-gray-900 leading-none">
                        Rp {{ number_format($layanan->avg('harga_mulai') / 1000000, 1) }}jt
                    </p>
                </div>
            </div>
        </div>

        <!-- Search & Filters -->
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-8">
            <form action="{{ route('admin.layanan.index') }}" method="GET" class="space-y-4">
                <div class="flex flex-col lg:flex-row gap-4">
                    <div class="flex-1 relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        </div>
                        <input type="text" name="search" value="{{ request('search') }}" 
                               class="block w-full pl-11 pr-4 py-3 bg-gray-50 border border-gray-100 text-gray-900 text-sm rounded-2xl focus:ring-indigo-500 focus:border-indigo-500 transition-all outline-none" 
                               placeholder="Cari nama layanan, destinasi, atau deskripsi...">
                    </div>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:flex gap-4">
                        <select name="jenis_layanan" class="bg-gray-50 border border-gray-100 text-gray-900 text-sm rounded-2xl focus:ring-indigo-500 focus:border-indigo-500 block w-full lg:w-48 p-3 outline-none appearance-none">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisLayananOptions as $key => $label)
                                <option value="{{ $key }}" {{ request('jenis_layanan') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                        <select name="status" class="bg-gray-50 border border-gray-100 text-gray-900 text-sm rounded-2xl focus:ring-indigo-500 focus:border-indigo-500 block w-full lg:w-40 p-3 outline-none appearance-none">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                        <div class="flex gap-2">
                            <button type="submit" class="flex-1 lg:flex-none inline-flex items-center justify-center gap-2 bg-gray-900 hover:bg-black text-white px-6 py-3 rounded-2xl font-bold transition-all duration-300">
                                Filter
                            </button>
                            @if(request()->anyFilled(['search', 'jenis_layanan', 'status']))
                            <a href="{{ route('admin.layanan.index') }}" class="inline-flex items-center justify-center w-12 h-12 bg-rose-50 text-rose-600 hover:bg-rose-100 rounded-2xl transition-all duration-300" title="Reset Filter">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <!-- Services Table -->
        <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">INFO LAYANAN</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400">KATEGORI & DURASI</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">HARGA MULAI</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-center">STATUS</th>
                            <th class="px-6 py-5 text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 text-right">AKSI</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($layanan as $index => $item)
                        <tr class="group hover:bg-indigo-50/30 transition-colors duration-300">
                            <td class="px-6 py-6">
                                <div class="flex items-center gap-4">
                                    <div class="relative w-16 h-16 rounded-2xl overflow-hidden border-2 border-white shadow-sm flex-shrink-0">
                                        @if($item->gambar_utama)
                                            <img src="{{ asset('storage/' . $item->gambar_utama) }}" alt="{{ $item->nama_layanan }}" class="w-full h-full object-cover">
                                        @elseif($item->gambar_destinasi && count($item->gambar_destinasi) > 0)
                                            <img src="{{ asset('storage/' . $item->gambar_destinasi[0]) }}" alt="{{ $item->nama_layanan }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-indigo-50 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-indigo-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                            </div>
                                        @endif
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.layanan.show', $item) }}" class="text-sm font-bold text-gray-900 hover:text-indigo-600 transition-colors block mb-1">
                                            {{ $item->nama_layanan }}
                                        </a>
                                        <div class="flex items-center gap-2 text-[11px] text-gray-400 font-bold uppercase tracking-wider">
                                            <svg class="w-3 h-3 text-amber-500" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>
                                            {{ $item->lokasi_tujuan }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6">
                                <div class="flex flex-col gap-2">
                                    <span class="inline-flex w-fit px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-wider rounded-full border border-blue-100">
                                        {{ $item->jenis_layanan_label }}
                                    </span>
                                    <div class="flex items-center gap-3 text-gray-500 font-medium text-xs">
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                            {{ $item->durasi_format }}
                                        </span>
                                        <span class="w-1 h-1 bg-gray-300 rounded-full"></span>
                                        <span class="flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                                            {{ $item->maks_orang }} Pax
                                        </span>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-6 text-right font-mono tracking-tight font-black text-indigo-700">
                                {{ $item->harga_format }}
                            </td>
                            <td class="px-6 py-6 text-center">
                                <span class="px-3 py-1.5 rounded-xl text-[10px] font-black uppercase tracking-wider border {{ $item->status == 'aktif' ? 'bg-emerald-50 text-emerald-600 border-emerald-100' : 'bg-rose-50 text-rose-600 border-rose-100' }}">
                                    {{ $item->status }}
                                </span>
                            </td>
                            <td class="px-6 py-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.layanan.show', $item) }}" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-blue-50 hover:text-blue-600 rounded-xl transition-all duration-300" title="Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    <a href="{{ route('admin.layanan.edit', $item) }}" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-amber-50 hover:text-amber-600 rounded-xl transition-all duration-300" title="Edit">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 00 2 2h11a2 2 0 00 2-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                                    </a>
                                    <form action="{{ route('admin.layanan.destroy', $item) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-10 h-10 flex items-center justify-center bg-gray-50 text-gray-400 hover:bg-rose-50 hover:text-rose-600 rounded-xl transition-all duration-300" title="Hapus">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="px-6 py-24 text-center">
                                <div class="flex flex-col items-center justify-center">
                                    <div class="w-20 h-20 bg-gray-50 text-gray-200 rounded-full flex items-center justify-center mb-4">
                                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0a2 2 0 012 2v4a2 2 0 01-2 2H6a2 2 0 01-2-2v-4a2 2 0 012-2m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"/></svg>
                                    </div>
                                    <h3 class="text-lg font-bold text-gray-900 mb-1">Tidak ada layanan ditemukan</h3>
                                    <p class="text-gray-400 text-sm max-w-xs mx-auto font-medium">Coba sesuaikan kata kunci pencarian atau filter Anda untuk menemukan hasil lain.</p>
                                    <a href="{{ route('admin.layanan.index') }}" class="mt-6 text-sm font-bold text-indigo-600 hover:text-indigo-700 underline underline-offset-4">Reset Semua Filter</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($layanan->hasPages())
            <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-50">
                {{ $layanan->appends(request()->query())->links() }}
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

        /* Custom Pagination Styling */
        .pagination {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
        }
        .page-item .page-link {
            border-radius: 0.75rem;
            border: 1px solid #f1f5f9;
            color: #64748b;
            padding: 0.5rem 1rem;
            font-weight: 700;
            transition: all 0.3s ease;
        }
        .page-item.active .page-link {
            background-color: #4f46e5;
            border-color: #4f46e5;
            color: white;
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.2);
        }
        .page-link:hover {
            background-color: #f8fafc;
            color: #4f46e5;
        }
    </style>
@endsection
