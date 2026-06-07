@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">
    <div class="mb-8 flex justify-between items-center">
        <div>
            <h1 class="text-3xl font-bold text-gray-900">Dashboard Komunitas</h1>
            <p class="mt-2 text-gray-600">Kelola profil pencarian teman dan undangan bermain Anda.</p>
        </div>
        <a href="{{ route('komunitas.chat.index') }}" class="inline-flex items-center px-4 py-2 border border-transparent rounded-lg font-semibold text-white transition-colors shadow-sm" style="background-color: #16a34a;">
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
                    <form action="{{ route('komunitas.post') }}" method="POST" class="space-y-5">
                        @csrf
                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-700">Level Kemampuan</label>
                            <div class="relative">
                                <select name="level_kemampuan" required class="block w-full pr-10 py-3 text-base focus:outline-none sm:text-sm rounded-xl appearance-none cursor-pointer" style="padding-left: 1rem; border: 1px solid #d1d5db; background-color: #f9fafb;">
                                    <option value="" disabled selected>Pilih level Anda...</option>
                                    <option value="Beginner">Beginner (Pemula)</option>
                                    <option value="Intermediate">Intermediate (Menengah)</option>
                                    <option value="Advanced">Advanced (Mahir)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-700">Lokasi Bermain</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 flex items-center pointer-events-none text-gray-400" style="padding-left: 1rem;">
                                    <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                </div>
                                <input type="text" name="lokasi" required placeholder="Cth: Gor Rungkut, Surabaya" class="block w-full pr-4 py-3 sm:text-sm rounded-xl text-gray-900 placeholder-gray-400" style="padding-left: 2.75rem; border: 1px solid #d1d5db; background-color: #f9fafb;">
                            </div>
                        </div>

                        <div class="space-y-1.5">
                            <label class="block text-sm font-semibold text-gray-700">Gaya Bermain / Tujuan</label>
                            <textarea name="gaya_bermain" required rows="3" placeholder="Ceritakan gaya main yang Anda cari...&#10;Cth: Mencari partner santai untuk olahraga sore, atau cari musuh sparring ganda putra." class="block w-full p-4 sm:text-sm rounded-xl text-gray-900 placeholder-gray-400 resize-none" style="border: 1px solid #d1d5db; background-color: #f9fafb;"></textarea>
                        </div>
                        
                        <div class="pt-2">
                            <button type="submit" class="w-full flex justify-center py-3 px-4 rounded-xl shadow-sm text-sm font-bold text-white transition-all transform hover:-translate-y-0.5" style="background-color: #16a34a;">
                                Mulai Cari Teman
                            </button>
                        </div>
                    </form>
                @endif
            </div>

            <!-- Undangan Masuk -->
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" id="undanganMasukSection">
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
            <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-6" id="daftarPemainSection">
                <h2 class="text-xl font-bold text-gray-900 mb-6 text-center">Pemain yang Mencari Teman</h2>
                
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
                                    // Cek apakah sudah ada chat aktif dengan orang ini
                                    $existingChat = $activeChats->first(function($chat) use ($partner) {
                                        return ($chat->pengirim_id == auth()->id() && $chat->penerima_id == $partner->id_pengguna)
                                            || ($chat->pengirim_id == $partner->id_pengguna && $chat->penerima_id == auth()->id());
                                    });
                                    
                                    // Cek apakah ada undangan pending dengan orang ini
                                    $hasPending = $myRequests->first(function($req) use ($partner) {
                                        return $req->penerima_id == $partner->id_pengguna && $req->status == 'pending';
                                    });
                                    
                                    $hasRequested = $myRequests->where('id_cari_teman', $partner->id)->first();
                                @endphp
                                
                                @if($existingChat)
                                    <a href="{{ route('komunitas.chat.room', $existingChat->id) }}" class="block w-full py-2 text-white rounded-lg font-semibold text-sm transition text-center" style="background-color: #16a34a;">
                                        💬 Lanjutkan Chat
                                    </a>
                                @elseif($hasPending)
                                    <button disabled class="w-full py-2 bg-gray-100 text-gray-500 rounded-lg font-semibold text-sm cursor-not-allowed">
                                        Menunggu Konfirmasi...
                                    </button>
                                @elseif($hasRequested && $hasRequested->status == 'rejected')
                                    <button disabled class="w-full py-2 bg-gray-100 text-red-400 rounded-lg font-semibold text-sm cursor-not-allowed">
                                        Ditolak
                                    </button>
                                @else
                                    <form action="{{ route('komunitas.ajak', $partner->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="w-full py-2 bg-teal-500 hover:bg-teal-600 text-white rounded-lg font-semibold text-sm transition">
                                            Ajak Main ›
                                        </button>
                                    </form>
                                @endif
                            </div>
                        @endif
                    @empty
                        <div class="w-full py-12 flex flex-col items-center justify-center text-center" style="grid-column: 1 / -1;">
                            <svg class="w-16 h-16 text-gray-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                            <p class="text-gray-500 text-base font-medium">Belum ada pemain lain yang mencari teman saat ini.</p>
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
                    
                    // Hanya update area undangan masuk (tidak mengandung form input user)
                    const newUndangan = doc.getElementById('undanganMasukSection');
                    const oldUndangan = document.getElementById('undanganMasukSection');
                    if (newUndangan && oldUndangan && newUndangan.innerHTML !== oldUndangan.innerHTML) {
                        oldUndangan.innerHTML = newUndangan.innerHTML;
                    }
                    
                    // Hanya update area daftar pemain (tidak mengandung form input user)
                    const newPemain = doc.getElementById('daftarPemainSection');
                    const oldPemain = document.getElementById('daftarPemainSection');
                    if (newPemain && oldPemain && newPemain.innerHTML !== oldPemain.innerHTML) {
                        oldPemain.innerHTML = newPemain.innerHTML;
                    }
                })
                .catch(err => console.log('Polling error:', err));
        }, 5000); // Cek pembaruan setiap 5 detik
    });
</script>
@endsection
