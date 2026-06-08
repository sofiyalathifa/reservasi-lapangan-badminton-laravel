@extends ('layouts.sidebar')

@section('content')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out lg:ml-68 rounded-xl">


    <!-- cards -->
    <div class="w-full px-6 py-6 mx-auto">
        <!-- row 1 -->
        <div class="flex flex-wrap -mx-3">
            @php
                $isKasir = auth()->check() && auth()->user()->role === 'kasir';
                $cardWidth = $isKasir ? 'lg:w-1/3' : 'lg:w-1/4';
            @endphp

            <!-- Card 1: Pendapatan Hari Ini -->
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 {{ $cardWidth }}">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Pendapatan Hari Ini</p>
                                <h5 class="mb-1 font-bold text-gray-800 text-xl">Rp {{ number_format($pendapatanHariIni, 0, ',', '.') }}</h5>
                                <p class="mb-0 text-sm {{ $persenPendapatan >= 0 ? 'text-green-500' : 'text-red-500' }} font-semibold">{{ $persenPendapatan >= 0 ? '+' : '' }}{{ number_format($persenPendapatan, 1) }}% <span class="font-normal text-gray-500">dibanding kemarin</span></p>
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
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 {{ $cardWidth }}">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Booking Hari Ini</p>
                                <h5 class="mb-1 font-bold text-gray-800 text-xl">{{ $bookingHariIni }} Reservasi</h5>
                                <p class="mb-0 text-sm {{ $persenBooking >= 0 ? 'text-green-500' : 'text-red-500' }} font-semibold">{{ $persenBooking >= 0 ? '+' : '' }}{{ number_format($persenBooking, 1) }}% <span class="font-normal text-gray-500">dibanding kemarin</span></p>
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
            <div class="w-full max-w-full px-3 mb-6 sm:w-1/2 {{ $cardWidth }}">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500">Lapangan Terpakai</p>
                                <h5 class="mb-1 font-bold text-gray-800 text-xl">{{ number_format($persenLapangan, 1) }}%</h5>
                                <p class="mb-0 text-sm text-gray-500">{{ $slotTerpakai }} Slot terpakai hari ini</p>
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

            @if(!$isKasir)
            <!-- Card 4: Total Transaksi Bulanan -->
            <div class="w-full max-w-full px-3 sm:w-1/2 lg:w-1/4 mb-6">
                <div class="relative flex flex-col min-w-0 break-words bg-white shadow-xl rounded-2xl bg-clip-border">
                    <div class="flex-auto p-4">
                        <div class="flex flex-row justify-between items-center">
                            <div class="flex-1 pr-2">
                                <p class="mb-0 text-sm font-semibold uppercase text-gray-500" style="font-size: 0.75rem;">Total Transaksi Bulanan</p>
                                <h5 class="mb-1 font-bold text-gray-800 text-xl">Rp {{ number_format($transaksiBulanIni, 0, ',', '.') }}</h5>
                                <p class="mb-0 text-sm {{ $persenTransaksi >= 0 ? 'text-green-500' : 'text-red-500' }} font-semibold">{{ $persenTransaksi >= 0 ? '+' : '' }}{{ number_format($persenTransaksi, 1) }}% <span class="font-normal text-gray-500">dibulan lalu</span></p>
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
            @endif

        </div>

        <!-- cards row 2 -->
        <div class="flex flex-wrap mt-6 -mx-3">
            @if(!$isKasir)
            <div class="w-full max-w-full px-3 mt-0 lg:w-7/12 lg:flex-none">
                <div class="border-black/12.5 dark:bg-slate-800 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0">
                        <h6 class="capitalize dark:text-white">Pendapatan Perminggu</h6>
                        <p class="mb-0 text-sm leading-normal dark:text-white dark:opacity-60">
                            <i class="fa fa-arrow-{{ $persenMingguan >= 0 ? 'up text-emerald-500' : 'down text-red-500' }}"></i>
                            <span class="font-semibold {{ $persenMingguan >= 0 ? 'text-emerald-500' : 'text-red-500' }}">{{ $persenMingguan >= 0 ? '+' : '' }}{{ number_format($persenMingguan, 1) }}%</span> dibanding minggu lalu
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
                            data: @json($chartData),
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
            @endif

            <div class="w-full max-w-full px-3 {{ $isKasir ? 'lg:w-full' : 'lg:w-5/12' }} lg:flex-none">
                <div id="carousel" class="relative w-full max-w-3xl mx-auto mt-6">
                    <!-- Slide container -->
                    <div id="slides">
                        <!-- Lapangan slides akan di-generate lewat JS -->
                    </div>
                </div>

                <script>
                    // Data jadwal lapangan riil dari database
                    const lapanganData = @json($jadwalLapangan);

                    // Generate slides
                    const slidesContainer = document.getElementById('slides');

                    lapanganData.forEach((lapangan, index) => {
                        const slide = document.createElement('div');
                        slide.className = index === 0 ? 'slide' : 'slide hidden'; // slide pertama visible, lainnya hidden
                        slide.innerHTML = `
                                <div class="bg-white dark:bg-slate-800 dark:text-white rounded-2xl shadow-xl p-6 h-full min-h-[300px] flex flex-col justify-start items-start text-left">
                                    <h4 class="font-bold mb-4 text-xl text-slate-700">${lapangan.id}</h4>
                                    <div class="grid grid-cols-4 gap-4 w-full pb-2 h-full content-start">
                                    ${lapangan.slots.map(slot => `
                                        <button class="w-full py-2.5 text-sm font-semibold rounded-lg text-center transition-all ${slot.status === 'booked' ? 'bg-emerald-500 text-white shadow-md cursor-not-allowed' : 'bg-white dark:bg-slate-700 dark:text-white dark:hover:bg-slate-600 shadow-sm border border-gray-200 hover:bg-gray-50 text-slate-700'}" ${slot.status === 'booked' ? 'disabled' : ''}>${slot.jam}</button>
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
                <div class="shadow-xl dark:bg-slate-800 dark:shadow-dark-xl relative flex flex-col break-words rounded-2xl border-0 bg-white bg-clip-border">
                    <div class="p-4 pb-0 rounded-t-4">
                        <h6 class="mb-0 dark:text-white font-semibold">Ringkasan Lapangan</h6>
                    </div>
                    <div class="flex-auto p-4">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg space-y-2">
                            @foreach($ringkasanLapangan as $lap)
                            <li class="flex justify-between items-center p-4 bg-white dark:bg-slate-700 rounded-lg shadow-sm border dark:border-slate-600">
                                <div class="flex items-center gap-2">
                                    <!-- Icon Lapangan -->
                                    <div class="w-10 h-10 flex items-center justify-center bg-teal-500 text-white rounded-lg">
                                        <img src="{{ asset('images/kok.png') }}" alt="Badminton Icon" class="w-6 h-6">
                                    </div>

                                    <!-- Nama Lapangan -->
                                    <h6 class="text-sm font-semibold text-slate-700 dark:text-white">{{ $lap['name'] }}</h6>
                                </div>

                                <!-- Chip Status di sebelah kanan -->
                                <div class="flex gap-2">
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700" title="Menunggu Pembayaran">
                                        Pending @if($lap['pending'] > 0)<span class="ml-1 px-1.5 py-0.5 bg-red-200 rounded-full">{{ $lap['pending'] }}</span>@endif
                                    </span>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-700" title="Sudah Bayar DP">
                                        DP @if($lap['dp'] > 0)<span class="ml-1 px-1.5 py-0.5 bg-blue-200 rounded-full">{{ $lap['dp'] }}</span>@endif
                                    </span>
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700" title="Sudah Lunas">
                                        Lunas @if($lap['lunas'] > 0)<span class="ml-1 px-1.5 py-0.5 bg-green-200 rounded-full">{{ $lap['lunas'] }}</span>@endif
                                    </span>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>



            <!-- Kolom 2: Detail Lapangan -->
            <div class="w-full px-3 mt-0 lg:w-1/2">
                <div class="shadow-xl dark:bg-slate-800 dark:shadow-dark-xl relative flex flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="p-4 pb-0 rounded-t-4">
                        <h6 class="mb-0 dark:text-white">Lapangan</h6>
                    </div>
                    <div class="flex-auto p-4">
                        <ul class="flex flex-col pl-0 mb-0 rounded-lg">
                            @foreach($ringkasanLapangan as $lap)
                            <li class="relative flex justify-between py-2 pr-4 mb-2 border-0 rounded-xl text-inherit">
                                <div class="flex items-center">
                                    <div class="inline-flex w-10 h-10 mr-4 items-center justify-center text-white bg-teal-500 rounded-xl shadow-md">
                                        <img src="{{ asset('images/kok.png') }}" alt="Badminton Icon" class="w-6 h-6">
                                    </div>
                                    <div class="flex flex-col">
                                        <h6 class="mb-1 text-sm leading-normal text-slate-700 dark:text-white">{{ $lap['name'] }}</h6>
                                        <span class="text-xs leading-tight dark:text-white/80">
                                            {{ $lap['booked'] }} booked, <span class="font-semibold">{{ $lap['available'] }} available</span>
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