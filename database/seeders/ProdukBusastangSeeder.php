<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukBusastangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk_busastang = [
            [
                'produk_id' => 38,
                'busastang_id' => 2
            ],
            ];

        for ($i = 0; $i < count($produk_busastang); $i++) {
            DB::table('produk_busastangs')->insert([
                'produk_id' => $produk_busastang[$i]['produk_id'],
                'busastang_id' => $produk_busastang[$i]['busastang_id'],
            ]);
        }
    }
}
