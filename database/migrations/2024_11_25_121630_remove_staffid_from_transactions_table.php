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
        Schema::table('transactions', function (Blueprint $table) {
            // Hapus foreign key StaffID
            $table->dropForeign(['StaffID']); // Pastikan nama kolom sesuai dengan migration awal
            
            // Hapus kolom StaffID
            $table->dropColumn('StaffID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('transactions', function (Blueprint $table) {
            // Tambahkan kembali kolom StaffID
            $table->unsignedBigInteger('StaffID');
            $table->foreign('StaffID')->references('StaffID')->on('staff')->onDelete('cascade');
        });
    }
};
