<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Bahan;
use App\Models\Jahit;
use App\Models\SiteSetting;
use App\Models\TempSpkProduk;
use App\Models\Ukuran;
use App\Models\Variasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsertingVariaController extends Controller
{
    public function inserting_varia()
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $bahan = new Bahan();
        $varia = new Variasi();
        $ukuran = new Ukuran();
        $jahit = new Jahit();

        $label_bahans = $bahan->label_bahans();
        $varias_harga = $varia->varias_harga();
        $ukurans_harga = $ukuran->ukurans_harga();
        $jahits_harga = $jahit->jahits_harga();

        $att_varia = [
            'label_bahans' => $label_bahans,
            'varias_harga' => $varias_harga,
            'ukurans_harga' => $ukurans_harga,
            'jahits_harga' => $jahits_harga,
        ];

        // dump($label_bahans);
        // dump($varias_harga);
        // dump($ukurans_harga);
        // dump($jahits_harga);

        $data = [
            'tipe' => 'varia',
            'bahans' => $label_bahans,
            'varias' => $varias_harga,
            'ukurans' => $ukurans_harga,
            'jahits' => $jahits_harga,
            'att_varia' => $att_varia,
            'mode' => 'SPK_BARU',
            'spk_item' => null,
            'produk' => null,
            'link_insert_db' => 'inserting-varia-db',
        ];
        return view('/spk/inserting_spk_item-2', $data);
    }

    public function inserting_varia_db(Request $request)
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
            'bahan' => 'required',
            'variasi' => 'required',
            'jumlah' => 'required|numeric|min:1',
        ]);

        /**
         * Menentukan semua variable yang nantinya akan diinsert ke table temp_spk_item
         * Banyak variable akan di set value nya menjadi NULL
         */
        /*
        $table->id();
        $table->string('tipe', 50);
        $table->foreignId('bahan_id')->nullable();
        $table->foreignId('variasi_id')->nullable();
        $table->foreignId('ukuran_id')->nullable();
        $table->foreignId('jahit_id')->nullable();
        $table->foreignId('std_id')->nullable();
        $table->foreignId('kombi_id')->nullable();
        $table->foreignId('busastang_id')->nullable();
        $table->foreignId('tankpad_id')->nullable();
        $table->foreignId('spjap_id')->nullable();
        $table->foreignId('stiker_id')->nullable();
        $table->string('nama');
        $table->string('nama_nota');
        $table->string('jumlah');
        $table->integer('harga');
        $table->string('ktrg')->nullable();
        */

        $tipe = $post['tipe'];
        $jumlah = $post['jumlah'];
        $ktrg = null;
        $bahan_id = $variasi_id = $ukuran_id = $jahit_id = null;
        $standar_id = $kombi_id = $busastang_id = $tankpad_id = $spjap_id = $tipe_bahan = $stiker_id = null;

        if (isset($post['bahan_id'])) {
            $bahan_id = $post['bahan_id'];
        }
        if (isset($post['ukuran_id'])) {
            $ukuran_id = $post['ukuran_id'];
        }
        if (isset($post['jahit_id'])) {
            $jahit_id = $post['jahit_id'];
        }
        if (isset($post['ktrg'])) {
            $ktrg = $post['ktrg'];
        }

        // dd($tipe);

        $variasi = json_decode($post['variasi'], true);
        $variasi_id = $variasi['id'];
        $harga = $post['bahan_harga'] + $variasi['harga'];
        $nama = "$post[bahan] $variasi[nama]";
        $nama_nota = $nama;
        // dd($variasi);


        if (isset($post['ukuran'])) {
            $ukuran = json_decode($post['ukuran'], true);
            $harga += $ukuran['harga'];
            $nama .= " uk.$ukuran[nama]";
            $nama_nota .= " uk.$ukuran[nama_nota]";
            $ukuran_id = $ukuran['id'];
        }
        if (isset($post['jahit'])) {
            $jahit = json_decode($post['jahit'], true);
            $harga += $jahit['harga'];
            $nama .= " + jht.$jahit[nama]";
            $nama_nota .= " + jht.$jahit[nama]";
            $jahit_id = $jahit['id'];
        }

        // MELENGKAPI NAMA NOTA SEKALI LAGI
        $nama_nota = "SJ $nama_nota";

        if ($show_dump) {
            dump('$tipe', $tipe);
            dump('$variasi', $variasi);
            dump('$harga', $harga);
            dump('$nama_nota', $nama_nota);
            dump('$nama', $nama);
        }

        $spk_item = null;
        if ($run_db) {
            $spk_item = TempSpkProduk::create([
                'tipe' => $tipe,
                'bahan_id' => $bahan_id,
                'variasi_id' => $variasi_id,
                'ukuran_id' => $ukuran_id,
                'jahit_id' => $jahit_id,
                'nama' => $nama,
                'nama_nota' => $nama_nota,
                'jumlah' => $jumlah,
                'harga' => $harga,
                'ktrg' => $ktrg,
            ]);

            $load_num->value =+ 1;
            $load_num->save();

            // dd($spk_item);

            $pesan_db = "SUCCESS: Item<br><br><span style='font-weight:bold'>$spk_item[nama_nota]</span><br></br>berhasil di input ke dalam SPK!";
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
