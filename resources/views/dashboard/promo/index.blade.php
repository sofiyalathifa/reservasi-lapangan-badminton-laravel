@extends ('layouts.sidebar')

@section('title', 'Kelola Promo')

@section('content')
<main class="relative h-full max-h-screen transition-all duration-200 ease-in-out lg:ml-68 rounded-xl">
    <div class="w-full px-6 py-6 mx-auto">

        @if(session('success'))
        <div class="p-4 mb-4 text-sm text-green-800 rounded-lg bg-green-50" role="alert">
            <span class="font-medium">Berhasil!</span> {{ session('success') }}
        </div>
        @endif

        @if($errors->any())
        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50" role="alert">
            <ul class="list-disc pl-4">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="flex flex-wrap -mx-3">
            <div class="flex-none w-full max-w-full px-3">
                <div class="relative flex flex-col min-w-0 mb-6 break-words bg-white border-0 border-transparent border-solid shadow-xl rounded-2xl bg-clip-border">
                    <div class="p-6 pb-0 mb-0 border-b-0 border-b-solid rounded-t-2xl border-b-transparent">
                        <div class="flex flex-wrap -mx-3 items-center justify-between">
                            <div class="flex items-center flex-none w-1/2 max-w-full px-3">
                                <h6 class="mb-0">Data Promo</h6>
                            </div>
                            <div class="flex items-center justify-end flex-none w-1/2 max-w-full px-3 gap-3">
                                <form action="{{ route('admin.promo.index') }}" method="GET" class="flex items-center m-0">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                            <i class="fas fa-search text-sm"></i>
                                        </div>
                                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/kode..." class="pl-9 text-sm border border-slate-300 rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all w-full max-w-[200px]">
                                    </div>
                                    <button type="submit" class="hidden"></button>
                                </form>
                                @if(auth()->check() && auth()->user()->role != 'owner')
                                <button onclick="openAddModal()" class="inline-block px-5 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all bg-transparent rounded-lg cursor-pointer text-sm ease-in shadow-md bg-150 bg-gradient-to-tl from-emerald-500 to-teal-400 hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                    <i class="fas fa-plus mr-2"></i> Tambah Promo
                                </button>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="flex-auto px-0 pt-0 pb-2 mt-4">
                        <div class="p-0 overflow-x-auto">
                            <table class="items-center w-full mb-0 align-top border-collapse text-slate-500">
                                <thead class="align-bottom">
                                    <tr>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Detail Promo</th>
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Diskon</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Masa Berlaku</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Status</th>
                                        @if(auth()->check() && auth()->user()->role != 'owner')
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($promos as $promo)
                                    <tr>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-sm leading-normal">{{ $promo->nama_promo }}</h6>
                                                    <p class="mb-0 text-xs leading-tight text-slate-400">Kode: <span class="font-bold text-emerald-500">{{ $promo->kode_promo }}</span></p>
                                                    <p class="mb-0 text-xs leading-tight text-slate-400 mt-1 max-w-xs truncate">{{ $promo->deskripsi }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-2 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <p class="mb-0 text-sm font-semibold leading-tight text-slate-600">
                                                @if($promo->tipe_diskon == 'persen')
                                                    {{ $promo->nilai_diskon }}%
                                                @else
                                                    Rp {{ number_format($promo->nilai_diskon, 0, ',', '.') }}
                                                @endif
                                            </p>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent text-sm">
                                            <p class="mb-0 text-sm font-semibold leading-tight text-slate-600">
                                                {{ $promo->tanggal_berakhir ? \Carbon\Carbon::parse($promo->tanggal_berakhir)->format('d M Y') : 'Tanpa Batas Waktu' }}
                                            </p>
                                            <p class="mb-0 text-xs leading-tight text-slate-400">Sisa Kuota: {{ $promo->kuota_total !== null ? $promo->kuota_total : 'Unlimited' }}</p>
                                        </td>
                                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="px-3 py-1.5 text-xs font-bold uppercase rounded-lg {{ $promo->status ? 'bg-emerald-100 text-emerald-700' : 'bg-slate-100 text-slate-700' }} inline-block whitespace-nowrap text-center align-baseline leading-none">
                                                {{ $promo->status ? 'Aktif' : 'Tidak Aktif' }}
                                            </span>
                                        </td>
                                        @if(auth()->check() && auth()->user()->role != 'owner')
                                        <td class="p-2 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <button type="button" data-promo="{{ json_encode($promo) }}" onclick="openEditModal(this)" class="text-xs font-semibold leading-tight text-slate-400 mr-3 hover:text-blue-500 transition-colors">
                                                Edit
                                            </button>
                                            <form action="{{ route('admin.promo.destroy', $promo->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus promo ini?');">
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
                                        <td colspan="5" class="p-4 text-center text-sm text-slate-500">
                                            Tidak ada data promo yang ditemukan.
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="p-4">
                                {{ $promos->links() }}
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
<!-- Modal Tambah/Edit Promo -->
<div id="promoModal" class="fixed inset-0 z-[9999] hidden items-center justify-center bg-black bg-opacity-50 overflow-y-auto pt-10 pb-10">
    <div class="relative w-full max-w-4xl p-6 bg-white rounded-2xl shadow-xl mx-4 my-auto">
        <div class="flex items-center justify-between mb-4 border-b pb-3">
            <h3 class="text-lg font-bold text-gray-900" id="modalTitle">Tambah Promo Baru</h3>
            <button type="button" onclick="closeModal()" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center transition-colors">
                <i class="fas fa-times text-lg px-1"></i>
            </button>
        </div>
        
        <form id="promoForm" action="{{ route('admin.promo.store') }}" method="POST">
            @csrf
            <input type="hidden" name="_method" id="formMethod" value="POST">
            
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 max-h-[75vh] overflow-y-auto px-2 pb-4 pt-2">
                
                <!-- Kiri: Info Utama -->
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-5 shadow-sm">
                    <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                        <div class="bg-emerald-100 text-emerald-600 w-8 h-8 flex items-center justify-center rounded-lg shadow-sm">
                            <i class="fas fa-tag text-sm"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 text-base m-0">Informasi Utama</h4>
                    </div>
                    
                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-slate-700">Nama Promo <span class="text-red-500">*</span></label>
                        <input type="text" name="nama_promo" id="nama_promo" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" placeholder="Contoh: Promo Akhir Tahun" required>
                    </div>
                    
                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-slate-700">Kode Promo <span class="text-red-500">*</span></label>
                        <input type="text" name="kode_promo" id="kode_promo" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none uppercase transition-all shadow-sm font-mono tracking-wide placeholder:tracking-normal" placeholder="MERDEKA50" required>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-slate-700">Deskripsi <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" rows="3" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm resize-none" placeholder="Jelaskan detail promo..." required></textarea>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Tipe Diskon <span class="text-red-500">*</span></label>
                            <select name="tipe_diskon" id="tipe_diskon" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" required>
                                <option value="persen">Persen (%)</option>
                                <option value="nominal">Nominal (Rp)</option>
                            </select>
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Nilai Diskon <span class="text-red-500">*</span></label>
                            <input type="number" name="nilai_diskon" id="nilai_diskon" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" required min="1" placeholder="Misal: 20">
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Label <span class="text-red-500">*</span></label>
                            <input type="text" name="tag" id="tag" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm uppercase text-xs" placeholder="Cth: HEMAT" required>
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Status <span class="text-red-500">*</span></label>
                            <select name="status" id="status" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" required>
                                <option value="1">Aktif</option>
                                <option value="0" class="text-slate-600">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Kanan: Syarat & Ketentuan -->
                <div class="bg-slate-50 p-5 rounded-2xl border border-slate-100 space-y-5 shadow-sm">
                    <div class="flex items-center gap-3 border-b border-slate-200 pb-3">
                        <div class="bg-orange-100 text-orange-600 w-8 h-8 flex items-center justify-center rounded-lg shadow-sm">
                            <i class="fas fa-shield-alt text-sm"></i>
                        </div>
                        <h4 class="font-bold text-slate-800 text-base m-0">Syarat & Batasan</h4>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Berakhir Pada <span class="text-xs font-normal text-slate-400">(Opsional)</span></label>
                            <input type="date" name="tanggal_berakhir" id="tanggal_berakhir" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm">
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Kuota Total <span class="text-xs font-normal text-slate-400">(Opsional)</span></label>
                            <input type="number" name="kuota_total" id="kuota_total" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" min="1" placeholder="Tanpa Batas">
                        </div>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Batas Per User <span class="text-xs font-normal text-slate-400">(Opsional)</span></label>
                            <input type="number" name="batas_per_user" id="batas_per_user" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" min="1" placeholder="Cth: 1 Kali">
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Min. Durasi <span class="text-xs font-normal text-slate-400">(Jam)</span></label>
                            <input type="number" name="min_durasi" id="min_durasi" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm" min="1" placeholder="Misal: 2">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-slate-700">Min. Transaksi <span class="text-xs font-normal text-slate-400">(Opsional)</span></label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-0 flex items-center pl-4 text-slate-400 font-medium text-sm">Rp</span>
                            <input type="number" name="min_total_harga" id="min_total_harga" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full pl-10 pr-4 py-2.5 outline-none transition-all shadow-sm" min="0" placeholder="50000">
                        </div>
                    </div>

                    <div>
                        <label class="block mb-1.5 text-sm font-semibold text-slate-700">Hari Berlaku <span class="text-xs font-normal text-slate-400">(Opsional)</span></label>
                        <select name="hari_berlaku" id="hari_berlaku" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm">
                            <option value="semua">Semua Hari</option>
                            <option value="weekday">Weekday (Senin - Jumat)</option>
                            <option value="weekend">Weekend (Sabtu - Minggu)</option>
                        </select>
                    </div>

                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Jam Mulai <span class="text-xs font-normal text-slate-400">(Ops)</span></label>
                            <input type="time" name="jam_mulai_berlaku" id="jam_mulai_berlaku" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm">
                        </div>
                        <div class="flex-1">
                            <label class="block mb-1.5 text-sm font-semibold text-slate-700">Jam Selesai <span class="text-xs font-normal text-slate-400">(Ops)</span></label>
                            <input type="time" name="jam_selesai_berlaku" id="jam_selesai_berlaku" class="bg-white border border-slate-200 text-slate-800 text-sm rounded-xl focus:ring-4 focus:ring-emerald-50 focus:border-emerald-500 block w-full px-4 py-2.5 outline-none transition-all shadow-sm">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="flex justify-end pt-4 border-t mt-4 gap-2">
                <button type="button" onclick="closeModal()" class="text-gray-700 bg-gray-100 hover:bg-gray-200 focus:ring-4 focus:outline-none focus:ring-gray-100 font-medium rounded-lg text-sm px-5 py-2.5 text-center transition-colors">
                    Batal
                </button>
                <button type="submit" id="submitBtn" class="text-white bg-gradient-to-r from-emerald-500 to-teal-500 hover:opacity-90 focus:ring-4 focus:outline-none focus:ring-emerald-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center shadow-md transition-all">
                    Simpan Promo
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    const modal = document.getElementById('promoModal');
    const form = document.getElementById('promoForm');
    const title = document.getElementById('modalTitle');
    const submitBtn = document.getElementById('submitBtn');
    const methodInput = document.getElementById('formMethod');
    
    function openAddModal() {
        title.textContent = 'Tambah Promo Baru';
        submitBtn.textContent = 'Simpan Promo';
        form.action = "{{ route('admin.promo.store') }}";
        methodInput.value = 'POST';
        form.reset();
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
    
    function openEditModal(btn) {
        const promo = JSON.parse(btn.dataset.promo);
        title.textContent = 'Edit Promo';
        submitBtn.textContent = 'Simpan Perubahan';
        form.action = `/promo-admin/${promo.id}`;
        methodInput.value = 'PUT';
        
        // Populate fields
        document.getElementById('nama_promo').value = promo.nama_promo;
        document.getElementById('kode_promo').value = promo.kode_promo;
        document.getElementById('deskripsi').value = promo.deskripsi;
        document.getElementById('tipe_diskon').value = promo.tipe_diskon;
        document.getElementById('nilai_diskon').value = promo.nilai_diskon;
        document.getElementById('tag').value = promo.tag;
        document.getElementById('status').value = promo.status ? '1' : '0';
        
        // Optional fields
        document.getElementById('tanggal_berakhir').value = promo.tanggal_berakhir ? promo.tanggal_berakhir.split('T')[0] : '';
        document.getElementById('kuota_total').value = promo.kuota_total || '';
        document.getElementById('batas_per_user').value = promo.batas_per_user || '';
        document.getElementById('min_durasi').value = promo.min_durasi || '';
        document.getElementById('min_total_harga').value = promo.min_total_harga || '';
        document.getElementById('hari_berlaku').value = promo.hari_berlaku || 'semua';
        document.getElementById('jam_mulai_berlaku').value = promo.jam_mulai_berlaku ? promo.jam_mulai_berlaku.substring(0, 5) : '';
        document.getElementById('jam_selesai_berlaku').value = promo.jam_selesai_berlaku ? promo.jam_selesai_berlaku.substring(0, 5) : '';
        
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
