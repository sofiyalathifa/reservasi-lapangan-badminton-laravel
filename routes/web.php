<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $lapangans = \App\Models\Lapangan::all();
    $beritas = \App\Models\Berita::latest('tanggal_publikasi')->take(6)->get();

    // Hanya tampilkan promo aktif, kuota masih ada, dan belum kadaluarsa
    $promos = \App\Models\Promo::where('status', true)->get()->filter(function ($promo) {
        if ($promo->tanggal_berakhir && $promo->tanggal_berakhir->isPast()) return false;
        if ($promo->kuota_total !== null && $promo->kuota_total <= 0) return false;
        return true;
    });

    $partners = \App\Models\CariTeman::with('user')->where('status', true)->latest()->take(3)->get();
    $pelatihs = \App\Models\Pelatih::where('status_aktif', true)->get();

    return view('home', compact('lapangans', 'beritas', 'promos', 'partners', 'pelatihs'));
})->name('home');

use App\Http\Controllers\BeritaController;

Route::get('/berita/{slug}', [BeritaController::class, 'show'])->name('berita.show');

use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;

Route::get('/lapangan/{id}', function ($id) {
    $lapangan = \App\Models\Lapangan::findOrFail($id);
    return view('lapangan.detail_lapangan', compact('lapangan', 'id'));
})->name('lapangan.detail');

Route::get('/lapangan/{id}/booking', [ReservasiController::class, 'create'])->name('reservasi.create')->middleware('auth');
Route::post('/lapangan/{id}/booking', [ReservasiController::class, 'store'])->name('reservasi.store')->middleware('auth');
Route::post('/reservasi/{id}/ulasan', [ReservasiController::class, 'storeUlasan'])->name('reservasi.ulasan')->middleware('auth');

Route::get('/pembayaran/{id_reservasi}', [PembayaranController::class, 'create'])->name('pembayaran.create')->middleware('auth');
Route::post('/pembayaran/{id_reservasi}', [PembayaranController::class, 'store'])->name('pembayaran.store')->middleware('auth');

Route::get('/pesanan-saya', [ReservasiController::class, 'riwayat'])->name('reservasi.riwayat')->middleware('auth');
Route::post('/reservasi/{id}/batal', [ReservasiController::class, 'batal'])->name('reservasi.batal')->middleware('auth');


use App\Http\Controllers\Auth\RegisterController;

Route::get('/registrasi', function () {
    return view('auth.register');
})->name('register');

Route::post('/registrasi', [RegisterController::class, 'store'])->name('register.store');

use App\Http\Controllers\Auth\LoginController;

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

use App\Http\Controllers\CariTemanController;
use App\Http\Controllers\KomunikasiController;

Route::middleware('auth')->group(function () {
    // Komunitas / Teman Main
    Route::get('/komunitas', [CariTemanController::class, 'index'])->name('komunitas.index');
    Route::post('/komunitas/post', [CariTemanController::class, 'store'])->name('komunitas.post');
    Route::post('/komunitas/close/{id}', [CariTemanController::class, 'close'])->name('komunitas.close');

    // Ajak Main
    Route::post('/komunitas/ajak/{id_cari_teman}', [KomunikasiController::class, 'kirimUndangan'])->name('komunitas.ajak');
    Route::post('/komunitas/respon/{id_ajak_main}', [KomunikasiController::class, 'responUndangan'])->name('komunitas.respon');

    // Chat
    Route::get('/komunitas/chat', [KomunikasiController::class, 'indexChat'])->name('komunitas.chat.index');
    Route::get('/komunitas/chat/{id_ajak_main}', [KomunikasiController::class, 'ruangChat'])->name('komunitas.chat.room');
    Route::post('/komunitas/chat/{id_ajak_main}', [KomunikasiController::class, 'kirimPesan'])->name('komunitas.chat.send');
    Route::get('/komunitas/chat/{id_ajak_main}/messages', [KomunikasiController::class, 'getMessages'])->name('komunitas.chat.messages');
});

use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/reservasi', [AdminController::class, 'index'])->name('reservasi.index');
    // Route::post('/reservasi/{id}/konfirmasi', [AdminController::class, 'konfirmasi'])->name('reservasi.konfirmasi');
    // Route::post('/reservasi/{id}/tolak', [AdminController::class, 'tolak'])->name('reservasi.tolak');
});

// Admin Dashboard Routes (from hafida/admin/dashboard)
Route::middleware(['auth', 'role:admin,kasir,owner'])->group(function () {
    Route::get('/dashboard', function () {
        $today = \Carbon\Carbon::today();
        $yesterday = \Carbon\Carbon::yesterday();
        $thisMonth = \Carbon\Carbon::now()->startOfMonth();
        $lastMonth = \Carbon\Carbon::now()->subMonth()->startOfMonth();

        // 1. Pendapatan Hari Ini
        $pendapatanHariIni = \App\Models\Pembayaran::whereIn('status_pembayaran', ['lunas', 'DP'])
            ->whereDate('tanggal_bayar', $today)
            ->sum('jumlah_bayar');

        $pendapatanKemarin = \App\Models\Pembayaran::whereIn('status_pembayaran', ['lunas', 'DP'])
            ->whereDate('tanggal_bayar', $yesterday)
            ->sum('jumlah_bayar');

        $persenPendapatan = $pendapatanKemarin > 0 ? (($pendapatanHariIni - $pendapatanKemarin) / $pendapatanKemarin) * 100 : ($pendapatanHariIni > 0 ? 100 : 0);

        // 2. Booking Hari Ini
        $bookingHariIni = \App\Models\Reservasi::whereDate('tanggal_booking', $today)
            ->where('status_reservasi', '!=', 'dibatalkan')
            ->count();
            
        $bookingKemarin = \App\Models\Reservasi::whereDate('tanggal_booking', $yesterday)
            ->where('status_reservasi', '!=', 'dibatalkan')
            ->count();

        $persenBooking = $bookingKemarin > 0 ? (($bookingHariIni - $bookingKemarin) / $bookingKemarin) * 100 : ($bookingHariIni > 0 ? 100 : 0);

        // 3. Lapangan Terpakai
        $totalLapangan = \App\Models\Lapangan::count();
        $jamOperasional = 15; // Asumsi 15 jam buka per hari (misal jam 8 pagi - 11 malam)
        $totalSlot = $totalLapangan * $jamOperasional;
        
        $slotTerpakai = \App\Models\Reservasi::whereDate('tanggal_booking', $today)
            ->where('status_reservasi', '!=', 'dibatalkan')
            ->sum('durasi');
            
        $persenLapangan = $totalSlot > 0 ? ($slotTerpakai / $totalSlot) * 100 : 0;

        // 4. Total Transaksi Bulanan
        $transaksiBulanIni = \App\Models\Pembayaran::whereIn('status_pembayaran', ['lunas', 'DP'])
            ->whereBetween('tanggal_bayar', [$thisMonth, \Carbon\Carbon::now()])
            ->sum('jumlah_bayar');

        $transaksiBulanLalu = \App\Models\Pembayaran::whereIn('status_pembayaran', ['lunas', 'DP'])
            ->whereBetween('tanggal_bayar', [$lastMonth, $thisMonth->copy()->subSecond()])
            ->sum('jumlah_bayar');

        $persenTransaksi = $transaksiBulanLalu > 0 ? (($transaksiBulanIni - $transaksiBulanLalu) / $transaksiBulanLalu) * 100 : ($transaksiBulanIni > 0 ? 100 : 0);

        // 5. Data Jadwal Lapangan Real-time
        $lapangans = \App\Models\Lapangan::all();
        $reservasiHariIni = \App\Models\Reservasi::whereDate('tanggal_booking', $today)
            ->where('status_reservasi', '!=', 'dibatalkan')
            ->get();

        $jadwalLapangan = [];
        $startHour = 7; // 07:00
        $endHour = 23;  // 23:00

        foreach ($lapangans as $lapangan) {
            $slots = [];
            for ($i = $startHour; $i < $endHour; $i++) {
                $jamMulai = sprintf('%02d:00', $i);
                $jamMulaiCek = sprintf('%02d:00:00', $i);
                
                $isBooked = $reservasiHariIni->where('id_lapangan', $lapangan->id_lapangan)
                    ->contains(function ($res) use ($jamMulaiCek) {
                        return $res->jam_mulai <= $jamMulaiCek && $res->jam_selesai > $jamMulaiCek;
                    });
                
                $slots[] = [
                    'jam' => $jamMulai,
                    'status' => $isBooked ? 'booked' : 'available'
                ];
            }
            
            $jadwalLapangan[] = [
                'id' => $lapangan->nama_lapangan,
                'slots' => $slots
            ];
        }

        // 6. Data Grafik Pendapatan Perminggu (Senin - Minggu)
        $startOfWeek = \Carbon\Carbon::now()->startOfWeek();
        $endOfWeek = \Carbon\Carbon::now()->endOfWeek();
        
        $startOfLastWeek = \Carbon\Carbon::now()->subWeek()->startOfWeek();
        $endOfLastWeek = \Carbon\Carbon::now()->subWeek()->endOfWeek();

        $pendapatanMingguIni = \App\Models\Pembayaran::whereIn('status_pembayaran', ['lunas', 'DP'])
            ->whereBetween('tanggal_bayar', [$startOfWeek, $endOfWeek])
            ->get();
            
        $pendapatanMingguLalu = \App\Models\Pembayaran::whereIn('status_pembayaran', ['lunas', 'DP'])
            ->whereBetween('tanggal_bayar', [$startOfLastWeek, $endOfLastWeek])
            ->sum('jumlah_bayar');

        $totalMingguIni = $pendapatanMingguIni->sum('jumlah_bayar');
        $persenMingguan = $pendapatanMingguLalu > 0 ? (($totalMingguIni - $pendapatanMingguLalu) / $pendapatanMingguLalu) * 100 : ($totalMingguIni > 0 ? 100 : 0);

        // Group pendapatan minggu ini berdasarkan hari (0 = Senin, 6 = Minggu)
        $chartData = [0, 0, 0, 0, 0, 0, 0];
        foreach ($pendapatanMingguIni as $p) {
            $dayIndex = \Carbon\Carbon::parse($p->tanggal_bayar)->dayOfWeekIso - 1;
            $chartData[$dayIndex] += $p->jumlah_bayar;
        }

        // 7. Ringkasan Lapangan (Status & Ketersediaan)
        $reservasiHariIni->load('pembayaran'); // Pastikan relasi pembayaran diload
        $ringkasanLapangan = [];
        
        foreach ($lapangans as $lapangan) {
            $resLapangan = $reservasiHariIni->where('id_lapangan', $lapangan->id_lapangan);
            
            // Hitung status pembayaran
            $countPending = $resLapangan->filter(function($r) { 
                return !$r->pembayaran || $r->pembayaran->status_pembayaran == 'pending'; 
            })->count();
            
            $countDP = $resLapangan->filter(function($r) { 
                return $r->pembayaran && $r->pembayaran->status_pembayaran == 'DP'; 
            })->count();
            
            $countLunas = $resLapangan->filter(function($r) { 
                return $r->pembayaran && $r->pembayaran->status_pembayaran == 'lunas'; 
            })->count();

            // Hitung slot
            $bookedToday = $resLapangan->sum('durasi');
            $availableToday = $jamOperasional - $bookedToday;
            if ($availableToday < 0) $availableToday = 0;

            $ringkasanLapangan[] = [
                'name' => $lapangan->nama_lapangan,
                'pending' => $countPending,
                'dp' => $countDP,
                'lunas' => $countLunas,
                'booked' => $bookedToday,
                'available' => $availableToday
            ];
        }

        if (auth()->check() && auth()->user()->role === 'owner') {
            return view('dashboard.owner.dashboard');
        }

        return view('dashboard.dashboard', compact(
            'pendapatanHariIni', 'persenPendapatan',
            'bookingHariIni', 'persenBooking',
            'slotTerpakai', 'persenLapangan',
            'transaksiBulanIni', 'persenTransaksi',
            'jadwalLapangan', 'chartData', 'persenMingguan',
            'ringkasanLapangan'
        ));
    })->name('dashboard');
});

Route::middleware(['auth', 'role:admin,kasir,owner'])->group(function () {
    Route::get('/reservasi-admin', [\App\Http\Controllers\AdminReservasiController::class, 'index'])->name('admin.reservasi.index');
    Route::post('/reservasi-admin/offline', [\App\Http\Controllers\AdminReservasiController::class, 'storeOffline'])->name('admin.reservasi.offline');
    Route::put('/reservasi-admin/{id}/status', [\App\Http\Controllers\AdminReservasiController::class, 'updateStatus'])->name('admin.reservasi.status');

    Route::get('/pembayaran-admin', [\App\Http\Controllers\AdminPembayaranController::class, 'index'])->name('admin.pembayaran.index');
    Route::put('/pembayaran-admin/{id}/verifikasi', [\App\Http\Controllers\AdminPembayaranController::class, 'verifikasi'])->name('admin.pembayaran.verifikasi');
});

Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/pelanggan', [\App\Http\Controllers\AdminPelangganController::class, 'index'])->name('pelanggan.index');
    Route::post('/pelanggan', [\App\Http\Controllers\AdminPelangganController::class, 'store'])->name('pelanggan.store');
    Route::put('/pelanggan/{id}', [\App\Http\Controllers\AdminPelangganController::class, 'update'])->name('pelanggan.update');
    Route::delete('/pelanggan/{id}', [\App\Http\Controllers\AdminPelangganController::class, 'destroy'])->name('pelanggan.destroy');

    Route::get('/pelatih-admin', [\App\Http\Controllers\AdminPelatihController::class, 'index'])->name('admin.pelatih.index');
    Route::post('/pelatih-admin', [\App\Http\Controllers\AdminPelatihController::class, 'store'])->name('admin.pelatih.store');
    Route::put('/pelatih-admin/{id}', [\App\Http\Controllers\AdminPelatihController::class, 'update'])->name('admin.pelatih.update');
    Route::delete('/pelatih-admin/{id}', [\App\Http\Controllers\AdminPelatihController::class, 'destroy'])->name('admin.pelatih.destroy');

    Route::get('/lapangan-admin', [\App\Http\Controllers\LapanganController::class, 'index'])->name('admin.lapangan.index');
    Route::get('/lapangan-admin/create', [\App\Http\Controllers\LapanganController::class, 'create'])->name('admin.lapangan.create');
    Route::post('/lapangan-admin', [\App\Http\Controllers\LapanganController::class, 'store'])->name('admin.lapangan.store');
    Route::get('/lapangan-admin/{id}/edit', [\App\Http\Controllers\LapanganController::class, 'edit'])->name('admin.lapangan.edit');
    Route::put('/lapangan-admin/{id}', [\App\Http\Controllers\LapanganController::class, 'update'])->name('admin.lapangan.update');
    Route::delete('/lapangan-admin/{id}', [\App\Http\Controllers\LapanganController::class, 'destroy'])->name('admin.lapangan.destroy');
});

Route::prefix('owner')->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard.owner.dashboard');
    })->name('owner.dashboard');
});
Route::middleware(['auth', 'role:admin,owner'])->group(function () {
    Route::get('/admin/laporan', [LaporanController::class, 'index'])
        ->name('admin.laporan');

    Route::get('/admin/laporan/export', [LaporanController::class, 'exportCsv'])
        ->name('admin.laporan.export');
});
