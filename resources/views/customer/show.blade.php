<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} — Maison De Jenrina</title>
    
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased min-h-screen flex flex-col"
      x-data="{ 
          selectedColor: 'Mocca', 
          selectedSize: 'L', 
          quantity: 1,
          maxStock: {{ $product->stock ?? 100 }}
      }">

    <!-- HEADER TOPBAR -->
    <header class="bg-white/80 backdrop-blur-md border-b border-[#EADFC7] px-8 py-4 sticky top-0 z-30 flex items-center justify-between shadow-xs">
        <a href="{{ route('customer.dashboard') }}" class="flex items-center gap-3">
            <img src="{{ asset('images/logo.png') }}" alt="Logo" class="w-8 h-8 rounded-full border border-[#3A2E2B] p-0.5 bg-white">
            <span class="font-serif font-bold text-sm text-[#3A2E2B] tracking-wider">MAISON DE JENRINA</span>
        </a>

        <div class="flex items-center gap-4">
            <a href="{{ route('cart.index') }}" class="w-9 h-9 rounded-full bg-stone-100 hover:bg-[#EADFC7] flex items-center justify-center text-stone-700 transition relative">
                <i class="fa-solid fa-cart-shopping text-sm"></i>
            </a>
            <div class="flex items-center gap-2">
                <div class="w-8 h-8 rounded-full bg-[#EADFC7] flex items-center justify-center text-[#3A2E2B] font-bold text-xs shadow-xs overflow-hidden border border-[#D5C1B2]">
                    <img src="{{ asset('images/profile.png') }}" alt="Profil" class="w-full h-full object-cover" onerror="this.style.display='none'">
                    <span style="display:none">{{ strtoupper(substr(auth()->user()->name ?? 'P', 0, 1)) }}</span>
                </div>
                <span class="text-xs font-bold text-[#3A2E2B] hidden md:inline">{{ auth()->user()->name ?? 'Pelanggan' }}</span>
            </div>
        </div>
    </header>

    <!-- KONTEN UTAMA DETAIL PRODUK -->
    <main class="max-w-6xl mx-auto p-4 md:p-8 w-full flex-1 space-y-6">
        
        @if(session('success'))
            <div class="bg-emerald-50 border border-emerald-200 text-emerald-800 text-xs px-4 py-3 rounded-2xl flex items-center gap-2 shadow-xs">
                <i class="fa-solid fa-circle-check text-emerald-600"></i>
                <span>{{ session('success') }}</span>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- FOTO PRODUK (KOLOM KIRI) -->
            <div class="lg:col-span-5 space-y-4">
                <!-- Foto Utama / Aktif -->
                <div class="bg-white p-2 rounded-3xl border border-[#EADFC7] shadow-sm overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-[400px] object-cover rounded-2xl" id="main-product-image">
                    @else
                        <div class="w-full h-[400px] bg-stone-100 rounded-2xl flex items-center justify-center text-stone-400">
                            <i class="fa-solid fa-shirt text-6xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Thumbnail Galeri Foto Tambahan (Lebih dari 1 foto) -->
                @if($product->images && $product->images->count() > 0)
                    <div class="grid grid-cols-4 gap-3">
                        <!-- Thumbnail Foto Utama -->
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" 
                                 onclick="document.getElementById('main-product-image').src=this.src"
                                 class="w-full h-20 object-cover rounded-2xl border-2 border-[#3A2E2B] cursor-pointer hover:opacity-80 transition shadow-xs">
                        @endif

                        <!-- Thumbnail Foto dari Relasi ProductImage -->
                        @foreach($product->images as $img)
                            <img src="{{ asset('storage/' . $img->image_path) }}" 
                                 onclick="document.getElementById('main-product-image').src=this.src"
                                 class="w-full h-20 object-cover rounded-2xl border border-[#EADFC7] cursor-pointer hover:opacity-80 transition shadow-xs">
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- DETAIL DESKRIPSI -->
            <div class="lg:col-span-4 space-y-6">
                <div>
                    <span class="px-3 py-1 bg-[#EADFC7]/60 text-[#3A2E2B] text-[10px] uppercase font-extrabold tracking-wider rounded-full inline-block mb-2">
                        {{ $product->category ?? 'TEEN FASHION' }}
                    </span>
                    <h1 class="text-2xl font-serif font-bold text-[#3A2E2B] leading-snug">{{ $product->name }}</h1>
                    <div class="flex items-center gap-2 mt-1 text-xs text-stone-500">
                        <span class="text-amber-500"><i class="fa-solid fa-star"></i> 4.8</span>
                        <span>•</span>
                        <span>Terjual 50+</span>
                    </div>
                </div>

                <!-- HARGA -->
                <div class="flex items-center gap-3 my-4">
                    @if($product->discount_price && $product->discount_price < $product->price)
                        <span class="text-2xl font-extrabold text-[#B86246]">
                            Rp {{ number_format($product->discount_price, 0, ',', '.') }}
                        </span>
                        <span class="text-stone-400 text-sm line-through">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                        @php
                            $discountPercent = round((($product->price - $product->discount_price) / $product->price) * 100);
                        @endphp
                        <span class="bg-rose-600 text-white text-[10px] font-extrabold px-2.5 py-1 rounded-full">
                            -{{ $discountPercent }}%
                        </span>
                    @else
                        <span class="text-2xl font-extrabold text-[#3A2E2B]">
                            Rp {{ number_format($product->price, 0, ',', '.') }}
                        </span>
                    @endif
                </div>

                <!-- PILIH WARNA & UKURAN -->
                <!-- PILIH WARNA (DINAMIS DARI DATABASE) -->
                <div class="space-y-2">
                    <label class="text-xs font-bold text-[#3A2E2B] uppercase tracking-wider block">PILIH WARNA:</label>
                    <div class="flex flex-wrap gap-2">
                        @php
                            // Memecah teks string dari database (misal: "Mocca, Black, Navy") menjadi array
                            $productColors = $product->colors ? explode(',', $product->colors) : ['Default'];
                        @endphp

                        @foreach($productColors as $color)
                            @php $cleanColor = trim($color); @endphp
                            <button type="button" 
                                    @click="selectedColor = '{{ $cleanColor }}'"
                                    :class="selectedColor === '{{ $cleanColor }}' ? 'bg-[#3A2E2B] text-white border-[#3A2E2B]' : 'bg-white text-stone-700 border-[#EADFC7] hover:bg-stone-50'"
                                    class="px-4 py-2 rounded-xl border text-xs font-semibold transition cursor-pointer">
                                {{ $cleanColor }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <div class="space-y-2">
                    <label class="text-xs font-bold text-[#3A2E2B] uppercase tracking-wider block">PILIH UKURAN (SIZE):</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach(['M (38-45 KG)', 'L (45-55 KG)', 'XL (55-67 KG)', 'XXL (68-75 KG)'] as $size)
                            <button type="button" 
                                    @click="selectedSize = '{{ $size }}'"
                                    :class="selectedSize === '{{ $size }}' ? 'bg-[#3A2E2B] text-white border-[#3A2E2B]' : 'bg-white text-stone-700 border-[#EADFC7] hover:bg-stone-50'"
                                    class="px-4 py-2.5 rounded-xl border text-xs font-semibold transition cursor-pointer">
                                {{ $size }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- DESKRIPSI (SUDAH DIPERBAIKI DENGAN nl2br) -->
                <div class="pt-4 border-t border-[#EADFC7] space-y-1">
                    <h3 class="text-xs font-bold text-[#3A2E2B] uppercase tracking-wider">DESKRIPSI PRODUK</h3>
                    <p class="text-xs text-stone-600 leading-relaxed">
                        {!! nl2br(e($product->description ?? 'Celana panjang wanita (sweatpants / kulot) bergaya Korean Streetwear / Y2K Aesthetic yang unik dengan aksen pinggang highwaist berhias lipatan rumbai.')) !!}
                    </p>
                </div>
            </div>

            <!-- CARD KANAN (ATUR JUMLAH & TOMBOL) -->
            <div class="lg:col-span-3 bg-white p-5 rounded-3xl border border-[#EADFC7] shadow-sm space-y-4 sticky top-24">
                <h2 class="font-bold text-xs text-[#3A2E2B] uppercase tracking-wider">ATUR JUMLAH DAN CATATAN</h2>

                <div class="flex items-center gap-3 p-2 bg-[#F8F6F0] rounded-xl border border-[#EADFC7]/60">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-12 h-12 object-cover rounded-lg shrink-0">
                    @else
                        <div class="w-12 h-12 bg-stone-200 rounded-lg flex items-center justify-center text-stone-400 shrink-0">
                            <i class="fa-solid fa-shirt text-xs"></i>
                        </div>
                    @endif
                    <div class="min-w-0">
                        <h4 class="font-bold text-xs text-[#3A2E2B] truncate">{{ $product->name }}</h4>
                        <p class="text-[10px] text-stone-500"><span x-text="selectedColor"></span>, <span x-text="selectedSize"></span></p>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs">
                    <span class="font-semibold text-stone-600">Jumlah:</span>
                    <div class="flex items-center border border-[#EADFC7] rounded-xl overflow-hidden bg-[#F8F6F0]">
                        <button type="button" @click="if(quantity > 1) quantity--" class="px-3 py-1.5 hover:bg-stone-200 text-stone-600 font-bold">-</button>
                        <span class="px-3 py-1.5 font-bold text-[#3A2E2B]" x-text="quantity">1</span>
                        <button type="button" @click="if(quantity < maxStock) quantity++" class="px-3 py-1.5 hover:bg-stone-200 text-stone-600 font-bold">+</button>
                    </div>
                </div>

                <div class="flex items-center justify-between text-xs text-stone-500">
                    <span>Stok Tersedia:</span>
                    <span class="font-bold text-stone-800">{{ $product->stock ?? '655' }} Pcs</span>
                </div>

                <div class="pt-3 border-t border-stone-100 flex items-center justify-between">
                    <span class="text-xs text-stone-500 font-semibold">Subtotal</span>
                    <span class="text-sm font-extrabold text-[#B86246]">Rp <span x-text="(quantity * {{ $product->discount_price && $product->discount_price < $product->price ? $product->discount_price : $product->price }}).toLocaleString('id-ID')"></span></span>
                </div>

                <!-- FORM PEMBELIAN (BELI & KERANJANG) -->
                <form method="POST" class="space-y-2 mt-2">
                    @csrf
                    <input type="hidden" name="color" :value="selectedColor">
                    <input type="hidden" name="size" :value="selectedSize">
                    <input type="hidden" name="quantity" :value="quantity">

                    <button type="submit" 
                            formaction="{{ route('checkout', $product->id) }}"
                            formmethod="GET"
                            class="w-full py-3 bg-[#3A2E2B] hover:bg-[#52423D] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition flex items-center justify-center gap-2 cursor-pointer">
                        <i class="fa-solid fa-bag-shopping"></i> BELI LANGSUNG
                    </button>

                    <button type="submit" 
                            formaction="{{ route('cart.add', $product->id) }}"
                            formmethod="POST"
                            class="w-full py-3 bg-[#EADFC7] hover:bg-[#D5C1B2] text-[#3A2E2B] font-bold text-xs uppercase tracking-wider rounded-xl transition flex items-center justify-center gap-2 cursor-pointer border border-[#D9C19D]">
                        <i class="fa-solid fa-cart-plus"></i> + KERANJANG
                    </button>
                </form>

                <!-- FOOTER TOMBOL CHAT, FAV, SHARE BERBENTUK KOTAK -->
                <div class="pt-3 border-t border-stone-100 grid grid-cols-3 gap-2">
                    
                    <!-- 1. CHAT INTERNAL (MODAL) -->
                    <div x-data="{ openChatModal: false }">
                        <button type="button" 
                                @click="openChatModal = true"
                                class="w-full flex items-center justify-center gap-1.5 py-2 px-1 rounded-xl bg-white hover:bg-stone-50 text-stone-700 hover:text-[#3A2E2B] text-xs font-semibold transition cursor-pointer border border-[#EADFC7] shadow-xs">
                            <i class="fa-regular fa-comment text-xs"></i>
                            <span>Chat</span>
                        </button>

                        <div x-show="openChatModal" 
                             x-transition
                             class="fixed inset-0 bg-black/50 backdrop-blur-xs z-50 flex items-center justify-center p-4" 
                             style="display: none;">
                            <div @click.away="openChatModal = false" class="bg-white rounded-3xl p-6 max-w-md w-full border border-[#EADFC7] shadow-xl space-y-4 text-left">
                                <div class="flex items-center justify-between pb-3 border-b border-stone-100">
                                    <h3 class="font-serif font-bold text-base text-[#3A2E2B]">Tanya Admin / Penjual</h3>
                                    <button type="button" @click="openChatModal = false" class="text-stone-400 hover:text-stone-700 font-bold cursor-pointer">✕</button>
                                </div>

                                <form action="{{ route('product.chat.store', $product->id) }}" method="POST" class="space-y-4">
                                    @csrf
                                    <div>
                                        <label class="text-xs font-bold text-stone-600 block mb-1">Produk yang Ditanyakan:</label>
                                        <input type="text" disabled value="{{ $product->name }}" class="w-full px-3 py-2 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7] text-stone-700 font-semibold">
                                    </div>

                                    <div>
                                        <label class="text-xs font-bold text-stone-600 block mb-1">Pesan Anda:</label>
                                        <textarea name="message" rows="4" required placeholder="Tuliskan pertanyaan mengenai ukuran, warna, atau ketersediaan stok..." class="w-full p-3 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B] text-stone-800"></textarea>
                                    </div>

                                    <div class="flex justify-end gap-2 pt-2">
                                        <button type="button" @click="openChatModal = false" class="px-4 py-2 rounded-xl bg-stone-100 text-stone-600 text-xs font-bold hover:bg-stone-200 cursor-pointer">Batal</button>
                                        <button type="submit" class="px-5 py-2 rounded-xl bg-[#3A2E2B] hover:bg-[#52423D] text-white text-xs font-bold shadow-md cursor-pointer">Kirim Pesan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- 2. FAV -->
                    <div x-data="{ isWished: false, showNotif: false }">
                        <button type="button"
                                @click="isWished = !isWished; showNotif = true; setTimeout(() => showNotif = false, 2000)" 
                                :class="isWished ? 'bg-rose-50 border-rose-200 text-rose-600' : 'bg-white hover:bg-stone-50 border-[#EADFC7] text-stone-700'"
                                class="w-full flex items-center justify-center gap-1.5 py-2 px-1 rounded-xl text-xs font-semibold transition cursor-pointer border shadow-xs">
                            <i class="fa-solid fa-heart text-xs" :class="isWished ? 'text-rose-600 scale-110' : 'text-stone-400'"></i>
                            <span x-text="isWished ? 'Saved' : 'Fav'"></span>
                        </button>

                        <div x-show="showNotif" 
                             x-transition 
                             class="fixed bottom-5 right-5 bg-[#3A2E2B] text-white text-xs px-4 py-2.5 rounded-xl shadow-lg z-50 flex items-center gap-2" 
                             style="display: none;">
                            <i class="fa-solid fa-heart text-rose-400"></i>
                            <span x-text="isWished ? 'Ditambahkan ke Wishlist!' : 'Dihapus dari Wishlist!'"></span>
                        </div>
                    </div>

                    <!-- 3. SHARE -->
                    <div x-data="{ copied: false }">
                        <button type="button"
                                @click="
                                    if (navigator.share) {
                                        navigator.share({
                                            title: '{{ addslashes($product->name) }}',
                                            url: window.location.href
                                        });
                                    } else {
                                        navigator.clipboard.writeText(window.location.href);
                                        copied = true;
                                        setTimeout(() => copied = false, 2000);
                                    }" 
                                class="w-full flex items-center justify-center gap-1.5 py-2 px-1 rounded-xl bg-white hover:bg-stone-50 text-stone-700 hover:text-[#3A2E2B] text-xs font-semibold transition cursor-pointer border border-[#EADFC7] shadow-xs">
                            <i class="fa-solid fa-share-nodes text-xs"></i>
                            <span x-text="copied ? 'Tersalin' : 'Share'"></span>
                        </button>
                    </div>

                </div>

            </div>

        </div>

        <!-- BAGIAN ULASAN PRODUK -->
        <div class="bg-white rounded-3xl border border-[#EADFC7] p-6 space-y-4 shadow-xs">
            <h3 class="font-serif font-bold text-lg text-[#3A2E2B]">Ulasan Pembeli ({{ $product->reviews->count() }})</h3>
            
            <div class="space-y-4 divide-y divide-stone-100">
                @forelse($product->reviews ?? [] as $review)
                    <div class="pt-4 first:pt-0 space-y-1.5">
                        <div class="flex items-center justify-between">
                            <span class="font-bold text-xs text-[#3A2E2B]">{{ $review->user->name ?? 'Pelanggan' }}</span>
                            <span class="text-[10px] text-stone-400">{{ $review->created_at->format('d M Y') }}</span>
                        </div>
                        
                        <!-- Bintang Rating -->
                        <div class="flex items-center gap-1 text-amber-400 text-[10px]">
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fa-solid fa-star {{ $i <= $review->rating ? 'text-amber-400' : 'text-stone-300' }}"></i>
                            @endfor
                        </div>
                        
                        <p class="text-xs text-stone-600 leading-relaxed">{{ $review->comment }}</p>
                    </div>
                @empty
                    <p class="text-xs text-stone-400 text-center py-4">Belum ada ulasan untuk produk ini. Jadilah yang pertama memberikan ulasan!</p>
                @endforelse
            </div>
        </div>

    </main>

</body>
</html>