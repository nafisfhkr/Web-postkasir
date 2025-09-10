<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StaffSeeder extends Seeder
{
    public function run()
    {
        DB::table('staff')->insert([
            [
                'penggunaID' => 1,
                'alamat' => 'Jl. A.Yani No 22',
                'foto' => null,
                'Jabatan' => 'Owner',
                'Gaji' => 10000000.00,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'penggunaID' => 2,
                'alamat' => 'Jl. Nurdin Pasamba No 12',
                'foto' => null,
                'Jabatan' => 'Staff',
                'Gaji' => 5000000.00,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
