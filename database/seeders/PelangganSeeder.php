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
            ['nama' => '3 Putra Motor', 'alamat' => '["Jl. Sutoyo 5 No. 140", "Kel. Teluk Dalam, Kec. Banjar Barat", "Banjarmasin"]', 'daerah_id' => 1, 'no_kontak' => '0822 5363 3222', 'pulau_id' => 1,'initial' => '3PM', 'is_reseller' => 'no'],
            ['nama' => 'Abadi Motor', 'alamat' => '["Permata 1, No.366", "Pangkal Pinang - Bangka"]', 'daerah_id' => 36, 'no_kontak' => null, 'pulau_id' => 3,'initial' => 'ABA', 'is_reseller' => 'no'],
            [
                'nama' => 'Acun Motor',
                'alamat' => '["Pangkal Pinang, Bangka"]',
                'daerah_id' => 36,
                'no_kontak' => null,
                'pulau_id' => 3,
                'initial' => 'ACUN',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Ade Jok Motor', 'alamat' => null, 'daerah_id' => 34, 'no_kontak' => null, 'pulau_id' => 2,'initial' => 'ADE', 'is_reseller' => 'no'],
            [
                'nama' => 'Ajung Jaya Motor',
                'alamat' => '["Jl. Pasar Lama", "Depan Gereja Zoar", "Sentani, Jayapura"]',
                'daerah_id' => 49,
                'no_kontak' => '0812 4886 092',
                'pulau_id' => 5,
                'initial' => 'AJ',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Akong', 'alamat' => '["Pluit, Jakarta"]', 'daerah_id' => 29, 'no_kontak' => '0812 9120 0168', 'pulau_id' => 2,'initial' => 'AK', 'is_reseller' => 'yes'],
            ['nama' => 'Alindo SM', 'alamat' => null, 'daerah_id' => 23, 'no_kontak' => null, 'pulau_id' => 2,'initial' => 'ALI', 'is_reseller' => 'no'],
            ['nama' => 'Andi MC', 'alamat' => null, 'daerah_id' => 16, 'no_kontak' => null, 'pulau_id' => 2,'initial' => 'ANDI', 'is_reseller' => 'no'],
            [
                'nama' => '["Andri .Bpk", "(MILLENIUM MOTOR)"]',
                'alamat' => '["Ambil di gudang, Bukittinggi"]',
                'daerah_id' => 42,
                'no_kontak' => '0813 6361 9119',
                'pulau_id' => 3,
                'initial' => 'MIL2',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Angian Motor',
                'alamat' => '["Pangkal Pinang, Bangka"]',
                'daerah_id' => 36,
                'no_kontak' => null,
                'pulau_id' => 3,
                'initial' => 'ANG',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Asia Pasifik',
                'alamat' => '["Jl. Serdam", "Komplek Pesona Alam No.E7", "Pontianak"]',
                'daerah_id' => 4,
                'no_kontak' => '0812 5732 345',
                'pulau_id' => 1,
                'initial' => 'ASPA',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'B2 Saddle',
                'alamat' => '["Jl. Ion Martasasmita KM 02", "DS Rancasari, Kec. Pamanukan (RM. Rosin)", "Kab. Subang"]',
                'daerah_id' => 28,
                'no_kontak' => '0821 2610 6000',
                'pulau_id' => 2,
                'initial' => 'B2',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'BCC Variasi',
                'alamat' => '["Jl. Otista No.8", "Sukabumi"]',
                'daerah_id' => 31,
                'no_kontak' => '0812 7037 093',
                'pulau_id' => 2,
                'initial' => 'BCC',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Bengkel Apang',
                'alamat' => '["Pasar Pagi Samping Surau", "Tj. Pandan, Belitung"]',
                'daerah_id' => 36,
                'no_kontak' => null,
                'pulau_id' => 3,
                'initial' => 'BENG',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Benteng Motor',
                'alamat' => '["JL. GG Bulu Sarang No.151", "Makassar"]',
                'daerah_id' => 47,
                'no_kontak' => '(0411) 362 2019',
                'pulau_id' => 4,
                'initial' => 'BEN',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Berjaya Motor', 'alamat' => '["Jl. Selat Panjang No.A1", "Pontianak Utara"]', 'daerah_id' => 4, 'no_kontak' => '0853 8999 9188', 'pulau_id' => 1,'initial' => 'BER', 'is_reseller' => 'no'],
            ['nama' => 'Biran Motor', 'alamat' => '["Semabung Baru No.50", "Pangkal Pinang - Bangka"]', 'daerah_id' => 36, 'no_kontak' => null, 'pulau_id' => 3,'initial' => 'BIR', 'is_reseller' => 'no'],
            [
                'nama' => 'BSM',
                'alamat' => '["Jl. Gading Indah Utara 4/20", "(masuk dari Perumahan Gading Regency)", "Surabaya"]',
                'daerah_id' => 33,
                'no_kontak' => '0812 5732 345',
                'pulau_id' => 2,
                'initial' => 'BSM',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Budi Stiker', 'alamat' => '["Jl. Mesjid No.126", "Kesawan - Medan"]', 'daerah_id' => 41, 'no_kontak' => '(061) 4572 651', 'pulau_id' => 3,'initial' => 'BS', 'is_reseller' => 'no'],
            [
                'nama' => 'Cendana Mega Pratama',
                'bentuk' => 'CV',
                'alamat' => '["Jl. H. Yunus Yanis No.62", "Kebon Handil, Jambi"]',
                'daerah_id' => 39,
                'no_kontak' => '0813 6691 1999',
                'pulau_id' => 3,
                'initial' => 'CMP',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Central Motor', 'alamat' => '["Perumahan Ambon Bay Regency No.A30", "Sebelah Dealer Hino Lateri - Ambon"]', 'daerah_id' => 51, 'no_kontak' => null, 'pulau_id' => 7,'initial' => 'CEN', 'is_reseller' => 'no'],
            ['nama' => 'Central Young Hero', 'alamat' => '["Jl. Sindansana No.27", "Singkawang"]', 'daerah_id' => 8, 'no_kontak' => null, 'pulau_id' => 1,'initial' => 'HERO', 'is_reseller' => 'no'],
            [
                'nama' => 'Champion Motor',
                'alamat' => '["Jl. DI Panjaitan No.16,17", "Jambi"]',
                'daerah_id' => 39,
                'no_kontak' => '0878 8017 017',
                'pulau_id' => 3,
                'initial' => 'CHA',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Christovel',
                'alamat' => '["Jl. Diponegoro No.66", "Makeret Barat, Manado"]',
                'daerah_id' => 48,
                'no_kontak' => '0821 9251 5555',
                'pulau_id' => 4,
                'initial' => 'CHRIS',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'CMP',
                'alamat' => '["Jl. H Yunus Yanis N0.62", "Kebon Handil, Jambi"]',
                'daerah_id' => 39,
                'no_kontak' => '0813 6691 1999',
                'pulau_id' => 3,
                'initial' => 'CMP',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Darwis Motor', 'alamat' => '["Poros Pallangga Goa", "Makassar"]', 'daerah_id' => 47, 'no_kontak' => '0812 4425 5038', 'pulau_id' => 4,'initial' => 'DWIS', 'is_reseller' => 'no'],
            ['nama' => 'Dunia Variasi', 'alamat' => '["Jl. Raya Dupak No.63", "Blok D No.18, Surabaya"]', 'daerah_id' => 33, 'no_kontak' => '0816 4387 388', 'pulau_id' => 2,'initial' => 'DV', 'is_reseller' => 'no'],
            [
                'nama' => 'DV Motor',
                'alamat' => '["Jl. Nilam 5, RT07/RW03", "Kel.Bacang,Kec.Bukit Intan", "Pangkal Pinang, Bangka"]',
                'daerah_id' => 36,
                'no_kontak' => '0821 8449 2070',
                'pulau_id' => 3,
                'initial' => 'DVM',
                'is_reseller' => 'no'
            ],
            [
                'nama' => '["Fortuner Motor", "- G -"]',
                'alamat' => '["Jl. K.H Agus Salim No.344", "KM 4,5, Gorontalo"]',
                'daerah_id' => 45,
                'no_kontak' => '0853 9995 0500',
                'pulau_id' => 4,
                'initial' => 'FOR',
                'is_reseller' => 'no'
            ],
            [
                'nama' => '["Fortuner Motor", "- L -"]',
                'alamat' => '["Jl. Muhamad Hatta, No.79", "Maahas, Luwuk, Sulteng"]',
                'daerah_id' => 46,
                'no_kontak' => null,
                'pulau_id' => 4,
                'initial' => 'FOR',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Endang, Bpk.', 'alamat' => null, 'daerah_id' => 34, 'no_kontak' => null, 'pulau_id' => 2,'initial' => null, 'is_reseller' => 'no'],
            [
                'nama' => 'Garuda Motor',
                'alamat' => '["Komplek Puri Taman Sari", "Jl. Tudopuli 10, BLOK K-5 No.29", "Makassar"]',
                'daerah_id' => 47,
                'no_kontak' => '0813 5543 8758',
                'pulau_id' => 4,
                'initial' => 'GAR',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Global Stiker',
                'alamat' => '["Jl. Jendral Sudirman No.207", "Palembang"]',
                'daerah_id' => 43,
                'no_kontak' => '(0711) 919 9977',
                'pulau_id' => 3,
                'initial' => 'GLO',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Hadi Rumawan .Bpk',
                'alamat' => ["Jl. Golf, GG Karet 2 No.73", "Landasan Ulin Banjarbaru", "Kalimantan Selatan"],
                'daerah_id' => 2,
                'no_kontak' => '0813 5158 8351',
                'pulau_id' => 1,
                'initial' => 'HADI',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Harapan Baru',
                'alamat' => ["Jl. Cipto Mangunkusumo RT:13", "Harapan Baru, Kec. Loa Janan Ilir", "Samarinda"],
                'daerah_id' => 5,
                'no_kontak' => '0821 4906 5389',
                'pulau_id' => 1,
                'initial' => 'HAR',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Hokky Motor', 'alamat' => ["Jl. R Wolter Monginsidi No.131", "Bahu - Manado"], 'daerah_id' => 48, 'no_kontak' => '0853 1978 2288', 'pulau_id' => 4,'initial' => 'HOK', 'is_reseller' => 'no'],
            [
                'nama' => 'HR Jaya Motor',
                'alamat' => '["Jl. Gatot Subroto No.21", "Samarinda"]',
                'daerah_id' => 5,
                'no_kontak' => '0821 1152 2998',
                'pulau_id' => 1,
                'initial' => 'HR',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'H.S Motor',
                'alamat' => '["Jl. Veteran Simpang SMP 7", "No.42, RT:31, Banjarmasin"]',
                'daerah_id' => 1,
                'no_kontak' => '0812 503 6074',
                'pulau_id' => 1,
                'initial' => 'HS',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'IKB Motor',
                'alamat' => '["Jl. Kenjeran 281", "Surabaya"]',
                'daerah_id' => 33,
                'no_kontak' => '0813 3199 2290',
                'pulau_id' => 2,
                'initial' => 'HS',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Indah Motor',
                'alamat' => '["Jl. MS Rahman 95", "Pangkal Pinang, Bangka"]',
                'daerah_id' => 36,
                'no_kontak' => null,
                'pulau_id' => 3,
                'initial' => 'INDH',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Indo Putra Mandiri',
                'alamat' => ["Jl. Bandang XII No.1", "Makassar"],
                'daerah_id' => 47,
                'no_kontak' => '0812 4208 300',
                'pulau_id' => 4,
                'initial' => 'IPM',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Ismail .Bpk',
                'alamat' => null,
                'daerah_id' => 21,
                'no_kontak' => null,
                'pulau_id' => 2,
                'initial' => 'IS',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Izur Motor',
                'alamat' => '["Jl. Teluk Tiram", "GG. Raden No.15, RT:21", "Banjarmasin"]',
                'daerah_id' => 1,
                'no_kontak' => null,
                'pulau_id' => 1,
                'initial' => 'IZ',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Jaya Motor',
                'alamat' => '["Jl. Sam Ratulangi No.123", "Manado"]',
                'daerah_id' => 48,
                'no_kontak' => '(0431) 862 550',
                'pulau_id' => 4,
                'initial' => 'JAYMO',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Jaya Queen Stiker',
                'alamat' => '["Jl. ST Syahrir No.63", "Bukittinggi"]',
                'daerah_id' => 38,
                'no_kontak' => '0813 7279 8121',
                'pulau_id' => 3,
                'initial' => 'JAYQU',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Jaya Stiker',
                'alamat' => '["Jl. Mesjid No.47", "Medan"]',
                'daerah_id' => 41,
                'no_kontak' => '0813 9712 9261',
                'pulau_id' => 3,
                'initial' => 'JAYST',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Jhon Motor', 'alamat' => ["Jl. GG Bulu Sarang Blok C No.13", "Komplek Bulu Sarang Square, Makassar"], 'daerah_id' => 47, 'no_kontak' => '(0411) 3651 559', 'pulau_id' => 4,'initial' => 'JHON', 'is_reseller' => 'no'],
            ['nama' => 'Joy Motor', 'alamat' => ["Jl. Tumpangsari No.52 B", "Cakranegara - Lombok"], 'daerah_id' => 50, 'no_kontak' => '0812 3821 3131', 'pulau_id' => 6,'initial' => 'JOY', 'is_reseller' => 'no'],
            [
                'nama' => 'Kalbar Motoshop',
                'alamat' => '["Jl. Agus Salim No.7", "Samarinda"]',
                'daerah_id' => 5,
                'no_kontak' => '0812 8088 6008',
                'pulau_id' => 1,
                'initial' => 'KAL',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Kanaka Motor',
                'alamat' => '["Jl. Valanda Maramis No.194", "Manado"]',
                'daerah_id' => 48,
                'no_kontak' => '(0431) 851 441',
                'pulau_id' => 4,
                'initial' => 'KAN',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Karunia Jaya Motor',
                'alamat' => '["Jl. Parit Pangeran", "Pontianak"]',
                'daerah_id' => 4,
                'no_kontak' => '0812 5010 2997',
                'pulau_id' => 1,
                'initial' => 'KAR',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Karya Motor',
                'alamat' => '["Jl. Jurung No.6", "Simpang Wahidin, Medan"]',
                'daerah_id' => 41,
                'no_kontak' => null,
                'pulau_id' => 3,
                'initial' => 'KAR',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Kencana Motor',
                'alamat' => null,
                'daerah_id' => 49,
                'no_kontak' => '0852 5428 0807',
                'pulau_id' => 5,
                'initial' => 'KENCA',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'KMS Motor',
                'alamat' => '["Jl. Jendral Sudirman No.47 D", "Palembang"]',
                'daerah_id' => 43,
                'no_kontak' => '(0711) 7081 681',
                'pulau_id' => 3,
                'initial' => 'KMS',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Kolongan Motor',
                'alamat' => '["Jl. Martadinata 3", "Manado"]',
                'daerah_id' => 48,
                'no_kontak' => '0852 5612 5992',
                'pulau_id' => 4,
                'initial' => 'KOL',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Leo Speedshop', 'alamat' => '["Komplek Royal Kartama Residence", "Ruko No.5, Jl.Kartama (Samping SMPN 2)","Mardoyan Damai, Pekanbaru"]', 'daerah_id' => 44, 'no_kontak' => '0812 9828 4688', 'pulau_id' => 3,'initial' => 'KMS', 'is_reseller' => 'no'],
            ['nama' => 'Millenium Motor', 'alamat' => '["Jl. Mayor Ruslan No.1333 F", "Palembang"]', 'daerah_id' => 43, 'no_kontak' => '(0711) 362 262', 'pulau_id' => 3,'initial' => 'MIL', 'is_reseller' => 'no'],
            [
                'nama' => 'Mitra Jaya Motor',
                'alamat' => '["Baubau", "Sulawesi Tenggara"]',
                'daerah_id' => 37,
                'no_kontak' => '0812 3346 9951',
                'pulau_id' => 3,
                'initial' => 'MIJA',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Mitra Usaha Mandiri',
                'alamat' => '["Jl. Sepakat 2, Ruko Mutiara", "Villa Sepakat, No.B3", "Pontianak"]',
                'daerah_id' => 4,
                'no_kontak' => '0821 5321 0278',
                'pulau_id' => 1,
                'initial' => 'MUM',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Mulya Sandi',
                'alamat' => '["Jl. Riau Ujung", "Pekanbaru"]',
                'daerah_id' => 44,
                'no_kontak' => '0813 1408 2897',
                'pulau_id' => 3,
                'initial' => 'MUL',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Mustika Raya',
                'alamat' => '["Jl. Mesjid No.124 B", "Medan"]',
                'daerah_id' => 41,
                'no_kontak' => '(061) 4579 659',
                'pulau_id' => 3,
                'initial' => 'MUS',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Mutiara Motor Mandiri',
                'bentuk' => 'CV',
                'alamat' => '["JL. Simpang Panji Suroso 160", "Malang"]',
                'daerah_id' => 27,
                'no_kontak' => '0818 387 233',
                'pulau_id' => 2,
                'initial' => 'MUT',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Nagata Motor',
                'alamat' => '["Jl. Wirapati No.15", "Sintang"]',
                'daerah_id' => 9,
                'no_kontak' => '0812 5602 566',
                'pulau_id' => 1,
                'initial' => 'NA',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'NGK Motor',
                'alamat' => '["Jl. Panjaitan No.5,6,7", "Kebun Handil - Jambi"]',
                'daerah_id' => 39,
                'no_kontak' => '0823 7356 6066',
                'pulau_id' => 3,
                'initial' => 'NGK',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Nino Motor',
                'alamat' => '["Jl. Kyai Tambak Deres 141", "Surabaya"]',
                'daerah_id' => 33,
                'no_kontak' => '0851 0058 5253',
                'pulau_id' => 2,
                'initial' => 'NINO',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Novi', 'sapaan' => 'Ibu', 'alamat' => '["A8/ROY/HSES/SRW/HSES", "MALAYSIA"]', 'daerah_id' => null, 'no_kontak' => null, 'pulau_id' => null,'initial' => 'NOV', 'is_reseller' => 'no'],
            [
                'nama' => 'Nurmanto',
                'alamat' => '["(TOKO MULIA MAKMUR)", "Jl.Perdamaian pal IX Kubu Raya/Ujung", "Kota baru Pontianak"]',
                'daerah_id' => 4,
                'no_kontak' => null,
                'pulau_id' => 1,
                'initial' => 'NURM',
                'is_reseller' => 'no'
            ],[
                'nama' => 'Nusi Motor',
                'alamat' => null,
                'daerah_id' => 40,
                'no_kontak' => '0852 6622 0856',
                'pulau_id' => 3,
                'initial' => 'NUS',
                'ktrg' => '0852 6622 0856 (DODI)',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Pasti Sukses Motor', 'alamat' => '["Jl. Sutorejo Utara Baru No.3", "Surabaya"]', 'daerah_id' => 33, 'no_kontak' => '0813 3018 6448', 'pulau_id' => 2, 'initial' => 'PAS', 'is_reseller' => 'no'],
            [
                'nama' => 'Pedoman Motor',
                'alamat' => '["Jl. Gusti Hamzah No.93", "Sambas"]',
                'daerah_id' => 6,
                'no_kontak' => '0812 5607 439',
                'pulau_id' => 1,
                'initial' => 'PE',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Pelita Jok',
                'alamat' => '["Jl.Pelita Gg 3, No.52, RT39", "Sungai Pinang Dalam", "Kec. Sungai Pinang, Samarinda"]',
                'daerah_id' => 5,
                'no_kontak' => '0821 5422 1345',
                'pulau_id' => 1,
                'initial' => 'PEL',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Pioneer Jaya Motor',
                'alamat' => '["Jl. Rumambi No.9", "Manado"]',
                'daerah_id' => 48,
                'no_kontak' => '(0431) 865 088',
                'pulau_id' => 4,
                'initial' => 'PION',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Prospek Motor',
                'alamat' => '["Komplek Bumi Batara 2", "BLOK C, No.58, Pontianak"]',
                'daerah_id' => 4,
                'no_kontak' => '0812 5794 675',
                'pulau_id' => 1,
                'initial' => 'PROS',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Rajawali Motor',
                'alamat' => '["Jl. Parit Lalang No.1", "Pangkal Pinang, Bangka"]',
                'daerah_id' => 36,
                'no_kontak' => null,
                'pulau_id' => 3,
                'initial' => 'RAJ',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Rama Motor', 'alamat' => '["Jl. Imam Bonjol No.38 B", "Samarinda"]', 'daerah_id' => 5, 'no_kontak' => '0813 5034 0369', 'pulau_id' => 1, 'initial' => 'RAM', 'is_reseller' => 'no'],
            ['nama' => 'Sambung Jaya Motor', 'alamat' => '["Jl. Imam Bonjol No.426", "Pontianak"]', 'daerah_id' => 4, 'no_kontak' => '0812 5673 5233', 'pulau_id' => 1, 'initial' => 'SAM', 'is_reseller' => 'no'],
            ['nama' => 'Saudara Motor', 'alamat' => null, 'daerah_id' => 23, 'no_kontak' => null, 'pulau_id' => 3, 'initial' => 'SAU', 'is_reseller' => 'no'],
            [
                'nama' => 'Scopa Motor',
                'alamat' => '["Jl. Kalimantan No.23", "Mataram, Lombok"]',
                'daerah_id' => 50,
                'no_kontak' => '(0370) 636 414',
                'pulau_id' => 6,
                'initial' => 'SCO',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Sejati Jaya Sondy',
                'alamat' => null,
                'daerah_id' => 47,
                'no_kontak' => null,
                'pulau_id' => 4,
                'initial' => 'SON',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Setia Budi',
                'alamat' => '["Jl. Jendral A. Yani KM6,7", "Komplek Bun Yamin Pemain 1, Raya Utama", "No.9, RT:14, Banjarmasin"]',
                'daerah_id' => 1,
                'no_kontak' => '0813 4819 1028',
                'pulau_id' => 1,
                'initial' => 'SET',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Sinar Perkasa Motor',
                'alamat' => '["Jl. Pasar 3", "Komplek Sehati Indah, No.88 FF", "Daerah Krakatau, Medan"]',
                'daerah_id' => 41,
                'no_kontak' => '0813 9600 5859',
                'pulau_id' => 3,
                'initial' => 'SIN',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'SS Uji 169 Handil Bakti',
                'alamat' => '["Jl. Karya Sabumi IV, No.26 A", "Kayu Tangi, Banjarmasin"]',
                'daerah_id' => 1,
                'no_kontak' => '(0561) 330 3216',
                'pulau_id' => 1,
                'initial' => 'SS',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Sukses Makmur Motor',
                'alamat' => '["PM NOOR RT39", "Samarinda"]',
                'daerah_id' => 5,
                'no_kontak' => '0813 4777 7722',
                'pulau_id' => 1,
                'initial' => 'SM',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Sumber Abadi Motor',
                'alamat' => '["KM 14 Jambi", "Palembang"]',
                'daerah_id' => 43,
                'no_kontak' => null,
                'pulau_id' => 3,
                'initial' => 'SAM',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Sumber Cemerlang',
                'alamat' => '["Jl. Karet 24 Ilir", "Kec.Bukit Kecil, Palembang"]',
                'daerah_id' => 43,
                'no_kontak' => '0878 9160 7875',
                'pulau_id' => 3,
                'initial' => 'SUMC',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Sumber Makmur',
                'alamat' => '["Kapasari, GG 5, No.11", "Surabaya"]',
                'daerah_id' => 33,
                'no_kontak' => '0812 3472 5210',
                'pulau_id' => 2,
                'initial' => 'SUMAK',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Sumber Mandiri Motor',
                'alamat' => '["Jl. Ringin Sari No.8,9", "(samping Alfamart Ringinsari), Pontianak"]',
                'daerah_id' => 4,
                'no_kontak' => '0811 578 278',
                'pulau_id' => 1,
                'initial' => 'SUMAN',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Sumber Rejeki Motor', 'alamat' => null, 'daerah_id' => 23, 'no_kontak' => null, 'pulau_id' => 2, 'initial' => 'SUMRE', 'is_reseller' => 'no'],
            [
                'nama' => 'Surya Jaya Motor',
                'alamat' => '["Jl. IR. H. Juanda No.54-56", "Pontianak"]',
                'daerah_id' => 4,
                'no_kontak' => '0812 5656 2985',
                'pulau_id' => 1,
                'initial' => 'SJM',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Surya Perdana Agung', 'alamat' => '["Jl. Soekarno Hatta", "Komplek Sentral Niaga No.12, A-B", "Pekanbaru"]', 'daerah_id' => 44, 'no_kontak' => '0812 7501 178', 'pulau_id' => 3, 'initial' => 'SPA', 'is_reseller' => 'no'],
            [
                'nama' => 'Teratai Motor',
                'alamat' => '["Jl. KL. Yos Sudarso 8J,8K,8L", "Komplek Brayan One Stop Square", "Medan"]',
                'daerah_id' => 41,
                'no_kontak' => '(061) 6643 002',
                'pulau_id' => 3,
                'initial' => 'TER',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Toko 86', 'alamat' => null, 'daerah_id' => 16, 'no_kontak' => null, 'pulau_id' => 2, 'initial' => 'T86', 'is_reseller' => 'no'],
            [
                'nama' => 'Tommy',
                'sapaan' => 'Ko',
                'alamat' => null,
                'daerah_id' => 22,
                'no_kontak' => null,
                'pulau_id' => 2,
                'initial' => 'TOM',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'Top Variasi',
                'alamat' => '["Jl. Jendral Sudirman No.52 E", "Palembang"]',
                'daerah_id' => 43,
                'no_kontak' => '(0711) 3579 36',
                'pulau_id' => 3,
                'initial' => 'TOP',
                'is_reseller' => 'no'
            ],
            ['nama' => 'Tulank', 'alamat' => null, 'daerah_id' => 16, 'no_kontak' => null, 'pulau_id' => 2, 'initial' => 'TL', 'is_reseller' => 'no'],
            [
                'nama' => 'UD Mitra',
                'alamat' => '["Poros Palangga Gowa", "Jl. KH. Wahid Hasyim 187"]',
                'daerah_id' => 33,
                'no_kontak' => '0812 3133 8838',
                'pulau_id' => 2,
                'initial' => 'UDM',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'UD Serba Jaya',
                'alamat' => '["Jl. Raya Tembok Dukuh No.134 A", "Surabaya"]',
                'daerah_id' => 33,
                'no_kontak' => '0813 3030 1567',
                'pulau_id' => 2,
                'initial' => 'UDS',
                'is_reseller' => 'no'
            ],
            [
                'nama' => 'WA',
                'alamat' => null,
                'daerah_id' => 47,
                'no_kontak' => null,
                'pulau_id' => 4,
                'initial' => 'WA',
                'is_reseller' => 'no'
            ],
            ['nama' => 'WK Motor', 'alamat' => '["Jl. Seliung No.10", "Sei Pinyuh"]', 'daerah_id' => 7, 'no_kontak' => '(0561) 652 483', 'pulau_id' => 1, 'initial' => 'WK', 'is_reseller' => 'no'],
            ['nama' => 'Yensen', 'alamat' => null, 'daerah_id' => 23, 'no_kontak' => null, 'pulau_id' => 2, 'initial' => 'YEN', 'is_reseller' => 'no'],
            [
                'nama' => 'Zen Motor',
                'alamat' => '["Jl. Simpang Panji Suroso 160", "(Jalan Keluar Mikrolet Arjosari)", "Malang"]',
                'daerah_id' => 27,
                'no_kontak' => '0818 387 233',
                'pulau_id' => 2,
                'initial' => 'ZEN',
                'is_reseller' => 'no'
            ],
            [
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
