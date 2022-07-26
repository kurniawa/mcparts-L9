<?php

namespace Database\Seeders;

use App\Models\Variasi;
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
            'harga' => 0
        ], [
            'nama' => 'LG.Bayang',
            'harga' => 1000
        ], [
            'nama' => 'LG.Bludru',
            'harga' => 1000
        ], [
            'nama' => 'LG.Bordir',
            'harga' => 1000
        ], [
            'nama' => 'LG.Mika',
            'harga' => 1000
        ], [
            'nama' => 'LG.Polymas',
            'harga' => 1000
        ], [
            'nama' => 'LG.Sablon',
            'harga' => 1000
        ], [
            'nama' => 'LG.Stiker',
            'harga' => 4000
        ], [
            'nama' => 'Press',
            'harga' => 3000
        ], [
            'nama' => 'T.Bayang',
            'harga' => 3000
        ], [
            'nama' => 'T.Polymas',
            'harga' => 5000
        ], [
            'nama' => 'T.Sablon',
            'harga' => 4000
        ], [
            'nama' => 'T.Trisula',
            'harga' => 4000
        ], [
            'nama' => 'Tulang Bayang', // dikasih nama lengkap Tulang, supaya ga ke tuker antara singkatan T dengan TL
            'harga' => 5000
        ]];

        for ($i = 0; $i < count($variasi); $i++) {
            $new_inserted_variasi = Variasi::create([
                'nama' => $variasi[$i]['nama'],
            ]);
            DB::table('variasi_hargas')->insert([
                'variasi_id' => $new_inserted_variasi['id'],
                'harga' => $variasi[$i]['harga']
            ]);
        }
    }
}
