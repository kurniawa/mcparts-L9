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
        // dump($data);
        return view('pelanggan.pelanggan-edit', $data);
    }

    public function edit_db(Request $request)
    {
        /**SETTINGAN AWAL UNTUK CONTROLLER YANG DIGUNAKAN UNTUK INSERT DAN UPDATE DB */
        /**END OF SETTINGAN AWAL */

        $request->validate([
            'nama' => 'required',
        ]);
        $success_=$warnings_=$errors_="";
        $post = $request->post();
        // dd($post);
        $pelanggan_id=$post['pelanggan_id'];
        $bentuk=$post['bentuk'];
        $nama=$post['nama'];
        $nik=$post['nik'];
        $alias=$post['alias'];
        $gender=$post['gender'];
        $gelar=$post['gelar'];
        $sapaan=$post['sapaan'];
        $initial=$post['initial'];
        // $tipe=$post['tipe'];
        // $nama_organisasi=$post['nama_organisasi'];
        // $nama_toko=$post['nama_toko'];
        // $nama_pemilik=$post['nama_pemilik'];
        // $tanggal_lahir=$post['tanggal_lahir'];
        // $kategori=$post['kategori'];
        // $keterangan=$post['keterangan'];
        // $is_reseller=$post['is_reseller'];
        // $reseller_id=$post['reseller_id'];
        // $updater=$post['updater'];

        $pelanggan = Pelanggan::find($pelanggan_id);

        $pelanggan->update([
            'bentuk'=>$bentuk,
            'nama'=>$nama,
            'nik'=>$nik,
            'alias'=>$alias,
            'gender'=>$gender,
            'sapaan'=>$sapaan,
            'gelar'=>$gelar,
            'initial'=>$initial,
            // 'tipe'=>$tipe,
            // 'nama_organisasi'=>$nama_organisasi,
            // 'nama_toko'=>$nama_toko,
            // 'nama_pemilik'=>$nama_pemilik,
            // 'tanggal_lahir'=>$tanggal_lahir,
            // 'kategori'=>$kategori,
            // 'keterangan'=>$keterangan,
            // 'is_reseller'=>$is_reseller,
            // 'reseller_id'=>$reseller_id,
            // 'updater'=>$updater,
        ]);
        $success_.="Data pelanggan $pelanggan->nama telah diupdate!";

        // return view('layouts.go-back-page', $data);
        $feedback=[
            'success_'=>$success_,
            'warnings_'=>$warnings_,
            'errors_'=>$errors_,
        ];

        return back()->with($feedback);
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
