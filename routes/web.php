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
    return view('home', compact('lapangans'));
})->name('home');

use App\Http\Controllers\ReservasiController;
use App\Http\Controllers\PembayaranController;

Route::get('/lapangan/{id}', function ($id) {
    $lapangan = \App\Models\Lapangan::findOrFail($id);
    return view('lapangan.detail_lapangan', compact('lapangan', 'id'));
})->name('lapangan.detail');

Route::get('/lapangan/{id}/booking', [ReservasiController::class, 'create'])->name('reservasi.create')->middleware('auth');
Route::post('/lapangan/{id}/booking', [ReservasiController::class, 'store'])->name('reservasi.store')->middleware('auth');

Route::get('/pembayaran/{id_reservasi}', [PembayaranController::class, 'create'])->name('pembayaran.create')->middleware('auth');
Route::post('/pembayaran/{id_reservasi}', [PembayaranController::class, 'store'])->name('pembayaran.store')->middleware('auth');

Route::get('/pesanan-saya', [ReservasiController::class, 'riwayat'])->name('reservasi.riwayat')->middleware('auth');


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
