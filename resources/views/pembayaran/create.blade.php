@extends('layouts.app')

@section('title', 'Selesaikan Pembayaran')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24 pb-12">
    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8 text-center animate-fade-in-up">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Selesaikan Pembayaran</h1>
            <p class="text-sm text-gray-500">ID Pesanan: <span class="font-semibold text-gray-700">{{ $reservasi->id_reservasi }}</span></p>
        </div>

        <!-- Alert -->
        @if(session('success'))
        <div class="mb-6 bg-green-50 border border-green-200 text-green-700 px-4 py-3 rounded-xl flex items-center gap-3 animate-fade-in-up">
            <svg class="w-5 h-5 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-100 animate-fade-in-up" style="animation-delay: 0.1s">
            
            <!-- Summary Box -->
            <div class="bg-gradient-to-br from-green-500 to-teal-600 p-8 text-white text-center relative overflow-hidden">
                <div class="absolute -right-8 -top-8 w-32 h-32 bg-white opacity-10 rounded-full"></div>
                <div class="absolute -left-8 -bottom-8 w-24 h-24 bg-black opacity-10 rounded-full"></div>
                
                <div class="relative z-10">
                    <p class="text-green-100 text-sm uppercase tracking-widest font-semibold mb-2">Total Tagihan</p>
                    <h2 class="text-4xl sm:text-5xl font-black mb-4 tracking-tight">Rp {{ number_format($reservasi->total_biaya, 0, ',', '.') }}</h2>
                    <div class="inline-flex items-center justify-center gap-2 bg-white/20 backdrop-blur-sm px-4 py-2 rounded-full text-sm font-medium">
                        <svg class="w-4 h-4 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Menunggu Pembayaran
                    </div>
                </div>
            </div>

            <div class="p-6 sm:p-8">
                <!-- Panduan Transfer -->
                <div class="mb-8">
                    <h3 class="text-lg font-bold text-gray-900 mb-4 border-b border-gray-100 pb-2">Instruksi Pembayaran</h3>
                    <div class="bg-blue-50/50 border border-blue-100 rounded-xl p-5">
                        <p class="text-sm text-blue-800 mb-4 font-medium">Silakan transfer persis sejumlah tagihan ke rekening di bawah ini:</p>
                        
                        <div class="flex flex-col sm:flex-row items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-blue-50">
                            <div class="w-full sm:w-20 h-12 bg-gray-50 rounded-lg flex items-center justify-center font-black text-blue-900 text-xl tracking-wider border border-gray-100">BCA</div>
                            <div class="text-center sm:text-left flex-1">
                                <p class="text-xs text-gray-500 uppercase font-semibold">Nomor Rekening</p>
                                <p class="text-xl sm:text-2xl font-bold text-gray-900 tracking-wider my-1">8765 4321 00</p>
                                <p class="text-xs text-gray-500 font-medium">a.n. Arena Prime Badminton</p>
                            </div>
                            <button type="button" class="mt-2 sm:mt-0 p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors flex items-center gap-1 text-sm font-semibold" onclick="navigator.clipboard.writeText('8765432100'); alert('Nomor rekening disalin!')">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                <span class="sm:hidden">Salin</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Form Upload -->
                <form action="{{ route('pembayaran.store', $reservasi->id_reservasi) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="space-y-6">
                        
                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Metode Pembayaran</label>
                            <div class="relative">
                                <select name="metode_pembayaran" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-gray-50 appearance-none font-medium text-gray-700" required>
                                    <option value="Transfer" selected>Transfer Bank (BCA, Mandiri, BNI)</option>
                                    <option value="QRIS">QRIS / E-Wallet (Gopay, OVO, Dana)</option>
                                </select>
                                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-4 text-gray-500">
                                    <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                                </div>
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-bold text-gray-800 mb-2">Upload Bukti Transfer</label>
                            
                            <!-- Custom File Upload Area -->
                            <div class="mt-2 flex justify-center rounded-xl border-2 border-dashed border-gray-300 px-6 py-10 hover:border-green-400 hover:bg-green-50/50 transition-colors relative" id="drop-zone">
                                <div class="text-center" id="upload-content">
                                    <div class="mx-auto h-16 w-16 bg-white shadow-sm rounded-full flex items-center justify-center border border-gray-100 mb-4">
                                        <svg class="h-8 w-8 text-green-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                            <polyline points="17 8 12 3 7 8"></polyline>
                                            <line x1="12" y1="3" x2="12" y2="15"></line>
                                        </svg>
                                    </div>
                                    <div class="flex text-sm leading-6 text-gray-600 justify-center items-center gap-1">
                                        <label for="file-upload" class="relative cursor-pointer rounded-md font-bold text-green-600 hover:text-green-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-green-600 focus-within:ring-offset-2">
                                            <span>Klik untuk upload</span>
                                            <input id="file-upload" name="bukti_pembayaran" type="file" class="sr-only" accept="image/png, image/jpeg, image/jpg" required onchange="previewImage(event)">
                                        </label>
                                        <p>atau drag and drop</p>
                                    </div>
                                    <p class="text-xs leading-5 text-gray-400 mt-2 font-medium">PNG, JPG, JPEG maksimal 2MB</p>
                                </div>

                                <!-- Image Preview (Hidden by default) -->
                                <div id="image-preview-container" class="hidden absolute inset-0 w-full h-full bg-white rounded-xl p-3 flex items-center justify-center z-10">
                                    <img id="image-preview" src="#" alt="Preview" class="h-full object-contain rounded-lg shadow-sm border border-gray-100">
                                    <button type="button" onclick="clearImage()" class="absolute -top-3 -right-3 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 shadow-lg transform hover:scale-110 transition-transform">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                                    </button>
                                </div>
                            </div>
                            @error('bukti_pembayaran')
                                <p class="text-red-500 text-sm font-medium mt-2 flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <button type="submit" class="mt-8 w-full bg-gray-900 text-white font-bold py-4 px-4 rounded-xl shadow-lg hover:shadow-xl hover:bg-black transform hover:-translate-y-1 transition-all duration-200 flex justify-center items-center gap-2">
                            Kirim Bukti Pembayaran
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                        </button>
                    </div>
                </form>

            </div>
        </div>
        
        <!-- Safe Payment Info -->
        <div class="mt-8 flex items-center justify-center gap-2 text-gray-400 text-sm font-medium">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
            Pembayaran Aman & Diverifikasi Manual
        </div>
    </div>
</div>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
    }
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    .animate-spin-slow {
        animation: spin 3s linear infinite;
    }
</style>

<script>
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('image-preview').src = e.target.result;
                document.getElementById('image-preview-container').classList.remove('hidden');
                document.getElementById('upload-content').classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    function clearImage() {
        document.getElementById('file-upload').value = "";
        document.getElementById('image-preview-container').classList.add('hidden');
        document.getElementById('upload-content').classList.remove('hidden');
    }
</script>
@endsection
