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
use Illuminate\Http\Request;

class NotaItemController extends Controller
{
    public function NotaItemBaru_DB(Request $request)
    {
        $run_db=true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        $post = $request->input();
        // return $post;
        // dump($post);

        $spk_produk=SpkProduk::find($post['spk_produk_id']);

        $spk=Spk::find($spk_produk['spk_id']);
        $user=auth()->user();
        $data_nota=[
            'pelanggan_id'=>$spk['pelanggan_id'],
            'reseller_id'=>$spk['reseller_id'],
            'jumlah_total'=>$post['jumlah'],
            'harga_total'=>$spk_produk['harga']*(int)$post['jumlah'],
            'created_by'=>$user['username'],
            'updated_by'=>$user['username'],
        ];
        if ($run_db) {
            $new_nota=Nota::create($data_nota);
            $success_logs[]='Nota baru telah dibuat.';
            $spk_produk_nota=[
                'spk_id'=>$spk_produk['spk_id'],
                'produk_id'=>$spk_produk['produk_id'],
                'spk_produk_id'=>$spk_produk['id'],
                'nota_id'=>$new_nota['id'],
                'jumlah'=>$post['jumlah'],
                'harga'=>$spk_produk['harga'],
                'harga_t'=>$spk_produk['harga']*(int)$post['jumlah'],
            ];
            $new_spk_produk_nota=SpkProdukNota::create($spk_produk_nota);
            $success_logs[]='spk_produk_nota baru telah dibuat.';

            //UPDATE no nota
            $new_nota->no_nota="N-$new_nota[id]";
            $new_nota->save();
            $success_logs[]='No Nota diupdate.';
            $main_log='Success';

            //UPDATE spk_produk->jml_sdh_nota
            UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk['id']);
            $success_logs[]='spk_produk: Jumlah Sudah Nota diupdate.';

        }
        $data=[
            'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
        ];
        return $data;
        // return view('layouts.db-result', $data);
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
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->input();
        // return $post;
        if ($run_db) {
            $spk_produk_nota=SpkProdukNota::find($post['spk_produk_nota_id']);
            $spk_produk_nota->jumlah=$post['jumlah'];
            $spk_produk_nota->save();
            $success_logs[]='spk_produk_nota: Jumlah Nota item yang berkaitan sudah diupdate.';

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

    public function delSpkPN(Request $request)
    {
        $run_db=true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        $post = $request->input();
        $spk_produk_nota_id=$post['spk_produk_nota_id'];
        // return $post;
        if ($run_db) {
            // Cari terlebih dahulu apakah ada spk_produk_nota lain dengan nota yang sama?
            // Kalau tidak ada, maka hapus nota aja, dan harusnya otomatis kehapus juga spk_produk_nota nya.

            $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_id);
            $spk_produk_nota_other=SpkProdukNota::where('nota_id',$spk_produk_nota['nota_id'])->where('id','!=',$spk_produk_nota_id)->first();
            if ($spk_produk_nota_other===null) {
                $nota=Nota::find($spk_produk_nota['nota_id']);
                $nota->delete();
                $success_logs[]='Tidak ada lagi spk_produk_nota yang sama, oleh karena itu nota akan langsung dihapus saja. Dengan demikan otomatis spk_produk_nota yang ingin di hapus juga akan ikut terhapus.';

                //UPDATE spk_produk->jml_sdh_nota
                UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk_nota['spk_produk_id']);
                $success_logs[]='spk_produk: Jumlah Sudah Nota diupdate.';
            } else {
                $spk_produk_nota->delete();
                $success_logs[]='spk_produk_nota: berhasil dihapus!';
                //UPDATE spk_produk->jml_sdh_nota
                UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk_nota['spk_produk_id']);
                $success_logs[]='spk_produk: Jumlah Sudah Nota diupdate.';

                UpdateDataSPK::Nota_JmlT_HargaT($spk_produk_nota['nota_id']);
                $success_logs[]='nota: Jumlah dan Harga Total Nota diupdate.';
            }

            $main_log='Success';

            $data=[
                'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'success_logs'=>$success_logs,'main_log'=>$main_log,
            ];
            return $data;
        }
    }

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

        dd('$get:', $get);

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
        ];

        // dump($data);

        return view('nota.edit_nama_item_nota', $data);
    }
}
