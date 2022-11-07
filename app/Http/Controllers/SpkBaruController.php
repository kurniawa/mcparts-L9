<?php

namespace App\Http\Controllers;

use App\Helpers\PelangganHelper;
use App\Helpers\SiteSettings;
use App\Helpers\UpdateDataSPK;
use App\Models\Daerah;
use App\Models\Pelanggan;
use App\Models\PelangganReseller;
use App\Models\Produk;
use App\Models\ProdukHarga;
use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\TempSpk;
use App\Models\TempSpkProduk;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpkBaruController extends Controller
{
    public function index()
    {
        SiteSettings::loadNumToZero();

        $label_pelanggans=PelangganHelper::label_pelanggans();

        /**Seandainya udah sempat buat sebelum nya */
        $user=auth()->user();
        $temp_spks = TempSpk::where('user_id',$user['id'])->get()->toArray();
        $pelanggans = $resellers = array();
        // dd($temp_spks);

        foreach ($temp_spks as $temp_spk) {
            $pelanggan=Pelanggan::find($temp_spk['pelanggan_id'])->toArray();
            $pelanggans[]=$pelanggan;

            if ($temp_spk['reseller_id']!==null) {
                $reseller=Pelanggan::find($temp_spk['reseller_id'])->toArray();
            } else {
                $reseller=null;
            }
            $resellers[]=$reseller;
        }

        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
            'label_pelanggans' => $label_pelanggans,
            'temp_spks' => $temp_spks,
            'pelanggans' => $pelanggans,
            'resellers' => $resellers,
            // 'pelanggan_resellers' => $pelanggan_resellers,
        ];

        return view('spk.spk-baru', $data);
    }

    public function SPKBaruDB(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $_errors=$_warnings=$_success="";

        if ($load_num->value > 0) {
            $run_db = false;
            $_errors.= '_ WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dd('$post: ', $post);
        $user=auth()->user();

        $temp_spk = [
            'pelanggan_id'=>$post['pelanggan_id'],
            'reseller_id'=>$post['reseller_id'],
            'judul'=>$post['judul'],
            'user_id'=>$user['id'],
            'created_at'=>date('d-m-Y H:i:s', strtotime($post['tanggal'])),
        ];
        if ($run_db) {
            $insert_temp_spk = TempSpk::create($temp_spk);
            $_success= 'Berhasil mempersiapkan cart untuk SPK Baru!';
        }

        // $route = 'SPK-Review';
        // $route_btn='Ke Review SPK';
        // $params=['temp_spk_id'=>$insert_temp_spk['id']];
        // $data = [
        //     'error_logs' => $error_logs,'warning_logs' => $warning_logs,'success_logs' => $success_logs,
        //     'route' => $route,'route_btn' => $route_btn,'params' => $params,
        // ];

        // return view('layouts.db-result', $data);
        $_logs=[
            '_success'=>$_success,
            '_warnings'=>$_warnings,
            '_errors'=>$_errors,
        ];
        return redirect()->route('SPK-Review',['temp_spk_id'=>$insert_temp_spk['id']])->with($_logs);
    }

    public function spk_review(Request $request)
    {
        //**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        SiteSettings::loadNumToZero();
        $get=$request->query();

        // dump($get);
        $temp_spk = TempSpk::find($get['temp_spk_id'])->toArray();
        $pelanggan = Pelanggan::find($temp_spk['pelanggan_id']);
        $alamat = $pelanggan->alamat->first()->toArray();
        $reseller = null;
        $reseller_id = null;
        if ($temp_spk['reseller_id'] !== null) {
            $reseller = Pelanggan::find($temp_spk['reseller_id']);
            $reseller_id = $reseller['id'];
        }
        $produks = array();

        $temp_spk_produks = TempSpkProduk::where('temp_spk_id',$temp_spk['id'])->get()->toArray();
        foreach ($temp_spk_produks as $spk_produk) {
            $produk = Produk::find($spk_produk['produk_id'])->toArray();
            if (count($produk)!==0) {
                $produks[]=$produk;
            }
        }

        $data = [
            'go_back' => true,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'reseller' => $reseller,
            'reseller_id' => $reseller_id,
            'produks' => $produks,
            'temp_spk_produks' => $temp_spk_produks,
            'temp_spk' => $temp_spk,
        ];

        return view('spk.spk_baru-spk_review', $data);
    }

    public function SPK_AddItems(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('$get:', $get);
        }

        $produk = new Produk();

        $label_produks = $produk->label_produks();

        $spk_id=$temp_spk_id=null;
        if (isset($get['spk_id'])) {
            $spk_id=$get['spk_id'];
        } else {
            $temp_spk_id=$get['temp_spk_id'];
        }

        $route='SPK_AddItems-DB';
        $data = [
            'temp_spk_id' => $temp_spk_id,
            // 'mode' => $mode,
            'produks' => $label_produks,
            'route'=>$route,
            'spk_id'=>$spk_id,
        ];

        if ($show_dump) {
            dump('$data:', $data);
        }

        return view('spk.SPK_AddItems', $data);
    }

    public function SPK_AddItems_DB (Request $request)
    {
        $load_num = SiteSetting::find(1);

        $run_db = true; // true apabila siap melakukan CRUD ke DB
        // $error_logs=$warning_logs=$success_logs = array();
        $_errors=$_warnings=$_success="";

        if ($load_num->value > 0) {
            $run_db = false;
            // $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $_errors.= 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dd('$post: ', $post);

        /**Selection dibawah ini digunakan oleh 2 halaman, yakni halaman ketika add item pada saat pembuatan spk,
         * serta halaman ketika add item pada tambah item spk lewat spk detail
         */
        if (isset($post['spk_id']) && $post['spk_id']!==null) {
            $produk=Produk::find($post['produk_id']);
            $produk_harga =ProdukHarga::where('produk_id',$produk['id'])->first();
            if ($run_db) {
                $spk_produk=SpkProduk::create([
                    'spk_id' => $post['spk_id'],
                    'produk_id' => $post['produk_id'],
                    'jumlah' => $post['jumlah'],
                    'jml_blm_sls' => $post['jumlah'],
                    'jml_t' => $post['jumlah'],
                    'harga' => $produk_harga['harga'],
                    'keterangan' => null,
                    'status' => 'PROSES',
                ]);
                // $success_logs[]="Item baru berhasil di tambahkan ke SPK-$post[spk_id]";
                $_success.="_ Item baru berhasil di tambahkan ke SPK-$post[spk_id]";

                UpdateDataSPK::All($post['spk_id']);
                $main_log='Success';
            }

            // $route = 'SPK-Detail';
            // $route_btn='Ke Detail SPK';
            // $params=['spk_id'=>$post['spk_id']];
            // $data = [
            //     'error_logs' => $error_logs,'warning_logs' => $warning_logs,'success_logs' => $success_logs,'main_log'=>$main_log,
            //     'route' => $route,'route_btn' => $route_btn,'params' => $params,
            // ];
            $_logs=[
                '_success'=>$_success,
                '_warnings'=>$_warnings,
                '_errors'=>$_errors,
            ];
            return redirect()->route('SPK-Detail',['spk_id'=>$post['spk_id']])->with($_logs);
        } else {
            if ($run_db) {
                $tempspkproduk_new = TempSpkProduk::create([
                    'temp_spk_id'=>$post['temp_spk_id'],
                    'produk_id' => $post['produk_id'],
                    'jumlah' => $post['jumlah'],
                ]);
                $load_num->value += 1;
                $load_num->save();
                $produk = Produk::find($tempspkproduk_new['produk_id']);
                // $success_logs[] = "Item $produk[nama] telah berhasil diinput ke temp_spk_produks";
                $_success= "Item $produk[nama] telah berhasil diinput ke temp_spk_produks";
                $main_log = "Succeed!";
            }

            // $route = 'SPK-Review';
            // $route_btn='Ke Review SPK';
            // $params=['temp_spk_id'=>$post['temp_spk_id']];
            // $data = [
            //     'error_logs' => $error_logs,'warning_logs' => $warning_logs,'success_logs' => $success_logs,
            //     'route' => $route,'route_btn' => $route_btn,'params' => $params,
            // ];
            $_logs=[
                '_success'=>$_success,
                '_warnings'=>$_warnings,
                '_errors'=>$_errors,
            ];
            return redirect()->route('SPK-Review',['temp_spk_id'=>$post['temp_spk_id']])->with($_logs);
        }

        // return view('layouts.db-result', $data);
    }

    public function spkBaru_spkItem_editDelete(Request $request)
    {
        //**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        // $load_num = SiteSettings::loadNumToZero();

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;

        $ada_error = true;
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        // if ($load_num->value > 0 && $load_num_ignore === false) {
        //     $run_db = false;
        // }
        $post = $request->post();

        if ($show_dump) {
            dump('$post:', $post);
        }

        $tipe_submit = $post['tipe_submit'];

        // HAPUS SPK ITEM - SPK BARU

        if ($tipe_submit === 'hapus') {
            $load_num = SiteSetting::find(1);

            if ($show_hidden_dump) {
                dump("load_num_value: " . $load_num->value);
            }

            if ($load_num->value > 0 && $load_num_ignore === false) {
                $run_db = false;
                $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
                $ada_error = true;
                $class_div_pesan_db = 'alert-danger';
            }

            if ($run_db) {
                $temp_spk_produk = TempSpkProduk::find($post['spk_item_id']);
                $temp_spk_produk->delete();

                $load_num->value += 1;
                $load_num->save();

                $main_log = "SUCCESS: Item $temp_spk_produk[nama_nota] berhasil di hapus dari daftar item SPK!";
                $ada_error = false;
                $class_div_pesan_db = 'alert-warning';
            }

            $data = [
                'go_back_number' => -1,
                'pesan_db' => $main_log,
                'ada_error' => $ada_error,
                'class_div_pesan_db' => $class_div_pesan_db
            ];

            return view('layouts.go-back-page', $data);
        }

        // EDIT SPK ITEM - SPK BARU

        $load_num = SiteSettings::loadNumToZero();

        return;

    }

    public function proceed_spk(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;
        // $success_logs = $warning_logs = $error_logs = array();
        $_errors=$_warnings=$_success="";

        if ($load_num->value > 0) {
            $run_db = false;
            // $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $_errors.= 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $temp_spk_id = $request->post('temp_spk_id');

        // dd($temp_spk_id);

        /**PEMBATALAN */
        if (isset($post['batal'])) {
            $temp_spk=TempSpk::find($post['temp_spk_id']);
            if ($run_db) {
                $temp_spk->delete();
                // $warning_logs[]='_ Pembuatan SPK dibatalkan. Data TempSPK dan TempSPKProduk dihapus!';
                $_warnings.='_ Pembuatan SPK dibatalkan. Data TempSPK dan TempSPKProduk dihapus!';
            }
            // $route='Home';
            // $route_btn='Ke Home';
            // $data=[
            //     'success_logs'=>$success_logs,'warning_logs'=>$warning_logs,'error_logs'=>$error_logs,
            //     'route'=>$route,'route_btn'=>$route_btn,
            // ];
            // return view('layouts.db-result',$data);
            $_logs=[
                '_success'=>$_success,
                '_warnings'=>$_warnings,
                '_errors'=>$_errors,
            ];
            return redirect()->route('SPK')->with($_logs);
        }
        /**END: PEMBATALAN */

        /**PROCEED SPK*/
        if ($run_db) {
            // Data dari Temp_spk masuk ke spk - pembuatan spk baru
            $temp_spk=TempSpk::find($temp_spk_id);
            $new_spk=Spk::proceedSPK($temp_spk);
            // $success_logs[]="SPK baru telah dibuat. Nomor SPK: $new_spk[no_spk].";
            $_success.="_ SPK baru telah dibuat. Nomor SPK: $new_spk[no_spk].";

            $temp_spk_produks=TempSpkProduk::where('temp_spk_id',$temp_spk_id)->get();
            // VARIABLE YANG NANTINYA AKAN DIINSERT KE TABLE PRODUKS
            $jumlah_total=$harga_total=0;
            for ($i = 0; $i < count($temp_spk_produks); $i++) {
                $produk_harga = ProdukHarga::where('produk_id', $temp_spk_produks[$i]->produk_id)->first();
                $produk=Produk::find($temp_spk_produks[$i]->produk_id);

                $new_spk_produk=SpkProduk::create([
                    'spk_id' => $new_spk['id'],
                    'produk_id' => $temp_spk_produks[$i]->produk_id,
                    'jumlah' => $temp_spk_produks[$i]->jumlah,
                    'jml_blm_sls' => $temp_spk_produks[$i]->jumlah,
                    'jml_t' => $temp_spk_produks[$i]->jumlah,
                    'harga' => $produk_harga['harga'],
                    'keterangan' => $temp_spk_produks[$i]->keterangan,
                    'status' => 'PROSES',
                    'nama_produk' => $produk['nama'],
                ]);
                // array_push($success_logs, "Input Item -> $new_spk_produk[nama_produk] ke Database. Relasi ke $new_spk[no_spk] dibuat.");
                $_success.= "_ Input Item -> $new_spk_produk[nama_produk] ke Database. Relasi ke $new_spk[no_spk] dibuat.";

                $harga_total+=$new_spk_produk['harga']*$new_spk_produk['jumlah'];
                $jumlah_total+=$new_spk_produk['jumlah'];
            }

            // UPDATE JUMLAH TOTAL DAN HARGA TOTAL DI SPK
            $new_spk->update([
                'jumlah_total'=>$jumlah_total,
                'harga_total'=>$harga_total,
            ]);

            // $success_logs[] = 'Harga Total dan Jumlah Total SPK telah diupdate!';
            $_success.= '_ Harga Total dan Jumlah Total SPK telah diupdate!';

            $temp_spk->delete();
            // array_push($success_logs, 'Related TempSpk deleted and all items in temp_spk_produks deleted.');
            $_success.= '_ Related TempSpk deleted and all items in temp_spk_produks deleted.';

            $load_num->value+=1;
            $load_num->save();
        }

        // $route = 'SPK';
        // $route_btn = 'Daftar SPK';
        // $data = [
        //     'success_logs' => $success_logs,'error_logs' => $error_logs,'warning_logs' => $warning_logs,
        //     'route' => $route,'route_btn' => $route_btn,
        // ];

        // return view('layouts.db-result', $data);

        $_logs=[
            '_success'=>$_success,
            '_warnings'=>$_warnings,
            '_errors'=>$_errors,
        ];
        return redirect()->route('SPK')->with($_logs);
    }
}
