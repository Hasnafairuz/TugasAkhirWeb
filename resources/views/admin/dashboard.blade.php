<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin — Maison De Jenrina</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- FontAwesome Icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Chart.js CDN -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased min-h-screen flex">

    <!-- 1. SIDEBAR KIRI ADMIN -->
    <aside class="w-64 bg-[#3A2E2B] text-[#E8DFD8] flex flex-col justify-between p-5 min-h-screen sticky top-0 shadow-xl z-50">
        <div>
            <!-- Brand Header dengan Logo -->
            <div class="flex items-center gap-3.5 pb-6 border-b border-[#4E403C] mb-6">
                <img src="{{ asset('images/logo.png') }}" 
                     alt="Logo Maison De Jenrina" 
                     class="w-10 h-10 object-cover rounded-full border-2 border-[#A38875] p-0.5 bg-white shadow-sm">
                <div>
                    <h2 class="font-serif font-bold text-sm text-white tracking-wide leading-tight">MAISON DE JENRINA</h2>
                    <span class="text-[9px] text-[#C4B2A5] uppercase tracking-widest font-semibold block mt-0.5">Admin Management</span>
                </div>
            </div>

            <!-- Group Navigasi Utama Admin -->
            <div class="space-y-6">
                <div>
                    <span class="text-[10px] font-bold uppercase tracking-widest text-[#A38875] px-3 block mb-2">Navigasi Utama</span>
                    <nav class="space-y-1.5">
                        <!-- Dashboard -->
                        <a href="{{ route('admin.dashboard') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl bg-[#52423D] text-white font-bold text-xs shadow-sm transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-chart-pie text-sm text-[#D4BCAD]"></i>
                                <span>Dashboard</span>
                            </div>
                            <i class="fa-solid fa-chevron-right text-[10px] opacity-70"></i>
                        </a>

                        <!-- Pesanan (Orders) -->
                        <a href="{{ route('admin.orders') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white font-medium text-xs transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-bag-shopping text-sm"></i>
                                <span>Pesanan (Orders)</span>
                            </div>
                        </a>

                        <!-- Katalog Produk -->
                        <a href="{{ route('admin.products') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white font-medium text-xs transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-shirt text-sm"></i>
                                <span>Katalog Produk</span>
                            </div>
                        </a>

                        <!-- Toko Penjual -->
                        <a href="{{ route('admin.stores') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white font-medium text-xs transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-store text-sm"></i>
                                <span>Toko Penjual</span>
                            </div>
                        </a>

                        <!-- Pelanggan -->
                        <a href="{{ route('admin.customers') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white font-medium text-xs transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-users text-sm"></i>
                                <span>Pelanggan</span>
                            </div>
                        </a>

                        <!-- Ulasan Produk -->
                        <a href="{{ route('admin.reviews.index') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white font-medium text-xs transition {{ request()->routeIs('admin.reviews.index') ? 'bg-[#52423D] text-white font-bold' : '' }}">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-star text-sm text-amber-400"></i>
                                <span>Ulasan Produk</span>
                            </div>
                        </a>

                        <!-- Menu Manajemen User -->
                        <a href="{{ route('admin.users') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white font-medium text-xs transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-user-shield text-sm"></i>
                                <span>Manajemen User</span>
                            </div>
                        </a>

                        <!-- Menu Pengaturan Sistem -->
                        <a href="{{ route('admin.settings') }}" class="w-full flex items-center justify-between px-3.5 py-2.5 rounded-xl text-[#D4BCAD] hover:bg-[#4E403C] hover:text-white font-medium text-xs transition">
                            <div class="flex items-center gap-3">
                                <i class="fa-solid fa-gear text-sm"></i>
                                <span>Pengaturan Sistem</span>
                            </div>
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
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- 2. KONTEN UTAMA DASHBOARD -->
    <div class="flex-1 flex flex-col min-w-0 overflow-y-auto">

        <!-- Top Header dengan State AlpineJS x-data -->
        <header class="bg-white border-b border-[#EADFC7] px-8 py-3.5 sticky top-0 z-40 flex items-center justify-between shadow-xs" x-data="{ openChat: false, openNotif: false }">
            <div>
                <h2 class="text-xl font-serif font-bold text-[#3A2E2B]">Overview Dashboard</h2>
                <p class="text-[11px] text-stone-500">Selamat datang kembali, Administrator!</p>
            </div>
            
            <div class="flex items-center gap-4">
                <!-- Search Bar -->
                <form action="{{ route('admin.products') }}" method="GET" class="relative hidden sm:block">
                    <input type="text" 
                           name="search" 
                           placeholder="Cari pesanan, produk..." 
                           value="{{ request('search') }}"
                           class="pl-9 pr-4 py-1.5 bg-[#F8F6F0] rounded-full text-xs border border-[#EADFC7] focus:outline-none focus:border-[#A38875] w-60 shadow-xs">
                    <button type="submit" class="absolute left-3 top-2 text-stone-400 text-xs hover:text-[#3A2E2B]">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </form>

                <div class="h-4 w-px bg-stone-200 hidden sm:block"></div>

                <!-- 1. DROPDOWN CHAT PELANGGAN -->
                <div class="relative">
                    <button @click="openChat = !openChat; openNotif = false" 
                            class="w-10 h-10 rounded-full bg-[#F8F6F0] border border-[#EADFC7] flex items-center justify-center text-stone-600 hover:text-[#3A2E2B] transition relative cursor-pointer">
                        <i class="fa-solid fa-comments text-sm"></i>
                        @if(isset($chats) && $chats->count() > 0)
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-amber-600 text-white font-bold text-[9px] rounded-full flex items-center justify-center border-2 border-white">
                                {{ $chats->count() }}
                            </span>
                        @endif
                    </button>

                    <!-- KOTAK DROPDOWN CHAT -->
                    <div x-show="openChat" 
                         @click.away="openChat = false" 
                         x-transition 
                         class="absolute right-0 mt-2 w-80 bg-white rounded-3xl border border-[#EADFC7] shadow-xl p-4 z-50 text-left space-y-3" 
                         style="display: none;">
                        
                        <div class="flex items-center justify-between border-b border-stone-100 pb-2">
                            <h4 class="font-bold text-xs text-[#3A2E2B] flex items-center gap-1.5">
                                <i class="fa-solid fa-comments text-amber-700"></i> Pesan Pertanyaan Produk
                            </h4>
                            <span class="text-[10px] text-stone-400 font-semibold">{{ isset($chats) ? $chats->count() : 0 }} Pesan</span>
                        </div>

                        <div class="space-y-2 max-h-64 overflow-y-auto">
                            @forelse($chats ?? [] as $chat)
                                <div class="p-2.5 bg-[#F8F6F0] rounded-2xl border border-[#EADFC7]/50 hover:bg-[#EADFC7]/30 transition">
                                    <div class="flex items-center justify-between text-[10px] font-bold text-stone-700 mb-0.5">
                                        <span>{{ optional($chat->user)->name ?? 'Pelanggan' }}</span>
                                        <span class="text-stone-400 font-normal">{{ $chat->created_at ? $chat->created_at->diffForHumans() : 'Baru' }}</span>
                                    </div>
                                    <p class="text-xs font-semibold text-[#3A2E2B] line-clamp-1">
                                        {{ optional($chat->product)->name ? '['.optional($chat->product)->name.']' : '' }}
                                    </p>
                                    <p class="text-[11px] text-stone-500 line-clamp-2 mt-0.5">
                                        {{ $chat->message ?? $chat->pesan ?? 'Mengirim pesan pertanyaan.' }}
                                    </p>
                                </div>
                            @empty
                                <div class="py-6 text-center text-stone-400 space-y-1">
                                    <i class="fa-solid fa-comment-slash text-2xl text-stone-300"></i>
                                    <p class="text-xs font-medium">Belum ada pesan dari customer.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- 2. DROPDOWN LONCENG NOTIFIKASI -->
                <div class="relative">
                    <button @click="openNotif = !openNotif; openChat = false" 
                            class="w-10 h-10 rounded-full bg-[#F8F6F0] border border-[#EADFC7] flex items-center justify-center text-stone-600 hover:text-[#3A2E2B] transition relative cursor-pointer">
                        <i class="fa-solid fa-bell text-sm"></i>
                        @if(isset($notifications) && $notifications->count() > 0)
                            <span class="absolute -top-1 -right-1 w-4 h-4 bg-rose-600 text-white font-bold text-[9px] rounded-full flex items-center justify-center border-2 border-white animate-pulse">
                                {{ $notifications->count() }}
                            </span>
                        @endif
                    </button>

                    <!-- KOTAK DROPDOWN NOTIFIKASI -->
                    <div x-show="openNotif" 
                         @click.away="openNotif = false" 
                         x-transition 
                         class="absolute right-0 mt-2 w-80 bg-white rounded-3xl border border-[#EADFC7] shadow-xl p-4 z-50 text-left space-y-3" 
                         style="display: none;">
                        
                        <div class="flex items-center justify-between border-b border-stone-100 pb-2">
                            <h4 class="font-bold text-xs text-[#3A2E2B] flex items-center gap-1.5">
                                <i class="fa-solid fa-bell text-rose-600"></i> Notifikasi Pesanan Masuk
                            </h4>
                            <a href="{{ route('admin.orders') }}" class="text-[10px] text-amber-700 font-bold hover:underline">Lihat Semua</a>
                        </div>

                        <div class="space-y-2 max-h-64 overflow-y-auto">
                            @forelse($notifications ?? [] as $notif)
                                <a href="{{ route('admin.orders') }}" class="block p-2.5 bg-[#F8F6F0] rounded-2xl border border-[#EADFC7]/50 hover:bg-[#EADFC7]/30 transition">
                                    <div class="flex items-center justify-between text-[10px] font-bold text-stone-700 mb-0.5">
                                        <span>Pesanan Baru {{ $notif->invoice_number ?? '#ORD-'.$notif->id }}</span>
                                        <span class="text-stone-400 font-normal">{{ $notif->created_at ? $notif->created_at->diffForHumans() : 'Baru' }}</span>
                                    </div>
                                    <p class="text-xs text-stone-600">
                                        Pembeli: <strong class="text-[#3A2E2B]">{{ optional($notif->user)->name ?? 'Pelanggan' }}</strong>
                                    </p>
                                    <p class="text-[11px] font-extrabold text-[#B86246] mt-0.5">
                                        Total: Rp {{ number_format($notif->total_price ?? $notif->total_amount ?? 0, 0, ',', '.') }}
                                    </p>
                                </a>
                            @empty
                                <div class="py-6 text-center text-stone-400 space-y-1">
                                    <i class="fa-solid fa-bell-slash text-2xl text-stone-300"></i>
                                    <p class="text-xs font-medium">Belum ada notifikasi pesanan baru.</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <div class="h-4 w-px bg-stone-200"></div>

                <!-- Profil Admin -->
                <div class="flex items-center gap-2.5">
                    <div class="w-8 h-8 rounded-full bg-[#EADFC7] flex items-center justify-center text-[#3A2E2B] font-bold text-xs shadow-xs">
                        {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                    </div>
                    <span class="text-xs font-bold text-[#3A2E2B] hidden md:inline">{{ auth()->user()->name ?? 'Administrator' }}</span>
                </div>
            </div>
        </header>

        <main class="p-8 space-y-8 max-w-6xl mx-auto w-full">

            <!-- Banner Welcome Panel + Tombol Unduh Laporan PDF & Excel -->
            <div class="bg-white rounded-3xl border border-[#EADFC7] p-6 shadow-xs flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
                <div>
                    <span class="text-[10px] font-bold text-[#A38875] bg-[#F8F6F0] px-3 py-1 rounded-full border border-[#EADFC7] uppercase tracking-wider">Admin Control Center</span>
                    <h2 class="text-2xl font-serif font-bold text-[#3A2E2B] mt-2">Ringkasan Sistem E-Commerce</h2>
                    <p class="text-xs text-stone-500 mt-1">Pantau seluruh metrik, toko, pesanan, dan pendapatan platform secara real-time.</p>
                </div>
                
                <!-- TOMBOL EKSPOR LAPORAN -->
                <div class="flex flex-wrap items-center gap-2 w-full md:w-auto">
                    <a href="{{ route('admin.reports.pdf') }}" class="px-4 py-2.5 bg-[#B86246] hover:bg-[#A05137] text-white text-xs font-bold rounded-xl transition flex items-center gap-2 shadow-xs">
                        <i class="fa-solid fa-file-pdf"></i>
                        <span>Unduh Laporan PDF</span>
                    </a>
                    <a href="{{ route('admin.reports.excel') }}" class="px-4 py-2.5 bg-emerald-700 hover:bg-emerald-800 text-white text-xs font-bold rounded-xl transition flex items-center gap-2 shadow-xs">
                        <i class="fa-solid fa-file-excel"></i>
                        <span>Unduh Excel (CSV)</span>
                    </a>
                </div>
            </div>

            <!-- 4 Card Statistik Utama Platform -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                <div class="bg-gradient-to-br from-[#EFE3D3] to-[#E2D2BC] p-5 rounded-2xl border border-[#D8C7AF] shadow-xs">
                    <span class="text-xs font-semibold uppercase text-[#6B5A58]">Total Penjualan</span>
                    <div class="text-2xl font-extrabold text-[#4A3E3D] my-2 tracking-tight">Rp {{ number_format($totalRevenue ?? 0, 0, ',', '.') }}</div>
                    <span class="text-[11px] font-bold text-emerald-700 bg-emerald-100 px-2 py-0.5 rounded-md"><i class="fa-solid fa-circle-check"></i> Real-time</span>
                </div>

                <div class="bg-gradient-to-br from-[#E2ECE9] to-[#C9DDD8] p-5 rounded-2xl border border-[#B2CDC7] shadow-xs">
                    <span class="text-xs font-semibold uppercase text-teal-800">Total Pesanan</span>
                    <div class="text-2xl font-extrabold text-teal-900 my-2 tracking-tight">{{ $totalOrders ?? 0 }} Orders</div>
                    <span class="text-[11px] font-bold text-teal-800 bg-teal-100 px-2 py-0.5 rounded-md"><i class="fa-solid fa-boxes-stacked"></i> Masuk</span>
                </div>

                <div class="bg-gradient-to-br from-[#FCECE8] to-[#F7D8D0] p-5 rounded-2xl border border-[#EFC3B7] shadow-xs">
                    <span class="text-xs font-semibold uppercase text-rose-800">Total Produk</span>
                    <div class="text-2xl font-extrabold text-rose-900 my-2 tracking-tight">{{ $totalProducts ?? 0 }} Produk</div>
                    <span class="text-[11px] font-medium text-rose-700">{{ $totalStores ?? 1 }} Toko Aktif</span>
                </div>

                <div class="bg-gradient-to-br from-[#EAE8F5] to-[#D5D0E8] p-5 rounded-2xl border border-[#BFB8DC] shadow-xs">
                    <span class="text-xs font-semibold uppercase text-indigo-800">Pelanggan</span>
                    <div class="text-2xl font-extrabold text-indigo-900 my-2 tracking-tight">{{ $totalCustomers ?? 0 }} Pelanggan</div>
                    <span class="text-[11px] font-medium text-stone-600">(Total User: {{ $totalUsers ?? 0 }})</span>
                </div>
            </div>

            <!-- STATUS PESANAN CEPAK -->
            @php
                $countUnpaid    = \App\Models\Order::where('status', 'unpaid')->count();
                $countPaid      = \App\Models\Order::whereIn('status', ['paid', 'processing'])->count();
                $countShipped   = \App\Models\Order::where('status', 'shipped')->count();
                $countCompleted = \App\Models\Order::where('status', 'completed')->count();
            @endphp
            <div>
                <h3 class="font-serif font-bold text-lg text-[#3A2E2B] mb-3">Status Pemrosesan Pesanan</h3>
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                    <div class="bg-white p-4 rounded-2xl border border-[#EADFC7] shadow-xs flex items-center justify-between">
                        <div>
                            <p class="text-[11px] text-stone-500 font-bold uppercase">Perlu Dibayar</p>
                            <h4 class="text-lg font-extrabold text-rose-600 mt-1">{{ $countUnpaid }}</h4>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-rose-50 text-rose-600 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-credit-card"></i>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl border border-[#EADFC7] shadow-xs flex items-center justify-between">
                        <div>
                            <p class="text-[11px] text-stone-500 font-bold uppercase">Perlu Dikirim</p>
                            <h4 class="text-lg font-extrabold text-amber-600 mt-1">{{ $countPaid }}</h4>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-amber-50 text-amber-600 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-box-archive"></i>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl border border-[#EADFC7] shadow-xs flex items-center justify-between">
                        <div>
                            <p class="text-[11px] text-stone-500 font-bold uppercase">Dalam Pengiriman</p>
                            <h4 class="text-lg font-extrabold text-blue-600 mt-1">{{ $countShipped }}</h4>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-blue-50 text-blue-600 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-truck-fast"></i>
                        </div>
                    </div>

                    <div class="bg-white p-4 rounded-2xl border border-[#EADFC7] shadow-xs flex items-center justify-between">
                        <div>
                            <p class="text-[11px] text-stone-500 font-bold uppercase">Selesai</p>
                            <h4 class="text-lg font-extrabold text-emerald-600 mt-1">{{ $countCompleted }}</h4>
                        </div>
                        <div class="w-10 h-10 rounded-xl bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold">
                            <i class="fa-solid fa-circle-check"></i>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GRAFIK & DIAGRAM -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                <!-- Grafik Pendapatan Penjualan -->
                <div class="lg:col-span-2 bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-xs">
                    <div class="flex items-center justify-between mb-4">
                        <div>
                            <h3 class="font-serif font-bold text-lg text-[#3A2E2B]">Grafik Pendapatan Penjualan</h3>
                            <p class="text-xs text-stone-400">Total akumulasi pendapatan transaksi masuk (Rupiah)</p>
                        </div>
                        <span class="text-xs bg-[#F8F6F0] px-3 py-1 rounded-lg font-semibold border border-[#EADFC7]">Real-time</span>
                    </div>
                    <div class="h-64">
                        <canvas id="revenueChart"></canvas>
                    </div>
                </div>

                <!-- Ringkasan Rating & Kepuasan Pelanggan -->
                <div class="bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-xs flex flex-col justify-between">
                    <div>
                        <div class="flex items-center justify-between mb-1">
                            <h3 class="font-serif font-bold text-lg text-[#3A2E2B]">Kepuasan Pelanggan</h3>
                            <a href="{{ route('admin.reviews.index') }}" class="text-[11px] font-bold text-[#A38875] hover:underline">Lihat Ulasan &rarr;</a>
                        </div>
                        <p class="text-xs text-stone-400 mb-4">Distribusi rating bintang dari ulasan pembeli</p>
                        
                        <div class="h-44 relative flex items-center justify-center">
                            <canvas id="ratingChart"></canvas>
                        </div>
                    </div>
                    
                    <div class="grid grid-cols-2 gap-2 mt-4 text-[11px] font-medium">
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-emerald-500"></span> Bintang 5</div>
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-blue-500"></span> Bintang 4</div>
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-amber-500"></span> Bintang 3</div>
                        <div class="flex items-center gap-2"><span class="w-2.5 h-2.5 rounded-full bg-rose-500"></span> Bintang 1-2</div>
                    </div>
                </div>
            </div>

            <!-- Grafik Top 5 Produk Terlaris -->
            <div class="bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <div>
                        <h3 class="font-serif font-bold text-lg text-[#3A2E2B]">Top Produk Paling Diminati</h3>
                        <p class="text-xs text-stone-400">Peringkat produk berdasarkan total item dipesan</p>
                    </div>
                    <span class="text-xs font-bold text-[#A38875] bg-[#F8F6F0] px-3 py-1 rounded-lg border border-[#EADFC7]">Terlaris</span>
                </div>
                <div class="h-56">
                    <canvas id="topProductsChart"></canvas>
                </div>
            </div>

            <!-- Tabel Transaksi Terbaru -->
            <div class="bg-white p-6 rounded-3xl border border-[#EADFC7] shadow-xs">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="font-serif font-bold text-lg text-[#3A2E2B]">Transaksi Terakhir</h3>
                    <a href="{{ route('admin.orders') }}" class="text-xs font-bold text-[#A38875] hover:underline">Lihat Semua Pesanan &rarr;</a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="border-b border-stone-100 text-xs uppercase text-stone-400 font-semibold">
                                <th class="pb-3">ID Pesanan</th>
                                <th class="pb-3">Produk Pakaian</th>
                                <th class="pb-3">Metode Bayar</th>
                                <th class="pb-3">Total Harga</th>
                                <th class="pb-3">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-stone-100 text-xs font-medium">
                            @forelse($recentOrders ?? [] as $order)
                                <tr>
                                    <td class="py-3 font-bold text-stone-700">#ORD-{{ $order->id }}</td>
                                    <td class="py-3 font-semibold text-[#3A2E2B]">{{ $order->product->name ?? 'Produk Pakaian' }}</td>
                                    <td class="py-3 text-stone-500">{{ $order->payment_method ?? 'Bank Transfer' }}</td>
                                    <td class="py-3 font-extrabold text-stone-800">Rp {{ number_format($order->total_price ?? 0, 0, ',', '.') }}</td>
                                    <td class="py-3">
                                        @if(($order->status ?? '') === 'completed')
                                            <span class="bg-emerald-100 text-emerald-800 px-2.5 py-1 rounded-full font-bold">Selesai</span>
                                        @elseif(($order->status ?? '') === 'shipped')
                                            <span class="bg-blue-100 text-blue-800 px-2.5 py-1 rounded-full font-bold">Pengiriman</span>
                                        @elseif(($order->status ?? '') === 'paid')
                                            <span class="bg-amber-100 text-amber-800 px-2.5 py-1 rounded-full font-bold">Perlu Dikirim</span>
                                        @else
                                            <span class="bg-stone-100 text-stone-700 px-2.5 py-1 rounded-full font-bold">{{ ucfirst($order->status ?? 'Lunas') }}</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="py-8 text-center text-stone-400">Belum ada transaksi pembelian yang masuk.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>

<script>
    @php
        $revenueData = [
            'Senin'  => \App\Models\Order::whereRaw("DAYNAME(created_at) = 'Monday'")->sum('total_price'),
            'Selasa' => \App\Models\Order::whereRaw("DAYNAME(created_at) = 'Tuesday'")->sum('total_price'),
            'Rabu'   => \App\Models\Order::whereRaw("DAYNAME(created_at) = 'Wednesday'")->sum('total_price'),
            'Kamis'  => \App\Models\Order::whereRaw("DAYNAME(created_at) = 'Thursday'")->sum('total_price'),
            'Jumat'  => \App\Models\Order::whereRaw("DAYNAME(created_at) = 'Friday'")->sum('total_price'),
            'Sabtu'  => \App\Models\Order::whereRaw("DAYNAME(created_at) = 'Saturday'")->sum('total_price'),
            'Minggu' => \App\Models\Order::whereRaw("DAYNAME(created_at) = 'Sunday'")->sum('total_price'),
        ];

        $star5   = class_exists('\App\Models\Review') ? \App\Models\Review::where('rating', 5)->count() : 0;
        $star4   = class_exists('\App\Models\Review') ? \App\Models\Review::where('rating', 4)->count() : 0;
        $star3   = class_exists('\App\Models\Review') ? \App\Models\Review::where('rating', 3)->count() : 0;
        $starLow = class_exists('\App\Models\Review') ? \App\Models\Review::whereIn('rating', [1, 2])->count() : 0;
        
        $totalReviews = $star5 + $star4 + $star3 + $starLow;
    @endphp

    const ctxRevenue = document.getElementById('revenueChart').getContext('2d');
    new Chart(ctxRevenue, {
        type: 'line',
        data: {
            labels: ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu', 'Minggu'],
            datasets: [{
                label: 'Pendapatan (Rp)',
                data: [
                    {{ $revenueData['Senin'] ?? 0 }},
                    {{ $revenueData['Selasa'] ?? 0 }},
                    {{ $revenueData['Rabu'] ?? 0 }},
                    {{ $revenueData['Kamis'] ?? 0 }},
                    {{ $revenueData['Jumat'] ?? 0 }},
                    {{ $revenueData['Sabtu'] ?? 0 }},
                    {{ $revenueData['Minggu'] ?? 0 }}
                ],
                borderColor: '#8C6D58',
                backgroundColor: 'rgba(140, 109, 88, 0.15)',
                fill: true,
                tension: 0.4,
                borderWidth: 3,
                pointBackgroundColor: '#3A2E2B',
                pointRadius: 5
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            return 'Pendapatan: Rp ' + context.parsed.y.toLocaleString('id-ID');
                        }
                    }
                }
            },
            scales: {
                y: { 
                    grid: { color: '#F8F6F0' },
                    ticks: {
                        callback: function(value) {
                            return 'Rp ' + value.toLocaleString('id-ID');
                        }
                    }
                },
                x: { grid: { display: false } }
            }
        }
    });

    const ctxRating = document.getElementById('ratingChart').getContext('2d');
    const ratingData = [{{ $star5 }}, {{ $star4 }}, {{ $star3 }}, {{ $starLow }}];
    const isRatingEmpty = ratingData.every(val => val === 0);

    new Chart(ctxRating, {
        type: 'doughnut',
        data: {
            labels: ['Bintang 5', 'Bintang 4', 'Bintang 3', 'Bintang 1-2'],
            datasets: [{
                data: isRatingEmpty ? [1] : ratingData,
                backgroundColor: isRatingEmpty ? ['#EADFC7'] : ['#10B981', '#3B82F6', '#F59E0B', '#F43F5E'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { 
                legend: { display: false },
                tooltip: {
                    enabled: !isRatingEmpty,
                    callbacks: {
                        label: function(context) {
                            if (isRatingEmpty) return ' Belum ada ulasan';
                            return ' ' + context.label + ': ' + context.parsed + ' ulasan';
                        }
                    }
                }
            },
            cutout: '70%'
        }
    });

    const ctxTopProducts = document.getElementById('topProductsChart').getContext('2d');
    
    @php
        $topProductsData = \App\Models\Order::select('product_id', \DB::raw('SUM(quantity) as total_qty'))
                            ->groupBy('product_id')
                            ->orderByDesc('total_qty')
                            ->with('product')
                            ->take(5)
                            ->get();

        $productNames = [];
        $productQty   = [];

        foreach($topProductsData as $item) {
            if($item->product) {
                $productNames[] = $item->product->name;
                $productQty[]   = $item->total_qty;
            }
        }
    @endphp

    const productLabels = {!! json_encode($productNames) !!};
    const productValues = {!! json_encode($productQty) !!};

    new Chart(ctxTopProducts, {
        type: 'bar',
        data: {
            labels: productLabels.length ? productLabels : ['Belum Ada Data Produk'],
            datasets: [{
                label: 'Total Terjual (Pcs)',
                data: productValues.length ? productValues : [0],
                backgroundColor: ['#8C6D58', '#88A99D', '#E0A899', '#A399C2', '#D2BBA0'],
                borderRadius: 8
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                x: { 
                    grid: { color: '#F8F6F0' },
                    ticks: { precision: 0 }
                },
                y: { grid: { display: false } }
            }
        }
    });
</script>

</body>
</html>