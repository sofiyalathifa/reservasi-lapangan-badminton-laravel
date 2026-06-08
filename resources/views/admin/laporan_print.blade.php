<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Laporan - GOR Badminton</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        @media print {
            body { font-size: 12px; }
            .no-print { display: none !important; }
        }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f8f9fa; font-weight: bold; }
        .text-right { text-align: right; }
        .text-center { text-align: center; }
        .kop-surat { border-bottom: 2px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
    </style>
</head>
<body class="bg-white text-gray-800 p-8 max-w-5xl mx-auto">

    <div class="no-print mb-6 text-right">
        <button onclick="window.print()" class="bg-emerald-500 text-white px-4 py-2 rounded shadow hover:bg-emerald-600 transition">🖨️ Cetak Sekarang</button>
        <button onclick="window.close()" class="bg-slate-500 text-white px-4 py-2 rounded shadow hover:bg-slate-600 ml-2 transition">❌ Tutup</button>
    </div>

    <div class="kop-surat text-center">
        <h1 class="text-2xl font-bold uppercase tracking-widest text-slate-800">Laporan Transaksi Reservasi</h1>
        <p class="text-slate-600 font-medium text-lg mt-1">GOR Badminton Puncak</p>
        <p class="text-sm text-slate-500 mt-2">Periode Data: <span class="font-bold text-slate-700">{{ $periodeTitle }}</span></p>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center w-12">No</th>
                <th class="w-28">Tgl Booking</th>
                <th class="w-32">Waktu Main</th>
                <th>Lapangan</th>
                <th>Pelanggan</th>
                <th>Status Booking</th>
                <th>Status Bayar</th>
                <th class="text-right">Total Biaya (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $totalSemua = 0; @endphp
            @forelse ($laporanDetail as $index => $row)
                @php 
                    // Hanya tambahkan total semua jika lunas/DP untuk pemasukan real, atau tambahkan semua? 
                    // Ini laporan detail, kita totalkan semua nilai transaksinya saja.
                    $totalSemua += $row->total_biaya; 
                @endphp
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->tanggal_booking)->format('d-M-Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($row->jam_mulai)->format('H:i') }} - {{ \Carbon\Carbon::parse($row->jam_selesai)->format('H:i') }}</td>
                    <td>{{ $row->nama_lapangan }}</td>
                    <td>{{ $row->nama_pelanggan }}</td>
                    <td>{{ strtoupper($row->status_reservasi) }}</td>
                    <td>{{ strtoupper($row->status_pembayaran ?? 'BELUM BAYAR') }}</td>
                    <td class="text-right">{{ number_format($row->total_biaya, 0, ',', '.') }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="8" class="text-center py-6 text-slate-500 italic">Tidak ada transaksi pada periode ini.</td>
                </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="7" class="text-right text-slate-700 uppercase">TOTAL NILAI TRANSAKSI</th>
                <th class="text-right text-lg font-bold text-slate-800">Rp {{ number_format($totalSemua, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <div class="mt-16 w-full flex justify-end">
        <div class="text-center">
            <p class="text-sm text-slate-600">Dicetak pada: {{ now()->format('d M Y, H:i') }}</p>
            <br><br><br><br>
            <p class="font-bold underline text-slate-800">{{ auth()->user()->name ?? 'Admin / Kasir' }}</p>
            <p class="text-sm text-slate-500">Petugas</p>
        </div>
    </div>

    <script>
        window.onload = function() {
            setTimeout(function() {
                window.print();
            }, 500); // Beri jeda setengah detik agar Tailwind selesai dimuat sebelum dialog print muncul
        }
    </script>
</body>
</html>
