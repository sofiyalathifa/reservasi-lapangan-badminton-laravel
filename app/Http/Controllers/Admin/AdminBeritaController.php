<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class AdminBeritaController extends Controller
{
    public function index(Request $request)
    {
        $query = Berita::query();

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->where('judul', 'like', "%{$search}%")
                  ->orWhere('kategori', 'like', "%{$search}%");
        }

        $beritas = $query->orderBy('tanggal_publikasi', 'desc')->paginate(10)->withQueryString();
        
        return view('dashboard.berita.index', compact('beritas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'konten' => 'required|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_publikasi' => 'required|date',
            'baca_menit' => 'required|integer|min:1',
        ]);

        $data = $request->except('gambar');
        $data['slug'] = Str::slug($request->judul) . '-' . time();
        
        if ($request->hasFile('gambar')) {
            $image = $request->file('gambar');
            $imageName = time() . '_' . Str::slug($request->judul) . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'konten' => 'required|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tanggal_publikasi' => 'required|date',
            'baca_menit' => 'required|integer|min:1',
        ]);

        $data = $request->except('gambar');
        $data['slug'] = Str::slug($request->judul) . '-' . time();

        if ($request->hasFile('gambar')) {
            // Delete old image
            if ($berita->gambar && File::exists(public_path('images/' . $berita->gambar))) {
                File::delete(public_path('images/' . $berita->gambar));
            }

            $image = $request->file('gambar');
            $imageName = time() . '_' . Str::slug($request->judul) . '.' . $image->extension();
            $image->move(public_path('images'), $imageName);
            $data['gambar'] = $imageName;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        if ($berita->gambar && File::exists(public_path('images/' . $berita->gambar))) {
            File::delete(public_path('images/' . $berita->gambar));
        }
        
        $berita->delete();

        return redirect()->route('admin.berita.index')->with('success', 'Berita berhasil dihapus!');
    }
}
