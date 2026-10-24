<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi & Pembayaran — Maison De Jenrina</title>
    
    <!-- Tailwind CSS & FontAwesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased min-h-screen flex flex-col"
      x-data="{ 
          shippingFee: 15000, 
          selectedPayment: 'gopay',
          paymentName: 'GoPay',
          paymentType: 'E-Wallet',
          paymentPhone: '',
          openPaymentModal: false,
          subtotalProducts: {{ $subtotalProd ?? (isset($product) ? ($product->discount_price ?? $product->price ?? 74000) : 74000) }},
          selectMethod(code, name, type) {
              this.selectedPayment = code;
              this.paymentName = name;
              this.paymentType = type;
              this.openPaymentModal = false;
          }
      }">

    <!-- HEADER TOPBAR -->
    <header class="bg-white/80 backdrop-blur-md border-b border-[#EADFC7] px-8 py-4 sticky top-0 z-30 flex items-center justify-between">
        <a href="{{ route('cart.index') }}" class="flex items-center gap-2 text-xs font-bold text-stone-600 hover:text-[#3A2E2B] transition">
            <i class="fa-solid fa-arrow-left"></i>
            <span>Kembali ke Keranjang</span>
        </a>

        <div class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 rounded-full border border-[#3A2E2B] p-0.5 bg-white shadow-xs">
            <span class="font-serif font-bold text-sm text-[#3A2E2B] tracking-wider">MAISON DE JENRINA</span>
        </div>
    </header>

    <!-- KONTEN UTAMA CHECKOUT -->
    <main class="max-w-6xl mx-auto p-4 md:p-8 w-full flex-1">
        
        <h1 class="text-2xl md:text-3xl font-serif font-bold text-[#3A2E2B] mb-6">Konfirmasi & Pembayaran</h1>

        <!-- FORM UTAMA -->
        <form id="checkout-form" action="{{ route('order.process') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            @csrf
            <input type="hidden" name="shipping_fee" :value="shippingFee">
            <input type="hidden" name="payment_method" :value="selectedPayment">

            <!-- ========================================== -->
            <!-- KOLOM SISI KIRI: INFORMASI, ONGKIR, & PEMBAYARAN (7 KOLOM) -->
            <!-- ========================================== -->
            <div class="lg:col-span-7 space-y-6">
                
                <!-- 1. INFORMASI PENGIRIMAN -->
                <div class="bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-xs space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-stone-100">
                        <div class="w-8 h-8 rounded-xl bg-[#F8F6F0] flex items-center justify-center text-[#3A2E2B] border border-[#EADFC7]">
                            <i class="fa-solid fa-location-dot text-xs"></i>
                        </div>
                        <h2 class="font-serif font-bold text-base text-[#3A2E2B]">Informasi Pengiriman</h2>
                    </div>

                    <div class="space-y-3 text-xs">
                        <div>
                            <label class="font-bold text-stone-700 block mb-1">Nama Customer / Penerima</label>
                            <input type="text" name="recipient_name" value="{{ auth()->user()->name ?? 'Pelanggan' }}" required
                                   class="w-full px-4 py-2.5 bg-[#F8F6F0] rounded-xl border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B] font-semibold text-stone-800">
                        </div>

                        <div>
                            <label class="font-bold text-stone-700 block mb-1">Nomor Telepon / WhatsApp</label>
                            <input type="text" name="phone" value="08123456789" required
                                   class="w-full px-4 py-2.5 bg-[#F8F6F0] rounded-xl border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B] font-semibold text-stone-800">
                        </div>

                        <div>
                            <label class="font-bold text-stone-700 block mb-1">Alamat Lengkap Pengiriman</label>
                            <textarea name="address" rows="3" required placeholder="Nama Jalan, No. Rumah, Kecamatan, Kota, Kode Pos"
                                      class="w-full p-3 bg-[#F8F6F0] rounded-xl border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B] text-stone-800"></textarea>
                        </div>
                    </div>
                </div>

                <!-- 2. PILIHAN OPSI ONGKIR -->
                <div class="bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-xs space-y-4">
                    <div class="flex items-center gap-2 pb-3 border-b border-stone-100">
                        <div class="w-8 h-8 rounded-xl bg-[#F8F6F0] flex items-center justify-center text-[#3A2E2B] border border-[#EADFC7]">
                            <i class="fa-solid fa-truck-fast text-xs"></i>
                        </div>
                        <h2 class="font-serif font-bold text-base text-[#3A2E2B]">Pilih Opsi Pengiriman (Ongkir)</h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 text-xs">
                        <!-- Reguler -->
                        <label @click="shippingFee = 15000" 
                               :class="shippingFee === 15000 ? 'border-[#3A2E2B] bg-[#F8F6F0] ring-1 ring-[#3A2E2B]' : 'border-[#EADFC7] bg-white hover:bg-stone-50'"
                               class="p-3.5 rounded-2xl border flex flex-col justify-between cursor-pointer transition">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-[#3A2E2B]">Reguler (J&T / JNE)</span>
                                <input type="radio" name="shipping_courier" value="reguler" :checked="shippingFee === 15000" class="accent-[#3A2E2B]">
                            </div>
                            <p class="text-[10px] text-stone-500 mb-2">Estimasi 2-3 Hari</p>
                            <span class="font-extrabold text-[#B86246]">Rp 15.000</span>
                        </label>

                        <!-- Express -->
                        <label @click="shippingFee = 25000" 
                               :class="shippingFee === 25000 ? 'border-[#3A2E2B] bg-[#F8F6F0] ring-1 ring-[#3A2E2B]' : 'border-[#EADFC7] bg-white hover:bg-stone-50'"
                               class="p-3.5 rounded-2xl border flex flex-col justify-between cursor-pointer transition">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-[#3A2E2B]">Express / Instant</span>
                                <input type="radio" name="shipping_courier" value="express" :checked="shippingFee === 25000" class="accent-[#3A2E2B]">
                            </div>
                            <p class="text-[10px] text-stone-500 mb-2">Tiba Hari Ini (Sameday)</p>
                            <span class="font-extrabold text-[#B86246]">Rp 25.000</span>
                        </label>

                        <!-- Ekonomi -->
                        <label @click="shippingFee = 10000" 
                               :class="shippingFee === 10000 ? 'border-[#3A2E2B] bg-[#F8F6F0] ring-1 ring-[#3A2E2B]' : 'border-[#EADFC7] bg-white hover:bg-stone-50'"
                               class="p-3.5 rounded-2xl border flex flex-col justify-between cursor-pointer transition">
                            <div class="flex items-center justify-between mb-2">
                                <span class="font-bold text-[#3A2E2B]">Hemat / Ekonomi</span>
                                <input type="radio" name="shipping_courier" value="economy" :checked="shippingFee === 10000" class="accent-[#3A2E2B]">
                            </div>
                            <p class="text-[10px] text-stone-500 mb-2">Estimasi 4-6 Hari</p>
                            <span class="font-extrabold text-[#B86246]">Rp 10.000</span>
                        </label>
                    </div>
                </div>

                <!-- 3. METODE PEMBAYARAN -->
                <div class="bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-xs space-y-4">
                    <div class="flex items-center justify-between pb-3 border-b border-stone-100">
                        <div class="flex items-center gap-2">
                            <div class="w-8 h-8 rounded-xl bg-[#F8F6F0] flex items-center justify-center text-[#3A2E2B] border border-[#EADFC7]">
                                <i class="fa-solid fa-wallet text-xs"></i>
                            </div>
                            <h2 class="font-serif font-bold text-base text-[#3A2E2B]">Metode Pembayaran</h2>
                        </div>
                        <span class="text-[10px] font-extrabold px-2.5 py-1 bg-amber-50 text-amber-800 border border-amber-200 rounded-full tracking-wider" x-text="paymentType.toUpperCase()">E-WALLET</span>
                    </div>

                    <!-- CARD PILIHAN UTAMA -->
                    <div @click="openPaymentModal = true" 
                         class="p-4 rounded-2xl border-2 border-[#3A2E2B] bg-gradient-to-r from-[#F8F6F0] to-white flex items-center justify-between cursor-pointer hover:shadow-md transition-all group">
                        <div class="flex items-center gap-3.5">
                            <div class="w-10 h-10 rounded-xl bg-white border border-[#EADFC7] flex items-center justify-center shadow-xs shrink-0">
                                <template x-if="selectedPayment.includes('gopay')"><i class="fa-solid fa-mobile-screen text-emerald-600 text-base"></i></template>
                                <template x-if="selectedPayment.includes('dana')"><i class="fa-solid fa-wallet text-sky-500 text-base"></i></template>
                                <template x-if="selectedPayment === 'qris'"><i class="fa-solid fa-qrcode text-stone-800 text-base"></i></template>
                                <template x-if="selectedPayment.includes('bank_bca')"><i class="fa-solid fa-building-columns text-blue-600 text-base"></i></template>
                                <template x-if="selectedPayment.includes('bank_mandiri')"><i class="fa-solid fa-building-columns text-blue-800 text-base"></i></template>
                                <template x-if="selectedPayment.includes('bank_bri')"><i class="fa-solid fa-building-columns text-sky-600 text-base"></i></template>
                                <template x-if="selectedPayment === 'cod'"><i class="fa-solid fa-hand-holding-dollar text-amber-600 text-base"></i></template>
                            </div>
                            <div>
                                <span class="text-[10px] font-bold text-stone-400 uppercase tracking-wider block">Dipilih:</span>
                                <span class="font-bold text-xs text-[#3A2E2B]" x-text="paymentName">GoPay</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center gap-3">
                            <span class="text-xs font-bold text-[#B86246] bg-amber-100/60 px-3 py-1 rounded-full border border-amber-200">Ubah</span>
                            <i class="fa-solid fa-chevron-right text-xs text-stone-400 group-hover:translate-x-1 transition"></i>
                        </div>
                    </div>

                    <!-- Input Nomor HP jika E-Wallet -->
                    <div x-show="['gopay', 'dana'].includes(selectedPayment)" class="pt-2 text-xs">
                        <label class="font-bold text-stone-700 block mb-1">Nomor HP Terhubung <span x-text="paymentName"></span></label>
                        <input type="text" name="payment_phone" x-model="paymentPhone" placeholder="Contoh: 081234567890" 
                               class="w-full px-4 py-2.5 bg-[#F8F6F0] rounded-xl border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B] font-semibold text-stone-800">
                    </div>

                    <!-- MODAL POPUP PILIHAN METODE -->
                    <div x-show="openPaymentModal" 
                         x-transition.opacity
                         class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-end sm:items-center justify-center p-0 sm:p-4"
                         style="display: none;">

                        <div @click.away="openPaymentModal = false" 
                             class="bg-white w-full max-w-lg rounded-t-3xl sm:rounded-3xl max-h-[85vh] overflow-y-auto border border-[#EADFC7] shadow-2xl flex flex-col">
                            
                            <div class="p-5 border-b border-stone-100 flex items-center justify-between sticky top-0 bg-white z-10">
                                <div class="flex items-center gap-2">
                                    <div class="w-8 h-8 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center border border-emerald-200">
                                        <i class="fa-solid fa-shield-halved text-xs"></i>
                                    </div>
                                    <h3 class="font-serif font-bold text-base text-[#3A2E2B]">Pilih Metode Pembayaran</h3>
                                </div>
                                <button type="button" @click="openPaymentModal = false" class="text-stone-400 hover:text-stone-800 font-bold p-1 cursor-pointer">
                                    <i class="fa-solid fa-xmark text-lg"></i>
                                </button>
                            </div>

                            <div class="p-5 space-y-6 text-xs">
                                <!-- E-Wallet & QRIS -->
                                <div>
                                    <h4 class="font-extrabold text-stone-400 uppercase tracking-widest text-[10px] mb-3 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span> E-Wallet & QRIS Instan
                                    </h4>
                                    <div class="space-y-2.5">
                                        <div @click="selectMethod('dana', 'DANA', 'E-Wallet')"
                                             :class="selectedPayment === 'dana' ? 'border-[#3A2E2B] bg-[#F8F6F0] ring-1 ring-[#3A2E2B]' : 'border-stone-200 hover:border-[#EADFC7] bg-white'"
                                             class="p-3.5 rounded-2xl border flex items-center justify-between cursor-pointer transition shadow-2xs">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-sky-50 flex items-center justify-center border border-sky-100">
                                                    <i class="fa-solid fa-wallet text-sky-500 text-sm"></i>
                                                </div>
                                                <div>
                                                    <span class="font-bold text-stone-800 block text-xs">DANA</span>
                                                    <span class="text-[10px] text-stone-400">Pembayaran instan via aplikasi DANA</span>
                                                </div>
                                            </div>
                                            <input type="radio" :checked="selectedPayment === 'dana'" class="accent-[#3A2E2B] w-4 h-4">
                                        </div>

                                        <div @click="selectMethod('gopay', 'GoPay', 'E-Wallet')"
                                             :class="selectedPayment === 'gopay' ? 'border-[#3A2E2B] bg-[#F8F6F0] ring-1 ring-[#3A2E2B]' : 'border-stone-200 hover:border-[#EADFC7] bg-white'"
                                             class="p-3.5 rounded-2xl border flex items-center justify-between cursor-pointer transition shadow-2xs">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-emerald-50 flex items-center justify-center border border-emerald-100">
                                                    <i class="fa-solid fa-mobile-screen text-emerald-600 text-sm"></i>
                                                </div>
                                                <div>
                                                    <span class="font-bold text-stone-800 block text-xs">GoPay</span>
                                                    <span class="text-[10px] text-stone-400">Pembayaran instan via Gojek / GoPay</span>
                                                </div>
                                            </div>
                                            <input type="radio" :checked="selectedPayment === 'gopay'" class="accent-[#3A2E2B] w-4 h-4">
                                        </div>

                                        <div @click="selectMethod('qris', 'QRIS', 'QR Code')"
                                             :class="selectedPayment === 'qris' ? 'border-[#3A2E2B] bg-[#F8F6F0] ring-1 ring-[#3A2E2B]' : 'border-stone-200 hover:border-[#EADFC7] bg-white'"
                                             class="p-3.5 rounded-2xl border flex items-center justify-between cursor-pointer transition shadow-2xs">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-stone-100 flex items-center justify-center border border-stone-200">
                                                    <i class="fa-solid fa-qrcode text-stone-800 text-sm"></i>
                                                </div>
                                                <div>
                                                    <span class="font-bold text-stone-800 block text-xs">QRIS (Semua E-Banking/Wallet)</span>
                                                    <span class="text-[10px] text-stone-400">Scan kode QR untuk bayar dari aplikasi apa saja</span>
                                                </div>
                                            </div>
                                            <input type="radio" :checked="selectedPayment === 'qris'" class="accent-[#3A2E2B] w-4 h-4">
                                        </div>
                                    </div>
                                </div>

                                <!-- Transfer Bank -->
                                <div>
                                    <h4 class="font-extrabold text-stone-400 uppercase tracking-widest text-[10px] mb-3 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-blue-500"></span> Transfer Bank (Virtual Account)
                                    </h4>
                                    <div class="space-y-2.5">
                                        <div @click="selectMethod('bank_bca', 'Virtual Account BCA', 'Bank Transfer')"
                                             :class="selectedPayment === 'bank_bca' ? 'border-[#3A2E2B] bg-[#F8F6F0] ring-1 ring-[#3A2E2B]' : 'border-stone-200 hover:border-[#EADFC7] bg-white'"
                                             class="p-3.5 rounded-2xl border flex items-center justify-between cursor-pointer transition shadow-2xs">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-blue-50 flex items-center justify-center border border-blue-100">
                                                    <i class="fa-solid fa-building-columns text-blue-600 text-sm"></i>
                                                </div>
                                                <div>
                                                    <span class="font-bold text-stone-800 block text-xs">Bank BCA (Virtual Account)</span>
                                                    <span class="text-[10px] text-stone-400">Verifikasi otomatis via m-BCA / ATM BCA</span>
                                                </div>
                                            </div>
                                            <input type="radio" :checked="selectedPayment === 'bank_bca'" class="accent-[#3A2E2B] w-4 h-4">
                                        </div>

                                        <div @click="selectMethod('bank_mandiri', 'Virtual Account Mandiri', 'Bank Transfer')"
                                             :class="selectedPayment === 'bank_mandiri' ? 'border-[#3A2E2B] bg-[#F8F6F0] ring-1 ring-[#3A2E2B]' : 'border-stone-200 hover:border-[#EADFC7] bg-white'"
                                             class="p-3.5 rounded-2xl border flex items-center justify-between cursor-pointer transition shadow-2xs">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-indigo-50 flex items-center justify-center border border-indigo-100">
                                                    <i class="fa-solid fa-building-columns text-indigo-700 text-sm"></i>
                                                </div>
                                                <div>
                                                    <span class="font-bold text-stone-800 block text-xs">Bank Mandiri (Virtual Account)</span>
                                                    <span class="text-[10px] text-stone-400">Verifikasi otomatis via Livin' Mandiri</span>
                                                </div>
                                            </div>
                                            <input type="radio" :checked="selectedPayment === 'bank_mandiri'" class="accent-[#3A2E2B] w-4 h-4">
                                        </div>

                                        <div @click="selectMethod('bank_bri', 'Virtual Account BRI', 'Bank Transfer')"
                                             :class="selectedPayment === 'bank_bri' ? 'border-[#3A2E2B] bg-[#F8F6F0] ring-1 ring-[#3A2E2B]' : 'border-stone-200 hover:border-[#EADFC7] bg-white'"
                                             class="p-3.5 rounded-2xl border flex items-center justify-between cursor-pointer transition shadow-2xs">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-cyan-50 flex items-center justify-center border border-cyan-100">
                                                    <i class="fa-solid fa-building-columns text-cyan-600 text-sm"></i>
                                                </div>
                                                <div>
                                                    <span class="font-bold text-stone-800 block text-xs">Bank BRI (Virtual Account)</span>
                                                    <span class="text-[10px] text-stone-400">Verifikasi otomatis via BRImo / ATM BRI</span>
                                                </div>
                                            </div>
                                            <input type="radio" :checked="selectedPayment === 'bank_bri'" class="accent-[#3A2E2B] w-4 h-4">
                                        </div>
                                    </div>
                                </div>

                                <!-- Bayar di Tempat (COD) -->
                                <div>
                                    <h4 class="font-extrabold text-stone-400 uppercase tracking-widest text-[10px] mb-3 flex items-center gap-2">
                                        <span class="w-2 h-2 rounded-full bg-amber-500"></span> Bayar Saat Diterima
                                    </h4>
                                    <div @click="selectMethod('cod', 'Bayar di Tempat (COD)', 'Cash on Delivery')"
                                         :class="selectedPayment === 'cod' ? 'border-[#3A2E2B] bg-[#F8F6F0] ring-1 ring-[#3A2E2B]' : 'border-stone-200 hover:border-[#EADFC7] bg-white'"
                                         class="p-3.5 rounded-2xl border flex items-center justify-between cursor-pointer transition shadow-2xs">
                                        <div class="flex items-center gap-3">
                                            <div class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center border border-amber-100">
                                                <i class="fa-solid fa-hand-holding-dollar text-amber-600 text-sm"></i>
                                            </div>
                                            <div>
                                                <span class="font-bold text-stone-800 block text-xs">Bayar di Tempat (COD)</span>
                                                <span class="text-[10px] text-stone-400">Bayar tunai langsung kepada kurir saat paket sampai</span>
                                            </div>
                                        </div>
                                        <input type="radio" :checked="selectedPayment === 'cod'" class="accent-[#3A2E2B] w-4 h-4">
                                    </div>
                                </div>

                            </div>

                            <div class="p-4 border-t border-stone-100 bg-white sticky bottom-0">
                                <button type="button" @click="openPaymentModal = false" 
                                        class="w-full py-3.5 bg-[#3A2E2B] hover:bg-[#52423D] text-white font-bold text-xs uppercase tracking-wider rounded-xl transition cursor-pointer shadow-md">
                                    Gunakan Metode Ini
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ========================================== -->
            <!-- KOLOM SISI KANAN: RINGKASAN PESANAN (5 KOLOM) -->
            <!-- ========================================== -->
            <div class="lg:col-span-5 bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-sm space-y-5 sticky top-24">
                
                <div class="flex items-center gap-2 pb-3 border-b border-stone-100">
                    <div class="w-8 h-8 rounded-xl bg-[#F8F6F0] flex items-center justify-center text-[#3A2E2B] border border-[#EADFC7]">
                        <i class="fa-solid fa-receipt text-xs"></i>
                    </div>
                    <h2 class="font-serif font-bold text-base text-[#3A2E2B]">Ringkasan Pesanan</h2>
                </div>

                <!-- ========================================== -->
                <!-- DAFTAR ITEM PRODUK (DIPERBARUI DI SINI) -->
                <!-- ========================================== -->
                <div class="space-y-3 divide-y divide-stone-100 max-h-60 overflow-y-auto pr-1">
                    @php
                        // Mengambil data produk yang dikirim dari CartController@checkout
                        $checkoutItems = isset($selectedProducts) ? $selectedProducts : [];
                        $subtotalProd = 0;
                    @endphp

                    @if(count($checkoutItems) > 0)
                        @foreach($checkoutItems as $item)
                            @php
                                $pName  = $item->product->name ?? $item->name ?? 'Produk';
                                $pPrice = $item->product->price ?? $item->price ?? 0;
                                $pQty   = $item->quantity ?? $item->qty ?? 1;
                                
                                // Mengambil gambar produk secara aman dari relasi database
                                $rawImg = $item->product->image ?? $item->product->photo ?? $item->image ?? null;

                                if (!empty($rawImg)) {
                                    $imgUrl = \Illuminate\Support\Str::startsWith($rawImg, ['http://', 'https://']) 
                                        ? $rawImg 
                                        : asset('storage/' . ltrim($rawImg, '/'));
                                } else {
                                    $imgUrl = asset('images/logo.png');
                                }

                                $pColor = $item->color ?? 'Black';
                                $pSize  = $item->size ?? 'L';
                                
                                $itemSubtotal = $pPrice * $pQty;
                                $subtotalProd += $itemSubtotal;
                            @endphp

                            <div class="pt-3 first:pt-0 flex items-center justify-between gap-3">
                                <div class="flex items-center gap-3 min-w-0">
                                    <div class="w-12 h-12 rounded-xl bg-stone-100 border border-[#EADFC7] overflow-hidden shrink-0">
                                        <img src="{{ $imgUrl }}" 
                                             alt="{{ $pName }}" 
                                             class="w-full h-full object-cover"
                                             onerror="this.onerror=null; this.src='{{ asset('images/logo.png') }}';">
                                    </div>
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-xs text-[#3A2E2B] truncate">{{ $pName }}</h4>
                                        <p class="text-[10px] text-stone-400">Warna: {{ $pColor }} | Size: {{ $pSize }}</p>
                                        <span class="text-[10px] font-semibold text-stone-600">{{ $pQty }} pcs x Rp {{ number_format($pPrice, 0, ',', '.') }}</span>
                                    </div>
                                </div>
                                <span class="font-bold text-xs text-[#3A2E2B] shrink-0">Rp {{ number_format($itemSubtotal, 0, ',', '.') }}</span>
                            </div>
                        @endforeach
                    @else
                        <p class="text-xs text-stone-400 text-center py-2">Tidak ada produk terpilih.</p>
                    @endif
                </div>

                <!-- RINCIAN BIAYA & HARGA -->
                <div class="space-y-2.5 text-xs text-stone-600 border-t border-stone-100 pt-3">
                    <div class="flex items-center justify-between">
                        <span>Subtotal Produk</span>
                        <span class="font-bold text-stone-800" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format({{ $subtotalProd }})">Rp {{ number_format($subtotalProd, 0, ',', '.') }}</span>
                    </div>

                    <div class="flex items-center justify-between">
                        <span>Biaya Pengiriman (Ongkir)</span>
                        <span class="font-bold text-[#B86246]" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format(shippingFee)">Rp 15.000</span>
                    </div>

                    <div class="flex items-center justify-between text-emerald-700">
                        <span>Biaya Layanan</span>
                        <span class="font-bold">Gratis</span>
                    </div>
                </div>

                <!-- TOTAL PEMBAYARAN -->
                <div class="pt-4 border-t border-stone-200 flex items-center justify-between">
                    <div>
                        <span class="text-xs text-stone-500 font-bold block">Total Pembayaran</span>
                        <span class="text-[10px] text-stone-400">Termasuk Pajak & Ongkir</span>
                    </div>
                    <span class="text-xl font-serif font-extrabold text-[#B86246]" x-text="'Rp ' + new Intl.NumberFormat('id-ID').format({{ $subtotalProd }} + shippingFee)">
                        Rp {{ number_format($subtotalProd + 15000, 0, ',', '.') }}
                    </span>
                </div>

                <!-- TOMBOL BUAT PESANAN SEKARANG -->
                <button type="submit" 
                        form="checkout-form"
                        class="w-full py-4 bg-[#3A2E2B] hover:bg-[#52423D] text-white rounded-2xl text-xs font-bold uppercase tracking-wider shadow-lg transition flex items-center justify-center gap-2 cursor-pointer mt-2">
                    <i class="fa-solid fa-lock text-xs text-amber-300"></i>
                    <span>Buat Pesanan Sekarang</span>
                </button>

            </div>

        </form>

    </main>

</body>
</html>