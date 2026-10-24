<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;

class ProductController extends Controller
{
    // 1. Simpan Produk Baru Beserta Multi-Foto
    public function store(Request $request)
    {
        $request->validate([
            'name'           => 'required|string|max:255',
            'category'       => 'required|string',
            'price'          => 'required|numeric',
            'discount_price' => 'nullable|numeric|lt:price',
            'stock'          => 'required|integer',
            'description'    => 'required|string',
            'colors'         => 'nullable|string',
            'size'           => 'nullable|string',
            'images'         => 'required|array',
            'images.*'       => 'image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        // Cari toko milik user yang sedang login
        $store = Store::where('user_id', auth()->id())->first();

        // Jika belum punya toko, buatkan otomatis
        if (!$store) {
            $store = Store::create([
                'user_id'    => auth()->id(),
                'store_name' => 'Toko ' . auth()->user()->name,
            ]);
        }

        // Ambil foto pertama sebagai thumbnail utama produk
        $firstImagePath = $request->file('images')[0]->store('products', 'public');

        // Simpan produk ke database
        $product = Product::create([
            'store_id'       => $store->id,
            'name'           => $request->name,
            'category'       => $request->category,
            'price'          => $request->price,
            'discount_price' => $request->discount_price,
            'stock'          => $request->stock,
            'image'          => $firstImagePath, 
            'description'    => $request->description,
            'colors'         => $request->colors,
            'size'           => $request->size,
        ]);

        // Simpan seluruh foto ke tabel galeri product_images (Looping)
        foreach ($request->file('images') as $file) {
            $path = $file->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
            ]);
        }

        return redirect()->back()->with('success', 'Produk dan galeri foto berhasil disimpan!');
    }

    // 2. Menampilkan Detail Produk beserta galeri foto dan ulasannya
    public function show($id)
    {
        $product = Product::with(['images', 'reviews.user'])->findOrFail($id);
        
        return view('customer.show', compact('product'));
    }

    // Menampilkan form edit produk
    public function edit($id)
    {
        $product = Product::with('images')->findOrFail($id);
        return view('seller.edit-produk', compact('product'));
    }

    // Memperbarui data produk ke database beserta multi-foto
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $request->validate([
            'name'           => 'required|string|max:255',
            'price'          => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'stock'          => 'required|integer',
            'colors'          => 'nullable|string',
            'category'       => 'required|string',
            'description'    => 'nullable|string',
            'images'         => 'nullable|array',
            'images.*'       => 'image|mimes:jpeg,png,jpg,webp|max:10240',
        ]);

        $data = $request->only(['name', 'price', 'discount_price', 'stock', 'category', 'description']);

        // Jika ada upload foto baru
        if ($request->hasFile('images')) {
            // Ambil foto pertama sebagai thumbnail utama baru
            $firstImagePath = $request->file('images')[0]->store('products', 'public');
            
            // Hapus foto utama lama jika ada
            if ($product->image && \Storage::disk('public')->exists($product->image)) {
                \Storage::disk('public')->delete($product->image);
            }
            
            $data['image'] = $firstImagePath;

            // Simpan juga ke galeri tabel product_images
            foreach ($request->file('images') as $file) {
                $path = $file->store('products', 'public');
                \App\Models\ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                ]);
            }
        }

        $product->update($data);

        return redirect()->route('seller.dashboard')->with('success', 'Produk dan galeri foto berhasil diperbarui!');
    }

    // 3. Hapus Produk
    public function destroy($id)
    {
        $store = Store::where('user_id', auth()->id())->first();

        if (!$store) {
            return back()->withErrors(['store' => 'Akses ditolak. Toko tidak ditemukan.']);
        }

        $product = Product::where('id', $id)->where('store_id', $store->id)->firstOrFail();

        // Hapus galeri foto terkait dari database
        $product->images()->delete();

        // Hapus data produk
        $product->delete();

        return redirect()->back()->with('success', 'Produk berhasil dihapus dari katalog toko!');
    }
}