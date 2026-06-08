<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminReservasiController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Reservasi::with(['user', 'lapangan', 'pembayaran']);

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id_reservasi', 'like', "%{$search}%")
                  ->orWhereHas('user', function($qUser) use ($search) {
                      $qUser->where('name', 'like', "%{$search}%");
                  });
            });
        }

        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status_reservasi', $request->status);
        }

        $reservasis = $query->orderBy('tanggal_booking', 'desc')
            ->orderBy('jam_mulai', 'desc')
            ->paginate(10)
            ->withQueryString();
            
        $lapangans = \App\Models\Lapangan::all();
            
        return view('dashboard.reservasi.index', compact('reservasis', 'lapangans'));
    }

    public function storeOffline(Request $request)
    {
        $request->validate([
            'nama_pelanggan' => 'required|string|max:255',
            'id_lapangan' => 'required|exists:lapangan,id_lapangan',
            'tanggal_booking' => 'required|date',
            'jam_mulai' => 'required',
            'durasi' => 'required|integer|min:1',
            'total_biaya' => 'required|numeric|min:0'
        ]);

        // Cari atau buat user guest
        $user = \App\Models\User::firstOrCreate(
            ['name' => $request->nama_pelanggan],
            [
                'email' => strtolower(str_replace(' ', '', $request->nama_pelanggan)) . '_' . time() . '@guest.com',
                'password' => \Illuminate\Support\Facades\Hash::make('guest123'),
                'role' => 'user'
            ]
        );

        $jam_selesai = \Carbon\Carbon::parse($request->jam_mulai)->addHours($request->durasi)->format('H:i');
        
        // Cek apakah lapangan sudah dipesan di jam tersebut
        $overlap = \App\Models\Reservasi::where('id_lapangan', $request->id_lapangan)
            ->where('tanggal_booking', $request->tanggal_booking)
            ->where('status_reservasi', '!=', 'dibatalkan')
            ->where(function ($query) use ($request, $jam_selesai) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $jam_selesai])
                      ->orWhereBetween('jam_selesai', [$request->jam_mulai, $jam_selesai])
                      ->orWhere(function ($q) use ($request, $jam_selesai) {
                          $q->where('jam_mulai', '<=', $request->jam_mulai)
                            ->where('jam_selesai', '>=', $jam_selesai);
                      });
            })
            ->exists();

        if ($overlap) {
            return redirect()->back()->with('error', 'Gagal: Lapangan ini sudah dipesan pada rentang waktu tersebut.');
        }

        $id_reservasi = 'RES-' . strtoupper(uniqid());

        $reservasi = \App\Models\Reservasi::create([
            'id_reservasi' => $id_reservasi,
            'id_pengguna' => $user->id,
            'id_lapangan' => $request->id_lapangan,
            'tanggal_booking' => $request->tanggal_booking,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $jam_selesai,
            'durasi' => $request->durasi,
            'total_biaya' => $request->total_biaya,
            'status_reservasi' => 'pending' // Awalnya pending menunggu bayar DP/Lunas
        ]);

        // Buat antrean pembayaran tunai di kasir
        \App\Models\Pembayaran::create([
            'id_pembayaran' => 'PAY-' . strtoupper(uniqid()),
            'id_reservasi' => $id_reservasi,
            'metode_pembayaran' => 'Cash',
            'jumlah_bayar' => $request->total_biaya,
            'tanggal_bayar' => now(),
            'status_pembayaran' => 'pending',
            'bukti_pembayaran' => 'offline_payment',
            'id_admin_verifikasi' => null,
            'verified_at' => null,
            'verification_note' => 'Booking Offline Kasir - Menunggu Pembayaran'
        ]);

        return redirect()->route('admin.pembayaran.index')->with('success', 'Booking berhasil dicatat. Silakan atur pembayaran tunai (DP/Lunas) di sini.');
    }

    public function updateStatus(Request $request, $id)
    {
        $reservasi = \App\Models\Reservasi::findOrFail($id);
        
        $request->validate([
            'status_reservasi' => 'required|in:pending,dikonfirmasi,dibatalkan,selesai,bayar_tunai',
        ]);

        if ($request->status_reservasi === 'bayar_tunai') {
            // Kasir menerima pembayaran tunai untuk pesanan online
            if (!$reservasi->pembayaran) {
                \App\Models\Pembayaran::create([
                    'id_pembayaran' => 'PAY-' . strtoupper(uniqid()),
                    'id_reservasi' => $reservasi->id_reservasi,
                    'metode_pembayaran' => 'Cash',
                    'jumlah_bayar' => $reservasi->total_biaya,
                    'tanggal_bayar' => now(),
                    'status_pembayaran' => 'pending',
                    'bukti_pembayaran' => 'offline_payment',
                    'id_admin_verifikasi' => null,
                    'verified_at' => null,
                    'verification_note' => 'Proses Bayar Tunai di Kasir'
                ]);
            }
            
            return redirect()->route('admin.pembayaran.index')->with('success', 'Pesanan dipindahkan. Silakan atur nominal tunai (DP/Lunas) di sini.');
        }

        $reservasi->status_reservasi = $request->status_reservasi;
        $reservasi->save();

        if ($request->has('status_pembayaran') && $reservasi->pembayaran) {
            $reservasi->pembayaran->status_pembayaran = $request->status_pembayaran;
            $reservasi->pembayaran->id_admin_verifikasi = auth()->id();
            $reservasi->pembayaran->verified_at = now();
            $reservasi->pembayaran->save();
        }

        return redirect()->back()->with('success', 'Status reservasi berhasil diperbarui.');
    }
}
