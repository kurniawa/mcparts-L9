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
            'harga' => 107500
        ], [
            'nama' => 'Beat',
            'harga' => 107500
        ], [
            'nama' => 'Beat FI',
            'harga' => 107500
        ], [
            'nama' => 'CB Japstyle',
            'harga' => 107500
        ], [
            'nama' => 'CB STD',
            'harga' => 107500
        ], [
            'nama' => 'F1ZR',
            'harga' => 107500
        ], [
            'nama' => 'Fit New',
            'harga' => 107500
        ], [
            'nama' => 'FU',
            'harga' => 107500
        ], [
            'nama' => 'GL Pro',
            'harga' => 107500
        ], [
            'nama' => 'Grand',
            'harga' => 107500
        ], [
            'nama' => "Grand'97",
            'harga' => 107500
        ], [
            'nama' => 'Jupiter MX',
            'harga' => 107500
        ], [
            'nama' => 'Jupiter New',
            'harga' => 107500
        ], [
            'nama' => 'Jupiter Z',
            'harga' => 107500
        ], [
            'nama' => 'Mio M3',
            'harga' => 107500
        ], [
            'nama' => 'Mio Soul',
            'harga' => 107500
        ],
        [
            'nama' => 'Prima',
            'harga' => 107500
        ],
        [
            'nama' => 'Revo FI',
            'harga' => 107500
        ],
        [
            'nama' => 'RX King',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK New',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK Perahu',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK Press',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK Supra',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK Supra 125',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK Supra Fit New',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK Supra X',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK Vario 125',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK Vario Techno',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK Vega R',
            'harga' => 107500
        ],
        [
            'nama' => 'RXK Vega ZR',
            'harga' => 107500
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
