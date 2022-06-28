<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VariasiVarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $variasi_varian = [
            // LG.Bayang
            ['variasi_id' => 2, 'varian_id' => '1'],
            ['variasi_id' => 2, 'varian_id' => '2'],
            ['variasi_id' => 2, 'varian_id' => '3'],
            ['variasi_id' => 2, 'varian_id' => '4'],
            ['variasi_id' => 2, 'varian_id' => '5'],
            ['variasi_id' => 2, 'varian_id' => '6'],
            ['variasi_id' => 2, 'varian_id' => '7'],
            ['variasi_id' => 2, 'varian_id' => '8'],
            ['variasi_id' => 2, 'varian_id' => '9'],
            ['variasi_id' => 2, 'varian_id' => '10'],
            ['variasi_id' => 2, 'varian_id' => '11'],
            ['variasi_id' => 2, 'varian_id' => '12'],
            ['variasi_id' => 2, 'varian_id' => '13'],
            ['variasi_id' => 2, 'varian_id' => '14'],
            ['variasi_id' => 2, 'varian_id' => '15'],
            ['variasi_id' => 2, 'varian_id' => '16'],
            ['variasi_id' => 2, 'varian_id' => '17'],
            ['variasi_id' => 2, 'varian_id' => '18'],
            ['variasi_id' => 2, 'varian_id' => '19'],
            ['variasi_id' => 2, 'varian_id' => '20'],
            ['variasi_id' => 2, 'varian_id' => '21'],
            ['variasi_id' => 2, 'varian_id' => '22'],
            ['variasi_id' => 2, 'varian_id' => '23'],
            ['variasi_id' => 2, 'varian_id' => '24'],
            ['variasi_id' => 2, 'varian_id' => '25'],
            ['variasi_id' => 2, 'varian_id' => '26'],
            ['variasi_id' => 2, 'varian_id' => '27'],
            // LG.Bludru
            ['variasi_id' => 3, 'varian_id' => '1'],
            ['variasi_id' => 3, 'varian_id' => '2'],
            ['variasi_id' => 3, 'varian_id' => '3'],
            ['variasi_id' => 3, 'varian_id' => '4'],
            ['variasi_id' => 3, 'varian_id' => '5'],
            ['variasi_id' => 3, 'varian_id' => '6'],
            ['variasi_id' => 3, 'varian_id' => '7'],
            ['variasi_id' => 3, 'varian_id' => '8'],
            ['variasi_id' => 3, 'varian_id' => '9'],
            ['variasi_id' => 3, 'varian_id' => '10'],
            ['variasi_id' => 3, 'varian_id' => '11'],
            ['variasi_id' => 3, 'varian_id' => '12'],
            ['variasi_id' => 3, 'varian_id' => '13'],
            ['variasi_id' => 3, 'varian_id' => '14'],
            ['variasi_id' => 3, 'varian_id' => '15'],
            ['variasi_id' => 3, 'varian_id' => '16'],
            ['variasi_id' => 3, 'varian_id' => '17'],
            ['variasi_id' => 3, 'varian_id' => '18'],
            ['variasi_id' => 3, 'varian_id' => '19'],
            ['variasi_id' => 3, 'varian_id' => '20'],
            ['variasi_id' => 3, 'varian_id' => '21'],
            ['variasi_id' => 3, 'varian_id' => '22'],
            ['variasi_id' => 3, 'varian_id' => '23'],
            ['variasi_id' => 3, 'varian_id' => '24'],
            ['variasi_id' => 3, 'varian_id' => '25'],
            ['variasi_id' => 3, 'varian_id' => '26'],
            ['variasi_id' => 3, 'varian_id' => '27'],
        ];
        for ($i = 0; $i < count($variasi_varian); $i++) {
            DB::table('variasi_varians')->insert([
                'variasi_id' => $variasi_varian[$i]['variasi_id'],
                'varian_id' => $variasi_varian[$i]['varian_id']
            ]);
        }
    }
}
