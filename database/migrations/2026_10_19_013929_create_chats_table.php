<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('chats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Pengirim (Customer)
            $table->foreignId('product_id')->nullable()->constrained()->onDelete('set null'); // Produk yang ditanyakan
            $table->text('message'); // Isi pesan
            $table->enum('sender_role', ['customer', 'admin'])->default('customer');
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('chats');
    }
};