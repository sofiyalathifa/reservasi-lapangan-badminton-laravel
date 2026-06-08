@extends ('layouts.sidebar')

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
                                <h6 class="mb-0">Data Pelanggan</h6>
                            </div>
                            <div class="flex items-center justify-end flex-none w-1/2 max-w-full px-3 gap-3">
                                <form action="{{ route('pelanggan.index') }}" method="GET" class="flex items-center m-0">
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none text-slate-400">
                                            <i class="fas fa-search text-sm"></i>
                                        </div>
                                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama/email..." class="pl-9 text-sm border border-slate-300 rounded-lg px-3 py-2 outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 transition-all w-full max-w-[200px]">
                                    </div>
                                    <button type="submit" class="hidden"></button>
                                </form>
                                @if(auth()->check() && auth()->user()->role != 'owner')
                                <button onclick="openAddModal()" class="inline-block px-5 py-2.5 font-bold leading-normal text-center text-white align-middle transition-all bg-transparent rounded-lg cursor-pointer text-sm ease-in shadow-md bg-150 bg-gradient-to-tl from-emerald-500 to-teal-400 hover:shadow-xs hover:-translate-y-px active:opacity-85">
                                    <i class="fas fa-plus mr-2"></i> Tambah
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
                                        <th class="px-6 py-3 font-bold text-left uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Pelanggan</th>
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Bergabung</th>
                                        @if(auth()->check() && auth()->user()->role != 'owner')
                                        <th class="px-6 py-3 font-bold text-center uppercase align-middle bg-transparent border-b border-collapse shadow-none text-xxs border-b-solid tracking-none whitespace-nowrap text-slate-400 opacity-70">Aksi</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($pelanggans as $pelanggan)
                                    <tr>
                                        <td class="p-4 px-6 align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <div class="flex px-2 py-1">
                                                <div>
                                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($pelanggan->name) }}&background=0D8ABC&color=fff&size=128" class="inline-flex items-center justify-center mr-4 text-white transition-all duration-200 ease-in-out h-12 w-12 rounded-xl" alt="avatar" />
                                                </div>
                                                <div class="flex flex-col justify-center">
                                                    <h6 class="mb-0 text-base leading-normal font-semibold">{{ $pelanggan->name }}</h6>
                                                    <p class="mb-0 text-sm leading-tight text-slate-400">{{ $pelanggan->email }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="p-4 px-6 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <span class="text-sm font-semibold leading-tight text-slate-400">{{ \Carbon\Carbon::parse($pelanggan->created_at)->format('d M Y') }}</span>
                                        </td>
                                        @if(auth()->check() && auth()->user()->role != 'owner')
                                        <td class="p-4 px-6 text-center align-middle bg-transparent border-b whitespace-nowrap shadow-transparent">
                                            <button onclick="openEditModal('{{ $pelanggan->id }}', '{{ addslashes($pelanggan->name) }}', '{{ $pelanggan->email }}')" class="text-sm font-semibold leading-tight text-blue-500 hover:text-blue-700 mr-4 cursor-pointer">
                                                <i class="fas fa-edit mr-1"></i> Edit
                                            </button>
                                            <button type="button" onclick="openDeleteModal('{{ $pelanggan->id }}', '{{ addslashes($pelanggan->name) }}')" class="text-sm font-semibold leading-tight text-red-500 hover:text-red-700 cursor-pointer">
                                                <i class="fas fa-trash mr-1"></i> Hapus
                                            </button>
                                        </td>
                                        @endif
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="p-4 text-center text-sm">Belum ada data pelanggan.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="p-4 mt-2">
                            {{ $pelanggans->links('vendor.pagination.tailwind') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>

{{-- Hidden form templates for modals (will be moved to body via JS) --}}
<template id="addModalTemplate">
    <div id="addModal" style="position:fixed;inset:0;z-index:99999;display:flex;align-items:center;justify-content:center;">
        <div style="position:fixed;inset:0;background:rgba(0,0,0,0.5);backdrop-filter:blur(4px);" onclick="closeModal('addModal')"></div>
        <div style="position:relative;background:#fff;border-radius:16px;box-shadow:0 25px 50px rgba(0,0,0,0.25);width:100%;max-width:480px;margin:1rem;animation:modalIn 0.25s ease-out;">
            <div style="padding:24px 28px 0;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                    <h3 style="font-size:1.25rem;font-weight:700;color:#1e293b;margin:0;">Tambah Pelanggan Baru</h3>
                    <button onclick="closeModal('addModal')" style="width:32px;height:32px;border-radius:8px;border:none;background:#f1f5f9;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:#64748b;transition:all .2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">&times;</button>
                </div>
            </div>
            <form action="{{ route('pelanggan.store') }}" method="POST" style="padding:0 28px 24px;" autocomplete="off">
                @csrf
                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:6px;font-size:0.875rem;font-weight:600;color:#374151;">Nama Lengkap</label>
                    <input type="text" name="name" required style="width:100%;padding:10px 14px;border:1.5px solid #d1d5db;border-radius:10px;font-size:0.9rem;outline:none;transition:border .2s;box-sizing:border-box;" onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'" placeholder="Masukkan nama lengkap" autocomplete="off">
                </div>
                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:6px;font-size:0.875rem;font-weight:600;color:#374151;">Email</label>
                    <input type="email" name="email" required style="width:100%;padding:10px 14px;border:1.5px solid #d1d5db;border-radius:10px;font-size:0.9rem;outline:none;transition:border .2s;box-sizing:border-box;" onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'" placeholder="contoh@email.com" autocomplete="off">
                </div>
                <div style="margin-bottom:24px;">
                    <label style="display:block;margin-bottom:6px;font-size:0.875rem;font-weight:600;color:#374151;">Password</label>
                    <input type="password" name="password" required minlength="6" style="width:100%;padding:10px 14px;border:1.5px solid #d1d5db;border-radius:10px;font-size:0.9rem;outline:none;transition:border .2s;box-sizing:border-box;" onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'" placeholder="Minimal 6 karakter" autocomplete="new-password">
                </div>
                <div style="display:flex;gap:10px;justify-content:flex-end;">
                    <button type="button" onclick="closeModal('addModal')" style="padding:10px 20px;border-radius:10px;border:1.5px solid #d1d5db;background:#fff;color:#374151;font-size:0.875rem;font-weight:600;cursor:pointer;transition:all .2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='#fff'">Batal</button>
                    <button type="submit" style="padding:10px 24px;border-radius:10px;border:none;background:linear-gradient(135deg,#10b981,#14b8a6);color:#fff;font-size:0.875rem;font-weight:600;cursor:pointer;transition:all .2s;box-shadow:0 4px 12px rgba(16,185,129,0.3);" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 16px rgba(16,185,129,0.4)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 12px rgba(16,185,129,0.3)'">
                        <i class="fas fa-save mr-1"></i> Simpan
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<template id="editModalTemplate">
    <div id="editModal" style="position:fixed;inset:0;z-index:99999;display:flex;align-items:center;justify-content:center;">
        <div style="position:fixed;inset:0;background:rgba(0,0,0,0.5);backdrop-filter:blur(4px);" onclick="closeModal('editModal')"></div>
        <div style="position:relative;background:#fff;border-radius:16px;box-shadow:0 25px 50px rgba(0,0,0,0.25);width:100%;max-width:480px;margin:1rem;animation:modalIn 0.25s ease-out;">
            <div style="padding:24px 28px 0;">
                <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;">
                    <h3 style="font-size:1.25rem;font-weight:700;color:#1e293b;margin:0;">Edit Pelanggan</h3>
                    <button onclick="closeModal('editModal')" style="width:32px;height:32px;border-radius:8px;border:none;background:#f1f5f9;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:1.1rem;color:#64748b;transition:all .2s;" onmouseover="this.style.background='#e2e8f0'" onmouseout="this.style.background='#f1f5f9'">&times;</button>
                </div>
            </div>
            <form id="editForm" method="POST" style="padding:0 28px 24px;" autocomplete="off">
                @csrf
                @method('PUT')
                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:6px;font-size:0.875rem;font-weight:600;color:#374151;">Nama Lengkap</label>
                    <input type="text" name="name" id="edit_nama" required style="width:100%;padding:10px 14px;border:1.5px solid #d1d5db;border-radius:10px;font-size:0.9rem;outline:none;transition:border .2s;box-sizing:border-box;" onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'" autocomplete="off">
                </div>
                <div style="margin-bottom:16px;">
                    <label style="display:block;margin-bottom:6px;font-size:0.875rem;font-weight:600;color:#374151;">Email</label>
                    <input type="email" name="email" id="edit_email" required style="width:100%;padding:10px 14px;border:1.5px solid #d1d5db;border-radius:10px;font-size:0.9rem;outline:none;transition:border .2s;box-sizing:border-box;" onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'" autocomplete="off">
                </div>
                <div style="margin-bottom:24px;">
                    <label style="display:block;margin-bottom:6px;font-size:0.875rem;font-weight:600;color:#374151;">Password <span style="font-weight:400;color:#9ca3af;">(Kosongkan jika tidak diubah)</span></label>
                    <input type="password" name="password" id="edit_password" minlength="6" style="width:100%;padding:10px 14px;border:1.5px solid #d1d5db;border-radius:10px;font-size:0.9rem;outline:none;transition:border .2s;box-sizing:border-box;" onfocus="this.style.borderColor='#3b82f6';this.style.boxShadow='0 0 0 3px rgba(59,130,246,0.1)'" onblur="this.style.borderColor='#d1d5db';this.style.boxShadow='none'" placeholder="Minimal 6 karakter" autocomplete="new-password">
                </div>
                <div style="display:flex;gap:10px;justify-content:flex-end;">
                    <button type="button" onclick="closeModal('editModal')" style="padding:10px 20px;border-radius:10px;border:1.5px solid #d1d5db;background:#fff;color:#374151;font-size:0.875rem;font-weight:600;cursor:pointer;transition:all .2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='#fff'">Batal</button>
                    <button type="submit" style="padding:10px 24px;border-radius:10px;border:none;background:linear-gradient(135deg,#3b82f6,#6366f1);color:#fff;font-size:0.875rem;font-weight:600;cursor:pointer;transition:all .2s;box-shadow:0 4px 12px rgba(59,130,246,0.3);" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 16px rgba(59,130,246,0.4)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 12px rgba(59,130,246,0.3)'">
                        <i class="fas fa-save mr-1"></i> Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<template id="deleteModalTemplate">
    <div id="deleteModal" style="position:fixed;inset:0;z-index:99999;display:flex;align-items:center;justify-content:center;">
        <div style="position:fixed;inset:0;background:rgba(0,0,0,0.5);backdrop-filter:blur(4px);" onclick="closeModal('deleteModal')"></div>
        <div style="position:relative;background:#fff;border-radius:16px;box-shadow:0 25px 50px rgba(0,0,0,0.25);width:100%;max-width:400px;margin:1rem;animation:modalIn 0.25s ease-out;text-align:center;">
            <div style="padding:32px 28px 24px;">
                <div style="width:64px;height:64px;background:#fee2e2;border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 20px;">
                    <i class="fas fa-exclamation-triangle" style="font-size:28px;color:#ef4444;"></i>
                </div>
                <h3 style="font-size:1.25rem;font-weight:700;color:#1e293b;margin:0 0 10px;">Konfirmasi Hapus</h3>
                <p style="font-size:0.95rem;color:#64748b;margin:0;line-height:1.5;">Apakah Anda yakin ingin menghapus pelanggan <strong id="delete_nama" style="color:#1e293b;"></strong>? Data yang dihapus tidak dapat dikembalikan.</p>
            </div>
            <div style="padding:16px 28px 24px;display:flex;gap:12px;justify-content:center;">
                <form id="deleteForm" method="POST" style="margin:0;">
                    @csrf
                    @method('DELETE')
                    <button type="button" onclick="closeModal('deleteModal')" style="padding:10px 20px;border-radius:10px;border:1.5px solid #d1d5db;background:#fff;color:#374151;font-size:0.875rem;font-weight:600;cursor:pointer;transition:all .2s;" onmouseover="this.style.background='#f9fafb'" onmouseout="this.style.background='#fff'">Batal</button>
                    <button type="submit" style="padding:10px 24px;border-radius:10px;border:none;background:linear-gradient(135deg,#ef4444,#f43f5e);color:#fff;font-size:0.875rem;font-weight:600;cursor:pointer;transition:all .2s;box-shadow:0 4px 12px rgba(239,68,68,0.3);" onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 16px rgba(239,68,68,0.4)'" onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 12px rgba(239,68,68,0.3)'">
                        Ya, Hapus
                    </button>
                </form>
            </div>
        </div>
    </div>
</template>

<style>
    @keyframes modalIn {
        from { opacity: 0; transform: scale(0.95) translateY(10px); }
        to { opacity: 1; transform: scale(1) translateY(0); }
    }
</style>

<script>
    function openAddModal() {
        closeModal('addModal'); // cleanup if exists
        var tpl = document.getElementById('addModalTemplate');
        var clone = tpl.content.cloneNode(true);
        document.body.appendChild(clone);
    }

    function openEditModal(id, nama, email) {
        closeModal('editModal'); // cleanup if exists
        var tpl = document.getElementById('editModalTemplate');
        var clone = tpl.content.cloneNode(true);
        document.body.appendChild(clone);

        document.getElementById('editForm').action = '/pelanggan/' + id;
        document.getElementById('edit_nama').value = nama;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_password').value = '';
    }

    function openDeleteModal(id, nama) {
        closeModal('deleteModal'); // cleanup if exists
        var tpl = document.getElementById('deleteModalTemplate');
        var clone = tpl.content.cloneNode(true);
        document.body.appendChild(clone);

        document.getElementById('deleteForm').action = '/pelanggan/' + id;
        document.getElementById('delete_nama').textContent = nama;
    }

    function closeModal(id) {
        var el = document.getElementById(id);
        if (el) {
            el.style.animation = 'none';
            el.remove();
        }
    }
</script>
@endsection