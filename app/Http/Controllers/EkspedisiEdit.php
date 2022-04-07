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

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = false; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = true; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = false;

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
        }

        $get = $request->input();

        if ($show_dump) {
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

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
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

        $post = $request->input();
        $ekspedisi = Ekspedisi::find($post['ekspedisi_id']);
        $bentuk_perusahaan = null;
        if (isset($post['bentuk_perusahaan']) && $post['bentuk_perusahaan'] !== null && $post['bentuk_perusahaan'] !== '') {
            $bentuk_perusahaan = $post['bentuk_perusahaan'];
        }

        if ($show_dump) {
            dump('$post: ', $post);
        }

        // $alamat_ekspedisi = json_encode(Arr::whereNotNull($post['alamat_ekspedisi']));
        $alamat_ekspedisi = json_encode(array_filter($post['alamat_ekspedisi']));

        $keterangan = $post['keterangan'];

        if ($keterangan === null || $keterangan === '') {
            $keterangan = null;
        }

        if ($run_db === true) {
            $ekspedisi->bentuk = $bentuk_perusahaan;
            $ekspedisi->nama = $post['nama_ekspedisi'];
            $ekspedisi->alamat = $alamat_ekspedisi;
            $ekspedisi->no_kontak = $post['kontak_ekspedisi'];
            $ekspedisi->ktrg = $keterangan;
            $ekspedisi->save();

            $load_num->value += 1;
            $load_num->save();

            $pesan_db = "SUCCESS: Data $ekspedisi[nama] berhasil diubah!";
            $ada_error = false;
            $class_div_pesan_db = 'alert-success';
        }

        $data = [
            'go_back_number' => -2,
            'pesan_db' => $pesan_db,
            'ada_error' => $ada_error,
            'class_div_pesan_db' => $class_div_pesan_db
        ];

        return view('layouts.go-back-page', $data);
    }

    public function ekspedisi_hapus(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = false; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = false;

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
        }

        $post = $request->input();

        if ($show_dump) {
            dump('$post: ', $post);
        }

        $ekspedisi = Ekspedisi::find($post['id']);

        if ($run_db === true) {
            $ekspedisi->delete();
        }

        $data = [
            'go_back_number' => -2
        ];


        if ($run_db) {
            $load_num->value += 1;
            $load_num->save();
        }
        return view('layouts.go-back-page', $data);
    }
}
