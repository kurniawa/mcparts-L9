<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Pelanggan;
use App\Models\PelangganEkspedisi;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PelangganEkspedisiController extends Controller
{
    public function index(Request $request)
    {
        $load_num = SiteSettings::loadNumToZero();
        // $load_num = SiteSetting::find(1);

        $show_dump = true; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = false; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = true;
        $ada_error = true;
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem ini, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        // if ($load_num->value > 0 && $load_num_ignore === false) {
        //     $run_db = false;
        //     $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        //     $ada_error = true;
        //     $class_div_pesan_db = 'alert-danger';
        // }


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
