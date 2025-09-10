<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('barang', function (Blueprint $table) {
            if (!Schema::hasColumn('barang', 'show_in_transaction')) {
                $table->boolean('show_in_transaction')->default(true);
            }
            if (!Schema::hasColumn('barang', 'use_stock')) {
                $table->boolean('use_stock')->default(true);
            }
            if (!Schema::hasColumn('barang', 'code')) {
                $table->string('code')->nullable();
            }
            if (!Schema::hasColumn('barang', 'kategori')) {
                $table->string('kategori')->nullable();
            }
            if (!Schema::hasColumn('barang', 'foto')) {
                $table->string('foto')->nullable();
            }
        });
    }
    


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('barang', function (Blueprint $table) {
            $table->dropColumn(['show_in_transaction', 'use_stock', 'code', 'kategori', 'foto']);
        });
    }
    
};
