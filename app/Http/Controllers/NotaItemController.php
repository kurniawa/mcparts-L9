<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Helpers\UpdateDataSPK;
use App\Models\Nota;
use App\Models\Produk;
use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use Illuminate\Http\Request;

class NotaItemController extends Controller
{
    public function NotaItemBaru(Request $request)
    {
        SiteSettings::loadNumToZero();

        $spk_produk_id = $request->query('spk_produk_id');
        $spk_produk=SpkProduk::find($spk_produk_id);
        $produk=Produk::find($spk_produk['id']);
        $spk_produk_notas = SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
        $data=[
            'produk'=>$produk,
            'spk_produk'=>$spk_produk,
            'spk_produk_notas'=>$spk_produk_notas,
        ];
        return view('nota.NotaItemBaru', $data);

    }

    public function NotaItemBaru_DB(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db=true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }


        $post = $request->input();
        // dump($post);

        $spk_produk=SpkProduk::find($post['spk_produk_id']);
        $jml_av=$spk_produk['jml_selesai']-$spk_produk['jml_sdh_nota'];
        if ($jml_av<(int)$post['jumlah']) {
            $run_db=false;
            $error_logs[]='Jumlah yang tersedia untuk dapat diinput ke nota tidak memadai!';
            $main_log='Error';
        }
        $spk=Spk::find($spk_produk['spk_id']);
        $user=auth()->user();
        $data_nota=[
            'pelanggan_id'=>$spk['pelanggan_id'],
            'reseller_id'=>$spk['reseller_id'],
            'jumlah_total'=>$post['jumlah'],
            'harga_total'=>$spk_produk['harga']*(int)$post['jumlah'],
            'created_by'=>$user['username'],
            'updated_by'=>$user['username'],
        ];
        if ($run_db) {
            $new_nota=Nota::create($data_nota);
            $success_logs[]='Nota baru telah dibuat.';
            $spk_produk_nota=[
                'spk_id'=>$spk_produk['spk_id'],
                'produk_id'=>$spk_produk['produk_id'],
                'spk_produk_id'=>$spk_produk['id'],
                'nota_id'=>$new_nota['id'],
                'jumlah'=>$post['jumlah'],
                'harga'=>$spk_produk['harga'],
                'harga_t'=>$spk_produk['harga']*(int)$post['jumlah'],
            ];
            $new_spk_produk_nota=SpkProdukNota::create($spk_produk_nota);
            $success_logs[]='spk_produk_nota baru telah dibuat.';

            //UPDATE no nota
            $new_nota->no_nota="N-$new_nota[id]";
            $new_nota->save();
            $success_logs[]='No Nota diupdate.';
            $load_num->value+=1;
            $load_num->save();
            $warning_logs[]='Load Num telah ditambah satu.';
            $main_log='Success';

            //UPDATE spk_produk->jml_sdh_nota
            UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk['id']);
            $success_logs[]='sok_produk: Jumlah Sudah Nota diupdate.';

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

    public function NotaItemAva(Request $request)
    {
        SiteSettings::loadNumToZero();

        $spk_produk_id = $request->query('spk_produk_id');
        $spk_produk=SpkProduk::find($spk_produk_id);
        // Cek terlebih dahulu, apakah spk terkait ini sudah memiliki nota
        $spk=Spk::find($spk_produk['spk_id']);
        $spk_produk_notas_terkait_spk = SpkProdukNota::where('spk_id', $spk['id'])->get();
        $nota_ids_terkait_spk=array();
        foreach ($spk_produk_notas_terkait_spk as $spk_produk_nota) {
            $nota_ids_terkait_spk[]=$spk_produk_nota['nota_id'];
        }
        $nota_ids_terkait_spk=array_unique($nota_ids_terkait_spk);
        /**
         * isi params yang dibutuhkan
         * [
         *      'nota_id'=>,
         *      'spk_produk_nota_id_terkait_item'=>, // ini nanti untuk memperjelas apakah update spk_produk_nota->jumlah atau buat spk_produk_nota baru
         * ]
         */
        $params=array();
        $spk_produk_notas_terkait_item = SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
        foreach ($nota_ids_terkait_spk as $nota_id) {
            $exist='no';
            foreach ($spk_produk_notas_terkait_item as $spk_produk_nota_terkait_item) {
                if ($nota_id==$spk_produk_nota_terkait_item['nota_id']) {
                    $exist='yes';
                }
            }
            if ($exist==='no') {
                $params[]=[
                    'nota_id_terkait_spk'=>$nota_id,
                    'spk_produk_nota_id_terkait_item'=>'',
                ];
            } else {
                $params[]=[
                    'nota_id_terkait_spk'=>$nota_id,
                    'spk_produk_nota_id_terkait_item'=>$spk_produk_nota_terkait_item['id'],
                ];
            }
        }
        $produk=Produk::find($spk_produk['id']);
        $data=[
            'produk'=>$produk,
            'spk_produk'=>$spk_produk,
            'spk_produk_notas_terkait_item'=>$spk_produk_notas_terkait_item,
            'spk_produk_notas_terkait_spk'=>$spk_produk_notas_terkait_spk,
            'params'=>$params,
        ];
        dump($data);
        return view('nota.NotaItemAva', $data);

    }

    public function NotaItemAva_DB(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db=true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->input();
        dump($post);

        $spk_produk=SpkProduk::find($post['spk_produk_id']);
        // Cek Jumlah Total di Array input jumlah
        $jumlah_input=0;
        foreach ($post['jumlah'] as $jumlah) {
            $jumlah_input+=(int)$jumlah;
        }
        if ($spk_produk['jml_selesai']<$jumlah_input) {
            $run_db=false;
            $error_logs[]='Jumlah yang tersedia untuk dapat diinput ke nota tidak memadai!';
            $main_log='Error';
        }
        $spk=Spk::find($spk_produk['spk_id']);
        $user=auth()->user();
        $i=0;
        if ($run_db) {
            foreach ($post['nota_id_terkait_spk'] as $nota_id) {
                $spk_produk_nota=null;
                if ($post['spk_produk_nota_id_terkait_item'][$i]===null) {
                    dump('masuk ke spk_produk_nota baru');
                    // Pembuatan spk_produk_nota baru
                    $spk_produk_nota=SpkProdukNota::create([
                        'spk_id'=>$spk['id'],
                        'produk_id'=>$spk_produk['produk_id'],
                        'spk_produk_id'=>$spk_produk['id'],
                        'nota_id'=>$nota_id,
                        'jumlah'=>(int)$post['jumlah'][$i],
                        'harga'=>(int)$spk_produk['harga'],
                        'harga_t'=>$spk_produk['harga']*(int)$post['jumlah'][$i],
                    ]);
                    $success_logs[]='spk_produk_nota baru telah diupdate.';
                } else {
                    dump('masuk ke update spk_produk_nota');
                    dump((int)$post['jumlah'][$i]);
                    $spk_produk_nota=SpkProdukNota::find($post['spk_produk_nota_id_terkait_item'][$i]);
                    $spk_produk_nota->jumlah=(int)$post['jumlah'][$i];
                    $spk_produk_nota->harga=$spk_produk['harga'];
                    $spk_produk_nota->harga_t=$spk_produk['harga']*(int)$post['jumlah'][$i];
                    $spk_produk_nota->save();
                    $success_logs[]='spk_produk_nota telah diupdate.';
                }

                //UPDATE spk_produk->jml_sdh_nota
                UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk['id']);
                $success_logs[]='spk_produk: Jumlah Sudah Nota diupdate.';

                UpdateDataSPK::Nota_JmlT_HargaT($spk_produk_nota['nota_id']);
                $success_logs[]='nota: Jumlah dan Harga Total Nota diupdate.';

                UpdateDataSPK::Nota_JmlT_HargaT($spk_produk_nota['nota_id']);
                $i++;
            }
            $load_num->value+=1;
            $load_num->save();
            $warning_logs[]='Load Num telah ditambah satu.';
            $main_log='Success';
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
}
