<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PenggunaSeeder extends Seeder
{
    public function run()
    {
        DB::table('pengguna')->insert([
            [
                'Nama' => 'Zulham',
                'Password' => Hash::make('ownerpassword'),
                'Code_referral' => null,
                'Role' => 'Owner',
                'Email' => 'admin@example.com',
                'No_hp' => '081234567890',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'Nama' => 'Sugeng',
                'Password' => Hash::make('Kasirpassword'),
                'Code_referral' => 'REF12345',
                'Role' => 'Kasir',
                'Email' => 'user@example.com',
                'No_hp' => '081987654321',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
