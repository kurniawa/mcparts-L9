<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use App\Models\Srjalan;
use Illuminate\Http\Request;

class SjItemController extends Controller
{
    public function SjItemBaru_DB(Request $request)
    {
        $run_db=true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        $post = $request->input();
        $spk_produk_id=$post['spk_produk_id'];
        $jumlahs=$post['jumlahs'];
        $spk_produk_nota_ids=$post['spk_produk_nota_ids'];
        $nota_ids=$post['nota_ids'];

        // return $post;

        // testing dengan get
        // $get=$request->query();
        // $spk_produk_id=$get['spk_produk_id'];
        // $jumlahs=$get['jumlahs'];
        // $spk_produk_nota_ids=$get['spk_produk_nota_ids'];
        // $nota_ids=$get['nota_ids'];
        // dd($get);

        if ($run_db) {
            $srjalan_id=null;
            for ($i=0; $i < count($nota_ids); $i++) {
                if ($i===0) {
                    $success_logs[]="Mulai membuat SrJalan baru. Seharusnya terjadi hanya pada loop 1. Loop berikutnya sudah diketahui srjalan_id nya";
                    list($srjalan_id,$success_logs2)=Srjalan::newSrjalan_basedOn_SpkProdukNotaID_a_Jml($spk_produk_nota_ids[$i],(int)$jumlahs[$i]);
                    array_merge($success_logs,$success_logs2);
                } else {
                    $success_logs[]="Pada loop 1 seharusnya sudah diketahui srjalan_id: $srjalan_id.";
                    $success_logs2=Srjalan::newSpkProdukNotaSrjalan_basedOn_SrJalanID_SpkProdukNotaID_a_Jml($srjalan_id,$spk_produk_nota_ids[$i],(int)$jumlahs[$i]);
                    array_merge($success_logs,$success_logs2);
                }
            }

            Srjalan::Update_SPK_JmlSj_Status_Packing($spk_produk_id);
            $success_logs[]="Updating spk_produk->jumlah_sudah_srjalan dan status.";
            $main_log='Success';
        }

        $data=[
            'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
        ];
        return $data;
    }

    public function SjItemAva_DB(Request $request)
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
        return $post;

        // cek apakah jumlah sesuai
        $jml_input=0;
        foreach ($post['jumlah'] as $jumlah) {
            $jml_input+=(int)$jumlah;
        }
        $jml_maks=0;
        foreach ($post['spk_produk_nota_id'] as $spk_produk_nota_id) {
            $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_id);
            $jml_maks+=$spk_produk_nota['jumlah'];
        }
        if ((int)$jml_input<=0||$jml_input>$jml_maks) {
            $run_db=false;
            $error_logs[]='Jumlah yang tersedia untuk dapat diinput ke SrJalan Baru tidak sesuai!';
            $main_log='Error';
        }
        //mulai looping spk_produk_nota_id
        if ($run_db) {
            $i=0;
            foreach ($post['spk_produk_nota_id'] as $spk_produk_nota_id) {
                if ($post['jumlah'][$i]>0) {
                    $success_logs2=Srjalan::SpkProdukNotaSrjalan_cek_SpkProdukNotaID_ifSama_updateJml_ifBeda_newSpkProdukNotaSrjalan($spk_produk_nota_id,$post['srjalan_id'][$i],$post['jumlah'][$i]);
                    array_merge($success_logs,$success_logs2);
                }
                $i++;
            }
            Srjalan::Update_SPK_JmlSj_Status_Packing($post['spk_produk_id']);
            $success_logs[]="Updating spk_produk->jumlah_sudah_srjalan dan status.";
            $main_log='Success';
        }

        $spk_produk=SpkProduk::find($post['spk_produk_id']);

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
