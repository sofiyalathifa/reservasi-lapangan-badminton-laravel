@extends('layouts.sidebar')

@section('title', 'Kelola Berita')

@section('content')
<!-- Trix Editor CSS & JS -->
<link rel="stylesheet" type="text/css" href="https://unpkg.com/trix@2.0.8/dist/trix.css">
<script type="text/javascript" src="https://unpkg.com/trix@2.0.8/dist/trix.umd.min.js"></script>
<style>
    /* Sembunyikan tombol upload file bawaan Trix karena kita pakai input file terpisah */
    trix-toolbar [data-trix-button-group="file-tools"] { display: none; }
    trix-editor.trix-content { min-height: 250px !important; }
</style>

<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out lg:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">
        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex items-center justify-between">
                            <h6 class="mb-0 font-bold text-slate-700 text-lg">Daftar Berita & Artikel</h6>
                            <div class="flex gap-2">
                                <form action="{{ route('admin.berita.index') }}" method="GET" class="flex gap-2">
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..." class="px-4 py-2 text-sm border rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                    <button type="submit" class="px-4 py-2 text-sm font-semibold text-white bg-blue-500 rounded-lg hover:bg-blue-600 transition-colors">
                                        Cari
                                    </button>
                                </form>
                                @if(auth()->check() && auth()->user()->role != 'owner')
                                <button onclick="openAddModal()" class="px-4 py-2 text-sm font-bold text-white bg-emerald-500 rounded-lg hover:bg-emerald-600 transition-colors shadow-sm">
                                    <i class="fas fa-plus mr-1"></i> Tambah Berita
                                </button>
                                @endif
                            </div>
                        </div>

                        @if (session('success'))
                            <div class="p-4 mt-4 text-sm text-emerald-800 rounded-lg bg-emerald-50" role="alert">
                                <span class="font-medium">Berhasil!</span> {{ session('success') }}
                            </div>
                        @endif
                    </div>

                    <div class="flex-auto px-0 pt-0 pb-2">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Berita</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Kategori</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Publikasi</th>
                                        @if(auth()->check() && auth()->user()->role != 'owner')
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($beritas as $item)
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <img src="{{ $item->gambar ? asset('images/' . $item->gambar) : 'https://ui-avatars.com/api/?name=Berita&background=10b981&color=fff' }}" class="inline-flex items-center justify-center mr-4 text-sm text-white transition-all duration-200 ease-in-out h-14 w-20 rounded-xl object-cover shadow-sm" alt="gambar">
                                                </div>
                                                <div class="flex flex-col justify-center max-w-[300px]">
                                                    <h6 class="mb-0 text-sm font-semibold leading-normal text-slate-700 truncate" title="{{ $item->judul }}">{{ $item->judul }}</h6>
                                                    <p class="mb-0 text-xs leading-tight text-slate-400"><i class="fas fa-clock mr-1"></i> {{ $item->baca_menit }} menit baca</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="px-3 py-1.5 text-xs font-bold uppercase rounded-lg bg-emerald-100 text-emerald-700 inline-block whitespace-nowrap text-center align-baseline leading-none">
                                                {{ $item->kategori }}
                                            </span>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-sm font-semibold leading-tight text-slate-600">
                                                {{ \Carbon\Carbon::parse($item->tanggal_publikasi)->format('d M Y') }}
                                            </p>
                                        </td>
                                        @if(auth()->check() && auth()->user()->role != 'owner')
                                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <button type="button" data-berita="{{ json_encode($item) }}" onclick="openEditModal(this)" class="text-xs font-semibold leading-tight text-slate-400 mr-3 hover:text-blue-500 transition-colors">
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-xs font-semibold leading-tight text-red-400 hover:text-red-600 transition-colors">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="p-4 text-center text-sm text-slate-500">
                                            Tidak ada data berita yang ditemukan.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="p-4">
                                {{ $beritas->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('modals')
<!-- Modal Tambah/Edit Berita -->
<div id="beritaModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black bg-opacity-50 overflow-y-auto pt-10 pb-10">
    <div class="relative w-full max-w-4xl p-6 bg-white rounded-2xl shadow-xl mx-4 my-auto">
        <div class="flex items-center justify-between mb-4 border-b pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modalTitle">Tambah Berita Baru</h3>
            <button type="button" onclick="closeModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-colors">
                <i class="fas fa-times text-lg px-1"></i>
            </button>
        </div>
        
        <form id="beritaForm" action="{{ route('admin.berita.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 max-h-[75vh] overflow-y-auto px-2 pb-4 pt-2">
                
                <!-- Kiri: Info Utama -->
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-5 shadow-sm">
                    <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                        <div class="bg-emerald-100 text-emerald-600 w-8 h-8 flex items-center justify-center rounded-lg shadow-sm">
                            <i class="fas fa-newspaper text-sm"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 text-base m-0">Konten Berita</h4>
                    </div>
                    
                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-slate-700">Judul Berita <span class="text-red-500">*</span></label>
                        <input type="text" name="judul" id="judul" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" placeholder="Contoh: Turnamen Bulutangkis Nasional" required>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Kategori <span class="text-red-500">*</span></label>
                            <input type="text" name="kategori" id="kategori" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" placeholder="Cth: Turnamen, Tips" required>
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Waktu Baca (Menit) <span class="text-red-500">*</span></label>
                            <input type="number" name="baca_menit" id="baca_menit" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" min="1" placeholder="Cth: 5" required>
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-slate-700">Tanggal Publikasi <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_publikasi" id="tanggal_publikasi" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" required>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-slate-700">Gambar Cover <span class="text-xs font-normal text-slate-400" id="gambarLabel">(Wajib untuk Berita Baru)</span></label>
                        <input type="file" name="gambar" id="gambar" accept="image/*" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm">
                        <p class="text-xs text-slate-500 mt-1">Format: JPG, PNG, JPEG. Max: 2MB.</p>
                    </div>
                </div>

                <!-- Kanan: Isi Konten -->
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-5 shadow-sm flex flex-col">
                    <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                        <div class="bg-blue-100 text-blue-600 w-8 h-8 flex items-center justify-center rounded-lg shadow-sm">
                            <i class="fas fa-align-left text-sm"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 text-base m-0">Teks Artikel</h4>
                    </div>

                    <div class="flex-1 flex flex-col">
                        <label class="block mb-1.5 text-sm font-semibold text-slate-700">Isi Konten Berita <span class="text-red-500">*</span></label>
                        <input id="konten" type="hidden" name="konten" required>
                        <trix-editor input="konten" class="trix-content bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm flex-1 overflow-y-auto"></trix-editor>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end pt-4 border-t mt-4 gap-2">
                <button type="button" onclick="closeModal()" class="text-gray-700 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors">
                    Batal
                </button>
                <button type="submit" id="submitBtn" class="text-white bg-gradient-to-r from-emerald-500 to-teal-500 hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md transition-all">
                    Simpan Berita
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('beritaModal');
    const form = document.getElementById('beritaForm');
    const title = document.getElementById('modalTitle');
    const submitBtn = document.getElementById('submitBtn');
    const methodInput = document.getElementById('formMethod');
    const gambarInput = document.getElementById('gambar');
    const gambarLabel = document.getElementById('gambarLabel');
    
    function openAddModal() {
        title.textContent = 'Tambah Berita Baru';
        submitBtn.textContent = 'Simpan Berita';
        form.action = "{{ route('admin.berita.store') }}";
        methodInput.value = 'POST';
        form.reset();
        document.querySelector("trix-editor").editor.loadHTML("");
        
        gambarInput.required = true;
        gambarLabel.textContent = '(Wajib)';
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    
    function openEditModal(btn) {
        const berita = JSON.parse(btn.dataset.berita);
        title.textContent = 'Edit Berita';
        submitBtn.textContent = 'Simpan Perubahan';
        form.action = `/berita-admin/${berita.id}`;
        methodInput.value = 'PUT';
        
        // Populate fields
        document.getElementById('judul').value = berita.judul;
        document.getElementById('kategori').value = berita.kategori;
        document.getElementById('baca_menit').value = berita.baca_menit;
        document.getElementById('tanggal_publikasi').value = berita.tanggal_publikasi ? berita.tanggal_publikasi.split(' ')[0] : '';
        document.querySelector("trix-editor").editor.loadHTML(berita.konten);
        
        gambarInput.required = false;
        gambarLabel.textContent = '(Opsional, abaikan jika tidak ingin ganti)';
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    
    function closeModal() {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }

    // Close modal when clicking outside
    modal.addEventListener('click', function(e) {
        if (e.target === modal) {
            closeModal();
        }
    });
</script>
@endsection
