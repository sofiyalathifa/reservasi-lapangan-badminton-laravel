@extends ('layouts.sidebar')

@section('content')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out lg:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">
        @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50 dark:bg-gray-800 dark:text-green-400" role="alert">
            <span class="font-medium">Berhasil!</span> {{ session('success') }}
        </div>
        @endif
        
        @if(session('error'))
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">
            <span class="font-medium">Gagal!</span> {{ session('error') }}
        </div>
        @endif

        <div class="flex flex-wrap -mx-3">
            <div class="w-full max-w-full px-3 mt-0 mb-6 lg:mb-0 lg:w-full lg:flex-none">
                <div class="border-black/12.5 dark:bg-slate-850 dark:shadow-dark-xl shadow-xl relative z-20 flex min-w-0 flex-col break-words rounded-2xl border-0 border-solid bg-white bg-clip-border">
                    <div class="border-black/12.5 mb-0 rounded-t-2xl border-b-0 border-solid p-6 pt-4 pb-0 flex flex-col md:flex-row justify-between items-start md:items-center gap-4">
                        <div>
                            <h6 class="capitalize dark:text-white font-bold">Data Reservasi</h6>
                            <p class="text-sm leading-normal dark:text-white dark:opacity-60">Daftar pesanan dari pelanggan</p>
                        </div>
                        <div class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                            <form method="GET" action="{{ route('admin.reservasi.index') }}" class="flex flex-col md:flex-row gap-3 w-full md:w-auto">
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                        <i class="fas fa-search text-xs"></i>
                                    </div>
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau ID..." class="pl-9 pr-3 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none dark:bg-slate-800 dark:border-slate-600 dark:text-white transition-all w-full md:w-48">
                                </div>
                                <div class="relative">
                                    <select name="status" onchange="this.form.submit()" class="appearance-none pl-3 pr-8 py-2 bg-slate-50 border border-slate-200 text-slate-700 text-xs font-semibold rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none dark:bg-slate-800 dark:border-slate-600 dark:text-white cursor-pointer transition-all w-full md:w-auto">
                                        <option value="semua" {{ request('status') == 'semua' ? 'selected' : '' }}>Semua Status</option>
                                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>⏳ Menunggu</option>
                                        <option value="dikonfirmasi" {{ request('status') == 'dikonfirmasi' ? 'selected' : '' }}>✅ Konfirmasi</option>
                                        <option value="selesai" {{ request('status') == 'selesai' ? 'selected' : '' }}>🏁 Selesai</option>
                                        <option value="dibatalkan" {{ request('status') == 'dibatalkan' ? 'selected' : '' }}>❌ Batal</option>
                                    </select>
                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2.5 text-slate-400">
                                        <i class="fas fa-chevron-down text-xxs"></i>
                                    </div>
                                </div>
                                @if(request('search') || (request('status') && request('status') !== 'semua'))
                                    <a href="{{ route('admin.reservasi.index') }}" class="px-3 py-2 text-xs font-bold text-slate-500 bg-white border border-slate-200 rounded-lg hover:bg-slate-50 transition-colors dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600 dark:hover:bg-slate-700 flex items-center justify-center" title="Reset Filter">
                                        <i class="fas fa-undo"></i>
                                    </a>
                                @endif
                                <!-- Tombol hidden untuk submit search dari input text ketika di-enter -->
                                <button type="submit" class="hidden"></button>
                            </form>
                                @if(auth()->check() && auth()->user()->role != 'owner')
                                <button onclick="document.getElementById('modal-booking-offline').classList.remove('hidden')" class="bg-gradient-to-tl from-emerald-500 to-teal-400 text-white font-bold text-xs px-4 py-2 rounded-lg shadow-md hover:shadow-lg transition-all whitespace-nowrap">
                                    <i class="fas fa-plus mr-1"></i> Booking Offline
                                </button>
                                @endif
                            </div>
                    </div>

                    <!-- Modal Booking Offline -->
                    <div id="modal-booking-offline" class="fixed inset-0 z-[9999] hidden overflow-y-auto bg-slate-900/60 backdrop-blur-sm transition-all duration-300">
                        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:p-0">
                            <div class="relative bg-white rounded-3xl text-left overflow-hidden shadow-2xl transform transition-all sm:my-8 sm:max-w-xl w-full dark:bg-slate-850 border border-slate-100 dark:border-slate-700">
                                <!-- Header -->
                                <div class="bg-gradient-to-r from-slate-50 to-white dark:from-slate-800 dark:to-slate-850 px-6 py-5 border-b border-slate-100 dark:border-slate-700 flex justify-between items-center">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-emerald-100 dark:bg-emerald-500/20 flex items-center justify-center text-emerald-600 dark:text-emerald-400 shadow-inner">
                                            <i class="fas fa-calendar-plus text-xl"></i>
                                        </div>
                                        <div>
                                            <h3 class="text-lg font-extrabold text-slate-800 dark:text-white tracking-tight" id="modal-title">Booking Offline</h3>
                                            <p class="text-xs font-semibold text-slate-500 dark:text-slate-400 m-0">Tambah reservasi langsung (On The Spot)</p>
                                        </div>
                                    </div>
                                    <button type="button" onclick="document.getElementById('modal-booking-offline').classList.add('hidden')" class="w-8 h-8 flex items-center justify-center text-slate-400 bg-slate-100 hover:bg-slate-200 hover:text-slate-600 rounded-full transition-colors dark:bg-slate-700 dark:hover:bg-slate-600 dark:text-slate-300">
                                        <i class="fas fa-times text-sm"></i>
                                    </button>
                                </div>
                                
                                <!-- Body -->
                                <div class="px-6 py-6">
                                    <form action="{{ route('admin.reservasi.offline') }}" method="POST" onsubmit="return validateBookingAdmin(this);">
                                        @csrf
                                        <div class="space-y-5">
                                            <!-- Pelanggan -->
                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide mb-2">Nama Pelanggan (Guest)</label>
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                                        <i class="fas fa-user text-sm"></i>
                                                    </div>
                                                    <input type="text" name="nama_pelanggan" required placeholder="Ketik nama pelanggan yang datang..." class="pl-10 w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm font-medium rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 block p-3 transition-all dark:bg-slate-800 dark:border-slate-600 dark:placeholder-slate-500 dark:text-white outline-none">
                                                </div>
                                            </div>

                                            <!-- Nomor Telepon -->
                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide mb-2">Nomor Telepon / WhatsApp</label>
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                                        <i class="fas fa-phone text-sm"></i>
                                                    </div>
                                                    <input type="text" name="nomor_telepon" placeholder="Contoh: 08123456789 (Opsional)" class="pl-10 w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm font-medium rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 block p-3 transition-all dark:bg-slate-800 dark:border-slate-600 dark:placeholder-slate-500 dark:text-white outline-none">
                                                </div>
                                            </div>

                                            <!-- Lapangan -->
                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide mb-2">Pilih Lapangan</label>
                                                <div class="relative">
                                                    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                                        <i class="fas fa-map-marker-alt text-sm"></i>
                                                    </div>
                                                    <select name="id_lapangan" required class="appearance-none pl-10 w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm font-bold rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 block p-3 cursor-pointer transition-all dark:bg-slate-800 dark:border-slate-600 dark:text-white outline-none">
                                                        @foreach($lapangans as $lap)
                                                            <option value="{{ $lap->id_lapangan }}" data-harga="{{ $lap->harga_per_jam }}">{{ $lap->nama_lapangan }} &nbsp;&mdash;&nbsp; Rp {{ number_format($lap->harga_per_jam, 0, ',', '.') }} / jam</option>
                                                        @endforeach
                                                    </select>
                                                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                                        <i class="fas fa-chevron-down text-xs"></i>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tanggal -->
                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide mb-2">Pilih Tanggal</label>
                                                @php
                                                    $days = ['Sun' => 'MIN', 'Mon' => 'SEN', 'Tue' => 'SEL', 'Wed' => 'RAB', 'Thu' => 'KAM', 'Fri' => 'JUM', 'Sat' => 'SAB'];
                                                @endphp
                                                <div class="flex gap-2 overflow-x-auto pb-2 snap-x hide-scrollbar">
                                                    @for($i = 0; $i < 7; $i++)
                                                        @php
                                                            $date = \Carbon\Carbon::now()->addDays($i);
                                                            $fullDate = $date->format('Y-m-d');
                                                            $dayName = $days[$date->format('D')];
                                                            $dayNum = $date->format('d');
                                                        @endphp
                                                        <label class="relative cursor-pointer snap-start flex-shrink-0">
                                                            <input type="radio" name="tanggal_booking" value="{{ $fullDate }}" onchange="checkRealtimeAdmin()" class="peer sr-only date-radio-admin" {{ $i == 0 ? 'checked' : '' }}>
                                                            <div class="w-16 h-20 rounded-xl border-2 border-slate-200 bg-white flex flex-col items-center justify-center gap-1 transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300 dark:bg-slate-800 dark:border-slate-700 dark:peer-checked:bg-emerald-900/30">
                                                                <span class="text-xs font-extrabold text-slate-500 peer-checked:text-emerald-600 dark:peer-checked:text-emerald-400">{{ $dayName }}</span>
                                                                <span class="text-xl font-black text-slate-800 peer-checked:text-emerald-600 dark:text-white dark:peer-checked:text-emerald-400">{{ $dayNum }}</span>
                                                            </div>
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <!-- Waktu -->
                                            <div>
                                                <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide mb-2">Pilih Waktu</label>
                                                <div class="grid grid-cols-4 sm:grid-cols-5 gap-2" id="admin-time-container">
                                                    @for($h = 7; $h <= 22; $h++)
                                                        @php
                                                            $timeStr = sprintf('%02d:00', $h);
                                                        @endphp
                                                        <label class="relative cursor-pointer time-label-admin">
                                                            <input type="radio" name="jam_mulai" value="{{ $timeStr }}" class="peer sr-only time-radio-admin">
                                                            <div class="time-card-admin px-2 py-2.5 rounded-lg border-2 border-slate-200 bg-white text-center transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300 dark:bg-slate-800 dark:border-slate-700 dark:peer-checked:bg-emerald-900/30">
                                                                <span class="text-sm font-black text-slate-700 peer-checked:text-emerald-600 dark:text-slate-300 dark:peer-checked:text-emerald-400 time-text-admin">{{ $timeStr }}</span>
                                                            </div>
                                                        </label>
                                                    @endfor
                                                </div>
                                            </div>

                                            <!-- Durasi & Harga -->
                                            <div class="grid grid-cols-2 gap-5 mt-2">
                                                <div>
                                                    <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wide mb-2">Durasi Main</label>
                                                    <div class="relative">
                                                        <select name="durasi" id="input-durasi" class="appearance-none w-full bg-slate-50 border border-slate-200 text-slate-800 text-sm font-bold rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 block p-3 cursor-pointer transition-all dark:bg-slate-800 dark:border-slate-600 dark:text-white outline-none">
                                                            <option value="1">1 Jam</option>
                                                            <option value="2">2 Jam</option>
                                                            <option value="3">3 Jam</option>
                                                            <option value="4">4 Jam</option>
                                                        </select>
                                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-slate-400">
                                                            <i class="fas fa-chevron-down text-xs"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div>
                                                    <label class="block text-xs font-bold text-emerald-600 dark:text-emerald-400 uppercase tracking-wide mb-2">Total Biaya Lunas</label>
                                                    <div class="relative">
                                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-emerald-600 dark:text-emerald-400 font-extrabold text-sm">Rp</div>
                                                        <input type="text" id="display-total" readonly placeholder="0" class="pl-10 w-full bg-emerald-50 border border-emerald-200 text-emerald-800 text-sm font-extrabold rounded-xl block p-3 transition-all dark:bg-emerald-900/30 dark:border-emerald-500/50 dark:text-emerald-300 outline-none shadow-inner cursor-not-allowed">
                                                        <input type="hidden" name="total_biaya" id="input-total">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <!-- Footer -->
                                        <div class="mt-8 pt-5 border-t border-slate-100 dark:border-slate-700 flex justify-end gap-3">
                                            <button type="button" onclick="document.getElementById('modal-booking-offline').classList.add('hidden')" class="px-5 py-2.5 text-sm font-bold text-slate-600 bg-white border border-slate-200 rounded-xl hover:bg-slate-50 transition-colors dark:bg-slate-800 dark:text-slate-300 dark:border-slate-600 dark:hover:bg-slate-700 shadow-sm">Batal</button>
                                            <button type="submit" class="px-6 py-2.5 text-sm font-bold text-white bg-gradient-to-r from-emerald-500 to-teal-500 border border-transparent rounded-xl hover:from-emerald-600 hover:to-teal-600 shadow-md hover:shadow-lg hover:shadow-emerald-500/30 focus:ring-4 focus:ring-emerald-500/30 transition-all transform hover:-translate-y-0.5">
                                                <i class="fas fa-check-circle mr-1.5"></i> Simpan Reservasi
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Error Waktu -->
                    <div id="modal-error-waktu" class="fixed inset-0 hidden items-center justify-center transition-opacity duration-300 opacity-0" style="z-index: 999999; background-color: rgba(15, 23, 42, 0.6); backdrop-filter: blur(4px);">
                        <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-sm w-full mx-4 transform scale-95 transition-transform duration-300 border border-red-100 text-center">
                            <div class="w-16 h-16 rounded-full mx-auto flex items-center justify-center mb-4" style="background-color: #fee2e2; color: #ef4444;">
                                <i class="fas fa-exclamation-triangle text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-slate-800 mb-2">Pilih Waktu</h3>
                            <p class="text-sm text-slate-500 mb-6" id="error-waktu-msg">Silakan pilih jam yang tersedia terlebih dahulu!</p>
                            <button type="button" onclick="closeErrorModal()" class="w-full py-3 text-white rounded-xl font-bold shadow-md transition-all" style="background-color: #ef4444;">
                                Mengerti
                            </button>
                        </div>
                    </div>
                    
                    <div class="flex-auto p-4 px-0 pb-2">
                        <div class="overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse dark:border-white/40 text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-4 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">No</th>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Pelanggan</th>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Lapangan & Jadwal</th>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Total Biaya</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none dark:border-white/40 dark:text-white text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($reservasis as $r)
                                    <tr>
                                        <td class="p-2 text-center align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <span class="text-xs font-semibold text-slate-500 dark:text-slate-400">{{ ($reservasis->currentPage() - 1) * $reservasis->perPage() + $loop->iteration }}</span>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal dark:text-white">{{ $r->user->name ?? 'Guest' }}</h6>
                                                    <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ $r->id_reservasi }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80">{{ $r->lapangan->nama_lapangan ?? 'N/A' }}</p>
                                            <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ \Carbon\Carbon::parse($r->tanggal_booking)->format('d M Y') }} • {{ \Carbon\Carbon::parse($r->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($r->jam_selesai)->format('H:i') }}</p>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-sm font-semibold leading-tight dark:text-white dark:opacity-80">Rp {{ number_format($r->total_biaya, 0, ',', '.') }}</p>
                                            @if($r->pembayaran)
                                                <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">{{ strtoupper($r->pembayaran->metode_pembayaran) }}</p>
                                            @else
                                                <p class="mb-0 text-xs leading-tight dark:text-white dark:opacity-80 text-slate-400">Belum ada info bayar</p>
                                            @endif
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b dark:border-white/40 shadow-transparent">
                                            <form action="{{ route('admin.reservasi.status', $r->id_reservasi) }}" method="POST" class="flex flex-col gap-2 min-w-[180px]">
                                                @csrf
                                                @method('PUT')
                                                
                                                @php
                                                    $statusResConfig = match($r->status_reservasi) {
                                                        'pending' => ['color' => 'bg-amber-100 text-amber-700', 'text' => 'Menunggu'],
                                                        'dikonfirmasi' => ['color' => 'bg-blue-100 text-blue-700', 'text' => 'Dikonfirmasi'],
                                                        'selesai' => ['color' => 'bg-emerald-100 text-emerald-700', 'text' => 'Selesai'],
                                                        'dibatalkan' => ['color' => 'bg-rose-100 text-rose-700', 'text' => 'Dibatalkan'],
                                                        default => ['color' => 'bg-slate-100 text-slate-700', 'text' => $r->status_reservasi],
                                                    };
                                                @endphp
                                                <div class="flex flex-col items-center justify-center gap-1.5 w-full">
                                                    <span class="px-3 py-1.5 text-xs font-bold rounded-md w-full text-center {{ $statusResConfig['color'] }}">
                                                        {{ $statusResConfig['text'] }}
                                                    </span>
                                                    
                                                    @if(auth()->check() && auth()->user()->role != 'owner')
                                                        @if($r->status_reservasi == 'pending' && !$r->pembayaran)
                                                            <button type="submit" name="status_reservasi" value="bayar_tunai" class="text-[10px] font-bold px-2 py-1.5 bg-emerald-50 text-emerald-600 border border-emerald-200 rounded hover:bg-emerald-100 transition-colors w-full text-center" onclick="return confirm('Pindahkan pesanan pelanggan ini ke menu Data Pembayaran untuk diproses tunai secara DP/Lunas?')">
                                                                <i class="fas fa-hand-holding-usd mr-1"></i> Proses Tunai
                                                            </button>
                                                            <button type="submit" name="status_reservasi" value="dibatalkan" class="text-[10px] font-bold px-2 py-1.5 bg-red-50 text-red-600 border border-red-200 rounded hover:bg-red-100 transition-colors w-full text-center" onclick="return confirm('Batalkan pesanan yang belum dibayar ini?')">
                                                                <i class="fas fa-times mr-1"></i> Batalkan
                                                            </button>
                                                        @endif
                                                    @endif
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                    
                                    @if($reservasis->isEmpty())
                                    <tr>
                                        <td colspan="4" class="p-4 text-center text-sm text-gray-500">Belum ada data reservasi.</td>
                                    </tr>
                                    @endif
                                </tbody>
                            </table>
                        </div>
                        
                        @if($reservasis->hasPages())
                        <div class="px-6 py-4 border-t border-slate-200 dark:border-white/40">
                            {{ $reservasis->links('pagination::tailwind') }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<style>
.hide-scrollbar::-webkit-scrollbar {
    display: none;
}
.hide-scrollbar {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lapanganSelect = document.querySelector('select[name="id_lapangan"]');
        const durasiSelect = document.getElementById('input-durasi');
        const displayTotal = document.getElementById('display-total');
        const inputTotal = document.getElementById('input-total');

        function calculateTotal() {
            if(!lapanganSelect || !durasiSelect) return;
            const selectedOption = lapanganSelect.options[lapanganSelect.selectedIndex];
            const hargaPerJam = parseInt(selectedOption.getAttribute('data-harga')) || 0;
            const durasi = parseInt(durasiSelect.value) || 1;
            
            const total = hargaPerJam * durasi;
            inputTotal.value = total;
            displayTotal.value = new Intl.NumberFormat('id-ID').format(total);
        }

        // Add event listener to lapangan to recheck booked slots when court changes
        if(lapanganSelect) {
            lapanganSelect.addEventListener('change', function() {
                calculateTotal();
                checkRealtimeAdmin();
            });
        }
        if(durasiSelect) durasiSelect.addEventListener('change', calculateTotal);
        
        // Initial calculation on load
        calculateTotal();

        // Initial check realtime
        checkRealtimeAdmin();
    });

    const bookedSlotsAdmin = JSON.parse('{!! json_encode($bookedSlotsAdmin ?? []) !!}');

    function checkRealtimeAdmin() {
        const selectedDateInput = document.querySelector('input[name="tanggal_booking"]:checked');
        const lapanganSelect = document.querySelector('select[name="id_lapangan"]');
        
        if(!selectedDateInput || !lapanganSelect) return;
        
        const selectedDate = selectedDateInput.value;
        const selectedLapId = lapanganSelect.value;
        
        const now = new Date();
        const todayStr = now.getFullYear() + '-' + String(now.getMonth() + 1).padStart(2, '0') + '-' + String(now.getDate()).padStart(2, '0');
        const isToday = selectedDate === todayStr;
        const currentHourStr = String(now.getHours()).padStart(2, '0') + ':' + String(now.getMinutes()).padStart(2, '0');
        
        // Dapatkan jadwal terbooking untuk lapangan dan tanggal ini
        const bookedForDate = (bookedSlotsAdmin[selectedLapId] && bookedSlotsAdmin[selectedLapId][selectedDate]) 
                              ? bookedSlotsAdmin[selectedLapId][selectedDate] 
                              : [];
        
        const timeRadios = document.querySelectorAll('.time-radio-admin');
        const timeLabels = document.querySelectorAll('.time-label-admin');
        const timeCards = document.querySelectorAll('.time-card-admin');
        const timeTexts = document.querySelectorAll('.time-text-admin');
        
        for (let i = 0; i < timeRadios.length; i++) {
            const radio = timeRadios[i];
            const label = timeLabels[i];
            const card = timeCards[i];
            const text = timeTexts[i];
            
            const timeVal = radio.value;
            const isPassed = isToday && timeVal < currentHourStr;
            const isBooked = bookedForDate.includes(timeVal);
            
            if (isPassed || isBooked) {
                // Disable and gray out
                radio.disabled = true;
                if (radio.checked) radio.checked = false; // Uncheck if passed or booked
                
                label.classList.remove('cursor-pointer');
                label.classList.add('cursor-not-allowed', 'opacity-50');
                
                // Styling form disabled state
                if (isBooked) {
                    card.className = "time-card-admin px-2 py-2.5 rounded-lg border-2 border-red-200 bg-red-50 text-center dark:bg-red-900/30 dark:border-red-800/50";
                    text.className = "text-sm font-black text-red-400 dark:text-red-500 time-text-admin";
                    label.title = "Sudah Dipesan";
                } else {
                    card.className = "time-card-admin px-2 py-2.5 rounded-lg border-2 border-slate-200 bg-slate-100 text-center dark:bg-slate-800 dark:border-slate-700";
                    text.className = "text-sm font-black text-slate-400 dark:text-slate-500 time-text-admin";
                    label.title = "Waktu Terlewat";
                }
            } else {
                // Re-enable
                radio.disabled = false;
                label.classList.add('cursor-pointer');
                label.classList.remove('cursor-not-allowed', 'opacity-50');
                
                // Restore original classes for active
                card.className = "time-card-admin px-2 py-2.5 rounded-lg border-2 border-slate-200 bg-white text-center transition-all peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-emerald-300 dark:bg-slate-800 dark:border-slate-700 dark:peer-checked:bg-emerald-900/30";
                text.className = "text-sm font-black text-slate-700 peer-checked:text-emerald-600 dark:text-slate-300 dark:peer-checked:text-emerald-400 time-text-admin";
                
                label.title = "";
            }
        }
    }

    function validateBookingAdmin(form) {
        const selectedTime = form.querySelector('input[name="jam_mulai"]:checked');
        if (!selectedTime || selectedTime.disabled) {
            showErrorModal("Silakan pilih jam yang tersedia terlebih dahulu sebelum menyimpan reservasi.");
            return false;
        }
        
        const btn = form.querySelector('button[type=submit]');
        btn.disabled = true;
        btn.classList.add('opacity-70', 'cursor-not-allowed');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1.5"></i> Menyimpan...';
        return true;
    }

    function showErrorModal(message) {
        document.getElementById('error-waktu-msg').innerText = message;
        const modal = document.getElementById('modal-error-waktu');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        // Timeout for fade-in effect
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('div').classList.remove('scale-95');
        }, 10);
    }

    function closeErrorModal() {
        const modal = document.getElementById('modal-error-waktu');
        modal.classList.add('opacity-0');
        modal.querySelector('div').classList.add('scale-95');
        
        // Wait for transition before hiding
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }
</script>
@endsection