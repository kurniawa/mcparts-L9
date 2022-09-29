<?php

namespace Database\Seeders;

use App\Models\Bahan;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BahanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $bahan = [[
            'nama' => 'Amplas(CA)', // 1
            'grade' => null,
            'harga' => 16500,
            'keterangan' => 'Dinamakan CA karena seperti mengandung bahan CA. Pengambilan dari MAX. Backing warna putih, tanpa merek. Nama lain pasir adalah Amplas.',
        ], [
            'nama' => 'Amplas(MCR)', // 2
            'grade' => null,
            'harga' => 16500,
            'keterangan' => 'Pengambilan dari Royal. Backing warna putih, merek MC (logo new bersayap).',
        ], [
            'nama' => 'Amplas(RY)', // 3
            'grade' => null,
            'harga' => 16500,
            'keterangan' => 'Pengambilan dari Royal. Backing warna abu, merek MC (logo new bersayap). Tidak dinamakan MC karena sudah tau, Amplas dari Royal pasti ada merek',
        ], [
            'nama' => 'Amplas(SBT)', // 4
            'grade' => null,
            'harga' => 19000,
            'keterangan' => 'Pengambilan dari Toko Sumber Maju Dunia, Tanah Abang. Bahan premium merek SB-Tech.',
        ], [
            'nama' => 'BigDot(CK)', // 5
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'BigDot dengan backing warna Coklat, tanpa merek. Pengambilan dari MAX.',
        ], [
            'nama' => 'BigDot(MC)', // 6
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'BigDot dengan merek MC. Pengambilan dari MAX',
        ], [
            'nama' => 'BigDot(MCR)', // 7
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'BigDot dengan merek MC (logo new bersayap), backing warna putih. Pengambilan dari Royal.',
        ], [
            'nama' => 'C24', // 8
            'grade' => 'B',
            'harga' => 13000,
            'keterangan' => 'Motif: Biji Kopi. Ketebalan:0.7 mm. Nama lain: Vario 0.7, penamaan tergantung pelanggan. Dulu keterangan ketebalan masih ditulis, sekarang tidak lagi ditulis, karena sudah pasti demikian dan untuk menghindari percekcokan dengan pelanggan.',
        ], [
            'nama' => 'C30(MC)', // 9
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Bahan dengan motif C30 (bintik-bintik kecil), ketebalan: 0.9 mm. Merek MC. Pengambilan dari MAX.',
        ], [
            'nama' => 'C38(EX)', // ? 10
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: MAX. Motif: C38 (mirip BigDot namun bentuk nya agak oval). Ketebalan: 0.9 mm.',
        ], [
            'nama' => 'C38(MC)', // 11
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Bahan dengan motif C38 (mirip BigDot namun bentuk nya agak oval), ketebalan: 0.9 mm. Merek MC. Pengambilan dari MAX.',
        ], [
            'nama' => 'Carbon', // 12
            'grade' => null,
            'harga' => 19000,
            'keterangan' => 'Ketebalan: 0.8 mm. Merek MC (logo new bersayap). Backing: Biru. Pengambilan dari Royal. Tidak ada keterangan RY, karena memang saat ini hanya Royal yang memproduksi bahan dengan motif ini. Oleh karena itu tidak perlu tertulis code yang membedakan.',
        ], [
            'nama' => 'Grafity', // 13
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Ketebalan: 0.8 mm. Merek MC (logo baru bersayap). Backing: Biru. Pengambilan dari Royal. Tidak ada keterangan RY, karena memang saat ini hanya Royal yang memproduksi bahan dengan motif ini. Oleh karena itu tidak perlu tertulis code yang membedakan.',
        ], [
            'nama' => 'Kulit Jeruk', // 14
            'grade' => 'B',
            'harga' => 13000,
            'keterangan' => 'Backing: Putih. Ketebalan: 0.7 mm. Pengambilan dari MAX.',
        ], [
            'nama' => 'Kulit Jeruk(CK)(RY)', // 15
            'grade' => 'B',
            'harga' => 13000,
            'keterangan' => 'Motif: Kulit Jeruk, tekstur terlihat sedikit berbeda dibandingkan dengan tekstur Kulit Jeruk dari MAX. Backing: Coklat. Pengambilan dari Royal.',
        ], [
            'nama' => 'L55(CK)', // L55(CK)/OSBAC // 16
            'grade' => 'B',
            'harga' => 13000,
            'keterangan' => 'Motif: Kulit Jeruk. Ketebalan: 0.7 mm. Backing: Coklat. Pengambilan dari MAX. Dulu namanya OSBAC yang ambil dari Royal dimana tekstur Kulit Jeruk nya juga yang Kulit Jeruk Royal. Karena tidak lagi ambil dari Royal, maka tidak perlu lagi ada penamaan tambahan seperti L55/OSBAC. Namun apabila ada ambil lagi dari Royal, mungkin bahan tersebut akan jadi OSBAC(RY). Waktu itu tidak ambil OSBAC lagi dari Royal karena ketebalan OSBAC: 0.8 mm. Lalu ada bahan baru dengan nama Navaro yang mirip OSBAC, cuma beda di ketebalan nya saja, yakni Navaro lebih tebal, namun dengan harga yang tidak berbeda jauh, sehingga pelanngan lebih memilih Navaro',
        ], [
            'nama' => 'L55(MC)', // 17
            'grade' => 'A',
            'harga' => 12000,
            'keterangan' => 'Motif: Kulit Jeruk. Ketebalan: 0.9 mm. Backing: Putih. Merek: MC, pengambilan dari MAX.',
        ], [
            'nama' => 'LuckyHole', // 18
            'grade' => 'B',
            'harga' => 12500,
            'keterangan' => 'Pengambilan dari: Toko Baru. Ketebalan: ~ 0.65 mm. Backing: Putih, polos. Pengambilan bukan dari pabrik, ini produk import.',
        ], [
            'nama' => 'LuckyHole(FB)', // 19
            'grade' => 'B',
            'harga' => 12500,
            'keterangan' => 'Seperti selayaknya LuckyHole biasa namun pengambilan dari Fajar Baru.',
        ], [
            'nama' => 'LuckyHole Biru', // 20
            'grade' => 'B',
            'harga' => 12500,
            'keterangan' => 'Pengambilan dari: Toko Baru. Ketebalan: ~ 0.65 mm. Backing: Putih, polos. Pengambilan bukan dari pabrik, ini produk import.',
        ], [
            'nama' => 'LuckyHole Hitam', // 20
            'grade' => 'B',
            'harga' => 12500,
            'keterangan' => 'Pengambilan dari: Toko Baru. Ketebalan: ~ 0.65 mm. Backing: Putih, polos. Pengambilan bukan dari pabrik, ini produk import.',
        ], [
            'nama' => 'LuckyHole Kuning', // 21
            'grade' => 'B',
            'harga' => 12500,
            'keterangan' => 'Pengambilan dari: Toko Baru. Ketebalan: ~ 0.65 mm. Backing: Putih, polos. Pengambilan bukan dari pabrik, ini produk import.',
        ], [
            'nama' => 'LuckyHole Merah', // 21
            'grade' => 'B',
            'harga' => 12500,
            'keterangan' => 'Pengambilan dari: Toko Baru. Ketebalan: ~ 0.65 mm. Backing: Putih, polos. Pengambilan bukan dari pabrik, ini produk import.',
        ], [
            'nama' => 'LuckyHole Warna', // 22
            'grade' => 'B',
            'harga' => 12500,
            'keterangan' => 'Seperti selayaknya LuckyHole biasa namun warna nya campur.',
        ], [
            'nama' => 'MBtech(BD)', // 23
            'grade' => null,
            'harga' => 41000,
            'keterangan' => 'Pengambilan dari: Fajar Baru. Motif BigDot. Ketebalan: ~ 1.3 mm. Backing: Putih, merek MB-tech. Bahan kualitas super premium (lebih premium dari SB-Tech).',
        ], [
            'nama' => 'MBtech(KJ)', // 24
            'grade' => null,
            'harga' => 41000,
            'keterangan' => 'Pengambilan dari: Fajar Baru. Motif Kulit Jeruk. Ketebalan: ~ 1.3 mm. Backing Putih, merek MB-tech . Bahan kualitas super premium (lebih premium dari SB-Tech).',
        ], [
            'nama' => 'MBtech(RD)', // 25
            'grade' => null,
            'harga' => 41000,
            'keterangan' => 'Pengambilan dari: Fajar Baru. Motif: Rider (mirip Carbon, bedanya Carbon mengkilap, kalo Rider tidak mengkilap). Ketebalan: ~ 1.3 mm. Backing Putih, merek MB-tech . Bahan kualitas super premium (lebih premium dari SB-Tech).',
        ], [
            'nama' => 'Navaro(MC)', // 26
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Motif: Kulit Jeruk. Ketebalan: 1 mm. Backing: Coklat. Merek MC. Pengambilan dari MAX. Penamaan Navaro karena dari lagganan.',
        ], [
            'nama' => 'UratTangan(MC)', // 27
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: MAX. Motif: UratTangan. Ketebalan: 0.9 mm. Backing: Putih. Merek: MC.',
        ], [
            'nama' => 'Vario(M)', // 28
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: MAX. Ketebalan: 0.9 mm. Backing: Biru, polos.',
        ], [
            'nama' => 'Vario(MC)', // 29
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: MAX. Ketebalan 0.9 mm, backing belakang putih, merek MC.',
        ], [
            'nama' => 'Vario(MCR)', // 30
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap).',
        ], [
            'nama' => 'Vario(RY)', // 31
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Biru, merek MC new (bersayap). Spek sama dengan Vario(MCR), bedanya cuma di backing saja.',
        ], [
            'nama' => 'Vario Biru', // 32
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap). Spek sama dengan Vario(MCR).',
        ], [
            'nama' => 'Vario Coklat', // 33
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap). Spek sama dengan Vario(MCR).',
        ], [
            'nama' => 'Vario Merah', // 34
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap). Spek sama dengan Vario(MCR).',
        ], [
            'nama' => 'Vario Putih', // 35
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap). Spek sama dengan Vario(MCR).',
        ], [
            'nama' => 'Vario Warna', // 36
            'grade' => 'A',
            'harga' => 14500,
            'keterangan' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap). Spek sama dengan Vario(MCR).',
        ], [
            'nama' => 'ZEUS(BD)', // 37
            'grade' => null,
            'harga' => 30500,
            'keterangan' => 'Pengambilan dari: Fajar Baru. Ketebalan 1.3 mm. Backing: Putih, merek ZEUS. Bahan kualitas premium menyerupai MBtech, dengan harga lebih murah, sehingga mendapat julukan MBtech Killer.',
        ], [
            'nama' => 'ZEUS(KJ)', // 38
            'grade' => null,
            'harga' => 30500,
            'keterangan' => 'Pengambilan dari: Fajar Baru. Ketebalan 1.3 mm. Backing: Putih, merek ZEUS. Bahan kualitas premium menyerupai MBtech, dengan harga lebih murah, sehingga mendapat julukan MBtech Killer.',
        ]];

        for ($i = 0; $i < count($bahan); $i++) {
            $new_inserted_bahan = Bahan::create([
                'nama' => $bahan[$i]['nama'],
                'grade' => $bahan[$i]['grade'],
                'keterangan' => $bahan[$i]['keterangan'],
            ]);
            DB::table('bahan_hargas')->insert([
                'bahan_id' => $new_inserted_bahan['id'],
                'harga' => $bahan[$i]['harga']
            ]);
        }
    }
}
