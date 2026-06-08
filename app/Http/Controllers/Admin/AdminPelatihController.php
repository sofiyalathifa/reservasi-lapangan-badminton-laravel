<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Pelatih;
use Illuminate\Support\Facades\File;

class AdminPelatihController extends Controller
{
    public function index(Request $request)
    {
        $query = Pelatih::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('nama_pelatih', 'like', "%{$search}%")
                  ->orWhere('spesialisasi', 'like', "%{$search}%");
            });
        }

        if ($request->has('status') && $request->status != '') {
            $status = $request->status == 'aktif' ? 1 : 0;
            $query->where('status_aktif', $status);
        }

        if ($request->has('level') && $request->level != '') {
            $query->where('target_level', $request->level);
        }

        $pelatihs = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return view('dashboard.pelatih.index', compact('pelatihs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_pelatih' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:255',
            'target_level' => 'required|in:Beginner,Intermediate,Advanced',
            'harga_per_sesi' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'status_aktif' => 'required|boolean',
            'deskripsi' => 'nullable|string',
            'foto_pelatih' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $foto_name = null;
        if ($request->hasFile('foto_pelatih')) {
            $file = $request->file('foto_pelatih');
            $foto_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/pelatih'), $foto_name);
        }

        Pelatih::create([
            'nama_pelatih' => $request->nama_pelatih,
            'spesialisasi' => $request->spesialisasi,
            'target_level' => $request->target_level,
            'harga_per_sesi' => $request->harga_per_sesi,
            'rating' => $request->rating ?? 0,
            'status_aktif' => $request->status_aktif,
            'deskripsi' => $request->deskripsi,
            'foto_pelatih' => $foto_name,
        ]);

        return redirect()->route('admin.pelatih.index')->with('success', 'Pelatih berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $pelatih = Pelatih::findOrFail($id);

        $request->validate([
            'nama_pelatih' => 'required|string|max:255',
            'spesialisasi' => 'required|string|max:255',
            'target_level' => 'required|in:Beginner,Intermediate,Advanced',
            'harga_per_sesi' => 'required|numeric|min:0',
            'rating' => 'nullable|numeric|min:0|max:5',
            'status_aktif' => 'required|boolean',
            'deskripsi' => 'nullable|string',
            'foto_pelatih' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $foto_name = $pelatih->foto_pelatih;
        if ($request->hasFile('foto_pelatih')) {
            // Delete old photo if exists
            if ($foto_name && File::exists(public_path('images/pelatih/' . $foto_name))) {
                File::delete(public_path('images/pelatih/' . $foto_name));
            }

            $file = $request->file('foto_pelatih');
            $foto_name = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('images/pelatih'), $foto_name);
        }

        $pelatih->update([
            'nama_pelatih' => $request->nama_pelatih,
            'spesialisasi' => $request->spesialisasi,
            'target_level' => $request->target_level,
            'harga_per_sesi' => $request->harga_per_sesi,
            'rating' => $request->rating ?? 0,
            'status_aktif' => $request->status_aktif,
            'deskripsi' => $request->deskripsi,
            'foto_pelatih' => $foto_name,
        ]);

        return redirect()->route('admin.pelatih.index')->with('success', 'Data pelatih berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $pelatih = Pelatih::findOrFail($id);
        
        // Delete photo if exists
        if ($pelatih->foto_pelatih && File::exists(public_path('images/pelatih/' . $pelatih->foto_pelatih))) {
            File::delete(public_path('images/pelatih/' . $pelatih->foto_pelatih));
        }

        $pelatih->delete();

        return redirect()->route('admin.pelatih.index')->with('success', 'Pelatih berhasil dihapus!');
    }
}
