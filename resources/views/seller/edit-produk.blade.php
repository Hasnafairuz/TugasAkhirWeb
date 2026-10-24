<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Produk — Maison De Jenrina</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:ital,wght@0,600;0,700;1,400&family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; background-color: #F8F6F0; }
        .font-serif { font-family: 'Playfair Display', serif; }
    </style>
</head>
<body class="bg-[#F8F6F0] text-stone-800 antialiased p-6 md:p-12">

    <div class="max-w-2xl mx-auto bg-white p-8 rounded-3xl border border-[#EADFC7] shadow-sm space-y-6">
        
        <div class="flex items-center justify-between pb-4 border-b border-stone-100">
            <div>
                <h1 class="font-serif font-bold text-xl text-[#3A2E2B]">Edit Produk</h1>
                <p class="text-xs text-stone-500">Perbarui informasi produk toko Anda</p>
            </div>
            <a href="{{ route('seller.dashboard') }}" class="px-4 py-2 bg-stone-100 hover:bg-stone-200 text-stone-700 text-xs font-bold rounded-xl transition">
                Kembali
            </a>
        </div>

        <form action="{{ route('seller.products.update', $product->id) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
            @csrf
            @method('PUT')

            <div>
                <label class="text-xs font-bold text-stone-700 block mb-1">Nama Produk</label>
                <input type="text" name="name" value="{{ old('name', $product->name) }}" required class="w-full px-4 py-3 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B]">
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-bold text-stone-700 block mb-1">Harga Normal (Rp)</label>
                    <input type="number" name="price" value="{{ old('price', $product->price) }}" required class="w-full px-4 py-3 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B]">
                </div>
                <div>
                    <label class="text-xs font-bold text-stone-700 block mb-1">Harga Diskon (Opsional)</label>
                    <input type="number" name="discount_price" value="{{ old('discount_price', $product->discount_price) }}" class="w-full px-4 py-3 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B]">
                </div>
            </div>

            <!-- Pilihan Warna & Ukuran pada Form Edit -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Pilihan Warna</label>
                    <input type="text" name="color" value="{{ old('color', $product->color ?? $product->colors) }}" 
                        class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]" placeholder="Mocca, Black, Navy">
                </div>
                <div>
                    <label class="block text-xs font-bold text-[#3A2E2B] uppercase mb-1">Pilihan Ukuran / Size</label>
                    <input type="text" name="size" value="{{ old('size', $product->size) }}" 
                        class="w-full text-xs p-3.5 rounded-xl border border-[#EADFC7] bg-[#F8F6F0]/40 focus:bg-white focus:outline-none focus:border-[#A38875]" placeholder="M, L, XL, XXL">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label class="text-xs font-bold text-stone-700 block mb-1">Stok</label>
                    <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" required class="w-full px-4 py-3 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B]">
                </div>
                <div>
                    <label class="text-xs font-bold text-stone-700 block mb-1">Kategori</label>
                    <input type="text" name="category" value="{{ old('category', $product->category) }}" required class="w-full px-4 py-3 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B]">
                </div>
            </div>

            <div>
                <label class="text-xs font-bold text-stone-700 block mb-1">Deskripsi Produk</label>
                <textarea name="description" rows="4" class="w-full p-4 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7] focus:outline-none focus:border-[#3A2E2B]">{{ old('description', $product->description) }}</textarea>
            </div>

            <div>
                <label class="text-xs font-bold text-stone-700 block mb-1">Tambah / Ganti Foto Produk (Bisa Pilih Banyak)</label>
                @if($product->image)
                    <div class="mb-2 flex items-center gap-2">
                        <img src="{{ asset('storage/' . $product->image) }}" class="w-20 h-20 object-cover rounded-xl border border-stone-200">
                        <span class="text-[10px] text-stone-400">Foto Utama Saat Ini</span>
                    </div>
                @endif
                <!-- Tambahkan atribut multiple dan ubah name menjadi images[] -->
                <input type="file" name="images[]" multiple class="w-full p-2 bg-[#F8F6F0] rounded-xl text-xs border border-[#EADFC7]">
                <p class="text-[10px] text-stone-400 mt-1">Anda bisa memilih lebih dari 1 foto sekaligus.</p>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3.5 bg-[#3A2E2B] hover:bg-[#52423D] text-white font-bold text-xs uppercase tracking-wider rounded-xl shadow-md transition cursor-pointer">
                    Simpan Perubahan
                </button>
            </div>
        </form>

    </div>

</body>
</html>