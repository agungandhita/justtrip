@extends('admin.layouts.main')

@section('container')
<div class="mt-20 pb-12 antialiased text-gray-900 px-4 md:px-8">
    <!-- Breadcrumbs & Navigation -->
    <div class="mb-8 px-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2 md:mb-0">
                <a href="{{ route('admin.bookings.index') }}" class="hover:text-amber-600 transition-colors">Manajemen Booking</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-gray-800 font-medium">Detail Booking</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.bookings.index') }}" class="group flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-xl text-gray-700 hover:bg-gray-50 hover:border-amber-200 transition-all duration-300 shadow-sm font-bold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Kembali
                </a>
                <a href="{{ route('admin.bookings.edit', $booking) }}" class="flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 px-6 py-2 rounded-xl text-white font-bold text-sm transition-all duration-300 shadow-lg shadow-indigo-100">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                    Edit Booking
                </a>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="px-4 mb-8">
        <div class="relative overflow-hidden bg-gradient-to-br from-indigo-900 via-blue-900 to-indigo-800 rounded-[2.5rem] p-8 md:p-12 text-white shadow-2xl">
            <!-- Background Decoration -->
            <div class="absolute top-0 right-0 -mt-20 -mr-20 w-80 h-80 bg-white opacity-10 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 -mb-20 -ml-20 w-80 h-80 bg-blue-400 opacity-10 rounded-full blur-3xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row md:items-end justify-between gap-8">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest backdrop-blur-md bg-white/10 text-white border border-white/20">
                            {{ $booking->booking_number }}
                        </span>
                        <span class="px-4 py-1.5 rounded-full text-[10px] font-black uppercase tracking-widest backdrop-blur-md 
                            @if($booking->status == 'pending') bg-amber-500/20 text-amber-300 border border-amber-500/30
                            @elseif($booking->status == 'confirmed') bg-emerald-500/20 text-emerald-300 border border-emerald-500/30
                            @elseif($booking->status == 'completed') bg-blue-500/20 text-blue-300 border border-blue-500/30
                            @else bg-rose-500/20 text-rose-300 border border-rose-500/30 @endif">
                            {{ $booking->status_label }}
                        </span>
                    </div>
                    <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-2">
                        @if($booking->layanan)
                            {{ $booking->layanan->nama_layanan }}
                        @else
                            {{ $booking->custom_booking_info['destination'] ?? 'Custom Trip' }}
                        @endif
                    </h1>
                    <p class="text-blue-100 flex items-center gap-2 opacity-80 text-sm font-medium">
                        <svg class="w-5 h-5 text-amber-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C8.13 2 5 5.13 5 9c0 5.25 7 13 7 13s7-7.75 7-13c0-3.87-3.13-7-7-7zm0 9.5a2.5 2.5 0 0 1 0-5 2.5 2.5 0 0 1 0 5z"/></svg>
                        {{ $booking->layanan->lokasi ?? $booking->custom_booking_info['destination'] ?? 'Destination' }}
                    </p>
                </div>
                <div class="text-left md:text-right">
                    <div class="text-blue-200 text-[10px] font-black uppercase tracking-widest mb-1">Total Pembayaran</div>
                    <div class="text-4xl md:text-5xl font-black text-amber-400 font-mono tracking-tighter">
                        {{ $booking->formatted_total_amount }}
                    </div>
                    @if($booking->invoice)
                        @if(in_array($booking->status, ['confirmed', 'completed']))
                            <a href="{{ route('admin.invoices.show', $booking->invoice) }}" class="inline-flex items-center gap-2 mt-4 text-xs font-bold text-white hover:text-amber-400 transition-colors uppercase tracking-widest bg-white/10 px-4 py-2 rounded-full border border-white/20">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Lihat Invoice
                            </a>
                        @else
                            <button disabled class="inline-flex items-center gap-2 mt-4 text-xs font-bold text-white/40 cursor-not-allowed uppercase tracking-widest bg-white/5 px-4 py-2 rounded-full border border-white/10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                                Invoice Belum Tersedia
                            </button>
                        @endif
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Stats Grid -->
    <div class="px-4 mb-8 grid grid-cols-2 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center transition-all hover:shadow-md group">
            <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
            </div>
            <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Tgl Booking</span>
            <span class="text-sm font-bold text-gray-900 mt-1">{{ $booking->formatted_booking_date }}</span>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center transition-all hover:shadow-md group">
            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-600 mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Tgl Berangkat</span>
            <span class="text-sm font-bold text-gray-900 mt-1">{{ $booking->formatted_tanggal_keberangkatan }}</span>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center transition-all hover:shadow-md group">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
            </div>
            <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Total Peserta</span>
            <span class="text-sm font-bold text-gray-900 mt-1">{{ $booking->jumlah_peserta }} Orang</span>
        </div>
        <div class="bg-white p-6 rounded-3xl shadow-sm border border-gray-100 flex flex-col items-center justify-center text-center transition-all hover:shadow-md group">
            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-600 mb-3 group-hover:scale-110 transition-transform">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
            </div>
            <span class="text-[10px] text-gray-400 font-black uppercase tracking-widest">Status Booking</span>
            <span class="text-sm font-bold text-gray-900 mt-1">{{ $booking->status_label }}</span>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="px-4 grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Left Column: Primary Details -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Customer Information Card -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-5 pointer-events-none">
                    <svg class="w-48 h-48 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                </div>
                <h3 class="text-xl font-bold mb-8 flex items-center gap-3">
                    <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                    Informasi Customer
                </h3>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="flex items-start gap-5">
                        <div class="w-16 h-16 rounded-3xl bg-indigo-50 flex items-center justify-center text-2xl font-black text-indigo-600 border-2 border-indigo-100 shadow-sm">
                            {{ substr($booking->user->name ?? $booking->customer_info['name'] ?? 'G', 0, 1) }}
                        </div>
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-1">Data Akun</p>
                            <h4 class="text-lg font-bold text-gray-900">{{ $booking->user->name ?? $booking->customer_info['name'] ?? 'Guest' }}</h4>
                            <p class="text-sm text-gray-500 font-medium">{{ $booking->user->email ?? $booking->customer_info['email'] ?? 'N/A' }}</p>
                            @if($booking->user)
                                <div class="mt-4 flex items-center gap-2">
                                    <span class="px-3 py-1 bg-blue-50 text-blue-600 text-[10px] font-black uppercase tracking-wider rounded-lg border border-blue-100 italic">Member</span>
                                    <span class="text-[10px] text-gray-400 font-medium">Sejak {{ $booking->user->created_at->format('M Y') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    
                    <div class="space-y-6">
                        <div>
                            <p class="text-[10px] font-black uppercase tracking-widest text-gray-400 mb-2">Kontak & Alamat</p>
                            <div class="space-y-3">
                                <div class="flex items-center gap-3 text-sm text-gray-700">
                                    <div class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 group">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <span class="font-bold">{{ $booking->customer_info['phone'] ?? $booking->user->phone ?? 'N/A' }}</span>
                                    @if(isset($booking->customer_info['phone']))
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $booking->customer_info['phone']) }}" target="_blank" class="text-[10px] font-black text-emerald-600 uppercase tracking-widest hover:text-emerald-700 underline">Send WhatsApp</a>
                                    @endif
                                </div>
                                <div class="flex items-start gap-3 text-sm text-gray-700">
                                    <div class="w-8 h-8 rounded-xl bg-gray-50 flex items-center justify-center text-gray-400 shrink-0">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                    </div>
                                    <span class="font-medium leading-relaxed">{{ $booking->customer_info['alamat'] ?? $booking->user->address ?? 'Alamat tidak tersedia' }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Notes Section -->
            @if($booking->catatan_khusus || $booking->admin_notes)
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                @if($booking->catatan_khusus)
                <div class="bg-amber-50 rounded-[2.5rem] p-8 border border-amber-100 shadow-sm relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-amber-400 opacity-10 rounded-full blur-2xl"></div>
                    <h4 class="text-sm font-black text-amber-800 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                        Catatan Customer
                    </h4>
                    <p class="text-sm text-amber-900 italic font-medium leading-relaxed">{{ $booking->catatan_khusus }}</p>
                </div>
                @endif
                
                @if($booking->admin_notes)
                <div class="bg-indigo-50 rounded-[2.5rem] p-8 border border-indigo-100 shadow-sm relative overflow-hidden">
                    <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-indigo-400 opacity-10 rounded-full blur-2xl"></div>
                    <h4 class="text-sm font-black text-indigo-800 uppercase tracking-widest mb-4 flex items-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                        Internal Notes
                    </h4>
                    <div class="text-sm text-indigo-900 font-medium leading-relaxed">
                        {!! nl2br(e($booking->admin_notes)) !!}
                    </div>
                </div>
                @endif
            </div>
            @endif

            <!-- Log Activity Timeline -->
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                <h3 class="text-xl font-bold mb-10 flex items-center gap-3">
                    <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                    Riwayat Perjalanan Booking
                </h3>
                
                <div class="space-y-12 ml-4 border-l-2 border-gray-50">
                    @forelse($auditTrail as $index => $log)
                    <div class="relative pl-10">
                        <div class="absolute -left-[11px] top-1 w-5 h-5 rounded-full border-4 border-white shadow-sm ring-4 ring-{{ $log['status'] === 'pending' ? 'amber' : ($log['status'] === 'confirmed' ? 'emerald' : ($log['status'] === 'cancelled' || $log['status'] === 'rejected' ? 'rose' : 'blue')) }}-50 bg-{{ $log['status'] === 'pending' ? 'amber' : ($log['status'] === 'confirmed' ? 'emerald' : ($log['status'] === 'cancelled' || $log['status'] === 'rejected' ? 'rose' : 'blue')) }}-500 transition-transform hover:scale-125"></div>
                        
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <div>
                                <p class="text-xs font-black text-gray-900 uppercase tracking-widest mb-1">{{ $log['description'] }}</p>
                                <p class="text-[11px] text-gray-400 font-bold">Oleh <span class="text-indigo-600 italic">@ {{ $log['user'] }}</span></p>
                                @if(isset($log['notes']) && $log['notes'])
                                    <div class="mt-4 p-4 bg-gray-50 rounded-2xl border border-gray-100 relative max-w-lg">
                                        <div class="absolute -left-2 top-4 w-4 h-4 bg-gray-50 border-l border-b border-gray-100 rotate-45"></div>
                                        <p class="text-xs text-gray-600 font-medium italic">"{{ $log['notes'] }}"</p>
                                    </div>
                                @endif
                            </div>
                            <div class="md:text-right shrink-0">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-tighter">{{ $log['timestamp']->format('d M Y') }}</p>
                                <p class="text-lg font-black text-gray-300">{{ $log['timestamp']->format('H:i') }}</p>
                            </div>
                        </div>
                    </div>
                    @empty
                    <p class="italic text-gray-400 text-center py-10">Belum ada riwayat tercatat.</p>
                    @endforelse
                </div>
            </div>
        </div>
        
        <!-- Right Column: Sidebar Actions -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Payment Summary Card -->
            <div class="bg-indigo-900 rounded-[2.5rem] p-8 shadow-xl text-white overflow-hidden relative group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-all"></div>
                <h3 class="text-lg font-bold mb-8 flex items-center gap-2">
                    <svg class="w-6 h-6 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                    Ringkasan Transaksi
                </h3>
                
                <div class="space-y-4">
                    <div class="flex justify-between items-center text-sm font-medium">
                        <span class="opacity-60">Harga Dasar ({{ $booking->jumlah_peserta }}x)</span>
                        <span>Rp {{ number_format($booking->original_amount, 0, ',', '.') }}</span>
                    </div>
                    @if($booking->discount_amount > 0)
                    <div class="flex justify-between items-center text-sm font-medium text-amber-300">
                        <span class="opacity-80">Potongan Diskon</span>
                        <span>-Rp {{ number_format($booking->discount_amount, 0, ',', '.') }}</span>
                    </div>
                    @endif
                    <div class="pt-4 mt-4 border-t border-white/10">
                        <div class="flex justify-between items-end">
                            <div>
                                <p class="text-[10px] font-black uppercase tracking-widest opacity-60 mb-1">Total Dibayar</p>
                                <p class="text-2xl font-black text-amber-400">{{ $booking->formatted_total_amount }}</p>
                            </div>
                            <div class="text-right">
                                <span class="px-3 py-1 whitespace-nowrap text-[9px] font-black uppercase tracking-widest rounded-lg border
                                    @if(in_array($booking->status, ['confirmed', 'completed'])) bg-emerald-500/20 text-emerald-300 border-emerald-500/30
                                    @elseif($booking->status === 'payment_uploaded') bg-purple-500/20 text-purple-300 border-purple-500/30
                                    @elseif(in_array($booking->status, ['approved', 'awaiting_payment'])) bg-amber-500/20 text-amber-300 border-amber-500/30
                                    @else bg-white/10 text-white border-white/20 @endif">
                                    {{ $booking->payment_status_label }}
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Center Card -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100">
                <h3 class="font-bold text-gray-900 mb-8 pb-4 border-b border-gray-50 flex items-center justify-between">
                    Kontrol Pemesanan
                    <span class="w-2 h-2 bg-indigo-600 rounded-full animate-ping"></span>
                </h3>
                
                <div class="space-y-4">
                    @if($booking->status === 'pending')
                    <button type="button" onclick="confirmBooking('{{ $booking->booking_id }}')" class="w-full flex items-center justify-between p-4 bg-emerald-50 rounded-2xl border border-emerald-100 text-emerald-700 hover:bg-emerald-100 transition-all duration-300 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-emerald-500 text-white rounded-xl shadow-lg shadow-emerald-100 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div class="text-left">
                                <div class="text-sm font-black uppercase tracking-tight">Setujui</div>
                                <div class="text-[10px] opacity-60 font-bold uppercase">Konfirmasi Tour</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 opacity-40 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                    @endif
                    
                    @if(in_array($booking->status, ['pending', 'approved', 'awaiting_payment']))
                    <button type="button" onclick="rejectBooking('{{ $booking->booking_id }}')" class="w-full flex items-center justify-between p-4 bg-rose-50 rounded-2xl border border-rose-100 text-rose-700 hover:bg-rose-100 transition-all duration-300 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-rose-500 text-white rounded-xl shadow-lg shadow-rose-100 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            </div>
                            <div class="text-left">
                                <div class="text-sm font-black uppercase tracking-tight">Tolak</div>
                                <div class="text-[10px] opacity-60 font-bold uppercase">Batalkan Pesanan</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 opacity-40 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                    @endif
                    
                    @if($booking->status === 'confirmed')
                    <button type="button" onclick="completeBooking('{{ $booking->booking_id }}')" class="w-full flex items-center justify-between p-4 bg-blue-50 rounded-2xl border border-blue-100 text-blue-700 hover:bg-blue-100 transition-all duration-300 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-500 text-white rounded-xl shadow-lg shadow-blue-100 flex items-center justify-center group-hover:rotate-12 transition-transform">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                            </div>
                            <div class="text-left">
                                <div class="text-sm font-black uppercase tracking-tight">Selesai</div>
                                <div class="text-[10px] opacity-60 font-bold uppercase">Tour Telah Berakhir</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 opacity-40 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </button>
                    @endif
                    
                    <a href="{{ route('admin.bookings.edit', $booking) }}" class="w-full flex items-center justify-between p-4 bg-gray-50 rounded-2xl border border-gray-100 text-gray-700 hover:bg-white hover:shadow-xl transition-all duration-500 group">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-white border border-gray-100 text-gray-500 rounded-xl shadow-sm flex items-center justify-center group-hover:border-indigo-200 group-hover:text-indigo-600 transition-colors">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                            </div>
                            <div class="text-left">
                                <div class="text-sm font-black uppercase tracking-tight">Ubah Data</div>
                                <div class="text-[10px] opacity-60 font-bold uppercase">Edit Informasi Booking</div>
                            </div>
                        </div>
                        <svg class="w-5 h-5 opacity-40 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                    </a>
                </div>
            </div>

            <!-- Customer Loyalty Stats -->
            <div class="bg-gradient-to-br from-gray-900 to-indigo-950 rounded-[2.5rem] p-8 shadow-xl text-white">
                <h3 class="text-lg font-bold mb-8 flex items-center gap-2">
                    <svg class="w-6 h-6 text-indigo-400" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>
                    Statistik Pelanggan
                </h3>
                
                <div class="space-y-6">
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium opacity-60">Total Pesanan</span>
                        <span class="text-lg font-black">{{ $booking->user->bookings()->count() }} Trip</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-xs font-medium opacity-60">Success Rate</span>
                        <span class="text-lg font-black text-emerald-400">
                            @php
                                $total = $booking->user->bookings()->count();
                                $success = $booking->user->bookings()->where('status', 'completed')->count();
                                echo $total > 0 ? round(($success / $total) * 100) : 0;
                            @endphp%
                        </span>
                    </div>
                    <div class="flex items-center justify-between pt-6 border-t border-white/10">
                        <span class="text-xs font-medium opacity-60">Total Kontribusi</span>
                        <span class="text-lg font-black text-indigo-300">Rp {{ number_format($booking->user->bookings()->whereIn('status', ['confirmed', 'completed'])->sum('total_amount'), 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- Modals remain the same but will be improved in partials/modals --}}
@include('admin.bookings.partials.modals')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');
    
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }
</style>

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