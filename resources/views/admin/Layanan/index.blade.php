@extends('admin.layouts.main')

@section('container')
    <div class="mt-20 pb-10">
        <!-- Header -->
        <div class="mb-8 px-4">
            <div class="flex items-center justify-between">
                <div>
                    <div class="flex items-center gap-3 mb-2">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 text-indigo-600" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M12,2A2,2 0 0,1 14,4V8A2,2 0 0,1 12,10A2,2 0 0,1 10,8V4A2,2 0 0,1 12,2M21,9V7L15,1H5A2,2 0 0,0 3,3V21A2,2 0 0,0 5,23H19A2,2 0 0,0 21,21V9Z"/>
                        </svg>
                        <h1 class="text-3xl font-bold text-gray-800 mb-0">Manajemen Layanan</h1>
                    </div>
                    <p class="text-gray-600 pl-11">Kelola data layanan travel</p>
                </div>
                <a href="{{ route('admin.layanan.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-3 rounded-lg font-medium transition-colors duration-200 flex items-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M11 11V5H13V11H19V13H13V19H11V13H5V11H11Z"/>
                    </svg>
                    Tambah Layanan
                </a>
            </div>
        </div>

        <!-- Search and Filter -->
        <div class="px-4 mb-6">
            <div class="bg-white rounded-xl shadow-md p-6">
                <form method="GET" action="{{ route('admin.layanan.index') }}" class="flex flex-col md:flex-row gap-4">
                    <div class="flex-1">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama layanan atau deskripsi..." class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                    </div>
                    <div class="w-full md:w-48">
                        <select name="jenis_layanan" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Semua Jenis</option>
                            @foreach($jenisLayananOptions as $key => $label)
                                <option value="{{ $key }}" {{ request('jenis_layanan') == $key ? 'selected' : '' }}>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full md:w-48">
                        <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
                            <option value="">Semua Status</option>
                            <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                            <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                        </select>
                    </div>
                    <button type="submit" class="bg-gray-600 hover:bg-gray-700 text-white px-6 py-2 rounded-lg font-medium transition-colors duration-200">
                        Filter
                    </button>
                    <a href="{{ route('admin.layanan.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-700 px-6 py-2 rounded-lg font-medium transition-colors duration-200 text-center">
                        Reset
                    </a>
                </form>
            </div>
        </div>

        <!-- Services Table -->
        <div class="px-4">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Gambar</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Layanan</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jenis</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Durasi</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">
                            @forelse($layanan as $index => $item)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $layanan->firstItem() + $index }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($item->gambar_utama)
                                            <img src="{{ asset('storage/' . $item->gambar_utama) }}" alt="{{ $item->nama_layanan }}" class="w-16 h-12 object-cover rounded-lg border border-gray-200">
                                        @else
                                            <div class="w-16 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19M19,19H5V5H19M13.96,12.29L11.21,15.83L9.25,13.47L6.5,17H17.5L13.96,12.29Z"/>
                                                </svg>
                                            </div>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $item->nama_layanan }}</div>
                                        <div class="text-sm text-gray-500">{{ Str::limit($item->deskripsi, 50) }}</div>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            {{ $item->jenis_layanan_label }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->harga_format }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                        {{ $item->durasi_format }}
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full {{ $item->status == 'aktif' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                            {{ ucfirst($item->status) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                        <div class="flex items-center space-x-2">
                                            <a href="{{ route('admin.layanan.show', $item) }}" class="text-indigo-600 hover:text-indigo-900 p-1 rounded" title="Lihat Detail">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M12 4.5C7 4.5 2.73 7.61 1 12C2.73 16.39 7 19.5 12 19.5S21.27 16.39 23 12C21.27 7.61 17 4.5 12 4.5ZM12 17C9.24 17 7 14.76 7 12S9.24 7 12 7S17 9.24 17 12S14.76 17 12 17ZM12 9C10.34 9 9 10.34 9 12S10.34 15 12 15S15 13.66 15 12S13.66 9 12 9Z"/>
                                                </svg>
                                            </a>
                                            <a href="{{ route('admin.layanan.edit', $item) }}" class="text-yellow-600 hover:text-yellow-900 p-1 rounded" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                                    <path d="M20.71,7.04C21.1,6.65 21.1,6 20.71,5.63L18.37,3.29C18,2.9 17.35,2.9 16.96,3.29L15.12,5.12L18.87,8.87M3,17.25V21H6.75L17.81,9.93L14.06,6.18L3,17.25Z"/>
                                                </svg>
                                            </a>
                                            <form action="{{ route('admin.layanan.toggle-status', $item) }}" method="POST" class="inline">
                                                @csrf
                                                <button type="submit" class="{{ $item->status == 'aktif' ? 'text-red-600 hover:text-red-900' : 'text-green-600 hover:text-green-900' }} p-1 rounded" title="{{ $item->status == 'aktif' ? 'Nonaktifkan' : 'Aktifkan' }}">
                                                    @if($item->status == 'aktif')
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                                            <path d="M12,2A10,10 0 0,0 2,12A10,10 0 0,0 12,22A10,10 0 0,0 22,12A10,10 0 0,0 12,2M12,4A8,8 0 0,1 20,12A8,8 0 0,1 12,20A8,8 0 0,1 4,12A8,8 0 0,1 12,4M12,6A6,6 0 0,0 6,12A6,6 0 0,0 12,18A6,6 0 0,0 18,12A6,6 0 0,0 12,6Z"/>
                                                        </svg>
                                                    @else
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                                            <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z"/>
                                                        </svg>
                                                    @endif
                                                </button>
                                            </form>
                                            <form action="{{ route('admin.layanan.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus layanan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900 p-1 rounded" title="Hapus">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor">
                                                        <path d="M19,4H15.5L14.5,3H9.5L8.5,4H5V6H19M6,19A2,2 0 0,0 8,21H16A2,2 0 0,0 18,19V7H6V19Z"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="px-6 py-12 text-center text-gray-500">
                                        <div class="flex flex-col items-center">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 text-gray-400 mb-4" viewBox="0 0 24 24" fill="currentColor">
                                                <path d="M12,2A2,2 0 0,1 14,4V8A2,2 0 0,1 12,10A2,2 0 0,1 10,8V4A2,2 0 0,1 12,2M21,9V7L15,1H5A2,2 0 0,0 3,3V21A2,2 0 0,0 5,23H19A2,2 0 0,0 21,21V9Z"/>
                                            </svg>
                                            <p class="text-lg font-medium">Tidak ada layanan ditemukan</p>
                                            <p class="text-sm">Silakan tambah layanan baru atau ubah filter pencarian</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <!-- Pagination -->
                @if($layanan->hasPages())
                    <div class="px-6 py-4 border-t border-gray-200">
                        {{ $layanan->appends(request()->query())->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection