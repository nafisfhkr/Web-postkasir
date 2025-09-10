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
        Schema::table('supplier_barang', function (Blueprint $table) {
            $table->unsignedBigInteger('BarangID');
            $table->foreign('BarangID')->references('BarangID')->on('barang')->onDelete('cascade');
        
            $table->unsignedBigInteger('SuplierID');
            $table->foreign('SuplierID')->references('SuplierID')->on('supplier')->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('supplier_barang', function (Blueprint $table) {
            $table->dropForeign(['BarangID']);
            $table->dropColumn('BarangID');

            $table->dropForeign(['SuplierID']);
            $table->dropColumn('SuplierID');
        });
    }
};
