<?php

namespace Database\Seeders;

use App\Models\PelangganReseller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pelanggan = [
            ['nama' => '3 Putra Motor', 'alamat' => '["Jl. Sutoyo 5 No. 140", "Kel. Teluk Dalam, Kec. Banjar Barat", "Banjarmasin"]', 'daerah_id' => 1, 'no_kontak' => '0822 5363 3222', 'pulau_id' => 1,'initial' => '3PM', 'is_reseller' => 'no'],
            ['nama' => 'Akong', 'alamat' => '["Pluit, Jakarta"]', 'daerah_id' => 24, 'no_kontak' => '0812 9120 0168', 'pulau_id' => 2,'initial' => 'AK', 'is_reseller' => 'yes'],
            ['nama' => 'Karya Motor', 'alamat' => '["Jl. Jurung No.6", "Simpang Wahidin, Medan"]', 'daerah_id' => 34, 'no_kontak' => '', 'pulau_id' => 3,'initial' => 'KAR', 'is_reseller' => 'no']
        ];

        $pelanggan_resellers = [
            ['reseller_id'=>2, 'pelanggan_id'=>3]
        ];

        for ($i = 0; $i < count($pelanggan); $i++) {
            DB::table('pelanggans')->insert([
                'nama' => $pelanggan[$i]['nama'],
                'alamat' => $pelanggan[$i]['alamat'],
                'no_kontak' => $pelanggan[$i]['no_kontak'],
                'pulau_id' => $pelanggan[$i]['pulau_id'],
                'daerah_id' => $pelanggan[$i]['daerah_id'],
                'initial' => $pelanggan[$i]['initial'],
                'is_reseller' => $pelanggan[$i]['is_reseller'],
            ]);
        }

        foreach ($pelanggan_resellers as $pelanggan_reseller) {
            PelangganReseller::create([
                'reseller_id' => $pelanggan_reseller['reseller_id'],
                'pelanggan_id' => $pelanggan_reseller['pelanggan_id'],
            ]);
        }

    }
}
