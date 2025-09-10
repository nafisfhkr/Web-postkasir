<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    public function run()
    {
        DB::table('supplier')->insert([
            [
                'Nama' => 'Mark',
                'Alamat' => 'Jl. Imam Bonjol No.1',
                'Kontak' => '081234567893',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Nama' => 'Cak Imin',
                'Alamat' => 'Jl. Mangkualam No.2',
                'Kontak' => '081234567894',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
