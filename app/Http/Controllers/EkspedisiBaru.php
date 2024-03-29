<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Ekspedisi;
use App\Models\EkspedisiAlamat;
use App\Models\EkspedisiKontak;
use App\Models\Kontak;
use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class EkspedisiBaru extends Controller
{
    public function index()
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
        }
        $all_ekspedisi = Ekspedisi::orderBy('nama')->get();

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'all_ekspedisi' => $all_ekspedisi,
        ];
        return view('ekspedisi.ekspedisi-baru', $data);
    }

    public function ekspedisi_baru_db(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $success_logs=$warning_logs=$error_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';


        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        $nama=$post['nama'];
        $bentuk=$post['bentuk'];
        //alamat
        $jalan=$post['jalan'];$komplek=$post['komplek'];$rt=$post['rt'];$rw=$post['rw'];$desa=$post['desa'];
        $kelurahan=$post['kelurahan'];$kecamatan=$post['kecamatan'];$kota=$post['kota'];$provinsi=$post['provinsi'];$kabupaten=$post['kabupaten'];
        $kodepos=$post['kodepos'];$pulau=$post['pulau'];$negara=$post['negara'];$short=$post['short'];$long=$post['long'];
        //kontak
        $nomor=$post['nomor'];$tipekontak=$post['tipekontak'];$kodearea=$post['kodearea'];
        //keterangan lain
        $keterangan=$post['keterangan'];

        // dd('$post: ', $post);

        if ($run_db === true) {
            $ekspedisi = Ekspedisi::create([
                'bentuk' => $bentuk,
                'nama' => $nama,
                'keterangan' => $keterangan,
            ]);
            $success_logs[] = "SUCCESS: Ekspedisi Baru dengan nama $ekspedisi[nama] berhasil dibuat!";

            if ($long[0]!==null) {
                $long=json_encode($long);

                $alamat=Alamat::create([
                    'jalan'=>$jalan,
                    'rt'=>$rt,'rw'=>$rw,
                    'komplek'=>$komplek,
                    'kecamatan'=>$kecamatan,
                    'kelurahan'=>$kelurahan,
                    'desa'=>$desa,
                    'kota'=>$kota,
                    'kabupaten'=>$kabupaten,
                    'provinsi'=>$provinsi,
                    'kodepos'=>$kodepos,
                    'pulau'=>$pulau,
                    'short'=>$short,
                    'negara'=>$negara,
                    'long'=>$long,
                ]);
                $success_logs[] = "SUCC: Alamat Baru dengan long: $alamat[long] berhasil dibuat!";
                $ekspedisi_alamat=EkspedisiAlamat::create([
                    'ekspedisi_id'=>$ekspedisi['id'],
                    'alamat_id'=>$alamat['id'],
                    'tipe'=>'UTAMA', // ekspedisi baru pasti alamatnya baru, oleh karena itu langsung ditetapkan sebagai alamat utama
                ]);
                $success_logs[] = "SUCC: Ekspedisi_alamat: $ekspedisi_alamat[ekspedisi_id] - $ekspedisi_alamat[alamat_id] berhasil dibuat!";
            } else {
                $warning_logs[]="Tidak tersedia input alamat. Maka alamat tidak dibuat dan tidak dihubungkan dengan ekspedisi ini.";
            }

            if ($nomor!==null) {
                $ekspedisi_kontak=EkspedisiKontak::create([
                    'ekspedisi_id'=>$ekspedisi['id'],
                    'nomor'=>$nomor,
                    'kodearea'=>$kodearea,
                    'tipe'=>$tipekontak,
                    'is_aktual'=>'yes'
                ]);
                $success_logs[] = "SUCC: Nomor Baru dengan nomor $ekspedisi_kontak[nomor] berhasil dibuat!";
            } else {
                $warning_logs[]='Tidak ada input nomor. Maka nomor tidak dibuat dan tidak dihubungkan dengan ekspedisi ini.';
            }


            $load_num->value += 1;
            $load_num->save();

            $main_log='SUCCESS';

        }

        $route='Ekspedisis';
        $route_btn='Ke Daftar Ekspedisi';
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,
        ];

        return view('layouts.db-result', $data);
    }
}
