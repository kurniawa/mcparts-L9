<?php

namespace Database\Seeders;

use App\Models\PelangganReseller;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PelangganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pelanggan = [
            [
                'nama' => '3 Putra Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Sutoyo 5 No. 140',
                    'kecamatan'=>'Banjar Barat',
                    'kelurahan'=>'Teluk Dalam',
                    'kota'=>'Banjarmasin',
                    'provinsi'=>'Kalimantan Selatan',
                    'pulau'=>'Kalimantan',
                    'short'=>'Banjarmasin',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Sutoyo 5 No. 140", "Kel. Teluk Dalam, Kec. Banjar Barat", "Banjarmasin"]',
                ]],
                'no_kontak' => ['082253633222'],
                'initial' => '3PM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Abadi Motor',
                'alamat' => [[
                    'jalan'=>'Permata 1 No.366',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Pangkalpinang',
                    'provinsi'=>'Kepulauan Bangka Belitung',
                    'pulau'=>'Bangka',
                    'short'=>'Pangkalpinang',
                    'negara'=>'Indonesia',
                    'long'=>'["Permata 1, No.366", "Pangkalpinang - Bangka"]',
                ]],
                'no_kontak' => null,
                'initial' => 'ABA',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Acun Motor',
                'alamat' => [[
                    'jalan'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Pangkalpinang',
                    'provinsi'=>'Kepulauan Bangka Belitung',
                    'pulau'=>'Bangka',
                    'short'=>'Pangkalpinang',
                    'negara'=>'Indonesia',
                    'long'=>'["Pangkalpinang, Bangka"]',
                ]],
                'no_kontak' => null,
                'initial' => 'ACUN',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Ade Jok Motor',
                'alamat' => [[
                    'jalan'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Tangerang',
                    'provinsi'=>'Banten',
                    'pulau'=>'Jawa',
                    'short'=>'Tangerang',
                    'negara'=>'Indonesia',
                    'long'=>'["Tangerang, Banten, Indonesia"]',
                ]],
                'no_kontak' => null,
                'initial' => 'ADE',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Ajung Jaya Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Pasar Lama',
                    'kecamatan'=>'Sentani',
                    'kelurahan'=>null,
                    'kota'=>null,
                    'kabupaten'=>'Jayapura',
                    'provinsi'=>null,
                    'pulau'=>'Papua',
                    'short'=>'Sentani, Jayapura',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Pasar Lama", "Depan Gereja Zoar", "Sentani, Jayapura"]',
                ]],
                'no_kontak' => ['08124886092'],
                'initial' => 'AJ',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Akong',
                'alamat' => [[
                    'jalan'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Pluit, Jakarta',
                    'negara'=>'Indonesia',
                    'long'=>'["Pluit, Jakarta"]',
                ]],
                'no_kontak' => ['081291200168'],
                'initial' => 'AK',
                'is_reseller' => 'yes'
            ], [
                'nama' => 'Alindo SM',
                'alamat' => [[
                    'jalan'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>null,
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'negara'=>'Indonesia',
                    'short'=>'Jakarta',
                    'long'=>'["Jakarta"]',
                ]],
                'no_kontak' => null,
                'initial' => 'ALI',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Andi MC',
                'alamat' => [[
                    'jalan'=>null,
                    'desa'=>'Karanggan',
                    'kecamatan'=>'Gn. Putri',
                    'kelurahan'=>null,
                    'kota'=>null,
                    'kabupaten'=>'Bogor',
                    'provinsi'=>'Jawa Barat',
                    'pulau'=>'Jawa',
                    'negara'=>'Indonesia',
                    'short'=>'Karanggan',
                    'long'=>'["Jakarta"]',
                ]],
                'no_kontak' => null,
                'initial' => 'ANDI',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Andri',
                'nama_bisnis' => 'Millenium Motor',
                'sapaan' => 'Bpk.',
                'alamat' => [[
                    'jalan'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Bukittinggi',
                    'kabupaten'=>null,
                    'provinsi'=>'Sumatra Barat',
                    'pulau'=>'Sumatra',
                    'negara'=>'Indonesia',
                    'short'=>'Bukittinggi',
                    'long'=>'["Ambil di gudang, Bukittinggi"]',
                ]],
                'no_kontak' => ['081363619119'],
                'pulau_id' => 3,
                'initial' => 'MIL2',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Angian Motor',
                'alamat' => [[
                    'jalan'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Pangkalpinang',
                    'provinsi'=>'Kepulauan Bangka Belitung',
                    'pulau'=>'Bangka',
                    'short'=>'Pangkalpinang',
                    'negara'=>'Indonesia',
                    'long'=>'["Pangkalpinang, Bangka"]',
                ]],
                'no_kontak' => null,
                'initial' => 'ANG',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Asia Pasifik',
                'alamat' => [[
                    'jalan'=>'Jl. Serdam',
                    'komplek'=>'Komplek Pesona Alam No.E7',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Pontianak',
                    'provinsi'=>'Kalimantan Barat',
                    'pulau'=>'Kalimantan',
                    'short'=>'Pontianak',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Serdam", "Komplek Pesona Alam No.E7", "Pontianak"]',
                ]],
                'no_kontak' => ['08125732345'],
                'initial' => 'ASPA',
                'is_reseller' => 'no'
            ], [
                'nama' => 'B2 Saddle',
                'alamat' => [[
                    'jalan'=>'Jl. Ion Martasasmita KM 02',
                    'desa'=>'Rancasari',
                    'kecamatan'=>'Pamanukan',
                    'kelurahan'=>null,
                    'kota'=>null,
                    'kabupaten'=>'Subang',
                    'provinsi'=>'Jawa Barat',
                    'pulau'=>'Jawa',
                    'short'=>'Pamanukan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Ion Martasasmita KM 02", "DS Rancasari, Kec. Pamanukan (RM. Rosin)", "Kab. Subang"]',
                ]],
                'no_kontak' => ['082126106000'],
                'initial' => 'B2',
                'is_reseller' => 'no'
            ], [
                'nama' => 'BCC Variasi',
                'alamat' => [[
                    'jalan'=>'Jl. Otista No.8',
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Sukabumi',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Barat',
                    'pulau'=>'Jawa',
                    'short'=>'Sukabumi',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Otista No.8", "Sukabumi"]',
                ]],
                'no_kontak' => ['08127037093'],
                'initial' => 'BCC',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Bengkel Apang',
                'alamat' => [[
                    'jalan'=>'Jl. Otista No.8',
                    'desa'=>null,
                    'kecamatan'=>'Tanjung Pandan',
                    'kelurahan'=>null,
                    'kota'=>null,
                    'kabupaten'=>'Belitung',
                    'provinsi'=>'Kepulauan Bangka Belitung',
                    'pulau'=>'Bangka',
                    'short'=>'Bangka',
                    'negara'=>'Indonesia',
                    'long'=>'["Pasar Pagi Samping Surau", "Tj. Pandan, Belitung"]',
                ]],
                'no_kontak' => null,
                'initial' => 'BENG',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Benteng Motor',
                'alamat' => [[
                    'jalan'=>'Jl. GG Bulu Sarang No.151',
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Makassar',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Selatan',
                    'pulau'=>'Sulawesi',
                    'short'=>'Makassar',
                    'negara'=>'Indonesia',
                    'long'=>'["JL. GG Bulu Sarang No.151", "Makassar"]',
                ]],
                'alamat' => '',
                'daerah_id' => 47,
                'no_kontak' => '(0411) 362 2019',
                'pulau_id' => 4,
                'initial' => 'BEN',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Berjaya Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Selat Panjang No.A1',
                    'desa'=>null,
                    'kecamatan'=>'Pontianak Utara',
                    'kelurahan'=>null,
                    'kota'=>'Pontianak',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Barat',
                    'pulau'=>'Kalimantan',
                    'short'=>'Pontianak',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Selat Panjang No.A1", "Pontianak Utara"]',
                ]],
                'no_kontak' => ['085389999188'],
                'initial' => 'BER',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Biran Motor',
                'alamat' => [[
                    'jalan'=>'Semabung Baru No.50',
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Pangkalpinang',
                    'kabupaten'=>'Belitung',
                    'provinsi'=>'Kepulauan Bangka Belitung',
                    'pulau'=>'Bangka',
                    'short'=>'Pangkalpinang',
                    'negara'=>'Indonesia',
                    'long'=>'["Semabung Baru No.50", "Pangkalpinang - Bangka"]',
                ]],
                'no_kontak' => null,
                'initial' => 'BIR',
                'is_reseller' => 'no'
            ], [
                'nama' => 'BSM',
                'alamat' => [[
                    'jalan'=>'Jl. Gading Indah Utara 4/20',
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Gading Indah Utara 4/20", "(masuk dari Perumahan Gading Regency)", "Surabaya"]',
                ]],
                'no_kontak' => ['08125732345'],
                'initial' => 'BSM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Budi Stiker',
                'alamat' => [[
                    'jalan'=>'Jl. Mesjid No.126',
                    'desa'=>null,
                    'kecamatan'=>'Medan Barat',
                    'kelurahan'=>'Kesawan',
                    'kota'=>'Medan',
                    'kabupaten'=>null,
                    'provinsi'=>'Sumatra Utara',
                    'pulau'=>'Sumatra',
                    'short'=>'Medan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Mesjid No.126", "Kesawan - Medan"]',
                ]],
                'no_kontak' => ['(061)4572651'],
                'initial' => 'BS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Cendana Mega Pratama (CMP)',
                'bentuk' => 'CV',
                'alamat' => [[
                    'jalan'=>'Jl. H. Yunus Yanis No.62',
                    'desa'=>null,
                    'kecamatan'=>'Jelutung',
                    'kelurahan'=>'Kebun Handil',
                    'kota'=>'Jambi',
                    'kabupaten'=>null,
                    'provinsi'=>'Jambi',
                    'pulau'=>'Sumatra',
                    'short'=>'Jambi',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. H. Yunus Yanis No.62", "Kebun Handil, Jambi"]',
                ]],
                'no_kontak' => ['081366911999'],
                'pulau_id' => 3,
                'initial' => 'CMP',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Central Motor',
                'alamat' => [[
                    'jalan'=>null,
                    'komplek'=>'Perumahan Ambon Bay Regency No.A30',
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Ambon',
                    'kabupaten'=>null,
                    'provinsi'=>'Maluku',
                    'pulau'=>'Ambon',
                    'short'=>'Ambon',
                    'negara'=>'Indonesia',
                    'long'=>'["Perumahan Ambon Bay Regency No.A30", "Sebelah Dealer Hino Lateri - Ambon"]',
                ]],
                'no_kontak' => null,
                'initial' => 'CEN',
                'is_reseller' => 'no',
                'reseller'=>'Akong',
            ], [
                'nama' => 'Central Young Hero',
                'alamat' => [[
                    'jalan'=>'Jl. Sindansana No.27',
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Singkawang',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Barat',
                    'pulau'=>'Kalimantan',
                    'short'=>'Singkawang',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Sindansana No.27", "Singkawang"]',
                ]],
                'no_kontak' => null,
                'initial' => 'HERO',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Champion Motor',
                'alamat' => [[
                    'jalan'=>'Jl. DI Panjaitan No.16-17',
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jambi',
                    'kabupaten'=>null,
                    'provinsi'=>'Jambi',
                    'pulau'=>'Sumatra',
                    'short'=>'Jambi',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. DI Panjaitan No.16,17", "Jambi"]',
                ]],
                'no_kontak' => ['08788017017'],
                'initial' => 'CHA',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Christovel',
                'alamat' => [[
                    'jalan'=>'Jl. Diponegoro No.66',
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>'Wenang',
                    'kelurahan'=>'Mahakeret Barat',
                    'kota'=>'Manado',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Utara',
                    'pulau'=>'Sulawesi',
                    'short'=>'Manado',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Diponegoro No.66", "Mahakeret Barat, Manado"]',
                ]],
                'no_kontak' => ['082192515555'],
                'initial' => 'CHRIS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Darwis Motor',
                'alamat' => [[
                    'jalan'=>'Poros Pallangga Goa',
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Makassar',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Selatan',
                    'pulau'=>'Sulawesi',
                    'short'=>'Makassar',
                    'negara'=>'Indonesia',
                    'long'=>'["Poros Pallangga Goa", "Makassar"]',
                ]],
                'no_kontak' => ['081244255038'],
                'initial' => 'DWIS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Dunia Variasi',
                'alamat' => [[
                    'jalan'=>'Jl. Raya Dupak No.63',
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Raya Dupak No.63", "Blok D No.18, Surabaya"]',
                ]],
                'no_kontak' => ['08164387388'],
                'pulau_id' => 2,
                'initial' => 'DV',
                'is_reseller' => 'no'
            ], [
                'nama' => 'DV Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Nilam 5',
                    'rt'=>'07','rw'=>'03',
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>'Bukit Intan',
                    'kelurahan'=>'Bacang',
                    'kota'=>'Pangkalpinang',
                    'kabupaten'=>'Belitung',
                    'provinsi'=>'Kepulauan Bangka Belitung',
                    'pulau'=>'Bangka',
                    'short'=>'Pangkalpinang',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Nilam 5, RT07/RW03", "Kel.Bacang,Kec.Bukit Intan", "Pangkalpinang, Bangka"]',
                ]],
                'no_kontak' => ['082184492070'],
                'initial' => 'DVM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Fortuner Motor',
                'nama2' => '- G -',
                'alamat' => [[
                    'jalan'=>'Jl. K.H. Agus Salim No.344',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Gorontalo',
                    'kabupaten'=>null,
                    'provinsi'=>'Gorontalo',
                    'pulau'=>'Sulawesi',
                    'short'=>'Gorontalo',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. K.H Agus Salim No.344", "KM 4,5, Gorontalo"]',
                ]],
                'no_kontak' => ['085399950500'],
                'initial' => 'FOR',
                'is_reseller' => 'no'
            ], [
                'nama' => "Fortuner Motor",
                'nama2' => "- L -",
                'alamat' => [[
                    'jalan'=>'Jl. Muhammad Hatta No.79',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>'Maahas',
                    'kecamatan'=>'Luwuk',
                    'kelurahan'=>'Maahas',
                    'kota'=>null,
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Tengah',
                    'pulau'=>'Sulawesi',
                    'short'=>'Luwuk',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Muhammad Hatta No.79", "Maahas, Luwuk, Sulteng"]',
                ]],
                'no_kontak' => null,
                'initial' => 'FOR',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Endang',
                'sapaan' => 'Bpk.',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Tangerang',
                    'kabupaten'=>null,
                    'provinsi'=>'Banten',
                    'pulau'=>'Jawa',
                    'short'=>'Tangerang',
                    'negara'=>'Indonesia',
                    'long'=>'["Tangerang, Banten"]',
                ]],
                'no_kontak' => null,
                'initial' => null,
                'is_reseller' => 'no'
            ], [
                'nama' => 'Garuda Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Tudopuli 10, BLOK K-5 No.29',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Komplek Puri Taman Sari',
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Makassar',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Selatan',
                    'pulau'=>'Sulawesi',
                    'short'=>'Makassar',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Puri Taman Sari", "Jl. Tudopuli 10, BLOK K-5 No.29", "Makassar"]',
                ]],
                'no_kontak' => ['081355438758'],
                'initial' => 'GAR',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Global Stiker',
                'alamat' => [[
                    'jalan'=>'Jl. Jendral Sudirman No.207',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Palembang',
                    'kabupaten'=>null,
                    'provinsi'=>'Sumatra Selatan',
                    'pulau'=>'Sumatra',
                    'short'=>'Palembang',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Jendral Sudirman No.207", "Palembang"]',
                ]],
                'no_kontak' => ['(0711)9199977'],
                'initial' => 'GLO',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Hadi Rumawan',
                'sapaan' => 'Bpk.',
                'alamat' => [[
                    'jalan'=>'Jl. Golf, GG Karet 2 No.73',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>'Landasan Ulin',
                    'kelurahan'=>null,
                    'kota'=>'Banjarbaru',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Selatan',
                    'pulau'=>'Kalimantan',
                    'short'=>'Banjarbaru',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Golf, GG Karet 2 No.73", "Landasan Ulin Banjarbaru", "Kalimantan Selatan"]',
                ]],
                'no_kontak' => ['081351588351'],
                'initial' => 'HADI',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Harapan Baru',
                'alamat' => [[
                    'jalan'=>'Jl. Cipto Mangunkusumo',
                    'rt'=>'13','rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>'Harapan Baru',
                    'kecamatan'=>'Loa Janan Ilir',
                    'kota'=>'Samarinda',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Timur',
                    'pulau'=>'Kalimantan',
                    'short'=>'Samarinda',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Cipto Mangunkusumo RT:13", "Harapan Baru, Kec. Loa Janan Ilir", "Samarinda"]',
                ]],
                'no_kontak' => ['082149065389'],
                'initial' => 'HAR',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Hokky Motor',
                'alamat' => [[
                    'jalan'=>'Jl. R Wolter Monginsidi No.131',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>'Bahu',
                    'kecamatan'=>'Malalayang',
                    'kota'=>'Manado',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Utara',
                    'pulau'=>'Sulawesi',
                    'short'=>'Manado',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. R Wolter Monginsidi No.131", "Bahu - Manado"]',
                ]],
                'no_kontak' => ['085319782288'],
                'initial' => 'HOK',
                'is_reseller' => 'no'
            ], [
                'nama' => 'HR Jaya Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Gatot Subroto No.21',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Samarinda',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Timur',
                    'pulau'=>'Kalimantan',
                    'short'=>'Samarinda',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Gatot Subroto No.21", "Samarinda"]',
                ]],
                'no_kontak' => ['082111522998'],
                'initial' => 'HR',
                'is_reseller' => 'no'
            ], [
                'nama' => 'H.S Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Veteran Simpang SMP 7 No.42',
                    'rt'=>'31','rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Banjarmasin',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Selatan',
                    'pulau'=>'Kalimantan',
                    'short'=>'Banjarmasin',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Veteran Simpang SMP 7", "No.42, RT:31, Banjarmasin"]',
                ]],
                'no_kontak' => ['08125036074'],
                'initial' => 'HS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'IKB Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Kenjeran 281',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kenjeran 281", "Surabaya"]',
                ]],
                'no_kontak' => ['081331992290'],
                'initial' => 'HS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Indah Motor',
                'alamat' => [[
                    'jalan'=>'Jl. MS Rahman 95',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Pangkalpinang',
                    'kabupaten'=>'Belitung',
                    'provinsi'=>'Kepulauan Bangka Belitung',
                    'pulau'=>'Bangka',
                    'short'=>'Pangkalpinang',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. MS Rahman 95", "Pangkalpinang, Bangka"]',
                ]],
                'no_kontak' => null,
                'initial' => 'INDH',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Indo Putra Mandiri',
                'alamat' => [[
                    'jalan'=>'Jl. Bandang XII No.1',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Makassar',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Selatan',
                    'pulau'=>'Sulawesi',
                    'short'=>'Makassar',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Bandang XII No.1", "Makassar"]',
                ]],
                'no_kontak' => ['08124208300'],
                'initial' => 'IPM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Ismail',
                'nama' => 'Bpk.',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>'Citeureup',
                    'kota'=>null,
                    'kabupaten'=>'Bogor',
                    'provinsi'=>'Jawa Barat',
                    'pulau'=>'Jawa',
                    'short'=>null,
                    'negara'=>'Indonesia',
                    'long'=>'["Citeureup"]',
                ]],
                'no_kontak' => null,
                'initial' => 'IS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Izur Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Teluk Tiram',
                    'rt'=>'21','rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Banjarmasin',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Selatan',
                    'pulau'=>'Kalimantan',
                    'short'=>'Banjarmasin',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Teluk Tiram", "GG. Raden No.15, RT:21", "Banjarmasin"]',
                ]],
                'no_kontak' => null,
                'initial' => 'IZ',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Jaya Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Sam Ratulangi No.123',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Manado',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Utara',
                    'pulau'=>'Sulawesi',
                    'short'=>'Manado',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Sam Ratulangi No.123", "Manado"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'0431',
                        'nomor'=>'862550',
                    ]
                ],
                'initial' => 'JAYMO',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Jaya Queen Stiker',
                'alamat' => [[
                    'jalan'=>'Jl. ST Syahrir No.63',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Bukittinggi',
                    'kabupaten'=>null,
                    'provinsi'=>'Sumatra Barat',
                    'pulau'=>'Sumatra',
                    'short'=>'Bukittinggi',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. ST Syahrir No.63", "Bukittinggi"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081372798121',
                    ]
                ],
                'initial' => 'JAYQU',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Jaya Stiker',
                'alamat' => [[
                    'jalan'=>'Jl. Mesjid No.47',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Medan',
                    'kabupaten'=>null,
                    'provinsi'=>'Sumatra Utara',
                    'pulau'=>'Sumatra',
                    'short'=>'Medan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Mesjid No.47", "Medan"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081397129261',
                    ]
                ],
                'initial' => 'JAYST',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Jhon Motor',
                'alamat' => [[
                    'jalan'=>'Jl. GG Bulu Sarang Blok C No.13',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Komplek Bulu Sarang Square',
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Makassar',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Selatan',
                    'pulau'=>'Sulawesi',
                    'short'=>'Makassar',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. GG Bulu Sarang Blok C No.13", "Komplek Bulu Sarang Square, Makassar"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'0411',
                        'nomor'=>'3651559',
                    ]
                ],
                'initial' => 'JHON',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Joy Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Tumpangsari No.52 B',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Lombok',
                    'kabupaten'=>null,
                    'provinsi'=>'Nusa Tenggara Barat',
                    'pulau'=>'Lombok',
                    'short'=>'Lombok',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Tumpangsari No.52 B", "Cakranegara - Lombok"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081238213131',
                    ]
                ],
                'initial' => 'JOY',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Kalbar Motoshop',
                'alamat' => [[
                    'jalan'=>'Jl. Agus Salim No.7',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Samarinda',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Timur',
                    'pulau'=>'Kalimantan',
                    'short'=>'Samarinda',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Agus Salim No.7", "Samarinda"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081280886008',
                    ]
                ],
                'initial' => 'KAL',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Kanaka Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Valanda Maramis No.194',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Manado',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Utara',
                    'pulau'=>'Sulawesi',
                    'short'=>'Manado',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Valanda Maramis No.194", "Manado"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'0431',
                        'nomor'=>'851441',
                    ]
                ],
                'initial' => 'KAN',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Karunia Jaya Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Parit Pangeran',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Pontianak',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Barat',
                    'pulau'=>'Kalimantan',
                    'short'=>'Pontianak',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Parit Pangeran", "Pontianak"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081250102997',
                    ]
                ],
                'initial' => 'KAR',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Karya Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Jurung No.6',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Medan',
                    'kabupaten'=>null,
                    'provinsi'=>'Sumatra Utara',
                    'pulau'=>'Sumatra',
                    'short'=>'Medan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Jurung No.6", "Simpang Wahidin, Medan"]',
                ]],
                'no_kontak' => null,
                'initial' => 'KAR',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Kencana Motor',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>null,
                    'kabupaten'=>'Jayapura',
                    'provinsi'=>null,
                    'pulau'=>'Papua',
                    'short'=>'Jayapura',
                    'negara'=>'Indonesia',
                    'long'=>'["Papua, Jayapura"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'085254280807',
                    ]
                ],
                'initial' => 'KENCA',
                'is_reseller' => 'no'
            ], [
                'nama' => 'KMS Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Jendral Sudirman No.47 D',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Palembang',
                    'kabupaten'=>null,
                    'provinsi'=>'Sumatra Selatan',
                    'pulau'=>'Sumatra',
                    'short'=>'Palembang',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Jendral Sudirman No.47 D", "Palembang"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>'0711',
                        'nomor'=>'7081681',
                    ]
                ],
                'initial' => 'KMS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Kolongan Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Martadinata 3',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Manado',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Utara',
                    'pulau'=>'Sulawesi',
                    'short'=>'Manado',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Martadinata 3", "Manado"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'085256125992',
                    ]
                ],
                'initial' => 'KOL',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Leo Speedshop',
                'alamat' => [[
                    'jalan'=>'Ruko No.5, Jl.Kartama',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Komplek Royal Kartama Residence',
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>'Marpoyan Damai',
                    'kota'=>'Pekanbaru',
                    'kabupaten'=>null,
                    'provinsi'=>'Riau',
                    'pulau'=>'Sumatra',
                    'short'=>'Pekanbaru',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Royal Kartama Residence", "Ruko No.5, Jl.Kartama (Samping SMPN 2)","Marpoyan Damai, Pekanbaru"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081298284688',
                    ]
                ],
                'initial' => 'KMS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Millenium Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Mayor Ruslan No.1333 F',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Palembang',
                    'kabupaten'=>null,
                    'provinsi'=>'Sumatra Selatan',
                    'pulau'=>'Sumatra',
                    'short'=>'Palembang',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Mayor Ruslan No.1333 F", "Palembang"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'0711',
                        'nomor'=>'362262',
                    ]
                ],
                'initial' => 'MIL',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Mitra Jaya Motor',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Baubau',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Tenggara',
                    'pulau'=>'Buton',
                    'short'=>'Baubau',
                    'negara'=>'Indonesia',
                    'long'=>'["Baubau", "Sulawesi Tenggara"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081233469951',
                    ]
                ],
                'initial' => 'MIJA',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Mitra Usaha Mandiri',
                'alamat' => [[
                    'jalan'=>'Jl. Sepakat 2',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Komplek Mutiara Villa Sepakat, No.B3',
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Pontianak',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Barat',
                    'pulau'=>'Kalimantan',
                    'short'=>'Pontianak',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Sepakat 2", " Ruko Mutiara Villa Sepakat, No.B3", "Pontianak"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'082153210278',
                    ]
                ],
                'initial' => 'MUM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Mulya Sandi',
                'alamat' => [[
                    'jalan'=>'Jl. Riau Ujung',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Pekanbaru',
                    'kabupaten'=>null,
                    'provinsi'=>'Riau',
                    'pulau'=>'Sumatra',
                    'short'=>'Pekanbaru',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Riau Ujung", "Pekanbaru"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081314082897',
                    ]
                ],
                'initial' => 'MUL',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Mustika Raya',
                'alamat' => [[
                    'jalan'=>'Jl. Mesjid No.124 B',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Medan',
                    'kabupaten'=>null,
                    'provinsi'=>'Sumatra Utara',
                    'pulau'=>'Sumatra',
                    'short'=>'Medan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Mesjid No.124 B", "Medan"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'061',
                        'nomor'=>'4579659',
                    ]
                ],
                'initial' => 'MUS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Mutiara Motor Mandiri',
                'bentuk' => 'CV',
                'alamat' => [[
                    'jalan'=>'Jl. Simpang Panji Suroso 160',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>null,
                    'kota'=>'Malang',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Malang',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Simpang Panji Suroso 160", "Malang"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'0818387233',
                    ]
                ],
                'initial' => 'MUT',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Nagata Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Wirapati No.15',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kelurahan'=>null,
                    'kecamatan'=>'Sintang',
                    'kota'=>'Sintang',
                    'kabupaten'=>'Sintang',
                    'provinsi'=>'Kalimantan Barat',
                    'pulau'=>'Kalimantan',
                    'short'=>'Sintang',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Wirapati No.15", "Sintang"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'08125602566',
                    ]
                ],
                'initial' => 'NA',
                'is_reseller' => 'no'
            ], [
                'nama' => 'NGK Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Panjaitan No.5,6,7',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>'Jelutung',
                    'kelurahan'=>'Kebun Handil',
                    'kota'=>'Jambi',
                    'kabupaten'=>null,
                    'provinsi'=>'Jambi',
                    'pulau'=>'Sumatra',
                    'short'=>'Jambi',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Panjaitan No.5,6,7", "Kebun Handil - Jambi"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'082373566066',
                    ]
                ],
                'initial' => 'NGK',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Nino Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Kyai Tambak Deres 141',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kyai Tambak Deres 141", "Surabaya"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'085100585253',
                    ]
                ],
                'initial' => 'NINO',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Novi',
                'sapaan' => 'Ibu',
                'alamat' => [[
                    'jalan'=>'A8/ROY/HSES/SRW/HSES',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>null,
                    'kabupaten'=>null,
                    'provinsi'=>null,
                    'pulau'=>null,
                    'short'=>'Malaysia',
                    'negara'=>'Malaysia',
                    'long'=>'["A8/ROY/HSES/SRW/HSES", "Malaysia"]',
                ]],
                'no_kontak' => null,
                'initial' => 'NOV',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Nurmanto',
                'alamat' => [[
                    'jalan'=>'Jl. Perdamaian, Pal IX',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Pontianak',
                    'kabupaten'=>'Kubu Raya',
                    'provinsi'=>'Kalimantan Barat',
                    'pulau'=>'Kalimantan',
                    'short'=>'Pontianak',
                    'negara'=>'Indonesia',
                    'long'=>'["Toko Mulia Makmur", "Jl. Perdamaian, Pal IX, Kubu Raya/Ujung", "Kota Baru Pontianak"]',
                ]],
                'no_kontak' => null,
                'initial' => 'NURM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Nusi Motor',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>null,
                    'kabupaten'=>'Lahat',
                    'provinsi'=>'Sumatra Selatan',
                    'pulau'=>'Sumatra',
                    'short'=>'Lahat',
                    'negara'=>'Indonesia',
                    'long'=>'["Lahat", "Sumatra Selatan"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nama'=>'Dodi',
                        'nomor'=>'085266220856',
                    ]
                ],
                'initial' => 'NUS',
                'ktrg' => null,
                'is_reseller' => 'no'
            ], [
                'nama' => 'Pasti Sukses Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Sutorejo Utara Baru No.3',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Sutorejo Utara Baru No.3", "Surabaya"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nama'=>null,
                        'nomor'=>'081330186448',
                    ]
                ],
                'initial' => 'PAS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Pedoman Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Gusti Hamzah No.93',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>null,
                    'kabupaten'=>'Sambas',
                    'provinsi'=>'Kalimantan Barat',
                    'pulau'=>'Kalimantan',
                    'short'=>'Sambas',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Gusti Hamzah No.93", "Sambas"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nama'=>null,
                        'nomor'=>'08125607439',
                    ]
                ],
                'initial' => 'PE',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Pelita Jok',
                'alamat' => [[
                    'jalan'=>'Jl. Pelita Gg 3, No.52',
                    'rt'=>'39','rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>'Sungai Pinang',
                    'kelurahan'=>'Sungai Pinang Dalam',
                    'kota'=>'Samarinda',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Timur',
                    'pulau'=>'Kalimantan',
                    'short'=>'Sambas',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Pelita Gg 3, No.52, RT:39", "Sungai Pinang Dalam", "Kec. Sungai Pinang, Samarinda"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nama'=>null,
                        'nomor'=>'082154221345',
                    ]
                ],
                'initial' => 'PEL',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Pioneer Jaya Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Rumambi No.9',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Manado',
                    'kabupaten'=>null,
                    'provinsi'=>'Sulawesi Utara',
                    'pulau'=>'Sulawesi',
                    'short'=>'Manado',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Rumambi No.9", "Manado"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>'0431',
                        'nama'=>null,
                        'nomor'=>'865088',
                    ]
                ],
                'initial' => 'PION',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Prospek Motor',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Komplek Bumi Batara 2',
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Pontianak',
                    'kabupaten'=>null,
                    'provinsi'=>'Kalimantan Barat',
                    'pulau'=>'Kalimantan',
                    'short'=>'Pontianak',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Bumi Batara 2", "BLOK C, No.58, Pontianak"]',
                ]],
                'no_kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nama'=>null,
                        'nomor'=>'08125794675',
                    ]
                ],
                'initial' => 'PROS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Rajawali Motor',
                'alamat' => [[
                    'jalan'=>'Jl. Parit Lalang No.1',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'desa'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Pangkalpinang',
                    'kabupaten'=>'Belitung',
                    'provinsi'=>'Kepulauan Bangka Belitung',
                    'pulau'=>'Bangka',
                    'short'=>'Pangkalpinang',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Parit Lalang No.1", "Pangkalpinang, Bangka"]',
                ]],
                'no_kontak' => null,
                'initial' => 'RAJ',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Rama Motor',
                'alamat' => '["Jl. Imam Bonjol No.38 B", "Samarinda"]',
                'daerah_id' => 5,
                'no_kontak' => '0813 5034 0369',
                'pulau_id' => 1,
                'initial' => 'RAM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Sambung Jaya Motor',
                'alamat' => '["Jl. Imam Bonjol No.426", "Pontianak"]',
                'daerah_id' => 4,
                'no_kontak' => '0812 5673 5233',
                'pulau_id' => 1,
                'initial' => 'SAM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Saudara Motor',
                'alamat' => null,
                'daerah_id' => 23,
                'no_kontak' => null,
                'pulau_id' => 3,
                'initial' => 'SAU',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Scopa Motor',
                'alamat' => '["Jl. Kalimantan No.23", "Mataram, Lombok"]',
                'daerah_id' => 50,
                'no_kontak' => '(0370) 636 414',
                'pulau_id' => 6,
                'initial' => 'SCO',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Sejati Jaya Sondy',
                'alamat' => null,
                'daerah_id' => 47,
                'no_kontak' => null,
                'pulau_id' => 4,
                'initial' => 'SON',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Setia Budi',
                'alamat' => '["Jl. Jendral A. Yani KM6,7", "Komplek Bun Yamin Pemain 1, Raya Utama", "No.9, RT:14, Banjarmasin"]',
                'daerah_id' => 1,
                'no_kontak' => '0813 4819 1028',
                'pulau_id' => 1,
                'initial' => 'SET',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Sinar Perkasa Motor',
                'alamat' => '["Jl. Pasar 3", "Komplek Sehati Indah, No.88 FF", "Daerah Krakatau, Medan"]',
                'daerah_id' => 41,
                'no_kontak' => '0813 9600 5859',
                'pulau_id' => 3,
                'initial' => 'SIN',
                'is_reseller' => 'no'
            ], [
                'nama' => 'SS Uji 169 Handil Bakti',
                'alamat' => '["Jl. Karya Sabumi IV, No.26 A", "Kayu Tangi, Banjarmasin"]',
                'daerah_id' => 1,
                'no_kontak' => '(0561) 330 3216',
                'pulau_id' => 1,
                'initial' => 'SS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Sukses Makmur Motor',
                'alamat' => '["PM NOOR RT39", "Samarinda"]',
                'daerah_id' => 5,
                'no_kontak' => '0813 4777 7722',
                'pulau_id' => 1,
                'initial' => 'SM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Sumber Abadi Motor',
                'alamat' => '["KM 14 Jambi", "Palembang"]',
                'daerah_id' => 43,
                'no_kontak' => null,
                'pulau_id' => 3,
                'initial' => 'SAM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Sumber Cemerlang',
                'alamat' => '["Jl. Karet 24 Ilir", "Kec.Bukit Kecil, Palembang"]',
                'daerah_id' => 43,
                'no_kontak' => '0878 9160 7875',
                'pulau_id' => 3,
                'initial' => 'SUMC',
                'is_reseller' => 'no'
            ],[
                'nama' => 'Sumber Makmur',
                'alamat' => '["Kapasari, GG 5, No.11", "Surabaya"]',
                'daerah_id' => 33,
                'no_kontak' => '0812 3472 5210',
                'pulau_id' => 2,
                'initial' => 'SUMAK',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Sumber Mandiri Motor',
                'alamat' => '["Jl. Ringin Sari No.8,9", "(samping Alfamart Ringinsari), Pontianak"]',
                'daerah_id' => 4,
                'no_kontak' => '0811 578 278',
                'pulau_id' => 1,
                'initial' => 'SUMAN',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Sumber Rejeki Motor',
                'alamat' => null,
                'daerah_id' => 23,
                'no_kontak' => null,
                'pulau_id' => 2,
                'initial' => 'SUMRE',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Surya Jaya Motor',
                'alamat' => '["Jl. IR. H. Juanda No.54-56", "Pontianak"]',
                'daerah_id' => 4,
                'no_kontak' => '0812 5656 2985',
                'pulau_id' => 1,
                'initial' => 'SJM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Surya Perdana Agung',
                'alamat' => '["Jl. Soekarno Hatta", "Komplek Sentral Niaga No.12, A-B", "Pekanbaru"]',
                'daerah_id' => 44,
                'no_kontak' => '0812 7501 178',
                'pulau_id' => 3,
                'initial' => 'SPA',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Teratai Motor',
                'alamat' => '["Jl. KL. Yos Sudarso 8J,8K,8L", "Komplek Brayan One Stop Square", "Medan"]',
                'daerah_id' => 41,
                'no_kontak' => '(061) 6643 002',
                'pulau_id' => 3,
                'initial' => 'TER',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Toko 86',
                'alamat' => null,
                'daerah_id' => 16,
                'no_kontak' => null,
                'pulau_id' => 2,
                'initial' => 'T86',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Tommy',
                'sapaan' => 'Ko',
                'alamat' => null,
                'daerah_id' => 22,
                'no_kontak' => null,
                'pulau_id' => 2,
                'initial' => 'TOM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Top Variasi',
                'alamat' => '["Jl. Jendral Sudirman No.52 E", "Palembang"]',
                'daerah_id' => 43,
                'no_kontak' => '(0711) 3579 36',
                'pulau_id' => 3,
                'initial' => 'TOP',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Tulank',
                'alamat' => null,
                'daerah_id' => 16,
                'no_kontak' => null,
                'pulau_id' => 2,
                'initial' => 'TL',
                'is_reseller' => 'no'
            ], [
                'nama' => 'UD Mitra',
                'alamat' => '["Poros Palangga Gowa", "Jl. KH. Wahid Hasyim 187"]',
                'daerah_id' => 33,
                'no_kontak' => '0812 3133 8838',
                'pulau_id' => 2,
                'initial' => 'UDM',
                'is_reseller' => 'no'
            ], [
                'nama' => 'UD Serba Jaya',
                'alamat' => '["Jl. Raya Tembok Dukuh No.134 A", "Surabaya"]',
                'daerah_id' => 33,
                'no_kontak' => '0813 3030 1567',
                'pulau_id' => 2,
                'initial' => 'UDS',
                'is_reseller' => 'no'
            ], [
                'nama' => 'WA',
                'alamat' => null,
                'daerah_id' => 47,
                'no_kontak' => null,
                'pulau_id' => 4,
                'initial' => 'WA',
                'is_reseller' => 'no'
            ], [
                'nama' => 'WK Motor',
                'alamat' => '["Jl. Seliung No.10", "Sei Pinyuh"]',
                'daerah_id' => 7,
                'no_kontak' => '(0561) 652 483',
                'pulau_id' => 1,
                'initial' => 'WK',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Yensen',
                'alamat' => null,
                'daerah_id' => 23,
                'no_kontak' => null,
                'pulau_id' => 2,
                'initial' => 'YEN',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Zen Motor',
                'alamat' => '["Jl. Simpang Panji Suroso 160", "(Jalan Keluar Mikrolet Arjosari)", "Malang"]',
                'daerah_id' => 27,
                'no_kontak' => '0818 387 233',
                'pulau_id' => 2,
                'initial' => 'ZEN',
                'is_reseller' => 'no'
            ], [
                'nama' => 'Zona Motor',
                'alamat' => null,
                'daerah_id' => 3,
                'no_kontak' => null,
                'pulau_id' => 1,
                'initial' => 'ZON',
                'is_reseller' => 'no'
            ],
        ];

        $pelanggan_resellers = [
            ['reseller_id'=>6, 'pelanggan_id'=>2],
            ['reseller_id'=>6, 'pelanggan_id'=>3],
        ];

        for ($i = 0; $i < count($pelanggan); $i++) {
            DB::table('pelanggans')->insert([
                'nama' => $pelanggan[$i]['nama'],
                'alamat' => json_encode($pelanggan[$i]['alamat']),
                'no_kontak' => $pelanggan[$i]['no_kontak'],
                'pulau_id' => $pelanggan[$i]['pulau_id'],
                'daerah_id' => $pelanggan[$i]['daerah_id'],
                'initial' => $pelanggan[$i]['initial'],
                'is_reseller' => $pelanggan[$i]['is_reseller'],
            ]);
        }

        foreach ($pelanggan_resellers as $pelanggan_reseller) {
            PelangganReseller::create([
                'reseller_id' => $pelanggan_reseller['reseller_id'],
                'pelanggan_id' => $pelanggan_reseller['pelanggan_id'],
            ]);
        }

    }
}
