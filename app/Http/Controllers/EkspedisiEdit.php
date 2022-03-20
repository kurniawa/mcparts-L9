<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class EkspedisiEdit extends Controller
{
    public function ekspedisi_edit(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $show_dump = true; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = false; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = true; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = true;

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }

        $get = $request->input();

        if ($show_dump === true) {
            dump("get");
            dump($get);
        }

        $ekspedisi = Ekspedisi::find($get['ekspedisi_id']);

        $data = [
            'ekspedisi' => $ekspedisi
        ];

        return view('ekspedisi.ekspedisi-edit', $data);
    }

    public function ekspedisi_edit_db(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = true; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = false; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = true;

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }

        $post = $request->input();
        $ekspedisi = Ekspedisi::find($post['ekspedisi_id']);
        $arr_alamat_eks = $post['alamat_ekspedisi'];
        $bentuk_perusahaan = null;
        if (isset($post['bentuk_perusahaan']) && $post['bentuk_perusahaan'] !== null && $post['bentuk_perusahaan'] !== '') {
            $bentuk_perusahaan = $post['bentuk_perusahaan'];
        }

        if ($show_dump === true) {
            dump('$post: ', $post);
            dump('count($arr_alamat_eks)', count($arr_alamat_eks));
        }

        $alamat_ekspedisi = "";

        $i_arrAlamatEks = 0;
        foreach ($arr_alamat_eks as $alamat_eks) {
            if ($alamat_eks === null || $alamat_eks === "") {
                # Kalau tidak diisi, maka tidak perlu ada yang diinput
            } else {
                if ($i_arrAlamatEks !== 0) {
                    $alamat_ekspedisi .= "[br]";
                }
                $alamat_ekspedisi .= $alamat_eks;
            }
            $i_arrAlamatEks++;
        }

        $keterangan = $post['keterangan'];

        if ($keterangan === null || $keterangan === '') {
            $keterangan = null;
        }

        $ekspedisi->bentuk = $bentuk_perusahaan;
        $ekspedisi->nama = $post['nama_ekspedisi'];
        $ekspedisi->alamat = $alamat_ekspedisi;
        $ekspedisi->no_kontak = $post['kontak_ekspedisi'];
        $ekspedisi->ktrg = $keterangan;
        if ($run_db === true) {
            $ekspedisi->save();
        }

        $data = [
            'go_back_number' => -2,
        ];

        $load_num->value += 1;
        $load_num->save();
        return view('layouts.go-back-page', $data);
    }

    public function ekspedisi_hapus(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = true; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = false; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = true;

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }

        $post = $request->input();

        if ($show_dump === true) {
            dump('$post: ', $post);
        }

        $ekspedisi = Ekspedisi::find($post['id']);

        if ($run_db === true) {
            $ekspedisi->delete();
        }

        $data = [
            'go_back_number' => -2
        ];

        $load_num->value += 1;
        $load_num->save();

        return view('layouts.go-back-page', $data);
    }
}
