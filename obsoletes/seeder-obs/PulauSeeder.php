<?php

namespace Database\Seeders;

use App\Models\Pulau;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PulauSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pulaus = [
            ['nama'=>'Kalimantan', 'negara_id'=>1],
            ['nama'=>'Jawa', 'negara_id'=>1],
            ['nama'=>'Sumatra', 'negara_id'=>1],
            ['nama'=>'Sulawesi', 'negara_id'=>1],
            ['nama'=>'Papua', 'negara_id'=>1],
            ['nama'=>'NTB', 'negara_id'=>1],
            ['nama'=>'Maluku', 'negara_id'=>1],
        ];

        foreach ($pulaus as $pulau) {
            Pulau::create(
                ['nama' => $pulau['nama'], 'negara_id'=>$pulau['negara_id']],
            );
        }
    }
}
