<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Daerah;
use App\Models\Negara;
use App\Models\Pelanggan;
use App\Models\Pulau;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PelangganEditController extends Controller
{
    public function pelanggan_edit(Request $request)
    {
        $load_num = SiteSettings::loadNumToZero();
        [$show_dump, $show_hidden_dump, $load_num_ignore, $run_db] = SiteSettings::variablesNeeded();

        if ($show_hidden_dump) {
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
        }

        $get = $request->query();
        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $negara = Negara::find(1);
        if ($pelanggan['negara_id'] !== 1 && $pelanggan['negara_id'] !== null) {
            $negara = Negara::find($pelanggan['negara_id']);
        }
        $pulau = null;
        if ($pelanggan['pulau_id'] !== null) {
            $pulau = Pulau::find($pelanggan['pulau_id']);
        }
        $daerah = null;
        if ($pelanggan['daerah_id'] !== null) {
            $daerah = Daerah::find($pelanggan['daerah_id']);
        }

        $label_negaras = getLabelNegara();
        $label_pulaus = getLabelPulau();
        $arr_label_daerahs = getLabelDaerah();


        if ($show_dump) {
            // dump('load_num', $load_num);
            // dump('label_pulaus:', $label_pulaus);
            // dd('arr_label_daerahs:', $arr_label_daerahs);
            dump('pelanggan:', $pelanggan);
            dump('negara:', $negara);
            dump('pulau:', $pulau);
            dump('daerah:', $daerah);
        }

        $data = [
            'pelanggan' => $pelanggan,
            'negara' => $negara,
            'pulau' => $pulau,
            'daerah' => $daerah,
            'label_negaras' => $label_negaras,
            'label_pulaus' => $label_pulaus,
            'arr_label_daerahs' => $arr_label_daerahs,
            'csrf' => csrf_token()
        ];

        return view('pelanggan.pelanggan-edit', $data);
    }

    public function edit_db(Request $request)
    {
        /**SETTINGAN AWAL UNTUK CONTROLLER YANG DIGUNAKAN UNTUK INSERT DAN UPDATE DB */
        $load_num = SiteSetting::find(1);
        [$show_dump, $show_hidden_dump, $load_num_ignore, $run_db] = SiteSettings::variablesNeeded();

        $ada_error = true;
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem ini, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($show_hidden_dump) {
            dump('$load_num->value:', $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }
        /**END OF SETTINGAN AWAL */

        $request->validate([
            'nama_pelanggan' => 'required',
            // 'alamat_pelanggan[]' => 'required',
            'daerah' => 'required',
        ]);

        $post = $request->post();

        if ($show_dump) {
            dump('$post');
            dump($post);
        }

        $pelanggan = Pelanggan::find($post['pelanggan_id']);
        $alamat_pelanggan = json_encode(array_filter($post['alamat_pelanggan']));

        if ($show_dump) {
            dump('pelanggan_old');
            dump($pelanggan);
            dump('$alamat_pelanggan');
            dump($alamat_pelanggan);
        }

        if ($run_db) {
            $pelanggan->nama = $post['nama_pelanggan'];
            $pelanggan->alamat = $alamat_pelanggan;
            $pelanggan->negara_id = $post['negara_id'];
            $pelanggan->pulau_id = $post['pulau_id'];
            $pelanggan->daerah_id = $post['daerah_id'];
            $pelanggan->no_kontak = $post['kontak_pelanggan'];
            $pelanggan->initial = $post['singkatan_pelanggan'];
            $pelanggan->ktrg = $post['keterangan'];
            $pelanggan->is_reseller = $post['is_reseller'];
            $pelanggan->save();
            $load_num->value += 1;
            $load_num->save();
            $main_log = "Data Pelanggan: $pelanggan[nama] BERHASIL DIUBAH.";
            $class_div_pesan_db = 'alert-success';
            $ada_error = false;
        }

        $data = [
            'go_back_number' => -2,
            'ada_error' => $ada_error,
            'pesan_db' => $main_log,
            'class_div_pesan_db' => $class_div_pesan_db,
        ];

        return view('layouts.go-back-page', $data);
    }

    public function destroy(Request $request)
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

        $post = $request->post();

        if ($show_dump) {
            dump('$post:');
            dump($post);
        }

        $pelanggan = Pelanggan::find($post['pelanggan_id']);

        if ($run_db) {
            $pelanggan->delete();
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
