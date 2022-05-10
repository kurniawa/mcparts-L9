<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
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
            $daerah = Daerah::find($pelanggan['daerah_id'])->toArray();
            $reseller = null;
            if ($srjalan['reseller_id'] !== null) {
                $reseller = Pelanggan::find($srjalan['reseller_id'])->toArray();
            }
            $ekspedisi = null;
            if ($srjalan['ekspedisi_id'] !== null) {
                $ekspedisi = Ekspedisi::find($srjalan['ekspedisi_id']);
            }
            $pelanggans[] = $pelanggan;
            $daerahs[] = $daerah;
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
        $data = [
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

    public function sjBaru_pCust()
    {
        SiteSettings::loadNumToZero();
        $show_dump = true;

        $pelanggan_id_sj_blm_kirim = Nota::select('pelanggan_id')->where('status_sj', 'BELUM SJ')->orderByDesc('created_at')->groupBy('pelanggan_id')->get();
        if ($show_dump) {
            dump('pelanggan_id_sj_blm_kirim', $pelanggan_id_sj_blm_kirim);
        }

        $pelanggans = $daerahs = $arr_notas = $resellers = $arr2_spk_produk_notas = $arr2_spk_produks = $arr2_produks = array();
        for ($i0 = 0; $i0 < count($pelanggan_id_sj_blm_kirim); $i0++) {
            $pelanggan = Pelanggan::find($pelanggan_id_sj_blm_kirim[$i0]['pelanggan_id']);
            $daerah = Daerah::find($pelanggan['daerah_id'])->toArray();
            $notas = Nota::where('pelanggan_id', $pelanggan['id'])->where('status_sj', 'BELUM SJ')->orderByDesc('created_at')->get();

            $pelanggans[] = $pelanggan;
            $daerahs[] = $daerah;
            $arr_notas[] = $notas;

            $resellers = $arr_spk_produk_notas = $arr_spk_produks = array();
            for ($i = 0; $i < count($notas); $i++) {
                if ($notas[$i]['reseller_id'] !== null) {
                    $reseller = Pelanggan::find($notas[$i]['reseller_id'])->toArray();
                    $resellers[] = $reseller;
                } else {
                    $reseller[] = null;
                }

                $spk_produk_notas = SpkProdukNota::where('nota_id', $notas[$i]['id'])->get()->toArray();
                $spk_produks = $produks = array();
                foreach ($spk_produk_notas as $spk_produk_nota) {
                    $spk_produk = SpkProduk::find($spk_produk_nota['spk_produk_id'])->toArray();
                    $produk = Produk::find($spk_produk['produk_id'])->toArray();
                    $spk_produks[] = $spk_produk;
                    $produks[] = $produk;
                }

                $arr_spk_produk_notas[] = $spk_produk_notas;
                $arr_spk_produks[] = $spk_produks;
                $arr_produks[] = $produks;
            }
            $arr_resellers[] = $resellers;
            $arr2_spk_produk_notas[] = $arr_spk_produk_notas;
            $arr2_spk_produks[] = $arr_spk_produks;
            $arr2_produks[] = $arr_produks;

        }

        $data = [
            'pelanggans' => $pelanggans,
            'daerahs' => $daerahs,
            'arr_notas' => $arr_notas,
            'arr_resellers' => $arr_resellers,
            'arr2_spk_produk_notas' => $arr2_spk_produk_notas,
            'arr2_spk_produks' => $arr2_spk_produks,
            'arr2_produks' => $arr2_produks,
        ];

        return view('srjalan.sjBaru-pCust', $data);
    }

    public function sjBaru_pPelanggan_pProduk(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('$get', $get);
        }

        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $daerah = Daerah::find($pelanggan['daerah_id']);
        $reseller = null;

        $notas = $arr_spk_produk_notas = $arr_spk_produks = $arr_produks = array();
        $i_nota_id = 0;
        foreach ($get['nota_id'] as $nota_id) {
            $nota = Nota::find($nota_id);
            $notas[] = $nota;

            if ($i_nota_id === 0) {
                if ($nota['reseller_id'] !== null) {
                    $reseller = Pelanggan::find($nota['reseller_id']);
                }
            }
            $spk_produk_notas = $nota->spk_produk_notas;
            $spk_produks = $nota->spk_produks;

            $produks = array();
            foreach ($spk_produks as $spk_produk) {
                $produk = Produk::find($spk_produk['produk_id']);
                $produks[] = $produk;
            }
            // $produks = $nota->produks;

            $arr_spk_produk_notas[] = $spk_produk_notas;
            $arr_spk_produks[] = $spk_produks;
            $arr_produks[] = $produks;

            $i_nota_id++;
        }

        $data = [
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'notas' => $notas,
            'arr_spk_produk_notas' => $arr_spk_produk_notas,
            'arr_spk_produks' => $arr_spk_produks,
            'arr_produks' => $arr_produks,
        ];

        return view('srjalan.sjBaru-pPelanggan-pProduk', $data);

    }

    public function sjBaru_pNota_pProduk_DB(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = true;
        $run_db = true;
        $error_messages = $success_messages = array();
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($load_num->value > 0) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $class_div_pesan_db = 'alert-danger';
        }

        $validate = $request->validate([
            "jml_input" => "array",
            "jml_input.*.*" => "numeric|min:1",
        ]);

        $post = $request->post();

        if ($show_dump === true) {
            dump('post', $post);
        }

        /**
         * CEK / VALIDASI MANUAL JUMLAH INPUT, APAKAH SUDAH SESUAI
         */
        $i_jml_avs = 0;
        $ada_kesalahan_input = false;
        foreach ($post['jml_av'] as $jml_avs) {
            $i_jml_av = 0;
            foreach ($jml_avs as $jml_av) {
                if ($post['jml_input'][$i_jml_avs][$i_jml_av] < 0 || $post['jml_input'][$i_jml_avs][$i_jml_av] > $jml_av) {
                    $ada_kesalahan_input = true;
                    $error_messages[] = "error_: jml_input ke [$i_jml_avs][$i_jml_av] bernilai kurang dari 0 atau lebih dari seharusnya!";
                }
                $i_jml_av++;
            }
            $i_jml_avs++;
        }

        if ($ada_kesalahan_input) { $run_db = false; }

        /** END OF VALIDASI MANUAL */

        if ($run_db) {
            $srjalan = Srjalan::create([
                'created_at' => $post['tgl_pembuatan'],
            ]);
            $success_messages[] = 'success_: $srjalan baru berhasil di create.';
        }

        $pelanggan = $reseller_id = $ekspedisi_id = null;

        $colly_total = 0;
        $i_nota_id = 0;
        foreach ($post['nota_id'] as $nota_id) {
            $nota = Nota::find($nota_id);
            if ($i_nota_id === 0) {
                $pelanggan = Pelanggan::find($nota['pelanggan_id']);
                if ($nota['reseller_id'] !== null) {
                    $reseller = Pelanggan::find($nota['reseller_id']);
                    $reseller_id = $reseller['id'];
                }
                if (count($pelanggan->ekspedisis->toArray()) !== 0) {
                    $ekspedisi_id = $pelanggan->get_ekspedisi_utama_id($pelanggan['id']);
                }
                if ($show_dump) {
                    dump('$pelanggan->ekspedisis->toArray()', $pelanggan->ekspedisis->toArray());
                    dump('$ekspedisi_id', $ekspedisi_id);
                }
            }

            $i_spk_produk_id = 0;
            foreach ($post['spk_produk_id'][$i_nota_id] as $spk_produk_id) {
                $spk_produk = SpkProduk::find($spk_produk_id);
                $spk = Spk::find($spk_produk['spk_id']);
                $produk = Produk::find($spk_produk['produk_id']);
                $spk_produk_nota = SpkProdukNota::find($post['spk_produk_nota_id'][$i_nota_id][$i_spk_produk_id]);
                $nota = Nota::find($spk_produk_nota['nota_id']);
                $jml_input = (int)$post['jml_input'][$i_nota_id][$i_spk_produk_id];

                $colly = null;
                if ($produk['aturan_packing'] !== null) {
                    $colly = $jml_input / $produk['aturan_packing'];
                    $colly_total += $colly;
                }

                if ($run_db) {
                    $spk_produk_nota_srjalan = SpkProdukNotaSrjalan::create([
                        'srjalan_id' => $srjalan['id'],
                        'spk_id' => $spk['id'],
                        'spk_produk_id' => $spk_produk['id'],
                        'produk_id' => $spk_produk['produk_id'],
                        'spk_produk_nota_id' => $spk_produk_nota['id'],
                        'nota_id' => $nota['id'],
                        'jumlah' => $jml_input,
                        'colly' => $colly,
                    ]);

                    $success_messages[] = "success_: create $spk_produk_nota_srjalan baru [$i_nota_id][$i_spk_produk_id]";

                    /**
                     * UPDATE TABLE spk_produk
                     */

                    $status_srjalan = 'SUDAH SEMUA';
                    if ($jml_input < $spk_produk->jml_t) {
                        $status_srjalan = 'SUDAH SEBAGIAN';
                    }
                    $spk_produk->jumlah_sudah_srjalan = $jml_input;
                    $spk_produk->status_srjalan = $status_srjalan;
                    $spk_produk->save();

                    $success_messages[] = "success_: UPDATE table spk_produk: jumlah_sudah_srjalan dan status_srjalan";
                }
                $i_spk_produk_id++;
            }
            $i_nota_id++;
        }

        /**
         * UPDATE table srjalan: pelanggan_id, reseller_id, colly
         */
        if ($run_db) {
            $srjalan->no_srjalan = "SJ-$srjalan[id]";
            $srjalan->pelanggan_id = $pelanggan['id'];
            $srjalan->ekspedisi_id = $ekspedisi_id;
            $srjalan->reseller_id = $reseller_id;
            $srjalan->colly = $colly_total;
            $srjalan->save();

            $pesan_db = 'SUCCESS:';
            $class_div_pesan_db = 'alert-success';
            $success_messages[] = 'success_: UPDATE TABLE srjalan: pelanggan_id, ekspedisi_id, reseller_id, colly.';

            $load_num->value += 1;
            $load_num->save();
        }

        $data = [
            'go_back_number' => -2,
            'error_messages' => $error_messages,
            'success_messages' => $success_messages,
            'pesan_db' => $pesan_db,
            'class_div_pesan_db' => $class_div_pesan_db,
        ];

        dump('ALL PROCESS IS FINISHED!');

        return view('layouts.go-back-page', $data);
    }

    public function sj_detailSJ(Request $request)
    {
        SiteSettings::loadNumToZero();

        $show_dump = true;

        $get = $request->query();

        if ($show_dump) {
            dump('get', $get);
        }

        $srjalan = json_decode($get['srjalan'], true);
        $pelanggan = json_decode($get['pelanggan'], true);
        $daerah = json_decode($get['daerah'], true);
        $reseller = json_decode($get['reseller'], true);
        $ekspedisi = json_decode($get['ekspedisi'], true);
        $spk_produk_nota_srjalans = json_decode($get['spk_produk_nota_srjalans'], true);
        $spk_produk_notas = json_decode($get['spk_produk_notas'], true);
        $spk_produks = json_decode($get['spk_produks'], true);
        $produks = json_decode($get['produks'], true);

        if ($srjalan['reseller_id'] !== null) {
            $reseller = Pelanggan::find($srjalan['reseller_id']);
        }

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
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;
        // Pada development mode, load number boleh diignore. Yang perlu diperhatikan adalah
        // insert dan update database supaya tidak berantakan
        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }

        $post = $request->input();
        $sj = json_decode($post['sj'], true);
        $pelanggan = json_decode($post['pelanggan'], true);
        $reseller = json_decode($post['reseller'], true);
        $ekspedisi = json_decode($post['ekspedisi'], true);


        if ($show_dump === true) {
            dump('post');
            dump($post);
            dump('sj:');
            dump($sj);
            dump('pelanggan:');
            dump($pelanggan);
            dump('reseller:');
            dump($reseller);
            dump('ekspedisi:');
            dump($ekspedisi);
        }

        $data = [
            'sj' => $sj,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
            'ekspedisi' => $ekspedisi,
            'csrf' => csrf_token()
        ];

        return view('sj.sj-printOut', $data);
    }

    public function sj_hapus(Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = true;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }

        $post = $request->input();
        $sj = Srjalan::find($post['sj_id']);

        if ($show_dump === true) {
            dump('post');
            dump($post);
        }

        if ($run_db === true) {
            $sj->delete();
        }

        $data = [
            'go_back_number' => -2,
            'csrf' => csrf_token()
        ];

        $load_num->value += 1;
        $load_num->save();

        dump('DELETE PROSES FINISHED!');

        return view('layouts.go-back-page', $data);
    }
}
