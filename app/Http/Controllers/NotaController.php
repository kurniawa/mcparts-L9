<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Daerah;
use App\Models\Nota;
use App\Models\Pelanggan;
use App\Models\Produk;
use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\SpkNota;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotaController extends Controller
{
    //
    public function index(Request $request)
    {

        // Metode untuk reset value pada pencegahan reload pada insert dan update DB
        SiteSettings::loadNumToZero();
        // END: metode untuk reset value: pencegahan reload pada halaman insert dan update DB
        // dump($reload_page);

        // else {
        //     $reload_page = false;
        // }


        $notas = Nota::limit(100)->orderByDesc('created_at')->get();
        $pelanggans = $resellers = $daerahs = $arr_spk_produk_notas = $arr_spk_produks = $arr_produks = array();
        for ($i = 0; $i < count($notas); $i++) {
            $pelanggan = Nota::find($notas[$i]->id)->pelanggan->toArray();
            $daerah = Daerah::find($pelanggan['daerah_id'])->toArray();
            array_push($pelanggans, $pelanggan);
            $daerahs[] = $daerah;

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
        // $pelanggan = Pelanggan::find(3)->spk;
        // dd($pelanggans);
        $data = [
            'notas' => $notas,
            'pelanggans' => $pelanggans,
            'daerahs' => $daerahs,
            'resellers' => $resellers,
            'arr_spk_produk_notas' => $arr_spk_produk_notas,
            'arr_spk_produks' => $arr_spk_produks,
            'arr_produks' => $arr_produks,
        ];
        // $data = ['notas' => $notas, 'pelanggans' => $pelanggans];
        return view('nota.notas', $data);
    }

    public function notaBaru_pilihSPK(Request $request)
    {
        SiteSettings::loadNumToZero();

        $show_dump = true;

        /**
         * Form pilihan spk yang ingin dibuatkan nota nya akan muncul. Daftar spk yang ada di pilihan adalah SPK dengan status "SELESAI"
         * atau "SEBAGIAN"
         */
        $spk = new Spk();
        list($pelanggans, $daerahs, $arr_resellers, $available_spks, $list_arr_spk_produks, $list_arr_produks) = $spk->get_available_spks_dan_pelanggan_terkait();

        if ($show_dump) {
            dump('$pelanggans', $pelanggans);
            dump('$daerahs', $daerahs);
            dump('$available_spks', $available_spks);
            dump('$arr_resellers', $arr_resellers);
            dump('$list_arr_spk_produks', $list_arr_spk_produks);
            dump('$list_arr_produks', $list_arr_produks);
        }

        // $pelanggan_spks = array();

        // foreach ($available_spks as $av_spk) {
        //     $pelanggan = Pelanggan::find($av_spk['pelanggan_id']);
        //     $reseller = null;
        //     if ($pelanggan['reseller_id'] !== null) {
        //         $reseller = Pelanggan::find($pelanggan['reseller_id']);
        //     }

        //     $spks = Spk::where('pelanggan_id', $pelanggan['id'])->get();

        //     $pelanggan_spk = [
        //         'pelanggan' => $pelanggan,
        //         'reseller' => $reseller,
        //         'spks' => $spks,
        //     ];

        //     array_push($pelanggan_spks, $pelanggan_spk);
        // }

        $data = [
            'csrf' => csrf_token(),
            'pelanggans' => $pelanggans,
            'daerahs' => $daerahs,
            'arr_resellers' => $arr_resellers,
            'available_spks' => $available_spks,
            'list_arr_spk_produks' => $list_arr_spk_produks,
            'list_arr_produks' => $list_arr_produks,
        ];
        return view('nota.nota_baru-pilih_spk', $data);
    }

    public function notaBaru_pSPK_pItem(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = true;

        // $reload_page = $request->session()->get('reload_page');
        // if ($reload_page === true) {
        //     $request->session()->put('reload_page', false);
        // }
        /**
         * Setelah pilih SPK, maka sudah semestinya langsung ke pilih Item. Karena ini konsepnya kita akan membuat Nota Baru.
         * Ada beberapa kasus yang perlu diperhatikan disini:
         * 1) SPK yang belum sepenuhnya selesai semua tapi sebagian yang sudah kelar ingin dibuatkan nota dan surat jalan terlebih dahulu
         * * Ini artinya dalam satu SPK bisa 'memiliki' lebih dari satu nota.
         *
         * * Lalu misal salah satu item di SPK berjumlah 300, maka ini juga bisa di split, misal yang ingin dibuatkan nota terlebih dahulu
         * * Hanya yang 150 nya saja.
         *
         * Sebelum melakukan itu semua, kita perlu mencari spk dari spk_id yang di post, supaya dapat get pelanggan_id dan get pelanggan
         *
         * Lalu kita perlu juga untuk get spk_item dari table spk_produks. Supaya nanti bisa di tampilkan daftar pilihan item yang dapat dibuat nota.
         * Daftar Item yang dapat dibuat nota tentunya adalah item yang telah selesai proses produksi dan juga item tersebut belum di input
         * ke dalam nota yang lain. Oleh karena itu kita perlu untuk edit table spk_produks yang sekarang, harus ditambahkan column nota_jumlah.
         * Dengan data Type Varchar(255) dan value nya nanti adalah string json.
         * Untuk memudahkan lagi, kita coba untuk menambahkan column sudah_nota dengan value yang juga sebagai string dengan contoh value nya misalnya
         * 'SEBAGIAN' atau 'SEMUA' atau 'BELUM. Kalo sebagian brrti sudah dimasukkan ke dalam nota sebagian, kalo semua brrti sudah semua nya diinput ke nota
         * kalo belum berrti belum diinput ke nota sama sekali.
         *
         * SPK sudah dipilih dan di send via post. spk_id diketahui, otomatis spk_item yang berkaitan dengan spk_id juga dapat diketahui.
         *
         */

        $get = $request->query();

        if ($show_dump) {
            dump('get', $get);
        }

        $spks = array();
        $arr_av_nota_items = array();
        $arr_produks = array();

        $reseller = null;

        for ($i_spkID = 0; $i_spkID < count($get['spk_id']); $i_spkID++) {
            $spk = Spk::find($get['spk_id'][$i_spkID]);

            if ($i_spkID === 0 && $spk['reseller_id'] !== null) {
                $reseller = Pelanggan::find($spk['reseller_id'])->toArray();
            }

            $av_nota_items = SpkProduk::where('spk_id', $spk['id'])
                ->where(function ($query) {
                    $query->where('status_nota', 'BELUM')
                        ->orWhere('status_nota', 'SEBAGIAN');
                })
                ->get();

            $produks = array();
            foreach ($av_nota_items as $av_nota_item) {
                $produk = Produk::find($av_nota_item['produk_id']);
                array_push($produks, $produk);
            }

            array_push($spks, $spk);
            array_push($arr_av_nota_items, $av_nota_items);
            array_push($arr_produks, $produks);
        }

        // $spk_id = $get['spk_id'];
        // $spk_this = Spk::find($spk_id);
        $pelanggan = Pelanggan::find($spks[0]['pelanggan_id']);
        $daerah = Daerah::find($pelanggan['daerah_id']);

        /**
         * nota_item_available Tadinya di ambil langsung dari table SpkProduk. Namun karena di table spk terdapat data yang sama
         * dan juga lebih lengkap karena disertai juga dengan nama nya, maka kita consider jg untuk ambil data dari table spk
         */


        // FILTER BERIKUTNYA ADALAH APAKAH ADA JUMLAH YANG SUDAH NOTA?

        // for ($i0=0; $i0 < count($nota_item_av); $i0++) {
        //     if ($nota_item_av[$i0]['jml_sdh_nota'] !== 0) {
        //         if ($nota_item_av[$i0]['jml_sdh_nota'] < $nota_item_av[$i0]['jml_selesai']) {
        //             # code...
        //         } else {
        //             unset($nota_item_av[$i0]);
        //             $nota_item_av = json_encode(array_values($nota_item_av));
        //         }
        //     }
        // }

        if ($show_dump === true) {
            dump('arr_av_nota_items');
            dump($arr_av_nota_items);
            // dd($arr_av_nota_items);
            dump('arr_produks: ', $arr_produks);
        }



        // $spk_nota_this = SpkNotas::where('spk_id', $spk_id)->get();
        // dump('spk_nota dengan spk_id ini');
        // dump($spk_nota_this);

        // $available_nota = [];
        // for ($i = 0; $i < count($spk_nota_this); $i++) {
        //     $available_nota_temp = Nota::find($spk_nota_this[$i]['nota_id']);
        //     array_push($available_nota, $available_nota_temp);
        // }
        // dump('available_nota');
        // dump($available_nota);

        $data = [
            'csrf' => csrf_token(),
            'spks' => $spks,
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'arr_av_nota_items' => $arr_av_nota_items,
            'arr_produks' => $arr_produks,
            'tgl_nota' => date('Y-m-d\TH:i:s'),
        ];
        return view('nota.notaBaru-pSPK-pItem', $data);
    }

    public function notaBaru_pSPK_pItem_DB(Request $request)
    {
        // Tindakan pencegahan salah kepencet reload
        $load_num = SiteSetting::find(1);

        $show_dump = true;
        $run_db = true;
        $success_messages = $error_messages = array();
        $pesan_db = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($load_num->value > 0) {
            $run_db = false;
            $pesan_db = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();
        if ($show_dump === true) {
            dump('post', $post);
        }
        /**
         * Mulai insert ke table notas, maka kita perlu mengetahui pelanggan_id, reseller_id terlebih dahulu.
         * Ini diketahui dari SPK
         *
         * data_nota_item: produk_id, nama_nota, jml_item, hrg_per_item, hrg_total_item
         */

        $nota_id = '?';
        $nota = '?';
        /**PENCEGAHAN apabila jumlah yang diinput ternyata 0 atau kurang dari 0, maka tidak dapat diproses ke nota
         * JUGA APABILA jml_input <= jml_av
         */
        // $data_nota_items = array();
        $d_spk_produk_ids = array();
        $d_jml_inputs = array();
        $d_spk_produk_nota_ids = array();
        // $d_jml_av = array();

        $hrg_total_nota = 0;
        $d_idx_nota_jml_kpn = array(); // Untuk nanti setelah insert nota, bisa balik lagi ke spk_produk untuk edit nota_id
        $d_nota_jml_kapan = array();

        $jumlah_looping_yang_diproses = 0;
        for ($i_spkID = 0; $i_spkID < count($post['spk_id']); $i_spkID++) {
            if ($i_spkID === 0) {
                # Belum ada proses insert DB, maka $nota_id belum diketahui
            } else {
                $nota = Nota::find($nota_id);
            }
            $spk = Spk::find($post['spk_id'][$i_spkID]);

            $spk_produk_ids = array();
            $jml_inputs = array();
            for ($i0 = 0; $i0 < count($post['spk_produk_id'][$i_spkID]); $i0++) {
                if ((int)$post['jml_input'][$i_spkID][$i0] > 0 && (int)$post['jml_input'][$i_spkID][$i0] <= (int)$post['jml_av'][$i_spkID][$i0]) {
                    array_push($spk_produk_ids, $post['spk_produk_id'][$i_spkID][$i0]);
                    array_push($jml_inputs, (int)$post['jml_input'][$i_spkID][$i0]);
                    // array_push($d_jml_av, (int)$post['jml_av'][$i0]);
                    $jumlah_looping_yang_diproses++;
                }
            } // END loop $i0

            if ($show_dump === true) {
                dump("spk_produk_ids setelah looping pertama");
                dump($spk_produk_ids);
            }

            $spk_produk_nota_ids = array();
            $nota_jml_kapan = array();
            $jml_item = array();
            for ($i = 0; $i < count($spk_produk_ids); $i++) {
                $spk_produk = SpkProduk::find($spk_produk_ids[$i]);
                // $spkcpnota = SpkcpNota::where('spkcp_id', $spk_produk['id']);
                dump('spk_produk: ', $spk_produk);
                $produk = Produk::find($spk_produk['produk_id']);

                $hrg_per_item = $spk_produk['harga'];

                if ($spk_produk['koreksi_harga'] !== null && $spk_produk['koreksi_harga'] !== '') {
                    $hrg_per_item += $spk_produk['koreksi_harga'];
                }

                $hrg_total_item = (int)$hrg_per_item * (int)$jml_inputs[$i];
                $hrg_total_nota += $hrg_total_item;

                // MULAI INSERT KE nota_produks
                // Disini aku sementara mau abaikan dulu table nota_produks, karena sudah ada json nya di table notas
                // notas, nota_produks, spk_notas

                // DB::table('nota_produks')->insert([
                //     'spk_id' => $spk['id'],
                //     'produk_id' => $produk['id'],
                //     'jumlah' => $jml_inputs[$i],
                //     'harga' => $hrg_per_item,
                //     'koreksi_harga' => $spk_produk['koreksi_harga'],
                // ]);

                // UPDATE spk_produks kolom nota_jml_kapan dan status_nota

                $jml_sdh_nota = $spk_produk['jml_sdh_nota']; // Secara defaulut value=0 sudah diatur pada pembuatan database nya
                // Concern Untuk KOLOM status_nota pada spk_produk

                // if ($spk_produk['nota_jml_kapan'] !== null && $spk_produk['nota_jml_kapan'] !== '') {
                //     $nota_jml_kapan = json_decode($spk_produk['nota_jml_kapan'], true);

                //     // Concern untuk kolom status_nota pada spk_produk, maka kita perlu mengetahui jumlah item yang sudah nota
                //     // supaya bisa dibandingkan dengan jumlah_item yang sebenarnya
                //     for ($i2 = 0; $i2 < count($nota_jml_kapan); $i2++) {
                //         $jml_sdh_nota += $nota_jml_kapan[$i2]['jml_item'];
                //     }
                // }

                $jml_sdh_nota += $jml_inputs[$i];
                $jml_total_item_ini = $spk_produk['jumlah'] + $spk_produk['deviasi_jml'];

                $status_nota = 'BELUM';
                if ($jml_sdh_nota === $jml_total_item_ini) {
                    $status_nota = 'SEMUA';
                } else if ($jml_sdh_nota > 0) {
                    $status_nota = 'SEBAGIAN';
                }

                array_push($jml_item, $jml_inputs[$i]);

                $spk_produk->jml_sdh_nota = $jml_sdh_nota;
                $spk_produk->status_nota = $status_nota;


                /**
                 * SPK PRODUK NOTA INSERT DB
                 */
                if ($run_db) {
                    $spk_produk->save();
                    $spk_produk_nota_id = SpkProdukNota::insertGetId([
                        'spk_produk_id' => $spk_produk['id'],
                        'jumlah' => $jml_inputs[$i],
                        'harga' => $hrg_per_item,
                        'harga_t' => $hrg_total_item,
                        'created_at' => $post['tgl_pembuatan']
                    ]);

                    array_push($success_messages, 'success_: insert ke spk_produk_nota, belum insert ke nota, nota_id belum diketahui.');
                }

                // $nota_item = [
                //     'spk_produk_nota_id' => $spk_produk_nota_id,
                //     'produk_id' => $produk['id'],
                //     'nama_nota' => $produk['nama_nota'],
                //     'jml_item' => $jml_inputs[$i],
                //     'hrg_per_item' => $hrg_per_item,
                //     'hrg_total_item' => $hrg_total_item,
                // ];

                // array_push($data_nota_items, $nota_item);

                array_push($spk_produk_nota_ids, $spk_produk_nota_id);
                // to recomment
                // array_push($d_spk_produk_nota_ids, $i);
            } // END LOOP $i -> count($spk_produk_ids)

            array_push($d_spk_produk_ids, $spk_produk_ids);
            array_push($d_jml_inputs, $jml_inputs);
            array_push($d_spk_produk_nota_ids, $spk_produk_nota_ids);

            if ($show_dump === true) {
                dump('$spk_produk_ids');
                dump($spk_produk_ids);
            }

            // CEK SEMUA YANG PERLU DIINSERT

            // PENCEGAHAN APABILA SEMUA JUMLAH YANG DIINPUT TIDAK SESUAI (=== 0 atau < 0)
            // MAKA TIDAK PERLU ADA YANG DIINPUT KE DB
            // $nota_jml_kapans = array();
            // $idx_nota_jml_kpn = array();
            for ($i_SPKProdukID=0; $i_SPKProdukID < count($spk_produk_ids); $i_SPKProdukID++) {
                if (count($spk_produk_ids) === 0) {
                    dump('TIDAK ADA YANG DI PROSES KE DATABASE, KARENA JUMLAH TIDAK SESUAI!');
                    array_push($error_messages, 'error_: TIDAK ADA YANG DI PROSES KE DATABASE, KARENA JUMLAH TIDAK SESUAI!');
                } else {

                    dump('INSERT TABLE nota');
                    dump([
                        'pelanggan_id' => $spk['pelanggan_id'],
                        'reseller_id' => $spk['reseller_id'],
                        'status' => 'PROSES',
                    ]);

                    dump('INSERT TABLE spk_notas', [
                        'spk_id' => $spk['id'],
                        'nota_id' => 'Dari insertGetId sebelumnya dulu',
                    ]);

                    /**
                     * INSERT KE NOTA HANYA PADA SAAT LOOPING PERTAMA, SUPAYA BISA TAHU $nota_id
                    */

                    if ($run_db) {
                        if ($i_spkID === 0 && $i_SPKProdukID === 0) {
                            $nota_id = DB::table('notas')->insertGetId([
                                'pelanggan_id' => $spk['pelanggan_id'],
                                'reseller_id' => $spk['reseller_id'],
                            ]);

                            if ($show_dump) {
                                dump("i_spkID = $i_spkID");
                                dump("nota saved, nota_id = $nota_id");
                            }

                            array_push($success_messages, 'success_: insert pertama ke table nota, sekaligus menetapkan nota_id');

                        }

                        DB::table('spk_notas')->insert([
                            'spk_id' => $spk['id'],
                            'nota_id' => $nota_id,
                        ]);

                        array_push($success_messages, 'success_: create relasi spk_notas');

                    }


                    // $nota_jml_kapan = [
                    //     'nota_id' => $nota_id,
                    //     'jml_item' => $jml_item[$i_SPKProdukID],
                    //     'tgl_input' => date('Y-m-d\TH:i:s'),
                    // ];

                    // array_push($nota_jml_kapans, $nota_jml_kapan);
                    // array_push($idx_nota_jml_kpn, count($nota_jml_kapans) - 1);

                    // UPDATE spk_produk dan spkcpnota

                    // to recomment
                    // DB::table('spkcp_notas')->insert([
                    //     'spkcp_id' => 1,
                    //     'jml' => 150
                    // ]);

                }

            }
            // array_push($d_nota_jml_kapan, $nota_jml_kapans);
            // array_push($d_idx_nota_jml_kpn, $idx_nota_jml_kpn);

        } // END FOR $i_spkID

        if ($jumlah_looping_yang_diproses === 0) {
            $run_db = false;
        }



        /**
         * UPDATE nota_id PADA TABLE spk_produk_nota
         */

        if ($show_dump) {
            dump('d_spk_produk_ids:', $d_spk_produk_ids);
            dump('count($d_spk_produk_ids):', count($d_spk_produk_ids));
            dump('$d_jml_inputs:', $d_jml_inputs);
            // dump('d_nota_jml_kapan: ', $d_nota_jml_kapan);
            // dump('d_idx_nota_jml_kpn: ', $d_idx_nota_jml_kpn);
        }

        foreach ($d_spk_produk_nota_ids as $spk_produk_nota_ids) {
            foreach ($spk_produk_nota_ids as $spk_produk_nota_id) {
                $spk_produk_nota = SpkProdukNota::find($spk_produk_nota_id);
                $spk_produk_nota->nota_id = $nota_id;
                if ($run_db) {
                    $spk_produk_nota->save();
                    $success_messages[] = 'success_: update nota_id pada table spk_produk_nota';
                }
            }
        }

        /**
         * UPDATE no_nota dan harga_total NOTA
         */

        if ($run_db) {

            $nota = Nota::find($nota_id);
            $nota->no_nota = "N-$nota_id";
            // $nota->data_nota_item = $data_nota_items;
            $nota->harga_total = $hrg_total_nota;
            $nota->save();

            $pesan_db = 'SUCCESS';
            $success_messages[] = 'success_: update no_nota dan harga_total_nota';
            $class_div_pesan_db = 'alert-success';

            $load_num->value = $load_num['value'] + 1;
            $load_num->save();
        }

        $data = [
            'go_back_number' => -3,
            'pesan_db' => $pesan_db,
            'class_div_pesan_db' => $class_div_pesan_db,
            'error_messages' => $error_messages,
            'success_messages' => $success_messages,
        ];


        return view('layouts.go-back-page', $data);
    }

    public function nota_detail(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;
        $get = $request->query();

        if ($show_dump) {
            dump('get');
            dump($get);
        }

        $nota = Nota::find($get['nota_id']);

        /**
         * PENGEN CARI TAU, SPKCPNota
         * implementasi nya sama2 merasa rumit, jadi kita jalanin aja pake JSON dlu.
         */

        $pelanggan = Nota::find($nota->id)->pelanggan->toArray();
        $daerah = Daerah::find($pelanggan['daerah_id'])->toArray();

        $reseller = null;
        if ($nota['reseller_id'] !== null) {
            $reseller = Pelanggan::find($nota['reseller_id'])->toArray();
        }

        $spk_produk_notas = SpkProdukNota::where('nota_id', $nota['id'])->get()->toArray();
        $spk_produks = $produks = array();
        foreach ($spk_produk_notas as $spk_produk_nota) {
            $spk_produk = SpkProduk::find($spk_produk_nota['spk_produk_id'])->toArray();
            $produk = Produk::find($spk_produk['produk_id'])->toArray();
            $spk_produks[] = $spk_produk;
            $produks[] = $produk;
        }


        $data = [
            'nota' => $nota,
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
        ];
        return view('nota.nota-detail', $data);
    }

    public function nota_print_out(Request $request)
    {
        $get = $request->input();
        // dump('get');
        // dump($get);

        $nota_id = $get['nota_id'];

        $nota = Nota::find($nota_id);

        $pelanggan = Pelanggan::find($nota['pelanggan_id']);

        $reseller = 'none';
        if ($nota['reseller_id'] !== null && $nota['reseller_id'] !== '') {
            $reseller = Pelanggan::find($nota['reseller_id']);
        }


        $data = [
            'csrf' => csrf_token(),
            'nota' => $nota,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
            // 'available_spk' => $available_spk
        ];
        return view('nota.nota-print-out', $data);
    }

    public function nota_hapus(Request $request)
    {
        $post = $request->input();
        dump('post');
        dump($post);

        $load_num = SiteSetting::find(1);
        dump('load_num');
        dump($load_num);

        $nota_id = (int)$post['nota_id'];

        $nota = Nota::find($nota_id);
        /**
         * Setelah nota, kita cari relasi nya dengan spkcp_nota untuk memperoleh spkcp_id. sehingga
         * bisa ketemu dengan spk_produk yang berkaitan.
         */
        $spkcp_notas = SpkProdukNota::where('nota_id', $nota_id)->get();
        dump("spkcp_notas");
        dump($spkcp_notas);
        // dd($spkcp_notas);

        for ($i0 = 0; $i0 < count($spkcp_notas); $i0++) {
            dump("LOOP - $i0");
            $spk_produk = SpkProduk::find($spkcp_notas[$i0]['spkcp_id']);
            $jml_sdh_nota_old = $spk_produk['jml_sdh_nota'];
            dump("jml_sdh_nota_old: $jml_sdh_nota_old");
            $jml_sdh_nota_new = $jml_sdh_nota_old - $spkcp_notas[$i0]['jml'];
            dump("jml_sdh_nota_new: $jml_sdh_nota_new");

            $spk_produk->jml_sdh_nota = $jml_sdh_nota_new;
            if ($jml_sdh_nota_new === 0) {
                $spk_produk->status_nota = 'BELUM';
            } else {
                $spk_produk->status_nota = 'SEBAGIAN';
            }
            dump("spk_produk->status_nota: $spk_produk->status_nota");

            /**
             * Disini concern untuk data json nya yang nota_jml_kapan. Pilih array yang nota_id nya sesuai,
             * lalu dari sana, kurangi jumlah nya, sesuai dengan jumlah dari nota_item yang dihapus.
             */

            $nota_jml_kapan = json_decode($spk_produk['nota_jml_kapan'], true);
            dump("nota_jml_kapan");
            dump($nota_jml_kapan);
            $i_nota_jml_kapan_toDelete = '?';
            for ($i1 = 0; $i1 < count($nota_jml_kapan); $i1++) {
                if ($nota_jml_kapan[$i1]['nota_id'] === $nota_id) {
                    $i_nota_jml_kapan_toDelete = $i1;
                    break;
                }
            }
            dump("i_nota_jml_kapan_toDelete: $i_nota_jml_kapan_toDelete");
            unset($nota_jml_kapan[$i_nota_jml_kapan_toDelete]);

            $nota_jml_kapan = array_values($nota_jml_kapan);
            dump("nota_jml_kapan (2)");
            dump($nota_jml_kapan);

            if (count($nota_jml_kapan) === 0) {
                $nota_jml_kapan = null;
            }

            dump("nota_jml_kapan (3)");
            dump($nota_jml_kapan);

            $spk_produk->nota_jml_kapan = $nota_jml_kapan;

            if ($load_num['value'] === 0) {
                $spk_produk->save();
            }

            dump("END LOOP - $i0");
        }

        if ($load_num['value'] === 0) {
            $nota->delete();
        }

        $data = [
            'go_back_number' => -2,
        ];

        $load_num->value = $load_num['value'] + 1;
        $load_num->save();

        return view('layouts.go-back-page', $data);
    }
}
