<?php

namespace App\Helpers;

use App\Models\Produk;
use App\Models\ProdukHarga;
use App\Models\SiteSetting;
use App\Models\SpkProduk;
use App\Models\TempSpkProduk;
use Illuminate\Support\Facades\DB;

class InsertingProductHelper {

    static function InsertingToTempSpkProduks($show_dump, $run_db, $pesan_db, $ada_error, $class_div_pesan_db, $success_logs, $tipe, $bahan_id, $variasi_id, $ukuran_id, $jahit_id, $kombi_id, $standar_id, $tankpad_id, $busastang_id, $tspjap_id, $tipe_bahan, $stiker_id, $nama, $nama_nota, $jumlah, $harga, $ktrg)
    {
        if ($run_db) {
            $inserted_product = TempSpkProduk::create([
                'tipe' => $tipe,
                'bahan_id' => $bahan_id,
                'variasi_id' => $variasi_id,
                'ukuran_id' => $ukuran_id,
                'jahit_id' => $jahit_id,
                'kombi_id' => $kombi_id,
                'standar_id' => $standar_id,
                'tankpad_id' => $tankpad_id,
                'busastang_id' => $busastang_id,
                'tspjap_id' => $tspjap_id,
                'tipe_bahan' => $tipe_bahan,
                'stiker_id' => $stiker_id,
                'nama' => $nama,
                'nama_nota' => $nama_nota,
                'jumlah' => $jumlah,
                'harga' => $harga,
                'ktrg' => $ktrg,
            ]);

            $pesan_db = 'SUCCESS: Berhasil input ke dalam temp_spk_produk';
            $ada_error = false;
            $class_div_pesan_db = 'alert-success';

            array_push($success_logs, "success_message: Item $inserted_product[nama_nota] berhasil di input ke dalam temp_spk_produk!");

        }

        return array($pesan_db, $ada_error, $class_div_pesan_db, $success_logs);
    }

    static function InsertingFromDetail($show_dump, $run_db, $load_num, $mode, $tipe, $bahan_id, $variasi_id, $ukuran_id, $jahit_id, $kombi_id, $standar_id, $tankpad_id, $busastang_id, $tspjap_id, $tipe_bahan, $stiker_id, $nama, $nama_nota, $jumlah, $harga, $ktrg, $spk, $jumlah_total, $harga_total, $success_logs)
    {
        // MENENTUKAN PROPERTIES UNTUK PRODUK BARU DAN MENYEDERHANAKAN DATA PRODUK

        // APABILA EXIST MAKA PERLU DI UPDATE HARGA LAMA NYA.
        $produk = Produk::where('nama', '=', $nama)->first();
        if ($produk !== null) {
            array_push($success_logs, "success_message: $produk[nama] ditemukan sudah ada di database. Tidak ada penambahan produk baru ke database!");

            $produk_harga = ProdukHarga::latest()->where('produk_id', '=', $produk['id'])->first();

            $produk_id = $produk_harga['produk_id'];

            if ($produk_harga['harga'] !== $harga) {
                if ($run_db) {
                    $produk_id = DB::table('produk_hargas')->insertGetId([
                        'produk_id' => $produk['id'],
                        'harga' => $harga,
                    ]);

                    array_push($success_logs, 'success_message: Ada perbedaan harga, harga terbaru berhasil diupdate!');
                }

            }
        } else {
            if ($run_db) {
                $produk = Produk::create([
                    'tipe' => $tipe,
                    'bahan_id' => $bahan_id,
                    'variasi_id' => $variasi_id,
                    'ukuran_id' => $ukuran_id,
                    'jahit_id' => $jahit_id,
                    'standar_id' => $standar_id,
                    'kombi_id' => $kombi_id,
                    'busastang_id' => $busastang_id,
                    'tankpad_id' => $tankpad_id,
                    'tspjap_id' => $tspjap_id,
                    'tipe_bahan' => $tipe_bahan,
                    'stiker_id' => $stiker_id,
                    'nama' => $nama,
                    'nama_nota' => $nama_nota,
                ]);
                DB::table('produk_hargas')->insert([
                    'produk_id' => $produk['id'],
                    'harga' => $harga,
                ]);

                array_push($success_logs, "SUCCESS: Item $produk[nama] merupakan produk baru dan berhasil di tambahkan ke dalam database.");
            }

        }

        if ($run_db) {
            // UPDATE RELASI DENGAN spk_produks
            $spk_produk = SpkProduk::create([
                'spk_id' => $spk['id'],
                'produk_id' => $produk['id'],
                'jumlah' => $jumlah,
                'harga' => $harga,
                'ktrg' => $ktrg,
                'status' => 'PROSES',
            ]);

            array_push($success_logs, 'success: Relasi spk_produks berhasil dibentuk!');

            if ($mode === 'ADD PRODUCT FROM DETAIL') {
                $spk->jumlah_total = $jumlah_total;
                $spk->harga_total = $harga_total;
                $spk->save();
            }

            $load_num->value =+ 1;
            $load_num->save();

            $pesan_db = "SUCCESS: Item $nama_nota berhasil di input ke dalam $spk[no_spk]!";
            $ada_error = false;
            $class_div_pesan_db = 'alert-success';
        }

        return array($pesan_db, $ada_error, $class_div_pesan_db, $success_logs);
    }

}

?>
