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
            'nama' => 'Kombinasi Sayap Warna(A) Motif + LG + jht.Kepala',
            'harga' => 20500
        ], [
            'nama' => 'Kombinasi Warna Japstyle + jht.Kepala',
            'harga' => 20000
        ],
        [
            'nama' => 'Kombinasi List Miring (A)',
            'harga' => 17000
        ],
        [
            'nama' => 'Kombinasi List Miring + LG',
            'harga' => 17000
        ],
        [
            'nama' => 'Kombinasi Warna X-Ride(L) + Rotan Warna',
            'harga' => 27500
        ], [
            'nama' => 'Kombinasi Warna X-Ride(L) + Benang Warna',
            'harga' => 26500
        ], [
            'nama' => 'Motif Sixpack 2 Warna + jht.Univ',
            'harga' => 29000
        ], [
            'nama' => 'Motif Sixpack 2 Warna uk.JB + jht.JB',
            'harga' => 36000
        ], [
            'nama' => 'Motif Hexagon 2 Warna + jht.Univ',
            'harga' => 29000
        ], [
            'nama' => 'Motif Hexagon 2 Warna uk.JB + jht.JB',
            'harga' => 36000
        ], [
            'nama' => 'Motif Starpack 2 Warna + jht.Univ',
            'harga' => 29000
        ], [
            'nama' => 'Motif Starpack 2 Warna uk.JB + jht.JB',
            'harga' => 36000
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
