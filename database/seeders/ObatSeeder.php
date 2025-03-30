<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ObatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $obats = [
            [
                'nama_obat' => 'Paracetamol',
                'kemasan' => 'Strip 10 tablet',
                'harga' => 5000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Amoxicillin',
                'kemasan' => 'Strip 8 kapsul',
                'harga' => 12000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Ibuprofen',
                'kemasan' => 'Strip 10 tablet',
                'harga' => 8000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Cetirizine',
                'kemasan' => 'Strip 10 tablet',
                'harga' => 15000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Omeprazole',
                'kemasan' => 'Strip 10 kapsul',
                'harga' => 18000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Metformin',
                'kemasan' => 'Botol 100 tablet',
                'harga' => 35000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Simvastatin',
                'kemasan' => 'Botol 30 tablet',
                'harga' => 45000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Ciprofloxacin',
                'kemasan' => 'Strip 10 tablet',
                'harga' => 22000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Loratadine',
                'kemasan' => 'Strip 10 tablet',
                'harga' => 12500,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Lansoprazole',
                'kemasan' => 'Strip 10 kapsul',
                'harga' => 24000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Diazepam',
                'kemasan' => 'Strip 10 tablet',
                'harga' => 30000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Ranitidine',
                'kemasan' => 'Botol 50 tablet',
                'harga' => 28000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Metronidazole',
                'kemasan' => 'Strip 10 tablet',
                'harga' => 15000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Ceftriaxone',
                'kemasan' => 'Vial 1 gram',
                'harga' => 65000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_obat' => 'Aspirin',
                'kemasan' => 'Botol 100 tablet',
                'harga' => 20000,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('obats')->insert($obats);
    }
}