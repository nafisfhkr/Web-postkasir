<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetailTransactionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('detail_transactions')->insert([
            [
                'TransaksiID' => 1,
                'BarangID' => 1,
                'Jumlah_barang' => 2,
                'harga_satuan' => 15000000.00,
                'Subtotal' => 30000000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'TransaksiID' => 2,
                'BarangID' => 2,
                'Jumlah_barang' => 3,
                'harga_satuan' => 200000.00,
                'Subtotal' => 600000.00,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
