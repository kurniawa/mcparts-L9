<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PelangganEkspedisiController extends Controller
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
        $run_db = false;
        $load_num_ignore = true;

        if ($show_hidden_dump === true) {
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }


        if ($show_dump === true) {
        }


        $data = [

        ];

        if ($show_dump === true) {
            dump("data: ", $data);
        }
        return view('pelanggan.pelanggan-ekspedisi', $data);
    }
}
