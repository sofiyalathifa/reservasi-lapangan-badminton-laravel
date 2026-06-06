<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Reservasi Lapangan Badminton')</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-white min-h-screen">

    <!-- Navbar -->
    <nav id="navbar" class="fixed top-2 left-0 right-0 z-50 transition-all duration-300">

        <div class="max-w-7xl mx-auto px-4 lg:px-6">

            <div id="navbarContainer" class="bg-white shadow-lg rounded-full px-6 lg:px-8 transition-all duration-300">

                <div class="flex justify-between items-center h-20">

                    <!-- Logo -->
                    <a href="/" class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-green-500 rounded-full flex items-center justify-center text-white text-xl">
                            🏸
                        </div>

                        <div>
                            <h1 class="font-bold text-lg text-gray-800">
                                Badminton
                            </h1>
                            <p class="text-xs text-gray-500">
                                Reservation System
                            </p>
                        </div>
                    </a>

                    <!-- Menu Desktop -->
                    <div class="hidden md:flex items-center gap-8">

                        <a href=" {{ route('home') }}#lapangan-populer"
                            class="text-gray-700 hover:text-green-500 font-medium transition">
                            Lapangan
                        </a>

                        <a href="#pelatih"
                            class="text-gray-700 hover:text-green-500 font-medium transition">
                            Pelatih
                        </a>

                        <a href="#cari-teman"
                            class="text-gray-700 hover:text-green-500 font-medium transition">
                            Cari Teman
                        </a>

                        <a href="#promo"
                            class="text-gray-700 hover:text-green-500 font-medium transition">
                            Promo
                        </a>

                        <a href="#berita"
                            class="text-gray-700 hover:text-green-500 font-medium transition">
                            Berita
                        </a>

                    </div>

                    <!-- Button Desktop -->
                    <div class="hidden md:block">
                        @auth
                            <div class="relative group cursor-pointer pt-2 pb-2">
                                <!-- Profile Initial Avatar -->
                                <div class="w-11 h-11 bg-gradient-to-r from-green-500 to-teal-500 rounded-full flex items-center justify-center text-white font-bold text-lg uppercase shadow-md hover:shadow-lg transition">
                                    {{ substr(Auth::user()->name, 0, 1) }}
                                </div>
                                
                                <!-- Dropdown Menu -->
                                <div class="absolute right-0 top-full mt-1 w-56 bg-white rounded-xl shadow-xl py-2 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-gray-100">
                                    <div class="px-4 py-3 border-b border-gray-100">
                                        <p class="text-sm font-semibold text-gray-800 truncate">{{ Auth::user()->name }}</p>
                                        <p class="text-xs text-gray-500 truncate">{{ Auth::user()->email }}</p>
                                    </div>
                                    <div class="py-1 border-b border-gray-100">
                                        <a href="{{ route('reservasi.riwayat') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-medium text-gray-700 hover:bg-gray-50 hover:text-green-600 transition">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"></path></svg>
                                            Pesanan Saya
                                        </a>
                                        @if(Auth::user()->role === 'admin')
                                        <a href="{{ route('admin.reservasi.index') }}" class="flex items-center gap-2 px-4 py-2 text-sm font-bold text-gray-700 hover:bg-teal-50 hover:text-teal-600 transition border-t border-gray-100">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                            Dashboard Admin
                                        </a>
                                        @endif
                                    </div>
                                    <form method="POST" action="{{ route('logout') }}" class="pt-1">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-sm font-medium text-red-600 hover:bg-red-50 hover:text-red-700 transition">
                                            Sign out
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="/login"
                                class="bg-gradient-to-r from-green-500 to-teal-500
                                   text-white px-6 py-3 rounded-full
                                   font-medium hover:scale-105 transition">
                                Login
                            </a>
                        @endauth
                    </div>

                    <!-- Hamburger Mobile -->
                    <button id="menuBtn"
                        class="md:hidden text-3xl text-gray-700">
                        ☰
                    </button>

                </div>
            </div>

        </div>
    </nav>

    <!-- Overlay -->
    <div id="overlay"
        class="fixed inset-0 bg-black/50 hidden z-40 md:hidden">
    </div>

    <!-- Sidebar Mobile -->
    <div id="mobileSidebar"
        class="fixed top-0 right-0 h-screen w-[80%] max-w-xs
           bg-gradient-to-b from-green-400 via-teal-500 to-cyan-600
           z-50 transform translate-x-full
           transition-transform duration-300 md:hidden">

        <!-- Close Button -->
        <div class="p-6">
            <button id="closeMenu"
                class="text-white text-3xl">
                ✕
            </button>
        </div>

        <!-- Menu -->
        <div class="px-8">

            <div class="flex flex-col space-y-2">

                <a href="/"
                    class="block w-full px-4 py-3 rounded-md font-semibold text-white transition duration-200
        {{ request()->routeIs('home') ? 'bg-white/20' : 'hover:bg-white/20' }}">
                    Home
                </a>

                <a href="/lapangan"
                    class="block w-full px-4 py-3 rounded-md font-semibold text-white transition duration-200
        {{ request()->routeIs('lapangan') ? 'bg-white/20' : 'hover:bg-white/20' }}">
                    Lapangan
                </a>

                <a href="/pelatih"
                    class="block w-full px-4 py-3 rounded-md font-semibold text-white transition duration-200
        {{ request()->routeIs('pelatih') ? 'bg-white/20' : 'hover:bg-white/20' }}">
                    Pelatih
                </a>

                <a href="/cari-teman"
                    class="block w-full px-4 py-3 rounded-md font-semibold text-white transition duration-200
        {{ request()->routeIs('cari-teman') ? 'bg-white/20' : 'hover:bg-white/20' }}">
                    Cari Teman
                </a>

                <a href="/promo"
                    class="block w-full px-4 py-3 rounded-md font-semibold text-white transition duration-200
        {{ request()->routeIs('promo') ? 'bg-white/20' : 'hover:bg-white/20' }}">
                    Promo
                </a>

                <a href="/berita"
                    class="block w-full px-4 py-3 rounded-md font-semibold text-white transition duration-200
        {{ request()->routeIs('berita') ? 'bg-white/20' : 'hover:bg-white/20' }}">
                    Berita
                </a>

                @auth
                <div class="my-2 border-t border-white/20"></div>
                <a href="{{ route('reservasi.riwayat') }}"
                    class="block w-full px-4 py-3 rounded-md font-bold text-yellow-300 transition duration-200
        {{ request()->routeIs('reservasi.riwayat') ? 'bg-white/20' : 'hover:bg-white/20' }}">
                    Pesanan Saya
                </a>
                
                @if(Auth::user()->role === 'admin')
                <a href="{{ route('admin.reservasi.index') }}"
                    class="block w-full px-4 py-3 rounded-md font-bold text-teal-300 transition duration-200
        {{ request()->routeIs('admin.reservasi.index') ? 'bg-white/20' : 'hover:bg-white/20' }}">
                    Dashboard Admin
                </a>
                @endif
                @endauth

            </div>

        </div>

        <!-- Footer -->
        <div class="absolute bottom-8 left-0 right-0">

            <div class="flex justify-center gap-4">

                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white">
                    f
                </div>

                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white">
                    x
                </div>

                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white">
                    ig
                </div>

                <div class="w-10 h-10 rounded-full bg-white/20 flex items-center justify-center text-white">
                    in
                </div>

            </div>

            <p class="text-center text-white/80 text-sm mt-5">
                © Copyright 2026
            </p>

        </div>

    </div>

    <!-- Content -->
    <main>
        @yield('content')
    </main>

    <!-- Script Sidebar -->
    <script>
        // Sidebar
        const menuBtn = document.getElementById('menuBtn');
        const closeMenu = document.getElementById('closeMenu');
        const sidebar = document.getElementById('mobileSidebar');
        const overlay = document.getElementById('overlay');

        menuBtn.addEventListener('click', () => {
            sidebar.classList.remove('translate-x-full');
            overlay.classList.remove('hidden');
        });

        closeMenu.addEventListener('click', () => {
            sidebar.classList.add('translate-x-full');
            overlay.classList.add('hidden');
        });

        overlay.addEventListener('click', () => {
            sidebar.classList.add('translate-x-full');
            overlay.classList.add('hidden');
        });

        // Navbar Scroll Effect
        const navbar = document.getElementById('navbar');
        const navbarContainer = document.getElementById('navbarContainer');
        let scrollTimeout;

        window.addEventListener('scroll', () => {

            // Sembunyikan navbar saat scroll (jika tidak sedang di paling atas)
            if (window.scrollY > 50) {
                navbar.style.transform = 'translateY(-150%)';
            }

            // Hapus timeout sebelumnya agar tidak tumpang tindih
            clearTimeout(scrollTimeout);

            // Set timeout baru untuk memunculkan navbar setelah scroll berhenti (misal: 250ms)
            scrollTimeout = setTimeout(() => {
                navbar.style.transform = 'translateY(0)';
            }, 250);

            if (window.scrollY > 50) {
                navbar.classList.remove('top-2');
                navbar.classList.add('top-0');
            } else {
                navbar.classList.remove('top-0');
                navbar.classList.add('top-2');
                navbar.style.transform = 'translateY(0)'; // Pastikan selalu muncul jika di atas
            }
        });
    </script>

    @if(isset($showFooter) && $showFooter)
    @include('partials.footer')
    @endif
</body>

</html>