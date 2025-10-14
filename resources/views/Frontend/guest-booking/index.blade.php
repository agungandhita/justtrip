@extends('Frontend.layouts.main')

@section('container')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-12">
    <div class="container mx-auto px-4">
        <!-- Header Section -->
        <div class="text-center mb-12">
            <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">
                Cari Perjalanan Impian Anda
            </h1>
            <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                Temukan destinasi wisata terbaik atau buat permintaan khusus sesuai keinginan Anda. 
                Kami siap membantu mewujudkan liburan impian Anda!
            </p>
        </div>

        <!-- Search Form -->
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8 md:p-12">
                <form action="{{ route('guest-booking.search') }}" method="POST" class="space-y-6">
                    @csrf
                    
                    <!-- Destinasi Input -->
                    <div class="space-y-2">
                        <label for="destinasi" class="block text-lg font-semibold text-gray-700">
                            <i class="fas fa-map-marker-alt text-blue-500 mr-2"></i>
                            Mau ke mana?
                        </label>
                        <div class="relative">
                            <input 
                                type="text" 
                                id="destinasi" 
                                name="destinasi" 
                                placeholder="Contoh: Bali, Yogyakarta, Raja Ampat, dll..."
                                class="w-full px-6 py-4 text-lg border-2 border-gray-200 rounded-xl focus:border-blue-500 focus:ring-4 focus:ring-blue-100 transition-all duration-200 @error('destinasi') border-red-500 @enderror"
                                value="{{ old('destinasi') }}"
                                required
                            >
                            <div class="absolute right-4 top-1/2 transform -translate-y-1/2">
                                <i class="fas fa-search text-gray-400"></i>
                            </div>
                        </div>
                        @error('destinasi')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Info Box -->
                    <div class="bg-blue-50 border border-blue-200 rounded-xl p-6">
                        <div class="flex items-start space-x-3">
                            <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                            <div>
                                <h3 class="font-semibold text-blue-800 mb-2">Yang akan terjadi selanjutnya:</h3>
                                <ul class="text-blue-700 space-y-1 text-sm">
                                    <li>✓ Kami akan mencari paket wisata yang sesuai dengan destinasi Anda</li>
                                    <li>✓ Jika tersedia, Anda bisa langsung booking paket yang ada</li>
                                    <li>✓ Jika tidak tersedia, Anda bisa membuat permintaan khusus</li>
                                    <li>✓ Tim kami akan menghubungi Anda dalam 24 jam</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="text-center">
                        <button 
                            type="submit" 
                            class="bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold py-4 px-12 rounded-xl text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200"
                        >
                            <i class="fas fa-search mr-2"></i>
                            Cari Sekarang
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Features Section -->
        <div class="mt-16 grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-clock text-blue-500 text-2xl"></i>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Respon Cepat</h3>
                <p class="text-gray-600">Tim kami akan merespon dalam 24 jam</p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-shield-alt text-green-500 text-2xl"></i>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Terpercaya</h3>
                <p class="text-gray-600">Pengalaman bertahun-tahun melayani wisatawan</p>
            </div>
            
            <div class="text-center p-6">
                <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="fas fa-heart text-purple-500 text-2xl"></i>
                </div>
                <h3 class="font-bold text-gray-800 mb-2">Sesuai Keinginan</h3>
                <p class="text-gray-600">Paket wisata disesuaikan dengan kebutuhan Anda</p>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Auto focus pada input destinasi
    document.getElementById('destinasi').focus();
    
    // Animasi smooth scroll jika ada error
    @if($errors->any())
        document.querySelector('.border-red-500').scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    @endif
});
</script>
@endsection