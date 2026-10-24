<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    // ==========================================
    // LETAK PENAMBAHAN / PENGECEKAN CODE ($fillable)
    // Pastikan semua kolom ini ada agar diizinkan masuk
    // ==========================================
    protected $fillable = [
        'invoice_number',
        'customer_id',
        'user_id',
        'store_id',
        'product_id',
        'quantity',
        'total_amount',
        'total_price',
        'shipping_address',
        'payment_method',
        'status',
    ];

    /**
     * Relasi ke Model User / Pelanggan
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'customer_id')->withDefault([
            'name' => 'Guest',
        ]);
    }

    /**
     * Alias relasi customer (mengarah ke customer_id)
     */
    public function customer()
    {
        return $this->belongsTo(User::class, 'customer_id')->withDefault([
            'name' => 'Guest',
        ]);
    }

    /**
     * Relasi ke Model Product
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class, 'order_id');
    }

    /**
     * Relasi ke Model Store / Toko
     */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    /**
     * Relasi ke OrderItem (jika sistem menggunakan tabel detail transaksi)
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id');
    }
}