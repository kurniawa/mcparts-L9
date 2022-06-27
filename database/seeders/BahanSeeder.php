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
            'nama' => 'Amplas(CA)',
            'grade' => null,
            'harga' => 16500,
            'ktrg' => 'Dinamakan CA karena seperti mengandung bahan CA. Pengambilan dari MAX. Backing warna putih, tanpa merek. Nama lain pasir adalah Amplas.',
        ], [
            'nama' => 'Amplas(MCR)',
            'grade' => null,
            'harga' => 16500,
            'ktrg' => 'Pengambilan dari Royal. Backing warna putih, merek MC (logo new bersayap).',
        ], [
            'nama' => 'Amplas(RY)',
            'grade' => null,
            'harga' => 16500,
            'ktrg' => 'Pengambilan dari Royal. Backing warna abu, merek MC (logo new bersayap). Tidak dinamakan MC karena sudah tau, Amplas dari Royal pasti ada merek',
        ], [
            'nama' => 'Amplas(SBT)',
            'grade' => null,
            'harga' => 19000,
            'ktrg' => 'Pengambilan dari Toko Sumber Maju Dunia, Tanah Abang. Bahan premium merek SB-Tech.',
        ], [
            'nama' => 'Big Dot(CK)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Big Dot dengan backing warna Coklat, tanpa merek. Pengambilan dari MAX.',
        ], [
            'nama' => 'Big Dot(MC)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Big Dot dengan merek MC. Pengambilan dari MAX',
        ], [
            'nama' => 'Big Dot(MCR)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Big Dot dengan merek MC (logo new bersayap), backing warna putih. Pengambilan dari Royal.',
        ], [
            'nama' => 'C24',
            'grade' => 'B',
            'harga' => 13000,
            'ktrg' => 'Motif: Biji Kopi, ketebalan nya 0.7 mm. Dulu keterangan ketebalan masih ditulis, sekarang tidak lagi ditulis, karena sudah pasti demikian dan untuk menghindari percekcokan dengan pelanggan. Nama lain C24 adalah Vario 0.7, nanti penamaan di Nota tergantung pelanggan.',
        ], [
            'nama' => 'C30(MC)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Bahan dengan motif C30 (bintik-bintik kecil), ketebalan: 0.9 mm. Merek MC. Pengambilan dari MAX.',
        ], [
            'nama' => 'C38(EX)', // ?
            'grade' => 'A',
            'harga' => 14500
        ], [
            'nama' => 'C38(MC)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Bahan dengan motif C38 (mirip Big Dot namun bentuk nya agak oval), ketebalan: 0.9 mm. Merek MC. Pengambilan dari MAX.',
        ], [
            'nama' => 'Carbon',
            'grade' => null,
            'harga' => 19000,
            'ktrg' => 'Ketebalan: 0.8 mm. Merek MC (logo baru bersayap). Backing: Biru. Pengambilan dari Royal. Tidak ada keterangan RY, karena memang saat ini hanya Royal yang memproduksi bahan dengan motif ini. Oleh karena itu tidak perlu tertulis code yang membedakan.',
        ], [
            'nama' => 'Graffiti',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Ketebalan: 0.8 mm. Merek MC (logo baru bersayap). Backing: Biru. Pengambilan dari Royal. Tidak ada keterangan RY, karena memang saat ini hanya Royal yang memproduksi bahan dengan motif ini. Oleh karena itu tidak perlu tertulis code yang membedakan.',
        ], [
            'nama' => 'Kulit Jeruk',
            'grade' => 'B',
            'harga' => 13000,
            'ktrg' => 'Backing: Putih. Ketebalan: 0.7 mm. Pengambilan dari MAX.',
        ], [
            'nama' => 'Kulit Jeruk(CK)(RY)',
            'grade' => 'B',
            'harga' => 13000,
            'ktrg' => 'Motif: Kulit Jeruk, tekstur terlihat sedikit berbeda dibandingkan dengan tekstur Kulit Jeruk dari MAX. Backing: Coklat. Pengambilan dari Royal.',
        ], [
            'nama' => 'L55(CK)', // L55(CK)/OSBAC
            'grade' => 'B',
            'harga' => 13000,
            'ktrg' => 'Motif: Kulit Jeruk. Ketebalan: 0.7 mm. Backing: Coklat. Pengambilan dari MAX. Dulu namanya OSBAC yang ambil dari Royal dimana tekstur Kulit Jeruk nya juga yang Kulit Jeruk Royal. Karena tidak lagi ambil dari Royal, maka tidak perlu lagi ada penamaan tambahan seperti L55/OSBAC. Namun apabila ada ambil lagi dari Royal, mungkin bahan tersebut akan jadi OSBAC(RY). Waktu itu tidak ambil OSBAC lagi dari Royal karena ketebalan OSBAC: 0.8 mm. Lalu ada bahan baru dengan nama Navaro yang mirip OSBAC, cuma beda di ketebalan nya saja, yakni Navaro lebih tebal, namun dengan harga yang tidak berbeda jauh, sehingga pelanngan lebih memilih Navaro',
        ], [
            'nama' => 'L55(MC)',
            'grade' => 'A',
            'harga' => 12000,
            'ktrg' => 'Motif: Kulit Jeruk. Ketebalan: 0.9 mm. Backing: Putih. Merek: MC, pengambilan dari MAX.',
        ], [
            'nama' => 'LuckyHole',
            'grade' => 'B',
            'harga' => 12500,
            'ktrg' => 'Pengambilan dari: Toko Baru. Ketebalan: ~ 0.65 mm. Backing: Putih, polos. Pengambilan bukan dari pabrik, ini produk import.',
        ], [
            'nama' => 'LuckyHole(FB)',
            'grade' => 'B',
            'harga' => 12500,
            'ktrg' => 'Seperti selayaknya LuckyHole biasa namun pengambilan dari Fajar Baru.',
        ], [
            'nama' => 'LuckyHole Biru',
            'grade' => 'B',
            'harga' => 12500,
            'ktrg' => 'Pengambilan dari: Toko Baru. Ketebalan: ~ 0.65 mm. Backing: Putih, polos. Pengambilan bukan dari pabrik, ini produk import.',
        ], [
            'nama' => 'LuckyHole Merah',
            'grade' => 'B',
            'harga' => 12500,
            'ktrg' => 'Pengambilan dari: Toko Baru. Ketebalan: ~ 0.65 mm. Backing: Putih, polos. Pengambilan bukan dari pabrik, ini produk import.',
        ], [
            'nama' => 'LuckyHole Warna',
            'grade' => 'B',
            'harga' => 12500,
            'ktrg' => 'Seperti selayaknya LuckyHole biasa namun warna nya campur.',
        ], [
            'nama' => 'MBtech(BD)',
            'grade' => null,
            'harga' => 41000,
            'ktrg' => 'Pengambilan dari: Fajar Baru. Motif Big Dot. Ketebalan: ~ 1.3 mm. Backing: Putih, merek MB-tech. Bahan kualitas super premium (lebih premium dari SB-Tech).',
        ], [
            'nama' => 'MBtech(KJ)',
            'grade' => null,
            'harga' => 41000,
            'ktrg' => 'Pengambilan dari: Fajar Baru. Motif Kulit Jeruk. Ketebalan: ~ 1.3 mm. Backing Putih, merek MB-tech . Bahan kualitas super premium (lebih premium dari SB-Tech).',
        ], [
            'nama' => 'MBtech(RD)',
            'grade' => null,
            'harga' => 41000,
            'ktrg' => 'Pengambilan dari: Fajar Baru. Motif: Rider (mirip Carbon, bedanya Carbon mengkilap, kalo Rider tidak mengkilap). Ketebalan: ~ 1.3 mm. Backing Putih, merek MB-tech . Bahan kualitas super premium (lebih premium dari SB-Tech).',
        ], [
            'nama' => 'Navaro(MC)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Motif: Kulit Jeruk. Ketebalan: 1 mm. Backing: Coklat. Merek MC. Pengambilan dari MAX. Penamaan Navaro karena dari lagganan.',
        ], [
            'nama' => 'Urat Tangan(MC)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Pengambilan dari: MAX. Motif: Urat Tangan. Ketebalan: 0.9 mm. Backing: Putih. Merek: MC.',
        ], [
            'nama' => 'Vario(M)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Pengambilan dari: MAX. Ketebalan: 0.9 mm. Backing: Biru, polos.',
        ], [
            'nama' => 'Vario(MC)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Pengambilan dari: MAX. Ketebalan 0.9 mm, backing belakang putih, merek MC.',
        ], [
            'nama' => 'Vario(MCR)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap).',
        ], [
            'nama' => 'Vario(RY)',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Biru, merek MC new (bersayap). Spek sama dengan Vario(MCR), bedanya cuma di backing saja.',
        ], [
            'nama' => 'Vario Biru',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap). Spek sama dengan Vario(MCR).',
        ], [
            'nama' => 'Vario Coklat',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap). Spek sama dengan Vario(MCR).',
        ], [
            'nama' => 'Vario Merah',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap). Spek sama dengan Vario(MCR).',
        ], [
            'nama' => 'Vario Putih',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap). Spek sama dengan Vario(MCR).',
        ], [
            'nama' => 'Vario Warna',
            'grade' => 'A',
            'harga' => 14500,
            'ktrg' => 'Pengambilan dari: Royal. Ketebalan 0.8 mm, Backing: Putih, merek MC new (bersayap). Spek sama dengan Vario(MCR).',
        ], [
            'nama' => 'ZEUS(BD)',
            'grade' => null,
            'harga' => 30500,
            'ktrg' => 'Pengambilan dari: Fajar Baru. Ketebalan 1.3 mm. Backing: Putih, merek ZEUS. Bahan kualitas premium menyerupai MBtech, dengan harga lebih murah, sehingga mendapat julukan MBtech Killer.',
        ], [
            'nama' => 'ZEUS(KJ)',
            'grade' => null,
            'harga' => 30500,
            'ktrg' => 'Pengambilan dari: Fajar Baru. Ketebalan 1.3 mm. Backing: Putih, merek ZEUS. Bahan kualitas premium menyerupai MBtech, dengan harga lebih murah, sehingga mendapat julukan MBtech Killer.',
        ], [

        ]];

        for ($i = 0; $i < count($bahan); $i++) {
            $new_inserted_bahan = Bahan::create([
                'nama' => $bahan[$i]['nama'],
                'grade' => $bahan[$i]['grade'],
                'ktrg' => $bahan[$i]['ktrg'],
            ]);
            DB::table('bahan_hargas')->insert([
                'bahan_id' => $new_inserted_bahan['id'],
                'harga' => $bahan[$i]['harga']
            ]);
        }
    }
}
