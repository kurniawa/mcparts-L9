<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bahan = [[
            'nama' => 'Amplas(RY)',
            'tipe' => null,
            'id' => 1,
            'harga' => 15000
        ], [
            'nama' => 'BigDot(MC)',
            'tipe' => 'A',
            'id' => 2,
            'harga' => 13000
        ], [
            'nama' => 'C24',
            'tipe' => 'A',
            'id' => 3,
            'harga' => 13000
        ], [
            'nama' => 'C30(MC)',
            'tipe' => 'A',
            'id' => 4,
            'harga' => 13000
        ], [
            'nama' => 'C38(EX)',
            'tipe' => 'A',
            'id' => 5,
            'harga' => 13000
        ], [
            'nama' => 'C38(MC)',
            'tipe' => 'A',
            'id' => 6,
            'harga' => 13000
        ], [
            'nama' => 'Carbon',
            'tipe' => null,
            'id' => 7,
            'harga' => 17000
        ], [
            'nama' => 'Grafitti',
            'tipe' => 'A',
            'id' => 8,
            'harga' => 13000
        ], [
            'nama' => 'Kulit Jeruk',
            'tipe' => 'B',
            'id' => 9,
            'harga' => 11500
        ], [
            'nama' => 'L55(CK)',
            'tipe' => null,
            'id' => 10,
            'harga' => 12000
        ], [
            'nama' => 'LuckyHole Hitam',
            'tipe' => 'B',
            'id' => 11,
            'harga' => 10000
        ], [
            'nama' => 'LuckyHole Warna',
            'tipe' => 'B',
            'id' => 12,
            'harga' => 10000
        ], [
            'nama' => 'Navaro(MC)',
            'tipe' => 'A',
            'id' => 13,
            'harga' => 13000
        ], [
            'nama' => 'U-Tangan(MC)',
            'tipe' => 'A',
            'id' => 14,
            'harga' => 13000
        ], [
            'nama' => 'Vario Coklat',
            'tipe' => 'A',
            'id' => 15,
            'harga' => 13000
        ], [
            'nama' => 'Vario(M)',
            'tipe' => 'A',
            'id' => 16,
            'harga' => 13000
        ], [
            'nama' => 'Vario(MC)',
            'tipe' => 'A',
            'id' => 17,
            'harga' => 13000
        ]];

        for ($i = 0; $i < count($bahan); $i++) {
            DB::table('bahans')->insert([
                'nama' => $bahan[$i]['nama'],
                'tipe' => $bahan[$i]['tipe'],
            ]);
            DB::table('bahan_hargas')->insert([
                'bahan_id' => $bahan[$i]['id'],
                'harga' => $bahan[$i]['harga']
            ]);
        }
    }
}
