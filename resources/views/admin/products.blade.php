<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk — Admin Maison De Jenrina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased min-h-screen flex">

    <!-- SIDEBAR KIRI ADMIN -->
    <aside class="w-64 bg-[#3A2E2B] text-[#E8DFD8] flex flex-col justify-between p-5 min-h-screen sticky top-0 shadow-xl z-50">
        <div>
            <!-- Brand & Logo -->
            <div class="flex items-center gap-3.5 pb-6 border-b border-[#4E403C] mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo Maison De Jenrina" class="w-10 h-10 object-cover rounded-full border-2 border-[#A38875] p-0.5 bg-white shadow-sm">
                <div>
                    <h2 class="font-serif font-bold text-xs text-white tracking-wide leading-tight">MAISON DE JENRINA</h2>
                    <span class="text-[9px] text-[#C4B2A5] uppercase tracking-widest font-semibold block mt-0.5">Admin Management</span>
                </div>
            </div>

            <!-- Navigation Links -->
            <nav class="space-y-1.5 text-xs font-medium">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-chart-pie text-sm"></i><span>Dashboard</span></div>
                </a>
                
                <a href="{{ route('admin.orders') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-bag-shopping text-sm"></i><span>Pesanan (Orders)</span></div>
                </a>

                <!-- KATALOG PRODUK (WARNA AKTIF COKELAT) -->
                <a href="{{ route('admin.products') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#52423D] text-white font-bold shadow-sm transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-shirt text-sm text-[#D4BCAD]"></i><span>Katalog Produk</span></div>
                    <i class="fa-solid fa-chevron-right text-[10px] opacity-80"></i>
                </a>

                <a href="{{ route('admin.stores') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-store text-sm"></i><span>Toko Penjual</span></div>
                </a>

                <a href="{{ route('admin.customers') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-users text-sm"></i><span>Pelanggan</span></div>
                </a>

                <!-- Manajemen User -->
                <a href="{{ route('admin.users') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-user-shield text-sm"></i><span>Manajemen User</span></div>
                </a>

                <!-- Pengaturan Sistem -->
                <a href="{{ route('admin.settings') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-gear text-sm"></i><span>Pengaturan Sistem</span></div>
                </a>
            </nav>
        </div>

        <!-- Logout Button -->
        <div class="pt-4 border-t border-[#4E403C]">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-900/30 hover:bg-rose-900/60 border border-rose-800/40 text-rose-200 font-bold text-xs transition cursor-pointer shadow-xs">
                    <i class="fa-solid fa-right-from-bracket"></i><span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <header class="bg-white border-b border-[#EADFC7] px-8 py-3.5 sticky top-0 z-40 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold text-stone-400">Admin</span>
                <span class="text-xs text-stone-300">/</span>
                <h1 class="text-sm font-bold text-[#3A2E2B]">Katalog Produk</h1>
            </div>

            <!-- Form Search Bar -->
            <form action="{{ route('admin.products') }}" method="GET" class="relative">
                <input type="text" name="search" placeholder="Cari produk atau kategori..." value="{{ request('search') }}"
                       class="pl-9 pr-4 py-1.5 bg-[#F8F6F0] rounded-full text-xs border border-[#EADFC7] focus:outline-none focus:border-[#A38875] w-64 shadow-xs">
                <button type="submit" class="absolute left-3 top-2 text-stone-400 text-xs hover:text-[#3A2E2B]">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </header>

        <main class="flex-1 p-8 max-w-7xl mx-auto w-full space-y-6">
            <div class="flex items-center justify-between">
                <div>
                    <h2 class="text-2xl font-serif font-bold text-[#3A2E2B]">Katalog Produk System</h2>
                    <p class="text-xs text-stone-500 mt-0.5">Pantau seluruh produk pakaian dan promo diskon yang diunggah oleh toko penjual.</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-stone-100 text-xs uppercase text-stone-400 font-semibold">
                                <th class="pb-3 px-4">Gambar</th>
                                <th class="pb-3 px-4">Nama Produk</th>
                                <th class="pb-3 px-4">Kategori</th>
                                <th class="pb-3 px-4">Toko Penjual</th>
                                <th class="pb-3 px-4">Harga (Normal / Diskon)</th>
                                <th class="pb-3 px-4">Stok</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100 text-xs font-medium text-stone-700">
                            @forelse($products as $product)
                                <tr class="hover:bg-[#F8F6F0]/60 transition">
                                    <td class="py-3 px-4">
                                        <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded-xl border border-[#EADFC7] shadow-xs" alt="{{ $product->name }}">
                                    </td>
                                    <td class="py-3 px-4 font-bold text-[#3A2E2B]">
                                        {{ $product->name }}
                                        @if($product->discount_price && $product->discount_price < $product->price)
                                            @php
                                                $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                                            @endphp
                                            <span class="ml-2 bg-rose-100 text-rose-700 text-[9px] font-extrabold px-2 py-0.5 rounded-md uppercase">Disc {{ $discountPercent }}%</span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-4"><span class="bg-[#F8F6F0] text-stone-700 border border-[#EADFC7] px-2.5 py-1 rounded-full font-semibold">{{ $product->category }}</span></td>
                                    <td class="py-3 px-4 text-stone-500">{{ $product->store->store_name ?? 'Maison Store' }}</td>
                                    
                                    <!-- KOLOM HARGA DENGAN DUKUNGAN DISKON -->
                                    <td class="py-3 px-4">
                                        @if($product->discount_price && $product->discount_price < $product->price)
                                            <div class="flex flex-col">
                                                <span class="font-extrabold text-[#B86246]">Rp {{ number_format($product->discount_price, 0, ',', '.') }}</span>
                                                <span class="text-stone-400 text-[10px] line-through">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                            </div>
                                        @else
                                            <span class="font-extrabold text-[#3A2E2B]">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                        @endif
                                    </td>

                                    <td class="py-3 px-4">
                                        @if($product->stock > 0)
                                            <span class="bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-full font-bold">{{ $product->stock }} pcs</span>
                                        @else
                                            <span class="bg-rose-100 text-rose-800 px-2.5 py-1 rounded-full font-bold">Habis</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-stone-400">
                                        @if(request('search'))
                                            Tidak ditemukan produk dengan kata kunci "<span class="font-bold text-stone-600">{{ request('search') }}</span>".
                                        @else
                                            Belum ada produk yang terdaftar dalam sistem.
                                        @endif
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>

</body>
</html>