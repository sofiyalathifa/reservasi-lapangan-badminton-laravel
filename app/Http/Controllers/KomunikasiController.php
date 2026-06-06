<?php

namespace App\Http\Controllers;

use App\Models\AjakMain;
use App\Models\CariTeman;
use App\Models\PesanKomunitas;
use Illuminate\Http\Request;

class KomunikasiController extends Controller
{
    public function kirimUndangan($id_cari_teman)
    {
        $cariTeman = CariTeman::findOrFail($id_cari_teman);

        if ($cariTeman->id_pengguna == auth()->id()) {
            return back()->with('error', 'Anda tidak bisa mengajak diri sendiri.');
        }

        $existing = AjakMain::where('id_cari_teman', $id_cari_teman)
            ->where('pengirim_id', auth()->id())
            ->first();

        if ($existing) {
            return back()->with('error', 'Anda sudah mengirimkan undangan sebelumnya.');
        }

        AjakMain::create([
            'id_cari_teman' => $id_cari_teman,
            'pengirim_id' => auth()->id(),
            'penerima_id' => $cariTeman->id_pengguna,
            'status' => 'pending'
        ]);

        return back()->with('success', 'Undangan bermain berhasil dikirim!');
    }

    public function responUndangan(Request $request, $id_ajak_main)
    {
        $ajakMain = AjakMain::findOrFail($id_ajak_main);

        if ($ajakMain->penerima_id != auth()->id()) {
            abort(403);
        }

        $request->validate(['status' => 'required|in:accepted,rejected']);

        $ajakMain->update(['status' => $request->status]);

        return back()->with('success', 'Berhasil merespon undangan.');
    }

    public function indexChat()
    {
        $chats = AjakMain::with('pengirim', 'penerima', 'cariTeman')
            ->where('status', 'accepted')
            ->where(function($q) {
                $q->where('pengirim_id', auth()->id())
                  ->orWhere('penerima_id', auth()->id());
            })
            ->latest('updated_at')
            ->get();

        return view('komunitas.chat_list', compact('chats'));
    }

    public function ruangChat($id_ajak_main)
    {
        $chatRoom = AjakMain::with('pengirim', 'penerima', 'cariTeman', 'pesanKomunitas.pengirim')->findOrFail($id_ajak_main);

        if ($chatRoom->status !== 'accepted' || ($chatRoom->pengirim_id != auth()->id() && $chatRoom->penerima_id != auth()->id())) {
            abort(403);
        }

        // Tandai terbaca
        PesanKomunitas::where('id_ajak_main', $id_ajak_main)
            ->where('pengirim_id', '!=', auth()->id())
            ->update(['is_read' => true]);

        return view('komunitas.chat_room', compact('chatRoom'));
    }

    public function kirimPesan(Request $request, $id_ajak_main)
    {
        $request->validate(['pesan' => 'required|string']);

        $chatRoom = AjakMain::findOrFail($id_ajak_main);
        if ($chatRoom->status !== 'accepted' || ($chatRoom->pengirim_id != auth()->id() && $chatRoom->penerima_id != auth()->id())) {
            abort(403);
        }

        PesanKomunitas::create([
            'id_ajak_main' => $id_ajak_main,
            'pengirim_id' => auth()->id(),
            'pesan' => $request->pesan
        ]);

        return back();
    }

    public function getMessages($id_ajak_main)
    {
        $chatRoom = AjakMain::findOrFail($id_ajak_main);
        if ($chatRoom->status !== 'accepted' || ($chatRoom->pengirim_id != auth()->id() && $chatRoom->penerima_id != auth()->id())) {
            return response()->json([], 403);
        }

        $messages = PesanKomunitas::with('pengirim:id,name')->where('id_ajak_main', $id_ajak_main)->get();
        return response()->json($messages);
    }
}
