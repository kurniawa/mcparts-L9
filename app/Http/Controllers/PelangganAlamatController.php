<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Alamat;
use App\Models\Pelanggan;
use App\Models\PelangganAlamat;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PelangganAlamatController extends Controller
{
    public function tambah_alamat(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();
        // dump($get);

        $pelanggan=Pelanggan::find($get['pelanggan_id']);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'pelanggan' => $pelanggan
        ];

        return view('pelanggan.pelanggan_tambah_alamat', $data);
    }

    public function tambah_alamat_db(Request $request)
    {
        /**STRATEGI:
         * - Apabila belum ada alamat sama sekali sebelumnya, maka alamat yang baru ini otomatis akan menjadi alamat utama.
         * - Apabila ada alamat lainnya, maka di cek terlebih dahulu, apakah alamat yang lain tersebut alamat utama atau cadangan.
         * - Apabila alamat lain tersebut ternyata tidak ada yang utama, maka alamat yang baru ini dijadikan sebagai alamat utama.
         */
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
        $long=$post['long'];
        $jalan=$post['jalan'];
        $komplek=$post['komplek'];
        $rt=$post['rt'];
        $rw=$post['rw'];
        $desa=$post['desa'];
        $kelurahan=$post['kelurahan'];
        $kecamatan=$post['kecamatan'];
        $kota=$post['kota'];
        $kabupaten=$post['kabupaten'];
        $provinsi=$post['provinsi'];
        $kodepos=$post['kodepos'];
        $pulau=$post['pulau'];
        $negara=$post['negara'];
        $short=$post['short'];
        $pelanggan_id=$post['pelanggan_id'];

        $long=json_encode($long);
        // dd($long);

        $tipe='CADANGAN';
        $pelanggan_alamats=PelangganAlamat::where('pelanggan_id',$pelanggan_id)->get();
        if (count($pelanggan_alamats)===0) {
            // Belum punya alamat sama sekali.
            $tipe='UTAMA';
            $success_logs[]='Pelanggan ini belum memiliki alamat sama sekali, maka alamat baru ini nantinya otomatis akan dijadikan alamat utama!';
        } else {
            foreach ($pelanggan_alamats as $pelanggan_alamat) {
                if ($pelanggan_alamat['tipe']==='UTAMA') {
                    break;
                    $success_logs[]='Pelanggan ini sudah memiliki alamat lain. Dan ada diantara alamat lain tersebut yang merupakan alamat utama. Maka alamat yang baru dibuat ini nantinya akan ditetapkan sebagai alamat CADANGAN.';
                } else {
                    $tipe='UTAMA';
                }
            }
        }
        if ($run_db) {
            $alamat=Alamat::create([
                'jalan'=>$jalan,'rt'=>$rt,'rw'=>$rw,'komplek'=>$komplek,'kecamatan'=>$kecamatan,'kelurahan'=>$kelurahan,
                'desa'=>$desa,'kota'=>$kota,'kabupaten'=>$kabupaten,'provinsi'=>$provinsi,'kodepos'=>$kodepos,
                'pulau'=>$pulau,'short'=>$short,'negara'=>$negara,'long'=>$long,
            ]);
            $success_logs[]="Alamat baru berhasil dibuat.";

            $pelanggan_alamat=PelangganAlamat::create([
                'pelanggan_id'=>$pelanggan_id,
                'alamat_id'=>$alamat['id'],
                'tipe'=>$tipe,
            ]);
            $success_logs[]="Relasi antara Alamat dan Pelanggan berhasil dibuat.";

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

    public function edit_alamat(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $get = $request->query();
        // dd($get);
        $pelanggan_id=$get['pelanggan_id'];
        $alamat_id=$get['alamat_id'];
        // dump($get);
        $alamat=Alamat::find($alamat_id);
        $alamat_long=json_decode($alamat['long'],true);
        $pelanggan = Pelanggan::find($pelanggan_id);
        $pelanggan_alamat=PelangganAlamat::where('pelanggan_id',$pelanggan_id)->where('alamat_id',$alamat_id)->first();

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'alamat_long' => $alamat_long,
            'pelanggan_alamat' => $pelanggan_alamat,
        ];
        // dd($data);
        return view('pelanggan.pelanggan_edit_alamat', $data);
    }

    public function edit_alamat_db(Request $request)
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
        // dump($post);
        // dd('$post: ', $post);
        $long=$post['long'];$jalan=$post['jalan'];$komplek=$post['komplek'];$rt=$post['rt'];$rw=$post['rw'];
        $desa=$post['desa'];$kelurahan=$post['kelurahan'];$kecamatan=$post['kecamatan'];$kota=$post['kota'];
        $kabupaten=$post['kabupaten'];$provinsi=$post['provinsi'];$kodepos=$post['kodepos'];$pulau=$post['pulau'];
        $negara=$post['negara'];$short=$post['short'];$pelanggan_id=$post['pelanggan_id'];$alamat_id=$post['alamat_id'];
        $alamat_utama='no';
        if (isset($post['alamat_utama'])) {
            $alamat_utama=$post['alamat_utama'];
        }
        $tipe_alamat='CADANGAN';
        if ($alamat_utama=='yes') {
            $tipe_alamat='UTAMA';
        }

        $long=json_encode($long);
        // dd($long);

        if ($run_db) {
            $alamat=Alamat::find($alamat_id);
            $alamat->jalan=$jalan;$alamat->komplek=$komplek;$alamat->rt=$rt;$alamat->rw=$rw;$alamat->kecamatan=$kecamatan;
            $alamat->kelurahan=$kelurahan;$alamat->desa=$desa;$alamat->kota=$kota;$alamat->kabupaten=$kabupaten;$alamat->provinsi=$provinsi;
            $alamat->kodepos=$kodepos;$alamat->pulau=$pulau;$alamat->negara=$negara;$alamat->short=$short;$alamat->long=$long;
            $alamat->save();

            $success_logs[]="Alamat berhasil di edit/update.";

            // Update pelanggan_alamat->tipe=$tipe_alamat
            // Apabila tipe_alamat adalah UTAMA maka alamat yang lain harus di set menjadi CADANGAN terlebih dahulu.
            if ($tipe_alamat==="UTAMA") {
                $pelanggan_alamat_utama=PelangganAlamat::where('pelanggan_id',$pelanggan_id)->where('alamat_id','!=',$alamat_id)->where('tipe','UTAMA')->get();
                if (count($pelanggan_alamat_utama)!==0) {
                    foreach ($pelanggan_alamat_utama as $eks_alm) {
                        $eks_alm->tipe='CADANGAN';$eks_alm->save();
                        $success_logs[]="pelanggan_alamat dengan ID $eks_alm[id] diupdate: tipe yang tadinya UTAMA menjadi CADANGAN";
                        // dump($eks_alm);
                    }
                }
            }
            $pelanggan_alamat=PelangganAlamat::where('pelanggan_id',$pelanggan_id)->where('alamat_id',$alamat_id)->first();
            $pelanggan_alamat->tipe=$tipe_alamat;
            $pelanggan_alamat->save();
            $success_logs[]="PelangganAlamat berhasil di edit/update.";

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

    public function hapus_alamat(Request $request)
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
        // dump($post);
        // dd('$post: ', $post);
        $pelanggan_id=$post['pelanggan_id'];
        $alamat_id=$post['alamat_id'];
        $pelanggan_alamat_id=$post['pelanggan_alamat_id'];
        // dd($long);

        if ($run_db) {
            // Sebelum hapus, cek terlebih dahulu tipe alamatnya, apabila yang mau dihapus adalah alamat utama, maka setelah penghapusan
            // harus dipilih alamat lain untuk menjadi yang utama
            $pelanggan_alamat=PelangganAlamat::find($pelanggan_alamat_id);
            $tetapkan_alamat_utama_lain=false;
            if ($pelanggan_alamat['tipe']=='UTAMA') {
                $tetapkan_alamat_utama_lain=true;
            }
            $alamat=Alamat::find($alamat_id);
            $alamat->delete();

            $success_logs[]="Alamat berhasil di hapus.";

            $pelanggan_alamat_other=PelangganAlamat::where('pelanggan_id',$pelanggan_id)->first();
            if ($pelanggan_alamat_other!==null && $tetapkan_alamat_utama_lain===true) {
                $pelanggan_alamat_other->tipe='UTAMA';
                $pelanggan_alamat_other->save();

                $success_logs[]="Alamat yang dihapus adalah alamat UTAMA. Pelanggan ini memiliki alamat lainnya. Alamat lain tersebut sekarang dijadikan alamat UTAMA.";
            }

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
