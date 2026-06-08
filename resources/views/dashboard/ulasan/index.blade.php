@extends('layouts.sidebar')

@section('title', 'Kelola Ulasan')

@section('content')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out lg:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex items-center justify-between">
                            <h6 class="mb-0 font-bold text-slate-700 text-lg">Daftar Ulasan Pelanggan</h6>
                            <div class="flex gap-2">
                                <form action="{{ route('admin.ulasan.index') }}" method="GET" class="flex gap-2">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari pelanggan/komentar..." class="px-4 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 w-64">
                                    <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition-colors shadow-sm">
                                        Cari
                                    </button>
                                </form>
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="p-4 mt-4 text-sm text-emerald-800 rounded-lg bg-emerald-50" role="alert">
                                <span class="font-medium">Berhasil!</span> {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <div class="flex-auto px-0 pt-0 pb-2 mt-4">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Pelanggan</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Lapangan</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Rating</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Komentar</th>
                                        @if(auth()->check() && auth()->user()->role != 'owner')
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($ulasans as $item)
                                    <tr>
                                        <td class="p-4 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm font-semibold leading-normal text-slate-700">{{ $item->user->name ?? 'User Tidak Diketahui' }}</h6>
                                                    <p class="mb-0 text-xs leading-tight text-slate-400">{{ \Carbon\Carbon::parse($item->created_at)->format('d M Y H:i') }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-sm font-semibold leading-tight text-slate-600">
                                                {{ $item->lapangan->nama_lapangan ?? 'Lapangan Dihapus' }}
                                            </p>
                                        </td>
                                        <td class="p-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex justify-center text-yellow-400 text-sm">
                                                @for($i = 1; $i <= 5; $i++)
                                                    @if($i <= $item->rating)
                                                        <i class="fas fa-star"></i>
                                                    @else
                                                        <i class="far fa-star text-slate-300"></i>
                                                    @endif
                                                @endfor
                                            </div>
                                            <span class="text-xs font-semibold text-slate-500">{{ $item->rating }} / 5</span>
                                        </td>
                                        <td class="p-4 text-center align-middle bg-transparent border-b shadow-transparent max-w-xs">
                                            <p class="mb-0 text-sm leading-tight text-slate-600 whitespace-normal break-words">
                                                {{ $item->komentar ?: '-' }}
                                            </p>
                                        </td>
                                        @if(auth()->check() && auth()->user()->role != 'owner')
                                        <td class="p-4 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <form action="{{ route('admin.ulasan.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus ulasan ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-semibold px-3 py-1.5 rounded-lg bg-red-50 text-red-500 hover:bg-red-100 transition-colors">
                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="5" class="p-6 text-center text-sm text-slate-500">
                                            Belum ada data ulasan.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="p-4">
                                {{ $ulasans->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection
