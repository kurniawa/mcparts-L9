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
            'harga' => 1000
        ], [
            'nama' => 'Scoopy',
            'harga' => 1000
        ], [
            'nama' => 'NMAX',
            'harga' => 1000
        ], [
            'nama' => 'PCX',
            'harga' => 1000
        ], [
            'nama' => 'Aerox',
            'harga' => 1000
        ], [
            'nama' => 'Freego',
            'harga' => 1000
        ], [
            'nama' => 'Vario 150',
            'harga' => 1000
        ], [
            'nama' => 'Mio Soul GT 125', // 93*56
            'harga' => 1000
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
