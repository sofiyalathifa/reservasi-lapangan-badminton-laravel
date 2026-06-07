<?php

namespace App\Http\Controllers;

use App\Models\CariTeman;
use App\Models\AjakMain;
use Illuminate\Http\Request;

class CariTemanController extends Controller
{
    public function index()
    {
        $myPost = CariTeman::where('id_pengguna', auth()->id())->where('status', true)->first();
        $allPartners = CariTeman::with('user')->where('status', true)->latest()->get();
        
        $myRequests = AjakMain::with('cariTeman.user', 'penerima')
            ->where('pengirim_id', auth()->id())
            ->latest()
            ->get();
            
        $rawIncomingRequests = AjakMain::with('pengirim', 'cariTeman')
            ->where('penerima_id', auth()->id())
            ->latest()
            ->get();

        // Hilangkan duplikat dari pengirim yang sama (hanya ambil yang terbaru)
        $seenIncoming = [];
        $incomingRequests = $rawIncomingRequests->filter(function($req) use (&$seenIncoming) {
            if (in_array($req->pengirim_id, $seenIncoming)) {
                return false;
            }
            $seenIncoming[] = $req->pengirim_id;
            return true;
        });

        // Ambil semua chat aktif (accepted) milik user saat ini
        $activeChats = AjakMain::where('status', 'accepted')
            ->where(function($q) {
                $q->where('pengirim_id', auth()->id())
                  ->orWhere('penerima_id', auth()->id());
            })
            ->get();

        return view('komunitas.dashboard', compact('myPost', 'allPartners', 'myRequests', 'incomingRequests', 'activeChats'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'level_kemampuan' => 'required|in:Beginner,Intermediate,Advanced',
            'lokasi' => 'required|string|max:255',
            'gaya_bermain' => 'required|string|max:255',
        ]);

        CariTeman::updateOrCreate(
            ['id_pengguna' => auth()->id(), 'status' => true],
            [
                'level_kemampuan' => $request->level_kemampuan,
                'lokasi' => $request->lokasi,
                'gaya_bermain' => $request->gaya_bermain,
                'status' => true,
            ]
        );

        return back()->with('success', 'Profil pencarian teman berhasil diposting!');
    }

    public function close($id)
    {
        $post = CariTeman::where('id', $id)->where('id_pengguna', auth()->id())->firstOrFail();
        $post->update(['status' => false]);

        return back()->with('success', 'Postingan berhasil ditutup.');
    }
}
