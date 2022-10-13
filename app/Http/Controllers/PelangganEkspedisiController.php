<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Ekspedisi;
use App\Models\Pelanggan;
use App\Models\PelangganEkspedisi;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PelangganEkspedisiController extends Controller
{
    public function index(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();

        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $ekspedisis = $pelanggan->ekspedisis;
        $pelanggan_ekspedisis = $pelanggan->pelanggan_ekspedisis;
        $all_ekspedisis = new Ekspedisi();
        $label_ekspedisis = $all_ekspedisis->label_ekspedisis();

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'pelanggan' => $pelanggan,
            'ekspedisis' => $ekspedisis,
            'pelanggan_ekspedisis' => $pelanggan_ekspedisis,
            'label_ekspedisis' => $label_ekspedisis,
            'csrf' => csrf_token(),
        ];
        dump($data);
        return view('pelanggan.tambah-ekspedisi', $data);
    }

    public function tambah_ekspedisi_db(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem ini, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();

            dump('$post:', $post);

        $request->validate([
            'ekspedisi_nama' => 'required',
            'ekspedisi_id' => 'required',
        ]);

        $pelanggan = Pelanggan::find($post['pelanggan_id']);
        $ekspedisi = Ekspedisi::find($post['ekspedisi_id']);

        if ($run_db) {
            $pelanggan_ekspedisi = PelangganEkspedisi::create([
                'pelanggan_id' => $post['pelanggan_id'],
                'ekspedisi_id' => $post['ekspedisi_id'],
                'tipe' => $post['tipe_ekspedisi'],
            ]);
                dump('$pelanggan_ekspedisi', $pelanggan_ekspedisi);
            $main_log = "Ekspedisi $ekspedisi[nama] berhasil dijadikan ekspedisi $pelanggan_ekspedisi[tipe] dari Pelanggan $pelanggan[nama]";
            $class_div_pesan_db = 'alert-success';
            $ada_error = false;
            $load_num->value += 1;
            $load_num->save();
        }


        $data = [
            'pesan_db' => $main_log,
            'go_back_number' => -2,
            'class_div_pesan_db' => $class_div_pesan_db,
            'ada_error' => $ada_error,
        ];

            dump("data:", $data);

        return view('layouts.go-back-page', $data);
    }

    public function hapus_relasi_ekspedisi(Request $request)
    {
        // $load_num = SiteSettings::loadNumToZero();
        $load_num = SiteSetting::find(1);

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = false; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = false;
        $ada_error = true;
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem ini, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump) {
            dump('$post:', $post);
        }

        $pelanggan = Pelanggan::find($post['pelanggan_id']);
        $ekspedisi = Ekspedisi::find($post['ekspedisi_id']);

        $pelanggan_ekspedisi = PelangganEkspedisi::where('ekspedisi_id', $post['ekspedisi_id'])
        ->where('pelanggan_id', $post['pelanggan_id'])->first();

        if ($run_db) {
            $pelanggan_ekspedisi->delete();
            $main_log = "Ekspedisi $ekspedisi[nama] berhasil dihapus dari data ekspedisi Pelanggan $pelanggan[nama]";
            $class_div_pesan_db = 'alert-warning';
            $ada_error = false;
            $load_num->value += 1;
            $load_num->save();
        }


        $data = [
            'pesan_db' => $main_log,
            'go_back_number' => -2,
            'class_div_pesan_db' => $class_div_pesan_db,
            'ada_error' => $ada_error,
        ];

        if ($show_dump) {
            dump("data:", $data);
        }

        return view('layouts.go-back-page', $data);
    }
}
