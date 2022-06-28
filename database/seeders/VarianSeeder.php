<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VarianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $varian = [
            ['kategori' => 'netral', 'nama' => '46'],
            ['kategori' => 'netral', 'nama' => 'Alpinestar'],
            ['kategori' => 'netral', 'nama' => 'Bikers'],
            ['kategori' => 'netral', 'nama' => 'Black'],
            ['kategori' => 'netral', 'nama' => 'BRIDE'],
            ['kategori' => 'netral', 'nama' => 'CW'],
            ['kategori' => 'netral', 'nama' => 'Daytona'],
            ['kategori' => 'netral', 'nama' => 'DBS'],
            ['kategori' => 'netral', 'nama' => 'Diavel'],
            ['kategori' => 'netral', 'nama' => 'FOX'],
            ['kategori' => 'netral', 'nama' => 'HKS'],
            ['kategori' => 'netral', 'nama' => 'Honda'],
            ['kategori' => 'netral', 'nama' => 'Kitaco'],
            ['kategori' => 'netral', 'nama' => 'Monster'],
            ['kategori' => 'netral', 'nama' => 'MotoGP'],
            ['kategori' => 'netral', 'nama' => 'Movistar'],
            ['kategori' => 'netral', 'nama' => 'Movistar XLGP Racing'],
            ['kategori' => 'netral', 'nama' => 'NGO'],
            ['kategori' => 'netral', 'nama' => 'Kawahara'],
            ['kategori' => 'netral', 'nama' => 'Repsol'],
            ['kategori' => 'netral', 'nama' => 'Ride It'],
            ['kategori' => 'netral', 'nama' => 'Rockstar'],
            ['kategori' => 'netral', 'nama' => 'Somjin'],
            ['kategori' => 'netral', 'nama' => 'TDR'],
            ['kategori' => 'netral', 'nama' => 'Tokage'],
            ['kategori' => 'netral', 'nama' => 'UpinIpin'],
            ['kategori' => 'netral', 'nama' => 'Yamaha'],
            ['kategori' => 'netral', 'nama' => 'Yoshimura'],
            ['kategori' => 'netral', 'nama' => 'YSS'], // 29
            // Tato
            ['kategori' => 'netral', 'nama' => 'Bride 9X'],
            ['kategori' => 'netral', 'nama' => 'Bride Blok 9X'],
            ['kategori' => 'netral', 'nama' => 'Kawahara 8X'],
            ['kategori' => 'netral', 'nama' => 'NGO 7X'],
            ['kategori' => 'netral', 'nama' => 'Somjin 7X'],
            ['kategori' => 'netral', 'nama' => 'Thailook 5X'],

            ['kategori' => 'kartun', 'nama' => 'Doraemon'],
            ['kategori' => 'kartun', 'nama' => 'Hello Kitty 2'],
            ['kategori' => 'kartun', 'nama' => 'Keropi'],
            ['kategori' => 'kartun', 'nama' => 'Mickey Mouse'],
            ['kategori' => 'kartun', 'nama' => 'Minions'],
            ['kategori' => 'kartun', 'nama' => 'One Piece'],
            ['kategori' => 'kartun', 'nama' => 'Spongebob'],
            ['kategori' => 'binatang', 'nama' => 'Naga'],
            ['kategori' => 'binatang', 'nama' => 'Scorpion'],
            ['kategori' => 'binatang', 'nama' => 'Kelabang'],
            ['kategori' => 'binatang', 'nama' => 'Macan'],
            ['kategori' => null, 'nama' => 'Racing Boy'],
            ['kategori' => null, 'nama' => 'Menara'],
            ['kategori' => null, 'nama' => 'Prima'], // 39
            ['kategori' => null, 'nama' => 'Tribal 1-6'],
            ['kategori' => null, 'nama' => 'Tribal 1'],
            ['kategori' => null, 'nama' => 'Tribal 2'],
            ['kategori' => null, 'nama' => 'Tribal 3'],
            ['kategori' => null, 'nama' => 'Tribal 4'],
            ['kategori' => null, 'nama' => 'Tribal 5'],
            ['kategori' => null, 'nama' => 'Tribal 6'],
            ['kategori' => null, 'nama' => 'Tribal 46'],
            ['kategori' => null, 'nama' => 'Trisula'], // 47
            ['kategori' => 'mika', 'nama' => '1W'],
        ];

        for ($i = 0; $i < count($varian); $i++) {
            DB::table('varians')->insert([
                'kategori' => $varian[$i]['kategori'],
                'nama' => $varian[$i]['nama']
            ]);
        }
    }
}
