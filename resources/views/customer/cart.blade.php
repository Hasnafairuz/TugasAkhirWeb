<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Keranjang Belanja — Maison De Jenrina</title>
    
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased flex min-h-screen">

    <!-- SIDEBAR CUSTOMER -->
    <aside class="w-64 bg-[#D9C19D] border-r border-[#C8B08C] min-h-screen flex flex-col justify-between p-5 fixed left-0 top-0 bottom-0 z-40 shadow-sm">
        <div>
            <a href="{{ route('landing') }}" class="flex items-center gap-3 pb-6 border-b border-[#C8B08C]/60 mb-6">
                <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-10 h-10 object-cover rounded-full border border-[#3A2E2B] p-0.5 bg-white shadow-xs">
                <div>
                    <h2 class="font-serif font-bold text-sm text-[#3A2E2B] leading-tight">MAISON DE JENRINA</h2>
                    <span class="text-[9px] text-[#52423D] uppercase tracking-widest font-semibold block">Customer Portal</span>
                </div>
            </a>

            <nav class="space-y-1.5 text-xs font-medium">
                <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 text-[#3A2E2B] hover:bg-white/40 text-xs font-semibold rounded-xl transition">
                    <i class="fa-solid fa-store"></i>
                    <span>Dashboard (Shop)</span>
                </a>

                <a href="{{ route('cart.index') }}" class="flex items-center gap-3 px-4 py-2.5 bg-[#3A2E2B] text-white text-xs font-bold rounded-xl shadow-xs">
                    <i class="fa-solid fa-cart-shopping text-amber-200"></i>
                    <span>Keranjang Belanja</span>
                </a>

                <a href="{{ route('customer.orders') }}" class="flex items-center gap-3 px-4 py-2.5 text-[#3A2E2B] hover:bg-white/40 text-xs font-semibold rounded-xl transition">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Pesanan Saya</span>
                </a>

                <a href="{{ route('landing') }}" class="flex items-center gap-3 px-4 py-2.5 text-[#3A2E2B] hover:bg-white/40 text-xs font-semibold rounded-xl transition">
                    <i class="fa-solid fa-house"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </nav>
        </div>

        <div class="pt-4 border-t border-[#C8B08C]/60">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full py-2.5 px-4 bg-rose-900/10 hover:bg-rose-900/20 text-rose-800 font-bold text-xs rounded-xl transition flex items-center justify-center gap-2 border border-rose-800/20 cursor-pointer">
                    <i class="fa-solid fa-right-from-bracket"></i>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- KONTEN UTAMA KERANJANG -->
    <div class="flex-1 ml-64 flex flex-col min-w-0 min-h-screen">
        
        <header class="bg-white/80 backdrop-blur-md border-b border-[#EADFC7] px-8 py-3.5 sticky top-0 z-30 flex items-center justify-between shadow-xs">
            <div class="flex items-center gap-3">
                <span class="text-xs font-semibold text-stone-400">Customer</span>
                <span class="text-xs text-stone-300">/</span>
                <h1 class="text-sm font-bold text-[#3A2E2B]">Keranjang Belanja</h1>
            </div>

            <div class="flex items-center gap-2.5">
                <div class="w-8 h-8 rounded-full bg-[#EADFC7] flex items-center justify-center text-[#3A2E2B] font-bold text-xs shadow-xs overflow-hidden border border-[#D5C1B2]">
                    <img src="{{ asset('images/profile.png') }}" alt="Profil" class="w-full h-full object-cover" onerror="this.style.display='none'">
                    <span style="display:none">{{ strtoupper(substr(auth()->user()->name ?? 'C', 0, 1)) }}</span>
                </div>
                <span class="text-xs font-bold text-[#3A2E2B] hidden md:inline">{{ auth()->user()->name ?? 'Pelanggan' }}</span>
            </div>
        </header>

        <main class="flex-1 p-8 max-w-5xl w-full space-y-6"
              x-data="{ 
                  selectedItems: [],
                  cartItems: [
                      @php
                          $items = $cartItems ?? session()->get('cart', []);
                      @endphp
                      @if(!empty($items))
                          @foreach($items as $id => $item)
                              @php 
                                  $isObj = is_object($item);
                                  $iId = (string) ($isObj ? $item->id : $id);
                                  $iPrice = $isObj ? ($item->product->price ?? 0) : ($item['price'] ?? 0);
                                  $iQty = $isObj ? $item->quantity : ($item['quantity'] ?? 1);
                              @endphp
                              { id: '{{ $iId }}', price: {{ $iPrice }}, qty: {{ $iQty }} },
                          @endforeach
                      @endif
                  ],
                  selectAll: false,
                  toggleSelectAll() {
                      if (this.selectAll) {
                          this.selectedItems = this.cartItems.map(item => item.id);
                      } else {
                          this.selectedItems = [];
                      }
                  },
                  updateSelectAllStatus() {
                      this.selectAll = (this.selectedItems.length === this.cartItems.length && this.cartItems.length > 0);
                  },
                  calculateTotal() {
                      let total = 0;
                      this.cartItems.forEach(item => {
                          if (this.selectedItems.includes(item.id)) {
                              total += (item.price * item.qty);
                          }
                      });
                      return total;
                  },
                  formatRupiah(number) {
                      return 'Rp ' + new Intl.NumberFormat('id-ID').format(number);
                  }
              }"
              x-init="selectedItems = cartItems.map(item => item.id); selectAll = true;">
            
            <div class="flex items-center justify-between mb-2">
                <div>
                    <h2 class="text-2xl font-serif font-bold text-[#3A2E2B]">Keranjang Belanja Saya</h2>
                    <p class="text-xs text-stone-500">Kelola daftar item busana yang ingin Anda beli</p>
                </div>
                <a href="{{ route('customer.dashboard') }}" class="text-xs font-bold text-stone-600 hover:text-[#3A2E2B] flex items-center gap-1.5 bg-white px-4 py-2 rounded-xl border border-[#EADFC7] shadow-xs transition">
                    <i class="fa-solid fa-arrow-left"></i> Lanjut Belanja
                </a>
            </div>

            @if(session('success'))
                <div class="p-4 bg-emerald-100 border border-emerald-300 text-emerald-800 text-xs font-bold rounded-xl flex items-center gap-2">
                    <i class="fa-solid fa-circle-check"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="bg-white rounded-3xl border border-[#EADFC7] shadow-xs overflow-hidden">
                @if(!empty($items) && count($items) > 0)
                    <!-- FORM PEMESANAN DENGAN CHECKBOX TERPILIH -->
                    <form action="{{ route('cart.checkout') }}" method="GET">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr class="bg-[#F8F6F0] text-stone-600 text-xs uppercase font-bold border-b border-[#EADFC7]">
                                        <th class="p-4 w-12 text-center">
                                            <input type="checkbox" 
                                                   x-model="selectAll" 
                                                   @change="toggleSelectAll()" 
                                                   class="w-4 h-4 rounded text-[#3A2E2B] focus:ring-0 border-[#C8B08C] cursor-pointer">
                                        </th>
                                        <th class="p-4">Produk</th>
                                        <th class="p-4">Harga</th>
                                        <th class="p-4 text-center">Jumlah</th>
                                        <th class="p-4">Subtotal</th>
                                        <th class="p-4 text-center">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-stone-100 text-xs font-medium">
                                    @foreach($items as $id => $item)
                                        @php 
                                            $isObject = is_object($item);
                                            $itemId = (string) ($isObject ? $item->id : $id);
                                            $name = $isObject ? ($item->product->name ?? 'Produk') : ($item['name'] ?? 'Produk');
                                            $price = $isObject ? ($item->product->price ?? 0) : ($item['price'] ?? 0);
                                            $quantity = $isObject ? $item->quantity : ($item['quantity'] ?? 1);
                                            $image = $isObject ? ($item->product->image ?? '') : ($item['image'] ?? '');
                                            $category = $isObject ? ($item->product->category ?? 'Fashion') : ($item['category'] ?? 'Fashion');
                                            
                                            $color = $isObject ? ($item->color ?? null) : ($item['color'] ?? null);
                                            $size = $isObject ? ($item->size ?? null) : ($item['size'] ?? null);

                                            $subtotal = $price * $quantity;
                                        @endphp
                                        <tr>
                                            <td class="p-4 text-center">
                                                <input type="checkbox" 
                                                       name="selected_items[]" 
                                                       value="{{ $itemId }}" 
                                                       x-model="selectedItems" 
                                                       @change="updateSelectAllStatus()" 
                                                       class="w-4 h-4 rounded text-[#3A2E2B] focus:ring-0 border-[#C8B08C] cursor-pointer">
                                            </td>
                                            <td class="p-4">
                                                <div class="flex items-center gap-3">
                                                    @if($image)
                                                        <img src="{{ asset('storage/' . $image) }}" class="w-14 h-14 object-cover rounded-xl border border-stone-200 shrink-0" alt="{{ $name }}">
                                                    @else
                                                        <div class="w-14 h-14 bg-stone-100 rounded-xl border border-stone-200 flex items-center justify-center text-stone-400 shrink-0">
                                                            <i class="fa-solid fa-shirt"></i>
                                                        </div>
                                                    @endif
                                                    <div>
                                                        <h3 class="font-bold text-[#3A2E2B] text-sm mb-0.5">{{ $name }}</h3>
                                                        <span class="text-[10px] text-stone-400 uppercase font-semibold block mb-1">{{ $category }}</span>
                                                        
                                                        <div class="flex flex-wrap gap-1 text-[11px] text-stone-600">
                                                            @if($color)
                                                                <span class="bg-[#F8F6F0] px-2 py-0.5 rounded border border-[#EADFC7]">Warna: <strong>{{ $color }}</strong></span>
                                                            @endif
                                                            @if($size)
                                                                <span class="bg-[#F8F6F0] px-2 py-0.5 rounded border border-[#EADFC7]">Size: <strong class="uppercase">{{ $size }}</strong></span>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="p-4 text-stone-700 font-semibold">
                                                Rp {{ number_format($price, 0, ',', '.') }}
                                            </td>
                                            <td class="p-4 text-center font-bold text-stone-800">
                                                {{ $quantity }} pcs
                                            </td>
                                            <td class="p-4 font-bold text-[#B86246]">
                                                Rp {{ number_format($subtotal, 0, ',', '.') }}
                                            </td>
                                            <td class="p-4 text-center">
                                                <form action="{{ route('cart.remove', $itemId) }}" method="POST" onsubmit="return confirm('Hapus item ini dari keranjang?')" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="p-2.5 bg-rose-50 hover:bg-rose-100 text-rose-600 rounded-xl transition cursor-pointer border border-rose-200">
                                                        <i class="fa-solid fa-trash-can"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- FOOTER TOTAL & TOMBOL LANJUT KE PEMESANAN -->
                        <div class="p-6 bg-[#F8F6F0]/40 border-t border-[#EADFC7] flex flex-col md:flex-row items-center justify-between gap-4">
                            <div>
                                <p class="text-xs text-stone-500 uppercase tracking-wide font-bold">TOTAL PEMBAYARAN:</p>
                                <p class="text-2xl font-extrabold text-[#3A2E2B]" x-text="formatRupiah(calculateTotal())">Rp 0</p>
                                <span class="text-[11px] text-stone-400 font-semibold" x-text="'(' + selectedItems.length + ' produk dipilih)'"></span>
                            </div>

                            <button type="submit" 
                                    :disabled="selectedItems.length === 0"
                                    :class="selectedItems.length === 0 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-[#52423D] cursor-pointer'"
                                    class="w-full md:w-auto px-8 py-3.5 bg-[#3A2E2B] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition flex items-center justify-center gap-2">
                                LANJUT KE PEMESANAN <i class="fa-solid fa-arrow-right"></i>
                            </button>
                        </div>
                    </form>
                @else
                    <div class="p-16 text-center">
                        <i class="fa-solid fa-cart-flatbed text-4xl text-stone-300 mb-3 block"></i>
                        <p class="text-stone-500 text-xs font-semibold mb-4">Keranjang belanja Anda masih kosong.</p>
                        <a href="{{ route('customer.dashboard') }}" class="inline-block px-6 py-2.5 bg-[#3A2E2B] hover:bg-[#52423D] text-white text-xs font-bold rounded-xl transition shadow-xs">
                            Mulai Belanja Sekarang
                        </a>
                    </div>
                @endif
            </div>

        </main>
    </div>

</body>
</html>