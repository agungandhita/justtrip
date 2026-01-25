@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-12 antialiased text-gray-900 px-4 md:px-8">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight">Halo, Admin JustTrip 👋</h1>
                <p class="text-gray-500 font-medium mt-1">Status bisnis Anda terpantau aman hari ini.</p>
            </div>
            <div class="flex items-center gap-3 bg-white px-5 py-3 rounded-2xl shadow-sm border border-gray-100">
                <div class="flex -space-x-2">
                    @foreach($topServices->take(3) as $service)
                        <div class="w-8 h-8 rounded-full border-2 border-white overflow-hidden bg-gray-100">
                            @if($service->gambar_utama)
                                <img src="{{ asset('storage/' . $service->gambar_utama) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-[10px] font-bold text-gray-400">JT</div>
                            @endif
                        </div>
                    @endforeach
                </div>
                <div class="text-xs font-bold text-gray-400 uppercase tracking-widest pl-2 border-l border-gray-100">
                    {{ $layananAktif }} Layanan Aktif
                </div>
            </div>
        </div>

        <!-- Main KPI Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Revenue Card -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-indigo-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-100 mb-6 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Pendapatan Bulan Ini</p>
                    <h3 class="text-2xl font-black text-gray-900 leading-none">Rp {{ number_format($pendapatanBulanIni, 0, ',', '.') }}</h3>
                    <div class="mt-4 flex items-center gap-2">
                        @if($perubahanPendapatan >= 0)
                            <span class="flex items-center gap-1 text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 10l7-7m0 0l7 7m-7-7v18"/></svg>
                                {{ $perubahanPendapatan }}%
                            </span>
                        @else
                            <span class="flex items-center gap-1 text-[10px] font-black text-rose-600 bg-rose-50 px-2 py-1 rounded-lg">
                                <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"/></svg>
                                {{ abs($perubahanPendapatan) }}%
                            </span>
                        @endif
                        <span class="text-[10px] text-gray-400 font-bold">vs bulan lalu</span>
                    </div>
                </div>
            </div>

            <!-- Booking Card -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-amber-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-amber-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-amber-100 mb-6 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Pemesanan Bulan Ini</p>
                    <h3 class="text-2xl font-black text-gray-900 leading-none">{{ $totalBookings }} Pesanan</h3>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="flex items-center gap-1 text-[10px] font-black text-amber-600 bg-amber-50 px-2 py-1 rounded-lg">
                            {{ $pendingBookings }} Baru
                        </span>
                        <span class="text-[10px] text-gray-400 font-bold">perlu diproses</span>
                    </div>
                </div>
            </div>

            <!-- User Card -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-emerald-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-100 mb-6 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Total Pelanggan</p>
                    <h3 class="text-2xl font-black text-gray-900 leading-none">{{ $totalUsers }} User</h3>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="flex items-center gap-1 text-[10px] font-black text-emerald-600 bg-emerald-50 px-2 py-1 rounded-lg">
                            +{{ $newUsersThisMonth }} Baru
                        </span>
                        <span class="text-[10px] text-gray-400 font-bold">minggu ini</span>
                    </div>
                </div>
            </div>

            <!-- Views/Metric Card -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-rose-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-rose-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-rose-100 mb-6 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Total Kunjungan</p>
                    <h3 class="text-2xl font-black text-gray-900 leading-none">{{ number_format($totalViews, 0, ',', '.') }}</h3>
                    <div class="mt-4 flex items-center gap-2">
                        <span class="flex items-center gap-1 text-[10px] font-black text-rose-600 bg-rose-50 px-2 py-1 rounded-lg">
                            {{ $conversionRate }}% Rate
                        </span>
                        <span class="text-[10px] text-gray-400 font-bold">Destinasi</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions Grid -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 mb-10 overflow-hidden relative">
            <div class="absolute right-0 top-0 opacity-5 pointer-events-none">
                <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M13,9V3.5L18.5,9M6,2C4.89,2 4,2.89 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2H6Z" /></svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                Manajemen Cepat
            </h2>
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                <a href="{{ route('admin.layanan.create') }}" class="flex flex-col items-center gap-4 p-6 rounded-3xl hover:bg-gray-50 transition-all group border border-transparent hover:border-gray-100">
                    <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center group-hover:shadow-lg group-hover:shadow-indigo-100 transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-600 uppercase tracking-tight group-hover:text-indigo-600 transition-colors">Tambah Layanan</span>
                </a>
                <a href="{{ route('admin.special-offers.create') }}" class="flex flex-col items-center gap-4 p-6 rounded-3xl hover:bg-gray-50 transition-all group border border-transparent hover:border-gray-100">
                    <div class="w-14 h-14 bg-amber-50 text-amber-600 rounded-2xl flex items-center justify-center group-hover:shadow-lg group-hover:shadow-amber-100 transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-600 uppercase tracking-tight group-hover:text-amber-600 transition-colors">Buat Promo</span>
                </a>
                <a href="{{ route('admin.special-offers.index') }}" class="flex flex-col items-center gap-4 p-6 rounded-3xl hover:bg-gray-50 transition-all group border border-transparent hover:border-gray-100">
                    <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center group-hover:shadow-lg group-hover:shadow-emerald-100 transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"/></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-600 uppercase tracking-tight group-hover:text-emerald-600 transition-colors">Kelola Pesanan</span>
                </a>
                <a href="{{ route('admin.news.index') }}" class="flex flex-col items-center gap-4 p-6 rounded-3xl hover:bg-gray-50 transition-all group border border-transparent hover:border-gray-100">
                    <div class="w-14 h-14 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center group-hover:shadow-lg group-hover:shadow-blue-100 transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10l4 4v10a2 2 0 01-2 2zM14 2v4h4"/></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-600 uppercase tracking-tight group-hover:text-blue-600 transition-colors">Tulis Berita</span>
                </a>
                <a href="{{ route('admin.galleries.index') }}" class="flex flex-col items-center gap-4 p-6 rounded-3xl hover:bg-gray-50 transition-all group border border-transparent hover:border-gray-100">
                    <div class="w-14 h-14 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center group-hover:shadow-lg group-hover:shadow-rose-100 transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-600 uppercase tracking-tight group-hover:text-rose-600 transition-colors">Update Galeri</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="flex flex-col items-center gap-4 p-6 rounded-3xl hover:bg-gray-50 transition-all group border border-transparent hover:border-gray-100">
                    <div class="w-14 h-14 bg-slate-50 text-slate-600 rounded-2xl flex items-center justify-center group-hover:shadow-lg group-hover:shadow-slate-100 transition-all">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"/></svg>
                    </div>
                    <span class="text-xs font-bold text-gray-600 uppercase tracking-tight group-hover:text-slate-600 transition-colors">Kelola User</span>
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
            <!-- Recent Bookings Table -->
            <div class="lg:col-span-8">
                <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="p-8 border-b border-gray-50 flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                            <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            Pesanan Terbaru
                        </h2>
                        <a href="{{ route('admin.special-offers.index') }}" class="text-xs font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700 transition-colors">Lihat Semua</a>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="bg-gray-50/50">
                                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Order ID</th>
                                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Customer</th>
                                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Layanan</th>
                                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 font-mono">Total</th>
                                    <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-50">
                                @forelse($recentBookings as $booking)
                                <tr class="group hover:bg-gray-50/50 transition-colors">
                                    <td class="px-8 py-6">
                                        <span class="text-xs font-black text-gray-900">#{{ $booking->booking_number }}</span>
                                        <p class="text-[9px] text-gray-400 font-bold uppercase mt-1">{{ $booking->created_at->format('d M, H:i') }}</p>
                                    </td>
                                    <td class="px-8 py-6">
                                        <div class="flex items-center gap-3">
                                            <div class="w-8 h-8 rounded-full bg-indigo-50 flex items-center justify-center text-[10px] font-black text-indigo-600 uppercase">
                                                {{ substr($booking->user->name ?? 'G', 0, 2) }}
                                            </div>
                                            <div>
                                                <p class="text-xs font-bold text-gray-900 leading-none">{{ $booking->user->name ?? 'Guest' }}</p>
                                                <p class="text-[10px] text-gray-400 font-medium mt-1">{{ $booking->user->email ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="text-xs font-bold text-gray-600 truncate max-w-[150px] inline-block">{{ $booking->layanan->nama_layanan ?? 'N/A' }}</span>
                                    </td>
                                    <td class="px-8 py-6">
                                        <span class="text-xs font-black text-indigo-700">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</span>
                                    </td>
                                    <td class="px-8 py-6 text-center">
                                        <span class="px-3 py-1.5 rounded-full text-[9px] font-black uppercase tracking-wider
                                            @if($booking->status == 'pending') bg-amber-50 text-amber-600
                                            @elseif($booking->status == 'completed' || $booking->status == 'confirmed') bg-emerald-50 text-emerald-600
                                            @elseif($booking->status == 'cancelled' || $booking->status == 'rejected') bg-rose-50 text-rose-600
                                            @else bg-gray-50 text-gray-600 @endif">
                                            {{ $booking->status }}
                                        </span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="px-8 py-20 text-center">
                                        <div class="flex flex-col items-center">
                                            <svg class="w-12 h-12 text-gray-200 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                            <p class="text-sm font-bold text-gray-400">Belum ada pesanan terbaru.</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Top Services List -->
            <div class="lg:col-span-4">
                <div class="bg-indigo-900 rounded-[2.5rem] shadow-xl p-8 text-white h-full relative overflow-hidden">
                    <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-3xl"></div>
                    <div class="relative z-10">
                        <h2 class="text-xl font-bold mb-8 flex items-center justify-between">
                            Layanan Terpopuler
                            <svg class="w-6 h-6 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                        </h2>
                        <div class="space-y-6">
                            @forelse($topServices as $service)
                            <div class="flex items-center gap-4 group cursor-pointer">
                                <div class="w-14 h-14 rounded-2xl overflow-hidden border-2 border-white/20 shadow-lg flex-shrink-0 group-hover:scale-110 transition-transform duration-300">
                                    @if($service->gambar_utama)
                                        <img src="{{ asset('storage/' . $service->gambar_utama) }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-white/10 flex items-center justify-center text-xs font-black">JT</div>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <h3 class="text-sm font-bold group-hover:text-amber-400 transition-colors">{{ $service->nama_layanan }}</h3>
                                    <div class="flex items-center justify-between mt-1">
                                        <span class="text-[10px] font-black text-white/50 uppercase tracking-widest">{{ $service->lokasi_tujuan }}</span>
                                        <span class="text-[11px] font-black text-amber-400">{{ $service->bookings_count }} Pesanan</span>
                                    </div>
                                    <div class="w-full h-1 bg-white/10 rounded-full mt-2 overflow-hidden">
                                        <div class="h-full bg-amber-400 rounded-full" style="width: {{ min(100, ($service->bookings_count / ($totalBookings ?: 1)) * 300) }}%"></div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <p class="text-sm text-white/50 italic text-center py-10">Data layanan belum tersedia.</p>
                            @endforelse
                        </div>

                        <!-- System Health Footer -->
                        <div class="mt-12 pt-8 border-t border-white/10">
                            <div class="flex items-center gap-4">
                                <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl flex items-center justify-center animate-pulse">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                                </div>
                                <div>
                                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-white/50">Status Sistem</p>
                                    <p class="text-xs font-bold">{{ strtoupper($systemStatus) }} - Berjalan Normal</p>
                                </div>
                            </div>
                        </div>
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

        /* Subtle scrollbar for table x-overflow */
        .overflow-x-auto::-webkit-scrollbar {
            height: 4px;
        }
        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
    </style>
@endsection
