<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PoliSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        $polis = [
            [
                'nama_poli' => 'Poli Umum',
                'keterangan' => 'Pelayanan kesehatan umum untuk berbagai keluhan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_poli' => 'Poli Gigi',
                'keterangan' => 'Pelayanan kesehatan gigi dan mulut',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_poli' => 'Poli Anak',
                'keterangan' => 'Pelayanan kesehatan khusus untuk anak-anak',
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama_poli' => 'Poli Mata',
                'keterangan' => 'Pelayanan kesehatan mata dan penglihatan',
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        DB::table('polis')->insert($polis);
    }
}