<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BeritaController extends Controller
{
    public function show($slug)
    {
        $berita = \App\Models\Berita::where('slug', $slug)->firstOrFail();
        $beritas_lainnya = \App\Models\Berita::where('id', '!=', $berita->id)->latest('tanggal_publikasi')->take(2)->get();
        return view('berita.show', compact('berita', 'beritas_lainnya'));
    }
}
