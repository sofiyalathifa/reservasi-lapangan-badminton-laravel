@extends ('layouts.sidebar')

@section('content')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out lg:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-800">
                Laporan Reservasi Badminton Hall
            </h1>

            <p class="text-slate-500 mt-2">
                Ringkasan reservasi, pemasukan, performa lapangan dan pelanggan aktif.
            </p>
        </div>

        <!-- Filter -->
        <div class="bg-white rounded-xl shadow p-5 mb-6">

            <div class="grid md:grid-cols-3 gap-4">

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Laporan Harian
                    </label>

                    <input
                        type="date"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <div>
                    <label class="block text-sm font-medium mb-2">
                        Laporan Bulanan
                    </label>

                    <input
                        type="month"
                        class="w-full border rounded-lg px-4 py-2">
                </div>

                <div class="flex items-end gap-2 print:hidden">
                    <a
                        href="{{ route('admin.laporan.export') }}"
                        class="bg-green-600 text-white px-5 py-2 rounded-lg inline-flex items-center justify-center">
                        Export CSV
                    </a>

                    <button
                        type="button"
                        onclick="window.print()"
                        class="bg-slate-800 text-white px-5 py-2 rounded-lg inline-flex items-center justify-center">
                        Print
                    </button>
                </div>

            </div>

        </div>

        <!-- Statistik -->
        <div class="grid md:grid-cols-4 gap-4 mb-6">

            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-slate-500 text-sm">
                    Reservasi Hari Ini
                </p>

                <h2 class="text-3xl font-bold mt-2">
                    {{ $reservasiHariIni }}
                </h2>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-slate-500 text-sm">
                    Pemasukan Hari Ini
                </p>

                <h2 class="text-3xl font-bold mt-2">
                    Rp{{ number_format($pemasukanHariIni,0,',','.') }}
                </h2>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-slate-500 text-sm">
                    Reservasi Bulan Ini
                </p>

                <h2 class="text-3xl font-bold mt-2">
                    {{ $reservasiBulanIni }}
                </h2>
            </div>

            <div class="bg-white p-5 rounded-xl shadow">
                <p class="text-slate-500 text-sm">
                    Pemasukan Bulan Ini
                </p>

                <h2 class="text-3xl font-bold mt-2">
                    Rp{{ number_format($pemasukanBulanIni,0,',','.') }}
                </h2>
            </div>

        </div>

        <!-- Top Section -->
        <div class="grid md:grid-cols-2 gap-6 mb-6">

            <div class="bg-white rounded-xl shadow p-5">

                <h3 class="font-bold text-lg mb-4">
                    Lapangan Favorit
                </h3>

                <p class="text-2xl font-bold">
                    {{ $lapanganFavorit->nama_lapangan ?? '-' }}
                </p>

                <p class="text-slate-500">
                    {{ $jumlahBookingLapangan }} booking
                </p>

            </div>

            <div class="bg-white rounded-xl shadow p-5">

                <h3 class="font-bold text-lg mb-4">
                    Pelanggan Paling Aktif
                </h3>

                <p class="text-2xl font-bold">
                    {{ $pelangganAktif->nama_lengkap ?? '-' }}
                </p>

                <p class="text-slate-500">
                    {{ $jumlahBookingPelanggan }} booking
                </p>

            </div>

        </div>

        <!-- Tabel -->
        <div class="bg-white rounded-xl shadow p-5">

            <h3 class="font-bold text-lg mb-4">
                Reservasi Bulanan
            </h3>

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

    <div class="bg-white p-5 rounded-xl shadow">
        <h3 class="font-bold mb-4">
            Reservasi per Hari
        </h3>
        <canvas id="chartReservasi" class="h-80 w-full"></canvas>
    </div>

    <div class="bg-white p-5 rounded-xl shadow">
        <h3 class="font-bold mb-4">
            Lapangan Terfavorit
        </h3>
        <canvas id="chartLapangan" class="h-80 w-full"></canvas>
    </div>

</div>

<div class="bg-white p-5 rounded-xl shadow mt-6 max-w-xl mx-auto">
    <h3 class="font-bold mb-4">
        Status Reservasi
    </h3>
    <canvas id="chartStatus" class="h-80 w-full"></canvas>
</div>

            <div class="overflow-x-auto">

                <table class="w-full">

                    <thead>

                        <tr class="border-b">

                            <th class="text-left py-3">
                                Tanggal
                            </th>

                            <th class="text-left py-3">
                                Total Booking
                            </th>

                            <th class="text-left py-3">
                                Total Nilai
                            </th>

                        </tr>

                    </thead>

                    <tbody>

                        @foreach($laporanBulanan as $laporan)

                        <tr class="border-b">

                            <td class="py-3">
                                {{ $laporan->tanggal_booking }}
                            </td>

                            <td class="py-3">
                                {{ $laporan->total_booking }}
                            </td>

                            <td class="py-3">
                                Rp{{ number_format($laporan->total_nilai,0,',','.') }}
                            </td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>

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
