<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDiskonTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('diskon', function (Blueprint $table) {
            // Hapus kolom BarangID
            $table->dropForeign(['BarangID']); // Jika ada foreign key
            $table->dropColumn('BarangID');

            // Tambahkan kolom nama_diskon
            $table->string('nama_diskon')->nullable()->after('DiskonID');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('diskon', function (Blueprint $table) {
            // Tambahkan kembali kolom BarangID
            $table->unsignedBigInteger('BarangID')->nullable()->after('DiskonID');

            // Tambahkan kembali foreign key
            $table->foreign('BarangID')->references('BarangID')->on('barang')->onDelete('cascade');

            // Hapus kolom nama_diskon
            $table->dropColumn('nama_diskon');
        });
    }
}
