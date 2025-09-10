<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomersSeeder extends Seeder
{
    public function run()
    {
        DB::table('customers')->insert([
            [
                'nama' => 'Adit',
                'email' => 'aditGanteng@example.com',
                'no_hp' => '081234567891',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nama' => 'Shin tae Yong',
                'email' => 'Shin@example.com',
                'no_hp' => '081234567892',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
