@extends ('layouts.sidebar')

@section('content')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out lg:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">
        @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Berhasil!</span> {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Gagal!</span>
            <ul class="mt-1 list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-full lg:flex-none">
                <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0 flex justify-between items-center">
                        <div>
                            <h6 class="capitalize dark:text-white font-bold">Data Pembayaran</h6>
                            <p class="text-sm leading-normal dark:text-white dark:opacity-60">Daftar transaksi dan verifikasi transfer</p>
                        </div>
                        <div class="flex items-center gap-2 mt-4 md:mt-0">
                            <form action="{{ route('admin.pembayaran.index') }}" method="GET" class="flex items-center gap-2">
                                <select name="status" class="text-sm border-gray-300 rounded-lg shadow-sm focus:border-emerald-500 focus:ring-emerald-500 dark:bg-slate-700 dark:border-slate-600 dark:text-white cursor-pointer px-3 py-2 outline-none transition-all" onchange="this.form.submit()">
                                    <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                    <option value="DP" {{ request('status') == 'DP' ? 'selected' : '' }}>💵 DP</option>
                                    <option value="lunas" {{ request('status') == 'lunas' ? 'selected' : '' }}>✅ Lunas</option>
                                    <option value="gagal" {{ request('status') == 'gagal' ? 'selected' : '' }}>❌ Ditolak/Gagal</option>
                                </select>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                        <i class="fas fa-search text-sm"></i>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari Res/User..." class="pl-9 text-sm border border-slate-300 rounded-lg px-3 py-2 w-full max-w-[200px] outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all dark:bg-slate-700 dark:border-slate-600 dark:text-white dark:placeholder-slate-400 shadow-sm">
                                </div>
                                <button type="submit" class="hidden"></button>
                            </form>
                        </div>
                    </div>
                    
                    <div class="flex-auto p-4 px-0 pb-2">
                        <div class="overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                <thead class="align-bottom bg-slate-50 dark:bg-slate-800">
                                    <tr>
                                        <th class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-500">No</th>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-500">Transaksi</th>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-500">Nominal & Metode</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-500">Status</th>
                                        @if(auth()->check() && auth()->user()->role == 'owner')
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-500">Bukti Pembayaran</th>
                                        @else
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs tracking-none whitespace-nowrap text-slate-500">Verifikasi (1-Klik)</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($pembayarans as $p)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                        <td class="p-4 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">{{ ($pembayarans->currentPage() - 1) * $pembayarans->perPage() + $loop->iteration }}</span>
                                        </td>
                                        <td class="p-4 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                            <div class="flex flex-col">
                                                <h6 class="mb-0 text-sm font-bold leading-normal text-slate-700 dark:text-white">{{ $p->reservasi->user->name ?? 'Guest' }}</h6>
                                                <p class="mb-0 text-xs leading-tight text-slate-400">Res: {{ $p->id_reservasi }}</p>
                                                <p class="mb-0 text-xs leading-tight text-slate-400">Pay: {{ $p->id_pembayaran }}</p>
                                            </div>
                                        </td>
                                        <td class="p-4 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                            <p class="mb-0 text-sm font-bold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($p->jumlah_bayar, 0, ',', '.') }}</p>
                                            <div class="flex items-center gap-1 mt-1">
                                                @if(strtolower($p->metode_pembayaran) == 'transfer')
                                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase rounded bg-blue-100 text-blue-700">TRANSFER</span>
                                                @else
                                                    <span class="px-2 py-0.5 text-[10px] font-bold uppercase rounded bg-teal-100 text-teal-700">CASH/TUNAI</span>
                                                @endif
                                                <span class="text-xs text-slate-400">{{ \Carbon\Carbon::parse($p->tanggal_bayar)->format('d M Y, H:i') }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                            @php
                                                $statusConfig = match($p->status_pembayaran) {
                                                    'pending' => ['color' => 'bg-amber-100 text-amber-700 border-amber-200', 'icon' => '⏳', 'text' => 'Menunggu Verifikasi'],
                                                    'sukses', 'lunas' => ['color' => 'bg-emerald-100 text-emerald-700 border-emerald-200', 'icon' => '✅', 'text' => 'Lunas'],
                                                    'gagal' => ['color' => 'bg-rose-100 text-rose-700 border-rose-200', 'icon' => '❌', 'text' => 'Ditolak/Gagal'],
                                                    default => ['color' => 'bg-slate-100 text-slate-700 border-slate-200', 'icon' => '❔', 'text' => $p->status_pembayaran],
                                                };
                                            @endphp
                                            <div class="inline-flex items-center gap-1.5 px-3 py-1.5 rounded-full border {{ $statusConfig['color'] }} text-xs font-bold shadow-sm">
                                                <span>{{ $statusConfig['icon'] }}</span>
                                                <span>{{ $statusConfig['text'] }}</span>
                                            </div>
                                        </td>
                                        <td class="p-4 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap">
                                            <div class="flex flex-col gap-2 items-center min-w-[140px]">
                                                @if($p->bukti_pembayaran && $p->bukti_pembayaran !== 'offline_payment')
                                                    <a href="{{ asset('storage/' . $p->bukti_pembayaran) }}" target="_blank" style="display: block; width: 100%; text-align: center; background-color: #eff6ff; color: #2563eb; border: 1px solid #bfdbfe; padding: 8px 12px; border-radius: 6px; font-weight: bold; text-decoration: none; font-size: 12px; margin-bottom: 8px;">
                                                        <i class="fas fa-search-plus mr-1"></i> Cek Bukti
                                                    </a>
                                                @else
                                                    @if(auth()->check() && auth()->user()->role == 'owner')
                                                        <span style="display: block; width: 100%; text-align: center; background-color: #f1f5f9; color: #64748b; border: 1px solid #e2e8f0; padding: 8px 12px; border-radius: 6px; font-weight: bold; font-size: 11px;">Tidak ada bukti (bayar di kasir)</span>
                                                    @endif
                                                @endif

                                                @if(auth()->check() && auth()->user()->role != 'owner')
                                                <div class="w-full mb-2 border-b border-slate-200 pb-2 dark:border-slate-700">
                                                    <form action="{{ route('admin.pembayaran.verifikasi', $p->id_pembayaran) }}" method="POST" class="flex flex-col gap-1 w-full">
                                                        @csrf
                                                        @method('PUT')
                                                        <p class="text-[10px] font-bold text-slate-400 uppercase text-left mb-0">Aksi Pembayaran:</p>
                                                        <div class="flex gap-1">
                                                            <select name="status_pembayaran" class="w-full text-xs font-semibold text-slate-700 border border-slate-300 rounded-md px-2 py-1 dark:bg-slate-700 dark:border-slate-600 dark:text-white outline-none">
                                                                <option value="pending" {{ $p->status_pembayaran == 'pending' ? 'selected' : '' }}>⏳ Pending</option>
                                                                <option value="DP" {{ $p->status_pembayaran == 'DP' ? 'selected' : '' }}>💵 Uang Muka (DP)</option>
                                                                <option value="lunas" {{ $p->status_pembayaran == 'lunas' ? 'selected' : '' }}>✅ Lunas</option>
                                                            </select>
                                                            <button type="submit" class="bg-emerald-500 hover:bg-emerald-600 text-white rounded-md px-2.5 py-1 shadow-sm transition-colors" title="Simpan Status Pembayaran">
                                                                <i class="fas fa-save text-xs"></i>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    
                                                    @if($p->status_pembayaran != 'lunas')
                                                    <form action="{{ route('admin.pembayaran.verifikasi', $p->id_pembayaran) }}" method="POST" class="mt-2 w-full" onsubmit="return confirm('Tolak pembayaran dan hapus data mutasi ini agar pelanggan bisa upload ulang?');">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="status_pembayaran" value="gagal">
                                                        <button type="submit" class="w-full px-2 py-1 text-xs font-bold text-red-500 bg-red-50 border border-red-200 rounded hover:bg-red-100 transition-all text-center" title="Tolak & Hapus Bukti">
                                                            <i class="fas fa-trash-alt mr-1"></i> Tolak (Hapus)
                                                        </button>
                                                    </form>
                                                    @endif
                                                </div>
                                                @endif
                                                
                                                <!-- Aksi Lapangan dihapus karena akan diotomatisasi -->
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                    @if($pembayarans->isEmpty())
                                    <tr>
                                        <td colspan="4" class="p-8 text-center text-sm text-gray-500">Belum ada data pembayaran.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        @if($pembayarans->hasPages())
                        <div class="px-6 py-4 border-t border-slate-200 dark:border-white/40">
                            {{ $pembayarans->links('pagination::tailwind') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection