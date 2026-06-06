<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reservasi;
use App\Models\Pembayaran;
use Illuminate\Support\Str;

class PembayaranController extends Controller
{
    public function create($id_reservasi)
    {
        $reservasi = Reservasi::with('lapangan')->findOrFail($id_reservasi);

        // Hanya boleh diakses oleh pemilik reservasi
        if ($reservasi->id_pengguna !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        return view('pembayaran.create', compact('reservasi'));
    }

    public function store(Request $request, $id_reservasi)
    {
        $reservasi = Reservasi::findOrFail($id_reservasi);

        if ($reservasi->id_pengguna !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'metode_pembayaran' => 'required|in:BCA,Mandiri,BNI,QRIS',
            'bukti_pembayaran' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imagePath = $request->file('bukti_pembayaran')->store('bukti_bayar', 'public');

        $idPembayaran = 'PAY-' . date('Ymd') . '-' . strtoupper(Str::random(4));

        Pembayaran::create([
            'id_pembayaran' => $idPembayaran,
            'id_reservasi' => $reservasi->id_reservasi,
            'metode_pembayaran' => $request->metode_pembayaran,
            'jumlah_bayar' => $reservasi->total_biaya,
            'tanggal_bayar' => now(),
            'status_pembayaran' => 'pending',
            'bukti_pembayaran' => $imagePath,
        ]);

        return redirect()->route('home')->with('success', 'Bukti pembayaran berhasil diunggah! Menunggu verifikasi admin.');
    }
}
