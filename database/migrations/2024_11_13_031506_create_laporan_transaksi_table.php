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
        Schema::create('laporan_transaksi', function (Blueprint $table) {
            $table->id('laporan_transaksiID');
            $table->date('tanggal');
            $table->integer('total_transaksi');
            $table->decimal('total_pendapatan', 15, 2);
            $table->decimal('jumlah_diskon', 15, 2);
            $table->unsignedBigInteger('penggunaID');
            $table->foreign('penggunaID')->references('id')->on('pengguna')->onDelete('cascade');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('laporan_transaksi');
    }
};
