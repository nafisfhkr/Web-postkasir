<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierBarangSeeder extends Seeder
{
    public function run()
    {
        DB::table('supplier_barang')->insert([
            [
                'BarangID' => 1,
                'SuplierID' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'BarangID' => 2,
                'SuplierID' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
