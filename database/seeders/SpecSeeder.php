<?php

namespace Database\Seeders;

use App\Models\Spec;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SpecSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ukuran = [
            [
                'nama' => 'JB 93x53',
                'nama_nota' => 'JB',
                'harga' => 4000 // 1
            ], [
                'nama' => 'S-JB 97x53',
                'nama_nota' => 'S-JB',
                'harga' => 5500 // 2
            ], [
                'nama' => 'Scoopy',
                'nama_nota' => 'Scoopy',
                'harga' => 5500 // 3
            ], [
                'nama' => 'NMAX',
                'nama_nota' => 'NMAX',
                'harga' => 5500 // 4
            ], [
                'nama' => 'PCX',
                'nama_nota' => 'PCX',
                'harga' => 5500 // 5
            ], [
                'nama' => 'Aerox',
                'nama_nota' => 'Aerox',
                'harga' => 5500 // 6
            ], [
                'nama' => 'Freego',
                'nama_nota' => 'Freego',
                'harga' => 5500 // 7
            ], [
                'nama' => 'Vario 150',
                'nama_nota' => 'Vario 150',
                'harga' => 5500 // 8
            ], [
                'nama' => 'Mio Soul GT 125',
                'nama_nota' => 'Mio Soul GT 125',
                'harga' => 5500 // 9
            ], [
                'nama' => 'S-BIG 100x57',
                'nama_nota' => 'S-BIG',
                'harga' => 7500 // 10
            ], [
                'nama' => 'S-BIG-JB 100x68.5',
                'nama_nota' => 'S-BIG-JB',
                'harga' => 9500 // 11
            ]
        ];

        for ($i = 0; $i < count($ukuran); $i++) {
            $new_inserted_ukuran = Spec::create([
                'kategori' => 'ukuran',
                'nama' => $ukuran[$i]['nama'],
                'nama_nota' => $ukuran[$i]['nama_nota'],
            ]);
            DB::table('spec_hargas')->insert([
                'spec_id' => $new_inserted_ukuran['id'],
                'harga' => $ukuran[$i]['harga']
            ]);
        }

        $busa = [
            [
                'nama' => 'busa',
                'harga' => 0, // 12
            ]
        ];

        for ($i = 0; $i < count($busa); $i++) {
            $new_inserted_busa = Spec::create([
                'kategori' => 'busa', // variasi, ukuran, busa, jahit, tipe_bahan
                'nama' => $busa[$i]['nama'],
            ]);
            DB::table('spec_hargas')->insert([
                'spec_id' => $new_inserted_busa['id'],
                'harga' => $busa[$i]['harga']
            ]);
        }

        $jahit = [[
            'nama' => 'Univ',
            'harga' => 1000 // 13
        ], [
            'nama' => 'ABS-RV',
            'harga' => 1000 // 14
        ], [
            'nama' => 'RXK',
            'harga' => 1000 // 15
        ], [
            'nama' => 'JB',
            'harga' => 1000 // 16
        ], [
            'nama' => 'Scoopy',
            'harga' => 1000 // 17
        ], [
            'nama' => 'NMAX',
            'harga' => 1000 // 18
        ], [
            'nama' => 'PCX',
            'harga' => 1000 // 19
        ], [
            'nama' => 'Aerox',
            'harga' => 1000 // 20
        ], [
            'nama' => 'Freego',
            'harga' => 1000 // 21
        ], [
            'nama' => 'Vario 150',
            'harga' => 1000 // 22
        ], [
            'nama' => 'Mio Soul GT 125', // 93*56
            'harga' => 1000 // 23
        ]
        ];

        for ($i = 0; $i < count($jahit); $i++) {
            $new_inserted_jahit = Spec::create([
                'kategori' => 'jahit', // variasi, ukuran, busa, jahit, tipe_bahan
                'nama' => $jahit[$i]['nama'],
            ]);
            DB::table('spec_hargas')->insert([
                'spec_id' => $new_inserted_jahit['id'],
                'harga' => $jahit[$i]['harga']
            ]);
        }

        $tipe_bahan = [[
            'nama' => 'A',
            'harga' => 3000 // 24
        ], [
            'nama' => 'B',
            'harga' => 0 // 25
        ],
        ];

        for ($i = 0; $i < count($tipe_bahan); $i++) {
            $new_inserted_tipe_bahan = Spec::create([
                'kategori' => 'tipe_bahan',
                'nama' => $tipe_bahan[$i]['nama'],
            ]);
            DB::table('spec_hargas')->insert([
                'spec_id' => $new_inserted_tipe_bahan['id'],
                'harga' => $tipe_bahan[$i]['harga']
            ]);
        }
    }
}
