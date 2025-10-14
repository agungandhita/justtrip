@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <a href="{{ route('admin.guest-bookings.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors duration-200">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20,11V13H8L13.5,18.5L12.08,19.92L4.16,12L12.08,4.08L13.5,5.5L8,11H20Z"/>
                            </svg>
                        </a>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Guest Booking #{{ $guestBooking->booking_number }}</h1>
                        @if($guestBooking->is_custom_request)
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-purple-100 text-purple-800">
                                Custom Request
                            </span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                Package Booking
                            </span>
                        @endif
                    </div>
                    <p class="text-gray-600 pl-9">Detail informasi guest booking</p>
                </div>
                <div class="flex gap-3">
                    <a href="{{ route('admin.guest-bookings.contact-whatsapp', $guestBooking) }}" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M17.472,14.382c-0.297-0.149-1.758-0.867-2.03-0.967c-0.273-0.099-0.471-0.148-0.67,0.15c-0.197,0.297-0.767,0.966-0.94,1.164c-0.173,0.199-0.347,0.223-0.644,0.075c-0.297-0.15-1.255-0.463-2.39-1.475c-0.883-0.788-1.48-1.761-1.653-2.059c-0.173-0.297-0.018-0.458,0.13-0.606c0.134-0.133,0.298-0.347,0.446-0.52c0.149-0.174,0.198-0.298,0.298-0.497c0.099-0.198,0.05-0.371-0.025-0.52C10.612,9.727,9.886,8.166,9.64,7.646c-0.238-0.505-0.479-0.437-0.658-0.445C8.804,7.193,8.606,7.193,8.408,7.193c-0.198,0-0.52,0.074-0.792,0.372C7.344,7.863,6.6,8.581,6.6,9.847c0,1.267,0.983,2.49,1.121,2.663c0.138,0.173,1.94,2.962,4.7,4.15c0.657,0.283,1.171,0.452,1.571,0.578c0.659,0.21,1.259,0.18,1.733,0.109c0.529-0.079,1.636-0.669,1.866-1.314c0.23-0.646,0.23-1.198,0.161-1.314C18.681,14.927,18.77,14.531,17.472,14.382z M12.057,21.785h-0.008c-1.849,0-3.66-0.497-5.263-1.428l-0.378-0.225l-3.918,1.028l1.042-3.807l-0.247-0.392c-1.022-1.625-1.562-3.506-1.561-5.438c0-5.632,4.581-10.213,10.213-10.213c2.728,0,5.292,1.063,7.215,2.991c1.925,1.928,2.985,4.486,2.984,7.214C22.273,17.195,17.692,21.785,12.057,21.785z M20.5,3.488C18.24,1.24,15.24,0.013,12.057,0C5.484,0,0.13,5.353,0.129,11.927c0,2.103,0.549,4.161,1.593,5.974L0,24l6.124-1.61c1.741,0.952,3.704,1.453,5.701,1.454h0.005c6.571,0,11.926-5.353,11.927-11.927C23.757,8.734,22.759,5.734,20.5,3.488z"/>
                        </svg>
                        Contact WhatsApp
                    </a>
                    <button onclick="openEmailModal()" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/>
                        </svg>
                        Send Email
                    </button>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 px-4">
            <!-- Main Content -->
            <div class="lg:col-span-2 space-y-8">
                <!-- Customer Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,4A4,4 0 0,1 16,8A4,4 0 0,1 12,12A4,4 0 0,1 8,8A4,4 0 0,1 12,4M12,14C16.42,14 20,15.79 20,18V20H4V18C4,15.79 7.58,14 12,14Z"/>
                        </svg>
                        Informasi Customer
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Nama Lengkap</label>
                            <p class="text-gray-900 font-medium">{{ $guestBooking->nama_lengkap }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <p class="text-gray-900">{{ $guestBooking->email }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">No. Telepon</label>
                            <p class="text-gray-900">{{ $guestBooking->nomor_telepon }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Kota</label>
                            <p class="text-gray-900">{{ $guestBooking->kota }}</p>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
                            <p class="text-gray-900">{{ $guestBooking->alamat }}</p>
                        </div>
                    </div>
                </div>

                <!-- Travel Information -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M2,21V19H4V17C4,14.24 6.24,12 9,12H15C17.76,12 20,14.24 20,17V19H22V21H20V20H4V21H2M9,2A4,4 0 0,1 13,6A4,4 0 0,1 9,10A4,4 0 0,1 5,6A4,4 0 0,1 9,2M15,2A4,4 0 0,1 19,6A4,4 0 0,1 15,10A4,4 0 0,1 11,6A4,4 0 0,1 15,2Z"/>
                        </svg>
                        Informasi Perjalanan
                    </h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Destinasi Dicari</label>
                            <p class="text-gray-900 font-medium">{{ $guestBooking->destinasi_dicari }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Jumlah Peserta</label>
                            <p class="text-gray-900">{{ $guestBooking->jumlah_peserta }} orang</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Tanggal Keberangkatan</label>
                            <p class="text-gray-900">{{ \Carbon\Carbon::parse($guestBooking->tanggal_keberangkatan_diinginkan)->format('d F Y') }}</p>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Estimasi Budget</label>
                            <p class="text-gray-900 font-medium text-green-600">
                                @if($guestBooking->budget_estimasi)
                                    Rp {{ number_format($guestBooking->budget_estimasi) }}
                                @else
                                    Tidak disebutkan
                                @endif
                            </p>
                        </div>
                        @if($guestBooking->layanan)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Paket Dipilih</label>
                                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4">
                                    <p class="text-blue-900 font-medium">{{ $guestBooking->layanan->nama_layanan }}</p>
                                    <p class="text-blue-700 text-sm">{{ $guestBooking->layanan->lokasi_tujuan }}</p>
                                    <p class="text-blue-600 text-sm">Durasi: {{ $guestBooking->layanan->durasi_hari }} hari</p>
                                    <p class="text-blue-800 font-medium">Mulai dari: Rp {{ number_format($guestBooking->layanan->harga_mulai) }}</p>
                                </div>
                            </div>
                        @endif
                        @if($guestBooking->kebutuhan_khusus)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Kebutuhan Khusus</label>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <p class="text-gray-900">{{ $guestBooking->kebutuhan_khusus }}</p>
                                </div>
                            </div>
                        @endif
                        @if($guestBooking->catatan_tambahan)
                            <div class="md:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1">Catatan Tambahan</label>
                                <div class="bg-gray-50 border border-gray-200 rounded-lg p-4">
                                    <p class="text-gray-900">{{ $guestBooking->catatan_tambahan }}</p>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                <!-- Admin Notes -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6 flex items-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M14,10H19.5L14,4.5V10M5,3H15L21,9V19A2,2 0 0,1 19,21H5C3.89,21 3,20.1 3,19V5C3,3.89 3.89,3 5,3M9,12H16V14H9V12M9,16H14V18H9V16Z"/>
                        </svg>
                        Admin Notes
                    </h2>
                    <form action="{{ route('admin.guest-bookings.update-status', $guestBooking) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                                <select name="status" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500">
                                    <option value="pending" {{ $guestBooking->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="contacted" {{ $guestBooking->status == 'contacted' ? 'selected' : '' }}>Contacted</option>
                                    <option value="quoted" {{ $guestBooking->status == 'quoted' ? 'selected' : '' }}>Quoted</option>
                                    <option value="confirmed" {{ $guestBooking->status == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                                    <option value="cancelled" {{ $guestBooking->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                    <option value="completed" {{ $guestBooking->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Admin Notes</label>
                                <textarea name="admin_notes" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Tambahkan catatan admin...">{{ $guestBooking->admin_notes }}</textarea>
                            </div>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg transition-colors duration-200">
                                Update Status & Notes
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Sidebar -->
            <div class="space-y-6">
                <!-- Booking Summary -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Booking Summary</h3>
                    <div class="space-y-3">
                        <div class="flex justify-between">
                            <span class="text-gray-600">Booking Number:</span>
                            <span class="font-medium">#{{ $guestBooking->booking_number }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Status:</span>
                            @php
                                $statusColors = [
                                    'pending' => 'bg-yellow-100 text-yellow-800',
                                    'contacted' => 'bg-blue-100 text-blue-800',
                                    'quoted' => 'bg-indigo-100 text-indigo-800',
                                    'confirmed' => 'bg-green-100 text-green-800',
                                    'cancelled' => 'bg-red-100 text-red-800',
                                    'completed' => 'bg-gray-100 text-gray-800'
                                ];
                            @endphp
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium {{ $statusColors[$guestBooking->status] ?? 'bg-gray-100 text-gray-800' }}">
                                {{ ucfirst($guestBooking->status) }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Type:</span>
                            <span class="font-medium">
                                {{ $guestBooking->is_custom_request ? 'Custom Request' : 'Package Booking' }}
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Created:</span>
                            <span class="font-medium">{{ $guestBooking->created_at->format('d/m/Y H:i') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-600">Updated:</span>
                            <span class="font-medium">{{ $guestBooking->updated_at->format('d/m/Y H:i') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">Quick Actions</h3>
                    <div class="space-y-3">
                        <a href="mailto:{{ $guestBooking->email }}" class="w-full bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M20,8L12,13L4,8V6L12,11L20,6M20,4H4C2.89,4 2,4.89 2,6V18A2,2 0 0,0 4,20H20A2,2 0 0,0 22,18V6C22,4.89 21.1,4 20,4Z"/>
                            </svg>
                            Email Customer
                        </a>
                        <a href="tel:{{ $guestBooking->nomor_telepon }}" class="w-full bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M6.62,10.79C8.06,13.62 10.38,15.94 13.21,17.38L15.41,15.18C15.69,14.9 16.08,14.82 16.43,14.93C17.55,15.3 18.75,15.5 20,15.5A1,1 0 0,1 21,16.5V20A1,1 0 0,1 20,21A17,17 0 0,1 3,4A1,1 0 0,1 4,3H7.5A1,1 0 0,1 8.5,4C8.5,5.25 8.7,6.45 9.07,7.57C9.18,7.92 9.1,8.31 8.82,8.59L6.62,10.79Z"/>
                            </svg>
                            Call Customer
                        </a>
                        <button onclick="copyBookingInfo()" class="w-full bg-gray-600 hover:bg-gray-700 text-white px-4 py-2 rounded-lg transition-colors duration-200 flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M19,21H8V7H19M19,5H8A2,2 0 0,0 6,7V21A2,2 0 0,0 8,23H19A2,2 0 0,0 21,21V7A2,2 0 0,0 19,5M16,1H4A2,2 0 0,0 2,3V17H4V3H16V1Z"/>
                            </svg>
                            Copy Info
                        </button>
                    </div>
                </div>

                <!-- Priority Indicator -->
                @if($guestBooking->is_custom_request)
                    <div class="bg-purple-50 border border-purple-200 rounded-xl p-6">
                        <div class="flex items-center gap-2 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-purple-600" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M12,2A2,2 0 0,1 14,4V8A2,2 0 0,1 12,10A2,2 0 0,1 10,8V4A2,2 0 0,1 12,2M21,9V7L15,1H5A2,2 0 0,0 3,3V21A2,2 0 0,0 5,23H19A2,2 0 0,0 21,21V9M19,9H14V4H19V9Z"/>
                            </svg>
                            <h4 class="font-semibold text-purple-800">Custom Request</h4>
                        </div>
                        <p class="text-purple-700 text-sm">Ini adalah permintaan khusus yang memerlukan perhatian lebih dan penawaran custom.</p>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Email Modal -->
    <div id="emailModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden z-50">
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl max-w-md w-full">
                <form action="{{ route('admin.guest-bookings.send-email', $guestBooking) }}" method="POST">
                    @csrf
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-gray-800 mb-4">Send Custom Email</h3>
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Subject</label>
                                <input type="text" name="subject" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Email subject...">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Message</label>
                                <textarea name="message" rows="6" required class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500" placeholder="Your message..."></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="px-6 py-4 bg-gray-50 flex justify-end gap-3">
                        <button type="button" onclick="closeEmailModal()" class="px-4 py-2 text-gray-700 bg-gray-200 hover:bg-gray-300 rounded-lg transition-colors duration-200">
                            Cancel
                        </button>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg transition-colors duration-200">
                            Send Email
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function openEmailModal() {
            document.getElementById('emailModal').classList.remove('hidden');
        }

        function closeEmailModal() {
            document.getElementById('emailModal').classList.add('hidden');
        }

        function copyBookingInfo() {
            const bookingInfo = `
Booking #{{ $guestBooking->booking_number }}
Customer: {{ $guestBooking->nama_lengkap }}
Email: {{ $guestBooking->email }}
Phone: {{ $guestBooking->nomor_telepon }}
Destination: {{ $guestBooking->destinasi_dicari }}
Participants: {{ $guestBooking->jumlah_peserta }}
Budget: @if($guestBooking->budget_estimasi)Rp {{ number_format($guestBooking->budget_estimasi) }}@else Tidak disebutkan @endif
Date: {{ \Carbon\Carbon::parse($guestBooking->tanggal_keberangkatan_diinginkan)->format('d F Y') }}
Type: {{ $guestBooking->is_custom_request ? 'Custom Request' : 'Package Booking' }}
Status: {{ ucfirst($guestBooking->status) }}
            `.trim();

            navigator.clipboard.writeText(bookingInfo).then(function() {
                alert('Booking information copied to clipboard!');
            });
        }

        // Close modal when clicking outside
        document.getElementById('emailModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeEmailModal();
            }
        });
    </script>
    @endpush
@endsection