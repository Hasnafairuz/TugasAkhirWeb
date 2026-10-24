<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Portal — Maison De Jenrina</title>
    
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
<body class="bg-[#F8F6F0] text-stone-800 antialiased flex min-h-screen">

    <!-- SIDEBAR CUSTOMER -->
    <aside class="w-64 bg-[#D9C19D] border-r border-[#C8B08C] min-h-screen flex flex-col justify-between p-5 fixed left-0 top-0 bottom-0 z-40 shadow-sm overflow-y-auto">
        <div>
            <!-- Header Brand & Logo -->
            <a href="{{ route('landing') }}" class="flex items-center gap-3 pb-6 border-b border-[#C8B08C]/60 mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 rounded-full border border-[#3A2E2B] p-0.5 bg-white shadow-xs object-cover">
                <div>
                    <h2 class="font-serif font-bold text-sm text-[#3A2E2B] leading-tight">MAISON DE JENRINA</h2>
                    <span class="text-[9px] text-[#52423D] uppercase tracking-widest font-semibold block">CUSTOMER PORTAL</span>
                </div>
            </a>

            <!-- Menu Navigasi Utama -->
            <nav class="space-y-1.5 mb-6">
                <a href="{{ route('customer.dashboard') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 bg-[#3A2E2B] text-white text-xs font-bold rounded-xl shadow-xs">
                    <i class="fa-solid fa-store text-amber-200"></i>
                    <span>Dashboard (Shop)</span>
                </a>

                <a href="{{ route('cart.index') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 text-[#3A2E2B] hover:bg-white/40 text-xs font-semibold rounded-xl transition">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Keranjang Belanja</span>
                </a>

                <a href="{{ route('customer.orders') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 text-[#3A2E2B] hover:bg-white/40 text-xs font-semibold rounded-xl transition">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Pesanan Saya</span>
                </a>

                <a href="{{ route('landing') }}" 
                   class="flex items-center gap-3 px-4 py-2.5 text-[#3A2E2B] hover:bg-white/40 text-xs font-semibold rounded-xl transition">
                    <i class="fa-solid fa-house"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </nav>

            <hr class="border-[#C8B08C]/60 my-4">

            <!-- FILTER SAMPING (SIDEBAR FILTER) -->
            <div class="space-y-5 text-xs text-[#3A2E2B]" x-data="{ openRating: true, openOffer: true, openOthers: true, openDelivery: true }">
                <h4 class="font-bold text-[#3A2E2B] uppercase tracking-wider text-[11px]">Filter Produk</h4>

                <!-- 1. Filter Rating -->
                <div class="border-b border-[#C8B08C]/60 pb-3">
                    <button @click="openRating = !openRating" class="flex items-center justify-between w-full font-bold text-[#3A2E2B] mb-2 cursor-pointer">
                        <span>Rating</span>
                        <i class="fa-solid text-[10px]" :class="openRating ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="openRating" class="space-y-1.5 pl-1">
                        <label class="flex items-center gap-2 cursor-pointer hover:text-[#3A2E2B]">
                            <input type="checkbox" class="rounded text-[#3A2E2B] focus:ring-0 border-[#C8B08C]">
                            <span class="flex items-center gap-1">
                                <i class="fa-solid fa-star text-amber-500 text-xs"></i>
                                <span>Rating 4 ke atas</span>
                            </span>
                        </label>
                    </div>
                </div>

                <!-- 2. Filter Penawaran -->
                <div class="border-b border-[#C8B08C]/60 pb-3">
                    <button @click="openOffer = !openOffer" class="flex items-center justify-between w-full font-bold text-[#3A2E2B] mb-2 cursor-pointer">
                        <span>Penawaran</span>
                        <i class="fa-solid text-[10px]" :class="openOffer ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="openOffer" class="space-y-1.5 pl-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="rounded border-[#C8B08C]">
                            <span>COD</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="rounded border-[#C8B08C]" checked>
                            <span>Harga Diskon</span>
                        </label>
                    </div>
                </div>

                <!-- 3. Filter Lainnya -->
                <div class="border-b border-[#C8B08C]/60 pb-3">
                    <button @click="openOthers = !openOthers" class="flex items-center justify-between w-full font-bold text-[#3A2E2B] mb-2 cursor-pointer">
                        <span>Lainnya</span>
                        <i class="fa-solid text-[10px]" :class="openOthers ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="openOthers" class="space-y-1.5 pl-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="rounded border-[#C8B08C]">
                            <span>PreOrder</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="rounded border-[#C8B08C]" checked>
                            <span>Ready Stock</span>
                        </label>
                    </div>
                </div>

                <!-- 4. Durasi Pengiriman -->
                <div>
                    <button @click="openDelivery = !openDelivery" class="flex items-center justify-between w-full font-bold text-[#3A2E2B] mb-2 cursor-pointer">
                        <span>Durasi Pengiriman</span>
                        <i class="fa-solid text-[10px]" :class="openDelivery ? 'fa-chevron-up' : 'fa-chevron-down'"></i>
                    </button>
                    <div x-show="openDelivery" class="space-y-1.5 pl-1">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="rounded border-[#C8B08C]">
                            <span>Instant / Sameday</span>
                        </label>
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" class="rounded border-[#C8B08C]">
                            <span>Reguler (2-3 Hari)</span>
                        </label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tombol Logout di Bawah Sidebar -->
        <div class="pt-4 border-t border-[#C8B08C]/60 mt-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2.5 px-4 bg-rose-900/10 hover:bg-rose-900/20 text-rose-800 font-bold text-xs rounded-xl transition flex items-center justify-center gap-2 border border-rose-800/20 cursor-pointer">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA SHOPPING DASHBOARD -->
    <div class="flex-1 ml-64 flex flex-col min-h-screen">
        
        <!-- TOPBAR AKUN CUSTOMER -->
        <header class="bg-white/80 backdrop-blur-md border-b border-[#EADFC7] px-8 py-4 sticky top-0 z-30 flex items-center justify-between">
            <div class="flex items-center gap-2 text-xs text-stone-500">
                <span>Customer</span> / <span class="font-bold text-[#3A2E2B]">Dashboard Shop</span>
            </div>

            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full bg-[#EADFC7] flex items-center justify-center text-xs font-bold text-[#3A2E2B] overflow-hidden border border-[#D5C1B2]">
                    <img src="{{ asset('images/profile.png') }}" alt="Profil" class="w-full h-full object-cover" onerror="this.style.display='none'">
                    <span style="display:none">{{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}</span>
                </div>
                <span class="text-xs font-bold text-[#3A2E2B]">{{ auth()->user()->name ?? 'Pelanggan' }}</span>
            </div>
        </header>

        <main class="p-8 flex-1">
            
            <!-- HEADER KATALOG & SEARCH -->
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl font-serif font-bold text-[#3A2E2B]">Katalog Busana Terkini</h1>
                    <p class="text-xs text-stone-500">Temukan pakaian gaya Korea dan loungewear favorit Anda</p>
                </div>

                <form action="{{ route('customer.dashboard') }}" method="GET" class="relative w-full md:w-80">
                    <input type="text" name="search" value="{{ request('search') }}" 
                           placeholder="Cari gaun, knitwear, piyama..." 
                           class="w-full pl-10 pr-4 py-2.5 bg-white border border-[#EADFC7] rounded-full text-xs focus:outline-none focus:border-[#3A2E2B] shadow-xs">
                    <button type="submit" class="absolute left-3.5 top-3 text-stone-400 text-xs cursor-pointer">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>
            </div>

            <!-- GRID KATALOG PRODUK -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                @forelse($products as $index => $product)
                    @php
                        $originalPrice = $product->price * 1.25;
                        $discountPercent = 20;
                        $ratings = [4.8, 4.9, 4.7, 5.0, 4.6];
                        $currentRating = $ratings[$index % count($ratings)];
                        $soldCount = (12 * ($index + 1)) + 15;
                    @endphp

                    <div class="bg-white rounded-2xl border border-[#EADFC7] overflow-hidden shadow-xs hover:shadow-md transition duration-300 flex flex-col justify-between group">
                        <div>
                            <!-- Gambar Produk & Badge Diskon -->
                            <div class="h-56 overflow-hidden bg-stone-100 relative flex items-center justify-center">
                                @if($product->image && file_exists(public_path('storage/' . $product->image)))
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                         class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                @else
                                    <div class="flex flex-col items-center justify-center text-stone-400">
                                        <i class="fa-solid fa-shirt text-3xl mb-1 text-stone-300"></i>
                                        <span class="text-[10px]">Maison De Jenrina</span>
                                    </div>
                                @endif
                                
                                <span class="absolute top-3 left-3 bg-white/90 backdrop-blur-sm text-[10px] font-bold text-[#3A2E2B] px-2.5 py-1 rounded-full uppercase border border-[#EADFC7]">
                                    {{ $product->category }}
                                </span>

                                <span class="absolute top-3 right-3 bg-rose-500 text-white text-[10px] font-extrabold px-2 py-0.5 rounded-md shadow-xs">
                                    -{{ $discountPercent }}%
                                </span>
                            </div>

                            <!-- Detail Produk -->
                            <div class="p-4">
                                <h3 class="font-bold text-sm text-[#3A2E2B] line-clamp-1 mb-1">{{ $product->name }}</h3>
                                
                                <!-- Informasi Warna & Ukuran Opsional -->
                                <div class="flex flex-wrap gap-1 mb-2 text-[10px] text-stone-500">
                                    @if($product->colors)
                                        <span class="bg-[#F8F6F0] px-2 py-0.5 rounded border border-[#EADFC7]">Warna: {{ $product->colors }}</span>
                                    @endif
                                    @if($product->size)
                                        <span class="bg-[#F8F6F0] px-2 py-0.5 rounded border border-[#EADFC7]">Size: {{ $product->size }}</span>
                                    @endif
                                </div>

                                <div class="flex items-center gap-1.5 text-xs mb-2">
                                    <i class="fa-solid fa-star text-amber-400 text-[11px]"></i>
                                    <span class="font-bold text-stone-700">{{ $currentRating }}</span>
                                    <span class="text-stone-300">|</span>
                                    <span class="text-[11px] text-stone-500">{{ $soldCount }}+ terjual</span>
                                </div>

                                <div class="flex items-baseline gap-2 mb-3">
                                    <span class="text-sm font-extrabold text-[#B86246]">
                                        Rp {{ number_format($product->price, 0, ',', '.') }}
                                    </span>
                                    <span class="text-[11px] text-stone-400 line-through">
                                        Rp {{ number_format($originalPrice, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL AKSI DI BAWAH KARTU (Lihat Detail + Grid Chat, Fav, Share) -->
                        <div class="p-4 pt-0 space-y-2">
                            <a href="{{ route('product.show', $product->id) }}"
                               class="w-full flex items-center justify-center gap-2 py-2 rounded-xl bg-[#F8F6F0] hover:bg-[#EADFC7] text-[#3A2E2B] text-xs font-bold border border-[#EADFC7] transition">
                                <span>Lihat Detail</span>
                                <i class="fa-solid fa-chevron-right text-[10px]"></i>
                            </a>

                            <!-- Grid 3 Tombol: Chat, Fav, Share -->
                            <div class="grid grid-cols-3 gap-1.5 pt-1 border-t border-stone-100">
                                
                                <!-- 1. TOMBOL CHAT (MODAL INTERNAL) -->
                                <div x-data="{ openChatModal: false }">
                                    <button type="button" 
                                            @click="openChatModal = true"
                                            class="w-full flex items-center justify-center gap-1 py-2 px-1 rounded-xl bg-white hover:bg-stone-50 text-stone-700 hover:text-[#3A2E2B] text-xs font-semibold transition cursor-pointer border border-[#EADFC7] shadow-xs"
                                            title="Tanya Admin">
                                        <i class="fa-regular fa-comment text-xs"></i>
                                        <span>Chat</span>
                                    </button>

                                    <!-- MODAL POPUP FORM CHAT -->
                                    <div x-show="openChatModal" 
                                         x-transition
                                         class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 flex items-center justify-center p-4" 
                                         style="display: none;">
                                        <div @click.away="openChatModal = false" class="bg-white rounded-3xl p-6 max-w-md w-full border border-[#EADFC7] shadow-xl space-y-4 text-left">
                                            <div class="flex items-center justify-between pb-3 border-b border-stone-100">
                                                <h3 class="font-serif font-bold text-base text-[#3A2E2B]">Tanya Admin / Penjual</h3>
                                                <button type="button" @click="openChatModal = false" class="text-stone-400 hover:text-stone-700 font-bold cursor-pointer">✕</button>
                                            </div>

                                            <form action="{{ route('product.chat.store', $product->id) }}" method="POST" class="space-y-4">
                                                @csrf
                                                <div>
                                                    <label class="text-xs font-bold text-stone-600 block mb-1">Produk yang Ditanyakan:</label>
                                                    <input type="text" disabled value="{{ $product->name }}" class="w-full px-3 py-2 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7] text-stone-700 font-semibold">
                                                </div>

                                                <div>
                                                    <label class="text-xs font-bold text-stone-600 block mb-1">Pesan Anda:</label>
                                                    <textarea name="message" rows="4" required placeholder="Tuliskan pertanyaan mengenai ukuran, warna, atau ketersediaan stok..." class="w-full p-3 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B] text-stone-800"></textarea>
                                                </div>

                                                <div class="flex justify-end gap-2 pt-2">
                                                    <button type="button" @click="openChatModal = false" class="px-4 py-2 rounded-xl bg-stone-100 text-stone-600 text-xs font-bold hover:bg-stone-200 cursor-pointer">Batal</button>
                                                    <button type="submit" class="px-5 py-2 rounded-xl bg-[#3A2E2B] hover:bg-[#52423D] text-white text-xs font-bold shadow-md cursor-pointer">Kirim Pesan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>

                                <!-- 2. TOMBOL FAV -->
                                <div x-data="{ isWished: false, showNotif: false }">
                                    <button type="button"
                                            @click="isWished = !isWished; showNotif = true; setTimeout(() => showNotif = false, 2000)" 
                                            :class="isWished ? 'bg-rose-50 border-rose-200 text-rose-600' : 'bg-white hover:bg-stone-50 border-[#EADFC7] text-stone-700'"
                                            class="w-full flex items-center justify-center gap-1 py-2 px-1 rounded-xl text-xs font-semibold transition cursor-pointer border shadow-xs"
                                            title="Favorit">
                                        <i class="fa-solid fa-heart text-xs" :class="isWished ? 'text-rose-600 scale-110' : 'text-stone-400'"></i>
                                        <span x-text="isWished ? 'Saved' : 'Fav'"></span>
                                    </button>

                                    <div x-show="showNotif" 
                                         x-transition 
                                         class="fixed bottom-5 right-5 bg-[#3A2E2B] text-white text-xs px-4 py-2.5 rounded-xl shadow-lg z-50 flex items-center gap-2" 
                                         style="display: none;">
                                        <i class="fa-solid fa-heart text-rose-400"></i>
                                        <span x-text="isWished ? 'Ditambahkan ke Wishlist!' : 'Dihapus dari Wishlist!'"></span>
                                    </div>
                                </div>

                                <!-- 3. TOMBOL SHARE -->
                                <div x-data="{ copied: false }">
                                    <button type="button"
                                            @click="
                                                if (navigator.share) {
                                                    navigator.share({
                                                        title: '{{ addslashes($product->name) }}',
                                                        url: window.location.origin + '/products/{{ $product->id }}'
                                                    });
                                                } else {
                                                    navigator.clipboard.writeText(window.location.origin + '/products/{{ $product->id }}');
                                                    copied = true;
                                                    setTimeout(() => copied = false, 2000);
                                                }" 
                                            class="w-full flex items-center justify-center gap-1 py-2 px-1 rounded-xl bg-white hover:bg-stone-50 text-stone-700 hover:text-[#3A2E2B] text-xs font-semibold transition cursor-pointer border border-[#EADFC7] shadow-xs"
                                            title="Share">
                                        <i class="fa-solid fa-share-nodes text-xs"></i>
                                        <span x-text="copied ? 'Tersalin' : 'Share'"></span>
                                    </button>
                                </div>

                            </div>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-16 text-center bg-white rounded-3xl border border-[#EADFC7]">
                        <i class="fa-solid fa-box-open text-3xl text-stone-300 mb-2"></i>
                        <p class="text-stone-400 text-xs">Belum ada produk yang ditemukan.</p>
                    </div>
                @endforelse
            </div>

        </main>
    </div>

</body>
</html>