<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LapanganController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('keyword');         // input search
        $status = $request->get('status');           // dropdown status
        $jenisLantai = $request->get('jenis_lantai'); // input jenis lantai

        // Query builder
        $lapanganQuery = DB::table('lapangan')
            ->select('lapangan.*')
            ->selectSub(function ($query) {
                $query->from('ulasans')
                    ->selectRaw('AVG(rating)')
                    ->whereColumn('ulasans.id_lapangan', 'lapangan.id_lapangan');
            }, 'rating')
            ->selectSub(function ($query) {
                $query->from('ulasans')
                    ->selectRaw('COUNT(*)')
                    ->whereColumn('ulasans.id_lapangan', 'lapangan.id_lapangan');
            }, 'jumlah_ulasan');

        // Filter search sebelum get()
        if ($keyword) {
            $lapanganQuery->where('nama_lapangan', 'like', "%{$keyword}%")
                ->orWhere('jenis_lantai', 'like', "%{$keyword}%")
                ->orWhere('status', 'like', "%{$keyword}%");
        }

        // Jalankan query
        $lapangan = $lapanganQuery->get();

        return view('dashboard.lapangan.index', compact('lapangan'));
    }

    function create()
    {
        return view('dashboard.lapangan.create');
    }

    public function store(Request $request)
    {
        // Validasi
        $request->validate([
            'id_lapangan'   => 'required|unique:lapangan,id_lapangan',
            'nama_lapangan' => 'required',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'     => 'nullable',
            'fasilitas'     => 'nullable',
            'jenis_lantai'  => 'required',
            'harga_per_jam' => 'required|numeric',
            'jam_buka'      => 'required',
            'jam_tutup'     => 'required',
            'status'        => 'required',
        ]);

        // Upload foto
        $namaFoto = null;

        if ($request->hasFile('foto')) {

            $file = $request->file('foto');

            $namaFoto = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('images'), $namaFoto);
        }

        // Simpan data ke database
        DB::table('lapangan')->insert([
            'id_lapangan'   => $request->id_lapangan,
            'nama_lapangan' => $request->nama_lapangan,
            'foto'          => $namaFoto,
            'deskripsi'     => $request->deskripsi,
            'fasilitas'     => $request->fasilitas,
            'jenis_lantai'  => $request->jenis_lantai,
            'harga_per_jam' => $request->harga_per_jam,
            'jam_buka'      => $request->jam_buka,
            'jam_tutup'     => $request->jam_tutup,
            'status'        => $request->status,
            'rating'        => 0,
            'jumlah_ulasan' => 0,
        ]);

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Data lapangan berhasil ditambahkan');
    }

    public function edit($id)
    {
        $lapangan = DB::table('lapangan')
            ->where('id_lapangan', $id)
            ->first();

        if (!$lapangan) {
            return redirect()
                ->route('admin.lapangan.index')
                ->with('error', 'Data lapangan tidak ditemukan');
        }

        return view('dashboard.lapangan.update', compact('lapangan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_lapangan' => 'required',
            'foto'          => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'deskripsi'     => 'required',
            'fasilitas'     => 'required',
            'jenis_lantai'  => 'required',
            'harga_per_jam' => 'required|numeric',
            'jam_buka'      => 'required',
            'jam_tutup'     => 'required',
            'status'        => 'required',
        ]);

        $lapangan = DB::table('lapangan')
            ->where('id_lapangan', $id)
            ->first();

        if (!$lapangan) {
            return redirect()
                ->route('admin.lapangan.index')
                ->with('error', 'Data lapangan tidak ditemukan');
        }

        $namaFoto = $lapangan->foto;

        if ($request->hasFile('foto')) {
            if ($lapangan->foto && file_exists(public_path('images/' . $lapangan->foto))) {
                unlink(public_path('images/' . $lapangan->foto));
            }

            $file = $request->file('foto');
            $namaFoto = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images'), $namaFoto);
        }

        DB::table('lapangan')
            ->where('id_lapangan', $id)
            ->update([
                'nama_lapangan' => $request->nama_lapangan,
                'foto'          => $namaFoto,
                'deskripsi'     => $request->deskripsi,
                'fasilitas'     => $request->fasilitas,
                'jenis_lantai'  => $request->jenis_lantai,
                'harga_per_jam' => $request->harga_per_jam,
                'jam_buka'      => $request->jam_buka,
                'jam_tutup'     => $request->jam_tutup,
                'status'        => $request->status,
            ]);

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Data lapangan berhasil diperbarui');
    }

    public function destroy($id)
    {
        $lapangan = DB::table('lapangan')
            ->where('id_lapangan', $id)
            ->first();

        if (!$lapangan) {
            return redirect()
                ->route('admin.lapangan.index')
                ->with('error', 'Data lapangan tidak ditemukan');
        }

        // hapus foto jika ada
        if ($lapangan->foto && file_exists(public_path('images/' . $lapangan->foto))) {
            unlink(public_path('images/' . $lapangan->foto));
        }

        // hapus data
        DB::table('lapangan')
            ->where('id_lapangan', $id)
            ->delete();

        return redirect()
            ->route('admin.lapangan.index')
            ->with('success', 'Data lapangan berhasil dihapus');
    }
}
