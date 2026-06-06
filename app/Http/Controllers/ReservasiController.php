<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Lapangan;
use App\Models\Reservasi;
use App\Models\Ulasan;
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

        $allPromos = \App\Models\Promo::where('status', true)->get();
        $validPromos = [];
        foreach ($allPromos as $promo) {
            if ($promo->isValidForUser(auth()->id())['is_valid']) {
                $validPromos[] = $promo;
            }
        }
        $promos = collect($validPromos);

        return view('reservasi.create', compact('lapangan', 'bookedSlots', 'id', 'promos'));
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

        $diskon = 0;
        $kode_promo = $request->kode_promo;

        if ($kode_promo) {
            $promo = \App\Models\Promo::where('kode_promo', $kode_promo)->first();
            if ($promo) {
                $validation = $promo->isValidForUser(auth()->id());
                if (!$validation['is_valid']) {
                    return back()->with('error', 'Gagal menggunakan promo: ' . $validation['message'])->withInput();
                }

                $bookingValidation = $promo->isValidForBooking($durasi, $totalBiaya, $request->tanggal, $request->jam_mulai);
                if (!$bookingValidation['is_valid']) {
                    return back()->with('error', 'Gagal menggunakan promo: ' . $bookingValidation['message'])->withInput();
                }

                if ($promo->tipe_diskon === 'persen') {
                    $diskon = $totalBiaya * ($promo->nilai_diskon / 100);
                } else {
                    $diskon = $promo->nilai_diskon;
                }
                
                if ($diskon > $totalBiaya) {
                    $diskon = $totalBiaya;
                }
                $totalBiaya -= $diskon;

                // Kurangi kuota jika promo digunakan dan punya batasan kuota global
                if ($promo->kuota_total !== null) {
                    $promo->decrement('kuota_total');
                }
            } else {
                $kode_promo = null;
            }
        }

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
            'kode_promo' => $kode_promo,
            'diskon' => $diskon,
            'total_biaya' => $totalBiaya,
            'status_reservasi' => 'pending',
        ]);

        return redirect()->route('pembayaran.create', $idReservasi)->with('success', 'Booking diamankan! Silakan selesaikan pembayaran Anda.');
    }

    public function riwayat(Request $request)
    {
        $status = $request->query('status', 'semua');

        $query = Reservasi::where('id_pengguna', auth()->id())
            ->with(['lapangan', 'pembayaran'])
            ->orderBy('created_at', 'desc');

        if ($status === 'belum_bayar') {
            $query->where('status_reservasi', 'pending')
                  ->whereDoesntHave('pembayaran');
        } elseif ($status === 'menunggu_konfirmasi') {
            $query->where('status_reservasi', 'pending')
                  ->has('pembayaran');
        } elseif ($status !== 'semua') {
            $query->where('status_reservasi', $status);
        }

        $reservasis = $query->get();

        return view('reservasi.riwayat', compact('reservasis', 'status'));
    }

    public function batal($id)
    {
        $reservasi = Reservasi::findOrFail($id);

        // Pastikan hanya pemilik yang bisa membatalkan
        if ($reservasi->id_pengguna !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        // Cek jika pesanan sudah dibayar atau statusnya bukan pending
        if ($reservasi->status_reservasi !== 'pending' || $reservasi->pembayaran()->exists()) {
            return back()->with('error', 'Pesanan ini tidak dapat dibatalkan karena sudah dalam proses pembayaran atau sudah lunas.');
        }

        $reservasi->update(['status_reservasi' => 'dibatalkan']);

        return back()->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function storeUlasan(Request $request, $id)
    {
        $reservasi = Reservasi::where('id_reservasi', $id)->with('lapangan')->firstOrFail();

        // Pastikan hanya pemilik yang bisa memberi ulasan
        if ($reservasi->id_pengguna !== auth()->id()) {
            abort(403, 'Akses ditolak.');
        }

        // Pastikan reservasi sudah selesai
        $isPast = \Carbon\Carbon::parse($reservasi->tanggal_booking . ' ' . $reservasi->jam_selesai)->isPast();
        if ($reservasi->status_reservasi !== 'dikonfirmasi' || !$isPast) {
            return back()->with('error', 'Anda belum bisa memberikan ulasan untuk sesi ini.');
        }

        // Pastikan belum pernah memberi ulasan
        if ($reservasi->ulasan()->exists()) {
            return back()->with('error', 'Anda sudah memberikan ulasan untuk sesi ini.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'komentar' => 'nullable|string',
        ]);

        // Simpan ulasan
        Ulasan::create([
            'id_reservasi' => $reservasi->id_reservasi,
            'id_lapangan' => $reservasi->id_lapangan,
            'id_user' => auth()->id(),
            'rating' => $request->rating,
            'komentar' => $request->komentar,
        ]);

        // Update rating lapangan
        $lapangan = $reservasi->lapangan;
        $totalUlasan = $lapangan->ulasans()->count();
        $avgRating = $lapangan->ulasans()->avg('rating');

        $lapangan->update([
            'rating' => round($avgRating, 1),
            'jumlah_ulasan' => $totalUlasan
        ]);

        return back()->with('success_review', 'Terima kasih! Ulasan Anda berhasil disimpan.');
    }
}
