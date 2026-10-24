<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Product;

class CartController extends Controller
{
    // 1. Menampilkan Halaman Keranjang Belanja
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();
        return view('customer.cart', compact('cartItems'));
    }

    // 2. Menambahkan Produk ke Keranjang (dari halaman detail / beli)
    public function add(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $color    = $request->input('color');
        $size     = $request->input('size');
        $quantity = $request->input('quantity', 1);

        // Menentukan harga final (otomatis mengecek apakah ada diskon valid)
        $finalPrice = ($product->discount_price && $product->discount_price < $product->price) 
                        ? $product->discount_price 
                        : $product->price;

        // Cek apakah item dengan produk, warna, dan ukuran yang sama sudah ada di keranjang
        $cartItem = Cart::where('user_id', auth()->id())
                        ->where('product_id', $product->id)
                        ->where('color', $color)
                        ->where('size', $size)
                        ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan jumlahnya dan perbarui harganya jika berubah
            $cartItem->quantity += $quantity;
            $cartItem->price = $finalPrice; // Opsional jika tabel cart menyimpan kolom price
            $cartItem->save();
        } else {
            // Jika belum ada, simpan baru beserta harga final promosi
            Cart::create([
                'user_id'    => auth()->id(),
                'product_id' => $product->id,
                'quantity'   => $quantity,
                'color'      => $color,
                'size'       => $size,
                // Pastikan kolom 'price' ada di migration carts Anda jika ingin menyimpannya per baris
                // 'price'   => $finalPrice, 
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang!');
    }

    // 3. Menghapus Item dari Keranjang (Method yang dicari oleh route cart.remove)
    public function destroy($id)
    {
        $cartItem = Cart::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $cartItem->delete();

        return redirect()->route('cart.index')->with('success', 'Item berhasil dihapus dari keranjang.');
    }

    // Memproses item keranjang yang dicentang menuju halaman checkout
    public function checkout(Request $request)
    {
        // Ambil array ID keranjang yang dicentang oleh user
        $selectedIds = $request->input('selected_items', []);

        if (empty($selectedIds)) {
            return redirect()->route('cart.index')->with('error', 'Silakan pilih minimal satu produk untuk checkout.');
        }

        // Ambil data keranjang beserta relasi produknya berdasarkan ID yang dicentang
        $selectedProducts = Cart::with('product')
                            ->where('user_id', auth()->id())
                            ->whereIn('id', $selectedIds)
                            ->get();

        // Hitung subtotal keseluruhan produk yang dipilih
        $subtotalProd = $selectedProducts->sum(function($item) {
            $price = optional($item->product)->discount_price && optional($item->product)->discount_price < optional($item->product)->price 
                     ? $item->product->discount_price 
                     : optional($item->product)->price ?? $item->price ?? 0;
            return $price * $item->quantity;
        });

        // Kirim data ke view checkout
        return view('customer.checkout', compact('selectedProducts', 'subtotalProd'));
    }
}

