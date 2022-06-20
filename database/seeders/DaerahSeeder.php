<?php

namespace Database\Seeders;

use App\Models\Daerah;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DaerahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $daerahs = [
            // Kalimantan
            ['nama'=>'Banjarmasin', 'negara_id'=>1, 'pulau_id'=>1], // 1
            ['nama'=>'Ketapang', 'negara_id'=>1, 'pulau_id'=>1],
            ['nama'=>'Pontianak', 'negara_id'=>1, 'pulau_id'=>1],
            ['nama'=>'Samarinda', 'negara_id'=>1, 'pulau_id'=>1],
            ['nama'=>'Sambas', 'negara_id'=>1, 'pulau_id'=>1], // 5
            ['nama'=>'Sei Pinyuh', 'negara_id'=>1, 'pulau_id'=>1],
            ['nama'=>'Singkawang', 'negara_id'=>1, 'pulau_id'=>1],
            ['nama'=>'Sintang', 'negara_id'=>1, 'pulau_id'=>1],
            // Jawa
            ['nama'=>'Bandung', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Bekasi', 'negara_id'=>1, 'pulau_id'=>2], // 10
            ['nama'=>'Bogor', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Ciamis', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Ciawi', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Cibubur', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Cibinong', 'negara_id'=>1, 'pulau_id'=>2], // 15
            ['nama'=>'Ciluar', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Cinere', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Cipanas', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Cirebon', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Citeureup', 'negara_id'=>1, 'pulau_id'=>2], // 20
            ['nama'=>'Depok', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Jakarta', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Kranggan', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Kediri', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Kuningan', 'negara_id'=>1, 'pulau_id'=>2], // 25
            ['nama'=>'Malang', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Pamanukan', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Pluit', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Semarang', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Sukabumi', 'negara_id'=>1, 'pulau_id'=>2], // 30
            ['nama'=>'Sumenep', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Surabaya', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Tangerang', 'negara_id'=>1, 'pulau_id'=>2],
            ['nama'=>'Tulungagung', 'negara_id'=>1, 'pulau_id'=>2],
            // Sumatra
            ['nama'=>'Bangka', 'negara_id'=>1, 'pulau_id'=>3], // 35
            ['nama'=>'Baubau', 'negara_id'=>1, 'pulau_id'=>3],
            ['nama'=>'Bukittinggi', 'negara_id'=>1, 'pulau_id'=>3],
            ['nama'=>'Jambi', 'negara_id'=>1, 'pulau_id'=>3],
            ['nama'=>'Lahat', 'negara_id'=>1, 'pulau_id'=>3],
            ['nama'=>'Medan', 'negara_id'=>1, 'pulau_id'=>3], // 40
            ['nama'=>'Padang Panjang', 'negara_id'=>1, 'pulau_id'=>3],
            ['nama'=>'Palembang', 'negara_id'=>1, 'pulau_id'=>3],
            ['nama'=>'Pekanbaru', 'negara_id'=>1, 'pulau_id'=>3],
            // Sulawesi
            ['nama'=>'Gorontalo', 'negara_id'=>1, 'pulau_id'=>4],
            ['nama'=>'Luwuk', 'negara_id'=>1, 'pulau_id'=>4], // 45
            ['nama'=>'Makassar', 'negara_id'=>1, 'pulau_id'=>4],
            ['nama'=>'Manado', 'negara_id'=>1, 'pulau_id'=>4],
            // Papua
            ['nama'=>'Jayapura', 'negara_id'=>1, 'pulau_id'=>5],
            // NTB
            ['nama'=>'Lombok', 'negara_id'=>1, 'pulau_id'=>6],
            // Maluku
            ['nama'=>'Ambon', 'negara_id'=>1, 'pulau_id'=>7], // 50

        ];

        foreach ($daerahs as $daerah) {
            Daerah::create([
                'nama'=>$daerah['nama'],
                'negara_id'=>$daerah['negara_id'],
                'pulau_id'=>$daerah['pulau_id'],
            ]);
        }
    }
}
