<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Nota;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

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
        $spks_t_pelanggan=Spk::where('pelanggan_id',$pelanggan['id'])->where('status_nota','!=','SELESAI')->where('status_nota','!=','SEMUA')->get();
        // dd($spks_t_pelanggan);
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
        // dump($nota_ids_terkait_pelanggan_or_item);

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
            // dump($nota_id);
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
                $spkProNoSjs_t_cust_d_spk=SpkProdukNotaSrjalan::where('nota_id',$nota_id)->get();
                // dd($spkProNoSjs_t_cust_d_spk);
                foreach ($spkProNoSjs_t_cust_d_spk as $spkProNoSj) {
                    // $params_sj[]=[
                    //     'pelanggan_id'=>$pelanggan['id'],
                    //     'spk_id'=>$spk['id'],
                    //     'spk_produk_id'=>null,
                    //     'nota_id'=>$nota_id,
                    //     'spk_produk_nota_id'=>$spkProNo['id'],
                    //     'spk_produk_nota_sj_id'=>$spkProNoSj['id'],
                    //     'srjalan_id'=>$spkProNoSj['srjalan_id'],
                    //     'jumlah'=>null,
                    // ];
                    $params_sj[]=[
                        'pelanggan_id'=>$pelanggan['id'],
                        'spk_id'=>$spk['id'],
                        'spk_produk_id'=>null,
                        'nota_id'=>$nota_id,
                        'spk_produk_nota_id'=>null,
                        'spk_produk_nota_sj_id'=>null,
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

        // Filter params_nota
        // dump('params_nota awal:',$params_nota);
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

        // Filter params_sj
        $i_toUnset=array();
        for ($i=0; $i < count($params_sj); $i++) {
            if ($params_sj[$i]['jumlah']==null) {
                $i_toUnset[]=$i;
            }
        }
        foreach ($i_toUnset as $i) {
            unset($params_sj[$i]);
        }
        $params_sj=array_values($params_sj);

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
            ['route'=>'SPK-Detail','nama'=>'Detail SPK','method'=>'get','params'=>[['name'=>'spk_id','value'=>$spk['id']]]],
        ];
        $data=[
            'navbar_bg'=>'bg-color-orange-2',
            'go_back' => true,
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
    public function index2(Request $request)
    {
        SiteSettings::loadNumToZero();

        // Pencarian data keseluruhan
        // Mundur, cari info tentang spk dan pelanggan terlebih dahulu, untuk mengetahui apakah sudah ada srjalan yang berkaitan dengan pelanggan ini secara keseluruhan.
        $get=$request->query();
        // dump($get);
        $spk_produk=SpkProduk::find($get['spk_produk_id']);
        $produk=Produk::find($spk_produk['produk_id']);
        $spk=Spk::find($spk_produk['spk_id']);
        $pelanggan=Pelanggan::find($spk['pelanggan_id']);

        // Level 1 -> Jumlah item yang sudah di proses di SPK
        // Level Nota
        // Level Nota 1 -> nota yang berkaitan langsung dengan spk ini
        $spk_produk_notas=SpkProdukNota::where('spk_id',$spk['id'])->get();

        // Level Nota 2 -> Apakah ada nota yang "belum selesai" berkaitan dengan pelanggan selain daripada yang berkaitan dengan spk ini?
        $pelanggan_spk_with_nota_belum_selesai_others=Spk::where('pelanggan_id',$pelanggan['id'])->where('status_nota','!=','SELESAI')->where('status_nota','!=','SEMUA')->where('id','!=',$spk['id'])->get();
        $nota_t_pelanggan_belum_selesai_others=array();
        if (count($pelanggan_spk_with_nota_belum_selesai_others)!==0) {
            foreach ($pelanggan_spk_with_nota_belum_selesai_others as $this_spk) {
                $spk_pro_notas=SpkProdukNota::where('spk_id',$this_spk['id'])->get();
                foreach ($spk_pro_notas as $spk_produk_nota) {
                    $nota_t_pelanggan_belum_selesai_others[]=$spk_produk_nota['nota_id'];
                }
            }
            array_unique($nota_t_pelanggan_belum_selesai_others);
        }
        // dd($nota_t_pelanggan_belum_selesai_others);
        // Level Sr. Jalan
        // Level Sr. Jalan 1 -> Sr Jalan yang berkaitan langsung dengan spk ini
        $spk_produk_nota_srjalans=SpkProdukNotaSrjalan::where('spk_id',$spk['id'])->get();
        // Level Sr. Jalan 2 -> Srjalan belum selesai yang berkaitan dengan pelanggan selain daripada yang berkaitan dengan spk ini.
        $pelanggan_spk_with_sj_belum_selesai_others=Spk::where('pelanggan_id',$pelanggan['id'])->where('status_sj','!=','SELESAI')->where('status_sj','!=','SEMUA')->where('id','!=',$spk['id'])->get();
        $sj_t_pelanggan_belum_selesai_others=array();
        if (count($pelanggan_spk_with_sj_belum_selesai_others)!==0) {
            foreach ($pelanggan_spk_with_sj_belum_selesai_others as $this_spk) {
                $spk_pro_nota_sjs=SpkProdukNota::where('spk_id',$this_spk['id'])->get();
                foreach ($spk_pro_nota_sjs as $spk_produk_nota_sj) {
                    $sj_t_pelanggan_belum_selesai_others[]=$spk_produk_nota_sj['srjalan_id'];
                }
            }
            array_unique($sj_t_pelanggan_belum_selesai_others);
        }

        /**Array untuk looping di halaman nanti */
        $srjalan_terkait_item=$srjalan_terkait_spk=array();
        $nota_ids_sama2=array();
        foreach ($spk_produk_nota_srjalans as $spk_produk_nota_sj) {
            $j=0;
            $nota_ids_sama=array();
            foreach ($spk_produk_notas as $spk_produk_no) {
                if ($spk_produk_nota_sj['spk_produk_id']==$spk_produk['id'] && $spk_produk_nota_sj['nota_id']==$spk_produk_no['nota_id']) {
                    $is_in_array_nota_ids_sama=false;
                    // dump("spk_produk_no[nota_id]: $spk_produk_no[nota_id]");
                    $is_in_array_nota_ids_sama=array_search($spk_produk_no['nota_id'],$nota_ids_sama);
                    // dump($is_in_array_nota_ids_sama);
                    // if ($j!==0) {
                    // }
                    if ($is_in_array_nota_ids_sama==false) {
                        // dump("Terjadi pengulangan yang diharapkan pada array 1, nota_id : $spk_produk_no[nota_id]");
                        $srjalan_terkait_item[]=$spk_produk_nota_sj;
                    } else {
                        // if ($spk_produk_nota_sj['jumlah']!==null) {
                        //     $srjalan_terkait_item[]=$spk_produk_nota_sj;
                        // }
                    }
                    $nota_ids_sama[]=$spk_produk_no['nota_id'];
                } elseif ($spk_produk_nota_sj['spk_produk_id']!==$spk_produk['id'] && $spk_produk_nota_sj['nota_id']==$spk_produk_no['nota_id']) {
                    $is_in_array_nota_ids_sama2=false;

                    // dump("spk_produk_no[nota_id]: $spk_produk_no[nota_id]");
                    $is_in_array_nota_ids_sama2=array_search($spk_produk_no['nota_id'],$nota_ids_sama2);
                    // dump($is_in_array_nota_ids_sama2);
                    if ($is_in_array_nota_ids_sama2==false) {
                        // dump("Terjadi pengulangan yang diharapkan pada elif, nota_id : $spk_produk_no[nota_id]");
                        $spkpronoXspkpronosj=[
                            "id" => $spk_produk_no['id'],
                            "spk_id" => $spk_produk_no['spk_id'],
                            "produk_id" => $spk_produk_no['produk_id'],
                            "spk_produk_id" => $spk_produk_no['spk_produk_id'],
                            "nota_id" => $spk_produk_no['nota_id'],
                            "jumlah" => $spk_produk_no['jumlah'],
                            "srjalan_id" => $spk_produk_nota_sj['srjalan_id'],
                        ];
                        $srjalan_terkait_spk[]=$spkpronoXspkpronosj;
                    }
                    $nota_ids_sama2[]=$spk_produk_no['nota_id'];
                }
                $j++;
            }
            // dump($nota_ids_sama2);
        }

        // Filter Srjalan terkait SPK yang dimana seringkali id srjaln sudah ada yang sama
        // Filter akan berfungsi bila pada srjalan yang sama, produk hanya akan tercantum satu kali saja.
        $srjalan_ids_terkait_spk=array();
        foreach ($srjalan_terkait_spk as $srjalan_t_spk) {
            $srjalan_ids_terkait_spk[]=$srjalan_t_spk['srjalan_id'];
        }
        $srjalan_ids_terkait_spk_unique=array_unique($srjalan_ids_terkait_spk);
        $srjalan_terkait_spk_filtered=array();
        foreach ($srjalan_ids_terkait_spk_unique as $srjalan_id) {
            for ($i=0; $i < count($srjalan_terkait_spk); $i++) {
                if ($srjalan_terkait_spk[$i]['srjalan_id']==$srjalan_id) {
                    // Apakah di filtered sudah memiliki item dengan srjalan_id yang sama?
                    $is_exist=false;
                    foreach ($srjalan_terkait_spk_filtered as $srjalan_t_spk_filtered) {
                        if ($srjalan_t_spk_filtered['srjalan_id']==$srjalan_id) {
                            $is_exist=true;
                        }
                    }
                    if ($is_exist===false) {
                        $srjalan_terkait_spk_filtered[]=$srjalan_terkait_spk[$i];
                    }
                }
            }
        }
        // dump($srjalan_terkait_spk_filtered);

        // Filter Srjalan terkait Item yang dimana seringkali id srjaln sudah ada yang sama
        // Filter akan beranggapan bahwa pada srjalan yang sama, produk hanya akan tercantum satu kali saja.
        $srjalan_ids_terkait_item=array();
        foreach ($srjalan_terkait_item as $srjalan_t_item) {
            $srjalan_ids_terkait_item[]=$srjalan_t_item['srjalan_id'];
        }
        $srjalan_ids_terkait_item_unique=array_unique($srjalan_ids_terkait_item);
        $srjalan_terkait_item_filtered=array();
        foreach ($srjalan_ids_terkait_item_unique as $srjalan_id) {
            for ($i=0; $i < count($srjalan_terkait_item); $i++) {
                if ($srjalan_terkait_item[$i]['srjalan_id']==$srjalan_id) {
                    // Apakah di filtered sudah memiliki item dengan srjalan_id yang sama?
                    $is_exist=false;
                    foreach ($srjalan_terkait_item_filtered as $srjalan_t_item_filtered) {
                        if ($srjalan_t_item_filtered['srjalan_id']==$srjalan_id) {
                            $is_exist=true;
                        }
                    }
                    if ($is_exist===false) {
                        $srjalan_terkait_item_filtered[]=$srjalan_terkait_item[$i];
                    }
                }
            }
        }
        // dump($srjalan_terkait_item_filtered);

        $menus=[
            ['route'=>'SPK-Detail','nama'=>'Detail SPK','method'=>'get','params'=>[['name'=>'spk_id','value'=>$spk['id']]]],
        ];
        $data=[
            'navbar_bg'=>'bg-color-orange-2',
            'go_back' => true,
            'spk_produk'=>$spk_produk,
            'spk'=>$spk,
            'produk'=>$produk,
            // Level Nota
            // spk_produk_nota yang telah tersedia
            'spk_produk_notas'=>$spk_produk_notas,
            // Nota belum selesai berkaitan pelanggan selain daripada yang berkaitan dengan spk ini
            'nota_t_pelanggan_belum_selesai_others'=>$nota_t_pelanggan_belum_selesai_others,
            // Level Sr. Jalan
            'spk_produk_nota_srjalans'=>$spk_produk_nota_srjalans,
            'sj_t_pelanggan_belum_selesai_others'=>$sj_t_pelanggan_belum_selesai_others,
            'srjalan_terkait_item'=>$srjalan_terkait_item,
            'srjalan_terkait_spk'=>$srjalan_terkait_spk,
            'srjalan_terkait_spk_filtered'=>$srjalan_terkait_spk_filtered,
            'srjalan_terkait_item_filtered'=>$srjalan_terkait_item_filtered,

            'menus'=>$menus,
        ];
        // dd($data);
        // dump($data);
        return view('tree.tree2', $data);
    }
}
