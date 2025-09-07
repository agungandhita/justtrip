<!-- JustTrip Navbar with Tailwind CSS -->
<nav class="fixed top-0 left-0 right-0 z-50 bg-white/95 backdrop-blur-md border-b border-gray-100 shadow-sm transition-all duration-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <!-- Logo -->
            <div class="flex items-center">
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <div class="w-10 h-10 bg-gradient-to-br from-teal-500 to-cyan-600 rounded-xl flex items-center justify-center group-hover:scale-105 transition-transform duration-200 overflow-hidden">
                        <img src="{{ asset('image/logo4.png') }}" alt="JustTrip Logo" class="w-8 h-8 object-contain">
                    </div>
                    <div class="hidden sm:block">
                        <h1 class="text-2xl font-bold bg-gradient-to-r from-teal-600 to-cyan-600 bg-clip-text text-transparent">JustTrip</h1>
                        <p class="text-xs text-gray-500 -mt-1">Your Travel Companion</p>
                    </div>
                </a>
            </div>

            <!-- Desktop Navigation -->
            <div class="hidden md:flex items-center space-x-8">
                <a href="{{ route('home') }}" class="text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 {{ request()->routeIs('home') || request()->routeIs('beranda') ? 'text-teal-600' : '' }}">
                    Beranda
                </a>
                <a href="{{ route('gallery') }}" class="text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 {{ request()->routeIs('destinasi') ? 'text-teal-600' : '' }}">
                    Galeri
                </a>
                <a href="{{ route('paket-tour') }}" class="text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 {{ request()->routeIs('paket-tour') ? 'text-teal-600' : '' }}">
                    Paket Tour
                </a>
                <a href="{{ route('tentang-kami') }}" class="text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 {{ request()->routeIs('tentang-kami') ? 'text-teal-600' : '' }}">
                    Tentang Kami
                </a>
                <a href="{{ route('articles.index') }}" class="text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 {{ request()->routeIs('articles.index') ? 'text-teal-600' : '' }}">
                    Artikel
                </a>
            </div>

            <!-- CTA Button & Mobile Menu -->
            <div class="flex items-center space-x-4">
                <!-- CTA Button -->
                <a href="#booking" class="hidden sm:inline-flex items-center px-6 py-2.5 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-full hover:from-orange-600 hover:to-orange-700 transform hover:scale-105 transition-all duration-200 shadow-lg hover:shadow-xl">
                    <i class="fas fa-calendar-check mr-2"></i>
                    Booking
                </a>

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
        <div class="px-4 py-3 space-y-3">
            <a href="{{ route('home') }}" class="block px-3 py-2 text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 {{ request()->routeIs('home') || request()->routeIs('beranda') ? 'text-teal-600 bg-teal-50' : '' }} rounded-lg">
                Beranda
            </a>
            <a href="{{ route('destinasi') }}" class="block px-3 py-2 text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('destinasi') ? 'text-teal-600 bg-teal-50' : '' }}">
                Destinasi
            </a>
            <a href="{{ route('paket-tour') }}" class="block px-3 py-2 text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('paket-tour') ? 'text-teal-600 bg-teal-50' : '' }}">
                Paket Tour
            </a>
            <a href="{{ route('tentang-kami') }}" class="block px-3 py-2 text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('tentang-kami') ? 'text-teal-600 bg-teal-50' : '' }}">
                Tentang Kami
            </a>
            <a href="{{ route('articles.index') }}" class="block px-3 py-2 text-gray-700 hover:text-teal-600 font-medium transition-colors duration-200 rounded-lg {{ request()->routeIs('articles.index') ? 'text-teal-600 bg-teal-50' : '' }}">
                Artikel
            </a>
            <a href="#booking" class="block mt-4 px-4 py-3 bg-gradient-to-r from-orange-500 to-orange-600 text-white font-semibold rounded-full text-center">
                <i class="fas fa-calendar-check mr-2"></i>
                Booking
            </a>
        </div>
    </div>
</nav>

<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobile-menu-button');
        const mobileMenu = document.getElementById('mobile-menu');

        mobileMenuButton.addEventListener('click', function() {
            mobileMenu.classList.toggle('hidden');
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', function(event) {
            if (!mobileMenuButton.contains(event.target) && !mobileMenu.contains(event.target)) {
                mobileMenu.classList.add('hidden');
            }
        });
    });
</script>
</header>
