<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan #{{ $order->invoice_number ?? $order->id }} — Maison De Jenrina</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased min-h-screen">

    <main class="max-w-4xl mx-auto p-6 md:p-8 space-y-6">
        
        <!-- HEADER & TOMBOL KEMBALI -->
        <div class="flex items-center justify-between pb-3 border-b border-[#EADFC7]/60">
            <div>
                <a href="{{ route('customer.orders') }}" class="inline-flex items-center gap-1.5 text-xs text-stone-500 hover:text-[#3A2E2B] font-semibold mb-1">
                    <i class="fa-solid fa-arrow-left text-[10px]"></i> Kembali ke Pusat Pesanan
                </a>
                <h1 class="text-2xl font-serif font-bold text-[#3A2E2B]">Rincian Detail Pesanan</h1>
            </div>
            
            <span class="px-3.5 py-1.5 rounded-full text-xs font-bold border flex items-center gap-1.5
                {{ $order->status == 'completed' ? 'bg-purple-50 text-purple-700 border-purple-200' : '' }}
                {{ $order->status == 'Pending' || $order->status == 'unpaid' ? 'bg-amber-50 text-amber-700 border-amber-200' : '' }}
                {{ $order->status == 'paid' ? 'bg-blue-50 text-blue-700 border-blue-200' : '' }}
                {{ $order->status == 'shipped' ? 'bg-indigo-50 text-indigo-700 border-indigo-200' : '' }}">
                <i class="fa-solid fa-circle text-[6px]"></i> Status: {{ ucfirst($order->status) }}
            </span>
        </div>

        <!-- INFO TRANSAKSI -->
        <div class="bg-white rounded-3xl border border-[#EADFC7] p-6 shadow-xs space-y-4">
            <div class="flex flex-wrap items-center justify-between gap-4 pb-4 border-b border-stone-100 text-xs">
                <div>
                    <span class="text-stone-400 block mb-0.5">Nomor Invoice</span>
                    <strong class="text-stone-800 font-bold text-sm">#{{ $order->invoice_number ?? 'INV-' . $order->id }}</strong>
                </div>
                <div>
                    <span class="text-stone-400 block mb-0.5">Tanggal Transaksi</span>
                    <strong class="text-stone-800 font-semibold">{{ $order->created_at ? $order->created_at->format('d M Y, H:i') : '-' }} WIB</strong>
                </div>
                <div>
                    <span class="text-stone-400 block mb-0.5">Metode Pembayaran</span>
                    <strong class="text-stone-800 font-semibold uppercase">{{ str_replace('_', ' ', $order->payment_method ?? 'Bank Transfer') }}</strong>
                </div>
            </div>

            <!-- DAFTAR ITEM PRODUK YANG DIBELI -->
            <div class="space-y-3">
                <h3 class="font-bold text-xs uppercase text-stone-400 tracking-wider">Produk Yang Dipesan</h3>
                
                @forelse($order->orderItems as $item)
                    @php
                        $prod = $item->product;
                        $img = optional($prod)->image ? asset('storage/' . $prod->image) : asset('images/default.jpg');
                    @endphp
                    <div class="flex items-center justify-between gap-4 p-4 bg-[#F8F6F0] rounded-2xl border border-[#EADFC7]/60">
                        <div class="flex items-center gap-4">
                            <img src="{{ $img }}" alt="Foto Produk" class="w-16 h-16 rounded-xl object-cover border border-[#EADFC7] shrink-0">
                            <div>
                                <h4 class="font-bold text-sm text-[#3A2E2B]">{{ optional($prod)->name ?? 'Produk Fashion' }}</h4>
                                
                                <div class="flex items-center gap-2 text-xs text-stone-500 mt-1">
                                    @if(!empty($item->color))
                                        <span class="bg-white px-2 py-0.5 rounded-md border border-[#EADFC7]">Warna: <strong>{{ $item->color }}</strong></span>
                                    @endif
                                    @if(!empty($item->size))
                                        <span class="bg-white px-2 py-0.5 rounded-md border border-[#EADFC7]">Size: <strong>{{ $item->size }}</strong></span>
                                    @endif
                                </div>
                                
                                <p class="text-xs text-stone-500 mt-1">Jumlah: <strong>{{ $item->quantity }}x</strong></p>
                            </div>
                        </div>

                        <div class="text-right">
                            <span class="text-xs text-stone-400 block">Subtotal</span>
                            <strong class="text-sm font-extrabold text-[#B86246]">
                                Rp {{ number_format(($item->price ?? optional($prod)->price ?? 0) * $item->quantity, 0, ',', '.') }}
                            </strong>
                        </div>
                    </div>
                @empty
                    <!-- Fallback Single Product -->
                    @php
                        $prod = $order->product;
                        $img = optional($prod)->image ? asset('storage/' . $prod->image) : asset('images/default.jpg');
                    @endphp
                    <div class="flex items-center justify-between gap-4 p-4 bg-[#F8F6F0] rounded-2xl border border-[#EADFC7]/60">
                        <div class="flex items-center gap-4">
                            <img src="{{ $img }}" alt="Foto Produk" class="w-16 h-16 rounded-xl object-cover border border-[#EADFC7] shrink-0">
                            <div>
                                <h4 class="font-bold text-sm text-[#3A2E2B]">{{ optional($prod)->name ?? 'Produk Fashion' }}</h4>
                                <p class="text-xs text-stone-500 mt-1">Jumlah: <strong>{{ $order->quantity ?? 1 }}x</strong></p>
                            </div>
                        </div>

                        <div class="text-right">
                            <span class="text-xs text-stone-400 block">Total</span>
                            <strong class="text-sm font-extrabold text-[#B86246]">
                                Rp {{ number_format($order->total_price ?? $order->total_amount ?? 0, 0, ',', '.') }}
                            </strong>
                        </div>
                    </div>
                @endforelse
            </div>

            <!-- RINCIAN TOTAL -->
            <div class="pt-4 border-t border-stone-100 flex justify-between items-center text-sm">
                <span class="font-bold text-stone-600">Total Pembayaran</span>
                <span class="text-lg font-extrabold text-[#B86246]">
                    Rp {{ number_format($order->total_price ?? $order->total_amount ?? 0, 0, ',', '.') }}
                </span>
            </div>
        </div>

    </main>

</body>
</html>