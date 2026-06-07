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
    return view('home');
})->name('home');

Route::get('/lapangan/{id}', function ($id) {
    return view('lapangan.detail_lapangan', compact('id'));
})->name('lapangan.detail');

Route::get('/registrasi', function () {
    return view('auth.register');
})->name('register');
Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
})->name('dashboard');

route::get('/reservasi', function () {
    return view('dashboard.reservasi.index');
})->name('reservasi.index');
route::get('/pembayaran', function () {
    return view('dashboard.pembayaran.index');
})->name('pembayaran.index');
route::get('/pelanggan', function () {
    return view('dashboard.pelanggan.index');
})->name('pelanggan.index');
route::get('/pelatih', function () {
    return view('dashboard.pelatih.index');
})->name('pelatih.index');
route::get('/lapangan', function () {       
    return view('dashboard.lapangan.index');
})->name('lapangan.index');     
