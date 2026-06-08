@extends ('layouts.sidebar')

@section('content')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out lg:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">        <!-- Header -->
        <div class="mb-8 flex flex-col md:flex-row justify-between items-start md:items-center">
            <div>
                <h1 class="text-3xl font-bold text-slate-800 tracking-tight">Laporan & Analitik</h1>
                <p class="text-slate-500 mt-1 text-sm">Pantau ringkasan reservasi, pendapatan, dan performa lapangan secara real-time.</p>
            </div>
            
            <div class="mt-4 md:mt-0 flex gap-3 print:hidden">
                <a href="{{ route('admin.laporan.export') }}" class="inline-flex items-center gap-2 bg-gradient-to-tl from-emerald-500 to-teal-400 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Export CSV
                </a>
                <button onclick="window.print()" class="inline-flex items-center gap-2 bg-gradient-to-tl from-slate-800 to-slate-700 text-white font-semibold px-5 py-2.5 rounded-xl shadow-md hover:shadow-lg hover:-translate-y-0.5 transition-all duration-200">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 17h2a2 2 0 002-2v-4a2 2 0 00-2-2H5a2 2 0 00-2 2v4a2 2 0 002 2h2m2 4h6a2 2 0 002-2v-4a2 2 0 00-2-2H9a2 2 0 00-2 2v4a2 2 0 002 2zm8-12V5a2 2 0 00-2-2H9a2 2 0 00-2 2v4h10z"></path></svg>
                    Print
                </button>
            </div>
        </div>

        <!-- Statistik Utama -->
        <div class="flex flex-wrap -mx-3 mb-6">
            <!-- Card 1 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 lg:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Reservasi Hari Ini</p>
                                <h5 class="mb-0 font-bold text-gray-800 text-2xl">{{ $reservasiHariIni }} <span class="text-sm font-medium text-gray-500">trx</span></h5>
                            </div>
                            <div class="flex-none">
                                <div class="inline-flex items-center justify-center w-12 h-12 text-center rounded-xl bg-gradient-to-tl from-blue-500 to-violet-500 shadow-md">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 lg:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Pemasukan Hari Ini</p>
                                <h5 class="mb-0 font-bold text-gray-800 text-xl">Rp{{ number_format($pemasukanHariIni,0,',','.') }}</h5>
                            </div>
                            <div class="flex-none">
                                <div class="inline-flex items-center justify-center w-12 h-12 text-center rounded-xl bg-gradient-to-tl from-emerald-500 to-teal-400 shadow-md">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 lg:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Reservasi Bulan Ini</p>
                                <h5 class="mb-0 font-bold text-gray-800 text-2xl">{{ $reservasiBulanIni }} <span class="text-sm font-medium text-gray-500">trx</span></h5>
                            </div>
                            <div class="flex-none">
                                <div class="inline-flex items-center justify-center w-12 h-12 text-center rounded-xl bg-gradient-to-tl from-orange-500 to-yellow-400 shadow-md">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 lg:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Pemasukan Bulan Ini</p>
                                <h5 class="mb-0 font-bold text-gray-800 text-xl">Rp{{ number_format($pemasukanBulanIni,0,',','.') }}</h5>
                            </div>
                            <div class="flex-none">
                                <div class="inline-flex items-center justify-center w-12 h-12 text-center rounded-xl bg-gradient-to-tl from-red-600 to-rose-400 shadow-md">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"></path></svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Highlight & Analitik -->
        <div class="flex flex-wrap -mx-3 mb-6">
            <!-- Lapangan Favorit -->
            <div class="w-full max-w-full px-3 lg:w-6/12 mb-6 lg:mb-0">
                <div class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-6">
                        <div class="flex items-center mb-4">
                            <div class="inline-flex items-center justify-center w-10 h-10 mr-4 text-center rounded-lg bg-gradient-to-tl from-indigo-500 to-blue-400 shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m3-4h1m-1 4h1m-5 8h8"></path></svg>
                            </div>
                            <div>
                                <h6 class="mb-0 text-lg font-bold text-slate-700">Lapangan Favorit</h6>
                                <p class="mb-0 text-sm leading-normal text-slate-500">Paling sering dibooking</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-3xl font-bold text-slate-800">{{ $lapanganFavorit->nama_lapangan ?? '-' }}</h3>
                            <p class="text-emerald-500 font-semibold mt-1">
                                <i class="mr-1 text-lg">🔥</i> {{ $jumlahBookingLapangan }} Total Booking
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pelanggan Aktif -->
            <div class="w-full max-w-full px-3 lg:w-6/12">
                <div class="relative flex flex-col h-full min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-6">
                        <div class="flex items-center mb-4">
                            <div class="inline-flex items-center justify-center w-10 h-10 mr-4 text-center rounded-lg bg-gradient-to-tl from-pink-500 to-rose-400 shadow-md">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            </div>
                            <div>
                                <h6 class="mb-0 text-lg font-bold text-slate-700">Pelanggan Teraktif</h6>
                                <p class="mb-0 text-sm leading-normal text-slate-500">Paling rajin bermain</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-3xl font-bold text-slate-800">{{ $pelangganAktif->nama_lengkap ?? '-' }}</h3>
                            <p class="text-emerald-500 font-semibold mt-1">
                                <i class="mr-1 text-lg">🌟</i> {{ $jumlahBookingPelanggan }} Total Booking
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 1 -->
        <div class="flex flex-wrap -mx-3 mt-6">
            <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none mb-6 lg:mb-0">
                <div class="border-black/12.5 shadow-xl relative z-20 flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        <h6 class="capitalize font-bold text-slate-700">Grafik Reservasi per Hari</h6>
                        <p class="mb-0 text-sm leading-normal text-slate-500">Intensitas booking harian</p>
                    </div>
                    <div class="flex-auto p-6">
                        <div class="relative h-72">
                            <canvas id="chartReservasi" class="h-full w-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="w-full max-w-full px-3 mt-0 lg:w-5/12 lg:flex-none">
                <div class="border-black/12.5 shadow-xl relative z-20 flex h-full min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        <h6 class="capitalize font-bold text-slate-700">Status Reservasi</h6>
                        <p class="mb-0 text-sm leading-normal text-slate-500">Persentase status booking</p>
                    </div>
                    <div class="flex-auto p-6">
                        <div class="relative h-72 flex justify-center pb-4">
                            <canvas id="chartStatus" class="h-full w-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts Row 2 -->
        <div class="flex flex-wrap -mx-3 mt-6 mb-6">
            <div class="w-full max-w-full px-3 mt-0">
                <div class="border-black/12.5 shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pb-0">
                        <h6 class="capitalize font-bold text-slate-700">Tingkat Penggunaan Lapangan</h6>
                        <p class="mb-0 text-sm leading-normal text-slate-500">Distribusi booking per lapangan</p>
                    </div>
                    <div class="flex-auto p-6">
                        <div class="relative h-80">
                            <canvas id="chartLapangan" class="h-full w-full"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table -->
        <div class="flex flex-wrap -mx-3 mt-6">
            <div class="w-full max-w-full px-3 mt-0">
                <div class="border-black/12.5 shadow-xl relative flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-black/12.5 rounded-t-2xl">
                        <h6 class="font-bold text-slate-700">Data Rekapitulasi Harian</h6>
                    </div>
                    <div class="flex-auto p-6 px-0 pb-2">
                        <div class="overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead>
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-wide text-slate-400 opacity-70">Tanggal</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-wide text-slate-400 opacity-70">Total Booking</th>
                                        <th class="px-6 py-3 font-bold text-right uppercase align-middle bg-transparent border-b border-gray-200 shadow-none text-xs border-b-solid tracking-wide text-slate-400 opacity-70">Total Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($laporanBulanan as $laporan)
                                    <tr class="hover:bg-slate-50 transition-colors">
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-4 py-2">
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm font-semibold text-slate-700">{{ \Carbon\Carbon::parse($laporan->tanggal_booking)->translatedFormat('d F Y') }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-sm font-semibold leading-normal text-center text-slate-600">{{ $laporan->total_booking }} trx</p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-sm font-bold leading-normal text-right pr-4 text-emerald-500">Rp{{ number_format($laporan->total_nilai,0,',','.') }}</p>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const reservasiPerHari = @json($reservasiPerHari);
        const lapanganChart = @json($lapanganChart);
        const statusReservasi = @json($statusReservasi);

        const reservasiData = reservasiPerHari.map(i => i.total);
        const reservasiColors = reservasiData.map((value, index) => {
            if (index === 0) return '#16a34a';
            return value >= reservasiData[index - 1] ? '#16a34a' : '#dc2626';
        });

        new Chart(
            document.getElementById('chartReservasi'),
            {
                type: 'line',
                data: {
                    labels: reservasiPerHari.map(i => i.tanggal_booking),
                    datasets: [{
                        label: 'Jumlah Reservasi',
                        data: reservasiData,
                        borderColor: '#16a34a',
                        backgroundColor: 'rgba(22, 163, 74, 0.12)',
                        pointBackgroundColor: reservasiColors,
                        pointBorderColor: '#ffffff',
                        pointRadius: 5,
                        pointHoverRadius: 7,
                        tension: 0.3,
                        segment: {
                            borderColor: ctx => ctx.p0.parsed.y <= ctx.p1.parsed.y ? '#16a34a' : '#dc2626'
                        }
                    }]
                },
                options: {
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                },
                devicePixelRatio: window.devicePixelRatio || 2
            }
        );

        const barColors = [
            '#2563eb',
            '#14b8a6',
            '#f59e0b',
            '#8b5cf6',
            '#ec4899',
            '#10b981',
            '#ef4444',
            '#0ea5e9'
        ];

        new Chart(
            document.getElementById('chartLapangan'),
            {
                type: 'bar',
                data: {
                    labels: lapanganChart.map(i => i.nama_lapangan),
                    datasets: [{
                        label: 'Total Booking',
                        data: lapanganChart.map(i => i.total),
                        backgroundColor: lapanganChart.map((_, index) => barColors[index % barColors.length]),
                        borderColor: '#0f172a',
                        borderWidth: 1
                    }]
                },
                options: {
                    plugins: {
                        legend: { display: false }
                    },
                    scales: {
                        y: { beginAtZero: true }
                    }
                },
                devicePixelRatio: window.devicePixelRatio || 2
            }
        );

        new Chart(
            document.getElementById('chartStatus'),
            {
                type: 'pie',
                data: {
                    labels: statusReservasi.map(i => i.status_reservasi),
                    datasets: [{
                        data: statusReservasi.map(i => i.total),
                        backgroundColor: ['#3b82f6', '#f97316', '#10b981', '#ef4444', '#8b5cf6']
                    }]
                },
                options: {
                    plugins: {
                        legend: {
                            position: 'bottom'
                        }
                    }
                },
                devicePixelRatio: window.devicePixelRatio || 2
            }
        );
    </script>
    </div>
</main>
@endsection
