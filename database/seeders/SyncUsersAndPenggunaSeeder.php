<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Pengguna;

class SyncUsersAndPenggunaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user dari tabel users
        $users = User::all();

        foreach ($users as $user) {
            // Periksa apakah pengguna sudah ada
            $pengguna = Pengguna::where('user_id', $user->id)->first();

            if (!$pengguna) {
                // Jika belum ada, buat entri baru di tabel pengguna
                Pengguna::create([
                    'user_id' => $user->id,
                    'Nama' => $user->name,
                    'Password' => $user->password,
                    'Email' => $user->email,
                    'Role' => 'Default Role', // Ubah sesuai kebutuhan
                    'No_hp' => '0000000000',  // Isi default atau ubah jika tersedia
                ]);
            }
        }
    }
}
