<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ulasan Produk — Admin Maison De Jenrina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700&family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased min-h-screen flex">

    <!-- SIDEBAR ADMIN -->
    <aside class="w-64 bg-[#3A2E2B] text-[#E8DFD8] flex flex-col justify-between p-5 min-h-screen sticky top-0 shadow-xl z-50">
        <div>
            <div class="flex items-center gap-3.5 pb-6 border-b border-[#4E403C] mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-cover rounded-full border-2 border-[#A38875] p-0.5 bg-white shadow-sm">
                <div>
                    <h2 class="font-serif font-bold text-xs text-white tracking-wide leading-tight">MAISON DE JENRINA</h2>
                    <span class="text-[9px] text-[#C4B2A5] uppercase tracking-widest font-semibold block mt-0.5">Admin Management</span>
                </div>
            </div>

            <nav class="space-y-1.5 text-xs font-medium">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-chart-pie text-sm"></i><span>Dashboard</span></div>
                </a>
                <a href="{{ route('admin.orders') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-bag-shopping text-sm"></i><span>Pesanan (Orders)</span></div>
                </a>
                <a href="{{ route('admin.products') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-shirt text-sm"></i><span>Katalog Produk</span></div>
                </a>
                <a href="{{ route('admin.stores') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-store text-sm"></i><span>Toko Penjual</span></div>
                </a>
                <a href="{{ route('admin.customers') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-users text-sm"></i><span>Pelanggan</span></div>
                </a>
                <a href="{{ route('admin.reviews.index') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#52423D] text-white font-bold shadow-sm transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-star text-sm text-amber-400"></i><span>Ulasan Produk</span></div>
                    <i class="fa-solid fa-chevron-right text-[10px] opacity-70"></i>
                </a>
                <a href="{{ route('admin.users') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-user-shield text-sm"></i><span>Manajemen User</span></div>
                </a>
                <a href="{{ route('admin.settings') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-gear text-sm"></i><span>Pengaturan Sistem</span></div>
                </a>
            </nav>
        </div>

        <div class="pt-4 border-t border-[#4E403C]">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center justify-center gap-2 px-4 py-2.5 rounded-xl bg-rose-900/30 hover:bg-rose-900/60 border border-rose-800/40 text-rose-200 font-bold text-xs transition cursor-pointer">
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
                <h1 class="text-sm font-bold text-[#3A2E2B]">Ulasan Produk</h1>
            </div>
        </header>

        <main class="flex-1 p-8 max-w-7xl mx-auto w-full space-y-6">
            <div>
                <h2 class="text-2xl font-serif font-bold text-[#3A2E2B]">Daftar Ulasan & Rating Pelanggan</h2>
                <p class="text-xs text-stone-500 mt-0.5">Pantau tanggapan dan masukan pembeli terhadap produk platform.</p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-stone-100 text-xs uppercase text-stone-400 font-semibold">
                                <th class="pb-3 px-4">Nama Pelanggan</th>
                                <th class="pb-3 px-4">Produk</th>
                                <th class="pb-3 px-4">Rating</th>
                                <th class="pb-3 px-4">Komentar Ulasan</th>
                                <th class="pb-3 px-4">Tanggal</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100 text-xs font-medium text-stone-700">
                            @forelse($reviews ?? [] as $review)
                                @php
                                    $productImage = optional($review->product)->image ? asset('storage/' . $review->product->image) : 'https://images.unsplash.com/photo-1515886657613-9f3515b0c78f?w=300';
                                @endphp
                                <tr class="hover:bg-[#F8F6F0]/50 transition">
                                    <!-- NAMA PELANGGAN -->
                                    <td class="py-3.5 px-4 font-bold text-stone-800">
                                        {{ optional($review->user)->name ?? 'Pelanggan' }}
                                    </td>

                                    <!-- PRODUK (DENGAN GAMBAR PRODUK) -->
                                    <td class="py-3.5 px-4 font-semibold text-[#3A2E2B]">
                                        <div class="flex items-center gap-3">
                                            <img src="{{ $productImage }}" alt="Foto Produk" class="w-12 h-12 rounded-xl object-cover border border-[#EADFC7] shrink-0">
                                            <span class="line-clamp-2 max-w-xs">{{ optional($review->product)->name ?? 'Produk Fashion' }}</span>
                                        </div>
                                    </td>

                                    <!-- RATING -->
                                    <td class="py-3.5 px-4 whitespace-nowrap">
                                        <div class="flex items-center text-amber-400 gap-1 text-sm font-bold">
                                            @for($i = 1; $i <= 5; $i++)
                                                @if($i <= ($review->rating ?? 5))
                                                    ★
                                                @else
                                                    <span class="text-stone-200">★</span>
                                                @endif
                                            @endfor
                                            <span class="text-xs text-stone-600 font-bold ml-1">({{ $review->rating ?? 5 }}/5)</span>
                                        </div>
                                    </td>

                                    <!-- KOMENTAR -->
                                    <td class="py-3.5 px-4 text-stone-600 max-w-xs">
                                        {{ $review->comment ?? 'Tidak ada komentar.' }}
                                    </td>

                                    <!-- TANGGAL -->
                                    <td class="py-3.5 px-4 text-stone-400 text-[11px] whitespace-nowrap">
                                        {{ $review->created_at ? $review->created_at->format('d M Y, H:i') : '-' }}
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-12 text-center text-stone-400">
                                        Belum ada ulasan produk yang dikirimkan oleh pelanggan.
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