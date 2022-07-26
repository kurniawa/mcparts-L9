<?php

namespace Database\Seeders;

use App\Models\Tsixpack;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TsixpackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tsixpack = [[
            'nama' => 'T.Sixpack',
            'harga' => 25500
        ]
    ];

        for ($i = 0; $i < count($tsixpack); $i++) {
            $inserted_tsixpack = Tsixpack::create([
                'nama' => $tsixpack[$i]['nama'],
            ]);
            DB::table('tsixpack_hargas')->insert([
                'tsixpack_id' => $inserted_tsixpack['id'],
                'harga' => $tsixpack[$i]['harga']
            ]);
        }
    }
}
