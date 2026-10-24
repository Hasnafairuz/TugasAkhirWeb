<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Produk — Maison De Jenrina</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
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

            <div class="space-y-6">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#A38875] px-3 block mb-2">Navigasi Utama</span>
                    <nav class="space-y-1.5 text-xs font-medium">
                        <a href="{{ route('seller.dashboard') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-chart-line text-sm"></i><span>Dashboard</span></div>
                        </a>
                        <!-- Tambah Produk (Aktif) -->
                        <a href="{{ route('seller.products.create') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#52423D] text-white font-bold shadow-sm transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-plus-circle text-sm text-[#D4BCAD]"></i><span>Tambah Produk</span></div>
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-70"></i>
                        </a>
                        <a href="{{ route('seller.katalog') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-shirt text-sm"></i><span>Katalog Produk</span></div>
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
                <h1 class="text-sm font-bold text-[#3A2E2B]">Tambah Produk Baru</h1>
            </div>
            <div class="flex items-center gap-3">
                <div class="w-8 h-8 rounded-full overflow-hidden border border-[#D5C1B2] bg-stone-100 shrink-0">
                    <img src="{{ asset('images/profile.png') }}" alt="Profil" class="w-full h-full object-cover">
                </div>
                <span class="text-xs font-bold text-[#3A2E2B]">{{ auth()->user()->name ?? 'Jenrina' }}</span>
            </div>
        </header>

        <main class="p-8 max-w-3xl mx-auto w-full">
            <div class="bg-white rounded-3xl border border-[#EADFC7] p-8 shadow-xs">
                <h3 class="text-lg font-serif font-bold text-[#3A2E2B] mb-1 flex items-center gap-2.5 pb-3 border-b border-stone-100">
                    <i class="fa-solid fa-plus-circle text-[#A38875]"></i>
                    <span>Formulir Tambah Produk Pakaian Baru</span>
                </h3>
                <p class="text-xs text-stone-500 mb-6">Lengkapi informasi produk pakaian yang akan dipasarkan di toko.</p>

                <!-- ========================================== -->
                <!-- PENAMPIL PESAN ERROR VALIDASI (DITAMBAHKAN DI SINI) -->
                <!-- ========================================== -->
                @if ($errors->any())
                    <div class="mb-6 p-4 bg-rose-50 border border-rose-200 text-rose-700 text-xs rounded-2xl space-y-1">
                        <p class="font-bold"><i class="fa-solid fa-triangle-exclamation mr-1"></i> Gagal Menyimpan Produk:</p>
                        <ul class="list-disc pl-4 space-y-0.5">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5">
                    @csrf
                    
                    <!-- Nama Produk -->
                    <div>
                        <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Nama Produk</label>
                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Contoh: Cardigan Knit Oversized" required
                               class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]">
                    </div>

                    <!-- Kategori Pakaian -->
                    <div>
                        <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Kategori Pakaian</label>
                        <select name="category" required class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]">
                            <option value="">Pilih Kategori</option>
                            <option value="Korean Style" {{ old('category') == 'Korean Style' ? 'selected' : '' }}>Korean Style</option>
                            <option value="Knitwear" {{ old('category') == 'Knitwear' ? 'selected' : '' }}>Knitwear</option>
                            <option value="Loungewear" {{ old('category') == 'Loungewear' ? 'selected' : '' }}>Loungewear</option>
                            <option value="Teen Fashion" {{ old('category') == 'Teen Fashion' ? 'selected' : '' }}>Teen Fashion</option>
                        </select>
                    </div>

                    <!-- Harga Normal & Harga Diskon -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Harga Normal (Rp)</label>
                            <input type="number" name="price" value="{{ old('price') }}" required 
                                   class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]" placeholder="Contoh: 89000">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Harga Diskon / Promo (Opsional)</label>
                            <input type="number" name="discount_price" value="{{ old('discount_price') }}" 
                                   class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]" placeholder="Kosongkan jika tidak ada">
                        </div>
                    </div>

                    <!-- Pilihan Warna & Ukuran -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Pilihan Warna</label>
                            <input type="text" name="colors" value="{{ old('colors') }}" 
                                   class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]" placeholder="Mocca, Black, Navy">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Pilihan Ukuran / Size</label>
                            <input type="text" name="size" value="{{ old('size') }}" 
                                   class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]" placeholder="Contoh: M, L, XL, XXL">
                        </div>
                    </div>

                    <!-- Stok Produk -->
                    <div>
                        <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Stok Produk</label>
                        <input type="number" name="stock" value="{{ old('stock') }}" placeholder="Contoh: 20" required
                               class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]">
                    </div>

                    <!-- Foto Produk -->
                    <div>
                        <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Foto Produk (Bisa pilih lebih dari 1)</label>
                        <input type="file" name="images[]" multiple accept="image/*" required 
                               class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 text-stone-600">
                    </div>

                    <!-- Deskripsi Pakaian -->
                    <div>
                        <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Deskripsi Pakaian</label>
                        <textarea name="description" rows="4" placeholder="Tuliskan deskripsi lengkap bahan, ukuran, dan keunggulan..." required
                                  class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]">{{ old('description') }}</textarea>
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="pt-4 border-t border-stone-100 flex items-center justify-end gap-3">
                        <a href="{{ route('seller.dashboard') }}" class="px-5 py-3 rounded-xl bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-bold transition">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-3 bg-[#52423D] hover:bg-[#3A2E2B] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition flex items-center justify-center gap-2 cursor-pointer">
                            <i class="fa-solid fa-check"></i> Simpan Produk
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

</body>
</html>