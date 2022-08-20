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
                'bentuk' => 'PT',
                'nama' => 'Adhiputra',
                'alamat' => '["Jl. RE Martadinata", "Pergudangan Caraka, BLOK 1K", "Tj. Priok"]',
                'no_kontak' => '(021) 4391 3388',
            ], [
                'bentuk' => null,
                'nama' => 'AFRO',
                'alamat' => '["Komplek Ruko Permata Ancol BLOK K-33"]',
                'no_kontak' => '(021) 645 0978',
            ], [
                'bentuk' => null,
                'nama' => 'ALTRANS',
                'alamat' => '["Jl. Agung Timur 8, BLOK 2", "Ruko Prima Sunter"]',
                'no_kontak' => '(021) 651 0665',
            ], [
                'bentuk' => 'CV',
                'nama' => 'Angkasa',
                'alamat' => '["Jl. Mangga Dua Raya", "Ruko Mangga Dua Plaza", "BLOK B, No. 06"]',
                'no_kontak' => '(021)6120 705',
            ], [
                'bentuk' => null,
                'nama' => 'Anugrah',
                'alamat' => '["Komplek DHI", "BLOK G", "No.22-23"]',
                'no_kontak' => '(021) 6623 077',
            ], [
                'bentuk' => 'CV',
                'nama' => 'Anugrah Duta Prima',
                'alamat' => '["Jl. Teluk Aru Utara 1 No.19", "Surabaya"]',
                'no_kontak' => '(031) 329 5462',
            ], [
                'bentuk' => 'CV',
                'nama' => 'Arung Samudra Express',
                'alamat' => '["Jl. Sukarjo Wiryo Pranoto No.11 B", "(Depan Stasiun KA Sawah Besar)"]',
                'no_kontak' => '(021) 6285 574',
            ], [
                'bentuk' => null,
                'nama' => 'Atlantic Cargo',
                'alamat' => '["Komplek Ruko Permata Ancol", "BLOK L-20"]',
                'no_kontak' => '(021) 6457 856',
            ], [
                'bentuk' => null,
                'nama' => 'Bahari Utama Jaya',
                'alamat' => '["Komplek Lodan Center BLOK P No.1"]',
                'no_kontak' => '(021) 691 6756',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Bangkit Jaya Manunggal',
                'alamat' => '["Jl. Tubagus Angke, Duta Square", "BLOK B, No.2, Jelambar"]',
                'no_kontak' => '(021) 5695 9281',
            ], [
                'bentuk' => null,
                'nama' => 'Baraka Sarana Tama',
                'alamat' => '["Cibinong"]',
                'no_kontak' => null,
            ], [
                'bentuk' => null,
                'nama' => 'Berkat Abadi Jaya',
                'alamat' => '["Jl. Krekot IV", "BLOK I No.16", "Pasar Baru"]',
                'no_kontak' => '(021) 381 4429',
            ], [
                'bentuk' => null,
                'nama' => 'Berkat Mandiri Trans',
                'alamat' => '["Jl. Lontar No.38, RT:1/RW:7", "Kebon Kacang, Tanah Abang"]',
                'no_kontak' => '0822 1313 9975',
            ], [
                'bentuk' => null,
                'nama' => 'Bintang Khatulistiwa',
                'alamat' => '["Jl. Teluk Kumai Timur No.14", "Depo Tanto 4, Surabaya"]',
                'no_kontak' => '0851 0010 7030',
            ], [
                'bentuk' => null,
                'nama' => 'Bintang Saudara',
                'alamat' => '["Komplek DHI, BLOK KK No.99"]',
                'no_kontak' => '(021) 660 5887',
            ], [
                'bentuk' => null,
                'nama' => 'BJA',
                'alamat' => '["Jl. Kapuk Kamal Raya No.40", "Pluit Bisnis BLOK N, No.8"]',
                'no_kontak' => '0822 1327 6565',
            ], [
                'bentuk' => null,
                'nama' => 'Cahaya Lintas',
                'alamat' => '["Komplek Ruko Permata Ancol", "BLOK P, No.22"]',
                'no_kontak' => '(021) 6457 818',
            ], [
                'bentuk' => null,
                'nama' => 'Cendana Makmur Bahagia',
                'alamat' => '["Jl. Pangeran Jayakarta", "GG Melawan No.123/71"]',
                'no_kontak' => '(021) 6120 709',
            ], [
                'bentuk' => null,
                'nama' => 'Citramas',
                'alamat' => '["Jl. Kapuk Kamal Raya No.40", "Pluit Bisnis BLOK N, No.7"]',
                'no_kontak' => '0877 7242 7956',
            ], [
                'bentuk' => null,
                'nama' => 'Dakota',
                'alamat' => '["Gunung Putri, Wanaherang"]',
                'no_kontak' => null,
            ], [
                'bentuk' => null,
                'nama' => 'Davindo',
                'alamat' => '["Jl. Lodan Raya No.15 B", "(Depan MKS)"]',
                'no_kontak' => '0811 9100 122',
            ], [
                'bentuk' => null,
                'nama' => 'Domestic Universal Cargo',
                'alamat' => '["Komplek Permata Ancol BLOK M/31"]',
                'no_kontak' => '(021) 6456 565',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Dwitama Bangun Pratama',
                'alamat' => '["Komplek DHI, BLOK OO, No.11 A"]',
                'no_kontak' => '(021) 2267 1119',
            ], [
                'bentuk' => null,
                'nama' => 'EDI Express',
                'alamat' => '["Jl. Pasoso", "Tj. Priok, Lapangan 219X"]',
                'no_kontak' => '0853 4854 2791',
            ], [
                'bentuk' => null,
                'nama' => 'Fajar Baru',
                'alamat' => '["Jl. Lodan Raya No.9"]',
                'no_kontak' => '0852 8565 5569',
            ], [
                'bentuk' => null,
                'nama' => 'Gasuma',
                'alamat' => '["Ruko Permata Ancol BLOK C No.17"]',
                'no_kontak' => '(021) 641 4535',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Handai Terang Sentosa',
                'alamat' => '["Jl. Raya Pakin", "Komplek Mitra Bahari", "BLOK C, No.16"]',
                'no_kontak' => '(021) 6625 172',
            ], [
                'bentuk' => null,
                'nama' => 'HWU',
                'alamat' => '["Jl. Gunung Sahari Raya", "Komplek Marinatama BLOK J No.1"]',
                'no_kontak' => '(021) 6470 0279',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Indokarya',
                'alamat' => '["Jl. Indokarya No.11", "BLOK E, Sunter Papango"]',
                'no_kontak' => '(021) 6502 34851',
            ], [
                'bentuk' => null,
                'nama' => 'Jasa Karya',
                'alamat' => '["Jl. Jembatan 3", "Komplek Pergudangan Pluit BLOK B", "Kavling No.13"]',
                'no_kontak' => '(021) 6660 0635',
            ], [
                'bentuk' => null,
                'nama' => 'Jasa Tunggal Bahari',
                'alamat' => '["Jl. Kalimas Baru, No.28-30", "Depo Sril Up Selamet", "Surabaya"]',
                'no_kontak' => null,
            ], [
                'bentuk' => null,
                'nama' => 'Jaya Alam Perkasa',
                'alamat' => '["Jl. Bandengan Utara", "GG Buntek, BLOK 85A, No.15"]',
                'no_kontak' => '(021) 669 5365',
            ], [
                'bentuk' => null,
                'nama' => 'Jakarta Bangka Express (JBE)',
                'alamat' => '["Ruko Duri Raya RT02/RW01, No.1", "Duri Kepa"]',
                'no_kontak' => '(021) 5696 6573',
            ], [
                'bentuk' => null,
                'nama' => 'Johan Express',
                'alamat' => '["Ruko Galaxy Palem Lestari", "BLOK M, No.79"]',
                'no_kontak' => '0813 8055 6175',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Karunia Cipta Logistics',
                'alamat' => '["Jl. Bandengan Utara", "Ruko Mega Bandengan 81", "Blok B No.49"]',
                'no_kontak' => '0822 9917 0903',
            ], [
                'bentuk' => null,
                'nama' => 'Karyati',
                'alamat' => '["Jl. Daan Mogot KM 12,8", "Pergudangan Prima 2 KAV 7, No.5"]',
                'no_kontak' => '0878 8698 1348',
            ], [
                'bentuk' => 'PT',
                'nama' => 'KSI Logistics',
                'alamat' => '["Jl. Cideng Barat, No.88A", "Gambir"]',
                'no_kontak' => '(021) 220 37785',
            ], [
                'bentuk' => null,
                'nama' => 'Limas',
                'alamat' => '["Komplek DHI BLOK E3", "(belakang Komplek, depan PERTAMINA)"]',
                'no_kontak' => '0813 8333 1261',
            ], [
                'bentuk' => null,
                'nama' => 'Lintas Abadi Sejahtera',
                'alamat' => '["Jl. RE Martadinata", "Pergudangan Inkopau BLOK B5"]',
                'no_kontak' => '0813 9936 7755',
            ], [
                'bentuk' => 'CV',
                'nama' => 'Marpahala',
                'alamat' => '["Jl. Kp Bandan, Tanah Merah", "(dekat POS BPPKB, depan Mesjid Ataubah)"]',
                'no_kontak' => '0823 6586 0090',
            ], [
                'bentuk' => null,
                'nama' => 'Merah Jaya',
                'alamat' => '["Jl. Kampung Bandan No.8"]',
                'no_kontak' => '(021) 7100 3436',
            ], [
                'bentuk' => 'CV',
                'nama' => 'Mitra Buana',
                'alamat' => '["Komplek DHI BLOK PP, No.17"]',
                'no_kontak' => '(021) 662 3515',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Mitra Kalbar Sentosa',
                'alamat' => '["Jl. Lodan Raya No.6C"]',
                'no_kontak' => '0821 5160 5345',
            ], [
                'bentuk' => null,
                'nama' => 'Mitra Samudra',
                'alamat' => '["Jl. Lodan Raya 2", "Komplek Ruko Lodan Center", "BLOK L No.17"]',
                'no_kontak' => '0821 9560 1720',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Multi Express Transindo',
                'alamat' => '["Jl. Sukarjo Wiryo Pranoto No.11D", "Depan Stasiun KA. Sawah Besar"]',
                'no_kontak' => '(021) 625 9158',
            ], [
                'bentuk' => null,
                'nama' => 'Multi Intim',
                'alamat' => '["Jl. Kasuari No.19, Surabaya"]',
                'no_kontak' => '0812 9120 0168',
            ], [
                'bentuk' => 'CV',
                'nama' => 'New Putra Duta',
                'alamat' => '["Jl. Krekot Pasar Baru BLOK C2, No.11 D"]',
                'no_kontak' => '0812 9166 2309',
            ], [
                'bentuk' => null,
                'nama' => 'Ponti Jaya Express',
                'alamat' => '["Komplek Ruko Permata Ancol", "BLOK I No.30"]',
                'no_kontak' => '(021) 6471 8201',
            ], [
                'bentuk' => null,
                'nama' => 'Putra Guna',
                'alamat' => '["Komplek Ruko Permata Ancol", "BLOK P No.9"]',
                'no_kontak' => '(021) 6471 1264',
            ], [
                'bentuk' => null,
                'nama' => 'Putra Mandiri Transindo',
                'alamat' => '["Komplek DHI BLOK MM, No.3"]',
                'no_kontak' => '(021) 6682 685',
            ], [
                'bentuk' => 'CV',
                'nama' => 'Putra Panorama',
                'alamat' => '["Jl. Perniagaan Barat II", "GG. Istal No.1, Pasar Pagi"]',
                'no_kontak' => '(021) 6907 479',
            ], [
                'bentuk' => 'CV',
                'nama' => 'Rama Express',
                'alamat' => '["Jl. Bandengan Utara", "Gg Buntek, Blok 85 C, No.40A"]',
                'no_kontak' => '0813 1727 5583',
            ], [
                'bentuk' => 'CV',
                'nama' => 'Rama Jaya',
                'alamat' => '["Komplek Lodan Center Blok L, No.18"]',
                'no_kontak' => '(021) 6917 189',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Ratu Berlian Makmur',
                'alamat' => '["Jl. Raya Daan Mogot, KM 21", "Batu Ceper Pergudangan Daan Mogot Arcadia", "BLOK F2, No.2"]',
                'no_kontak' => '(021) 2900 6339',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Rinjani Jaya Trans',
                'alamat' => '["Jl. Kenjeran No.381", "KAV 1, SURABAYA"]',
                'no_kontak' => '(031) 389 0663',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Sahabat Belitung Express (SBE)',
                'alamat' => '["Jl. Gunung Sahari", "Ruko Marinatama Blok I, No.6-7"]',
                'no_kontak' => '(021) 647 033 60',
            ], [
                'bentuk' => 'PT',
                'nama' => 'Saranaraya Lintas Timur',
                'alamat' => '["Depo Spil Inggom", "Jl. Industri 1, Tj.Priok"]',
                'no_kontak' => '0812 9525 8167',
            ], [
                'bentuk' => null,
                'nama' => 'Sinar Berlian',
                'alamat' => '["Komplek DHI", "BLOK H No.24"]',
                'no_kontak' => '(021) 660 5824',
            ], [
                'bentuk' => null,
                'nama' => 'Subur Antar Nusa',
                'alamat' => '["Jl. Kapuk Kamal Raya No.40", "Pluit Bisnis BLOK D, No.7"]',
                'no_kontak' => '(021) 5596 3780',
            ], [
                'bentuk' => 'CV',
                'nama' => 'Sukses Abadi Zentosa',
                'alamat' => '["Jl. Tongkol No.6", "Ruko BR"]',
                'no_kontak' => '0812 3496 5888',
            ], [
                'bentuk' => 'CV',
                'nama' => 'Sukses Karunia Sejahtera',
                'alamat' => '["Jl. Kampung Bandan No.1"]',
                'no_kontak' => '0851 0529 2979',
            ], [
                'bentuk' => null,
                'nama' => 'Sumber Urip',
                'alamat' => '["Jl. Pangeran Jayakarta No.16, 6-7"]',
                'no_kontak' => '(021) 6294 208',
            ], [
                'bentuk' => null,
                'nama' => 'Surya Angkasa',
                'alamat' => '["Jl. Sidorame No.30 A", "RT002/RW11, Pegirian", "Kec.Semampir, Surabaya"]',
                'no_kontak' => '0877 7117 6788',
            ], [
                'bentuk' => null,
                'nama' => 'Tesa Logistic',
                'alamat' => '["Pergudangan Prima Center 1, BLOK D 11", "Jl.Pool PPD Kendang Kali Angke"]',
                'no_kontak' => '0812 9022 8075',
            ], [
                'bentuk' => null,
                'nama' => 'Toko Bangunan Buana Indah',
                'alamat' => '["Jl. Raya Serang KM 13,8", "Pasir Gadung Cikupa, Tangerang"]',
                'no_kontak' => '(021) 594 04418',
            ], [
                'bentuk' => null,
                'nama' => 'TTM',
                'alamat' => '["Lodan Center BLOK C, No.10"]',
                'no_kontak' => '0856 1171 138',
            ], [
                'bentuk' => null,
                'nama' => 'Wira Agung',
                'alamat' => '["Jl. Tubagus Angke BLOK D 1/9", "Ruko Taman Duta Mas"]',
                'no_kontak' => '(021) 5678 067',
            ], [
                'bentuk' => null,
                'nama' => 'Wira Express',
                'alamat' => '["Komplek DHI, BLOK MM No.17-18"]',
                'no_kontak' => '(021) 660 5892',
            ]
        ]);
    }
}
