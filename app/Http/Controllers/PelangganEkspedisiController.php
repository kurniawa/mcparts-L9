<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\PelangganEkspedisi;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PelangganEkspedisiController extends Controller
{
    public function index(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $show_dump = true;
        $show_hidden_dump = false;
        $run_db = false;
        $load_num_ignore = true;

        if ($show_hidden_dump === true) {
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }

        $get = $request->query();

        if ($show_dump === true) {
            dump('$get:', $get);
        }

        $pelanggan = Pelanggan::find($get['pelanggan_id']);

        if ($show_dump) {
            dump('$pelanggan:', $pelanggan);
            dump('$ekspedisis:', $pelanggan->ekspedisis);
            dump('$pelanggan_ekspedisis', $pelanggan->pelanggan_ekspedisis);
        }


        $data = [
            'pelanggan' => $pelanggan,
            'ekspedisis' => $pelanggan->ekspedisis,
            'pelanggan_ekspedisis' => $pelanggan->pelanggan_ekspedisis,
            'csrf' => csrf_token(),
        ];

        if ($show_dump === true) {
            dump("data:", $data);
        }
        return view('pelanggan.pelanggan-ekspedisi', $data);
    }
}
