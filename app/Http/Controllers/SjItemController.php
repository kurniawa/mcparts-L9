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
use App\Models\SpkProdukNotaSrjalan;
use App\Models\Srjalan;
use Illuminate\Http\Request;

class SjItemController extends Controller
{
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

    public function SjItemBaru_DB(Request $request)
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
        // dd($post);
        // cek apakah jumlah sesuai
        $jml_input=0;
        foreach ($post['jumlah'] as $jumlah) {
            $jml_input+=(int)$jumlah;
        }
        if ((int)$post['jml_av']<=0||(int)$post['jml_av']<$jml_input) {
            $run_db=false;
            $error_logs[]='Jumlah yang tersedia untuk dapat diinput ke SrJalan Baru tidak memadai!';
            $main_log='Error';
        }
        if ($run_db) {
            $srjalan_id=null;
            $i=0;
            foreach ($post['spk_produk_nota_ids'] as $spk_produk_nota_id) {
                if ($i===0) {
                    $success_logs[]="Mulai membuat SrJalan baru. Seharusnya terjadi hanya pada loop 1. Loop berikutnya sudah diketahui srjalan_id nya";
                    list($srjalan_id,$success_logs2)=Srjalan::newSrjalan_basedOn_SpkProdukNotaID_a_Jml($spk_produk_nota_id,(int)$post['jumlah'][$i]);
                    array_merge($success_logs,$success_logs2);
                } else {
                    $success_logs[]="Pada loop 1 seharusnya sudah diketahui srjalan_id: $srjalan_id.";
                    $success_logs2=Srjalan::newSpkProdukNotaSrjalan_basedOn_SrJalanID_SpkProdukNotaID_a_Jml($srjalan_id,$spk_produk_nota_id,(int)$post['jumlah'][$i]);
                    array_merge($success_logs,$success_logs2);
                }
                $i++;
            }

            Srjalan::Update_SPK_JmlSj_Status_Packing($post['spk_produk_id']);
            $success_logs[]="Updating spk_produk->jumlah_sudah_srjalan dan status.";
            $main_log='Success';
        }

        $spk_produk_id=SpkProduk::find($post['spk_produk_id']);
        $route='SPK-Detail';
        $params=['spk_id'=>$spk_produk_id['spk_id']];
        $route_btn='Ke Detail SPK';
        $data=[
            'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params
        ];
        return view('layouts.db-result', $data);
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
        dump($post);

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
