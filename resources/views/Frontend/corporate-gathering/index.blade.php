@extends('Frontend.layouts.landing')

@section('title', 'Gathering Kantor ke Jogja Mulai Rp1 Juta-an | JustTrip')
@section('description', 'Gathering kantor ke Jogja mulai Rp1 Juta-an per orang. Bus PP, hotel, makan 10x, dokumentasi drone. Melayani 30 hingga 500 peserta.')

@section('content')
@php
    $waUrl = 'https://wa.me/6282266478147?text=Halo%20JustTrip%2C%20saya%20mau%20tanya%20paket%20gathering%20kantor';
@endphp

<!-- Header Minimalis (Hanya Logo, Bukan H1, Tanpa Navigasi) -->
<header class="w-full bg-white/95 border-b border-gray-100 py-4 px-4 sm:px-6 sticky top-0 z-40 backdrop-blur-sm">
    <div class="max-w-5xl mx-auto flex items-center justify-between">
        <div class="flex items-center space-x-3">
            <img src="{{ asset('image/LOGO TOSCA.png') }}" alt="JustTrip Logo" class="w-10 h-10 object-contain" width="40" height="40">
            <div>
                <span class="text-xl font-bold tracking-tight text-blue-900 block leading-tight">Justtrip</span>
                <span class="text-[11px] text-gray-500 font-medium -mt-1 block">#TripGagalMoveOn</span>
            </div>
        </div>
        <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold text-xs sm:text-sm px-4 py-2 rounded-xl shadow-sm transition-all">
            <svg class="w-4 h-4 fill-current" viewBox="0 0 24 24">
                <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
            </svg>
            <span>Hubungi Kami</span>
        </a>
    </div>
</header>

<main class="w-full">
    <!-- Blok 1: Hero -->
    <section class="w-full py-12 md:py-20 px-4 sm:px-6 bg-gradient-to-b from-blue-900 via-blue-950 to-slate-900 text-white">
        <div class="max-w-5xl mx-auto grid md:grid-cols-12 gap-8 md:gap-12 items-center">
            <div class="md:col-span-7">
                <span class="inline-block bg-orange-500/20 text-orange-400 border border-orange-500/30 text-xs font-bold uppercase tracking-wider px-3.5 py-1.5 rounded-full mb-4">
                    Corporate Gathering &amp; Outing Jogja
                </span>
                <h1 class="text-3xl sm:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tight mb-6 text-white">
                    Gathering Kantor ke Jogja, Mulai Rp1 Juta-an per Orang
                </h1>
                <p class="text-base sm:text-lg text-blue-100/90 leading-relaxed mb-8">
                    Bus PP, hotel, makan 10x, dokumentasi drone. 1 hari, 2 hari, atau 3 hari — kami sesuaikan.
                </p>
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-base sm:text-lg px-8 py-4 rounded-2xl shadow-xl hover:shadow-emerald-600/30 transition-all">
                        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                        </svg>
                        <span>Konsultasi via WhatsApp</span>
                    </a>
                </div>
            </div>
            <div class="md:col-span-5">
                <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-white/10">
                    <img src="{{ asset('image/1.webp') }}" 
                         alt="Dokumentasi Gathering Kantor Skala Besar Jogja" 
                         class="w-full h-72 sm:h-96 object-cover" 
                         width="600" 
                         height="400" 
                         fetchpriority="high">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 text-xs text-white/90 font-medium">
                        Dokumentasi Gathering &amp; Outing JustTrip
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blok 2: Masalah -->
    <section class="py-16 md:py-20 px-4 sm:px-6 bg-white">
        <div class="max-w-5xl mx-auto">
            <div class="text-center max-w-2xl mx-auto mb-12">
                <span class="text-orange-600 font-bold uppercase tracking-wider text-xs mb-2 block">Tantangan Panitia</span>
                <h2 class="text-2xl sm:text-3xl font-extrabold text-slate-900 tracking-tight">
                    Mengatur Gathering Kantor Sering Kali Bikin Pusing?
                </h2>
            </div>
            <div class="grid sm:grid-cols-3 gap-6 sm:gap-8">
                <div class="bg-slate-50 p-6 sm:p-8 rounded-3xl border border-slate-100 flex flex-col">
                    <div class="w-12 h-12 rounded-2xl bg-red-100 text-red-600 flex items-center justify-center font-black text-xl mb-4">
                        1
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Ditunjuk Atasan Tanpa Panduan</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Tiba-tiba dipercaya jadi PIC event tanpa ada acuan susunan acara, pilihan destinasi, maupun vendor terpercaya.
                    </p>
                </div>
                <div class="bg-slate-50 p-6 sm:p-8 rounded-3xl border border-slate-100 flex flex-col">
                    <div class="w-12 h-12 rounded-2xl bg-amber-100 text-amber-600 flex items-center justify-center font-black text-xl mb-4">
                        2
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Vendor Hanya Eksekusi</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Banyak EO atau agen hanya menunggu perintah, tanpa memberikan kurasi konsep, ice breaking, atau solusi proaktif saat ada kendala.
                    </p>
                </div>
                <div class="bg-slate-50 p-6 sm:p-8 rounded-3xl border border-slate-100 flex flex-col">
                    <div class="w-12 h-12 rounded-2xl bg-blue-100 text-blue-600 flex items-center justify-center font-black text-xl mb-4">
                        3
                    </div>
                    <h3 class="text-lg font-bold text-slate-900 mb-2">Takut Anggaran Membengkak</h3>
                    <p class="text-sm text-slate-600 leading-relaxed">
                        Kekhawatiran biaya tak terduga di tengah perjalanan atau transparansi rincian paket yang tidak jelas sejak awal.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- Blok 3: Paket & Harga (Disembunyikan sementara - butuh input konfirmasi harga dari Udi) --}}

    <!-- Blok 4: Kapasitas -->
    <section class="py-16 md:py-20 px-4 sm:px-6 bg-slate-900 text-white">
        <div class="max-w-4xl mx-auto text-center">
            <span class="text-emerald-400 font-bold uppercase tracking-wider text-xs mb-3 block">Pengalaman Teruji</span>
            <h2 class="text-2xl sm:text-4xl font-extrabold tracking-tight mb-6">
                Kapasitas Fleksibel untuk Rombongan Kecil Maupun Besar
            </h2>
            <p class="text-lg sm:text-xl text-slate-300 font-medium leading-relaxed max-w-2xl mx-auto mb-8">
                Melayani 30 hingga 500 peserta. Sudah menangani gathering 300 orang di Jogja dengan standar operasional yang presisi.
            </p>
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-6 max-w-2xl mx-auto pt-6 border-t border-slate-800">
                <div>
                    <div class="text-3xl sm:text-4xl font-black text-orange-400">30–500</div>
                    <div class="text-xs sm:text-sm text-slate-400 mt-1">Kapasitas Peserta</div>
                </div>
                <div>
                    <div class="text-3xl sm:text-4xl font-black text-orange-400">300+</div>
                    <div class="text-xs sm:text-sm text-slate-400 mt-1">Acara Skala Besar Terlaksana</div>
                </div>
                <div class="col-span-2 sm:col-span-1">
                    <div class="text-3xl sm:text-4xl font-black text-orange-400">100%</div>
                    <div class="text-xs sm:text-sm text-slate-400 mt-1">Custom Itinerary Sesuai Kebutuhan</div>
                </div>
            </div>
        </div>
    </section>

    {{-- Blok 5: Bukti (Disembunyikan sementara - butuh input logo klien, testimoni asli, foto nyata dari Udi) --}}

    {{-- Blok 6: FAQ (Disembunyikan sementara - butuh input jawaban 5 pertanyaan dari Udi) --}}

    <!-- Blok 7: Penutup & CTA WhatsApp -->
    <section class="py-16 md:py-24 px-4 sm:px-6 bg-white text-center">
        <div class="max-w-3xl mx-auto">
            <h2 class="text-2xl sm:text-4xl font-extrabold text-slate-900 tracking-tight mb-4">
                Siap Rencanakan Gathering Kantor Tanpa Pusing?
            </h2>
            <p class="text-base sm:text-lg text-slate-600 mb-8 leading-relaxed">
                Konsultasikan kebutuhan tanggal, jumlah peserta, dan konsep acara kantor Anda bersama tim konsultan JustTrip sekarang.
            </p>
            <a href="{{ $waUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-3 bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-base sm:text-lg px-8 py-4 rounded-2xl shadow-xl hover:shadow-emerald-600/30 transition-all">
                <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946.003-6.556 5.338-11.891 11.893-11.891 3.181.001 6.167 1.24 8.413 3.488 2.245 2.248 3.481 5.236 3.48 8.414-.003 6.557-5.338 11.892-11.893 11.892-1.99-.001-3.951-.5-5.688-1.448l-6.305 1.654zm6.597-3.807c1.676.995 3.276 1.591 5.392 1.592 5.448 0 9.886-4.434 9.889-9.885.002-5.462-4.415-9.89-9.881-9.892-5.452 0-9.887 4.434-9.889 9.884-.001 2.225.651 3.891 1.746 5.634l-.999 3.648 3.742-.981zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.031-.967-.272-.099-.47-.149-.669.149-.198.297-.768.967-.941 1.165-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.521.151-.172.2-.296.3-.495.099-.198.05-.372-.025-.521-.075-.148-.669-1.611-.916-2.206-.242-.579-.487-.501-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.076 4.487.709.306 1.263.489 1.694.626.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
                </svg>
                <span>Chat WhatsApp Sekarang</span>
            </a>
        </div>
    </section>
</main>
@endsection

@push('scripts')
{{-- Event Lead & penerusan fbclid ke WhatsApp (06 §3.2) --}}
<script>
document.addEventListener('click', function (e) {
  var link = e.target.closest('a[href*="wa.me"], a[href*="api.whatsapp.com"]');
  if (!link) return;

  // Teruskan fbclid dari URL halaman ke link WhatsApp.
  // Tanpa ini atribusi iklan putus dan semua chat tercatat sebagai "direct".
  var fbclid = new URLSearchParams(location.search).get('fbclid');
  if (fbclid && link.href.indexOf('fbclid') === -1) {
    link.href += (link.href.indexOf('?') === -1 ? '?' : '&')
               + 'fbclid=' + encodeURIComponent(fbclid);
  }

  // Kirim event konversi ke Meta.
  fbq('track', 'Lead', {
    content_name: 'Gathering Corporate',
    content_category: 'Landing Page'
  });
}, true);
</script>

{{-- Event ViewContent untuk retargeting (06 §3.3) --}}
<script>
  fbq('track', 'ViewContent', {
    content_name: 'Gathering Corporate',
    content_category: 'Landing Page'
  });
</script>
@endpush
