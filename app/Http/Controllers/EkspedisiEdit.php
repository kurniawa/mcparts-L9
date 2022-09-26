<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EkspedisiEdit extends Controller
{
    public function ekspedisi_edit(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $get = $request->query();
        // dump($get);

        $ekspedisi = Ekspedisi::find($get['ekspedisi_id']);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'ekspedisi' => $ekspedisi
        ];

        return view('ekspedisi.ekspedisi-edit', $data);
    }

    public function ekspedisi_edit_db(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $success_logs=$warning_logs=$error_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[]='WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dd('$post: ', $post);
        $nama=$post['nama_ekspedisi'];
        $bentuk=$post['bentuk_perusahaan'];
        $ktrg=$post['keterangan'];


        if ($run_db) {
            $ekspedisi = Ekspedisi::find($post['ekspedisi_id']);
            $ekspedisi->bentuk = $bentuk;
            $ekspedisi->nama = $nama;
            $ekspedisi->ktrg = $ktrg;
            $ekspedisi->save();
            $success_logs[]="Data Ekspedisi telah diupdate.";

            $load_num->value += 1;
            $load_num->save();

            $main_log = "SUCCESS";
        }

        $route='DetailEkspedisi';
        $route_btn='Ke Detail Ekspedisi';
        $params=['ekspedisi_id'=>$ekspedisi['id']];

        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }

    public function tambah_alamat(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $get = $request->query();
        // dump($get);

        $ekspedisi = Ekspedisi::find($get['ekspedisi_id']);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'ekspedisi' => $ekspedisi
        ];

        return view('ekspedisi.tambah_alamat', $data);
    }

    public function tambah_kontak(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $get = $request->query();
        // dump($get);

        $ekspedisi = Ekspedisi::find($get['ekspedisi_id']);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'ekspedisi' => $ekspedisi
        ];

        return view('ekspedisi.tambah_kontak', $data);
    }

    public function ekspedisi_hapus(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $success_logs=$warning_logs=$error_logs=array();
        $main_log=null;
        $run_db = true; // true apabila siap melakukan CRUD ke DB

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        $ekspedisi_id=$post['ekspedisi_id'];

        // dd('$post: ', $post);

        if ($run_db === true) {
            $ekspedisi = Ekspedisi::find($ekspedisi_id);
            $ekspedisi->delete();
            $warning_logs[]="Ekspedisi $ekspedisi[nama] berhasil dihapus!";
            $main_log='SUCCESS';
            $load_num->value += 1;
            $load_num->save();
        }

        $route='Ekspedisis';
        $route_btn='Ke Daftar Ekspedisi';
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,
        ];

        return view('layouts.db-result', $data);
    }
}
