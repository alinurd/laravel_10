<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('client_products', function (Blueprint $table) {
            $table->id(); // Primary Key
            $table->unsignedBigInteger('pt_id'); // ID Perusahaan
            $table->unsignedBigInteger('pic_id'); // ID PIC
            $table->string('direktur', 150); // Nama Direktur
            $table->string('product', 150); // Nama Produk
            $table->string('jenis', 100); // Jenis Produk
            $table->text('spesifikasi')->nullable(); // Spesifikasi Produk
            $table->string('sut', 100)->nullable(); // Standard Usage Terms
            $table->string('merk', 100)->nullable(); // Merek Produk
            $table->string('code_hs', 50)->nullable(); // Kode HS
            $table->string('status', 50)->default('active'); // Status Produk
            $table->timestamps(); // Created at & Updated at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_products');
    }
};
