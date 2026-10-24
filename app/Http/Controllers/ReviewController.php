<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Menyimpan ulasan produk dari pelanggan
     */
    public function store(Request $request)
    {
        // 1. Validasi Input Ulasan
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'order_id'   => 'nullable',
            'rating'     => 'required|integer|min:1|max:5',
            'comment'    => 'required|string|max:1000',
        ]);

        // 2. Simpan Ulasan ke Database
        Review::create([
            'user_id'    => auth()->id(),
            'product_id' => $request->product_id,
            'order_id'   => $request->order_id,
            'rating'     => $request->rating,
            'comment'    => $request->comment,
        ]);

        // 3. Kembali ke Halaman Pusat Pesanan dengan Pesan Sukses
        return back()->with('success', 'Ulasan Anda berhasil dikirim! Terima kasih atas masukkannya.');
    }
}