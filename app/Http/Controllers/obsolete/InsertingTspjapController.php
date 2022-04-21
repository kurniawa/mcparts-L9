<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Bahan;
use App\Models\SiteSetting;
use App\Models\TempSpkProduk;
use App\Models\Tspjap;
use Illuminate\Http\Request;

class InsertingTspjapController extends Controller
{
    public function inserting_tspjap()
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $tspjap = new Tspjap();
        $label_tspjaps = $tspjap->label_tspjaps();
        $bahan = new Bahan();
        $d_bahan_a = $bahan->d_bahan_a();
        $d_bahan_b = $bahan->d_bahan_b();

        $data = [
            'judul' => 'SJ T.SixPack/Japstyle',
            'tipe' => 'tspjap',
            'd_bahan_a' => $d_bahan_a,
            'd_bahan_b' => $d_bahan_b,
            'tspjaps' => $label_tspjaps,
            'mode' => 'SPK_BARU',
            'spk_item' => null,
            'produk' => null,
            'link_insert_db' => 'inserting-tspjap-db',
        ];

        if ($show_dump) {
            dump('$data:', $data);
        }

        return view('spk.inserting_spk_item-2', $data);
    }

    public function inserting_tspjap_db(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = true; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = false; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = false;
        $ada_error = true;
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump) {
            dump('$post: ', $post);
        }

        $request->validate([
            'tipe_bahan' => 'required',
            'bahan' => 'required',
            'tspjap_id' => 'required',
            'jumlah' => 'required|numeric|min:1',
        ]);

        $tipe = $post['tipe'];
        $jumlah = $post['jumlah'];
        $ktrg = null;
        $bahan_id = $variasi_id = $ukuran_id = $jahit_id = null;
        $tspjap_id = $busastang_id = $tankpad_id = $spjap_id = $tipe_bahan = $stiker_id = null;

        if (isset($post['tspjap_id'])) {
            $tspjap_id = $post['tspjap_id'];
        }
        if (isset($post['ktrg'])) {
            $ktrg = $post['ktrg'];
        }

        $nama = $post['tspjap'];
        $harga = $post['tspjap_harga'];
        $tipe_bahan = $post['tipe_bahan'];
        $bahan = $post['bahan'];
        if ($bahan !== null) {
            $nama = "$bahan $nama";
        } else {
            $nama = "Bahan($tipe_bahan) $nama";
        }
        $nama_nota = $nama;

        // MELENGKAPI NAMA NOTA SEKALI LAGI
        $nama_nota = "SJ $nama_nota";

        if ($show_dump) {
            dump('$tipe', $tipe);
            dump('$harga', $harga);
            dump('$nama_nota', $nama_nota);
            dump('$nama', $nama);
        }

        $spk_item = null;
        if ($run_db) {
            $spk_item = TempSpkProduk::create([
                'tipe' => $tipe,
                'tspjap_id' => $tspjap_id,
                'nama' => $nama,
                'nama_nota' => $nama_nota,
                'jumlah' => $jumlah,
                'harga' => $harga,
                'ktrg' => $ktrg,
            ]);

            $load_num->value =+ 1;
            $load_num->save();

            // dd($spk_item);

            $pesan_db = "SUCCESS: Item $spk_item[nama_nota] berhasil di input ke dalam SPK!";
            $ada_error = false;
            $class_div_pesan_db = 'alert-success';
        }

        $data = [
            'spks' => $post,
            'spk_item' => $spk_item,
            'go_back_number' => -2,
            'pesan_db' => $pesan_db,
            'ada_error' => $ada_error,
            'class_div_pesan_db' => $class_div_pesan_db
        ];

        return view('layouts.go-back-page', $data);
    }
}
