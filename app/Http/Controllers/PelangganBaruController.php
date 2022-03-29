<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Pelanggan;
use App\Models\Pulau;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PelangganBaruController extends Controller
{
    public function pelanggan_baru(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $show_dump = true;
        $show_hidden_dump = true;
        $run_db = false;
        $load_num_ignore = true;

        if ($show_hidden_dump === true) {
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }

        $pulaus = new Pulau();
        $label_pulaus = $pulaus->label_pulaus();
        $daerahs = new Daerah();
        $label_daerahs = $daerahs->label_daerahs();
        $arr_label_daerahs = array();
        // lihat doc bagian collection, nanti ada helper func nya, lumayan bermanfaat
        $arr_label_daerahs[0] = $label_daerahs->where('pulau_id', 1)->toArray();
        $arr_label_daerahs[1] = $label_daerahs->where('pulau_id', 2)->toArray();
        $arr_label_daerahs[1] = array_values($arr_label_daerahs[1]);
        $arr_label_daerahs[2] = $label_daerahs->where('pulau_id', 3)->toArray();
        $arr_label_daerahs[2] = array_values($arr_label_daerahs[2]);
        $arr_label_daerahs[3] = $label_daerahs->where('pulau_id', 4)->toArray();
        $arr_label_daerahs[3] = array_values($arr_label_daerahs[3]);
        $arr_label_daerahs[4] = $label_daerahs->where('pulau_id', 5)->toArray();
        $arr_label_daerahs[4] = array_values($arr_label_daerahs[4]);
        $arr_label_daerahs[5] = $label_daerahs->where('pulau_id', 6)->toArray();
        $arr_label_daerahs[5] = array_values($arr_label_daerahs[5]);


        if ($show_dump === true) {
            dump('label_pulaus:', $label_pulaus);
            dump('label_daerahs:', $label_daerahs);
            dump('arr_label_daerahs:', $arr_label_daerahs);
        }

        $data = [
            'label_pulaus' => $label_pulaus,
            'arr_label_daerahs' => $arr_label_daerahs
        ];

        return view('pelanggan.pelanggan-baru', $data);
    }

    public function create(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = true;
        $show_hidden_dump = true;
        $run_db = true;
        $load_num_ignore = false;

        if ($show_hidden_dump === true) {
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }

        $request->validate([
            'nama_pelanggan' => 'required',
            // 'alamat_pelanggan[]' => 'required',
            'daerah' => 'required',
            'pulau' => 'required',
        ]);

        $post = $request->input();

        if ($show_dump === true) {
            dump("post:", $post);
        }

        // ALAMAT
        $arr_alamat_pelanggan = $post['alamat_pelanggan'];
        $alamat_pelanggan = "";

        $i_arrAlamaCust = 0;
        foreach ($arr_alamat_pelanggan as $baris_alamat_pelanggan) {
            if ($baris_alamat_pelanggan === null || $baris_alamat_pelanggan === "") {
                # Kalau tidak diisi, maka tidak perlu ada yang diinput
            } else {
                if ($i_arrAlamaCust !== 0) {
                    $alamat_pelanggan .= "[br]";
                }
                $alamat_pelanggan .= $baris_alamat_pelanggan;
            }
            $i_arrAlamaCust++;
        }


        if ($run_db === true) {
            Pelanggan::create([
                'nama' => $post['nama_pelanggan'],
                'alamat' => $alamat_pelanggan,
                'daerah' => $post['daerah'],
                'no_kontak' => $post['kontak_pelanggan'],
                'pulau' => $post['pulau'],
                'initial' => $post['singkatan_pelanggan'],
                'ktrg' => $post['keterangan'],
            ]);
        }

        $data = [
            'go_back_number'=>-2
        ];

        if ($run_db === true) {
            $load_num->value += 1;
            $load_num->save();
        }

        return view('layouts.go-back-page', $data);
    }
}
