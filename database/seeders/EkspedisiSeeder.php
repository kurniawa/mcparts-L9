<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EkspedisiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('ekspedisis')->insert([
            [
                'bentuk' => 'CV',
                'nama' => 'Angkasa',
                'alamat' => '["Jl. Mangga Dua Raya", "Ruko Mangga Dua Plaza", "Blok B, No. 06"]',
                'no_kontak' => '(021)6120 705',
            ], [
                'bentuk' => null,
                'nama' => 'Wira Agung',
                'alamat' => '["Jl. Tubagus Angke Blok D 1/9", "Ruko Taman Duta Mas"]',
                'no_kontak' => '(021) 5678 067',
            ]
        ]);
    }
}
