@extends('layouts.app')

@section('title', 'Detail Lapangan')

@section('content')

<body class="bg-white">
    <div class="pt-24">
        <!-- Content Section -->
        <section class="relative py-8 sm:py-12 md:py-16 overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 lg:gap-8">

                    <!-- Main Content -->
                    <div class="lg:col-span-7 xl:col-span-8 order-2 lg:order-1">

                        <!-- Gambar Lapangan -->
                        <div class="mb-6">
                            <img src="{{ asset('images/lap1.jpeg') }}"
                                alt="Court A" class="w-full rounded-xl shadow-lg" style="height: 400px; object-fit: cover;">
                        </div>

                        <!-- Card Court Lainnya Full Width -->
                        <div class="mt-6 bg-white shadow-lg rounded-xl p-6 w-full max-w-full">
                            <h3 class="text-lg font-semibold text-gray-900 mb-4">Court Lainnya</h3>
                            <ul class="divide-y divide-gray-200">
                                <li class="py-3">
                                    <a href="#preview1" class="block hover:bg-gray-50 transition-colors rounded-md px-4 py-3">
                                        <h4 class="text-gray-900 font-medium">Court B – Smash Zone</h4>
                                        <span class="text-green-500">Rp75.000/jam</span>
                                    </a>
                                </li>
                                <li class="py-3">
                                    <a href="#preview2" class="block hover:bg-gray-50 transition-colors rounded-md px-4 py-3">
                                        <h4 class="text-gray-900 font-medium">Court C – Rally House</h4>
                                        <span class="text-green-500">Rp68.000/jam</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Sidebar Content -->
                    <aside class="lg:col-span-5 xl:col-span-4 order-1 lg:order-2 space-y-6 sm:space-y-8">

                        <!-- Preview Lapangan Card -->
                        <div class="bg-gradient-to-br from-green-500 to-teal-500 p-6 rounded-xl shadow-lg text-white animate-slide-left" style="animation-delay: 0.5s">
                            <span class="text-sm uppercase bg-white/20 px-2 py-1 rounded-full inline-block mb-2">Preview Lapangan</span>
                            <h3 class="text-2xl font-semibold mb-2">Court A - Arena Prime</h3>
                            <p class="text-sm mb-4">
                                Court premium untuk sesi after office, sparring kompetitif, atau latihan teknik dengan fasilitas yang nyaman.
                            </p>
                            <div class="flex flex-wrap gap-3 text-white text-sm mb-4">
                                <span class="inline-flex items-center gap-1 bg-white/20 px-2 py-1 rounded-full">Indoor Vinyl</span>
                                <span class="inline-flex items-center gap-1 bg-white/20 px-2 py-1 rounded-full">Rp90.000 / jam</span>
                                <span class="inline-flex items-center gap-1 bg-white/20 px-2 py-1 rounded-full">⭐ 4.9</span>
                                <span class="inline-flex items-center gap-1 bg-white/20 px-2 py-1 rounded-full">06.00 - 23.00</span>
                            </div>
                            <span class="inline-block mt-2 px-3 py-1 text-green-200 bg-green-800/30 rounded-full text-sm">Tersedia</span>
                            <a href="{{ route('reservasi.create', ['id' => $id]) }}" class="mt-4 block text-center w-full bg-gradient-to-r from-green-400 to-green-500 font-medium py-2 rounded-lg shadow hover:from-green-500 hover:to-green-600 transition-colors">
                                Booking Sekarang
                            </a>
                        </div>

                        <!-- Fasilitas -->
                        <div class="space-y-3 sm:space-y-4 animate-slide-left" style="animation-delay: 0.7s">
                            <h3 class="text-lg font-light text-gray-900">Fasilitas</h3>
                            <div class="flex flex-wrap gap-2">
                                @foreach (['Indoor Vinyl','Net Standar','Lampu LED','Area Tunggu','Locker Room','AC'] as $facility)
                                <span class="px-3 py-1 bg-gray-100 border border-gray-300 rounded-full text-sm text-gray-800 hover:text-gray-900 hover:border-green-500 transition duration-300">
                                    {{ $facility }}
                                </span>
                                @endforeach
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </section>
    </div>
</body>
@endsection