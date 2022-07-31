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
            ['kategori' => 'honda', 'nama' => 'C70'],
            ['kategori' => 'honda', 'nama' => 'CB'],
            ['kategori' => 'honda', 'nama' => 'Honda'],
            ['kategori' => 'yamaha', 'nama' => 'RXK'],
            ['kategori' => 'netral', 'nama' => 'Netral'],
            ['kategori' => 'netral', 'nama' => '46'],
            ['kategori' => 'netral', 'nama' => 'Alpinestar'],
            ['kategori' => 'netral', 'nama' => 'Bikers'],
            ['kategori' => 'netral', 'nama' => 'Black'],
            ['kategori' => 'netral', 'nama' => 'BRIDE'],
            ['kategori' => 'netral', 'nama' => 'CW'],
            ['kategori' => 'netral', 'nama' => 'Daytona'],
            ['kategori' => 'netral', 'nama' => 'DBS'],
            ['kategori' => 'netral', 'nama' => 'Diavel'],
            ['kategori' => 'netral', 'nama' => 'Fox'],
            ['kategori' => 'netral', 'nama' => 'HKS'],
            ['kategori' => 'netral', 'nama' => 'Kitaco'],
            ['kategori' => 'netral', 'nama' => 'Monster'],
            ['kategori' => 'netral', 'nama' => 'MotoGP'],
            ['kategori' => 'netral', 'nama' => 'Movistar'],
            ['kategori' => 'netral', 'nama' => 'Movistar XLGP'], // tidak perlu ditulis racing
            ['kategori' => 'netral', 'nama' => 'NGO'],
            ['kategori' => 'netral', 'nama' => 'Kawahara'],
            ['kategori' => 'netral', 'nama' => 'RacingBoy'],
            ['kategori' => 'netral', 'nama' => 'RacingBoy XLGP'],
            ['kategori' => 'netral', 'nama' => 'RacingBoy Thailand'],
            ['kategori' => 'netral', 'nama' => 'Repsol'],
            ['kategori' => 'netral', 'nama' => 'Ride It'],
            ['kategori' => 'netral', 'nama' => 'Rockstar'],
            ['kategori' => 'netral', 'nama' => 'Rossy 46'],
            ['kategori' => 'netral', 'nama' => '46 The Doctor'],
            ['kategori' => 'netral', 'nama' => 'Sepatu'],
            ['kategori' => 'netral', 'nama' => 'Sa-Korn'],
            ['kategori' => 'netral', 'nama' => 'Somjin'],
            ['kategori' => 'netral', 'nama' => 'TDR'],
            ['kategori' => 'netral', 'nama' => 'Tokage'],
            ['kategori' => 'netral', 'nama' => 'UpinIpin'],
            ['kategori' => 'netral', 'nama' => 'Yamaha'],
            ['kategori' => 'netral', 'nama' => 'Yoshimura'],
            ['kategori' => 'netral', 'nama' => 'YSS'], // 29
            // Tato
            ['kategori' => 'multiple', 'nama' => 'Bride 9X'],
            ['kategori' => 'multiple', 'nama' => 'Blok Bride'], // campur
            ['kategori' => 'multiple', 'nama' => 'Blok Bride Pelangi'],
            ['kategori' => 'multiple', 'nama' => 'Tribal 5X'],
            ['kategori' => 'multiple', 'nama' => 'Tribal Bride 5X'],
            ['kategori' => 'multiple', 'nama' => 'Kawahara 8X'],
            ['kategori' => 'multiple', 'nama' => 'NGO 7X'],
            ['kategori' => 'multiple', 'nama' => 'Somjin 7X'],
            ['kategori' => 'multiple', 'nama' => 'Thailook 5X'],
            ['kategori' => 'multiple', 'nama' => 'Tribal 5X'], // campur

            ['kategori' => 'anime', 'nama' => 'Doraemon'],
            ['kategori' => 'anime', 'nama' => 'Doraemon Jepang'],
            ['kategori' => 'anime', 'nama' => 'Doraemon New'],
            ['kategori' => 'anime', 'nama' => 'Straw Hat'],
            ['kategori' => 'kartun', 'nama' => 'Kartun'],
            ['kategori' => 'kartun', 'nama' => 'HelloKitty2'],
            ['kategori' => 'kartun', 'nama' => 'Keropi'],
            ['kategori' => 'kartun', 'nama' => 'Keropi No.9'],
            ['kategori' => 'kartun', 'nama' => 'MickeyMouse'],
            ['kategori' => 'kartun', 'nama' => 'Minion'],
            ['kategori' => 'kartun', 'nama' => 'SpongeBob'],
            ['kategori' => 'binatang', 'nama' => 'Kelabang'],
            ['kategori' => 'binatang', 'nama' => 'Laba"'],
            ['kategori' => 'binatang', 'nama' => 'Macan'],
            ['kategori' => 'binatang', 'nama' => 'Naga'],
            ['kategori' => 'binatang', 'nama' => 'Scorpion'],
            ['kategori' => null, 'nama' => 'Menara'],
            ['kategori' => 'tulang', 'nama' => 'Prima'], // 39
            ['kategori' => 'tribal', 'nama' => 'Cumi'],
            ['kategori' => 'tribal', 'nama' => 'Tribal 1-6'],
            ['kategori' => 'tribal', 'nama' => 'Tribal 1'],
            ['kategori' => 'tribal', 'nama' => 'Tribal 2'],
            ['kategori' => 'tribal', 'nama' => 'Tribal 3'],
            ['kategori' => 'tribal', 'nama' => 'Tribal 4'],
            ['kategori' => 'tribal', 'nama' => 'Tribal 5'],
            ['kategori' => 'tribal', 'nama' => 'Tribal 6'],
            ['kategori' => 'tribal', 'nama' => 'Tribal 46'],
            ['kategori' => 'tribal', 'nama' => 'Tribal Movistar'],
            ['kategori' => 'tribal', 'nama' => 'Tribal Petir'],
            ['kategori' => 'tribal', 'nama' => 'Trisula'], // 47 - T.Bayang, T.Polymas, T.Sablon
            ['kategori' => 'mika', 'nama' => '1W'],
            // ['kategori' => 'event', 'nama' => 'Euro 2021'],
            ['kategori' => 'event', 'nama' => 'Modi'],
            ['kategori' => 'list', 'nama' => 'Kawahara'],
            ['kategori' => 'campur', 'nama' => 'Canpur'],
        ];

        for ($i = 0; $i < count($varian); $i++) {
            DB::table('varians')->insert([
                'kategori' => $varian[$i]['kategori'],
                'nama' => $varian[$i]['nama']
            ]);
        }
    }
}
