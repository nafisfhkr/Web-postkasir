<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHutangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hutang', function (Blueprint $table) {
            $table->id('hutangID');
            $table->unsignedBigInteger('SuplierID');
            $table->date('Tanggal_hutang');
            $table->date('Jatuh_tempo');
            $table->decimal('Total_hutang', 15, 2);
            $table->string('Status Pembayaran');
            $table->timestamps();

            $table->foreign('SuplierID')->references('SuplierID')->on('supplier')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hutang');
    }
}

