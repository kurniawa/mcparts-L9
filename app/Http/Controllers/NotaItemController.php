<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Helpers\UpdateDataSPK;
use App\Models\Nota;
use App\Models\Pelanggan;
use App\Models\PelangganNamaproduk;
use App\Models\PelangganProduk;
use App\Models\Produk;
use App\Models\ProdukHarga;
use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\Srjalan;
use Illuminate\Http\Request;

class NotaItemController extends Controller
{
    public function NotaItemBaru_DB(Request $request)
    {
        $success_logs = $error_logs = $warning_logs="";

        $post = $request->input();
        // dd($post);
        $spk_produk_id=$post['spk_produk_id'];
        $jumlah=$post['jml_nota_new'];
        /**PENGECEKAN */
        if ($jumlah===0 || $jumlah<0) {
            return back()->with('error','Input jumlah harus lebih dari 0!');
        }
        if ($jumlah===null) {
            return back()->with('error','Input jumlah tidak valid!');
        }
        // Cek berapa jumlah selesai nya, apakah jumlah input lebih daripada jumlah selesai
        // dan jumlah yang sudah nota
        $spk_produk=SpkProduk::find($spk_produk_id);
        $jumlah_selesai=$spk_produk['jml_selesai'];
        $jumlah_sudah_nota=0;
        $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk_id)->get();
        foreach ($spk_produk_notas as $spk_produk_nota) {
            $jumlah_sudah_nota+=$spk_produk_nota['jumlah'];
        }
        $jumlah_ava=$jumlah_selesai-$jumlah_sudah_nota;
        // dd($jumlah_ava);
        if ($jumlah>$jumlah_ava) {
            return back()->with('error', 'Jumlah input melebihi jumlah selesai atau tidak sesuai dengan jumlah yang sudah diinput ke nota...');
        }
        /** */
        UpdateDataSPK::newNota_basedOn_spkProdukID_with_certainJumlah($spk_produk_id,$jumlah);
        $success_logs.="Berhasil membuat Nota baru...";
        //UPDATE spk_produk->jml_sdh_nota
        UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk_id);
        $success_logs.='spk_produk: Jumlah Sudah Nota diupdate.';

        // return $data;
        // return view('layouts.db-result', $data);
        return back()->with('success',$success_logs);
    }

    public function newSpkProN_to_avaN(Request $request)
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
        // return $post;
        // cari harga produk
        $produk_harga=ProdukHarga::where('produk_id',$post['produk_id'])->latest()->first();
        // return $produk_harga['harga'];
        $harga=$produk_harga['harga'];
        $harga_t=$harga*(int)$post['jumlah'];
        if ($run_db) {
            $spk_produk_nota=SpkProdukNota::create([
                'spk_id'=>$post['spk_id'],
                'produk_id'=>$post['produk_id'],
                'spk_produk_id'=>$post['spk_produk_id'],
                'nota_id'=>$post['nota_id'],
                'jumlah'=>(int)$post['jumlah'],
                'harga'=>(int)$harga,
                'harga_t'=>$harga_t,
            ]);
            //UPDATE spk_produk->jml_sdh_nota
            UpdateDataSPK::SpkProduk_JmlNota_Status($post['spk_produk_id']);
            $success_logs[]='spk_produk: Jumlah Sudah Nota diupdate.';

            UpdateDataSPK::Nota_JmlT_HargaT($spk_produk_nota['nota_id']);
            $success_logs[]='nota: Jumlah dan Harga Total Nota diupdate.';

            $main_log='Success';

            $data=[
                'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
            ];
            return $data;
        }
    }

    public function editJmlSpkPN(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db=true;
        $success_logs = $error_logs = $warning_logs="";
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->input();
        // dd($post);
        $spk_produk_nota_id=$post['spk_produk_nota_id'];
        $nota_id=$post['nota_id'];
        $spk_produk_id=$post['spk_produk_id'];
        $jumlah=(int)$post['jumlah'];
        $type=$post['type'];

        if ($type==='edit') {
            /**Mulai Pengecekan */
            /**Cek apakah semua input jumlah===null */
            if ($jumlah===0 || $jumlah<0) {
                return back()->with('error','Input jumlah harus lebih dari 0!');
            }
            if ($jumlah===null) {
                return back()->with('error','Input jumlah tidak valid!');
            }
            // Cek apakah jumlah yang diinput melebihi jumlah selesai spk_produk ini?
            $spk_produk=SpkProduk::find($spk_produk_id);
            $jumlah_selesai=$spk_produk['jml_selesai'];
            $jumlah_sudah_nota_other=0;
            if ($spk_produk_nota_id!==null) {
                $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk_id)->where('id','!=',$spk_produk_nota_id)->get();
            } else {
                $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk_id)->get();
            }
            foreach ($spk_produk_notas as $spk_produk_nota) {
                $jumlah_sudah_nota_other+=$spk_produk_nota['jumlah'];
            }
            $jumlah_ava=$jumlah_selesai-$jumlah_sudah_nota_other;
            // dump($jumlah_selesai);
            // dump($spk_produk_notas);
            // dd($jumlah_ava);
            if ($jumlah>$jumlah_ava) {
                return back()->with('error','Jumlah input tidak sesuai dengan jumlah_selesai dan jumlah yang sudah nota!');
            }
            /** */
            if ($run_db) {
                if ($spk_produk_nota_id===null) {
                    // Sama seperti create baru, namun nota_id sudah diketahui
                    UpdateDataSPK::newSPKProdukNota_certainJumlah($spk_produk_id,$nota_id,$jumlah);
                    $success_logs.="Berhasil membuat Nota baru...";
                    //UPDATE spk_produk->jml_sdh_nota
                    UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk_id);
                    $success_logs.='spk_produk: Jumlah Sudah Nota diupdate.';
                } else {
                    $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_id);
                    $spk_produk_nota->jumlah=$jumlah;
                    $spk_produk_nota->save();
                    $success_logs.='spk_produk_nota: Jumlah Nota item yang berkaitan sudah diupdate.';

                    //UPDATE spk_produk->jml_sdh_nota
                    UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk_id);
                    $success_logs.='spk_produk: Jumlah Sudah Nota diupdate.';

                    UpdateDataSPK::Nota_JmlT_HargaT($spk_produk_nota['nota_id']);
                    $success_logs.='nota: Jumlah dan Harga Total Nota diupdate.';
                }
                // return $data;
            }
        } elseif ($type==='delete') {
            if ($run_db) {
                // Cari terlebih dahulu apakah ada spk_produk_nota lain dengan nota yang sama?
                // Kalau tidak ada, maka hapus nota aja, dan harusnya otomatis kehapus juga spk_produk_nota nya.

                $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_id);
                // sebelum hapus spk_produk_nota, kita hapus dulu spk_produk_nota_srjalan yang berkaitan apabila exist
                $spk_produk_nota_srjalans=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spk_produk_nota_id)->get();
                foreach ($spk_produk_nota_srjalans as $spk_produk_nota_srjalan) {
                    $success_logs.=Srjalan::deleteSJ_basedOn_SPKProNSJID($spk_produk_nota_srjalan['id']);
                }
                $spk_produk_nota_other=SpkProdukNota::where('nota_id',$spk_produk_nota['nota_id'])->where('id','!=',$spk_produk_nota_id)->first();
                if ($spk_produk_nota_other===null) {
                    $nota=Nota::find($spk_produk_nota['nota_id']);
                    $nota->delete();
                    $success_logs.='Tidak ada lagi spk_produk_nota yang sama, oleh karena itu nota akan langsung dihapus saja. Dengan demikan otomatis spk_produk_nota yang ingin di hapus juga akan ikut terhapus.';

                    //UPDATE spk_produk->jml_sdh_nota
                    UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk_nota['spk_produk_id']);
                    $success_logs.='spk_produk: Jumlah Sudah Nota diupdate.';
                } else {
                    $spk_produk_nota->delete();
                    $success_logs.='spk_produk_nota: berhasil dihapus!';
                    //UPDATE spk_produk->jml_sdh_nota
                    UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk_nota['spk_produk_id']);
                    $success_logs.='spk_produk: Jumlah Sudah Nota diupdate.';

                    UpdateDataSPK::Nota_JmlT_HargaT($spk_produk_nota['nota_id']);
                    $success_logs.='nota: Jumlah dan Harga Total Nota diupdate.';
                }

            }
        }

        return back()->with('success',$success_logs);
    }

    // public function delSpkPN(Request $request)
    // {
    //     $run_db=true;
    //     $success_logs = $error_logs = $warning_logs="";
    //     $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

    //     $post = $request->input();
    //     $spk_produk_nota_id=$post['spk_produk_nota_id'];
    //     // return $post;
    //     if ($run_db) {
    //         // Cari terlebih dahulu apakah ada spk_produk_nota lain dengan nota yang sama?
    //         // Kalau tidak ada, maka hapus nota aja, dan harusnya otomatis kehapus juga spk_produk_nota nya.

    //         $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_id);
    //         $spk_produk_nota_other=SpkProdukNota::where('nota_id',$spk_produk_nota['nota_id'])->where('id','!=',$spk_produk_nota_id)->first();
    //         if ($spk_produk_nota_other===null) {
    //             $nota=Nota::find($spk_produk_nota['nota_id']);
    //             $nota->delete();
    //             $success_logs.='Tidak ada lagi spk_produk_nota yang sama, oleh karena itu nota akan langsung dihapus saja. Dengan demikan otomatis spk_produk_nota yang ingin di hapus juga akan ikut terhapus.';

    //             //UPDATE spk_produk->jml_sdh_nota
    //             UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk_nota['spk_produk_id']);
    //             $success_logs.='spk_produk: Jumlah Sudah Nota diupdate.';
    //         } else {
    //             $spk_produk_nota->delete();
    //             $success_logs.='spk_produk_nota: berhasil dihapus!';
    //             //UPDATE spk_produk->jml_sdh_nota
    //             UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk_nota['spk_produk_id']);
    //             $success_logs.='spk_produk: Jumlah Sudah Nota diupdate.';

    //             UpdateDataSPK::Nota_JmlT_HargaT($spk_produk_nota['nota_id']);
    //             $success_logs.='nota: Jumlah dan Harga Total Nota diupdate.';
    //         }

    //         $main_log='Success';

    //         $data=[
    //             'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
    //         ];
    //         // return $data;
    //         return back()->with('success',$success_logs);
    //     }
    // }

    public function NotaItemAva_DB(Request $request)
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
        // dump($post);

        $spk_produk=SpkProduk::find($post['spk_produk_id']);
        // Cek Jumlah Total di Array input jumlah
        $jumlah_input=0;
        foreach ($post['jumlah'] as $jumlah) {
            $jumlah_input+=(int)$jumlah;
        }
        if ($spk_produk['jml_selesai']<$jumlah_input) {
            $run_db=false;
            $error_logs[]='Jumlah yang tersedia untuk dapat diinput ke nota tidak memadai!';
            $main_log='Error';
        }
        $spk=Spk::find($spk_produk['spk_id']);
        $user=auth()->user();
        $i=0;
        if ($run_db) {
            foreach ($post['nota_id_terkait_spk'] as $nota_id) {
                $spk_produk_nota=null;
                if ($post['spk_produk_nota_id_terkait_item'][$i]===null) {
                    dump('masuk ke spk_produk_nota baru');
                    // Pembuatan spk_produk_nota baru
                    $spk_produk_nota=SpkProdukNota::create([
                        'spk_id'=>$spk['id'],
                        'produk_id'=>$spk_produk['produk_id'],
                        'spk_produk_id'=>$spk_produk['id'],
                        'nota_id'=>$nota_id,
                        'jumlah'=>(int)$post['jumlah'][$i],
                        'harga'=>(int)$spk_produk['harga'],
                        'harga_t'=>$spk_produk['harga']*(int)$post['jumlah'][$i],
                    ]);
                    $success_logs[]='spk_produk_nota baru telah diupdate.';
                } else {
                    dump('masuk ke update spk_produk_nota');
                    dump((int)$post['jumlah'][$i]);
                    $spk_produk_nota=SpkProdukNota::find($post['spk_produk_nota_id_terkait_item'][$i]);
                    $spk_produk_nota->jumlah=(int)$post['jumlah'][$i];
                    $spk_produk_nota->harga=$spk_produk['harga'];
                    $spk_produk_nota->harga_t=$spk_produk['harga']*(int)$post['jumlah'][$i];
                    $spk_produk_nota->save();
                    $success_logs[]='spk_produk_nota telah diupdate.';
                }

                //UPDATE spk_produk->jml_sdh_nota
                UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk['id']);
                $success_logs[]='spk_produk: Jumlah Sudah Nota diupdate.';

                UpdateDataSPK::Nota_JmlT_HargaT($spk_produk_nota['nota_id']);
                $success_logs[]='nota: Jumlah dan Harga Total Nota diupdate.';

                UpdateDataSPK::Nota_JmlT_HargaT($spk_produk_nota['nota_id']);
                $i++;
            }
            $load_num->value+=1;
            $load_num->save();
            $warning_logs[]='Load Num telah ditambah satu.';
            $main_log='Success';
        }

        $route='SPK-Detail';
        $params=['spk_id'=>$spk_produk['spk_id']];
        $route_btn='Ke Detail SPK';
        $data=[
            'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params
        ];
        return view('layouts.db-result', $data);
    }

    public function edit_nama_item_nota(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();

        // dd('$get:', $get);

        $data_item = json_decode($get['data_item'], true);

        $spk_produk_nota = SpkProdukNota::find($data_item['spk_produk_nota_id']);
        $spk_produk = SpkProduk::find($data_item['spk_produk_id']);
        $produk = Produk::find($data_item['produk_id']);
        $nota = Nota::find($get['nota_id']);
        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $reseller = null;
        $reseller_id=null;
        if ($nota['reseller_id'] !== null) {
            $reseller = Pelanggan::find($nota['reseller_id']);
            $reseller_id=$reseller['id'];
        }
        $pelanggan_namaproduks=PelangganNamaproduk::where('pelanggan_id',$pelanggan['id'])->get();
        $pelanggan_namaproduk=PelangganNamaproduk::where('pelanggan_id',$pelanggan['id'])->where('status','DEFAULT')->latest()->first();
        $namanota_khusus_pelanggan='-';
        if ($pelanggan_namaproduk!==null) {
            $namanota_khusus_pelanggan=$pelanggan_namaproduk['nama_nota'];
        }
        $namanota_now=null;
        if ($spk_produk_nota['namaproduk_id']!==null) {
            $pelanggan_namaproduk=PelangganNamaproduk::find($spk_produk_nota['namaproduk_id']);
            $namanota_now=$pelanggan_namaproduk['nama_nota'];
        } else {
            $namanota_now=$produk['nama_nota'];
        }

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'nota' => $nota,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
            'reseller_id' => $reseller_id,
            'spk_produk_nota' => $spk_produk_nota,
            'spk_produk' => $spk_produk,
            'produk' => $produk,
            'pelanggan_namaproduks'=>$pelanggan_namaproduks,
            'namanota_now'=>$namanota_now,
            'namanota_khusus_pelanggan'=>$namanota_khusus_pelanggan,
        ];

        // dump($data);

        return view('nota.edit_nama_item_nota', $data);
    }

    public function input_nama_nota_item(Request $request)
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
        // dd($post);
        $nama_baru=$post['nama_baru'];
        $nota_id=$post['nota_id'];
        $pelanggan_id=$post['pelanggan_id'];
        $reseller_id=$post['reseller_id'];
        $produk_id=$post['produk_id'];

        // dd('post', $post);

        if ($run_db) {
            $pelanggan_namaproduk_id=null;
            $pelanggan_namaproduk=PelangganNamaproduk::where('produk_id',$produk_id)->where('pelanggan_id',$pelanggan_id)->where('nama_nota',$nama_baru)->first();
            if ($pelanggan_namaproduk!==null) {
                $pelanggan_namaproduk_id=$pelanggan_namaproduk['id'];
                $success_logs[]='Nama yang diinput sudah exist di table pelanggan_namaproduks, maka pelanggan_namaproduk_id ditetapkan.';
                // dd($pelanggan_namaproduk);
            } else {
                $pelanggan_namaproduk_new=PelangganNamaproduk::create([
                    'pelanggan_id'=>$pelanggan_id,
                    'reseller_id'=>$reseller_id,
                    'produk_id'=>$produk_id,
                    'nama_nota'=>$nama_baru,
                    'status'=>'DEFAULT',
                ]);
                $pelanggan_namaproduk_id=$pelanggan_namaproduk_new['id'];
                $success_logs[]='Belum ada pelanggan_namaproduk yang sama -> Berhasil create pelanggan_namaproduk baru! Nama Nota ini dijadikan sebagai nama default!';
                // Cek apakah ada nama produk lain yang sudah diset sebagai default? Kalau ada maka harus diganti menjadi lama
                $pelanggan_namaproduk_other=PelangganNamaproduk::where('produk_id',$produk_id)->where('pelanggan_id',$pelanggan_id)->where('id','!=',$pelanggan_namaproduk_new['id'])->where('status','DEFAULT')->first();
                if ($pelanggan_namaproduk_other!==null) {
                    $pelanggan_namaproduk_other->status='LAMA';
                    $pelanggan_namaproduk_other->save();
                    $success_logs[]='Terdapat nama nota DEFAULT selain dari yang sudah diinput ini. Oleh karena itu nama nota tersebut dijadikan nama LAMA';
                }
            }

            $spk_produk_nota = SpkProdukNota::find($post['spk_produk_nota_id']);
            $spk_produk_nota->namaproduk_id=$pelanggan_namaproduk_id;
            $spk_produk_nota->save();
            $success_logs[]='Berhasil update nama_nota item!';

            $main_log='SUCCESS';
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

    public function pilih_nama_nota_item(Request $request)
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
        $spk_produk_nota_id=$post['spk_produk_nota_id'];
        $data_nama=json_decode($post['data_nama'],true);
        $table_id=null;
        if (isset($data_nama['id'])) {
            $table_id=$data_nama['id'];
        }
        $table_name=$data_nama['table'];

        $namaproduk_id=null;
        if ($table_name==='pelanggan_namaproduks') {
            $namaproduk_id=$table_id;
        }

        $nota_id=$post['nota_id'];

        if ($run_db) {
            $spk_produk_nota = SpkProdukNota::find($spk_produk_nota_id);
            $spk_produk_nota->namaproduk_id=$namaproduk_id;
            $spk_produk_nota->save();
            $success_logs[]='Berhasil update nama_nota item';

            $main_log='SUCCESS';
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
}
