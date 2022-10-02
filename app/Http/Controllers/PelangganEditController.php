<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Pelanggan;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PelangganEditController extends Controller
{
    public function pelanggan_edit(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();
        // dd($get);
        $pelanggan = Pelanggan::find($get['pelanggan_id']);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'pelanggan' => $pelanggan,
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
            $pelanggan->keterangan = $post['keterangan'];
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
        $success_logs=$warning_logs=$error_logs=array();
        $main_log=null;
        $run_db = true; // true apabila siap melakukan CRUD ke DB

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        $pelanggan_id=$post['pelanggan_id'];

        // dd('$post: ', $post);

        if ($run_db === true) {
            $pelanggan = Pelanggan::find($pelanggan_id);
            $pelanggan->delete();
            $warning_logs[]="Pelanggan $pelanggan[nama] berhasil dihapus!";
            $main_log='SUCCESS';
            $load_num->value += 1;
            $load_num->save();
        }

        $route='Pelanggans';
        $route_btn='Ke Daftar Pelanggan';
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,
        ];

        return view('layouts.db-result', $data);
    }
}
