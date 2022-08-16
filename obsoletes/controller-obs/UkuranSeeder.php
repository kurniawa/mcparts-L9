<?php

namespace Database\Seeders;

use App\Models\Ukuran;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UkuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // UKURAN SEEDER

        $ukuran = [
            [
                'nama' => 'JB93x53',
                'nama_nota' => 'JB',
                'harga' => 4000
            ], [
                'nama' => 'SuperJB97x53',
                'nama_nota' => 'Super-JB',
                'harga' => 5500
            ], [
                'nama' => 'Scoopy',
                'nama_nota' => 'Scoopy',
                'harga' => 5500
            ], [
                'nama' => 'NMAX',
                'nama_nota' => 'NMAX',
                'harga' => 5500
            ], [
                'nama' => 'PCX',
                'nama_nota' => 'PCX',
                'harga' => 5500
            ], [
                'nama' => 'Aerox',
                'nama_nota' => 'Aerox',
                'harga' => 5500
            ], [
                'nama' => 'FreeGo',
                'nama_nota' => 'FreeGo',
                'harga' => 5500
            ], [
                'nama' => 'Vario 150',
                'nama_nota' => 'Vario 150',
                'harga' => 5500
            ], [
                'nama' => 'MioSoulGT125',
                'nama_nota' => 'MioSoulGT125',
                'harga' => 5500
            ], [
                'nama' => 'MEGA100x57',
                'nama_nota' => 'MEGA', // 10
                'harga' => 7500
            ], [
                'nama' => 'GIGA100x68.5',
                'nama_nota' => 'GIGA',
                'harga' => 9500
            ]
        ];
        for ($i = 0; $i < count($ukuran); $i++) {
            $new_inserted_ukuran = Ukuran::create([
                'nama' => $ukuran[$i]['nama'],
                'nama_nota' => $ukuran[$i]['nama_nota']
            ]);
            DB::table('ukuran_hargas')->insert([
                'ukuran_id' => $new_inserted_ukuran['id'],
                'harga' => $ukuran[$i]['harga']
            ]);
        }
    }
}
