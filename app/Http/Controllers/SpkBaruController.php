<?php

namespace App\Http\Controllers;

use App\Helpers\PelangganHelper;
use App\Helpers\SiteSettings;
use App\Models\Daerah;
use App\Models\Pelanggan;
use App\Models\PelangganReseller;
use App\Models\Produk;
use App\Models\ProdukHarga;
use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\TempSpkProduk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpkBaruController extends Controller
{
    public function index()
    {
        echo "<img style='position:fixed;width:5rem;top:20%;left:50%;transform:translate(-50%,-50%);' id='loading-progress-icon2' src='/img/icons/loading/gear_loading-violet.gif' alt=''>";
        //**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        $load_num = SiteSettings::loadNumToZero();

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;
        // Pada development mode, load number boleh diignore. Yang perlu diperhatikan adalah
        // insert dan update database supaya tidak berantakan
        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
        }
        // $pelanggan = new Pelanggan();
        // $label_pelanggans = $pelanggan->label_pelanggans();
        // $pelanggan_resellers = PelangganReseller::orderBy('reseller_id')->get();
        $label_pelanggans = PelangganHelper::label_pelanggan_resellers();

        if ($show_dump) {
            dump("label_pelanggans");
            dump($label_pelanggans);
            // dump('$pelanggan_resellers:', $pelanggan_resellers);
        }

        // $d_nama_pelanggan_2 = $pelanggan->d_nama_pelanggan_2();
        // dd($d_label_pelanggan);
        // dd($d_label_pelanggan_2);

        $data = [
            'label_pelanggans' => $label_pelanggans,
            // 'pelanggan_resellers' => $pelanggan_resellers,
        ];

        return view('spk.spk-baru', $data);
    }

    public function spk_review(Request $request)
    {
        //**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        $load_num = SiteSettings::loadNumToZero();

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = false;
        $load_num_ignore = true;

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
        }
        $get = $request->query();
        // #
        // Karena akan sering bolak balik halaman ini, maka request methodnya ditetapkan menjadi GET
        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $daerah = Daerah::find($pelanggan['daerah_id']);
        $reseller = null;
        $reseller_id = null;
        if ($get['reseller_id'] !== null) {
            $reseller = Pelanggan::find($get['reseller_id']);
            $reseller_id = $reseller['id'];
        }
        $judul = $get['judul'];
        $tanggal = date('d-m-Y', strtotime($get['tanggal']));
        $spk_items = DB::table('temp_spk_produks')->get()->toArray();

        // dd($spk_items);
        $produks = array();
        // dd($spk_items[0]->produk_id);
        for ($i=0; $i < count($spk_items); $i++) {
            $produk = Produk::find($spk_items[$i]->produk_id)->toArray();
            $produks[] = $produk;
        }

        if ($show_dump) {
            dump("get");
            dump($get);
            dump("pelanggan");
            dump($pelanggan);
        }

        $data = [
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'reseller_id' => $reseller_id,
            'judul' => $judul,
            'spk_items' => $spk_items,
            'produks' => $produks,
            'tanggal' => $tanggal,
        ];

        return view('spk.spk_baru-spk_review', $data);
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
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
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
                $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
                $ada_error = true;
                $class_div_pesan_db = 'alert-danger';
            }

            if ($run_db) {
                $temp_spk_produk = TempSpkProduk::find($post['spk_item_id']);
                $temp_spk_produk->delete();

                $load_num->value += 1;
                $load_num->save();

                $pesan_db = "SUCCESS: Item $temp_spk_produk[nama_nota] berhasil di hapus dari daftar item SPK!";
                $ada_error = false;
                $class_div_pesan_db = 'alert-warning';
            }

            $data = [
                'go_back_number' => -1,
                'pesan_db' => $pesan_db,
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
        // #loading-progress-icon {
        //     position: fixed;
        //     width: 5rem;
        //     top: 20%;
        //     left: 50%;
        //     transform: translate(-50%, -50%);
        // }
        // echo "<img style='position:fixed;width:5rem;top:20%;left:50%;transform:translate(-50%,-50%);' id='loading-progress-icon' src='/img/icons/loading/gear_loading-violet.gif' alt=''>";

        $load_num = SiteSetting::find(1);

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;

        $ada_error = true;
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $success_messages = array();
        $error_messages = array();
        $class_div_pesan_db = 'alert-danger';

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();
        $pelanggan = Pelanggan::find($post['pelanggan_id']);

        if ($show_dump) {
            dump('$post');
            dump($post);
        }

        if ($post['submit_type'] !== 'proceed_spk') {
            $run_db = false;
        }

        $spk_item = DB::table('temp_spk_produks')->get();

        if ($show_dump) {
            dump('spk_item');
            dump($spk_item);
        }

        $reseller_id = $post['reseller_id'];

        // INSERT SPK GET SPK_ID Karena untuk update jumlah_total dan harga_total
        if ($run_db) {
            $spk = Spk::create([
                'pelanggan_id' => $post['pelanggan_id'],
                'reseller_id' => $reseller_id,
                'status' => 'PROSES',
                'judul' => $post['judul'],
                'jumlah_total' => 0,
                'harga_total' => 0,
            ]);

            DB::table('spks')
                ->where('id', $spk['id'])
                ->update([
                    'no_spk' => "SPK-$spk[id]"
                ]);
        }

        $jumlah_total = 0;
        $harga_total = 0;

        // VARIABLE YANG NANTINYA AKAN DIINSERT KE TABLE PRODUKS

        for ($i = 0; $i < count($spk_item); $i++) {
            $produk_harga = ProdukHarga::where('produk_id', $spk_item[$i]->produk_id)->first();
            $jumlah_total += $spk_item[$i]->jumlah;
            $harga_total += $produk_harga['harga'];
            if ($run_db) {
                DB::table('spk_produks')->insertGetId([
                    'spk_id' => $spk['id'],
                    'produk_id' => $spk_item[$i]->produk_id,
                    'jumlah' => $spk_item[$i]->jumlah,
                    'jml_blm_sls' => $spk_item[$i]->jumlah,
                    'harga' => $produk_harga['harga'],
                    'ktrg' => $spk_item[$i]->ktrg,
                    'status' => 'PROSES',
                ]);
            }

            if ($i >= count($spk_item)) {
                array_push($success_messages, 'success_detail: Inserting all item in spk_produk_id.');
            }
        }

        // UPDATE JUMLAH TOTAL DAN HARGA TOTAL DI SPK
        if ($run_db) {
            $spk->harga_total = $harga_total;
            $spk->jumlah_total = $jumlah_total;
            $spk->save();

            $success_messages[] = 'Harga Total dan Jumlah Total SPK diupdate!';
        }

        if ($run_db) {
            DB::table('temp_spk_produks')->truncate();
            array_push($success_messages, 'success_detail: Truncating all item in temp_spk_produks.');

            $pesan_db = "SUCCESS: SPK baru telah dibuat. Semua item telah diinput ke SPK tersebut dan temp_spk_produks telah di truncate";
            $class_div_pesan_db = 'alert-success';
        }

        $data = [
            'spk_item' => $spk_item,
            'spks' => $post,
            'go_back_number' => -3,
            'pesan_db' => $pesan_db,
            'success_messages' => $success_messages,
            'error_messages' => $error_messages,
            'ada_error' => $ada_error,
            'class_div_pesan_db' => $class_div_pesan_db,
        ];

        return view('layouts.go-back-page', $data);
    }
}
