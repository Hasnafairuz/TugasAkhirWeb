<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pesanan — Admin Maison De Jenrina</title>
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
                <a href="{{ route('admin.orders') }}" class="flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#52423D] text-white font-bold shadow-sm transition">
                    <div class="flex items-center gap-3"><i class="fa-solid fa-bag-shopping text-sm text-[#D4BCAD]"></i><span>Pesanan (Orders)</span></div>
                    <i class="fa-solid fa-chevron-right text-[10px] opacity-70"></i>
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
                <h1 class="text-sm font-bold text-[#3A2E2B]">Manajemen Pesanan</h1>
            </div>

            <!-- Search Bar untuk Pesanan -->
            <form action="{{ route('admin.orders') }}" method="GET" class="relative">
                <input type="text" 
                       name="search" 
                       placeholder="Cari ID pesanan, pembeli..." 
                       value="{{ request('search') }}"
                       class="pl-9 pr-4 py-1.5 bg-[#F8F6F0] rounded-full text-xs border border-[#EADFC7] focus:outline-none focus:border-[#A38875] w-64 shadow-xs">
                <button type="submit" class="absolute left-3 top-2 text-stone-400 text-xs hover:text-[#3A2E2B]">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </header>

        <main class="flex-1 p-8 max-w-7xl mx-auto w-full space-y-6">
            <div>
                <h2 class="text-2xl font-serif font-bold text-[#3A2E2B]">Daftar Pesanan Masuk</h2>
                <p class="text-xs text-stone-500 mt-0.5">Kelola seluruh transaksi pembelian dari pelanggan platform.</p>
            </div>

            <div class="bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-xs">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-stone-100 text-xs uppercase text-stone-400 font-semibold">
                                <th class="pb-3 px-4">ID Transaksi</th>
                                <th class="pb-3 px-4">Nama Pembeli</th>
                                <th class="pb-3 px-4">Detail Produk</th>
                                <th class="pb-3 px-4">Metode Pembayaran</th>
                                <th class="pb-3 px-4">Total Harga</th>
                                <th class="pb-3 px-4 text-center">Status & Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100 text-xs font-medium text-stone-700">
                            @forelse($orders ?? [] as $order)
                                @php
                                    $buyerName = optional($order->user)->name ?? optional($order->customer)->name ?? 'Pelanggan';
                                @endphp
                                <tr class="hover:bg-[#F8F6F0]/50 transition">
                                    <!-- ID TRANSAKSI / INVOICE -->
                                    <td class="py-3.5 px-4 font-bold text-stone-700 align-top">
                                        {{ $order->invoice_number ?? '#ORD-' . $order->id }}
                                    </td>

                                    <!-- NAMA PEMBELI -->
                                    <td class="py-3.5 px-4 font-bold text-stone-800 align-top">
                                        {{ $buyerName }}
                                    </td>

                                    <!-- DETAIL PRODUK (Gambar, Nama, Warna, Size, Qty, Harga) -->
                                    <td class="py-3.5 px-4 align-top max-w-sm">
                                        <div class="space-y-2">
                                            @forelse($order->orderItems as $item)
                                                @php
                                                    $productImage = optional($item->product)->image ?? 'images/default.jpg';
                                                @endphp
                                                <div class="bg-[#F8F6F0] p-2.5 rounded-2xl border border-[#EADFC7]/70 flex items-center gap-3">
                                                    <!-- Gambar Produk -->
                                                    <img src="{{ asset('storage/' . $productImage) }}" alt="Produk" class="w-12 h-12 rounded-xl object-cover border border-[#EADFC7] shrink-0">
                                                    
                                                    <div class="flex-1 min-w-0">
                                                        <div class="font-bold text-[#3A2E2B] truncate">
                                                            {{ optional($item->product)->name ?? 'Produk Pakaian' }}
                                                        </div>
                                                        
                                                        <!-- Warna & Ukuran -->
                                                        <div class="flex items-center gap-2 text-[10px] text-stone-500 mt-0.5">
                                                            @if(!empty($item->color))
                                                                <span class="bg-white px-2 py-0.5 rounded-md border border-[#EADFC7]">Warna: <strong class="text-stone-700">{{ $item->color }}</strong></span>
                                                            @endif
                                                            @if(!empty($item->size))
                                                                <span class="bg-white px-2 py-0.5 rounded-md border border-[#EADFC7]">Size: <strong class="text-stone-700">{{ $item->size }}</strong></span>
                                                            @endif
                                                        </div>

                                                        <div class="text-[11px] text-stone-500 flex justify-between mt-1">
                                                            <span>Jumlah: <strong class="text-stone-700">{{ $item->quantity }}x</strong></span>
                                                            <span class="font-bold text-[#B86246]">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <!-- Cadangan jika orderItems kosong -->
                                                <div class="bg-[#F8F6F0] p-2.5 rounded-2xl border border-[#EADFC7]/70 flex items-center gap-3">
                                                    <img src="{{ asset('storage/' . (optional($order->product)->image ?? 'images/default.jpg')) }}" alt="Produk" class="w-12 h-12 rounded-xl object-cover border border-[#EADFC7] shrink-0">
                                                    <div class="flex-1 min-w-0">
                                                        <div class="font-bold text-[#3A2E2B] truncate">
                                                            {{ optional($order->product)->name ?? 'Produk Pakaian' }}
                                                        </div>
                                                        <div class="text-[11px] text-stone-500 mt-0.5">
                                                            Jumlah: <strong class="text-stone-700">{{ $order->quantity ?? 1 }}x</strong>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </div>
                                    </td>

                                    <!-- METODE PEMBAYARAN -->
                                    <td class="py-3.5 px-4 uppercase text-[11px] text-stone-500 font-semibold align-top">
                                        {{ str_replace('_', ' ', $order->payment_method ?? 'Bank Transfer') }}
                                    </td>

                                    <!-- TOTAL HARGA -->
                                    <td class="py-3.5 px-4 font-extrabold text-[#B86246] align-top">
                                        Rp {{ number_format($order->total_price ?? $order->total_amount ?? 0, 0, ',', '.') }}
                                    </td>
                                    
                                    <!-- STATUS & AKSI -->
                                    <td class="py-3.5 px-4 text-center align-top">
                                        <div class="flex flex-col items-center gap-2">
                                            <!-- Grid Tombol Status (2x2) -->
                                            <div class="grid grid-cols-2 gap-1.5 w-48">
                                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="w-full">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="Pending">
                                                    <button type="submit" class="w-full py-1.5 rounded-lg text-[10px] font-bold transition cursor-pointer {{ in_array($order->status, ['Pending', 'unpaid']) ? 'bg-rose-600 text-white shadow-xs ring-2 ring-rose-300' : 'bg-rose-50 text-rose-700 hover:bg-rose-100 border border-rose-200' }}">
                                                        Dibayar
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="w-full">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="paid">
                                                    <button type="submit" class="w-full py-1.5 rounded-lg text-[10px] font-bold transition cursor-pointer {{ $order->status == 'paid' ? 'bg-amber-600 text-white shadow-xs ring-2 ring-amber-300' : 'bg-amber-50 text-amber-700 hover:bg-amber-100 border border-amber-200' }}">
                                                        Dikirim
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="w-full">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="shipped">
                                                    <button type="submit" class="w-full py-1.5 rounded-lg text-[10px] font-bold transition cursor-pointer {{ $order->status == 'shipped' ? 'bg-blue-600 text-white shadow-xs ring-2 ring-blue-300' : 'bg-blue-50 text-blue-700 hover:bg-blue-100 border border-blue-200' }}">
                                                        Proses
                                                    </button>
                                                </form>

                                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="w-full">
                                                    @csrf @method('PUT')
                                                    <input type="hidden" name="status" value="completed">
                                                    <button type="submit" class="w-full py-1.5 rounded-lg text-[10px] font-bold transition cursor-pointer {{ $order->status == 'completed' ? 'bg-emerald-600 text-white shadow-xs ring-2 ring-emerald-300' : 'bg-emerald-50 text-emerald-700 hover:bg-emerald-100 border border-emerald-200' }}">
                                                        Selesai
                                                    </button>
                                                </form>
                                            </div>

                                            <!-- Tombol Hapus Pesanan -->
                                            <form action="{{ route('admin.orders.destroy', $order->id) }}" method="POST" class="w-48" onsubmit="return confirm('Apakah Anda yakin ingin menghapus pesanan {{ $order->invoice_number ?? '#ORD-' . $order->id }} ini?');">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="w-full py-1.5 rounded-lg text-[10px] font-bold bg-stone-100 hover:bg-rose-100 text-stone-600 hover:text-rose-700 border border-stone-200 hover:border-rose-300 transition flex items-center justify-center gap-1.5 cursor-pointer">
                                                    <i class="fa-solid fa-trash-can"></i> Hapus Pesanan
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="py-12 text-center text-stone-400">
                                        @if(request('search'))
                                            Tidak ditemukan pesanan dengan kata kunci "<span class="font-bold text-stone-600">{{ request('search') }}</span>".
                                        @else
                                            Belum ada pesanan masuk.
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