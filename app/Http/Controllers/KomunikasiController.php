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

        // Cek apakah sudah ada chat AKTIF (accepted) dengan orang ini
        $existingChat = AjakMain::where('status', 'accepted')
            ->where(function($q) use ($cariTeman) {
                $q->where(function($q2) use ($cariTeman) {
                    $q2->where('pengirim_id', auth()->id())
                       ->where('penerima_id', $cariTeman->id_pengguna);
                })->orWhere(function($q2) use ($cariTeman) {
                    $q2->where('pengirim_id', $cariTeman->id_pengguna)
                       ->where('penerima_id', auth()->id());
                });
            })
            ->first();

        if ($existingChat) {
            return redirect()->route('komunitas.chat.room', $existingChat->id)
                ->with('success', 'Anda sudah memiliki obrolan dengan ' . $cariTeman->user->name . '. Lanjutkan di sini!');
        }

        // Cek apakah sudah ada undangan PENDING dengan orang ini (apapun postingannya)
        $existingPending = AjakMain::where('status', 'pending')
            ->where(function($q) use ($cariTeman) {
                $q->where(function($q2) use ($cariTeman) {
                    $q2->where('pengirim_id', auth()->id())
                       ->where('penerima_id', $cariTeman->id_pengguna);
                })->orWhere(function($q2) use ($cariTeman) {
                    $q2->where('pengirim_id', $cariTeman->id_pengguna)
                       ->where('penerima_id', auth()->id());
                });
            })
            ->first();

        if ($existingPending) {
            return back()->with('error', 'Anda sudah memiliki undangan yang menunggu konfirmasi dengan ' . $cariTeman->user->name . '.');
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
        $allChats = AjakMain::with('pengirim', 'penerima', 'cariTeman')
            ->where('status', 'accepted')
            ->where(function($q) {
                $q->where('pengirim_id', auth()->id())
                  ->orWhere('penerima_id', auth()->id());
            })
            ->latest('updated_at')
            ->get();

        // Hilangkan duplikat: hanya tampilkan 1 chat per lawan bicara (yang terbaru)
        $seen = [];
        $chats = $allChats->filter(function($chat) use (&$seen) {
            $lawanId = $chat->pengirim_id == auth()->id() ? $chat->penerima_id : $chat->pengirim_id;
            if (in_array($lawanId, $seen)) {
                return false;
            }
            $seen[] = $lawanId;
            return true;
        });

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
