@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative flex items-center justify-center min-h-screen overflow-hidden">
    <!-- Background Slider -->
    <div class="absolute inset-0 z-0" id="heroSlider">
        <div class="absolute inset-0 z-10 bg-gradient-to-r from-blue-900/80 via-blue-800/80 to-indigo-900/80"></div>

        <!-- Slider Images - Travel Theme -->
        <div class="relative h-full overflow-hidden slider-container">
            <div class="h-full transition-opacity duration-1000 bg-center bg-cover slide active" style="background-image: url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
            <div class="absolute inset-0 h-full transition-opacity duration-1000 bg-center bg-cover opacity-0 slide" style="background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
            <div class="absolute inset-0 h-full transition-opacity duration-1000 bg-center bg-cover opacity-0 slide" style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
        </div>

        <!-- Slider Navigation Dots -->
        <div class="absolute z-20 flex space-x-3 transform -translate-x-1/2 bottom-20 left-1/2">
            <button class="w-3 h-3 transition-all duration-300 rounded-full slider-dot bg-white/50 hover:bg-white active" data-slide="0"></button>
            <button class="w-3 h-3 transition-all duration-300 rounded-full slider-dot bg-white/50 hover:bg-white" data-slide="1"></button>
            <button class="w-3 h-3 transition-all duration-300 rounded-full slider-dot bg-white/50 hover:bg-white" data-slide="2"></button>
        </div>

        <!-- Slider Arrow Navigation -->
        <button class="absolute z-20 transition-all duration-300 transform -translate-y-1/2 left-4 top-1/2 text-white/70 hover:text-white" id="prevSlide">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button class="absolute z-20 transition-all duration-300 transform -translate-y-1/2 right-4 top-1/2 text-white/70 hover:text-white" id="nextSlide">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <!-- Hero Content -->
    <div class="relative z-20 max-w-6xl px-4 mx-auto text-center text-white" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="mb-3 text-2xl font-bold leading-tight text-transparent sm:text-3xl md:text-4xl lg:text-5xl xl:text-6xl sm:mb-4 md:mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text">
            Liburan Jadi Gampang
        </h1>
        <p class="max-w-4xl mx-auto mb-4 text-sm font-medium text-blue-100 sm:text-base md:text-lg lg:text-xl sm:mb-6 md:mb-8" data-aos="fade-up" data-aos-delay="200">
            Cukup sekali klik dengan JustTrip. Temukan destinasi impian dan nikmati perjalanan tak terlupakan.
        </p>
        <div class="flex flex-col justify-center gap-2 sm:flex-row sm:gap-3 md:gap-4" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('special-offers.index') }}" class="px-4 py-2 text-xs font-bold text-center text-white transition-all duration-300 transform bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 sm:py-3 md:py-4 sm:px-6 md:px-8 rounded-xl sm:text-sm md:text-base lg:text-lg hover:scale-105 hover:shadow-xl">
                <i class="mr-1 fas fa-tags sm:mr-2"></i>
                Lihat Promo Spesial
            </a>
            <a href="{{ route('packages.index') }}" class="px-4 py-2 text-xs font-bold text-center text-white transition-all duration-300 transform border-2 border-white hover:bg-white hover:text-blue-600 sm:py-3 md:py-4 sm:px-6 md:px-8 rounded-xl sm:text-sm md:text-base lg:text-lg hover:scale-105">
                <i class="mr-1 fas fa-plane sm:mr-2"></i>
                Jelajahi Destinasi
            </a>
        </div>

        <!-- Quick Search Form -->
        <div class="max-w-4xl p-3 mx-auto mt-8 bg-white shadow-2xl sm:mt-10 md:mt-12 rounded-2xl sm:p-4 md:p-6" data-aos="fade-up" data-aos-delay="600">
            <h3 class="mb-2 text-base font-bold text-center text-gray-900 sm:text-lg md:text-xl sm:mb-3 md:mb-4">Cari Perjalanan Impian Anda</h3>
            <form action="{{ route('guest-booking.search') }}" method="POST" class="grid grid-cols-1 gap-3 sm:grid-cols-2 lg:grid-cols-4 sm:gap-4" x-data="guestBookingSearch()">
                @csrf
                <div class="relative">
                    <label class="block mb-2 text-xs font-semibold text-gray-800 sm:text-sm">Destinasi</label>
                    <div class="relative">
                        <input type="text" name="destinasi" placeholder="Mau ke mana?" value="{{ old('destinasi') }}" x-model="destinasi" @input="searchLayanan()" class="w-full px-3 py-2 pl-8 text-sm text-gray-900 placeholder-gray-500 bg-white border border-gray-300 sm:px-4 sm:py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent sm:pl-10 sm:text-base" required>
                        <i class="absolute text-sm text-gray-500 transform -translate-y-1/2 fas fa-map-marker-alt left-2 sm:left-3 top-1/2"></i>
                    </div>
                    
                    <!-- Loading indicator -->
                    <div x-show="loading" class="absolute left-0 right-0 flex items-center p-2 mt-1 text-xs text-blue-700 border border-blue-200 rounded top-full bg-blue-50">
                        <i class="mr-2 fas fa-spinner fa-spin"></i> Mencari paket...
                    </div>
                    
                    <!-- Suggestions dropdown -->
                    <div x-show="layananList.length > 0 && !loading" class="absolute left-0 right-0 z-50 mt-1 overflow-y-auto bg-white border border-gray-200 shadow-lg top-full rounded-xl max-h-64">
                        <template x-for="layanan in layananList.slice(0, 5)" :key="layanan.layanan_id">
                            <a :href="'{{ route('guest-booking.form') }}?destinasi=' + encodeURIComponent(destinasi) + '&layanan_id=' + layanan.layanan_id" class="block px-4 py-2 text-xs border-b hover:bg-blue-50 last:border-b-0 sm:text-sm">
                                <h4 class="font-semibold text-gray-800" x-text="layanan.nama_layanan"></h4>
                                <p class="text-xs text-gray-600" x-text="layanan.lokasi_tujuan + ' • ' + layanan.durasi_hari + ' hari'"></p>
                                <p class="text-xs font-semibold text-blue-600" x-text="'Mulai: ' + formatPrice(layanan.harga_mulai)"></p>
                            </a>
                        </template>
                    </div>
                    
                    @error('destinasi')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative">
                    <label class="block mb-2 text-xs font-semibold text-gray-800 sm:text-sm">Tanggal Berangkat</label>
                    <div class="relative">
                        <input type="date" name="departure_date" value="{{ old('departure_date') }}" min="{{ date('Y-m-d', strtotime('+1 day')) }}" class="w-full px-3 py-2 pl-8 text-sm text-gray-900 bg-white border border-gray-300 sm:px-4 sm:py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent sm:pl-10 sm:text-base">
                        <i class="absolute text-sm text-gray-500 transform -translate-y-1/2 fas fa-calendar-alt left-2 sm:left-3 top-1/2"></i>
                    </div>
                    @error('departure_date')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="relative">
                    <label class="block mb-2 text-xs font-semibold text-gray-800 sm:text-sm">Jumlah Orang</label>
                    <div class="relative">
                        <select name="participants" class="w-full px-3 py-2 pl-8 text-sm text-gray-900 bg-white border border-gray-300 appearance-none sm:px-4 sm:py-3 rounded-xl focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent sm:pl-10 sm:text-base">
                            <option value="" class="text-gray-500">Pilih jumlah orang</option>
                            <option value="1" {{ old('participants') == '1' ? 'selected' : '' }} class="text-gray-900">1 Orang</option>
                            <option value="2" {{ old('participants') == '2' ? 'selected' : '' }} class="text-gray-900">2 Orang</option>
                            <option value="3-5" {{ old('participants') == '3-5' ? 'selected' : '' }} class="text-gray-900">3-5 Orang</option>
                            <option value="6+" {{ old('participants') == '6+' ? 'selected' : '' }} class="text-gray-900">6+ Orang</option>
                        </select>
                        <i class="absolute text-sm text-gray-500 transform -translate-y-1/2 fas fa-users left-2 sm:left-3 top-1/2"></i>
                        <i class="absolute text-sm text-gray-500 transform -translate-y-1/2 fas fa-chevron-down right-2 sm:right-3 top-1/2"></i>
                    </div>
                    @error('participants')
                        <p class="mt-1 text-xs text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-end sm:col-span-2 lg:col-span-1">
                    <button type="submit" class="w-full px-4 py-2 text-sm font-bold text-white transition-all duration-300 transform bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 sm:py-3 sm:px-6 rounded-xl hover:scale-105 hover:shadow-lg sm:text-base">
                        <i class="mr-1 fas fa-search sm:mr-2"></i>
                        Cari Sekarang
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute z-20 transform -translate-x-1/2 bottom-8 left-1/2" data-aos="bounce" data-aos-delay="1000">
        <div class="flex justify-center w-6 h-10 border-2 border-white rounded-full">
            <div class="w-1 h-3 mt-2 bg-white rounded-full animate-bounce"></div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section class="py-12 sm:py-16 lg:py-20 bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="container px-4 mx-auto">
        <div class="mb-12 text-center sm:mb-16" data-aos="fade-up">
            <h2 class="mb-3 text-2xl font-bold text-gray-800 sm:text-3xl md:text-4xl lg:text-5xl sm:mb-4">Mengapa Pilih JustTrip?</h2>
            <p class="max-w-3xl px-4 mx-auto text-base text-gray-600 sm:text-lg md:text-xl">Partner terpercaya untuk mewujudkan perjalanan impian Anda dengan layanan travel terbaik dan pengalaman tak terlupakan</p>
        </div>

        <div class="grid grid-cols-1 gap-6 mb-12 sm:grid-cols-2 lg:grid-cols-3 sm:gap-8 sm:mb-16 lg:mb-20">
            <div class="p-6 transition-all duration-300 transform bg-white shadow-lg rounded-xl sm:p-8 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full sm:w-16 sm:h-16 bg-gradient-to-r from-blue-500 to-blue-600 sm:mb-6">
                    <i class="text-lg text-white fas fa-map-marked-alt sm:text-2xl"></i>
                </div>
                <h3 class="mb-3 text-lg font-bold text-center text-gray-800 sm:text-xl sm:mb-4">Destinasi Terlengkap</h3>
                <p class="text-sm leading-relaxed text-center text-gray-600 sm:text-base">Ratusan destinasi menarik dari dalam dan luar negeri dengan paket tour yang disesuaikan kebutuhan Anda</p>
            </div>

            <div class="p-6 transition-all duration-300 transform bg-white shadow-lg rounded-xl sm:p-8 hover:shadow-xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full sm:w-16 sm:h-16 bg-gradient-to-r from-orange-500 to-orange-600 sm:mb-6">
                    <i class="text-lg text-white fas fa-shield-alt sm:text-2xl"></i>
                </div>
                <h3 class="mb-3 text-lg font-bold text-center text-gray-800 sm:text-xl sm:mb-4">Harga Transparan</h3>
                <p class="text-sm leading-relaxed text-center text-gray-600 sm:text-base">Tidak ada biaya tersembunyi, harga kompetitif dengan kualitas pelayanan terbaik untuk setiap perjalanan</p>
            </div>

            <div class="p-6 transition-all duration-300 transform bg-white shadow-lg rounded-xl sm:p-8 hover:shadow-xl hover:-translate-y-2 sm:col-span-2 lg:col-span-1" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center justify-center w-12 h-12 mx-auto mb-4 rounded-full sm:w-16 sm:h-16 bg-gradient-to-r from-green-500 to-green-600 sm:mb-6">
                    <i class="text-lg text-white fas fa-headset sm:text-2xl"></i>
                </div>
                <h3 class="mb-3 text-lg font-bold text-center text-gray-800 sm:text-xl sm:mb-4">Pelayanan 24/7</h3>
                <p class="text-sm leading-relaxed text-center text-gray-600 sm:text-base">Tim customer service berpengalaman siap membantu Anda kapan saja untuk perjalanan yang sempurna</p>
            </div>
        </div>


    </div>
</section>

<!-- Testimonials Section -->
<section class="py-12 bg-white sm:py-16 md:py-20">
    <div class="container px-4 mx-auto">
        <div class="mb-8 text-center sm:mb-12 md:mb-16" data-aos="fade-up">
            <h2 class="mb-2 text-xl font-bold text-gray-800 sm:text-2xl md:text-3xl lg:text-4xl sm:mb-3 md:mb-4">Testimoni Pelanggan</h2>
            <p class="text-sm text-gray-600 sm:text-base md:text-lg lg:text-xl">Pengalaman nyata dari pelanggan yang telah menggunakan layanan sewa bus JustTrip</p>
        </div>

        <div class="grid gap-8 md:grid-cols-3">
            <div class="p-8 shadow-lg bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center mb-6">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Sarah" class="object-cover w-16 h-16 mr-4 rounded-full">
                    <div>
                        <h4 class="font-bold text-gray-800">Sarah Putri</h4>
                        <p class="text-gray-600">Jakarta</p>
                        <p class="text-sm text-blue-600">Sewa Big Bus 45 Seat</p>
                    </div>
                </div>
                <div class="flex mb-4">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="italic text-gray-700">"Sewa bus untuk study tour sekolah sangat memuaskan! Bus bersih, AC dingin, dan sopir sangat berpengalaman. Harga juga transparan tanpa biaya tersembunyi."</p>
            </div>

            <div class="p-8 shadow-lg bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center mb-6">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Andi" class="object-cover w-16 h-16 mr-4 rounded-full">
                    <div>
                        <h4 class="font-bold text-gray-800">Andi Pratama</h4>
                        <p class="text-gray-600">Surabaya</p>
                        <p class="text-sm text-orange-600">Sewa Hiace 12 Seat</p>
                    </div>
                </div>
                <div class="flex mb-4">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="italic text-gray-700">"Trip keluarga ke Malang jadi sangat nyaman dengan Hiace dari JustTrip. Pelayanan customer service responsif dan bus sesuai ekspektasi. Recommended!"</p>
            </div>

            <div class="p-8 shadow-lg bg-gradient-to-br from-green-50 to-green-100 rounded-xl" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center mb-6">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Maya" class="object-cover w-16 h-16 mr-4 rounded-full">
                    <div>
                        <h4 class="font-bold text-gray-800">Maya Sari</h4>
                        <p class="text-gray-600">Bandung</p>
                        <p class="text-sm text-green-600">Sewa Medium Bus 30 Seat</p>
                    </div>
                </div>
                <div class="flex mb-4">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="italic text-gray-700">"Gathering kantor ke Puncak menggunakan medium bus JustTrip. Semua karyawan puas dengan kenyamanan dan keamanan perjalanan. Terima kasih JustTrip!"</p>
            </div>
        </div>
    </div>
</section>

<!-- Destinations Section -->
<section class="py-12 sm:py-16 md:py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="container px-4 mx-auto">
        <div class="mb-8 text-center sm:mb-12 md:mb-16" data-aos="fade-up">
            <h2 class="mb-2 text-xl font-bold text-gray-800 sm:text-2xl md:text-3xl lg:text-4xl sm:mb-3 md:mb-4">Destinasi Populer</h2>
            <p class="max-w-3xl mx-auto text-sm text-gray-600 sm:text-base md:text-lg lg:text-xl">Jelajahi destinasi menakjubkan dengan paket tour terbaik dari JustTrip</p>
        </div>

        <!-- Tabs -->
        <div class="flex justify-center mb-12" data-aos="fade-up" data-aos-delay="100">
            <div class="p-2 bg-white rounded-full shadow-lg">
                <button class="px-8 py-3 font-semibold transition-all duration-300 rounded-full tab-btn active" data-tab="international">Internasional</button>
                <button class="px-8 py-3 font-semibold transition-all duration-300 rounded-full tab-btn" data-tab="domestic">Domestik</button>
            </div>
        </div>

        <!-- International Destinations -->
        <div id="international" class="tab-content active">
            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 lg:grid-cols-3 sm:gap-6 md:gap-8">
                <div class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg group rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bali" class="object-cover w-full h-48 transition-transform duration-500 sm:h-56 md:h-64 group-hover:scale-110">
                        <div class="absolute top-3 left-3 sm:top-4 sm:left-4">
                            <span class="px-2 py-1 text-xs font-semibold text-white rounded-full bg-gradient-to-r from-blue-500 to-blue-600 sm:px-3 sm:py-1 sm:text-sm">Populer</span>
                        </div>
                        <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/50 to-transparent group-hover:opacity-100"></div>
                    </div>
                    <div class="p-4 sm:p-5 md:p-6">
                        <h3 class="mb-1 text-base font-bold text-gray-800 sm:text-lg md:text-xl sm:mb-2">Bali</h3>
                        <p class="mb-3 text-xs text-gray-600 sm:text-sm md:text-base sm:mb-4">4D3N • Hotel 4* • Breakfast • Tour Guide</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-lg font-bold text-blue-600 sm:text-xl md:text-2xl">Rp 2.500.000</span>
                            <span class="text-xs text-gray-500 sm:text-sm">/person</span>
                        </div>
                        <button class="px-3 py-1 text-xs font-semibold text-white transition-all duration-300 transform rounded-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 sm:px-4 sm:py-2 md:px-6 md:py-2 sm:text-sm md:text-base hover:scale-105">Book Now</button>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg group rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1555400082-8c5cd5b3c3d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Singapore" class="object-cover w-full h-64 transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 text-sm font-semibold text-white rounded-full bg-gradient-to-r from-orange-500 to-orange-600">Promo</span>
                        </div>
                        <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/50 to-transparent group-hover:opacity-100"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-bold text-gray-800">Singapore</h3>
                        <p class="mb-4 text-gray-600">3D2N • Hotel 5* • Universal Studios • City Tour</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 4.200.000</span>
                            <span class="text-sm text-gray-500">/person</span>
                        </div>
                        <button class="px-6 py-2 font-semibold text-white transition-all duration-300 transform rounded-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 hover:scale-105">Book Now</button>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg group rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1528181304800-259b08848526?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Thailand" class="object-cover w-full h-64 transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 text-sm font-semibold text-white rounded-full bg-gradient-to-r from-slate-500 to-slate-600">Premium</span>
                        </div>
                        <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/50 to-transparent group-hover:opacity-100"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-bold text-gray-800">Thailand</h3>
                        <p class="mb-4 text-gray-600">5D4N • Hotel 4* • Temple Tour • Shopping</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 3.800.000</span>
                            <span class="text-sm text-gray-500">/person</span>
                        </div>
                        <button class="px-6 py-2 font-semibold text-white transition-all duration-300 transform rounded-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 hover:scale-105">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Corporate Bus Services -->
        <div id="domestic" class="hidden tab-content">
            <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
                <div class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg group rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Employee Gathering" class="object-cover w-full h-64 transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 text-sm font-semibold text-white rounded-full bg-gradient-to-r from-blue-500 to-blue-600">Corporate</span>
                        </div>
                        <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/50 to-transparent group-hover:opacity-100"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-bold text-gray-800">Employee Gathering</h3>
                        <p class="mb-4 text-gray-600">Medium Bus 25 Seat • AC • Sound System • WiFi</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 2.000.000</span>
                                <span class="text-sm text-gray-500">/hari</span>
                            </div>
                            <button class="px-6 py-2 font-semibold text-white transition-all duration-300 transform rounded-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 hover:scale-105">Sewa</button>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg group rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Meeting Transport" class="object-cover w-full h-64 transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 text-sm font-semibold text-white rounded-full bg-gradient-to-r from-orange-500 to-orange-600">Executive</span>
                        </div>
                        <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/50 to-transparent group-hover:opacity-100"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-bold text-gray-800">Meeting Transport</h3>
                        <p class="mb-4 text-gray-600">Hiace Executive • Leather Seat • AC • Mineral Water</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 1.500.000</span>
                                <span class="text-sm text-gray-500">/hari</span>
                            </div>
                            <button class="px-6 py-2 font-semibold text-white transition-all duration-300 transform rounded-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 hover:scale-105">Sewa</button>
                        </div>
                    </div>
                </div>

                <div class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg group rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Company Outing" class="object-cover w-full h-64 transition-transform duration-500 group-hover:scale-110">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1 text-sm font-semibold text-white rounded-full bg-gradient-to-r from-slate-500 to-slate-600">Premium</span>
                        </div>
                        <div class="absolute inset-0 transition-opacity duration-300 opacity-0 bg-gradient-to-t from-black/50 to-transparent group-hover:opacity-100"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="mb-2 text-xl font-bold text-gray-800">Company Outing</h3>
                        <p class="mb-4 text-gray-600">Big Bus 45 Seat • AC • Toilet • Entertainment System</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 2.800.000</span>
                                <span class="text-sm text-gray-500">/hari</span>
                            </div>
                            <button class="px-6 py-2 font-semibold text-white transition-all duration-300 transform rounded-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 hover:scale-105">Sewa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-12 text-center" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('packages.index') }}" class="inline-block px-8 py-4 text-lg font-bold text-white transition-all duration-300 transform bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 rounded-xl hover:scale-105 hover:shadow-xl">
                Lihat Semua Paket Tour
            </a>
        </div>
    </div>
</section>

<!-- Special Offers Section -->
<section class="py-20 bg-gradient-to-br from-orange-50 via-orange-100 to-teal-50">
    <div class="container px-4 mx-auto">
        <div class="mb-16 text-center" data-aos="fade-up">
            <h2 class="mb-4 text-4xl font-bold text-gray-800 md:text-5xl">Penawaran Spesial</h2>
            <p class="max-w-3xl mx-auto text-xl text-gray-600">Jangan lewatkan promo terbatas dan penawaran eksklusif dari JustTrip</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($featuredOffers->take(3) as $index => $offer)
            <div class="relative overflow-hidden transition-all duration-500 transform bg-white shadow-xl rounded-2xl hover:shadow-2xl hover:-translate-y-3" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="absolute top-0 right-0 z-10">
                    <div class="px-6 py-2 text-lg font-bold text-white bg-gradient-to-r from-orange-500 to-orange-600 rounded-bl-2xl">
                        <span class="text-2xl">{{ $offer->discount_percentage }}%</span> OFF
                    </div>
                </div>
                <div class="relative overflow-hidden">
                    @if($offer->image)
                        <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}" class="object-cover w-full h-64">
                    @else
                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $offer->title }}" class="object-cover w-full h-64">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute text-white bottom-4 left-4">
                        <h3 class="mb-2 text-2xl font-bold">{{ $offer->title }}</h3>
                        <p class="text-lg">{{ $offer->subtitle ?? 'Penawaran Terbatas!' }}</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-lg text-gray-400 line-through">Rp {{ number_format($offer->original_price, 0, ',', '.') }}</span>
                            <span class="ml-2 text-3xl font-bold text-orange-600">Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">{{ Str::limit($offer->description, 50) }}</p>
                    <div class="flex items-center justify-between">
                        @php
                            $daysLeft = now()->diffInDays($offer->valid_until, false);
                        @endphp
                        @if($daysLeft > 0)
                            <span class="text-sm font-semibold text-red-500">⏰ {{ $daysLeft }} hari lagi</span>
                        @else
                            <span class="text-sm font-semibold text-red-500">⏰ Berakhir hari ini</span>
                        @endif
                        <a href="{{ route('special-offers.show', $offer->slug) }}" class="px-6 py-2 font-semibold text-white transition-all duration-300 transform rounded-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 hover:scale-105">
                            Ambil Promo
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <!-- Fallback content if no featured offers -->
            <div class="relative overflow-hidden transition-all duration-500 transform bg-white shadow-xl rounded-2xl hover:shadow-2xl hover:-translate-y-3" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute top-0 right-0 z-10">
                    <div class="px-6 py-2 text-lg font-bold text-white bg-gradient-to-r from-orange-500 to-orange-600 rounded-bl-2xl">
                        <span class="text-2xl">50%</span> OFF
                    </div>
                </div>
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bali Special" class="object-cover w-full h-64">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute text-white bottom-4 left-4">
                        <h3 class="mb-2 text-2xl font-bold">Bali Paradise</h3>
                        <p class="text-lg">Flash Sale 24 Jam!</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-lg text-gray-400 line-through">Rp 5.000.000</span>
                            <span class="ml-2 text-3xl font-bold text-orange-600">Rp 2.500.000</span>
                        </div>
                    </div>
                    <p class="mb-4 text-gray-600">4D3N • Villa Private • All Inclusive</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm font-semibold text-red-500">⏰ Berakhir dalam 12 jam</span>
                        <a href="{{ route('special-offers.index') }}" class="px-6 py-2 font-semibold text-white transition-all duration-300 transform rounded-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 hover:scale-105">
                            Lihat Promo
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- View All Special Offers Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('special-offers.index') }}" class="inline-block px-8 py-4 text-lg font-semibold text-white transition-all duration-300 transform rounded-full shadow-lg bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 hover:scale-105 hover:shadow-xl">
                Lihat Semua Promo
            </a>
        </div>

        <!-- CTA Banner -->
        <div class="relative p-8 mt-16 overflow-hidden text-center text-white bg-gradient-to-r from-teal-500 via-cyan-500 to-slate-500 rounded-3xl md:p-12" data-aos="fade-up" data-aos-delay="400">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <h3 class="mb-4 text-3xl font-bold md:text-4xl">Dapatkan Notifikasi Promo Terbaru!</h3>
                <p class="mb-8 text-xl opacity-90">Subscribe newsletter kami dan jadi yang pertama tahu promo eksklusif</p>
                <div class="flex flex-col justify-center max-w-md gap-4 mx-auto sm:flex-row">
                    <input type="email" placeholder="Masukkan email Anda" class="flex-1 px-6 py-3 text-gray-800 rounded-full focus:outline-none focus:ring-4 focus:ring-white/30">
                    <button class="px-8 py-3 font-bold text-teal-600 transition-all duration-300 transform bg-white rounded-full hover:bg-gray-100 hover:scale-105">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- News/Articles Section -->
<section class="py-20 bg-white">
    <div class="container px-4 mx-auto">
        <div class="mb-16 text-center" data-aos="fade-up">
            <h2 class="mb-4 text-4xl font-bold text-gray-800 md:text-5xl">Artikel & Tips Travel</h2>
            <p class="max-w-3xl mx-auto text-xl text-gray-600">Dapatkan inspirasi dan tips terbaik untuk perjalanan Anda dari para ahli travel</p>
        </div>

        <div class="grid gap-8 md:grid-cols-2 lg:grid-cols-3">
            @forelse($latestNews->take(3) as $index => $article)
            <article class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="relative overflow-hidden">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="object-cover w-full h-64 transition-transform duration-500 hover:scale-110">
                    @else
                        <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $article->title }}" class="object-cover w-full h-64 transition-transform duration-500 hover:scale-110">
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 text-sm font-semibold text-white bg-teal-500 rounded-full">{{ $article->category ?? 'Travel' }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-3 text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $article->created_at->format('d M Y') }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $article->read_time ?? '5' }} min read</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-800 transition-colors duration-300 hover:text-teal-600">
                        {{ $article->title }}
                    </h3>
                    <p class="mb-4 text-gray-600 line-clamp-3">
                        {{ Str::limit(strip_tags($article->content), 120) }}
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @if($article->author_image)
                                <img src="{{ asset('storage/' . $article->author_image) }}" alt="{{ $article->author }}" class="object-cover w-8 h-8 mr-3 rounded-full">
                            @else
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" alt="{{ $article->author }}" class="object-cover w-8 h-8 mr-3 rounded-full">
                            @endif
                            <span class="text-sm text-gray-600">{{ $article->author ?? 'Admin' }}</span>
                        </div>
                        <a href="{{ route('articles.show', $article->slug) }}" class="text-sm font-semibold text-teal-600 transition-colors duration-300 hover:text-teal-800">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <!-- Fallback content if no articles -->
            <article class="overflow-hidden transition-all duration-500 transform bg-white shadow-lg rounded-2xl hover:shadow-2xl hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Travel Tips" class="object-cover w-full h-64 transition-transform duration-500 hover:scale-110">
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 text-sm font-semibold text-white bg-teal-500 rounded-full">Tips Travel</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center mb-3 text-sm text-gray-500">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>15 Januari 2024</span>
                        <span class="mx-2">•</span>
                        <span>5 min read</span>
                    </div>
                    <h3 class="mb-3 text-xl font-bold text-gray-800 transition-colors duration-300 hover:text-teal-600">
                        10 Tips Hemat Budget untuk Backpacker Pemula
                    </h3>
                    <p class="mb-4 text-gray-600 line-clamp-3">
                        Ingin traveling dengan budget terbatas? Simak tips jitu dari para backpacker berpengalaman untuk menjelajahi dunia tanpa menguras kantong.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" alt="Author" class="object-cover w-8 h-8 mr-3 rounded-full">
                            <span class="text-sm text-gray-600">Ahmad Rizki</span>
                        </div>
                        <a href="#" class="text-sm font-semibold text-teal-600 transition-colors duration-300 hover:text-teal-800">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </article>
            @endforelse
        </div>

        <!-- View All Articles Button -->
        <div class="mt-12 text-center">
            <a href="{{ route('articles.index') }}" class="inline-block px-8 py-4 text-lg font-semibold text-white transition-all duration-300 transform rounded-full shadow-lg bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 hover:scale-105 hover:shadow-xl">
                Lihat Semua Artikel
            </a>
        </div>
    </div>
</section>


<script>
document.addEventListener('DOMContentLoaded', function() {
    const slides = document.querySelectorAll('.slide');
    const dots = document.querySelectorAll('.slider-dot');
    const prevBtn = document.getElementById('prevSlide');
    const nextBtn = document.getElementById('nextSlide');
    let currentSlide = 0;
    let slideInterval;

    // Function to show specific slide
    function showSlide(index) {
        // Hide all slides
        slides.forEach(slide => {
            slide.classList.remove('active');
            slide.style.opacity = '0';
        });

        // Remove active class from all dots
        dots.forEach(dot => {
            dot.classList.remove('active');
            dot.style.backgroundColor = 'rgba(255, 255, 255, 0.5)';
        });

        // Show current slide
        slides[index].classList.add('active');
        slides[index].style.opacity = '1';

        // Highlight current dot
        dots[index].classList.add('active');
        dots[index].style.backgroundColor = 'rgba(255, 255, 255, 1)';

        currentSlide = index;
    }

    // Function to go to next slide
    function nextSlide() {
        const next = (currentSlide + 1) % slides.length;
        showSlide(next);
    }

    // Function to go to previous slide
    function prevSlide() {
        const prev = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(prev);
    }

    // Auto slide functionality
    function startAutoSlide() {
        slideInterval = setInterval(nextSlide, 5000); // Change slide every 5 seconds
    }

    function stopAutoSlide() {
        clearInterval(slideInterval);
    }

    // Event listeners for navigation buttons
    nextBtn.addEventListener('click', () => {
        stopAutoSlide();
        nextSlide();
        startAutoSlide();
    });

    prevBtn.addEventListener('click', () => {
        stopAutoSlide();
        prevSlide();
        startAutoSlide();
    });

    // Event listeners for dots
    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            stopAutoSlide();
            showSlide(index);
            startAutoSlide();
        });
    });

    // Pause auto slide on hover
    const sliderContainer = document.getElementById('heroSlider');
    sliderContainer.addEventListener('mouseenter', stopAutoSlide);
    sliderContainer.addEventListener('mouseleave', startAutoSlide);

    // Initialize slider
    showSlide(0);
    startAutoSlide();
});
</script>

@endsection
