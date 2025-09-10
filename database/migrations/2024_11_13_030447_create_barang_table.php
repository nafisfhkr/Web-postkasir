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
        Schema::create('barang', function (Blueprint $table) {
            $table->id('BarangID');
            $table->string('Nama_barang');
            $table->unsignedBigInteger('kategoriID');
            $table->foreign('kategoriID')->references('kategoriID')->on('kategori')->onDelete('cascade');
            $table->decimal('Harga_jual', 15, 2);
            $table->decimal('Harga_dasar', 15, 2);
            $table->integer('Stok');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};
