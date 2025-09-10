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
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id('detailID');

            
            $table->unsignedBigInteger('TransaksiID');
            $table->foreign('TransaksiID')->references('TransaksiID')->on('transactions')->onDelete('cascade');

            // Define `BarangID` as unsignedBigInteger and add foreign key constraint explicitly
            $table->unsignedBigInteger('BarangID');
            $table->foreign('BarangID')->references('BarangID')->on('barang')->onDelete('cascade');

            // Define other columns
            $table->integer('Jumlah_barang');
            $table->decimal('harga_satuan', 15, 2);
            $table->decimal('Subtotal', 15, 2);
            $table->timestamps();

            // Optional: Adding indexes for performance
            $table->index('TransaksiID');
            $table->index('BarangID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transactions');
    }
};
