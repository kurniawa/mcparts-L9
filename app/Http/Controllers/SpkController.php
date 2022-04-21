<?php

namespace App\Http\Controllers;

use App\Helpers\PelangganHelper;
use App\Helpers\SiteSettings;
use App\Http\Requests\StoreSpkRequest;
use App\Http\Requests\UpdateSpkRequest;
use App\Models\Daerah;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\SpkProduk;
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
        echo "<img style='position:fixed;width:5rem;top:20%;left:50%;transform:translate(-50%,-50%);' id='loading-progress-icon2' src='/img/icons/loading/gear_loading-violet.gif' alt=''>";

        //**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        $load_num = SiteSettings::loadNumToZero();

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $show_hidden_dump = false;

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        $spks = Spk::limit(100)->orderByDesc('created_at')->get();
        $pelanggans = array();
        $daerahs = array();
        $resellers = array();
        $arr_spk_produks = array();
        $arr_produks = array();
        for ($i = 0; $i < count($spks); $i++) {
            $spk = Spk::find($spks[$i]->id);
            $pelanggan = $spk->pelanggan;
            $daerah = Daerah::find($pelanggan['daerah_id']);
            if ($spks[$i]->reseller_id !== null && $spks[$i]->reseller_id !== '') {
                $reseller = Pelanggan::find($spks[$i]->reseller_id);
                array_push($resellers, $reseller);
            } else {
                array_push($resellers, 'none');
            }
            $produks = $spk->produks;
            $spk_produks = $spk->spk_produks;
            array_push($arr_produks, $produks);
            array_push($arr_spk_produks, $spk_produks);
            array_push($pelanggans, $pelanggan);
            array_push($daerahs, $daerah);
        }

        $data = [
            'spks' => $spks,
            'pelanggans' => $pelanggans,
            'daerahs' => $daerahs,
            'resellers' => $resellers,
            'arr_produks' => $arr_produks,
            'arr_spk_produks' => $arr_spk_produks,
        ];

        return view('spk.spks', $data);
    }

    public function spk_detail(Request $request)
    {
        $load_num = SiteSettings::loadNumToZero();

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $show_hidden_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('$get:', $get);
        }

        $spk = Spk::find($get['spk_id']);
        $pelanggan = Pelanggan::find($spk['pelanggan_id']);
        $reseller = null;
        $daerah = Daerah::find($pelanggan['daerah_id']);
        if ($spk['reseller_id'] !== null) {
            $reseller = Pelanggan::find($spk['reseller_id']);
        }
        $produks = $spk->produks;
        $spk_produks = $spk->spk_produks;

        $data = [
            'spk' => $spk,
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
            'my_csrf' => csrf_token(),
        ];

        return view('spk.spk-detail', $data);
    }

    public function delete_item_from_spk_detail(Request $request)
    {
        /**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */

        $load_num = SiteSetting::find(1);
        $show_dump = true;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;

        $ada_error = true;
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $success_messages = array();
        $class_div_pesan_db = 'alert-danger';

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump) {
            dump('$post:', $post);
        }

        if ($run_db) {
            $spk_produk = SpkProduk::find($post['spk_produks_id']);
            $produk = Produk::find($spk_produk['produk_id']);
            $spk_produk->delete();

            $load_num->value += 1;
            $load_num->save();

            $pesan_db = "SUCCESS: Item $produk[nama] berhasil di hapus dari daftar item SPK!";
            array_push($success_messages, "success_message: spk_produk dengan id: $spk_produk[id] berhasil dihapus");

            $spk = Spk::find($spk_produk['spk_id']);
            $spk->jumlah_total = $spk['jumlah_total'] - $spk_produk['jumlah'];
            $spk->harga_total = $spk['harga_total'] - ($spk_produk['jumlah'] * $spk_produk['harga']);
            $spk->save();

            array_push($success_messages, "success_message: Jumlah total dan harga total dari spk dengan id: $spk[id] berhasil diubah");

            $ada_error = false;
            $class_div_pesan_db = 'alert-warning';
        }

        $data = [
            'go_back_number' => -1,
            'pesan_db' => $pesan_db,
            'ada_error' => $ada_error,
            'class_div_pesan_db' => $class_div_pesan_db,
            'success_messages' => $success_messages,
        ];

        return view('layouts.go-back-page', $data);
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

        $label_pelanggan_resellers = PelangganHelper::label_pelanggan_resellers();

        if ($spk['reseller_id'] !== null) {
            $reseller = Pelanggan::find($spk['reseller_id']);
            $reseller_id = $reseller['id'];
            $pelanggan_nama = "$reseller[nama]: $pelanggan[nama]";
        }

        $data = [
            'spk' => $spk,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
            'reseller_id' => $reseller_id,
            'pelanggan_nama' => $pelanggan_nama,
            'label_pelanggan_resellers' => $label_pelanggan_resellers,
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
        $show_dump = true;
        $run_db = true;
        $success_messages = $error_messages = array();
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';
        $ada_error = true;

        if ($load_num->value > 0) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $request->validate([
            'pelanggan_id' => 'required',
            'created_at' => 'required|date_format:Y-m-d\TH:i:s',
        ]);

        $post = $request->post();

        if ($show_dump) {
            dump('$post:', $post);
        }

        $spk = Spk::find($post['spk_id']);
        $pelanggan = Pelanggan::find($spk['pelanggan_id']);
        $reseller = null;
        $reseller_id = null;
        $created_at = $post['created_at'];

        if ($post['reseller_id'] !== null) {
            $reseller = Pelanggan::find($post['reseller_id']);
            $reseller_id = $reseller['id'];
        }

        if ($run_db) {
            $spk->pelanggan_id = $pelanggan['id'];
            $spk->reseller_id = $reseller_id;
            $spk->created_at = $created_at;
            $spk->save();

            $pesan_db = "SUCCESS: Kop SPK dengan ID: $spk[id] berhasil diubah/-update.";
            $class_div_pesan_db = 'alert-success';
            $ada_error = false;
        }


        $data = [
            'success_messages' => $success_messages,
            'error_messages' => $error_messages,
            'pesan_db' => $pesan_db,
            'class_div_pesan_db' => $class_div_pesan_db,
            'ada_error' => $ada_error,
            'go_back_number' => -2,
        ];

        if ($show_dump) {
            dump('$data:', $data);
        }

        return view('layouts.go-back-page', $data);
    }

    public function print_out_spk(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $post = $request->post();

        if ($show_dump) {
            dump('$post:', $post);
        }

        $spk = Spk::find($post['spk_id']);
        $pelanggan = Pelanggan::find($spk['pelanggan_id']);
        $reseller = null;
        $reseller_id = null;
        $pelanggan_nama = $pelanggan['nama'];

        $spk_produks = SpkProduk::where('spk_id', $spk['id'])->get();
        $produks = array();
        foreach ($spk_produks as $spk_produk) {
            $produk = Produk::find($spk_produk['produk_id']);
            array_push($produks, $produk);
        }

        $label_pelanggan_resellers = PelangganHelper::label_pelanggan_resellers();

        if ($spk['reseller_id'] !== null) {
            $reseller = Pelanggan::find($spk['reseller_id']);
            $reseller_id = $reseller['id'];
            $pelanggan_nama = "$reseller[nama]: $pelanggan[nama]";
        }

        $data = [
            'spk' => $spk,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
            'reseller_id' => $reseller_id,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
            'pelanggan_nama' => $pelanggan_nama,
        ];

        if ($show_dump) {
            dump('$data:', $data);
        }
        return view('spk.print-out-spk', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSpkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function show(Spk $spk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function edit(Spk $spk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpkRequest  $request
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpkRequest $request, Spk $spk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spk $spk)
    {
        //
    }
}
