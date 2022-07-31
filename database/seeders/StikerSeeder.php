<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StikerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stiker = [[
            'nama' => 'Api',
            'id' => 1,
            'harga' => 4000
        ], [
            'nama' => 'MU',
            'id' => 2,
            'harga' => 2500
        ], [
            'nama' => 'PSM',
            'id' => 3,
            'harga' => 2500
        ]];

        for ($i = 0; $i < count($stiker); $i++) {
            DB::table('stikers')->insert([
                'nama' => $stiker[$i]['nama'],
            ]);
            DB::table('stiker_hargas')->insert([
                'stiker_id' => $stiker[$i]['id'],
                'harga' => $stiker[$i]['harga']
            ]);
        }
    }
}
