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
use App\Models\SpkProdukSelesai;
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
        $arr_finished_at_last = array();
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

            $spk_produk_selesai = new SpkProdukSelesai();
            $finished_at_last = $spk_produk_selesai->get_finished_at_last($spk['id']);
            array_push($arr_finished_at_last, $finished_at_last);
        }

        $data = [
            'spks' => $spks,
            'pelanggans' => $pelanggans,
            'daerahs' => $daerahs,
            'resellers' => $resellers,
            'arr_produks' => $arr_produks,
            'arr_spk_produks' => $arr_spk_produks,
            'arr_finished_at_last' => $arr_finished_at_last,
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

    public function hapus_spk(Request $request)
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

        $post = $request->post();

        if ($show_dump) {
            dump('$post:', $post);
        }

        $spk = Spk::find($post['spk_id']);

        if ($run_db) {
            $spk->delete();

            $pesan_db = "SUCCESS: SPK dengan ID: $spk[id] berhasil dihapus!";
            $class_div_pesan_db = 'alert-warning';
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

    public function tetapkan_item_selesai(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('$get:', $get);
        }

        $spk = Spk::find($get['spk_id']);
        $pelanggan = Pelanggan::find($spk['pelanggan_id']);
        $daerah = Daerah::find($pelanggan['daerah_id']);
        $reseller = null;

        if ($spk['reseller_id'] !== null) {
            $reseller = Pelanggan::find($spk['reseller_id']);
        }

        $spk_produks = $spk->spk_produks;
        $produks = $spk->produks;

        if ($show_dump) {
            dump('$spk:', $spk);
            dump('$pelanggan:', $pelanggan);
            dump('$daerah:', $daerah);
            dump('$reseller:', $reseller);
            dump('$spk_produks:', $spk_produks);
            dump('$produks:', $produks);
        }


        $data = [
            'spk' => $spk,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
            'daerah' => $daerah,
        ];

        if ($show_dump) {
            dump('$data:', $data);
        }

        return view('spk.tetapkan-item-selesai', $data);
    }

    public function tetapkan_item_selesai_db(Request $request)
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

        $post = $request->post();

        if ($show_dump) {
            dump('$post:', $post);
        }

        $spk = Spk::find($post['spk_id']);
        // $str_data_spk_item_old = $spk['data_spk_item'];

        // $data_spk_item_old = json_decode($str_data_spk_item_old, true);
        // $data_spk_item_new = $data_spk_item_old;

        $d_spk_produk_id = $post['spk_produk_id'];

        /**
         * Jumlah total mengacu pada jumlah item seharusnya baik yang selesai atau yang belum.
         */
        $jumlah_total_old = (int)$spk['jumlah_total'];
        $harga_total_old = (int)$spk['harga_total'];
        $jumlah_total_new = $jumlah_total_old;
        $harga_total_new = $harga_total_old;

        if ($show_dump === true) {
            dump('$spk:', $spk);
            dump('$d_spk_produk_id:', $d_spk_produk_id);
        }

        for ($i = 0; $i < count($d_spk_produk_id); $i++) {
            $spk_produk_ini = SpkProduk::find($d_spk_produk_id[$i]);
            if ($show_dump) {
                dump('$spk_produk_ini:', $spk_produk_ini);
            }
            $deviasi_jml = (int)$post['deviasi_jml'][$i];
            $tbh_jml_selesai = (int)$post['tbh_jml_selesai'][$i];
            // $jumlah_akhir adalah jumlah masing-masing item setelah adanya deviasi jumlah
            $jumlah_akhir = $spk_produk_ini['jumlah'] + $spk_produk_ini['deviasi_jml'];
            dump("jumlah_akhir=$jumlah_akhir");
            $harga_item = $spk_produk_ini['harga'];

            $finished_at = date('Y-m-d', strtotime($post['tgl_selesai'][$i]));

            // status sebelumnya
            $status = $spk_produk_ini['status'];
            $jml_selesai_old = $spk_produk_ini['jml_selesai'];
            $jml_selesai_new = $jml_selesai_old + $tbh_jml_selesai;

            if ($show_dump) {
                dump('$jml_selesai_old:', $jml_selesai_old);
                dump('$tbh_jml_selesai:', $tbh_jml_selesai);
                dump('$jml_selesai_new:', $jml_selesai_new);
            }

            if ($spk_produk_ini['deviasi_jml'] !== $deviasi_jml) {
                $deviasi_jml_old = $spk_produk_ini['deviasi_jml'];
                if ($deviasi_jml_old === null) {
                    $deviasi_jml_old = 0;
                }
                dump('$diff_deviasi_jml = $deviasi_jml_old - $deviasi_jml');
                $diff_deviasi_jml = $deviasi_jml_old - $deviasi_jml;
                dump("$diff_deviasi_jml = $deviasi_jml_old - $deviasi_jml");
                /**
                 * misal deviasi_jml sebelumnya lebi besar daripada deviasi jmlh yang saat ini diinput:
                 * 10 - 5 = 5
                 * -2 - (-8) = 6
                 * jumlah akhir yang tadinya 110 misal, menjadi:
                 * 110 - 5 = 105
                 * 98 - 6 = 92
                 */
                $jumlah_akhir -= $diff_deviasi_jml;
                $jumlah_total_new -= $diff_deviasi_jml;
                $harga_total_new -= $diff_deviasi_jml * $harga_item;
            }

            if ($jml_selesai_new === $jumlah_akhir) {
                $status = 'SELESAI';
            } elseif ($jml_selesai_new !== 0) {
                $status = 'SEBAGIAN';
            } elseif ($jml_selesai_new === 0) {
                $status = 'BELUM';
            } else {
                $run_db = false;
                array_push($error_messages, 'error_message: Jumlah selesai bisa jadi kurang dari 0 atau melebihi jumlah akhir. Tidak ada yang diproses ke Database.');
            }

            if ($run_db) {
                $spk_produk_ini->deviasi_jml = $deviasi_jml;
                $spk_produk_ini->jml_t = $jumlah_akhir;
                $spk_produk_ini->jml_selesai = $jml_selesai_new;
                $spk_produk_ini->jml_blm_sls = $jumlah_akhir - $jml_selesai_new;
                $spk_produk_ini->status = $status;
                $spk_produk_ini->save();


                if ($jml_selesai_old !== $jml_selesai_new) {
                    if ($jml_selesai_new > $jml_selesai_old) {

                        $spk_produk_selesai = new SpkProdukSelesai();
                        $tahapan_selesai_last = $spk_produk_selesai->get_tahapan_last($spk_produk_ini['id']);
                        $tahapan_selesai_next = $tahapan_selesai_last+1;

                        if ($show_dump) {
                            dump('$tahapan_selesai_next:', $tahapan_selesai_next);
                        }

                        SpkProdukSelesai::create([
                            'spk_id' => $spk['id'],
                            'spk_produk_id' => $spk_produk_ini['id'],
                            'jumlah' => $tbh_jml_selesai,
                            'finished_at' => $finished_at,
                            'tahapan_selesai' => $tahapan_selesai_next,
                        ]);

                        $load_num->value += 1;
                        $load_num->save();

                        array_push($success_messages, 'success_: Ditemukan adanya penambahan jumlah selesai dari item terkait. Relasi dengan table spk_produk_selesais berhasil dibuat.');
                    } else {
                        // Kalau $jml_selesai_new, kurang dari $jml_selesai_old, berarti ini masuk ke kasus pengurangan.
                        $spk_produk_selesai = SpkProdukSelesai::where('spk_produk_id', $spk_produk_ini['id'])->get();

                        if ($show_dump) {
                            dump('$spk_produk_selesai:', $spk_produk_selesai);
                            dump('count($spk_produk_selesai):', count($spk_produk_selesai));
                        }

                        $pengurangan_jumlah = $tbh_jml_selesai * -1;
                        for ($j=count($spk_produk_selesai)-1; $j >= 0; $j--) {
                            $spk_produk_selesai_ini = SpkProdukSelesai::find($spk_produk_selesai[$j]['id']);
                            if ($spk_produk_selesai[$j]['jumlah'] > $pengurangan_jumlah){
                                $spk_produk_selesai_ini->jumlah = $spk_produk_selesai[$j]['jumlah'] - $pengurangan_jumlah;
                                $spk_produk_selesai_ini->finished_at = $finished_at;
                                $spk_produk_selesai_ini->save();
                                break;
                            } elseif ($spk_produk_selesai[$j]['jumlah'] === $pengurangan_jumlah) {
                                $spk_produk_selesai_ini->delete();
                                break;
                            } else {
                                // kalau di spk_produk_selesai di tahapan yang ini, pengurangan jumlah masih lebih besar daripada jumlah spk_produk_selesai
                                $pengurangan_jumlah -= $spk_produk_selesai_ini['jumlah'];
                                $spk_produk_selesai_ini->delete();
                            }

                        }

                        $load_num->value += 1;
                        $load_num->save();

                        array_push($success_messages, 'success_: Ditemukan adanya PENGURANGAN jumlah selesai dari item terkait. Relasi dengan table_spk_produk berhasil di update.');
                    }

                }

            }
        }

        // UPDATE STATUS SPK
        $spk_produks = SpkProduk::where('spk_id', $spk['id'])->get();
        $jumlah_status_selesai = 0;

        for ($i=0; $i < count($spk_produks); $i++) {
            if ($spk_produks[$i]['status'] === 'SELESAI') {
                $jumlah_status_selesai++;
            }
        }

        $status_spk = 'PROSES';
        if ($jumlah_status_selesai === count($spk_produks)) {
            $status_spk = 'SELESAI';
        } elseif ($jumlah_status_selesai > 0) {
            $status_spk = 'SEBAGIAN';
        }

        if ($run_db) {
            $spk->status = $status_spk;
            $spk->jumlah_total = $jumlah_total_new;
            $spk->harga_total = $harga_total_new;
            $spk->save();

            $load_num->value += 1;
            $load_num->save();

            $pesan_db = 'SUCCESS:';
            $class_div_pesan_db = 'alert-success';
            array_push($success_messages, 'success_: Jumlah Total dan Harga Total SPK berhasil diupdate!');
        }


        $data = [
            'success_messages' => $success_messages,
            'error_messages' => $error_messages,
            'pesan_db' => $pesan_db,
            'class_div_pesan_db' => $class_div_pesan_db,
            'ada_error' => $ada_error,
            'go_back_number' => -2,
        ];

        return view('layouts.go-back-page', $data);

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
