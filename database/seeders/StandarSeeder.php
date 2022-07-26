<?php

namespace Database\Seeders;

use App\Models\Standar;
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
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Astrea 800',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'yes',
            'alas' => 'no',
        ], [
            'nama' => 'Beat',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'C70',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'yes',
            'alas' => 'no',
        ], [
            'nama' => 'CB',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'yes',
            'alas' => 'no',
        ], [
            'nama' => 'F1ZR',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'GL PRO',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => "Grand'97",
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Jupiter MX',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Jupiter Z',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Karisma',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'KLX Hitam',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Mio',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Prima',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'yes',
            'alas' => 'no',
        ], [
            'nama' => 'RX King 02',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'RX King 95',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'RX-S',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'yes',
            'alas' => 'no',
        ], [
            'nama' => 'RX Spesial',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Shogun',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Shogun 110',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Supra 125',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Supra Fit',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Supra Fit New',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Supra X',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'no',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Tiger',
            'harga' => 12500,
            'jahit_kepala' => 'yes',
            'jahit_samping' => 'yes',
            'press' => 'no',
            'alas' => 'no',
        ], [
            'nama' => 'Vario',
            'harga' => 12500,
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
            $new_inserted_standar = Standar::create([
                'nama' => $standar[$i]['nama'],
                'harga_dasar' => $standar[$i]['harga']
            ]);

            $harga = $standar[$i]['harga'];

            if ($standar[$i]['jahit_samping'] === 'yes') {
                $harga += $harga_jahit_samping;
            }
            if ($standar[$i]['press'] === 'yes') {
                $harga += $harga_press;
            }
            if ($standar[$i]['alas'] === 'yes') {
                $harga += $harga_alas;
            }
            DB::table('standar_variasis')->insert([
                'standar_id' => $new_inserted_standar['id'],
                'jahit_kepala' => $standar[$i]['jahit_kepala'],
                'jahit_samping' => $standar[$i]['jahit_samping'],
                'press' => $standar[$i]['press'],
                'alas' => $standar[$i]['alas'],
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
