<?php

namespace App\Http\Controllers;

use App\Helpers\PelangganHelper;
use App\Helpers\SiteSettings;
use App\Http\Requests\StoreSpkRequest;
use App\Http\Requests\UpdateSpkRequest;
use App\Models\Alamat;
use App\Models\Nota;
use App\Models\Pelanggan;
use App\Models\PelangganAlamat;
use App\Models\Produk;
use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\SpkProdukSelesai;
use App\Models\Srjalan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SpkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        SiteSettings::loadNumToZero();

        $spks = Spk::limit(100)->orderByDesc('created_at')->get();
        $pelanggans = $resellers = $alamats = $arr_spk_produks = $arr_produks = $arr_finished_at_last = $bg_color_tgl= array();
        for ($i = 0; $i < count($spks); $i++) {
            $spk = Spk::find($spks[$i]->id);
            $pelanggan = $spk->pelanggan;
            $pelanggan_alamat = PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->latest()->first()->toArray();
            $alamat = Alamat::find($pelanggan_alamat['alamat_id']);
            if ($spks[$i]->reseller_id !== null && $spks[$i]->reseller_id !== '') {
                $reseller = Pelanggan::find($spks[$i]->reseller_id);
                array_push($resellers, $reseller);
            } else {
                array_push($resellers, null);
            }
            $bg_color=['bg-danger bg-gradient'];
            if ($spk['finished_at']!==null) {
                $bg_color=['bg-warning bg-gradient','bg-success bg-gradient'];
            }
            $produks = $spk->produks;
            $spk_produks = $spk->spk_produks;
            array_push($arr_produks, $produks);
            array_push($arr_spk_produks, $spk_produks);
            array_push($pelanggans, $pelanggan);
            $alamats[]=$alamat;
            $bg_color_tgl[]=$bg_color;

            $spk_produk_selesai = new SpkProdukSelesai();
            $finished_at_last = $spk_produk_selesai->get_finished_at_last($spk['id']);
            array_push($arr_finished_at_last, $finished_at_last);
        }
        // dump($alamats);

        $menus=[['route'=>'SPKBaru','nama'=>'+Tambah SPK Baru']];
        $data = [
            'navbar_bg'=>'bg-color-orange-2',
            'go_back' => true,
            'spks' => $spks,
            'pelanggans' => $pelanggans,
            'alamats' => $alamats,
            'resellers' => $resellers,
            'arr_produks' => $arr_produks,
            'arr_spk_produks' => $arr_spk_produks,
            'arr_finished_at_last' => $arr_finished_at_last,
            'menus' => $menus,
            'bg_color_tgl' => $bg_color_tgl,
        ];

        return view('spk.spks', $data);
    }

    public function spk_detail(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();

        $spk = Spk::find($get['spk_id']);
        $pelanggan = Pelanggan::find($spk['pelanggan_id']);
        $alamat = $pelanggan->alamat->first()->toArray();

        $reseller = null;
        if ($spk['reseller_id'] !== null) {
            $reseller = Pelanggan::find($spk['reseller_id']);
        }
        $produks = $spk->produks;
        $spk_produks = $spk->spk_produks;

        // dump($spk_produks);

        $menus=[
            ['route'=>'PrintOutSPK','nama'=>'Print Out','method'=>'get','params'=>[['name'=>'spk_id','value'=>$spk['id']],]],
            ['route'=>'EditKopSPK','nama'=>'Kopf','method'=>'get','params'=>[['name'=>'spk_id','value'=>$spk['id']],]],
            ['route'=>'ItemSelesai_All','nama'=>'Selesai All','method'=>'post','params'=>[['name'=>'spk_id','value'=>$spk['id']],]],
            ['route'=>'SPK_AddItems','nama'=>'Tambah Item','method'=>'get','params'=>[['name'=>'spk_id','value'=>$spk['id']],]],
            ['route'=>'NotaAll','nama'=>'N-All','method'=>'get','params'=>[['name'=>'spk_id','value'=>$spk['id']],]],
            ['route'=>'SjAll','nama'=>'Sr-All','method'=>'get','params'=>[['name'=>'spk_id','value'=>$spk['id']],]],
            ['route'=>'HapusSPK','nama'=>'Hapus','method'=>'post','params'=>[['name'=>'spk_id','value'=>$spk['id']],],'confirm'=>'Anda yakin ingin menghapus SPK ini? (Menghapus SPK akan turut menghapus Nota dan Sr. Jalan yang terkait!)'],
        ];
        $data = [
            'navbar_bg'=>'bg-color-orange-2',
            'go_back' => true,
            'spk' => $spk,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'reseller' => $reseller,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
            'menus' => $menus,
        ];

        // dd($spk_produks);
        // dd($data);

        return view('spk.spk-detail', $data);
    }

    public function edit_kop_spk(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('$get:', $get);
        }

        $spk = Spk::find($get['spk_id']);
        $pelanggan = Pelanggan::find($spk['pelanggan_id']);
        $reseller = null;
        $reseller_id = null;
        $pelanggan_nama = $pelanggan['nama'];

        $label_pelanggans = PelangganHelper::label_pelanggans();

        if ($spk['reseller_id'] !== null) {
            $reseller = Pelanggan::find($spk['reseller_id']);
            $reseller_id = $reseller['id'];
            $pelanggan_nama = "$reseller[nama]: $pelanggan[nama]";
        }

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'spk' => $spk,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
            'reseller_id' => $reseller_id,
            'pelanggan_nama' => $pelanggan_nama,
            'label_pelanggans' => $label_pelanggans,
        ];

        if ($show_dump) {
            dump('$data:', $data);
            dump('$pelanggan[nama]:', $pelanggan['nama']);
        }
        return view('spk.edit-kop-spk', $data);
    }

    public function edit_kop_spk_db(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $request->validate([
            'pelanggan_id' => 'required',
            'created_at' => 'required|date_format:Y-m-d\TH:i:s',
        ]);

        $post = $request->post();

        // dump('$post:', $post);

        $spk = Spk::find($post['spk_id']);
        $pelanggan_new=Pelanggan::find($post['pelanggan_id']);

        $reseller = null;
        $reseller_id = null;
        $created_at = $post['created_at'];

        if ($post['reseller_id'] !== null) {
            $reseller = Pelanggan::find($post['reseller_id']);
            $reseller_id = $reseller['id'];
        }

        if ($run_db) {
            $spk->pelanggan_id = $pelanggan_new['id'];
            $spk->reseller_id = $reseller_id;
            $spk->created_at = $created_at;
            $spk->save();

            $main_log = "SUCCESS: Kop SPK dengan ID: $spk[id] berhasil diubah/-update.";
        }

        $route='SPK-Detail';
        $route_btn='Ke Detail SPK';
        $params=['spk_id'=>$spk['id']];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }

    public function print_out_spk(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();

        // dump('$get:', $get);

        $spk = Spk::find($get['spk_id']);
        if ($spk->cust_short!==null) {
            $pelanggan_nama = "$spk->pelanggan_nama - $spk->cust_short";
        } else {
            $pelanggan_nama = $spk->pelanggan_nama;
        }

        if ($spk['reseller_id'] !== null) {
            $pelanggan_nama = "$spk->reseller_nama: $pelanggan_nama";
        }

        $spk_produks = SpkProduk::where('spk_id', $spk['id'])->get();


        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'spk' => $spk,
            'spk_produks' => $spk_produks,
            'pelanggan_nama' => $pelanggan_nama,
        ];

        // dump('$data:', $data);
        return view('spk.print-out-spk', $data);
    }

    public function hapus_spk(Request $request)
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
        $spk_id=$post['spk_id'];
        // dump('$post:', $post);

        if ($run_db) {
            // Cari SPK-> Cari Nota terkait -> Cari Sr. Jalan terkait, supaya bisa dihapus semua sekaligus
            $spk = Spk::find($spk_id);
            $spk_produk_notas=SpkProdukNota::where('spk_id', $spk['id'])->get();
            // Cari Nota terkait
            $nota_ids=array();
            foreach ($spk_produk_notas as $spk_produk_nota) {
                $is_nota_id_in_array=array_search($spk_produk_nota['nota_id'], $nota_ids);
                if ($is_nota_id_in_array === false) {
                    $nota_ids[]=$spk_produk_nota['nota_id'];
                }
            }
            // dump($nota_ids);
            // Cari Sr. Jalan terkait
            $sj_ids=array();
            foreach ($nota_ids as $nota_id) {
                $spk_produk_nota_sjs=SpkProdukNotaSrjalan::where('nota_id',$nota_id)->get();
                foreach ($spk_produk_nota_sjs as $spk_produk_nota_sj) {
                    $is_sj_id_in_array=array_search($spk_produk_nota_sj['srjalan_id'], $sj_ids);
                    if ($is_sj_id_in_array === false) {
                        $sj_ids[]=$spk_produk_nota_sj['srjalan_id'];
                    }
                }
            }
            // dd($sj_ids);

            $spk->delete();
            $warning_logs[]="$spk[no_spk] berhasil dihapus!";
            foreach ($nota_ids as $nota_id) {
                $nota_to_delete=Nota::find($nota_id);
                $nota_to_delete->delete();
                $warning_logs[]="Nota terkait: $nota_to_delete[no_nota] berhasil dihapus!";
            }

            foreach ($sj_ids as $sj_id) {
                $sj_to_delete=Srjalan::find($sj_id);
                $sj_to_delete->delete();
                $warning_logs[]="Sr. Jalan terkait: $sj_to_delete[no_srjalan] berhasil dihapus!";
            }

            $main_log = "SUCCESS:";
        }

        $route='SPK';
        $route_btn='Ke Daftar SPK';
        $data = [
            'success_logs' => $success_logs,'error_logs' => $error_logs,'warning_logs'=>$warning_logs,'main_log' => $main_log,
            'route'=>$route,'route_btn'=>$route_btn,
        ];

        return view('layouts.db-result', $data);
    }

    public function spkEditTglPembuatan(Request $request)
    {
        $_success=$_warnings=$_errors="";
        $post=$request->post();
        $spk_id=$post['spk_id'];
        $created_at=$post['tgl_pembuatan'];
        // $created_at=date('d-m-Y H:i:s', strtotime($post['tgl_pembuatan']));
        // dd($post);
        $spk=Spk::find($spk_id);

        $spk->update([
            'created_at'=>$created_at
        ]);
        $_success.="_ Tanggal pembuatan $spk[no_spk] telah diupdate!";

        $_logs=["_success"=>$_success,"_warnings"=>$_warnings,"_errors"=>$_errors];
        return back()->with($_logs);
    }

}
