@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Slider -->
    <div class="absolute inset-0 z-0" id="heroSlider">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-900/80 via-blue-800/80 to-indigo-900/80 z-10"></div>

        <!-- Slider Images - Travel Theme -->
        <div class="slider-container h-full relative overflow-hidden">
            <div class="slide active bg-cover bg-center h-full transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
            <div class="slide bg-cover bg-center h-full transition-opacity duration-1000 opacity-0 absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
            <div class="slide bg-cover bg-center h-full transition-opacity duration-1000 opacity-0 absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
        </div>

        <!-- Slider Navigation Dots -->
        <div class="absolute bottom-20 left-1/2 transform -translate-x-1/2 z-20 flex space-x-3">
            <button class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300 active" data-slide="0"></button>
            <button class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-slide="1"></button>
            <button class="slider-dot w-3 h-3 rounded-full bg-white/50 hover:bg-white transition-all duration-300" data-slide="2"></button>
        </div>

        <!-- Slider Arrow Navigation -->
        <button class="absolute left-4 top-1/2 transform -translate-y-1/2 z-20 text-white/70 hover:text-white transition-all duration-300" id="prevSlide">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
            </svg>
        </button>
        <button class="absolute right-4 top-1/2 transform -translate-y-1/2 z-20 text-white/70 hover:text-white transition-all duration-300" id="nextSlide">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
            </svg>
        </button>
    </div>

    <!-- Hero Content -->
    <div class="relative z-20 text-center text-white px-4 max-w-6xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="text-5xl md:text-7xl font-bold mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
            Liburan Jadi Gampang
        </h1>
        <p class="text-xl md:text-2xl mb-8 text-blue-100 font-medium" data-aos="fade-up" data-aos-delay="200">
            Cukup sekali klik dengan JustTrip. Temukan destinasi impian dan nikmati perjalanan tak terlupakan.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('special-offers.index') }}" class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl text-center">
                <i class="fas fa-tags mr-2"></i>
                Lihat Promo Spesial
            </a>
            <a href="{{ route('packages.index') }}" class="border-2 border-white text-white hover:bg-white hover:text-blue-600 font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 text-center">
                <i class="fas fa-plane mr-2"></i>
                Jelajahi Destinasi
            </a>
        </div>

        <!-- Quick Search Form -->
        <div class="mt-12 bg-white/10 backdrop-blur-md rounded-2xl p-6 max-w-4xl mx-auto" data-aos="fade-up" data-aos-delay="600">
            <h3 class="text-xl font-semibold mb-4 text-white">Cari Destinasi Impian</h3>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Tanggal Keberangkatan</label>
                    <input type="date" class="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white placeholder-white/60 focus:outline-none focus:ring-2 focus:ring-orange-500">
                </div>
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Destinasi</label>
                    <select class="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">Pilih Destinasi</option>
                        <option value="bali">Bali</option>
                        <option value="yogyakarta">Yogyakarta</option>
                        <option value="bandung">Bandung</option>
                        <option value="lombok">Lombok</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-medium text-white/80 mb-2">Jumlah Traveler</label>
                    <select class="w-full px-4 py-3 rounded-lg bg-white/20 border border-white/30 text-white focus:outline-none focus:ring-2 focus:ring-orange-500">
                        <option value="">Pilih Jumlah</option>
                        <option value="1">1 Orang</option>
                        <option value="2">2 Orang</option>
                        <option value="3-5">3-5 Orang</option>
                        <option value="6+">6+ Orang</option>
                    </select>
                </div>
                <div class="flex items-end">
                    <button class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-3 px-6 rounded-lg transition-all duration-300 transform hover:scale-105">
                        <i class="fas fa-search mr-2"></i>
                        Cari Paket
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Scroll Indicator -->
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 z-20" data-aos="bounce" data-aos-delay="1000">
        <div class="w-6 h-10 border-2 border-white rounded-full flex justify-center">
            <div class="w-1 h-3 bg-white rounded-full mt-2 animate-bounce"></div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section class="py-20 bg-gradient-to-br from-slate-50 to-blue-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Mengapa Pilih JustTrip?</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Partner terpercaya untuk mewujudkan perjalanan impian Anda dengan layanan travel terbaik dan pengalaman tak terlupakan</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8 mb-20">
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-blue-600 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-map-marked-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Destinasi Terlengkap</h3>
                <p class="text-gray-600 text-center">Ratusan destinasi menarik dari dalam dan luar negeri dengan paket tour yang disesuaikan kebutuhan Anda</p>
            </div>

            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-orange-600 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-shield-alt text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Harga Transparan</h3>
                <p class="text-gray-600 text-center">Tidak ada biaya tersembunyi, harga kompetitif dengan kualitas pelayanan terbaik untuk setiap perjalanan</p>
            </div>

            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-green-600 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <i class="fas fa-headset text-white text-2xl"></i>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Pelayanan 24/7</h3>
                <p class="text-gray-600 text-center">Tim customer service berpengalaman siap membantu Anda kapan saja untuk perjalanan yang sempurna</p>
            </div>
        </div>

        <!-- Travel Services Section -->
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="text-center mb-6">
                    <i class="fas fa-plane text-4xl text-blue-600 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800">Paket Internasional</h3>
                    <p class="text-blue-600 font-semibold">Asia & Eropa</p>
                </div>
                <ul class="text-gray-600 space-y-2">
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Tiket pesawat & visa</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Hotel berbintang</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Tour guide berpengalaman</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Asuransi perjalanan</li>
                </ul>
            </div>

            <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="text-center mb-6">
                    <i class="fas fa-mountain text-4xl text-orange-600 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800">Paket Domestik</h3>
                    <p class="text-orange-600 font-semibold">Nusantara</p>
                </div>
                <ul class="text-gray-600 space-y-2">
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Transportasi lengkap</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Akomodasi terbaik</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Makan sesuai itinerary</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Dokumentasi perjalanan</li>
                </ul>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="300">
                <div class="text-center mb-6">
                    <i class="fas fa-users text-4xl text-green-600 mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800">Custom Trip</h3>
                    <p class="text-green-600 font-semibold">Sesuai Keinginan</p>
                </div>
                <ul class="text-gray-600 space-y-2">
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Itinerary fleksibel</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Budget sesuai kebutuhan</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Grup kecil atau besar</li>
                    <li><i class="fas fa-check text-green-500 mr-2"></i>Konsultasi gratis</li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Testimoni Pelanggan</h2>
            <p class="text-xl text-gray-600">Pengalaman nyata dari pelanggan yang telah menggunakan layanan sewa bus JustTrip</p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 rounded-xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center mb-6">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Sarah" class="w-16 h-16 rounded-full object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Sarah Putri</h4>
                        <p class="text-gray-600">Jakarta</p>
                        <p class="text-sm text-blue-600">Sewa Big Bus 45 Seat</p>
                    </div>
                </div>
                <div class="flex mb-4">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="text-gray-700 italic">"Sewa bus untuk study tour sekolah sangat memuaskan! Bus bersih, AC dingin, dan sopir sangat berpengalaman. Harga juga transparan tanpa biaya tersembunyi."</p>
            </div>

            <div class="bg-gradient-to-br from-orange-50 to-orange-100 rounded-xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center mb-6">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Andi" class="w-16 h-16 rounded-full object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Andi Pratama</h4>
                        <p class="text-gray-600">Surabaya</p>
                        <p class="text-sm text-orange-600">Sewa Hiace 12 Seat</p>
                    </div>
                </div>
                <div class="flex mb-4">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="text-gray-700 italic">"Trip keluarga ke Malang jadi sangat nyaman dengan Hiace dari JustTrip. Pelayanan customer service responsif dan bus sesuai ekspektasi. Recommended!"</p>
            </div>

            <div class="bg-gradient-to-br from-green-50 to-green-100 rounded-xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center mb-6">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Maya" class="w-16 h-16 rounded-full object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Maya Sari</h4>
                        <p class="text-gray-600">Bandung</p>
                        <p class="text-sm text-green-600">Sewa Medium Bus 30 Seat</p>
                    </div>
                </div>
                <div class="flex mb-4">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="text-gray-700 italic">"Gathering kantor ke Puncak menggunakan medium bus JustTrip. Semua karyawan puas dengan kenyamanan dan keamanan perjalanan. Terima kasih JustTrip!"</p>
            </div>
        </div>
    </div>
</section>

<!-- Destinations Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-blue-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Destinasi Populer</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Jelajahi destinasi menakjubkan dengan paket tour terbaik dari JustTrip</p>
        </div>

        <!-- Tabs -->
        <div class="flex justify-center mb-12" data-aos="fade-up" data-aos-delay="100">
            <div class="bg-white rounded-full p-2 shadow-lg">
                <button class="tab-btn active px-8 py-3 rounded-full font-semibold transition-all duration-300" data-tab="international">Internasional</button>
                <button class="tab-btn px-8 py-3 rounded-full font-semibold transition-all duration-300" data-tab="domestic">Domestik</button>
            </div>
        </div>

        <!-- International Destinations -->
        <div id="international" class="tab-content active">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bali" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">Populer</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Bali</h3>
                        <p class="text-gray-600 mb-4">4D3N • Hotel 4* • Breakfast • Tour Guide</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 2.500.000</span>
                            <span class="text-gray-500 text-sm">/person</span>
                        </div>
                        <button class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Book Now</button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1555400082-8c5cd5b3c3d5?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Singapore" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-3 py-1 rounded-full text-sm font-semibold">Promo</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Singapore</h3>
                        <p class="text-gray-600 mb-4">3D2N • Hotel 5* • Universal Studios • City Tour</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 4.200.000</span>
                            <span class="text-gray-500 text-sm">/person</span>
                        </div>
                        <button class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Book Now</button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1528181304800-259b08848526?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Thailand" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-slate-500 to-slate-600 text-white px-3 py-1 rounded-full text-sm font-semibold">Premium</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Thailand</h3>
                        <p class="text-gray-600 mb-4">5D4N • Hotel 4* • Temple Tour • Shopping</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 3.800.000</span>
                            <span class="text-gray-500 text-sm">/person</span>
                        </div>
                        <button class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Book Now</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Corporate Bus Services -->
        <div id="domestic" class="tab-content hidden">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1560472354-b33ff0c44a43?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Employee Gathering" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-3 py-1 rounded-full text-sm font-semibold">Corporate</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Employee Gathering</h3>
                        <p class="text-gray-600 mb-4">Medium Bus 25 Seat • AC • Sound System • WiFi</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 2.000.000</span>
                                <span class="text-gray-500 text-sm">/hari</span>
                            </div>
                            <button class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Sewa</button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Meeting Transport" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-3 py-1 rounded-full text-sm font-semibold">Executive</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Meeting Transport</h3>
                        <p class="text-gray-600 mb-4">Hiace Executive • Leather Seat • AC • Mineral Water</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 1.500.000</span>
                                <span class="text-gray-500 text-sm">/hari</span>
                            </div>
                            <button class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Sewa</button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1511632765486-a01980e01a18?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Company Outing" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-slate-500 to-slate-600 text-white px-3 py-1 rounded-full text-sm font-semibold">Premium</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Company Outing</h3>
                        <p class="text-gray-600 mb-4">Big Bus 45 Seat • AC • Toilet • Entertainment System</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-blue-600">Rp 2.800.000</span>
                                <span class="text-gray-500 text-sm">/hari</span>
                            </div>
                            <button class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Sewa</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
            <a href="{{ route('packages.index') }}" class="bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-600 hover:to-blue-700 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl inline-block">
                Lihat Semua Layanan Bus
            </a>
        </div>
    </div>
</section>

<!-- Special Offers Section -->
<section class="py-20 bg-gradient-to-br from-orange-50 via-orange-100 to-teal-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Penawaran Spesial</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Jangan lewatkan promo terbatas dan penawaran eksklusif dari JustTrip</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($featuredOffers->take(3) as $index => $offer)
            <div class="relative bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="absolute top-0 right-0 z-10">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-2 rounded-bl-2xl font-bold text-lg">
                        <span class="text-2xl">{{ $offer->discount_percentage }}%</span> OFF
                    </div>
                </div>
                <div class="relative overflow-hidden">
                    @if($offer->image)
                        <img src="{{ asset('storage/' . $offer->image) }}" alt="{{ $offer->title }}" class="w-full h-64 object-cover">
                    @else
                        <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $offer->title }}" class="w-full h-64 object-cover">
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-2xl font-bold mb-2">{{ $offer->title }}</h3>
                        <p class="text-lg">{{ $offer->subtitle ?? 'Penawaran Terbatas!' }}</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-gray-400 line-through text-lg">Rp {{ number_format($offer->original_price, 0, ',', '.') }}</span>
                            <span class="text-3xl font-bold text-orange-600 ml-2">Rp {{ number_format($offer->discounted_price, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">{{ Str::limit($offer->description, 50) }}</p>
                    <div class="flex items-center justify-between">
                        @php
                            $daysLeft = now()->diffInDays($offer->valid_until, false);
                        @endphp
                        @if($daysLeft > 0)
                            <span class="text-sm text-red-500 font-semibold">⏰ {{ $daysLeft }} hari lagi</span>
                        @else
                            <span class="text-sm text-red-500 font-semibold">⏰ Berakhir hari ini</span>
                        @endif
                        <a href="{{ route('special-offers.show', $offer->slug) }}" class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                            Ambil Promo
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <!-- Fallback content if no featured offers -->
            <div class="relative bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute top-0 right-0 z-10">
                    <div class="bg-gradient-to-r from-orange-500 to-orange-600 text-white px-6 py-2 rounded-bl-2xl font-bold text-lg">
                        <span class="text-2xl">50%</span> OFF
                    </div>
                </div>
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1571896349842-33c89424de2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bali Special" class="w-full h-64 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-2xl font-bold mb-2">Bali Paradise</h3>
                        <p class="text-lg">Flash Sale 24 Jam!</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-gray-400 line-through text-lg">Rp 5.000.000</span>
                            <span class="text-3xl font-bold text-orange-600 ml-2">Rp 2.500.000</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">4D3N • Villa Private • All Inclusive</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-red-500 font-semibold">⏰ Berakhir dalam 12 jam</span>
                        <a href="{{ route('special-offers.index') }}" class="bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                            Lihat Promo
                        </a>
                    </div>
                </div>
            </div>
            @endforelse
        </div>

        <!-- View All Special Offers Button -->
        <div class="text-center mt-12">
            <a href="{{ route('special-offers.index') }}" class="inline-block bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
                Lihat Semua Promo
            </a>
        </div>

        <!-- CTA Banner -->
        <div class="mt-16 bg-gradient-to-r from-teal-500 via-cyan-500 to-slate-500 rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden" data-aos="fade-up" data-aos-delay="400">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <h3 class="text-3xl md:text-4xl font-bold mb-4">Dapatkan Notifikasi Promo Terbaru!</h3>
                <p class="text-xl mb-8 opacity-90">Subscribe newsletter kami dan jadi yang pertama tahu promo eksklusif</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                    <input type="email" placeholder="Masukkan email Anda" class="flex-1 px-6 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-4 focus:ring-white/30">
                    <button class="bg-white text-teal-600 font-bold px-8 py-3 rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                        Subscribe
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- News/Articles Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Artikel & Tips Travel</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Dapatkan inspirasi dan tips terbaik untuk perjalanan Anda dari para ahli travel</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @forelse($latestNews->take(3) as $index => $article)
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="{{ ($index + 1) * 100 }}">
                <div class="relative overflow-hidden">
                    @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    @else
                        <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="{{ $article->title }}" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    @endif
                    <div class="absolute top-4 left-4">
                        <span class="bg-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">{{ $article->category ?? 'Travel' }}</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>{{ $article->created_at->format('d M Y') }}</span>
                        <span class="mx-2">•</span>
                        <span>{{ $article->read_time ?? '5' }} min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-teal-600 transition-colors duration-300">
                        {{ $article->title }}
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        {{ Str::limit(strip_tags($article->content), 120) }}
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            @if($article->author_image)
                                <img src="{{ asset('storage/' . $article->author_image) }}" alt="{{ $article->author }}" class="w-8 h-8 rounded-full object-cover mr-3">
                            @else
                                <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" alt="{{ $article->author }}" class="w-8 h-8 rounded-full object-cover mr-3">
                            @endif
                            <span class="text-gray-600 text-sm">{{ $article->author ?? 'Admin' }}</span>
                        </div>
                        <a href="{{ route('articles.show', $article->slug) }}" class="text-teal-600 hover:text-teal-800 font-semibold text-sm transition-colors duration-300">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <!-- Fallback content if no articles -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Travel Tips" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Tips Travel</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>15 Januari 2024</span>
                        <span class="mx-2">•</span>
                        <span>5 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-teal-600 transition-colors duration-300">
                        10 Tips Hemat Budget untuk Backpacker Pemula
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        Ingin traveling dengan budget terbatas? Simak tips jitu dari para backpacker berpengalaman untuk menjelajahi dunia tanpa menguras kantong.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" alt="Author" class="w-8 h-8 rounded-full object-cover mr-3">
                            <span class="text-gray-600 text-sm">Ahmad Rizki</span>
                        </div>
                        <a href="#" class="text-teal-600 hover:text-teal-800 font-semibold text-sm transition-colors duration-300">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            </article>
            @endforelse
        </div>

        <!-- View All Articles Button -->
        <div class="text-center mt-12">
            <a href="{{ route('articles.index') }}" class="inline-block bg-gradient-to-r from-teal-500 to-cyan-500 hover:from-teal-600 hover:to-cyan-600 text-white px-8 py-4 rounded-full font-semibold text-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-xl">
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
