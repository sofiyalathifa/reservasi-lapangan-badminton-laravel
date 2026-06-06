<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Reservasi;
use Illuminate\Support\Str;

class ReservasiController extends Controller
{
    public function create($id)
    {
        $lapangan = Lapangan::find($id);
        if (!$lapangan) {
            $lapangan = Lapangan::first(); // Fallback karena view detail masih mockup
        }

        // Ambil data reservasi 7 hari ke depan yang tidak dibatalkan
        $startDate = date('Y-m-d');
        $endDate = date('Y-m-d', strtotime('+6 days'));

        $reservasis = Reservasi::where('id_lapangan', $lapangan->id_lapangan)
            ->whereBetween('tanggal_booking', [$startDate, $endDate])
            ->whereIn('status_reservasi', ['pending', 'dikonfirmasi'])
            ->get();

        $bookedSlots = [];
        foreach ($reservasis as $res) {
            $tanggal = date('Y-m-d', strtotime($res->tanggal_booking));
            $startHour = (int) date('H', strtotime($res->jam_mulai));
            $durasi = $res->durasi;

            if (!isset($bookedSlots[$tanggal])) {
                $bookedSlots[$tanggal] = [];
            }

            for ($i = 0; $i < $durasi; $i++) {
                $h = $startHour + $i;
                $timeString = sprintf('%02d:00', $h);
                if (!in_array($timeString, $bookedSlots[$tanggal])) {
                    $bookedSlots[$tanggal][] = $timeString;
                }
            }
        }

        return view('reservasi.create', compact('lapangan', 'id', 'bookedSlots'));
    }

    public function store(Request $request, $id)
    {
        $lapangan = Lapangan::find($id);
        if (!$lapangan) {
            $lapangan = Lapangan::first();
        }

        $request->validate([
            'tanggal' => 'required|date',
            'jam_mulai' => 'required',
            'durasi' => 'required|integer|min:1|max:5',
        ]);

        $jam_mulai = $request->jam_mulai;
        $durasi = $request->durasi;
        $harga_per_jam = $lapangan->harga_per_jam;

        // Hitung jam_selesai
        $jamSelesaiStr = date('H:i:s', strtotime($jam_mulai . " + $durasi hours"));
        $totalBiaya = $durasi * $harga_per_jam;

        // Generate ID Reservasi Unik
        $idReservasi = 'RES-' . date('Ymd', strtotime($request->tanggal)) . '-' . strtoupper(Str::random(4));

        Reservasi::create([
            'id_reservasi' => $idReservasi,
            'id_pengguna' => auth()->id(), // Dari tabel users
            'id_lapangan' => $lapangan->id_lapangan,
            'tanggal_booking' => $request->tanggal,
            'jam_mulai' => $jam_mulai,
            'jam_selesai' => $jamSelesaiStr,
            'durasi' => $durasi,
            'total_biaya' => $totalBiaya,
            'status_reservasi' => 'pending',
        ]);

        return redirect()->route('pembayaran.create', $idReservasi)->with('success', 'Booking diamankan! Silakan selesaikan pembayaran Anda.');
    }
}
