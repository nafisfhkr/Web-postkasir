<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DiskonSeeder extends Seeder
{
    public function run()
    {
        DB::table('diskon')->insert([
            [
                'nama_diskon' => 'Diskon Akhir Tahun',  // Nama diskon
                'besar_diskon' => 10.00,            // Diskon 10%
                'jangka_waktu' => 30,               // Berlaku selama 30 hari
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama_diskon' => 'Diskon Ulang Tahun Owner',  // Nama diskon
                'besar_diskon' => 15.00,            // Diskon 15%
                'jangka_waktu' => 15,               // Berlaku selama 15 hari
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
