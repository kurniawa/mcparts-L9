<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JahitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // JAHIT SEEDER

        $jahit = [[
            'nama' => 'Univ',
            'id' => 1,
            'harga' => 1000
        ], [
            'nama' => 'ABS-RV',
            'id' => 2,
            'harga' => 1000
        ], [
            'nama' => 'RXK',
            'id' => 3,
            'harga' => 1000
        ], [
            'nama' => 'JB',
            'id' => 4,
            'harga' => 4000
        ], [
            'nama' => 'Scoopy',
            'id' => 5,
            'harga' => 4000
        ], [
            'nama' => 'NMAX',
            'id' => 6,
            'harga' => 5500
        ], [
            'nama' => 'PCX',
            'id' => 7,
            'harga' => 5500
        ], [
            'nama' => 'Aerox',
            'id' => 8,
            'harga' => 5500
        ], [
            'nama' => 'Freego',
            'id' => 9,
            'harga' => 5500
        ], [
            'nama' => 'Vario 150',
            'id' => 10,
            'harga' => 5500
        ], [
            'nama' => 'Mio Soul GT 125', // 93*56
            'id' => 11,
            'harga' => 5500
        ]
        ];

        for ($i = 0; $i < count($jahit); $i++) {
            DB::table('jahits')->insert([
                'nama' => $jahit[$i]['nama'],
            ]);
            DB::table('jahit_hargas')->insert([
                'jahit_id' => $jahit[$i]['id'],
                'harga' => $jahit[$i]['harga']
            ]);
        }
    }
}
