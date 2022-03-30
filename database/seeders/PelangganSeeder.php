<?php

namespace Database\Seeders;

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
            ['nama' => '3 Putra Motor', 'alamat' => '["Jl. Sutoyo 5 No. 140", "Kel. Teluk Dalam, Kec. Banjar Barat", "Banjarmasin"]', 'daerah_id' => 1, 'no_kontak' => '0822 5363 3222', 'pulau_id' => 1,'initial' => '3PM', 'reseller_id' => null],
            ['nama' => 'Akong', 'alamat' => '["Pluit, Jakarta"]', 'daerah_id' => 24, 'no_kontak' => '0812 9120 0168', 'pulau_id' => 2,'initial' => 'AK', 'reseller_id' => null],
            ['nama' => 'Karya Motor', 'alamat' => '["Jl. Jurung No.6", "Simpang Wahidin, Medan"]', 'daerah_id' => 34, 'no_kontak' => '', 'pulau_id' => 3,'initial' => 'KAR', 'reseller_id' => 2],
            ['nama' => 'Karya Motor', 'alamat' => '["Jl. Jurung No.6", "Simpang Wahidin, Medan"]', 'daerah_id' => 34, 'no_kontak' => '', 'pulau_id' => 3,'initial' => 'KAR', 'reseller_id' => null]
        ];

        for ($i = 0; $i < count($pelanggan); $i++) {
            DB::table('pelanggans')->insert([
                'nama' => $pelanggan[$i]['nama'],
                'alamat' => $pelanggan[$i]['alamat'],
                'no_kontak' => $pelanggan[$i]['no_kontak'],
                'pulau_id' => $pelanggan[$i]['pulau_id'],
                'daerah_id' => $pelanggan[$i]['daerah_id'],
                'initial' => $pelanggan[$i]['initial'],
                'reseller_id' => $pelanggan[$i]['reseller_id'],
            ]);
        }
    }
}
