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
                'nama' => 'JB 93x53',
                'nama_nota' => 'JB',
                'harga' => 4000
            ], [
                'nama' => 'S-JB 97x53',
                'nama_nota' => 'S-JB',
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
                'nama' => 'Freego',
                'nama_nota' => 'Freego',
                'harga' => 5500
            ], [
                'nama' => 'Vario 150',
                'nama_nota' => 'Vario 150',
                'harga' => 5500
            ], [
                'nama' => 'Mio Soul GT 125',
                'nama_nota' => 'Mio Soul GT 125',
                'harga' => 5500
            ], [
                'nama' => 'S-BIG 100x57',
                'nama_nota' => 'S-BIG', // 10
                'harga' => 7500
            ], [
                'nama' => 'S-BIG-JB 100x68.5',
                'nama_nota' => 'S-BIG-JB',
                'harga' => 9500
            ], [

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
