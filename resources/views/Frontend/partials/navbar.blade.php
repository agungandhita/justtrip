<!-- JustTrip Bus Rental Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-200 overflow-hidden shadow-sm">
                        <img src="{{ asset('image/logo4.png') }}" alt="JustTrip Logo" class="w-8 h-8 object-contain">
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-700 bg-clip-text text-transparent">JustTrip</h1>
                        <p class="text-xs text-gray-500 -mt-1">Your Travel Partner</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('home') || request()->routeIs('beranda') ? 'text-blue-600' : '' }}">
                    Beranda
                </a>

                <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('gallery') ? 'text-blue-600' : '' }}">
                    Galeri
                </a>
                <a href="{{ route('paket-tour') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('paket-tour') ? 'text-blue-600' : '' }}">
                    Paket Tour
                </a>

                <a href="{{ route('guest-booking.index') }}" class="text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 {{ request()->routeIs('guest-booking.*') ? 'text-green-600' : '' }}">
                    Guest Booking
                </a>

                <!-- Special Offers with Badge -->
                <a href="{{ route('special-offers.index') }}" class="relative text-gray-700 hover:text-red-600 font-medium transition-colors duration-200 {{ request()->routeIs('special-offers.*') ? 'text-red-600' : '' }}">
                    <span class="flex items-center">
                        Promo Spesial
                        <span class="ml-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full w-5 h-5 flex items-center justify-center animate-pulse">
                            <i class="fas fa-fire text-xs"></i>
                        </span>
                    </span>
                </a>

                <a href="{{ route('tentang-kami') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('tentang-kami') ? 'text-blue-600' : '' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('articles.index') ? 'text-blue-600' : '' }}">
                    Artikel
                </a>
            </div>

            <!-- CTA Button & User Menu & Mobile Menu -->
            <div class="flex items-center space-x-4">
                <!-- User Dropdown Menu -->
                @auth
                <div class="relative">
                    <button id="user-menu-button" class="flex items-center space-x-2 p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center">
                            <i class="fas fa-user-circle text-white text-sm"></i>
                        </div>
                        <span class="hidden md:block text-sm font-medium">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-xs"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="user-dropdown" class="absolute right-0 mt-2 w-64 bg-white rounded-lg shadow-lg border border-gray-100 hidden z-50">
                        <div class="py-2">
                            <!-- User Info -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                            </div>

                            <!-- Riwayat Login -->
                            <div class="px-4 py-2">
                                <h4 class="text-xs font-semibold text-gray-400 uppercase tracking-wider mb-2">Riwayat Login</h4>
                                <div class="space-y-1">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">Login Terakhir:</span>
                                        <span class="text-gray-900">{{ Auth::user()->updated_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">Status:</span>
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                            <i class="fas fa-circle text-green-400 text-xs mr-1"></i>
                                            Online
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <div class="border-t border-gray-100">
                                <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-user-circle mr-3 text-gray-400"></i>
                                    Profil Saya
                                </a>
                                <a href="{{ route('user.bookings') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-history mr-3 text-gray-400"></i>
                                    Riwayat Booking
                                </a>
                                <a href="{{ route('user.settings') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 hover:bg-gray-50 transition-colors duration-200">
                                    <i class="fas fa-cog mr-3 text-gray-400"></i>
                                    Pengaturan
                                </a>
                            </div>

                            <!-- Logout -->
                            <div class="border-t border-gray-100">
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 hover:bg-red-50 transition-colors duration-200">
                                        <i class="fas fa-sign-out-alt mr-3 text-red-500"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <!-- Login/Register Buttons for Guest -->
                <div class="hidden md:flex items-center space-x-2">
                    <a href="{{ route('login') }}" class="px-4 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                        Daftar
                    </a>
                </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="md:hidden p-2 rounded-lg text-gray-600 hover:text-gray-900 hover:bg-gray-100 transition-colors duration-200">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="md:hidden hidden bg-white border-t border-gray-100">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('home') || request()->routeIs('beranda') ? 'text-blue-600 bg-blue-50' : '' }} rounded-lg">
                <i class="fas fa-home mr-2"></i>
                Beranda
            </a>

            <a href="{{ route('gallery') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('gallery') ? 'text-blue-600 bg-blue-50' : '' }}">
                <i class="fas fa-images mr-2"></i>
                Galeri
            </a>

            <a href="{{ route('paket-tour') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('paket-tour') ? 'text-blue-600 bg-blue-50' : '' }}">
                <i class="fas fa-map-marked-alt mr-2"></i>
                Paket Tour
            </a>

            <a href="{{ route('guest-booking.index') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('guest-booking.*') ? 'text-green-600 bg-green-50' : '' }}">
                <i class="fas fa-calendar-plus mr-2"></i>
                Guest Booking
            </a>

            <a href="{{ route('special-offers.index') }}" class="block px-3 py-2 text-gray-700 hover:text-red-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('special-offers.*') ? 'text-red-600 bg-red-50' : '' }}">
                <i class="fas fa-fire mr-2"></i>
                Promo Spesial
                <span class="ml-2 bg-gradient-to-r from-red-500 to-pink-500 text-white text-xs rounded-full w-5 h-5 inline-flex items-center justify-center animate-pulse">
                    <i class="fas fa-percent text-xs"></i>
                </span>
            </a>

            <a href="{{ route('tentang-kami') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('tentang-kami') ? 'text-blue-600 bg-blue-50' : '' }}">
                <i class="fas fa-info-circle mr-2"></i>
                Tentang Kami
            </a>

            <a href="{{ route('articles.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('articles.index') ? 'text-blue-600 bg-blue-50' : '' }}">
                <i class="fas fa-newspaper mr-2"></i>
                Artikel
            </a>

            @auth
            <!-- Simple User Links for Mobile -->
            <div class="border-t border-gray-200 mt-3 pt-3 space-y-2">
                <a href="{{ route('user.profile') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg">
                    <i class="fas fa-user-circle mr-2"></i>
                    Profil Saya
                </a>
                <a href="{{ route('user.bookings') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg">
                    <i class="fas fa-history mr-2"></i>
                    Riwayat Booking
                </a>
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="block w-full text-left px-3 py-2 text-red-600 hover:bg-red-50 font-medium transition-colors duration-200 rounded-lg">
                        <i class="fas fa-sign-out-alt mr-2"></i>
                        Logout
                    </button>
                </form>
            </div>
            @else
            <!-- Simple Login/Register for Mobile -->
            <div class="border-t border-gray-200 mt-3 pt-3 space-y-2">
                <a href="{{ route('login') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg">
                    <i class="fas fa-sign-in-alt mr-2"></i>
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="block px-3 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition-colors duration-200">
                    <i class="fas fa-user-plus mr-2"></i>
                    Daftar
                </a>
            </div>
            @endauth
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle and User dropdown toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');
        const userMenuButton = document.getElementById('user-menu-button');
        const userDropdown = document.getElementById('user-dropdown');

        // Mobile menu toggle
        if (mobileMenuButton && mobileMenu) {
            mobileMenuButton.addEventListener('click', function() {
                mobileMenu.classList.toggle('hidden');
                // Close user dropdown when opening mobile menu
                if (userDropdown) {
                    userDropdown.classList.add('hidden');
                }
            });
        }

        // User dropdown toggle
        if (userMenuButton && userDropdown) {
            userMenuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                userDropdown.classList.toggle('hidden');
                // Close mobile menu when opening user dropdown
                if (mobileMenu) {
                    mobileMenu.classList.add('hidden');
                }
            });
        }

        // Close menus when clicking outside
        document.addEventListener('click', function(event) {
            // Close mobile menu
            if (mobileMenuButton && mobileMenu &&
                !mobileMenuButton.contains(event.target) &&
                !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }

            // Close user dropdown
            if (userMenuButton && userDropdown &&
                !userMenuButton.contains(event.target) &&
                !userDropdown.contains(event.target)) {
                userDropdown.classList.add('hidden');
            }
        });

        // Close dropdowns when pressing Escape key
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape') {
                if (mobileMenu) mobileMenu.classList.add('hidden');
                if (userDropdown) userDropdown.classList.add('hidden');
            }
        });
    });
</script>
</header>
