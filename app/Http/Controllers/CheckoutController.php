<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Cart;

class CheckoutController extends Controller
{
    // Menampilkan halaman form checkout untuk Beli Langsung
    public function process(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $color = $request->input('color');
        $size = $request->input('size');
        $quantity = $request->input('quantity', 1);

        return view('customer.checkout', compact('product', 'color', 'size', 'quantity'));
    }

    // Menampilkan halaman form checkout dari Keranjang Belanja
    public function cartCheckout()
    {
        $checkoutItems = Cart::where('user_id', auth()->id())->with('product')->get();

        return view('customer.checkout', compact('checkoutItems'));
    }

    // Menyimpan pesanan dan mengurangi stok secara otomatis
    public function storeOrder(Request $request, $id = null)
    {
        // 1. Validasi data form checkout
        $request->validate([
            'customer_name'    => 'required|string|max:255',
            'phone'            => 'required|string|max:20',
            'shipping_address' => 'required|string',
            'payment_method'   => 'required|string',
            'quantity'         => 'nullable|integer|min:1',
        ]);

        $quantity = $request->input('quantity', 1);

        // 2. Cek apakah pembelian dari Beli Langsung ($id ada) atau dari Keranjang
        if ($id) {
            $product = Product::findOrFail($id);

            // Validasi ketersediaan stok
            if ($product->stock < $quantity) {
                return back()->withErrors(['stock' => 'Stok produk tidak mencukupi! Sisa stok: ' . $product->stock]);
            }

            // Kurangi stok produk secara otomatis di database
            $product->decrement('stock', $quantity);

            // Hitung total harga (memperhitungkan diskon jika ada)
            $pricePerItem = ($product->discount_price && $product->discount_price < $product->price) 
                            ? $product->discount_price 
                            : $product->price;

            // Simpan pesanan ke database
            Order::create([
                'user_id'          => auth()->id(),
                'product_id'       => $product->id,
                'customer_name'    => $request->customer_name,
                'phone'            => $request->phone,
                'shipping_address' => $request->shipping_address,
                'payment_method'   => $request->payment_method,
                'quantity'         => $quantity,
                'total_price'      => $pricePerItem * $quantity,
                'status'           => 'Pending',
            ]);

        } else {
            // Jika checkout dari keranjang belanja
            $cartItems = Cart::where('user_id', auth()->id())->with('product')->get();
            
            if ($cartItems->isEmpty()) {
                return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
            }

            foreach ($cartItems as $item) {
                if ($item->product) {
                    // Validasi stok per item keranjang
                    if ($item->product->stock < $item->quantity) {
                        return back()->withErrors(['stock' => 'Stok untuk produk "' . $item->product->name . '" tidak mencukupi!']);
                    }

                    // Kurangi stok masing-masing produk
                    $item->product->decrement('stock', $item->quantity);

                    $pricePerItem = ($item->product->discount_price && $item->product->discount_price < $item->product->price) 
                                    ? $item->product->discount_price 
                                    : $item->product->price;

                    // Buat pesanan untuk setiap item di keranjang
                    Order::create([
                        'user_id'          => auth()->id(),
                        'product_id'       => $item->product_id,
                        'customer_name'    => $request->customer_name,
                        'phone'            => $request->phone,
                        'shipping_address' => $request->shipping_address,
                        'payment_method'   => $request->payment_method,
                        'quantity'         => $item->quantity,
                        'total_price'      => $pricePerItem * $item->quantity,
                        'status'           => 'Pending',
                    ]);
                }
            }

            // Kosongkan keranjang setelah berhasil *checkout*
            Cart::where('user_id', auth()->id())->delete();
        }

        // 3. Arahkan ke halaman riwayat pesanan pelanggan dengan pesan sukses
        return redirect()->route('customer.orders')->with('success', 'Pesanan berhasil dibuat dan stok produk telah diperbarui!');
    }
}