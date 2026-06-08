@csrf

<div class="grid grid-cols-1 md:grid-cols-2 gap-5">

    {{-- ID Lapangan --}}
    <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700">
            ID Lapangan
        </label>
        <input type="text"
            name="id_lapangan"
            value="{{ old('id_lapangan', $lapangan->id_lapangan ?? '') }}"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none"
            placeholder="Contoh: LP001"
            {{ isset($lapangan) ? 'readonly' : '' }}
            required>
    </div>

    {{-- Nama Lapangan --}}
    <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700">
            Nama Lapangan
        </label>
        <input type="text"
            name="nama_lapangan"
            value="{{ old('nama_lapangan', $lapangan->nama_lapangan ?? '') }}"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none"
            placeholder="Contoh: Lapangan A1"
            required>
    </div>

    {{-- Foto --}}
    <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700">
            Foto
        </label>

        <input type="file"
            name="foto"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 bg-white">

        @if(isset($lapangan) && $lapangan->foto)
        <p class="mt-2 text-sm text-gray-500">Foto saat ini:</p>
        <img src="{{ asset('images/' . $lapangan->foto) }}"
            class="w-32 h-32 mt-1 rounded-xl object-cover shadow">
        @endif
    </div>

    {{-- Jenis Lantai --}}
    <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700">
            Jenis Lantai
        </label>
        <input type="text"
            name="jenis_lantai"
            value="{{ old('jenis_lantai', $lapangan->jenis_lantai ?? '') }}"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none"
            placeholder="Contoh: Vinyl"
            required>
    </div>

    {{-- Harga --}}
    <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700">
            Harga Per Jam
        </label>
        <input type="number"
            name="harga_per_jam"
            value="{{ old('harga_per_jam', $lapangan->harga_per_jam ?? '') }}"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none"
            placeholder="Contoh: 85000"
            required>
    </div>

    {{-- Status --}}
    <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700">
            Status
        </label>
        <select name="status"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none"
            required>
            <option value="tersedia" {{ old('status', $lapangan->status ?? '') == 'tersedia' ? 'selected' : '' }}>
                Tersedia
            </option>
            <option value="perbaikan" {{ old('status', $lapangan->status ?? '') == 'perbaikan' ? 'selected' : '' }}>
                Perbaikan
            </option>
        </select>
    </div>

    {{-- Jam Buka --}}
    <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700">
            Jam Buka
        </label>

        <select
            name="jam_buka"
            size="1"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none"
            required>

            @for ($i = 7; $i <= 22; $i++)

                @php
                $jam=sprintf('%02d:00', $i);
                @endphp

                <option value="{{ $jam }}"
                {{ old('jam_buka', $lapangan->jam_buka ?? '') == $jam ? 'selected' : '' }}>
                {{ $jam }}
                </option>

                @endfor

        </select>
    </div>

    {{-- Jam Tutup --}}
    <div>
        <label class="block mb-2 text-sm font-semibold text-gray-700">
            Jam Tutup
        </label>

        <select
            name="jam_tutup"
            size="1"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none"
            required>

            @for ($i = 7; $i <= 22; $i++)
                @php
                $jam=sprintf('%02d:00', $i);
                @endphp

                <option value="{{ $jam }}"
                {{ old('jam_tutup', $lapangan->jam_tutup ?? '') == $jam ? 'selected' : '' }}>
                {{ $jam }}
                </option>
                @endfor

        </select>
    </div>

    {{-- Deskripsi --}}
    <div class="md:col-span-2">
        <label class="block mb-2 text-sm font-semibold text-gray-700">
            Deskripsi
        </label>
        <textarea name="deskripsi"
            rows="4"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none"
            placeholder="Masukkan deskripsi lapangan"
            required>{{ old('deskripsi', $lapangan->deskripsi ?? '') }}</textarea>
    </div>

    {{-- Fasilitas --}}
    <div class="md:col-span-2">
        <label class="block mb-2 text-sm font-semibold text-gray-700">
            Fasilitas
        </label>
        <input type="text"
            name="fasilitas"
            value="{{ old('fasilitas', $lapangan->fasilitas ?? '') }}"
            class="w-full px-4 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-green-400 focus:border-green-400 outline-none"
            placeholder="Contoh: Lampu LED, Lantai Premium, Ruang Tunggu"
            required>
    </div>

</div>

<div class="flex justify-end gap-3 mt-6">

    <a href="{{ route('admin.lapangan.index') }}"
        class="px-5 py-2.5 rounded-xl border border-gray-300 text-gray-700 hover:bg-gray-100 transition">
        Batal
    </a>

    <button type="submit"
        class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-green-500 to-teal-500 text-white font-semibold shadow-md hover:shadow-lg transition">
        Simpan
    </button>

</div>