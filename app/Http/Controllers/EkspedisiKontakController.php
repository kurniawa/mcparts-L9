<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use App\Models\EkspedisiKontak;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class EkspedisiKontakController extends Controller
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

        $ekspedisi = Ekspedisi::find($get['ekspedisi_id']);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'ekspedisi' => $ekspedisi
        ];

        return view('ekspedisi.tambah_kontak', $data);
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
        $ekspedisi_id=$post['ekspedisi_id'];

        if ($run_db) {
            // Kalau belum punya kontak sebelumnya, maka nomor baru ini di set otomasis sebagai aktual
            $is_aktual='no';
            $ekspedisi_kontak=EkspedisiKontak::where('ekspedisi_id',$ekspedisi_id)->get();
            if (count($ekspedisi_kontak)==null) {
                $is_aktual='yes';
                $success_logs[]="Belum ditemukan adanya kontak terkait dengan ekspedisi ini. is_aktual=yes";
            } else {
                $success_logs[]="Sudah ditemukan adanya kontak terkait dengan ekspedisi ini. is_aktual=no";
            }

            $ekspedisi_kontak=EkspedisiKontak::create([
                'ekspedisi_id'=>$ekspedisi_id,
                'nomor'=>$nomor,
                'kodearea'=>$kodearea,
                'tipe'=>$tipe,
                'lokasi'=>$lokasi,
                'is_aktual'=>$is_aktual,
            ]);
            $success_logs[]="Kontak baru berhasil dibuat. Relasi antara ekspedisi dan kontak berhasil dibuat.";

            $load_num->value += 1;
            $load_num->save();

            $main_log = "SUCCESS";
        }

        $route='DetailEkspedisi';
        $route_btn='Ke Detail Ekspedisi';
        $params=['ekspedisi_id'=>$ekspedisi_id];

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
        $ekspedisi_id=$get['ekspedisi_id'];
        $ekspedisi_kontak_id=$get['ekspedisi_kontak_id'];

        $ekspedisi = Ekspedisi::find($get['ekspedisi_id']);
        $ekspedisi_kontak=EkspedisiKontak::find($ekspedisi_kontak_id);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'ekspedisi' => $ekspedisi,
            'ekspedisi_kontak' => $ekspedisi_kontak,
        ];

        return view('ekspedisi.edit_kontak', $data);
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
        $ekspedisi_id=$post['ekspedisi_id'];
        $ekspedisi_kontak_id=$post['ekspedisi_kontak_id'];

        if ($run_db) {
            // Kalo is_aktual==yes, maka nomor lain harus di set is_aktual nya sebagai no
            if ($is_aktual==='yes') {
                $ekspedisi_kontak_other=EkspedisiKontak::where('ekspedisi_id',$ekspedisi_id)->get();
                if (count($ekspedisi_kontak_other)!==0) {
                    foreach ($ekspedisi_kontak_other as $pel_kontak) {
                        if ($pel_kontak['is_aktual']==='yes') {
                            $pel_kontak->is_aktual='no';
                            $pel_kontak->save();
                            $success_logs[]='Ekspedisi ini ternyata memiliki kontak lain yang merupakan aktual, oleh karena itu kontak lain tersebut di set sebagai is_aktual=no terlebih dahulu.';
                        }
                    }
                }
            }
            $ekspedisi_kontak=EkspedisiKontak::find($ekspedisi_kontak_id);

            $ekspedisi_kontak->nomor=$nomor;
            $ekspedisi_kontak->kodearea=$kodearea;
            $ekspedisi_kontak->tipe=$tipe;
            $ekspedisi_kontak->lokasi=$lokasi;
            $ekspedisi_kontak->is_aktual=$is_aktual;
            $ekspedisi_kontak->save();
            $success_logs[]="Data kontak berhasil diupdate.";

            $load_num->value += 1;
            $load_num->save();

            $main_log = "SUCCESS";
        }

        $route='DetailEkspedisi';
        $route_btn='Ke Detail Ekspedisi';
        $params=['ekspedisi_id'=>$ekspedisi_id];

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
        $ekspedisi_id=$post['ekspedisi_id'];
        $ekspedisi_kontak_id=$post['ekspedisi_kontak_id'];

        if ($run_db) {
            // Kalo is_aktual==yes, maka setelah nomor ini dihapus, nomor lain harus di set is_aktual nya sebagai yes
            $ekspedisi_kontak_other=EkspedisiKontak::where('ekspedisi_id',$ekspedisi_id)->where('id','!=',$ekspedisi_kontak_id)->latest()->first();
            if ($ekspedisi_kontak_other===null) {
                $warning_logs[]='Ekspedisi ini tidak memiliki kontak lain yang dapat di set sebagai kontak aktual';
            } else {
                $ekspedisi_kontak_other->is_aktual='yes';
                $ekspedisi_kontak_other->save();
                $success_logs[]='Ekspedisi ini memiliki kontak lain yang dapat di set sebagai kontak aktual, maka kontak lain tersebut akan di set sebagai kontak aktual';
            }
            $ekspedisi_kontak=EkspedisiKontak::find($ekspedisi_kontak_id);
            $ekspedisi_kontak->delete();
            $success_logs[]="Relasi ekspedisi_kontak ini berhasil dihapus!";

            $load_num->value += 1;
            $load_num->save();

            $main_log = "SUCCESS";
        }

        $route='DetailEkspedisi';
        $route_btn='Ke Detail Ekspedisi';
        $params=['ekspedisi_id'=>$ekspedisi_id];

        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }
}
