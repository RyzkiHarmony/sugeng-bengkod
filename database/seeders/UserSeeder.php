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
                'nama' => 'Admin Sugeng',
                'alamat' => 'Jl. Kesehatan No. 5, Pemalang',
                'no_hp' => '085700704667',
                'no_ktp' => '3201234567892345789',
                'no_rm' => null,
                'id_poli' => null,
                'role' => 'admin',
                'email' => 'sugeng@admin.com',
                'email_verified_at' => $now,
                'password' => Hash::make('admin123'),
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Dr. Andi',
                'alamat' => 'Jl. Kesehatan No. 5, Bandung',
                'no_hp' => '081234567891',
                'no_ktp' => '3201234567890001',
                'no_rm' => null,
                'id_poli' => 1, 
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
                'no_ktp' => '3201234567890002',
                'no_rm' => null,
                'id_poli' => 2, 
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
                'no_ktp' => '3301234567890001',
                'no_rm' => '202411001', 
                'id_poli' => null,
                'role' => 'pasien',
                'email' => 'rizki@pasien.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => null,
                'created_at' => Carbon::create(2024, 11, 1), 
                'updated_at' => Carbon::create(2024, 11, 1),
            ],
            [
                'nama' => 'Harmony',
                'alamat' => 'Jl. Sehat No. 20, Semarang',
                'no_hp' => '081234567894',
                'no_ktp' => '3301234567890002',
                'no_rm' => '202411002', 
                'id_poli' => null,
                'role' => 'pasien',
                'email' => 'harmony@pasien.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => null,
                'created_at' => Carbon::create(2024, 11, 2), 
                'updated_at' => Carbon::create(2024, 11, 2),
            ],
            [
                'nama' => 'Siti',
                'alamat' => 'Jl. Mawar No. 25, Jakarta',
                'no_hp' => '081234567895',
                'no_ktp' => '3101234567890001',
                'no_rm' => null, 
                'id_poli' => null,
                'role' => 'pasien',
                'email' => 'siti@pasien.com',
                'email_verified_at' => $now,
                'password' => Hash::make('password123'),
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Admin System',
                'alamat' => 'Jl. Admin No. 1, Jakarta',
                'no_hp' => '081234567890',
                'no_ktp' => '3101234567890000',
                'no_rm' => null, 
                'id_poli' => null,
                'role' => 'admin',
                'email' => 'admin@system.com',
                'email_verified_at' => $now,
                'password' => Hash::make('admin123'),
                'remember_token' => null,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('users')->insert($users);
    }
}