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
        dump($get);
        $spk_produk=SpkProduk::find($get['spk_produk_id']);
        $spk=Spk::find($spk_produk['spk_id']);
        $produk=Produk::find($spk_produk['produk_id']);
        // Apakah item ini sudah ada Nota nya?
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

        $jml_sdh_nota=0;
        $spk_produk_notas_terkait_item=SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
        foreach ($spk_produk_notas_terkait_item as $spk_produk_nota) {
            $jml_sdh_nota+=$spk_produk_nota['jumlah'];
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
        ];
        dump($data);
        return view('tree.tree', $data);
    }
}
