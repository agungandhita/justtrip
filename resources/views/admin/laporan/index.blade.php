@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7,15H9C9,16.08 10.37,17 12,17C13.63,17 15,16.08 15,15C15,13.9 13.96,13.5 11.76,12.97C9.64,12.44 7,11.78 7,9C7,7.21 8.47,5.69 10.5,5.18V3H13.5V5.18C15.53,5.69 17,7.21 17,9H15C15,7.92 13.63,7 12,7C10.37,7 9,7.92 9,9C9,10.1 10.04,10.5 12.24,11.03C14.36,11.56 17,12.22 17,15C17,16.79 15.53,18.31 13.5,18.82V21H10.5V18.82C8.47,18.31 7,16.79 7,15Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Laporan Pendapatan</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Kelola dan analisis pendapatan dari pesanan yang telah selesai</p>
                </div>
            </div>
        </div>

        <!-- Filter Section -->
        <div class="px-4 mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <form method="GET" action="{{ route('admin.laporan.index') }}" class="flex flex-wrap items-end gap-4">
                    <div class="flex-1 min-w-[200px]">
                        <label for="start_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Mulai</label>
                        <input type="date" id="start_date" name="start_date" value="{{ $startDate }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="flex-1 min-w-[200px]">
                        <label for="end_date" class="block text-sm font-medium text-gray-700 mb-2">Tanggal Akhir</label>
                        <input type="date" id="end_date" name="end_date" value="{{ $endDate }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-md font-medium transition-colors duration-200 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M9.5,3A6.5,6.5 0 0,1 16,9.5C16,11.11 15.41,12.59 14.44,13.73L14.71,14H15.5L20.5,19L19,20.5L14,15.5V14.71L13.73,14.44C12.59,15.41 11.11,16 9.5,16A6.5,6.5 0 0,1 3,9.5A6.5,6.5 0 0,1 9.5,3M9.5,5C7,5 5,7 5,9.5C5,12 7,14 9.5,14C12,14 14,12 14,9.5C14,7 12,5 9.5,5Z"/>
                            </svg>
                            Filter
                        </button>
                        <a href="{{ route('admin.laporan.export', ['start_date' => $startDate, 'end_date' => $endDate]) }}" 
                           class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-md font-medium transition-colors duration-200 flex items-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                            </svg>
                            Export Excel
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="px-4 mb-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Total Pendapatan -->
                <div class="bg-gradient-to-r from-blue-500 to-blue-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-blue-100 text-sm font-medium">Total Pendapatan</p>
                            <p class="text-3xl font-bold">Rp {{ number_format($totalPendapatan, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-blue-400 bg-opacity-30 rounded-full p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7,15H9C9,16.08 10.37,17 12,17C13.63,17 15,16.08 15,15C15,13.9 13.96,13.5 11.76,12.97C9.64,12.44 7,11.78 7,9C7,7.21 8.47,5.69 10.5,5.18V3H13.5V5.18C15.53,5.69 17,7.21 17,9H15C15,7.92 13.63,7 12,7C10.37,7 9,7.92 9,9C9,10.1 10.04,10.5 12.24,11.03C14.36,11.56 17,12.22 17,15C17,16.79 15.53,18.31 13.5,18.82V21H10.5V18.82C8.47,18.31 7,16.79 7,15Z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Total Pesanan -->
                <div class="bg-gradient-to-r from-green-500 to-green-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-green-100 text-sm font-medium">Total Pesanan</p>
                            <p class="text-3xl font-bold">{{ $totalPesanan }}</p>
                        </div>
                        <div class="bg-green-400 bg-opacity-30 rounded-full p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M7,4V2A1,1 0 0,1 8,1H16A1,1 0 0,1 17,2V4H20A1,1 0 0,1 21,5V19A1,1 0 0,1 20,20H4A1,1 0 0,1 3,19V5A1,1 0 0,1 4,4H7M9,3V4H15V3H9M5,6V18H19V6H5Z"/>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Rata-rata Pendapatan -->
                <div class="bg-gradient-to-r from-purple-500 to-purple-600 rounded-lg shadow-lg p-6 text-white">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-purple-100 text-sm font-medium">Rata-rata per Pesanan</p>
                            <p class="text-3xl font-bold">Rp {{ number_format($rataRataPendapatan, 0, ',', '.') }}</p>
                        </div>
                        <div class="bg-purple-400 bg-opacity-30 rounded-full p-3">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8" viewBox="0 0 24 24" fill="currentColor">
                                <path d="M16,11.78L20.24,4.45L21.97,5.45L16.74,14.5L10.23,10.75L5.46,19H22V21H2V3H4V17.54L9.5,8L16,11.78Z"/>
                            </svg>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pendapatan per Layanan -->
        @if($pendapatanPerLayanan->count() > 0)
        <div class="px-4 mb-6">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">Pendapatan per Layanan</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                    @foreach($pendapatanPerLayanan as $layanan => $data)
                    <div class="bg-gray-50 rounded-lg p-4">
                        <h4 class="font-medium text-gray-800 mb-2">{{ $layanan ?: 'Layanan Tidak Diketahui' }}</h4>
                        <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($data['total'], 0, ',', '.') }}</p>
                        <p class="text-sm text-gray-600">{{ $data['count'] }} pesanan</p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Tabel Detail Pesanan -->
        <div class="px-4">
            <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-800">Detail Pesanan ({{ $pesanan->count() }} pesanan)</h3>
                </div>
                
                @if($pesanan->count() > 0)
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pesanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pelanggan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Layanan</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Total Harga</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Selesai</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Prioritas</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($pesanan as $item)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div>
                                        <div class="text-sm font-medium text-gray-900">{{ $item->nomor_pesanan }}</div>
                                        <div class="text-sm text-gray-500">{{ $item->jenis_layanan }}</div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->user ? $item->user->name : $item->nama_pemesan }}</div>
                                    <div class="text-sm text-gray-500">{{ $item->email_pemesan }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm text-gray-900">{{ $item->layanan ? $item->layanan->nama_layanan : '-' }}</div>
                                    <div class="text-sm text-gray-500">Jumlah: {{ $item->jumlah }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">Rp {{ number_format($item->total_harga, 0, ',', '.') }}</div>
                                    @if($item->biaya_tambahan > 0)
                                    <div class="text-xs text-gray-500">+ Biaya tambahan: Rp {{ number_format($item->biaya_tambahan, 0, ',', '.') }}</div>
                                    @endif
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                    {{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y H:i') }}
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $prioritasClass = match($item->prioritas) {
                                            'kilat' => 'bg-red-100 text-red-800',
                                            'cepat' => 'bg-orange-100 text-orange-800',
                                            default => 'bg-gray-100 text-gray-800'
                                        };
                                    @endphp
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $prioritasClass }}">
                                        {{ ucfirst($item->prioritas ?? 'normal') }}
                                    </span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @else
                <div class="px-6 py-12 text-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="mx-auto h-12 w-12 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h3 class="mt-2 text-sm font-medium text-gray-900">Tidak ada data</h3>
                    <p class="mt-1 text-sm text-gray-500">Tidak ada pesanan yang selesai dalam periode yang dipilih.</p>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection