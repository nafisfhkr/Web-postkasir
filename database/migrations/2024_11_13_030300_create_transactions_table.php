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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('TransaksiID');
        
            // Pastikan foreign key merujuk ke kolom `penggunaID` pada tabel `pengguna`
            $table->unsignedBigInteger('penggunaID');
            $table->foreign('penggunaID')->references('id')->on('pengguna')->onDelete('cascade');
        
            $table->unsignedBigInteger('StaffID');
            $table->foreign('StaffID')->references('StaffID')->on('staff')->onDelete('cascade');
        
            $table->unsignedBigInteger('CustomerID')->nullable();
            $table->foreign('CustomerID')->references('CustomerID')->on('customers')->onDelete('set null');
        
            $table->date('Tanggal_transaksi');
            $table->decimal('total_harga', 15, 2);
            $table->string('metode_pembayaran');
            $table->timestamps();
        });
        
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
