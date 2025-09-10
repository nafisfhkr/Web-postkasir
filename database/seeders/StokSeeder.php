<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run()
    {
        DB::table('stok')->insert([
            [
                'BarangID' => 1,
                'Tanggal' => now()->subDays(10),
                'Jumlah' => 15,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'BarangID' => 2,
                'Tanggal' => now()->subDays(8),
                'Jumlah' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
