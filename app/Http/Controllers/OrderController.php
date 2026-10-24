<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\Cart;
use App\Models\Product;
use App\Models\Review;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str; 

class OrderController extends Controller
{
    // 1. Halaman Ringkasan Checkout (Mendukung Beli Langsung & Keranjang)
    public function checkout(Request $request, $id = null)
    {
        $checkoutItems = [];

        // 1. Jika ada ID (artinya dari tombol Beli Langsung)
        if ($id) {
            $product = Product::findOrFail($id);
            $qty = $request->input('quantity', 1);
            $color = $request->input('color', null);
            $size = $request->input('size', null);

            // Menentukan harga final (cek diskon otomatis)
            $finalPrice = ($product->discount_price && $product->discount_price < $product->price) 
                            ? $product->discount_price 
                            : $product->price;

            $checkoutItems[$product->id] = [
                'name'     => $product->name,
                'price'    => $finalPrice, 
                'quantity' => $qty,
                'image'    => $product->image,
                'store_id' => $product->store_id ?? 1,
                'color'    => $color,
                'size'     => $size,
            ];

            session()->put('checkout_direct', $checkoutItems);
        } 
        else {
            // 2. Jika dari Keranjang Belanja, ambil dari database tabel carts milik user yang login
            $cartDatabaseItems = Cart::where('user_id', auth()->id())->with('product')->get();
            
            if ($cartDatabaseItems->isNotEmpty()) {
                foreach ($cartDatabaseItems as $cartItem) {
                    $product = $cartItem->product;

                    if (!$product) continue;

                    // Menentukan harga final (cek diskon otomatis untuk setiap produk di keranjang)
                    $finalPrice = ($product->discount_price && $product->discount_price < $product->price) 
                                    ? $product->discount_price 
                                    : $product->price;

                    $checkoutItems[$product->id] = [
                        'name'     => $product->name,
                        'price'    => $finalPrice, 
                        'quantity' => $cartItem->quantity,
                        'image'    => $product->image,
                        'store_id' => $product->store_id ?? 1,
                        'color'    => $cartItem->color,
                        'size'     => $cartItem->size,
                    ];
                }
            } else {
                // Cadangan jika tersimpan di sesi direct
                $checkoutItems = session()->get('checkout_direct', []);
            }
        }

        if (empty($checkoutItems)) {
            return redirect()->route('customer.dashboard')->with('error', 'Keranjang belanja Anda kosong.');
        }

        return view('customer.checkout', compact('checkoutItems'));
    }

   
    // 2. Memproses Simpan Transaksi ke Database / Midtrans
    public function processOrder(Request $request)
    {
        // 1. Validasi input form checkout
        $request->validate([
            'recipient_name' => 'required|string|max:255',
            'phone'          => 'required|string|max:20',
            'address'        => 'required|string',
            'shipping_fee'   => 'required|numeric',
            'payment_method' => 'required|string',
        ]);

        // 2. Ambil data item keranjang milik user beserta relasi produknya
        $cartItems = Cart::with('product')->where('user_id', auth()->id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // 3. CEK KECUKUPAN STOK TERLEBIH DAHULU (Mencegah Overselling)
        foreach ($cartItems as $item) {
            if (!$item->product) continue;

            if ($item->product->stock < $item->quantity) {
                return redirect()->route('cart.index')->with('error', 'Stok untuk produk "' . $item->product->name . '" tidak mencukupi. Tersisa: ' . $item->product->stock);
            }
        }

        // 4. Hitung Total Keseluruhan Belanjaan
        $subtotal = 0;
        foreach ($cartItems as $item) {
            if (!$item->product) continue;
            $price = ($item->product->discount_price && $item->product->discount_price < $item->product->price)
                     ? $item->product->discount_price
                     : $item->product->price;
            $subtotal += ($price * $item->quantity);
        }

        $grandTotal = $subtotal + $request->shipping_fee;
        $firstItem  = $cartItems->first();

        // 5. BUAT 1 HEADER TRANSACTION (ORDER UTAMA / 1 RESI)
        $order = Order::create([
            'user_id'          => auth()->id(),
            'customer_id'      => auth()->id(),
            'store_id'         => $firstItem->product->store_id ?? 1,
            'product_id'       => $firstItem->product_id, // Opsional / produk acuan utama
            'quantity'         => $cartItems->sum('quantity'),
            'total_price'      => $grandTotal,
            'total_amount'     => $grandTotal,
            'payment_method'   => $request->payment_method,
            'shipping_address' => $request->address,
            'status'           => 'Pending', 
            'invoice_number'   => 'INV-' . date('Ymd') . '-' . strtoupper(Str::random(4)),
        ]);

        // 6. SIMPAN SEMUA ITEM KERANJANG KE TABEL ORDER_ITEMS & POTONG STOK
        foreach ($cartItems as $item) {
            if (!$item->product) continue;

            $productPrice = ($item->product->discount_price && $item->product->discount_price < $item->product->price)
                            ? $item->product->discount_price
                            : $item->product->price;

            \App\Models\OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $item->product_id,
                'quantity'   => $item->quantity,
                'price'      => $productPrice,
            ]);

            // KURANGI STOK PRODUK OTOMATIS
            $item->product->decrement('stock', $item->quantity);
        }

        // 7. Bersihkan keranjang belanja setelah berhasil membuat pesanan
        Cart::where('user_id', auth()->id())->delete();

        // 8. Arahkan ke Pusat Pesanan
        return redirect()->route('customer.orders')->with('success', 'Pesanan Anda berhasil dibuat dan dijadikan dalam 1 Invoice Resi!');
    }

    // 3. Menampilkan Daftar Pesanan Customer (Pusat Pesanan dengan Filter Tab yang Akurat)
    public function myOrders(Request $request)
    {
        $query = Order::with(['orderItems.product', 'product', 'review'])->where('user_id', auth()->id());

        // Filter berdasarkan status tab
        if ($request->has('status') && $request->status != '') {
            $statusTab = $request->status;

            if ($statusTab == 'unpaid') {
                // Menangkap status Pending atau unpaid
                $query->whereIn('status', ['Pending', 'unpaid']);
            } elseif ($statusTab == 'paid') {
                // Menangkap status paid / perlu dikirim
                $query->where('status', 'paid');
            } elseif ($statusTab == 'shipped') {
                // Menangkap status shipped / akan diterima
                $query->where('status', 'shipped');
            } elseif ($statusTab == 'completed') {
                // Menangkap status completed / perlu diulas (selesai)
                $query->where('status', 'completed');
            } elseif ($statusTab == 'returned') {
                // Menangkap status returned / pengembalian barang
                $query->where('status', 'returned');
            } else {
                $query->where('status', $statusTab);
            }
        }

        $orders = $query->latest()->get();

        return view('customer.orders', compact('orders'));
    }

    // 4. Unduh Invoice PDF
    public function downloadPdf($id)
    {
        // Panggil relasi orderItems.product agar bisa merender seluruh barang yang dibeli
        $order = Order::with(['orderItems.product', 'product', 'user'])->findOrFail($id);

        return view('pdf.invoice', compact('order'));
    }

    // 5. Hapus Pesanan dari Riwayat
    public function destroy($id)
    {
        $order = Order::findOrFail($id);
        $order->delete();

        return back()->with('success', 'Transaksi berhasil dihapus.');
    }
    
    // 6. Method Update Status
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,unpaid,paid,shipped,completed,cancelled,returned',
        ]);

        $order = Order::findOrFail($id);
        // Jika admin mengklik 'unpaid', simpan sebagai 'Pending' agar cocok dengan ENUM database
        $order->status = ($request->status == 'unpaid') ? 'Pending' : $request->status;
        $order->save();

        return back()->with('success', 'Status pesanan berhasil diperbarui menjadi ' . ucfirst($request->status));
    }

    public function reviewsIndex()
{
    // Mengambil seluruh ulasan pelanggan beserta relasi user dan produknya
    $reviews = Review::with(['user', 'product'])->latest()->get();

    return view('admin.reviews', compact('reviews'));
}

public function showCustomerOrderDetail($id)
{
    // Mengambil data pesanan milik user yang sedang login beserta item & produknya
    $order = Order::with(['orderItems.product', 'product'])
                ->where('id', $id)
                ->where('user_id', auth()->id())
                ->firstOrFail();

    return view('customer.orders_detail', compact('order'));
}
    // ==========================================
    // ADMIN: Menampilkan Daftar Semua Pesanan Masuk
    // ==========================================
    public function adminOrdersIndex(Request $request)
    {
        // Load relasi orderItems.product agar data semua produk dalam 1 transaksi terbawa ke view admin
        $orders = Order::with(['orderItems.product', 'user', 'store', 'product'])->latest()->paginate(10);

        return view('admin.orders', compact('orders'));
    }
}