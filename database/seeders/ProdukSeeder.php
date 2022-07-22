<?php

namespace Database\Seeders;

use App\Models\Attsjvariasi;
use App\Models\Bahan;
use App\Models\Produk;
use App\Models\ProdukBahan;
use App\Models\ProdukHarga;
use App\Models\ProdukSpec;
use App\Models\Spec;
use App\Models\Variasi;
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
        $produk = [[
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(CA) Polos',
            'nama_nota' => 'SJ Amplas(CA) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 1
            'harga' => 16500,
            'bahan'=>'Amplas(CA)','variasi_1'=>'Polos','varian_1'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(CA) Polos + jht.Univ',
            'nama_nota' => 'SJ Amplas(CA) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 2
            'harga' => 17500,
            'bahan'=>'Amplas(CA)','variasi_1'=>'Polos','varian_1'=>null,'jahit'=>'Univ'
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(CA) LG.Stiker',
            'nama_nota' => 'SJ Amplas(CA) LG.Stiker',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 3
            'harga' => 20500,
            'bahan'=>'Amplas(CA)','variasi_1'=>'Polos','varian_1'=>null,'jahit'=>'Univ'
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Bayang',
            'nama_nota' => 'SJ Amplas(RY) LG.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 4
            'harga' => 17500,
            'bahan'=>'Amplas(CA)','variasi_1'=>'LG.Bayang','varian_1'=>null,'jahit'=>null
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Bludru',
            'nama_nota' => 'SJ Amplas(RY) LG.Bludru',
            'tipe_packing' => 'colly', // 5
            'aturan_packing' => 150,
            'harga' => 17500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'LG.Bludru','varian_1'=>null,'jahit'=>null
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Bludru + jht.Univ',
            'nama_nota' => 'SJ Amplas(RY) LG.Bludru + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 6
            'harga' => 18500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'LG.Bludru','varian_1'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Bordir',
            'nama_nota' => 'SJ Amplas(RY) LG.Bordir',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 7
            'harga' => 17500,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Bordir uk.JB93x53',
            'nama_nota' => 'SJ Amplas(RY) LG.Bordir uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 8
            'harga' => 21500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'LG.Bludru','varian_1'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Mika 1W',
            'nama_nota' => 'SJ Amplas(RY) LG.Mika 1W',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 9
            'harga' => 17500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'LG.Mika','varian_1'=>'1W','ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Polymas',
            'nama_nota' => 'SJ Amplas(RY) LG.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 10
            'harga' => 17500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'LG.Polymas','varian_1'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Polymas uk.JB93x53',
            'nama_nota' => 'SJ Amplas(RY) LG.Polymas uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 11
            'harga' => 21500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'LG.Polymas','varian_1'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Stiker',
            'nama_nota' => 'SJ Amplas(RY) LG.Stiker',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150,  // 12
            'harga' => 20500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'LG.Stiker','varian_1'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Stiker + jht.Univ',
            'nama_nota' => 'SJ Amplas(RY) LG.Stiker + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 13
            'harga' => 21500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'LG.Stiker','varian_1'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Stiker uk.JB93x53',
            'nama_nota' => 'SJ Amplas(RY) LG.Stiker uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 14
            'harga' => 24500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'LG.Stiker','varian_1'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) LG.Stiker uk.SuperJB97x53',
            'nama_nota' => 'SJ Amplas(RY) LG.Stiker uk.Super-JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150,// 15
            'harga' => 26000,
            'bahan'=>'Amplas(RY)','variasi_1'=>'LG.Stiker','varian_1'=>null,'ukuran'=>'Super-JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) Polos',
            'nama_nota' => 'SJ Amplas(RY) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150,// 16
            'harga' => 16500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'Polos','varian_1'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) Polos + jht.ABS-RV',
            'nama_nota' => 'SJ Amplas(RY) Polos + jht.ABS-RV',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 17
            'harga' => 17500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'Polos','varian_1'=>null,'ukuran'=>null,'jahit'=>'ABS-RV',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) Polos + jht.RXK',
            'nama_nota' => 'SJ Amplas(RY) Polos + jht.RXK',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, //18
            'harga' => 17500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'Polos','varian_1'=>null,'ukuran'=>null,'jahit'=>'RXK',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) Polos + jht.Univ',
            'nama_nota' => 'SJ Amplas(RY) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, //19
            'harga' => 17500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'Polos','varian_1'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) Polos uk.JB93x53',
            'nama_nota' => 'SJ Amplas(RY) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 20
            'harga' => 20500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'Polos','varian_1'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Amplas(RY) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 21
            'harga' => 21500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'Polos','varian_1'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) Polos uk.SuperJB97x53',
            'nama_nota' => 'SJ Amplas(RY) Polos uk.Super-JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 22
            'harga' => 22000,
            'bahan'=>'Amplas(RY)','variasi_1'=>'Polos','varian_1'=>null,'ukuran'=>'Super-JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) Polos uk.GIGA100x68.5',
            'nama_nota' => 'SJ Amplas(RY) Polos uk.GIGA',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 23
            'harga' => 26000,
            'bahan'=>'Amplas(RY)','variasi_1'=>'Polos','varian_1'=>null,'ukuran'=>'GIGA 93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) T.Sablon Tribal 1-6',
            'nama_nota' => 'SJ Amplas(RY) T.Sablon Tribal 1-6',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 24
            'harga' => 21500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'T.Sablon','varian_1'=>'Tribal 1-6','ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(RY) Tulang Bayang + LG.Sablon',
            'nama_nota' => 'SJ Amplas(RY) Tulang Bayang + LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, //25
            'harga' => 22500,
            'bahan'=>'Amplas(RY)','variasi_1'=>'Tulang Bayang','varian_1'=>null,'variasi_2'=>'LG.Sablon','ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(SBT) LG.Bludru',
            'nama_nota' => 'SJ Amplas(SBT) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 26
            'harga' => 20000,
            'bahan'=>'Amplas(SBT)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(SBT) LG.Bordir',
            'nama_nota' => 'SJ Amplas(SBT) LG.Bordir',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 27
            'harga' => 20000,
            'bahan'=>'Amplas(SBT)','variasi_1'=>'LG.Bordir','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(SBT) LG.Polymas',
            'nama_nota' => 'SJ Amplas(SBT) LG.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 28
            'harga' => 20000,
            'bahan'=>'Amplas(SBT)','variasi_1'=>'LG.Polymas','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(SBT) LG.Stiker',
            'nama_nota' => 'SJ Amplas(SBT) LG.Stiker',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 29
            'harga' => 23000,
            'bahan'=>'Amplas(SBT)','variasi_1'=>'LG.Stiker','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(SBT) Polos',
            'nama_nota' => 'SJ Amplas(SBT) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 30
            'harga' => 19000,
            'bahan'=>'Amplas(SBT)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(SBT) Polos + jht.Univ',
            'nama_nota' => 'SJ Amplas(SBT) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 31
            'harga' => 20000,
            'bahan'=>'Amplas(SBT)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Amplas(SBT) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Amplas(SBT) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 32
            'harga' => 24000,
            'bahan'=>'Amplas(SBT)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(CK) Polos uk.JB93x53',
            'nama_nota' => 'SJ BigDot(CK) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 18500,
            'bahan'=>'BigDot(CK)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(CK) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ BigDot(CK) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 19500,
            'bahan'=>'BigDot(CK)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) LG.Bludru',
            'nama_nota' => 'SJ BigDot(MC) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 15500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) LG.Bludru + jht.Univ',
            'nama_nota' => 'SJ BigDot(MC) LG.Bludru + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 16500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) LG.Polymas',
            'nama_nota' => 'SJ BigDot(MC) LG.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 15500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'LG.Polymas','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) Polos',
            'nama_nota' => 'SJ BigDot(MC) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 14500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) Polos + jht.ABS-RV',
            'nama_nota' => 'SJ BigDot(MC) Polos + jht.ABS-RV',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 15500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>'ABS-RV',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) Polos + jht.RXK',
            'nama_nota' => 'SJ BigDot(MC) Polos + jht.RXK',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 15500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>'RXK',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) Polos + jht.Univ',
            'nama_nota' => 'SJ BigDot(MC) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 15500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) Polos uk.JB93x53',
            'nama_nota' => 'SJ BigDot(MC) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 18500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ BigDot(MC) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 33
            'harga' => 19500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) Polos uk.SuperJB97x53',
            'nama_nota' => 'SJ BigDot(MC) Polos uk.Super-JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'SuperJB97x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) T.Polymas',
            'nama_nota' => 'SJ BigDot(MC) T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MC) Tulang Bayang',
            'nama_nota' => 'SJ BigDot(MC) Tulang Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'BigDot(MC)','variasi_1'=>'Tulang Bayang','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MCR) LG.Bludru',
            'nama_nota' => 'SJ BigDot(MCR) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'BigDot(MCR)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MCR) Polos',
            'nama_nota' => 'SJ BigDot(MCR) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'BigDot(MCR)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MCR) Polos + jht.ABS-RV',
            'nama_nota' => 'SJ BigDot(MCR) Polos + jht.ABS-RV',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'BigDot(MCR)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>'ABS-RV',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MCR) Polos + jht.Univ',
            'nama_nota' => 'SJ BigDot(MCR) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'BigDot(MCR)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MCR) Polos uk.JB93x53',
            'nama_nota' => 'SJ BigDot(MCR) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'BigDot(MCR)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MCR) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ BigDot(MCR) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'BigDot(MCR)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'BigDot(MCR) T.Polymas',
            'nama_nota' => 'SJ BigDot(MCR) T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21500,
            'bahan'=>'BigDot(MCR)','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 LG.Bayang',
            'nama_nota' => 'SJ C24 LG.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'C24','variasi_1'=>'LG.Bayang','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 LG.Polymas',
            'nama_nota' => 'SJ C24 LG.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'C24','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 LG.Sablon',
            'nama_nota' => 'SJ C24 LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'C24','variasi_1'=>'LG.Sablon','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 Polos',
            'nama_nota' => 'SJ C24 Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13000,
            'bahan'=>'C24','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 Polos + jht.Univ',
            'nama_nota' => 'SJ C24 Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'C24','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 Polos uk.JB93x53',
            'nama_nota' => 'SJ C24 Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17000,
            'bahan'=>'C24','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ C24 Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 Polos uk.Aerox + jht.Aerox',
            'nama_nota' => 'SJ C24 Polos uk.Aerox + jht.Aerox',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'C24','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'Aerox','jahit'=>'Aerox',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 Polos uk.NMAX + jht.NMAX',
            'nama_nota' => 'SJ C24 Polos uk.NMAX + jht.NMAX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'C24','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'ukuran'=>'NMAX','jahit'=>'NMAX',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon',
            'nama_nota' => 'SJ C24 T.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon Blok Bride Pelangi',
            'nama_nota' => 'SJ C24 T.Sablon Blok Bride Pelangi',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>'Blok Bride Pelangi','variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon Fox',
            'nama_nota' => 'SJ C24 T.Sablon Fox',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>'Fox','variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon Modi',
            'nama_nota' => 'SJ C24 T.Sablon Modi',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>'Modi','variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon NGO 7X',
            'nama_nota' => 'SJ C24 T.Sablon NGO 7X',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>'NGO 7X','variasi_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon RacingBoy List Kawahara',
            'nama_nota' => 'SJ C24 T.Sablon RacingBoy List Kawahara',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>'RacingBoy','variasi_2'=>'List','varian_2'=>'Kawahara','ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon Straw Hat',
            'nama_nota' => 'SJ C24 T.Sablon Straw Hat',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>'Straw Hat','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon Thailook 5X',
            'nama_nota' => 'SJ C24 T.Sablon Thailook 5X',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>'Thailook 5X','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon Tribal 1',
            'nama_nota' => 'SJ C24 T.Sablon Tribal 1',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>'Tribal 1','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon Tribal 5',
            'nama_nota' => 'SJ C24 T.Sablon Tribal 5',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>'Tribal 5','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Sablon Trisula',
            'nama_nota' => 'SJ C24 T.Sablon Trisula',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Sablon','varian_1'=>'Trisula','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C24 T.Polymas',
            'nama_nota' => 'SJ C24 T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'C24','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C30(MC) LG.Bludru',
            'nama_nota' => 'SJ C30(MC) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'C30(MC)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C30(MC) Polos',
            'nama_nota' => 'SJ C30(MC) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
            'bahan'=>'C30(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C30(MC) Polos + jht.RXK',
            'nama_nota' => 'SJ C30(MC) Polos + jht.RXK',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'C30(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'RXK',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C30(MC) Polos + jht.Univ',
            'nama_nota' => 'SJ C30(MC) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'C30(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C30(MC) Polos uk.JB93x53',
            'nama_nota' => 'SJ C30(MC) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'C30(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C30(MC) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ C30(MC) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'C30(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C30(MC) Polos uk.SuperJB97x53',
            'nama_nota' => 'SJ C30(MC) Polos uk.Super-JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20000,
            'bahan'=>'C30(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'SuperJB97x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C30(MC) Polos uk.MioSoulGT125 + jht.MioSoulGT125',
            'nama_nota' => 'SJ C30(MC) Polos uk.MioSoulGT125 + jht.MioSoulGT125',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'C30(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'MioSoulGT125','jahit'=>'MioSoulGT125',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) LG.Bludru',
            'nama_nota' => 'SJ C38(MC) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'C30(MC)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C30(MC) T.Polymas',
            'nama_nota' => 'SJ C30(MC) T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'C30(MC)','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) Polos',
            'nama_nota' => 'SJ C38(MC) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) Polos + jht.Univ',
            'nama_nota' => 'SJ C38(MC) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ C38(MC) uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) uk.Aerox + jht.Aerox',
            'nama_nota' => 'SJ C38(MC) uk.Aerox + jht.Aerox',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'Aerox','jahit'=>'Aerox',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) uk.FreeGo + jht.FreeGo',
            'nama_nota' => 'SJ C38(MC) uk.FreeGo + jht.FreeGo',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'FreeGo','jahit'=>'FreeGo',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) Polos uk.JB93x53',
            'nama_nota' => 'SJ C38(MC) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ C38(MC) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) Polos uk.MioSoulGT125 + jht.MioSoulGT125',
            'nama_nota' => 'SJ C38(MC) Polos uk.MioSoulGT125 + jht.MioSoulGT125',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'MioSoulGT125','jahit'=>'MioSoulGT125',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) Polos uk.NMAX + jht.NMAX',
            'nama_nota' => 'SJ C38(MC) Polos uk.NMAX + jht.NMAX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'NMAX','jahit'=>'NMAX',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) Polos uk.PCX + jht.PCX',
            'nama_nota' => 'SJ C38(MC) Polos uk.PCX + jht.PCX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'PCX','jahit'=>'PCX',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) Polos uk.SuperJB97x53 + jht.JB',
            'nama_nota' => 'SJ C38(MC) Polos uk.Super-JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'Super-JB','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'C38(MC) T.Polymas',
            'nama_nota' => 'SJ C38(MC) T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'C38(MC)','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon LG.Bludru',
            'nama_nota' => 'SJ Carbon LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20000,
            'bahan'=>'C38(MC)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon LG.Bludru uk.JB93x53',
            'nama_nota' => 'SJ Carbon LG.Bludru uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 24000,
            'bahan'=>'Carbon','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon LG.Bludru uk.SuperJB97x53',
            'nama_nota' => 'SJ Carbon LG.Bludru uk.Super-JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 25500,
            'bahan'=>'Carbon','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'Super-JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon LG.Bordir',
            'nama_nota' => 'SJ Carbon LG.Bordir',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20000,
            'bahan'=>'Carbon','variasi_1'=>'LG.Bordir','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'Super-JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon LG.Bordir + jht.Univ',
            'nama_nota' => 'SJ Carbon LG.Bordir + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'Carbon','variasi_1'=>'LG.Bordir','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon LG.Bordir Bikers',
            'nama_nota' => 'SJ Carbon LG.Bordir Bikers',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20000,
            'bahan'=>'Carbon','variasi_1'=>'LG.Bordir','varian_1'=>'Bikers','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon LG.Bordir uk.SuperJB97x53',
            'nama_nota' => 'SJ Carbon LG.Bordir uk.Super-JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 25500,
            'bahan'=>'Carbon','variasi_1'=>'LG.Bordir','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'SuperJB97x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon LG.Sablon Sa-Korn',
            'nama_nota' => 'SJ Carbon LG.Sablon Sa-Korn',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20000,
            'bahan'=>'Carbon','variasi_1'=>'LG.Sablon','varian_1'=>'Sa-Korn','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon LG.Stiker',
            'nama_nota' => 'SJ Carbon LG.Stiker',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 23000,
            'bahan'=>'Carbon','variasi_1'=>'LG.Stiker','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon LG.Stiker + jht.Univ',
            'nama_nota' => 'SJ Carbon LG.Stiker + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 24000,
            'bahan'=>'Carbon','variasi_1'=>'LG.Stiker','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Polos',
            'nama_nota' => 'SJ Carbon Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19000,
            'bahan'=>'Carbon','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Polos + jht.RXK',
            'nama_nota' => 'SJ Carbon Polos + jht.RXK',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20000,
            'bahan'=>'Carbon','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'RXK',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Polos + jht.Univ',
            'nama_nota' => 'SJ Carbon Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20000,
            'bahan'=>'Carbon','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Polos uk.JB93x53',
            'nama_nota' => 'SJ Carbon Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 23000,
            'bahan'=>'Carbon','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Carbon Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 24000,
            'bahan'=>'Carbon','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Polos uk.SuperJB97x53',
            'nama_nota' => 'SJ Carbon Polos uk.Super-JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 24500,
            'bahan'=>'Carbon','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'SuperJB97x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Polos uk.Aerox + jht.Aerox',
            'nama_nota' => 'SJ Carbon Polos uk.Aerox + jht.Aerox',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 25500,
            'bahan'=>'Carbon','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'Aerox','jahit'=>'Aerox',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Polos uk.NMAX',
            'nama_nota' => 'SJ Carbon Polos uk.NMAX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 24500,
            'bahan'=>'Carbon','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'NMAX','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Polos uk.NMAX + jht.NMAX',
            'nama_nota' => 'SJ Carbon Polos uk.NMAX + jht.NMAX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 25500,
            'bahan'=>'Carbon','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'NMAX','jahit'=>'NMAX',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon T.Bayang',
            'nama_nota' => 'SJ Carbon T.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 22000,
            'bahan'=>'Carbon','variasi_1'=>'T.Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon T.Bayang + jht.Univ',
            'nama_nota' => 'SJ Carbon T.Bayang + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 23000,
            'bahan'=>'Carbon','variasi_1'=>'T.Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon T.Bayang uk.JB93x53',
            'nama_nota' => 'SJ Carbon T.Bayang uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 26000,
            'bahan'=>'Carbon','variasi_1'=>'T.Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon T.Bayang uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Carbon T.Bayang uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 27000,
            'bahan'=>'Carbon','variasi_1'=>'T.Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Tulang Bayang',
            'nama_nota' => 'SJ Carbon Tulang Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 22000,
            'bahan'=>'Carbon','variasi_1'=>'Tulang Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Tulang Bayang + LG.Bludru',
            'nama_nota' => 'SJ Carbon Tulang Bayang + LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 23000,
            'bahan'=>'Carbon','variasi_1'=>'Tulang Bayang','varian_1'=>null,'variasi_2'=>'LG.Blurdru','varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Tulang Bayang Prima + LG.Bludru',
            'nama_nota' => 'SJ Carbon Tulang Bayang Prima + LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 24000,
            'bahan'=>'Carbon','variasi_1'=>'Tulang Bayang','varian_1'=>'Prima','variasi_2'=>'LG.Blurdru','varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Tulang Bayang Prima uk.JB93x53 + LG.Bludru',
            'nama_nota' => 'SJ Carbon Tulang Bayang Prima uk.JB + LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 28000,
            'bahan'=>'Carbon','variasi_1'=>'Tulang Bayang','varian_1'=>'Prima','variasi_2'=>'LG.Blurdru','varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Carbon Tulang Bayang Prima uk.JB93x53 + LG.Polymas',
            'nama_nota' => 'SJ Carbon Tulang Bayang Prima uk.JB + LG.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 28000,
            'bahan'=>'Carbon','variasi_1'=>'Tulang Bayang','varian_1'=>'Prima','variasi_2'=>'LG.Polymas','varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity LG.Bludru',
            'nama_nota' => 'SJ Grafity LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Grafity','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity LG.Polymas',
            'nama_nota' => 'SJ Grafity LG.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Grafity','variasi_1'=>'LG.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity LG.Polymas + jht.Univ',
            'nama_nota' => 'SJ Grafity LG.Polymas + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 16500,
            'bahan'=>'Grafity','variasi_1'=>'LG.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity LG.Sablon',
            'nama_nota' => 'SJ Grafity LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Grafity','variasi_1'=>'LG.Sablon','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity LG.Stiker',
            'nama_nota' => 'SJ Grafity LG.Stiker',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Grafity','variasi_1'=>'LG.Stiker','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity Polos',
            'nama_nota' => 'SJ Grafity Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
            'bahan'=>'Grafity','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity Polos + jht.Univ',
            'nama_nota' => 'SJ Grafity Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Grafity','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity Polos uk.JB93x53',
            'nama_nota' => 'SJ Grafity Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Grafity','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Grafity Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'Grafity','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity Polos uk.NMAX + jht.NMAX',
            'nama_nota' => 'SJ Grafity Polos uk.NMAX + jht.NMAX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'Grafity','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'NMAX','jahit'=>'NMAX',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Bayang',
            'nama_nota' => 'SJ Grafity T.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Grafity','variasi_1'=>'T.Bayang','varian_1'=>'Trisula','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon',
            'nama_nota' => 'SJ Grafity T.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon Doraemon',
            'nama_nota' => 'SJ Grafity T.Sablon Doraemon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'Doraemon','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon Doraemon Jepang',
            'nama_nota' => 'SJ Grafity T.Sablon Doraemon Jepang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'Doraemon Jepang','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon Doraemon New',
            'nama_nota' => 'SJ Grafity T.Sablon Doraemon New',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'Doraemon New','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon HelloKitty2',
            'nama_nota' => 'SJ Grafity T.Sablon HelloKitty2',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'HelloKitty2','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon Keropi No.9',
            'nama_nota' => 'SJ Grafity T.Sablon Keropi No.9',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'Keropi No.9','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon Keropi',
            'nama_nota' => 'SJ Grafity T.Sablon Keropi',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'Keropi','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Polymas Macan uk.JB93x53',
            'nama_nota' => 'SJ Grafity T.Polymas Macan uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Polymas','varian_1'=>'Macan','variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon MickeyMouse',
            'nama_nota' => 'SJ Grafity T.Sablon MickeyMouse',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'MickeyMouse','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon Minion',
            'nama_nota' => 'SJ Grafity T.Sablon Minion',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'Minion','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity Tulang Bayang Prima',
            'nama_nota' => 'SJ Grafity Tulang Bayang Prima',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'Tulang Bayang','varian_1'=>'Prima','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity Tulang Bayang Prima + LG.Bludru',
            'nama_nota' => 'SJ Grafity Tulang Bayang Prima + LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'Tulang Bayang','varian_1'=>'Prima','variasi_2'=>'LG.Bludru','varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity Tulang Bayang Prima + LG.Sablon',
            'nama_nota' => 'SJ Grafity Tulang Bayang Prima + LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'Tulang Bayang','varian_1'=>'Prima','variasi_2'=>'LG.Sablon','varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon RacingBoy',
            'nama_nota' => 'SJ Grafity T.Sablon RacingBoy',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'RacingBoy','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon 46 The Doctor', //
            'nama_nota' => 'SJ Grafity T.Sablon 46 The Doctor',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'Rossy 46','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon Somjin 7X',
            'nama_nota' => 'SJ Grafity T.Sablon Somjin 7X',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'Somjin 7X','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon Straw Hat',
            'nama_nota' => 'SJ Grafity T.Sablon Straw Hat',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'Straw Hat','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Polymas Tokage',
            'nama_nota' => 'SJ Grafity T.Polymas Tokage',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Grafity','variasi_1'=>'T.Polymas','varian_1'=>'Tokage','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Sablon Tribal 1-6 + jht.Univ',
            'nama_nota' => 'SJ Grafity T.Sablon Tribal 1-6 + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Grafity','variasi_1'=>'T.Sablon','varian_1'=>'Tribal 1-6','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Polymas Trisula',
            'nama_nota' => 'SJ Grafity T.Polymas Trisula',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Grafity','variasi_1'=>'T.Polymas','varian_1'=>'Trisula','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Polymas Naga',
            'nama_nota' => 'SJ Grafity T.Polymas Naga',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Grafity','variasi_1'=>'T.Polymas','varian_1'=>'Naga','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity T.Polymas',
            'nama_nota' => 'SJ Grafity T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Grafity','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity Tulang Bayang + LG.Bludru',
            'nama_nota' => 'SJ Grafity Tulang Bayang + LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'Grafity','variasi_1'=>'Tulang Bayang','varian_1'=>null,'variasi_2'=>'LG.Bludru','varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Grafity Tulang Bayang Prima',
            'nama_nota' => 'SJ Grafity Tulang Bayang Prima',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Grafity','variasi_1'=>'Tulang Bayang','varian_1'=>'Prima','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk LG.Bayang',
            'nama_nota' => 'SJ Kulit Jeruk LG.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'LG.Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk LG.Bayang + jht.Univ',
            'nama_nota' => 'SJ Kulit Jeruk LG.Bayang + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'LG.Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk LG.Bludru',
            'nama_nota' => 'SJ Kulit Jeruk LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk LG.Bludru + jht.RXK',
            'nama_nota' => 'SJ Kulit Jeruk LG.Bludru + jht.RXK',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'RXK',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk LG.Bludru + jht.Univ',
            'nama_nota' => 'SJ Kulit Jeruk LG.Bludru + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk LG.Sablon',
            'nama_nota' => 'SJ Kulit Jeruk LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'LG.Sablon','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk LG.Sablon Kartun',
            'nama_nota' => 'SJ Kulit Jeruk LG.Sablon Kartun',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'LG.Sablon','varian_1'=>'Kartun','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk LG.Sablon Netral',
            'nama_nota' => 'SJ Kulit Jeruk LG.Sablon Netral',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'LG.Sablon','varian_1'=>'Netral','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk Polos',
            'nama_nota' => 'SJ Kulit Jeruk Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk Polos + jht.Univ',
            'nama_nota' => 'SJ Kulit Jeruk Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk Polos uk.JB93x53',
            'nama_nota' => 'SJ Kulit Jeruk Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Kulit Jeruk Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk Polos uk.97x68.5',
            'nama_nota' => 'SJ Kulit Jeruk Polos uk.97x68.5',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'Kulit Jeruk','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'97x68.5','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk(CK)(RY) LG.Bludru',
            'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'Kulit Jeruk(CK)(RY)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk(CK)(RY) Polos',
            'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13000,
            'bahan'=>'Kulit Jeruk(CK)(RY)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk(CK)(RY) T.Bayang C70',
            'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) T.Bayang C70',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'Kulit Jeruk(CK)(RY)','variasi_1'=>'T.Bayang','varian_1'=>'C70','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk(CK)(RY) T.Bayang CB',
            'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) T.Bayang CB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'Kulit Jeruk(CK)(RY)','variasi_1'=>'T.Bayang','varian_1'=>'CB','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Kulit Jeruk(CK)(RY) T.Bayang RXK',
            'nama_nota' => 'SJ Kulit Jeruk(CK)(RY) T.Bayang RXK',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'Kulit Jeruk(CK)(RY)','variasi_1'=>'T.Bayang','varian_1'=>'RXK','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(CK) LG.Bludru',
            'nama_nota' => 'SJ L55(CK) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'L55(CK)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(CK) LG.Bludru + jht.Univ',
            'nama_nota' => 'SJ L55(CK) LG.Bludru + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15000,
            'bahan'=>'L55(CK)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(CK) LG.Bludru uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ L55(CK) LG.Bludru uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'L55(CK)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(CK) Polos',
            'nama_nota' => 'SJ L55(CK) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13000,
            'bahan'=>'L55(CK)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(CK) Polos + jht.ABS-RV',
            'nama_nota' => 'SJ L55(CK) Polos + jht.ABS-RV',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'L55(CK)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'ABS-RV',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(CK) Polos + jht.Univ',
            'nama_nota' => 'SJ L55(CK) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'L55(CK)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(CK) Polos uk.JB93x53',
            'nama_nota' => 'SJ L55(CK) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17000,
            'bahan'=>'L55(CK)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(CK) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ L55(CK) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'L55(CK)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(CK) T.Polymas',
            'nama_nota' => 'SJ L55(CK) T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'L55(CK)','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(MC) LG.Bludru',
            'nama_nota' => 'SJ L55(MC) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'L55(MC)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(MC) Polos',
            'nama_nota' => 'SJ L55(MC) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13000,
            'bahan'=>'L55(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(MC) Polos + jht.Univ',
            'nama_nota' => 'SJ L55(MC) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'L55(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(MC) Polos uk.JB93x53',
            'nama_nota' => 'SJ L55(MC) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14000,
            'bahan'=>'L55(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'L55(MC) T.Polymas',
            'nama_nota' => 'SJ L55(MC) T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18000,
            'bahan'=>'L55(MC)','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole LG.Bayang',
            'nama_nota' => 'SJ LuckyHole LG.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13500,
            'bahan'=>'LuckyHole','variasi_1'=>'LG.Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole LG.Bayang + jht.Univ',
            'nama_nota' => 'SJ LuckyHole LG.Bayang + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
            'bahan'=>'LuckyHole','variasi_1'=>'LG.Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole LG.Bludru',
            'nama_nota' => 'SJ LuckyHole LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13500,
            'bahan'=>'LuckyHole','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole LG.Bludru + jht.Univ',
            'nama_nota' => 'SJ LuckyHole LG.Bludru + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
            'bahan'=>'LuckyHole','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole LG.Polymas',
            'nama_nota' => 'SJ LuckyHole LG.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13500,
            'bahan'=>'LuckyHole','variasi_1'=>'LG.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole Polos',
            'nama_nota' => 'SJ LuckyHole Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 12500,
            'bahan'=>'LuckyHole','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole Polos + jht.Univ',
            'nama_nota' => 'SJ LuckyHole Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13500,
            'bahan'=>'LuckyHole','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole Polos uk.JB93x53',
            'nama_nota' => 'SJ LuckyHole Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 16500,
            'bahan'=>'LuckyHole','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ LuckyHole Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'LuckyHole','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole Warna LG.Bludru',
            'nama_nota' => 'SJ LuckyHole Warna LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13500,
            'bahan'=>'LuckyHole Warna','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole(FB) LG.Bludru',
            'nama_nota' => 'SJ LuckyHole(FB) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13500,
            'bahan'=>'LuckyHole(FB)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole(FB) Polos',
            'nama_nota' => 'SJ LuckyHole(FB) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 12500,
            'bahan'=>'LuckyHole(FB)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole Biru LG.Bludru',
            'nama_nota' => 'SJ LuckyHole Biru LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13500,
            'bahan'=>'LuckyHole Biru','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole Hitam LG.Bludru',
            'nama_nota' => 'SJ LuckyHole Hitam LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13500,
            'bahan'=>'LuckyHole Biru','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole Kuning LG.Bludru',
            'nama_nota' => 'SJ LuckyHole Kuning LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13500,
            'bahan'=>'LuckyHole Kuning','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole Merah LG.Bludru',
            'nama_nota' => 'SJ LuckyHole Merah LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 13500,
            'bahan'=>'LuckyHole Merah','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'LuckyHole Merah Polos',
            'nama_nota' => 'SJ LuckyHole Merah Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 12500,
            'bahan'=>'LuckyHole Merah','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'MBtech(BD) LG.Bayang',
            'nama_nota' => 'SJ MBtech(BD) LG.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 42000,
            'bahan'=>'MBtech(BD)','variasi_1'=>'LG.Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'MBtech(BD) Polos',
            'nama_nota' => 'SJ MBtech(BD) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 41000,
            'bahan'=>'MBtech(BD)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'MBtech(BD) Tulang Bayang + LG.Bayang',
            'nama_nota' => 'SJ MBtech(BD) Tulang Bayang + LG.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 45000,
            'bahan'=>'MBtech(BD)','variasi_1'=>'Tulang Bayang','varian_1'=>null,'variasi_2'=>'LG.Bayang','varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'MBtech(KJ) Polos',
            'nama_nota' => 'SJ MBtech(KJ) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 41000,
            'bahan'=>'MBtech(BD)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'MBtech(RD) Polos',
            'nama_nota' => 'SJ MBtech(RD) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 41000,
            'bahan'=>'MBtech(BD)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) LG.Bayang',
            'nama_nota' => 'SJ Navaro(MC) LG.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'LG.Bayang','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) LG.Bludru',
            'nama_nota' => 'SJ Navaro(MC) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) LG.Bludru uk.JB93x53',
            'nama_nota' => 'SJ Navaro(MC) LG.Bludru uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) LG.Sablon Kartun',
            'nama_nota' => 'SJ Navaro(MC) LG.Sablon Kartun',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'LG.Sablon','varian_1'=>'Kartun','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) LG.Mika 1W',
            'nama_nota' => 'SJ Navaro(MC) LG.Mika 1W',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'LG.Mika','varian_1'=>'1W','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) LG.Polymas',
            'nama_nota' => 'SJ Navaro(MC) LG.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'LG.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) LG.Polymas uk.JB93x53',
            'nama_nota' => 'SJ Navaro(MC) LG.Polymas uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'LG.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB3x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) Polos',
            'nama_nota' => 'SJ Navaro(MC) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) Polos + jht.ABS-RV',
            'nama_nota' => 'SJ Navaro(MC) Polos + jht.ABS-RV',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'ABS-RV',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) Polos + jht.RXK',
            'nama_nota' => 'SJ Navaro(MC) Polos + jht.RXK',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'RXK',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) Polos + jht.Univ',
            'nama_nota' => 'SJ Navaro(MC) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) Polos uk.JB93x53',
            'nama_nota' => 'SJ Navaro(MC) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Navaro(MC) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) Polos uk.NMAX + jht.NMAX',
            'nama_nota' => 'SJ Navaro(MC) Polos uk.NMAX + jht.NMAX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'NMAX','jahit'=>'NMAX',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) Polos uk.GIGA100x68.5',
            'nama_nota' => 'SJ Navaro(MC) Polos uk.GIGA',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20000,
            'bahan'=>'Navaro(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'GIGA100x68.5','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) Polos uk.PCX + jht.PCX',
            'nama_nota' => 'SJ Navaro(MC) Polos uk.PCX + jht.PCX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'Navaro(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'PCX','jahit'=>'PCX',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Bikers',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Bikers',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Bikers','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Doraemon',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Doraemon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Doraemon','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Fox',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Fox',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Fox','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon HelloKitty2',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon HelloKitty2',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'HelloKitty2','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Kelabang',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Kelabang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Kelabang','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Keropi',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Keropi',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Keropi','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Laba"',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Laba"',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Laba"','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Macan',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Macan',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Macan','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon MickeyMouse',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon MickeyMouse',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'MickeyMouse','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Minion',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Minion',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Minion','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Modi',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Modi',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Modi','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Movistar',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Movistar',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Movistar','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon RacingBoy',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon RacingBoy',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'RacingBoy','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Scorpion',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Scorpion',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Scorpion','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Sepatu',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Sepatu',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Sepatu','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon SpongeBob',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon SpongeBob',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'SpongeBob','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Tribal 46',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Tribal 46',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Tribal 46','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Sablon Tribal Movistar',
            'nama_nota' => 'SJ Navaro(MC) T.Sablon Tribal Movistar',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 17500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Sablon','varian_1'=>'Tribal Movistar','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Polymas',
            'nama_nota' => 'SJ Navaro(MC) T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Polymas + jht.Univ',
            'nama_nota' => 'SJ Navaro(MC) T.Polymas + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Polymas','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Polymas Trisula',
            'nama_nota' => 'SJ Navaro(MC) T.Polymas Trisula',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Polymas','varian_1'=>'Trisula','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Polymas Trisula + jht.Univ',
            'nama_nota' => 'SJ Navaro(MC) T.Polymas Trisula + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Polymas','varian_1'=>'Trisula','variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Navaro(MC) T.Polymas Trisula + LG.Polymas + jht.Univ',
            'nama_nota' => 'SJ Navaro(MC) T.Polymas Trisula + LG.Polymas + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21500,
            'bahan'=>'Navaro(MC)','variasi_1'=>'T.Polymas','varian_1'=>'Trisula','variasi_2'=>'LG.Polymas','varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'UratTangan(MC) LG.Bludru',
            'nama_nota' => 'SJ UratTangan(MC) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'UratTangan(MC)','variasi_1'=>'LG.Bludru','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'UratTangan(MC) Polos',
            'nama_nota' => 'SJ UratTangan(MC) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
            'bahan'=>'UratTangan(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'UratTangan(MC) Polos + jht.RXK',
            'nama_nota' => 'SJ UratTangan(MC) Polos + jht.RXK',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'UratTangan(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'RXK',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'UratTangan(MC) Polos + jht.Univ',
            'nama_nota' => 'SJ UratTangan(MC) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'UratTangan(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'UratTangan(MC) Polos uk.JB93x53',
            'nama_nota' => 'SJ UratTangan(MC) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'UratTangan(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'UratTangan(MC) Polos uk.NMAX + jht.NMAX',
            'nama_nota' => 'SJ UratTangan(MC) Polos uk.NMAX + jht.NMAX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'UratTangan(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'NMAX','jahit'=>'NMAX',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'UratTangan(MC) Polos uk.Aerox + jht.Aerox',
            'nama_nota' => 'SJ UratTangan(MC) Polos uk.Aerox + jht.Aerox',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'UratTangan(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'Aerox','jahit'=>'Aerox',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'UratTangan(MC) Polos uk.FreeGo + jht.FreeGo',
            'nama_nota' => 'SJ UratTangan(MC) Polos uk.FreeGo + jht.FreeGo',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
            'bahan'=>'UratTangan(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'FreeGo','jahit'=>'FreeGo',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'UratTangan(MC) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ UratTangan(MC) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'UratTangan(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(M) LG.Sablon',
            'nama_nota' => 'SJ Vario(M) LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Vario(M)','variasi_1'=>'LG.Sablon','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(M) Polos',
            'nama_nota' => 'SJ Vario(M) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
            'bahan'=>'Vario(M)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(M) Polos + jht.Univ',
            'nama_nota' => 'SJ Vario(M) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
            'bahan'=>'Vario(M)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(M) Polos uk.JB93x53',
            'nama_nota' => 'SJ Vario(M) Polos uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
            'bahan'=>'Vario(M)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(M) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Vario(M) Polos uk.JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'Vario(M)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'JB93x53','jahit'=>'JB',
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(M) Polos uk.SuperJB97x53',
            'nama_nota' => 'SJ Vario(M) Polos uk.Super-JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'Vario(M)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'SuperJB97x53','jahit'=>null,
        ], [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(M) Polos uk.SuperJB97x53 + jht.JB',
            'nama_nota' => 'SJ Vario(M) Polos uk.Super-JB + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
            'bahan'=>'Vario(M)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'SuperJB97x53','jahit'=>'JB',
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
            'nama' => 'Vario(M) T.Sablon Fox',
            'nama_nota' => 'SJ Vario(M) T.Sablon Fox',
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
            'nama' => 'Vario(M) T.Sablon RacingBoy',
            'nama_nota' => 'SJ Vario(M) T.Sablon RacingBoy',
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
            'nama' => 'Vario(MC) LG.Polymas uk.JB93x53',
            'nama_nota' => 'SJ Vario(MC) LG.Polymas uk.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) LG.Sablon',
            'nama_nota' => 'SJ Vario(MC) LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
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
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) LG.Sablon uk.JB93x53',
            'nama_nota' => 'SJ Vario(MC) LG.Sablon uk.JB93x53',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) Polos',
            'nama_nota' => 'SJ Vario(MC) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) Polos + jht.ABS-RV',
            'nama_nota' => 'SJ Vario(MC) Polos + jht.ABS-RV',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) Polos + jht.Univ',
            'nama_nota' => 'SJ Vario(MC) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Vario(MC) Polos uk.JB93x53 + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) Polos uk.NMAX + jht.NMAX',
            'nama_nota' => 'SJ Vario(MC) Polos uk.NMAX + jht.NMAX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Bayang',
            'nama_nota' => 'SJ Vario(MC) T.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Bayang + jht.Univ',
            'nama_nota' => 'SJ Vario(MC) T.Bayang + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Bayang Trisula',
            'nama_nota' => 'SJ Vario(MC) T.Bayang Trisula',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Bayang + LG.Sablon',
            'nama_nota' => 'SJ Vario(MC) T.Bayang + LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Bayang C70',
            'nama_nota' => 'SJ Vario(MC) T.Bayang C70',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Bayang CB',
            'nama_nota' => 'SJ Vario(MC) T.Bayang CB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Bayang Cumi',
            'nama_nota' => 'SJ Vario(MC) T.Bayang Cumi',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Polymas',
            'nama_nota' => 'SJ Vario(MC) T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Polymas + jht.Univ',
            'nama_nota' => 'SJ Vario(MC) T.Polymas + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Polymas Cumi',
            'nama_nota' => 'SJ Vario(MC) T.Polymas Cumi',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Polymas Naga',
            'nama_nota' => 'SJ Vario(MC) T.Polymas Naga',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Polymas Trisula',
            'nama_nota' => 'SJ Vario(MC) T.Polymas Trisula',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Polymas Trisula + LG.Polymas',
            'nama_nota' => 'SJ Vario(MC) T.Polymas Trisula + LG.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Polymas Trisula + LG.Polymas + jht.Univ',
            'nama_nota' => 'SJ Vario(MC) T.Polymas Trisula + LG.Polymas + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Polymas uk.JB93x53',
            'nama_nota' => 'SJ Vario(MC) T.Polymas uk.JB93x53',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 23500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon',
            'nama_nota' => 'SJ Vario(MC) T.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon uk.JB93x53',
            'nama_nota' => 'SJ Vario(MC) T.Sablon uk.JB93x53',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon + Press',
            'nama_nota' => 'SJ Vario(MC) T.Sablon + Press',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Bikers',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Bikers',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Bride 9X',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Bride 9X',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Doraemon New',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Doraemon New',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Doraemon',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Doraemon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Fox',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Fox',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon HelloKitty2',
            'nama_nota' => 'SJ Vario(MC) T.Sablon HelloKitty2',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Scorpion',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Scorpion',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Kawahara 8X',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Kawahara 8X',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Kelabang',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Kelabang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Keropi',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Keropi',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Laba"',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Laba"',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Macan',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Macan',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Minion',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Minion',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Movistar',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Movistar',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Movistar XLGP',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Movistar XLGP',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon NGO 7X',
            'nama_nota' => 'SJ Vario(MC) T.Sablon NGO 7X',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Sepatu',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Sepatu',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Somjin 7X',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Somjin 7X',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon SpongeBob',
            'nama_nota' => 'SJ Vario(MC) T.Sablon SpongeBob',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Thailook 5X',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Thailook 5X',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Tribal 1-6 + jht.Univ',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Tribal 1-6 + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Tribal 4',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Tribal 4',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Tribal 46',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Tribal 46',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Tribal Movistar',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Tribal Movistar',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) T.Sablon Tribal Petir',
            'nama_nota' => 'SJ Vario(MC) T.Sablon Tribal Petir',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) Tulang Bayang + LG.Bludru',
            'nama_nota' => 'SJ Vario(MC) Tulang Bayang + LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MC) Tulang Bayang + LG.Sablon',
            'nama_nota' => 'SJ Vario(MC) Tulang Bayang + LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MCR) LG.Sablon',
            'nama_nota' => 'SJ Vario(MCR) LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MCR) Polos',
            'nama_nota' => 'SJ Vario(MCR) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MCR) Polos + jht.ABS-RV',
            'nama_nota' => 'SJ Vario(MCR) Polos + jht.ABS-RV',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MCR) Polos + jht.Univ',
            'nama_nota' => 'SJ Vario(MCR) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MCR) Polos uk.JB93x53',
            'nama_nota' => 'SJ Vario(MCR) Polos uk.JB93x53',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MCR) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Vario(MCR) Polos uk.JB93x53 + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MCR) T.Sablon Macan',
            'nama_nota' => 'SJ Vario(MCR) T.Sablon Macan',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MCR) T.Polymas',
            'nama_nota' => 'SJ Vario(MCR) T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MCR) Tulang Bayang',
            'nama_nota' => 'SJ Vario(MCR) Tulang Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(MCR) Tulang Bayang + LG.Sablon',
            'nama_nota' => 'SJ Vario(MCR) Tulang Bayang + LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) LG.Bludru',
            'nama_nota' => 'SJ Vario(RY) LG.Bludru',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) LG.Bludru + jht.Univ',
            'nama_nota' => 'SJ Vario(RY) LG.Bludru + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 16500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) LG.Sablon',
            'nama_nota' => 'SJ Vario(RY) LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) LG.Sablon + jht.Univ',
            'nama_nota' => 'SJ Vario(RY) LG.Sablon + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 16500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) LG.Stiker',
            'nama_nota' => 'SJ Vario(RY) LG.Stiker',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) Polos',
            'nama_nota' => 'SJ Vario(RY) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) Polos + jht.Univ',
            'nama_nota' => 'SJ Vario(RY) Polos + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 15500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) Polos uk.JB93x53',
            'nama_nota' => 'SJ Vario(RY) Polos uk.JB93x53',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) Polos uk.JB93x53 + jht.JB',
            'nama_nota' => 'SJ Vario(RY) Polos uk.JB93x53 + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) Polos uk.NMAX + jht.NMAX',
            'nama_nota' => 'SJ Vario(RY) Polos uk.NMAX + jht.NMAX',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) Polos uk.SuperJB97x53 + jht.JB',
            'nama_nota' => 'SJ Vario(RY) Polos uk.SuperJB97x53 + jht.JB',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 21000,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Bayang',
            'nama_nota' => 'SJ Vario(RY) T.Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Bayang + jht.Univ',
            'nama_nota' => 'SJ Vario(RY) T.Bayang + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Bayang Trisula',
            'nama_nota' => 'SJ Vario(RY) T.Bayang Trisula',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Polymas',
            'nama_nota' => 'SJ Vario(RY) T.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Polymas Trisula',
            'nama_nota' => 'SJ Vario(RY) T.Polymas Trisula',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Sablon',
            'nama_nota' => 'SJ Vario(RY) T.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Sablon + Press',
            'nama_nota' => 'SJ Vario(RY) T.Sablon + Press',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 19500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Sablon Doraemon',
            'nama_nota' => 'SJ Vario(RY) T.Sablon Doraemon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Sablon HelloKitty2',
            'nama_nota' => 'SJ Vario(RY) T.Sablon HelloKitty2',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Sablon MickeyMouse',
            'nama_nota' => 'SJ Vario(RY) T.Sablon MickeyMouse',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Sablon Thailook 5X',
            'nama_nota' => 'SJ Vario(RY) T.Sablon Thailook 5X',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Sablon Tribal 1-6',
            'nama_nota' => 'SJ Vario(RY) T.Sablon Tribal 1-6',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) T.Sablon Tribal 46',
            'nama_nota' => 'SJ Vario(RY) T.Sablon Tribal 46',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario(RY) Tulang Bayang + LG.Sablon',
            'nama_nota' => 'SJ Vario(RY) Tulang Bayang + LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Coklat Polos uk.Scoopy + jht.Scoopy',
            'nama_nota' => 'SJ Vario Coklat Polos uk.Scoopy + jht.Scoopy',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 20500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Merah T.Sablon Doraemon',
            'nama_nota' => 'SJ Vario Merah T.Sablon Doraemon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Merah T.Sablon HelloKitty2',
            'nama_nota' => 'SJ Vario Merah T.Sablon HelloKitty2',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Merah T.Sablon MickeyMouse',
            'nama_nota' => 'SJ Vario Merah T.Sablon MickeyMouse',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Putih T.Sablon Doraemon',
            'nama_nota' => 'SJ Vario Putih T.Sablon Doraemon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Merah T.Sablon HelloKitty2',
            'nama_nota' => 'SJ Vario Merah T.Sablon HelloKitty2',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Merah T.Sablon HelloKitty2 uk.SuperJB97x53',
            'nama_nota' => 'SJ Vario Merah T.Sablon HelloKitty2 uk.SuperJB97x53',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 24000,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Warna Polos',
            'nama_nota' => 'SJ Vario Warna Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 14500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Warna T.Sablon Doraemon',
            'nama_nota' => 'SJ Vario Warna T.Sablon Doraemon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Warna T.Sablon HelloKitty2',
            'nama_nota' => 'SJ Vario Warna T.Sablon HelloKitty2',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Vario Warna T.Sablon MickeyMouse',
            'nama_nota' => 'SJ Vario Warna T.Sablon MickeyMouse',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 18500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Zeus(BD) Polos',
            'nama_nota' => 'SJ Zeus(BD) Polos',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 30500,
        ],
        [
            'tipe' => 'SJ-Variasi',
            'nama' => 'Zeus(BD) Tulang Bayang',
            'nama_nota' => 'SJ Zeus(BD) Tulang Bayang',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 30500,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => 'Jok Assy Absolute Revo',
            'nama_nota' => 'Jok Assy Absolute Revo',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>'Absolute Revo','variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => 'Jok Assy Beat',
            'nama_nota' => 'Jok Assy Beat',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>'Beat','variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => 'Jok Assy Beat FI',
            'nama_nota' => 'Jok Assy Beat FI',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>'Beat FI','variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => 'Jok Assy CB STD',
            'nama_nota' => 'Jok Assy CB STD',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>'CB STD','variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => 'Jok Assy F1ZR',
            'nama_nota' => 'Jok Assy F1ZR',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>'F1ZR','variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => 'Jok Assy Fit New',
            'nama_nota' => 'Jok Assy Fit New',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>'Fit New','variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => 'Jok Assy FU',
            'nama_nota' => 'Jok Assy FU',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>'FU','variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => 'Jok Assy GL Pro',
            'nama_nota' => 'Jok Assy GL Pro',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>'GL Pro','variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => 'Jok Assy Grand',
            'nama_nota' => 'Jok Assy Grand',
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>'Grand','variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Grand'97",
            'nama_nota' => "Jok Assy Grand'97",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Grand'97",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Jupiter MX",
            'nama_nota' => "Jok Assy Jupiter MX",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Jupiter MX",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Jupiter New",
            'nama_nota' => "Jok Assy Jupiter New",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Jupiter New",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Jupiter Z",
            'nama_nota' => "Jok Assy Jupiter Z",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Jupiter Z",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Mio M3",
            'nama_nota' => "Jok Assy Mio M3",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Jupiter Mio M3",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Mio Soul",
            'nama_nota' => "Jok Assy Mio Soul",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Jupiter Mio Soul",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Prima",
            'nama_nota' => "Jok Assy Prima",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Prima",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Revo FI",
            'nama_nota' => "Jok Assy Revo FI",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Revo FI",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy RXK",
            'nama_nota' => "Jok Assy RXK",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"RX King",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy RXK New",
            'nama_nota' => "Jok Assy RXK New",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"RXK New",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy RXK Perahu",
            'nama_nota' => "Jok Assy RXK Perahu", // Produk apa ni?
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"RXK Perahu",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy RXK Press",
            'nama_nota' => "Jok Assy RXK Press", // ada yang ga press brrti?
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"RXK Press",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Supra",
            'nama_nota' => "Jok Assy Supra",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Supra",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Supra 125",
            'nama_nota' => "Jok Assy Supra 125",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Supra 125",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Supra Fit New",
            'nama_nota' => "Jok Assy Supra Fit New",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Supra Fit New",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Supra X",
            'nama_nota' => "Jok Assy Supra X",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Supra Fit New",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Vario 125",
            'nama_nota' => "Jok Assy Vario 125",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Vario 125",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Vario Techno",
            'nama_nota' => "Jok Assy Vario Techno",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Vario Techno",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Vega R",
            'nama_nota' => "Jok Assy Vega R",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Vega R",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'Jok Assy',
            'nama' => "Jok Assy Vega ZR",
            'nama_nota' => "Jok Assy Vega ZR",
            'tipe_packing' => 'colly',
            'aturan_packing' => 150, // 34
            'harga' => 107500,
            'jokassy'=>"Vega ZR",'variasi_1'=>null,'varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi List Miring(A)',
            'nama_nota' => 'SJ Kombinasi List Miring(A)',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'List Miring','grade_bahan'=>"A",'bahan'=>null,'variasi_1'=>null,'varian_1'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi List Miring(A) + LG.Polymas',
            'nama_nota' => 'SJ Kombinasi List Miring(A) + LG.Polymas',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'List Miring','grade_bahan'=>"A",'bahan'=>null,'variasi_1'=>'LG.Polymas','varian_1'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi List Miring(A) + LG.Sablon',
            'nama_nota' => 'SJ Kombinasi List Miring(A) + LG.Sablon',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'List Miring','grade_bahan'=>"A",'bahan'=>null,'variasi_1'=>'LG.Sablon','varian_1'=>null,'ukuran'=>null,'jahit'=>null,
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi List Miring(A) + jht.Univ',
            'nama_nota' => 'SJ Kombinasi List Miring(A) + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'List Miring','grade_bahan'=>"A",'bahan'=>null,'variasi_1'=>null,'varian_1'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi Sayap Warna(A) + jht.Univ',
            'nama_nota' => 'SJ Kombinasi Sayap Warna(A) + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'Sayap Warna','grade_bahan'=>"A",'bahan'=>null,'variasi_1'=>null,'varian_1'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi Sayap Warna(A) + LG.Polymas + jht.Univ',
            'nama_nota' => 'SJ Kombinasi Sayap Warna(A) + LG.Polymas + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'Sayap Warna','grade_bahan'=>"A",'bahan'=>null,'variasi_1'=>'LG.Polymas','varian_1'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi Sayap Warna(A) + LG.Sablon + jht.Univ',
            'nama_nota' => 'SJ Kombinasi Sayap Warna(A) + LG.Sablon + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'Sayap Warna','grade_bahan'=>"A",'bahan'=>null,'variasi_1'=>'LG.Sablon','varian_1'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi Warna Japstyle(A) + jht.Univ',
            'nama_nota' => 'SJ Kombinasi Warna Japstyle(A) + jht.Univ',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'Warna Japstyle','grade_bahan'=>"A",'bahan'=>null,'variasi_1'=>null,'varian_1'=>null,'ukuran'=>null,'jahit'=>'Univ',
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi Warna X-Ride uk.JB93x53 + jht.Benang Warna',
            'nama_nota' => 'SJ Kombinasi Warna X-Ride uk.JB + jht. Benang Warna', // (L) untuk ukuran Jumbo, grade bahan B tidak ditulis
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'Warna X-Ride','grade_bahan'=>"B",'bahan'=>null,'variasi_1'=>null,'varian_1'=>null,'ukuran'=>'JB93x53','jahit'=>'Benang Warna',
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi Warna X-Ride uk.JB93x53 + jht.JB Benang Warna',
            'nama_nota' => 'SJ Kombinasi Warna X-Ride uk.JB + jht.JB Benang Warna',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'Warna X-Ride','grade_bahan'=>"B",'bahan'=>null,'variasi_1'=>null,'varian_1'=>null,'ukuran'=>'JB93x53','jahit'=>'JB Benang Warna',
        ], [
            'tipe' => 'SJ-Kombinasi',
            'nama' => 'Kombinasi Warna X-Ride(L) Benang Warna', // ?
            'nama_nota' => 'SJ Kombinasi Warna X-Ride(L) Benang Warna',
            'tipe_packing' => 'colly',
            'aturan_packing' => 100, // 34
            'harga' => 29000,
            'kombinasi'=>'Warna X-Ride','grade_bahan'=>"B",'bahan'=>null,'variasi_1'=>null,'varian_1'=>null,'ukuran'=>'JB93x53','jahit'=>'JB Benang Warna',
        ], [
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
                'tipe' => 'SJ-Japstyle',
                'nama' => 'Vario Warna Japstyle',
                'nama_nota' => 'SJ Vario Warna Japstyle',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 20500,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Hexagon 2 Warna(A) + jht.Univ',
                'nama_nota' => 'SJ Motif Hexagon 2 Warna(A) + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Hexagon 2 Warna uk.JB93x53+ jht.JB',
                'nama_nota' => 'SJ Motif Hexagon 2 Warna uk.JB93x53+ jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Sixpack 2 Warna(A) + jht.Univ',
                'nama_nota' => 'SJ Motif Sixpack 2 Warna(A) + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Sixpack 2 Warna(A) + Motif + jht.Univ',
                'nama_nota' => 'SJ Motif Sixpack 2 Warna(A) + Motif + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Sixpack 2 Warna(A) "Carbon" + LG + Motif + jht.Univ',
                'nama_nota' => 'SJ Motif Sixpack 2 Warna(A) + Motif + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Sixpack 2 Warna(A) uk.JB93x53 + jht.Univ',
                'nama_nota' => 'SJ Motif Sixpack 2 Warna(A) uk.JB + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 34
                'harga' => 29000,
            ],
            [
                'tipe' => 'SJ-Motif',
                'nama' => 'Motif Sixpack Full Hitam uk.JB93x53 + jht.Univ',
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
                'nama' => 'Standar GL Pro Bahan UratTangan(MC) + Alas',
                'nama_nota' => 'SJ Standar GL Pro Bahan UratTangan(MC) + Alas',
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
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'Bahan(A) T.Sixpack uk.JB93x53 + Busa + jht.JB',
                'nama_nota' => 'SJ Bahan(A) T.Sixpack uk.JB + Busa + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'C30(MC) T.Sixpack + Busa + jht.Univ',
                'nama_nota' => 'SJ C30(MC) T.Sixpack + Busa + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 27000,
                'bahan'=>'C30(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'MioSoulGT125','jahit'=>'MioSoulGT125',
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'C30(MC) T.Sixpack uk.JB93x53 + Busa',
                'nama_nota' => 'SJ C30(MC) T.Sixpack uk.JB + Busa',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 30500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'C30(MC) T.Sixpack uk.JB93x53 + Busa + jht.JB',
                'nama_nota' => 'SJ C30(MC) T.Sixpack uk.JB + Busa + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 31500,
            ], [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'T.Sixpack C38(MC) + Busa + jht.Univ',
                'nama_nota' => 'SJ T.Sixpack C38(MC) + Busa + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 27000,
                'bahan'=>'C38(MC)','variasi_1'=>'Polos','varian_1'=>null,'variasi_2'=>null,'varian_2'=>null,'ukuran'=>'Super-JB','jahit'=>'JB',
            ], [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'Carbon T.Sixpack uk.Super-JB + Busa +jht.JB',
                'nama_nota' => 'SJ Carbon T.Sixpack uk.Super-JB + Busa +jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 150, // 34
                'harga' => 34500,
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
                'nama' => 'L55(MC) T.Sixpack uk.JB93x53 + Busa + jht.JB',
                'nama_nota' => 'SJ L55(MC) T.Sixpack uk.JB + Busa + jht.JB',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack uk.SuperJB97x53 + Busa + jht.NMAX',
                'nama_nota' => 'SJ L55(MC) T.Sixpack uk.Super-JB + Busa + jht.NMAX',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'L55(MC) T.Sixpack uk.JB93x53 + Alas + jht.JB',
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
                'nama' => 'L55(MC) T.Sixpack uk.JB93x53 + Busa',
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
                'nama' => 'UratTangan(MC) T.Sixpack + Busa + jht.Univ',
                'nama_nota' => 'SJ UratTangan(MC) T.Sixpack + Busa + jht.Univ',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'Vario(MC) T.Sixpack + Busa + jht.ABS-RV',
                'nama_nota' => 'SJ Vario(MC) T.Sixpack + Busa + jht.ABS-RV',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'Vario(MC) T.Sixpack + Busa + jht.RXK',
                'nama_nota' => 'SJ Vario(MC) T.Sixpack + Busa + jht.RXK',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
            ],
            [
                'tipe' => 'SJ-T.Sixpack',
                'nama' => 'Vario(RY) T.Sixpack + Busa',
                'nama_nota' => 'SJ Vario(RY) T.Sixpack + Busa',
                'tipe_packing' => 'colly',
                'aturan_packing' => 100, // 38
                'harga' => 31500,
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
                'nama' => $produk[$i]['nama'],
                'nama_nota' => $produk[$i]['nama_nota'],
                'tipe_packing' => $produk[$i]['tipe_packing'],
                'aturan_packing' => $produk[$i]['aturan_packing'],
            ]);

            ProdukHarga::create([
                'produk_id' => $inserted_produk['id'],
                'harga' => $produk[$i]['harga'],
            ]);

            if ($produk[$i]['tipe'] === 'SJ-Variasi') {
                $bahan = Bahan::where('nama', $produk[$i]['bahan'])->first();
                ProdukBahan::create([
                    'produk_id' => $inserted_produk['id'],
                    'bahan_id' => $bahan['id']
                ]);

                $variasi_1 = Variasi::where('nama', $produk[$i]['variasi_1'])->first();
                $varian_1_id = null;
                if ($produk[$i]['varian_1'] !== null) {
                    $varian_1 = Variasi::where('nama', $produk[$i]['varian_1'])->first();
                    $varian_1_id = $varian_1['id'];
                }
                Attsjvariasi::create([
                    'produk_id' => $inserted_produk['id'],
                    'variasi_id' => $variasi_1['id'],
                    'varian_id' => $varian_1_id,
                ]);

                if (isset($produk[$i]['variasi_2'])) {
                    if ($produk[$i]['variasi_2'] !== null) {
                        $variasi_2 = Variasi::where('nama', $produk[$i]['variasi_2'])->first();
                        $varian_2_id = null;
                        if ($produk[$i]['varian_2'] !== null) {
                            $varian_2 = Variasi::where('nama', $produk[$i]['varian_2'])->first();
                            $varian_2_id = $varian_2['id'];
                        }
                        Attsjvariasi::create([
                            'produk_id' => $inserted_produk['id'],
                            'variasi_id' => $variasi_2['id'],
                            'varian_id' => $varian_2_id,
                        ]);
                    }
                }

                if (isset($produk[$i]['ukuran'])) {
                    if ($produk[$i]['ukuran'] !== null) {
                        $ukuran = Spec::where('kategori', 'ukuran')->where('nama', $produk[$i]['ukuran'])->first();
                        ProdukSpec::create([
                            'produk_id' => $inserted_produk['id'],
                            'spec_id' => $ukuran['id']
                        ]);
                    }
                }

                if (isset($produk[$i]['jahit'])) {
                    if ($produk[$i]['jahit'] !== null) {
                        $jahit = Spec::where('kategori', 'jahit')->where('nama', $produk[$i]['jahit'])->first();
                        ProdukSpec::create([
                            'produk_id' => $inserted_produk['id'],
                            'spec_id' => $jahit['id']
                        ]);
                    }
                }
            }
        }

        /** LIST LG.STIKER
         * - TDR
         * - YSS
        */

    }
}
