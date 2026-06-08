<?php

use Illuminate\Support\Facades\Route;

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
Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

Route::get('/reservasi-admin', function () {
    return view('dashboard.reservasi.index');
})->name('admin.reservasi.index');

Route::get('/pembayaran-admin', function () {
    return view('dashboard.pembayaran.index');
})->name('admin.pembayaran.index');

Route::get('/pelanggan', function () {
    return view('dashboard.pelanggan.index');
})->name('pelanggan.index');

Route::get('/pelatih-admin', function () {
    return view('dashboard.pelatih.index');
})->name('admin.pelatih.index');

// Route::get('/lapangan-admin', function () {       
//     return view('dashboard.lapangan.index');
// })->name('admin.lapangan.index');



use App\Http\Controllers\LapanganController;

Route::prefix('admin')->group(function () {
    Route::get('/lapangan', [LapanganController::class, 'index'])
        ->name('admin.lapangan.index');

    Route::get('/lapangan/create', [LapanganController::class, 'create'])
        ->name('admin.lapangan.create');

    Route::post('/lapangan', [LapanganController::class, 'store'])
        ->name('admin.lapangan.store');

    Route::get('/lapangan/{id}/edit', [LapanganController::class, 'edit'])
        ->name('admin.lapangan.edit');

    Route::put('/lapangan/{id}', [LapanganController::class, 'update'])
        ->name('admin.lapangan.update');
    Route::delete('/lapangan/{id}', [LapanganController::class, 'destroy'])
        ->name('admin.lapangan.destroy');
});
