<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukTsixpackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk_tsixpack = [
            [
                'produk_id' => 38,
                'tsixpack_id' => 1
            ],
            ];

        for ($i = 0; $i < count($produk_tsixpack); $i++) {
            DB::table('produk_tsixpacks')->insert([
                'produk_id' => $produk_tsixpack[$i]['produk_id'],
                'tsixpack_id' => $produk_tsixpack[$i]['tsixpack_id'],
            ]);
        }
    }
}
