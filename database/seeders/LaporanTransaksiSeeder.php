<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanTransaksiSeeder extends Seeder
{
    public function run()
    {
        DB::table('laporan_transaksi')->insert([
            [
                'tanggal' => now()->subMonth(),
                'total_transaksi' => 20,
                'total_pendapatan' => 10000000.00,
                'jumlah_diskon' => 500000.00,
                'penggunaID' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'tanggal' => now()->subDays(15),
                'total_transaksi' => 10,
                'total_pendapatan' => 7500000.00,
                'jumlah_diskon' => 300000.00,
                'penggunaID' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
