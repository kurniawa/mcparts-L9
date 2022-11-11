<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Alamat;
use App\Models\Nota;
use App\Models\Pelanggan;
use App\Models\PelangganAlamat;
use App\Models\PelangganKontak;
use App\Models\PelangganNamaproduk;
use App\Models\Produk;
use App\Models\ProdukHarga;
use App\Models\SiteSetting;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\Srjalan;
use Illuminate\Http\Request;

class NotaDetailController extends Controller
{
    public function notaSelesai(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();
        // dd('$get:', $get);
        $nota_id=$get['nota_id'];

        $obj_nota = new Nota();
        list($nota,$pelanggan,$pelanggan_nama,$alamat,$cust_long_ala,$alamat_avas,$cust_kontak,$kontak,$kontak_avas,$reseller,$reseller_nama,$alamat_reseller,$reseller_long_ala,$alamat_reseller_avas,$reseller_kontak,$kontak_reseller,$kontak_reseller_avas,$spk_produk_notas, $spk_produks, $produks,$data_items) = $obj_nota->getOneNotaAndComponents($get['nota_id']);

        // Setting untuk nama nota khusus pelanggan apabila tersedia
        $nama_notas=array();
        for ($i=0; $i < count($spk_produk_notas); $i++) {
            $nama_nota=$produks[$i]['nama_nota'];
            if ($spk_produk_notas[$i]['namaproduk_id']!==null) {
                $pelanggan_namaproduk=PelangganNamaproduk::find($spk_produk_notas[$i]['namaproduk_id']);
                $nama_nota=$pelanggan_namaproduk['nama_nota'];
            }
            $nama_notas[]=$nama_nota;
        }

        $reseller_id=null;
        if ($reseller!==null) {
            $reseller_id=$reseller['id'];
        }

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'nota' => $nota,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'reseller' => $reseller,
            'reseller_id' => $reseller_id,
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
        ];
        // dump($data);
        // dd($data);
        return view('nota.notaSelesai', $data);
    }

    public function notaSelesaiDB(Request $request)
    {
        // Tanggal selesai ini penting untuk menetapkan nota sebagai nota fix dengan nama_nota, tanggal, nama_pelanggan yang tidak akan
        // ikut berubah ke depan nya jika ada edit nama_produk, pelanggan_nama, dll.
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
        $nota_id = $post['nota_id'];
        $pelanggan_id=$post['pelanggan_id'];
        $reseller_id=$post['reseller_id'];
        $finished_at=$post['tgl_selesai'];
        // dump($finished_at);
        // $finished_at=date('d-m-Y H:i:s', strtotime($finished_at));
        // dd($finished_at);

        if ($run_db) {
            $nota = Nota::find($nota_id);
            $pelanggan=Pelanggan::find($pelanggan_id);
            // Menetapkan Data Pelanggan Fix
            $fixedNamaAlamatKontak=new Pelanggan();
            $fixedNamaAlamatKontak->notaSelesai_fixNamaAlamatKontakPelanggan($nota,$pelanggan);
            $success_logs[]="Menetapkan Nama, Alamat, Kontak Pelanggan Fix.";

            // Menetapkan Data Reseller Fix
            if ($reseller_id!==null) {
                $reseller=Pelanggan::find($reseller_id);
                $fixedNamaAlamatKontak->notaSelesai_fixNamaAlamatKontakReseller($nota,$reseller);
                $success_logs[]="Menetapkan Nama, Alamat, Kontak Reseller Fix.";
            }

            // Menetapkan Tanggal Selesai Nota
            $nota->finished_at=$finished_at;
            $nota->save();

            $success_logs[]="Menetapkan tanggal selesai dari Nota: $nota[no_nota]! Berhasil Update Data Nota Selesai";

            // Menetapkan Data spk_produk_nota
            $fixedNamaNota=new SpkProdukNota();
            $fixedNamaNota->notaSelesai_fixNamaItemNota($nota['id']);
            $success_logs[]="Menetapkan Nama Nota Item.";

            $main_log = 'SUCCESS:';
            $load_num->value+=1;
            $load_num->save();
        }

        $route='daftar_nota';
        $route_btn='Ke Daftar Nota';
        $params=null;
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }

    public function notaDetail_assignAlamat(Request $request)
    {
        SiteSettings::loadNumToZero();
        $get = $request->query();

        $obj_nota = new Nota();
        list($nota,$pelanggan,$pelanggan_nama,$alamat,$cust_long_ala,$alamat_avas,$cust_kontak,$kontak,$kontak_avas,$reseller,$reseller_nama,$alamat_reseller,$reseller_long_ala,$alamat_reseller_avas,$reseller_kontak,$kontak_reseller,$kontak_reseller_avas,$spk_produk_notas, $spk_produks, $produks,$data_items) = $obj_nota->getOneNotaAndComponents($get['nota_id']);

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'nota' => $nota,
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
        ];
        // dd($data);
        // dump($data);
        return view('nota.assign-alamat', $data);
    }

    public function notaDetail_assignAlamatDB(Request $request)
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
        $nota_id = $post['nota_id'];
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
            $nota=Nota::find($nota_id);
            $nota->alamat_id=$alamat_pelanggan_id;
            $nota->alamat_reseller_id=$alamat_reseller_id;
            $nota->save();

            $success_logs[]="Alamat pelanggan dan alamat reseller telah ditetapkan untuk nota ini!";

            if ($is_also_for_sj==='yes') {
                $spk_produk_nota_srjalans=SpkProdukNotaSrjalan::where('nota_id',$nota['id'])->get();
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
        $params=['nota_id'=>$nota_id];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }

    public function notaEditTglPembuatan(Request $request)
    {
        $_success=$_warnings=$_errors="";
        $post=$request->post();
        $nota_id=$post['nota_id'];
        $created_at=$post['tgl_pembuatan'];
        // $created_at=date('d-m-Y H:i:s', strtotime($post['tgl_pembuatan']));
        // dd($post);
        $nota=Nota::find($nota_id);

        $nota->update([
            'created_at'=>$created_at
        ]);
        $_success.="_ Tanggal pembuatan $nota[no_nota] telah diupdate!";

        $_logs=["_success"=>$_success,"_warnings"=>$_warnings,"_errors"=>$_errors];
        return back()->with($_logs);
    }

    public function notaFix(Request $request)
    {
        $_success=$_warnings=$_errors="";
        $post=$request->post();
        // dd($post);
        $nota_id=$post['nota_id'];
        $nota=Nota::find($nota_id);
        /**
         * spk_produk_notas fix harga dan fix nama
         */
        $spk_produk_notas=SpkProdukNota::where('nota_id',$nota['id'])->get();
        $harga_total=0;
        foreach ($spk_produk_notas as $spk_produk_nota) {
            $produk=Produk::find($spk_produk_nota->produk_id);
            $harga=$spk_produk_nota->harga;
            if ($spk_produk_nota->produk_harga_id!==null) {
                $produk_harga=ProdukHarga::find($spk_produk_nota->produk_harga_id);
                $harga=$produk_harga->harga;
            } else {
                $produk_harga=ProdukHarga::where('produk_id',$produk->id)->where('status','DEFAULT')->first();
                if ($produk_harga!==null) {
                    $harga=$produk_harga->harga;
                }
            }
            $harga_t=$spk_produk_nota->jumlah*$harga;
            $nama_nota=$produk->nama_nota;
            if ($spk_produk_nota->namaproduk_id!==null) {
                $pelanggan_namaproduk=PelangganNamaproduk::find($spk_produk_nota->namaproduk_id);
                $nama_nota=$pelanggan_namaproduk->nama_nota;
            }
            $spk_produk_nota->update([
                'nama_nota'=>$nama_nota,
                'harga'=>$harga,
                'harga_t'=>$harga_t,
            ]);
            $harga_total+=$harga_t;
        }
        $_success.="Semua item pada nota diupdate: nama_nota, harga, harga_t --";
        /**
         * sekarang giliran nota nya yang diupdate
         */
        // Data Pelanggan
        $pelanggan=Pelanggan::find($nota['pelanggan_id']);
        $pelanggan_nama=$pelanggan['nama'];
        $pelanggan_alamat=PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
        $cust_long_ala=$cust_short=null;
        if ($pelanggan_alamat!==null) {
            $alamat=Alamat::find($pelanggan_alamat['alamat_id']);
            $cust_long_ala=$alamat['long'];
            $cust_short=$alamat['short'];
        }
        $pelanggan_kontak=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->where('is_aktual','yes')->first();
        $cust_kontak=null;
        if ($pelanggan_kontak!==null) {
            $pelanggan_kontak['id'];
            $cust_kontak=json_encode($pelanggan_kontak->toArray());
        }
        // Data Reseller
        $reseller_nama=$reseller_long_ala=$reseller_short=$reseller_kontak=null;
        if ($nota['reseller_id']!==null) {
            $reseller=Pelanggan::find($nota['reseller_id']);
            $reseller_nama=$reseller['nama'];
            $reseller_alamat=PelangganAlamat::where('pelanggan_id',$nota['reseller_id'])->where('tipe','UTAMA')->first();
            if ($reseller_alamat!==null) {
                $alamat_reseller=Alamat::find($reseller_alamat['alamat_id']);
                $reseller_long_ala=$alamat_reseller['long'];
                $reseller_short=$alamat_reseller['short'];
            }
            $kontak_reseller=PelangganKontak::where('pelanggan_id',$nota['reseller_id'])->where('is_aktual','yes')->first();
            if ($reseller_kontak!==null) {
                $reseller_kontak=json_encode($kontak_reseller->toArray());
            }
        }

        $user=auth()->user();
        $data_nota=[
            'harga_total'=>$harga_total,
            'updated_by'=>$user['username'],
            'pelanggan_nama'=>$pelanggan_nama,
            'cust_long_ala'=>$cust_long_ala,
            'cust_short'=>$cust_short,
            'cust_kontak'=>$cust_kontak,
            'reseller_nama'=>$reseller_nama,
            'reseller_long_ala'=>$reseller_long_ala,
            'reseller_short'=>$reseller_short,
            'reseller_kontak'=>$reseller_kontak,
        ];

        $nota->update($data_nota);
        $_success.="Data Nota $nota->no_nota telah diupdate: harga_total, pelanggan, reseller, alamat dan kontak yang tercantum pada nota --";

        $_logs=["_success"=>$_success,"_warnings"=>$_warnings,"_errors"=>$_errors];
        return back()->with($_logs);
    }
}
