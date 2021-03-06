<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StandarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $standar = [[
            'nama' => 'Absolute Revo',
            'id' => 1,
            'harga' => 12500
        ], [
            'nama' => 'Astrea 800',
            'id' => 2,
            'harga' => 12500
        ], [
            'nama' => 'Beat',
            'id' => 3,
            'harga' => 12500
        ], [
            'nama' => 'C70',
            'id' => 4,
            'harga' => 12500
        ], [
            'nama' => 'CB',
            'id' => 5,
            'harga' => 12500
        ], [
            'nama' => 'F1ZR',
            'id' => 6,
            'harga' => 12500
        ], [
            'nama' => 'GL PRO',
            'id' => 7,
            'harga' => 12500
        ], [
            'nama' => "Grand'97",
            'id' => 8,
            'harga' => 12500
        ], [
            'nama' => 'Jupiter MX',
            'id' => 9,
            'harga' => 12500
        ], [
            'nama' => 'Jupiter Z',
            'id' => 10,
            'harga' => 12500
        ], [
            'nama' => 'Karisma',
            'id' => 11,
            'harga' => 12500
        ], [
            'nama' => 'KLX',
            'id' => 11,
            'harga' => 12500
        ], [
            'nama' => 'Mio',
            'id' => 12,
            'harga' => 12500
        ], [
            'nama' => 'Prima',
            'id' => 13,
            'harga' => 12500
        ], [
            'nama' => 'RX King 02',
            'id' => 14,
            'harga' => 12500
        ], [
            'nama' => 'RX King 95',
            'id' => 14,
            'harga' => 12500
        ], [
            'nama' => 'RX-S',
            'id' => 15,
            'harga' => 12500
        ], [
            'nama' => 'RX Spesial',
            'id' => 16,
            'harga' => 12500
        ], [
            'nama' => 'Shogun',
            'id' => 17,
            'harga' => 12500
        ], [
            'nama' => 'Shogun 110',
            'id' => 18,
            'harga' => 12500
        ], [
            'nama' => 'Supra 125',
            'id' => 19,
            'harga' => 12500
        ], [
            'nama' => 'Supra Fit',
            'id' => 20,
            'harga' => 12500
        ], [
            'nama' => 'Supra Fit New',
            'id' => 21,
            'harga' => 12500
        ], [
            'nama' => 'Supra X',
            'id' => 22,
            'harga' => 12500
        ], [
            'nama' => 'Tiger',
            'id' => 23,
            'harga' => 12500
        ], [
            'nama' => 'Vario',
            'id' => 24,
            'harga' => 12500
        ]];

        $standar_variasi = [[
            'standar_id' => 1,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 2,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'yes',
            'alas' => 'no',
        ], [
            'standar_id' => 3,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 4,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'yes',
            'alas' => 'no',
        ], [
            'standar_id' => 5,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'yes',
            'alas' => 'no',
        ], [
            'standar_id' => 6,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 7,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 8,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 9,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 10,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 11,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 12,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 13,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'yes',
            'alas' => 'no',
        ], [
            'standar_id' => 14,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 15,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 16,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'yes',
            'alas' => 'no',
        ], [
            'standar_id' => 17,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 18,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 19,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 20,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 21,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 22,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 23,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'standar_id' => 24,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ]];

        $harga_jahit_kepala = 1000;
        $harga_jahit_samping = 1500;
        $harga_press = 1500;
        $harga_alas = 1500;
        $harga_busa = 1500;
        $variasi_std_harga = [[
            'variasi_standar' => 'jahit_kepala',
            'harga' => $harga_jahit_kepala
        ], [
            'variasi_standar' => 'jahit_samping',
            'harga' => $harga_jahit_samping
        ], [
            'variasi_standar' => 'press',
            'harga' => $harga_press
        ], [
            'variasi_standar' => 'alas',
            'harga' => $harga_alas
        ], [
            'variasi_standar' => 'busa',
            'harga' => $harga_busa
        ]];

        for ($i = 0; $i < count($standar); $i++) {
            DB::table('standars')->insert([
                'nama' => $standar[$i]['nama'],
                'harga_dasar' => $standar[$i]['harga']
            ]);

            $harga = $standar[$i]['harga'];

            if ($standar_variasi[$i]['jahit_samping'] === 1) {
                $harga += $harga_jahit_samping;
            }
            if ($standar_variasi[$i]['press'] === 1) {
                $harga += $harga_press;
            }
            if ($standar_variasi[$i]['alas'] === 1) {
                $harga += $harga_alas;
            }
            DB::table('standar_variasis')->insert([
                'standar_id' => $standar_variasi[$i]['standar_id'],
                'jahit_kepala' => $standar_variasi[$i]['jahit_kepala'],
                'jahit_samping' => $standar_variasi[$i]['jahit_samping'],
                'press' => $standar_variasi[$i]['press'],
                'alas' => $standar_variasi[$i]['alas'],
                'harga' => $harga
            ]);
        }
        for ($j = 0; $j < count($variasi_std_harga); $j++) {
            DB::table('variasistandar_hargas')->insert([
                'variasi_standar' => $variasi_std_harga[$j]['variasi_standar'],
                'harga' => $variasi_std_harga[$j]['harga'],
            ]);
        }
    }
}
