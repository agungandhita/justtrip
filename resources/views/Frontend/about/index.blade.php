@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative min-h-[60vh] flex items-center justify-center overflow-hidden">
    <!-- Background Images with Parallax Effect -->
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-r from-blue-600/70 via-indigo-600/70 to-purple-600/70 z-10"></div>
        <div class="bg-cover bg-center h-full" style="background-image: url('https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1200&q=80')"></div>
    </div>
    
    <!-- Hero Content -->
    <div class="relative z-20 text-center text-white px-4 max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="1000">
        <h1 class="text-4xl md:text-6xl font-bold mb-6 bg-gradient-to-r from-white to-blue-100 bg-clip-text text-transparent">
            Tentang JustTrip
        </h1>
        <p class="text-lg md:text-xl mb-8 text-blue-100 font-medium" data-aos="fade-up" data-aos-delay="200">
            Mewujudkan perjalanan impian Anda dengan layanan terpercaya sejak 2015
        </p>
    </div>
</section>

<!-- About Us Section -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Cerita Kami</h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    JustTrip lahir dari passion untuk menjelajahi dunia dan keinginan untuk membuat perjalanan menjadi lebih mudah dan menyenangkan bagi semua orang. Sejak didirikan pada tahun 2015, kami telah melayani lebih dari 50.000 pelanggan dengan kepuasan 98%.
                </p>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Kami percaya bahwa setiap perjalanan adalah kesempatan untuk menciptakan kenangan indah, memperluas wawasan, dan membangun koneksi yang bermakna. Tim profesional kami berdedikasi untuk memberikan pengalaman perjalanan yang tak terlupakan.
                </p>
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-600 mb-2">50K+</div>
                        <div class="text-gray-600">Happy Customers</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-600 mb-2">8+</div>
                        <div class="text-gray-600">Years Experience</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-600 mb-2">200+</div>
                        <div class="text-gray-600">Destinations</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-600 mb-2">98%</div>
                        <div class="text-gray-600">Satisfaction Rate</div>
                    </div>
                </div>
            </div>
            <div data-aos="fade-left">
                <div class="relative">
                    <img src="https://images.unsplash.com/photo-1600880292203-757bb62b4baf?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" alt="About Us" class="rounded-2xl shadow-2xl">
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center">
                        <div class="text-white text-center">
                            <div class="text-2xl font-bold">2015</div>
                            <div class="text-sm">Founded</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Vision & Mission -->
<section class="py-20 bg-gradient-to-br from-blue-50 to-indigo-50">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Visi & Misi</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Komitmen kami untuk memberikan yang terbaik bagi setiap perjalanan Anda</p>
        </div>
        
        <div class="grid md:grid-cols-2 gap-12">
            <!-- Vision -->
            <div class="bg-white rounded-2xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="100">
                <div class="w-16 h-16 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Visi Kami</h3>
                <p class="text-gray-600 text-center leading-relaxed">
                    Menjadi platform travel terdepan di Indonesia yang menghubungkan setiap orang dengan pengalaman perjalanan terbaik di dunia, menciptakan kenangan indah yang akan diingat selamanya.
                </p>
            </div>
            
            <!-- Mission -->
            <div class="bg-white rounded-2xl p-8 shadow-lg" data-aos="fade-up" data-aos-delay="200">
                <div class="w-16 h-16 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mb-6 mx-auto">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 text-center">Misi Kami</h3>
                <ul class="text-gray-600 space-y-3">
                    <li class="flex items-start">
                        <span class="text-emerald-500 mr-2 mt-1">•</span>
                        Memberikan layanan travel berkualitas tinggi dengan harga terjangkau
                    </li>
                    <li class="flex items-start">
                        <span class="text-emerald-500 mr-2 mt-1">•</span>
                        Menghadirkan inovasi teknologi untuk kemudahan booking dan planning
                    </li>
                    <li class="flex items-start">
                        <span class="text-emerald-500 mr-2 mt-1">•</span>
                        Membangun kepercayaan melalui transparansi dan profesionalisme
                    </li>
                    <li class="flex items-start">
                        <span class="text-emerald-500 mr-2 mt-1">•</span>
                        Mendukung pariwisata berkelanjutan dan ramah lingkungan
                    </li>
                </ul>
            </div>
        </div>
    </div>
</section>

<!-- Our Values -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Nilai-Nilai Kami</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Prinsip yang memandu setiap langkah perjalanan bersama JustTrip</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Value 1 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-20 h-20 bg-gradient-to-r from-blue-500 to-indigo-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Passion</h3>
                <p class="text-gray-600">Cinta mendalam terhadap dunia travel dan komitmen untuk memberikan yang terbaik</p>
            </div>
            
            <!-- Value 2 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-20 h-20 bg-gradient-to-r from-emerald-500 to-teal-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5-6a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Trust</h3>
                <p class="text-gray-600">Membangun kepercayaan melalui transparansi, kejujuran, dan konsistensi layanan</p>
            </div>
            
            <!-- Value 3 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-20 h-20 bg-gradient-to-r from-purple-500 to-pink-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Innovation</h3>
                <p class="text-gray-600">Terus berinovasi dengan teknologi terdepan untuk pengalaman travel yang lebih baik</p>
            </div>
            
            <!-- Value 4 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="400">
                <div class="w-20 h-20 bg-gradient-to-r from-orange-500 to-red-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-3">Excellence</h3>
                <p class="text-gray-600">Komitmen untuk selalu memberikan layanan berkualitas tinggi dan melampaui ekspektasi</p>
            </div>
        </div>
    </div>
</section>

<!-- Team Section -->
<section class="py-20 bg-gradient-to-br from-gray-50 to-slate-100">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Tim Kami</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Bertemu dengan para profesional yang berdedikasi untuk perjalanan terbaik Anda</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Team Member 1 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg text-center group hover:shadow-2xl transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="relative mb-6">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="CEO" class="w-24 h-24 rounded-full mx-auto object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Andi Pratama</h3>
                <p class="text-emerald-600 font-semibold mb-3">CEO & Founder</p>
                <p class="text-gray-600 text-sm">Visioner di balik JustTrip dengan pengalaman 15+ tahun di industri travel dan teknologi</p>
            </div>
            
            <!-- Team Member 2 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg text-center group hover:shadow-2xl transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="relative mb-6">
                    <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="COO" class="w-24 h-24 rounded-full mx-auto object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Sarah Wijaya</h3>
                <p class="text-emerald-600 font-semibold mb-3">Chief Operating Officer</p>
                <p class="text-gray-600 text-sm">Ahli operasional yang memastikan setiap detail perjalanan berjalan dengan sempurna</p>
            </div>
            
            <!-- Team Member 3 -->
            <div class="bg-white rounded-2xl p-8 shadow-lg text-center group hover:shadow-2xl transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                <div class="relative mb-6">
                    <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-4.0.3&auto=format&fit=crop&w=300&q=80" alt="CTO" class="w-24 h-24 rounded-full mx-auto object-cover group-hover:scale-110 transition-transform duration-300">
                    <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-emerald-500 rounded-full flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                        </svg>
                    </div>
                </div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Budi Santoso</h3>
                <p class="text-emerald-600 font-semibold mb-3">Chief Technology Officer</p>
                <p class="text-gray-600 text-sm">Arsitek teknologi yang mengembangkan platform inovatif untuk pengalaman travel terbaik</p>
            </div>
        </div>
    </div>
</section>

<!-- Awards & Recognition -->
<section class="py-20 bg-white">
    <div class="container mx-auto px-4">
        <div class="text-center mb-16" data-aos="fade-up">
            <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Penghargaan & Sertifikasi</h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">Pengakuan atas dedikasi kami dalam memberikan layanan travel terbaik</p>
        </div>
        
        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Award 1 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-20 h-20 bg-gradient-to-r from-yellow-400 to-orange-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Best Travel Agency</h3>
                <p class="text-gray-600 text-sm">Indonesia Travel Awards 2023</p>
            </div>
            
            <!-- Award 2 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-20 h-20 bg-gradient-to-r from-emerald-400 to-teal-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">ISO 9001:2015</h3>
                <p class="text-gray-600 text-sm">Quality Management System</p>
            </div>
            
            <!-- Award 3 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-20 h-20 bg-gradient-to-r from-blue-400 to-indigo-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Top Digital Platform</h3>
                <p class="text-gray-600 text-sm">Digital Innovation Awards 2023</p>
            </div>
            
            <!-- Award 4 -->
            <div class="text-center group" data-aos="fade-up" data-aos-delay="400">
                <div class="w-20 h-20 bg-gradient-to-r from-purple-400 to-pink-500 rounded-full flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform duration-300">
                    <svg class="w-10 h-10 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M12.395 2.553a1 1 0 00-1.45-.385c-.345.23-.614.558-.822.88-.214.33-.403.713-.57 1.116-.334.804-.614 1.768-.84 2.734a31.365 31.365 0 00-.613 3.58 2.64 2.64 0 01-.945-1.067c-.328-.68-.398-1.534-.398-2.654A1 1 0 005.05 6.05 6.981 6.981 0 003 11a7 7 0 1011.95-4.95c-.592-.591-.98-.985-1.348-1.467-.363-.476-.724-1.063-1.207-2.03zM12.12 15.12A3 3 0 017 13s.879.5 2.5.5c0-1 .5-4 1.25-4.5.5 1 .786 1.293 1.371 1.879A2.99 2.99 0 0113 13a2.99 2.99 0 01-.879 2.121z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-800 mb-2">Customer Choice</h3>
                <p class="text-gray-600 text-sm">TripAdvisor Travelers' Choice 2023</p>
            </div>
        </div>
    </div>
</section>

<!-- Contact CTA -->
<section class="py-20 bg-gradient-to-r from-emerald-500 via-teal-500 to-cyan-500">
    <div class="container mx-auto px-4">
        <div class="bg-white/10 backdrop-blur-sm rounded-3xl p-8 md:p-12 text-center text-white relative overflow-hidden" data-aos="fade-up">
            <div class="absolute inset-0 bg-black/10"></div>
            <div class="relative z-10">
                <h3 class="text-3xl md:text-4xl font-bold mb-4">Siap Memulai Perjalanan Bersama Kami?</h3>
                <p class="text-xl mb-8 opacity-90">Hubungi tim profesional kami untuk konsultasi gratis dan dapatkan paket travel terbaik</p>
                <div class="flex flex-col sm:flex-row gap-4 justify-center">
                    <button class="bg-white text-emerald-600 font-bold px-8 py-4 rounded-full hover:bg-gray-100 transition-all duration-300 transform hover:scale-105">
                        Hubungi Kami
                    </button>
                    <button class="border-2 border-white text-white font-bold px-8 py-4 rounded-full hover:bg-white hover:text-emerald-600 transition-all duration-300 transform hover:scale-105">
                        Lihat Paket Tour
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection