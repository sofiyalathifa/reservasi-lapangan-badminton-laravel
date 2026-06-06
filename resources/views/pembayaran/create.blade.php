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
                    
                    <!-- BCA -->
                    <div id="instruksi-BCA" class="payment-instruction bg-blue-50/50 border border-blue-100 rounded-xl p-5 block">
                        <p class="text-sm text-blue-800 mb-4 font-medium">Silakan transfer persis sejumlah tagihan ke rekening BCA di bawah ini:</p>
                        <div class="flex items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-blue-50">
                            <div class="w-24 h-16 bg-gray-50 rounded-xl flex shrink-0 items-center justify-center font-black text-blue-900 text-2xl tracking-wider border border-gray-200 shadow-inner">BCA</div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wide">Nomor Rekening</p>
                                <p class="text-xl sm:text-2xl font-black text-gray-900 tracking-widest my-1 truncate">8765 4321 00</p>
                                <p class="text-sm text-gray-600 font-semibold truncate">a.n. Arena Prime Badminton</p>
                            </div>
                            <button type="button" class="btn-salin shrink-0 p-3 text-blue-600 bg-blue-50 hover:bg-blue-100 rounded-xl transition-colors flex flex-col items-center justify-center gap-1 text-xs font-bold shadow-sm" onclick="copyRekening('8765432100', this)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                <span>Salin</span>
                            </button>
                        </div>
                    </div>

                    <!-- Mandiri -->
                    <div id="instruksi-Mandiri" class="payment-instruction bg-yellow-50/50 border border-yellow-100 rounded-xl p-5 hidden">
                        <p class="text-sm text-yellow-800 mb-4 font-medium">Silakan transfer persis sejumlah tagihan ke rekening Mandiri di bawah ini:</p>
                        <div class="flex items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-yellow-50">
                            <div class="w-24 h-16 bg-gray-50 rounded-xl flex shrink-0 items-center justify-center font-black text-yellow-600 text-lg tracking-wider border border-gray-200 shadow-inner">MANDIRI</div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wide">Nomor Rekening</p>
                                <p class="text-xl sm:text-2xl font-black text-gray-900 tracking-widest my-1 truncate">1410 0123 4567</p>
                                <p class="text-sm text-gray-600 font-semibold truncate">a.n. Arena Prime Badminton</p>
                            </div>
                            <button type="button" class="btn-salin shrink-0 p-3 text-yellow-600 bg-yellow-50 hover:bg-yellow-100 rounded-xl transition-colors flex flex-col items-center justify-center gap-1 text-xs font-bold shadow-sm" onclick="copyRekening('141001234567', this)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                <span>Salin</span>
                            </button>
                        </div>
                    </div>

                    <!-- BNI -->
                    <div id="instruksi-BNI" class="payment-instruction bg-orange-50/50 border border-orange-100 rounded-xl p-5 hidden">
                        <p class="text-sm text-orange-800 mb-4 font-medium">Silakan transfer persis sejumlah tagihan ke rekening BNI di bawah ini:</p>
                        <div class="flex items-center gap-4 bg-white p-4 rounded-xl shadow-sm border border-orange-50">
                            <div class="w-24 h-16 bg-gray-50 rounded-xl flex shrink-0 items-center justify-center font-black text-orange-600 text-2xl tracking-wider border border-gray-200 shadow-inner">BNI</div>
                            <div class="flex-1 min-w-0">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wide">Nomor Rekening</p>
                                <p class="text-xl sm:text-2xl font-black text-gray-900 tracking-widest my-1 truncate">0987 6543 21</p>
                                <p class="text-sm text-gray-600 font-semibold truncate">a.n. Arena Prime Badminton</p>
                            </div>
                            <button type="button" class="btn-salin shrink-0 p-3 text-orange-600 bg-orange-50 hover:bg-orange-100 rounded-xl transition-colors flex flex-col items-center justify-center gap-1 text-xs font-bold shadow-sm" onclick="copyRekening('0987654321', this)">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                <span>Salin</span>
                            </button>
                        </div>
                    </div>

                    <!-- QRIS -->
                    <div id="instruksi-QRIS" class="payment-instruction bg-teal-50/50 border border-teal-100 rounded-xl p-5 hidden">
                        <p class="text-sm text-teal-800 mb-4 font-medium text-center">Silakan scan kode QRIS di bawah ini menggunakan aplikasi M-Banking atau E-Wallet Anda (Gopay, OVO, Dana, ShopeePay):</p>
                        <div class="flex flex-col items-center gap-4 bg-white p-6 rounded-xl shadow-sm border border-teal-50">
                            <!-- Dummy QRIS Image -->
                            <div class="w-48 h-48 bg-white border-4 border-gray-900 rounded-xl p-2 flex flex-col items-center justify-center relative">
                                <div class="absolute -top-3 bg-white px-2 text-xs font-black text-gray-900">QRIS</div>
                                <svg class="w-full h-full text-gray-800" viewBox="0 0 24 24" fill="currentColor">
                                    <path d="M3 3h8v8H3V3zm2 2v4h4V5H5zm8-2h8v8h-8V3zm2 2v4h4V5h-4zM3 13h8v8H3v-8zm2 2v4h4v-4H5zm13-2h3v2h-3v-2zm-3 0h2v2h-2v-2zm3 3h3v2h-3v-2zm-2 2h2v3h-2v-3zm-3 0h2v2h-2v-2zm0-2h2v2h-2v-2zm-2 0h2v2h-2v-2zm0-2h2v2h-2v-2zm0 4h2v2h-2v-2z"/>
                                </svg>
                            </div>
                            <div class="text-center">
                                <p class="text-xs text-gray-500 uppercase font-bold tracking-wide">Merchant ID</p>
                                <p class="text-lg font-black text-gray-900 tracking-widest my-1">ID1029384756</p>
                                <p class="text-sm text-gray-600 font-semibold">Arena Prime Badminton</p>
                            </div>
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
                                <select name="metode_pembayaran" id="metodeSelect" onchange="changePaymentMethod()" class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:ring-2 focus:ring-green-500 focus:border-green-500 transition-colors bg-gray-50 appearance-none font-medium text-gray-700" required>
                                    <option value="BCA" selected>Transfer Bank - BCA</option>
                                    <option value="Mandiri">Transfer Bank - Mandiri</option>
                                    <option value="BNI">Transfer Bank - BNI</option>
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
                                        <label for="file-upload" class="relative cursor-pointer rounded-md font-bold text-green-600 hover:text-green-500 focus-within:outline-none">
                                            <span>Klik untuk upload</span>
                                            <input id="file-upload" name="bukti_pembayaran" type="file" style="opacity: 0; position: absolute; z-index: -1; width: 1px; height: 1px;" accept="image/png, image/jpeg, image/jpg" required onchange="previewImage(event)">
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

    function copyRekening(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            // Ubah teks tombol sementara
            const span = btn.querySelector('span');
            const originalText = span.innerText;
            span.innerText = 'Tersalin!';
            btn.classList.add('bg-green-100', 'text-green-700');
            btn.classList.remove('bg-blue-50', 'text-blue-600');
            
            // Buat toast notification melayang
            const toast = document.createElement('div');
            toast.className = 'fixed top-20 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white px-6 py-3 rounded-full shadow-2xl z-50 flex items-center gap-3 animate-fade-in-up font-medium text-sm';
            toast.innerHTML = `<svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Nomor rekening disalin ke clipboard!`;
            document.body.appendChild(toast);

            setTimeout(() => {
                // Kembalikan tombol ke bentuk semula
                span.innerText = originalText;
                btn.classList.remove('bg-green-100', 'text-green-700');
                btn.classList.add('bg-blue-50', 'text-blue-600');
                
                // Hilangkan toast secara smooth
                toast.style.opacity = '0';
                toast.style.transform = 'translate(-50%, -20px)';
                toast.style.transition = 'all 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 2500);
        });
    }

    function changePaymentMethod() {
        const selected = document.getElementById('metodeSelect').value;
        
        // Hide all instruction boxes
        document.querySelectorAll('.payment-instruction').forEach(el => {
            el.classList.add('hidden');
            el.classList.remove('block', 'animate-fade-in-up');
        });
        
        // Show the active one
        const activeEl = document.getElementById('instruksi-' + selected);
        if (activeEl) {
            activeEl.classList.remove('hidden');
            activeEl.classList.add('block', 'animate-fade-in-up');
        }
    }
</script>
@endsection
