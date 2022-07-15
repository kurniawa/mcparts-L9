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
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(CA) Polos',
                'nama_nota' => 'SJ Amplas(CA) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 1
                'harga' => 16500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(CA) Polos + jht.Univ',
                'nama_nota' => 'SJ Amplas(CA) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 2
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(CA) LG.Stiker',
                'nama_nota' => 'SJ Amplas(CA) LG.Stiker',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 3
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Bayang',
                'nama_nota' => 'SJ Amplas(RY) LG.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 4
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Bludru',
                'nama_nota' => 'SJ Amplas(RY) LG.Bludru',
                'tipe_packing' => 'colly', // 5
                'aturan_packing' => 150,
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Bludru + jht.Univ',
                'nama_nota' => 'SJ Amplas(RY) LG.Bludru + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 6
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Bordir',
                'nama_nota' => 'SJ Amplas(RY) LG.Bordir',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 7
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Bordir uk.JB 93x53',
                'nama_nota' => 'SJ Amplas(RY) LG.Bordir uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 8
                'harga' => 21500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Mika 1W',
                'nama_nota' => 'SJ Amplas(RY) LG.Mika 1W',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 9
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Polymas',
                'nama_nota' => 'SJ Amplas(RY) LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 10
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Polymas uk.JB 93x53',
                'nama_nota' => 'SJ Amplas(RY) LG.Polymas uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 11
                'harga' => 21500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Stiker',
                'nama_nota' => 'SJ Amplas(RY) LG.Stiker',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,  // 12
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Stiker + jht.Univ',
                'nama_nota' => 'SJ Amplas(RY) LG.Stiker + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 13
                'harga' => 21500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Stiker uk.JB 93x53',
                'nama_nota' => 'SJ Amplas(RY) LG.Stiker uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 14
                'harga' => 24500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) LG.Stiker uk.Super-JB 97x53',
                'nama_nota' => 'SJ Amplas(RY) LG.Stiker uk.Super-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,// 15
                'harga' => 26000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) Polos',
                'nama_nota' => 'SJ Amplas(RY) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150,// 16
                'harga' => 16500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) Polos + jht.ABS-RV',
                'nama_nota' => 'SJ Amplas(RY) Polos + jht.ABS-RV',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 17
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) Polos + jht.RXK',
                'nama_nota' => 'SJ Amplas(RY) Polos + jht.RXK',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, //18
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) Polos + jht.Univ',
                'nama_nota' => 'SJ Amplas(RY) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, //19
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) Polos uk.JB 93x53',
                'nama_nota' => 'SJ Amplas(RY) Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 20
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Amplas(RY) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 21
                'harga' => 21500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) Polos uk.Super-JB 97x53',
                'nama_nota' => 'SJ Amplas(RY) Polos uk.Super-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 22
                'harga' => 22000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) Polos uk.S-BIG-JB 100x68.5',
                'nama_nota' => 'SJ Amplas(RY) Polos uk.S-BIG-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 23
                'harga' => 26000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) T.Sablon Tribal 1-6',
                'nama_nota' => 'SJ Amplas(RY) T.Sablon Tribal 1-6',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 24
                'harga' => 21500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(RY) Tulang Bayang + LG.Sablon',
                'nama_nota' => 'SJ Amplas(RY) Tulang Bayang + LG.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, //25
                'harga' => 22500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(SBT) LG.Bludru',
                'nama_nota' => 'SJ Amplas(SBT) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 26
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(SBT) LG.Bordir',
                'nama_nota' => 'SJ Amplas(SBT) LG.Bordir',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 27
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(SBT) LG.Polymas',
                'nama_nota' => 'SJ Amplas(SBT) LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 28
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(SBT) LG.Stiker',
                'nama_nota' => 'SJ Amplas(SBT) LG.Stiker',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 29
                'harga' => 23000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(SBT) Polos',
                'nama_nota' => 'SJ Amplas(SBT) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 30
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(SBT) Polos + jht.Univ',
                'nama_nota' => 'SJ Amplas(SBT) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 31
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Amplas(SBT) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Amplas(SBT) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 32
                'harga' => 24000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(CK) Polos uk.JB 93x53',
                'nama_nota' => 'SJ BigDot(CK) Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(CK) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ BigDot(CK) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) LG.Bludru',
                'nama_nota' => 'SJ BigDot(MC) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) LG.Bludru + jht.Univ',
                'nama_nota' => 'SJ BigDot(MC) LG.Bludru + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 16500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) LG.Polymas',
                'nama_nota' => 'SJ BigDot(MC) LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) Polos',
                'nama_nota' => 'SJ BigDot(MC) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 14500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) Polos + jht.ABS-RV',
                'nama_nota' => 'SJ BigDot(MC) Polos + jht.ABS-RV',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) Polos + jht.RXK',
                'nama_nota' => 'SJ BigDot(MC) Polos + jht.RXK',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) Polos + jht.Univ',
                'nama_nota' => 'SJ BigDot(MC) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) Polos uk.JB 93x53',
                'nama_nota' => 'SJ BigDot(MC) Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ BigDot(MC) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 33
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) Polos uk.Super-JB 97x53',
                'nama_nota' => 'SJ BigDot(MC) Polos uk.Super-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) T.Polymas',
                'nama_nota' => 'SJ BigDot(MC) T.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MC) Tulang Bayang',
                'nama_nota' => 'SJ BigDot(MC) Tulang Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MCR) LG.Bludru',
                'nama_nota' => 'SJ BigDot(MCR) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MCR) Polos',
                'nama_nota' => 'SJ BigDot(MCR) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MCR) Polos + jht.ABS-RV',
                'nama_nota' => 'SJ BigDot(MCR) Polos + jht.ABS-RV',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MCR) Polos + jht.Univ',
                'nama_nota' => 'SJ BigDot(MCR) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MCR) Polos uk.JB 93x53',
                'nama_nota' => 'SJ BigDot(MCR) Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MCR) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ BigDot(MCR) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'BigDot(MCR) T.Polymas',
                'nama_nota' => 'SJ BigDot(MCR) T.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 LG.Bayang',
                'nama_nota' => 'SJ C24 LG.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 LG.Polymas',
                'nama_nota' => 'SJ C24 LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 LG.Sablon',
                'nama_nota' => 'SJ C24 LG.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 Polos',
                'nama_nota' => 'SJ C24 Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 Polos + jht.Univ',
                'nama_nota' => 'SJ C24 Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 Polos uk.JB 93x53',
                'nama_nota' => 'SJ C24 Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ C24 Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 Polos uk.Aerox + jht.Aerox',
                'nama_nota' => 'SJ C24 Polos uk.Aerox + jht.Aerox',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 Polos uk.NMAX + jht.NMAX',
                'nama_nota' => 'SJ C24 Polos uk.NMAX + jht.NMAX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon Blok Bride Pelangi',
                'nama_nota' => 'SJ C24 T.Sablon Blok Bride Pelangi',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon FOX',
                'nama_nota' => 'SJ C24 T.Sablon FOX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon Modi',
                'nama_nota' => 'SJ C24 T.Sablon Modi',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon NGO 7X',
                'nama_nota' => 'SJ C24 T.Sablon NGO 7X',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon Racing Boy List Kawahara',
                'nama_nota' => 'SJ C24 T.Sablon Racing Boy List Kawahara',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon Straw Hat',
                'nama_nota' => 'SJ C24 T.Sablon Straw Hat',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon Thailook 5X',
                'nama_nota' => 'SJ C24 T.Sablon Thailook 5X',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon Tribal 1',
                'nama_nota' => 'SJ C24 T.Sablon Tribal 1',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon Tribal 5',
                'nama_nota' => 'SJ C24 T.Sablon Tribal 5',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon Trisula',
                'nama_nota' => 'SJ C24 T.Sablon Trisula',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Polymas',
                'nama_nota' => 'SJ C24 T.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C24 T.Sablon',
                'nama_nota' => 'SJ C24 T.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C30(MC) LG.Bludru',
                'nama_nota' => 'SJ C30(MC) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C30(MC) Polos',
                'nama_nota' => 'SJ C30(MC) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C30(MC) Polos + jht.RXK',
                'nama_nota' => 'SJ C30(MC) Polos + jht.RXK',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C30(MC) Polos + jht.Univ',
                'nama_nota' => 'SJ C30(MC) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C30(MC) Polos uk.JB 93x53',
                'nama_nota' => 'SJ C30(MC) Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C30(MC) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ C30(MC) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C30(MC) Polos uk.Super-JB 97x53',
                'nama_nota' => 'SJ C30(MC) Polos uk.Super-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C30(MC) Polos uk.MioSoulGT125 + jht.MioSoulGT125',
                'nama_nota' => 'SJ C30(MC) Polos uk.MioSoulGT125 + jht.MioSoulGT125',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'C30(MC) T.Sixpack + Busa + jht.Univ',
                'nama_nota' => 'SJ C30(MC) T.Sixpack + Busa + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 27000,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'C30(MC) T.Sixpack uk.JB 93x53 + Busa',
                'nama_nota' => 'SJ C30(MC) T.Sixpack uk.JB + Busa',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 30500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'C30(MC) T.Sixpack uk.JB 93x53 + Busa + jht.JB',
                'nama_nota' => 'SJ C30(MC) T.Sixpack uk.JB + Busa + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C30(MC) T.Polymas',
                'nama_nota' => 'SJ C30(MC) T.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) LG.Bludru',
                'nama_nota' => 'SJ C38(MC) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) Polos',
                'nama_nota' => 'SJ C38(MC) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) Polos + jht.Univ',
                'nama_nota' => 'SJ C38(MC) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ C38(MC) uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) uk.Aerox + jht.Aerox',
                'nama_nota' => 'SJ C38(MC) uk.Aerox + jht.Aerox',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) uk.FreeGo + jht.FreeGo',
                'nama_nota' => 'SJ C38(MC) uk.FreeGo + jht.FreeGo',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) uk.JB 93x53',
                'nama_nota' => 'SJ C38(MC) uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ C38(MC) uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) uk.MioSoulGT125 + jht.MioSoulGT125',
                'nama_nota' => 'SJ C38(MC) uk.MioSoulGT125 + jht.MioSoulGT125',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) uk.NMAX + jht.NMAX',
                'nama_nota' => 'SJ C38(MC) uk.NMAX + jht.NMAX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) uk.PCX + jht.PCX',
                'nama_nota' => 'SJ C38(MC) uk.PCX + jht.PCX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) uk.Super-JB 97x53 + jht.JB',
                'nama_nota' => 'SJ C38(MC) uk.Super-JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'T.Sixpack C38(MC) + Busa + jht.Univ',
                'nama_nota' => 'SJ T.Sixpack C38(MC) + Busa + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 27000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'C38(MC) T.Polymas',
                'nama_nota' => 'SJ C38(MC) T.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon LG.Bludru',
                'nama_nota' => 'SJ Carbon LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon LG.Bludru uk.JB 93x53',
                'nama_nota' => 'SJ Carbon LG.Bludru uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 24000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon LG.Bludru uk.Super-JB 97x53',
                'nama_nota' => 'SJ Carbon LG.Bludru uk.Super-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 25500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon LG.Bordir',
                'nama_nota' => 'SJ Carbon LG.Bordir',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon LG.Bordir + jht.Univ',
                'nama_nota' => 'SJ Carbon LG.Bordir + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon LG.Bordir Bikers',
                'nama_nota' => 'SJ Carbon LG.Bordir Bikers',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon LG.Bordir uk.Super-JB 97x53',
                'nama_nota' => 'SJ Carbon LG.Bordir uk.Super-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 25500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon LG.Sablon Sakorn',
                'nama_nota' => 'SJ Carbon LG.Sablon Sakorn',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon LG.Stiker',
                'nama_nota' => 'SJ Carbon LG.Stiker',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 23000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon LG.Stiker + jht.Univ',
                'nama_nota' => 'SJ Carbon LG.Stiker + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 24000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Polos',
                'nama_nota' => 'SJ Carbon Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Polos + jht.RXK',
                'nama_nota' => 'SJ Carbon Polos + jht.RXK',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Polos + jht.Univ',
                'nama_nota' => 'SJ Carbon Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Polos uk.JB 93x53',
                'nama_nota' => 'SJ Carbon Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 23000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Carbon Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 24000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Polos uk.Super-JB 97x53',
                'nama_nota' => 'SJ Carbon Polos uk.Super-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 24500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Polos uk.Aerox + jht.Aerox',
                'nama_nota' => 'SJ Carbon Polos uk.Aerox + jht.Aerox',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 25500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Polos uk.NMAX',
                'nama_nota' => 'SJ Carbon Polos uk.NMAX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 24500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Polos uk.NMAX + jht.NMAX',
                'nama_nota' => 'SJ Carbon Polos uk.NMAX + jht.NMAX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 25500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'Carbon T.Sixpack uk.Super-JB + Busa +jht.JB',
                'nama_nota' => 'SJ Carbon T.Sixpack uk.Super-JB + Busa +jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 34500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon T.Bayang',
                'nama_nota' => 'SJ Carbon T.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 22000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon T.Bayang + jht.Univ',
                'nama_nota' => 'SJ Carbon T.Bayang + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 23000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon T.Bayang uk.JB 93x53',
                'nama_nota' => 'SJ Carbon T.Bayang uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 26000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon T.Bayang uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Carbon T.Bayang uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 27000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Tulang Bayang',
                'nama_nota' => 'SJ Carbon Tulang Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 22000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Tulang Bayang + LG.Bludru',
                'nama_nota' => 'SJ Carbon Tulang Bayang + LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 23000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Tulang Bayang Prima + LG.Bludru',
                'nama_nota' => 'SJ Carbon Tulang Bayang Prima + LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 24000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Tulang Bayang Prima uk.JB 93x53 + LG.Bludru',
                'nama_nota' => 'SJ Carbon Tulang Bayang Prima uk.JB + LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 28000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Carbon Tulang Bayang Prima uk.JB 93x53 + LG.Polymas',
                'nama_nota' => 'SJ Carbon Tulang Bayang Prima uk.JB + LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 28000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity LG.Bludru',
                'nama_nota' => 'SJ Grafity LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity LG.Polymas',
                'nama_nota' => 'SJ Grafity LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity LG.Polymas + jht.Univ',
                'nama_nota' => 'SJ Grafity LG.Polymas + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 16500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity LG.Sablon',
                'nama_nota' => 'SJ Grafity LG.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity LG.Stiker',
                'nama_nota' => 'SJ Grafity LG.Stiker',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity Polos',
                'nama_nota' => 'SJ Grafity Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity Polos + jht.Univ',
                'nama_nota' => 'SJ Grafity Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity uk.JB 93x53',
                'nama_nota' => 'SJ Grafity uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Grafity uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity uk.NMAX + jht.NMAX',
                'nama_nota' => 'SJ Grafity uk.NMAX + jht.NMAX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon',
                'nama_nota' => 'SJ Grafity T.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Doraemon Jepang',
                'nama_nota' => 'SJ Grafity T.Sablon Doraemon Jepang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Doraemon New',
                'nama_nota' => 'SJ Grafity T.Sablon Doraemon New',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Doraemon',
                'nama_nota' => 'SJ Grafity T.Sablon Doraemon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Hello Kitty 2',
                'nama_nota' => 'SJ Grafity T.Sablon Hello Kitty 2',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Keropi No.9',
                'nama_nota' => 'SJ Grafity T.Sablon Keropi No.9',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Keropi',
                'nama_nota' => 'SJ Grafity T.Sablon Keropi',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Polymas Macan uk.JB 93x53',
                'nama_nota' => 'SJ Grafity T.Polymas Macan uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Mickey Mouse',
                'nama_nota' => 'SJ Grafity T.Sablon Mickey Mouse',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Minion',
                'nama_nota' => 'SJ Grafity T.Sablon Minion',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity Tulang Bayang Prima',
                'nama_nota' => 'SJ Grafity Tulang Bayang Prima',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity Tulang Bayang Prima + LG.Bludru',
                'nama_nota' => 'SJ Grafity Tulang Bayang Prima + LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity Tulang Bayang Prima + LG.Sablon',
                'nama_nota' => 'SJ Grafity Tulang Bayang Prima + LG.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Racing Boy',
                'nama_nota' => 'SJ Grafity T.Sablon Racing Boy',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Rossy 46',
                'nama_nota' => 'SJ Grafity T.Sablon Rossy 46',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Somjin 7X',
                'nama_nota' => 'SJ Grafity T.Sablon Somjin 7X',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Straw Hat',
                'nama_nota' => 'SJ Grafity T.Sablon Straw Hat',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Straw Hat No.12',
                'nama_nota' => 'SJ Grafity T.Sablon Straw Hat No.12',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Polymas Tokage',
                'nama_nota' => 'SJ Grafity T.Polymas Tokage',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Sablon Tribal 1-6 + jht.Univ',
                'nama_nota' => 'SJ Grafity T.Sablon Tribal 1-6 + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Polymas Trisula',
                'nama_nota' => 'SJ Grafity T.Polymas Trisula',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Bayang',
                'nama_nota' => 'SJ Grafity T.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Polymas Naga',
                'nama_nota' => 'SJ Grafity T.Polymas Naga',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity T.Polymas',
                'nama_nota' => 'SJ Grafity T.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity Tulang Bayang + LG.Bludru',
                'nama_nota' => 'SJ Grafity Tulang Bayang + LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Grafity Tulang Bayang Prima',
                'nama_nota' => 'SJ Grafity Tulang Bayang Prima',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => 'Jok Assy Absolute Revo',
                'nama_nota' => 'Jok Assy Absolute Revo',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => 'Jok Assy Beat',
                'nama_nota' => 'Jok Assy Beat',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => 'Jok Assy Beat FI',
                'nama_nota' => 'Jok Assy Beat FI',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => 'Jok Assy CB STD',
                'nama_nota' => 'Jok Assy CB STD',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => 'Jok Assy F1ZR',
                'nama_nota' => 'Jok Assy F1ZR',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => 'Jok Assy Fit New',
                'nama_nota' => 'Jok Assy Fit New',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => 'Jok Assy FU',
                'nama_nota' => 'Jok Assy FU',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => 'Jok Assy GL Pro',
                'nama_nota' => 'Jok Assy GL Pro',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => 'Jok Assy Grand',
                'nama_nota' => 'Jok Assy Grand',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Grand'97",
                'nama_nota' => "Jok Assy Grand'97",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Jupiter MX",
                'nama_nota' => "Jok Assy Jupiter MX",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Jupiter New",
                'nama_nota' => "Jok Assy Jupiter New",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Jupiter Z",
                'nama_nota' => "Jok Assy Jupiter Z",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Mio M3",
                'nama_nota' => "Jok Assy Mio M3",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Mio Soul",
                'nama_nota' => "Jok Assy Mio Soul",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy MX",
                'nama_nota' => "Jok Assy MX",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Prima",
                'nama_nota' => "Jok Assy Prima",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Revo FI",
                'nama_nota' => "Jok Assy Revo FI",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy RX King",
                'nama_nota' => "Jok Assy RX King",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy RXK New",
                'nama_nota' => "Jok Assy RXK New",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy RXK New Papas Perahu",
                'nama_nota' => "Jok Assy RXK New Papas Perahu",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy RXK Press",
                'nama_nota' => "Jok Assy RXK Press",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Supra",
                'nama_nota' => "Jok Assy Supra",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Supra 125",
                'nama_nota' => "Jok Assy Supra 125",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Supra Fit New",
                'nama_nota' => "Jok Assy Supra Fit New",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Supra X",
                'nama_nota' => "Jok Assy Supra X",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Vario 125",
                'nama_nota' => "Jok Assy Vario 125",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Vario Techno",
                'nama_nota' => "Jok Assy Vario Techno",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Vega R",
                'nama_nota' => "Jok Assy Vega R",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'Jok Assy',
                'nama' => "Jok Assy Vega ZR",
                'nama_nota' => "Jok Assy Vega ZR",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi List Miring (A)',
                'nama_nota' => 'SJ Kombinasi List Miring (A)',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi List Miring (A) + LG',
                'nama_nota' => 'SJ Kombinasi List Miring (A) + LG',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi List Miring (A) + jht.Univ',
                'nama_nota' => 'SJ Kombinasi List Miring (A) + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi Sayap Warna (A) + jht.Univ',
                'nama_nota' => 'SJ Kombinasi Sayap Warna (A) + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi Sayap Warna (A) + LG + jht.Univ',
                'nama_nota' => 'SJ Kombinasi Sayap Warna (A) + LG + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi Warna Japstyle (A) + jht.Univ',
                'nama_nota' => 'SJ Kombinasi Warna Japstyle (A) + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi Warna X-Ride(L) + jht.Benang Warna',
                'nama_nota' => 'SJ Kombinasi Warna X-Ride(L) + jht. Benang Warna',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi Warna X-Ride(L) + jht.JB Benang Warna',
                'nama_nota' => 'SJ Kombinasi Warna X-Ride(L) + jht.JB Benang Warna',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi Warna X-Ride(L) Benang Warna',
                'nama_nota' => 'SJ Kombinasi Warna X-Ride(L) Benang Warna',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi Warna X-Ride Benang Warna',
                'nama_nota' => 'SJ Kombinasi Warna X-Ride Benang Warna',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Kombinasi',
                'nama' => 'Kombinasi X-Ride(L) Benang Warna',
                'nama_nota' => 'SJ Kombinasi X-Ride(L) Benang Warna',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk LG.Bayang',
                'nama_nota' => 'SJ Kulit Jeruk LG.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk LG.Bayang + jht.Univ',
                'nama_nota' => 'SJ Kulit Jeruk LG.Bayang + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk LG.Bludru',
                'nama_nota' => 'SJ Kulit Jeruk LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk LG.Bludru + jht.RXK',
                'nama_nota' => 'SJ Kulit Jeruk LG.Bludru + jht.RXK',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk LG.Bludru + jht.Univ',
                'nama_nota' => 'SJ Kulit Jeruk LG.Bludru + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk LG.Sablon',
                'nama_nota' => 'SJ Kulit Jeruk LG.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk LG.Sablon Kartun',
                'nama_nota' => 'SJ Kulit Jeruk LG.Sablon Kartun',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk LG.Sablon Netral',
                'nama_nota' => 'SJ Kulit Jeruk LG.Sablon Netral',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk Polos',
                'nama_nota' => 'SJ Kulit Jeruk Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk Polos + jht.Univ',
                'nama_nota' => 'SJ Kulit Jeruk Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk Polos uk.JB 93x53',
                'nama_nota' => 'SJ Kulit Jeruk Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Kulit Jeruk Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk Polos uk.97x68.5',
                'nama_nota' => 'SJ Kulit Jeruk Polos uk.97x68.5',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk(CK)(RY) LG.Bludru',
                'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk(CK)(RY) Polos',
                'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk(CK)(RY) T.Bayang C70',
                'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) T.Bayang C70',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk(CK)(RY) T.Bayang CB',
                'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) T.Bayang CB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk(CK)(RY) T.Bayang C70',
                'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) T.Bayang C70',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Kulit Jeruk(CK)(RY) T.Bayang RXK',
                'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) T.Bayang RXK',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(CK) LG.BLudru',
                'nama_nota' => 'SJ L55(CK) LG.BLudru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(CK) LG.BLudru + jht.Univ',
                'nama_nota' => 'SJ L55(CK) LG.BLudru + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(CK) LG.Bludru uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ L55(CK) LG.Bludru uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(CK) Polos',
                'nama_nota' => 'SJ L55(CK) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(CK) Polos + jht.ABS-RV',
                'nama_nota' => 'SJ L55(CK) Polos + jht.ABS-RV',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(CK) Polos + jht.Univ',
                'nama_nota' => 'SJ L55(CK) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(CK) Polos uk.JB 93x53',
                'nama_nota' => 'SJ L55(CK) Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(CK) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ L55(CK) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(CK) T.Polymas',
                'nama_nota' => 'SJ L55(CK) T.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(MC) Polos',
                'nama_nota' => 'SJ L55(MC) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(MC) Polos + jht.Univ',
                'nama_nota' => 'SJ L55(MC) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(MC) LG.Bludru',
                'nama_nota' => 'SJ L55(MC) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(MC) uk.JB 93x53',
                'nama_nota' => 'SJ L55(MC) uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'L55(MC) T.Polymas',
                'nama_nota' => 'SJ L55(MC) T.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole LG.Bayang',
                'nama_nota' => 'SJ LuckyHole LG.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole LG.Bayang + jht.Univ',
                'nama_nota' => 'SJ LuckyHole LG.Bayang + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole LG.Bludru',
                'nama_nota' => 'SJ LuckyHole LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole LG.Bludru + jht.Univ',
                'nama_nota' => 'SJ LuckyHole LG.Bludru + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole LG.Polymas',
                'nama_nota' => 'SJ LuckyHole LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole Polos',
                'nama_nota' => 'SJ LuckyHole Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 12500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole Polos + jht.Univ',
                'nama_nota' => 'SJ LuckyHole Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole Polos uk.JB 93x53',
                'nama_nota' => 'SJ LuckyHole Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 16500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ LuckyHole Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole Warna LG.Bludru',
                'nama_nota' => 'SJ LuckyHole Warna LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'MBtech(BD) LG.Bayang',
                'nama_nota' => 'SJ MBtech(BD) LG.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 42000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'MBtech(BD) Polos',
                'nama_nota' => 'SJ MBtech(BD) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 41000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'MBtech(BD) Tulang Bayang + LG.Bayang',
                'nama_nota' => 'SJ MBtech(BD) Tulang Bayang + LG.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 45000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'MBtech(KJ) Polos',
                'nama_nota' => 'SJ MBtech(KJ) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 41000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'MBtech(RD) Polos',
                'nama_nota' => 'SJ MBtech(RD) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 41000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole(FB) LG.Bludru',
                'nama_nota' => 'SJ LuckyHole(FB) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole(FB) Polos',
                'nama_nota' => 'SJ LuckyHole(FB) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 12500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole Biru LG.Bludru',
                'nama_nota' => 'SJ LuckyHole Biru LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole Hitam LG.Bludru',
                'nama_nota' => 'SJ LuckyHole Hitam LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole Kuning LG.Bludru',
                'nama_nota' => 'SJ LuckyHole Kuning LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole Merah LG.Bludru',
                'nama_nota' => 'SJ LuckyHole Merah LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 13500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'LuckyHole Merah Polos',
                'nama_nota' => 'SJ LuckyHole Merah Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 12500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) LG.Bayang',
                'nama_nota' => 'SJ Navaro(MC) LG.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) LG.Bludru',
                'nama_nota' => 'SJ Navaro(MC) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) LG.Bludru uk.JB',
                'nama_nota' => 'SJ Navaro(MC) LG.Bludru uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) LG.Sablon Kartun',
                'nama_nota' => 'SJ Navaro(MC) LG.Sablon Kartun',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) LG.Mika 1W',
                'nama_nota' => 'SJ Navaro(MC) LG.Mika 1W',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) LG.Polymas',
                'nama_nota' => 'SJ Navaro(MC) LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) LG.Polymas uk.JB 93x53',
                'nama_nota' => 'SJ Navaro(MC) LG.Polymas uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) Polos',
                'nama_nota' => 'SJ Navaro(MC) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) Polos + jht.ABS-RV',
                'nama_nota' => 'SJ Navaro(MC) Polos + jht.ABS-RV',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) Polos + jht.RXK',
                'nama_nota' => 'SJ Navaro(MC) Polos + jht.RXK',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) Polos + jht.Univ',
                'nama_nota' => 'SJ Navaro(MC) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) Polos uk.JB 93x53',
                'nama_nota' => 'SJ Navaro(MC) Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Navaro(MC) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) Polos uk.NMAX + jht.NMAX',
                'nama_nota' => 'SJ Navaro(MC) Polos uk.NMAX + jht.NMAX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) Polos uk.GIGA 100x68.5',
                'nama_nota' => 'SJ Navaro(MC) Polos uk.GIGA 100x68.5',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) Polos uk.PCX + jht.PCX',
                'nama_nota' => 'SJ Navaro(MC) Polos uk.PCX + jht.PCX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Bikers',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Bikers',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Doraemon',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Doraemon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Fox',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Fox',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Hello Kitty 2',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Hello Kitty 2',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Kelabang',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Kelabang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Keropi',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Keropi',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Laba"',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Laba"',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Macan',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Macan',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Mickey Mouse',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Mickey Mouse',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Minion',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Minion',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Modi',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Modi',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Movistar',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Movistar',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Racing Boy',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Racing Boy',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Scorpion',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Scorpion',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Sepatu',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Sepatu',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon SpongeBob',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon SpongeBob',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Tribal 46',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Tribal 46',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Sablon Tribal Movistar',
                'nama_nota' => 'SJ Navaro(MC) T.Sablon Tribal Movistar',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Polymas',
                'nama_nota' => 'SJ Navaro(MC) T.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Polymas + jht.Univ',
                'nama_nota' => 'SJ Navaro(MC) T.Polymas + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Polymas Trisula',
                'nama_nota' => 'SJ Navaro(MC) T.Polymas Trisula',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Polymas Trisula + jht.Univ',
                'nama_nota' => 'SJ Navaro(MC) T.Polymas Trisula + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Navaro(MC) T.Polymas Trisula + LG.Polymas + jht.Univ',
                'nama_nota' => 'SJ Navaro(MC) T.Polymas Trisula + LG.Polymas + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Urat Tangan(MC) LG.Bludru',
                'nama_nota' => 'SJ Urat Tangan(MC) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Urat Tangan(MC) Polos',
                'nama_nota' => 'SJ Urat Tangan(MC) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Urat Tangan(MC) Polos + jht.RXK',
                'nama_nota' => 'SJ Urat Tangan(MC) Polos + jht.RXK',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Urat Tangan(MC) Polos + jht.Univ',
                'nama_nota' => 'SJ Urat Tangan(MC) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Urat Tangan(MC) uk.JB 93x53',
                'nama_nota' => 'SJ Urat Tangan(MC) uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Urat Tangan(MC) uk.NMAX + jht.NMAX',
                'nama_nota' => 'SJ Urat Tangan(MC) uk.NMAX + jht.NMAX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Urat Tangan(MC) uk.Aerox + jht.Aerox',
                'nama_nota' => 'SJ Urat Tangan(MC) uk.Aerox + jht.Aerox',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Urat Tangan(MC) uk.FreeGo + jht.FreeGo',
                'nama_nota' => 'SJ Urat Tangan(MC) uk.FreeGo + jht.FreeGo',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 21000,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Urat Tangan(MC) uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Urat Tangan(MC) uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) LG.Sablon',
                'nama_nota' => 'SJ Vario(M) LG.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) Polos',
                'nama_nota' => 'SJ Vario(M) Polos',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 14500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) Polos + jht.Univ',
                'nama_nota' => 'SJ Vario(M) Polos + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) Polos uk.JB 93x53',
                'nama_nota' => 'SJ Vario(M) Polos uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) Polos uk.JB 93x53 + jht.JB',
                'nama_nota' => 'SJ Vario(M) Polos uk.JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) Polos uk.Super-JB 97x53',
                'nama_nota' => 'SJ Vario(M) Polos uk.Super-JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) Polos uk.Super-JB 97x53 + jht.JB',
                'nama_nota' => 'SJ Vario(M) Polos uk.Super-JB + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon',
                'nama_nota' => 'SJ Vario(M) T.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon Bride 9X',
                'nama_nota' => 'SJ Vario(M) T.Sablon Bride 9X',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon Doraemon',
                'nama_nota' => 'SJ Vario(M) T.Sablon Doraemon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon FOX',
                'nama_nota' => 'SJ Vario(M) T.Sablon FOX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon Keropi',
                'nama_nota' => 'SJ Vario(M) T.Sablon Keropi',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon Macan',
                'nama_nota' => 'SJ Vario(M) T.Sablon Macan',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon Movistar XLGP Racing',
                'nama_nota' => 'SJ Vario(M) T.Sablon Movistar XLGP Racing',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon Racing Boy',
                'nama_nota' => 'SJ Vario(M) T.Sablon Racing Boy',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon Tribal Campur + jht.Univ',
                'nama_nota' => 'SJ Vario(M) T.Sablon Tribal Campur + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon Tribal',
                'nama_nota' => 'SJ Vario(M) T.Sablon Tribal',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 18500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Sablon Tribal + jht.Univ',
                'nama_nota' => 'SJ Vario(M) T.Sablon Tribal + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Bayang',
                'nama_nota' => 'SJ Vario(M) T.Bayang',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Bayang + jht.Univ',
                'nama_nota' => 'SJ Vario(M) T.Bayang + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Polymas',
                'nama_nota' => 'SJ Vario(M) T.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Polymas Trisula + LG.Polymas',
                'nama_nota' => 'SJ Vario(M) T.Polymas Trisula + LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Polymas + jht.Univ',
                'nama_nota' => 'SJ Vario(M) T.Polymas + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) T.Polymas Trisula + jht.Univ',
                'nama_nota' => 'SJ Vario(M) T.Polymas Trisula + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(M) Tulang Bayang + LG.Sablon',
                'nama_nota' => 'SJ Vario(M) Tulang Bayang + LG.Sablon',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(MC) T.Polymas Tribal Bride 5X + jht.Univ',
                'nama_nota' => 'SJ Vario(MC) T.Polymas Tribal Bride 5X + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(MC) T.Sablon Blok Bride',
                'nama_nota' => 'SJ Vario(MC) T.Sablon Blok Bride',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(MC) LG.Bludru',
                'nama_nota' => 'SJ Vario(MC) LG.Bludru',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(MC) LG.Bludru + jht.Univ',
                'nama_nota' => 'SJ Vario(MC) LG.Bludru + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 16500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(MC) LG.Polymas',
                'nama_nota' => 'SJ Vario(MC) LG.Polymas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(MC) LG.Polymas uk.JB 93x53',
                'nama_nota' => 'SJ Vario(MC) LG.Polymas uk.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 19500,
            ],
            [
                'tipe' => 'SJ-Variasi',
                'nama' => 'Vario(MC) LG.Sablon Sa-Korn + jht.Univ',
                'nama_nota' => 'SJ Vario(MC) LG.Sablon Sa-Korn + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 16500,
            ],
            [
                'tipe' => 'SJ-Japstyle',
                'nama' => 'Kulit Jeruk Japstyle',
                'nama_nota' => 'SJ Kulit Jeruk Japstyle',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 18000,
            ],
            [
                'tipe' => 'SJ-Japstyle',
                'nama' => 'Kulit Jeruk(CK)(RY) Japstyle',
                'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) Japstyle',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Japstyle',
                'nama' => 'Kulit Jeruk(CK) Japstyle',
                'nama_nota' => 'SJ Kulit Jeruk(CK) Japstyle',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Japstyle',
                'nama' => 'L55(CK) Japstyle',
                'nama_nota' => 'SJ L55(CK) Japstyle',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Japstyle',
                'nama' => 'L55(MC) Japstyle',
                'nama_nota' => 'SJ L55(MC) Japstyle',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Japstyle',
                'nama' => 'LuckyHole Japstyle',
                'nama_nota' => 'SJ LuckyHole Japstyle',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Japstyle',
                'nama' => 'Navaro(MC) Japstyle',
                'nama_nota' => 'SJ Navaro(MC) Japstyle',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Japstyle',
                'nama' => 'Vario(MC) Japstyle',
                'nama_nota' => 'SJ Vario(MC) Japstyle',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Hexagon 2 Warna (A) + jht.Univ',
                'nama_nota' => 'SJ Motif Hexagon 2 Warna (A) + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Hexagon 2 Warna uk.JB 93x53+ jht.JB',
                'nama_nota' => 'SJ Motif Hexagon 2 Warna uk.JB 93x53+ jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Sixpack 2 Warna (A) + jht.Univ',
                'nama_nota' => 'SJ Motif Sixpack 2 Warna (A) + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Sixpack 2 Warna (A) + Motif + jht.Univ',
                'nama_nota' => 'SJ Motif Sixpack 2 Warna (A) + Motif + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Sixpack 2 Warna (A) "Carbon" + LG + Motif + jht.Univ',
                'nama_nota' => 'SJ Motif Sixpack 2 Warna (A) + Motif + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Sixpack 2 Warna (A) uk.JB 93x53 + jht.Univ',
                'nama_nota' => 'SJ Motif Sixpack 2 Warna (A) uk.JB + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Sixpack Full Hitam uk.JB 93x53 + jht.Univ',
                'nama_nota' => 'SJ Motif Sixpack Full Hitam uk.JB + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => 'Standar Astrea 800 + Alas',
                'nama_nota' => 'SJ Standar Astrea 800 + Alas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => 'Standar C70',
                'nama_nota' => 'SJ Standar C70',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => 'Standar C70 Bahan(A) + Alas',
                'nama_nota' => 'SJ Standar C70 Bahan(A) + Alas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => 'Standar CB',
                'nama_nota' => 'SJ Standar CB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => 'Standar CB Bahan Kulit Jeruk(CK)(RY) + Alas',
                'nama_nota' => 'SJ Standar CB Bahan Kulit Jeruk(CK)(RY) + Alas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => 'Standar F1ZR',
                'nama_nota' => 'SJ Standar F1ZR',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => 'Standar GL Pro',
                'nama_nota' => 'SJ Standar GL Pro',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => 'Standar GL Pro Bahan Urat Tangan(MC) + Alas',
                'nama_nota' => 'SJ Standar GL Pro Bahan Urat Tangan(MC) + Alas',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar Grand'97",
                "nama_nota" => "SJ Standar Grand'97",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar KLX Hitam",
                "nama_nota" => "SJ Standar KLX Hitam",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 15500,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar Prima",
                "nama_nota" => "SJ Standar Prima",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar RX King 02",
                "nama_nota" => "SJ Standar RX King 02",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 14000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar RX Spesial",
                "nama_nota" => "SJ Standar RX Spesial",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 17500,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar RX King 95 + Alas",
                "nama_nota" => "SJ Standar RX King 95 + Alas",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar RX King 95 + Alas + Sayap Abu",
                "nama_nota" => "SJ Standar RX King 95 + Alas + Sayap Abu",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar RX King 95 + Alas + Sayap Hitam",
                "nama_nota" => "SJ Standar RX King 95 + Alas + Sayap Hitam",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar RX King 95 Bahan L55(MC) + Alas",
                "nama_nota" => "SJ Standar RX King 95 Bahan L55(MC) + Alas",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar RX King 95 + Busa + Sayap Hitam",
                "nama_nota" => "SJ Standar RX King 95 + Busa + Sayap Hitam",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => "Standar RX King 95 + Busa",
                "nama_nota" => "SJ Standar RX King 95 + Busa",
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 19000,
            ],
            [
                'tipe' => 'SJ-Standar',
                'nama' => 'Standar Supra Fit',
                'nama_nota' => 'SJ Standar Supra Fit',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 35
                'harga' => 14000,
            ],
            [
                'tipe' => 'Tankpad',
                'tankpad_id' => 5,
                'nama' => 'TP Fox Dimensi',
                'nama_nota' => 'TP Fox Dimensi',
                'tipe_packing' => 'dus',
                'aturan_packing' => 500, // 36
                'harga' => 5500,
            ],
            [
                'tipe' => 'Tankpad',
                'tankpad_id' => 5,
                'nama' => 'TP Fox Hitam',
                'nama_nota' => 'TP Fox Hitam',
                'tipe_packing' => 'dus',
                'aturan_packing' => 500, // 36
                'harga' => 5500,
            ],
            [
                'tipe' => 'Tankpad',
                'tankpad_id' => 5,
                'nama' => 'TP MC Dimensi',
                'nama_nota' => 'TP MC Dimensi',
                'tipe_packing' => 'dus',
                'aturan_packing' => 500, // 36
                'harga' => 5500,
            ],
            [
                'tipe' => 'Tankpad',
                'tankpad_id' => 5,
                'nama' => 'TP MC Hitam',
                'nama_nota' => 'TP MC Hitam',
                'tipe_packing' => 'dus',
                'aturan_packing' => 500, // 36
                'harga' => 5500,
            ],
            [
                'tipe' => 'Tankpad',
                'tankpad_id' => 5,
                'nama' => 'TP Racing Jumbo Mika/Sablon',
                'nama_nota' => 'TP Racing Jumbo Mika/Sablon',
                'tipe_packing' => 'dus',
                'aturan_packing' => 500, // 36
                'harga' => 5500,
            ],
            [
                'tipe' => 'Tankpad',
                'tankpad_id' => 5,
                'nama' => 'TP Racing Kecil Mika/Sablon',
                'nama_nota' => 'TP Racing Kecil Mika/Sablon',
                'tipe_packing' => 'dus',
                'aturan_packing' => 500, // 36
                'harga' => 5500,
            ],
            [
                'tipe' => 'Busa-Stang',
                'busastang_id' => 1,
                'nama' => 'Busa Stang',
                'nama_nota' => 'Busa Stang',
                'tipe_packing' => 'bal',
                'aturan_packing' => 72, // 37
                'harga' => 8000,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'Bahan(A) T.Sixpack uk.JB 93x53 + Busa + jht.JB',
                'nama_nota' => 'SJ Bahan(A) T.Sixpack uk.JB + Busa + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack + Alas + jht.ABS-RV',
                'nama_nota' => 'SJ L55(MC) T.Sixpack + Alas + jht.ABS-RV',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack + Busa',
                'nama_nota' => 'SJ L55(MC) T.Sixpack + Busa',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack + Busa + jht.ABS-RV',
                'nama_nota' => 'SJ L55(MC) T.Sixpack + Busa + jht.ABS-RV',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack + Busa + jht.Univ',
                'nama_nota' => 'SJ L55(MC) T.Sixpack + Busa + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack + Busa + jht.Warna',
                'nama_nota' => 'SJ L55(MC) T.Sixpack + Busa + jht.Warna',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack uk.JB 93x53 + Busa + jht.JB',
                'nama_nota' => 'SJ L55(MC) T.Sixpack uk.JB + Busa + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack uk.Super-JB 97x53 + Busa + jht.NMAX',
                'nama_nota' => 'SJ L55(MC) T.Sixpack uk.Super-JB + Busa + jht.NMAX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack uk.JB 93x53 + Alas + jht.JB',
                'nama_nota' => 'SJ L55(MC) T.Sixpack uk.JB + Alas + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack + Busa',
                'nama_nota' => 'SJ L55(MC) T.Sixpack + Busa',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack uk.JB 93x53 + Busa',
                'nama_nota' => 'SJ L55(MC) T.Sixpack uk.JB + Busa',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'Navaro T.Sixpack + Alas + jht.Univ',
                'nama_nota' => 'SJ Navaro T.Sixpack + Alas + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'Urat Tangan(MC) T.Sixpack + Busa + jht.Univ',
                'nama_nota' => 'SJ Urat Tangan(MC) T.Sixpack + Busa + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'Stiker',
                'stiker_id' => 1,
                'nama' => 'Stiker Api',
                'nama_nota' => 'Stiker Api',
                'tipe_packing' => null,
                'aturan_packing' => null, // 39
                'harga' => 4000,
            ],
            [
                'tipe' => 'Rol',
                'nama' => 'LuckyHole Hitam Rol',
                'nama_nota' => 'SJ LuckyHole Hitam Rol',
                'tipe_packing' => null,
                'aturan_packing' => null, // 34
                'harga' => 327000,
            ],
            [
                'tipe' => 'Rotan',
                'nama' => 'Rotan Hitam',
                'nama_nota' => 'SJ Rotan Hitam',
                'tipe_packing' => null,
                'aturan_packing' => null, // 34
                'harga' => 30000,
            ],
        ];

        for ($i = 0; $i < count($produk); $i++) {
            $inserted_produk = Produk::create([
                'tipe' => $produk[$i]['tipe'],
                // 'properties' => $produk[$i]['properties'],
                // 'bahan_id' => $produk[$i]['bahan_id'],
                // 'variasi_id' => $produk[$i]['variasi_id'],
                // 'ukuran_id' => $produk[$i]['ukuran_id'],
                // 'jahit_id' => $produk[$i]['jahit_id'],
                // 'standar_id' => $produk[$i]['standar_id'],
                // 'kombinasi_id' => $produk[$i]['kombinasi_id'],
                // 'busastang_id' => $produk[$i]['busastang_id'],
                // 'tankpad_id' => $produk[$i]['tankpad_id'],
                // 'tspjap_id' => $produk[$i]['tspjap_id'],
                // 'tipe_bahan' => $produk[$i]['tipe_bahan'],
                // 'stiker_id' => $produk[$i]['stiker_id'],
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
