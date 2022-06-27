<?php

namespace Database\Seeders;

use App\Models\Jahit;
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
            'harga' => 1000
        ], [
            'nama' => 'ABS-RV',
            'harga' => 1000
        ], [
            'nama' => 'RXK',
            'harga' => 1000
        ], [
            'nama' => 'JB',
            'harga' => 4000
        ], [
            'nama' => 'Scoopy',
            'harga' => 4000
        ], [
            'nama' => 'NMAX',
            'harga' => 5500
        ], [
            'nama' => 'PCX',
            'harga' => 5500
        ], [
            'nama' => 'Aerox',
            'harga' => 5500
        ], [
            'nama' => 'Freego',
            'harga' => 5500
        ], [
            'nama' => 'Vario 150',
            'harga' => 5500
        ], [
            'nama' => 'Mio Soul GT 125', // 93*56
            'harga' => 5500
        ]
        ];

        for ($i = 0; $i < count($jahit); $i++) {
            $new_inserted_jahit = Jahit::create([
                'nama' => $jahit[$i]['nama'],
            ]);
            DB::table('jahit_hargas')->insert([
                'jahit_id' => $new_inserted_jahit['id'],
                'harga' => $jahit[$i]['harga']
            ]);
        }
    }
}
