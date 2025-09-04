@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Background Images with Parallax Effect -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/70 via-purple-600/70 to-violet-600/70 z-10"></div>
        <div class="bg-cover bg-center h-full" style="background-image: url('https://images.unsplash.com/photo-1488646953014-85cb44e25828?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-20 text-center text-white px-4 max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
            Destinasi Impian Anda
        </h1>
        <p class="text-lg md:text-xl mb-8 text-blue-100 font-medium" data-aos="fade-up" data-aos-delay="200">
            Jelajahi destinasi terbaik di seluruh dunia dengan paket tour eksklusif dari JustTrip
        </p>
    </div>
</section>

<!-- Destinations Section -->
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

                <!-- Additional International Destinations -->
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1539650116574-75c0c6d73f6e?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Dubai" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-yellow-500 to-orange-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Luxury</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Dubai, UAE</h3>
                        <p class="text-gray-600 mb-4">5 Hari 4 Malam • Hotel Bintang 5 • Desert Safari</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 15.800.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="500">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1506197603052-3cc9c3a201bd?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Maldives" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-cyan-500 to-blue-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Honeymoon</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Maldives</h3>
                        <p class="text-gray-600 mb-4">6 Hari 5 Malam • Water Villa • All Inclusive</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 35.000.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="600">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Seoul" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-pink-500 to-rose-500 text-white px-3 py-1 rounded-full text-sm font-semibold">K-Pop</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Seoul, Korea Selatan</h3>
                        <p class="text-gray-600 mb-4">5 Hari 4 Malam • Hotel Bintang 4 • K-Pop Tour</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 11.200.000</span>
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
                        <img src="https://images.unsplash.com/photo-1518548419970-58e3b4079ab2?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Lombok" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-teal-500 to-cyan-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Pantai</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Lombok, NTB</h3>
                        <p class="text-gray-600 mb-4">4 Hari 3 Malam • Pantai Eksotis • Snorkeling</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 1.800.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>

                <!-- Additional Domestic Destinations -->
                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1578662996442-48f60103fc96?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Raja Ampat" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Diving</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Raja Ampat, Papua</h3>
                        <p class="text-gray-600 mb-4">6 Hari 5 Malam • Diving Paradise • Liveaboard</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 8.500.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="500">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Bromo" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-orange-500 to-yellow-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Adventure</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Bromo Tengger, Jawa Timur</h3>
                        <p class="text-gray-600 mb-4">3 Hari 2 Malam • Sunrise Tour • Jeep Adventure</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 1.500.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>

                <div class="group bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="600">
                    <div class="relative overflow-hidden">
                        <img src="https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="Labuan Bajo" class="w-full h-64 object-cover group-hover:scale-110 transition-transform duration-500">
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-green-500 to-emerald-500 text-white px-3 py-1 rounded-full text-sm font-semibold">Komodo</span>
                        </div>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    </div>
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-800 mb-2">Labuan Bajo, NTT</h3>
                        <p class="text-gray-600 mb-4">5 Hari 4 Malam • Komodo Island • Island Hopping</p>
                        <div class="flex items-center justify-between">
                            <div>
                                <span class="text-2xl font-bold text-emerald-600">Rp 4.200.000</span>
                                <span class="text-gray-500 text-sm">/orang</span>
                            </div>
                            <button class="bg-gradient-to-r from-emerald-500 to-teal-500 hover:from-emerald-600 hover:to-teal-600 text-white px-6 py-2 rounded-full font-semibold transition-all duration-300 transform hover:scale-105">Detail</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
// Tab functionality
document.addEventListener('DOMContentLoaded', function() {
    const tabBtns = document.querySelectorAll('.tab-btn');
    const tabContents = document.querySelectorAll('.tab-content');
    
    tabBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const targetTab = btn.getAttribute('data-tab');
            
            // Remove active class from all buttons and contents
            tabBtns.forEach(b => b.classList.remove('active', 'bg-blue-500', 'text-white'));
            tabContents.forEach(content => {
                content.classList.add('hidden');
                content.classList.remove('active');
            });
            
            // Add active class to clicked button
            btn.classList.add('active', 'bg-blue-500', 'text-white');
            
            // Show target content
            const targetContent = document.getElementById(targetTab);
            if (targetContent) {
                targetContent.classList.remove('hidden');
                targetContent.classList.add('active');
            }
        });
    });
    
    // Set initial active state
    const firstBtn = document.querySelector('.tab-btn.active');
    if (firstBtn) {
        firstBtn.classList.add('bg-blue-500', 'text-white');
    }
});
</script>
@endsection