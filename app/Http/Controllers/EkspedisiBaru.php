<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class EkspedisiBaru extends Controller
{
    public function index()
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }
        $all_ekspedisi = Ekspedisi::orderBy('nama')->get();

        $data = [
            'all_ekspedisi' => $all_ekspedisi,
        ];
        return view('ekspedisi.ekspedisi-baru', $data);
    }

    public function ekspedisi_baru_db(Request $request)
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

        if ($run_db === true) {
            Ekspedisi::create([
                'bentuk' => $post['bentuk_perusahaan'],
                'nama' => $post['nama_ekspedisi'],
                'alamat' => $post['alamat_ekspedisi'],
                'no_kontak' => $post['kontak_ekspedisi'],
            ]);
        }

        $data = [
            'go_back_number' => -2
        ];

        $load_num->value += 1;
        $load_num->save();
        return view('layouts.go-back-page', $data);
    }
}
