<?php

namespace App\Http\Controllers;

use App\Models\Pelanggan;
use App\Models\PelangganKontak;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PelangganKontakController extends Controller
{
    public function tambah_kontak(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $get = $request->query();
        // dump($get);

        $pelanggan = Pelanggan::find($get['pelanggan_id']);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'pelanggan' => $pelanggan
        ];

        return view('pelanggan.pelanggan_tambah_kontak', $data);
    }

    public function tambah_kontak_db(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $success_logs=$warning_logs=$error_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[]='WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dd('$post: ', $post);
        $tipe=$post['tipekontak'];
        $kodearea=$post['kodearea'];
        $nomor=$post['nomor'];
        $lokasi=$post['lokasi'];
        $pelanggan_id=$post['pelanggan_id'];

        if ($run_db) {
            // Kalau belum punya kontak sebelumnya, maka nomor baru ini di set otomasis sebagai aktual
            $is_aktual='no';
            $pelanggan_kontak=PelangganKontak::where('pelanggan_id',$pelanggan_id)->get();
            if (count($pelanggan_kontak)==null) {
                $is_aktual='yes';
                $success_logs[]="Belum ditemukan adanya kontak terkait dengan pelanggan ini. is_aktual=yes";
            } else {
                $success_logs[]="Sudah ditemukan adanya kontak terkait dengan pelanggan ini. is_aktual=no";
            }

            $pelanggan_kontak=PelangganKontak::create([
                'pelanggan_id'=>$pelanggan_id,
                'nomor'=>$nomor,
                'kodearea'=>$kodearea,
                'tipe'=>$tipe,
                'lokasi'=>$lokasi,
                'is_aktual'=>$is_aktual,
            ]);
            $success_logs[]="Kontak baru berhasil dibuat. Relasi antara pelanggan dan kontak berhasil dibuat.";

            $load_num->value += 1;
            $load_num->save();

            $main_log = "SUCCESS";
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

    public function edit_kontak(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $get = $request->query();
        // dump($get);
        $pelanggan_id=$get['pelanggan_id'];
        $pelanggan_kontak_id=$get['pelanggan_kontak_id'];

        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $pelanggan_kontak=PelangganKontak::find($pelanggan_kontak_id);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'pelanggan' => $pelanggan,
            'pelanggan_kontak' => $pelanggan_kontak,
        ];

        return view('pelanggan.pelanggan_edit_kontak', $data);
    }

    public function edit_kontak_db(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $success_logs=$warning_logs=$error_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[]='WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dd('$post: ', $post);
        $tipe=$post['tipekontak'];
        $kodearea=$post['kodearea'];
        $nomor=$post['nomor'];
        $lokasi=$post['lokasi'];
        $is_aktual=$post['is_aktual'];
        $pelanggan_id=$post['pelanggan_id'];
        $pelanggan_kontak_id=$post['pelanggan_kontak_id'];

        if ($run_db) {
            // Kalo is_aktual==yes, maka nomor lain harus di set is_aktual nya sebagai no
            if ($is_aktual==='yes') {
                $pelanggan_kontak_other=PelangganKontak::where('pelanggan_id',$pelanggan_id)->get();
                if (count($pelanggan_kontak_other)!==0) {
                    foreach ($pelanggan_kontak_other as $pel_kontak) {
                        if ($pel_kontak['is_aktual']==='yes') {
                            $pel_kontak->is_aktual='no';
                            $pel_kontak->save();
                            $success_logs[]='Pelanggan ini ternyata memiliki kontak lain yang merupakan aktual, oleh karena itu kontak lain tersebut di set sebagai is_aktual=no terlebih dahulu.';
                        }
                    }
                }
            }
            $pelanggan_kontak=PelangganKontak::find($pelanggan_kontak_id);

            $pelanggan_kontak->nomor=$nomor;
            $pelanggan_kontak->kodearea=$kodearea;
            $pelanggan_kontak->tipe=$tipe;
            $pelanggan_kontak->lokasi=$lokasi;
            $pelanggan_kontak->is_aktual=$is_aktual;
            $pelanggan_kontak->save();
            $success_logs[]="Data kontak berhasil diupdate.";

            $load_num->value += 1;
            $load_num->save();

            $main_log = "SUCCESS";
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

    public function hapus_kontak(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $success_logs=$warning_logs=$error_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[]='WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dd('$post: ', $post);
        $pelanggan_id=$post['pelanggan_id'];
        $pelanggan_kontak_id=$post['pelanggan_kontak_id'];

        if ($run_db) {
            // Kalo is_aktual==yes, maka setelah nomor ini dihapus, nomor lain harus di set is_aktual nya sebagai yes
            $pelanggan_kontak_other=PelangganKontak::where('pelanggan_id',$pelanggan_id)->where('id','!=',$pelanggan_kontak_id)->latest()->first();
            if ($pelanggan_kontak_other===null) {
                $warning_logs[]='Pelanggan ini tidak memiliki kontak lain yang dapat di set sebagai kontak aktual';
            } else {
                $pelanggan_kontak_other->is_aktual='yes';
                $pelanggan_kontak_other->save();
                $success_logs[]='Pelanggan ini memiliki kontak lain yang dapat di set sebagai kontak aktual, maka kontak lain tersebut akan di set sebagai kontak aktual';
            }
            $pelanggan_kontak=PelangganKontak::find($pelanggan_kontak_id);
            $pelanggan_kontak->delete();
            $success_logs[]="Relasi pelanggan_kontak ini berhasil dihapus!";

            $load_num->value += 1;
            $load_num->save();

            $main_log = "SUCCESS";
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
}
