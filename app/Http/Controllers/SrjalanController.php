<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Helpers\UpdateDataSPK;
use App\Models\Daerah;
use App\Models\Ekspedisi;
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

        $pelanggans = $daerahs = $resellers = $ekspedisis = $arr_spk_produk_nota_srjalans = $arr_spk_produk_notas = $arr_spk_produks = $arr_produks = array();
        foreach ($srjalans as $srjalan) {
            $pelanggan = Pelanggan::find($srjalan['pelanggan_id'])->toArray();
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
            foreach ($spk_produk_nota_srjalans as $spk_produk_nota_srjalan) {
                $spk_produk_nota = SpkProdukNota::find($spk_produk_nota_srjalan['spk_produk_nota_id'])->toArray();
                $spk_produk = SpkProduk::find($spk_produk_nota_srjalan['spk_produk_id'])->toArray();
                $produk = Produk::find($spk_produk_nota_srjalan['produk_id'])->toArray();

                $spk_produk_notas[] = $spk_produk_nota;
                $spk_produks[] = $spk_produk;
                $produks[] = $produk;
            }

            $arr_spk_produk_nota_srjalans[] = $spk_produk_nota_srjalans;
            $arr_spk_produk_notas[] = $spk_produk_notas;
            $arr_spk_produks[] = $spk_produks;
            $arr_produks[] = $produks;
        }


        // $pelanggan = Pelanggan::find(3)->spk;
        // dd($pelanggans);
        // $menus=[['route'=>'PrintOutSPK','nama'=>'Print Out','method'=>'get','params'=>['name'=>'spk_id','value'=>$spk['id']]],];

        $data = [
            'navbar_bg'=>'bg-color-orange-2',
            'go_back' => true,
            'srjalans' => $srjalans,
            'pelanggans' => $pelanggans,
            'daerahs' => $daerahs,
            'resellers' => $resellers,
            'ekspedisis' => $ekspedisis,
            'arr_spk_produk_nota_srjalans' => $arr_spk_produk_nota_srjalans,
            'arr_spk_produk_notas' => $arr_spk_produk_notas,
            'arr_spk_produks' => $arr_spk_produks,
            'arr_produks' => $arr_produks,
        ];

        return view('srjalan.srjalans', $data);
    }

    public function SjAll(Request $request)
    {
        SiteSettings::loadNumToZero();
        $spk_id=$request->query('spk_id');
        $srjalans=SpkProdukNotaSrjalan::where('spk_id',$spk_id)->get('srjalan_id')->pluck('srjalan_id')->toArray();

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
                Srjalan::Update_SPK_JmlSj_Status_Packing($spk_produk['id']);
                $success_logs[]="Updating jumlah_sudah_srjalan, status, packing pada srjalan ID: $post[srjalan_id]";
            }
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
                    Srjalan::Update_SPK_JmlSj_Status_Packing($spk_produks[$i]['id']);
                    $success_logs[]="Updating spk_produk->jumlah_sudah_srjalan dan status.";
                }
            }
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

        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('get', $get);
        }

        $sj = new Srjalan();
        list($srjalan, $pelanggan, $daerah, $reseller, $ekspedisi, $spk_produk_nota_srjalans, $spk_produk_notas, $spk_produks, $produks) = $sj->get_one_srjalan_and_components($get['srjalan_id']);

        $data = [
            'srjalan' => $srjalan,
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'ekspedisi' => $ekspedisi,
            'spk_produk_nota_srjalans' => $spk_produk_nota_srjalans,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
        ];

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
        list($srjalan, $pelanggan, $daerah, $reseller, $ekspedisi, $spk_produk_nota_srjalans, $spk_produk_notas, $spk_produks, $produks) = $sj->get_one_srjalan_and_components($get['srjalan_id']);

        $alamat_reseller = null;
        if ($reseller !== null) {
            $alamat_reseller = json_decode($reseller['alamat'], true);
        }
        $alamat_ekspedisi = json_decode($ekspedisi['alamat'], true);
        $data = [
            'srjalan' => $srjalan,
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'alamat_reseller' => $alamat_reseller,
            'ekspedisi' => $ekspedisi,
            'alamat_ekspedisi' => $alamat_ekspedisi,
            'spk_produk_nota_srjalans' => $spk_produk_nota_srjalans,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
        ];

        return view('srjalan.sj-printOut', $data);
    }

    public function sj_hapus(Request $request)
    {
        $load_num = SiteSetting::find(1);
        dump($load_num);

        $show_dump = false;
        $run_db = true;

        $error_logs = $success_logs = array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump === true) {
            dump('post', $post);
        }

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
            $nota = Nota::find($SPKProdukNotaSrjalan['nota_id']);
            $jumlah_sj = $nota['jumlah_sj'] - $jumlah_kurang;
            $status_sj_nota = $nota['status_sj'];
            if ($jumlah_sj === 0) {
                $status_sj_nota = 'BELUM';
            } elseif ($jumlah_sj === $nota['jumlah_total']) {
                $status_sj_nota = 'SEMUA';
            } elseif ($jumlah_sj < $nota['jumlah_total']) {
                $status_sj_nota = 'SEBAGIAN';
            }

            // dump('$jumlah_sj, $status_sj_nota', $jumlah_sj, $status_sj_nota);

            if ($run_db) {
                $nota->status_sj = $status_sj_nota;
                $nota->jumlah_sj = $jumlah_sj;
                $nota->save();

                $success_logs[] = 'UPDATE nota: status_sj, jumlah_sj';
            }
            // END

            // DELETE spk_produk_nota_srjalan udah otomatis akan ke delete, ketika nanti delete sj.
        }


        if ($run_db === true) {
            $sj->delete();

            $success_logs[] = 'success_: Surat Jalan ini berhasil dihapus!';
            $main_log = 'SUCCESS:';
            $class_div_pesan_db = 'alert-success';

            $load_num->value += 1;
            $load_num->save();
        }

        $data = [
            'go_back_number' => -2,
            'pesan_db' => $main_log,
            'class_div_pesan_db' => $class_div_pesan_db,
            'error_logs' => $error_logs,
            'success_logs' => $success_logs,
        ];

        if ($show_dump) {
            dump('DELETE PROSES FINISHED!');
        }

        return view('layouts.go-back-page', $data);
    }
}
