@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-12 antialiased text-gray-900 px-4 md:px-8">
        <!-- Header Section -->
        <div class="mb-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
                    <div class="w-2 h-10 bg-indigo-600 rounded-full"></div>
                    Manajemen Booking
                </h1>
                <p class="text-gray-500 font-medium mt-1 ml-5">Kelola dan pantau seluruh transaksi pemesanan layanan JustTrip.</p>
            </div>
            <div class="flex items-center gap-4 bg-white px-6 py-3 rounded-2xl shadow-sm border border-gray-100">
                <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                </div>
                <div>
                    <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 leading-none">Total Booking</p>
                    <p class="text-lg font-bold text-gray-900">{{ number_format($statistics['total']) }} Pesanan</p>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <!-- Total Card -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-blue-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-blue-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-blue-100 mb-6 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M19,3H18V1H16V3H8V1H6V3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M19,19H5V8H19V19Z"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Total Booking</p>
                    <h3 class="text-3xl font-black text-gray-900 leading-none">{{ number_format($statistics['total']) }}</h3>
                    <p class="mt-4 text-[10px] text-gray-400 font-bold uppercase tracking-wider">Keseluruhan Data</p>
                </div>
            </div>

            <!-- Pending Card -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-amber-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-amber-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-amber-100 mb-6 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,8V12L14.5,14.5L13.08,15.92L10,12.83V8H12Z"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Menunggu Konfirmasi</p>
                    <h3 class="text-3xl font-black text-amber-600 leading-none">{{ number_format($statistics['pending']) }}</h3>
                    <p class="mt-4 text-[10px] text-amber-600 font-bold uppercase tracking-wider">Perlu Diproses Segera</p>
                </div>
            </div>

            <!-- Confirmed Card -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-emerald-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-emerald-500 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-100 mb-6 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24"><path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Booking Dikonfirmasi</p>
                    <h3 class="text-3xl font-black text-emerald-600 leading-none">{{ number_format($statistics['confirmed']) }}</h3>
                    <p class="mt-4 text-[10px] text-emerald-600 font-bold uppercase tracking-wider">Berhasil Disetujui</p>
                </div>
            </div>

            <!-- Revenue Card -->
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 relative overflow-hidden group hover:shadow-xl transition-all duration-500">
                <div class="absolute -right-6 -top-6 w-32 h-32 bg-indigo-50 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 bg-indigo-600 text-white rounded-2xl flex items-center justify-center shadow-lg shadow-indigo-100 mb-6 group-hover:rotate-12 transition-transform">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1"/></svg>
                    </div>
                    <p class="text-[10px] font-black uppercase tracking-[0.2em] text-gray-400 mb-1">Estimasi Pendapatan</p>
                    <h3 class="text-2xl font-black text-indigo-600 leading-none">Rp {{ number_format($statistics['total_revenue'], 0, ',', '.') }}</h3>
                    <p class="mt-4 text-[10px] text-indigo-400 font-bold uppercase tracking-wider">Total Nilai Transaksi</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-gray-100 mb-10 overflow-hidden relative">
            <div class="absolute right-0 top-0 opacity-5 pointer-events-none">
                <svg class="w-64 h-64 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M14,12L10,8V11H2V13H10V16L14,12Z M22,12L18,16V13H11V11H18V8L22,12Z"/></svg>
            </div>
            <h2 class="text-xl font-bold text-gray-900 mb-8 flex items-center gap-3">
                <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                Filter Pencarian
            </h2>
            
            <form method="GET" action="{{ route('admin.bookings.index') }}" class="relative z-10 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label for="search" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Cari Data</label>
                    <div class="relative">
                        <input type="text" id="search" name="search" value="{{ request('search') }}"
                               placeholder="Order ID atau Nama..."
                               class="w-full pl-12 pr-4 py-3.5 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 transition-all text-sm font-medium">
                        <svg class="w-5 h-5 text-gray-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                    </div>
                </div>
                
                <div>
                    <label for="status" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Status</label>
                    <select id="status" name="status"
                            class="w-full px-4 py-3.5 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 transition-all text-sm font-medium appearance-none">
                        <option value="">Semua Status</option>
                        @foreach($statusOptions as $value => $label)
                            <option value="{{ $value }}" {{ request('status') == $value ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="layanan_id" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2 ml-1">Layanan</label>
                    <select id="layanan_id" name="layanan_id"
                            class="w-full px-4 py-3.5 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-2 focus:ring-indigo-100 focus:border-indigo-400 transition-all text-sm font-medium appearance-none">
                        <option value="">Semua Layanan</option>
                        @foreach($layananOptions as $layanan)
                            <option value="{{ $layanan->layanan_id }}" {{ request('layanan_id') == $layanan->layanan_id ? 'selected' : '' }}>{{ $layanan->nama_layanan }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="flex items-end gap-3">
                    <button type="submit" class="flex-1 bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3.5 rounded-2xl transition-all shadow-lg shadow-indigo-100 flex items-center justify-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                        Terapkan
                    </button>
                    @if(request()->hasAny(['search', 'status', 'layanan_id']))
                        <a href="{{ route('admin.bookings.index') }}" class="px-5 py-3.5 bg-gray-100 hover:bg-gray-200 text-gray-600 font-bold rounded-2xl transition-all flex items-center justify-center">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/></svg>
                        </a>
                    @endif
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-[2.5rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="p-8 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
                <h2 class="text-xl font-bold text-gray-900 flex items-center gap-3">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                    Daftar Transaksi
                </h2>
                <span class="text-[10px] font-black text-gray-400 uppercase tracking-widest bg-white px-4 py-2 rounded-full border border-gray-100">
                    {{ $bookings->total() }} Total Entri
                </span>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50">
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Order ID</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Customer</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400">Layanan & Tujuan</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">Peserta</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 font-mono">Total Transaksi</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-center">Status</th>
                            <th class="px-8 py-5 text-[10px] font-black uppercase tracking-widest text-gray-400 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($bookings as $booking)
                        <tr class="group hover:bg-gray-50/50 transition-colors">
                            <td class="px-8 py-6">
                                <span class="text-xs font-black text-gray-900 group-hover:text-indigo-600 transition-colors">#{{ $booking->booking_number }}</span>
                                <p class="text-[9px] text-gray-400 font-bold uppercase mt-1">{{ $booking->created_at->format('d M Y, H:i') }}</p>
                            </td>
                            <td class="px-8 py-6">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-2xl bg-indigo-50 flex flex-col items-center justify-center text-[11px] font-black text-indigo-600 uppercase border border-indigo-100 transition-transform group-hover:scale-110">
                                        {{ substr($booking->user->name ?? $booking->customer_info['name'] ?? 'G', 0, 2) }}
                                    </div>
                                    <div>
                                        <div class="flex items-center gap-2">
                                            <p class="text-xs font-bold text-gray-900 tracking-tight">{{ $booking->user->name ?? $booking->customer_info['name'] ?? 'Guest' }}</p>
                                            @if($booking->user)
                                                <span class="text-[8px] font-black bg-blue-50 text-blue-500 px-1.5 py-0.5 rounded uppercase tracking-tighter">Member</span>
                                            @else
                                                <span class="text-[8px] font-black bg-amber-50 text-amber-500 px-1.5 py-0.5 rounded uppercase tracking-tighter">Guest</span>
                                            @endif
                                        </div>
                                        <p class="text-[10px] text-gray-400 font-medium mt-0.5">{{ $booking->user->email ?? $booking->customer_info['email'] ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-8 py-6">
                                <div class="max-w-[200px]">
                                    <p class="text-xs font-bold text-gray-700 truncate capitalize">{{ $booking->layanan->nama_layanan ?? $booking->custom_booking_info['destination'] ?? 'Custom Trip' }}</p>
                                    <p class="text-[10px] text-indigo-400 font-bold uppercase tracking-wider mt-0.5 flex items-center gap-1">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>
                                        {{ $booking->layanan->lokasi ?? $booking->custom_booking_info['destination'] ?? 'Custom' }}
                                    </p>
                                </div>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-gray-100 text-[11px] font-black text-gray-600">
                                    {{ $booking->jumlah_peserta }}
                                </span>
                            </td>
                            <td class="px-8 py-6">
                                <span class="text-xs font-black text-indigo-700 tracking-tight">{{ $booking->formatted_total_amount }}</span>
                                <p class="text-[9px] text-gray-400 font-bold mt-0.5">Sudah Termasuk Pajak</p>
                            </td>
                            <td class="px-8 py-6 text-center">
                                <span class="px-4 py-1.5 rounded-full text-[9px] font-black uppercase tracking-widest border shadow-sm
                                    @if($booking->status == 'pending') bg-amber-50 text-amber-600 border-amber-100
                                    @elseif($booking->status == 'confirmed') bg-emerald-50 text-emerald-600 border-emerald-100
                                    @elseif($booking->status == 'completed') bg-blue-50 text-blue-600 border-blue-100
                                    @elseif($booking->status == 'cancelled' || $booking->status == 'rejected') bg-rose-50 text-rose-600 border-rose-100
                                    @else bg-gray-50 text-gray-600 border-gray-200 @endif animate-pulse-slow">
                                    {{ $booking->status_label }}
                                </span>
                            </td>
                            <td class="px-8 py-6 text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.bookings.show', $booking) }}" 
                                       class="p-2 text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all" title="Lihat Detail">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/><path d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/></svg>
                                    </a>
                                    
                                    @if($booking->status === 'pending')
                                    <button type="button" onclick="confirmBooking({{ $booking->booking_id }})" 
                                            class="p-2 text-emerald-600 hover:bg-emerald-50 rounded-xl transition-all" title="Konfirmasi">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                    </button>
                                    @endif

                                    @if(in_array($booking->status, ['pending', 'confirmed']))
                                    <button type="button" onclick="rejectBooking({{ $booking->booking_id }})" 
                                            class="p-2 text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Tolak">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                                    </button>
                                    @endif

                                    @if($booking->status === 'confirmed')
                                    <button type="button" onclick="completeBooking({{ $booking->booking_id }})" 
                                            class="p-2 text-blue-600 hover:bg-blue-50 rounded-xl transition-all" title="Selesaikan">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    </button>
                                    @endif

                                    @if(isset($booking->customer_info['phone']))
                                    <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->customer_info['phone']) }}" 
                                       target="_blank" 
                                       class="p-2 text-emerald-500 hover:bg-emerald-50 rounded-xl transition-all" title="WhatsApp Customer">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M12.04 2c-5.46 0-9.91 4.45-9.91 9.91 0 1.75.46 3.45 1.32 4.95L2.05 22l5.25-1.38c1.45.79 3.08 1.21 4.74 1.21 5.46 0 9.91-4.45 9.91-9.91 0-2.65-1.03-5.14-2.9-7.01A9.817 9.817 0 0 0 12.04 2zM12.04 20.13c-1.55 0-3.07-.42-4.39-1.21l-.31-.19L4.22 19.54l.82-2.99-.21-.33c-.87-1.38-1.33-2.98-1.33-4.63 0-4.75 3.86-8.61 8.61-8.61 2.31 0 4.47.9 6.1 2.53s2.53 3.8 2.53 6.1c.01 4.76-3.86 8.62-8.62 8.62zM16.51 13.88c-.25-.13-1.46-.72-1.69-.8-.22-.08-.39-.13-.55.13s-.63.8-.77.96-.28.18-.53.05a6.76 6.76 0 0 1-1.95-1.21c-.55-.49-1.08-1.09-1.41-1.74-.14-.25-.01-.39.12-.52.11-.11.25-.29.37-.43.13-.13.17-.22.25-.38.08-.16.04-.3-.02-.43s-.55-1.33-.76-1.82c-.2-.48-.41-.42-.56-.42h-.48c-.17 0-.44.06-.67.31-.22.25-.86.84-.86 2.04s.87 2.36.99 2.53c.12.18 1.7 2.6 4.13 3.65.58.25 1.03.4 1.38.51.58.18 1.11.16 1.53.1.47-.07 1.46-.6 1.67-1.18.21-.58.21-1.07.14-1.18s-.22-.16-.47-.29z"/></svg>
                                    </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="px-8 py-20 text-center">
                                <div class="flex flex-col items-center">
                                    <div class="w-24 h-24 bg-gray-50 rounded-full flex items-center justify-center mb-6">
                                        <svg class="w-12 h-12 text-gray-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"/></svg>
                                    </div>
                                    <p class="text-lg font-bold text-gray-400">Belum ada transaksi ditemukan.</p>
                                    <p class="text-sm text-gray-300 mt-1">Gunakan filter lain atau reset pencarian Anda.</p>
                                    <a href="{{ route('admin.bookings.index') }}" class="mt-6 text-xs font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700 transition-colors">Reset Filter</a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Enhanced Pagination -->
            @if($bookings->hasPages())
                <div class="px-8 py-6 bg-gray-50/50 border-t border-gray-100 italic">
                    {{ $bookings->appends(request()->query())->links() }}
                </div>
            @endif
        </div>
    </div>

    <!-- Styles for the new design -->
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');
        
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #f8fafc;
        }

        .animate-pulse-slow {
            animation: pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.8; }
        }

        /* Custom select styling to hide default arrow in premium look */
        select {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='none' viewBox='0 0 20 20'%3e%3cpath stroke='%2394a3b8' stroke-linecap='round' stroke-linejoin='round' stroke-width='1.5' d='M6 8l4 4 4-4'/%3e%3c/svg%3e");
            background-position: right 0.75rem center;
            background-repeat: no-repeat;
            background-size: 1.5em 1.5em;
            padding-right: 2.5rem;
        }

        /* Scrollbar styling */
        .overflow-x-auto::-webkit-scrollbar {
            height: 6px;
        }
        .overflow-x-auto::-webkit-scrollbar-track {
            background: #f1f5f9;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb {
            background: #e2e8f0;
            border-radius: 10px;
        }
        .overflow-x-auto::-webkit-scrollbar-thumb:hover {
            background: #cbd5e1;
        }
    </style>

    {{-- Modals remain the same but will be improved in partials/modals --}}
    @include('admin.bookings.partials.modals')

    @push('scripts')
    <script>
    function confirmBooking(bookingId) {
        document.getElementById('confirmForm').action = `/admin/bookings/${bookingId}/confirm`;
        document.getElementById('confirmModal').classList.remove('hidden');
    }

    function rejectBooking(bookingId) {
        document.getElementById('rejectForm').action = `/admin/bookings/${bookingId}/reject`;
        document.getElementById('rejectModal').classList.remove('hidden');
    }

    function completeBooking(bookingId) {
        document.getElementById('completeForm').action = `/admin/bookings/${bookingId}/complete`;
        document.getElementById('completeModal').classList.remove('hidden');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.add('hidden');
    }

    // Close modal when clicking outside
    document.addEventListener('click', function(event) {
        const modals = ['confirmModal', 'rejectModal', 'completeModal'];
        modals.forEach(modalId => {
            const modal = document.getElementById(modalId);
            if (modal && event.target === modal) {
                closeModal(modalId);
            }
        });
    });
    </script>
    @endpush
@endsection
