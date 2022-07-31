<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RotanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rotan = [[
            'nama' => 'Hitam',
            'id' => 1,
            'harga' => 40000
        ]];

        for ($i = 0; $i < count($rotan); $i++) {
            DB::table('rotans')->insert([
                'nama' => $rotan[$i]['nama'],
            ]);
            DB::table('rotan_hargas')->insert([
                'rotan_id' => $rotan[$i]['id'],
                'harga' => $rotan[$i]['harga']
            ]);
        }
    }
}
