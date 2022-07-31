<?php

namespace Database\Seeders;

use App\Models\Kombinasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KombinasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kombinasi = [[
            'nama' => 'Sayap Warna',
            'harga' => 20500
        ], [
            'nama' => 'Warna Japstyle',
            'harga' => 20000
        ],
        [
            'nama' => 'List Miring',
            'harga' => 17000
        ],
        [
            'nama' => 'Warna X-Ride',
            'harga' => 27500
        ]];

        for ($i = 0; $i < count($kombinasi); $i++) {
            $new_inserted_kombinasi = Kombinasi::create([
                'nama' => $kombinasi[$i]['nama'],
            ]);
            DB::table('kombinasi_hargas')->insert([
                'kombinasi_id' => $new_inserted_kombinasi['id'],
                'harga' => $kombinasi[$i]['harga']
            ]);
        }
    }
}
