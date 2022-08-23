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
        $show_dump = false;

        $sj = new Srjalan();
        list($pelanggans, $daerahs, $arr_notas, $arr_resellers, $arr2_spk_produk_notas, $arr2_spk_produks, $arr2_produks) = $sj->get_available_notas_for_srjalan();

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

        $show_dump = false;
        $run_db = true;
        $error_logs = $success_logs = array();
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
                    $error_logs[] = "error_: jml_input ke [$i_jml_avs][$i_jml_av] bernilai kurang dari 0 atau lebih dari seharusnya!";
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
            $success_logs[] = 'success_: $srjalan baru berhasil di create.';
        }

        $pelanggan = $reseller_id = $ekspedisi_id = null;

        $colly_total = 0;
        $i_nota_id = 0;
        foreach ($post['nota_id'] as $nota_id) {
            $nota = Nota::find($nota_id);
            $status_sj = 'BELUM SJ';
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

                    $success_logs[] = "success_: create $spk_produk_nota_srjalan baru [$i_nota_id][$i_spk_produk_id]";

                }
                /**
                 * UPDATE TABLE spk_produk
                 */

                if ($jml_input === $spk_produk->jml_t) {
                    $status_srjalan = 'SEMUA';
                    /** INI CARA SMART SAYA UNTUK MENGHINDARI PENGECEKAN ARRAY semua status sj MELALUI LOOPING */
                    if ($status_sj !== 'SEBAGIAN' || $status_sj !== 'SEMUA') {
                        $status_sj = 'SEMUA';
                    }
                } elseif ($jml_input < $spk_produk->jml_t) {
                    $status_srjalan = 'SEBAGIAN';
                    if ($status_sj !== 'SEBAGIAN') {
                        $status_sj = 'SEBAGIAN';
                    }
                }

                if ($run_db) {
                    $spk_produk->jumlah_sudah_srjalan = $jml_input;
                    $spk_produk->status_srjalan = $status_srjalan;
                    $spk_produk->save();

                    $success_logs[] = "success_: UPDATE table spk_produk: jumlah_sudah_srjalan dan status_srjalan";
                }

                // UPDATE spk: status_sj, jumlah_sudah_sj
                $jumlah_sudah_sj = $spk['jumlah_sudah_sj'] + $jml_input;
                if ($jumlah_sudah_sj === 0) {
                    $status_sj_spk = 'BELUM';
                } elseif ($jumlah_sudah_sj === $spk['jumlah_total']) {
                    $status_sj_spk = 'SEMUA';
                } elseif ($jumlah_sudah_sj < $spk['jumlah_total']) {
                    $status_sj_spk = 'SEBAGIAN';
                }

                if ($run_db) {
                    $spk->status_sj = $status_sj_spk;
                    $spk->jumlah_sudah_sj = $jumlah_sudah_sj;
                    $spk->save();

                    $success_logs[] = 'UPDATE spk: status_sj, jumlah_sudah_sj';
                }

                // UPDATE nota: status_sj, jumlah_sj
                $jumlah_sj = $nota['jumlah_sj'] + $jml_input;
                if ($jumlah_sj === 0) {
                    $status_sj_nota = 'BELUM';
                } elseif ($jumlah_sj === $nota['jumlah_total']) {
                    $status_sj_nota = 'SEMUA';
                } elseif ($jumlah_sj < $nota['jumlah_total']) {
                    $status_sj_nota = 'SEBAGIAN';
                }

                if ($run_db) {
                    $nota->status_sj = $status_sj_nota;
                    $nota->jumlah_sj = $jumlah_sj;
                    $nota->save();

                    $success_logs[] = 'UPDATE nota: status_sj, jumlah_sj';
                }
                // END

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
            $success_logs[] = 'success_: UPDATE TABLE srjalan: pelanggan_id, ekspedisi_id, reseller_id, colly.';

            $load_num->value += 1;
            $load_num->save();
        }

        $data = [
            'go_back_number' => -3,
            'error_logs' => $error_logs,
            'success_logs' => $success_logs,
            'pesan_db' => $pesan_db,
            'class_div_pesan_db' => $class_div_pesan_db,
        ];

        dump('ALL PROCESS IS FINISHED!');

        return view('layouts.go-back-page', $data);
    }

    public function sj_detailSJ(Request $request)
    {
        SiteSettings::loadNumToZero();

        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('get', $get);
        }

        $sj = new Srjalan();
        list($srjalan, $pelanggan, $daerah, $reseller, $ekspedisi, $spk_produk_nota_srjalans, $spk_produk_notas, $spk_produks, $produks) = $sj->get_one_srjalan_and_components($get['srjalan_id']);

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
        SiteSettings::loadNumToZero();

        $show_dump = false;
        // Pada development mode, load number boleh diignore. Yang perlu diperhatikan adalah
        // insert dan update database supaya tidak berantakan

        $get = $request->query();

        if ($show_dump === true) {
            dump('get:', $get);
        }

        $sj = new Srjalan();
        list($srjalan, $pelanggan, $daerah, $reseller, $ekspedisi, $spk_produk_nota_srjalans, $spk_produk_notas, $spk_produks, $produks) = $sj->get_one_srjalan_and_components($get['srjalan_id']);

        $alamat_reseller = null;
        if ($reseller !== null) {
            $alamat_reseller = json_decode($reseller['alamat'], true);
        }
        $alamat_ekspedisi = json_decode($ekspedisi['alamat'], true);
        $data = [
            'srjalan' => $srjalan,
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'alamat_reseller' => $alamat_reseller,
            'ekspedisi' => $ekspedisi,
            'alamat_ekspedisi' => $alamat_ekspedisi,
            'spk_produk_nota_srjalans' => $spk_produk_nota_srjalans,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
        ];

        return view('srjalan.sj-printOut', $data);
    }

    public function sj_hapus(Request $request)
    {
        $load_num = SiteSetting::find(1);
        dump($load_num);

        $show_dump = false;
        $run_db = true;

        $error_logs = $success_logs = array();
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($load_num->value > 0) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump === true) {
            dump('post', $post);
        }

        $sj = Srjalan::find($post['srjalan_id']);

        $spk_produk_nota_srjalans = SpkProdukNotaSrjalan::where('srjalan_id', $sj['id'])->get()->toArray();
        // dd($spk_produk_nota_srjalans);
        foreach ($spk_produk_nota_srjalans as $SPKProdukNotaSrjalan) {
            $jumlah_kurang = $SPKProdukNotaSrjalan['jumlah'];
            // UPDATE spk: status_sj, jumlah_sudah_sj
            $spk = Spk::find($SPKProdukNotaSrjalan['spk_id']);
            $jumlah_sudah_sj_spk = $spk['jumlah_sudah_sj'] - $jumlah_kurang;
            if ($jumlah_sudah_sj_spk === 0) {
                $status_sj_spk = 'BELUM';
            } elseif ($jumlah_sudah_sj_spk === $spk['jumlah_total']) {
                $status_sj_spk = 'SEMUA';
            } elseif ($jumlah_sudah_sj_spk < $spk['jumlah_total']) {
                $status_sj_spk = 'SEBAGIAN';
            }

            if ($run_db) {
                $spk->status_sj = $status_sj_spk;
                $spk->jumlah_sudah_sj = $jumlah_sudah_sj_spk;
                $spk->save();

                $success_logs[] = 'UPDATE spk: status_sj, jumlah_sudah_sj';
            }
            // UPDATE spk_produk: jumlah_sudah_srjalan, status_srjalan.
            $spk_produk = SpkProduk::find($SPKProdukNotaSrjalan['spk_produk_id']);
            $jumlahSudahSrjalanSpkProduk = $spk_produk['jumlah_sudah_srjalan'] - $jumlah_kurang;
            if ($jumlahSudahSrjalanSpkProduk === 0) {
                $statusSrjalanSPKProduk = 'BELUM';
            } elseif ($jumlahSudahSrjalanSpkProduk === $spk_produk['jml_t']) {
                $statusSrjalanSPKProduk = 'SEMUA';
            } elseif ($jumlahSudahSrjalanSpkProduk < $spk_produk['jml_t']) {
                $statusSrjalanSPKProduk = 'SEBAGIAN';
            }

            if ($run_db) {
                $spk_produk->jumlah_sudah_srjalan = $jumlahSudahSrjalanSpkProduk;
                $spk_produk->status_srjalan = $statusSrjalanSPKProduk;
                $spk_produk->save();

                $success_logs[] = 'UPDATE spk_produk: jumlah_sudah_srjalan, status_srjalan';
            }

            // UPDATE nota: status_sj, jumlah_sj
            $nota = Nota::find($SPKProdukNotaSrjalan['nota_id']);
            $jumlah_sj = $nota['jumlah_sj'] - $jumlah_kurang;
            $status_sj_nota = $nota['status_sj'];
            if ($jumlah_sj === 0) {
                $status_sj_nota = 'BELUM';
            } elseif ($jumlah_sj === $nota['jumlah_total']) {
                $status_sj_nota = 'SEMUA';
            } elseif ($jumlah_sj < $nota['jumlah_total']) {
                $status_sj_nota = 'SEBAGIAN';
            }

            // dump('$jumlah_sj, $status_sj_nota', $jumlah_sj, $status_sj_nota);

            if ($run_db) {
                $nota->status_sj = $status_sj_nota;
                $nota->jumlah_sj = $jumlah_sj;
                $nota->save();

                $success_logs[] = 'UPDATE nota: status_sj, jumlah_sj';
            }
            // END

            // DELETE spk_produk_nota_srjalan udah otomatis akan ke delete, ketika nanti delete sj.
        }


        if ($run_db === true) {
            $sj->delete();

            $success_logs[] = 'success_: Surat Jalan ini berhasil dihapus!';
            $pesan_db = 'SUCCESS:';
            $class_div_pesan_db = 'alert-success';

            $load_num->value += 1;
            $load_num->save();
        }

        $data = [
            'go_back_number' => -2,
            'pesan_db' => $pesan_db,
            'class_div_pesan_db' => $class_div_pesan_db,
            'error_logs' => $error_logs,
            'success_logs' => $success_logs,
        ];

        if ($show_dump) {
            dump('DELETE PROSES FINISHED!');
        }

        return view('layouts.go-back-page', $data);
    }
}
