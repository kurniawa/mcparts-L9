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
}
