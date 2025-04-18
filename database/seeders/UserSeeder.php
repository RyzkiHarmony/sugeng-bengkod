<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $users = [
            [
                'nama' => 'Dr. Andi',
                'alamat' => 'Jl. Kesehatan No. 5, Bandung',
                'no_hp' => '081234567891',
                'role' => 'dokter',
                'email' => 'andi@dokter.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Dr. Budi',
                'alamat' => 'Jl. Farmasi No. 10, Surabaya',
                'no_hp' => '081234567892',
                'role' => 'dokter',
                'email' => 'budi@dokter.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Rizki',
                'alamat' => 'Jl. Perawat No. 15, Yogyakarta',
                'no_hp' => '081234567893',
                'role' => 'pasien',
                'email' => 'rizki@pasien.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Harmony',
                'alamat' => 'Jl. Sehat No. 20, Semarang',
                'no_hp' => '081234567894',
                'role' => 'pasien',
                'email' => 'harmony@pasien.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('users')->insert($users);
    }
}