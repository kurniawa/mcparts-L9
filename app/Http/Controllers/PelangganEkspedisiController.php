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

        $success_logs = $error_logs =$warning_logs= array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem ini, coba hubungi Admin atau Developer sistem ini!';
        $run_db=true;
        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dd('$post:', $post);
        $pelanggan_id=$post['pelanggan_id'];
        $ekspedisi_id=$post['ekspedisi_id'];
        $tipe=$post['tipe_ekspedisi'];
        $is_transit='no';
        if (isset($post['is_transit'])) {
            $is_transit=$post['is_transit'];
        }

        $request->validate([
            'ekspedisi_nama' => 'required',
            'ekspedisi_id' => 'required',
        ]);

        $pelanggan = Pelanggan::find($post['pelanggan_id']);
        $ekspedisi = Ekspedisi::find($post['ekspedisi_id']);

        if ($run_db) {
            // Sebelum input ekspedisi baru, perlu dipastikan terlebih dahulu, bahwa ekspedisi yang dipilih memang belum diinput sebagai ekspedisi
            // dari perlanggan ini.
            $cek_cust_ekspedisi=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('ekspedisi_id',$ekspedisi['id'])->where('tipe',$tipe)->first();
            if ($cek_cust_ekspedisi!== null) {
                $request->validate(['ekspedisi_nama_err'=>'required'],['ekspedisi_nama_err.required'=>"Ekspedisi: $cek_cust_ekspedisi[nama] sudah ditetapkan sebagai ekspedisi dari pelanggan: $pelanggan[nama]!"]);
            }
            $pelanggan_ekspedisi = PelangganEkspedisi::create([
                'pelanggan_id' => $pelanggan_id,
                'ekspedisi_id' => $ekspedisi_id,
                'tipe' => $tipe,
                'is_transit'=>$is_transit,
            ]);

            $success_logs[]="Ekspedisi $ekspedisi[nama] berhasil dijadikan ekspedisi $pelanggan_ekspedisi[tipe] dari Pelanggan $pelanggan[nama]";
            // Setelah insert, maka apabila yang barusan diinsert di set sebagai UTAMA, maka apabila ditemukan ekspedisi UTAMA lain nya,
            // harus dijadikan ekspedisi CADANGAN, sehingga ekspedisi yang UTAMA hanya satu saja.
            $cust_eks_utama_other=PelangganEkspedisi::where('pelanggan_id',$pelanggan_id)->where('tipe','UTAMA')->where('is_transit',$is_transit)
            ->where('id','!=',$pelanggan_ekspedisi['id'])->first();
            if ($cust_eks_utama_other!==null) {
                $cust_eks_utama_other->tipe='CADANGAN';
                $cust_eks_utama_other->save();
                $success_logs[]="Ditemukan ada ekspedisi UTAMA lain, selain yang baru saja diinput, oleh karena itu, ekspedisi lain tersebut dijadikan ekspedisi CADANGAN";
            }
            $main_log = "SUCCESS";
            $load_num->value += 1;
            $load_num->save();
        }

        $route='pelanggan_detail';
        $route_btn='Ke Detail Pelanggan';
        $params=['pelanggan_id'=>$pelanggan_id];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
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
