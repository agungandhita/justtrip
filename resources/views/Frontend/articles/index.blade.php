@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Background Images with Parallax Effect -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-purple-600/70 via-pink-600/70 to-red-600/70 z-10"></div>
        <div class="bg-cover bg-center h-full" style="background-image: url('https://images.unsplash.com/photo-1455390582262-044cdead277a?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-20 text-center text-white px-4 max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-pink-100 bg-clip-text text-transparent">
            Travel Blog & Tips
        </h1>
        <p class="text-lg md:text-xl mb-8 text-pink-100 font-medium" data-aos="fade-up" data-aos-delay="200">
            Inspirasi perjalanan, tips travel, dan cerita menarik dari seluruh dunia
        </p>
    </div>
</section>

<!-- Featured Articles -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Artikel Pilihan</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Artikel terbaru dan terpopuler untuk menginspirasi perjalanan Anda</p>
        </div>
        
        <div class="grid lg:grid-cols-2 gap-12 mb-16">
            <!-- Featured Article 1 -->
            <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="100">
                <div class="relative overflow-hidden rounded-2xl mb-6">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bali Hidden Gems" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Destinasi</span>
                    </div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <p class="text-sm opacity-80 mb-2">15 Januari 2024</p>
                        <h3 class="text-2xl font-bold mb-2">10 Hidden Gems di Bali yang Wajib Dikunjungi</h3>
                        <p class="text-sm opacity-90">Temukan tempat-tempat tersembunyi di Bali yang belum banyak diketahui wisatawan</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-semibold text-gray-800">Sarah Wijaya</p>
                            <p class="text-gray-500 text-sm">Travel Writer</p>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-500 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        5 min read
                    </div>
                </div>
            </div>
            
            <!-- Featured Article 2 -->
            <div class="group cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                <div class="relative overflow-hidden rounded-2xl mb-6">
                    <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Budget Travel Tips" class="w-full h-80 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Tips</span>
                    </div>
                    <div class="absolute bottom-6 left-6 text-white">
                        <p class="text-sm opacity-80 mb-2">12 Januari 2024</p>
                        <h3 class="text-2xl font-bold mb-2">Cara Traveling Hemat dengan Budget Minim</h3>
                        <p class="text-sm opacity-90">Tips dan trik untuk menikmati perjalanan menarik tanpa menguras kantong</p>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="w-10 h-10 rounded-full mr-3">
                        <div>
                            <p class="font-semibold text-gray-800">Andi Pratama</p>
                            <p class="text-gray-500 text-sm">Travel Expert</p>
                        </div>
                    </div>
                    <div class="flex items-center text-gray-500 text-sm">
                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        8 min read
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Article Categories -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-slate-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Kategori Artikel</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Jelajahi artikel berdasarkan kategori yang Anda minati</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Category 1 -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Destinasi</h3>
                <p class="text-gray-600 text-center mb-6">Panduan lengkap destinasi wisata menarik di seluruh dunia</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-emerald-600">45</span>
                    <p class="text-gray-500 text-sm">artikel</p>
                </div>
            </div>
            
            <!-- Category 2 -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.663 17h4.673M12 3v1m6.364 1.636l-.707.707M21 12h-1M4 12H3m3.343-5.657l-.707-.707m2.828 9.9a5 5 0 117.072 0l-.548.547A3.374 3.374 0 0014 18.469V19a2 2 0 11-4 0v-.531c0-.895-.356-1.754-.988-2.386l-.548-.547z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Tips & Tricks</h3>
                <p class="text-gray-600 text-center mb-6">Tips praktis untuk perjalanan yang lebih nyaman dan hemat</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-blue-600">32</span>
                    <p class="text-gray-500 text-sm">artikel</p>
                </div>
            </div>
            
            <!-- Category 3 -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v13m0-13V6a2 2 0 112 2h-2zm0 0V5.5A2.5 2.5 0 109.5 8H12zm-7 4h14M5 12a2 2 0 110-4h14a2 2 0 110 4M5 12v7a2 2 0 002 2h10a2 2 0 002-2v-7"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Kuliner</h3>
                <p class="text-gray-600 text-center mb-6">Eksplorasi cita rasa kuliner khas dari berbagai negara</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-purple-600">28</span>
                    <p class="text-gray-500 text-sm">artikel</p>
                </div>
            </div>
            
            <!-- Category 4 -->
            <div class="group bg-white rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Fotografi</h3>
                <p class="text-gray-600 text-center mb-6">Tips fotografi travel untuk mengabadikan momen terbaik</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-orange-600">19</span>
                    <p class="text-gray-500 text-sm">artikel</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Latest Articles -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Artikel Terbaru</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Update terbaru dari dunia travel dan tips perjalanan</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Article 1 -->
            <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="100">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tokyo Travel" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Destinasi</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 text-sm mb-2">10 Januari 2024</p>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-emerald-600 transition-colors">Panduan Lengkap Liburan ke Tokyo untuk Pemula</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">Temukan tips dan trik untuk menjelajahi Tokyo dengan mudah, mulai dari transportasi hingga tempat wisata wajib dikunjungi.</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-gray-700 text-sm font-medium">Sarah Wijaya</span>
                        </div>
                        <span class="text-gray-500 text-sm">7 min read</span>
                    </div>
                </div>
            </article>
            
            <!-- Article 2 -->
            <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="200">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Mountain Travel" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Tips</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 text-sm mb-2">8 Januari 2024</p>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-emerald-600 transition-colors">5 Persiapan Penting Sebelum Mendaki Gunung</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">Panduan lengkap persiapan fisik dan mental sebelum melakukan pendakian gunung untuk pemula hingga expert.</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-gray-700 text-sm font-medium">Budi Santoso</span>
                        </div>
                        <span class="text-gray-500 text-sm">6 min read</span>
                    </div>
                </div>
            </article>
            
            <!-- Article 3 -->
            <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="300">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1414016642750-7fdd78dc33d9?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Food Travel" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-purple-500 to-pink-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Kuliner</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 text-sm mb-2">5 Januari 2024</p>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-emerald-600 transition-colors">Kuliner Khas Thailand yang Wajib Dicoba</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">Jelajahi cita rasa autentik Thailand melalui 10 makanan khas yang akan memanjakan lidah Anda.</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-gray-700 text-sm font-medium">Andi Pratama</span>
                        </div>
                        <span class="text-gray-500 text-sm">5 min read</span>
                    </div>
                </div>
            </article>
            
            <!-- Article 4 -->
            <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="400">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Budget Travel" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-orange-500 to-red-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Tips</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 text-sm mb-2">3 Januari 2024</p>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-emerald-600 transition-colors">Cara Menghemat Biaya Akomodasi Saat Traveling</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">Tips praktis untuk mendapatkan akomodasi terbaik dengan budget terbatas tanpa mengorbankan kenyamanan.</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-gray-700 text-sm font-medium">Sarah Wijaya</span>
                        </div>
                        <span class="text-gray-500 text-sm">4 min read</span>
                    </div>
                </div>
            </article>
            
            <!-- Article 5 -->
            <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="500">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1502602898536-47ad22581b52?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Europe Travel" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Destinasi</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 text-sm mb-2">1 Januari 2024</p>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-emerald-600 transition-colors">Itinerary 2 Minggu Keliling Eropa dengan Kereta</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">Panduan lengkap perjalanan 14 hari menggunakan Eurail Pass untuk menjelajahi 8 negara Eropa.</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-gray-700 text-sm font-medium">Budi Santoso</span>
                        </div>
                        <span class="text-gray-500 text-sm">12 min read</span>
                    </div>
                </div>
            </article>
            
            <!-- Article 6 -->
            <article class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2 cursor-pointer" data-aos="fade-up" data-aos-delay="600">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Photography" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Fotografi</span>
                    </div>
                </div>
                <div class="p-6">
                    <p class="text-gray-500 text-sm mb-2">28 Desember 2023</p>
                    <h3 class="text-xl font-bold text-gray-800 mb-3 group-hover:text-emerald-600 transition-colors">Tips Fotografi Landscape untuk Pemula</h3>
                    <p class="text-gray-600 mb-4 line-clamp-3">Teknik dasar fotografi landscape yang akan membantu Anda menghasilkan foto pemandangan yang menakjubkan.</p>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=100&q=80" alt="Author" class="w-8 h-8 rounded-full mr-2">
                            <span class="text-gray-700 text-sm font-medium">Andi Pratama</span>
                        </div>
                        <span class="text-gray-500 text-sm">9 min read</span>
                    </div>
                </div>
            </article>
        </div>
        
        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="700">
            <button class="bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Lihat Semua Artikel
            </button>
        </div>
    </div>
</section>

<!-- Newsletter Subscription -->
<section class="py-20 bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500">
    <div class="container mx-auto px-4">
        <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden" data-aos="fade-up">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <h3 class="text-3xl md:text-4xl font-bold mb-4">Jangan Lewatkan Artikel Terbaru!</h3>
                <p class="text-xl mb-8 opacity-90">Subscribe newsletter kami dan dapatkan tips travel terbaru langsung di inbox Anda</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center max-w-md mx-auto">
                    <input type="email" placeholder="Masukkan email Anda" class="flex-1 px-6 py-3 rounded-full text-gray-800 focus:outline-none focus:ring-4 focus:ring-white/30">
                    <button class="bg-white text-purple-600 font-bold px-8 py-3 rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                        Subscribe
                    </button>
                </div>
                <p class="text-sm opacity-75 mt-4">Gratis dan bisa unsubscribe kapan saja</p>
            </div>
        </div>
    </div>
</section>
@endsection