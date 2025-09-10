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
        Schema::create('piutang', function (Blueprint $table) {
            $table->id('piutangID');
            $table->unsignedBigInteger('CustomerID');
            $table->unsignedBigInteger('TransaksiID');
            $table->date('Tanggal_piutang');
            $table->date('Jatuh_tempo');
            $table->decimal('Total_piutang', 15, 2);
            $table->string('Status_Pembayaran');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('CustomerID')->references('CustomerID')->on('customers')->onDelete('cascade');
            $table->foreign('TransaksiID')->references('TransaksiID')->on('transactions')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('piutang');
    }
};

