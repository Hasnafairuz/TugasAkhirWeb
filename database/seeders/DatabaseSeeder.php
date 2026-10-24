<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Store;
use App\Models\Product;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat Akun Admin
        User::updateOrCreate(
            ['email' => 'admin@maison.com'],
            [
                'name' => 'Admin Maison',
                'password' => bcrypt('admin123'),
                'role' => 'admin'
                ]
                );

        // 2. Buat Akun Seller & Toko
        $seller = User::updateOrCreate(
            ['email' => 'seller@maison.com'],
            [
                'name' => 'Toko Jenrina',
                'password' => bcrypt('seller123'),
                'role' => 'seller'
            ]
        );

        // 3. Buat Akun Customer
        User::updateOrCreate(
            ['email' => 'customer@maison.com'],
            [
                'name' => 'Pelanggan',
                'password' => bcrypt('customer123'),
                'role' => 'customer'
                ]
                ); 


        $store = Store::create([
            'user_id'     => $seller->id,
            'store_name'  => 'Maison De Jenrina Official',
            'description' => 'Boutique fashion wanita gaya Prancis & Korea.',
        ]);

        // 3. Seed Produk Pakaian Lengkap dengan Kolom 'colors' dan 'size'
        $products = [
            [
                'name'        => 'SweatPants Highwaist Ruffle Layer',
                'category'    => 'Teen Fashion',
                'colors'      => 'Cokelat, Hitam',
                'size'        => null,
                'price'       => 109000,
                'stock'       => 238,
                'description' => 'Celana sweatpants highwaist dengan aksen layer ruffle yang elegan.',
            ],
            [
                'name'        => 'Piyama Set Bow-knot',
                'category'    => 'Loungewear',
                'colors'      => 'Cream, Off White',
                'size'        => null,
                'price'       => 89000,
                'stock'       => 855,
                'description' => 'Setelan piyama lembut beraksen pita manis untuk tidur makin nyaman.',
            ],
            [
                'name'        => 'One Set Salt Bread - Setelan Piyama Kaos',
                'category'    => 'Loungewear',
                'colors'      => 'Biru Muda, Soft Yellow',
                'size'        => null,
                'price'       => 60000,
                'stock'       => 1800,
                'description' => 'Setelan santai bahan kaos katun dingin dengan motif Salt Bread lucu.',
            ],
            [
                'name'        => 'Piyama Wanita Nawon Sleepwear',
                'category'    => 'Loungewear',
                'colors'      => 'Hitam, Navy',
                'size'        => null,
                'price'       => 79000,
                'stock'       => 960,
                'description' => 'Baju tidur eksklusif bahan adem gaya minimalis.',
            ],
        ];

        foreach ($products as $item) {
            Product::create([
                'store_id'    => $store->id,
                'name'        => $item['name'],
                'category'    => $item['category'],
                'colors'      => $item['colors'],
                'size'        => $item['size'],
                'price'       => $item['price'],
                'stock'       => $item['stock'],
                'description' => $item['description'],
                'image'       => 'products/default.jpg',
            ]);
        }
    }
}