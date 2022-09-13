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


    public function SjItemAva(Request $request)
    {
        SiteSettings::loadNumToZero();

        // Pencarian data keseluruhan
        // Mundur, cari info tentang spk terlebih dahulu, untuk mengetahui apakah sudah ada srjalan yang berkaitan dengan spk ini secara keseluruhan.
        $spk=Spk::find($request->query('spk_id'));
        $spk_produks=SpkProduk::where('spk_id', $spk['id'])->get();

        $spk_produk_nota_srjalanss=$srjalan_ids_terkait_spk=array();
        foreach ($spk_produks as $spk_produk) {
            $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
            foreach ($spk_produk_notas as $spk_produk_nota) {
                $spk_produk_nota_srjalans=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spk_produk_nota['id'])->get();
                foreach ($spk_produk_nota_srjalans as $spk_produk_nota_srjalan) {
                    $spk_produk_nota_srjalanss[]=$spk_produk_nota_srjalan;
                    $srjalan_ids_terkait_spk[]=$spk_produk_nota_srjalan['srjalan_id'];
                }
            }
        }
        // kalo ada srjalan yang sama, di filter disini.
        // dump($srjalan_ids_terkait_spk);
        $srjalan_ids_terkait_spk=array_unique($srjalan_ids_terkait_spk);
        // dump($srjalan_ids_terkait_spk);
        // Pencarian data spesifik yang terkait dengan spk_produk_id
        $spk_produk_id = $request->query('spk_produk_id');
        $spk_produk=SpkProduk::find($spk_produk_id);
        $produk=Produk::find($spk_produk['id']);

        $related_spk_produk_nota_srjalanss=array();
        $kombi_sjID_spkProdNoSJ=array(); // kombinasi antara srjalan_id yang terkait spk dengan spk_produk_nota_srjalan_id yang terkait dengan spk_produk
        $related_spk_produk_notas = SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
        $spk_produk_nota_ids_basedOn_spk_produk_id=array();
        $jml_av=$jml_sdh_nota=$jml_sdh_sj=0;
        foreach ($related_spk_produk_notas as $spk_produk_nota) {
            $spk_produk_nota_srjalans=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spk_produk_nota['id'])->get();
            if (count($spk_produk_nota_srjalans)!==0) {
                foreach ($spk_produk_nota_srjalans as $spk_produk_nota_srjalan) {
                    $related_spk_produk_nota_srjalanss[]=$spk_produk_nota_srjalan;
                    $jml_sdh_sj+=$spk_produk_nota_srjalan['jumlah'];
                }
            }
            $jml_sdh_nota+=$spk_produk_nota['jumlah'];
            $spk_produk_nota_ids_basedOn_spk_produk_id[]=$spk_produk_nota['id'];
        }
        foreach ($srjalan_ids_terkait_spk as $srjalan_id) {
            if (count($related_spk_produk_nota_srjalanss)===0) {
                if (count($kombi_sjID_spkProdNoSJ)===0) {
                    $data_kombi=[
                        'srjalan_id'=>$srjalan_id,
                        'spk_produk_nota_srjalan_id'=>"",
                    ];
                    $kombi_sjID_spkProdNoSJ[]=$data_kombi;
                } else {
                    $exist='no';
                    for ($j=0; $j < count($kombi_sjID_spkProdNoSJ); $j++) {
                        if ($kombi_sjID_spkProdNoSJ[$j]['srjalan_id']==$srjalan_id && $kombi_sjID_spkProdNoSJ[$j]['spk_produk_nota_srjalan_id']=="") {
                            $exist='yes';
                        }
                    }
                    if ($exist==='no') {
                        $kombi_sjID_spkProdNoSJ[]=[
                            'srjalan_id'=>$srjalan_id,
                            'spk_produk_nota_srjalan_id'=>"",
                        ];
                    }
                }
            } else {
                for ($i=0; $i < count($related_spk_produk_nota_srjalanss); $i++) {
                    if (count($kombi_sjID_spkProdNoSJ)===0) {
                        if ($srjalan_id==$related_spk_produk_nota_srjalanss[$i]['srjalan_id']) {
                            $data_kombi=[
                                'srjalan_id'=>$srjalan_id,
                                'spk_produk_nota_srjalan_id'=>$related_spk_produk_nota_srjalanss[$i]['id'],
                            ];
                        } else {
                            $data_kombi=[
                                'srjalan_id'=>$srjalan_id,
                                'spk_produk_nota_srjalan_id'=>"",
                            ];
                        }
                        $kombi_sjID_spkProdNoSJ[]=$data_kombi;
                    } else {
                        if ($srjalan_id==$related_spk_produk_nota_srjalanss[$i]['srjalan_id']) {
                            $exist='no';
                            for ($j=0; $j < count($kombi_sjID_spkProdNoSJ); $j++) {
                                if ($kombi_sjID_spkProdNoSJ[$j]['srjalan_id']==$srjalan_id&&$kombi_sjID_spkProdNoSJ[$j]['spk_produk_nota_srjalan_id']==$related_spk_produk_nota_srjalanss[$i]['id']) {
                                    $exist='yes';
                                }
                            }
                            if ($exist==='no') {
                                $kombi_sjID_spkProdNoSJ[]=[
                                    'srjalan_id'=>$srjalan_id,
                                    'spk_produk_nota_srjalan_id'=>$related_spk_produk_nota_srjalanss[$i]['id'],
                                ];
                            }
                        } else {
                            $exist='no';
                            for ($j=0; $j < count($kombi_sjID_spkProdNoSJ); $j++) {
                                if ($kombi_sjID_spkProdNoSJ[$j]['srjalan_id']==$srjalan_id&&$kombi_sjID_spkProdNoSJ[$j]['spk_produk_nota_srjalan_id']=="") {
                                    $exist='yes';
                                }
                            }
                            if ($exist==='no') {
                                $kombi_sjID_spkProdNoSJ[]=[
                                    'srjalan_id'=>$srjalan_id,
                                    'spk_produk_nota_srjalan_id'=>"",
                                ];
                            }
                        }
                    }
                }
            }
        }
        $params=array();
        $spk_produk_nota_ids_basedOn_spk_produk_id=array_unique($spk_produk_nota_ids_basedOn_spk_produk_id);
        foreach ($spk_produk_nota_ids_basedOn_spk_produk_id as $spk_produk_nota_id) {
            $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_id);
            foreach ($kombi_sjID_spkProdNoSJ as $kombi) {
                if ($kombi['spk_produk_nota_srjalan_id']!=="") {
                    $spk_produk_nota_srjalan=SpkProdukNotaSrjalan::find($kombi['spk_produk_nota_srjalan_id']);
                    if ($spk_produk_nota['nota_id']==$spk_produk_nota_srjalan['nota_id']) {
                        $params[]=[
                            'srjalan_id'=>$kombi['srjalan_id'],
                            'spk_produk_nota_srjalan_id'=>$kombi['spk_produk_nota_srjalan_id'],
                            'spk_produk_nota_id'=>$spk_produk_nota['id'],
                            'nota_id'=>$spk_produk_nota['nota_id'],
                        ];
                    }
                } else {
                    $params[]=[
                        'srjalan_id'=>$kombi['srjalan_id'],
                        'spk_produk_nota_srjalan_id'=>"",
                        'spk_produk_nota_id'=>$spk_produk_nota['id'],
                        'nota_id'=>$spk_produk_nota['nota_id'],
                    ];
                }
            }
        }
        $jml_av=$jml_sdh_nota-$jml_sdh_sj;
        $data=[
            'produk'=>$produk,
            'spk_produk'=>$spk_produk,
            'related_spk_produk_notas'=>$related_spk_produk_notas,
            'related_spk_produk_nota_srjalanss'=>$related_spk_produk_nota_srjalanss,
            'spk_produk_nota_srjalanss'=>$spk_produk_nota_srjalanss,
            'srjalan_ids_terkait_spk'=>$srjalan_ids_terkait_spk,
            'jml_av'=>$jml_av,
            'spk_produk_nota_ids_basedOn_spk_produk_id'=>$spk_produk_nota_ids_basedOn_spk_produk_id,
            'kombi_sjID_spkProdNoSJ'=>$kombi_sjID_spkProdNoSJ,
            'params'=>$params,
        ];
        dump($data);
        return view('srjalan.SjItemAva', $data);

    }

    public function SjItemBaru(Request $request)
    {
        SiteSettings::loadNumToZero();

        // Pencarian data keseluruhan
        // Mundur, cari info tentang spk terlebih dahulu, untuk mengetahui apakah sudah ada srjalan yang berkaitan dengan spk ini secara keseluruhan.
        $spk=Spk::find($request->query('spk_id'));
        $spk_produk=SpkProduk::find($request->query('spk_produk_id'));
        $produk=Produk::find($spk_produk['produk_id']);
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
            'produk'=>$produk,
            'spk_produk'=>$spk_produk,
            'spk_produk_notas_terkait_item'=>$spk_produk_notas_terkait_item,
            'spk_produk_nota_sjs_terkait_item'=>$spk_produk_nota_sjs_terkait_item,
            'spk_produk_nota_sjs_terkait_spk'=>$spk_produk_nota_sjs_terkait_spk,
            'jml_av'=>$jml_av,
            'params'=>$params,
        ];
        dump($data);
        return view('srjalan.SjItemBaru', $data);

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
            $exist='no';$spk_produk_nota_id_terkait_item=null;
            foreach ($spk_produk_notas_terkait_item as $spk_produk_nota) {
                // dump($nota_id,$spk_produk_nota['nota_id']);
                if ($nota_id==$spk_produk_nota['nota_id']) {
                    $exist='yes';
                    $spk_produk_nota_id_terkait_item=$spk_produk_nota['id'];
                }
            }
            // dump($exist);
            if ($exist==='no') {
                $params[]=[
                    'nota_id_terkait_spk'=>$nota_id,
                    'spk_produk_nota_id_terkait_item'=>'',
                ];
            } else {
                $params[]=[
                    'nota_id_terkait_spk'=>$nota_id,
                    'spk_produk_nota_id_terkait_item'=>$spk_produk_nota_id_terkait_item,
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
        // dump($data);
        return view('nota.NotaItemAva', $data);

    }

    public function NotaItemBaru(Request $request)
    {
        SiteSettings::loadNumToZero();

        $spk_produk_id = $request->query('spk_produk_id');
        $spk_produk=SpkProduk::find($spk_produk_id);
        $produk=Produk::find($spk_produk['produk_id']);
        $spk_produk_notas = SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
        $data=[
            'produk'=>$produk,
            'spk_produk'=>$spk_produk,
            'spk_produk_notas'=>$spk_produk_notas,
        ];
        return view('nota.NotaItemBaru', $data);

    }
}
