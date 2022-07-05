<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukMotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk_motif = [
        [
            'produk_id' => 34,
            'motif_id' => 1
        ],
        ];

        for ($i = 0; $i < count($produk_motif); $i++) {
            DB::table('produk_motifs')->insert([
                'produk_id' => $produk_motif[$i]['produk_id'],
                'motif_id' => $produk_motif[$i]['motif_id'],
            ]);
        }
    }
}
