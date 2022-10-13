<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Nota;
use App\Models\PelangganNamaproduk;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class NotaDetailController extends Controller
{
    public function notaSelesai(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();
        // dd('$get:', $get);
        $nota_id=$get['nota_id'];

        $pbj_nota = new Nota();
        list($nota, $pelanggan, $alamat, $reseller, $spk_produk_notas, $spk_produks, $produks) = $pbj_nota->getOneNotaAndComponents($nota_id);

        // Setting untuk nama nota khusus pelanggan apabila tersedia
        $nama_notas=array();
        for ($i=0; $i < count($spk_produk_notas); $i++) {
            $nama_nota=$produks[$i]['nama_nota'];
            if ($spk_produk_notas[$i]['namaproduk_id']!==null) {
                $pelanggan_namaproduk=PelangganNamaproduk::find($spk_produk_notas[$i]['namaproduk_id']);
                $nama_nota=$pelanggan_namaproduk['nama_nota'];
            }
            $nama_notas[]=$nama_nota;
        }

        $data = [
            'csrf' => csrf_token(),
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'nota' => $nota,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'reseller' => $reseller,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
            'nama_notas' => $nama_notas,
        ];

        return view('nota.notaSelesai', $data);
    }

    public function notaSelesaiDB(Request $request)
    {

        $load_num = SiteSetting::find(1);
        $run_db = true;

        $success_logs = $error_logs =$warning_logs= array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dump($post);
        $nota_id = $post['nota_id'];
        $finished_at=$post['tgl_selesai'];
        // dump($finished_at);
        // $finished_at=date('d-m-Y H:i:s', strtotime($finished_at));
        // dd($finished_at);

        if ($run_db) {
            $nota = Nota::find($nota_id);
            $nota->finished_at=$finished_at;
            $nota->save();

            $success_logs[]='Berhasil update tanggal selesai dari Nota terkait!';

            $main_log = 'SUCCESS:';
        }

        $route='Nota-Detail';
        $route_btn='Ke Detail Nota';
        $params=['nota_id'=>$nota_id];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }
}
