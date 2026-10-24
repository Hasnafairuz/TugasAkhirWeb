<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Toko — Maison De Jenrina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased min-h-screen flex">

    <!-- SIDEBAR KIRI -->
    <aside class="w-64 bg-[#3A2E2B] text-[#E8DFD8] flex flex-col justify-between p-5 min-h-screen sticky top-0 shadow-xl z-50">
        <div>
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
                        <a href="{{ route('seller.products.create') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-plus-circle text-sm"></i><span>Tambah Produk</span></div>
                        </a>
                        <a href="{{ route('seller.katalog') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-shirt text-sm"></i><span>Katalog Produk</span></div>
                        </a>
                        <a href="{{ route('seller.users') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-users text-sm"></i><span>Manajemen User</span></div>
                        </a>
                        <!-- Pengaturan Toko (Aktif) -->
                        <a href="{{ route('seller.settings') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#52423D] text-white font-bold shadow-sm transition">
                            <div class="flex items-center gap-3"><i class="fa-solid fa-gear text-sm text-[#D4BCAD]"></i><span>Pengaturan Toko</span></div>
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-70"></i>
                        </a>
                    </nav>
                </div>

                <!-- Bagian Toko & Halaman yang Ditambahkan -->
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

        <div class="pt-4 border-t border-[#4E403C]">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-900/30 hover:bg-rose-900/60 border border-rose-800/40 text-rose-200 font-bold text-xs transition cursor-pointer shadow-xs">
                    <i class="fa-solid fa-right-from-bracket"></i><span>Keluar dari Akun</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">
        <header class="bg-white border-b border-[#EADFC7] px-8 py-3.5 sticky top-0 z-40 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold text-stone-400">Seller</span>
                <span class="text-xs text-stone-300">/</span>
                <h1 class="text-sm font-bold text-[#3A2E2B]">Pengaturan Toko</h1>
            </div>
            <div class="flex items-center gap-2.5">
                <span class="text-xs font-bold text-[#3A2E2B]">{{ $user->name }}</span>
            </div>
        </header>

        <main class="p-8 max-w-4xl mx-auto w-full space-y-6">
            @if(session('success'))
                <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold rounded-2xl flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-[#EADFC7] p-8 shadow-xs">
                <h3 class="text-lg font-serif font-bold text-[#3A2E2B] mb-2 pb-3 border-b border-stone-100 flex items-center gap-2">
                    <i class="fa-solid fa-gear text-[#A38875]"></i> Konfigurasi Profil & Toko
                </h3>
                <p class="text-xs text-stone-500 mb-6">Perbarui informasi akun dan identitas toko Anda.</p>

                <form action="{{ route('seller.settings.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="text-xs font-bold text-stone-600 block mb-1">Nama Pemilik / Akun</label>
                        <input type="text" name="name" value="{{ $user->name }}" required
                               class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]">
                    </div>

                    <div>
                        <label class="text-xs font-bold text-stone-600 block mb-1">Alamat Email</label>
                        <input type="email" name="email" value="{{ $user->email }}" required
                               class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]">
                    </div>

                    <div class="pt-4">
                        <button type="submit" class="px-6 py-3 bg-[#52423D] hover:bg-[#3A2E2B] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition cursor-pointer">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>