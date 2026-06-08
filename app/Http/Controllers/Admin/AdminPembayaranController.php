<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminPembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = \App\Models\Pembayaran::with(['reservasi.user']);

        // Filter status
        if ($request->filled('status') && $request->status !== 'semua') {
            $query->where('status_pembayaran', $request->status);
        }

        // Pencarian
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('id_pembayaran', 'like', "%{$search}%")
                  ->orWhere('id_reservasi', 'like', "%{$search}%")
                  ->orWhere('metode_pembayaran', 'like', "%{$search}%")
                  ->orWhereHas('reservasi.user', function($qUser) use ($search) {
                      $qUser->where('name', 'like', "%{$search}%");
                  });
            });
        }

        // Urutkan yang pending di atas, lalu berdasarkan tanggal terbaru
        $pembayarans = $query->orderByRaw("FIELD(status_pembayaran, 'pending') DESC")
            ->orderBy('tanggal_bayar', 'desc')
            ->paginate(10)
            ->withQueryString();
            
        return view('dashboard.pembayaran.index', compact('pembayarans'));
    }

    public function verifikasi(Request $request, $id)
    {
        $pembayaran = \App\Models\Pembayaran::findOrFail($id);
        
        $request->validate([
            'status_pembayaran' => 'required|in:pending,DP,lunas,gagal',
        ]);

        if ($request->status_pembayaran == 'gagal') {
            // Revert status reservasi ke pending jika ditolak
            $reservasi = $pembayaran->reservasi;
            if ($reservasi) {
                $reservasi->status_reservasi = 'pending';
                $reservasi->save();
            }

            // Karena ENUM DB hanya mendukung pending, lunas, DP
            // Maka jika ditolak, kita hapus data pembayarannya agar user bisa upload ulang
            $pembayaran->delete();
            return redirect()->back()->with('success', 'Pembayaran ditolak. Data pembayaran dihapus dan status reservasi kembali menjadi Menunggu.');
        }

        $pembayaran->status_pembayaran = $request->status_pembayaran;
        $pembayaran->id_admin_verifikasi = auth()->id();
        $pembayaran->verified_at = now();
        $pembayaran->save();

        $reservasi = $pembayaran->reservasi;
        if ($reservasi) {
            if (in_array($request->status_pembayaran, ['lunas', 'DP'])) {
                $reservasi->status_reservasi = 'dikonfirmasi';
            } elseif ($request->status_pembayaran === 'pending') {
                $reservasi->status_reservasi = 'pending';
            }
            $reservasi->save();
        }

        return redirect()->back()->with('success', 'Pembayaran berhasil diverifikasi!');
    }
}
