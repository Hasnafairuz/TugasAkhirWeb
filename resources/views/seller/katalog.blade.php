<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk — Maison De Jenrina</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <!-- FontAwesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased min-h-screen flex">

    <!-- SIDEBAR KIRI SELLER -->
    <aside class="w-64 bg-[#3A2E2B] text-[#E8DFD8] flex flex-col justify-between p-5 min-h-screen sticky top-0 shadow-xl z-50">
        <div>
            <!-- Brand Header -->
            <div class="flex items-center gap-3.5 pb-6 border-b border-[#4E403C] mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-cover rounded-full border-2 border-[#A38875] p-0.5 bg-white shadow-sm">
                <div>
                    <h2 class="font-serif font-bold text-sm text-white tracking-wide leading-tight">Maison De Jenrina</h2>
                    <span class="text-[9px] text-[#C4B2A5] uppercase tracking-widest font-semibold block mt-0.5">Seller Center</span>
                </div>
            </div>

            <!-- Group Navigasi Utama -->
            <div class="space-y-6">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#A38875] px-3 block mb-2">Navigasi Utama</span>
                    <nav class="space-y-1.5 text-xs font-medium">
                        <a href="{{ route('seller.dashboard') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-chart-line text-sm"></i><span>Dashboard</span></div>
                        </a>
                        <a href="{{ route('seller.products.create') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-plus-circle text-sm"></i><span>Tambah Produk</span></div>
                        </a>
                        <!-- Katalog Produk (Aktif) -->
                        <a href="{{ route('seller.katalog') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#52423D] text-white font-bold shadow-sm transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-shirt text-sm text-[#D4BCAD]"></i><span>Katalog Produk</span></div>
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-70"></i>
                        </a>
                        <a href="{{ route('seller.users') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-users text-sm"></i><span>Manajemen User</span></div>
                        </a>
                        <a href="{{ route('seller.settings') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-gear text-sm"></i><span>Pengaturan Toko</span></div>
                        </a>
                    </nav>
                </div>

                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#A38875] px-3 block mb-2">Toko & Halaman</span>
                    <nav class="space-y-1">
                        <a href="{{ route('landing') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white font-medium text-xs transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-store text-sm"></i><span>Lihat Toko Publik</span></div>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] opacity-40"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="pt-4 border-t border-[#4E403C]">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-900/30 hover:bg-rose-900/60 border border-rose-800/40 text-rose-200 font-bold text-xs transition cursor-pointer shadow-xs">
                    <i class="fa-solid fa-right-from-bracket"></i><span>Keluar dari Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- AREA KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <header class="bg-white border-b border-[#EADFC7] px-8 py-3.5 sticky top-0 z-40 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold text-stone-400">Seller</span>
                <span class="text-xs text-stone-300">/</span>
                <h1 class="text-sm font-bold text-[#3A2E2B]">Katalog Produk</h1>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full overflow-hidden border border-[#D5C1B2] bg-stone-100 shrink-0">
                    <img src="{{ asset('images/profile.png') }}" alt="Profil" class="w-full h-full object-cover">
                </div>
                <span class="text-xs font-bold text-[#3A2E2B]">{{ auth()->user()->name ?? 'Jenrina' }}</span>
            </div>
        </header>

        <main class="p-8 space-y-6 max-w-6xl mx-auto w-full">
            <!-- Header Info -->
            <div class="bg-white rounded-3xl border border-[#EADFC7] p-6 shadow-xs flex items-center justify-between">
                <div>
                    <h2 class="text-xl font-serif font-bold text-[#3A2E2B]">Seluruh Katalog Produk Toko</h2>
                    <p class="text-xs text-stone-500 mt-1">Daftar lengkap produk pakaian yang aktif dan tampil di toko publik.</p>
                </div>
                <span class="text-xs font-bold text-[#A38875] bg-[#F8F6F0] px-4 py-2 rounded-xl border border-[#EADFC7]">
                    Total: {{ $products->total() }} Produk
                </span>
            </div>

            <!-- GRID KARTU PRODUK -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                @forelse($products as $product)
                    <div class="p-4 rounded-3xl border border-[#EADFC7] bg-white hover:shadow-md transition-all flex flex-col justify-between group relative overflow-hidden space-y-3">
                        
                        <div>
                            <!-- AREA GAMBAR & BADGE -->
                            <div class="relative w-full h-52 rounded-2xl overflow-hidden mb-3 border border-stone-100 bg-stone-100">
                                <a href="{{ route('product.show', $product->id) }}">
                                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover group-hover:scale-105 transition duration-300">
                                </a>

                                <!-- BADGE KATEGORI (KIRI BAWAH) -->
                                <span class="absolute bottom-2.5 left-2.5 bg-black/60 text-white text-[9px] font-bold px-2.5 py-0.5 rounded-full backdrop-blur-xs">
                                    {{ $product->category }}
                                </span>

                                <!-- BADGE INDIKATOR MULTI-FOTO (KANAN ATAS) -->
                                @if($product->images && $product->images->count() > 0)
                                    <span class="absolute top-2.5 right-2.5 bg-[#3A2E2B]/80 backdrop-blur-xs text-white text-[9px] font-bold px-2 py-0.5 rounded-full flex items-center gap-1 shadow-xs z-10">
                                        <i class="fa-solid fa-images text-[8px]"></i> {{ $product->images->count() + 1 }} Foto
                                    </span>
                                @endif
                            </div>

                            <!-- NAMA PRODUK -->
                            <h4 class="font-bold text-[#3A2E2B] text-xs leading-snug line-clamp-2 h-8 mb-2" title="{{ $product->name }}">
                                <a href="{{ route('product.show', $product->id) }}" class="hover:underline">{{ $product->name }}</a>
                            </h4>

                            <!-- INFORMASI WARNA PRODUK (DINAMIS DARI DATABASE) -->
                            <p class="text-[11px] text-stone-500 font-medium mb-2">
                                Warna: <span class="font-semibold text-stone-700">{{ $product->colors ?? '-' }}</span>
                            </p>

                            <!-- HARGA & STOK -->
                            <div class="flex items-center justify-between text-[11px]">
                                <span class="font-extrabold text-[#3A2E2B]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                <span class="text-stone-500 font-semibold bg-stone-100 px-2 py-0.5 rounded-md">Stok: {{ $product->stock }}</span>
                            </div>
                        </div>

                        <!-- TOMBOL AKSI: DETAIL & HAPUS PRODUK -->
                        <div class="space-y-2 pt-2 border-t border-stone-100">
                            <!-- Tombol Lihat Detail -->
                            <a href="{{ route('product.show', $product->id) }}" class="w-full py-2 bg-[#F8F6F0] hover:bg-[#3A2E2B] text-[#3A2E2B] hover:text-white rounded-xl text-xs font-bold border border-[#EADFC7] transition flex items-center justify-center gap-1.5 shadow-2xs">
                                <i class="fa-solid fa-eye text-[10px]"></i>
                                <span>Detail Produk</span>
                            </a>

                            <!-- Tombol Hapus Produk -->
                            <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="w-full py-2 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-xl text-xs font-bold border border-rose-200 transition flex items-center justify-center gap-1.5 cursor-pointer">
                                    <i class="fa-solid fa-trash-can text-[10px]"></i> Hapus Produk
                                </button>
                            </form>
                        </div>

                    </div>
                @empty
                    <div class="col-span-full p-12 text-center bg-white rounded-3xl border border-[#EADFC7]">
                        <i class="fa-solid fa-box-open text-4xl text-stone-300 mb-2 block"></i>
                        <p class="text-xs font-bold text-stone-500">Belum ada produk di dalam katalog toko Anda.</p>
                    </div>
                @endforelse
            </div>

            <!-- PAGINASI -->
            @if ($products->hasPages())
                <div class="bg-white rounded-3xl border border-[#EADFC7] p-5 shadow-xs flex items-center justify-between text-xs font-bold text-[#3A2E2B]">
                    <span class="text-[11px] text-stone-500 font-medium">
                        Menampilkan <span class="font-bold text-[#3A2E2B]">{{ $products->firstItem() }}</span> - <span class="font-bold text-[#3A2E2B]">{{ $products->lastItem() }}</span> dari <span class="font-bold text-[#3A2E2B]">{{ $products->total() }}</span> produk
                    </span>

                    <div class="flex items-center gap-1.5">
                        @if ($products->onFirstPage())
                            <span class="px-3.5 py-2 bg-stone-100 text-stone-400 rounded-xl text-xs font-semibold cursor-not-allowed border border-stone-200">
                                <i class="fa-solid fa-chevron-left text-[10px] mr-1"></i> Sebelumnya
                            </span>
                        @else
                            <a href="{{ $products->previousPageUrl() }}" class="px-3.5 py-2 bg-[#F8F6F0] hover:bg-[#52423D] hover:text-white text-[#3A2E2B] rounded-xl text-xs font-semibold transition border border-[#EADFC7] shadow-xs">
                                <i class="fa-solid fa-chevron-left text-[10px] mr-1"></i> Sebelumnya
                            </a>
                        @endif

                        @if ($products->hasMorePages())
                            <a href="{{ $products->nextPageUrl() }}" class="px-3.5 py-2 bg-[#F8F6F0] hover:bg-[#52423D] hover:text-white text-[#3A2E2B] rounded-xl text-xs font-semibold transition border border-[#EADFC7] shadow-xs">
                                Selanjutnya <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
                            </a>
                        @else
                            <span class="px-3.5 py-2 bg-stone-100 text-stone-400 rounded-xl text-xs font-semibold cursor-not-allowed border border-stone-200">
                                Selanjutnya <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        </main>
    </div>

</body>
</html>