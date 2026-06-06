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
                            <img src="{{ asset('images/' . ($lapangan->foto ?? 'lap1.jpeg')) }}"
                                alt="{{ $lapangan->nama_lapangan }}" class="w-full rounded-xl shadow-lg" style="height: 400px; object-fit: cover;">
                        </div>

                        <!-- Ulasan Pelanggan -->
                        <div class="mt-6 bg-white shadow-xl rounded-2xl p-8 w-full max-w-full border border-gray-50">
                            <h3 class="text-xl font-black text-gray-900 mb-6 flex items-center gap-3">
                                <span class="flex items-center justify-center w-10 h-10 rounded-full bg-yellow-100 text-yellow-500">
                                    <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path></svg>
                                </span>
                                Ulasan Pelanggan
                            </h3>
                            <div class="space-y-6">
                                <!-- Review 1 -->
                                <div class="border-b border-gray-100 pb-6 last:border-0 last:pb-0 transition duration-300 hover:bg-gray-50 p-4 rounded-xl -mx-4">
                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 rounded-full bg-green-500 flex items-center justify-center text-white font-bold text-xl shrink-0 shadow-sm">
                                            A
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <h4 class="font-bold text-gray-900">Ahmad Budi</h4>
                                                <span class="text-xs font-semibold text-gray-400 bg-gray-100 px-2 py-1 rounded-full">2 hari lalu</span>
                                            </div>
                                            <div class="flex text-yellow-400 text-sm mb-3">
                                                ★★★★★
                                            </div>
                                            <p class="text-gray-600 leading-relaxed text-sm">
                                                "Sirkulasi udara sangat bagus, karpet vinylnya kesat dan tidak licin sama sekali. Pencahayaannya juga pas, tidak bikin silau saat melihat bola lambung. Sangat direkomendasikan!"
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <!-- Review 2 -->
                                <div class="border-b border-gray-100 pb-6 last:border-0 last:pb-0 transition duration-300 hover:bg-gray-50 p-4 rounded-xl -mx-4">
                                    <div class="flex items-start gap-4">
                                        <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-bold text-xl shrink-0 shadow-sm">
                                            R
                                        </div>
                                        <div class="flex-1">
                                            <div class="flex items-center justify-between mb-1">
                                                <h4 class="font-bold text-gray-900">Rizky Pratama</h4>
                                                <span class="text-xs font-semibold text-gray-400 bg-gray-100 px-2 py-1 rounded-full">1 mgg lalu</span>
                                            </div>
                                            <div class="flex text-yellow-400 text-sm mb-3">
                                                ★★★★<span class="text-gray-300">★</span>
                                            </div>
                                            <p class="text-gray-600 leading-relaxed text-sm">
                                                "Fasilitas ruang gantinya bersih dan nyaman. Parkiran juga tergolong luas untuk mobil. Kekurangannya mungkin kantin kalau malam tutupnya agak kepagian. Selebihnya joss!"
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Sidebar Content -->
                    <aside class="lg:col-span-5 xl:col-span-4 order-1 lg:order-2 space-y-6 sm:space-y-8 pb-10">

                        <!-- Preview Lapangan Card -->
                        <div class="bg-gradient-to-br from-green-500 to-teal-500 p-6 rounded-2xl shadow-xl text-white animate-slide-left" style="animation-delay: 0.5s">
                            <span class="text-xs font-bold tracking-wider uppercase bg-white/20 px-3 py-1 rounded-full inline-block mb-3">Preview Lapangan</span>
                            <h3 class="text-2xl font-bold mb-2">{{ $lapangan->nama_lapangan }} ({{ $lapangan->id_lapangan }})</h3>
                            <p class="text-sm mb-4 leading-relaxed text-green-50">
                                {{ $lapangan->deskripsi ?? 'Court premium untuk sesi after office, sparring kompetitif, atau latihan teknik dengan fasilitas yang nyaman.' }}
                            </p>
                            
                            <div class="grid grid-cols-2 gap-3 text-sm mb-5">
                                <div class="bg-white/10 rounded-lg p-3 backdrop-blur-sm">
                                    <span class="block text-green-100 text-xs mb-1">Tipe Lantai</span>
                                    <span class="font-semibold">{{ $lapangan->jenis_lantai }}</span>
                                </div>
                                <div class="bg-white/10 rounded-lg p-3 backdrop-blur-sm">
                                    <span class="block text-green-100 text-xs mb-1">Harga</span>
                                    <span class="font-semibold">Rp{{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}<span class="text-xs font-normal">/jam</span></span>
                                </div>
                                <div class="bg-white/10 rounded-lg p-3 backdrop-blur-sm">
                                    <span class="block text-green-100 text-xs mb-1">Rating</span>
                                    <span class="font-semibold text-yellow-300">⭐ {{ $lapangan->rating ?? 0 }} <span class="text-xs font-normal text-white">({{ $lapangan->jumlah_ulasan ?? 0 }})</span></span>
                                </div>
                                <div class="bg-white/10 rounded-lg p-3 backdrop-blur-sm">
                                    <span class="block text-green-100 text-xs mb-1">Jam Operasional</span>
                                    <span class="font-semibold">{{ date('H:i', strtotime($lapangan->jam_buka)) }} - {{ date('H:i', strtotime($lapangan->jam_tutup)) }}</span>
                                </div>
                            </div>
                            
                            @if($lapangan->status == 'tersedia')
                            <a href="{{ route('reservasi.create', ['id' => $lapangan->id_lapangan]) }}" class="mt-2 block text-center w-full bg-white text-green-600 font-bold py-3 rounded-xl shadow-lg hover:bg-gray-50 transition-all transform hover:-translate-y-1">
                                Booking Sekarang
                            </a>
                            @else
                            <button disabled class="mt-2 block text-center w-full bg-white/40 text-white font-bold py-3 rounded-xl shadow cursor-not-allowed">
                                Sedang Perbaikan
                            </button>
                            @endif
                        </div>

                        <!-- Fasilitas -->
                        <div class="bg-white rounded-2xl shadow-lg p-6 border border-gray-100 animate-slide-left" style="animation-delay: 0.7s">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 flex items-center gap-2">
                                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                Fasilitas Tersedia
                            </h3>
                            <div class="flex flex-wrap gap-2">
                                @php
                                    $fasilitasArray = $lapangan->fasilitas ? explode(',', $lapangan->fasilitas) : ['Indoor Vinyl','Net Standar','Lampu LED','Area Tunggu','Locker Room','AC'];
                                @endphp
                                @foreach ($fasilitasArray as $facility)
                                <span class="px-3 py-1.5 bg-green-50 border border-green-100 rounded-lg text-sm text-green-700 font-medium">
                                    {{ trim($facility) }}
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