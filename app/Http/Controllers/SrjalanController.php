<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Helpers\UpdateDataSPK;
use App\Models\Alamat;
use App\Models\Daerah;
use App\Models\Ekspedisi;
use App\Models\EkspedisiAlamat;
use App\Models\Nota;
use App\Models\Pelanggan;
use App\Models\PelangganEkspedisi;
use App\Models\Produk;
use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\Srjalan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SrjalanController extends Controller
{
    public function index(Request $request)
    {
        SiteSettings::loadNumToZero();

        $srjalans = Srjalan::limit(100)->orderByDesc('created_at')->get();

        $spks=$notas=$pelanggans = $alamats = $resellers = $ekspedisis = $arr_spk_produk_nota_srjalans = $arr_spk_produk_notas = $arr_spk_produks = $arr_produks =$bg_color_tgl= array();
        foreach ($srjalans as $srjalan) {
            $pelanggan = Pelanggan::find($srjalan['pelanggan_id']);
            $alamat=$pelanggan->alamat->first();
            $reseller = null;
            if ($srjalan['reseller_id'] !== null) {
                $reseller = Pelanggan::find($srjalan['reseller_id'])->toArray();
            }
            $ekspedisi = null;
            if ($srjalan['ekspedisi_id'] !== null) {
                $ekspedisi = Ekspedisi::find($srjalan['ekspedisi_id']);
            }
            $pelanggans[] = $pelanggan;
            $resellers[] = $reseller;
            $ekspedisis[] = $ekspedisi;

            $spk_produk_nota_srjalans = SpkProdukNotaSrjalan::where('srjalan_id', $srjalan['id'])->get()->toArray();
            $spk_produk_notas = $spk_produks = $produks = array();
            $j=0;
            foreach ($spk_produk_nota_srjalans as $spk_produk_nota_srjalan) {
                $spk_produk_nota = SpkProdukNota::find($spk_produk_nota_srjalan['spk_produk_nota_id'])->toArray();
                $spk_produk = SpkProduk::find($spk_produk_nota_srjalan['spk_produk_id'])->toArray();
                $produk = Produk::find($spk_produk_nota_srjalan['produk_id'])->toArray();

                $spk_produk_notas[] = $spk_produk_nota;
                $spk_produks[] = $spk_produk;
                $produks[] = $produk;

                if ($j===0) {
                    $spks[]=$spk_produk['spk_id'];
                    $notas[]=$spk_produk_nota['nota_id'];
                }
                $j++;
            }

            $arr_spk_produk_nota_srjalans[] = $spk_produk_nota_srjalans;
            $arr_spk_produk_notas[] = $spk_produk_notas;
            $arr_spk_produks[] = $spk_produks;
            $arr_produks[] = $produks;
            $alamats[] = $alamat;

            $bg_color=['bg-danger bg-gradient'];
            if ($srjalan['finished_at']!==null) {
                $bg_color=['bg-warning bg-gradient','bg-success bg-gradient'];
            }
            $bg_color_tgl[]=$bg_color;
        }


        // $pelanggan = Pelanggan::find(3)->spk;
        // dd($pelanggans);

        $data = [
            'navbar_bg'=>'bg-color-orange-2',
            'go_back' => true,
            'srjalans' => $srjalans,
            'pelanggans' => $pelanggans,
            'alamats' => $alamats,
            'resellers' => $resellers,
            'ekspedisis' => $ekspedisis,
            'arr_spk_produk_nota_srjalans' => $arr_spk_produk_nota_srjalans,
            'arr_spk_produk_notas' => $arr_spk_produk_notas,
            'arr_spk_produks' => $arr_spk_produks,
            'arr_produks' => $arr_produks,
            'bg_color_tgl' => $bg_color_tgl,
            'spks' => $spks,
            'notas' => $notas,
        ];
        // dump($data);
        // dd($data);
        return view('srjalan.srjalans', $data);
    }

    public function SjAll(Request $request)
    {
        SiteSettings::loadNumToZero();
        $spk_id=$request->query('spk_id');
        $srjalans=SpkProdukNotaSrjalan::where('spk_id',$spk_id)->get('srjalan_id')->pluck('srjalan_id')->toArray();
        // if (count($srjalans)!==0) {
        //     $spk=Spk::find($spk_id);
        //     $_warning="_ Sudah ada Sr. Jalan terbentuk untuk $spk[no_spk]. Oleh karena itu harap menggunakan Fitur Tree untuk menginput item SPK ke Sr. Jalan.";
        //     return back()->with(["_warning"=>$_warning]);
        // }

        // dump($srjalans);
        $srjalans=array_unique($srjalans);
        // dd($srjalans);

        $data=[
            'srjalans'=>$srjalans,
            'spk_id'=>$spk_id,
        ];
        return view('srjalan.SjAll', $data);
    }

    public function SjAll_DB(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();

        if (isset($post['mode'])) {
            $request->validate([
                'srjalan_id'=>'required'
            ]);
        }
        // dd('$post:', $post);
        $spk_produks=SpkProduk::where('spk_id',$post['spk_id'])->get();
        if (isset($post['srjalan_id'])) {
            /**Ketika sudah ada srjalan yang terbentuk, maka untuk menginput item ke srjalan, lebih baik menggunakan tree */

            foreach ($spk_produks as $spk_produk) {
                $produk=Produk::find($spk_produk['produk_id']);
                $SPKProdukNotas=SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
                if (count($SPKProdukNotas)===0) {
                    $error_logs[]='Item ini belum dibuat nota nya, silahkan membuat nota terlebih dahulu';
                    $run_db=false;
                } else {
                    foreach ($SPKProdukNotas as $SPKProdukNota) {
                        $nota=Nota::find($SPKProdukNota['nota_id']);
                        $SPKProdukNoSjs=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$SPKProdukNota['id'])->get();
                        if (count($SPKProdukNoSjs)!==0) {
                            $success_logs[]="spk_produk_nota_id:$SPKProdukNota[id] sudah memiliki SrJalan.";
                            $jml_srjalan_sama=$jml_srjalan_beda=0;
                            $SPKProdukNoSjID_toUpdate=null;
                            // Cari ID yang srjalan_id nya sama seperti yang di post
                            //cek srjalan_id nya sama seperti yang di post atau tidak
                            foreach ($SPKProdukNoSjs as $SPKProdukNoSj) {
                                if ($SPKProdukNoSj['srjalan_id']==$post['srjalan_id']) {
                                    $jml_srjalan_sama+=$SPKProdukNoSj['jumlah'];
                                    $SPKProdukNoSjID_toUpdate=$SPKProdukNoSj['id'];
                                } else {
                                    $jml_srjalan_beda+=$SPKProdukNoSj['jumlah'];
                                }
                            }
                            if ($jml_srjalan_sama===0) {
                                $success_logs[]="spk_produk_id:$spk_produk[id] tidak memiliki SrJalan sama seperti yang di post:$post[srjalan_id]";
                                $jml_av=$spk_produk['jml_selesai']-$jml_srjalan_beda;
                                if ($jml_av!==0) {
                                    $jml_packing=ceil($jml_av/$produk['aturan_packing']);
                                    if ($run_db) {
                                        SpkProdukNotaSrjalan::create([
                                            'spk_id'=>$post['spk_id'],
                                            'produk_id'=>$produk['id'],
                                            'nota_id'=>$nota['id'],
                                            'srjalan_id'=>$post['srjalan_id'],
                                            'spk_produk_id'=>$spk_produk['id'],
                                            'spk_produk_nota_id'=>$SPKProdukNota['id'],
                                            'jumlah'=>$jml_av,
                                            'tipe_packing'=>$produk['tipe_packing'],
                                            'jml_packing'=>$jml_packing,
                                        ]);
                                        $success_logs[]="Membuat SPKProdukNoSj baru dengan jumlah yang tersedia, yakni setelah dikurang $jml_srjalan_beda";
                                    }
                                }
                            } else {
                                $success_logs[]="spk_produk_nota_id:$SPKProdukNota[id] memiliki SrJalan sama seperti yang di post:$post[srjalan_id]";
                                $jml_av=$spk_produk['jml_selesai']-($jml_srjalan_sama+$jml_srjalan_beda);
                                $jml_to_update=$jml_av+$jml_srjalan_sama;
                                $SPKProdukNoSjToUpdate=SpkProdukNotaSrjalan::find($SPKProdukNoSjID_toUpdate);
                                $SPKProdukNoSjToUpdate->jumlah=$jml_to_update;
                                if ($run_db) {
                                    $SPKProdukNoSjToUpdate->save();
                                    $success_logs[]="Updating SPKProdukNoSj->jumlah";
                                }
                            }
                        } else {
                            //PEMBUATAN SPKProdukNoSj baru
                            $success_logs[]="spk_produk_id:$spk_produk[id] belum memiliki SrJalan. Pembuatan SPKProdukNoSj baru.";
                            if ($run_db) {
                                $jml_packing=ceil($SPKProdukNota['jumlah']/$produk['aturan_packing']);
                                SpkProdukNotaSrjalan::create([
                                    'spk_id'=>$post['spk_id'],
                                    'produk_id'=>$produk['id'],
                                    'nota_id'=>$nota['id'],
                                    'srjalan_id'=>$post['srjalan_id'],
                                    'spk_produk_id'=>$spk_produk['id'],
                                    'spk_produk_nota_id'=>$SPKProdukNota['id'],
                                    'jumlah'=>$SPKProdukNota['jumlah'],
                                    'tipe_packing'=>$produk['tipe_packing'],
                                    'jml_packing'=>$jml_packing,
                                ]);
                                $success_logs[]="Membuat SPKProdukNoSj baru";
                            }
                        }
                    }
                }
            }
            // dd($spk_produks);
            Srjalan::Update_SPK_JmlSj_Status_Packing($spk_produks);
            $success_logs[]="Updating jumlah_sudah_srjalan, status, packing pada srjalan ID: $post[srjalan_id]";
        } else {
            $success_logs[]='Belum ada SrJalan sama sekali untuk Item-item ini';
            $new_srjalan_id=null;
            for ($i=0; $i < count($spk_produks); $i++) {
                $SPKProdukNotas=SpkProdukNota::where('spk_produk_id',$spk_produks[$i]['id'])->get();
                if (count($SPKProdukNotas)===0) {
                    $error_logs[]='Belum ada Nota sama sekali. Proses pembuatan SrJalan dibatalkan! Silahkan buat Nota terlebih dahulu untuk item-item bersangkutan!';
                    $run_db=false;
                } else {
                    if ($i===0) {
                        list($new_srjalan_id,$success_logs2)=Srjalan::newSrjalan_berdasarkan_SpkProdukID($spk_produks[$i]['id']);
                        $success_logs=array_merge($success_logs,$success_logs2);
                    } else {
                        $success_logs2=Srjalan::newSpkProdukNotaSrjalan_with_SpkProdukID_and_SrjalanID($spk_produks[$i]['id'],$new_srjalan_id);
                        $success_logs=array_merge($success_logs,$success_logs2);
                    }
                }
            }
            Srjalan::Update_SPK_JmlSj_Status_Packing($spk_produks);
            $success_logs[]="Updating spk_produk->jumlah_sudah_srjalan dan status.";
        }
        $main_log='Success';
        $load_num->value+=1;
        $load_num->save();

        $route='SPK-Detail';
        $route_btn='Ke Detail SPK';
        $params=['spk_id'=>$post['spk_id']];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }



    public function sj_detailSJ(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();

        // dump('get', $get);

        $obj_sj = new Srjalan();
        list($srjalan,$pelanggan,$pelanggan_nama,$alamat,$cust_long_ala,$alamat_avas,$cust_kontak,$kontak,$kontak_avas,$reseller,$reseller_nama,$alamat_reseller,$reseller_long_ala,$alamat_reseller_avas,$reseller_kontak,$kontak_reseller,$kontak_reseller_avas,$spk_produk_nota_sjs, $spk_produks, $produks,$data_items) = $obj_sj->getOneSjAndComponents($get['srjalan_id']);
        list($ekspedisi_nama,$eks_long_ala,$eks_kontak,$ekspedisi,$alamat_ekspedisi,$kontak_ekspedisi,$transit_nama,$trans_long_ala,$trans_kontak,$transit,$alamat_transit,$kontak_transit)=$obj_sj->sjDetail_getEkspedisi($srjalan);

        $menus=[
            ['route'=>'SJ-PrintOut','nama'=>'PrintOut SJ','method'=>'GET','params'=>[['name'=>'srjalan_id','value'=>$srjalan['id']]]],
            ['route'=>'editColly','nama'=>'E.Col','method'=>'GET','params'=>[['name'=>'srjalan_id','value'=>$srjalan['id']]]],
            // ['route'=>'sjDetail_assignAlamat','nama'=>'Ass.Alamat','method'=>'get','params'=>[['name'=>'srjalan_id','value'=>$srjalan['id']],]],
            ['route'=>'sjEditEkspedisi','nama'=>'E.Eks','method'=>'GET','params'=>[['name'=>'srjalan_id','value'=>$srjalan['id']]]],
            ['route'=>'sj_hapus','nama'=>'Hapus','method'=>'POST','params'=>[['name'=>'srjalan_id','value'=>$srjalan['id']]],'confirm'=>'Apakah Anda yakin ingin menghapus Sr. Jalan ini? (Jumlah sudah Sr. Jalan pada Tree akan disesuaikan kembali.)'],
        ];

        $reseller_id=null;
        if ($reseller!==null) {
            $reseller_id=$reseller['id'];
        }
        if ($cust_kontak!==null) {
            $cust_kontak=json_decode($cust_kontak,true);
        }
        if ($reseller_kontak!==null) {
            $reseller_kontak=json_decode($reseller_kontak,true);
        }
        if ($eks_kontak!==null) {
            $eks_kontak=json_decode($eks_kontak,true);
        }
        if ($trans_kontak!==null) {
            $trans_kontak=json_decode($trans_kontak,true);
        }
        $data = [
            'navbar_bg'=>'bg-color-orange-2',
            'go_back'=>true,
            'srjalan' => $srjalan,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'reseller' => $reseller,
            'spk_produk_nota_srjalans' => $spk_produk_nota_sjs,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
            'data_items' => $data_items,
            'pelanggan_nama' => $pelanggan_nama,
            'cust_long_ala' => $cust_long_ala,
            'cust_kontak' => $cust_kontak,
            'kontak' => $kontak,
            'reseller_nama' => $reseller_nama,
            'alamat_reseller' => $alamat_reseller, // dari alamat_reseller_id di nota
            'reseller_long_ala' => $reseller_long_ala,
            'reseller_kontak' => $reseller_kontak,
            'kontak_reseller' => $kontak_reseller,
            'alamat_avas' => $alamat_avas,
            'kontak_avas' => $kontak_avas,
            'alamat_reseller_avas' => $alamat_reseller_avas,
            'kontak_reseller_avas' => $kontak_reseller_avas,
            'menus' => $menus,
            // Ekspedisi
            'ekspedisi_nama' => $ekspedisi_nama,
            'eks_long_ala' => $eks_long_ala,
            'eks_kontak' => $eks_kontak,
            'ekspedisi' => $ekspedisi,
            'alamat_ekspedisi' => $alamat_ekspedisi,
            'kontak_ekspedisi' => $kontak_ekspedisi,
            'transit_nama' => $transit_nama,
            'trans_long_ala' => $trans_long_ala,
            'trans_kontak' => $trans_kontak,
            'transit' => $transit,
            'alamat_transit' => $alamat_transit,
            'kontak_transit' => $kontak_transit,
        ];
        // dump($data);
        // dd($data);
        return view('srjalan.sj-detailSJ', $data);
    }

    public function sj_printOut(Request $request)
    {
        SiteSettings::loadNumToZero();

        $show_dump = false;
        // Pada development mode, load number boleh diignore. Yang perlu diperhatikan adalah
        // insert dan update database supaya tidak berantakan

        $get = $request->query();

        if ($show_dump === true) {
            dump('get:', $get);
        }

        $sj = new Srjalan();
        list($srjalan, $pelanggan,$alamat,$pelanggan_kontak,$reseller,$reseller_kontak,$ekspedisi,$ekspedisi_kontak,$transit,$alamat_transit,$transit_kontak,$spk_produk_nota_srjalans, $spk_produk_notas, $spk_produks, $produks) = $sj->get_one_srjalan_and_components($get['srjalan_id']);

        $alamat_reseller=$alamat_reseller_long=null;
        $alamat_long=json_decode($alamat['long'],true);
        if ($reseller!==null) {
            $alamat_reseller = $reseller->alamat->first();
            $alamat_reseller_long=json_decode($alamat_reseller['long'],true);
        }
        // dd($alamat_reseller);
        $ekspedisi_alamat=EkspedisiAlamat::where('ekspedisi_id',$ekspedisi['id'])->where('tipe','UTAMA')->latest()->first();
        // dump($ekspedisi_alamat);
        $alamat_ekspedisi =Alamat::find($ekspedisi_alamat['alamat_id']);
        $jml_baris_produk=count($produks);
        if (count($produks)<10) {
            $jml_baris_produk=10;
        }
        $data = [
            'navbar_bg' => 'bg-color-orange-2',
            'go_back' => true,
            'srjalan' => $srjalan,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'alamat_long' => $alamat_long,
            'reseller' => $reseller,
            'alamat_reseller' => $alamat_reseller,
            'alamat_reseller_long' => $alamat_reseller_long,
            'ekspedisi' => $ekspedisi,
            'alamat_ekspedisi' => $alamat_ekspedisi,
            'spk_produk_nota_srjalans' => $spk_produk_nota_srjalans,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
            'jml_baris_produk' => $jml_baris_produk,
            'pelanggan_kontak' => $pelanggan_kontak,
            'reseller_kontak' => $reseller_kontak,
            'ekspedisi_kontak' => $ekspedisi_kontak,
            'transit' => $transit,
            'alamat_transit' => $alamat_transit,
            'transit_kontak' => $transit_kontak,
        ];
        // dd($data);
        // dump($data);
        if ($reseller!==null) {
            return view('srjalan.sj-printOutReseller', $data);
        }
        return view('srjalan.sj-printOut', $data);
    }

    public function sj_hapus(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $run_db = true;

        $error_logs = $success_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();

        // dd('post', $post);

        $sj = Srjalan::find($post['srjalan_id']);

        $spk_produk_nota_srjalans = SpkProdukNotaSrjalan::where('srjalan_id', $sj['id'])->get()->toArray();
        // dd($spk_produk_nota_srjalans);
        foreach ($spk_produk_nota_srjalans as $SPKProdukNotaSrjalan) {
            $jumlah_kurang = $SPKProdukNotaSrjalan['jumlah'];
            // UPDATE spk: status_sj, jumlah_sudah_sj
            $spk = Spk::find($SPKProdukNotaSrjalan['spk_id']);
            $jumlah_sudah_sj_spk = $spk['jumlah_sudah_sj'] - $jumlah_kurang;
            if ($jumlah_sudah_sj_spk === 0) {
                $status_sj_spk = 'BELUM';
            } elseif ($jumlah_sudah_sj_spk === $spk['jumlah_total']) {
                $status_sj_spk = 'SEMUA';
            } elseif ($jumlah_sudah_sj_spk < $spk['jumlah_total']) {
                $status_sj_spk = 'SEBAGIAN';
            }

            if ($run_db) {
                $spk->status_sj = $status_sj_spk;
                $spk->jumlah_sudah_sj = $jumlah_sudah_sj_spk;
                $spk->save();

                $success_logs[] = 'UPDATE spk: status_sj, jumlah_sudah_sj';
            }
            // UPDATE spk_produk: jumlah_sudah_srjalan, status_srjalan.
            $spk_produk = SpkProduk::find($SPKProdukNotaSrjalan['spk_produk_id']);
            $jumlahSudahSrjalanSpkProduk = $spk_produk['jumlah_sudah_srjalan'] - $jumlah_kurang;
            if ($jumlahSudahSrjalanSpkProduk === 0) {
                $statusSrjalanSPKProduk = 'BELUM';
            } elseif ($jumlahSudahSrjalanSpkProduk === $spk_produk['jml_t']) {
                $statusSrjalanSPKProduk = 'SEMUA';
            } elseif ($jumlahSudahSrjalanSpkProduk < $spk_produk['jml_t']) {
                $statusSrjalanSPKProduk = 'SEBAGIAN';
            }

            if ($run_db) {
                $spk_produk->jumlah_sudah_srjalan = $jumlahSudahSrjalanSpkProduk;
                $spk_produk->status_srjalan = $statusSrjalanSPKProduk;
                $spk_produk->save();

                $success_logs[] = 'UPDATE spk_produk: jumlah_sudah_srjalan, status_srjalan';
            }

            // UPDATE nota: status_sj, jumlah_sj
            // $nota = Nota::find($SPKProdukNotaSrjalan['nota_id']);
            // $jumlah_sj = $nota['jumlah_sj'] - $jumlah_kurang;
            // $status_sj_nota = $nota['status_sj'];
            // if ($jumlah_sj === 0) {
            //     $status_sj_nota = 'BELUM';
            // } elseif ($jumlah_sj === $nota['jumlah_total']) {
            //     $status_sj_nota = 'SEMUA';
            // } elseif ($jumlah_sj < $nota['jumlah_total']) {
            //     $status_sj_nota = 'SEBAGIAN';
            // }

            // // dump('$jumlah_sj, $status_sj_nota', $jumlah_sj, $status_sj_nota);

            // if ($run_db) {
            //     $nota->status_sj = $status_sj_nota;
            //     $nota->jumlah_sj = $jumlah_sj;
            //     $nota->save();

            //     $success_logs[] = 'UPDATE nota: status_sj, jumlah_sj';
            // }
            // END

            // DELETE spk_produk_nota_srjalan udah otomatis akan ke delete, ketika nanti delete sj.
        }


        if ($run_db === true) {
            $sj->delete();

            $success_logs[] = 'success_: Surat Jalan ini berhasil dihapus!';
            $main_log = 'SUCCESS:';

            $load_num->value += 1;
            $load_num->save();
        }

        $route='srjalans';
        $route_btn='Ke Daftar Sr. Jalan';
        $params=null;
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }
}
