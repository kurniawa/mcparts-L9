<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Produk;
use App\Models\SiteSetting;
use App\Models\TempSpkProduk;
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


        // $mode = $get['mode'];


        $data = [
            'spk_id' => $spk_id,
            // 'mode' => $mode,
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

        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $error_logs=$warning_logs=$success_logs = array();

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        dump('$post: ', $post);
        $user=auth()->user();

        if ($run_db) {
            $tempspkproduk_new = TempSpkProduk::create([
                'user_id'=>$user['id'],
                'produk_id' => $post['produk_id'],
                'jumlah' => $post['jumlah'],
            ]);
            $load_num->value += 1;
            $load_num->save();
            $produk = Produk::find($tempspkproduk_new['produk_id']);
            $success_logs[] = "Item $produk[nama] telah berhasil diinput ke temp_spk_produks";
            $pesan_db = "Succeed!";
        }

        $route = 'SPK-Review';
        $route_btn='Ke Review SPK';
        $data = [
            'go_back_number' => -2,
            'pesan_db' => $pesan_db,
            'error_logs' => $error_logs,
            'warning_logs' => $warning_logs,
            'success_logs' => $success_logs,
            'route' => $route,
            'route_btn' => $route_btn,
        ];

        return view('layouts.db-result', $data);
    }
}
