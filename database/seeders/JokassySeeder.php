<?php

namespace Database\Seeders;

use App\Models\Jokassy;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JokassySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jokassy = [[
            'nama' => 'Absolute Revo',
            'harga' => 0
        ], [
            'nama' => 'Beat',
            'harga' => 1000
        ], [
            'nama' => 'Beat FI',
            'harga' => 1000
        ], [
            'nama' => 'CB STD',
            'harga' => 1000
        ], [
            'nama' => 'F1ZR',
            'harga' => 1000
        ], [
            'nama' => 'Fit New',
            'harga' => 1000
        ], [
            'nama' => 'FU',
            'harga' => 1000
        ], [
            'nama' => 'GL Pro',
            'harga' => 4000
        ], [
            'nama' => 'Grand',
            'harga' => 3000
        ], [
            'nama' => "Grand'97",
            'harga' => 3000
        ], [
            'nama' => 'Jupiter MX',
            'harga' => 5000
        ], [
            'nama' => 'Jupiter New',
            'harga' => 4000
        ], [
            'nama' => 'Jupiter Z',
            'harga' => 4000
        ], [
            'nama' => 'Mio M3',
            'harga' => 5000
        ], [
            'nama' => 'Mio Soul',
            'harga' => 5000
        ],
        [
            'nama' => 'MX',
            'harga' => 5000
        ],
        [
            'nama' => 'Prima',
            'harga' => 5000
        ],
        [
            'nama' => 'Revo FI',
            'harga' => 5000
        ],
        [
            'nama' => 'RX King',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK New',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK New Papas Perahu',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK Press',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK Supra',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK Supra 125',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK Supra Fit New',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK Supra X',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK Vario 125',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK Vario Techno',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK Vega R',
            'harga' => 5000
        ],
        [
            'nama' => 'RXK Vega ZR',
            'harga' => 5000
        ],
        ];

        for ($i = 0; $i < count($jokassy); $i++) {
            $new_inserted_jokassy = Jokassy::create([
                'nama' => $jokassy[$i]['nama'],
            ]);
            DB::table('jokassy_hargas')->insert([
                'jokassy_id' => $new_inserted_jokassy['id'],
                'harga' => $jokassy[$i]['harga']
            ]);
        }
    }
}
