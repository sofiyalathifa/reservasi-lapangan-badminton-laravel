@extends ('layouts.sidebar')

@section('content')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out xl:ml-68 rounded-xl">


    <!-- cards -->
    <div class="w-full px-6 py-6 mx-auto">
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">

            <!-- Card 1: Pendapatan Hari Ini -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Pendapatan Hari Ini</p>
                                <h5 class="mb-2 font-bold text-gray-800">Rp 2.500.000</h5>
                                <p class="mb-0 text-sm text-green-500">+12% dibanding kemarin</p>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-blue-500 to-violet-500">
                                    <i class="ni ni-money-coins text-white text-lg relative top-3.5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 2: Booking Hari Ini -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Booking Hari Ini</p>
                                <h5 class="mb-2 font-bold text-gray-800">35 Slot</h5>
                                <p class="mb-0 text-sm text-green-500">+8% dibanding kemarin</p>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-red-600 to-orange-600">
                                    <i class="ni ni-calendar-grid-58 text-white text-lg relative top-3.5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 3: Lapangan Terpakai -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Lapangan Terpakai</p>
                                <h5 class="mb-2 font-bold text-gray-800">70%</h5>
                                <p class="mb-0 text-sm text-green-500">Slot terpakai hari ini</p>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-emerald-500 to-teal-400">
                                    <i class="ni ni-app text-white text-lg relative top-3.5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Card 4: Total Transaksi Bulanan -->
            <div class="w-full max-w-full px-3 sm:w-1/2 xl:w-1/4">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row -mx-3">
                            <div class="flex-none w-2/3 max-w-full px-3">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Total Transaksi Bulanan</p>
                                <h5 class="mb-2 font-bold text-gray-800">Rp 20.000.000</h5>
                                <p class="mb-0 text-sm text-green-500">+15% dibanding bulan lalu</p>
                            </div>
                            <div class="px-3 text-right basis-1/3">
                                <div class="inline-block w-12 h-12 text-center rounded-circle bg-gradient-to-tl from-orange-500 to-yellow-500">
                                    <i class="ni ni-cart text-white text-lg relative top-3.5"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- cards row 2 -->
        <div class="flex flex-wrap mt-6 -mx-3">
            <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
                <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                        <h6 class="capitalize dark:text-white">Pendapatan Perminggu</h6>
                        <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                            <i class="fa fa-arrow-up text-emerald-500"></i>
                            <span class="font-semibold">+12%</span> dibanding minggu lalu
                        </p>
                    </div>
                    <div class="flex-auto p-4">
                        <canvas id="weeklyRevenueChart" height="300"></canvas>
                    </div>
                </div>
            </div>

            <!-- CDN Chart.js -->
            <script>
                const ctx = document.getElementById('weeklyRevenueChart').getContext('2d');

                const weeklyRevenueChart = new Chart(ctx, {
                    type: 'line',
                    data: {
                        labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
                        datasets: [{
                            label: 'Pendapatan (Rp)',
                            data: [500000, 700000, 600000, 800000, 750000, 900000, 650000], // dummy data
                            borderColor: '#22c55e', // garis hijau
                            backgroundColor: 'rgba(34,197,94,0.2)', // gradient fill
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
                                        return 'Rp ' + value.toLocaleString();
                                    }
                                }
                            }
                        }
                    }
                });
            </script>

            <div class="w-full max-w-full px-3 lg:w-5/12 lg:flex-none">
                <div id="carousel" class="relative w-full max-w-3xl mx-auto mt-6">
                    <!-- Slide container -->
                    <div id="slides">
                        <!-- Lapangan slides akan di-generate lewat JS -->
                    </div>
                </div>

                <script>
                    // Dummy data sementara
                    const lapanganData = [{
                            id: 1,
                            slots: [{
                                    jam: "07:00",
                                    status: "available"
                                },
                                {
                                    jam: "08:00",
                                    status: "booked"
                                },
                                {
                                    jam: "09:00",
                                    status: "available"
                                },
                                {
                                    jam: "10:00",
                                    status: "available"
                                },
                            ]
                        },
                        {
                            id: 2,
                            slots: [{
                                    jam: "07:00",
                                    status: "booked"
                                },
                                {
                                    jam: "08:00",
                                    status: "available"
                                },
                                {
                                    jam: "09:00",
                                    status: "available"
                                },
                                {
                                    jam: "10:00",
                                    status: "booked"
                                },
                            ]
                        },
                        {
                            id: 3,
                            slots: [{
                                    jam: "07:00",
                                    status: "available"
                                },
                                {
                                    jam: "08:00",
                                    status: "booked"
                                },
                                {
                                    jam: "09:00",
                                    status: "available"
                                },
                                {
                                    jam: "10:00",
                                    status: "available"
                                },
                            ]
                        }
                    ];

                    // Generate slides
                    const slidesContainer = document.getElementById('slides');

                    lapanganData.forEach((lapangan, index) => {
                        const slide = document.createElement('div');
                        slide.className = index === 0 ? 'slide' : 'slide hidden'; // slide pertama visible, lainnya hidden
                        slide.innerHTML = `
                                <div class="bg-white rounded-2xl shadow-xl p-6 h-[300px] flex flex-col justify-start">
                                    <h4 class="font-semibold mb-4 text-lg">Lapangan ${lapangan.id}</h4>
                                    <div class="flex flex-wrap gap-2 overflow-auto">
                                    ${lapangan.slots.map(slot => `
                                        <button class="px-3 py-1 rounded-full ${slot.status === 'booked' ? 'bg-green-500 text-white cursor-not-allowed' : 'bg-white shadow-md hover:bg-gray-100 text-slate-700'}" ${slot.status === 'booked' ? 'disabled' : ''}>${slot.jam}</button>
                                    `).join('')}
                                    </div>
                                </div>
                            `;
                        slidesContainer.appendChild(slide);
                    });

                    // Auto-slide
                    const slides = document.querySelectorAll('.slide');
                    let current = 0;
                    setInterval(() => {
                        slides[current].classList.add('hidden');
                        current = (current + 1) % slides.length;
                        slides[current].classList.remove('hidden');
                    }, 3000);
                </script>
            </div>
        </div>

        <!-- cards row 3 -->

        <div class="flex flex-wrap mt-6 -mx-3">
            <!-- Kolom 1: Ringkasan Lapangan -->
            <div class="w-full px-3 mt-0 lg:w-1/2">
                <div class="shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex flex-col break-words rounded-2xl border-0 bg-white bg-clip-border">
                    <div class="p-4 pb-0 rounded-t-4">
                        <h6 class="mb-0 dark:text-white font-semibold">Ringkasan Lapangan</h6>
                    </div>
                    <div class="flex-auto p-4">
                        @php
                        $lapanganData = [
                        ['name' => 'Lapangan 1', 'icon' => 'images/kok.png', 'status' => ['Pending','DP','Lunas'], 'total' => 5],
                        ['name' => 'Lapangan 2', 'icon' => 'images/kok.png', 'status' => ['Pending','DP','Lunas'], 'total' => 6],
                        ['name' => 'Lapangan 3', 'icon' => 'images/kok.png', 'status' => ['Pending','DP','Lunas'], 'total' => 5],
                        ];

                        $statusColor = [
                        'Pending' => 'bg-red-100 text-red-700',
                        'DP' => 'bg-blue-100 text-blue-700',
                        'Lunas' => 'bg-green-100 text-green-700',
                        ];
                        @endphp

                        <ul class="flex flex-col pl-0 mb-0 rounded-lg space-y-2">
                            @foreach($lapanganData as $lap)
                            <li class="flex justify-between items-center p-4 bg-white rounded-lg shadow-sm border">
                                <div class="flex items-center gap-2">
                                    <!-- Icon Lapangan -->
                                    <div class="w-10 h-10 flex items-center justify-center bg-teal-500 text-white rounded-lg">
                                        <img src="{{ asset($lap['icon']) }}" alt="Badminton Icon" class="w-6 h-6">
                                    </div>

                                    <!-- Nama Lapangan -->
                                    <h6 class="text-sm font-semibold text-slate-700 dark:text-white">{{ $lap['name'] }}</h6>
                                </div>

                                <!-- Chip Status di sebelah kanan -->
                                <div class="flex gap-2">
                                    @foreach($lap['status'] as $status)
                                    <button
                                        onclick="filterStatus('{{ $lap['name'] }}', '{{ $status }}')"
                                        class="px-3 py-1 rounded-full text-xs font-semibold {{ $statusColor[$status] }}">
                                        {{ $status }}
                                    </button>
                                    @endforeach
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <script>
                function filterStatus(lapangan, status) {
                    alert('Filter Lapangan ' + lapangan + ' by status: ' + status);
                    // nanti bisa pakai AJAX untuk load data sesuai status
                }
            </script>

            <script>
                function filterStatus(lapangan, status) {
                    alert('Filter Lapangan ' + lapangan + ' by status: ' + status);
                    // nanti bisa pakai AJAX untuk load data sesuai status
                }
            </script>

            <!-- Kolom 2: Detail Lapangan -->
            <div class="w-full px-3 mt-0 lg:w-1/2">
                <div class="shadow-xl dark:bg-slate-850 dark:shadow-dark-xl relative flex flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="p-4 pb-0 rounded-t-4">
                        <h6 class="mb-0 dark:text-white">Lapangan</h6>
                    </div>
                    <div class="flex-auto p-4">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            @php
                            $lapanganData = [
                            ['name' => 'Lapangan 1', 'status' => 'Available', 'booked' => 3, 'total' => 6, 'icon' => 'ni ni-app'],
                            ['name' => 'Lapangan 2', 'status' => 'Available', 'booked' => 2, 'total' => 7, 'icon' => 'ni ni-tv-2'],
                            ['name' => 'Lapangan 3', 'status' => 'Under Maintenance', 'booked' => 0, 'total' => 8, 'icon' => 'ni ni-money-coins'],
                            ['name' => 'Lapangan 4', 'status' => 'Available', 'booked' => 5, 'total' => 7, 'icon' => 'ni ni-satisfied'],
                            ];
                            @endphp

                            @foreach($lapanganData as $lap)
                            <li class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-xl text-inherit">
                                <div class="flex items-center">
                                    <div class="inline-flex w-10 h-10 mr-4 items-center justify-center text-white bg-teal-500 rounded-xl shadow-md">
                                        <img src="{{ asset('images/kok.png') }}" alt="Badminton Icon" class="w-6 h-6">
                                    </div>
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">{{ $lap['name'] }}</h6>
                                        <span class="text-xs leading-tight dark:text-white/80">
                                            {{ $lap['booked'] }} booked, <span class="font-semibold">{{ $lap['total'] - $lap['booked'] }} available</span>
                                        </span>
                                    </div>
                                </div>
                                <div class="flex">
                                    <button class="group ease-in leading-pro text-xs rounded-3.5xl p-1.2 h-6.5 w-6.5 mx-0 my-auto inline-block cursor-pointer border-0 bg-transparent text-center align-middle font-bold text-slate-700 shadow-none transition-all dark:text-white">
                                        <i class="ni ease-bounce text-2xs group-hover:translate-x-1.25 ni-bold-right transition-all duration-200" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </li>
                            @endforeach

                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <footer class="bg-white p-4 mt-10 text-center text-sm text-gray-400 border-t">
            © 2025 AdminSDK. All rights reserved.
        </footer>

    </div>
    <!-- end cards -->
</main>

@endsection