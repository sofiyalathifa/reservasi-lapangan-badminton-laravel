@extends('layouts.app')

@section('title', 'Booking Lapangan')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24 pb-12">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 animate-fade-in-up">
        
        <!-- Header -->
        <div class="mb-8 flex items-center gap-4">
            <a href="{{ route('lapangan.detail', ['id' => $id]) }}" class="p-2 bg-white rounded-full shadow-sm hover:bg-gray-100 transition-colors text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <div>
                <h1 class="text-2xl font-bold text-gray-900">Reservasi Lapangan</h1>
                <p class="text-sm text-gray-500">Lengkapi detail pemesanan di bawah ini.</p>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Booking Form -->
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6 sm:p-8">
                    <h2 class="text-lg font-semibold text-gray-800 mb-6 border-b border-gray-100 pb-4">Detail Jadwal Main</h2>
                    
                    <form action="{{ route('reservasi.store', ['id' => $id]) }}" method="POST" id="bookingForm">
                        @csrf
                        
                        @php
                            $dates = [];
                            $hariIndo = ['Sun' => 'Min', 'Mon' => 'Sen', 'Tue' => 'Sel', 'Wed' => 'Rab', 'Thu' => 'Kam', 'Fri' => 'Jum', 'Sat' => 'Sab'];
                            for($i = 0; $i < 7; $i++) {
                                $dateStr = strtotime("+$i days");
                                $dates[] = [
                                    'value' => date('Y-m-d', $dateStr),
                                    'day' => $hariIndo[date('D', $dateStr)],
                                    'date' => date('d', $dateStr)
                                ];
                            }
                            $times = ['08:00', '09:00', '10:00', '13:00', '14:00', '15:00', '16:00', '19:00', '20:00', '21:00'];
                        @endphp

                        <div class="space-y-8">
                            
                            <!-- Tanggal (Cinema Style) -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-3">Pilih Tanggal</label>
                                <div class="flex gap-3 overflow-x-auto pb-2 scrollbar-hide">
                                    @foreach($dates as $index => $d)
                                    <div onclick="selectDate(this)" data-value="{{ $d['value'] }}"
                                         class="date-card cursor-pointer flex-shrink-0 w-16 h-20 rounded-2xl border-2 transition-all flex flex-col items-center justify-center
                                         {{ $index === 0 ? 'border-green-500 bg-green-50 shadow-sm' : 'border-gray-200 bg-white hover:border-green-300' }}">
                                        <span class="text-xs font-semibold {{ $index === 0 ? 'text-green-600' : 'text-gray-500' }} uppercase">{{ $d['day'] }}</span>
                                        <span class="text-xl font-bold {{ $index === 0 ? 'text-green-700' : 'text-gray-800' }}">{{ $d['date'] }}</span>
                                    </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="tanggal" id="selectedDate" value="{{ $dates[0]['value'] }}">
                            </div>

                            <!-- Waktu Mulai (Cinema Style) -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-3">Pilih Waktu</label>
                                <div class="grid grid-cols-3 sm:grid-cols-5 gap-3">
                                    @foreach($times as $time)
                                    <div onclick="selectTime(this)" data-value="{{ $time }}"
                                         class="time-card cursor-pointer rounded-xl border-2 border-gray-200 bg-white py-2 text-center font-bold text-gray-700 hover:border-green-400 hover:text-green-600 transition-all">
                                        {{ $time }}
                                    </div>
                                    @endforeach
                                </div>
                                <input type="hidden" name="jam_mulai" id="selectedTime" value="" required>
                            </div>

                            <!-- Durasi & Catatan -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 pt-4 border-t border-gray-100">
                                <!-- Durasi -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">Durasi Main</label>
                                    <div class="relative">
                                        <select name="durasi" id="durasiSelect" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-gray-50 hover:bg-white appearance-none font-medium text-gray-700" required onchange="updateTotal()">
                                            <option value="1" selected>1 Jam</option>
                                            <option value="2">2 Jam</option>
                                            <option value="3">3 Jam</option>
                                            <option value="4">4 Jam</option>
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                        </div>
                                    </div>
                                </div>

                                <!-- Catatan -->
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">Catatan Tambahan</label>
                                    <textarea name="catatan" rows="1" placeholder="Cth: Sewa 2 sepatu..." class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-gray-50 hover:bg-white font-medium text-gray-700"></textarea>
                                </div>
                            </div>

                        </div>
                    </form>
                </div>
            </div>

            <!-- Summary Card -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 overflow-hidden sticky top-28">
                    <!-- Header Card -->
                    <div class="bg-gradient-to-br from-green-500 to-teal-600 p-6 text-white relative overflow-hidden">
                        <!-- Dekorasi -->
                        <div class="absolute top-0 right-0 -mr-8 -mt-8 w-32 h-32 rounded-full bg-white opacity-10"></div>
                        <div class="absolute bottom-0 left-0 -ml-8 -mb-8 w-24 h-24 rounded-full bg-black opacity-10"></div>
                        
                        <div class="relative z-10">
                            <span class="text-xs font-semibold bg-white/20 backdrop-blur-sm px-3 py-1 rounded-full uppercase tracking-wider mb-4 inline-block shadow-sm">Ringkasan</span>
                            <h3 class="text-xl font-bold leading-tight mb-1">{{ $lapangan->nama_lapangan }}</h3>
                            <p class="text-green-100 text-sm flex items-center gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                Rungkut, Surabaya
                            </p>
                        </div>
                    </div>
                    
                    <!-- Rincian -->
                    <div class="p-6 space-y-5">
                        <div class="flex justify-between text-sm items-center">
                            <span class="text-gray-500">Harga Lapangan</span>
                            <span class="font-semibold text-gray-900" id="hargaPerJam" data-harga="{{ $lapangan->harga_per_jam }}">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }} / jam</span>
                        </div>
                        <div class="flex justify-between text-sm items-center">
                            <span class="text-gray-500">Total Durasi</span>
                            <span class="font-semibold text-gray-900"><span id="displayDurasi">1</span> Jam</span>
                        </div>
                        <div class="flex justify-between text-sm items-center pb-5 border-b border-gray-100">
                            <span class="text-gray-500 flex items-center gap-1">
                                Biaya Layanan
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </span>
                            <span class="font-bold text-green-500">Gratis</span>
                        </div>
                        
                        <!-- Total -->
                        <div class="flex justify-between items-end pt-2">
                            <div>
                                <span class="block text-sm text-gray-500 mb-1">Total Pembayaran</span>
                                <span class="text-2xl font-black text-teal-600 tracking-tight" id="totalHarga">Rp {{ number_format($lapangan->harga_per_jam, 0, ',', '.') }}</span>
                            </div>
                        </div>

                        <!-- Button Submit (Triggers form) -->
                        <button type="button" onclick="document.getElementById('bookingForm').submit()" class="mt-6 w-full bg-gray-900 text-white font-bold py-3.5 px-4 rounded-xl shadow-lg hover:shadow-xl hover:bg-black transform hover:-translate-y-1 transition-all duration-200 flex justify-center items-center gap-2">
                            Konfirmasi Booking
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                        
                        <!-- Trust Badge -->
                        <div class="bg-green-50 rounded-lg p-3 mt-4 flex items-center justify-center gap-2 text-green-700 text-xs font-medium">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Transaksi Aman & Terverifikasi
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>

<script>
    function selectDate(element) {
        // Update hidden input
        const dateValue = element.getAttribute('data-value');
        document.getElementById('selectedDate').value = dateValue;
        
        // Reset all cards
        document.querySelectorAll('.date-card').forEach(card => {
            card.className = "date-card cursor-pointer flex-shrink-0 w-16 h-20 rounded-2xl border-2 transition-all flex flex-col items-center justify-center border-gray-200 bg-white hover:border-green-300";
            card.children[0].className = "text-xs font-semibold text-gray-500 uppercase";
            card.children[1].className = "text-xl font-bold text-gray-800";
        });

        // Set active card
        element.className = "date-card cursor-pointer flex-shrink-0 w-16 h-20 rounded-2xl border-2 transition-all flex flex-col items-center justify-center border-green-500 bg-green-50 shadow-sm";
        element.children[0].className = "text-xs font-semibold text-green-600 uppercase";
        element.children[1].className = "text-xl font-bold text-green-700";
    }

    function selectTime(element) {
        // Update hidden input
        const timeValue = element.getAttribute('data-value');
        document.getElementById('selectedTime').value = timeValue;

        // Reset all time cards
        document.querySelectorAll('.time-card').forEach(card => {
            card.className = "time-card cursor-pointer rounded-xl border-2 border-gray-200 bg-white py-2 text-center font-bold text-gray-700 hover:border-green-400 hover:text-green-600 transition-all";
        });

        // Set active time card
        element.className = "time-card cursor-pointer rounded-xl border-2 border-green-500 bg-green-500 py-2 text-center font-bold text-white shadow-md transform scale-105 transition-all";
    }

    function updateTotal() {
        const durasi = document.getElementById('durasiSelect').value;
        const hargaElement = document.getElementById('hargaPerJam');
        const harga = parseInt(hargaElement.getAttribute('data-harga'));
        
        const total = durasi * harga;
        
        // Update display
        document.getElementById('displayDurasi').innerText = durasi;
        // Format to Rupiah
        document.getElementById('totalHarga').innerText = 'Rp ' + total.toLocaleString('id-ID');
    }
</script>
@endsection
