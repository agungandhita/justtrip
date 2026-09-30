@extends('Frontend.layouts.main')

@section('container')
<style>
    .crisp-img {
        image-rendering: -webkit-optimize-contrast;
        image-rendering: crisp-edges;
    }
</style>

<!-- Hero Section -->
<section class="relative w-full bg-slate-900 overflow-hidden">
    <div class="relative w-full aspect-[21/9] sm:aspect-[24/9] md:max-h-[460px] overflow-hidden">
        <img src="{{ asset('image/TENTANG-JUSTTRIP.png') }}" 
             alt="Tentang JustTrip Indonesia - Partner Perjalanan & Tour Organizer" 
             class="w-full h-full object-cover object-center transform hover:scale-[1.01] transition-transform duration-700">
        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/40 via-transparent to-transparent pointer-events-none"></div>
    </div>
</section>

<!-- Story & About Us Section -->
<section id="about-us" class="py-20 md:py-28 bg-white overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">
            
            <!-- Left Column: Authentic Brand Story -->
            <div class="lg:col-span-7" data-aos="fade-right">
                <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-teal-50 border border-teal-200/60 mb-6">
                    <span class="w-2 h-2 rounded-full bg-teal-600 animate-pulse"></span>
                    <span class="text-xs font-bold tracking-wider uppercase text-teal-800">Cerita & Komitmen Kami</span>
                </div>

                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight mb-6 leading-tight">
                    Merancang Perjalanan Bermakna, <span class="text-teal-600">Bukan Sekadar Itinerary.</span>
                </h2>

                <div class="space-y-4 text-base sm:text-lg text-slate-600 leading-relaxed">
                    <p>
                        <strong class="text-slate-900 font-semibold">JUSTTRIP</strong> hadir sejak <span class="text-teal-700 font-bold">2017</span> sebagai partner perjalanan untuk perusahaan dan keluarga besar yang meyakini bahwa kebersamaan adalah fondasi terkuat bagi sinergi tim dan kehangatan hubungan.
                    </p>
                    <p>
                        Lebih dari <span class="font-bold text-slate-900">200+ perusahaan</span> telah mempercayakan perjalanannya bersama kami. Kami tidak sekadar mengatur transportasi atau hotel, melainkan merancang pengalaman yang membakar semangat, memperkuat kolaborasi, dan menciptakan momen tak terlupakan—baik untuk <span class="text-slate-800 font-medium">corporate gathering, outbound training</span>, maupun <span class="text-slate-800 font-medium">family gathering</span>.
                    </p>
                    <p>
                        Dari perusahaan swasta multinasional, BUMN, instansi pemerintahan, hingga reuni akbar keluarga, Justtrip terbiasa mengelola rombongan dengan jumlah puluhan hingga ratusan peserta dengan standar manajemen operasional yang presisi.
                    </p>
                    <p>
                        Kami memahami setiap organisasi memiliki budaya dan ekspektasi yang unik. Oleh karena itu, seluruh rancangan program kami bersifat <strong class="text-slate-900 font-semibold">100% custom</strong>—bukan hasil copy-paste—dan disesuaikan dengan sasaran, karakter, serta nilai yang ingin dicapai klien.
                    </p>
                </div>

                <!-- Editorial Quote Card -->
                <div class="my-8 p-6 rounded-2xl bg-gradient-to-r from-teal-50/80 to-slate-50 border-l-4 border-teal-600 shadow-sm">
                    <div class="flex items-start gap-4">
                        <i class="fas fa-quote-left text-2xl text-teal-600/40 mt-1"></i>
                        <div>
                            <p class="text-lg font-bold text-slate-800 italic">
                                "Let's create meaningful journeys — not just itineraries."
                            </p>
                            <p class="text-xs uppercase tracking-wider text-slate-500 mt-2 font-semibold">
                                Filosofi Pelayanan Justtrip Indonesia
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Unified Stats Grid -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 pt-2">
                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-teal-200 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-teal-100/60 text-teal-700 flex items-center justify-center mb-2 text-sm">
                            <i class="fas fa-building"></i>
                        </div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-slate-900">200+</div>
                        <div class="text-xs sm:text-sm font-medium text-slate-500 mt-1">Klien Korporasi</div>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-teal-200 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-teal-100/60 text-teal-700 flex items-center justify-center mb-2 text-sm">
                            <i class="fas fa-calendar-check"></i>
                        </div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-slate-900">9+ Th</div>
                        <div class="text-xs sm:text-sm font-medium text-slate-500 mt-1">Pengalaman</div>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-teal-200 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-teal-100/60 text-teal-700 flex items-center justify-center mb-2 text-sm">
                            <i class="fas fa-flag-checkered"></i>
                        </div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-slate-900">100+</div>
                        <div class="text-xs sm:text-sm font-medium text-slate-500 mt-1">Event Sukses</div>
                    </div>

                    <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100 hover:border-teal-200 transition-colors">
                        <div class="w-8 h-8 rounded-lg bg-teal-100/60 text-teal-700 flex items-center justify-center mb-2 text-sm">
                            <i class="fas fa-users"></i>
                        </div>
                        <div class="text-2xl sm:text-3xl font-extrabold text-slate-900">100%</div>
                        <div class="text-xs sm:text-sm font-medium text-slate-500 mt-1">Custom Trip</div>
                    </div>
                </div>
            </div>

            <!-- Right Column: Real-life Authentic Visual Showcase -->
            <div class="lg:col-span-5" data-aos="fade-left">
                <div class="relative">
                    <!-- Main High-Res Image Card -->
                    <div class="relative rounded-3xl overflow-hidden shadow-2xl border-4 border-white bg-slate-100">
                        <img src="{{ asset('image/1.jpg') }}" 
                             alt="Tim JustTrip memandu kegiatan gathering dan outbound" 
                             class="w-full h-[440px] sm:h-[500px] object-cover object-center transform hover:scale-105 transition-transform duration-700">
                        
                        <!-- Overlay gradient bottom -->
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-950/80 via-slate-950/20 to-transparent"></div>

                        <!-- Card caption overlay -->
                        <div class="absolute bottom-6 left-6 right-6 text-white">
                            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-500/90 text-white text-xs font-semibold mb-2 shadow-sm">
                                <i class="fas fa-circle-check"></i>
                                <span>Tim Fasilitator Bersertifikat</span>
                            </div>
                            <h3 class="text-xl font-bold leading-snug">
                                Didampingi Tour Leader & Trainer Profesional
                            </h3>
                            <p class="text-xs text-slate-200 mt-1">
                                Menjamin suasana hangat, seru, interaktif, dan terkoordinasi rapi sejak keberangkatan.
                            </p>
                        </div>
                    </div>

                    <!-- Established Floating Badge (Clean & Non-slop) -->
                    <div class="absolute -top-5 -left-5 bg-white rounded-2xl p-4 shadow-xl border border-slate-100 flex items-center gap-3">
                        <div class="w-12 h-12 rounded-xl bg-teal-600 flex items-center justify-center text-white text-lg shadow-md shadow-teal-600/30">
                            <i class="fas fa-award"></i>
                        </div>
                        <div>
                            <div class="text-xs uppercase tracking-wider text-slate-500 font-semibold">Established</div>
                            <div class="text-lg font-bold text-slate-900 leading-none mt-0.5">Sejak 2017</div>
                        </div>
                    </div>

                    <!-- Secondary Floating Trust Chip -->
                    <div class="absolute -bottom-5 -right-5 hidden sm:flex items-center gap-3 bg-white/95 backdrop-blur-md rounded-2xl p-4 shadow-xl border border-slate-100">
                        <div class="w-10 h-10 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-base">
                            <i class="fas fa-shield-halved"></i>
                        </div>
                        <div>
                            <div class="text-xs font-bold text-slate-800">PT Trisula Pandu Nusantara</div>
                            <div class="text-[11px] text-teal-600 font-medium">Biro Perjalanan Wisata Resmi</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Core Pillars / Why Different Section -->
<section class="py-16 bg-slate-50 border-y border-slate-200/70">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center max-w-2xl mx-auto mb-12" data-aos="fade-up">
            <span class="text-xs font-bold uppercase tracking-widest text-teal-700 bg-teal-100/60 px-3 py-1 rounded-full">
                Keunggulan Layanan
            </span>
            <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 mt-3">
                Mengapa Memilih Justtrip?
            </h2>
            <p class="text-slate-600 text-sm sm:text-base mt-2">
                Empat pilar utama yang menjadi pembeda kami dalam setiap program perjalanan.
            </p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            <!-- Pillar 1 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 hover:border-teal-500/60 hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="100">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-users-gear"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">HR & Team Experience</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Dirancang dengan pemahaman human capital untuk memperkuat chemistry, engagement, dan kolaborasi antar karyawan.
                </p>
            </div>

            <!-- Pillar 2 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 hover:border-teal-500/60 hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="200">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-sliders"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Customized Itinerary</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Setiap rencana rute, aktivitas, dan menu konsumsi disesuaikan dengan kebutuhan dan karakteristik unik rombongan Anda.
                </p>
            </div>

            <!-- Pillar 3 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 hover:border-teal-500/60 hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="300">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Legalitas PT & MOU</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Jaminan keamanan dan transparansi anggaran dengan ikatan perjanjian kerja sama resmi (MOU) dan invoice profesional.
                </p>
            </div>

            <!-- Pillar 4 -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200/80 hover:border-teal-500/60 hover:shadow-md transition-all duration-300" data-aos="fade-up" data-aos-delay="400">
                <div class="w-12 h-12 rounded-xl bg-teal-50 text-teal-600 flex items-center justify-center text-xl mb-4">
                    <i class="fas fa-headset"></i>
                </div>
                <h3 class="text-lg font-bold text-slate-900 mb-2">Layanan End-to-End</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Dukungan menyeluruh dari survey destinasi, perizinan, reservasi armada bus, akomodasi, hingga pelaporan dokumentasi pasca event.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Our Services Section -->
<section id="our-services" class="py-20 md:py-28 bg-white overflow-hidden">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Section Header -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-16 gap-6" data-aos="fade-up">
            <div class="max-w-2xl">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-teal-50 border border-teal-200/60 mb-3">
                    <span class="text-xs font-bold tracking-wider uppercase text-teal-800">Portofolio Layanan</span>
                </div>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight">
                    Layanan Unggulan Justtrip
                </h2>
                <p class="text-base sm:text-lg text-slate-600 mt-3 leading-relaxed">
                    Solusi perjalanan dan manajemen acara menyeluruh yang dirancang terukur untuk memenuhi setiap ekspektasi Anda.
                </p>
            </div>
            
            <div>
                <a href="https://wa.me/6282266478147" target="_blank" 
                   class="inline-flex items-center gap-2 px-5 py-3 rounded-xl bg-teal-600 text-white font-bold text-sm hover:bg-teal-700 shadow-md shadow-teal-600/20 transition-all">
                    <i class="fab fa-whatsapp text-lg"></i>
                    <span>Konsultasi Kebutuhan Trip</span>
                </a>
            </div>
        </div>

        <!-- 6 Cohesive Service Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            
            <!-- Service 1: Corporate & Family Gathering -->
            <div class="group bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-teal-500/50 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between" data-aos="fade-up">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-users"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-teal-700 transition-colors">
                        Corporate & Family Gathering
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Membangun kebersamaan dan keceriaan lewat konsep acara gathering kreatif yang berkesan mendalam bagi karyawan maupun anggota keluarga besar.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-teal-600">
                    <span>Program Custom & Tematik</span>
                    <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>

            <!-- Service 2: Capacity Building & Outbound -->
            <div class="group bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-teal-500/50 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="100">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-compass"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-teal-700 transition-colors">
                        Capacity Building & Outbound
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Pengembangan kapasitas kepemimpinan, komunikasi, dan sinergi tim melalui simulasi outdoor yang mendidik, menantang, dan penuh inspirasi.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-teal-600">
                    <span>Fasilitator Bersertifikat</span>
                    <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>

            <!-- Service 3: MICE -->
            <div class="group bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-teal-500/50 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="200">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-briefcase"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-teal-700 transition-colors">
                        MICE Professional
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Manajemen profesional untuk kebutuhan Meeting, Incentive, Convention, dan Exhibition dengan koordinasi teknis yang matang dan berkelas.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-teal-600">
                    <span>Full Event Organizer</span>
                    <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>

            <!-- Service 4: International Tour -->
            <div class="group bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-teal-500/50 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="300">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-earth-americas"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-teal-700 transition-colors">
                        International Tour
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Eksplorasi destinasi mancanegara dengan kepastian jadwal, tiket, akomodasi berbintang, dan pendampingan tour leader berpengalaman global.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-teal-600">
                    <span>Asia & Destinasi Global</span>
                    <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>

            <!-- Service 5: Heritage, Retreat & Executive Camp -->
            <div class="group bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-teal-500/50 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="400">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-mountain-sun"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-teal-700 transition-colors">
                        Heritage, Retreat & Camp
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Pengalaman eksklusif yang memadukan napak tilas sejarah, ketenangan alam, dan fasilitas executive camp untuk relaksasi dan refleksi mendalam.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-teal-600">
                    <span>Eksklusif & Private</span>
                    <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>

            <!-- Service 6: Sewa Bus Pariwisata -->
            <div class="group bg-white rounded-3xl p-8 border border-slate-200/80 shadow-sm hover:shadow-xl hover:border-teal-500/50 hover:-translate-y-1.5 transition-all duration-300 flex flex-col justify-between" data-aos="fade-up" data-aos-delay="500">
                <div>
                    <div class="w-14 h-14 rounded-2xl bg-teal-50 text-teal-600 flex items-center justify-center text-2xl mb-6 group-hover:bg-teal-600 group-hover:text-white transition-colors duration-300">
                        <i class="fas fa-bus"></i>
                    </div>
                    <h3 class="text-xl font-bold text-slate-900 mb-3 group-hover:text-teal-700 transition-colors">
                        Sewa Bus Pariwisata
                    </h3>
                    <p class="text-slate-600 text-sm leading-relaxed mb-6">
                        Penyediaan armada bus pariwisata modern (Medium & Big Bus) dengan kru pengemudi terlatih, standar keselamatan tinggi, dan fasilitas premium.
                    </p>
                </div>
                <div class="pt-4 border-t border-slate-100 flex items-center justify-between text-xs font-semibold text-teal-600">
                    <span>Armada Terbaru & Terawat</span>
                    <i class="fas fa-arrow-right transform group-hover:translate-x-1 transition-transform"></i>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Official Accreditation & Legal Credentials (Clean & Crisp, No AI Slop) -->
<section id="awards" class="py-20 md:py-28 bg-slate-50 border-t border-slate-200/70">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="text-center max-w-3xl mx-auto mb-16" data-aos="fade-up">
            <span class="inline-flex items-center gap-1.5 px-4 py-1.5 text-xs font-bold tracking-widest text-teal-800 uppercase bg-teal-100/70 rounded-full border border-teal-200/60 mb-4">
                <i class="fas fa-shield-halved text-teal-600"></i>
                Kredibilitas & Legalitas Resmi
            </span>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold text-slate-900 tracking-tight">
                Akreditasi & Sertifikasi Profesi
            </h2>
            <p class="text-slate-600 text-base sm:text-lg mt-4 leading-relaxed">
                JustTrip berkomitmen penuh pada legalitas usaha berbadan hukum PT serta pengakuan sertifikasi nasional demi menjamin keamanan dan mutu pelayanan terbaik.
            </p>
        </div>
        
        <!-- Accreditation Cards: Crisp Sizing, No Blurry Scaled Raster -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            <!-- Card 1: ASITA -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-xl hover:border-teal-500/50 transition-all duration-300 flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="100">
                <div class="w-full h-28 bg-slate-50 rounded-2xl flex items-center justify-center p-4 border border-slate-100 mb-6 group-hover:border-teal-100 transition-colors">
                    <img src="{{ asset('img/IMG_0350.PNG') }}" 
                         alt="Logo ASITA - Association of the Indonesian Tours and Travel Agencies" 
                         class="h-16 w-auto max-w-[200px] object-contain crisp-img">
                </div>
                
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-bold mb-3 border border-teal-100">
                    <i class="fas fa-shield-halved"></i>
                    <span>Anggota Resmi ASITA</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Legalitas Biro Perjalanan</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Terdaftar resmi dalam Asosiasi Perusahaan Perjalanan Wisata Indonesia (ASITA) dengan kepatuhan penuh terhadap kode etik dan standar mutu nasional.
                </p>
            </div>
            
            <!-- Card 2: AITTA -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-xl hover:border-teal-500/50 transition-all duration-300 flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="200">
                <div class="w-full h-28 bg-slate-50 rounded-2xl flex items-center justify-center p-4 border border-slate-100 mb-6 group-hover:border-teal-100 transition-colors">
                    <img src="{{ asset('img/IMG_0351.PNG') }}" 
                         alt="Logo AITTA - Alliance of Indonesia Tours and Travel Agencies" 
                         class="h-14 w-auto max-w-[200px] object-contain crisp-img">
                </div>
                
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-bold mb-3 border border-teal-100">
                    <i class="fas fa-award"></i>
                    <span>Aliansi Mitra Strategis</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Jaringan Agen Wisata</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Tergabung dalam aliansi agen perjalanan terpercaya untuk memperluas akses armada transportasi, akomodasi, dan kemudahan logistik di setiap destinasi.
                </p>
            </div>
            
            <!-- Card 3: BNSP -->
            <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-sm hover:shadow-xl hover:border-teal-500/50 transition-all duration-300 flex flex-col items-center text-center group" data-aos="fade-up" data-aos-delay="300">
                <div class="w-full h-28 bg-slate-50 rounded-2xl flex items-center justify-center p-4 border border-slate-100 mb-6 group-hover:border-teal-100 transition-colors">
                    <img src="{{ asset('img/IMG_0352.PNG') }}" 
                         alt="Logo BNSP - Badan Nasional Sertifikasi Profesi" 
                         class="h-14 w-auto max-w-[220px] object-contain crisp-img">
                </div>
                
                <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-50 text-teal-700 text-xs font-bold mb-3 border border-teal-100">
                    <i class="fas fa-circle-check"></i>
                    <span>Sertifikasi Kompetensi BNSP</span>
                </div>
                <h3 class="text-xl font-bold text-slate-900 mb-2">Pemandu Berlisensi Resmi</h3>
                <p class="text-slate-600 text-sm leading-relaxed">
                    Tenaga Tour Leader dan instruktur lapangan kami tersertifikasi kompetensi resmi oleh Badan Nasional Sertifikasi Profesi untuk standar keselamatan tinggi.
                </p>
            </div>
        </div>
        
        <!-- Trust Indicators Badge Bar (Consistent Brand Colors) -->
        <div class="mt-16 pt-10 border-t border-slate-200 flex flex-wrap justify-center items-center gap-6 sm:gap-12 text-slate-700 text-sm font-semibold" data-aos="fade-up">
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center text-xs">
                    <i class="fas fa-shield-halved"></i>
                </div>
                <span>PT Berbadan Hukum Resmi</span>
            </div>
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center text-xs">
                    <i class="fas fa-file-contract"></i>
                </div>
                <span>Perjanjian Kerjasama (MOU) Jelas</span>
            </div>
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center text-xs">
                    <i class="fas fa-circle-check"></i>
                    </div>
                <span>Kru & Driver Berpengalaman</span>
            </div>
            <div class="flex items-center gap-2.5">
                <div class="w-7 h-7 rounded-full bg-teal-100 text-teal-700 flex items-center justify-center text-xs">
                    <i class="fas fa-headset"></i>
                </div>
                <span>Konsultasi & Support Cepat</span>
            </div>
        </div>

    </div>
</section>

<!-- Call to Action Banner -->
<section class="py-16 bg-white">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative rounded-3xl overflow-hidden bg-gradient-to-br from-slate-900 via-slate-800 to-teal-950 p-8 sm:p-12 lg:p-16 text-white shadow-2xl">
            <!-- Subtle background pattern -->
            <div class="absolute inset-0 opacity-10" style="background-image: radial-gradient(#fff 1px, transparent 1px); background-size: 24px 24px;"></div>
            
            <div class="relative z-10 max-w-3xl">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-teal-500/20 text-teal-300 text-xs font-bold mb-4 border border-teal-400/30">
                    <i class="fas fa-paper-plane"></i>
                    Konsultasi Gratis Bersama Kami
                </span>
                <h2 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold tracking-tight leading-tight">
                    Rencanakan Agenda Perjalanan Terbaik Untuk Tim Anda
                </h2>
                <p class="text-slate-300 text-base sm:text-lg mt-4 leading-relaxed max-w-2xl">
                    Mulai dari gathering tahunan, outbound team building, study tour, hingga sewa bus pariwisata. Hubungi kami untuk penawaran proposal dan rute terbaik.
                </p>

                <div class="flex flex-wrap items-center gap-4 mt-8">
                    <a href="https://wa.me/6282266478147" target="_blank"
                       class="inline-flex items-center gap-3 px-6 py-3.5 rounded-xl bg-teal-500 text-slate-950 font-bold hover:bg-teal-400 shadow-lg shadow-teal-500/25 transition-all">
                        <i class="fab fa-whatsapp text-xl"></i>
                        <span>Chat WhatsApp Konsultan</span>
                    </a>
                    <a href="{{ route('paket-tour') }}"
                       class="inline-flex items-center gap-2 px-6 py-3.5 rounded-xl bg-white/10 hover:bg-white/20 text-white font-bold border border-white/20 backdrop-blur-sm transition-all">
                        <span>Lihat Paket Tour</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection