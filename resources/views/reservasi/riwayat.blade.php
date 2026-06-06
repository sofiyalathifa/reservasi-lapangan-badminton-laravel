@extends('layouts.app')

@section('title', 'Pesanan Saya')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24 pb-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Pesanan Saya</h1>
            <p class="text-gray-500">Pantau semua riwayat booking dan status pembayaran Anda di sini.</p>
        </div>

        @if(session('success'))
        <div class="mb-8 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl flex items-center gap-3 shadow-sm">
            <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        @if($reservasis->isEmpty())
            <div class="bg-white rounded-2xl p-12 text-center shadow-sm border border-gray-100">
                <div class="w-24 h-24 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <span class="text-4xl">🏸</span>
                </div>
                <h3 class="text-xl font-bold text-gray-900 mb-2">Belum ada pesanan</h3>
                <p class="text-gray-500 mb-8">Anda belum pernah melakukan booking lapangan. Yuk, mulai main!</p>
                <a href="{{ route('home') }}#lapangan-populer" class="inline-block bg-green-500 text-white font-bold py-3 px-8 rounded-full shadow-lg hover:bg-green-600 hover:-translate-y-1 transition-all duration-200">
                    Cari Lapangan
                </a>
            </div>
        @else
            <div class="space-y-6">
                @foreach($reservasis as $res)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-md transition-shadow border border-gray-100 overflow-hidden flex flex-col sm:flex-row relative">
                    
                    <!-- Indikator Warna Status -->
                    <div class="w-full sm:w-2 
                        @if($res->status_reservasi == 'pending') bg-yellow-400 
                        @elseif($res->status_reservasi == 'dikonfirmasi') bg-green-500 
                        @else bg-red-500 @endif
                    "></div>

                    <!-- Gambar Lapangan -->
                    <div class="w-full sm:w-48 h-48 sm:h-auto shrink-0 relative overflow-hidden bg-gray-100">
                        @php
                            $fotoArray = $res->lapangan->foto ? explode(',', $res->lapangan->foto) : ['lap1.jpeg'];
                            $fotoUtama = trim($fotoArray[0]);
                        @endphp
                        <img src="{{ asset('images/' . $fotoUtama) }}" alt="{{ $res->lapangan->nama_lapangan }}" class="w-full h-full object-cover">
                    </div>

                    <!-- Konten -->
                    <div class="p-6 flex-1 flex flex-col justify-between">
                        <div>
                            <div class="flex flex-col md:flex-row md:items-start justify-between gap-4 mb-2">
                                <div>
                                    <h3 class="text-xl font-bold text-gray-900">{{ $res->lapangan->nama_lapangan }}</h3>
                                    <p class="text-sm text-gray-500 font-mono mt-1">Order ID: {{ $res->id_reservasi }}</p>
                                </div>
                                
                                <!-- Badge Status -->
                                <div>
                                    @if($res->status_reservasi == 'pending')
                                        @if($res->pembayaran)
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800 border border-blue-200">
                                                <svg class="w-3.5 h-3.5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"></path></svg>
                                                Menunggu Konfirmasi
                                            </span>
                                        @else
                                            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800 border border-yellow-200">
                                                <span class="w-1.5 h-1.5 rounded-full bg-yellow-500 animate-pulse"></span>
                                                Menunggu Pembayaran
                                            </span>
                                        @endif
                                    @elseif($res->status_reservasi == 'dikonfirmasi')
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800 border border-green-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                            Lunas / Dikonfirmasi
                                        </span>
                                    @else
                                        <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800 border border-red-200">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                            Dibatalkan
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mt-6">
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100">
                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Jadwal Main</p>
                                    <p class="font-semibold text-gray-900">
                                        {{ \Carbon\Carbon::parse($res->tanggal_booking)->translatedFormat('l, d F Y') }}
                                    </p>
                                    <p class="text-green-600 font-bold mt-1">
                                        {{ date('H:i', strtotime($res->jam_mulai)) }} - {{ date('H:i', strtotime($res->jam_selesai)) }} WIB ({{ $res->durasi }} Jam)
                                    </p>
                                </div>
                                <div class="bg-gray-50 p-4 rounded-xl border border-gray-100 flex flex-col justify-center">
                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider mb-1">Total Biaya</p>
                                    <p class="text-2xl font-black text-gray-900 tracking-tight">Rp {{ number_format($res->total_biaya, 0, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Action Button -->
                        @if($res->status_reservasi == 'pending')
                            <div class="mt-6 pt-6 border-t border-gray-100 flex justify-end items-center">
                                @if($res->pembayaran)
                                    <div class="text-sm font-medium text-blue-600 flex items-center gap-2 bg-blue-50 px-4 py-2 rounded-lg">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path></svg>
                                        Bukti bayar telah diunggah. Menunggu verifikasi admin.
                                    </div>
                                @else
                                    <a href="{{ route('pembayaran.create', $res->id_reservasi) }}" class="inline-flex items-center gap-2 bg-gray-900 text-white font-bold py-2.5 px-6 rounded-lg shadow-md hover:bg-black hover:-translate-y-0.5 transition-all duration-200">
                                        Lanjutkan Pembayaran
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"></path></svg>
                                    </a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
