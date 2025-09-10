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
        Schema::create('diskon', function (Blueprint $table) {
            $table->id('DiskonID');
            $table->unsignedBigInteger('BarangID');
            $table->foreign('BarangID')->references('BarangID')->on('barang')->onDelete('cascade');
            $table->decimal('besar_diskon', 5, 2);
            $table->integer('jangka_waktu');
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('diskon');
    }
};
