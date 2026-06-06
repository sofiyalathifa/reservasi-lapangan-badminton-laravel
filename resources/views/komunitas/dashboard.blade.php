@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Komunitas</h1>
            <p class="mt-2 text-gray-600">Kelola profil pencarian teman dan undangan bermain Anda.</p>
        </div>
        <a href="{{ route('komunitas.chat.index') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 border border-transparent rounded-lg font-semibold text-white hover:bg-blue-700">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
            Ruang Obrolan
        </a>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-700">
        {{ session('success') }}
    </div>
    @endif
    
    @if(session('error'))
    <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700">
        {{ session('error') }}
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Kolom Kiri: Profil Saya & Undangan -->
        <div class="lg:col-span-1 space-y-8">
            <!-- Profil Pencarian Saya -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4">Profil Pencarian Saya</h2>
                
                @if($myPost)
                    <div class="bg-blue-50 rounded-xl p-4 border border-blue-100">
                        <div class="flex justify-between items-start mb-2">
                            <span class="inline-block px-2 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-md">{{ $myPost->level_kemampuan }}</span>
                            <span class="text-xs text-blue-600 font-semibold flex items-center">
                                <span class="w-2 h-2 rounded-full bg-green-500 mr-1"></span> Aktif
                            </span>
                        </div>
                        <p class="text-sm text-gray-600 mt-2"><strong>Lokasi:</strong> {{ $myPost->lokasi }}</p>
                        <p class="text-sm text-gray-600"><strong>Gaya Main:</strong> {{ $myPost->gaya_bermain }}</p>
                        
                        <form action="{{ route('komunitas.close', $myPost->id) }}" method="POST" class="mt-4">
                            @csrf
                            <button type="submit" class="w-full py-2 text-sm text-red-600 bg-red-50 hover:bg-red-100 rounded-lg font-semibold transition">Tutup Pencarian</button>
                        </form>
                    </div>
                @else
                    <form action="{{ route('komunitas.post') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Level Kemampuan</label>
                            <select name="level_kemampuan" required class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="Beginner">Beginner (Pemula)</option>
                                <option value="Intermediate">Intermediate (Menengah)</option>
                                <option value="Advanced">Advanced (Mahir)</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Lokasi (Area/Kota)</label>
                            <input type="text" name="lokasi" required placeholder="Cth: Rungkut, Surabaya" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1">Gaya Bermain / Tujuan</label>
                            <textarea name="gaya_bermain" required rows="2" placeholder="Cth: Cari teman untuk sparring ganda putra" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"></textarea>
                        </div>
                        <button type="submit" class="w-full py-2 bg-blue-600 text-white rounded-lg font-semibold hover:bg-blue-700 transition">Posting Profil</button>
                    </form>
                @endif
            </div>

            <!-- Undangan Masuk -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-lg font-bold text-gray-900 mb-4 flex justify-between items-center">
                    Undangan Masuk
                    @if($incomingRequests->where('status', 'pending')->count() > 0)
                        <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">{{ $incomingRequests->where('status', 'pending')->count() }}</span>
                    @endif
                </h2>
                
                @forelse($incomingRequests as $req)
                    <div class="mb-3 p-3 border rounded-lg {{ $req->status == 'pending' ? 'border-yellow-200 bg-yellow-50' : 'border-gray-100' }}">
                        <p class="text-sm"><strong>{{ $req->pengirim->name }}</strong> mengajak Anda bermain.</p>
                        <p class="text-xs text-gray-500 mb-2">{{ $req->created_at->diffForHumans() }}</p>
                        
                        @if($req->status == 'pending')
                            <div class="flex gap-2 mt-2">
                                <form action="{{ route('komunitas.respon', $req->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="status" value="accepted">
                                    <button type="submit" class="w-full py-1.5 text-xs bg-green-500 hover:bg-green-600 text-white font-semibold rounded transition">Terima</button>
                                </form>
                                <form action="{{ route('komunitas.respon', $req->id) }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="w-full py-1.5 text-xs bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold rounded transition">Tolak</button>
                                </form>
                            </div>
                        @else
                            <span class="inline-block px-2 py-1 rounded text-xs font-bold {{ $req->status == 'accepted' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                                {{ ucfirst($req->status) }}
                            </span>
                        @endif
                    </div>
                @empty
                    <p class="text-sm text-gray-500 text-center py-4">Belum ada undangan masuk.</p>
                @endforelse
            </div>
        </div>

        <!-- Kolom Kanan: Daftar Pemain -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-6">Pemain yang Mencari Teman</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($allPartners as $partner)
                        @if($partner->id_pengguna != auth()->id())
                            <div class="border border-gray-200 rounded-xl p-4 hover:shadow-md transition">
                                <div class="flex justify-between items-start mb-2">
                                    <h3 class="font-bold text-lg text-gray-900">{{ $partner->user->name }}</h3>
                                    <span class="inline-block px-2 py-1 bg-teal-50 text-teal-700 text-xs font-semibold rounded-md">{{ $partner->level_kemampuan }}</span>
                                </div>
                                <p class="text-sm text-gray-500 mb-1"><svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>{{ $partner->lokasi }}</p>
                                <p class="text-sm text-gray-700 mb-4 bg-gray-50 p-2 rounded">"{{ $partner->gaya_bermain }}"</p>
                                
                                @php
                                    $hasRequested = $myRequests->where('id_cari_teman', $partner->id)->first();
                                @endphp
                                
                                @if($hasRequested)
                                    <button disabled class="w-full py-2 bg-gray-100 text-gray-500 rounded-lg font-semibold text-sm cursor-not-allowed">
                                        {{ $hasRequested->status == 'pending' ? 'Menunggu Konfirmasi...' : ($hasRequested->status == 'accepted' ? 'Diterima - Cek Chat' : 'Ditolak') }}
                                    </button>
                                @else
                                    <form action="{{ route('komunitas.ajak', $partner->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full py-2 bg-teal-500 hover:bg-teal-600 text-white rounded-lg font-semibold text-sm transition">
                                            Ajak Main
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @empty
                        <div class="col-span-full py-8 text-center text-gray-500">
                            Belum ada pemain lain yang mencari teman saat ini.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-refresh Dashboard (Polling)
        setInterval(function() {
            fetch("{{ route('komunitas.index') }}")
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    
                    // Kita akan me-refresh area notifikasi undangan dan list pemain
                    const newGrid = doc.querySelector('.grid.grid-cols-1.lg\\:grid-cols-3');
                    const oldGrid = document.querySelector('.grid.grid-cols-1.lg\\:grid-cols-3');
                    
                    if (newGrid && oldGrid && newGrid.innerHTML !== oldGrid.innerHTML) {
                        oldGrid.innerHTML = newGrid.innerHTML;
                    }
                })
                .catch(err => console.log('Polling error:', err));
        }, 5000); // Cek pembaruan setiap 5 detik
    });
</script>
@endsection
