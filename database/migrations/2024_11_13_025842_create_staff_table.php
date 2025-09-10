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
        Schema::create('staff', function (Blueprint $table) {
            $table->id('StaffID');
            $table->unsignedBigInteger('penggunaID');
            $table->foreign('penggunaID')->references('id')->on('pengguna')->onDelete('cascade'); // Sesuaikan kolom referensi
            $table->string('alamat');
            $table->string('foto')->nullable();
            $table->string('Jabatan');
            $table->decimal('Gaji', 15, 2);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('staff');
    }
};
