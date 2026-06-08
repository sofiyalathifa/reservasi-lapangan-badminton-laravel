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

    public function exportCsv()
    {
        $laporanBulanan = DB::table('reservasi')
            ->select(
                'tanggal_booking',
                DB::raw('COUNT(*) as total_booking'),
                DB::raw('SUM(total_biaya) as total_nilai')
            )
            ->groupBy('tanggal_booking')
            ->orderByDesc('tanggal_booking')
            ->get();

        $fileName = 'laporan_reservasi_' . now()->format('Ymd_His') . '.csv';

        $callback = function () use ($laporanBulanan) {
            $handle = fopen('php://output', 'w');
            fputcsv($handle, ['Tanggal', 'Total Booking', 'Total Nilai']);

            foreach ($laporanBulanan as $laporan) {
                fputcsv($handle, [
                    $laporan->tanggal_booking,
                    $laporan->total_booking,
                    $laporan->total_nilai,
                ]);
            }

            fclose($handle);
        };

        return response()->streamDownload($callback, $fileName, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
        ]);
    }
}