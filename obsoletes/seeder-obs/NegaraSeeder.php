<?php

namespace Database\Seeders;

use App\Models\Negara;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NegaraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $negaras = [
            ['nama'=>'Indonesia'],
            ['nama'=>'Malaysia'],
        ];

        foreach ($negaras as $negara) {
            Negara::create([
                'nama'=>$negara['nama']
            ]);
        }
    }
}
