<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maison De Jenrina — K-Fashion & Loungewear Collection</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F5F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#F8F5F0] text-stone-800">

    <!-- NAVBAR NAVIGATION -->
    <nav class="bg-[#EFE9E0] border-b border-[#E2D9CC] sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Logo Brand -->
            <a href="{{ route('landing') }}" class="flex items-center gap-3 group">
                 <img src="{{ asset('images/logo.png') }}" 
                 alt="Logo Maison De Jenrina" 
                 class="w-12 h-12 object-contain rounded-full border border-[#D8C2A7] p-0.5 bg-white shadow-xs group-hover:scale-105 transition-transform">

                 <div class="flex flex-col">
                    <span class="font-serif text-xl md:text-2xl font-bold text-[#3D2E24] tracking-wide group-hover:text-[#8C6D58] transition-colors">
                        MAISON DE JENRINA
                    </span>
                    <span class="text-[9px] text-stone-500 uppercase tracking-widest -mt-0.5">
                        Korean Fashion Store
                    </span>
                </div>
            </a>

            <!-- Search Bar Navigation -->
            <form action="{{ route('landing') }}" method="GET" class="hidden md:flex relative w-80">
                <input type="text" 
                       name="search" 
                       placeholder="Cari pakaian gaya korea, knitwear..." 
                       value="{{ request('search') }}"
                       class="w-full pl-10 pr-4 py-2 rounded-full bg-white text-xs border border-[#E2D9CC] focus:outline-none focus:border-[#4A3E3D] shadow-xs">
                <button type="submit" class="absolute left-3.5 top-2.5 text-stone-400 text-xs hover:text-[#4A3E3D]">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>

            <!-- Nav Action Buttons -->
            <div class="flex items-center gap-3">
                @auth
                    @if(auth()->user()->role === 'admin')
                        <a href="{{ route('admin.dashboard') }}" class="px-4 py-2 rounded-xl bg-[#4A3E3D] text-white text-xs font-bold shadow-sm hover:bg-[#322928] transition">
                            Dashboard Admin
                        </a>
                    @elseif(auth()->user()->role === 'seller')
                        <a href="{{ route('seller.dashboard') }}" class="px-4 py-2 rounded-xl bg-[#4A3E3D] text-white text-xs font-bold shadow-sm hover:bg-[#322928] transition">
                            Dashboard Seller
                        </a>
                    @else
                        <a href="{{ route('customer.orders') }}" class="px-4 py-2 rounded-xl bg-[#4A3E3D] text-white text-xs font-bold shadow-sm hover:bg-[#322928] transition">
                            Pesanan Saya
                        </a>
                    @endif

                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="px-4 py-2 rounded-xl border border-rose-200 bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold transition flex items-center gap-1.5">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="px-5 py-2.5 rounded-xl border border-[#4A3E3D] text-[#4A3E3D] hover:bg-[#4A3E3D] hover:text-white text-xs font-bold transition">
                        LOGIN
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- MAIN CONTENT CONTAINER -->
    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">

        <!-- BANNER HERO COLLECTION (KEMBALI KE DESAIN SEMULA TANPA FOTO) -->
        <div class="bg-gradient-to-r from-[#EADBC8] via-[#E5D3B9] to-[#DFCCB3] p-8 md:p-12 rounded-3xl border border-[#D8C2A7] shadow-sm relative overflow-hidden my-6">
            <div class="flex flex-col md:flex-row items-center justify-between gap-8 relative z-10">
                <div class="max-w-xl">
                    <span class="text-xs font-bold uppercase tracking-widest text-[#7C5C43] bg-white/60 px-3 py-1 rounded-full border border-[#D2BBA0] shadow-xs">
                        K-Fashion & Loungewear Collection
                    </span>
                    <h1 class="text-4xl md:text-5xl font-serif font-bold text-[#3D2E24] mt-4 mb-3 leading-tight">
                        Elevated Style.<br>Everyday You.
                    </h1>
                    <p class="text-xs md:text-sm text-[#5C483A] mb-6 leading-relaxed">
                        Temukan koleksi baju wanita gaya Korea, knitwear lembut, dan loungewear santai terkini hanya di Maison De Jenrina.
                    </p>
                    <a href="#katalog-produk" class="inline-flex items-center gap-2 px-6 py-3 rounded-2xl bg-gradient-to-r from-[#B86246] to-[#8C3E27] text-white font-bold text-xs uppercase tracking-wider shadow-md hover:from-[#A05137] hover:to-[#73311E] transition-all">
                        <span>Jelajahi Produk</span>
                        <i class="fa-solid fa-arrow-right text-xs"></i>
                    </a>
                </div>
                <div class="bg-white/80 backdrop-blur-md p-6 rounded-2xl border border-white/60 shadow-xs max-w-xs text-center">
                    <p class="font-serif italic text-sm text-[#3D2E24] font-medium">
                        "Timeless pieces. Modern silhouettes."
                    </p>
                    <p class="text-[10px] uppercase tracking-widest text-[#8C6D58] mt-2 font-semibold">
                        — Maison De Jenrina
                    </p>
                </div>
            </div>
        </div>

        <!-- KATEGORI PRODUK MELINGKAR -->
        <section class="py-6">
            <div class="flex items-center justify-between mb-4">
                <h3 class="font-serif font-bold text-lg text-[#4A3E3D]">Kategori Pilihan</h3>
            </div>
            <div class="flex items-center gap-6 overflow-x-auto no-scrollbar py-2">
                <a href="{{ route('landing') }}" class="flex flex-col items-center gap-2 group shrink-0">
                    <div class="w-16 h-16 rounded-full bg-white border-2 border-[#E2D9CC] shadow-sm flex items-center justify-center group-hover:border-[#8C6D58] group-hover:scale-105 transition">
                        <div class="grid grid-cols-2 gap-1">
                            <span class="w-2 h-2 rounded-full bg-[#4A3E3D]"></span>
                            <span class="w-2 h-2 rounded-full bg-[#4A3E3D]"></span>
                            <span class="w-2 h-2 rounded-full bg-[#4A3E3D]"></span>
                            <span class="w-2 h-2 rounded-full bg-[#4A3E3D]"></span>
                        </div>
                    </div>
                    <span class="text-xs font-bold text-[#4A3E3D] group-hover:text-[#8C6D58] transition">View All</span>
                </a>

                <a href="{{ route('landing', ['search' => 'korean']) }}" class="flex flex-col items-center gap-2 group shrink-0">
                    <div class="w-16 h-16 rounded-full bg-[#EFE3D3] border-2 border-[#D8C7AF] shadow-sm flex items-center justify-center group-hover:scale-105 transition">
                        <i class="fa-solid fa-shirt text-[#6B5A58] text-lg"></i>
                    </div>
                    <span class="text-xs font-semibold text-stone-700 group-hover:text-[#4A3E3D] transition">Korean Style</span>
                </a>

                <a href="{{ route('landing', ['search' => 'knitwear']) }}" class="flex flex-col items-center gap-2 group shrink-0">
                    <div class="w-16 h-16 rounded-full bg-[#E2ECE9] border-2 border-[#B2CDC7] shadow-sm flex items-center justify-center group-hover:scale-105 transition">
                        <i class="fa-solid fa-vest text-teal-800 text-lg"></i>
                    </div>
                    <span class="text-xs font-semibold text-stone-700 group-hover:text-[#4A3E3D] transition">Knitwear</span>
                </a>

                <a href="{{ route('landing', ['search' => 'teen']) }}" class="flex flex-col items-center gap-2 group shrink-0">
                    <div class="w-16 h-16 rounded-full bg-[#EAE8F5] border-2 border-[#BFB8DC] shadow-sm flex items-center justify-center group-hover:scale-105 transition">
                        <i class="fa-solid fa-hat-cowboy text-indigo-800 text-lg"></i>
                    </div>
                    <span class="text-xs font-semibold text-stone-700 group-hover:text-[#4A3E3D] transition">Teen Fashion</span>
                </a>

                <a href="{{ route('landing', ['search' => 'loungewear']) }}" class="flex flex-col items-center gap-2 group shrink-0">
                    <div class="w-16 h-16 rounded-full bg-[#FCECE8] border-2 border-[#EFC3B7] shadow-sm flex items-center justify-center group-hover:scale-105 transition">
                        <i class="fa-solid fa-bed text-rose-800 text-lg"></i>
                    </div>
                    <span class="text-xs font-semibold text-stone-700 group-hover:text-[#4A3E3D] transition">Loungewear</span>
                </a>
            </div>
        </section>

        <!-- SECTION KATALOG PRODUK PUBLIK -->
        <section id="katalog-produk" class="py-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h2 class="text-2xl font-serif font-bold text-[#4A3E3D]">Koleksi Pakaian Terbaik</h2>
                    <p class="text-xs text-stone-500 mt-1">Pilihan busana trendi langsung dari Jenrina Store</p>
                </div>
                @if(request('search'))
                    <a href="{{ route('landing') }}" class="text-xs font-bold text-rose-700 bg-rose-50 px-3 py-1.5 rounded-lg border border-rose-200">
                        Reset Filter: "{{ request('search') }}" ×
                    </a>
                @endif
            </div>

            <!-- GRID PRODUK DENGAN TOMBOL AKSI LENGKAP -->
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($products as $product)
                    @php
                        $hasDiscount = !empty($product->discount_price) && $product->discount_price > 0 && $product->discount_price != $product->price;
                        
                        if ($hasDiscount) {
                            $originalPrice = max($product->price, $product->discount_price);
                            $promoPrice = min($product->price, $product->discount_price);
                            $discountPercent = round((($originalPrice - $promoPrice) / $originalPrice) * 100);
                        } else {
                            $promoPrice = $product->price;
                        }
                    @endphp

                    <div class="bg-white rounded-2xl border border-[#E2D9CC] overflow-hidden shadow-xs hover:shadow-md transition flex flex-col justify-between relative">
                        
                        <!-- BADGE DISKON OTOMATIS -->
                        @if($hasDiscount)
                            <span class="absolute top-3 left-3 bg-rose-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full shadow-sm z-10">
                                -{{ $discountPercent }}%
                            </span>
                        @endif

                        <div>
                            <div class="h-52 overflow-hidden bg-stone-100 relative">
                                <!-- Klik gambar mengarah ke halaman detail produk -->
                                <a href="{{ route('product.show', $product->id) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full h-full object-cover hover:scale-105 transition duration-300" alt="{{ $product->name }}">
                                </a>

                                <!-- BADGE INDIKATOR JUMLAH FOTO LEBIH DARI 1 -->
                                @if($product->images && $product->images->count() > 0)
                                    <span class="absolute top-3 right-3 bg-[#3A2E2B]/80 backdrop-blur-xs text-white text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-xs z-10">
                                        <i class="fa-solid fa-images text-[8px]"></i> {{ $product->images->count() + 1 }} Foto
                                    </span>
                                @endif

                                <span class="absolute bottom-3 left-3 bg-white/90 backdrop-blur-sm text-[10px] font-bold text-[#4A3E3D] px-2.5 py-1 rounded-full uppercase tracking-wider border border-[#E2D9CC]">
                                    {{ $product->category }}
                                </span>
                            </div>
                            <div class="p-4">
                                <!-- Nama Produk dengan tautan ke detail produk -->
                                <h3 class="font-bold text-sm text-[#4A3E3D] line-clamp-1 mb-2">
                                    <a href="{{ route('product.show', $product->id) }}" class="hover:underline">{{ $product->name }}</a>
                                </h3>
                                
                                <!-- KONDISI HARGA -->
                                <div class="flex items-center gap-2 mb-3">
                                    @if($hasDiscount)
                                        <span class="font-extrabold text-[#B86246] text-sm">
                                            Rp {{ number_format($promoPrice, 0, ',', '.') }}
                                        </span>
                                        <span class="text-stone-400 text-xs line-through">
                                            Rp {{ number_format($originalPrice, 0, ',', '.') }}
                                        </span>
                                    @else
                                        <span class="font-extrabold text-[#4A3E3D] text-sm">
                                            Rp {{ number_format($promoPrice, 0, ',', '.') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- TOMBOL AKSI BAWAH KARTU KATALOG -->
                        <div class="p-4 pt-0 space-y-2">
                            <!-- Grid Tombol Aksi Katalog -->
                            <div class="grid grid-cols-3 gap-1 pt-2 border-t border-stone-100" x-data="{ openChatModal: false }">
                                
                                <!-- 1. TOMBOL CHAT (Membuka Modal Form Internal) -->
                                <button type="button" 
                                        @click="openChatModal = true"
                                        class="flex items-center justify-center gap-1 py-1.5 px-1 rounded-lg bg-stone-50 hover:bg-[#EADFC7] text-stone-700 hover:text-[#3A2E2B] text-[11px] font-bold transition cursor-pointer border border-stone-200"
                                        title="Tanya Admin">
                                    <i class="fa-regular fa-comment text-xs"></i>
                                    <span>Chat</span>
                                </button>

                                <!-- MODAL POPUP FORM CHAT INTERNAL -->
                                <div x-show="openChatModal" 
                                     x-transition
                                     class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 flex items-center justify-center p-4" 
                                     style="display: none;">
                                    <div @click.away="openChatModal = false" class="bg-white rounded-3xl p-6 max-w-md w-full border border-[#EADFC7] shadow-xl space-y-4 text-left">
                                        <div class="flex items-center justify-between pb-3 border-b border-stone-100">
                                            <h3 class="font-serif font-bold text-base text-[#3A2E2B]">Tanya Admin / Penjual</h3>
                                            <button type="button" @click="openChatModal = false" class="text-stone-400 hover:text-stone-700 font-bold cursor-pointer">✕</button>
                                        </div>

                                        <!-- Form Pengiriman Pesan ke Database (Tabel Chats) -->
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

                                <!-- 2. TOMBOL WISHLIST -->
                                <div x-data="{ isWished: false, showNotif: false }">
                                    <button type="button"
                                            @click="isWished = !isWished; showNotif = true; setTimeout(() => showNotif = false, 2000)" 
                                            :class="isWished ? 'bg-rose-50 border-rose-200 text-rose-600' : 'bg-stone-50 border-stone-200 text-stone-700 hover:bg-[#EADFC7] hover:text-[#3A2E2B]'"
                                            class="w-full flex items-center justify-center gap-1 py-1.5 px-1 rounded-lg text-[11px] font-bold transition cursor-pointer border">
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
                                            class="w-full flex items-center justify-center gap-1 py-1.5 px-1 rounded-lg bg-stone-50 hover:bg-[#EADFC7] text-stone-700 hover:text-[#3A2E2B] text-[11px] font-bold transition cursor-pointer border border-stone-200">
                                        <i class="fa-solid fa-share-nodes text-xs"></i>
                                        <span x-text="copied ? 'Tersalin' : 'Share'"></span>
                                    </button>
                                </div>

                            </div>

                            <!-- TOMBOL DETAIL PRODUK / LIHAT DETAIL -->
                            <a href="{{ route('product.show', $product->id) }}" class="w-full py-2 bg-stone-100 hover:bg-[#3A2E2B] text-stone-700 hover:text-white rounded-xl text-xs font-bold transition flex items-center justify-center gap-1.5 border border-stone-200 shadow-2xs">
                                <i class="fa-solid fa-eye text-[10px]"></i>
                                <span>Lihat Detail Produk</span>
                            </a>

                        </div>

                    </div>
                @empty
                    <div class="col-span-full py-12 text-center bg-white rounded-2xl border border-[#E2D9CC]">
                        <p class="text-stone-400 text-sm">Belum ada koleksi produk yang cocok ditemukan.</p>
                    </div>
                @endforelse
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="bg-[#EFE9E0] border-t border-[#E2D9CC] py-8 mt-12 text-center text-xs text-stone-500">
        <p class="font-serif font-bold text-sm text-[#4A3E3D] mb-1">MAISON DE JENRINA</p>
        <p>&copy; 2026 Maison De Jenrina. All rights reserved.</p>
    </footer>

</body>
</html>