@extends('admin.layouts.main')

@section('container')
<div class="p-4 bg-white block sm:flex items-center justify-between border-b border-gray-200 lg:mt-1.5 dark:bg-gray-800 dark:border-gray-700">
    <div class="w-full mb-1">
        <div class="mb-4">
            <nav class="flex mb-5" aria-label="Breadcrumb">
                <ol class="inline-flex items-center space-x-1 text-sm font-medium md:space-x-2">
                    <li class="inline-flex items-center">
                        <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-gray-700 hover:text-primary-600 dark:text-gray-300 dark:hover:text-white">
                            <svg class="w-5 h-5 mr-2.5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <a href="{{ route('admin.bookings.index') }}" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Manajemen Booking</a>
                        </div>
                    </li>
                    <li>
                        <div class="flex items-center">
                            <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                            <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">{{ $booking->booking_number }}</span>
                        </div>
                    </li>
                </ol>
            </nav>
            <div class="flex items-center justify-between">
                <h1 class="text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">Detail Booking {{ $booking->booking_number }}</h1>
                <div class="flex space-x-2">
                    <a href="{{ route('admin.bookings.edit', $booking) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                        Edit Booking
                    </a>
                    @if($booking->invoice)
                        <a href="{{ route('admin.invoices.show', $booking->invoice) }}" class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-gray-900 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:ring-4 focus:ring-primary-300 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"></path></svg>
                            Lihat Invoice
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mb-6">
    <!-- Main Booking Information -->
    <div class="lg:col-span-2">
        <!-- Booking Details Card -->
        <div class="bg-white shadow rounded-lg p-6 mb-6 dark:bg-gray-800">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-medium text-gray-900 dark:text-white">Informasi Booking</h3>
                <span class="bg-{{ $booking->status_color }}-100 text-{{ $booking->status_color }}-800 text-sm font-medium px-3 py-1 rounded-full dark:bg-{{ $booking->status_color }}-900 dark:text-{{ $booking->status_color }}-300">
                    {{ $booking->status_label }}
                </span>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Detail Booking</h4>
                    <dl class="space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Booking Number:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->booking_number }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Tanggal Booking:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->formatted_booking_date }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Tanggal Keberangkatan:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->formatted_tanggal_keberangkatan }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Jumlah Peserta:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->jumlah_peserta }} orang</dd>
                        </div>
                    </dl>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Informasi Layanan</h4>
                    <dl class="space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Nama Layanan:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->layanan->nama_layanan }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Jenis Layanan:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->layanan->jenis_layanan }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Lokasi:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->layanan->lokasi }}</dd>
                        </div>
                        @if($booking->specialOffer)
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Special Offer:</dt>
                            <dd class="text-sm font-medium text-green-600 dark:text-green-400">{{ $booking->specialOffer->title }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
        
        <!-- Customer Information Card -->
        <div class="bg-white shadow rounded-lg p-6 mb-6 dark:bg-gray-800">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Informasi Customer</h3>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Data Akun</h4>
                    <dl class="space-y-2">
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Nama:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->user->name }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Email:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->user->email }}</dd>
                        </div>
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Bergabung:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->user->created_at->format('d M Y') }}</dd>
                        </div>
                    </dl>
                </div>
                
                <div>
                    <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Data Booking</h4>
                    <dl class="space-y-2">
                        @if(isset($booking->customer_info['nama']))
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Nama Lengkap:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->customer_info['nama'] }}</dd>
                        </div>
                        @endif
                        @if(isset($booking->customer_info['phone']))
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Telepon:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->customer_info['phone'] }}</dd>
                        </div>
                        @endif
                        @if(isset($booking->customer_info['alamat']))
                        <div class="flex justify-between">
                            <dt class="text-sm text-gray-500 dark:text-gray-400">Alamat:</dt>
                            <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->customer_info['alamat'] }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>
        </div>
        
        <!-- Notes Section -->
        @if($booking->catatan_khusus || $booking->admin_notes)
        <div class="bg-white shadow rounded-lg p-6 mb-6 dark:bg-gray-800">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Catatan</h3>
            
            @if($booking->catatan_khusus)
            <div class="mb-4">
                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Catatan Customer:</h4>
                <p class="text-sm text-gray-900 dark:text-white bg-gray-50 dark:bg-gray-700 p-3 rounded-lg">{{ $booking->catatan_khusus }}</p>
            </div>
            @endif
            
            @if($booking->admin_notes)
            <div>
                <h4 class="text-sm font-medium text-gray-500 dark:text-gray-400 mb-2">Catatan Admin:</h4>
                <div class="text-sm text-gray-900 dark:text-white bg-blue-50 dark:bg-blue-900/20 p-3 rounded-lg">
                    {!! nl2br(e($booking->admin_notes)) !!}
                </div>
            </div>
            @endif
        </div>
        @endif
        
        <!-- Audit Trail -->
        <div class="bg-white shadow rounded-lg p-6 dark:bg-gray-800">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Riwayat Perubahan</h3>
            
            <div class="flow-root">
                <ul role="list" class="-mb-8">
                    @foreach($auditTrail as $index => $log)
                    <li>
                        <div class="relative pb-8">
                            @if(!$loop->last)
                            <span class="absolute top-4 left-4 -ml-px h-full w-0.5 bg-gray-200 dark:bg-gray-600" aria-hidden="true"></span>
                            @endif
                            <div class="relative flex space-x-3">
                                <div>
                                    <span class="h-8 w-8 rounded-full bg-{{ $log['status'] === 'pending' ? 'yellow' : ($log['status'] === 'confirmed' ? 'green' : ($log['status'] === 'cancelled' ? 'red' : 'blue')) }}-500 flex items-center justify-center ring-8 ring-white dark:ring-gray-800">
                                        @if($log['action'] === 'created')
                                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                                            </svg>
                                        @elseif($log['action'] === 'confirmed')
                                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                            </svg>
                                        @elseif($log['action'] === 'cancelled')
                                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                            </svg>
                                        @else
                                            <svg class="h-5 w-5 text-white" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                            </svg>
                                        @endif
                                    </span>
                                </div>
                                <div class="min-w-0 flex-1 pt-1.5 flex justify-between space-x-4">
                                    <div>
                                        <p class="text-sm text-gray-500 dark:text-gray-400">{{ $log['description'] }} <span class="font-medium text-gray-900 dark:text-white">{{ $log['user'] }}</span></p>
                                        @if(isset($log['notes']) && $log['notes'])
                                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-300">{{ $log['notes'] }}</p>
                                        @endif
                                    </div>
                                    <div class="text-right text-sm whitespace-nowrap text-gray-500 dark:text-gray-400">
                                        <time datetime="{{ $log['timestamp']->toISOString() }}">{{ $log['timestamp']->format('d M Y, H:i') }}</time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Sidebar -->
    <div class="lg:col-span-1">
        <!-- Payment Information -->
        <div class="bg-white shadow rounded-lg p-6 mb-6 dark:bg-gray-800">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Informasi Pembayaran</h3>
            
            <dl class="space-y-3">
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500 dark:text-gray-400">Harga Asli:</dt>
                    <dd class="text-sm font-medium text-gray-900 dark:text-white">Rp {{ number_format($booking->original_amount, 0, ',', '.') }}</dd>
                </div>
                @if($booking->discount_amount > 0)
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500 dark:text-gray-400">Diskon:</dt>
                    <dd class="text-sm font-medium text-red-600 dark:text-red-400">-Rp {{ number_format($booking->discount_amount, 0, ',', '.') }}</dd>
                </div>
                @endif
                <div class="border-t border-gray-200 dark:border-gray-600 pt-3">
                    <div class="flex justify-between">
                        <dt class="text-base font-medium text-gray-900 dark:text-white">Total:</dt>
                        <dd class="text-base font-medium text-gray-900 dark:text-white">{{ $booking->formatted_total_amount }}</dd>
                    </div>
                </div>
            </dl>
        </div>
        
        <!-- Action Buttons -->
        <div class="bg-white shadow rounded-lg p-6 mb-6 dark:bg-gray-800">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Aksi</h3>
            
            <div class="space-y-3">
                @if($booking->status === 'pending')
                <button type="button" onclick="confirmBooking({{ $booking->booking_id }})" class="w-full inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md shadow-sm hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path></svg>
                    Konfirmasi Booking
                </button>
                @endif
                
                @if(in_array($booking->status, ['pending', 'confirmed']))
                <button type="button" onclick="rejectBooking({{ $booking->booking_id }})" class="w-full inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md shadow-sm hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    Tolak Booking
                </button>
                @endif
                
                @if($booking->status === 'confirmed')
                <button type="button" onclick="completeBooking({{ $booking->booking_id }})" class="w-full inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-white bg-blue-600 border border-transparent rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                    Selesaikan Booking
                </button>
                @endif
                
                <a href="{{ route('admin.bookings.edit', $booking) }}" class="w-full inline-flex justify-center items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z"></path></svg>
                    Edit Booking
                </a>
            </div>
        </div>
        
        <!-- Quick Stats -->
        <div class="bg-white shadow rounded-lg p-6 dark:bg-gray-800">
            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-4">Statistik Customer</h3>
            
            <dl class="space-y-3">
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500 dark:text-gray-400">Total Booking:</dt>
                    <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->user->bookings()->count() }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500 dark:text-gray-400">Booking Selesai:</dt>
                    <dd class="text-sm font-medium text-gray-900 dark:text-white">{{ $booking->user->bookings()->where('status', 'completed')->count() }}</dd>
                </div>
                <div class="flex justify-between">
                    <dt class="text-sm text-gray-500 dark:text-gray-400">Total Pengeluaran:</dt>
                    <dd class="text-sm font-medium text-gray-900 dark:text-white">Rp {{ number_format($booking->user->bookings()->whereIn('status', ['confirmed', 'completed'])->sum('total_amount'), 0, ',', '.') }}</dd>
                </div>
            </dl>
        </div>
    </div>
</div>

<!-- Include the same modals from index.blade.php -->
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
        if (event.target === modal) {
            closeModal(modalId);
        }
    });
});
</script>
@endpush
@endsection