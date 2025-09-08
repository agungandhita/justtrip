@extends('Frontend.layouts.main')

@section('title', 'My Bookings')

@section('container')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <h1 class="text-3xl font-bold text-gray-800 mb-8">My Bookings</h1>

        @if($bookings->count() > 0)
            <div class="grid gap-6">
                @foreach($bookings as $booking)
                    <div class="bg-white rounded-lg shadow-md p-6 border border-gray-200">
                        <div class="flex justify-between items-start mb-4">
                            <div>
                                <h3 class="text-xl font-semibold text-gray-800">{{ $booking->layanan->nama ?? 'N/A' }}</h3>
                                <p class="text-gray-600">Booking ID: #{{ $booking->booking_id }}</p>
                            </div>
                            <span class="px-3 py-1 rounded-full text-sm font-medium
                                @if($booking->status == 'confirmed') bg-green-100 text-green-800
                                @elseif($booking->status == 'pending') bg-yellow-100 text-yellow-800
                                @elseif($booking->status == 'cancelled') bg-red-100 text-red-800
                                @else bg-gray-100 text-gray-800
                                @endif">
                                {{ ucfirst($booking->status) }}
                            </span>
                        </div>

                        <div class="grid md:grid-cols-2 gap-4 mb-4">
                            <div>
                                <p class="text-sm text-gray-600">Travel Date</p>
                                <p class="font-medium">{{ $booking->tanggal_keberangkatan ? $booking->tanggal_keberangkatan->format('d M Y') : 'N/A' }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Participants</p>
                                <p class="font-medium">{{ $booking->jumlah_peserta }} people</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Total Price</p>
                                <p class="font-medium text-green-600">Rp {{ number_format($booking->total_amount, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600">Booking Date</p>
                                <p class="font-medium">{{ $booking->created_at->format('d M Y') }}</p>
                            </div>
                        </div>

                        @if($booking->catatan_khusus)
                            <div class="mb-4">
                                <p class="text-sm text-gray-600">Notes</p>
                                <p class="text-gray-800">{{ $booking->catatan_khusus }}</p>
                            </div>
                        @endif

                        <div class="flex gap-3">
                            <a href="{{ route('booking.show', $booking->booking_id) }}"
                               class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                                View Details
                            </a>

                            @if($booking->status == 'confirmed' && $booking->invoice)
                                <a href="{{ route('invoice.download', $booking->invoice->invoice_id) }}"
                                   class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700 transition duration-200">
                                    Download Invoice
                                </a>
                            @endif

                            @if($booking->status == 'pending')
                                <button onclick="cancelBooking({{ $booking->booking_id }})"
                                        class="bg-red-600 text-white px-4 py-2 rounded-lg hover:bg-red-700 transition duration-200">
                                    Cancel Booking
                                </button>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-8">
                {{ $bookings->links() }}
            </div>
        @else
            <div class="text-center py-12">
                <div class="max-w-md mx-auto">
                    <svg class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">No bookings found</h3>
                    <p class="mt-1 text-sm text-gray-500">You haven't made any bookings yet.</p>
                    <div class="mt-6">
                        <a href="{{ route('packages.index') }}"
                           class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            Browse Packages
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

<script>
function cancelBooking(bookingId) {
    if (confirm('Are you sure you want to cancel this booking?')) {
        fetch(`/booking/${bookingId}/cancel`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Failed to cancel booking. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again.');
        });
    }
}
</script>
@endsection
