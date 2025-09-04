@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-screen flex items-center justify-center overflow-hidden">
    <!-- Background Slider -->
    <div class="absolute inset-0 z-0" id="heroSlider">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/70 via-purple-600/70 to-violet-600/70 z-10"></div>
        
        <!-- Slider Images -->
        <div class="slider-container h-full relative overflow-hidden">
            <div class="slide active bg-cover bg-center h-full transition-opacity duration-1000" style="background-image: url('https://images.unsplash.com/photo-1544735716-392fe2489ffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
            <div class="slide bg-cover bg-center h-full transition-opacity duration-1000 opacity-0 absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
            <div class="slide bg-cover bg-center h-full transition-opacity duration-1000 opacity-0 absolute inset-0" style="background-image: url('https://images.unsplash.com/photo-1502602898536-47ad22581b52?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80')"></div>
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
            Explore the World with JustTrip
        </h1>
        <p class="text-xl md:text-2xl mb-8 text-blue-100 font-medium" data-aos="fade-up" data-aos-delay="200">
            Liburan jadi gampang, cukup sekali klik dengan JustTrip.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center" data-aos="fade-up" data-aos-delay="400">
            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Pesan Sekarang
            </button>
            <button class="border-2 border-white text-white hover:bg-white hover:text-purple-600 font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105">
                Lihat Destinasi
            </button>
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
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Tentang JustTrip</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Platform travel terpercaya yang menghadirkan pengalaman liburan tak terlupakan dengan kemudahan booking sekali klik</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8 mb-20">
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-purple-500 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Destinasi Terlengkap</h3>
                <p class="text-gray-600 text-center">Ribuan destinasi domestik dan internasional siap memenuhi impian liburan Anda</p>
            </div>
            
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Harga Terbaik</h3>
                <p class="text-gray-600 text-center">Dapatkan harga terbaik dengan berbagai promo menarik dan cashback menggiurkan</p>
            </div>
            
            <div class="bg-white rounded-xl p-8 shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-r from-violet-500 to-purple-500 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Pelayanan 24/7</h3>
                <p class="text-gray-600 text-center">Tim customer service siap membantu Anda kapan saja dengan pelayanan terbaik</p>
            </div>
        </div>
    </div>
</section>

<!-- Testimonials Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Kata Mereka</h2>
            <p class="text-xl text-gray-600">Pengalaman nyata dari pelanggan setia JustTrip</p>
        </div>
        
        <div class="grid md:grid-cols-3 gap-8">
            <div class="bg-gradient-to-br from-blue-50 to-purple-50 rounded-xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center mb-6">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Sarah" class="w-16 h-16 rounded-full object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Sarah Putri</h4>
                        <p class="text-gray-600">Jakarta</p>
                    </div>
                </div>
                <div class="flex mb-4">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="text-gray-700 italic">"Booking trip ke Bali jadi super mudah! Pelayanannya ramah dan harga sangat kompetitif. Pasti bakal pakai JustTrip lagi!"</p>
            </div>
            
            <div class="bg-gradient-to-br from-emerald-50 to-teal-50 rounded-xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="flex items-center mb-6">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Andi" class="w-16 h-16 rounded-full object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Andi Pratama</h4>
                        <p class="text-gray-600">Surabaya</p>
                    </div>
                </div>
                <div class="flex mb-4">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="text-gray-700 italic">"Honeymoon ke Jepang jadi tak terlupakan berkat JustTrip. Semua terorganisir dengan baik, recommended banget!"</p>
            </div>
            
            <div class="bg-gradient-to-br from-violet-50 to-purple-50 rounded-xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="300">
                <div class="flex items-center mb-6">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=150&q=80" alt="Maya" class="w-16 h-16 rounded-full object-cover mr-4">
                    <div>
                        <h4 class="font-bold text-gray-800">Maya Sari</h4>
                        <p class="text-gray-600">Bandung</p>
                    </div>
                </div>
                <div class="flex mb-4">
                    <span class="text-yellow-400">★★★★★</span>
                </div>
                <p class="text-gray-700 italic">"Family trip ke Yogya jadi lebih seru! Anak-anak senang, orang tua juga puas. Terima kasih JustTrip!"</p>
            </div>
        </div>
    </div>
</section>

<!-- Product/Destinations Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-slate-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Destinasi Populer</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Jelajahi destinasi impian Anda dengan paket tour terbaik dari JustTrip</p>
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
                        <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tokyo" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Populer</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Tokyo, Jepang</h3>
                        <p class="text-gray-600 mb-4">5 Hari 4 Malam • Hotel Bintang 4 • Termasuk Visa</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 12.500.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>
                
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1502602898536-47ad22581b52?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Paris" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-fuchsia-500 to-pink-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Promo</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Paris, Prancis</h3>
                        <p class="text-gray-600 mb-4">6 Hari 5 Malam • Hotel Bintang 5 • City Tour</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 18.900.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>
                
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Santorini" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Eksklusif</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Santorini, Yunani</h3>
                        <p class="text-gray-600 mb-4">7 Hari 6 Malam • Resort Mewah • Private Tour</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 25.000.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Domestic Destinations -->
        <div id="domestic" class="tab-content hidden">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bali" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Favorit</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Bali, Indonesia</h3>
                        <p class="text-gray-600 mb-4">4 Hari 3 Malam • Hotel Bintang 4 • Antar Jemput</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 2.500.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>
                
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1596422846543-75c6fc197f07?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Yogyakarta" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Budaya</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Yogyakarta</h3>
                        <p class="text-gray-600 mb-4">3 Hari 2 Malam • Wisata Budaya • Kuliner</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 1.200.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>
                
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1558618666-fcd25c85cd64?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Raja Ampat" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Diving</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Raja Ampat</h3>
                        <p class="text-gray-600 mb-4">5 Hari 4 Malam • Diving Paradise • Liveaboard</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 8.500.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
            <button class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Lihat Semua Destinasi
            </button>
        </div>
    </div>
</section>

<!-- Special Offers Section -->
<section class="py-20 bg-gradient-to-br from-fuchsia-50 via-purple-50 to-indigo-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Penawaran Spesial</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Jangan lewatkan promo terbatas dan penawaran eksklusif dari JustTrip</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Special Deal 1 -->
            <div class="relative bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute top-0 right-0 z-10">
                    <div class="bg-gradient-to-r from-fuchsia-500 to-pink-500 text-white px-6 py-2 rounded-bl-2xl font-bold text-lg">
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
                            <span class="text-3xl font-bold text-fuchsia-600 ml-2">Rp 2.500.000</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">4D3N • Villa Private • All Inclusive</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-red-500 font-semibold">⏰ Berakhir dalam 12 jam</span>
                        <button class="bg-gradient-to-r from-fuchsia-500 to-pink-500 hover:from-fuchsia-600 hover:to-pink-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                            Ambil Promo
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Special Deal 2 -->
            <div class="relative bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="200">
                <div class="absolute top-0 right-0 z-10">
                    <div class="bg-gradient-to-r from-indigo-500 to-blue-500 text-white px-6 py-2 rounded-bl-2xl font-bold text-lg">
                        <span class="text-2xl">30%</span> OFF
                    </div>
                </div>
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1493780474015-ba834fd0ce2f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Korea Special" class="w-full h-64 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-2xl font-bold mb-2">Korea Autumn</h3>
                        <p class="text-lg">Early Bird Special</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-gray-400 line-through text-lg">Rp 15.000.000</span>
                            <span class="text-3xl font-bold text-indigo-600 ml-2">Rp 10.500.000</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">6D5N • Seoul & Busan • K-Pop Tour</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-orange-500 font-semibold">🔥 Hanya 20 slot tersisa</span>
                        <button class="bg-gradient-to-r from-indigo-500 to-blue-500 hover:from-indigo-600 hover:to-blue-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Special Deal 3 -->
            <div class="relative bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-3" data-aos="fade-up" data-aos-delay="300">
                <div class="absolute top-0 right-0 z-10">
                    <div class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-6 py-2 rounded-bl-2xl font-bold text-lg">
                        <span class="text-2xl">40%</span> OFF
                    </div>
                </div>
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1539650116574-75c0c6d73f6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Europe Special" class="w-full h-64 object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-2xl font-bold mb-2">Europe Grand Tour</h3>
                        <p class="text-lg">Group Discount</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-gray-400 line-through text-lg">Rp 35.000.000</span>
                            <span class="text-3xl font-bold text-emerald-600 ml-2">Rp 21.000.000</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">12D11N • 7 Countries • Luxury Hotels</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-green-500 font-semibold">✅ Min. 10 orang</span>
                        <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                            Join Group
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- CTA Banner -->
        <div class="mt-16 bg-gradient-to-r from-fuchsia-500 via-purple-500 to-indigo-500 rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden" data-aos="fade-up" data-aos-delay="400">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <h3 class="text-3xl md:text-4xl font-bold mb-4">Dapatkan Notifikasi Promo Terbaru!</h3>
                <p class="text-xl mb-8 opacity-90">Subscribe newsletter kami dan jadi yang pertama tahu promo eksklusif</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                    <input type="email" placeholder="Masukkan email Anda" class="flex-1 px-6 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-4 focus:ring-white/30">
                    <button class="bg-white text-purple-600 font-bold px-8 py-3 rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
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
            <!-- Article 1 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Travel Tips" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Tips Travel</span>
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
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition-colors duration-300">
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
                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors duration-300">
                            Baca Selengkapnya →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 2 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Hidden Gems" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-emerald-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Destinasi</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>12 Januari 2024</span>
                        <span class="mx-2">•</span>
                        <span>8 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition-colors duration-300">
                        5 Hidden Gems di Indonesia yang Wajib Dikunjungi
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        Jelajahi keindahan tersembunyi Indonesia yang belum banyak diketahui wisatawan. Dari pantai eksotis hingga gunung menawan.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" alt="Author" class="w-8 h-8 rounded-full object-cover mr-3">
                            <span class="text-gray-600 text-sm">Sari Dewi</span>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors duration-300">
                            Baca Selengkapnya →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 3 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1436491865332-7a61a109cc05?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Solo Travel" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Solo Travel</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>10 Januari 2024</span>
                        <span class="mx-2">•</span>
                        <span>6 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition-colors duration-300">
                        Panduan Lengkap Solo Traveling untuk Wanita
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        Tips keamanan dan persiapan yang perlu diketahui wanita sebelum melakukan perjalanan sendirian ke berbagai destinasi.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" alt="Author" class="w-8 h-8 rounded-full object-cover mr-3">
                            <span class="text-gray-600 text-sm">Maya Putri</span>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors duration-300">
                            Baca Selengkapnya →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 4 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Photography" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Photography</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>8 Januari 2024</span>
                        <span class="mx-2">•</span>
                        <span>7 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition-colors duration-300">
                        Teknik Fotografi Travel untuk Hasil Instagramable
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        Pelajari teknik dasar fotografi travel untuk menghasilkan foto-foto menawan yang siap dipamerkan di media sosial.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" alt="Author" class="w-8 h-8 rounded-full object-cover mr-3">
                            <span class="text-gray-600 text-sm">Budi Santoso</span>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors duration-300">
                            Baca Selengkapnya →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 5 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="500">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Culinary" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Kuliner</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>5 Januari 2024</span>
                        <span class="mx-2">•</span>
                        <span>4 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition-colors duration-300">
                        Wisata Kuliner Terbaik di Asia Tenggara
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        Jelajahi cita rasa autentik dari berbagai negara Asia Tenggara yang akan memanjakan lidah para food lover.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" alt="Author" class="w-8 h-8 rounded-full object-cover mr-3">
                            <span class="text-gray-600 text-sm">Chef Andi</span>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors duration-300">
                            Baca Selengkapnya →
                        </button>
                    </div>
                </div>
            </article>
            
            <!-- Article 6 -->
            <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="600">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Budget Travel" class="w-full h-64 object-cover hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Budget</span>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center text-gray-500 text-sm mb-3">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                        <span>3 Januari 2024</span>
                        <span class="mx-2">•</span>
                        <span>6 min read</span>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 hover:text-blue-600 transition-colors duration-300">
                        Liburan Mewah dengan Budget Minim? Bisa!
                    </h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        Strategi jitu untuk menikmati liburan berkelas tanpa harus mengeluarkan biaya yang fantastis. Simak tipsnya di sini.
                    </p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=50&q=80" alt="Author" class="w-8 h-8 rounded-full object-cover mr-3">
                            <span class="text-gray-600 text-sm">Lisa Maharani</span>
                        </div>
                        <button class="text-blue-600 hover:text-blue-800 font-semibold text-sm transition-colors duration-300">
                            Baca Selengkapnya →
                        </button>
                    </div>
                </div>
            </article>
        </div>
        
        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="700">
            <button class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Lihat Semua Artikel
            </button>
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
