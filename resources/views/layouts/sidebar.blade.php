<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- FontAwesome CDN -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<!-- <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>SDK Badminton Hall</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head> -->

<body class="m-0 font-sans text-base antialiased font-normal dark:bg-slate-900 leading-default bg-gray-50 text-slate-500" style="font-family: 'Open Sans', sans-serif;">
    <div class="absolute w-full bg-gradient-to-r from-green-500 to-teal-500 dark:hidden min-h-[300px]"></div>
    <!-- sidenav  -->
    <!-- Menggunakan overflow-hidden untuk mengunci scroll halaman luar -->
    <aside class="fixed inset-y-0 flex flex-col items-center justify-between block w-full p-0 my-4 overflow-hidden antialiased transition-transform duration-200 -translate-x-full bg-white border-0 shadow-xl dark:shadow-none dark:bg-slate-800 max-w-64 ease-nav-brand z-990 lg:ml-6 rounded-2xl lg:left-0 lg:translate-x-0" aria-expanded="false">

        <!-- Bagian Logo (Tinggi tetap) -->
        <div class="h-19 w-full flex-shrink-0">
            <i class="absolute top-0 right-0 p-4 opacity-50 cursor-pointer fas fa-times dark:text-white text-slate-400 lg:hidden" sidenav-close></i>
            <a class="block px-8 py-5 m-0 text-sm whitespace-nowrap dark:text-white text-slate-700">
                <img src="{{ asset('images/logo.png') }}" class="inline h-full max-w-full transition-all duration-200 dark:hidden ease-nav-brand max-h-8" alt="main_logo" />
                <span class="ml-1 font-semibold transition-all duration-200 ease-nav-brand">Argon Dashboard 2</span>
            </a>
        </div>

        <!-- Navigasi Utama -->
        <nav class="flex flex-col overflow-hidden w-full flex-1 px-4 text-sm bg-white pb-4">

            @php
                $role = auth()->user()->role ?? 'user';
            @endphp

            <!-- Jarak antar menu vertikal dipadatkan (space-y-0.5) agar tombol logout naik ke atas layar -->
            <div class="flex flex-col h-full flex-1 space-y-0.5">

                <a href="{{ route('dashboard') }}" class="flex items-center px-4 py-1.5 hover:text-white rounded-lg transition-colors hover:bg-gradient-to-r hover:from-green-500 hover:to-teal-500">
                    Dashboard
                </a>

                @if(in_array($role, ['admin', 'kasir']))
                <a href="{{ route('admin.reservasi.index') }}" class="flex items-center px-4 py-1.5 hover:text-white rounded-lg transition-colors hover:bg-gradient-to-r hover:from-green-500 hover:to-teal-500">
                    Data Reservasi
                </a>
                <a href="{{ route('admin.pembayaran.index') }}" class="flex items-center px-4 py-1.5 hover:text-white rounded-lg transition-colors hover:bg-gradient-to-r hover:from-green-500 hover:to-teal-500">
                    Data Pembayaran
                </a>
                @endif

                @if($role === 'admin')
                <a href="{{ route('pelanggan.index') }}" class="flex items-center px-4 py-1.5 hover:text-white rounded-lg transition-colors hover:bg-gradient-to-r hover:from-green-500 hover:to-teal-500">
                    Pelanggan
                </a>
                <a href="{{ route('admin.pelatih.index') }}" class="flex items-center px-4 py-1.5 hover:text-white rounded-lg transition-colors hover:bg-gradient-to-r hover:from-green-500 hover:to-teal-500">
                    Pelatih
                </a>
                <a href="{{ route('admin.lapangan.index') }}" class="flex items-center px-4 py-1.5 hover:text-white rounded-lg transition-colors hover:bg-gradient-to-r hover:from-green-500 hover:to-teal-500">
                    Lapangan
                </a>
                @endif

                @if($role === 'owner')
                <a href="#" class="flex items-center px-4 py-1.5 hover:text-white rounded-lg transition-colors hover:bg-gradient-to-r hover:from-green-500 hover:to-teal-500">
                    Laporan Reservasi
                </a>
                <a href="#" class="flex items-center px-4 py-1.5 hover:text-white rounded-lg transition-colors hover:bg-gradient-to-r hover:from-green-500 hover:to-teal-500">
                    Laporan Pembayaran
                </a>
                @endif

                <div class="mt-auto pt-2 px-4 w-full">
                    <form action="{{ route('logout') }}" method="POST" class="w-full">
                        @csrf
                        <button type="submit" class="flex justify-center items-center px-4 py-2 w-full text-white font-semibold rounded-lg shadow-md bg-gradient-to-r from-green-500 to-teal-500 hover:opacity-90 transition border-0 cursor-pointer">
                            Logout
                        </button>
                    </form>
                </div>
            </div>

        </nav>
    </aside>
    <!-- end sidenav -->

    <main> <!-- Navbar -->
        <nav class="relative flex flex-wrap items-center justify-between px-0 py-2 mx-6 transition-all ease-in shadow-none duration-250 rounded-2xl lg:flex-nowrap lg:justify-start" navbar-main navbar-scroll="false">
            <div class="flex items-center justify-between w-full px-4 py-1 mx-auto flex-wrap-inherit">
                <div class="flex items-center mt-2 grow sm:mt-0 sm:mr-6 md:mr-0 lg:flex lg:basis-auto">
                    <ul class="flex flex-row justify-end pl-0 mb-0 list-none md-max:w-full md:ml-auto md:pr-4">
                        <li class="flex items-center pl-4 lg:hidden"> <a href="javascript:;" class="block p-0 text-sm text-white transition-all ease-nav-brand" sidenav-trigger>
                                <div class="w-4.5 overflow-hidden"> <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i> <i class="ease mb-0.75 relative block h-0.5 rounded-sm bg-white transition-all"></i> <i class="ease relative block h-0.5 rounded-sm bg-white transition-all"></i> </div>
                            </a> </li> <!-- notifications -->
                        <div class="flex items-center space-x-4"> <!-- Foto profil --> <img src="{{ asset('images/logo.png') }}" alt="User Profile" class="w-10 h-10 rounded-full border-2 border-white shadow-md"> <!-- Nama dan role -->
                            <div class="flex flex-col"> <span class="text-sm font-semibold text-white">{{ auth()->check() ? auth()->user()->name : 'User' }}</span> <span class="text-xs text-gray-200 capitalize">{{ auth()->check() ? auth()->user()->role : 'Guest' }}</span> </div> <!-- Icon notifikasi -->
                            <div class="flex items-center space-x-3 ml-4"> <button class="text-white hover:text-gray-200 relative"> <i class="fas fa-bell"></i> <!-- tanda notifikasi merah --> <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span> </button> </div>
                        </div>
                    </ul>
                </div>
            </div>
        </nav> <!-- end Navbar --> @yield('content')
    </main>
    <script>
        // Sidebar Toggle Script
        document.addEventListener('DOMContentLoaded', function() {
            const sidenav = document.querySelector('aside');
            const trigger = document.querySelector('[sidenav-trigger]');
            const closeBtn = document.querySelector('[sidenav-close]');

            if (trigger) {
                trigger.addEventListener('click', function() {
                    sidenav.classList.remove('-translate-x-full');
                    sidenav.classList.add('translate-x-0');
                    sidenav.setAttribute('aria-expanded', 'true');
                });
            }

            if (closeBtn) {
                closeBtn.addEventListener('click', function() {
                    sidenav.classList.add('-translate-x-full');
                    sidenav.classList.remove('translate-x-0');
                    sidenav.setAttribute('aria-expanded', 'false');
                });
            }
        });
    </script>
    @yield('modals')
</body>

</html>

<!-- <nav class="mb-2">
    <ol class="flex flex-wrap pt-1 mr-12 bg-transparent rounded-lg sm:mr-16">
        <li class="text-sm leading-normal">
            <a class="text-white opacity-50" href="javascript:;">Pages</a>
        </li>
        <li class="text-sm pl-2 capitalize leading-normal text-white before:float-left before:pr-2 before:text-white before:content-['/']" aria-current="page">Dashboard</li>
    </ol>
    <h6 class="mb-0 font-bold text-white capitalize">Dashboard</h6>
</nav> -->