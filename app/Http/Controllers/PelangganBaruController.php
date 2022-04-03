<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Daerah;
use App\Models\Pelanggan;
use App\Models\Pulau;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PelangganBaruController extends Controller
{
    public function pelanggan_baru(Request $request)
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

        $label_negaras = getLabelNegara();
        $label_pulaus = getLabelPulau();
        $arr_label_daerahs = getLabelDaerah();


        if ($show_dump === true) {
            dump('label_negaras:', $label_negaras);
            dump('label_pulaus:', $label_pulaus);
            dump('arr_label_daerahs:', $arr_label_daerahs);
        }

        $data = [
            'label_negaras' => $label_negaras,
            'label_pulaus' => $label_pulaus,
            'arr_label_daerahs' => $arr_label_daerahs
        ];

        return view('pelanggan.pelanggan-baru', $data);
    }

    public function create(Request $request)
    {
        /**SETTINGAN AWAL UNTUK CONTROLLER YANG DIGUNAKAN UNTUK INSERT DAN UPDATE DB */
        $load_num = SiteSetting::find(1);
        [$show_dump, $show_hidden_dump, $load_num_ignore, $run_db] = SiteSettings::variablesNeeded();

        if ($show_hidden_dump) {
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }
        /**END OF SETTINGAN AWAL */

        $request->validate([
            'nama_pelanggan' => 'required',
            // 'alamat_pelanggan[]' => 'required',
            'daerah' => 'required',
        ]);

        $post = $request->input();

        if ($show_dump === true) {
            dump("post:", $post);
        }

        // ALAMAT
        // FILTER BARIS YANG VALUE NYA NULL DAN empty string, JANGAN MASUK KE DB

        $arr_alamat = array_filter($post['alamat_pelanggan']);

        if ($show_dump) {
            dump('$arr_alamat');
            dump($arr_alamat);
        }
        $msg = 'Something went wrong!';
        if ($run_db === true) {
            Pelanggan::create([
                'nama' => $post['nama_pelanggan'],
                'alamat' => json_encode($arr_alamat),
                'no_kontak' => $post['kontak_pelanggan'],
                'negara_id' => $post['negara_id'],
                'pulau_id' => $post['pulau_id'],
                'daerah_id' => $post['daerah_id'],
                'initial' => $post['singkatan_pelanggan'],
                'ktrg' => $post['keterangan'],
                'is_reseller' => $post['is_reseller'],
            ]);
            $msg = 'Pelanggan Baru berhasil diinput ke Database!';
        }

        $data = [
            'msg'=>$msg,
            'go_back_number'=>-2,
        ];

        if ($run_db === true) {
            $load_num->value += 1;
            $load_num->save();
        }

        return view('layouts.go-back-page', $data);
    }
}
