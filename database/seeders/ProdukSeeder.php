<?php

namespace Database\Seeders;

use App\Models\Produk;
use App\Models\ProdukHarga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProdukSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $produk = [
            [
                'tipe' => 'varia','bahan_id' => 1,'ukuran_id' => null,'jahit_id' => null,'standar_id' => null,'kombi_id' => null,
                'busastang_id' => null,'tankpad_id' => null,'tspjap_id' => null,'tipe_bahan' => null,'stiker_id' => null,
                'nama' => 'Amplas(CA) Polos',
                'nama_nota' => 'SJ Amplas(CA) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,
                'harga' => 16500,
            ],
            [
                'tipe' => 'varia','bahan_id' => 1,'ukuran_id' => null,'jahit_id' => 1,'standar_id' => null,'kombi_id' => null,
                'busastang_id' => null,'tankpad_id' => null,'tspjap_id' => null,'tipe_bahan' => null,'stiker_id' => null,
                'nama' => 'Amplas(CA) Polos + jht.Univ',
                'nama_nota' => 'SJ Amplas(CA) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,
                'harga' => 17500,
            ],
            [
                'tipe' => 'varia','bahan_id' => 1,'ukuran_id' => null,'jahit_id' => null,'standar_id' => null,'kombi_id' => null,
                'busastang_id' => null,'tankpad_id' => null,'tspjap_id' => null,'tipe_bahan' => null,'stiker_id' => null,
                'nama' => 'Amplas(CA) LG.Stiker',
                'nama_nota' => 'SJ Amplas(CA) LG.Stiker',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,
                'harga' => 20500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Bayang',
                'nama_nota' => 'SJ Amplas(RY) LG.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,
                'harga' => 17500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Bludru',
                'nama_nota' => 'SJ Amplas(RY) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,
                'harga' => 17500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => null, 'jahit_id' => 1, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Bludru + jht.Univ',
                'nama_nota' => 'SJ Amplas(RY) LG.Bludru + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,
                'harga' => 18500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Bordir',
                'nama_nota' => 'SJ Amplas(RY) LG.Bordir',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,
                'harga' => 17500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => 1, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Bordir uk.JB 93x53',
                'nama_nota' => 'SJ Amplas(RY) LG.Bordir uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 8
                'harga' => 21500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Mika 1W',
                'nama_nota' => 'SJ Amplas(RY) LG.Mika 1W',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,
                'harga' => 17500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Polymas',
                'nama_nota' => 'SJ Amplas(RY) LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,
                'harga' => 17500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => 1, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Polymas uk.JB 93x53',
                'nama_nota' => 'SJ Amplas(RY) LG.Polymas uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,//
                'harga' => 21500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Stiker',
                'nama_nota' => 'SJ Amplas(RY) LG.Stiker',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, //
                'harga' => 20500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => null, 'jahit_id' => 1, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Stiker + jht.Univ',
                'nama_nota' => 'SJ Amplas(RY) LG.Stiker + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,//
                'harga' => 21500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => 1, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Stiker uk.JB 93x53',
                'nama_nota' => 'SJ Amplas(RY) LG.Stiker uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,//
                'harga' => 24500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => 2, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) LG.Stiker uk.S-JB 97x53',
                'nama_nota' => 'SJ Amplas(RY) LG.Stiker uk.S-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,// 15
                'harga' => 26000,
            ],
            [
                'tipe' => 'varia','bahan_id' => 3,'ukuran_id' => null,'jahit_id' => null,'standar_id' => null,'kombi_id' => null,
                'busastang_id' => null,'tankpad_id' => null,'tspjap_id' => null,'tipe_bahan' => null,'stiker_id' => null,
                'nama' => 'Amplas(RY) Polos',
                'nama_nota' => 'SJ Amplas(RY) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,// 16
                'harga' => 16500,
            ],
            [
                'tipe' => 'varia','bahan_id' => 3,'ukuran_id' => null,'jahit_id' => 2,'standar_id' => null,'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) Polos + jht.ABS-RV',
                'nama_nota' => 'SJ Amplas(RY) Polos + jht.ABS-RV',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 17
                'harga' => 17500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => null, 'jahit_id' => 3, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) Polos + jht.RXK',
                'nama_nota' => 'SJ Amplas(RY) Polos + jht.RXK',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, //18
                'harga' => 17500,
            ],
            [
                'tipe' => 'varia','bahan_id' => 3,'ukuran_id' => null,'jahit_id' => 1,'standar_id' => null,'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) Polos + jht.Univ',
                'nama_nota' => 'SJ Amplas(RY) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, //19
                'harga' => 17500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => 1, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) Polos uk.JB 93x53',
                'nama_nota' => 'SJ Amplas(RY) Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 20
                'harga' => 20500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => 1, 'jahit_id' => 4, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Amplas(RY) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 21
                'harga' => 21500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => 2, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) Polos uk.S-JB 97x53',
                'nama_nota' => 'SJ Amplas(RY) Polos uk.S-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 22
                'harga' => 22000,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => 11, 'jahit_id' => 2, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) Polos uk.S-BIG-JB 100x68.5',
                'nama_nota' => 'SJ Amplas(RY) Polos uk.S-BIG-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 23
                'harga' => 26000,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3,'ukuran_id' => 1, 'jahit_id' => 2, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) T.Sablon Tribal 1-6',
                'nama_nota' => 'SJ Amplas(RY) T.Sablon Tribal 1-6',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 24
                'harga' => 21500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 3, 'ukuran_id' => 1, 'jahit_id' => 2, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(RY) Tulang Bayang + LG.Sablon',
                'nama_nota' => 'SJ Amplas(RY) Tulang Bayang + LG.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, //25
                'harga' => 22500,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 4,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(SBT) LG.Bludru',
                'nama_nota' => 'SJ Amplas(SBT) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 26
                'harga' => 20000,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 4,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(SBT) LG.Bordir',
                'nama_nota' => 'SJ Amplas(SBT) LG.Bordir',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 27
                'harga' => 20000,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 4,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(SBT) LG.Polymas',
                'nama_nota' => 'SJ Amplas(SBT) LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 28
                'harga' => 20000,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 4,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(SBT) LG.Stiker',
                'nama_nota' => 'SJ Amplas(SBT) LG.Stiker',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 29
                'harga' => 23000,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 4,'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(SBT) Polos',
                'nama_nota' => 'SJ Amplas(SBT) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 30
                'harga' => 19000,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 4,'ukuran_id' => null, 'jahit_id' => 1, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(SBT) Polos + jht.Univ',
                'nama_nota' => 'SJ Amplas(SBT) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 31
                'harga' => 20000,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 4,'ukuran_id' => 1, 'jahit_id' => 4, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Amplas(SBT) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Amplas(SBT) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 32
                'harga' => 24000,
            ],
            [
                'tipe' => 'varia', 'bahan_id' => 6,'ukuran_id' => 1, 'jahit_id' => 4, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'BigDot(MC) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ BigDot(MC) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 19500,
            ],
            [
                'tipe' => 'kombi', 'bahan_id' => null, 'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => 6,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Motif Sixpack 2 Warna + jht.Univ',
                'nama_nota' => 'SJ Motif Sixpack 2 Warna + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, //
                'harga' => 29000,
            ],
            [
                'tipe' => 'std', 'bahan_id' => null, 'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => 20, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Standar Supra Fit',
                'nama_nota' => 'SJ Standar Supra Fit',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, //
                'harga' => 15000,
            ],
            [
                'tipe' => 'tankpad', 'bahan_id' => null, 'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => 5, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'TP Fox Dimensi',
                'nama_nota' => 'TP Fox Dimensi',
                'tipe_packing' => 'dus',
                'aturan_packing' => 500, //
                'harga' => 5500,
            ],
            [
                'tipe' => 'busastang', 'bahan_id' => null, 'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => 1, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => null,
                'nama' => 'Busa-Stang',
                'nama_nota' => 'Busa-Stang',
                'tipe_packing' => 'bal',
                'aturan_packing' => 72, //
                'harga' => 8000,
            ],
            [
                'tipe' => 'spjap', 'bahan_id' => null, 'ukuran_id' => 1, 'jahit_id' => 4, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => 2, 'tipe_bahan' => 'A', 'stiker_id' => null,
                'nama' => 'Bahan(A) T.Sixpack + Busa uk.JB + jht.JB',
                'nama_nota' => 'SJ Bahan(A) T.Sixpack + Busa uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100,
                'harga' => 31500,
            ],
            [
                'tipe' => 'stiker', 'bahan_id' => null, 'ukuran_id' => null, 'jahit_id' => null, 'standar_id' => null, 'kombi_id' => null,
                'busastang_id' => null, 'tankpad_id' => null, 'tspjap_id' => null, 'tipe_bahan' => null, 'stiker_id' => 1,
                'nama' => 'Stiker Api',
                'nama_nota' => 'Stiker Api',
                'tipe_packing' => null,
                'aturan_packing' => null, //
                'harga' => 4000,
            ],
        ];
        for ($i = 0; $i < count($produk); $i++) {
            $inserted_produk = Produk::create([
                'tipe' => $produk[$i]['tipe'],
                // 'properties' => $produk[$i]['properties'],
                'bahan_id' => $produk[$i]['bahan_id'],
                // 'variasi_id' => $produk[$i]['variasi_id'],
                'ukuran_id' => $produk[$i]['ukuran_id'],
                'jahit_id' => $produk[$i]['jahit_id'],
                'standar_id' => $produk[$i]['standar_id'],
                'kombi_id' => $produk[$i]['kombi_id'],
                'busastang_id' => $produk[$i]['busastang_id'],
                'tankpad_id' => $produk[$i]['tankpad_id'],
                'tspjap_id' => $produk[$i]['tspjap_id'],
                'tipe_bahan' => $produk[$i]['tipe_bahan'],
                'stiker_id' => $produk[$i]['stiker_id'],
                'nama' => $produk[$i]['nama'],
                'nama_nota' => $produk[$i]['nama_nota'],
                'tipe_packing' => $produk[$i]['tipe_packing'],
                'aturan_packing' => $produk[$i]['aturan_packing'],
            ]);

            ProdukHarga::create([
                'produk_id' => $inserted_produk['id'],
                'harga' => $produk[$i]['harga'],
            ]);
        }

        /** LIST LG.STIKER
         * - TDR
         * - YSS
        */

    }
}
