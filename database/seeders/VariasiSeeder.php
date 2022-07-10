<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variasi = [[
            'nama' => 'Polos',
            'id' => 1,
            'harga' => 0
        ], [
            'nama' => 'LG.Bayang',
            'id' => 2,
            'harga' => 1000
        ], [
            'nama' => 'LG.Bludru',
            'id' => 3,
            'harga' => 1000
        ], [
            'nama' => 'LG.Bordir',
            'id' => 4,
            'harga' => 1000
        ], [
            'nama' => 'LG.Mika',
            'id' => 5,
            'harga' => 1000
        ], [
            'nama' => 'LG.Polymas',
            'id' => 6,
            'harga' => 1000
        ], [
            'nama' => 'LG.Sablon',
            'id' => 7,
            'harga' => 1000
        ], [
            'nama' => 'LG.Stiker',
            'id' => 8,
            'harga' => 4000
        ], [
            'nama' => 'Press',
            'id' => 9,
            'harga' => 3000
        ], [
            'nama' => 'T.Bayang',
            'id' => 10,
            'harga' => 3000
        ], [
            'nama' => 'T.Polymas',
            'id' => 11,
            'harga' => 5000
        ], [
            'nama' => 'T.Sablon',
            'id' => 12,
            'harga' => 4000
        ], [
            'nama' => 'T.Trisula',
            'id' => 13,
            'harga' => 4000
        ], [
            'nama' => 'Tulang Bayang', // dikasih nama lengkap Tulang, supaya ga ke tuker antara singkatan T dengan TL
            'id' => 14,
            'harga' => 5000
        ]];

        for ($i = 0; $i < count($variasi); $i++) {
            DB::table('variasis')->insert([
                'nama' => $variasi[$i]['nama'],
            ]);
            DB::table('variasi_hargas')->insert([
                'variasi_id' => $variasi[$i]['id'],
                'harga' => $variasi[$i]['harga']
            ]);
        }
    }
}
