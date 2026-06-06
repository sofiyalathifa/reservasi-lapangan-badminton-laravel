@extends('layouts.app')

@section('title', 'Admin Dashboard - Verifikasi Pembayaran')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24 pb-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Dashboard Verifikasi</h1>
            <p class="text-gray-500">Kelola semua pesanan pelanggan, cek bukti transfer, dan konfirmasi pembayaran.</p>
            
            <!-- Filter Tabs -->
            <div class="mt-6 flex flex-wrap gap-2">
                <a href="{{ route('admin.reservasi.index', ['status' => 'semua']) }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-200 {{ $status === 'semua' ? 'bg-gray-900 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">Semua Pesanan</a>
                <a href="{{ route('admin.reservasi.index', ['status' => 'menunggu_konfirmasi']) }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-200 {{ $status === 'menunggu_konfirmasi' ? 'bg-blue-500 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">Butuh Verifikasi (Prioritas)</a>
                <a href="{{ route('admin.reservasi.index', ['status' => 'pending']) }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-200 {{ $status === 'pending' ? 'bg-yellow-500 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">Belum Bayar</a>
                <a href="{{ route('admin.reservasi.index', ['status' => 'dikonfirmasi']) }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-200 {{ $status === 'dikonfirmasi' ? 'bg-green-500 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">Lunas</a>
                <a href="{{ route('admin.reservasi.index', ['status' => 'dibatalkan']) }}" class="px-5 py-2.5 rounded-full text-sm font-bold transition-all duration-200 {{ $status === 'dibatalkan' ? 'bg-red-500 text-white shadow-md' : 'bg-white text-gray-600 hover:bg-gray-100 border border-gray-200' }}">Dibatalkan</a>
            </div>
        </div>

        @if(session('success'))
        <div class="mb-8 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl flex items-center gap-3 shadow-sm">
            <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif
        
        @if(session('error'))
        <div class="mb-8 bg-red-50 border border-red-200 text-red-700 px-5 py-4 rounded-xl flex items-center gap-3 shadow-sm">
            <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('error') }}</span>
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-sm text-gray-500 uppercase tracking-wider">
                            <th class="p-4 font-bold">ID / Tgl Booking</th>
                            <th class="p-4 font-bold">Pelanggan</th>
                            <th class="p-4 font-bold">Jadwal Main</th>
                            <th class="p-4 font-bold">Tagihan</th>
                            <th class="p-4 font-bold">Status</th>
                            <th class="p-4 font-bold text-center">Aksi Admin</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($reservasis as $res)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="p-4">
                                <div class="font-mono text-gray-900 font-bold">{{ $res->id_reservasi }}</div>
                                <div class="text-xs text-gray-500 mt-1">{{ $res->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-gray-900">{{ $res->pengguna->name ?? 'User' }}</div>
                                <div class="text-xs text-gray-500">{{ $res->pengguna->email ?? '-' }}</div>
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-gray-900">{{ $res->lapangan->nama_lapangan }}</div>
                                <div class="text-sm text-green-600 font-semibold">{{ \Carbon\Carbon::parse($res->tanggal_booking)->format('d/m/Y') }}</div>
                                <div class="text-xs text-gray-500">{{ date('H:i', strtotime($res->jam_mulai)) }} - {{ date('H:i', strtotime($res->jam_selesai)) }}</div>
                            </td>
                            <td class="p-4">
                                <div class="font-bold text-gray-900">Rp {{ number_format($res->total_biaya, 0, ',', '.') }}</div>
                                @if($res->pembayaran)
                                    <div class="text-xs text-gray-500 font-semibold mt-1">Via {{ $res->pembayaran->metode_pembayaran }}</div>
                                @endif
                            </td>
                            <td class="p-4">
                                @if($res->status_reservasi == 'pending')
                                    @if($res->pembayaran)
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-blue-100 text-blue-800">Menunggu Konfirmasi</span>
                                    @else
                                        <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-yellow-100 text-yellow-800">Belum Bayar</span>
                                    @endif
                                @elseif($res->status_reservasi == 'dikonfirmasi')
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-800">Lunas</span>
                                @else
                                    <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-800">Dibatalkan</span>
                                @endif
                            </td>
                            <td class="p-4 flex items-center justify-center gap-2">
                                @if($res->status_reservasi == 'pending' && $res->pembayaran)
                                    <!-- Tombol Lihat Bukti Bayar -->
                                    <a href="{{ asset('storage/' . $res->pembayaran->bukti_pembayaran) }}" target="_blank" class="p-2 bg-blue-50 text-blue-600 hover:bg-blue-100 rounded-lg transition-colors" title="Lihat Bukti Transfer">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                                    </a>
                                    
                                    <!-- Form Konfirmasi -->
                                    <form action="{{ route('admin.reservasi.konfirmasi', $res->id_reservasi) }}" method="POST" onsubmit="return confirm('Yakin validasi pembayaran ini?');">
                                        @csrf
                                        <button type="submit" class="p-2 bg-green-500 text-white hover:bg-green-600 rounded-lg transition-colors shadow-sm" title="Konfirmasi Lunas">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        </button>
                                    </form>

                                    <!-- Form Tolak -->
                                    <form action="{{ route('admin.reservasi.tolak', $res->id_reservasi) }}" method="POST" onsubmit="return confirm('Yakin tolak dan batalkan pesanan ini?');">
                                        @csrf
                                        <button type="submit" class="p-2 bg-red-50 text-red-600 hover:bg-red-100 border border-red-200 rounded-lg transition-colors" title="Tolak & Batalkan">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                        </button>
                                    </form>
                                @else
                                    <span class="text-xs text-gray-400 font-medium italic">Tidak ada aksi</span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="p-8 text-center text-gray-500 font-medium">Belum ada pesanan dalam kategori ini.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if($reservasis->hasPages())
                <div class="p-4 border-t border-gray-100">
                    {{ $reservasis->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
@endsection
