<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JapstyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $japstyle = [[
            'nama' => 'Japstyle',
            'id' => 4,
            'tipe_bahan' => 'A',
            'harga' => 22000
        ], [
            'id' => 4,
            'tipe_bahan' => 'B',
            'harga' => 19000
        ]];

        for ($i = 0; $i < count($japstyle); $i++) {
            if (isset($japstyle[$i]['nama'])) {
                DB::table('japstyles')->insert([
                    'nama' => $japstyle[$i]['nama'],
                ]);
            }
            DB::table('japstyle_hargas')->insert([
                'japstyle_id' => $japstyle[$i]['id'],
                'tipe_bahan' => $japstyle[$i]['tipe_bahan'],
                'harga' => $japstyle[$i]['harga']
            ]);
        }
    }
}
