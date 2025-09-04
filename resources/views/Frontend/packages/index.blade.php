@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Background Images with Parallax Effect -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-emerald-600/70 via-teal-600/70 to-cyan-600/70 z-10"></div>
        <div class="bg-cover bg-center h-full" style="background-image: url('https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-20 text-center text-white px-4 max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-emerald-100 bg-clip-text text-transparent">
            Paket Tour Terbaik
        </h1>
        <p class="text-lg md:text-xl mb-8 text-emerald-100 font-medium" data-aos="fade-up" data-aos-delay="200">
            Nikmati liburan impian dengan paket tour all-inclusive yang dirancang khusus untuk Anda
        </p>
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
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bali Package" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-red-500 to-pink-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Flash Sale</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-2xl font-bold mb-2">Bali Paradise</h3>
                        <p class="text-lg">Limited Time Offer</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-gray-400 line-through text-lg">Rp 3.500.000</span>
                            <span class="text-3xl font-bold text-emerald-600 ml-2">Rp 2.499.000</span>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">4D3N • Ubud & Seminyak • Private Pool Villa</p>
                    <div class="flex items-center justify-between">
                        <span class="text-sm text-red-500 font-semibold">🔥 Berakhir dalam 2 hari</span>
                        <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                            Book Now
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Special Deal 2 -->
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Korea Package" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Early Bird</span>
                    </div>
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
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1502602898536-47ad22581b52?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Europe Package" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Group Tour</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 text-white">
                        <h3 class="text-2xl font-bold mb-2">Europe Grand Tour</h3>
                        <p class="text-lg">Group Package</p>
                    </div>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-gray-400 line-through text-lg">Rp 45.000.000</span>
                            <span class="text-3xl font-bold text-emerald-600 ml-2">Rp 32.000.000</span>
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
    </div>
</section>

<!-- Package Categories -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Kategori Paket Tour</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Pilih paket tour sesuai dengan preferensi dan budget Anda</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Honeymoon Package -->
            <div class="group bg-gradient-to-br from-pink-50 to-rose-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-r from-pink-500 to-rose-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Honeymoon Package</h3>
                <p class="text-gray-600 text-center mb-6">Paket romantis untuk pasangan yang baru menikah dengan destinasi eksotis</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-pink-600">Mulai Rp 8.500.000</span>
                    <p class="text-gray-500 text-sm">/couple</p>
                </div>
            </div>
            
            <!-- Family Package -->
            <div class="group bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Family Package</h3>
                <p class="text-gray-600 text-center mb-6">Paket liburan keluarga dengan aktivitas menyenangkan untuk semua usia</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-blue-600">Mulai Rp 3.200.000</span>
                    <p class="text-gray-500 text-sm">/orang</p>
                </div>
            </div>
            
            <!-- Adventure Package -->
            <div class="group bg-gradient-to-br from-emerald-50 to-teal-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Adventure Package</h3>
                <p class="text-gray-600 text-center mb-6">Paket petualangan untuk pencinta adrenalin dan aktivitas outdoor</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-emerald-600">Mulai Rp 2.800.000</span>
                    <p class="text-gray-500 text-sm">/orang</p>
                </div>
            </div>
            
            <!-- Luxury Package -->
            <div class="group bg-gradient-to-br from-yellow-50 to-orange-50 rounded-2xl p-8 shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-gradient-to-r from-yellow-500 to-orange-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-4 text-center">Luxury Package</h3>
                <p class="text-gray-600 text-center mb-6">Paket mewah dengan akomodasi dan layanan premium terbaik</p>
                <div class="text-center">
                    <span class="text-2xl font-bold text-orange-600">Mulai Rp 15.000.000</span>
                    <p class="text-gray-500 text-sm">/orang</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Popular Packages -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-slate-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Paket Tour Populer</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Paket tour terlaris yang dipilih oleh ribuan pelanggan JustTrip</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Package 1 -->
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="100">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1540959733332-eab4deabeeaf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Tokyo Package" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-blue-500 to-purple-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Best Seller</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Tokyo Cherry Blossom</h3>
                    <p class="text-gray-600 mb-4">5D4N • Tokyo & Kyoto • Sakura Season • Hotel 4★</p>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-2xl font-bold text-emerald-600">Rp 12.500.000</span>
                            <span class="text-gray-500 text-sm">/orang</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-400 mr-1">★★★★★</span>
                            <span class="text-gray-600 text-sm">(4.8)</span>
                        </div>
                    </div>
                    <ul class="text-gray-600 text-sm mb-4 space-y-1">
                        <li>✓ Tiket pesawat PP</li>
                        <li>✓ Hotel 4 bintang</li>
                        <li>✓ Makan 3x sehari</li>
                        <li>✓ Tour guide lokal</li>
                    </ul>
                    <button class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                        Lihat Detail
                    </button>
                </div>
            </div>
            
            <!-- Package 2 -->
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="200">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bali Package" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-emerald-500 to-teal-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Favorit</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Bali Romantic Getaway</h3>
                    <p class="text-gray-600 mb-4">4D3N • Ubud & Seminyak • Private Villa • Couple Package</p>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-2xl font-bold text-emerald-600">Rp 4.200.000</span>
                            <span class="text-gray-500 text-sm">/couple</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-400 mr-1">★★★★★</span>
                            <span class="text-gray-600 text-sm">(4.9)</span>
                        </div>
                    </div>
                    <ul class="text-gray-600 text-sm mb-4 space-y-1">
                        <li>✓ Private villa dengan pool</li>
                        <li>✓ Romantic dinner</li>
                        <li>✓ Spa couple treatment</li>
                        <li>✓ Airport transfer</li>
                    </ul>
                    <button class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                        Lihat Detail
                    </button>
                </div>
            </div>
            
            <!-- Package 3 -->
            <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="relative overflow-hidden">
                    <img src="https://images.unsplash.com/photo-1502602898536-47ad22581b52?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Europe Package" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                    <div class="absolute top-4 left-4">
                        <span class="bg-gradient-to-r from-purple-500 to-indigo-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Premium</span>
                    </div>
                    <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                </div>
                <div class="p-6">
                    <h3 class="text-xl font-bold text-gray-800 mb-2">Europe Classic Tour</h3>
                    <p class="text-gray-600 mb-4">10D9N • Paris, Rome, London • Luxury Hotels • Small Group</p>
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <span class="text-2xl font-bold text-emerald-600">Rp 28.500.000</span>
                            <span class="text-gray-500 text-sm">/orang</span>
                        </div>
                        <div class="flex items-center">
                            <span class="text-yellow-400 mr-1">★★★★★</span>
                            <span class="text-gray-600 text-sm">(4.7)</span>
                        </div>
                    </div>
                    <ul class="text-gray-600 text-sm mb-4 space-y-1">
                        <li>✓ Hotel mewah 5 bintang</li>
                        <li>✓ High-speed train</li>
                        <li>✓ Museum & attraction tickets</li>
                        <li>✓ Professional guide</li>
                    </ul>
                    <button class="w-full bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white py-3 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">
                        Lihat Detail
                    </button>
                </div>
            </div>
        </div>
        
        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="400">
            <button class="bg-gradient-to-r from-blue-500 to-purple-500 hover:from-blue-600 hover:to-purple-600 text-white font-bold py-4 px-8 rounded-xl text-lg transition-all duration-300 transform hover:scale-105 hover:shadow-xl">
                Lihat Semua Paket Tour
            </button>
        </div>
    </div>
</section>

<!-- CTA Newsletter -->
<section class="py-20 bg-gradient-to-r from-fuchsia-500 via-purple-500 to-indigo-500">
    <div class="container mx-auto px-4">
        <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden" data-aos="fade-up">
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
@endsection