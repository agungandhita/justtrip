<div>
    <div class="flex items-start">
        <nav id="sidebar" class="lg:min-w-[250px] w-max max-lg:min-w-8">
            <div id="sidebar-collapse-menu" style="height: calc(100vh - 72px)"
                class="bg-white shadow-lg h-screen fixed py-6 px-4 top-[70px] left-0 overflow-auto z-[99] lg:min-w-[250px] lg:w-max max-lg:w-0 max-lg:invisible transition-all duration-500">

                <!-- Menu Utama -->
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.dashboard') }}"
                            class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all {{ request()->routeIs('admin') || request()->routeIs('admin.dashboard') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3"
                                viewBox="0 0 24 24">
                                <path
                                    d="M19.56 23.253H4.44a4.051 4.051 0 0 1-4.05-4.05v-9.115c0-1.317.648-2.56 1.728-3.315l7.56-5.292a4.062 4.062 0 0 1 4.644 0l7.56 5.292a4.056 4.056 0 0 1 1.728 3.315v9.115a4.051 4.051 0 0 1-4.05 4.05zM12 2.366a2.45 2.45 0 0 0-1.393.443l-7.56 5.292a2.433 2.433 0 0 0-1.037 1.987v9.115c0 1.34 1.09 2.43 2.43 2.43h15.12c1.34 0 2.43-1.09 2.43-2.43v-9.115c0-.788-.389-1.533-1.037-1.987l-7.56-5.292A2.438 2.438 0 0 0 12 2.377z"
                                    data-original="#000000"></path>
                                <path
                                    d="M16.32 23.253H7.68a.816.816 0 0 1-.81-.81v-5.4c0-2.83 2.3-5.13 5.13-5.13s5.13 2.3 5.13 5.13v5.4c0 .443-.367.81-.81.81zm-7.83-1.62h7.02v-4.59c0-1.933-1.577-3.51-3.51-3.51s-3.51 1.577-3.51 3.51z"
                                    data-original="#000000"></path>
                            </svg>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>

                <!-- Manajemen User -->
                <div class="mt-6">
                    <h6 class="text-blue-600 text-sm font-bold px-4">Manajemen User</h6>
                    <ul class="mt-3 space-y-2">
                        <li>
                            <a href="{{ route('admin.users.index') }}"
                                class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all {{ request()->routeIs('admin.users.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3" viewBox="0 0 24 24">
                                    <path d="M12 14V16C8.68629 16 6 18.6863 6 22H4C4 17.5817 7.58172 14 12 14ZM12 13C8.685 13 6 10.315 6 7C6 3.685 8.685 1 12 1C15.315 1 18 3.685 18 7C18 10.315 15.315 13 12 13ZM12 11C14.21 11 16 9.21 16 7C16 4.79 14.21 3 12 3C9.79 3 8 4.79 8 7C8 9.21 9.79 11 12 11ZM18 17V14H20V17H23V19H20V22H18V19H15V17H18Z"/>
                                </svg>
                                <span>Kelola User</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Manajemen Konten -->
                <div class="mt-6">
                    <h6 class="text-blue-600 text-sm font-bold px-4">Manajemen Konten</h6>
                    <ul class="mt-3 space-y-2">
                        <li>
                            <a href="{{ route('admin.news.index') }}" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all {{ request()->routeIs('admin.news.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3" viewBox="0 0 24 24">
                                    <path d="M20,11H23V13H20V11M1,11H4V13H1V11M13,1V4H11V1H13M4.92,3.5L7.05,5.64L5.63,7.05L3.5,4.93L4.92,3.5M16.95,5.63L19.07,3.5L20.5,4.93L18.37,7.05L16.95,5.63M12,6A6,6 0 0,1 18,12C18,14.22 16.79,16.16 15,17.2V19A1,1 0 0,1 14,20H10A1,1 0 0,1 9,19V17.2C7.21,16.16 6,14.22 6,12A6,6 0 0,1 12,6M14,21V22A1,1 0 0,1 13,23H11A1,1 0 0,1 10,22V21H14M11,16H13V8H11V16Z"/>
                                </svg>
                                <span>News & Articles</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.galleries.index') }}" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all {{ request()->routeIs('admin.gallery.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3" viewBox="0 0 24 24">
                                    <path d="M8.5,13.5L11,16.5L14.5,12L19,18H5M21,19V5C21,3.89 20.1,3 19,3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19Z"/>
                                </svg>
                                <span>Gallery</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Manajemen Produk & Layanan -->
                <div class="mt-6">
                    <h6 class="text-blue-600 text-sm font-bold px-4">Manajemen Produk & Layanan</h6>
                    <ul class="mt-3 space-y-2">
                         <li>
                            <a href="{{ route('admin.layanan.index') }}" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all {{ request()->routeIs('admin.layanan.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3" viewBox="0 0 24 24">
                                    <path d="M14,2H6A2,2 0 0,0 4,4V20A2,2 0 0,0 6,22H18A2,2 0 0,0 20,20V8L14,2M18,20H6V4H13V9H18V20Z"/>
                                </svg>
                                <span>Layanan Travel</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.special-offers.index') }}" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all {{ request()->routeIs('admin.special-offers.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3" viewBox="0 0 24 24">
                                    <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M12,6A6,6 0 0,1 18,12A6,6 0 0,1 12,18A6,6 0 0,1 6,12A6,6 0 0,1 12,6M12,8A4,4 0 0,0 8,12A4,4 0 0,0 12,16A4,4 0 0,0 16,12A4,4 0 0,0 12,8Z"/>
                                </svg>
                                <span>Special Offers</span>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Manajemen Booking -->
                <div class="mt-6">
                    <h6 class="text-blue-600 text-sm font-bold px-4">Manajemen Booking</h6>
                    <ul class="mt-3 space-y-2">
                        <li>
                            <a href="{{ route('admin.bookings.index') }}" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all {{ request()->routeIs('admin.bookings.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3" viewBox="0 0 24 24">
                                    <path d="M19,3H18V1H16V3H8V1H6V3H5A2,2 0 0,0 3,5V19A2,2 0 0,0 5,21H19A2,2 0 0,0 21,19V5A2,2 0 0,0 19,3M19,19H5V8H19V19M16,10V12H14V10H16M12,10V12H10V10H12M8,10V12H6V10H8M16,14V16H14V14H16M12,14V16H10V14H12M8,14V16H6V14H8"/>
                                </svg>
                                <span>Booking Member</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.guest-bookings.index') }}" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all {{ request()->routeIs('admin.guest-bookings.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3" viewBox="0 0 24 24">
                                    <path d="M16,4C18.11,4 19.8,5.69 19.8,7.8C19.8,9.91 18.11,11.6 16,11.6C13.89,11.6 12.2,9.91 12.2,7.8C12.2,5.69 13.89,4 16,4M16,13.4C18.67,13.4 24,14.73 24,17.4V20H8V17.4C8,14.73 13.33,13.4 16,13.4M12.51,7.71C12.56,9.81 10.81,11.6 8.7,11.55C6.58,11.5 4.8,9.75 4.85,7.64C4.9,5.53 6.65,3.75 8.76,3.8C10.37,3.83 11.7,4.96 12.1,6.5C12.17,6.74 12.2,6.98 12.2,7.23C12.2,7.4 12.17,7.56 12.15,7.71H12.51M7.71,13.4C8.78,13.4 9.8,13.54 10.76,13.77C9.36,14.68 8.6,15.84 8.6,17.4V20H0V17.4C0,14.73 5.33,13.4 7.71,13.4Z"/>
                                </svg>
                                <span>Guest Booking</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('admin.payment-confirmations.index') }}" class="text-gray-800 text-sm flex items-center hover:bg-gray-100 rounded-md px-4 py-2 transition-all {{ request()->routeIs('admin.payment-confirmations.*') ? 'bg-blue-50 text-blue-600 border-r-2 border-blue-600' : '' }}">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="w-[18px] h-[18px] mr-3" viewBox="0 0 24 24">
                                    <path d="M12,2A10,10 0 0,1 22,12A10,10 0 0,1 12,22A10,10 0 0,1 2,12A10,10 0 0,1 12,2M12,4A8,8 0 0,0 4,12A8,8 0 0,0 12,20A8,8 0 0,0 20,12A8,8 0 0,0 12,4M11,16.5L6.5,12L7.91,10.59L11,13.67L16.59,8.09L18,9.5L11,16.5Z"/>
                                </svg>
                                <span>Konfirmasi Pembayaran</span>
                            </a>
                        </li>
                    </ul>
                </div>
                <!-- Aksi & Profil -->
                <div class="mt-6">
                    <h6 class="text-blue-600 text-sm font-bold px-4">Aksi & Profil</h6>
                    <ul class="mt-3 space-y-2">
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit"
                                    class="text-gray-800 text-sm flex items-center cursor-pointer hover:bg-gray-100 rounded-md px-4 py-2 w-full transition-all">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                                        class="w-[18px] h-[18px] mr-3" viewBox="0 0 6.35 6.35">
                                        <path
                                            d="M3.172.53a.265.266 0 0 0-.262.268v2.127a.265.266 0 0 0 .53 0V.798A.265.266 0 0 0 3.172.53zm1.544.532a.265.266 0 0 0-.026 0 .265.266 0 0 0-.147.47c.459.391.749.973.749 1.626 0 1.18-.944 2.131-2.116 2.131A2.12 2.12 0 0 1 1.06 3.16c0-.65.286-1.228.74-1.62a.265.266 0 1 0-.344-.404A2.667 2.667 0 0 0 .53 3.158a2.66 2.66 0 0 0 2.647 2.663 2.657 2.657 0 0 0 2.645-2.663c0-.812-.363-1.542-.936-2.03a.265.266 0 0 0-.17-.066z"
                                            data-original="#000000" />
                                    </svg>
                                    <span>Logout</span>
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>

        <button id="toggle-sidebar"
            class='lg:hidden w-8 h-8 z-[100] fixed top-[74px] left-[10px] cursor-pointer bg-[#007bff] flex items-center justify-center rounded-full outline-none transition-all duration-500'>
            <svg xmlns="http://www.w3.org/2000/svg" fill="#fff" class="w-3 h-3" viewBox="0 0 55.752 55.752">
                <path
                    d="M43.006 23.916a5.36 5.36 0 0 0-.912-.727L20.485 1.581a5.4 5.4 0 0 0-7.637 7.638l18.611 18.609-18.705 18.707a5.398 5.398 0 1 0 7.634 7.635l21.706-21.703a5.35 5.35 0 0 0 .912-.727 5.373 5.373 0 0 0 1.574-3.912 5.363 5.363 0 0 0-1.574-3.912z"
                    data-original="#000000" />
            </svg>
        </button>

    </div>
</div>
