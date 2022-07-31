<?php

namespace Database\Seeders;

use App\Models\Motif;
use App\Models\MotifHarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MotifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $motif = [[
            'nama' => 'Sixpack 2 Warna',
            'id' => 1,
            'harga' => 27000
        ], [
            'nama' => 'Sixpack Full Hitam',
            'id' => 2,
            'harga' => 27000
        ], [
            'nama' => 'Hexagon 2 Warna',
            'id' => 2,
            'harga' => 27000
        ], [
            'nama' => 'Starpack 2 Warna',
            'id' => 3,
            'harga' => 27000
        ]];

        for ($i = 0; $i < count($motif); $i++) {
            Motif::create([
                'nama' => $motif[$i]['nama'],
            ]);
            MotifHarga::create([
                'motif_id' => $motif[$i]['id'],
                'harga' => $motif[$i]['harga']
            ]);
        }
    }
}
