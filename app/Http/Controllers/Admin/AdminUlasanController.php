<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ulasan;

class AdminUlasanController extends Controller
{
    public function index(Request $request)
    {
        $query = Ulasan::with(['user', 'lapangan']);

        if ($request->has('search') && $request->search != '') {
            $search = $request->search;
            $query->whereHas('user', function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%");
            })->orWhereHas('lapangan', function($q) use ($search) {
                $q->where('nama_lapangan', 'like', "%{$search}%");
            })->orWhere('komentar', 'like', "%{$search}%");
        }

        $ulasans = $query->orderBy('created_at', 'desc')->paginate(10)->withQueryString();
        
        return view('dashboard.ulasan.index', compact('ulasans'));
    }

    public function destroy($id)
    {
        $ulasan = Ulasan::findOrFail($id);
        $ulasan->delete();

        return redirect()->route('admin.ulasan.index')->with('success', 'Ulasan berhasil dihapus!');
    }
}
