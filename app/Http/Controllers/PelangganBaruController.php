<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Pelanggan;
use App\Models\PelangganAlamat;
use App\Models\PelangganKontak;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class PelangganBaruController extends Controller
{
    public function create(Request $request)
    {
        /**SETTINGAN AWAL UNTUK CONTROLLER YANG DIGUNAKAN UNTUK INSERT DAN UPDATE DB */
        $load_num = SiteSetting::find(1);
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $success_logs=$warning_logs=$error_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }
        /**END OF SETTINGAN AWAL */

        $post = $request->post();
        // dd($post);

        $nama=$post['nama'];$bentuk=$post['bentuk'];$nik=$post['nik'];
        $gender=$post['gender'];$alias=$post['alias'];$initial=$post['initial'];
        //alamat
        $jalan=$post['jalan'];$komplek=$post['komplek'];$rt=$post['rt'];$rw=$post['rw'];$desa=$post['desa'];
        $kelurahan=$post['kelurahan'];$kecamatan=$post['kecamatan'];$kota=$post['kota'];$provinsi=$post['provinsi'];$kabupaten=$post['kabupaten'];
        $kodepos=$post['kodepos'];$pulau=$post['pulau'];$negara=$post['negara'];$short=$post['short'];$long=$post['long'];
        //kontak
        $nomor=$post['nomor'];$tipekontak=$post['tipekontak'];$kodearea=$post['kodearea'];
        //keterangan lain
        $keterangan=$post['keterangan'];

        // ALAMAT
        // FILTER BARIS YANG VALUE NYA NULL DAN empty string, JANGAN MASUK KE DB

        if ($run_db === true) {
            $pelanggan = Pelanggan::create([
                'bentuk' => $bentuk,
                'nik' => $nik,
                'nama' => $nama,
                'gender' => $gender,
                'alias' => $alias,
                'initial' => $initial,
                'keterangan' => $keterangan,
            ]);
            $success_logs[] = "SUCCESS: Pelanggan Baru dengan nama $pelanggan[nama] berhasil dibuat!";

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
                $pelanggan_alamat=PelangganAlamat::create([
                    'pelanggan_id'=>$pelanggan['id'],
                    'alamat_id'=>$alamat['id'],
                    'tipe'=>'UTAMA',
                ]);
                $success_logs[] = "SUCC: Pelanggan_alamat: $pelanggan_alamat[pelanggan_id] - $pelanggan_alamat[alamat_id] berhasil dibuat!";
            } else {
                $warning_logs[]="Tidak tersedia input alamat. Maka alamat tidak dibuat dan tidak dihubungkan dengan ekspedisi ini.";
            }

            if ($nomor!==null) {
                $pelanggan_kontak=PelangganKontak::create([
                    'pelanggan_id'=>$pelanggan['id'],
                    'nomor'=>$nomor,
                    'kodearea'=>$kodearea,
                    'tipe'=>$tipekontak,
                    'is_aktual'=>'yes'
                ]);
                $success_logs[] = "SUCC: Nomor Baru dengan nomor $pelanggan_kontak[nomor] berhasil dibuat!";
            } else {
                $warning_logs[]='Tidak ada input nomor. Maka nomor tidak dibuat dan tidak dihubungkan dengan ekspedisi ini.';
            }

            $load_num->value += 1;
            $load_num->save();

            $main_log='SUCCESS';
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
