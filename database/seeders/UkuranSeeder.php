<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // UKURAN SEEDER

        $ukuran = [
            [
                'id' => 1,
                'nama' => 'JB 93x53',
                'nama_nota' => 'JB',
                'harga' => 4000
            ], [
                'id' => 2,
                'nama' => 'S-JB 97x53',
                'nama_nota' => 'S-JB',
                'harga' => 5500
            ], [
                'id' => 3,
                'nama' => 'Scoopy',
                'nama_nota' => 'Scoopy',
                'harga' => 5500
            ], [
                'id' => 4,
                'nama' => 'NMAX',
                'nama_nota' => 'NMAX',
                'harga' => 5500
            ], [
                'id' => 5,
                'nama' => 'PCX',
                'nama_nota' => 'PCX',
                'harga' => 5500
            ], [
                'id' => 6,
                'nama' => 'Aerox',
                'nama_nota' => 'Aerox',
                'harga' => 5500
            ], [
                'id' => 7,
                'nama' => 'Freego',
                'nama_nota' => 'Freego',
                'harga' => 5500
            ], [
                'id' => 8,
                'nama' => 'Vario 150',
                'nama_nota' => 'Vario 150',
                'harga' => 5500
            ], [
                'id' => 9,
                'nama' => 'Mio Soul GT 125',
                'nama_nota' => 'Mio Soul GT 125',
                'harga' => 5500
            ]
        ];
        for ($i = 0; $i < count($ukuran); $i++) {
            DB::table('ukurans')->insert([
                'nama' => $ukuran[$i]['nama'],
                'nama_nota' => $ukuran[$i]['nama_nota']
            ]);
            DB::table('ukuran_hargas')->insert([
                'ukuran_id' => $ukuran[$i]['id'],
                'harga' => $ukuran[$i]['harga']
            ]);
        }
    }
}
