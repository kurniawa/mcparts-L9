<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Alamat;
use App\Models\Ekspedisi;
use App\Models\EkspedisiAlamat;
use App\Models\EkspedisiKontak;
use App\Models\Pelanggan;
use App\Models\PelangganAlamat;
use App\Models\PelangganEkspedisi;
use App\Models\PelangganKontak;
use App\Models\SiteSetting;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\Srjalan;
use Illuminate\Http\Request;

class SjDetailController extends Controller
{
    public function editColly(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();
        // dd('$get:', $get);
        $srjalan_id=$get['srjalan_id'];

        $srjalan=Srjalan::find($srjalan_id);
        $pelanggan=Pelanggan::find($srjalan['pelanggan_id']);
        $reseller=null;
        if ($srjalan['reseller_id']!==null) {
            $reseller=Pelanggan::find($srjalan['reseller_id']);
        }
        // Hitungan Jumlah Colly dan Dus sesuai sistem
        $sProNoSjs=SpkProdukNotaSrjalan::where('srjalan_id',$srjalan['id'])->get();
        $jml_colly_sys=$jml_dus_sys=0;
        foreach ($sProNoSjs as $item) {
            if ($item['tipe_packing']==='colly' && $item['jml_packing']!==null) {
                $jml_colly_sys+=$item['colly'];
            } else if ($item['tipe_packing']==='dus' && $item['jml_packing']!==null) {
                $jml_dus_sys+=$item['dus'];
            }
        }

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'srjalan' => $srjalan,
            'jml_colly_sys' => $jml_colly_sys,
            'jml_dus_sys' => $jml_dus_sys,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
        ];

        // dump($data);

        return view('srjalan.editColly', $data);
    }

    public function editCollyDB(Request $request)
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
        // dd($post);
        $srjalan_id=$post['srjalan_id'];
        $jml_colly=$post['jml_colly'];
        $jml_dus=$post['jml_dus'];

        if ($run_db) {
            $srjalan=Srjalan::find($srjalan_id);
            $srjalan->jml_colly=$jml_colly;
            $srjalan->jml_dus=$jml_dus;
            $srjalan->save();

            $success_logs[]="Update Jumlah Packing Sr. Jalan berhasil!";
            $main_log='Success';
            $load_num->value+=1;
            $load_num->save();
        }


        $route='SJ-Detail';
        $route_btn='Ke Detail Sr. Jalan';
        $params=['srjalan_id'=>$srjalan_id];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }

    public function sjSelesai(Request $request)
    {
        SiteSettings::loadNumToZero();

        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('get', $get);
        }

        $obj_sj = new Srjalan();
        list($srjalan,$pelanggan,$pelanggan_nama,$alamat,$cust_long_ala,$alamat_avas,$cust_kontak,$kontak,$kontak_avas,$reseller,$reseller_nama,$alamat_reseller,$reseller_long_ala,$alamat_reseller_avas,$reseller_kontak,$kontak_reseller,$kontak_reseller_avas,$spk_produk_nota_srjalans, $spk_produks, $produks,$data_items) = $obj_sj->getOneSjAndComponents($get['srjalan_id']);
        // list($ekspedisi_nama,$eks_long_ala,$eks_kontak,$ekspedisi,$alamat_ekspedisi,$kontak_ekspedisi,$transit_nama,$trans_long_ala,$trans_kontak,$transit,$alamat_transit,$kontak_transit)=$obj_sj->sjDetail_getEkspedisi($srjalan);

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


        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'srjalan' => $srjalan,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'reseller' => $reseller,
            'reseller_id' => $reseller_id,
            'spk_produk_nota_srjalans' => $spk_produk_nota_srjalans,
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

        ];
        // dd($data);
        return view('srjalan.sjSelesai', $data);
    }

    public function sjSelesaiDB(Request $request)
    {

        $load_num = SiteSetting::find(1);
        $run_db = true;

        $success_logs = $error_logs =$warning_logs= array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dump($post);
        $srjalan_id = $post['srjalan_id'];
        $pelanggan_id=$post['pelanggan_id'];
        $reseller_id=$post['reseller_id'];
        $finished_at=$post['tgl_selesai'];

        if ($run_db) {
            $srjalan = Srjalan::find($srjalan_id);
            $pelanggan=Pelanggan::find($pelanggan_id);
            // Menetapkan Data Pelanggan Fix
            $fixedNamaAlamatKontak=new Pelanggan();
            $fixedNamaAlamatKontak->sjSelesai_fixNamaAlamatKontakPelanggan($srjalan,$pelanggan);
            $success_logs[]="Menetapkan Nama, Alamat, Kontak Pelanggan Fix.";

            // Set Ekspedisi & Ekspedisi Transit - Pelanggan
            $setEkspedisi=new Ekspedisi();
            $setEkspedisi->sjSelesai_setEkspedisi($srjalan,$pelanggan);
            $success_logs[]="Menetapkan data ekspedisi dan ekspedisi transit fix untuk pelanggan.";

            // Menetapkan Data Reseller Fix
            if ($reseller_id!==null) {
                $reseller=Pelanggan::find($reseller_id);
                $fixedNamaAlamatKontak->sjSelesai_fixNamaAlamatKontakReseller($srjalan,$reseller);
                $success_logs[]="Menetapkan Nama, Alamat, Kontak Reseller Fix.";
            }

            $srjalan->finished_at=$finished_at;
            $srjalan->save();

            $success_logs[]="Menetapkan tanggal selesai dari Sr. Jalan $srjalan[no_srjalan]!";
            $success_logs[]="Berhasil Update Data Sr. Jalan Selesai";

            $main_log = 'SUCCESS:';
            $load_num->value+=1;
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

    public function sjEditEkspedisi(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();
        // dump('get', $get);
        // dd($get);
        $srjalan_id=$get['srjalan_id'];
        $srjalan=Srjalan::find($srjalan_id);
        // dd($srjalan);
        $pelanggan=Pelanggan::find($srjalan['pelanggan_id']);
        // dd($pelanggan);
        $reseller=null;
        if ($srjalan['reseller_id']!==null) {
            $reseller=Pelanggan::find($srjalan['reseller_id']);
        }

        // Ekspedisi Normal
        $cust_ekspedisis=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('is_transit','no')->get();
        $ekspedisi_normals=array();
        foreach ($cust_ekspedisis as $cust_ekspedisi) {
            $ekspedisi_cust=Ekspedisi::find($cust_ekspedisi['ekspedisi_id']);
            $ekspedisi_normals[]=$ekspedisi_cust;
        }
        $ekspedisi_chosen=null;
        if ($srjalan['ekspedisi_id']!==null) {
            $ekspedisi_chosen=Ekspedisi::find($srjalan['ekspedisi_id']);
        }

        // Ekspedisi Transit
        $cust_transits=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('is_transit',"yes")->get();
        $ekspedisi_transits=array();
        if (count($cust_transits)!==null) {
            foreach ($cust_transits as $cust_transit) {
                $transit_cust=Ekspedisi::find($cust_transit['ekspedisi_id']);
                $ekspedisi_transits[]=$transit_cust;
            }
        }
        $transit_chosen=null;
        if ($srjalan['ekspedisi_transit_id']!==null) {
            $transit_chosen=Ekspedisi::find($srjalan['ekspedisi_transit_id']);
        }

        $data = [
            'navbar_bg'=>'bg-color-orange-2',
            'go_back'=>true,
            'srjalan' => $srjalan,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
            'ekspedisi_normals' => $ekspedisi_normals,
            'ekspedisi_transits' => $ekspedisi_transits,
            'ekspedisi_chosen' => $ekspedisi_chosen,
            'transit_chosen' => $transit_chosen,
        ];
        // dump($data);
        // dd($data);
        return view('srjalan.sjEditEkspedisi', $data);
    }

    public function sjEditEkspedisiDB(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;

        $success_logs = $error_logs =$warning_logs= "";
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dd($post);
        $srjalan_id = $post['srjalan_id'];
        $ekspedisi_id=null;
        if (isset($post['ekspedisi_normal_id'])) {
            $ekspedisi_id=$post['ekspedisi_normal_id'];
        }
        $transit_id=null;
        if (isset($post['ekspedisi_transit_id'])) {
            $transit_id=$post['ekspedisi_transit_id'];
        }

        if ($run_db) {
            $success_logs.=Ekspedisi::updateEkspedisiSJ($srjalan_id,$ekspedisi_id,$transit_id);

            // $main_log = 'SUCCESS:';
            $load_num->value+=1;
            $load_num->save();
        }

        // $route='SJ-Detail';
        // $route_btn='Ke Detail Sr. Jalan';
        // $params=['srjalan_id'=>$srjalan_id];
        // $data = [
        //     'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
        //     'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        // ];

        // return view('layouts.db-result', $data);

        return redirect()->route('SJ-Detail',['srjalan_id'=>$srjalan_id])->with(['_success'=>$success_logs]);
    }

    public function sjDetail_assignAlamat(Request $request)
    {
        SiteSettings::loadNumToZero();
        $get = $request->query();

        $obj_sj = new Srjalan();
        list($srjalan,$pelanggan,$pelanggan_nama,$alamat,$cust_long_ala,$alamat_avas,$cust_kontak,$kontak,$kontak_avas,$reseller,$reseller_nama,$alamat_reseller,$reseller_long_ala,$alamat_reseller_avas,$reseller_kontak,$kontak_reseller,$kontak_reseller_avas,$spk_produk_notas, $spk_produks, $produks,$data_items) = $obj_sj->getOneSjAndComponents($get['srjalan_id']);
        list($ekspedisi_nama,$eks_long_ala,$eks_kontak,$ekspedisi,$alamat_ekspedisi,$kontak_ekspedisi,$transit_nama,$trans_long_ala,$trans_kontak,$transit,$alamat_transit,$kontak_transit)=$obj_sj->sjDetail_getEkspedisi($srjalan);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'srjalan' => $srjalan,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'reseller' => $reseller,
            'spk_produk_notas' => $spk_produk_notas,
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
        // dd($data);
        // dump($data);
        return view('nota.assign-alamat', $data);
    }

    public function sjDetail_assignAlamatDB(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;

        $success_logs=$error_logs=$warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dd($post);
        $srjalan_id = $post['srjalan_id'];
        $alamat_pelanggan_id=null;
        if (isset($post['alamat_pelanggan_id'])) {
            $alamat_pelanggan_id=$post['alamat_pelanggan_id'];
        }
        $alamat_reseller_id=null;
        if (isset($post['alamat_reseller_id'])) {
            $alamat_reseller_id=$post['alamat_reseller_id'];
        }
        $is_also_for_sj=$post['is_also_for_sj'];

        if ($run_db) {
            $nota=Srjalan::find($srjalan_id);
            $nota->alamat_id=$alamat_pelanggan_id;
            $nota->alamat_reseller_id=$alamat_reseller_id;
            $nota->save();

            $success_logs[]="Alamat pelanggan dan alamat reseller telah ditetapkan untuk nota ini!";

            if ($is_also_for_sj==='yes') {
                $spk_produk_nota_srjalans=SpkProdukNotaSrjalan::where('srjalan_id',$nota['id'])->get();
                if (count($spk_produk_nota_srjalans)!==0) {
                    $srjalan_ids=array();
                    foreach ($spk_produk_nota_srjalans as $spk_produk_nota_srjalan) {
                        $is_in_array=array_search($spk_produk_nota_srjalan['srjalan_id'], $srjalan_ids);
                        if ($is_in_array === false) {
                            $srjalan_ids[]=$spk_produk_nota_srjalan['srjalan_id'];
                        }
                    }
                    foreach ($srjalan_ids as $srjalan_id) {
                        $srjalan=Srjalan::find($srjalan_id);
                        $srjalan->alamat_id=$alamat_pelanggan_id;
                        $srjalan->alamat_reseller_id=$alamat_reseller_id;
                        $srjalan->save();
                    }
                    $success_logs[]="Penetapan alamat pelanggan dan reseller juga dilakukan pada Sr. Jalan!";
                } else {
                    $success_logs[]="Belum ada Sr. jalan yang dibuat dari Nota ini, oleh karena itu batal menetapkan alamat pelanggan dan reseller pada Sr. Jalan!";
                }
            }
            $main_log = 'SUCCESS:';
            $load_num->value+=1;
            $load_num->save();
        }

        $route='Nota-Detail';
        $route_btn='Ke Detail Nota';
        $params=['srjalan_id'=>$srjalan_id];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }
}
