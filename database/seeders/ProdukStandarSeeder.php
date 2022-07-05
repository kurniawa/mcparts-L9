<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukStandarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk_standar = [
            [
                'produk_id' => 35,
                'standar_id' => 20
            ],
            ];

        for ($i = 0; $i < count($produk_standar); $i++) {
            DB::table('produk_standars')->insert([
                'produk_id' => $produk_standar[$i]['produk_id'],
                'standar_id' => $produk_standar[$i]['standar_id'],
            ]);
        }
    }
}
