@extends ('layouts.sidebar')

@section('content')

<main class="relative min-h-screen transition-all duration-200 ease-in-out lg:ml-72">

    <div class="px-8 py-8">

        <div class="bg-white rounded-2xl shadow-lg p-6">

            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-800">
                    Daftar Lapangan
                </h1>
                <div class="flex items-center md:ml-auto md:pr-4 relative">

                    {{-- Search Input --}}
                    <form method="GET" action="{{ route('admin.lapangan.index') }}" class="flex items-center w-full">
                        <div class="relative flex flex-wrap items-stretch w-full transition-all rounded-lg ease">

                            <span class="text-sm absolute inset-y-0 left-0 flex items-center pl-2.5 text-gray-500">
                                <i class="fas fa-search"></i>
                            </span>

                            <input type="text" name="keyword"
                                value="{{ request('keyword') }}"
                                class="pl-9 pr-12 w-full text-sm py-2.5 rounded-lg border border-gray-300 focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none"
                                placeholder="Cari Lapangan..." />
                        </div>

                        {{-- Tombol Filter --}}
                        <div class="relative ml-2">
                            <button type="button"
                                class="inline-flex items-center justify-center w-12 h-12 rounded-xl border border-gray-300 bg-white text-gray-700 hover:bg-gray-100 transition"
                                onclick="document.getElementById('filterDropdown').classList.toggle('hidden')">
                                <i class="fas fa-filter text-lg"></i>
                            </button>

                            {{-- Dropdown Filter --}}
                            <div id="filterDropdown" class="absolute right-0 mt-2 w-48 bg-white border border-gray-300 rounded-lg shadow-lg hidden z-50">
                                <form method="GET" action="{{ route('admin.lapangan.index') }}" class="px-2 space-y-2">
                                    <label class="block text-sm font-medium text-gray-700">Status</label>
                                    <select name="status" class="w-full border border-gray-300 rounded px-3 py-2">
                                        <option value="">Semua</option>
                                        <option value="tersedia" {{ request('status') == 'tersedia' ? 'selected' : '' }}>Tersedia</option>
                                        <option value="perbaikan" {{ request('status') == 'perbaikan' ? 'selected' : '' }}>Perbaikan</option>
                                    </select>

                                    <label class="block text-sm font-medium text-gray-700 ">Jenis Lantai</label>
                                    <input type="text" name="jenis_lantai" value="{{ request('jenis_lantai') }}"
                                        class="w-full border border-gray-300 rounded px-3 py-2" placeholder="Contoh: Vinyl">

                                    <div class="flex justify-between mt-2">
                                        <button type="submit"
                                            class="w-1/2 mr-1 bg-green-500 text-white rounded py-2 hover:bg-green-600 transition">
                                            Terapkan
                                        </button>
                                        <a href="{{ route('admin.lapangan.index') }}"
                                            class="w-1/2 ml-1 text-center border border-gray-300 rounded py-2 hover:bg-gray-100 transition">
                                            Reset
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </form>

                </div>
                <a href="{{ route('admin.lapangan.create') }}"
                    class="inline-flex items-center gap-2 px-5 py-2.5 bg-gradient-to-r from-green-500 to-teal-500 text-white rounded-xl shadow-md hover:shadow-lg hover:scale-[1.02] transition-all duration-200">

                    <i class="fas fa-plus text-sm"></i>

                    <span class="font-medium">
                        Tambah Lapangan
                    </span>

                </a>
            </div>

            {{-- Table --}}
            <div class="overflow-x-auto rounded-xl border border-gray-200">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase"> Foto </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase"> Nama Lapangan </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase"> Jenis Lantai </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase"> Harga/Jam </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase"> Status </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase"> Rating </th>
                            <th class="px-6 py-4 text-left text-xs font-semibold text-gray-500 uppercase"> Ulasan </th>
                            <th class="px-6 py-4 text-center text-xs font-semibold text-gray-500 uppercase"> Aksi </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-100"> @forelse ($lapangan as $item) <tr class="hover:bg-gray-50 transition"> {{-- Foto --}}
                            <td class="px-6 py-4 whitespace-nowrap"> <img src="{{ asset('images/' . $item->foto) }}" alt="{{ $item->nama_lapangan }}" class="w-16 h-16 rounded-xl object-cover shadow"> </td> {{-- Nama --}}
                            <td class="px-6 py-4">
                                <div class="font-semibold text-gray-800"> {{ $item->nama_lapangan }} </div>
                                <div class="text-sm text-gray-500 mt-1"> {{ Str::limit($item->deskripsi, 50) }} </div>
                            </td> {{-- Jenis Lantai --}}
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700"> {{ $item->jenis_lantai }} </td> {{-- Harga --}}
                            <td class="px-6 py-4 whitespace-nowrap font-medium text-gray-800"> Rp {{ number_format($item->harga_per_jam, 0, ',', '.') }} </td> {{-- Status --}}
                            <td class="px-6 py-4 whitespace-nowrap"> @if($item->status == 'tersedia') <span class="px-3 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-700"> Tersedia </span> @else <span class="px-3 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-700"> Perbaikan </span> @endif </td> {{-- Rating --}}
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center gap-1"> <i class="fas fa-star text-yellow-400"></i> <span class="font-medium text-gray-700"> {{ number_format($item->rating ?? 0, 1) }} </span> </div>
                            </td> {{-- Jumlah Ulasan --}}
                            <td class="px-6 py-4 whitespace-nowrap text-gray-700"> {{ $item->jumlah_ulasan ?? 0 }} Ulasan </td> {{-- Aksi --}}
                            <td class="px-6 py-4 whitespace-nowrap text-center">
                                <div class="flex items-center justify-center gap-2">
                                    <a href="{{ route('admin.lapangan.edit', $item->id_lapangan) }}" class="px-3 py-1.5 text-sm rounded-lg bg-blue-500 text-white hover:bg-blue-600 transition"> Edit </a>
                                    <form action="{{ route('admin.lapangan.destroy', $item->id_lapangan) }}"
                                        method="POST"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit"
                                            class="px-3 py-1.5 text-sm rounded-lg bg-red-500 text-white hover:bg-red-600 transition">
                                            Hapus
                                        </button>

                                    </form>
                                </div>
                            </td>
                        </tr> @empty <tr>
                            <td colspan="8" class="px-6 py-8 text-center text-gray-500"> Data lapangan belum tersedia </td>
                        </tr> @endforelse </tbody>
                </table>
            </div>

        </div>

    </div>

</main>

@endsection