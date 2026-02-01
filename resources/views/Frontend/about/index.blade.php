@extends('Frontend.layouts.main')

@section('container')
<!-- Hero Section -->
<section class="relative w-full">
    <img src="{{ asset('image/TENTANG-JUSTTRIP.png') }}" alt="Paket Tour Background" class="w-full h-auto">
</section>

<!-- About Us Section -->
<section id="about-us" class="py-20 bg-white overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            <div data-aos="fade-right" data-aos-offset="200">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6">Cerita Kami</h2>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    JUSTTRIP hadir dari 2017 sebagai partner perjalanan untuk perusahaan dan keluarga besar yang percaya bahwa kebersamaan adalah fondasi kekuatan tim dan hubungan.
                </p>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Lebih dari 200+ perusahaan yang bersama dengan kami, tidak hanya mengatur perjalanan, tetapi merancang pengalaman yang membangun semangat, memperkuat kolaborasi, dan menciptakan momen kebersamaan yang bermakna—baik untuk corporate gathering, outbound, maupun family gathering.
                </p>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Dengan pengalaman menangani program perjalanan untuk perusahaan swasta, BUMN, instansi pemerintah, hingga keluarga besar, Justtrip telah dipercaya mengelola perjalanan dengan jumlah peserta mulai dari puluhan hingga ratusan orang dalam berbagai skala acara.
                </p>
                <p class="text-lg text-gray-600 mb-6 leading-relaxed">
                    Kami memahami bahwa setiap perusahaan dan setiap keluarga memiliki karakter yang berbeda. Karena itu, seluruh program kami dirancang custom, bukan hasil copy–paste, dan disesuaikan dengan tujuan, budaya, serta kebutuhan peserta.
                </p>
                <p class="text-lg text-gray-600 mb-8 leading-relaxed">
                    Melalui pendekatan berbasis HR experience, manajemen acara yang rapi, dan layanan menyeluruh dari awal hingga akhir, Justtrip siap membantu menciptakan perjalanan yang bukan hanya seru, tetapi juga berdampak dan berkesan.
                </p>
                <p class="text-xl text-gray-800 font-semibold mb-8 italic">
                    Let's create meaningful journeys — not just itineraries.
                </p>
                <div class="grid grid-cols-2 gap-6">
                    <div class="text-center">
                        <div class="text-3xl font-bold text-teal-600 mb-2">200+</div>
                        <div class="text-gray-600">Perusahaan</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-teal-600 mb-2">9+</div>
                        <div class="text-gray-600">Tahun Pengalaman</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-600 mb-2">100+</div>
                        <div class="text-gray-600">Event Terselenggara</div>
                    </div>
                    <div class="text-center">
                        <div class="text-3xl font-bold text-emerald-600 mb-2">Ratusan</div>
                        <div class="text-gray-600">Peserta Per Event</div>
                    </div>
                </div>
            </div>
            <div data-aos="fade-left">
                <div class="relative group">
                    <img src="{{ asset('image/KOTAK.png') }}" alt="JustTrip Illustration" class="rounded-2xl shadow-2xl transform group-hover:scale-[1.02] transition-transform duration-500">
                    <div class="absolute -bottom-6 -right-6 w-32 h-32 bg-gradient-to-r from-teal-500 to-cyan-500 rounded-2xl flex items-center justify-center shadow-xl rotate-3">
                        <div class="text-white text-center">
                            <div class="text-2xl font-bold">2017</div>
                            <div class="text-sm">Founded</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>




<!-- Our Services Section -->
<section id="our-services" class="py-20 bg-white overflow-hidden">
    <div class="container mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-end mb-16" data-aos="fade-up" data-aos-offset="200">
            <div class="max-w-2xl">
                <h2 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4">Layanan Kami</h2>
                <p class="text-xl text-gray-600">Solusi perjalanan menyeluruh yang dirancang khusus untuk memenuhi setiap kebutuhan unik Anda.</p>
            </div>
            <div class="hidden md:block">
                <div class="w-32 h-1 bg-teal-500 rounded-full mb-2"></div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <!-- Service 1 -->
            <div class="group relative bg-slate-50 rounded-3xl p-8 hover:bg-teal-600 transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-white transition-colors duration-300">Corporate & Family Gathering</h3>
                <p class="text-gray-600 group-hover:text-teal-50 transition-colors duration-300">Membangun kebersamaan dan keceriaan melalui acara gathering yang berkesan bagi karyawan maupun keluarga.</p>
                <div class="absolute top-4 right-4 text-slate-200 group-hover:text-teal-500/30 transition-colors duration-300">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3.005 3.005 0 013.25-2.906z"></path>
                    </svg>
                </div>
            </div>

            <!-- Service 2 -->
            <div class="group relative bg-slate-50 rounded-3xl p-8 hover:bg-teal-600 transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-white transition-colors duration-300">Capacity Building & Outbound</h3>
                <p class="text-gray-600 group-hover:text-teal-50 transition-colors duration-300">Program pengembangan diri dan kerjasama tim melalui aktivitas luar ruangan yang menantang dan edukatif.</p>
                <div class="absolute top-4 right-4 text-slate-200 group-hover:text-teal-500/30 transition-colors duration-300">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M11.3 1.046A1 1 0 0112 2v5h4a1 1 0 01.82 1.573l-7 10A1 1 0 018 18v-5H4a1 1 0 01-.82-1.573l7-10a1 1 0 011.12-.38z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <!-- Service 3 -->
            <div class="group relative bg-slate-50 rounded-3xl p-8 hover:bg-teal-600 transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="300">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-white transition-colors duration-300">MICE</h3>
                <p class="text-gray-600 group-hover:text-teal-50 transition-colors duration-300">Layanan profesional untuk Meeting, Incentive, Convention, dan Exhibition dengan manajemen acara yang teliti.</p>
                <div class="absolute top-4 right-4 text-slate-200 group-hover:text-teal-500/30 transition-colors duration-300">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <!-- Service 4 -->
            <div class="group relative bg-slate-50 rounded-3xl p-8 hover:bg-teal-600 transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="400">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 002 2h1.5m1.5-1.5V13a2.5 2.5 0 01-2.5 2.5h-1.5a2 2 0 01-2-2v-1a2 2 0 00-2-2H9"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-white transition-colors duration-300">International Tour</h3>
                <p class="text-gray-600 group-hover:text-teal-50 transition-colors duration-300">Eksplorasi destinasi mancanegara dengan paket perjalanan yang terorganisir, aman, dan penuh petualangan.</p>
                <div class="absolute top-4 right-4 text-slate-200 group-hover:text-teal-500/30 transition-colors duration-300">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM4.332 8.027a6.012 6.012 0 011.912-2.706C6.512 5.73 6.974 6 7.5 6A1.5 1.5 0 019 7.5V8a2 2 0 004 0 2 2 0 011.523-1.943A5.977 5.977 0 0116 10c0 .34-.028.675-.083 1H15a2 2 0 00-2 2v2.197A5.973 5.973 0 0110 16v-2a2 2 0 00-2-2 2 2 0 01-2-2 2 2 0 00-1.668-1.973z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <!-- Service 5 -->
            <div class="group relative bg-slate-50 rounded-3xl p-8 hover:bg-teal-600 transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="500">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-white transition-colors duration-300">Heritage, Retreat & Executive Camp</h3>
                <p class="text-gray-600 group-hover:text-teal-50 transition-colors duration-300">Pengalaman eksklusif yang memadukan sejarah, ketenangan, dan kenyamanan fasilitas premium.</p>
                <div class="absolute top-4 right-4 text-slate-200 group-hover:text-teal-500/30 transition-colors duration-300">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"></path>
                    </svg>
                </div>
            </div>

            <!-- Service 6 -->
            <div class="group relative bg-slate-50 rounded-3xl p-8 hover:bg-teal-600 transition-all duration-500 transform hover:-translate-y-2" data-aos="fade-up" data-aos-delay="600">
                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-sm group-hover:scale-110 transition-transform duration-500">
                    <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-gray-800 mb-4 group-hover:text-white transition-colors duration-300">Sewa Bus Pariwisata</h3>
                <p class="text-gray-600 group-hover:text-teal-50 transition-colors duration-300">Penyediaan armada bus pariwisata modern dengan standar kenyamanan dan keamanan tinggi untuk perjalanan Anda.</p>
                <div class="absolute top-4 right-4 text-slate-200 group-hover:text-teal-500/30 transition-colors duration-300">
                    <svg class="w-24 h-24" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19,15c0,1.1-0.9,2-2,2h-1c-1.1,0-2-0.9-2-2s0.9-2,2-2h1C18.1,13,19,13.9,19,15z M7,13H6c-1.1,0-2,0.9-2,2s0.9,2,2,2h1 c1.1,0,2-0.9,2-2S8.1,13,7,13z M22,11v6c0,1.1-0.9,2-2,2H4c-1.1,0-2-0.9-2-2v-6c0-1.1,0.9-2,2-2h1V4c0-1.1,0.9-2,2-2H17c1.1,0,2,0.9,2,2v5 h1C21.1,9,22,9.9,22,11z M17.5,10V4h-11v6H17.5z M4,11v6h1.2c-0.1-0.3-0.2-0.6-0.2-1c0-1.7,1.3-3,3-3s3,1.3,3,3 c0,0.4-0.1,0.7-0.2,1h2.4c-0.1-0.3-0.2-0.6-0.2-1c0-1.7,1.3-3,3-3s3,1.3,3,3c0,0.4-0.1,0.7-0.2,1H20v-6H4z"/>
                    </svg>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Awards & Recognition -->
<section id="awards" class="relative py-20 sm:py-28 bg-slate-50 overflow-hidden">
    <!-- Decorative Premium Background Elements -->
    <div class="absolute top-0 left-0 w-72 h-72 bg-teal-200/20 rounded-full -translate-x-1/2 -translate-y-1/2 blur-[100px]"></div>
    <div class="absolute bottom-0 right-0 w-96 h-96 bg-blue-200/20 rounded-full translate-x-1/3 translate-y-1/3 blur-[120px]"></div>
    
    <div class="container mx-auto px-4 relative z-10">
        <div class="text-center mb-16 sm:mb-24" data-aos="fade-up">
            <span class="inline-block px-4 py-1.5 mb-6 text-xs sm:text-sm font-bold tracking-[0.2em] text-teal-600 uppercase bg-teal-50 rounded-full border border-teal-100">
                Kredibilitas & Kepercayaan
            </span>
            <h2 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-extrabold text-slate-900 mb-6 tracking-tight">
                Penghargaan & <span class="text-transparent bg-clip-text bg-gradient-to-r from-teal-600 to-blue-600">Sertifikasi</span>
            </h2>
            <div class="w-24 h-1.5 bg-gradient-to-r from-teal-500 to-blue-500 mx-auto rounded-full mb-8"></div>
            <p class="text-base sm:text-lg md:text-xl text-slate-600 max-w-3xl mx-auto leading-relaxed px-4">
                JustTrip berkomitmen penuh pada legalitas dan standar kualitas internasional demi memberikan pengalaman perjalanan yang aman, nyaman, dan tak terlupakan.
            </p>
        </div>
        
        <!-- Awards Premium Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 md:gap-12">
            <!-- Card 1 -->
            <div class="group bg-white rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/60 hover:shadow-teal-200/40 transition-all duration-500 border border-slate-100 flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="100">
                <div class="relative mb-10 w-full aspect-[4/3] rounded-3xl overflow-hidden shadow-inner bg-slate-50 border-[6px] border-white group-hover:border-teal-50 transition-all duration-500">
                    <img src="{{ asset('img/img_0350.png') }}" 
                         alt="Sertifikasi JustTrip" 
                         class="w-full h-full object-contain p-4 transform group-hover:scale-110 rotate-0 group-hover:-rotate-1 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-tr from-teal-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                <div class="w-16 h-16 bg-teal-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-teal-600 group-hover:rotate-6 transition-all duration-500">
                    <i class="fas fa-shield-check text-2xl text-teal-600 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-3">Legalitas Resmi</h3>
                <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
                    Terdaftar secara resmi sebagai penyelenggara perjalanan wisata dengan izin usaha lengkap dan terverifikasi.
                </p>
            </div>
            
            <!-- Card 2 -->
            <div class="group bg-white rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/60 hover:shadow-blue-200/40 transition-all duration-500 border border-slate-100 flex flex-col items-center text-center" data-aos="fade-up" data-aos-delay="200">
                <div class="relative mb-10 w-full aspect-[4/3] rounded-3xl overflow-hidden shadow-inner bg-slate-50 border-[6px] border-white group-hover:border-blue-50 transition-all duration-500">
                    <img src="{{ asset('img/img_0351.png') }}" 
                         alt="Kualitas Layanan" 
                         class="w-full h-full object-contain p-4 transform group-hover:scale-110 rotate-0 group-hover:rotate-1 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-tr from-blue-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                <div class="w-16 h-16 bg-blue-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-blue-600 group-hover:-rotate-6 transition-all duration-500">
                    <i class="fas fa-award text-2xl text-blue-600 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-3">Sertifikasi Mutu</h3>
                <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
                    Pengakuan atas standar manajemen mutu layanan yang konsisten dan berorientasi pada kepuasan pelanggan.
                </p>
            </div>
            
            <!-- Card 3 -->
            <div class="group bg-white rounded-[2.5rem] p-8 shadow-2xl shadow-slate-200/60 hover:shadow-emerald-200/40 transition-all duration-500 border border-slate-100 flex flex-col items-center text-center md:col-span-2 lg:col-span-1" data-aos="fade-up" data-aos-delay="300">
                <div class="relative mb-10 w-full aspect-[4/3] rounded-3xl overflow-hidden shadow-inner bg-slate-50 border-[6px] border-white group-hover:border-emerald-50 transition-all duration-500">
                    <img src="{{ asset('img/img_0352.png') }}" 
                         alt="Mitra Kepercayaan" 
                         class="w-full h-full object-contain p-4 transform group-hover:scale-110 rotate-0 group-hover:-rotate-1 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-tr from-emerald-600/10 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                </div>
                <div class="w-16 h-16 bg-emerald-50 rounded-2xl flex items-center justify-center mb-6 group-hover:bg-emerald-600 group-hover:rotate-6 transition-all duration-500">
                    <i class="fas fa-handshake text-2xl text-emerald-600 group-hover:text-white transition-colors duration-300"></i>
                </div>
                <h3 class="text-2xl font-bold text-slate-800 mb-3">Partner Terpercaya</h3>
                <p class="text-slate-500 text-sm sm:text-base leading-relaxed">
                    Bekerjasama dengan jaringan mitra global untuk memastikan kemudahan dan kenyamanan akses di setiap destinasi.
                </p>
            </div>
        </div>
        
        <!-- Trust Indicators Footer -->
        <div class="mt-20 pt-12 border-t border-slate-200/60 flex flex-wrap justify-center items-center gap-8 opacity-70" data-aos="fade-up">
            <div class="flex items-center space-x-2 grayscale hover:grayscale-0 transition-all duration-300">
                <i class="fas fa-check-circle text-teal-600"></i>
                <span class="font-semibold text-slate-700">Verified Travel Agency</span>
            </div>
            <div class="flex items-center space-x-2 grayscale hover:grayscale-0 transition-all duration-300">
                <i class="fas fa-lock text-blue-600"></i>
                <span class="font-semibold text-slate-700">Secure Booking</span>
            </div>
            <div class="flex items-center space-x-2 grayscale hover:grayscale-0 transition-all duration-300">
                <i class="fas fa-headset text-emerald-600"></i>
                <span class="font-semibold text-slate-700">24/7 Support</span>
            </div>
        </div>
    </div>
</section>


@endsection