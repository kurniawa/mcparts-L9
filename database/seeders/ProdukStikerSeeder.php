<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukStikerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk_stiker = [
            [
                'produk_id' => 39,
                'stiker_id' => 1
            ],
            ];

        for ($i = 0; $i < count($produk_stiker); $i++) {
            DB::table('produk_stikers')->insert([
                'produk_id' => $produk_stiker[$i]['produk_id'],
                'stiker_id' => $produk_stiker[$i]['stiker_id'],
            ]);
        }
    }
}
