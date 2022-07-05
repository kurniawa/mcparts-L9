<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TspjapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tspjap = [[
            'nama' => 'T.Sixpack + Busa + jht.Univ',
            'id' => 1,
            'tipe_bahan' => 'A',
            'harga' => 25500
        ], [
            'nama' => 'T.Sixpack + Busa + uk.JB + jht.JB',
            'id' => 2,
            'tipe_bahan' => 'A',
            'harga' => 30000
        ], [
            'nama' => 'T.Sixpack + Busa + uk.JB + jht.NMAX',
            'id' => 3,
            'tipe_bahan' => 'A',
            'harga' => 33000
        ], [
            'nama' => 'Japstyle',
            'id' => 4,
            'tipe_bahan' => 'A',
            'harga' => 22000
        ], [
            'id' => 4,
            'tipe_bahan' => 'B',
            'harga' => 19000
        ]];

        for ($i = 0; $i < count($tspjap); $i++) {
            if (isset($tspjap[$i]['nama'])) {
                DB::table('tspjaps')->insert([
                    'nama' => $tspjap[$i]['nama'],
                ]);
            }
            DB::table('tspjap_bahan_hargas')->insert([
                'tspjap_id' => $tspjap[$i]['id'],
                'tipe_bahan' => $tspjap[$i]['tipe_bahan'],
                'harga' => $tspjap[$i]['harga']
            ]);
        }
    }
}
