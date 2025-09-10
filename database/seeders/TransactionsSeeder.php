<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransactionsSeeder extends Seeder
{
    public function run()
    {
        DB::table('transactions')->insert([
            [
                'penggunaID' => 1,
                'CustomerID' => 1,
                'Tanggal_transaksi' => now()->subDays(5),
                'total_harga' => 500000.00,
                'metode_pembayaran' => 'Cash',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'penggunaID' => 2,
                'CustomerID' => 2,
                'Tanggal_transaksi' => now()->subDays(3),
                'total_harga' => 750000.00,
                'metode_pembayaran' => 'Credit Card',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
