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
            'grade_bahan' => 'A',
            'harga' => 25500
        ], [
            'nama' => 'T.Sixpack uk.JB + Busa + jht.JB',
            'id' => 2,
            'grade_bahan' => 'A',
            'harga' => 30000
        ],
        [
            'nama' => 'T.Sixpack uk.JB + Busa + jht.NMAX',
            'id' => 3,
            'grade_bahan' => 'A',
            'harga' => 33000
        ],
        [
            'nama' => 'C30(MC) T.Sixpack + Busa + jht.Univ',
            'bahan_id' => null, // ?
            'id' => 4,
            'grade_bahan' => 'A',
            'harga' => 27000
        ],
        [
            'nama' => 'C30(MC) T.Sixpack uk.JB + Busa',
            'bahan_id' => null, // ?
            'id' => 4,
            'grade_bahan' => 'A',
            'harga' => 33000
        ],
        [
            'nama' => 'C30(MC) T.Sixpack uk.JB + Busa + jht.JB',
            'bahan_id' => null, // ?
            'id' => 4,
            'grade_bahan' => 'A',
            'harga' => 33000
        ],
        [
            'nama' => 'T.Sixpack C38(MC) + Busa + jht.Univ',
            'bahan_id' => null, // ?
            'id' => 4,
            'grade_bahan' => 'A',
            'harga' => 27000
        ],
    ];

        for ($i = 0; $i < count($tsixpack); $i++) {
            if ($tsixpack[$i]['bahan_id'] !== null) {
                DB::table('tsixpacks')->insert([
                    'nama' => $tsixpack[$i]['nama'],
                    'bahan_id' => $tsixpack[$i]['bahan_id'],
                ]);
            } else {
                DB::table('tsixpacks')->insert([
                    'nama' => $tsixpack[$i]['nama'],
                ]);
            }
            DB::table('tsixpack_hargas')->insert([
                'tsixpack_id' => $tsixpack[$i]['id'],
                'grade_bahan' => $tsixpack[$i]['grade_bahan'],
                'harga' => $tsixpack[$i]['harga']
            ]);
        }
    }
}
