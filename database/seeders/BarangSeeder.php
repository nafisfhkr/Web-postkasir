<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run()
    {
        DB::table('barang')->insert([
            [
                'Nama_barang' => 'Macbook Pro',
                'kategoriID' => 1,
                'Harga_jual' => 15000000.00,
                'Harga_dasar' => 10000000.00,
                'Stok' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Nama_barang' => 'Kemeja Uniqlo',
                'kategoriID' => 2,
                'Harga_jual' => 200000.00,
                'Harga_dasar' => 100000.00,
                'Stok' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
