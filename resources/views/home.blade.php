@extends('layouts.app', ['showFooter' => true])

@section('title', 'Home')

@section('content')

<main class="bg-white overflow-hidden">

    {{-- HERO SECTION --}}
    <section id="hero" class="relative min-h-screen overflow-hidden bg-white pt-28 lg:pt-0">

        <div class="absolute top-0 right-[-180px] w-[350px] h-[350px]
            lg:-top-32 lg:right-[-150px] lg:w-[700px] lg:h-[700px]
            rounded-full bg-gray-200">
        </div>

        <div class="absolute top-8 right-[-120px] w-[300px] h-[300px]
            lg:-top-24 lg:right-[-100px] lg:w-[620px] lg:h-[620px]
            rounded-full overflow-hidden">
            <img src="{{ asset('images/banner1.jpeg') }}"
                alt="Badminton"
                class="w-full h-full object-cover">
        </div>

        <div class="max-w-7xl mx-auto px-6 relative z-10 min-h-screen flex items-center pt-24 pb-20 lg:pt-24 lg:pb-24">
            <div class="max-w-xl">

                <p class="text-green-500 uppercase tracking-[4px] font-semibold mb-4">
                    Venue badminton utama di Rungkut, Surabaya
                </p>

                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold leading-tight max-w-2xl">
                    Booking Lapangan
                    <span class="text-green-500">Badminton</span>
                    Jadi Lebih Mudah
                </h1>

                <p class="mt-6 text-gray-600 text-base lg:text-lg max-w-xl">
                    Venue badminton indoor untuk latihan rutin, sparring, dan booking harian dengan sistem reservasi yang rapi dan mudah dipantau.
                </p>

                <div class="flex gap-3 mt-10">
                    <a href="/reservasi"
                        class="bg-gradient-to-r from-green-500 to-teal-500 hover:bg-green-600 text-white px-4 py-3 lg:px-8 lg:py-4 text-sm lg:text-base rounded-full font-medium transition">
                        Booking Sekarang
                    </a>

                    <a href="#lapangan-populer"
                        class="border border-gray-300 px-4 py-3 lg:px-8 lg:py-4 text-sm lg:text-base rounded-full hover:bg-gray-200 transition">
                        Lihat Lapangan
                    </a>
                </div>

            </div>
        </div>

    </section>


    {{-- LAPANGAN POPULER SECTION --}}
    <section id="lapangan-populer" class="relative py-20 bg-white">
        <div class="max-w-6xl mx-auto relative px-6" id="carousel-container">

            <h2 class="text-4xl font-extrabold text-center text-gray-800 mb-5 tracking-tight">
                Lapangan <span class="text-green-600">Populer</span>
            </h2>

            <!-- Search bar -->
            <div class="max-w-5xl mx-auto mb-10">
                <p class="text-gray-500 text-center mb-6">
                    Ada preview visual, filter tipe lapangan, lokasi, dan harga agar proses booking terasa cepat dan menyenangkan.
                </p>

                <div class="flex flex-col lg:flex-row items-center justify-center gap-4">

                    {{-- Search Bar --}}
                    <div class="w-full lg:w-[360px] flex items-center gap-3 px-5 py-3 rounded-full border border-gray-300 bg-white shadow-sm">
                        <span class="text-gray-400">⌕</span>
                        <input
                            id="searchInput"
                            type="text"
                            placeholder="Cari nama venue atau lokasi"
                            class="w-full bg-transparent outline-none text-gray-700 placeholder:text-gray-400">
                    </div>

                    {{-- Filter Tabs --}}
                    <div id="typeTabs"
                        class="flex flex-wrap justify-center gap-2 rounded-full border border-gray-200 bg-white p-2 shadow-sm">

                        <button class="tab-btn active-tab px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300"
                            data-type="Semua">
                            Semua
                        </button>

                        <button class="tab-btn px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300"
                            data-type="Indoor Vinyl">
                            Indoor Vinyl
                        </button>

                        <button class="tab-btn px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300"
                            data-type="Karpet Premium">
                            Karpet Premium
                        </button>

                        <button class="tab-btn px-5 py-2 rounded-full text-sm font-semibold transition-all duration-300"
                            data-type="Indoor Basic">
                            Indoor Basic
                        </button>

                    </div>

                </div>
            </div>

            <div class="relative">
                <div class="overflow-hidden py-4">
                    <div id="track" class="flex transition-transform duration-500 ease-out">

                        @for ($i = 1; $i <= 5; $i++)
                            <div class="min-w-full md:min-w-[33.33%] p-4">
                            <article class="bg-white rounded-lg overflow-hidden shadow-2xl max-w-sm mx-auto transition-all duration-300 hover:-translate-y-2 hover:shadow-2xl">

                                <img
                                    class="h-48 w-full object-cover object-center"
                                    src="{{ asset('images/lap' . $i . '.jpeg') }}"
                                    alt="Lapangan {{ $i }}" />

                                <div class="p-6">
                                    <div class="flex items-baseline">
                                        <span class="inline-block bg-teal-200 text-teal-800 py-1 px-4 text-xs rounded-full uppercase font-semibold tracking-wide">
                                            Available
                                        </span>

                                        <div class="ml-2 text-gray-600 text-xs uppercase font-semibold tracking-wide">
                                            Indoor &bull; Court {{ $i }}
                                        </div>
                                    </div>

                                    <h4 class="mt-2 font-semibold text-lg leading-tight truncate">
                                        Lapangan Badminton {{ $i }}
                                    </h4>

                                    <div class="mt-1">
                                        <span class="font-semibold text-gray-900">
                                            Rp {{ 50000 + ($i * 10000) }}
                                        </span>
                                        <span class="text-gray-600 text-sm">
                                            / jam
                                        </span>
                                    </div>

                                    <div class="mt-2 flex items-center">
                                        <span class="text-teal-600 font-semibold">
                                            ★★★★☆
                                        </span>

                                        <span class="ml-2 text-gray-600 text-sm">
                                            {{ 20 + ($i * 4) }} reviews
                                        </span>
                                    </div>

                                    <a href="{{ route('lapangan.detail', ['id' => $i]) }}"
                                        class="inline-block mt-5 w-full text-center bg-green-500 hover:bg-green-600 text-white py-3 rounded-lg font-medium transition">
                                        Preview & Booking
                                    </a>
                                </div>

                            </article>
                    </div>
                    @endfor

                </div>
            </div>

            <button id="prevBtn"
                class="absolute top-1/2 left-0 -translate-y-1/2 -translate-x-2 md:-translate-x-6 bg-white p-3 rounded-full shadow-lg text-blue-900 hover:bg-blue-50 z-10 transition">
                ‹
            </button>

            <button id="nextBtn"
                class="absolute top-1/2 right-0 -translate-y-1/2 translate-x-2 md:translate-x-6 bg-white p-3 rounded-full shadow-lg text-blue-900 hover:bg-blue-50 z-10 transition">
                ›
            </button>
        </div>

        <div class="flex justify-center mt-8 space-x-2" id="indicators"></div>

        </div>
    </section>

    {{-- PELATIH & TEMAN MAIN SECTION --}}
    <section id="komunitas" class="relative bg-white py-24">

        @php
        $coaches = [
        [
        'name' => 'Coach Ardi',
        'specialty' => 'Footwork & Singles',
        'level' => 'Advanced',
        'price' => 'Mulai Rp150.000/sesi',
        'rating' => '4.9',
        ],
        [
        'name' => 'Coach Nabila',
        'specialty' => 'Beginner Clinic',
        'level' => 'Beginner',
        'price' => 'Mulai Rp120.000/sesi',
        'rating' => '4.8',
        ],
        [
        'name' => 'Coach Reza',
        'specialty' => 'Doubles Strategy',
        'level' => 'Intermediate',
        'price' => 'Mulai Rp135.000/sesi',
        'rating' => '4.9',
        ],
        ];

        $partners = [
        [
        'name' => 'Raka, 26',
        'city' => 'Rungkut, Surabaya',
        'skill' => 'Intermediate',
        'play' => 'Main santai dan sparring malam',
        ],
        [
        'name' => 'Dina, 24',
        'city' => 'Sukolilo, Surabaya',
        'skill' => 'Beginner',
        'play' => 'Butuh partner latihan weekend',
        ],
        [
        'name' => 'Bagas, 29',
        'city' => 'Wonokromo, Surabaya',
        'skill' => 'Advanced',
        'play' => 'Cari partner latihan kompetitif',
        ],
        ];
        @endphp

        <div class="mx-auto max-w-7xl px-6">

            {{-- Section Heading --}}
            <div class="mx-auto mb-14 max-w-3xl text-center">
                <p class="mb-3 text-sm font-semibold uppercase tracking-[4px] text-green-500">
                    Komunitas Badminton
                </p>

                <h2 class="text-4xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                    Tingkatkan Permainan dan
                    <span class="text-green-500">Temukan Partner</span>
                </h2>

                <p class="mt-5 text-lg leading-8 text-slate-600">
                    Pilih pelatih sesuai kebutuhan atau temukan teman bermain
                    dengan level dan jadwal yang cocok.
                </p>
            </div>

            <div class="grid grid-cols-1 gap-8 lg:grid-cols-2">

                {{-- CARI PELATIH --}}
                <article id="pelatih"
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-md md:p-8">

                    <div class="mb-8">
                        <p class="mb-2 text-sm font-semibold uppercase tracking-[3px] text-green-500">
                            Cari Pelatih
                        </p>

                        <h3 class="text-3xl font-bold text-slate-900">
                            Temukan coach sesuai level bermainmu
                        </h3>

                        <p class="mt-3 text-slate-600">
                            Latihan teknik dan strategi bersama pelatih profesional.
                        </p>
                    </div>

                    <div class="space-y-4">
                        @foreach ($coaches as $coach)
                        <div
                            class="flex flex-col justify-between gap-5 rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-green-300 hover:shadow-lg sm:flex-row sm:items-center">

                            <div>
                                <span
                                    class="inline-flex rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                    {{ $coach['level'] }}
                                </span>

                                <h4 class="mt-3 text-xl font-bold text-slate-900">
                                    {{ $coach['name'] }}
                                </h4>

                                <p class="mt-1 text-sm text-slate-600">
                                    {{ $coach['specialty'] }}
                                </p>

                                <p class="mt-2 text-sm font-semibold text-green-500">
                                    {{ $coach['price'] }}
                                </p>
                            </div>

                            <div class="flex items-center justify-between gap-4 sm:flex-col sm:items-end">
                                <span class="text-sm font-semibold text-amber-500">
                                    ★ {{ $coach['rating'] }}
                                </span>

                                <a href="#"
                                    class="inline-flex items-center rounded-full bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-gradient-to-r from-green-500 to-teal-500 hover:text-white">
                                    Booking Coach

                                    <svg class="ml-3" width="4" height="8" viewBox="0 0 3 6"
                                        fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M0 0L3 3L0 6"></path>
                                    </svg>
                                </a>
                            </div>

                        </div>
                        @endforeach
                    </div>

                </article>


                {{-- CARI TEMAN MAIN --}}
                <article id="teman-main"
                    class="rounded-2xl border border-slate-200 bg-white p-6 shadow-md md:p-8">

                    <div class="mb-8">
                        <p class="mb-2 text-sm font-semibold uppercase tracking-[3px] text-cyan-500">
                            Cari Teman Main
                        </p>

                        <h3 class="text-3xl font-bold text-slate-900">
                            Temukan partner bermain yang sesuai
                        </h3>

                        <p class="mt-3 text-slate-600">
                            Cari teman bermain berdasarkan level, lokasi, dan gaya bermain.
                        </p>
                    </div>

                    <div class="space-y-4">
                        @foreach ($partners as $partner)
                        <div
                            class="rounded-xl border border-slate-200 bg-white p-5 shadow-sm transition-all duration-300 hover:-translate-y-1 hover:border-cyan-300 hover:shadow-lg">

                            <div class="flex items-start justify-between gap-4">
                                <div>
                                    <h4 class="text-xl font-bold text-slate-900">
                                        {{ $partner['name'] }}
                                    </h4>

                                    <p class="mt-1 text-sm text-slate-500">
                                        {{ $partner['city'] }}
                                    </p>
                                </div>

                                <span
                                    class="rounded-full bg-cyan-100 px-4 py-2 text-xs font-semibold text-cyan-700">
                                    {{ $partner['skill'] }}
                                </span>
                            </div>

                            <p class="mt-4 text-sm leading-6 text-slate-600">
                                {{ $partner['play'] }}
                            </p>

                            <a href="#"
                                class="mt-5 inline-flex items-center rounded-full bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-gradient-to-r from-green-500 to-teal-500 hover:text-white">
                                Ajak Main

                                <svg class="ml-3" width="4" height="8" viewBox="0 0 3 6"
                                    fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M0 0L3 3L0 6"></path>
                                </svg>
                            </a>

                        </div>
                        @endforeach
                    </div>

                </article>

            </div>
        </div>
    </section>


    {{-- PROMO SECTION --}}
    <section id="promo" class="relative bg-white py-20">
        <div class="mx-auto max-w-7xl px-6">

            <div class="grid grid-cols-1 gap-6 md:grid-cols-2 lg:grid-cols-4">

                {{-- INTRO PROMO --}}
                <div class="flex min-h-[370px] flex-col rounded-md bg-gradient-to-b from-green-400 to-cyan-600 p-12 text-white">

                    <p class="text-sm font-semibold uppercase tracking-[5px]">
                        Promosi
                    </p>

                    <h2 class="mt-10 text-4xl font-bold leading-tight">
                        Promo yang Bikin Booking Lebih Ringan
                    </h2>

                    <p class="mt-5 text-sm leading-7 text-white/80">
                        Gunakan promo aktif untuk mendapatkan harga booking yang lebih hemat.
                    </p>

                </div>


                {{-- HAPPY HOUR --}}
                <article
                    class="group flex min-h-[370px] flex-col rounded-md bg-white p-10 shadow-lg transition-all duration-300 hover:-translate-y-3 hover:shadow-2xl">

                    <span class="w-fit rounded-full bg-orange-100 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-orange-600">
                        Hemat
                    </span>

                    <h3 class="mt-5 text-3xl font-bold leading-tight text-slate-900">
                        Happy Hour Weekday
                    </h3>

                    <p class="mt-5 flex-1 leading-8 text-slate-500">
                        Dapatkan diskon 25% untuk booking lapangan pada pukul 10.00–15.00.
                    </p>

                    <div class="mt-auto flex w-full items-center gap-2 pt-6">
                        <span
                            class="shrink-0 rounded-full bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700">
                            HAPPY25
                        </span>

                        <a href="#"
                            class="ml-auto inline-flex shrink-0 items-center whitespace-nowrap text-xs font-semibold text-green-500 transition hover:text-green-600 sm:text-sm">
                            Klaim Promo
                            <span class="ml-2">›</span>
                        </a>
                    </div>

                </article>


                {{-- PAKET MAIN DAN PELATIH --}}
                <article
                    class="group flex h-full min-h-[370px] flex-col rounded-md bg-white p-10 shadow-lg transition-all duration-300 hover:-translate-y-3 hover:shadow-2xl">

                    <span class="w-fit rounded-full bg-orange-100 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-orange-600">
                        Favorit
                    </span>

                    <h3 class="mt-5 text-3xl font-bold leading-tight text-slate-900">
                        Paket Main + Pelatih
                    </h3>

                    <p class="mt-5 flex-1 leading-8 text-slate-500">
                        Gratis shuttlecock untuk pemesanan sesi latihan dengan durasi minimal dua jam.
                    </p>

                    <div class="mt-auto flex w-full items-center gap-2 pt-6">
                        <span
                            class="shrink-0 rounded-full bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700">
                            COACHPLAY
                        </span>

                        <a href="#"
                            class="ml-auto inline-flex shrink-0 items-center whitespace-nowrap text-xs font-semibold text-green-500 transition hover:text-green-600 sm:text-sm">
                            Klaim Promo
                            <span class="ml-2">›</span>
                        </a>
                    </div>

                </article>


                {{-- MEMBER REFERRAL --}}
                <article
                    class="group flex min-h-[370px] flex-col rounded-md bg-white p-10 shadow-lg transition-all duration-300 hover:-translate-y-3 hover:shadow-2xl">

                    <span class="w-fit rounded-full bg-orange-100 px-4 py-2 text-xs font-semibold uppercase tracking-wide text-orange-600">
                        Baru
                    </span>

                    <h3 class="mt-5 text-3xl font-bold leading-tight text-slate-900">
                        Member Referral
                    </h3>

                    <p class="mt-5 flex-1 leading-8 text-slate-500">
                        Ajak teman untuk bergabung dan dapatkan voucher booking senilai Rp50.000.
                    </p>

                    <div class="mt-auto flex w-full items-center gap-2 pt-6">
                        <span
                            class="shrink-0 rounded-full bg-slate-100 px-3 py-2 text-xs font-semibold text-slate-700">
                            REFER50
                        </span>

                        <a href="#"
                            class="ml-auto inline-flex shrink-0 items-center whitespace-nowrap text-xs font-semibold text-green-500 transition hover:text-green-600 sm:text-sm">
                            Klaim Promo
                            <span class="ml-2">›</span>
                        </a>
                    </div>
                </article>

            </div>

        </div>
    </section>

    {{-- BERITA SECTION --}}
    <section id="berita" class="relative bg-white py-24">

        <div class="mx-auto max-w-7xl px-6">

            {{-- SECTION HEADING --}}
            <div class="mb-12 max-w-3xl">

                <p class="mb-3 text-sm font-semibold uppercase tracking-[4px] text-green-500">
                    Berita & Insight
                </p>

                <h2 class="text-4xl font-extrabold leading-tight text-slate-900 md:text-5xl">
                    Update Badminton untuk
                    <span class="text-green-500">
                        Pemain Aktif
                    </span>
                </h2>

                <p class="mt-5 text-lg leading-8 text-slate-600">
                    Temukan tips bermain, agenda komunitas, informasi turnamen,
                    dan berita badminton terbaru.
                </p>

            </div>


            {{-- BERITA CONTENT --}}
            <div class="grid grid-cols-1 items-start gap-12 lg:grid-cols-12">

                {{-- ARTIKEL UTAMA --}}
                <article class="lg:col-span-7">

                    <a href="#"
                        class="group block overflow-hidden rounded-2xl">

                        <img
                            src="{{ asset('images/banner.jpeg') }}"
                            alt="Tips meningkatkan permainan badminton"
                            class="h-72 w-full object-cover transition duration-500 group-hover:scale-105 md:h-96">

                    </a>

                    <div class="mt-6">

                        <a href="#"
                            class="text-xs font-semibold uppercase tracking-wide text-green-500 transition hover:text-green-600">
                            Tips Bermain
                        </a>

                        <h3 class="mt-3">
                            <a href="#"
                                class="text-2xl font-bold leading-tight text-slate-900 transition hover:text-green-500 md:text-3xl">
                                Cara meningkatkan konsistensi permainan badminton
                            </a>
                        </h3>

                        <p class="mt-4 max-w-3xl text-sm leading-7 text-slate-600">
                            Pelajari cara memperbaiki footwork, kontrol pukulan,
                            dan strategi permainan agar lebih konsisten di lapangan.
                        </p>

                        <div class="mt-5 flex items-center gap-3 text-xs text-slate-400">
                            <span>12 Juni 2026</span>
                            <span>•</span>
                            <span>5 menit baca</span>
                        </div>

                        <a href="#"
                            class="mt-6 inline-flex items-center rounded-full bg-slate-100 px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-gradient-to-r from-green-500 to-teal-500 hover:text-white">
                            Baca Artikel
                            <span class="ml-3">›</span>
                        </a>

                    </div>

                </article>


                {{-- BERITA TERBARU --}}
                <aside class="lg:col-span-5">

                    <div class="mb-6 flex items-center justify-between">

                        <h3 class="text-2xl font-bold text-slate-900">
                            Berita Terbaru
                        </h3>

                        <a href="#"
                            class="text-sm font-semibold text-green-500 transition hover:text-green-600">
                            Lihat Semua
                        </a>

                    </div>


                    <div class="space-y-5">

                        {{-- BERITA 1 --}}
                        <article class="group flex items-start gap-4 border-b border-slate-200 pb-5">

                            <a href="#"
                                class="shrink-0 overflow-hidden rounded-lg">

                                <img
                                    src="{{ asset('images/berita1.jpeg') }}"
                                    alt="Turnamen badminton lokal"
                                    class="h-24 w-24 object-cover transition duration-300 group-hover:scale-105">

                            </a>

                            <div>

                                <p class="text-xs text-slate-400">
                                    10 Juni 2026
                                </p>

                                <a href="#"
                                    class="mt-2 block font-semibold leading-6 text-slate-900 transition hover:text-green-500">
                                    Turnamen badminton lokal segera dimulai
                                </a>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Informasi pendaftaran dan jadwal pertandingan terbaru.
                                </p>

                            </div>

                        </article>


                        {{-- BERITA 2 --}}
                        <article class="group flex items-start gap-4 border-b border-slate-200 pb-5">

                            <a href="#"
                                class="shrink-0 overflow-hidden rounded-lg">

                                <img
                                    src="{{ asset('images/berita2.jpeg') }}"
                                    alt="Tips memilih raket badminton"
                                    class="h-24 w-24 object-cover transition duration-300 group-hover:scale-105">

                            </a>

                            <div>

                                <p class="text-xs text-slate-400">
                                    8 Juni 2026
                                </p>

                                <a href="#"
                                    class="mt-2 block font-semibold leading-6 text-slate-900 transition hover:text-green-500">
                                    Tips memilih raket berdasarkan gaya bermain
                                </a>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Kenali jenis raket yang sesuai dengan kebutuhanmu.
                                </p>

                            </div>

                        </article>


                        {{-- BERITA 3 --}}
                        <article class="group flex items-start gap-4 border-b border-slate-200 pb-5">

                            <a href="#"
                                class="shrink-0 overflow-hidden rounded-lg">

                                <img
                                    src="{{ asset('images/berita3.jpeg') }}"
                                    alt="Latihan footwork badminton"
                                    class="h-24 w-24 object-cover transition duration-300 group-hover:scale-105">

                            </a>

                            <div>

                                <p class="text-xs text-slate-400">
                                    5 Juni 2026
                                </p>

                                <a href="#"
                                    class="mt-2 block font-semibold leading-6 text-slate-900 transition hover:text-green-500">
                                    Latihan footwork sederhana untuk pemula
                                </a>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Latihan dasar untuk meningkatkan pergerakan di lapangan.
                                </p>

                            </div>

                        </article>


                        {{-- BERITA 4 --}}
                        <article class="group flex items-start gap-4">

                            <a href="#"
                                class="shrink-0 overflow-hidden rounded-lg">

                                <img
                                    src="{{ asset('images/berita4.jpeg') }}"
                                    alt="Komunitas badminton"
                                    class="h-24 w-24 object-cover transition duration-300 group-hover:scale-105">

                            </a>

                            <div>

                                <p class="text-xs text-slate-400">
                                    2 Juni 2026
                                </p>

                                <a href="#"
                                    class="mt-2 block font-semibold leading-6 text-slate-900 transition hover:text-green-500">
                                    Agenda open play komunitas minggu ini
                                </a>

                                <p class="mt-2 text-sm leading-6 text-slate-500">
                                    Temukan jadwal bermain bersama komunitas badminton.
                                </p>

                            </div>

                        </article>

                    </div>

                </aside>

            </div>

        </div>

    </section>



</main>


@endsection