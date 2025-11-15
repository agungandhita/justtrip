<!-- JustTrip Bus Rental Navbar -->
<nav class="fixed top-0 left-0 right-0 z-50 transition-all duration-300 border-b border-gray-100 shadow-sm backdrop-blur-md bg-white/95">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="flex items-center justify-center w-10 h-10 overflow-hidden transition-transform duration-200 bg-blue-500 shadow-sm rounded-xl group-hover:scale-105">
                        <img src="{{ asset('image/logo4.png') }}" alt="JustTrip Logo" class="object-contain w-8 h-8">
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-blue-600 to-blue-700">JustTrip</h1>
                        <p class="-mt-1 text-xs text-gray-500">Your Travel Partner</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="items-center hidden space-x-8 md:flex">
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
                        <span class="flex items-center justify-center w-5 h-5 ml-2 text-xs text-white rounded-full bg-gradient-to-r from-red-500 to-pink-500 animate-pulse">
                            <i class="text-xs fas fa-fire"></i>
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
                    <button id="user-menu-button" class="flex items-center p-2 space-x-2 text-gray-600 transition-colors duration-200 rounded-lg hover:text-gray-900 hover:bg-gray-100">
                        <div class="flex items-center justify-center w-8 h-8 rounded-full bg-gradient-to-br from-blue-500 to-blue-600">
                            <i class="text-sm text-white fas fa-user-circle"></i>
                        </div>
                        <span class="hidden text-sm font-medium md:block">{{ Auth::user()->name }}</span>
                        <i class="text-xs fas fa-chevron-down"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="user-dropdown" class="absolute right-0 z-50 hidden w-64 mt-2 bg-white border border-gray-100 rounded-lg shadow-lg">
                        <div class="py-2">
                            <!-- User Info -->
                            <div class="px-4 py-3 border-b border-gray-100">
                                <p class="text-sm font-medium text-gray-900">{{ Auth::user()->name }}</p>
                                <p class="text-sm text-gray-500">{{ Auth::user()->email }}</p>
                            </div>

                            <!-- Riwayat Login -->
                            <div class="px-4 py-2">
                                <h4 class="mb-2 text-xs font-semibold tracking-wider text-gray-400 uppercase">Riwayat Login</h4>
                                <div class="space-y-1">
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">Login Terakhir:</span>
                                        <span class="text-gray-900">{{ Auth::user()->updated_at->format('d M Y, H:i') }}</span>
                                    </div>
                                    <div class="flex items-center justify-between text-sm">
                                        <span class="text-gray-600">Status:</span>
                                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-green-800 bg-green-100 rounded-full">
                                            <i class="mr-1 text-xs text-green-400 fas fa-circle"></i>
                                            Online
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Menu Items -->
                            <div class="border-t border-gray-100">
                                <a href="{{ route('user.profile') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-50">
                                    <i class="mr-3 text-gray-400 fas fa-user-circle"></i>
                                    Profil Saya
                                </a>
                                <a href="{{ route('booking.index') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-50">
                                    <i class="mr-3 text-gray-400 fas fa-history"></i>
                                    Riwayat Booking
                                </a>
                                {{-- <a href="{{ route('user.settings') }}" class="flex items-center px-4 py-2 text-sm text-gray-700 transition-colors duration-200 hover:bg-gray-50">
                                    <i class="mr-3 text-gray-400 fas fa-cog"></i>
                                    Pengaturan
                                </a> --}}
                            </div>

                            <!-- Logout -->
                            <div class="border-t border-gray-100">
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="flex items-center w-full px-4 py-2 text-sm text-red-600 transition-colors duration-200 hover:bg-red-50">
                                        <i class="mr-3 text-red-500 fas fa-sign-out-alt"></i>
                                        Logout
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <!-- Login/Register Buttons for Guest -->
                <div class="items-center hidden space-x-2 md:flex">
                    <a href="{{ route('login') }}" class="px-4 py-2 font-medium text-gray-700 transition-colors duration-200 hover:text-blue-600">
                        Masuk
                    </a>
                    <a href="{{ route('register') }}" class="px-4 py-2 font-medium text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                        Daftar
                    </a>
                </div>
                @endauth

                <!-- Mobile Menu Button -->
                <button id="mobile-menu-button" class="p-2 text-gray-600 transition-colors duration-200 rounded-lg md:hidden hover:text-gray-900 hover:bg-gray-100">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden bg-white border-t border-gray-100 md:hidden">
        <div class="px-4 py-3 space-y-2">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 {{ request()->routeIs('home') || request()->routeIs('beranda') ? 'text-blue-600 bg-blue-50' : '' }} rounded-lg">
                <i class="mr-2 fas fa-home"></i>
                Beranda
            </a>

            <a href="{{ route('gallery') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('gallery') ? 'text-blue-600 bg-blue-50' : '' }}">
                <i class="mr-2 fas fa-images"></i>
                Galeri
            </a>

            <a href="{{ route('paket-tour') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('paket-tour') ? 'text-blue-600 bg-blue-50' : '' }}">
                <i class="mr-2 fas fa-map-marked-alt"></i>
                Paket Tour
            </a>

            <a href="{{ route('guest-booking.index') }}" class="block px-3 py-2 text-gray-700 hover:text-green-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('guest-booking.*') ? 'text-green-600 bg-green-50' : '' }}">
                <i class="mr-2 fas fa-calendar-plus"></i>
                Guest Booking
            </a>

            <a href="{{ route('special-offers.index') }}" class="block px-3 py-2 text-gray-700 hover:text-red-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('special-offers.*') ? 'text-red-600 bg-red-50' : '' }}">
                <i class="mr-2 fas fa-fire"></i>
                Promo Spesial
                <span class="inline-flex items-center justify-center w-5 h-5 ml-2 text-xs text-white rounded-full bg-gradient-to-r from-red-500 to-pink-500 animate-pulse">
                    <i class="text-xs fas fa-percent"></i>
                </span>
            </a>

            <a href="{{ route('tentang-kami') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('tentang-kami') ? 'text-blue-600 bg-blue-50' : '' }}">
                <i class="mr-2 fas fa-info-circle"></i>
                Tentang Kami
            </a>

            <a href="{{ route('articles.index') }}" class="block px-3 py-2 text-gray-700 hover:text-blue-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('articles.index') ? 'text-blue-600 bg-blue-50' : '' }}">
                <i class="mr-2 fas fa-newspaper"></i>
                Artikel
            </a>

            @auth
            <!-- Simple User Links for Mobile -->
            <div class="pt-3 mt-3 space-y-2 border-t border-gray-200">
                <a href="{{ route('user.profile') }}" class="block px-3 py-2 font-medium text-gray-700 transition-colors duration-200 rounded-lg hover:text-blue-600">
                    <i class="mr-2 fas fa-user-circle"></i>
                    Profil Saya
                </a>
                <a href="{{ route('booking.index') }}" class="block px-3 py-2 font-medium text-gray-700 transition-colors duration-200 rounded-lg hover:text-blue-600">
                    <i class="mr-2 fas fa-history"></i>
                    Riwayat Booking
                </a> --}}
                <form method="POST" action="{{ route('logout') }}" class="block">
                    @csrf
                    <button type="submit" class="block w-full px-3 py-2 font-medium text-left text-red-600 transition-colors duration-200 rounded-lg hover:bg-red-50">
                        <i class="mr-2 fas fa-sign-out-alt"></i>
                        Logout
                    </button>
                </form>
            </div>
            @else
            <!-- Simple Login/Register for Mobile -->
            <div class="pt-3 mt-3 space-y-2 border-t border-gray-200">
                <a href="{{ route('login') }}" class="block px-3 py-2 font-medium text-gray-700 transition-colors duration-200 rounded-lg hover:text-blue-600">
                    <i class="mr-2 fas fa-sign-in-alt"></i>
                    Masuk
                </a>
                <a href="{{ route('register') }}" class="block px-3 py-2 font-medium text-white transition-colors duration-200 bg-blue-600 rounded-lg hover:bg-blue-700">
                    <i class="mr-2 fas fa-user-plus"></i>
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
