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

    return view('home', compact('lapangans', 'beritas', 'promos'));
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

use App\Http\Controllers\AdminController;

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    // Route::get('/reservasi', [AdminController::class, 'index'])->name('reservasi.index');
    // Route::post('/reservasi/{id}/konfirmasi', [AdminController::class, 'konfirmasi'])->name('reservasi.konfirmasi');
    // Route::post('/reservasi/{id}/tolak', [AdminController::class, 'tolak'])->name('reservasi.tolak');
});
