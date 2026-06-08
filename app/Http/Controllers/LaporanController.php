<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class LaporanController extends Controller
{
    public function index()
    {
        // CARD LAPORAN
        $reservasiHariIni = DB::table('reservasi')
            ->where('status_reservasi', '!=', 'dibatalkan')
            ->whereDate('tanggal_booking', now())
            ->count();

        $pemasukanHariIni = DB::table('pembayaran')
            ->whereIn('status_pembayaran', ['lunas', 'DP'])
            ->whereDate('tanggal_bayar', now())
            ->sum('jumlah_bayar');

        $reservasiBulanIni = DB::table('reservasi')
            ->where('status_reservasi', '!=', 'dibatalkan')
            ->whereMonth('tanggal_booking', now()->month)
            ->whereYear('tanggal_booking', now()->year)
            ->count();

        $pemasukanBulanIni = DB::table('pembayaran')
            ->whereIn('status_pembayaran', ['lunas', 'DP'])
            ->whereMonth('tanggal_bayar', now()->month)
            ->whereYear('tanggal_bayar', now()->year)
            ->sum('jumlah_bayar');

        // LAPANGAN FAVORIT
        $lapanganFavorit = DB::table('reservasi')
            ->join('lapangan', 'reservasi.id_lapangan', '=', 'lapangan.id_lapangan')
            ->where('status_reservasi', '!=', 'dibatalkan')
            ->select(
                'lapangan.nama_lapangan',
                DB::raw('COUNT(*) as total_booking')
            )
            ->groupBy('lapangan.nama_lapangan')
            ->orderByDesc('total_booking')
            ->first();

        $jumlahBookingLapangan = $lapanganFavorit->total_booking ?? 0;

        // PELANGGAN PALING AKTIF
        $pelangganAktif = DB::table('reservasi')
            ->join('users', 'reservasi.id_pengguna', '=', 'users.id')
            ->where('status_reservasi', '!=', 'dibatalkan')
            ->select(
                'users.name as nama_lengkap',
                DB::raw('COUNT(*) as total_booking')
            )
            ->groupBy('users.name')
            ->orderByDesc('total_booking')
            ->first();

        $jumlahBookingPelanggan = $pelangganAktif->total_booking ?? 0;

        // TABEL RESERVASI BULANAN
        $laporanBulanan = DB::table('reservasi')
            ->select(
                'tanggal_booking',
                DB::raw('COUNT(*) as total_booking'),
                DB::raw('SUM(total_biaya) as total_nilai')
            )
            ->groupBy('tanggal_booking')
            ->orderByDesc('tanggal_booking')
            ->get();

        // ===============================
        // GRAFIK RESERVASI HARIAN
        // ===============================
        $grafikReservasi = DB::table('reservasi')
            ->select(
                'tanggal_booking',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('tanggal_booking')
            ->orderBy('tanggal_booking')
            ->get();

        $tanggalGrafik = $grafikReservasi->pluck('tanggal_booking');
        $jumlahGrafik = $grafikReservasi->pluck('total');

        // ===============================
        // GRAFIK LAPANGAN FAVORIT
        // ===============================
        $grafikLapangan = DB::table('reservasi')
            ->join('lapangan', 'reservasi.id_lapangan', '=', 'lapangan.id_lapangan')
            ->select(
                'lapangan.nama_lapangan',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('lapangan.nama_lapangan')
            ->orderByDesc('total')
            ->get();

        $namaLapangan = $grafikLapangan->pluck('nama_lapangan');
        $jumlahLapangan = $grafikLapangan->pluck('total');

        // ===============================
        // PIE CHART STATUS RESERVASI
        // ===============================
        $statusReservasi = DB::table('reservasi')
            ->select(
                'status_reservasi',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('status_reservasi')
            ->get();

        $statusLabel = $statusReservasi->pluck('status_reservasi');
        $statusJumlah = $statusReservasi->pluck('total');
        $reservasiPerHari = DB::table('reservasi')
    ->select(
        'tanggal_booking',
        DB::raw('COUNT(*) as total')
    )
    ->groupBy('tanggal_booking')
    ->orderBy('tanggal_booking')
    ->get();

$lapanganChart = DB::table('reservasi')
    ->join('lapangan', 'reservasi.id_lapangan', '=', 'lapangan.id_lapangan')
    ->select(
        'lapangan.nama_lapangan',
        DB::raw('COUNT(*) as total')
    )
    ->groupBy('lapangan.nama_lapangan')
    ->get();

$statusReservasi = DB::table('reservasi')
    ->select(
        'status_reservasi',
        DB::raw('COUNT(*) as total')
    )
    ->groupBy('status_reservasi')
    ->get();

        return view('admin.laporan', compact(
    'reservasiHariIni',
    'pemasukanHariIni',
    'reservasiBulanIni',
    'pemasukanBulanIni',
    'lapanganFavorit',
    'jumlahBookingLapangan',
    'pelangganAktif',
    'jumlahBookingPelanggan',
    'laporanBulanan',
    'reservasiPerHari',
    'lapanganChart',
    'statusReservasi'
));
    }

    public function exportCsv(\Illuminate\Http\Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = DB::table('reservasi')
            ->join('users', 'reservasi.id_pengguna', '=', 'users.id')
            ->join('lapangan', 'reservasi.id_lapangan', '=', 'lapangan.id_lapangan')
            ->leftJoin('pembayaran', 'reservasi.id_reservasi', '=', 'pembayaran.id_reservasi')
            ->where('reservasi.status_reservasi', '!=', 'dibatalkan');

        if ($filter == 'harian') {
            $query->whereDate('reservasi.tanggal_booking', now());
            $periodeStr = 'Harian_';
        } elseif ($filter == 'mingguan') {
            $query->whereBetween('reservasi.tanggal_booking', [now()->startOfWeek(), now()->endOfWeek()]);
            $periodeStr = 'Mingguan_';
        } elseif ($filter == 'bulanan') {
            $query->whereMonth('reservasi.tanggal_booking', now()->month)
                  ->whereYear('reservasi.tanggal_booking', now()->year);
            $periodeStr = 'Bulanan_';
        } else {
            $periodeStr = 'Semua_';
        }

        $laporanDetail = $query->select(
                'reservasi.id_reservasi',
                'reservasi.tanggal_booking',
                'reservasi.jam_mulai',
                'reservasi.jam_selesai',
                'lapangan.nama_lapangan',
                'users.name as nama_pelanggan',
                'users.nomor_telepon',
                'reservasi.status_reservasi',
                'reservasi.total_biaya',
                'reservasi.diskon',
                'pembayaran.metode_pembayaran',
                'pembayaran.status_pembayaran'
            )
            ->orderByDesc('reservasi.tanggal_booking')
            ->orderBy('reservasi.jam_mulai')
            ->get();

        $fileName = 'Laporan_Detail_Reservasi_' . $periodeStr . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($laporanDetail) {
            $handle = fopen('php://output', 'w');
            
            // Header CSV yang proper
            fputcsv($handle, [
                'ID Reservasi', 
                'Tanggal Booking', 
                'Waktu Main', 
                'Lapangan', 
                'Pelanggan', 
                'No Telepon', 
                'Status Reservasi', 
                'Diskon Promo', 
                'Total Biaya (Rp)', 
                'Metode Bayar', 
                'Status Bayar'
            ], ';');

            foreach ($laporanDetail as $row) {
                fputcsv($handle, [
                    $row->id_reservasi,
                    \Carbon\Carbon::parse($row->tanggal_booking)->format('d-M-Y'),
                    \Carbon\Carbon::parse($row->jam_mulai)->format('H:i') . ' - ' . \Carbon\Carbon::parse($row->jam_selesai)->format('H:i'),
                    $row->nama_lapangan,
                    $row->nama_pelanggan,
                    $row->nomor_telepon ?? '-',
                    strtoupper($row->status_reservasi),
                    $row->diskon,
                    $row->total_biaya,
                    $row->metode_pembayaran ?? '-',
                    strtoupper($row->status_pembayaran ?? 'BELUM BAYAR'),
                ], ';');
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $fileName, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }

    public function print(\Illuminate\Http\Request $request)
    {
        $filter = $request->query('filter', 'all');

        $query = DB::table('reservasi')
            ->join('users', 'reservasi.id_pengguna', '=', 'users.id')
            ->join('lapangan', 'reservasi.id_lapangan', '=', 'lapangan.id_lapangan')
            ->leftJoin('pembayaran', 'reservasi.id_reservasi', '=', 'pembayaran.id_reservasi')
            ->where('reservasi.status_reservasi', '!=', 'dibatalkan');

        $periodeTitle = 'Semua Waktu';
        if ($filter == 'harian') {
            $query->whereDate('reservasi.tanggal_booking', now());
            $periodeTitle = 'Hari Ini (' . now()->format('d M Y') . ')';
        } elseif ($filter == 'mingguan') {
            $query->whereBetween('reservasi.tanggal_booking', [now()->startOfWeek(), now()->endOfWeek()]);
            $periodeTitle = 'Minggu Ini (' . now()->startOfWeek()->format('d M') . ' - ' . now()->endOfWeek()->format('d M Y') . ')';
        } elseif ($filter == 'bulanan') {
            $query->whereMonth('reservasi.tanggal_booking', now()->month)
                  ->whereYear('reservasi.tanggal_booking', now()->year);
            $periodeTitle = 'Bulan ' . now()->translatedFormat('F Y');
        }

        $laporanDetail = $query->select(
                'reservasi.id_reservasi',
                'reservasi.tanggal_booking',
                'reservasi.jam_mulai',
                'reservasi.jam_selesai',
                'lapangan.nama_lapangan',
                'users.name as nama_pelanggan',
                'reservasi.status_reservasi',
                'reservasi.total_biaya',
                'pembayaran.status_pembayaran'
            )
            ->orderByDesc('reservasi.tanggal_booking')
            ->orderBy('reservasi.jam_mulai')
            ->get();

        return view('admin.laporan_print', compact('laporanDetail', 'periodeTitle'));
    }
}