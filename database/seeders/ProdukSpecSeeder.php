<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukSpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk_spec = [[
            'produk_id' => 2,
            'spec_id' => 13
        ], [
            'produk_id' => 6,
            'spec_id' => 13
        ], [
            'produk_id' => 8,
            'spec_id' => 1
        ], [
            'produk_id' => 11,
            'spec_id' => 1
        ], [
            'produk_id' => 13,
            'spec_id' => 13
        ], [
            'produk_id' => 14,
            'spec_id' => 1
        ], [
            'produk_id' => 15,
            'spec_id' => 2
        ], [
            'produk_id' => 17,
            'spec_id' => 14
        ], [
            'produk_id' => 18,
            'spec_id' => 15
        ], [
            'produk_id' => 19,
            'spec_id' => 13
        ],
        [
            'produk_id' => 20,
            'spec_id' => 1
        ],
        [
            'produk_id' => 21,
            'spec_id' => 1
        ],
        [
            'produk_id' => 21,
            'spec_id' => 16
        ],
        [
            'produk_id' => 22,
            'spec_id' => 2
        ],
        [
            'produk_id' => 23,
            'spec_id' => 11
        ],
        [
            'produk_id' => 23,
            'spec_id' => 14
        ],
        [
            'produk_id' => 24,
            'spec_id' => 1
        ],
        [
            'produk_id' => 24,
            'spec_id' => 14
        ],
        [
            'produk_id' => 31,
            'spec_id' => 13
        ],
        [
            'produk_id' => 32,
            'spec_id' => 1
        ],
        [
            'produk_id' => 32,
            'spec_id' => 16
        ],
        [
            'produk_id' => 33,
            'spec_id' => 1
        ],
        [
            'produk_id' => 33,
            'spec_id' => 16
        ],
        [
            'produk_id' => 34,
            'spec_id' => 13
        ],
        [
            'produk_id' => 38,
            'spec_id' => 1
        ],
        [
            'produk_id' => 38,
            'spec_id' => 12
        ],
        [
            'produk_id' => 38,
            'spec_id' => 16
        ],
        [
            'produk_id' => 38,
            'spec_id' => 24
        ],
        ];

        for ($i = 0; $i < count($produk_spec); $i++) {
            DB::table('produk_specs')->insert([
                'produk_id' => $produk_spec[$i]['produk_id'],
                'spec_id' => $produk_spec[$i]['spec_id'],
            ]);
        }
    }
}
