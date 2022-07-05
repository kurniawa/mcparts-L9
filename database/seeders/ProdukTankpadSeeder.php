<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukTankpadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk_tankpad = [
            [
                'produk_id' => 36,
                'tankpad_id' => 5
            ],
            ];

        for ($i = 0; $i < count($produk_tankpad); $i++) {
            DB::table('produk_tankpads')->insert([
                'produk_id' => $produk_tankpad[$i]['produk_id'],
                'tankpad_id' => $produk_tankpad[$i]['tankpad_id'],
            ]);
        }
    }
}
