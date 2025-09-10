<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LaporanKeuanganSeeder extends Seeder
{
    public function run()
    {
        DB::table('laporan_keuangan')->insert([
            [
                'Periode_awal' => now()->subMonths(2),
                'Periode_akhir' => now()->subMonth(),
                'total_pemasukan' => 20000000.00,
                'total_pengeluaran' => 15000000.00,
                'laba_bersih' => 5000000.00,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
