<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Helpers\UpdateDataSPK;
use App\Models\Produk;
use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\SpkProduk;
use Illuminate\Http\Request;

class SpkItemController extends Controller
{
    public function deviasi(Request $request)
    {
        SiteSettings::loadNumToZero();

        $tipe = $request->query('tipe');

        $spk_produk = SpkProduk::find($request->query('spk_produk_id'));
        $produk = Produk::find($spk_produk['produk_id']);

        // dump($spk_produk);

        if ($tipe==='deviasi') {
            $judul='Deviasi Jumlah';$label='Ganti Deviasi';$input='deviasi_jml';$tipe_input='number';
        } elseif ($tipe==='jumlah') {
            $judul='Ganti Jumlah';$label='Ganti Jumlah';$input='jumlah';$tipe_input='number';
        } elseif ($tipe==='keterangan') {
            $judul='Keterangan';$label='Keterangan';$input='keterangan';$tipe_input='text';
        } elseif ($tipe==='selesai') {
            $judul='Menentukan Jml. Selesai Item';$label='Jml. Selesai';$input='jml_selesai';$tipe_input='number';
        }

        $data=[
            'tipe'=>$tipe,
            'spk_produk'=>$spk_produk,
            'produk'=>$produk,
            'judul'=>$judul,
            'label'=>$label,
            'input'=>$input,
            'tipe_input'=>$tipe_input,
        ];

        return view('spk.deviasi', $data);
    }
    public function deviasi_db(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }


        $post = $request->input();
        // dump($post);

        $spk_produk=SpkProduk::find($post['id']);
        if ($post['tipe']==='deviasi') {
            $spk_produk->deviasi_jml = $post['deviasi_jml'];
            if ($run_db) {
                $spk_produk->save();
                $success_logs[]='Berhasil update deviasi!';
                UpdateDataSPK::All($spk_produk['spk_id']);
                $main_log='Success';
            }
        } else if ($post['tipe']==='jumlah') {
            $spk_produk->jumlah=$post['jumlah'];
            if ($run_db) {
                $spk_produk->save();
                $success_logs[]='Berhasil update jumlah!';
                UpdateDataSPK::All($spk_produk['spk_id']);
                $main_log='Success';
            }
        } else if ($post['tipe']==='keterangan') {
            $spk_produk->ktrg=$post['keterangan'];
            if ($run_db) {
                $spk_produk->save();
                $success_logs[]='Berhasil update keterangan!';
                $main_log='Success';
            }
        } else if ($post['tipe']==='selesai') {
            if ($post['jml_selesai']<=$spk_produk['jml_t']) {
                $spk_produk->jml_selesai=$post['jml_selesai'];
                if ($run_db) {
                    $spk_produk->save();
                    $success_logs[]='Berhasil update selesai!';
                    $main_log='Success';
                }
            } else {
                $error_logs[]='Update tidak berhasil, karena jml_selesai tidak sesuai dengan ketersediaan dari jml_t';
                $main_log='Failed!';
            }
        }

        $route='SPK-Detail';
        $params=['spk_id'=>$spk_produk['spk_id']];
        $route_btn='Ke Detail SPK';
        $data=[
            'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params
        ];
        return view('layouts.db-result', $data);
    }

    public function hapusItemSPK(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $spk_produk = SpkProduk::find($request->input('spk_produk_id'));
        if ($run_db) {
            $spk_produk->delete();
            $warning_logs[]="Berhasil menghapus Item SPK!";
            $main_log='Success!';

            UpdateDataSPK::All($spk_produk['spk_id']);
            $success_logs[]='Berhasil update semua data SPK yang berkaitan.';
        }

        $route = 'SPK-Detail';
        $route_btn='Ke Detail SPK';
        $params=['spk_id'=>$spk_produk['spk_id']];
        $data = [
            'error_logs' => $error_logs,'warning_logs' => $warning_logs,'success_logs' => $success_logs,'main_log'=>$main_log,
            'route' => $route,'route_btn' => $route_btn,'params' => $params,
        ];


        return view('layouts.db-result', $data);
    }

    public function ItemSelesai_All(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $spk_id = $request->post('spk_id');
        $spk_produks=SpkProduk::where('spk_id',$spk_id)->get();
        foreach ($spk_produks as $spk_produk) {
            $spk_produk->jml_selesai=$spk_produk['jml_t'];
            if ($run_db) {
                $spk_produk->save();
                $success_logs[]='SPK Item berhasil diperbaharui!';
            }
        }
        if ($run_db) {
            UpdateDataSPK::All($spk_id);
            $success_logs[]='Update All Data SPK!';
            $main_log='Success';
        }

        $route = 'SPK-Detail';
        $route_btn='Ke Detail SPK';
        $params=['spk_id'=>$spk_id];
        $data = [
            'error_logs' => $error_logs,'warning_logs' => $warning_logs,'success_logs' => $success_logs,'main_log'=>$main_log,
            'route' => $route,'route_btn' => $route_btn,'params' => $params,
        ];


        return view('layouts.db-result', $data);
    }
}
