@extends ('layouts.sidebar')

@section('content')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out lg:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">
        
        @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            <span class="font-medium">Berhasil!</span> {{ session('success') }}
        </div>
        @endif

        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap -mx-3 items-center justify-between">
                            <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                                <h6 class="mb-0">Daftar Lapangan</h6>
                            </div>
                            <div class="flex items-center justify-end flex-none w-1/2 max-w-full px-3 gap-3">
                                
                                {{-- Search & Filter Section --}}
                                <form method="GET" action="{{ route('admin.lapangan.index') }}" class="flex items-center gap-2 m-0">
                                    <div class="relative flex items-center">
                                        <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-500">
                                            <i class="fas fa-search text-xs"></i>
                                        </span>
                                        <input type="text" name="keyword" value="{{ request('keyword') }}" class="pl-9 pr-3 py-2 text-sm rounded-lg border border-gray-300 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none w-48 transition-all" placeholder="Cari Lapangan..." />
                                    </div>
                                    
                                    <div class="relative">
                                        <button type="button" class="flex items-center justify-center w-9 h-9 rounded-lg border border-gray-300 bg-white text-gray-600 hover:bg-gray-50 transition-colors" onclick="document.getElementById('filterDropdown').classList.toggle('hidden')">
                                            <i class="fas fa-filter text-sm"></i>
                                        </button>
                                        
                                        {{-- Dropdown Filter --}}
                                        <div id="filterDropdown" class="absolute right-0 mt-2 w-56 bg-white border border-gray-100 rounded-xl shadow-lg hidden z-50 p-4">
                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Status</label>
                                            <select name="status" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm mb-3 focus:outline-none focus:border-emerald-400">
                                                <option value="">Semua</option>
                                                <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                                <option value="perbaikan" {{ request('status') == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                                            </select>

                                            <label class="block text-xs font-semibold text-gray-700 mb-1">Jenis Lantai</label>
                                            <input type="text" name="jenis_lantai" value="{{ request('jenis_lantai') }}" class="w-full border border-gray-200 rounded-lg px-3 py-2 text-sm mb-4 focus:outline-none focus:border-emerald-400" placeholder="Contoh: Vinyl">

                                            <div class="flex gap-2">
                                                <button type="submit" class="flex-1 text-white text-xs font-bold rounded-lg py-2 transition" style="background: linear-gradient(135deg, #10b981, #059669); border: none;">Terapkan</button>
                                                <a href="{{ route('admin.lapangan.index') }}" class="flex-1 text-center bg-gray-100 text-gray-600 text-xs font-bold rounded-lg py-2 hover:bg-gray-200 transition">Reset</a>
                                            </div>
                                        </div>
                                    </div>
                                </form>

                                @if(auth()->check() && auth()->user()->role != 'owner')
                                <a href="{{ route('admin.lapangan.create') }}" class="inline-block px-5 py-2 font-bold leading-normal text-center text-white align-middle transition-all rounded-lg cursor-pointer text-sm ease-in shadow-md hover:shadow-xs hover:-translate-y-px active:opacity-85 m-0 whitespace-nowrap" style="background: linear-gradient(135deg, #10b981, #14b8a6); border: none;">
                                    <i class="fas fa-plus mr-1"></i> Tambah Lapangan
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-6">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500 table-fixed" style="table-layout: fixed;">
                                <thead class="align-bottom">
                                    <tr>
                                        <th style="width: 30%" class="px-4 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none text-xxs tracking-none text-slate-400 opacity-70">Lapangan</th>
                                        <th style="width: 15%" class="px-2 py-3 font-bold text-left uppercase align-middle bg-transparent border-b shadow-none text-xxs tracking-none text-slate-400 opacity-70">Jenis Lantai</th>
                                        <th style="width: 15%" class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xxs tracking-none text-slate-400 opacity-70">Tarif / Jam</th>
                                        <th style="width: 12%" class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xxs tracking-none text-slate-400 opacity-70">Status</th>
                                        <th style="width: 15%" class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xxs tracking-none text-slate-400 opacity-70">Rating & Ulasan</th>
                                        @if(auth()->check() && auth()->user()->role != 'owner')
                                        <th style="width: 15%" class="px-2 py-3 font-bold text-center uppercase align-middle bg-transparent border-b shadow-none text-xxs tracking-none text-slate-400 opacity-70">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($lapangan as $item)
                                    <tr>
                                        <td class="p-4 px-4 align-middle bg-transparent border-b shadow-transparent truncate">
                                            <div class="flex px-2 py-1 items-center">
                                                <div class="flex-shrink-0">
                                                    <img src="{{ asset('images/' . $item->foto) }}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-12 w-12 rounded-xl object-cover shadow-sm" alt="{{ $item->nama_lapangan }}" onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->nama_lapangan) }}&background=10b981&color=fff&size=128'" />
                                                </div>
                                                <div class="flex flex-col justify-center min-w-0 w-full">
                                                    <h6 class="mb-0 text-base leading-normal font-semibold text-slate-700 truncate">{{ $item->nama_lapangan }}</h6>
                                                    <p class="mb-0 text-xs leading-tight text-slate-400 truncate" title="{{ $item->deskripsi }}">{{ $item->deskripsi }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 px-2 align-middle bg-transparent border-b shadow-transparent">
                                            <p class="mb-0 text-sm font-semibold leading-tight truncate">{{ $item->jenis_lantai }}</p>
                                        </td>
                                        <td class="p-4 px-2 text-center align-middle bg-transparent border-b shadow-transparent">
                                            <span class="text-sm font-semibold leading-tight text-slate-500 whitespace-nowrap">Rp {{ number_format($item->harga_per_jam, 0, ',', '.') }}</span>
                                        </td>
                                        <td class="p-4 px-2 text-center align-middle bg-transparent border-b shadow-transparent">
                                            <span class="px-3 py-1.5 text-xs font-semibold rounded-lg {{ $item->status == 'tersedia' ? 'bg-emerald-100 text-emerald-700' : 'bg-red-100 text-red-700' }}">
                                                {{ $item->status == 'tersedia' ? 'Tersedia' : 'Perbaikan' }}
                                            </span>
                                        </td>
                                        <td class="p-4 px-2 text-center align-middle bg-transparent border-b shadow-transparent">
                                            <div class="flex flex-col items-center justify-center">
                                                <p class="mb-0 text-sm font-semibold leading-tight text-slate-700 whitespace-nowrap">
                                                    <span class="text-yellow-500"><i class="fas fa-star"></i> {{ number_format($item->rating ?? 0, 1) }}</span>
                                                </p>
                                                <p class="mb-0 text-xs leading-tight text-slate-400 whitespace-nowrap">{{ $item->jumlah_ulasan ?? 0 }} Ulasan</p>
                                            </div>
                                        </td>
                                        @if(auth()->check() && auth()->user()->role != 'owner')
                                        <td class="p-4 px-2 text-center align-middle bg-transparent border-b shadow-transparent">
                                            <div class="flex items-center justify-center gap-3">
                                                <a href="{{ route('admin.lapangan.edit', $item->id_lapangan) }}" class="text-sm font-semibold leading-tight text-blue-500 hover:text-blue-700 cursor-pointer transition-colors">
                                                    <i class="fas fa-edit"></i> Edit
                                                </a>
                                                <button type="button" onclick="openDeleteModal('{{ $item->id_lapangan }}', '{{ addslashes($item->nama_lapangan) }}')" class="text-sm font-semibold leading-tight text-red-500 hover:text-red-700 cursor-pointer border-none bg-transparent p-0 transition-colors">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </div>
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="6" class="p-8 text-center text-sm text-slate-400">Belum ada data lapangan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Modal Hapus -->
<div id="deleteModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity duration-300 opacity-0">
    <div class="bg-white rounded-2xl shadow-2xl w-[90%] max-w-md overflow-hidden transform scale-95 transition-transform duration-300">
        <div class="p-6 text-center">
            <div class="w-16 h-16 rounded-full bg-red-100 flex items-center justify-center mx-auto mb-4">
                <i class="fas fa-exclamation-triangle text-2xl text-red-500"></i>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">Hapus Lapangan?</h3>
            <p class="text-gray-500 mb-6 text-sm">Anda yakin ingin menghapus lapangan <span id="deleteItemName" class="font-bold text-gray-800"></span>? Data yang dihapus tidak dapat dikembalikan.</p>
            
            <div class="flex gap-3 justify-center">
                <button type="button" onclick="closeDeleteModal()" class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 font-medium transition-colors" style="background: white;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='white'">
                    Batal
                </button>
                <form id="deleteForm" method="POST" class="m-0 p-0" style="display: inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="px-5 py-2.5 rounded-xl text-white font-medium hover:shadow-lg transition-all" style="background: linear-gradient(135deg, #ef4444, #e11d48); border: none;">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function openDeleteModal(id, name) {
        document.getElementById('deleteItemName').innerText = name;
        document.getElementById('deleteForm').action = `/lapangan-admin/${id}`;
        
        const modal = document.getElementById('deleteModal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            modal.querySelector('div').classList.remove('scale-95');
            modal.querySelector('div').classList.add('scale-100');
        }, 10);
    }

    function closeDeleteModal() {
        const modal = document.getElementById('deleteModal');
        
        modal.classList.add('opacity-0');
        modal.querySelector('div').classList.remove('scale-100');
        modal.querySelector('div').classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
        }, 300);
    }
</script>

@endsection