<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Pelanggan;
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
        // Mundur, cari info tentang spk dan pelanggan terlebih dahulu, untuk mengetahui apakah sudah ada srjalan yang berkaitan dengan pelanggan ini secara keseluruhan.
        $get=$request->query();
        // dump($get);
        $spk_produk=SpkProduk::find($get['spk_produk_id']);
        $spk=Spk::find($spk_produk['spk_id']);
        $pelanggan=Pelanggan::find($spk['pelanggan_id']);
        $produk=Produk::find($spk_produk['produk_id']);
        // Apakah pelanggan ini memiliki SPK lain yang masih aktif, selain SPK yang ini? Dan dari SPK2 yang ada, apakah memiliki Nota? Lalu apakah Nota2 tersebut memiliki SrJalan?
        $spks_t_pelanggan=Spk::where('pelanggan_id',$pelanggan['id'])->where('status_tree','!=','SELESAI')->get();
        // $spk_produk_notas_terkait_pelanggan=array();
        $nota_ids_terkait_pelanggan=array();
        foreach ($spks_t_pelanggan as $spk_t_pelanggan) {
            $spk_produk_notas_terkait_spk=SpkProdukNota::where('spk_id',$spk_t_pelanggan['id'])->get();
            foreach ($spk_produk_notas_terkait_spk as $spk_produk_nota) {
                $nota_ids_terkait_pelanggan[]=$spk_produk_nota['nota_id'];
            }
        }
        // Apakah item ini sudah ada Nota nya?
        $jml_sdh_nota=0;
        $spk_produk_notas_terkait_item=SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
        $nota_ids_terkait_item=array();
        foreach ($spk_produk_notas_terkait_item as $spk_produk_nota) {
            $jml_sdh_nota+=$spk_produk_nota['jumlah'];
            $nota_ids_terkait_item[]=$spk_produk_nota['nota_id'];
        }

        // Merge keduanya lalu unique
        $nota_ids_terkait_pelanggan_or_item = array_merge($nota_ids_terkait_item,$nota_ids_terkait_pelanggan);
        $nota_ids_terkait_pelanggan_or_item = array_unique($nota_ids_terkait_pelanggan_or_item);
        dump($nota_ids_terkait_pelanggan_or_item);

        // Dari Nota2 tersebut, kita cek SrJalan nya apakah ada?
        $sj_ids_t_cust=array();
        foreach ($nota_ids_terkait_pelanggan_or_item as $nota_id) {
            $spkProNoSjs_t_cust = SpkProdukNotaSrjalan::where('nota_id',$nota_id)->get();
            foreach ($spkProNoSjs_t_cust as $spkProNoSj) {
                $sj_ids_t_cust[]=$spkProNoSj['srjalan_id'];
            }
        }
        $sj_ids_t_cust=array_unique($sj_ids_t_cust);

        // Membuat params_nota dari nota_id yang tersedia. Array yang ada di loop lagi untuk cek dan bikin object.
        $params_nota=$params_sj=array();
        foreach ($nota_ids_terkait_pelanggan_or_item as $nota_id) {
            dump($nota_id);
            $spkProNos_t_cust_d_notaID_not_spk_not_spkProduk=SpkProdukNota::where('nota_id',$nota_id)->where('spk_id','!=',$spk['id'])->where('spk_produk_id','!=',$spk_produk['id'])->get();
            // dump($spkProNos_t_cust_d_notaID_not_spk_not_spkProduk);
            foreach ($spkProNos_t_cust_d_notaID_not_spk_not_spkProduk as $spkProNo) {
                $params_nota[]=[
                    'pelanggan_id'=>$pelanggan['id'],
                    'spk_id'=>null,
                    'spk_produk_id'=>null,
                    'nota_id'=>$nota_id,
                    'spk_produk_nota_id'=>$spkProNo['id'],
                    'jumlah'=>null,
                ];
                $spkProNoSjs_t_cust=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spkProNo['id'])->get();
                foreach ($spkProNoSjs_t_cust as $spkProNoSj) {
                    $params_sj[]=[
                        'pelanggan_id'=>$pelanggan['id'],
                        'spk_id'=>null,
                        'spk_produk_id'=>null,
                        'nota_id'=>$nota_id,
                        'spk_produk_nota_id'=>$spkProNo['id'],
                        'spk_produk_nota_sj_id'=>$spkProNoSj['id'],
                        'srjalan_id'=>$spkProNoSj['srjalan_id'],
                        'jumlah'=>null,
                    ];
                }
            }
            $spkProNos_t_cust_d_notaID_d_spk_not_spkProduk=SpkProdukNota::where('nota_id',$nota_id)->where('spk_id',$spk['id'])->where('spk_produk_id','!=',$spk_produk['id'])->get();
            foreach ($spkProNos_t_cust_d_notaID_d_spk_not_spkProduk as $spkProNo) {
                $params_nota[]=[
                    'pelanggan_id'=>$pelanggan['id'],
                    'spk_id'=>$spk['id'],
                    'spk_produk_id'=>null,
                    'nota_id'=>$nota_id,
                    'spk_produk_nota_id'=>$spkProNo['id'],
                    'jumlah'=>null,
                ];
                $spkProNoSjs_t_cust_d_spk=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spkProNo['id'])->get();
                foreach ($spkProNoSjs_t_cust_d_spk as $spkProNoSj) {
                    $params_sj[]=[
                        'pelanggan_id'=>$pelanggan['id'],
                        'spk_id'=>$spk['id'],
                        'spk_produk_id'=>null,
                        'nota_id'=>$nota_id,
                        'spk_produk_nota_id'=>$spkProNo['id'],
                        'spk_produk_nota_sj_id'=>$spkProNoSj['id'],
                        'srjalan_id'=>$spkProNoSj['srjalan_id'],
                        'jumlah'=>null,
                    ];
                }
            }
            $spkProNos_t_cust_d_notaID_d_spk_d_spkProduk=SpkProdukNota::where('nota_id',$nota_id)->where('spk_id',$spk['id'])->where('spk_produk_id',$spk_produk['id'])->get();
            foreach ($spkProNos_t_cust_d_notaID_d_spk_d_spkProduk as $spkProNo) {
                $params_nota[]=[
                    'pelanggan_id'=>$pelanggan['id'],
                    'spk_id'=>$spk['id'],
                    'spk_produk_id'=>$spk_produk['id'],
                    'nota_id'=>$nota_id,
                    'spk_produk_nota_id'=>$spkProNo['id'],
                    'jumlah'=>$spkProNo['jumlah'],
                ];
                $spkProNoSjs_t_cust_d_spk_d_item=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spkProNo['id'])->get();
                foreach ($spkProNoSjs_t_cust_d_spk_d_item as $spkProNoSj) {
                    $params_sj[]=[
                        'pelanggan_id'=>$pelanggan['id'],
                        'spk_id'=>$spk['id'],
                        'spk_produk_id'=>$spk_produk['id'],
                        'nota_id'=>$nota_id,
                        'spk_produk_nota_id'=>$spkProNo['id'],
                        'spk_produk_nota_sj_id'=>$spkProNoSj['id'],
                        'srjalan_id'=>$spkProNoSj['srjalan_id'],
                        'jumlah'=>$spkProNoSj['jumlah'],
                    ];
                }
            }
        }

        dump('params_nota awal:',$params_nota);
        $i_toUnset=array();
        for ($i=0; $i < count($params_nota); $i++) {
            for ($j=$i+1; $j < count($params_nota); $j++) {
                if ($params_nota[$i]['nota_id']==$params_nota[$j]['nota_id']) {
                    $i_toUnset[]=$i;
                }
            }
        }
        foreach ($i_toUnset as $i) {
            unset($params_nota[$i]);
        }
        $params_nota=array_values($params_nota);

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

        $menus=[
            ['route'=>'SPK-Detail','nama'=>'Detail SPK','method'=>'get','params'=>['name'=>'spk_id','value'=>$spk['id']]],
        ];
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
            'params_sj'=>$params_sj,
            'nota_ids_terkait_pelanggan_or_item'=>$nota_ids_terkait_pelanggan_or_item,
            'menus'=>$menus,
        ];
        dump($data);
        return view('tree.tree', $data);
    }
}
