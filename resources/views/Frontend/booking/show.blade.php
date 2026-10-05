@extends('Frontend.layouts.main')

@section('title', 'Detail Booking #' . $booking->booking_id)

@section('container')
<div class="min-h-screen bg-[#f8fafc]">
    <!-- Hero Section -->
    <div class="bg-blue-600 pt-12 pb-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
                <div>
                    <nav class="flex mb-4 text-sm text-blue-100" aria-label="Breadcrumb">
                        <ol class="flex items-center space-x-2">
                            <li><a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a></li>
                            <li><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2"/></svg></li>
                            <li><a href="{{ route('booking.index') }}" class="hover:text-white transition-colors">Booking Saya</a></li>
                            <li><svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M9 5l7 7-7 7" stroke-width="2"/></svg></li>
                            <li class="text-white font-bold">Detail #{{ $booking->booking_id }}</li>
                        </ol>
                    </nav>
                    <h1 class="text-3xl md:text-5xl font-black text-white leading-tight">
                        Status Pesanan Anda
                    </h1>
                    <div class="mt-4 flex flex-wrap items-center gap-4">
                        <span class="px-4 py-1.5 bg-white/20 backdrop-blur-md border border-white/30 rounded-full text-white text-sm font-bold">
                            ID: #{{ $booking->booking_id }}
                        </span>
                        <span class="px-4 py-1.5 bg-{{ $booking->status_color }}-500 text-white rounded-full text-sm font-bold shadow-lg shadow-black/10">
                            {{ $booking->status_label }}
                        </span>
                    </div>
                </div>
                <div class="flex items-center space-x-3">
                    @if(in_array($booking->status, ['confirmed', 'completed']))
                        <a href="{{ route('booking.invoice', $booking->booking_id) }}" 
                           class="bg-white text-blue-600 px-6 py-3 rounded-2xl font-black shadow-xl hover:bg-blue-50 transition-all flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M12 10v6m0 0l-3-3m3 3l3-3m7-3V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-3" stroke-width="2"/></svg>
                            Invoice PDF
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 -mt-10 pb-20">
        <!-- Status Tracker Card -->
        <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 p-8 mb-8 overflow-x-auto">
            <div class="min-w-[600px] flex items-start justify-between relative">
                <!-- Progress Line Background -->
                <div class="absolute top-6 left-0 right-0 h-1 bg-gray-100 -z-0"></div>
                
                @php
                    $steps = [
                        ['id' => 'pending', 'label' => 'Pending', 'icon' => 'clock'],
                        ['id' => 'approved', 'label' => 'Disetujui', 'icon' => 'check-circle'],
                        ['id' => 'awaiting_payment', 'label' => 'Bayar', 'icon' => 'credit-card'],
                        ['id' => 'payment_uploaded', 'label' => 'Verifikasi', 'icon' => 'search'],
                        ['id' => 'confirmed', 'label' => 'Dikonfirmasi', 'icon' => 'check-double'],
                        ['id' => 'completed', 'label' => 'Selesai', 'icon' => 'flag']
                    ];
                    
                    $currentIdx = 0;
                    foreach($steps as $idx => $step) {
                        if($booking->status === $step['id']) {
                            $currentIdx = $idx;
                            break;
                        }
                    }
                    if($booking->status === 'confirmed') $currentIdx = 4;
                    if($booking->status === 'completed') $currentIdx = 5;
                    // Handle terminal states
                    if(in_array($booking->status, ['rejected', 'cancelled'])) $currentIdx = -1;
                @endphp

                @foreach($steps as $idx => $step)
                    @php
                        $isCompleted = $currentIdx > $idx;
                        $isActive = $currentIdx === $idx;
                        $isPending = $currentIdx < $idx && $currentIdx !== -1;
                    @endphp
                    <div class="flex flex-col items-center relative z-10 flex-1">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center transition-all duration-500 {{ $isActive ? 'bg-blue-600 text-white shadow-xl shadow-blue-200 scale-110' : ($isCompleted ? 'bg-green-500 text-white' : 'bg-gray-100 text-gray-400') }}">
                            @if($isCompleted)
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            @elseif($step['id'] === 'pending')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @elseif($step['id'] === 'approved')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                            @elseif($step['id'] === 'awaiting_payment')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"/></svg>
                            @elseif($step['id'] === 'payment_uploaded')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                            @elseif($step['id'] === 'confirmed')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                            @elseif($step['id'] === 'completed')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 21v-4m0 0V5a2 2 0 012-2h6.5l1 1H21l-3 6 3 6h-8.5l-1-1H5a2 2 0 00-2 2zm9-13.5V9"/></svg>
                            @else
                                <i class="fas fa-{{ $step['icon'] }} text-lg"></i>
                            @endif
                        </div>
                        <span class="mt-3 text-xs font-black uppercase tracking-widest {{ $isActive ? 'text-blue-600' : ($isCompleted ? 'text-green-600' : 'text-gray-400') }}">
                            {{ $step['label'] }}
                        </span>
                        @if ($isActive)
                            <span class="absolute -bottom-6 flex h-2 w-2">
                                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-blue-500"></span>
                            </span>
                        @endif
                    </div>
                @endforeach
            </div>
            
            @if(in_array($booking->status, ['rejected', 'cancelled']))
                <div class="mt-12 p-6 bg-red-50 border border-red-100 rounded-3xl flex items-center gap-6 animate-pulse">
                    <div class="w-16 h-16 bg-red-100 text-red-600 rounded-2xl flex items-center justify-center flex-shrink-0">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/></svg>
                    </div>
                    <div>
                        <h3 class="text-xl font-black text-red-900">Pesanan {{ $booking->status_label }}</h3>
                        <p class="text-red-700 font-medium">
                            {{ $booking->admin_notes ?? 'Maaf, pesanan Anda tidak dapat dilanjutkan. Silakan hubungi admin untuk informasi lebih lanjut.' }}
                        </p>
                    </div>
                </div>
            @endif
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            <!-- Left Side: Details -->
            <div class="lg:col-span-8 space-y-8">
                <!-- Trip Summary Header -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 overflow-hidden">
                    <div class="relative h-64">
                         <img src="{{ asset($booking->layanan->gambar_utama ? 'storage/' . $booking->layanan->gambar_utama : 'img/placeholder-trip.jpg') }}"
                             alt="{{ $booking->layanan->nama_layanan }}"
                             class="w-full h-full object-cover">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-transparent to-transparent"></div>
                        <div class="absolute bottom-8 left-8 right-8 flex justify-between items-end">
                            <div>
                                <p class="text-blue-400 font-black uppercase tracking-widest text-sm mb-2">{{ $booking->layanan->lokasi }}</p>
                                <h2 class="text-white text-3xl font-black leading-tight">{{ $booking->layanan->nama_layanan }}</h2>
                            </div>
                            <div class="text-right text-white">
                                <p class="text-xs font-bold opacity-60 uppercase mb-1">Berangkat</p>
                                <p class="text-xl font-black">{{ $booking->tanggal_keberangkatan->format('d M Y') }}</p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-8 grid grid-cols-2 md:grid-cols-4 gap-8">
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Durasi</p>
                            <p class="text-gray-900 font-black">{{ $booking->layanan->durasi ?? 'Sesuai Paket' }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Peserta</p>
                            <p class="text-gray-900 font-black">{{ $booking->jumlah_peserta }} Orang</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Tipe Paket</p>
                            <p class="text-gray-900 font-black">Premium Trip</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Booking At</p>
                            <p class="text-gray-900 font-black">{{ $booking->created_at->format('d/m/y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Section: Traveler Info -->
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 md:p-10">
                    <div class="flex items-center space-x-4 mb-8">
                        <div class="p-3 bg-blue-50 text-blue-600 rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-gray-900">Informasi Pemesan</h2>
                            <p class="text-gray-500 font-medium text-sm">Data pribadi yang terdaftar dalam sistem</p>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Nama Lengkap</p>
                            <p class="text-lg font-bold text-gray-900">{{ $booking->user?->name }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Email Aktif</p>
                            <p class="text-lg font-bold text-gray-900">{{ $booking->user?->email }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">WhatsApp</p>
                            <p class="text-lg font-bold text-gray-900">{{ $booking->user?->phone }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest">Alamat</p>
                            <p class="text-lg font-bold text-gray-900 line-clamp-2">{{ $booking->user?->address }}</p>
                        </div>
                        @if($booking->catatan_khusus)
                            <div class="md:col-span-2 p-6 bg-gray-50 rounded-3xl border border-dashed border-gray-300">
                                <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-2">Catatan Khusus</p>
                                <p class="text-sm font-medium text-gray-700 italic">"{{ $booking->catatan_khusus }}"</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Section: Payment Section -->
                @if(in_array($booking->status, ['approved', 'awaiting_payment', 'payment_uploaded']))
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 md:p-10">
                        <div class="flex items-center space-x-4 mb-8">
                            <div class="p-3 bg-green-50 text-green-600 rounded-2xl">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"/></svg>
                            </div>
                            <div>
                                <h2 class="text-2xl font-black text-gray-900">Pembayaran</h2>
                                <p class="text-gray-500 font-medium text-sm">Metode transfer bank & konfirmasi</p>
                            </div>
                        </div>

                        @if($booking->status === 'payment_uploaded')
                            <div class="bg-yellow-50 border border-yellow-100 rounded-3xl p-8 text-center">
                                <div class="w-16 h-16 bg-yellow-100 text-yellow-600 rounded-full flex items-center justify-center mx-auto mb-4">
                                    <i class="fas fa-hourglass-half text-2xl animate-pulse"></i>
                                </div>
                                <h3 class="text-xl font-black text-yellow-900 mb-2">Sedang Diverifikasi</h3>
                                <p class="text-yellow-700 font-medium max-w-md mx-auto">
                                    Bukti pembayaran Anda telah kami terima dan sedang dalam proses verifikasi oleh tim keuangan kami.
                                </p>
                            </div>
                        @else
                            <form action="{{ route('payment.store') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                                <input type="hidden" name="payment_amount" value="{{ $booking->total_amount }}">
                                <input type="hidden" name="payment_date" value="{{ now()->format('Y-m-d H:i:s') }}">
                                
                                <!-- Step info -->
                                <div class="p-6 bg-blue-600 rounded-3xl text-white relative overflow-hidden group">
                                    <div class="relative z-10">
                                        <p class="text-blue-100 text-xs font-bold uppercase tracking-widest mb-1">Total Bayar</p>
                                        <h3 class="text-4xl font-black mb-4">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</h3>
                                        <p class="text-blue-100 text-sm font-medium leading-relaxed">
                                            Silakan transfer tepat sesuai nominal di atas ke salah satu rekening resmi kami di bawah ini.
                                        </p>
                                    </div>
                                    <svg class="absolute -right-8 -bottom-8 w-48 h-48 text-white/10 group-hover:scale-110 transition-transform duration-700" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-6h2v6zm0-8h-2V7h2v2z"/></svg>
                                </div>

                                <!-- Bank List (Now inside form) -->
                                <div class="space-y-3">
                                    <label class="text-sm font-black text-gray-700 uppercase tracking-widest">Pilih Bank Tujuan Transfer</label>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        @php
                                            $banks = \App\Models\PaymentConfirmation::BANK_ACCOUNTS;
                                        @endphp
                                        @foreach($banks as $bankKey => $bank)
                                            <label class="bank-option p-6 border-2 rounded-3xl cursor-pointer transition-all duration-300 block
                                                {{ $loop->first ? 'border-blue-500 bg-blue-50/50' : 'border-gray-100 bg-gray-50/50 hover:bg-white hover:shadow-xl hover:border-blue-100' }}"
                                                for="destination_bank_{{ $bankKey }}">
                                                <input type="radio" name="destination_bank" id="destination_bank_{{ $bankKey }}" value="{{ $bankKey }}" {{ $loop->first ? 'checked' : '' }} class="hidden bank-radio" required>
                                                <div class="flex justify-between items-start mb-4">
                                                    <div class="flex items-center gap-3">
                                                        <span class="w-5 h-5 rounded-full border-2 border-gray-300 flex items-center justify-center bank-radio-indicator">
                                                            <span class="w-3 h-3 rounded-full bank-radio-dot {{ $loop->first ? 'bg-blue-500' : '' }}"></span>
                                                        </span>
                                                        <span class="px-3 py-1 bg-blue-100 text-blue-600 rounded-lg text-[10px] font-black uppercase">{{ $bank['name'] }}</span>
                                                    </div>
                                                    <i class="fas fa-university text-gray-300"></i>
                                                </div>
                                                <p class="text-xl font-black text-gray-900 mb-1 copy-target">{{ $bank['account_number'] }}</p>
                                                <p class="text-xs font-bold text-gray-500 uppercase tracking-widest">{{ $bank['account_holder'] }}</p>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>

                                <!-- Sender Info Section -->
                                <div class="space-y-6 pt-6 border-t border-gray-100">
                                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                                        <div class="space-y-2">
                                            <label class="text-sm font-black text-gray-700 uppercase tracking-widest">Bank Pengirim</label>
                                            <input type="text" name="sender_bank_name" placeholder="Misal: BCA, BNI, BRI" required
                                                   class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none font-bold">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-sm font-black text-gray-700 uppercase tracking-widest">Nomor Rekening</label>
                                            <input type="text" name="sender_account_number" placeholder="Contoh: 1234567890" required
                                                   class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none font-bold">
                                        </div>
                                        <div class="space-y-2">
                                            <label class="text-sm font-black text-gray-700 uppercase tracking-widest">Atas Nama Rekening</label>
                                            <input type="text" name="sender_account_holder" placeholder="Nama sesuai buku tabungan" required
                                                   class="w-full px-6 py-4 bg-gray-50 border border-gray-100 rounded-2xl focus:ring-4 focus:ring-blue-100 focus:border-blue-500 transition-all outline-none font-bold">
                                        </div>
                                    </div>

                                    <div class="space-y-2">
                                        <label class="text-sm font-black text-gray-700 uppercase tracking-widest">Unggah Bukti Transfer</label>
                                        <div class="relative group">
                                            <input type="file" name="payment_proof" id="payment_proof" class="hidden" accept="image/*,.pdf" required>
                                            <label for="payment_proof" class="flex flex-col items-center justify-center border-2 border-dashed border-gray-200 rounded-[2rem] p-10 hover:bg-blue-50/50 hover:border-blue-400 cursor-pointer transition-all duration-300">
                                                <div class="w-16 h-16 bg-blue-50 text-blue-600 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"/></svg>
                                                </div>
                                                <p class="text-lg font-black text-gray-900 mb-1">Klik untuk pilih file</p>
                                                <p class="text-sm text-gray-500 font-medium">PNG, JPG, JPEG atau PDF (Maks. 2MB)</p>
                                                <div id="file-name" class="mt-4 px-4 py-2 bg-blue-100 text-blue-700 rounded-full text-xs font-bold hidden"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="w-full bg-blue-600 text-white font-black py-5 rounded-[2rem] shadow-xl shadow-blue-200 hover:bg-blue-700 hover:-translate-y-1 transition-all duration-300 flex items-center justify-center gap-3">
                                    <i class="fas fa-paper-plane"></i>
                                    Konfirmasi Pembayaran Sekarang
                                </button>
                            </form>
                        @endif
                    </div>
                @endif

                @if($booking->status === 'pending')
                    <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 flex flex-col md:flex-row items-center justify-between gap-6">
                        <div>
                            <h3 class="text-xl font-black text-gray-900 mb-1">Ingin Merubah Rencana?</h3>
                            <p class="text-gray-500 font-medium">Anda masih bisa membatalkan pesanan ini karena belum dikonfirmasi.</p>
                        </div>
                        <form action="{{ route('booking.cancel', $booking->booking_id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin membatalkan pesanan ini?')">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="px-8 py-4 border-2 border-red-100 text-red-600 font-black rounded-2xl hover:bg-red-50 transition-colors flex items-center gap-3">
                                <i class="fas fa-times"></i>
                                Batalkan Pesanan
                            </button>
                        </form>
                    </div>
                @endif

                {{-- Selected Options Detail Card --}}
                @if($booking->selected_options && count($booking->selected_options) > 0)
                <div class="bg-white rounded-[2rem] shadow-sm border border-gray-100 p-8 md:p-10">
                    <div class="flex items-center space-x-4 mb-6">
                        <div class="p-3 bg-amber-50 text-amber-600 rounded-2xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        </div>
                        <div>
                            <h2 class="text-2xl font-black text-gray-900">Layanan Tambahan Dipilih</h2>
                            <p class="text-gray-500 font-medium text-sm">Harga opsional yang Anda tambahkan pada booking ini</p>
                        </div>
                    </div>

                    <div class="space-y-3">
                        @foreach($booking->selected_options as $opt)
                        <div class="flex items-center justify-between p-5 bg-amber-50 border-2 border-amber-100 rounded-2xl">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-amber-100 text-amber-600 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/></svg>
                                </div>
                                <div>
                                    <p class="font-bold text-amber-900">{{ $opt['type'] }}</p>
                                    <p class="text-xs text-amber-600">Rp {{ number_format($opt['price_per_person'] ?? 0, 0, ',', '.') }} × {{ $booking->jumlah_peserta }} orang</p>
                                </div>
                            </div>
                            <p class="font-black text-amber-700 text-lg">Rp {{ number_format($opt['total_price'] ?? 0, 0, ',', '.') }}</p>
                        </div>
                        @endforeach

                        <div class="flex justify-between items-center px-5 py-4 bg-amber-100 rounded-2xl mt-2">
                            <span class="font-black text-amber-900 text-sm uppercase tracking-widest">Total Biaya Tambahan</span>
                            <span class="font-black text-amber-700 text-xl">Rp {{ number_format($booking->options_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Right Side: Sidebar -->
            <div class="lg:col-span-4 space-y-8">
                <!-- Summary Card -->
                <div class="bg-white rounded-[2rem] shadow-xl border border-gray-100 overflow-hidden sticky top-8">
                    <div class="p-8 border-b border-gray-50">
                        <h3 class="text-xl font-black text-gray-900">Rincian Biaya</h3>
                    </div>
                    <div class="p-8 space-y-6">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-500 font-bold uppercase tracking-widest text-[10px]">Harga Paket x {{ $booking->jumlah_peserta }}</span>
                            <span class="text-gray-900 font-black">Rp {{ number_format($booking->original_amount, 0, ',', '.') }}</span>
                        </div>
                        
                        @if($booking->discount_amount > 0)
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-green-600 font-bold uppercase tracking-widest text-[10px]">Diskon Promo{{ $booking->specialOffer ? ' (' . $booking->specialOffer->discount_percentage . '%)' : '' }}</span>
                                <span class="text-green-600 font-black">-Rp {{ number_format($booking->discount_amount, 0, ',', '.') }}</span>
                            </div>
                        @endif

                        @if($booking->options_amount > 0)
                            <div class="flex justify-between items-center text-sm">
                                <span class="text-amber-600 font-bold uppercase tracking-widest text-[10px]">Biaya Tambahan Opsional</span>
                                <span class="text-amber-600 font-black">+Rp {{ number_format($booking->options_amount, 0, ',', '.') }}</span>
                            </div>
                            @if($booking->selected_options && count($booking->selected_options) > 0)
                                <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 space-y-2">
                                    @foreach($booking->selected_options as $opt)
                                        <div class="flex justify-between items-center text-xs">
                                            <span class="text-amber-800 font-bold flex items-center gap-1">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"/></svg>
                                                {{ $opt['type'] }}
                                            </span>
                                            <span class="text-amber-700 font-black">Rp {{ number_format($opt['total_price'] ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        @endif

                        <div class="flex justify-between items-center text-sm border-t border-dashed border-gray-100 pt-4">
                            <span class="text-gray-900 font-bold uppercase tracking-widest text-[10px]">
                                Subtotal Paket{{ $booking->options_amount > 0 ? ' + Tambahan' : '' }}
                            </span>
                            <span class="text-gray-900 font-black">{{ $booking->formatted_total_amount }}</span>
                        </div>



                        <div class="pt-6 border-t border-gray-100">
                            <div class="flex justify-between items-center">
                                <div>
                                    <p class="text-[10px] font-black text-gray-400 uppercase tracking-widest mb-1">Total Pembayaran</p>
                                    <p class="text-3xl font-black text-blue-600">{{ $booking->formatted_total_amount }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-3 pt-4">
                            @if($booking->invoice && in_array($booking->status, ['confirmed', 'completed']))
                                <a href="{{ route('invoice.view', $booking->invoice->invoice_id) }}" target="_blank" class="w-full py-4 bg-gray-900 text-white rounded-2xl flex items-center justify-center gap-3 font-black text-sm hover:bg-black transition-colors">
                                    <i class="fas fa-eye"></i>
                                    Lihat Invoice Online
                                </a>
                            @endif
                            <button onclick="sendInvoiceToWhatsApp({{ $booking->invoice?->invoice_id ?? '0' }})" class="w-full py-4 border-2 border-[#25D366]/20 text-[#25D366] rounded-2xl flex items-center justify-center gap-3 font-black text-sm hover:bg-[#25D366]/5 transition-colors">
                                <i class="fab fa-whatsapp text-lg"></i>
                                Tanya CS Kami
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Trust Badges -->
                <div class="grid grid-cols-2 gap-4">
                    <div class="bg-gray-50 rounded-2xl p-4 text-center border border-gray-100">
                        <i class="fas fa-shield-alt text-blue-600 mb-2"></i>
                        <p class="text-[10px] font-black text-gray-900 uppercase">Aman & Terpercaya</p>
                    </div>
                    <div class="bg-gray-50 rounded-2xl p-4 text-center border border-gray-100">
                        <i class="fas fa-bolt text-yellow-500 mb-2"></i>
                        <p class="text-[10px] font-black text-gray-900 uppercase">Konfirmasi Cepat</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // File upload preview
        const fileInput = document.getElementById('payment_proof');
        const fileNameDisplay = document.getElementById('file-name');
        
        if (fileInput) {
            fileInput.addEventListener('change', function() {
                if (this.files && this.files.length > 0) {
                    fileNameDisplay.textContent = 'Terpilih: ' + this.files[0].name;
                    fileNameDisplay.classList.remove('hidden');
                } else {
                    fileNameDisplay.classList.add('hidden');
                }
            });
        }

        // Initialize bank selection on page load
        updateBankSelection();
    });

    // Function to update bank selection visual state
    function updateBankSelection() {
        const bankCards = document.querySelectorAll('.bank-option');
        
        bankCards.forEach(card => {
            const radio = card.querySelector('.bank-radio');
            const dot = card.querySelector('.bank-radio-dot');
            
            if (radio && radio.checked) {
                card.classList.remove('border-gray-100', 'bg-gray-50/50');
                card.classList.add('border-blue-500', 'bg-blue-50/50');
                if (dot) dot.classList.add('bg-blue-500');
            } else {
                card.classList.remove('border-blue-500', 'bg-blue-50/50');
                card.classList.add('border-gray-100', 'bg-gray-50/50');
                if (dot) dot.classList.remove('bg-blue-500');
            }
        });
    }

    // Add event listeners for bank radio buttons
    document.querySelectorAll('.bank-radio').forEach(radio => {
        radio.addEventListener('change', updateBankSelection);
    });

    // Function to send invoice to WhatsApp admin
    function sendInvoiceToWhatsApp(invoiceId) {
        if (!invoiceId || invoiceId === '0') {
             // Fallback to general CS if no invoice
             window.open('https://wa.me/6282266478147?text=' + encodeURIComponent('Halo Admin JustTrip, saya ingin bertanya tentang booking #{{ $booking->booking_id }}. Bisakah Anda membantu saya?'), '_blank');
             return;
        }

        if (confirm('Apakah Anda yakin ingin mengirim invoice ini ke WhatsApp admin?')) {
            const button = event.currentTarget;
            const originalText = button.innerHTML;
            button.disabled = true;
            button.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Mengirim...';
            
            fetch(`/invoice/${invoiceId}/send-whatsapp`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: 'Invoice berhasil dikirim ke WhatsApp admin.',
                        confirmButtonColor: '#3085d6'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Gagal!',
                        text: data.message || 'Terjadi kesalahan saat mengirim invoice.',
                        confirmButtonColor: '#d33'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Terjadi kesalahan sistem. Silakan coba lagi.',
                    confirmButtonColor: '#d33'
                });
            })
            .finally(() => {
                if(button) {
                    button.disabled = false;
                    button.innerHTML = originalText;
                }
            });
        }
    }
</script>
@endpush
