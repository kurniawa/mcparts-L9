<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TsixpackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tsixpack = [[
            'nama' => 'T.Sixpack + Busa + jht.Univ',
            'id' => 1,
            'tipe_bahan' => 'A',
            'harga' => 25500
        ], [
            'nama' => 'T.Sixpack uk.JB + Busa + jht.JB',
            'id' => 2,
            'tipe_bahan' => 'A',
            'harga' => 30000
        ], [
            'nama' => 'T.Sixpack uk.JB + Busa + jht.NMAX',
            'id' => 3,
            'tipe_bahan' => 'A',
            'harga' => 33000
        ]];

        for ($i = 0; $i < count($tsixpack); $i++) {
            if (isset($tsixpack[$i]['nama'])) {
                DB::table('tsixpacks')->insert([
                    'nama' => $tsixpack[$i]['nama'],
                ]);
            }
            DB::table('tsixpack_hargas')->insert([
                'tsixpack_id' => $tsixpack[$i]['id'],
                'tipe_bahan' => $tsixpack[$i]['tipe_bahan'],
                'harga' => $tsixpack[$i]['harga']
            ]);
        }
    }
}
