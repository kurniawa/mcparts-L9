<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukBahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk_bahan = [
        [
            'produk_id' => 1,
            'bahan_id' => 1,
        ],
        [
            'produk_id' => 2,
            'bahan_id' => 1,
        ],
        [
            'produk_id' => 3,
            'bahan_id' => 1,
        ],
        [
            'produk_id' => 4,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 5,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 6,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 7,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 8,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 9,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 10,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 11,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 12,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 13,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 14,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 15,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 16,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 17,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 18,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 19,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 20,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 21,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 22,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 23,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 24,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 25,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 26,
            'bahan_id' => 3,
        ],
        [
            'produk_id' => 27,
            'bahan_id' => 4,
        ],
        [
            'produk_id' => 28,
            'bahan_id' => 4,
        ],
        [
            'produk_id' => 29,
            'bahan_id' => 4,
        ],
        [
            'produk_id' => 30,
            'bahan_id' => 4,
        ],
        [
            'produk_id' => 31,
            'bahan_id' => 4,
        ],
        [
            'produk_id' => 32,
            'bahan_id' => 4,
        ],
        [
            'produk_id' => 33,
            'bahan_id' => 6,
        ],
    ];

        for ($i = 0; $i < count($produk_bahan); $i++) {
            DB::table('produk_bahans')->insert([
                'produk_id' => $produk_bahan[$i]['produk_id'],
                'bahan_id' => $produk_bahan[$i]['bahan_id'],
            ]);
        }
    }
}
