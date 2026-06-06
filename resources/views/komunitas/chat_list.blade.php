@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 pt-28 pb-12">
    <div class="mb-8 flex items-center justify-between">
        <h1 class="text-3xl font-bold text-gray-900">Ruang Obrolan</h1>
        <a href="{{ route('komunitas.index') }}" class="text-blue-600 hover:text-blue-800 font-semibold">&larr; Kembali ke Dashboard</a>
    </div>

    <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
        <div class="divide-y divide-gray-100">
            @forelse($chats as $chat)
                @php
                    // Tentukan siapa lawan bicara kita (yang bukan kita)
                    $lawanBicara = $chat->pengirim_id == auth()->id() ? $chat->penerima : $chat->pengirim;
                    // Cek jika ada pesan belum terbaca untuk kita
                    $unreadCount = \App\Models\PesanKomunitas::where('id_ajak_main', $chat->id)
                                        ->where('pengirim_id', '!=', auth()->id())
                                        ->where('is_read', false)
                                        ->count();
                    // Ambil pesan terakhir
                    $latestMessage = \App\Models\PesanKomunitas::where('id_ajak_main', $chat->id)->latest()->first();
                @endphp
                <a href="{{ route('komunitas.chat.room', $chat->id) }}" class="block p-4 hover:bg-blue-50 transition flex items-center justify-between">
                    <div class="flex items-center gap-4 w-full">
                        <div class="w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center font-bold text-xl uppercase flex-shrink-0">
                            {{ substr($lawanBicara->name, 0, 1) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <h3 class="font-bold text-gray-900 text-base">
                                {{ $lawanBicara->name }} 
                                <span class="font-normal text-xs text-gray-500 ml-1">({{ $chat->cariTeman->lokasi }})</span>
                            </h3>
                            @if($latestMessage)
                                <p class="text-sm flex items-center gap-1 truncate {{ $unreadCount > 0 ? 'text-gray-800 font-semibold' : 'text-gray-500' }}">
                                    @if($latestMessage->pengirim_id == auth()->id())
                                        <svg class="w-4 h-4 text-blue-500 flex-shrink-0" style="margin-top: 2px;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7M5 13l4 4L19 7"></path></svg>
                                    @endif
                                    <span class="truncate">{{ $latestMessage->pesan }}</span>
                                </p>
                            @else
                                <p class="text-sm text-gray-400 italic">Membahas ajakan bermain: {{ $chat->cariTeman->lokasi }}</p>
                            @endif
                        </div>
                        <div class="text-right flex-shrink-0 ml-2">
                            <span class="text-xs {{ $unreadCount > 0 ? 'text-green-500 font-bold' : 'text-gray-400' }} block mb-1">
                                {{ $latestMessage ? $latestMessage->created_at->format('H:i') : $chat->updated_at->diffForHumans() }}
                            </span>
                            @if($unreadCount > 0)
                                <span class="inline-flex justify-center items-center bg-green-500 text-white text-[10px] font-bold h-5 min-w-[20px] px-1.5 rounded-full">{{ $unreadCount }}</span>
                            @endif
                        </div>
                    </div>
                </a>
            @empty
                <div class="p-8 text-center text-gray-500">
                    <p>Anda belum memiliki percakapan aktif.</p>
                    <p class="text-sm mt-2">Terima undangan atau ajak seseorang bermain untuk memulai percakapan.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-refresh daftar obrolan (Polling)
        setInterval(function() {
            fetch("{{ route('komunitas.chat.index') }}")
                .then(res => res.text())
                .then(html => {
                    const parser = new DOMParser();
                    const doc = parser.parseFromString(html, 'text/html');
                    const newChatList = doc.querySelector('.divide-y');
                    const oldChatList = document.querySelector('.divide-y');
                    
                    // Update DOM hanya jika ada perubahan pada list (pesan baru, notif baru)
                    if (newChatList && oldChatList && newChatList.innerHTML !== oldChatList.innerHTML) {
                        oldChatList.innerHTML = newChatList.innerHTML;
                    }
                })
                .catch(err => console.log('Polling error:', err));
        }, 5000); // Cek pesan baru setiap 5 detik
    });
</script>
@endsection
