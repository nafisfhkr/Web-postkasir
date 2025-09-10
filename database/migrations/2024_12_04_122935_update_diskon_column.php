<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateDiskonColumn extends Migration
{
    public function up()
    {
        // Hapus kolom diskon dari tabel detail_transaksi
        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->dropColumn('diskon');
        });

        // Tambahkan kolom diskon ke tabel transaksi
        Schema::table('transactions', function (Blueprint $table) {
            $table->decimal('diskon', 5, 2)->default(0)->after('total_harga');
        });
    }

    public function down()
    {
        // Kembalikan perubahan jika rollback dilakukan
        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->decimal('diskon', 5, 2)->default(0);
        });

        Schema::table('transactions', function (Blueprint $table) {
            $table->dropColumn('diskon');
        });
    }
}

