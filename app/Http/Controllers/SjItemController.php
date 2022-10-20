<?php

namespace App\Http\Controllers;

use App\Helpers\UpdateDataSPK;
use App\Models\SiteSetting;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
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
        // dd($post);
        $spk_produk_id=$post['spk_produk_id'];
        $jumlahs=$post['jumlahs'];
        $spk_produk_nota_ids=$post['spk_produk_nota_ids'];
        $nota_ids=$post['nota_ids'];
        // dump('post',$post);

        // cek apakah jumlah yang ingin di input ke sj sudah sesuai. Apakah sudah ada sj yang sempat dibuat,
        // Kalau sudah ada, berapa banyak dan masih bisa input berapa lagi.
        list($result,$message)=UpdateDataSPK::sjBaru_isJumlahSesuai($spk_produk_nota_ids,$jumlahs);
        if ($result==='error') {
            return back()->with('error',$message);
        }
        // dd($post);

        if ($run_db) {
            $srjalan_id=null;
            $nota_ids_copy=$nota_ids;
            for ($i=0; $i < count($nota_ids); $i++) {
                array_splice($nota_ids_copy,0,1);
                array_values($nota_ids_copy);

                if ($jumlahs[$i]!==null) {
                    $is_in_array=array_search($nota_ids[$i],$nota_ids_copy);
                    if ($is_in_array===false) {
                        $success_logs[]="Mulai membuat SrJalan baru. Seharusnya terjadi hanya pada loop 1. Loop berikutnya sudah diketahui srjalan_id nya";
                        list($srjalan_id,$success_logs2)=Srjalan::newSrjalan_basedOn_SpkProdukNotaID_a_Jml($spk_produk_nota_ids[$i],(int)$jumlahs[$i]);
                        array_merge($success_logs,$success_logs2);
                    } else {
                        $success_logs[]="Pada loop 1 seharusnya sudah diketahui srjalan_id: $srjalan_id.";
                        $success_logs2=Srjalan::newSpkProdukNotaSrjalan_basedOn_SrJalanID_SpkProdukNotaID_a_Jml($srjalan_id,$spk_produk_nota_ids[$i],(int)$jumlahs[$i]);
                        array_merge($success_logs,$success_logs2);
                    }
                }

            }

            // sementara ubah sebisa
            Srjalan::Update_SPK_JmlSj_Status_Packing_BasedOn_SPKProID($spk_produk_id);
            $success_logs[]="Updating spk_produk->jumlah_sudah_srjalan dan status.";
            $main_log='Success';
        }

        $data=[
            'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
        ];
        return back()->with('success','Berhasil create Sr. Jalan Baru!');
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
            Srjalan::Update_SPK_JmlSj_Status_Packing_BasedOn_SPKProID($post['spk_produk_id']);
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

    public function editJmlSpkPNSJ(Request $request)
    {
        $run_db=true;
        $success_logs = $error_logs = $warning_logs="";
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        $post = $request->input();
        // dd($post);
        // dump($post);
        $spk_produk_nota_sj_id=$post['spk_produk_nota_sj_id'];
        $srjalan_id=$post['srjalan_id'];
        $jumlah=(int)$post['jumlah'];
        $spk_produk_id=$post['spk_produk_id'];
        $nota_id=$post['nota_id'];
        $submit=$post['submit'];


        if ($submit==='edit') {
            /**PENGECEKAN */
            /**Cek apakah semua input jumlah===null */
            if ($jumlah===0 || $jumlah<0) {
                return back()->with('error','Input jumlah harus lebih dari 0!');
            }
            if ($jumlah===null) {
                return back()->with('error','Input jumlah tidak valid!');
            }
            /**Cek apakah jumlah sudah sesuai dengan yang sudah surat jalan dan sudah nota */

            $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk_id)->where('nota_id',$nota_id)->get();
            $jumlah_sudah_nota=0;
            $jumlah_sudah_sj=0;
            foreach ($spk_produk_notas as $spk_produk_nota) {
                $jumlah_sudah_nota+=$spk_produk_nota['jumlah'];
                $spk_produk_nota_srjalans=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spk_produk_nota['id'])->get();
                foreach ($spk_produk_nota_srjalans as $spk_produk_nota_srjalan) {
                    $jumlah_sudah_sj+=$spk_produk_nota_srjalan['jumlah'];
                }
            }
            // dump($spk_produk_nota_srjalans);
            $jumlah_ava=$jumlah_sudah_nota-$jumlah_sudah_sj;
            // dump($jumlah_sudah_nota);
            // dump($jumlah_sudah_sj);
            // dd($jumlah_ava);
            if ($jumlah>$jumlah_ava) {
                return back()->with('error','Jumlah diinput melebihi apa jumlah yang sudah nota!');
            }


            /** */
            // dump('jumlah',$jumlah);
            if ($run_db) {
            // dd('jumlah',$jumlah);
            // if null
                if ($spk_produk_nota_sj_id===null) {
                    $spk_produk_nota=SpkProdukNota::where('spk_produk_id',$spk_produk_id)->where('nota_id',$nota_id)->first();
                    $obj_sj=new Srjalan();
                    $obj_sj->newSpkProdukNotaSrjalan_basedOn_SrJalanID_SpkProdukNotaID_a_Jml($srjalan_id,$spk_produk_nota['id'],$jumlah);
                    $success_logs.="Menginput jumlah item yang ada pada nota ke Sr. Jalan yang ada (yang terkait dengan SPK ini)...";
                    $obj_sj->Update_SPK_JmlSj_Status_Packing_BasedOn_SPKProID($spk_produk_id);
                    $success_logs.="Update yang berkaitan dengan Sr. Jalan pada table spk->jumlah_sudah_srjalan dan srjalan->jumlah_packing, dll...";
                } else {
                    $spk_produk_nota_sj=SpkProdukNotaSrjalan::find($spk_produk_nota_sj_id);
                    $spk_produk_nota_sj->jumlah=$jumlah;
                    $spk_produk_nota_sj->save();
                    $success_logs.="spk_produk_nota_sj->jumlah berhasil di edit.";

                    Srjalan::Update_SPK_JmlSj_Status_Packing_BasedOn_SPKProID($spk_produk_id);
                    $success_logs.="Updating spk_produk->jumlah_sudah_srjalan dan status.";
                    $main_log='Success';
                }
            }

        } elseif ($submit==='delete') {
            if ($run_db) {
                $success_logs.=Srjalan::deleteSJ_basedOn_SPKProNSJID($spk_produk_nota_sj_id);

                $data=[
                    'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
                ];
                // return $data;
            }
        }


        $data=[
            'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
        ];
        return back()->with('success',$success_logs);
    }

    public function delSpkPNSJ(Request $request)
    {
        $run_db=true;
        $success_logs = $error_logs = $warning_logs="";
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        $post = $request->input();
        // dd($post);
        $spk_produk_nota_sj_id=$post['spk_produk_nota_sj_id'];
        $spk_produk_id=$post['spk_produk_id'];
        // return $post;

        // $get=$request->query();
        // $spk_produk_nota_sj_id=$get['spk_produk_nota_sj_id'];
        // $spk_produk_id=$get['spk_produk_id'];
        // return $get;

        if ($run_db) {
            $spk_produk_nota_sj=SpkProdukNotaSrjalan::find($spk_produk_nota_sj_id);
            $spk_produk_nota_sj->delete();
            $success_logs.='spk_produk_nota_sj: berhasil dihapus!';

            //UPDATE spk_produk->jml_sdh_nota
            Srjalan::Update_SPK_JmlSj_Status_Packing_BasedOn_SPKProID($spk_produk_id);
            $success_logs.="Updating spk_produk->jumlah_sudah_srjalan dan status.";
            $main_log='Success';

            // cek apakah surat jalan masih memiliki spk_produk_nota_srjalan yang selain yang ini?
            $srjalan=Srjalan::find($spk_produk_nota_sj['srjalan_id']);
            $spk_produk_nota_sj_other=SpkProdukNotaSrjalan::where('srjalan_id',$srjalan['id'])->get();
            if (count($spk_produk_nota_sj_other)===0) {
                $srjalan->delete();
                $success_logs.="Srjalan tidak memiliki spk_produk_nota_srjalan yang lain. Srjalan dihapus!";
            } else {
                $success_logs.="Srjalan masih memiliki spk_produk_nota_srjalan yang lain. Srjalan tidak dihapus.";
            }

            $data=[
                'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
            ];
            // return $data;
            return back()->with('success',$success_logs);
        }
    }
}
