@extends('admin.layouts.main')

@section('container')
<div class="mt-20 pb-12 antialiased text-gray-900 px-4 md:px-8">
    <!-- Breadcrumbs & Navigation -->
    <div class="mb-8 px-4">
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
            <div class="flex items-center gap-2 text-sm text-gray-500 mb-2 md:mb-0">
                <a href="{{ route('admin.bookings.index') }}" class="hover:text-indigo-600 transition-colors">Manajemen Booking</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <a href="{{ route('admin.bookings.show', $booking) }}" class="hover:text-indigo-600 transition-colors">Detail Booking</a>
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
                <span class="text-gray-800 font-medium">Edit Booking</span>
            </div>
            <div class="flex items-center gap-3">
                <a href="{{ route('admin.bookings.show', $booking) }}" class="group flex items-center gap-2 bg-white border border-gray-200 px-4 py-2 rounded-xl text-gray-700 hover:bg-gray-50 hover:border-indigo-200 transition-all duration-300 shadow-sm font-bold text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 group-hover:-translate-x-1 transition-transform" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M19 12H5M12 19l-7-7 7-7"/></svg>
                    Batal
                </a>
            </div>
        </div>
    </div>

    <!-- Header Section -->
    <div class="mb-10 px-4">
        <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 tracking-tight flex items-center gap-3">
            <div class="w-2 h-10 bg-indigo-600 rounded-full"></div>
            Edit Booking #{{ $booking->booking_number }}
        </h1>
        <p class="text-gray-500 font-medium mt-1 ml-5 text-sm uppercase tracking-widest">Detail Pemesanan {{ $booking->status_label }}</p>
    </div>

    @if ($errors->any())
        <div class="px-4 mb-8">
            <div class="bg-rose-50 border border-rose-100 rounded-[1.5rem] p-6 text-rose-700">
                <div class="flex items-center gap-3 mb-3">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    <h4 class="font-bold">Mohon perbaiki kesalahan berikut:</h4>
                </div>
                <ul class="list-disc list-inside text-sm font-medium space-y-1 ml-9">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.bookings.update', $booking) }}" method="POST" class="px-4 grid grid-cols-1 lg:grid-cols-12 gap-8">
        @csrf
        @method('PUT')

        <!-- Left Column: Form Fields -->
        <div class="lg:col-span-8 space-y-8">
            <!-- Booking Details Card -->
            <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100 relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-5 pointer-events-none">
                    <svg class="w-64 h-64 text-indigo-600" fill="currentColor" viewBox="0 0 24 24"><path d="M19,3H18V1H16V3H8V1H6V3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M19,19H5V8H19V19Z"/></svg>
                </div>
                
                <h3 class="text-xl font-black mb-10 flex items-center gap-3 text-indigo-900 uppercase tracking-tight">
                    <div class="w-2 h-8 bg-indigo-600 rounded-full"></div>
                    Informasi Perjalanan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div>
                        <label for="layanan_id" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3 ml-1">Layanan Travel <span class="text-rose-500">*</span></label>
                        <div class="relative group">
                            <select id="layanan_id" name="layanan_id" required
                                    class="w-full px-5 py-4 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all text-sm font-bold appearance-none">
                                @foreach($layananOptions as $layanan)
                                    <option value="{{ $layanan->layanan_id }}" {{ (old('layanan_id') ?? $booking->layanan_id) == $layanan->layanan_id ? 'selected' : '' }}>{{ $layanan->nama_layanan }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="tanggal_keberangkatan" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3 ml-1">Tanggal Keberangkatan <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <input type="date" id="tanggal_keberangkatan" name="tanggal_keberangkatan" 
                                   value="{{ old('tanggal_keberangkatan') ?? ($booking->tanggal_keberangkatan ? $booking->tanggal_keberangkatan->format('Y-m-d') : '') }}"
                                   required
                                   class="w-full px-5 py-4 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all text-sm font-bold">
                            <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div>
                        <label for="jumlah_peserta" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3 ml-1">Jumlah Peserta <span class="text-rose-500">*</span></label>
                        <div class="relative">
                            <input type="number" id="jumlah_peserta" name="jumlah_peserta" min="1"
                                   value="{{ old('jumlah_peserta') ?? $booking->jumlah_peserta }}"
                                   required
                                   class="w-full px-5 py-4 bg-gray-50 border-gray-100 rounded-2xl focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all text-sm font-bold">
                            <div class="absolute inset-y-0 right-5 flex items-center pointer-events-none text-gray-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label for="admin_notes" class="block text-[10px] font-black uppercase tracking-widest text-gray-400 mb-3 ml-1">Internal Notes (Admin Only)</label>
                        <textarea id="admin_notes" name="admin_notes" rows="4"
                                  placeholder="Tambahkan catatan internal mengenai booking ini..."
                                  class="w-full px-5 py-4 bg-gray-50 border-gray-100 rounded-[1.5rem] focus:bg-white focus:ring-4 focus:ring-indigo-100 focus:border-indigo-400 transition-all text-sm font-medium resize-none">{{ old('admin_notes') ?? $booking->admin_notes }}</textarea>
                    </div>
                </div>

                <div class="mt-12 pt-10 border-t border-gray-50 flex flex-col md:flex-row md:items-center justify-between gap-6 relative z-10">
                    <p class="text-[10px] text-gray-400 font-bold max-w-sm italic">
                        <span class="text-rose-500 font-black">*</span> Mengubah data layanan atau jumlah peserta dapat mempengaruhi total tagihan yang harus dibayarkan customer.
                    </p>
                    <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-black uppercase tracking-widest px-10 py-4 rounded-2xl transition-all shadow-xl shadow-indigo-100 flex items-center justify-center gap-3 transform hover:-translate-y-1 active:scale-95">
                        Simpan Perubahan
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                    </button>
                </div>
            </div>

            <!-- Customer Original Requests (Read-only for context) -->
            <div class="bg-amber-50 rounded-[2.5rem] p-10 border border-amber-100 relative overflow-hidden">
                <div class="absolute right-0 top-0 opacity-10 pointer-events-none">
                    <svg class="w-48 h-48 text-amber-600" fill="currentColor" viewBox="0 0 24 24"><path d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
                </div>
                <h3 class="text-lg font-black mb-8 flex items-center gap-3 text-amber-800 uppercase tracking-tight">
                    <div class="w-2 h-6 bg-amber-400 rounded-full"></div>
                    Permintaan Khusus Customer
                </h3>
                
                <div class="relative z-10">
                    @if($booking->catatan_khusus)
                        <div class="p-6 bg-white/50 backdrop-blur-sm rounded-[1.5rem] border border-amber-200">
                            <p class="text-sm text-amber-900 italic font-medium leading-relaxed">"{{ $booking->catatan_khusus }}"</p>
                        </div>
                    @else
                        <p class="text-sm text-amber-600 font-bold italic">Tidak ada catatan atau permintaan khusus dari customer.</p>
                    @endif
                </div>
            </div>
        </div>

        <!-- Right Column: Context & Stats -->
        <div class="lg:col-span-4 space-y-8">
            <!-- User Info Card -->
            <div class="bg-white rounded-[2.5rem] p-8 shadow-sm border border-gray-100 overflow-hidden group">
                <h3 class="text-sm font-black text-gray-900 uppercase tracking-widest mb-8 flex items-center gap-2">
                    Informasi Akun
                </h3>
                <div class="flex items-center gap-5 mb-8">
                    <div class="w-16 h-16 rounded-3xl bg-indigo-50 flex items-center justify-center text-2xl font-black text-indigo-600 border-2 border-indigo-100 group-hover:scale-110 transition-transform">
                        {{ substr($booking->user->name ?? $booking->customer_info['name'] ?? 'G', 0, 1) }}
                    </div>
                    <div>
                        <h4 class="text-lg font-extrabold text-gray-900 leading-tight">{{ $booking->user->name ?? $booking->customer_info['name'] ?? 'Guest' }}</h4>
                        <p class="text-xs text-gray-500 font-bold mt-1">{{ $booking->user->email ?? $booking->customer_info['email'] ?? 'N/A' }}</p>
                    </div>
                </div>

                <div class="space-y-4 pt-8 border-t border-gray-50">
                    <div class="flex flex-col gap-1">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">Nomor Telepon</span>
                        <span class="text-sm font-bold text-gray-700">{{ $booking->customer_info['phone'] ?? $booking->user->phone ?? 'N/A' }}</span>
                    </div>
                    <div class="flex flex-col gap-1">
                        <span class="text-[9px] font-black text-gray-400 uppercase tracking-[0.2em]">Alamat Pengiriman</span>
                        <span class="text-sm font-medium text-gray-600 leading-relaxed">{{ $booking->customer_info['alamat'] ?? $booking->user->address ?? 'N/A' }}</span>
                    </div>
                </div>
            </div>

            <!-- Booking Snapshots -->
            <div class="bg-indigo-900 rounded-[2.5rem] p-10 shadow-xl text-white relative overflow-hidden group">
                <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-amber-400 opacity-10 rounded-full blur-2xl group-hover:scale-150 transition-all duration-700"></div>
                <h3 class="text-sm font-black text-indigo-200 uppercase tracking-widest mb-8">Snapshot Biaya</h3>
                
                <div class="space-y-6">
                    <div class="flex justify-between items-center">
                        <span class="text-xs font-medium opacity-60">Status Sekarang</span>
                        <span class="px-3 py-1 bg-white/10 text-white text-[9px] font-black uppercase tracking-widest rounded-lg border border-white/20">{{ $booking->status_label }}</span>
                    </div>
                    <div class="flex justify-between items-center text-sm font-medium pt-4 border-t border-white/5">
                        <span class="opacity-60">Harga Terakhir</span>
                        <span class="font-black text-amber-400">{{ $booking->formatted_total_amount }}</span>
                    </div>
                </div>

                <div class="mt-10 p-5 bg-white/5 rounded-2xl border border-white/10">
                    <div class="flex gap-4 items-center">
                        <div class="w-10 h-10 bg-amber-400 text-indigo-900 rounded-xl flex items-center justify-center">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <p class="text-[10px] font-medium text-indigo-100 leading-relaxed uppercase tracking-tighter">Sistem akan log perubahan data ini untuk keperluan auditi.</p>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap');
    
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background-color: #f8fafc;
    }

    input[type="date"]::-webkit-calendar-picker-indicator {
        opacity: 0;
        width: 100%;
        height: 100%;
        position: absolute;
        cursor: pointer;
    }
</style>
@endsection
