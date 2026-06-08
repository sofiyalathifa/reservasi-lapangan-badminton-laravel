@extends ('layouts.sidebar')

@section('content')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out lg:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <!-- Card 1: Pendapatan Hari Ini -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 lg:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Pendapatan Hari Ini</p>
                                <h5 class="mb-1 font-bold text-gray-800 text-xl">Rp 2.500.000</h5>
                                <p class="mb-0 text-sm text-green-500 font-semibold">+12% <span class="font-normal text-gray-500">dibanding kemarin</span></p>
                            </div>
                            <div class="flex-none">
                                <div class="inline-flex items-center justify-center w-12 h-12 text-center rounded-xl bg-gradient-to-tl from-blue-500 to-violet-500 shadow-md">
                                    <i class="ni ni-money-coins text-white text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Booking Hari Ini -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 lg:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Booking Hari Ini</p>
                                <h5 class="mb-1 font-bold text-gray-800 text-xl">35 Slot</h5>
                                <p class="mb-0 text-sm text-green-500 font-semibold">+8% <span class="font-normal text-gray-500">dibanding kemarin</span></p>
                            </div>
                            <div class="flex-none">
                                <div class="inline-flex items-center justify-center w-12 h-12 text-center rounded-xl bg-gradient-to-tl from-red-600 to-orange-600 shadow-md">
                                    <i class="ni ni-calendar-grid-58 text-white text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Lapangan Terpakai -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 lg:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Lapangan Terpakai</p>
                                <h5 class="mb-1 font-bold text-gray-800 text-xl">70%</h5>
                                <p class="mb-0 text-sm text-gray-500">Slot terpakai hari ini</p>
                            </div>
                            <div class="flex-none">
                                <div class="inline-flex items-center justify-center w-12 h-12 text-center rounded-xl bg-gradient-to-tl from-emerald-500 to-teal-400 shadow-md">
                                    <i class="ni ni-app text-white text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Total Transaksi Bulanan -->
            <div class="w-full max-w-full px-3 sm:w-1/2 lg:w-1/4 mb-6">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500" style="font-size: 0.75rem;">Total Transaksi Bulanan</p>
                                <h5 class="mb-1 font-bold text-gray-800 text-xl">Rp 20.000.000</h5>
                                <p class="mb-0 text-sm text-green-500 font-semibold">+15% <span class="font-normal text-gray-500">dibulan lalu</span></p>
                            </div>
                            <div class="flex-none">
                                <div class="inline-flex items-center justify-center w-12 h-12 text-center rounded-xl bg-gradient-to-tl from-orange-500 to-yellow-500 shadow-md">
                                    <i class="ni ni-cart text-white text-lg"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
                <div class="border-black/12.5 dark:bg-slate-800 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                        <h6 class="capitalize dark:text-white">Pendapatan Perbulan</h6>
                        <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                            <i class="fa fa-arrow-up text-emerald-500"></i>
                            <span class="font-semibold text-emerald-500">+15%</span> dibanding bulan lalu
                        </p>
                    </div>
                    <div class="flex-auto p-4">
                        <canvas id="monthlyRevenueChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- CDN Chart.js -->
            <script>
                // ctxMonthly didefinisikan
                const ctxMonthly = document.getElementById('monthlyRevenueChart').getContext('2d');

                const monthlyRevenueChart = new Chart(ctxMonthly, {
                    type: 'line',
                    data: {
                        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'],
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: [5000000, 7000000, 6000000, 8000000, 7000000, 9000000, 8000000, 9500000, 8500000, 9000000, 9200000, 10000000], // kelipatan 1 juta
                            borderColor: '#22c55e',
                            backgroundColor: 'rgba(34,197,94,0.2)',
                            fill: true,
                            tension: 0.4,
                            pointBackgroundColor: '#22c55e',
                            pointRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    callback: function(value) {
                                        return 'Rp ' + (value / 1000000).toLocaleString() + ' jt';
                                    },
                                    stepSize: 1000000
                                }
                            }
                        }
                    }
                });
            </script>

            <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                <div class="border-black/12.5 dark:bg-slate-800 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border p-6">
                    <h6 class="capitalize dark:text-white mb-4">Lapangan Terbanyak Dibooking</h6>
                    <canvas id="bookingBarChart" height="300"></canvas>
                </div>
            </div>

            <script>
                const ctxBar = document.getElementById('bookingBarChart').getContext('2d');

                const lapanganLabels = ['Lapangan 1', 'Lapangan 2', 'Lapangan 3', 'Lapangan 4']; // ganti sesuai lapangan
                const bookingData = [35, 50, 25, 40]; // jumlah booking per lapangan

                const bookingBarChart = new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: lapanganLabels,
                        datasets: [{
                            label: 'Jumlah Booking',
                            data: bookingData,
                            backgroundColor: ['#22c55e', '#16a34a', '#4ade80', '#86efac'],
                            borderRadius: 5
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                display: false
                            },
                            tooltip: {
                                mode: 'index',
                                intersect: false
                            }
                        },
                        scales: {
                            y: {
                                beginAtZero: true,
                                ticks: {
                                    stepSize: 10
                                }
                            }
                        }
                    }
                });
            </script>
        </div>
    </div>
</main>
@endsection