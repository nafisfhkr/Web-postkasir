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
        Schema::create('pengguna', function (Blueprint $table) {
            $table->id('id'); // Menggunakan 'penggunaID' sebagai primary key
            $table->string('Nama');
            $table->string('Password');
            $table->string('Code_referral')->nullable();
            $table->string('Role');
            $table->string('Email')->unique();
            $table->string('No_hp');
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengguna');
    }
};
