<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;

class ChatController extends Controller 
{
    // Menyimpan pesan dari customer di halaman produk
    public function store(Request $request, $productId) 
    {
        if (!auth()->check()) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu untuk mengirim pesan.');
        }

        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Chat::create([
            'user_id'     => auth()->id(),
            'product_id'  => $productId,
            'message'     => $request->message,
            'sender_role' => 'customer',
        ]);

        return redirect()->back()->with('success', 'Pesan Anda berhasil terkirim ke Admin/Seller!');
    }

    // Membalas pesan oleh admin/seller
    public function reply(Request $request, $userId) 
    {
        $request->validate([
            'message' => 'required|string|max:1000',
        ]);

        Chat::create([
            'user_id'     => $userId,
            'product_id'  => null,
            'message'     => $request->message,
            'sender_role' => 'admin',
        ]);

        return redirect()->back()->with('success', 'Balasan berhasil dikirim.');
    }
}