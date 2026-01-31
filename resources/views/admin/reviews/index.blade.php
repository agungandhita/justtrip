@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header Section -->
        <div class="mb-8 px-4">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <div class="p-3 bg-teal-100 rounded-2xl">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-teal-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,17.27L18.18,21L16.54,13.97L22,9.24L14.81,8.62L12,2L9.19,8.62L2,9.24L7.45,13.97L5.82,21L12,17.27Z"/>
                            </svg>
                        </div>
                        <div>
                            <h1 class="text-3xl font-black text-gray-800 tracking-tight">Ulasan Pelanggan</h1>
                            <p class="text-gray-500 font-medium">Kelola testimoni perjalanan untuk membangun kepercayaan pelanggan</p>
                        </div>
                    </div>
                </div>
                <a href="{{ route('admin.reviews.create') }}" class="inline-flex items-center justify-center gap-2 bg-gradient-to-r from-teal-600 to-teal-500 hover:from-teal-700 hover:to-teal-600 text-white px-6 py-3.5 rounded-2xl font-bold shadow-lg shadow-teal-200 transition-all duration-300 transform hover:scale-[1.02] active:scale-95">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                        <line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line>
                    </svg>
                    Tambah Review Baru
                </a>
            </div>
        </div>

        <!-- Stats Overview -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 px-4 mb-8">
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-1">Total Ulasan</p>
                <h3 class="text-3xl font-black text-gray-800">{{ $reviews->total() }}</h3>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-1">Rating Rata-rata</p>
                <h3 class="text-3xl font-black text-teal-600">4.9 <span class="text-sm font-normal text-gray-400">/ 5.0</span></h3>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-1">Status Aktif</p>
                <h3 class="text-3xl font-black text-green-600">{{ $reviews->where('is_active', true)->count() }}</h3>
            </div>
            <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100">
                <p class="text-gray-500 text-sm font-bold uppercase tracking-wider mb-1">Perlu Moderasi</p>
                <h3 class="text-3xl font-black text-orange-500">{{ $reviews->where('is_active', false)->count() }}</h3>
            </div>
        </div>

        <!-- Filters Section -->
        <div class="px-4 mb-6">
            <div class="bg-white/70 backdrop-blur-md rounded-3xl shadow-sm border border-gray-100 p-6">
                <form action="{{ route('admin.reviews.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-12 gap-4">
                    <div class="md:col-span-12 lg:col-span-5">
                        <label for="search" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Pencarian Cepat</label>
                        <div class="relative group">
                            <input type="text" id="search" name="search" value="{{ request('search') }}" placeholder="Cari nama pelanggan, destinasi, atau isi ulasan..." class="w-full bg-gray-50 border-gray-100 rounded-2xl py-3 pl-12 pr-4 text-gray-700 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 focus:bg-white transition-all duration-300">
                            <div class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 group-focus-within:text-teal-500 transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="md:col-span-6 lg:col-span-3">
                        <label for="status" class="block text-xs font-black text-gray-400 uppercase tracking-widest mb-2 ml-1">Filter Status</label>
                        <select id="status" name="status" class="w-full bg-gray-50 border-gray-100 rounded-2xl py-3 px-4 text-gray-700 focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 focus:bg-white transition-all duration-300 appearance-none">
                            <option value="">Semua Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>✓ Aktif</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>○ Nonaktif</option>
                        </select>
                    </div>
                    <div class="md:col-span-6 lg:col-span-4 flex items-end gap-3">
                        <button type="submit" class="flex-1 bg-gray-800 hover:bg-gray-900 text-white font-bold py-3 px-6 rounded-2xl transition-all duration-300 shadow-md">
                            Terapkan Filter
                        </button>
                        <a href="{{ route('admin.reviews.index') }}" class="bg-white border border-gray-200 hover:bg-gray-50 text-gray-600 font-bold py-3 px-4 rounded-2xl transition-all duration-300" title="Reset Filter">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                            </svg>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Table Card -->
        <div class="px-4">
            <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-gray-50/50">
                                <th class="px-8 py-5 text-xs font-black text-gray-400 uppercase tracking-widest">Customer</th>
                                <th class="px-6 py-5 text-xs font-black text-gray-400 uppercase tracking-widest">Detail Perjalanan</th>
                                <th class="px-6 py-5 text-xs font-black text-gray-400 uppercase tracking-widest text-center">Status</th>
                                <th class="px-6 py-5 text-xs font-black text-gray-400 uppercase tracking-widest text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-50">
                            @forelse($reviews as $review)
                                <tr class="hover:bg-teal-50/20 transition-colors group">
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-4">
                                            <div class="relative">
                                                <img src="{{ $review->avatar_url }}" alt="{{ $review->customer_name }}" class="w-14 h-14 rounded-2xl object-cover ring-2 ring-white shadow-md">
                                                <div class="absolute -bottom-1 -right-1 w-6 h-6 bg-white rounded-full flex items-center justify-center shadow-sm">
                                                    <span class="text-[10px] font-black text-teal-600">{{ $review->rating }}★</span>
                                                </div>
                                            </div>
                                            <div>
                                                <div class="text-base font-black text-gray-800">{{ $review->customer_name }}</div>
                                                <div class="text-xs font-bold text-gray-400 uppercase">{{ $review->customer_position ?? 'Pelanggan Setia' }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6">
                                        <div class="flex flex-col gap-1">
                                            <div class="flex items-center gap-2 text-sm font-bold text-gray-700">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-orange-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                                {{ $review->destination }}
                                            </div>
                                            <div class="text-sm text-gray-500 line-clamp-1 italic">
                                                "{{ Str::limit($review->content, 60) }}"
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-6 text-center">
                                        <form action="{{ route('admin.reviews.toggle-active', $review->id) }}" method="POST" class="inline">
                                            @csrf
                                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full text-xs font-black transition-all duration-300 {{ $review->is_active ? 'bg-green-100 text-green-700 hover:bg-green-200' : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}">
                                                <span class="w-1.5 h-1.5 rounded-full {{ $review->is_active ? 'bg-green-500 animate-pulse' : 'bg-gray-400' }}"></span>
                                                {{ $review->is_active ? 'PUBLISHED' : 'DRAFT' }}
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-8 py-6 text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <a href="{{ route('admin.reviews.show', $review->id) }}" class="p-2 bg-blue-50 text-blue-600 rounded-xl hover:bg-blue-600 hover:text-white transition-all duration-300" title="Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.reviews.edit', $review->id) }}" class="p-2 bg-yellow-50 text-yellow-600 rounded-xl hover:bg-yellow-500 hover:text-white transition-all duration-300" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" class="inline" onsubmit="return confirm('Hapus ulasan ini secara permanen?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-50 text-red-500 rounded-xl hover:bg-red-500 hover:text-white transition-all duration-300" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center justify-center">
                                            <div class="w-20 h-20 bg-gray-50 rounded-full flex items-center justify-center mb-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                                                </svg>
                                            </div>
                                            <h3 class="text-xl font-black text-gray-800 mb-2">Belum Ada Ulasan</h3>
                                            <p class="text-gray-500 max-w-xs mx-auto mb-6">Database ulasan masih kosong. Mulai tambahkan testimoni dari pelanggan perjalanan Anda.</p>
                                            <a href="{{ route('admin.reviews.create') }}" class="bg-teal-600 text-white font-bold py-3 px-8 rounded-2xl shadow-lg shadow-teal-100 transition-all">
                                                Tambah Ulasan Pertama
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <!-- Pagination Section -->
                @if($reviews->hasPages())
                    <div class="bg-gray-50/50 px-8 py-6 border-t border-gray-100">
                        {{ $reviews->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
