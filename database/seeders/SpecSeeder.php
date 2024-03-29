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
        $ukuran = [[
            'nama' => 'PK',
            'nama_nota' => 'PK', // Patron Kecil, lebih kecil dari standar
            'harga' => 0 // 1
        ], [
            'nama' => 'JB93x53',
            'nama_nota' => 'JB',
            'harga' => 4000 // 1
        ], [
            'nama' => 'L', // ukuran nya sama seperti Jumbo
            'nama_nota' => 'L',
            'harga' => 4000 // 1
        ], [
                'nama' => 'LONG95x51',
                'nama_nota' => 'LONG',
                'harga' => 4000 // 1
            ],
            [
                'nama' => 'SuperJB97x53',
                'nama_nota' => 'SuperJB',
                'harga' => 5500 // 2
            ],
            [
                'nama' => '97x68.5',
                'nama_nota' => '97x68.5',
                'harga' => 5500 // 2
            ],
            [
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
                'nama' => 'FreeGo',
                'nama_nota' => 'FreeGo',
                'harga' => 5500 // 7
            ], [
                'nama' => 'Vario150',
                'nama_nota' => 'Vario150',
                'harga' => 5500 // 8
            ], [
                'nama' => 'MioSoulGT125',
                'nama_nota' => 'MioSoulGT125',
                'harga' => 5500 // 9
            ], [
                'nama' => 'MEGA100x57',
                'nama_nota' => 'MEGA',
                'harga' => 7500 // 10
            ], [
                'nama' => 'GIGA100x68.5',
                'nama_nota' => 'GIGA',
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
            'nama' => 'FreeGo',
            'harga' => 1000 // 21
        ], [
            'nama' => 'Vario150',
            'harga' => 1000 // 22
        ],
        [
            'nama' => 'MioSoulGT125', // 93*56
            'harga' => 1000 // 23
        ],
        [
            'nama' => 'Warna',
            'harga' => 1000 // 23
        ],
        ];

        for ($i = 0; $i < count($jahit); $i++) {
            $new_inserted_jahit = Spec::create([
                'kategori' => 'jahit', // variasi, ukuran, alas, jahit, grade_bahan
                'nama' => $jahit[$i]['nama'],
            ]);
            DB::table('spec_hargas')->insert([
                'spec_id' => $new_inserted_jahit['id'],
                'harga' => $jahit[$i]['harga']
            ]);
        }

        $grade_bahan = [[
            'nama' => 'A',
            'harga' => 3000 // 24
        ], [
            'nama' => 'B',
            'harga' => 0 // 25
        ],
        ];

        for ($i = 0; $i < count($grade_bahan); $i++) {
            $new_inserted_grade_bahan = Spec::create([
                'kategori' => 'grade_bahan',
                'nama' => $grade_bahan[$i]['nama'],
            ]);
            DB::table('spec_hargas')->insert([
                'spec_id' => $new_inserted_grade_bahan['id'],
                'harga' => $grade_bahan[$i]['harga']
            ]);
        }

        $list = [[
            'nama' => 'Benang Warna',
            'harga' => 3000 // 24
        ], [
            'nama' => 'Rotan Warna',
            'harga' => 3000 // 25
        ],
        ];

        for ($i = 0; $i < count($list); $i++) {
            $new_inserted_list = Spec::create([
                'kategori' => 'list',
                'nama' => $list[$i]['nama'],
            ]);
            DB::table('spec_hargas')->insert([
                'spec_id' => $new_inserted_list['id'],
                'harga' => $list[$i]['harga']
            ]);
        }

        $alas = [
            [
                'nama' => 'Alas',
                'harga' => 0, // 12
            ]
        ];

        for ($i = 0; $i < count($alas); $i++) {
            $new_inserted_alas = Spec::create([
                'kategori' => 'alas', // variasi, ukuran, alas, jahit, grade_bahan
                'nama' => $alas[$i]['nama'],
            ]);
            DB::table('spec_hargas')->insert([
                'spec_id' => $new_inserted_alas['id'],
                'harga' => $alas[$i]['harga']
            ]);
        }
        $busa = [
            [
                'nama' => 'Busa',
                'harga' => 0, // 12
            ]
        ];

        for ($i = 0; $i < count($busa); $i++) {
            $new_inserted_busa = Spec::create([
                'kategori' => 'busa', // variasi, ukuran, busa, jahit, grade_bahan
                'nama' => $busa[$i]['nama'],
            ]);
            DB::table('spec_hargas')->insert([
                'spec_id' => $new_inserted_busa['id'],
                'harga' => $busa[$i]['harga']
            ]);
        }

        $sayap = [
            [
                'nama' => 'Sayap Abu',
                'harga' => 0, // 12
            ], [
                'nama' => 'Sayap Hitam',
                'harga' => 0, // 12
            ]
        ];

        for ($i = 0; $i < count($sayap); $i++) {
            $new_inserted_sayap = Spec::create([
                'kategori' => 'sayap', // variasi, ukuran, sayap, jahit, grade_bahan
                'nama' => $sayap[$i]['nama'],
            ]);
            DB::table('spec_hargas')->insert([
                'spec_id' => $new_inserted_sayap['id'],
                'harga' => $sayap[$i]['harga']
            ]);
        }
    }
}
