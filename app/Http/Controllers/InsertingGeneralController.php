<?php

namespace App\Http\Controllers;

use App\Helpers\InsertingProductHelper;
use App\Helpers\SiteSettings;
use App\Models\Attsjvariasi;
use App\Models\Bahan;
use App\Models\Busastang;
use App\Models\Jahit;
use App\Models\Kombi;
use App\Models\Motif;
use App\Models\Produk;
use App\Models\ProdukHarga;
use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\Standar;
use App\Models\Stiker;
use App\Models\Tankpad;
use App\Models\Tspjap;
use App\Models\Ukuran;
use App\Models\Variasi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InsertingGeneralController extends Controller
{
    public function inserting_general(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('$get:', $get);
        }

        $spk_id = null; // Kalo mode SPK_BARU nilainya nanti null
        if (isset($get['spk_id'])) {
            $spk_id = $get['spk_id'];
        }

        $produk = new Produk();
        $attsjvariasis = Attsjvariasi::all();
        $bahan = new Bahan();
        $varia = new Variasi();
        $ukuran = new Ukuran();
        $jahit = new Jahit();
        $kombi = new Kombi();
        $standar = new Standar();
        $tankpad = new Tankpad();
        $busastang = new Busastang();
        $tspjap = new Tspjap();
        $stiker = new Stiker();
        $motif = new Motif();

        $label_produks = $produk->label_produks();
        $label_bahans = $bahan->label_bahans();
        $varias_harga = $varia->varias_harga();
        $ukurans_harga = $ukuran->ukurans_harga();
        $jahits_harga = $jahit->jahits_harga();
        $label_kombis = $kombi->label_kombis();
        $label_standars = $standar->label_standars();
        $label_tankpads = $tankpad->label_tankpads();
        $label_busastangs = $busastang->label_busastangs();
        $label_tspjaps = $tspjap->label_tspjaps();
        $label_stikers = $stiker->label_stikers();
        $label_tspjap_a = $tspjap->label_tspjaps_a();
        $label_tspjap_b = $tspjap->label_tspjaps_b();
        $d_bahan_a = $bahan->d_bahan_a();
        $d_bahan_b = $bahan->d_bahan_b();
        $motif_harga = $motif->motif_harga();

        $mode = $get['mode'];
        // $tipe = $get['tipe'];

        // if ($mode === 'SPK_BARU') {
        //     if ($tipe === 'varia') {
        //         $judul = 'SPK Baru: Tambah SJ Variasi';
        //     } elseif ($tipe === 'kombinasi') {
        //         $judul = 'SPK BARU: Tambah SJ Kombinasi';
        //     } elseif ($tipe === 'standar') {
        //         $judul = 'SPK BARU: Tambah SJ Standar';
        //     } elseif ($tipe === 'tankpad') {
        //         $judul = 'SPK BARU: Tambah SJ Tankpad';
        //     } elseif ($tipe === 'busastang') {
        //         $judul = 'SPK BARU: Tambah SJ Busastang';
        //     } elseif ($tipe === 'tspjap') {
        //         $judul = 'SPK BARU: Tambah SJ T.Sixpack/Japstyle';
        //     } elseif ($tipe === 'stiker') {
        //         $judul = 'SPK BARU: Tambah SJ Stiker';
        //     } elseif ($tipe === 'motif') {
        //         $judul = 'SPK BARU: Tambah SJ Motif';
        //     }
        // } elseif ($mode === 'ADD PRODUCT FROM DETAIL') {
        //     if ($tipe === 'varia') {
        //         $judul = 'Edit SPK: Tambah SJ Variasi';
        //     } elseif ($tipe === 'kombinasi') {
        //         $judul = 'Edit SPK: Tambah SJ Kombinasi';
        //     } elseif ($tipe === 'standar') {
        //         $judul = 'Edit SPK: Tambah SJ Standar';
        //     } elseif ($tipe === 'tankpad') {
        //         $judul = 'Edit SPK: Tambah SJ Tankpad';
        //     } elseif ($tipe === 'busastang') {
        //         $judul = 'Edit SPK: Tambah SJ Busastang';
        //     } elseif ($tipe === 'tspjap') {
        //         $judul = 'Edit SPK: Tambah SJ T.Sixpack/Japstyle';
        //     } elseif ($tipe === 'stiker') {
        //         $judul = 'Edit SPK: Tambah SJ Stiker';
        //     } elseif ($tipe === 'motif') {
        //         $judul = 'SPK BARU: Tambah SJ Motif';
        //     }
        // }

        $data = [
            'spk_id' => $spk_id,
            'mode' => $mode,
            'produks' => $label_produks,
            'attsjvariasis' => $attsjvariasis,
            // 'tipe' => $tipe,
            // 'judul' => $judul,
            'bahans' => $label_bahans,
            'varias' => $varias_harga,
            'ukurans' => $ukurans_harga,
            'jahits' => $jahits_harga,
            'kombis' => $label_kombis,
            'standars' => $label_standars,
            'tankpads' => $label_tankpads,
            'busastangs' => $label_busastangs,
            'tspjaps' => $label_tspjaps,
            'label_tspjap_a' => $label_tspjap_a,
            'label_tspjap_b' => $label_tspjap_b,
            'stikers' => $label_stikers,
            'd_bahan_a' => $d_bahan_a,
            'd_bahan_b' => $d_bahan_b,
            'motif' => $motif_harga,
        ];

        if ($show_dump) {
            dump('$data:', $data);
        }

        return view('spk.inserting-general', $data);
    }

    public function inserting_general_db (Request $request)
    {
        $load_num = SiteSetting::find(1);

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $show_hidden_dump = false;
        $ada_error = true;
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';
        $error_messages = array();
        $success_messages = array();

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump) {
            dump('$post: ', $post);
        }

        $tipe = $post['tipe'];
        $mode = $post['mode'];
        $jumlah = $post['jumlah'];

        if ($tipe === 'varia') {
            $request->validate([
                'bahan' => 'required',
                'variasi' => 'required',
                'jumlah' => 'numeric|required|min:1',
            ]);
        } elseif ($tipe === 'kombinasi') {
            $request->validate([
                'kombi' => 'required',
                'jumlah' => 'numeric|required|min:1',
            ]);
        } elseif ($tipe === 'standar') {
            $request->validate([
                'standar' => 'required',
                'jumlah' => 'numeric|required|min:1',
            ]);
        } elseif ($tipe === 'tankpad') {
            $request->validate([
                'tankpad' => 'required',
                'jumlah' => 'numeric|required|min:1',
            ]);
        } elseif ($tipe === 'busastang') {
            $request->validate([
                'busastang' => 'required',
                'jumlah' => 'numeric|required|min:1',
            ]);
        } elseif ($tipe === 'tspjap') {
            $request->validate([
                'tipe_bahan' => 'required',
                'bahan_tspjap' => 'required',
                'tspjap' => 'required',
                'jumlah' => 'numeric|required|min:1',
            ]);
        } elseif ($tipe === 'stiker') {
            $request->validate([
                'stiker' => 'required',
                'jumlah' => 'numeric|required|min:1',
            ]);
        }

        $ktrg = null;
        $bahan_id = $variasi_id = $ukuran_id = $jahit_id = null;
        $standar_id = $kombi_id = $busastang_id = $tankpad_id = $tspjap_id = $tipe_bahan = $stiker_id = null;

        if (isset($post['bahan_id'])) {
            $bahan_id = $post['bahan_id'];
        }
        if (isset($post['ukuran_id'])) {
            $ukuran_id = $post['ukuran_id'];
        }
        if (isset($post['jahit_id'])) {
            $jahit_id = $post['jahit_id'];
        }
        if (isset($post['standar_id'])) {
            $standar_id = $post['standar_id'];
        }
        if (isset($post['kombi_id'])) {
            $kombi_id = $post['kombi_id'];
        }
        if (isset($post['busastang_id'])) {
            $busastang_id = $post['busastang_id'];
        }
        if (isset($post['tankpad_id'])) {
            $tankpad_id = $post['tankpad_id'];
        }
        if (isset($post['tspjap_id'])) {
            $tspjap_id = $post['tspjap_id'];
        }
        if (isset($post['stiker_id'])) {
            $stiker_id = $post['stiker_id'];
        }
        if (isset($post['ktrg'])) {
            $ktrg = $post['ktrg'];
        }

        if ($tipe === 'varia') {
            $variasi = json_decode($post['variasi'], true);
            // dd($variasi);
            $variasi_id = $variasi['id'];
            $harga = $post['bahan_harga'] + $variasi['harga'];
            $nama = "$post[bahan] $variasi[nama]";
            $nama_nota = $nama;

            if (isset($post['ukuran'])) {
                $ukuran = json_decode($post['ukuran'], true);
                $harga += $ukuran['harga'];
                $nama .= " uk.$ukuran[nama]";
                $nama_nota .= " uk.$ukuran[nama_nota]";
                $ukuran_id = $ukuran['id'];
            }
            if (isset($post['jahit'])) {
                $jahit = json_decode($post['jahit'], true);
                $harga += $jahit['harga'];
                $nama .= " + jht.$jahit[nama]";
                $nama_nota .= " + jht.$jahit[nama]";
                $jahit_id = $jahit['id'];
            }
        } elseif ($tipe === 'kombinasi') {
            $nama = $post['kombi'];
            $nama_nota = $nama;
            $harga = $post['kombi_harga'];
        } elseif ($tipe === 'standar') {
            $nama = "Standar $post[standar]";
            $nama_nota = $nama;
            $harga = $post['standar_harga'];
        } elseif ($tipe === 'tspjap') {
            $nama = $post['tspjap'];
            $harga = $post['tspjap_harga'];
            $tipe_bahan = $post['tipe_bahan'];
            $bahan = $post['bahan'];
            if ($bahan !== null) {
                $nama = "$bahan $nama";
            } else {
                $nama = "Bahan($tipe_bahan) $nama";
            }
            $nama_nota = $nama;
        } elseif ($tipe === 'tankpad') {
            $nama = "TP $post[tankpad]";
            $nama_nota = $nama;
            $harga = $post['tankpad_harga'];
        } elseif ($tipe === 'busastang') {
            $nama = $post['busastang'];
            $nama_nota = $nama;
            $harga = $post['busastang_harga'];
        } elseif ($tipe === 'stiker') {
            $nama = $post['stiker'];
            $nama_nota = $nama;
            $harga = $post['stiker_harga'];
        }

        // MELENGKAPI NAMA NOTA SEKALI LAGI
        if ($tipe === 'varia' || $tipe === 'kombinasi' || $tipe === 'standar' || $tipe === 'tspjap') {
            $nama_nota = "SJ $nama_nota";
        }

        if ($show_dump) {
            dump('$tipe', $tipe);
            // dump('$variasi', $variasi);
            dump('$harga', $harga);
            dump('$nama_nota', $nama_nota);
            dump('$ktrg', $ktrg);
            dump('$nama', $nama);
        }

        if ($mode === 'SPK_BARU') {
            list($pesan_db, $ada_error, $class_div_pesan_db, $success_messages) = InsertingProductHelper::InsertingToTempSpkProduks($show_dump, $run_db, $pesan_db, $ada_error, $class_div_pesan_db, $success_messages, $tipe, $bahan_id, $variasi_id, $ukuran_id, $jahit_id, $kombi_id, $standar_id, $tankpad_id, $busastang_id, $tspjap_id, $tipe_bahan, $stiker_id, $nama, $nama_nota, $jumlah, $harga, $ktrg);
        } elseif ($mode === 'ADD PRODUCT FROM DETAIL') {
            $spk = Spk::find($post['spk_id']);
            $jumlah_total = $spk['jumlah_total'] + $jumlah;
            $harga_total = $spk['harga_total'] + $harga;
            list($pesan_db, $ada_error, $class_div_pesan_db, $success_messages) = InsertingProductHelper::InsertingFromDetail($show_dump, $run_db, $load_num, $mode, $tipe, $bahan_id, $variasi_id, $ukuran_id, $jahit_id, $kombi_id, $standar_id, $tankpad_id, $busastang_id, $tspjap_id, $tipe_bahan, $stiker_id, $nama, $nama_nota, $jumlah, $harga, $ktrg, $spk, $jumlah_total, $harga_total, $success_messages);
        }


        $data = [
            'go_back_number' => -2,
            'pesan_db' => $pesan_db,
            'ada_error' => $ada_error,
            'class_div_pesan_db' => $class_div_pesan_db,
            'error_messages' => $error_messages,
            'success_messages' => $success_messages,
        ];

        return view('layouts.go-back-page', $data);
    }
}
