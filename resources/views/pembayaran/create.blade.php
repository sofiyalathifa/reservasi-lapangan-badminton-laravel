@extends('layouts.app')

@section('title', 'Selesaikan Pembayaran')

@section('content')
<div class="min-h-screen bg-gray-50 pt-24 pb-12">
    <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="mb-8 text-center animate-fade-in-up">
            <h1 class="text-3xl font-extrabold text-gray-900 mb-2">Selesaikan Pembayaran</h1>
            <p class="text-gray-500">ID Pesanan: <span class="font-bold text-gray-800 bg-gray-100 px-2 py-1 rounded-md">{{ $reservasi->id_reservasi }}</span></p>
        </div>

        <!-- Alert -->
        @if(session('success'))
        <div class="max-w-3xl mx-auto mb-8 bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-xl flex items-center gap-3 animate-fade-in-up shadow-sm">
            <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span class="font-medium">{{ session('success') }}</span>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- LEFT COLUMN: Summary & Instructions -->
            <div class="lg:col-span-7 space-y-6 animate-fade-in-up" style="animation-delay: 0.1s">
                
                <!-- Total Tagihan Card -->
                <div class="bg-gradient-to-br from-green-500 to-teal-600 p-8 rounded-2xl shadow-lg text-white text-center relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-white opacity-10 rounded-full blur-2xl"></div>
                    <div class="absolute -left-8 -bottom-8 w-24 h-24 bg-black opacity-10 rounded-full blur-xl"></div>
                    
                    <div class="relative z-10">
                        <p class="text-green-100 text-sm uppercase tracking-widest font-semibold mb-2">Total Tagihan</p>
                        <h2 class="text-4xl sm:text-5xl font-black mb-4 tracking-tight drop-shadow-md">Rp {{ number_format($reservasi->total_biaya, 0, ',', '.') }}</h2>
                        <div class="inline-flex items-center justify-center gap-2 bg-white/20 backdrop-blur-md border border-white/30 px-5 py-2 rounded-full text-sm font-medium shadow-sm">
                            <svg class="w-4 h-4 animate-spin-slow" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Menunggu Pembayaran
                        </div>
                        @php
                            $deadline = \Carbon\Carbon::parse($reservasi->created_at)->addHours(24);
                        @endphp
                        <p class="mt-4 text-green-50 text-sm font-medium">Selesaikan sebelum <strong class="text-white tracking-wide">{{ $deadline->format('H:i') }} WIB, {{ $deadline->format('d/m/Y') }}</strong></p>
                    </div>
                </div>

                <!-- Metode & Instruksi Pembayaran -->
                <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 sm:p-8">
                    <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
                        <svg class="w-6 h-6 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path></svg>
                        Metode Pembayaran
                    </h3>

                    <!-- Select Metode -->
                    <div class="mb-6 relative">
                        <select name="metode_pembayaran_pilih" id="metodeSelect" onchange="changePaymentMethod()" class="w-full px-5 py-4 rounded-xl border border-gray-300 focus:ring-4 focus:ring-green-500/20 focus:border-green-500 transition-all bg-gray-50/50 hover:bg-gray-50 appearance-none font-semibold text-gray-800 text-lg cursor-pointer shadow-sm">
                            <option value="BCA" selected>Transfer Bank - BCA</option>
                            <option value="Mandiri">Transfer Bank - Mandiri</option>
                            <option value="BNI">Transfer Bank - BNI</option>
                            <option value="QRIS">QRIS / E-Wallet</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-5 text-gray-500">
                            <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path></svg>
                        </div>
                    </div>
                    
                    <!-- BCA -->
                    <div id="instruksi-BCA" class="payment-instruction">
                        <div class="bg-blue-50/50 border border-blue-200 rounded-xl p-6">
                            <p class="text-sm text-blue-800 mb-4 font-medium">Silakan transfer persis sejumlah tagihan ke rekening BCA di bawah ini:</p>
                            <div class="flex flex-col sm:flex-row items-center gap-4 bg-white p-5 rounded-xl shadow-sm border border-blue-100">
                                <div class="w-24 h-16 bg-blue-600 rounded-lg flex shrink-0 items-center justify-center font-black text-white text-2xl tracking-wider shadow-md">BCA</div>
                                <div class="flex-1 text-center sm:text-left min-w-0">
                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Nomor Rekening</p>
                                    <p class="text-2xl font-black text-gray-900 tracking-widest my-1 font-mono">8765 4321 00</p>
                                    <p class="text-sm text-gray-600 font-semibold">a.n. Arena Prime Badminton</p>
                                </div>
                                <button type="button" class="btn-salin w-full sm:w-auto p-3 px-5 text-blue-700 bg-blue-100 hover:bg-blue-200 rounded-xl transition-all font-bold shadow-sm flex items-center justify-center gap-2" onclick="copyRekening('8765432100', this, 'BCA')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    <span>Salin</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Mandiri -->
                    <div id="instruksi-Mandiri" class="payment-instruction hidden">
                        <div class="bg-yellow-50/50 border border-yellow-200 rounded-xl p-6">
                            <p class="text-sm text-yellow-800 mb-4 font-medium">Silakan transfer persis sejumlah tagihan ke rekening Mandiri di bawah ini:</p>
                            <div class="flex flex-col sm:flex-row items-center gap-4 bg-white p-5 rounded-xl shadow-sm border border-yellow-100">
                                <div class="w-24 h-16 bg-yellow-500 rounded-lg flex shrink-0 items-center justify-center font-black text-white text-lg tracking-wider shadow-md">MANDIRI</div>
                                <div class="flex-1 text-center sm:text-left min-w-0">
                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Nomor Rekening</p>
                                    <p class="text-2xl font-black text-gray-900 tracking-widest my-1 font-mono">1410 0123 4567</p>
                                    <p class="text-sm text-gray-600 font-semibold">a.n. Arena Prime Badminton</p>
                                </div>
                                <button type="button" class="btn-salin w-full sm:w-auto p-3 px-5 text-yellow-700 bg-yellow-100 hover:bg-yellow-200 rounded-xl transition-all font-bold shadow-sm flex items-center justify-center gap-2" onclick="copyRekening('141001234567', this, 'Mandiri')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    <span>Salin</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- BNI -->
                    <div id="instruksi-BNI" class="payment-instruction hidden">
                        <div class="bg-orange-50/50 border border-orange-200 rounded-xl p-6">
                            <p class="text-sm text-orange-800 mb-4 font-medium">Silakan transfer persis sejumlah tagihan ke rekening BNI di bawah ini:</p>
                            <div class="flex flex-col sm:flex-row items-center gap-4 bg-white p-5 rounded-xl shadow-sm border border-orange-100">
                                <div class="w-24 h-16 bg-orange-600 rounded-lg flex shrink-0 items-center justify-center font-black text-white text-2xl tracking-wider shadow-md">BNI</div>
                                <div class="flex-1 text-center sm:text-left min-w-0">
                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-wider">Nomor Rekening</p>
                                    <p class="text-2xl font-black text-gray-900 tracking-widest my-1 font-mono">0987 6543 21</p>
                                    <p class="text-sm text-gray-600 font-semibold">a.n. Arena Prime Badminton</p>
                                </div>
                                <button type="button" class="btn-salin w-full sm:w-auto p-3 px-5 text-orange-700 bg-orange-100 hover:bg-orange-200 rounded-xl transition-all font-bold shadow-sm flex items-center justify-center gap-2" onclick="copyRekening('0987654321', this, 'BNI')">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"></path></svg>
                                    <span>Salin</span>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- QRIS -->
                    <div id="instruksi-QRIS" class="payment-instruction hidden">
                        <div class="bg-teal-50/50 border border-teal-200 rounded-xl p-6">
                            <p class="text-sm text-teal-800 mb-6 font-medium text-center">Silakan scan kode QRIS di bawah ini menggunakan M-Banking atau E-Wallet (Gopay, OVO, Dana, LinkAja):</p>
                            <div class="flex flex-col items-center gap-5 bg-white p-6 rounded-xl shadow-sm border border-teal-100 max-w-sm mx-auto">
                                <div class="w-48 h-48 bg-white border-4 border-teal-500 rounded-2xl p-3 flex flex-col items-center justify-center relative shadow-inner">
                                    <div class="absolute -top-4 bg-teal-500 text-white px-4 py-1 rounded-full text-sm font-black shadow-md tracking-wider">QRIS</div>
                                    <svg class="w-full h-full text-gray-800" viewBox="0 0 24 24" fill="currentColor">
                                        <path d="M3 3h8v8H3V3zm2 2v4h4V5H5zm8-2h8v8h-8V3zm2 2v4h4V5h-4zM3 13h8v8H3v-8zm2 2v4h4v-4H5zm13-2h3v2h-3v-2zm-3 0h2v2h-2v-2zm3 3h3v2h-3v-2zm-2 2h2v3h-2v-3zm-3 0h2v2h-2v-2zm0-2h2v2h-2v-2zm-2 0h2v2h-2v-2zm0-2h2v2h-2v-2zm0 4h2v2h-2v-2z"/>
                                    </svg>
                                </div>
                                <div class="text-center w-full">
                                    <p class="text-xs text-gray-500 uppercase font-bold tracking-widest mb-1">Merchant ID</p>
                                    <div class="bg-gray-50 py-2 rounded-lg border border-gray-100">
                                        <p class="text-lg font-black text-gray-900 tracking-widest font-mono">ID1029384756</p>
                                    </div>
                                    <p class="text-sm text-gray-600 font-semibold mt-3">Arena Prime Badminton</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Upload Form -->
            <div class="lg:col-span-5 animate-fade-in-up" style="animation-delay: 0.2s">
                <div class="bg-white rounded-2xl shadow-xl border border-gray-100 p-6 sm:p-8 lg:sticky lg:top-24">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Konfirmasi Pembayaran</h3>
                    <p class="text-sm text-gray-500 mb-6">Upload bukti transfer agar pesananmu segera diproses.</p>

                    <form action="{{ route('pembayaran.store', $reservasi->id_reservasi) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Hidden input to store selected method to submit -->
                        <input type="hidden" name="metode_pembayaran" id="metodeSubmit" value="BCA">

                        <div class="space-y-6">
                            
                            <!-- Upload Area -->
                            <div>
                                <label class="block text-sm font-bold text-gray-800 mb-3">Upload Bukti Transfer <span class="text-red-500">*</span></label>
                                
                                <div class="mt-1 flex justify-center rounded-2xl border-2 border-dashed border-gray-300 px-6 py-12 hover:border-green-500 hover:bg-green-50/30 transition-all duration-300 relative group cursor-pointer" id="drop-zone">
                                    
                                    <!-- Input file menutupi seluruh box -->
                                    <input id="file-upload" name="bukti_pembayaran" type="file" style="opacity: 0; position: absolute; inset: 0; width: 100%; height: 100%; cursor: pointer; z-index: 20;" accept="image/png, image/jpeg, image/jpg" required onchange="previewImage(event)">

                                    <div class="text-center relative z-10 pointer-events-none" id="upload-content">
                                        <div class="mx-auto h-16 w-16 bg-white shadow-sm rounded-full flex items-center justify-center border border-gray-100 mb-4 group-hover:scale-110 group-hover:text-green-500 transition-transform duration-300">
                                            <svg class="h-8 w-8 text-gray-400 group-hover:text-green-500 transition-colors duration-300" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                                                <polyline points="17 8 12 3 7 8"></polyline>
                                                <line x1="12" y1="3" x2="12" y2="15"></line>
                                            </svg>
                                        </div>
                                        <div class="flex text-sm leading-6 text-gray-600 justify-center items-center gap-1">
                                            <span class="font-bold text-green-600">Pilih File</span>
                                            <p>atau drop di sini</p>
                                        </div>
                                        <p class="text-xs leading-5 text-gray-400 mt-2 font-medium">Maks. 2MB (JPG, JPEG, PNG)</p>
                                    </div>

                                    <!-- Image Preview -->
                                    <div id="image-preview-container" class="hidden absolute inset-0 w-full h-full bg-white rounded-2xl p-2 flex items-center justify-center z-30">
                                        <img id="image-preview" src="#" alt="Preview" class="h-full object-contain rounded-xl shadow-sm">
                                        <button type="button" onclick="clearImage()" class="absolute -top-3 -right-3 bg-red-500 text-white rounded-full p-2 hover:bg-red-600 shadow-lg transform hover:scale-110 transition-transform z-40 cursor-pointer">
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

                            <button type="submit" class="w-full bg-gray-900 text-white font-bold py-4 px-4 rounded-xl shadow-lg hover:shadow-xl hover:bg-black hover:scale-[1.02] active:scale-[0.98] transition-all duration-200 flex justify-center items-center gap-2">
                                Kirim Konfirmasi
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                            </button>
                            
                            <div class="flex items-center justify-center gap-2 text-gray-400 text-xs font-medium pt-2">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Transaksi aman & terenkripsi
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>

<style>
    .animate-fade-in-up {
        animation: fadeInUp 0.6s cubic-bezier(0.16, 1, 0.3, 1) forwards;
        opacity: 0;
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

    function copyRekening(text, btn, bank) {
        navigator.clipboard.writeText(text).then(() => {
            const span = btn.querySelector('span');
            const originalText = span.innerText;
            span.innerText = 'Tersalin!';
            
            // Adjust colors based on bank
            if(bank === 'BCA') {
                btn.classList.add('bg-blue-600', 'text-white');
                btn.classList.remove('bg-blue-100', 'text-blue-700');
            } else if (bank === 'Mandiri') {
                btn.classList.add('bg-yellow-500', 'text-white');
                btn.classList.remove('bg-yellow-100', 'text-yellow-700');
            } else if (bank === 'BNI') {
                btn.classList.add('bg-orange-600', 'text-white');
                btn.classList.remove('bg-orange-100', 'text-orange-700');
            }

            const toast = document.createElement('div');
            toast.className = 'fixed top-10 left-1/2 transform -translate-x-1/2 bg-gray-900 text-white px-6 py-3 rounded-full shadow-2xl z-50 flex items-center gap-3 animate-fade-in-up font-medium text-sm';
            toast.innerHTML = `<svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg> Nomor rekening disalin ke clipboard!`;
            document.body.appendChild(toast);

            setTimeout(() => {
                span.innerText = originalText;
                
                if(bank === 'BCA') {
                    btn.classList.remove('bg-blue-600', 'text-white');
                    btn.classList.add('bg-blue-100', 'text-blue-700');
                } else if (bank === 'Mandiri') {
                    btn.classList.remove('bg-yellow-500', 'text-white');
                    btn.classList.add('bg-yellow-100', 'text-yellow-700');
                } else if (bank === 'BNI') {
                    btn.classList.remove('bg-orange-600', 'text-white');
                    btn.classList.add('bg-orange-100', 'text-orange-700');
                }

                toast.style.opacity = '0';
                toast.style.transform = 'translate(-50%, -20px)';
                toast.style.transition = 'all 0.3s ease';
                setTimeout(() => toast.remove(), 300);
            }, 2500);
        });
    }

    function changePaymentMethod() {
        const selected = document.getElementById('metodeSelect').value;
        
        // Update hidden input for form submission
        document.getElementById('metodeSubmit').value = selected;
        
        // Hide all instruction boxes
        document.querySelectorAll('.payment-instruction').forEach(el => {
            el.classList.add('hidden');
        });
        
        // Show the active one
        const activeEl = document.getElementById('instruksi-' + selected);
        if (activeEl) {
            activeEl.classList.remove('hidden');
            // Retrigger animation
            activeEl.style.animation = 'none';
            activeEl.offsetHeight; /* trigger reflow */
            activeEl.style.animation = null;
            activeEl.classList.add('animate-fade-in-up');
        }
    }
</script>
@endsection
