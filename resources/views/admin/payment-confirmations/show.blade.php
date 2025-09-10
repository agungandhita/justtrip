@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Breadcrumb -->
        <nav class="flex mb-8 px-4" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('admin.dashboard') }}" class="inline-flex items-center text-sm font-medium text-gray-700 hover:text-primary-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10.707 2.293a1 1 0 00-1.414 0l-7 7a1 1 0 001.414 1.414L4 10.414V17a1 1 0 001 1h2a1 1 0 001-1v-2a1 1 0 011-1h2a1 1 0 011 1v2a1 1 0 001 1h2a1 1 0 001-1v-6.586l.293.293a1 1 0 001.414-1.414l-7-7z"></path></svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <a href="{{ route('admin.payment-confirmations.index') }}" class="ml-1 text-gray-700 hover:text-primary-600 md:ml-2 dark:text-gray-300 dark:hover:text-white">Konfirmasi Pembayaran</a>
                    </div>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-6 h-6 text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd"></path></svg>
                        <span class="ml-1 text-gray-400 md:ml-2 dark:text-gray-500" aria-current="page">{{ $paymentConfirmation->booking->booking_number }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        <!-- Header -->
        <div class="flex items-center justify-between mb-8 px-4">
            <div>
                <h1 class="text-3xl font-bold text-gray-800">Detail Konfirmasi Pembayaran</h1>
                <p class="text-gray-600 mt-1">Booking {{ $paymentConfirmation->booking->booking_number }}</p>
            </div>
            <div class="flex space-x-3">
                @if($paymentConfirmation->status === 'pending')
                    <button onclick="approvePayment({{ $paymentConfirmation->payment_confirmation_id }})" 
                            class="bg-green-600 text-white px-6 py-2.5 rounded-lg hover:bg-green-700 transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z"/>
                        </svg>
                        Setujui Pembayaran
                    </button>
                    <button onclick="rejectPayment({{ $paymentConfirmation->payment_confirmation_id }})" 
                            class="bg-red-600 text-white px-6 py-2.5 rounded-lg hover:bg-red-700 transition-colors flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M14.5,9L13.09,7.59L12,8.67L10.91,7.59L9.5,9L10.59,10.09L9.5,11.17L10.91,12.59L12,11.5L13.09,12.59L14.5,11.17L13.41,10.09L14.5,9Z"/>
                        </svg>
                        Tolak Pembayaran
                    </button>
                @endif
                <a href="{{ route('admin.payment-confirmations.download-proof', $paymentConfirmation) }}" 
                   class="bg-blue-600 text-white px-6 py-2.5 rounded-lg hover:bg-blue-700 transition-colors flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                    </svg>
                    Download Bukti
                </a>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 px-4">
            <!-- Payment Confirmation Details -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Status Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Status Konfirmasi</h3>
                    <div class="flex items-center justify-between">
                        <div>
                            @if($paymentConfirmation->status === 'pending')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-yellow-100 text-yellow-800">
                                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,8V12L14.5,14.5L13.08,15.92L10,12.83V8H12Z"/>
                                    </svg>
                                    Menunggu Verifikasi
                                </span>
                            @elseif($paymentConfirmation->status === 'approved')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-green-100 text-green-800">
                                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z"/>
                                    </svg>
                                    Disetujui
                                </span>
                            @elseif($paymentConfirmation->status === 'rejected')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-red-100 text-red-800">
                                    <svg class="w-4 h-4 mr-2" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M14.5,9L13.09,7.59L12,8.67L10.91,7.59L9.5,9L10.59,10.09L9.5,11.17L10.91,12.59L12,11.5L13.09,12.59L14.5,11.17L13.41,10.09L14.5,9Z"/>
                                    </svg>
                                    Ditolak
                                </span>
                            @endif
                        </div>
                        <div class="text-right text-sm text-gray-500">
                            <div>Upload: {{ $paymentConfirmation->created_at->format('d M Y H:i') }}</div>
                            @if($paymentConfirmation->processed_at)
                                <div>Diproses: {{ $paymentConfirmation->processed_at->format('d M Y H:i') }}</div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Payment Details -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Detail Pembayaran</h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-6">
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Metode Pembayaran:</span>
                                <span class="text-sm font-medium text-gray-900">{{ ucfirst(str_replace('_', ' ', $paymentConfirmation->payment_method)) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Jumlah Pembayaran:</span>
                                <span class="text-sm font-medium text-gray-900">Rp {{ number_format($paymentConfirmation->payment_amount, 0, ',', '.') }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Tanggal Pembayaran:</span>
                                <span class="text-sm font-medium text-gray-900">{{ \Carbon\Carbon::parse($paymentConfirmation->payment_date)->format('d M Y') }}</span>
                            </div>
                        </div>
                        
                        @if($paymentConfirmation->payment_method === 'bank_transfer')
                            <div class="space-y-3">
                                @if($paymentConfirmation->bank_name)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Nama Bank:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->bank_name }}</span>
                                    </div>
                                @endif
                                @if($paymentConfirmation->account_number)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">No. Rekening:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->account_number }}</span>
                                    </div>
                                @endif
                                @if($paymentConfirmation->account_holder_name)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Nama Pemilik:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->account_holder_name }}</span>
                                    </div>
                                @endif
                            </div>
                        @elseif($paymentConfirmation->payment_method === 'e_wallet')
                            <div class="space-y-3">
                                @if($paymentConfirmation->e_wallet_type)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">Jenis E-Wallet:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->e_wallet_type }}</span>
                                    </div>
                                @endif
                                @if($paymentConfirmation->e_wallet_number)
                                    <div class="flex justify-between">
                                        <span class="text-sm text-gray-600">No. E-Wallet:</span>
                                        <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->e_wallet_number }}</span>
                                    </div>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Payment Proof -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Bukti Pembayaran</h3>
                    <div class="space-y-4">
                        @if($paymentConfirmation->payment_proof_path)
                            @php
                                $fileExtension = pathinfo($paymentConfirmation->payment_proof_path, PATHINFO_EXTENSION);
                                $isImage = in_array(strtolower($fileExtension), ['jpg', 'jpeg', 'png', 'gif']);
                            @endphp
                            
                            @if($isImage)
                                <div class="border rounded-lg overflow-hidden">
                                    <img src="{{ Storage::url($paymentConfirmation->payment_proof_path) }}" 
                                         alt="Bukti Pembayaran" 
                                         class="w-full h-auto max-h-96 object-contain">
                                </div>
                            @else
                                <div class="border-2 border-dashed border-gray-300 rounded-lg p-8 text-center">
                                    <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                    </svg>
                                    <p class="text-gray-600 font-medium">File PDF</p>
                                    <p class="text-sm text-gray-500">Klik tombol download untuk melihat file</p>
                                </div>
                            @endif
                        @endif
                        
                        @if($paymentConfirmation->payment_notes)
                            <div class="bg-gray-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-gray-700 mb-2">Catatan Customer:</h4>
                                <p class="text-sm text-gray-600">{{ $paymentConfirmation->payment_notes }}</p>
                            </div>
                        @endif
                        
                        @if($paymentConfirmation->admin_notes)
                            <div class="bg-blue-50 rounded-lg p-4">
                                <h4 class="text-sm font-medium text-blue-700 mb-2">Catatan Admin:</h4>
                                <p class="text-sm text-blue-600">{{ $paymentConfirmation->admin_notes }}</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Booking Information -->
            <div class="space-y-8">
                <!-- Booking Details -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Booking</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Nomor Booking:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->booking->booking_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Status Booking:</span>
                            <span class="text-sm font-medium text-gray-900">{{ ucfirst($paymentConfirmation->booking->status) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Tanggal Booking:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->booking->booking_date->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Tanggal Keberangkatan:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->booking->tanggal_keberangkatan->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-sm text-gray-600">Jumlah Peserta:</span>
                            <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->booking->jumlah_peserta }} orang</span>
                        </div>
                        <div class="flex justify-between border-t pt-3">
                            <span class="text-sm font-medium text-gray-900">Total Pembayaran:</span>
                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($paymentConfirmation->booking->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Customer Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Customer</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-600">Nama:</span>
                            <p class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->booking->user->name }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Email:</span>
                            <p class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->booking->user->email }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">No. Telepon:</span>
                            <p class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->booking->user->phone ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Service Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Layanan</h3>
                    <div class="space-y-3">
                        <div>
                            <span class="text-sm text-gray-600">Layanan:</span>
                            <p class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->booking->layanan->nama_layanan }}</p>
                        </div>
                        <div>
                            <span class="text-sm text-gray-600">Destinasi:</span>
                            <p class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->booking->layanan->destinasi }}</p>
                        </div>
                        @if($paymentConfirmation->booking->specialOffer)
                            <div>
                                <span class="text-sm text-gray-600">Special Offer:</span>
                                <p class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->booking->specialOffer->title }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Invoice Information -->
                @if($paymentConfirmation->invoice)
                    <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                        <h3 class="text-lg font-semibold text-gray-900 mb-4">Informasi Invoice</h3>
                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Nomor Invoice:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->invoice->invoice_number }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Status Invoice:</span>
                                <span class="text-sm font-medium text-gray-900">{{ ucfirst($paymentConfirmation->invoice->status) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-sm text-gray-600">Tanggal Invoice:</span>
                                <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->invoice->created_at->format('d M Y') }}</span>
                            </div>
                            @if($paymentConfirmation->invoice->paid_at)
                                <div class="flex justify-between">
                                    <span class="text-sm text-gray-600">Tanggal Bayar:</span>
                                    <span class="text-sm font-medium text-gray-900">{{ $paymentConfirmation->invoice->paid_at->format('d M Y H:i') }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Approve Modal -->
    <div id="approveModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Setujui Pembayaran</h3>
                    <button onclick="closeApproveModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form id="approveForm" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-4">
                        <label for="approve_admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Catatan Admin (Opsional)</label>
                        <textarea id="approve_admin_notes" 
                                  name="admin_notes" 
                                  rows="3" 
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-green-500 focus:ring-green-500"
                                  placeholder="Tambahkan catatan untuk customer..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeApproveModal()" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-green-600 border border-transparent rounded-md hover:bg-green-700">
                            Setujui Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Reject Modal -->
    <div id="rejectModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Tolak Pembayaran</h3>
                    <button onclick="closeRejectModal()" class="text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                
                <form id="rejectForm" method="POST">
                    @csrf
                    @method('PATCH')
                    
                    <div class="mb-4">
                        <label for="reject_admin_notes" class="block text-sm font-medium text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                        <textarea id="reject_admin_notes" 
                                  name="admin_notes" 
                                  rows="3" 
                                  required
                                  class="w-full rounded-md border-gray-300 shadow-sm focus:border-red-500 focus:ring-red-500"
                                  placeholder="Jelaskan alasan penolakan pembayaran..."></textarea>
                    </div>
                    
                    <div class="flex justify-end space-x-3">
                        <button type="button" 
                                onclick="closeRejectModal()" 
                                class="px-4 py-2 text-sm font-medium text-gray-700 bg-gray-100 border border-gray-300 rounded-md hover:bg-gray-200">
                            Batal
                        </button>
                        <button type="submit" 
                                class="px-4 py-2 text-sm font-medium text-white bg-red-600 border border-transparent rounded-md hover:bg-red-700">
                            Tolak Pembayaran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function approvePayment(confirmationId) {
            document.getElementById('approveForm').action = `/admin/payment-confirmations/${confirmationId}/approve`;
            document.getElementById('approveModal').classList.remove('hidden');
        }

        function rejectPayment(confirmationId) {
            document.getElementById('rejectForm').action = `/admin/payment-confirmations/${confirmationId}/reject`;
            document.getElementById('rejectModal').classList.remove('hidden');
        }

        function closeApproveModal() {
            document.getElementById('approveModal').classList.add('hidden');
            document.getElementById('approve_admin_notes').value = '';
        }

        function closeRejectModal() {
            document.getElementById('rejectModal').classList.add('hidden');
            document.getElementById('reject_admin_notes').value = '';
        }

        // Close modals when clicking outside
        window.onclick = function(event) {
            const approveModal = document.getElementById('approveModal');
            const rejectModal = document.getElementById('rejectModal');
            
            if (event.target === approveModal) {
                closeApproveModal();
            }
            if (event.target === rejectModal) {
                closeRejectModal();
            }
        }
    </script>
@endsection