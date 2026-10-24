<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Seller — Maison De Jenrina</title>
    
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
                <img src="{{ asset('images/logo.png') }}" alt="Logo Maison De Jenrina" class="w-10 h-10 object-cover rounded-full border-2 border-[#A38875] p-0.5 bg-white shadow-sm">
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
                        <!-- Tombol Dashboard (Aktif) -->
                        <a href="{{ route('seller.dashboard') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#52423D] text-white font-bold shadow-sm transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-chart-line text-sm text-[#D4BCAD]"></i>
                                <span>Dashboard</span>
                            </div>
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-70"></i>
                        </a>

                        <!-- Tombol Tambah Produk -->
                        <a href="{{ route('seller.products.create') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-plus-circle text-sm"></i>
                                <span>Tambah Produk</span>
                            </div>
                        </a>

                        <!-- Tombol Katalog Produk -->
                        <a href="{{ route('seller.katalog') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-shirt text-sm"></i>
                                <span>Katalog Produk</span>
                            </div>
                        </a>

                        <!-- Menu Manajemen User -->
                        <a href="{{ route('seller.users') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-users text-sm"></i>
                                <span>Manajemen User</span>
                            </div>
                        </a>

                        <!-- Menu Pengaturan Toko -->
                        <a href="{{ route('seller.settings') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-gear text-sm"></i>
                                <span>Pengaturan Toko</span>
                            </div>
                        </a>
                    </nav>
                </div>

                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#A38875] px-3 block mb-2">Toko & Halaman</span>
                    <nav class="space-y-1">
                        <a href="{{ route('landing') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white font-medium text-xs transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-store text-sm"></i>
                                <span>Lihat Toko Publik</span>
                            </div>
                            <i class="fa-solid fa-arrow-up-right-from-square text-[10px] opacity-40"></i>
                        </a>
                    </nav>
                </div>
            </div>
        </div>

        <!-- Tombol Logout -->
        <div class="pt-4 border-t border-[#4E403C]">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-900/30 hover:bg-rose-900/60 border border-rose-800/40 text-rose-200 font-bold text-xs transition cursor-pointer shadow-xs">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar (Logout) </span>
                </button>
            </form>
        </div>
    </aside>

    <!-- AREA KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">

        <!-- HEADER TOPBAR -->
        <header class="bg-white border-b border-[#EADFC7] px-8 py-3.5 sticky top-0 z-40 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold text-stone-400">Seller</span>
                <span class="text-xs text-stone-300">/</span>
                <h1 class="text-sm font-bold text-[#3A2E2B]">Dashboard Toko</h1>
            </div>

            <div class="flex items-center gap-5">
                <form action="{{ route('landing') }}" method="GET" class="relative hidden sm:block w-64">
                    <input type="text" name="search" placeholder="Cari katalog pakaian..." 
                           class="w-full pl-8 pr-4 py-1.5 rounded-full bg-[#F8F6F0] text-xs border border-[#EADFC7] focus:outline-none focus:bg-white focus:border-[#A38875] transition">
                    <i class="fa-solid fa-magnifying-glass absolute left-3 top-2 text-stone-400 text-xs"></i>
                </form>

                <div class="h-4 w-px bg-stone-200 hidden sm:block"></div>

                <!-- Notifikasi -->
                <div class="flex items-center gap-3 relative" x-data="{ openNotif: false }">
                    <div class="relative">
                        <button type="button" @click="openNotif = !openNotif" class="w-9 h-9 rounded-full bg-[#F8F6F0] hover:bg-[#EFEADB] flex items-center justify-center text-[#3A2E2B] transition relative border border-[#EADFC7] cursor-pointer">
                            <i class="fa-regular fa-bell text-sm"></i>
                            @if(isset($notifications) && $notifications->count() > 0)
                                <span class="absolute top-2 right-2 w-2 h-2 bg-[#B86246] rounded-full"></span>
                            @endif
                        </button>

                        <div x-show="openNotif" @click.away="openNotif = false" x-transition class="absolute right-0 mt-2 w-80 bg-white rounded-2xl border border-[#EADFC7] shadow-xl z-50 p-4 space-y-3" style="display: none;">
                            <div class="flex items-center justify-between pb-2 border-b border-stone-100">
                                <h4 class="text-xs font-bold text-[#3A2E2B] flex items-center gap-1.5">
                                    <i class="fa-solid fa-bell text-[#A38875]"></i> Notifikasi Toko
                                </h4>
                                <span class="text-[10px] text-stone-400 font-semibold">{{ $notifications->count() ?? 0 }} Terbaru</span>
                            </div>
                            <div class="space-y-2 max-h-60 overflow-y-auto">
                                @forelse($notifications ?? [] as $notif)
                                    <div class="p-2.5 rounded-xl bg-[#F8F6F0] border border-[#EADFC7]/60 flex items-center gap-2.5">
                                        <!-- FOTO PRODUK PADA NOTIFIKASI -->
                                        <div class="w-9 h-9 rounded-xl overflow-hidden bg-stone-200 shrink-0 border border-[#EADFC7]">
                                            @if($notif->product && $notif->product->image)
                                                <img src="{{ asset('storage/' . $notif->product->image) }}" alt="{{ $notif->product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-stone-400 bg-stone-100">
                                                    <i class="fa-solid fa-shirt text-xs"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <div class="min-w-0 flex-1">
                                            <p class="text-[11px] font-bold text-[#3A2E2B] truncate">Pesanan Baru #{{ $notif->invoice_number ?? $notif->id }}</p>
                                            <p class="text-[10px] text-stone-500 truncate">Pembeli: {{ $notif->customer->name ?? $notif->customer_name ?? 'Pelanggan' }}</p>
                                            <span class="text-[9px] text-[#B86246] font-bold block mt-0.5">Rp {{ number_format($notif->total_amount ?? $notif->total_price ?? 0, 0, ',', '.') }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div class="text-center py-4">
                                        <i class="fa-regular fa-bell-slash text-2xl text-stone-300 mb-1 block"></i>
                                        <p class="text-[11px] text-stone-400 font-medium">Belum ada pesanan baru.</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>

                <div class="h-4 w-px bg-stone-200"></div>

                <!-- Profil -->
                <div class="flex items-center gap-2.5 pl-1">
                    <div class="w-8 h-8 rounded-full overflow-hidden border border-[#D5C1B2] bg-stone-100 shrink-0">
                        <img src="{{ asset('images/profile.png') }}" alt="Profil" class="w-full h-full object-cover">
                    </div>
                    <div class="hidden md:block text-left">
                        <span class="text-xs font-bold text-[#3A2E2B] block leading-tight">{{ auth()->user()->name ?? 'Jenrina' }}</span>
                        <span class="text-[10px] text-stone-400 font-semibold uppercase">Seller</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- KONTEN UTAMA DASHBOARD -->
        <main class="p-8 space-y-8 max-w-5xl mx-auto w-full">

            <!-- Banner Welcome Panel -->
            <div class="bg-white rounded-3xl border border-[#EADFC7] p-6 shadow-xs flex items-center justify-between">
                <div>
                    <span class="text-[10px] font-bold text-[#A38875] bg-[#F8F6F0] px-3 py-1 rounded-full border border-[#EADFC7] uppercase tracking-wider">Dashboard E-Commerce</span>
                    <h2 class="text-2xl font-serif font-bold text-[#3A2E2B] mt-2">Panel Seller — Maison De Jenrina</h2>
                    <p class="text-xs text-stone-500 mt-1">Kelola katalog pakaian dan stok barang toko Anda secara efisien.</p>
                </div>
                <div class="hidden md:flex gap-3">
                    <div class="bg-[#F8F6F0] px-5 py-3 rounded-2xl border border-[#EADFC7] text-center shadow-xs">
                        <span class="text-[10px] text-stone-500 font-bold uppercase block">Total Produk</span>
                        <span class="text-xl font-extrabold text-[#3A2E2B]">
                            {{ method_exists($products, 'total') ? $products->total() : count($products) }} Item
                        </span>
                    </div>
                </div>
            </div>

            <!-- Alert Success -->
            @if(session('success'))
                <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold rounded-2xl flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <!-- DAFTAR PRODUK -->
            <div class="bg-white rounded-3xl border border-[#EADFC7] p-6 shadow-xs">
                <div class="flex items-center justify-between mb-4 pb-3 border-b border-stone-100">
                    <div>
                        <h3 class="text-base font-bold text-[#3A2E2B]">Daftar Produk Toko</h3>
                        <p class="text-[11px] text-stone-400">Kelola katalog pakaian toko</p>
                    </div>
                    <a href="{{ route('seller.products.create') }}" class="px-4 py-2 bg-[#52423D] hover:bg-[#3A2E2B] text-white rounded-xl text-xs font-bold transition flex items-center gap-2 shadow-xs">
                        <i class="fa-solid fa-plus"></i> Tambah Produk Baru
                    </a>
                </div>

                <!-- List Produk -->
                <div class="space-y-3">
                    @forelse($products as $product)
                        <div class="p-3.5 rounded-2xl border border-stone-200 bg-[#F8F6F0]/30 hover:bg-[#F8F6F0] transition flex items-center justify-between gap-4">
                            <div class="flex items-center gap-3 min-w-0">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-14 h-14 object-cover rounded-xl border border-stone-200 shrink-0">
                                <div class="min-w-0">
                                    <h4 class="font-bold text-[#3A2E2B] text-xs truncate">{{ $product->name }}</h4>
                                    <p class="text-[11px] text-stone-500 mt-0.5">
                                        <span class="font-bold text-[#B86246]">Rp {{ number_format($product->price, 0, ',', '.') }}</span> 
                                        | Stok: <span class="font-semibold text-stone-700">{{ $product->stock }}</span>
                                    </p>
                                </div>
                            </div>

                            <!-- TOMBOL EDIT & HAPUS -->
                            <div class="flex items-center gap-2">
                                <a href="{{ route('seller.products.edit', $product->id) }}" 
                                   class="px-3 py-1.5 bg-stone-100 hover:bg-stone-200 text-stone-700 rounded-lg text-xs font-bold border border-stone-300 transition flex items-center gap-1.5">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </a>

                                <form action="{{ route('seller.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus produk ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="px-3 py-1.5 bg-rose-50 hover:bg-rose-100 text-rose-700 rounded-lg text-xs font-bold border border-rose-200 transition cursor-pointer">
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    @empty
                        <div class="p-8 text-center border-2 border-dashed border-stone-200 rounded-2xl">
                            <i class="fa-solid fa-box-open text-3xl text-stone-300 mb-2 block"></i>
                            <p class="text-xs font-bold text-stone-500">Belum ada produk yang ditambahkan.</p>
                        </div>
                    @endforelse
                </div>

                <!-- PAGINASI KUSTOM YANG ELEGAN -->
                @if ($products->hasPages())
                    <div class="mt-6 pt-4 border-t border-stone-100 flex items-center justify-between text-xs font-bold text-[#3A2E2B]">
                        <span class="text-[11px] text-stone-500 font-medium">
                            Menampilkan <span class="font-bold text-[#3A2E2B]">{{ $products->firstItem() }}</span> - <span class="font-bold text-[#3A2E2B]">{{ $products->lastItem() }}</span> dari <span class="font-bold text-[#3A2E2B]">{{ $products->total() }}</span> produk
                        </span>

                        <div class="flex items-center gap-1.5">
                            @if ($products->onFirstPage())
                                <span class="px-3 py-1.5 bg-stone-100 text-stone-400 rounded-xl text-xs font-semibold cursor-not-allowed border border-stone-200">
                                    <i class="fa-solid fa-chevron-left text-[10px] mr-1"></i> Sebelumnya
                                </span>
                            @else
                                <a href="{{ $products->previousPageUrl() }}" class="px-3 py-1.5 bg-white hover:bg-[#52423D] hover:text-white text-[#3A2E2B] rounded-xl text-xs font-semibold transition border border-[#EADFC7] shadow-xs">
                                    <i class="fa-solid fa-chevron-left text-[10px] mr-1"></i> Sebelumnya
                                </a>
                            @endif

                            @if ($products->hasMorePages())
                                <a href="{{ $products->nextPageUrl() }}" class="px-3 py-1.5 bg-white hover:bg-[#52423D] hover:text-white text-[#3A2E2B] rounded-xl text-xs font-semibold transition border border-[#EADFC7] shadow-xs">
                                    Selanjutnya <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
                                </a>
                            @else
                                <span class="px-3 py-1.5 bg-stone-100 text-stone-400 rounded-xl text-xs font-semibold cursor-not-allowed border border-stone-200">
                                    Selanjutnya <i class="fa-solid fa-chevron-right text-[10px] ml-1"></i>
                                </span>
                            @endif
                        </div>
                    </div>
                @endif
            </div>

        </main>
    </div>

</body>
</html>