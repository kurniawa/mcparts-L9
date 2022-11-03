<?php

namespace Database\Seeders;

use App\Models\Alamat;
use App\Models\Ekspedisi;
use App\Models\EkspedisiAlamat;
use App\Models\EkspedisiKontak;
use App\Models\Kontak;
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
        $ekspedisis=[
            [
                'bentuk' => 'PT',
                'nama' => 'Adhiputra',
                'alamat' => [[
                    'jalan'=>'Jl. RE Martadinata',
                    'komplek'=>'Pergudangan Caraka',
                    'kecamatan'=>'Tanjung Priok',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Tj. Priok',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. RE Martadinata", "Pergudangan Caraka, Blok 1K", "Tj. Priok"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'43913388',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'AFRO',
                'alamat' => [[
                    'jalan'=>null,
                    'komplek'=>'Ruko Permata Ancol',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Ancol',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Ruko Permata Ancol", "Blok K-33"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6450978',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'ALTRANS',
                'alamat' => [[
                    'jalan'=>'Jl. Agung Timur 8',
                    'komplek'=>'Ruko Prima Sunter',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Sunter',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Agung Timur 8, Blok 2", "Ruko Prima Sunter"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6510665',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'Angkasa',
                'alamat' => [[
                    'jalan'=>'Jl. Mangga Dua Raya',
                    'komplek'=>'Ruko Mangga Dua Plaza',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Mangga Dua',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Mangga Dua Raya", "Ruko Mangga Dua Plaza", "Blok B, No. 06"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6120705',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Anugrah',
                'alamat' => [[
                    'jalan'=>null,
                    'komplek'=>'DHI',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'DHI',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek DHI", "Blok G", "No.22-23"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6623077',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'Anugrah Duta Prima',
                'alamat' => [[
                    'jalan'=>'Jl. Teluk Aru Utara 1 No.19',
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Teluk Aru Utara 1 No.19", "Surabaya"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'031',
                        'nomor'=>'3295462',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'Arung Samudra Express',
                'alamat' => [[
                    'jalan'=>'Jl. Sukarjo Wiryo Pranoto No.11 B',
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Pusat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Sawah Besar',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Sukarjo Wiryo Pranoto No.11 B", "(Depan Stasiun KA Sawah Besar)"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6285574',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Atlantic Cargo',
                'alamat' => [[
                    'jalan'=>null,
                    'komplek'=>'Ruko Permata Ancol',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Ancol',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Ruko Permata Ancol", "Blok L-20"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6457856',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Bahari Utama Jaya',
                'alamat' => [[
                    'jalan'=>null,
                    'komplek'=>'Lodan Center',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Lodan',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Lodan Center","Blok P No.1"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6916756',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Bangkit Jaya Manunggal',
                'alamat' => [[
                    'jalan'=>'Jl. Tubagus Angke',
                    'komplek'=>'Duta Square',
                    'kecamatan'=>null,
                    'kelurahan'=>'Jelambar',
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Jelambar',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Tubagus Angke, Duta Square", "Blok B, No.2, Jelambar"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'56959281',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Baraka Sarana Tama',
                'alamat' => [[
                    'jalan'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Cibinong',
                    'kelurahan'=>null,
                    'kota'=>'Bogor',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Barat',
                    'pulau'=>'Jawa',
                    'short'=>'Cibinong',
                    'negara'=>'Indonesia',
                    'long'=>'["Cibinong"]',
                ]],
                'kontak' => null,
            ], [
                'bentuk' => null,
                'nama' => 'Berkat Abadi Jaya',
                'alamat' => [[
                    'jalan'=>'Jl. Krekot IV',
                    'komplek'=>null,
                    'kecamatan'=>'Sawah Besar',
                    'kelurahan'=>'Pasar Baru',
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Pasar Baru',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Krekot IV", "Blok I No.16", "Pasar Baru"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'3814429',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Berkat Mandiri Trans',
                'alamat' => [[
                    'jalan'=>'Jl. Lontar No.38',
                    'rt'=>'01','rw'=>'07',
                    'komplek'=>null,
                    'kecamatan'=>'Tanah Abang',
                    'kelurahan'=>'Kebon Kacang',
                    'kota'=>'Jakarta Pusat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Tn. Abang',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Lontar No.38, RT:1/RW:7", "Kebon Kacang, Tanah Abang"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'082213139975',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Bintang Khatulistiwa',
                'alamat' => [[
                    'jalan'=>'Jl. Teluk Kumai Timur No.14',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Teluk Kumai Timur No.14", "Depo Tanto 4, Surabaya"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'085100107030',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Bintang Saudara',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'DHI',
                    'kecamatan'=>'Penjaringan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'DHI',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek DHI, Blok KK No.99"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6605887',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'BJA',
                'alamat' => [[
                    'jalan'=>'Jl. Kapuk Kamal Raya No.40',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Pluit Bisnis',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Barat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Pluit',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kapuk Kamal Raya No.40", "Pluit Bisnis Blok N, No.8"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'082213276565',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Cahaya Lintas',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Ruko Permata Ancol',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Ancol',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Ruko Permata Ancol", "Blok P, No.22"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6457818',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Cendana Makmur Bahagia',
                'alamat' => [[
                    'jalan'=>'Jl. Pangeran Jayakarta',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Sawah Besar',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Pusat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Sawah Besar',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Pangeran Jayakarta", "GG Melawan No.123/71"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6120709',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Citramas',
                'alamat' => [[
                    'jalan'=>'Jl. Kapuk Kamal Raya No.40',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Pluit Bisnis',
                    'kecamatan'=>'Sawah Besar',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Barat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Pluit',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kapuk Kamal Raya No.40", "Pluit Bisnis Blok N, No.7"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'087772427956',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Dakota',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Gunung Putri',
                    'kelurahan'=>null,
                    'kota'=>'Bogor',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Barat',
                    'pulau'=>'Jawa',
                    'short'=>'Gn. Putri',
                    'negara'=>'Indonesia',
                    'long'=>'["Gunung Putri, Wanaherang"]',
                ]],
                'kontak' => null,
            ], [
                'bentuk' => null,
                'nama' => 'Davindo',
                'alamat' => [[
                    'jalan'=>'Jl. Lodan Raya No.15 B',
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Lodan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Lodan Raya No.15 B", "(Depan MKS)"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'08119100122',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Domestic Universal Cargo',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Ruko Permata Ancol',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Ancol',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Ruko Permata Ancol", "Blok M/31"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6456565',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Dwitama Bangun Pratama',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'DHI',
                    'kecamatan'=>'Penjaringan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'DHI',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek DHI, Blok OO, No.11 A"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'22671119',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'EDI Express',
                'alamat' => [[
                    'jalan'=>'Jl. Pasoso',
                    'komplek'=>null,
                    'kecamatan'=>'Tanjung Priok',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Tj. Priok',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Pasoso", "Tj. Priok, Lapangan 219X"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'085348542791',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Fajar Baru',
                'alamat' => [[
                    'jalan'=>'Jl. Lodan Raya No.9',
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Lodan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Lodan Raya No.9"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'085285655569',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Gasuma',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Ruko Permata Ancol',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Ancol',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Ruko Permata Ancol", "Blok C No.17"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6414535',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Handai Terang Sentosa',
                'alamat' => [[
                    'jalan'=>'Jl. Raya Pakin',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Mitra Bahari',
                    'kecamatan'=>'Penjaringan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Mitra Bahari',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Raya Pakin", "Komplek Mitra Bahari", "Blok C, No.16"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6625172',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'HWU',
                'alamat' => [[
                    'jalan'=>'Jl. Gunung Sahari Raya',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Komplek Marinatama',
                    'kecamatan'=>'Pademangan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Marinatama',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Gunung Sahari Raya", "Komplek Marinatama Blok J No.1"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'64700279',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Indokarya',
                'alamat' => [[
                    'jalan'=>'Jl. Indokarya No.11',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>'Papanggo',
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Sunter',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Indokarya No.11", "Blok E, Sunter Papango"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'650234851',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Jasa Karya',
                'alamat' => [[
                    'jalan'=>'Jl. Jembatan 3',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Pergudangan Pluit',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Pluit',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Jembatan 3", "Komplek Pergudangan Pluit Blok B", "Kavling No.13"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'66600635',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Jasa Tunggal Bahari',
                'alamat' => [[
                    'jalan'=>'Jl. Kalimas Baru, No.28-30',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kalimas Baru, No.28-30", "Depo Sril Up Selamet", "Surabaya"]',
                ]],
                'kontak' => null,
            ], [
                'bentuk' => null,
                'nama' => 'Jaya Alam Perkasa',
                'alamat' => [[
                    'jalan'=>'Jl. Bandengan Utara',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Bandengan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Bandengan Utara", "GG Buntek, Blok 85A, No.15"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6695365',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Jakarta Bangka Express (JBE)',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>'02','rw'=>'01',
                    'komplek'=>'Ruko Duri Raya',
                    'kecamatan'=>'Kebon Jeruk',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Barat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Duri Kepa',
                    'negara'=>'Indonesia',
                    'long'=>'["Ruko Duri Raya","RT02/RW01, No.1, Duri Kepa"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'56966573',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Johan Express',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Ruko Galaxy Taman Palem Lestari',
                    'kecamatan'=>'Cengkareng',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Barat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Cengkareng',
                    'negara'=>'Indonesia',
                    'long'=>'["Ruko Galaxy Taman Palem Lestari", "Blok M, No.79"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081380556175',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Karunia Cipta Logistics',
                'alamat' => [[
                    'jalan'=>"Jl. Bandengan Utara",
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Ruko Mega Bandengan',
                    'kecamatan'=>'Penjaringan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Bandengan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Bandengan Utara", "Ruko Bandengan Megah 81", "Blok B No.49"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'082299170903',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Karyati',
                'alamat' => [[
                    'jalan'=>"Jl. Daan Mogot KM 12,8",
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Pergudangan Prima',
                    'kecamatan'=>'Cengkareng',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Barat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Cengkareng',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Daan Mogot KM 12,8", "Pergudangan Prima 2 KAV 7, No.5"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'087886981348',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'KSI Logistics',
                'alamat' => [[
                    'jalan'=>"Jl. Cideng Barat, No.88A",
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Gambir',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Pusat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Gambir',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Cideng Barat, No.88A", "Gambir"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'22037785',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Limas',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'DHI',
                    'kecamatan'=>'Penjaringan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'DHI',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek DHI Blok E3", "(belakang Komplek, depan PERTAMINA)"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081383331261',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Lintas Abadi Sejahtera',
                'alamat' => [[
                    'jalan'=>'Jl. RE Martadinata',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Pergudangan Inkopau',
                    'kecamatan'=>'Tanjung Priok',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Tj. Priok',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. RE Martadinata", "Pergudangan Inkopau Blok B5"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081399367755',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'Marpahala',
                'alamat' => [[
                    'jalan'=>'Jl. Kp. Bandan',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Pademangan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Pademangan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kp. Bandan, Tanah Merah", "(dekat POS BPPKB, depan Mesjid Ataubah)"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'082365860090',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Merah Jaya',
                'alamat' => [[
                    'jalan'=>'Jl. Kp. Bandan',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Pademangan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Pademangan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kp. Bandan No.8"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'71003436',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'Mitra Buana',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'DHI',
                    'kecamatan'=>'Penjaringan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'DHI',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek DHI Blok PP, No.17"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6623515',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Mitra Kalbar Sentosa',
                'alamat' => [[
                    'jalan'=>'Jl. Lodan Raya No.6C',
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Lodan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Lodan Raya No.6C"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'082151605345',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Mitra Samudra',
                'alamat' => [[
                    'jalan'=>'Jl. Lodan Raya 2',
                    'komplek'=>'Komplek Ruko Lodan Center',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Lodan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Lodan Raya 2", "Komplek Ruko Lodan Center", "Blok L No.17"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'082195601720',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Multi Express Transindo',
                'alamat' => [[
                    'jalan'=>'Jl. Sukarjo Wiryo Pranoto No.11D',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Sawah Besar',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Pusat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Sawah Besar',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Sukarjo Wiryo Pranoto No.11D", "Depan Stasiun KA. Sawah Besar"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6259158',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Multi Intim',
                'alamat' => [[
                    'jalan'=>'Jl. Kasuari No.19',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kasuari No.19, Surabaya"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081291200168',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'New Putra Duta',
                'alamat' => [[
                    'jalan'=>'Jl. Krekot IV',
                    'komplek'=>null,
                    'kecamatan'=>'Sawah Besar',
                    'kelurahan'=>'Pasar Baru',
                    'kota'=>'Jakarta Pusat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Swh. Besar',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Krekot Pasar Baru","Blok C2, No.11 D"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081291662309',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Ponti Jaya Express',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Ruko Permata Ancol',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Ancol',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Ruko Permata Ancol", "Blok I No.30"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'64718201',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Putra Guna',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Ruko Permata Ancol',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Ancol',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Ruko Permata Ancol", "Blok P No.9"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'64711264',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Putra Mandiri Transindo',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'DHI',
                    'kecamatan'=>'Penjaringan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'DHI',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek DHI Blok MM, No.3"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6682685',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'Putra Panorama',
                'alamat' => [[
                    'jalan'=>'Jl. Perniagaan Barat II',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Tambora',
                    'kelurahan'=>'Roa Malaka',
                    'kota'=>'Jakarta Barat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Pasar Pagi',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Perniagaan Barat II", "GG. Istal No.1, Pasar Pagi"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6907479',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'Rama Express',
                'alamat' => [[
                    'jalan'=>"Jl. Bandengan Utara",
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Penjaringan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Bandengan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Bandengan Utara", "Gg Buntek, Blok 85 C, No.40A"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081317275583',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'Rama Jaya',
                'alamat' => [[
                    'jalan'=>null,
                    'komplek'=>'Komplek Ruko Lodan Center',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Lodan',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek Lodan Center Blok L, No.18"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6917189',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Ratu Berlian Makmur',
                'alamat' => [[
                    'jalan'=>"Jl. Arcadia Daan Mogot, KM 21",
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Gudang Arcadia',
                    'kecamatan'=>'Batuceper',
                    'kelurahan'=>null,
                    'kota'=>'Tangerang',
                    'kabupaten'=>null,
                    'provinsi'=>'Banten',
                    'pulau'=>'Jawa',
                    'short'=>'Batuceper',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Arcadia Daan Mogot, KM 21", "Gudang Arcadia Blok F2, No.2","Batuceper"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'29006339',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Rinjani Jaya Trans',
                'alamat' => [[
                    'jalan'=>'Jl. Kenjeran No.381',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kenjeran No.381", "KAV 1, Surabaya"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'031',
                        'nomor'=>'3890663',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Sahabat Belitung Express (SBE)',
                'alamat' => [[
                    'jalan'=>'Jl. Gn. Sahari',
                    'komplek'=>'Ruko Marinatama',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Gn. Sahari',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Gunung Sahari", "Ruko Marinatama Blok I, No.6-7"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'64703360',
                    ]
                ],
            ], [
                'bentuk' => 'PT',
                'nama' => 'Saranaraya Lintas Timur',
                'alamat' => [[
                    'jalan'=>'Jl. Industri 1',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Depo SPIL Inggom',
                    'kecamatan'=>'Tj. Priok',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Tj. Priok',
                    'negara'=>'Indonesia',
                    'long'=>'["Depo SPIL Inggom", "Jl. Industri 1, Tj. Priok"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081295258167',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Sinar Berlian',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'DHI',
                    'kecamatan'=>'Penjaringan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'DHI',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek DHI","Blok H No.24"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6605824',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Subur Antar Nusa',
                'alamat' => [[
                    'jalan'=>'Jl. Kapuk Kamal Raya No.40',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Pluit Bisnis',
                    'kecamatan'=>'Sawah Besar',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Barat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Pluit',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kapuk Kamal Raya No.40", "Pluit Bisnis Blok D, No.7"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'55963780',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'Sukses Abadi Zentosa',
                'alamat' => [[
                    'jalan'=>'Jl. Tongkol No.6',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Ruko BR',
                    'kecamatan'=>'Pademangan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Tongkol',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Tongkol No.6", "Ruko BR"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081234965888',
                    ]
                ],
            ], [
                'bentuk' => 'CV',
                'nama' => 'Sukses Karunia Sejahtera',
                'alamat' => [[
                    'jalan'=>'Jl. Kampung Bandan No.1',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Pademangan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Kp. Bandan',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Kampung Bandan No.1"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'085105292979',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Sumber Urip',
                'alamat' => [[
                    'jalan'=>'Jl. Pangeran Jayakarta No.16/6-7',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Sawah Besar',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Pusat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Swh. Besar',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Pangeran Jayakarta No.16/6-7"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6294208',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Surya Angkasa',
                'alamat' => [[
                    'jalan'=>'Jl. Sidorame No.30 A',
                    'rt'=>'02','rw'=>'11',
                    'komplek'=>null,
                    'kecamatan'=>'Semampir',
                    'kelurahan'=>null,
                    'kota'=>'Surabaya',
                    'kabupaten'=>null,
                    'provinsi'=>'Jawa Timur',
                    'pulau'=>'Jawa',
                    'short'=>'Surabaya',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Sidorame No.30 A", "RT002/RW11, Pegirian", "Kec.Semampir, Surabaya"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'087771176788',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Tesa Logistic',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Pergudangan Prima',
                    'kecamatan'=>'Cengkareng',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Barat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Cengkareng',
                    'negara'=>'Indonesia',
                    'long'=>'["Pergudangan Prima Center 1, Blok D 11", "Jl.Pool PPD Kendang Kali Angke"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'081290228075',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Toko Bangunan Buana Indah',
                'alamat' => [[
                    'jalan'=>"Jl. Raya Serang KM 13,8",
                    'rt'=>null,'rw'=>null,
                    'komplek'=>null,
                    'kecamatan'=>'Cikupa',
                    'kelurahan'=>null,
                    'kota'=>'Tangerang',
                    'kabupaten'=>null,
                    'provinsi'=>'Banten',
                    'pulau'=>'Jawa',
                    'short'=>'Cikupa',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Raya Serang KM 13,8", "Pasir Gadung Cikupa, Tangerang"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'59404418',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'TTM',
                'alamat' => [[
                    'jalan'=>null,
                    'komplek'=>'Komplek Ruko Lodan Center',
                    'kecamatan'=>null,
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Lodan',
                    'negara'=>'Indonesia',
                    'long'=>'["Lodan Center Blok C, No.10"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'seluler',
                        'kodearea'=>null,
                        'nomor'=>'08561171138',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Wira Agung',
                'alamat' => [[
                    'jalan'=>'Jl. Tubagus Angke Blok D 1/9',
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'Gudang Dutamas',
                    'kecamatan'=>'Grogol Petamburan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Barat',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'Gd. Dutamas',
                    'negara'=>'Indonesia',
                    'long'=>'["Jl. Tubagus Angke Blok D 1/9", "Gudang Dutamas"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'5678067',
                    ]
                ],
            ], [
                'bentuk' => null,
                'nama' => 'Wira Express',
                'alamat' => [[
                    'jalan'=>null,
                    'rt'=>null,'rw'=>null,
                    'komplek'=>'DHI',
                    'kecamatan'=>'Penjaringan',
                    'kelurahan'=>null,
                    'kota'=>'Jakarta Utara',
                    'kabupaten'=>null,
                    'provinsi'=>'DKI Jakarta',
                    'pulau'=>'Jawa',
                    'short'=>'DHI',
                    'negara'=>'Indonesia',
                    'long'=>'["Komplek DHI, Blok MM No.17-18"]',
                ]],
                'kontak' => [
                    [
                        'tipe'=>'kantor',
                        'kodearea'=>'021',
                        'nomor'=>'6605892',
                    ]
                ],
            ]
        ];

        for ($i = 0; $i < count($ekspedisis); $i++) {
            $bentuk = null;
            if (isset($ekspedisis[$i]['bentuk']) && $ekspedisis[$i]['bentuk'] !== null) {
                $bentuk = $ekspedisis[$i]['bentuk'];
            }
            $ekspedisi_new = Ekspedisi::create([
                'bentuk' => $bentuk,
                'nama' => $ekspedisis[$i]['nama'],
            ]);
            // dump($ekspedisi_new['nama']);
            if ($ekspedisis[$i]['alamat']) {
                foreach ($ekspedisis[$i]['alamat'] as $alamat) {
                    $alamat_new = Alamat::create($alamat);
                    EkspedisiAlamat::create([
                        'ekspedisi_id'=>$ekspedisi_new['id'],
                        'alamat_id'=>$alamat_new['id'],
                        'tipe'=>'UTAMA',
                    ]);
                }
            }
            if (isset($ekspedisis[$i]['kontak']) && $ekspedisis[$i]['kontak'] !== null) {
                foreach ($ekspedisis[$i]['kontak'] as $kontak) {
                    EkspedisiKontak::create([
                        'ekspedisi_id'=>$ekspedisi_new['id'],
                        'tipe'=>$kontak['tipe'],
                        'kodearea'=>$kontak['kodearea'],
                        'nomor'=>$kontak['nomor'],
                        'is_aktual'=>'yes',
                    ]);
                }
            }

        }
    }
}
