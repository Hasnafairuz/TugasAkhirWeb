<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Pesanan — Maison De Jenrina</title>
    
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
<body class="bg-[#F8F6F0] text-stone-800 antialiased min-h-screen">

    <main class="max-w-6xl mx-auto p-6 md:p-8 space-y-6">
        
        <!-- HEADER UTAMA & TOMBOL KEMBALI -->
        <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4 pb-2 border-b border-[#EADFC7]/60">
            <div>
                <div class="flex items-center gap-2 text-xs text-stone-400 mb-1">
                    <span>Customer</span> / <span class="font-bold text-[#3A2E2B]">Pusat Pesanan</span>
                </div>
                <h1 class="text-3xl font-serif font-bold text-[#3A2E2B]">Pusat Pesanan</h1>
                <p class="text-xs text-stone-500 mt-1">Pantau proses pengiriman dan riwayat transaksi belanja Anda</p>
            </div>

            <!-- TOMBOL KEMBALI KE DASHBOARD CUSTOMER -->
            <a href="{{ route('customer.dashboard') }}" 
               class="inline-flex items-center gap-2 px-4 py-2.5 rounded-2xl bg-white hover:bg-[#3A2E2B] text-[#3A2E2B] hover:text-white border border-[#EADFC7] shadow-xs hover:shadow-md font-bold text-xs transition duration-200 group self-start sm:self-center">
                <i class="fa-solid fa-arrow-left text-xs group-hover:-translate-x-0.5 transition-transform"></i>
                <span>Kembali ke Customer Shop</span>
            </a>
        </div>

        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs px-4 py-3 rounded-2xl flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-rose-50 border border-rose-200 text-rose-800 text-xs px-4 py-3 rounded-2xl flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-circle-exclamation text-rose-600"></i>
                <span>{{ session('error') }}</span>
            </div>
        @endif

        <!-- STATS & KATEGORI PESANAN -->
        <div class="bg-white rounded-3xl border border-[#EADFC7] p-6 shadow-xs">
            <div class="flex items-center justify-between mb-6">
                <h3 class="font-bold text-sm text-[#3A2E2B]">Pesanan Anda</h3>
                <a href="{{ route('customer.orders') }}" class="text-xs font-semibold text-stone-500 hover:text-[#3A2E2B]">Lihat Semua &gt;</a>
            </div>

            <div class="grid grid-cols-5 gap-4 text-center text-xs">
                <a href="{{ route('customer.orders', ['status' => 'unpaid']) }}" class="flex flex-col items-center gap-2 group cursor-pointer">
                    <div class="w-14 h-14 rounded-2xl {{ request('status') == 'unpaid' ? 'bg-[#3A2E2B] text-white' : 'bg-[#F8F6F0] text-stone-600' }} border border-[#EADFC7] flex items-center justify-center group-hover:scale-105 transition">
                        <i class="fa-solid fa-wallet text-lg"></i>
                    </div>
                    <span class="font-semibold {{ request('status') == 'unpaid' ? 'text-[#3A2E2B] font-bold' : 'text-stone-600' }}">Perlu dibayar</span>
                </a>

                <a href="{{ route('customer.orders', ['status' => 'paid']) }}" class="flex flex-col items-center gap-2 group cursor-pointer">
                    <div class="w-14 h-14 rounded-2xl {{ request('status') == 'paid' ? 'bg-[#3A2E2B] text-white' : 'bg-[#F8F6F0] text-stone-600' }} border border-[#EADFC7] flex items-center justify-center group-hover:scale-105 transition">
                        <i class="fa-solid fa-box text-lg"></i>
                    </div>
                    <span class="font-semibold {{ request('status') == 'paid' ? 'text-[#3A2E2B] font-bold' : 'text-stone-600' }}">Perlu dikirim</span>
                </a>

                <a href="{{ route('customer.orders', ['status' => 'shipped']) }}" class="flex flex-col items-center gap-2 group cursor-pointer">
                    <div class="w-14 h-14 rounded-2xl {{ request('status') == 'shipped' ? 'bg-[#3A2E2B] text-white' : 'bg-[#F8F6F0] text-stone-600' }} border border-[#EADFC7] flex items-center justify-center group-hover:scale-105 transition">
                        <i class="fa-solid fa-truck-fast text-lg"></i>
                    </div>
                    <span class="font-semibold {{ request('status') == 'shipped' ? 'text-[#3A2E2B] font-bold' : 'text-stone-600' }}">Akan diterima</span>
                </a>

                <a href="{{ route('customer.orders', ['status' => 'completed']) }}" class="flex flex-col items-center gap-2 group cursor-pointer relative">
                    <div class="w-14 h-14 rounded-2xl {{ request('status') == 'completed' ? 'bg-[#3A2E2B] text-white' : 'bg-[#F8F6F0] text-stone-600' }} border border-[#EADFC7] flex items-center justify-center group-hover:scale-105 transition relative">
                        <i class="fa-solid fa-star text-amber-500 text-lg"></i>
                    </div>
                    <span class="font-semibold {{ request('status') == 'completed' ? 'text-[#3A2E2B] font-bold' : 'text-stone-600' }}">Perlu diulas</span>
                </a>

                <a href="{{ route('customer.orders', ['status' => 'returned']) }}" class="flex flex-col items-center gap-2 group cursor-pointer">
                    <div class="w-14 h-14 rounded-2xl {{ request('status') == 'returned' ? 'bg-[#3A2E2B] text-white' : 'bg-[#F8F6F0] text-stone-600' }} border border-[#EADFC7] flex items-center justify-center group-hover:scale-105 transition">
                        <i class="fa-solid fa-rotate-left text-lg"></i>
                    </div>
                    <span class="font-semibold {{ request('status') == 'returned' ? 'text-[#3A2E2B] font-bold' : 'text-stone-600' }}">Pengembalian barang</span>
                </a>
            </div>
        </div>

        <!-- DAFTAR PESANAN -->
        <div class="space-y-4">
            @forelse($orders ?? [] as $order)
                @php
                    $firstProduct = optional($order->orderItems->first())->product ?? $order->product;
                    $totalItems = $order->orderItems->sum('quantity') ?: ($order->quantity ?? 1);
                @endphp

                <div class="bg-white rounded-3xl border border-[#EADFC7] p-5 shadow-xs hover:shadow-md transition flex flex-col md:flex-row md:items-center justify-between gap-4" x-data="{ openReviewModal: false, selectedRating: 5 }">
                    
                    <!-- INFORMASI PRODUK -->
                    <div class="flex items-center gap-4">
                        <div class="w-16 h-16 rounded-2xl bg-stone-100 border border-[#EADFC7] overflow-hidden shrink-0">
                            <img src="{{ asset('storage/' . ($firstProduct->image ?? 'images/default.jpg')) }}" alt="Foto Produk" class="w-full h-full object-cover">
                        </div>
                        <div>
                            <div class="flex items-center gap-2 text-[11px] text-stone-400 mb-0.5">
                                <span class="font-bold text-stone-600">#{{ $order->invoice_number ?? 'INV-' . $order->id }}</span>
                                <span>•</span>
                                <span>{{ $order->created_at ? $order->created_at->format('d M Y') : date('d M Y') }}</span>
                            </div>
                            <h4 class="font-bold text-sm text-[#3A2E2B]">
                                {{ $firstProduct->name ?? 'Produk Pesanan' }}
                                @if($order->orderItems->count() > 1)
                                    <span class="text-xs text-stone-500 font-normal ml-1">(+{{ $order->orderItems->count() - 1 }} produk lainnya)</span>
                                @endif
                            </h4>
                            <p class="text-xs font-extrabold text-[#B86246] mt-0.5">
                                Rp {{ number_format($order->total_price ?? $order->total_amount ?? 0, 0, ',', '.') }}
                                <span class="text-[10px] font-normal text-stone-400">({{ $totalItems }} item)</span>
                            </p>
                        </div>
                    </div>

                    <!-- BADGE STATUS & TOMBOL AKSI -->
                    <div class="flex items-center gap-2 flex-wrap">
                        <span class="px-3 py-1 rounded-full text-xs font-bold border flex items-center gap-1
                            {{ $order->status == 'completed' ? 'bg-purple-50 text-purple-700 border-purple-200' : '' }}
                            {{ $order->status == 'Pending' || $order->status == 'unpaid' ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                            {{ $order->status == 'paid' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                            {{ $order->status == 'shipped' ? 'bg-indigo-50 text-indigo-700 border-indigo-200' : '' }}
                            {{ $order->status == 'returned' ? 'bg-rose-50 text-rose-700 border-rose-200' : '' }}">
                            <i class="fa-solid fa-circle text-[6px]"></i> {{ ucfirst($order->status) }}
                        </span>

                        <!-- TOMBOL DETAIL PESANAN (BARU) -->
                        <a href="{{ route('customer.orders.show', $order->id) }}" class="px-3.5 py-2 bg-[#F8F6F0] hover:bg-[#EADFC7] text-[#3A2E2B] border border-[#EADFC7] rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-xs">
                            <i class="fa-solid fa-list-check text-stone-600"></i> Detail
                        </a>

                        <!-- AKSI KHUSUS UNTUK STATUS SELESAI (COMPLETED) -->
                        @if($order->status == 'completed')
                            <!-- TOMBOL PDF RESI -->
                            <a href="{{ route('orders.pdf', $order->id) }}" target="_blank" class="px-3.5 py-2 bg-stone-800 hover:bg-black text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-xs">
                                <i class="fa-solid fa-file-pdf text-rose-400"></i> PDF
                            </a>

                            <!-- TOMBOL BERI ULASAN -->
                            @if(isset($order->review) && $order->review)
                                <span class="px-3.5 py-2 bg-emerald-50 text-emerald-700 border border-emerald-200 font-bold text-xs rounded-xl flex items-center gap-1.5 shadow-xs">
                                    <i class="fa-solid fa-circle-check text-emerald-600"></i> Ulasan Terkirim
                                </span>
                            @else
                                <button type="button" 
                                        @click="openReviewModal = true"
                                        class="px-4 py-2 bg-gradient-to-r from-amber-500 to-amber-600 hover:from-amber-600 hover:to-amber-700 text-white rounded-xl text-xs font-bold transition flex items-center gap-1.5 shadow-md cursor-pointer">
                                    <i class="fa-solid fa-star text-xs"></i>
                                    <span>Beri Ulasan</span>
                                </button>

                                <!-- MODAL REVIEW -->
                                <div x-show="openReviewModal" 
                                     x-transition
                                     class="fixed inset-0 bg-black/60 backdrop-blur-xs z-50 flex items-center justify-center p-4" 
                                     style="display: none;">
                                    
                                    <div @click.away="openReviewModal = false" class="bg-white rounded-3xl p-6 max-w-md w-full border border-[#EADFC7] shadow-2xl space-y-4 text-left">
                                        <div class="flex items-center justify-between pb-3 border-b border-stone-100">
                                            <div>
                                                <h3 class="font-serif font-bold text-base text-[#3A2E2B]">Tulis Ulasan Produk</h3>
                                                <p class="text-[11px] text-stone-400">Bagikan pengalaman Anda menggunakan produk ini</p>
                                            </div>
                                            <button type="button" @click="openReviewModal = false" class="text-stone-400 hover:text-stone-700 font-bold text-base cursor-pointer">✕</button>
                                        </div>

                                        <form action="{{ route('reviews.store') }}" method="POST" class="space-y-4">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $firstProduct->id ?? '' }}">
                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                            <input type="hidden" name="rating" :value="selectedRating">

                                            <div class="flex items-center gap-3 p-3 bg-[#F8F6F0] rounded-2xl border border-[#EADFC7]">
                                                <span class="font-bold text-xs text-[#3A2E2B] line-clamp-1">{{ $firstProduct->name ?? 'Produk' }}</span>
                                            </div>

                                            <div class="text-center space-y-1">
                                                <label class="text-xs font-bold text-stone-600 block">Kualitas Produk:</label>
                                                <div class="flex items-center justify-center gap-2">
                                                    <template x-for="star in [1, 2, 3, 4, 5]">
                                                        <button type="button" 
                                                                @click="selectedRating = star"
                                                                class="text-2xl transition transform hover:scale-125 focus:outline-none cursor-pointer"
                                                                :class="star <= selectedRating ? 'text-amber-400' : 'text-stone-300'">
                                                            ★
                                                        </button>
                                                    </template>
                                                </div>
                                                <span class="text-[11px] font-semibold text-amber-600 block" x-text="['Sangat Buruk', 'Buruk', 'Cukup', 'Bagus', 'Sangat Memuaskan'][selectedRating - 1]">:</span>
                                            </div>

                                            <div>
                                                <label class="text-xs font-bold text-stone-600 block mb-1">Ulasan Anda:</label>
                                                <textarea name="comment" rows="4" required placeholder="Tulis ulasan Anda..." class="w-full p-3 bg-[#F8F6F0] rounded-2xl text-xs border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B] text-stone-800"></textarea>
                                            </div>

                                            <div class="flex justify-end gap-2 pt-2">
                                                <button type="button" @click="openReviewModal = false" class="px-4 py-2 rounded-xl bg-stone-100 text-stone-600 text-xs font-bold hover:bg-stone-200 cursor-pointer">Batal</button>
                                                <button type="submit" class="px-5 py-2 rounded-xl bg-[#3A2E2B] hover:bg-[#52423D] text-white text-xs font-bold shadow-md cursor-pointer flex items-center gap-1.5">
                                                    <i class="fa-solid fa-paper-plane text-[10px]"></i>
                                                    <span>Kirim Ulasan</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            @endif
                        @endif

                    </div>
                </div>
            @empty
                <div class="bg-white rounded-3xl border border-[#EADFC7] p-8 text-center space-y-3">
                    <div class="w-16 h-16 bg-[#F8F6F0] border border-[#EADFC7] rounded-full flex items-center justify-center mx-auto text-stone-400 text-xl">
                        <i class="fa-solid fa-box-open"></i>
                    </div>
                    <h4 class="font-bold text-sm text-[#3A2E2B]">Belum Ada Pesanan</h4>
                    <p class="text-xs text-stone-500">Anda belum memiliki riwayat pesanan pada kategori ini.</p>
                </div>
            @endforelse
        </div>

    </main>

</body>
</html>