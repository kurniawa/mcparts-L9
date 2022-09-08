<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Produk;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use Illuminate\Http\Request;

class TreeController extends Controller
{
    public function index(Request $request)
    {
        SiteSettings::loadNumToZero();

        // Pencarian data keseluruhan
        // Mundur, cari info tentang spk terlebih dahulu, untuk mengetahui apakah sudah ada srjalan yang berkaitan dengan spk ini secara keseluruhan.
        $get=$request->query();
        // dump($get);
        $spk_produk=SpkProduk::find($get['spk_produk_id']);
        $spk=Spk::find($spk_produk['spk_id']);
        $produk=Produk::find($spk_produk['produk_id']);
        // Apakah item ini sudah ada Nota nya?
        $jml_sdh_nota=0;
        $spk_produk_notas_terkait_item=SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
        $nota_ids_terkait_item=array();
        foreach ($spk_produk_notas_terkait_item as $spk_produk_nota) {
            $jml_sdh_nota+=$spk_produk_nota['jumlah'];
            $nota_ids_terkait_item[]=$spk_produk_nota['nota_id'];
        }
        // Apakah SPK ini sudah ada Nota nya?
        $nota_ids_terkait_spk=array();
        $spk_produk_notas_terkait_spk=SpkProdukNota::where('spk_id',$spk['id'])->get();
        foreach ($spk_produk_notas_terkait_spk as $spk_produk_nota) {
            $nota_ids_terkait_spk[]=$spk_produk_nota['nota_id'];
        }
        // Merge keduanya lalu unique
        $nota_ids_terkait_spk_d_item = array_merge($nota_ids_terkait_item,$nota_ids_terkait_spk);
        $nota_ids_terkait_spk_d_item = array_unique($nota_ids_terkait_spk_d_item);
        // dump($nota_ids_terkait_spk_d_item);
        // Membuat params_nota dari nota_id yang tersedia. Array yang ada di loop lagi untuk cek dan bikin object.
        $params_nota=array();
        foreach ($nota_ids_terkait_spk_d_item as $nota_id) {
            $spkProdukNota_t_spk_d_nota_ID_not_spkProduk=SpkProdukNota::where('nota_id',$nota_id)->where('spk_id',$spk['id'])->where('spk_produk_id',$spk_produk['id'])->first();
            // dump($spkProdukNota_t_spk_d_nota_ID_not_spkProduk);
            if ($spkProdukNota_t_spk_d_nota_ID_not_spkProduk===null) {
                $params_nota[]=[
                    'spk_id'=>$spk['id'],
                    'spk_produk_id'=>null,
                    'nota_id'=>$nota_id,
                    'spk_produk_nota_id'=>null,
                    'jumlah'=>null,
                ];
            } else {
                $params_nota[]=[
                    'spk_id'=>$spk['id'],
                    'spk_produk_id'=>$spk_produk['id'],
                    'nota_id'=>$nota_id,
                    'spk_produk_nota_id'=>$spkProdukNota_t_spk_d_nota_ID_not_spkProduk['id'],
                    'jumlah'=>$spkProdukNota_t_spk_d_nota_ID_not_spkProduk['jumlah'],
                ];
            }
        }

        $spk_produk_nota_sjs_terkait_spk=SpkProdukNotaSrjalan::where('spk_id',$spk['id'])->get();
        $sj_ids_terkait_spk=array();
        foreach ($spk_produk_nota_sjs_terkait_spk as $spk_produk_nota_sj) {
            $sj_ids_terkait_spk[]=$spk_produk_nota_sj['id'];
        }
        $sj_ids_terkait_spk=array_unique($sj_ids_terkait_spk);

        $params=array();
        $spk_produk_nota_sjs_terkait_item=SpkProdukNotaSrjalan::where('spk_produk_id',$spk_produk['id'])->get();
        foreach ($sj_ids_terkait_spk as $sj_id) {
            $exist='no';$spk_produk_nota_sj_id_terkait_item=null;
            foreach ($spk_produk_nota_sjs_terkait_item as $spk_produk_nota_sj) {
                if ($spk_produk_nota_sj['srjalan_id']==$sj_id) {
                    $exist='yes';
                    $spk_produk_nota_sj_id_terkait_item=$spk_produk_nota_sj['id'];
                }
            }

            if ($exist==='no') {
                if ($exist==='no') {
                    $params[]=[
                        'sj_id_terkait_spk'=>$sj_id,
                        'spk_produk_nota_sj_id_terkait_item'=>'',
                    ];
                } else {
                    $params[]=[
                        'sj_id_terkait_spk'=>$sj_id,
                        'spk_produk_nota_sj_id_terkait_item'=>$spk_produk_nota_sj_id_terkait_item,
                    ];
                }
            }
        }
        $jml_sdh_sj=0;
        foreach ($spk_produk_nota_sjs_terkait_item as $spk_produk_nota_sj) {
            $jml_sdh_sj+=$spk_produk_nota_sj['jumlah'];
        }
        $jml_av=$jml_sdh_nota-$jml_sdh_sj;
        $data=[
            'spk_produk'=>$spk_produk,
            'spk'=>$spk,
            'produk'=>$produk,
            'spk_produk_notas_terkait_item'=>$spk_produk_notas_terkait_item,
            'spk_produk_nota_sjs_terkait_item'=>$spk_produk_nota_sjs_terkait_item,
            'spk_produk_nota_sjs_terkait_spk'=>$spk_produk_nota_sjs_terkait_spk,
            'jml_av'=>$jml_av,
            'params'=>$params,
            'params_nota'=>$params_nota,
        ];
        dump($data);
        return view('tree.tree', $data);
    }
}
