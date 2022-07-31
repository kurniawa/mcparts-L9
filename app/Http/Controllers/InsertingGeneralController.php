<?php

namespace App\Http\Controllers;

use App\Helpers\InsertingProductHelper;
use App\Helpers\SiteSettings;
use App\Models\Attsjvariasi;
use App\Models\Bahan;
use App\Models\Busastang;
use App\Models\Jahit;
use App\Models\Japstyle;
use App\Models\Kombinasi;
use App\Models\Motif;
use App\Models\Produk;
use App\Models\SiteSetting;
use App\Models\Spec;
use App\Models\Spk;
use App\Models\Standar;
use App\Models\Stiker;
use App\Models\Tankpad;
use App\Models\TempSpkProduk;
use App\Models\Tsixpack;
use App\Models\Tspjap;
use App\Models\Ukuran;
use App\Models\Varian;
use App\Models\Variasi;
use Illuminate\Http\Request;

class InsertingGeneralController extends Controller
{
    public function inserting_general(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('$get:', $get);
        }

        $spk_id = null; // Kalo mode SPK_BARU nilainya nanti null
        if (isset($get['spk_id'])) {
            $spk_id = $get['spk_id'];
        }

        $produk = new Produk();

        $label_produks = $produk->label_produks();


        $mode = $get['mode'];


        $data = [
            'spk_id' => $spk_id,
            'mode' => $mode,
            'produks' => $label_produks,
        ];

        if ($show_dump) {
            dump('$data:', $data);
        }

        return view('spk.inserting-general', $data);
    }

    public function inserting_general_db (Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $show_hidden_dump = false;
        $ada_error = true;
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';
        $error_messages = array();
        $success_messages = array();

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump) {
            dump('$post: ', $post);
        }

        if ($run_db) {
            $tempspkproduk_new = TempSpkProduk::create([
                'produk_id' => $post['produk_id'],
                'jumlah' => $post['jumlah'],
            ]);
            $load_num->value += 1;
            $load_num->save();
            $produk = Produk::find($tempspkproduk_new['produk_id']);
            $success_messages[] = "Item $produk[nama] telah berhasil diinput ke temp_spk_produks";
            $pesan_db = "Succeed!";
        }

        $data = [
            'go_back_number' => -2,
            'pesan_db' => $pesan_db,
            'ada_error' => $ada_error,
            'class_div_pesan_db' => $class_div_pesan_db,
            'error_messages' => $error_messages,
            'success_messages' => $success_messages,
        ];

        return view('layouts.go-back-page', $data);
    }
}
