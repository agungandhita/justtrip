<!-- JustTrip Footer with Tailwind CSS -->
<footer class="bg-gradient-to-br from-gray-900 via-blue-900 to-slate-900 text-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Logo & About -->
            <div class="lg:col-span-2">
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center shadow-sm">
                        <img src="{{ asset('image/logo4.png') }}" alt="JustTrip Logo" class="w-10 h-10 object-contain">
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold bg-gradient-to-r from-blue-400 to-blue-500 bg-clip-text text-transparent">JustTrip</h3>
                        <p class="text-gray-300 text-sm">Your Travel Partner</p>
                    </div>
                </div>
                <p class="text-gray-300 mb-6 leading-relaxed max-w-md">
                    Liburan jadi mudah dengan JustTrip. Kami menyediakan paket travel terlengkap dengan harga transparan untuk perjalanan wisata domestik dan internasional Anda.
                </p>
                <div class="flex space-x-4">
                    <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110" title="Instagram">
                        <i class="fab fa-instagram text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110" title="TikTok">
                        <i class="fab fa-tiktok text-lg"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 hover:bg-white/20 rounded-full flex items-center justify-center transition-all duration-200 hover:scale-110" title="WhatsApp">
                        <i class="fab fa-whatsapp text-lg"></i>
                    </a>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="text-lg font-semibold mb-4 text-white">Quick Links</h4>
                <ul class="space-y-3">
                    <li>
                        <a href="{{ route('home') }}" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center">
                            <i class="fas fa-home w-4 mr-3"></i>
                            Beranda
                        </a>
                    </li>
                    <li>
                        <a href="#destinasi" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center">
                            <i class="fas fa-map-marked-alt w-4 mr-3"></i>
                            Destinasi
                        </a>
                    </li>
                    <li>
                        <a href="#packages" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center">
                            <i class="fas fa-route w-4 mr-3"></i>
                            Paket Tour
                        </a>
                    </li>
                    <li>
                        <a href="#about" class="text-gray-300 hover:text-white transition-colors duration-200 flex items-center">
                            <i class="fas fa-info-circle w-4 mr-3"></i>
                            Tentang Kami
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div>
                <h4 class="text-lg font-semibold mb-4 text-white">Kontak</h4>
                <ul class="space-y-3">
                    <li class="text-gray-300 flex items-start">
                        <i class="fas fa-envelope w-4 mr-3 mt-1"></i>
                        <span>info@justtrip.com</span>
                    </li>
                    <li class="text-gray-300 flex items-start">
                        <i class="fas fa-phone w-4 mr-3 mt-1"></i>
                        <span>+62 812-3456-7890</span>
                    </li>
                    <li class="text-gray-300 flex items-start">
                        <i class="fas fa-map-marker-alt w-4 mr-3 mt-1"></i>
                        <span>Jakarta, Indonesia</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="border-t border-white/10 mt-8 pt-8 text-center">
            <p class="text-gray-400 text-sm">
                © {{ date('Y') }} JustTrip. All rights reserved. Made with ❤️ for your journey.
            </p>
        </div>
    </div>
</footer>
