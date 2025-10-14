@extends('Frontend.layouts.main')

@section('container')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <div class="max-w-2xl mx-auto">
            <!-- Success Icon -->
            <div class="text-center mb-8">
                <div class="w-24 h-24 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-check text-green-500 text-4xl"></i>
                </div>
                
                <h1 class="text-3xl font-bold text-gray-800 mb-4">
                    @if($guestBooking->is_custom_request)
                        Permintaan Khusus Berhasil Dikirim!
                    @else
                        Booking Berhasil Dikirim!
                    @endif
                </h1>
                
                <p class="text-gray-600 text-lg">
                    Terima kasih {{ $guestBooking->nama_lengkap }}! 
                    @if($guestBooking->is_custom_request)
                        Permintaan khusus Anda telah kami terima dan akan segera diproses.
                    @else
                        Booking Anda telah kami terima dan akan segera diproses.
                    @endif
                </p>
            </div>

            <!-- Booking Details -->
            <div class="bg-white rounded-xl shadow-lg p-8 mb-8">
                <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-receipt text-blue-500 mr-3"></i>
                    Detail Booking
                </h2>
                
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Nomor Booking</label>
                        <p class="text-lg font-bold text-blue-600">{{ $guestBooking->booking_number }}</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Status</label>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                            <i class="fas fa-clock mr-1"></i>
                            Menunggu Konfirmasi
                        </span>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Destinasi</label>
                        <p class="text-gray-800">{{ $guestBooking->destinasi_dicari }}</p>
                    </div>
                    
                    @if(!$guestBooking->is_custom_request && $guestBooking->layanan)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Paket Dipilih</label>
                            <p class="text-gray-800">{{ $guestBooking->layanan->nama_layanan }}</p>
                        </div>
                    @endif
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Jumlah Peserta</label>
                        <p class="text-gray-800">{{ $guestBooking->jumlah_peserta }} orang</p>
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Diinginkan</label>
                        <p class="text-gray-800">{{ \Carbon\Carbon::parse($guestBooking->tanggal_keberangkatan_diinginkan)->format('d F Y') }}</p>
                    </div>
                    
                    @if($guestBooking->budget_estimasi)
                        <div>
                            <label class="block text-sm font-medium text-gray-500 mb-1">Budget Estimasi</label>
                            <p class="text-gray-800">{{ $guestBooking->budget_estimasi }}</p>
                        </div>
                    @endif
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-500 mb-1">Tanggal Booking</label>
                        <p class="text-gray-800">{{ $guestBooking->created_at->format('d F Y, H:i') }}</p>
                    </div>
                </div>
                
                @if($guestBooking->catatan_khusus)
                    <div class="mt-6 pt-6 border-t">
                        <label class="block text-sm font-medium text-gray-500 mb-2">Catatan Khusus</label>
                        <p class="text-gray-800 bg-gray-50 p-4 rounded-lg">{{ $guestBooking->catatan_khusus }}</p>
                    </div>
                @endif
            </div>

            <!-- Next Steps -->
            <div class="bg-blue-50 border border-blue-200 rounded-xl p-6 mb-8">
                <h3 class="text-lg font-bold text-blue-800 mb-4 flex items-center">
                    <i class="fas fa-info-circle mr-2"></i>
                    Langkah Selanjutnya
                </h3>
                
                <div class="space-y-3">
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5">1</div>
                        <div>
                            <p class="text-blue-800 font-medium">Email Konfirmasi</p>
                            <p class="text-blue-700 text-sm">Kami telah mengirim email konfirmasi ke <strong>{{ $guestBooking->email }}</strong></p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5">2</div>
                        <div>
                            <p class="text-blue-800 font-medium">Tim Kami Akan Menghubungi</p>
                            <p class="text-blue-700 text-sm">Dalam 1x24 jam, tim kami akan menghubungi Anda melalui WhatsApp atau telepon</p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5">3</div>
                        <div>
                            <p class="text-blue-800 font-medium">Diskusi Detail</p>
                            <p class="text-blue-700 text-sm">
                                @if($guestBooking->is_custom_request)
                                    Kami akan membahas detail itinerary, harga, dan kebutuhan khusus Anda
                                @else
                                    Kami akan mengkonfirmasi detail booking dan membahas pembayaran
                                @endif
                            </p>
                        </div>
                    </div>
                    
                    <div class="flex items-start">
                        <div class="w-6 h-6 bg-blue-500 text-white rounded-full flex items-center justify-center text-xs font-bold mr-3 mt-0.5">4</div>
                        <div>
                            <p class="text-blue-800 font-medium">Finalisasi & Pembayaran</p>
                            <p class="text-blue-700 text-sm">Setelah semua detail disepakati, Anda dapat melakukan pembayaran</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Contact Info -->
            <div class="bg-white rounded-xl shadow-lg p-6 mb-8">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Butuh Bantuan?</h3>
                
                <div class="grid md:grid-cols-2 gap-4">
                    <div class="flex items-center p-4 bg-green-50 rounded-lg">
                        <i class="fab fa-whatsapp text-green-500 text-2xl mr-3"></i>
                        <div>
                            <p class="font-medium text-gray-800">WhatsApp</p>
                            <p class="text-sm text-gray-600">+62 812-3456-7890</p>
                        </div>
                    </div>
                    
                    <div class="flex items-center p-4 bg-blue-50 rounded-lg">
                        <i class="fas fa-envelope text-blue-500 text-2xl mr-3"></i>
                        <div>
                            <p class="font-medium text-gray-800">Email</p>
                            <p class="text-sm text-gray-600">info@justtrip.com</p>
                        </div>
                    </div>
                </div>
                
                <p class="text-sm text-gray-600 mt-4 text-center">
                    Simpan nomor booking <strong>{{ $guestBooking->booking_number }}</strong> untuk referensi komunikasi dengan tim kami.
                </p>
            </div>

            <!-- Action Buttons -->
            <div class="text-center space-y-4">
                <a href="{{ route('guest-booking.index') }}" 
                   class="inline-flex items-center bg-blue-500 hover:bg-blue-600 text-white font-medium py-3 px-6 rounded-lg transition-colors">
                    <i class="fas fa-search mr-2"></i>
                    Cari Destinasi Lain
                </a>
                
                <div>
                    <button onclick="window.print()" 
                            class="inline-flex items-center text-gray-600 hover:text-blue-500 transition-colors">
                        <i class="fas fa-print mr-2"></i>
                        Cetak Halaman Ini
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
@media print {
    .no-print {
        display: none !important;
    }
    
    body {
        background: white !important;
    }
    
    .bg-gray-50 {
        background: white !important;
    }
    
    .shadow-lg {
        box-shadow: none !important;
        border: 1px solid #e5e7eb !important;
    }
}
</style>
@endsection