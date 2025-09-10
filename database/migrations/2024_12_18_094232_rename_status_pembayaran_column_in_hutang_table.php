<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('hutang', function (Blueprint $table) {
            $table->renameColumn('Status Pembayaran', 'Status_Pembayaran');
        });
    }

    public function down()
    {
        Schema::table('hutang', function (Blueprint $table) {
            $table->renameColumn('Status_Pembayaran', 'Status Pembayaran');
        });
    }
};
