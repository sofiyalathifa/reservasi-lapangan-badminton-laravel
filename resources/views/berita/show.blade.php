@extends('layouts.app')

@section('title', $berita->judul . ' - Berita & Insight')

@section('content')
<main class="min-h-screen bg-slate-50 pt-24 pb-12">
    <div class="mx-auto max-w-4xl px-4 sm:px-6 lg:px-8">
        
        {{-- BREADCRUMB --}}
        <nav class="mb-8 flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('home') }}" class="inline-flex items-center text-sm font-medium text-gray-500 hover:text-green-600 transition">
                        Home
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <a href="{{ route('home') }}#berita" class="ml-1 text-sm font-medium text-gray-500 hover:text-green-600 transition md:ml-2">Berita</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-4 h-4 text-gray-400 mx-1" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                        </svg>
                        <span class="ml-1 text-sm font-medium text-gray-400 md:ml-2">{{ Str::limit($berita->judul, 20) }}</span>
                    </div>
                </li>
            </ol>
        </nav>

        {{-- ARTICLE HEADER --}}
        <header class="mb-10 text-center">
            <span class="inline-block px-4 py-1.5 mb-4 text-xs font-bold text-green-600 bg-green-100 rounded-full uppercase tracking-wider">
                {{ $berita->kategori }}
            </span>
            <h1 class="text-4xl sm:text-5xl font-extrabold text-gray-900 leading-tight mb-6">
                {{ $berita->judul }}
            </h1>
            <div class="flex items-center justify-center gap-4 text-sm text-gray-500 font-medium">
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    {{ \Carbon\Carbon::parse($berita->tanggal_publikasi)->translatedFormat('d F Y') }}
                </div>
                <span>•</span>
                <div class="flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ $berita->baca_menit }} menit baca
                </div>
            </div>
        </header>

        {{-- MAIN IMAGE --}}
        <div class="mb-12 overflow-hidden rounded-3xl shadow-lg border border-gray-100">
            <img src="{{ asset('images/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="w-full h-72 md:h-96 object-cover object-center">
        </div>

        {{-- CONTENT BODY --}}
        <article class="custom-prose max-w-none text-gray-700 leading-relaxed bg-white p-8 sm:p-12 rounded-3xl shadow-sm border border-gray-100">
            <style>
                .custom-prose h3 {
                    font-size: 1.5rem;
                    font-weight: 800;
                    color: #111827;
                    margin-top: 2rem;
                    margin-bottom: 1rem;
                }
                .custom-prose p {
                    margin-bottom: 1.25rem;
                }
                .custom-prose ul {
                    list-style-type: disc;
                    padding-left: 1.5rem;
                    margin-bottom: 1.25rem;
                }
                .custom-prose li {
                    margin-bottom: 0.5rem;
                }
                .custom-prose strong {
                    color: #111827;
                    font-weight: 700;
                }
            </style>
            {!! $berita->konten !!}
        </article>

        {{-- RELATED ARTICLES --}}
        @if($beritas_lainnya->count() > 0)
        <div style="margin-top: 2rem;">
            <h3 class="text-2xl font-bold text-gray-900 mb-8 border-b pb-4">Baca Juga</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 gap-8">
                @foreach($beritas_lainnya as $item)
                <a href="{{ route('berita.show', $item->slug) }}" class="group bg-white rounded-2xl overflow-hidden shadow-sm border border-gray-100 transition duration-300 hover:shadow-xl hover:-translate-y-1">
                    <img src="{{ asset('images/' . $item->gambar) }}" alt="{{ $item->judul }}" class="w-full h-48 object-cover">
                    <div class="p-6">
                        <span class="text-xs font-bold text-green-500 uppercase tracking-wider mb-2 block">{{ $item->kategori }}</span>
                        <h4 class="text-lg font-bold text-gray-900 group-hover:text-green-600 transition leading-snug mb-3">
                            {{ Str::limit($item->judul, 50) }}
                        </h4>
                        <p class="text-sm text-gray-500">
                            {{ \Carbon\Carbon::parse($item->tanggal_publikasi)->translatedFormat('d M Y') }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif
        
    </div>
</main>
@endsection
