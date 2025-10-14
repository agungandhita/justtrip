@extends('Frontend.layouts.main')

@section('container')
<div class="min-h-screen bg-gray-50 py-8">
    <div class="container mx-auto px-4">
        <!-- Header -->
        <div class="mb-8">
            <div class="flex items-center space-x-2 text-sm text-gray-500 mb-4">
                <a href="{{ route('guest-booking.index') }}" class="hover:text-blue-500">Pencarian</a>
                <i class="fas fa-chevron-right"></i>
                @if(!$isCustom)
                    <a href="{{ route('guest-booking.search', ['destinasi' => $destinasi]) }}" class="hover:text-blue-500">Hasil Pencarian</a>
                    <i class="fas fa-chevron-right"></i>
                @endif
                <span>Form Booking</span>
            </div>
            
            <h1 class="text-3xl font-bold text-gray-800">
                @if($isCustom)
                    Permintaan Khusus untuk "{{ $destinasi }}"
                @else
                    Booking {{ $layanan->nama_layanan }}
                @endif
            </h1>
        </div>

        <form action="{{ route('guest-booking.store') }}" method="POST" id="bookingForm" class="space-y-8">
            @csrf
            <input type="hidden" name="destinasi_dicari" value="{{ $destinasi }}">
            @if(!$isCustom && $layanan)
                <input type="hidden" name="layanan_id" value="{{ $layanan->layanan_id }}">
            @endif
            <input type="hidden" name="is_custom_request" value="{{ $isCustom ? '1' : '0' }}">

            <div class="grid lg:grid-cols-3 gap-8">
                <!-- Main Form -->
                <div class="lg:col-span-2 space-y-8">
                    
                    <!-- Data Pribadi -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-user text-blue-500 mr-3"></i>
                            Data Pribadi
                        </h2>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nama Lengkap *</label>
                                <input type="text" name="nama_lengkap" value="{{ old('nama_lengkap') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nama_lengkap') border-red-500 @enderror"
                                       placeholder="Masukkan nama lengkap" required>
                                @error('nama_lengkap')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Email *</label>
                                <input type="email" name="email" value="{{ old('email') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror"
                                       placeholder="contoh@email.com" required>
                                @error('email')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Nomor Telepon *</label>
                                <input type="tel" name="nomor_telepon" value="{{ old('nomor_telepon') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('nomor_telepon') border-red-500 @enderror"
                                       placeholder="08xxxxxxxxxx" required>
                                @error('nomor_telepon')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            

                        </div>
                        
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Alamat Lengkap *</label>
                            <textarea name="alamat" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('alamat') border-red-500 @enderror"
                                      placeholder="Masukkan alamat lengkap" required>{{ old('alamat') }}</textarea>
                            @error('alamat')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="grid md:grid-cols-3 gap-6 mt-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kota *</label>
                                <input type="text" name="kota" value="{{ old('kota') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kota') border-red-500 @enderror"
                                       placeholder="Jakarta" required>
                                @error('kota')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Provinsi *</label>
                                <input type="text" name="provinsi" value="{{ old('provinsi') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('provinsi') border-red-500 @enderror"
                                       placeholder="DKI Jakarta" required>
                                @error('provinsi')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Kode Pos</label>
                                <input type="text" name="kode_pos" value="{{ old('kode_pos') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kode_pos') border-red-500 @enderror"
                                       placeholder="12345">
                                @error('kode_pos')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <!-- Detail Perjalanan -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <h2 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                            <i class="fas fa-suitcase text-green-500 mr-3"></i>
                            Detail Perjalanan
                        </h2>
                        
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Jumlah Peserta *</label>
                                <select name="jumlah_peserta" 
                                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('jumlah_peserta') border-red-500 @enderror" required>
                                    <option value="">Pilih jumlah peserta</option>
                                    @for($i = 1; $i <= 20; $i++)
                                        <option value="{{ $i }}" {{ old('jumlah_peserta') == $i ? 'selected' : '' }}>
                                            {{ $i }} {{ $i == 1 ? 'orang' : 'orang' }}
                                        </option>
                                    @endfor
                                </select>
                                @error('jumlah_peserta')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Tanggal Keberangkatan Diinginkan *</label>
                                <input type="date" name="tanggal_keberangkatan_diinginkan" value="{{ old('tanggal_keberangkatan_diinginkan') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('tanggal_keberangkatan_diinginkan') border-red-500 @enderror"
                                       min="{{ date('Y-m-d', strtotime('+3 days')) }}" required>
                                @error('tanggal_keberangkatan_diinginkan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-2">Durasi Perjalanan (Hari)</label>
                                <input type="number" name="durasi_hari_diinginkan" value="{{ old('durasi_hari_diinginkan') }}" 
                                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('durasi_hari_diinginkan') border-red-500 @enderror"
                                       placeholder="3" min="1" max="365">
                                @error('durasi_hari_diinginkan')
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Budget Estimasi - Hanya untuk Custom Request -->
                        @if($isCustom)
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Estimasi Budget</label>
                            <select name="budget_estimasi" 
                                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('budget_estimasi') border-red-500 @enderror">
                                <option value="">Pilih range budget (opsional)</option>
                                <option value="1000000" {{ old('budget_estimasi') == '1000000' ? 'selected' : '' }}>< Rp 1.000.000</option>
                                <option value="2000000" {{ old('budget_estimasi') == '2000000' ? 'selected' : '' }}>Rp 1.000.000 - 3.000.000</option>
                                <option value="4000000" {{ old('budget_estimasi') == '4000000' ? 'selected' : '' }}>Rp 3.000.000 - 5.000.000</option>
                                <option value="7500000" {{ old('budget_estimasi') == '7500000' ? 'selected' : '' }}>Rp 5.000.000 - 10.000.000</option>
                                <option value="15000000" {{ old('budget_estimasi') == '15000000' ? 'selected' : '' }}>> Rp 10.000.000</option>
                            </select>
                            @error('budget_estimasi')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        @endif
                        
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Kebutuhan Khusus</label>
                            <textarea name="kebutuhan_khusus" rows="3" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('kebutuhan_khusus') border-red-500 @enderror"
                                      placeholder="Contoh: makanan halal, akses kursi roda, dll.">{{ old('kebutuhan_khusus') }}</textarea>
                            @error('kebutuhan_khusus')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        
                        <div class="mt-6">
                            <label class="block text-sm font-medium text-gray-700 mb-2">Catatan Tambahan</label>
                            <textarea name="catatan_tambahan" rows="4" 
                                      class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('catatan_tambahan') border-red-500 @enderror"
                                      placeholder="Ceritakan keinginan khusus Anda, seperti: aktivitas yang diinginkan, akomodasi, dll.">{{ old('catatan_tambahan') }}</textarea>
                            @error('catatan_tambahan')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="bg-white rounded-xl shadow-lg p-6">
                        <div class="flex items-center mb-4">
                            <input type="checkbox" id="agree_terms" name="agree_terms" value="1" 
                                   class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 @error('agree_terms') border-red-500 @enderror" required>
                            <label for="agree_terms" class="ml-2 text-sm text-gray-700">
                                Saya setuju dengan <a href="#" class="text-blue-500 hover:underline">syarat dan ketentuan</a> yang berlaku
                            </label>
                        </div>
                        @error('agree_terms')
                            <p class="text-red-500 text-sm mb-4">{{ $message }}</p>
                        @enderror
                        
                        <button type="submit" 
                                class="w-full bg-gradient-to-r from-blue-500 to-purple-600 hover:from-blue-600 hover:to-purple-700 text-white font-bold py-4 px-6 rounded-xl text-lg shadow-lg hover:shadow-xl transform hover:-translate-y-1 transition-all duration-200">
                            <i class="fas fa-paper-plane mr-2"></i>
                            @if($isCustom)
                                Kirim Permintaan Khusus
                            @else
                                Kirim Booking
                            @endif
                        </button>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    @if(!$isCustom && $layanan)
                        <!-- Package Info -->
                        <div class="bg-white rounded-xl shadow-lg p-6 sticky top-8">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Detail Paket</h3>
                            
                            @if($layanan->gambar_destinasi)
                                @php
                                    $gambar = is_string($layanan->gambar_destinasi) 
                                        ? json_decode($layanan->gambar_destinasi, true) 
                                        : $layanan->gambar_destinasi;
                                @endphp
                                @if($gambar && is_array($gambar) && count($gambar) > 0)
                                    <img src="{{ asset('storage/' . $gambar[0]) }}" alt="{{ $layanan->nama_layanan }}" class="w-full h-32 object-cover rounded-lg mb-4">
                                @endif
                            @endif
                            
                            <h4 class="font-bold text-gray-800 mb-2">{{ $layanan->nama_layanan }}</h4>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($layanan->deskripsi, 100) }}</p>
                            
                            <div class="space-y-2 mb-4">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-map-marker-alt w-4"></i>
                                    <span class="ml-2">{{ $layanan->lokasi_tujuan }}</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-calendar w-4"></i>
                                    <span class="ml-2">{{ $layanan->durasi_hari }} hari</span>
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-users w-4"></i>
                                    <span class="ml-2">Maks {{ $layanan->maks_orang }} orang</span>
                                </div>
                            </div>
                            
                            <div class="border-t pt-4">
                                <span class="text-sm text-gray-500">Harga per orang</span>
                                <div class="text-xl font-bold text-gray-600 mb-2">
                                    Rp {{ number_format($layanan->harga_mulai, 0, ',', '.') }}
                                </div>
                                
                                <div class="bg-blue-50 rounded-lg p-3 mt-3">
                                    <span class="text-sm text-gray-600">Total Estimasi Harga</span>
                                    <div class="text-2xl font-bold text-blue-600" id="totalPrice">
                                        Rp {{ number_format($layanan->harga_mulai, 0, ',', '.') }}
                                    </div>
                                    <p class="text-xs text-gray-500 mt-1">*Berdasarkan <span id="participantCount">1</span> peserta</p>
                                </div>
                                
                                <p class="text-xs text-gray-500 mt-2">*Harga final dapat berubah sesuai tanggal dan fasilitas tambahan</p>
                            </div>
                        </div>
                    @else
                        <!-- Custom Request Info -->
                        <div class="bg-white rounded-xl shadow-lg p-6 sticky top-8">
                            <h3 class="text-lg font-bold text-gray-800 mb-4">Permintaan Khusus</h3>
                            
                            <div class="bg-purple-50 rounded-lg p-4 mb-4">
                                <h4 class="font-bold text-purple-800 mb-2">{{ $destinasi }}</h4>
                                <p class="text-purple-700 text-sm">Kami akan membuatkan paket wisata khusus sesuai keinginan Anda.</p>
                            </div>
                            
                            <div class="space-y-3">
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    Konsultasi gratis
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    Itinerary disesuaikan
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    Budget fleksibel
                                </div>
                                <div class="flex items-center text-sm text-gray-600">
                                    <i class="fas fa-check text-green-500 mr-3"></i>
                                    Respon dalam 24 jam
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date to 3 days from now
    const dateInput = document.querySelector('input[name="tanggal_keberangkatan_diinginkan"]');
    if (dateInput) {
        const today = new Date();
        today.setDate(today.getDate() + 3);
        dateInput.min = today.toISOString().split('T')[0];
    }
    
    @if(!$isCustom && $layanan)
    // Real-time price calculation for existing services
    const participantInput = document.querySelector('input[name="jumlah_peserta"]');
    const totalPriceElement = document.getElementById('totalPrice');
    const participantCountElement = document.getElementById('participantCount');
    const basePrice = {{ $layanan->harga_mulai }};
    
    function updatePrice() {
        const participants = parseInt(participantInput.value) || 1;
        const totalPrice = basePrice * participants;
        
        totalPriceElement.textContent = 'Rp ' + totalPrice.toLocaleString('id-ID');
        participantCountElement.textContent = participants;
    }
    
    if (participantInput) {
        participantInput.addEventListener('input', updatePrice);
        participantInput.addEventListener('change', updatePrice);
        // Initialize with current value
        updatePrice();
    }
    @endif
    
    // Form validation
    const form = document.getElementById('bookingForm');
    form.addEventListener('submit', function(e) {
        const requiredFields = form.querySelectorAll('[required]');
        let isValid = true;
        
        requiredFields.forEach(field => {
            if (!field.value.trim()) {
                isValid = false;
                field.classList.add('border-red-500');
            } else {
                field.classList.remove('border-red-500');
            }
        });
        
        if (!isValid) {
            e.preventDefault();
            // Scroll to first error
            const firstError = form.querySelector('.border-red-500');
            if (firstError) {
                firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                firstError.focus();
            }
        }
    });
});
</script>
@endsection