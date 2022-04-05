<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Http\Requests\StorePelangganResellerRequest;
use App\Http\Requests\UpdatePelangganResellerRequest;
use App\Models\Pelanggan;
use App\Models\PelangganReseller;
use App\Models\Pulau;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PelangganResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        $load_num = SiteSettings::loadNumToZero();

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $show_hidden_dump = false;

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        $get = $request->query();

        if ($show_dump) {
            dump('$get:');
            dump($get);
        }

        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $resellers = $pelanggan->resellers;
        // $pelanggan_resellers = PelangganReseller::groupBy('reseller_id')->get();
        // $pelanggan_resellers = DB::table('pelanggan_resellers')->groupBy('reseller_id')->get();
        $pelanggan_resellers = DB::table('pelanggan_resellers')->select('reseller_id')->groupBy('reseller_id')->get()->toArray();
        $list_of_resellers = array();
        foreach ($pelanggan_resellers as $pelanggan_reseller) {
            // dd($pelanggan_reseller->reseller_id);
            $reseller = new Pelanggan();
            $reseller = $reseller->label_pelanggans_certain_id($pelanggan_reseller->reseller_id);
            array_push($list_of_resellers, $reseller[0]);
        }
        // $pulau = new Pulau();
        // $list_of_pulaus = $pulau->label_pulaus();

        $data = [
            'pelanggan' => $pelanggan,
            'resellers' => $resellers,
            'pelanggan_resellers' => $pelanggan_resellers,
            'list_of_resellers' => $list_of_resellers,
            // 'list_of_pulaus' => $list_of_pulaus
        ];

        if ($show_dump) {
            dump('$data');
            dump($data);
        }

        return view('pelanggan.tetapkan-reseller', $data);
    }

    public function tetapkan_reseller_db(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = true; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = false; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = true;
        $ada_error = true;
        $pesan_db = 'Ooops! Ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump === true) {
            dump("post:");
            dump($post);
        }
        $pelanggan = Pelanggan::find($post['pelanggan_id']);
        $reseller = Pelanggan::find($post['reseller_id']);

        // CEK APAKAH RESELLER TERPILIH SUDAH TERDAFTAR MENJADI RESELLER DARI PELANGGAN INI
        $is_exist_in_pelanggan_reseller = PelangganReseller::where('reseller_id', $post['reseller_id'])
            ->where('pelanggan_id', $post['pelanggan_id'])
            ->first();
        // KALAU BELUM EXIST MAKA AKAN MENGEMBALIKAN NULL
        if ($show_dump) {
            dump('$is_exist_in_pelanggan_reseller');
            dump($is_exist_in_pelanggan_reseller);
        }

        if ($is_exist_in_pelanggan_reseller !== null) {
            $run_db = false;
            $pesan_db = 'WARNING: Tidak ada yang diinput ke Database, karena ' . $reseller['nama'] . ' memang dari sebelumnya sudah terdaftar sebagai Reseller dari ' . $pelanggan['nama'];
            $ada_error = true;
            $class_div_pesan_db = 'alert-warning';
        }

        if ($run_db) {
            PelangganReseller::create([
                'reseller_id' => $post['reseller_id'],
                'pelanggan_id' => $post['pelanggan_id'],
            ]);

            $pesan_db = "SUCCESS: $reseller[nama] berhasil ditambahkan sebagai Reseller bagi pelanggan $pelanggan[nama]";
            $ada_error = false;
            $class_div_pesan_db = 'alert-success';
            $load_num->value += 1;
            $load_num->save();
        }
        $data = [
            'go_back_number' => -2,
            'pesan_db' => $pesan_db,
            'ada_error' => $ada_error,
            'class_div_pesan_db' => $class_div_pesan_db
        ];
        return view('layouts.go-back-page', $data);
    }

    public function hapus_reseller(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = true; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = false; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = true;
        $ada_error = true;
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump === true) {
            dump("post:");
            dump($post);
        }

        if ($run_db) {
            $pelanggan = Pelanggan::find($post['pelanggan_id']);
            $reseller = Pelanggan::find($post['reseller_id']);
            $pelanggan_reseller = PelangganReseller::where('reseller_id', $post['reseller_id'])
            ->where('pelanggan_id', $post['pelanggan_id'])
            ->first();

            $pelanggan_reseller->delete();

            $pesan_db = "SUCCESS: $reseller[nama] berhasil dihapus dari data Reseller $pelanggan[nama]";
            $ada_error = false;
            $class_div_pesan_db = 'alert-success';
            $load_num->value += 1;
            $load_num->save();
        }
        $data = [
            'go_back_number' => -2,
            'pesan_db' => $pesan_db,
            'ada_error' => $ada_error,
            'class_div_pesan_db' => $class_div_pesan_db
        ];
        return view('layouts.go-back-page', $data);
    }


}
