<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Promo;

class AdminPromoController extends Controller
{
    public function index(Request $request)
    {
        $query = Promo::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('nama_promo', 'like', "%{$search}%")
                  ->orWhere('kode_promo', 'like', "%{$search}%");
        }

        $promos = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return view('dashboard.promo.index', compact('promos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_promo' => 'required|string|max:255',
            'kode_promo' => 'required|string|unique:promos,kode_promo|max:50',
            'deskripsi' => 'required|string',
            'tipe_diskon' => 'required|in:persen,nominal',
            'nilai_diskon' => 'required|integer|min:1',
            'tag' => 'required|string|max:50',
            'status' => 'required|boolean',
            'tanggal_berakhir' => 'nullable|date',
            'kuota_total' => 'nullable|integer|min:1',
            'batas_per_user' => 'nullable|integer|min:1',
            'min_durasi' => 'nullable|integer|min:1',
            'min_total_harga' => 'nullable|integer|min:0',
            'hari_berlaku' => 'nullable|in:semua,weekday,weekend',
            'jam_mulai_berlaku' => 'nullable|date_format:H:i',
            'jam_selesai_berlaku' => 'nullable|date_format:H:i',
        ]);

        Promo::create($request->all());

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $promo = Promo::findOrFail($id);

        $request->validate([
            'nama_promo' => 'required|string|max:255',
            'kode_promo' => 'required|string|max:50|unique:promos,kode_promo,' . $promo->id,
            'deskripsi' => 'required|string',
            'tipe_diskon' => 'required|in:persen,nominal',
            'nilai_diskon' => 'required|integer|min:1',
            'tag' => 'required|string|max:50',
            'status' => 'required|boolean',
            'tanggal_berakhir' => 'nullable|date',
            'kuota_total' => 'nullable|integer|min:1',
            'batas_per_user' => 'nullable|integer|min:1',
            'min_durasi' => 'nullable|integer|min:1',
            'min_total_harga' => 'nullable|integer|min:0',
            'hari_berlaku' => 'nullable|in:semua,weekday,weekend',
            'jam_mulai_berlaku' => 'nullable|date_format:H:i',
            'jam_selesai_berlaku' => 'nullable|date_format:H:i',
        ]);

        $promo->update($request->all());

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $promo = Promo::findOrFail($id);
        $promo->delete();

        return redirect()->route('admin.promo.index')->with('success', 'Promo berhasil dihapus!');
    }
}
