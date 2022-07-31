<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rol = [[
            'nama' => 'LuckyHole Hitam',
            'id' => 1,
            'harga' => 1000000
        ]];

        for ($i = 0; $i < count($rol); $i++) {
            DB::table('rols')->insert([
                'nama' => $rol[$i]['nama'],
            ]);
            DB::table('rol_hargas')->insert([
                'rol_id' => $rol[$i]['id'],
                'harga' => $rol[$i]['harga']
            ]);
        }
    }
}
