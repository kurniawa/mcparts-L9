<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Helpers\UpdateDataSPK;
use App\Models\Daerah;
use App\Models\Nota;
use App\Models\Pelanggan;
use App\Models\PelangganProduk;
use App\Models\Produk;
use App\Models\ProdukHarga;
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
            array_push($pelanggans, $pelanggan);

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

    public function NotaAll(Request $request)
    {
        SiteSettings::loadNumToZero();
        $spk_id=$request->query('spk_id');
        $notas=SpkProdukNota::where('spk_id',$spk_id)->get('nota_id')->pluck('nota_id')->toArray();

        // dump($notas);
        $notas=array_unique($notas);
        // dd($notas);

        $data=[
            'notas'=>$notas,
            'spk_id'=>$spk_id,
        ];
        return view('nota.NotaAll', $data);
    }

    public function NotaAll_DB(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();

        if (isset($post['mode'])) {
            $request->validate([
                'nota_id'=>'required'
            ]);
        }
        // dd('$post:', $post);
        $spk_produks=SpkProduk::where('spk_id',$post['spk_id'])->get();
        if (isset($post['nota_id'])) {
            foreach ($spk_produks as $spk_produk) {
                $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
                if (count($spk_produk_notas)!==0) {
                    $success_logs[]="spk_produk_id:$spk_produk[id] sudah memiliki nota.";
                    $jml_nota_sama=$jml_nota_beda=0;
                    $SPKProdukNotaID_toUpdate=null;
                    //cek nota_id nya sama seperti yang di post atau tidak
                    foreach ($spk_produk_notas as $spk_produk_nota) {
                        if ($spk_produk_nota['nota_id']==$post['nota_id']) {
                            $jml_nota_sama+=$spk_produk_nota['jumlah'];
                            $SPKProdukNotaID_toUpdate=$spk_produk_nota['id'];
                        } else {
                            $jml_nota_beda+=$spk_produk_nota['jumlah'];
                        }
                    }
                    if ($jml_nota_sama===0) {
                        $success_logs[]="spk_produk_id:$spk_produk[id] tidak memiliki nota sama seperti yang di post:$post[nota_id]";
                        $jml_av=$spk_produk['jml_selesai']-$jml_nota_beda;
                        if ($jml_av!==0) {
                            if ($run_db) {
                                SpkProdukNota::create([
                                    'spk_id'=>$post['spk_id'],
                                    'produk_id'=>$spk_produk['spk_produk_id'],
                                    'spk_produk_id'=>$spk_produk['id'],
                                    'nota_id'=>$post['nota_id'],
                                    'jumlah'=>$jml_av,
                                    'harga'=>$spk_produk['harga'],
                                    'harga_t'=>$spk_produk['harga']*$jml_av,
                                ]);
                                $success_logs[]="Membuat spk_produk_nota baru dengan jumlah yang tersedia, yakni setelah dikurang $jml_nota_beda";
                            }
                        }
                    } else {
                        $success_logs[]="spk_produk_id:$spk_produk[id] memiliki nota sama seperti yang di post:$post[nota_id]";
                        $jml_av=$spk_produk['jml_selesai']-($jml_nota_sama+$jml_nota_beda);
                        $jml_to_update=$jml_av+$jml_nota_sama;
                        $SPKProdukNotaToUpdate=SpkProdukNota::find($SPKProdukNotaID_toUpdate);
                        $SPKProdukNotaToUpdate->jumlah=$jml_to_update;
                        if ($run_db) {
                            $SPKProdukNotaToUpdate->save();
                            $success_logs[]="Updating spk_produk_nota->jumlah";
                        }
                    }
                } else {
                    //PEMBUATAN spk_produk_nota baru
                    $success_logs[]="spk_produk_id:$spk_produk[id] belum memiliki nota. Pembuatan spk_produk_nota baru.";
                    if ($run_db) {
                        SpkProdukNota::create([
                            'spk_id'=>$post['spk_id'],
                            'produk_id'=>$spk_produk['produk_id'],
                            'spk_produk_id'=>$spk_produk['id'],
                            'nota_id'=>$post['nota_id'],
                            'jumlah'=>$spk_produk['jumlah'],
                            'harga'=>$spk_produk['harga'],
                            'harga_t'=>$spk_produk['harga']*$spk_produk['jumlah'],
                        ]);
                        $success_logs[]="Membuat spk_produk_nota baru";
                    }

                }
                UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produk['id']);
                $success_logs[]="Updating jml_sdh_nota dan status_nota pada spk_produk ID: $spk_produk[id]";
                UpdateDataSPK::Nota_JmlT_HargaT($post['nota_id']);
                $success_logs[]="Updating jumlah_total dan harga_total pada nota ID: $post[nota_id]";

                $load_num->value+=1;
                $load_num->save();
                $main_log='Success';
            }
        } else {
            //kalo ada lebih dari satu item, tetep mesti cek lewat loop, karena loop pertama pasti sudah terbentuk nota baru.
            $nota_id=null; // setelah loop pertama, $nota_id akan memiliki value dan menjadi acuan untuk loop berikutnya.
            for ($i=0; $i < count($spk_produks); $i++) {
                if ($i===0) {
                    $success_logs[]='Nota sama sekali belum ada.';
                    list($success_logs2, $nota_id)=UpdateDataSPK::NewNota($spk_produks[$i]['id']);
                    $success_logs=array_merge($success_logs,$success_logs2);
                } else {
                    if ($nota_id!==null) {
                        $success_logs2=UpdateDataSPK::NewSPKProdukNota($spk_produks[$i]['id'],$nota_id);
                        $success_logs=array_merge($success_logs,$success_logs2);
                    } else {
                        $error_logs[]='Ada kesalahan, nota_id belum diketahui';
                    }
                }
                UpdateDataSPK::SpkProduk_JmlNota_Status($spk_produks[$i]['id']);
                $success_logs[]="Updating jml_sdh_nota dan status_nota pada spk_produks[$i] ID: $spk_produks[$i][id]";
                UpdateDataSPK::Nota_JmlT_HargaT($nota_id);
                $success_logs[]="Updating jumlah_total dan harga_total pada nota ID: $nota_id";
                $main_log='Success';
            }
        }

        $route='SPK-Detail';
        $route_btn='Ke Detail SPK';
        $params=['spk_id'=>$post['spk_id']];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }

    public function notaBaru_pilihSPK(Request $request)
    {
        SiteSettings::loadNumToZero();

        $show_dump = false;

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
        $show_dump = false;

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

        if ($show_dump === true) {
            dump('arr_av_nota_items');
            dump($arr_av_nota_items);
            // dd($arr_av_nota_items);
            dump('arr_produks: ', $arr_produks);
        }

        $data = [
            'csrf' => csrf_token(),
            'spks' => $spks,
            'pelanggan' => $pelanggan,
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

        $show_dump = false;
        $run_db = true;
        $success_logs = $error_logs = array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $ada_error = true;
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();
        if ($show_dump) {
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

            $jumlah_nota_total = 0;
            for ($i = 0; $i < count($spk_produk_ids); $i++) {
                $spk_produk = SpkProduk::find($spk_produk_ids[$i]);
                // $spkcpnota = SpkcpNota::where('spkcp_id', $spk_produk['id']);
                if ($show_dump) {
                    dump('spk_produk: ', $spk_produk);
                }
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

                $jml_sdh_nota = $spk_produk['jml_sdh_nota']; // Secara default value=0 sudah diatur pada pembuatan database nya
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
                $jumlah_nota_total += $jml_sdh_nota;
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
                        'spk_id' => $post['spk_id'][$i],
                        'spk_produk_id' => $spk_produk['id'],
                        'jumlah' => $jml_inputs[$i],
                        'harga' => $hrg_per_item,
                        'harga_t' => $hrg_total_item,
                        'created_at' => $post['tgl_pembuatan']
                    ]);

                    array_push($success_logs, 'success_: insert ke spk_produk_nota, belum insert ke nota, nota_id belum diketahui.');
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

            if ($show_dump) {
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
                    array_push($error_logs, 'error_: TIDAK ADA YANG DI PROSES KE DATABASE, KARENA JUMLAH TIDAK SESUAI!');
                } else {
                    // dump('INSERT TABLE nota');
                    // dump([
                    //     'pelanggan_id' => $spk['pelanggan_id'],
                    //     'reseller_id' => $spk['reseller_id'],
                    //     'status' => 'PROSES',
                    // ]);

                    // dump('INSERT TABLE spk_notas', [
                    //     'spk_id' => $spk['id'],
                    //     'nota_id' => 'Dari insertGetId sebelumnya dulu',
                    // ]);

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

                            array_push($success_logs, 'success_: insert pertama ke table nota, sekaligus menetapkan nota_id');

                        }

                        /**
                         * INSERT ke spk_notas
                         * keterangan: dengan catatan belum ada yang diinsert dengan spk_id dan nota_id yang sama
                         */
                        $spk_nota = SpkNota::where('spk_id', $spk['id'])->where('nota_id', $nota_id)->first();

                        if ($spk_nota === null) {
                            DB::table('spk_notas')->insert([
                                'spk_id' => $spk['id'],
                                'nota_id' => $nota_id,
                            ]);

                            array_push($success_logs, 'success_: create relasi spk_notas');
                        } else {
                            $success_logs[] = 'relasi spk_notas sudah exist';
                        }
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

        $iSPKProdukNota1 = 0;
        foreach ($d_spk_produk_nota_ids as $spk_produk_nota_ids) {
            $iSPKProdukNota2 = 0;
            foreach ($spk_produk_nota_ids as $spk_produk_nota_id) {
                $spk_produk_nota = SpkProdukNota::find($spk_produk_nota_id);
                $spk_produk_nota->nota_id = $nota_id;
                if ($run_db) {
                    $spk_produk_nota->save();
                    $success_logs[] = 'success_: update nota_id pada table spk_produk_nota';
                }

                /**CEK APAKAH PELANGGAN INI TELAH SEMPAT ORDER PRODUK INI SEBELUMNYA
                 * kalau belum, berarti create relasi baru. Kalau sudah ada, tinggal update saja
                 * nota_id nya jadi nota_id yang terbaru.
                */

                $spk_produk = SpkProduk::find($d_spk_produk_ids[$iSPKProdukNota1][$iSPKProdukNota2]);

                $pelanggan_produk = PelangganProduk::where('pelanggan_id', $post['pelanggan_id'])
                ->where('reseller_id', $post['reseller_id'])
                ->where('produk_id', $spk_produk['produk_id'])
                ->where('harga_price_list', $spk_produk_nota['harga'])->get()->toArray();

                if (count($pelanggan_produk) === 0) {
                    if ($run_db) {
                        $pelanggan_produk = PelangganProduk::create([
                            'pelanggan_id' => $post['pelanggan_id'],
                            'reseller_id' => $post['reseller_id'],
                            'produk_id' => $spk_produk['produk_id'],
                            'nota_id' => $nota_id,
                            'harga_price_list' => $spk_produk_nota['harga'],
                        ]);

                        $success_logs[] = 'Berhasil create relasi pelanggan_produk yang baru';
                    }
                } else {
                    if ($pelanggan_produk[0]['nota_id'] !== $nota_id) {
                        $pelanggan_produk = PelangganProduk::find($pelanggan_produk[0]['id']);
                        $pelanggan_produk->nota_id = $nota_id;
                        if ($run_db) {
                            $pelanggan_produk->save();

                            $success_logs[] = 'Ditemukan ada pelanggan_produk yang sesuai -> update nota_id pada data pelanggan_produk terkait';
                        }
                    }
                }

                $iSPKProdukNota2++;
            }
            $iSPKProdukNota1++;
        }

        /**
         * UPDATE no_nota dan harga_total NOTA
         */

        if ($run_db) {

            $nota = Nota::find($nota_id);
            $nota->no_nota = "N-$nota_id";
            // $nota->data_nota_item = $data_nota_items;
            $nota->jumlah_total = $jumlah_nota_total;
            $nota->harga_total = $hrg_total_nota;
            $nota->save();

            $main_log = 'SUCCESS';
            $success_logs[] = 'success_: update no_nota dan harga_total_nota';
            $class_div_pesan_db = 'alert-success';

            $load_num->value = $load_num['value'] + 1;
            $load_num->save();
        }

        /**
         * UPDATE status_nota pada $spk
         * keterangan: ini dicoding terpisah dari codingan di atas, karena memang harus dihitung ulang dari awal jml_sdh_nota
         */
        foreach ($post['spk_id'] as $spk_id) {
            $obj_spk = new Spk();
            list($spk, $status_nota, $jumlah_sudah_nota) = $obj_spk->updateStatusNota($spk_id);

            if ($run_db) {
                $spk->status_nota = $status_nota;
                $spk->jumlah_sudah_nota = $jumlah_sudah_nota;
                $spk->save();
                $success_logs[] = "status_nota pada spk di update menjadi $status_nota dan jumlah_sudah_nota menjadi $jumlah_sudah_nota";
            }
        }


        $data = [
            'go_back_number' => -3,
            'pesan_db' => $main_log,
            'class_div_pesan_db' => $class_div_pesan_db,
            'error_logs' => $error_logs,
            'success_logs' => $success_logs,
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

        $obj_nota = new Nota();
        list($nota, $pelanggan, $daerah, $reseller, $spk_produk_notas, $spk_produks, $produks, $data_items) = $obj_nota->getOneNotaAndComponents($get['nota_id']);


        $data = [
            'nota' => $nota,
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
            'data_items' => $data_items,
        ];
        return view('nota.nota-detail', $data);
    }

    public function nota_print_out(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('get');
            dump($get);
        }

        $pbj_nota = new Nota();
        list($nota, $pelanggan, $daerah, $reseller, $spk_produk_notas, $spk_produks, $produks) = $pbj_nota->getOneNotaAndComponents($get['nota_id']);

        $data = [
            'csrf' => csrf_token(),
            'nota' => $nota,
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
        ];
        return view('nota.nota-print-out', $data);
    }

    public function nota_hapus(Request $request)
    {

        $load_num = SiteSetting::find(1);
        $show_dump = true;
        $run_db = true;

        $success_logs = $error_logs = array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump) {
            dump('post', $post);
        }

        $nota_id = (int)$post['nota_id'];

        $nota = Nota::find($nota_id);
        /**
         * Setelah nota, kita cari relasi nya dengan spkcp_nota untuk memperoleh spkcp_id. sehingga
         * bisa ketemu dengan spk_produk yang berkaitan.
         */
        $spkcp_notas = SpkProdukNota::where('nota_id', $nota_id)->get();
        if ($show_dump) {
            dump("spkcp_notas");
            dump($spkcp_notas);
        }

        foreach ($spkcp_notas as $spkcp_nota) {
            $spk_produk = SpkProduk::find($spkcp_nota['spk_produk_id']);
            $spk = Spk::find($spkcp_nota['spk_id']);

            // dump($spkcp_nota);
            // dump($spk_produk);

            $status_nota = 'SEMUA';
            $jml_sdh_nota = $spk_produk['jml_sdh_nota'] - $spkcp_nota['jumlah'];

            if ($jml_sdh_nota === 0) {
                $status_nota = 'BELUM';
            } elseif ($jml_sdh_nota < $spk_produk['jml_selesai']) {
                $status_nota = 'SEBAGIAN';
            }

            if ($show_dump) {
                dump($spk_produk['jml_sdh_nota']);
                dump($spkcp_nota['jumlah']);
                dump('$jml_sdh_nota', $jml_sdh_nota);
            }

            if ($run_db) {
                $spk_produk->status_nota = $status_nota;
                $spk_produk->jml_sdh_nota = $jml_sdh_nota;
                $spk_produk->save();
                $success_logs[] = 'success_: UPDATE status_nota pada table spk_produk terkait!';

                $obj_spk = new Spk();
                $success_logs[] = $obj_spk->updateStatusNota_JumlahSudahNota($spk['id']);
            }
        }

        # UPDATE status_nota PADA SPK

        if ($run_db) {
            $nota->delete();

            $load_num->value += 1;
            $load_num->save();

            $main_log = 'SUCCESS:';
            $class_div_pesan_db = 'alert-success';
            $success_logs[] = 'success_: Berhasil delete nota terkait!';
        }

        $data = [
            'go_back_number' => -2,
            'pesan_db' => $main_log,
            'class_div_pesan_db' => $class_div_pesan_db,
            'error_logs' => $error_logs,
            'success_logs' => $success_logs,
        ];


        return view('layouts.go-back-page', $data);
    }

    public function edit_item_nota(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('$get:', $get);
        }

        $data_item = json_decode($get['data_item'], true);

        $spk_produk_nota = SpkProdukNota::find($data_item['spk_produk_nota_id']);
        $spk_produk = SpkProduk::find($data_item['spk_produk_id']);
        $produk = Produk::find($data_item['produk_id']);
        $nota = Nota::find($get['nota_id']);
        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $reseller = null;
        if ($nota['reseller_id'] !== null) {
            $reseller = Pelanggan::find($nota['reseller_id']);
        }

        $jumlahYangAdaPadaNotaLain = 0;
        $spkProdukNotas = SpkProdukNota::where('spk_produk_id', $spk_produk['id'])->where('id', '!=', $spk_produk_nota['id'])->get()->toArray();
        if (count($spkProdukNotas) !== 0) {
            foreach ($spkProdukNotas as $spkProdukNota) {
                $jumlahYangAdaPadaNotaLain += $spkProdukNota['jumlah'];
            }
        }

        $data = [
            'nota' => $nota,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
            'spk_produk_nota' => $spk_produk_nota,
            'spk_produk' => $spk_produk,
            'produk' => $produk,
            'jumlahYangAdaPadaNotaLain' => $jumlahYangAdaPadaNotaLain,
        ];

        // dump($data);

        return view('nota.edit_item_nota', $data);
    }

    public function edit_item_nota_db(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $show_dump = true;
        $run_db = true;

        $success_logs = $error_logs = array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        $jumlah_selesai = $post['jumlah_selesai'];
        $request->validate([
            'jumlah_input' => "required|numeric|min:1|max:$jumlah_selesai",
        ]);

        if ($show_dump) {
            dump('post', $post);
        }

        $spk_produk_nota = SpkProdukNota::find($post['spk_produk_nota_id']);
        $spk_produk = SpkProduk::find($post['spk_produk_id']);
        $produk = Produk::find($post['produk_id']);
        $nota = Nota::find($post['nota_id']);

        if ($spk_produk_nota['jumlah'] !== (int)$post['jumlah_input']) {
            $jml_sdh_nota = (int)$post['jumlah_input'] + (int)$post['jumlah_yang_ada_pada_nota_lain'];
            dump('$jml_sdh_nota', $jml_sdh_nota);
            dump('$spk_produk[jml_selesai]', $spk_produk['jml_selesai']);
            if ($run_db) {
                $harga_t = (int)$post['jumlah_input'] * $spk_produk_nota['harga'];
                $harga_total_nota = $nota['harga_total'] - $spk_produk_nota['harga_t'] + $harga_t; // dikurang dengan jumlah yang lama, ditambah dengan jumlah yang baru

                $spk_produk_nota->jumlah = $post['jumlah_input'];
                $spk_produk_nota->harga_t = $harga_t;
                $spk_produk_nota->save();

                $success_logs[] = "update spk_produk_nota: jumlah=$spk_produk_nota[jumlah] dan harga_t=$spk_produk_nota[harga_t]";

                $nota->harga_total = $harga_total_nota;
                $nota->save();

                $success_logs[] = "update nota: harga_total=$harga_total_nota";

                $spk_produk->jml_sdh_nota = $jml_sdh_nota;
                $status_nota = 'BELUM';
                if ($jml_sdh_nota === $spk_produk['jml_selesai']) {
                    $status_nota = 'SEMUA';
                } elseif ($jml_sdh_nota > 0 && $jml_sdh_nota < $spk_produk['jml_selesai']) {
                    $status_nota = 'SEBAGIAN';
                }
                $spk_produk->status_nota = $status_nota;
                $spk_produk->save();

                $success_logs[] = "update spk_produk: jml_sdh_nota=$spk_produk[jml_sdh_nota] dan status_nota=$spk_produk[status_nota]";

                $main_log = 'SUCCESS';
                $class_div_pesan_db = 'alert-success';
            }

            /**
             * Update status_nota pada spk
             */
            $obj_spk = new Spk();
            list($spk, $status_nota, $jumlah_sudah_nota) = $obj_spk->updateStatusNota($spk_produk['spk_id']);

            if ($run_db) {
                $spk->status_nota = $status_nota;
                $spk->jumlah_sudah_nota = $jumlah_sudah_nota;
                $spk->save();
                $success_logs[] = "status_nota pada spk di update menjadi $status_nota";
            }
        } else {
            $main_log = 'OK';
            $class_div_pesan_db = 'alert-secondary';
            $success_logs[] = 'Tidak ada diubah, karena jumlah yang diinput sama seperti jumlah sebelumnya';
        }

        $data = [
            'go_back_number' => -2,
            'pesan_db' => $main_log,
            'class_div_pesan_db' => $class_div_pesan_db,
            'error_logs' => $error_logs,
            'success_logs' => $success_logs,
        ];

        return view('layouts.go-back-page', $data);
    }

    public function hapus_item_nota(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $show_dump = true;
        $run_db = true;

        $success_logs = $error_logs = array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump) {
            dump('post', $post);
        }

        $spk_produk_nota = SpkProdukNota::find($post['spk_produk_nota_id']);
        $spk_produk = SpkProduk::find($post['spk_produk_id']);
        $produk = Produk::find($post['produk_id']);
        $nota = Nota::find($post['nota_id']);

        if ($run_db) {
            # spk_produk: jml_sdh_nota dan status_nota
            $jml_sdh_nota = $spk_produk['jml_sdh_nota'] - $spk_produk_nota['jumlah'];
            $spk_produk->jml_sdh_nota = $jml_sdh_nota;

            $status_nota = 'BELUM';
            if ($jml_sdh_nota === $spk_produk['jml_selesai']) {
                $status_nota = 'SEMUA';
            } elseif ($jml_sdh_nota > 0 && $jml_sdh_nota < $spk_produk['jml_selesai']) {
                $status_nota = 'SEBAGIAN';
            }
            $spk_produk->status_nota = $status_nota;
            $spk_produk->save();

            $success_logs[] = "update spk_produk: jml_sdh_nota=$spk_produk[jml_sdh_nota] dan status_nota=$spk_produk[status_nota]";
            # nota: harga_total
            $harga_total = $nota['harga_total'] - $spk_produk_nota['harga_t'];
            $nota->harga_total = $harga_total;
            $nota->save();

            $success_logs[] = "update nota: harga_total=$harga_total";

            # hapus dari relasi antara pelanggan dan produk dan nota yang berkaitan
            $pelanggan_produk = PelangganProduk::where('produk_id', $produk['id'])
            ->where('nota_id', $nota['id'])->orderBy('updated_at', 'desc')->first()->delete();
            // dd($pelanggan_produk);
            $success_logs[] = "hapus relasi pelanggan_produk";

            # hapus spk_produk_nota
            $spk_produk_nota->delete();
            $success_logs[] = "hapus spk_produk_nota";

            $main_log = 'SUCCESS';
            $class_div_pesan_db = 'alert-success';
        }

        # UPDATE status_nota dan jumlah_sudah_nota pada spk
        $obj_spk = new Spk();
        $success_logs[] = $obj_spk->updateStatusNota_JumlahSudahNota($spk_produk_nota['spk_id']);

        $data = [
            'go_back_number' => -2,
            'pesan_db' => $main_log,
            'class_div_pesan_db' => $class_div_pesan_db,
            'error_logs' => $error_logs,
            'success_logs' => $success_logs,
        ];

        return view('layouts.go-back-page', $data);
    }

    public function tambah_item(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;
        $get = $request->query();

        if ($show_dump) {
            dump('$get', $get);
        }

        $obj_nota = new Nota();
        list($pelanggan, $daerah, $reseller, $reseller_id, $av_spks, $arr_spk_produks, $arr_produks, $nama_spks) = $obj_nota->getAvailableSPKItemFromNotaID($get['nota_id']);

        $data = [
            'nota_id' => $get['nota_id'],
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'reseller_id' => $reseller_id,
            'av_spks' => $av_spks,
            'arr_spk_produks' => $arr_spk_produks,
            'arr_produks' => $arr_produks,
            'nama_spks' => $nama_spks,
        ];

        return view('nota.tambah_item', $data);
    }

    public function tambah_item_pilih_item(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;
        $get = $request->query();

        if ($show_dump) {
            dump('$get', $get);
        }

        $obj_nota = new Nota();
        $spks = $arr_spk_produks = $arr_produks = array();
        foreach ($get['spk_id'] as $spk_id) {
            list($spk, $spk_produks, $produks) = $obj_nota->getAvailableSpkItemToAddToNotaFromSPK($spk_id);
            if (count($spk_produks) !== 0) {
                $arr_spk_produks[] = $spk_produks;
                $arr_produks[] = $produks;
                $spks[] = $spk;
            }
        }

        $data = [
            'nota_id' => $get['nota_id'],
            'spks' => $spks,
            'arr_spk_produks' => $arr_spk_produks,
            'arr_produks' => $arr_produks,
        ];

        dump($data);

        return view('nota.tambah_item_pilih_item', $data);
    }

    public function tambah_item_db(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $show_dump = false;
        $run_db = true;

        $success_logs = $error_logs = array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        $class_div_pesan_db = 'alert-danger';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            $class_div_pesan_db = 'alert-danger';
        }

        $post = $request->post();

        if ($show_dump) {
            dump('post', $post);
        }

        $spk_produk_ids = $post['spk_produk_id'];
        $jml_inputs = $post['jml_input'];
        $jml_avs = $post['jml_av'];
        $spk_ids = $post['spk_id'];
        $nota = Nota::find($post['nota_id']);
        $jumlah_total_nota = $nota->jumlah_total;
        $harga_total_nota = $nota->harga_total;
        for ($i=0; $i < count($spk_produk_ids); $i++) {
            for ($j=0; $j < count($spk_produk_ids[$i]); $j++) {
                $jml_input = (int)$jml_inputs[$i][$j];
                $jml_av = (int)$jml_avs[$i][$j];
                // update spk_produk: jml_sdh_nota dan status_nota
                $spk_produk = SpkProduk::find($spk_produk_ids[$i][$j]);
                $status_nota = 'BELUM';
                if ($jml_input === $jml_av) {
                    $status_nota = 'SEMUA';
                } elseif ($jml_input < $jml_av && $jml_input !== 0) {
                    $status_nota = 'SEBAGIAN';
                }

                if ($run_db) {
                    $spk_produk->jml_sdh_nota = $jml_input;
                    $spk_produk->status_nota = $status_nota;
                    $spk_produk->save();
                    $success_logs[] = 'update spk_produk: jml_sudah_nota dan status_nota';
                }

                // update spk: jumlah_sudah_nota dan status_nota
                $spk = Spk::find($spk_ids[$i][$j]);
                $jumlahSudahNotaThisSPK = $spk['jumlah_sudah_nota'];
                $jumlahSudahNotaThisSPK += $jml_input;
                $statusNotaThisSPK = $spk['status_nota'];
                if ($jumlahSudahNotaThisSPK === $spk['jumlah_total']) {
                    $statusNotaThisSPK = 'SEMUA';
                } elseif ($jumlahSudahNotaThisSPK !== 0 && $jumlahSudahNotaThisSPK < $spk['jumlah_total']) {
                    $statusNotaThisSPK = 'SEBAGIAN';
                }

                if ($run_db) {
                    $spk->jumlah_sudah_nota = $jumlahSudahNotaThisSPK;
                    $spk->status_nota = $statusNotaThisSPK;
                    $spk->save();
                    $success_logs[] = 'update spk: jumlah_sudah_nota dan status_nota';
                }

                // UPDATE spk_produk_nota: insert baru kalo belum ada, update apabila sudah ada.
                $spk_produk_nota = SpkProdukNota::where('spk_id', $spk['id'])
                ->where('spk_produk_id', $spk_produk['id'])
                ->where('nota_id', $nota['id'])->get()->toArray();

                $harga_t = $jml_input * $spk_produk['harga'];
                if ($run_db) {
                    if (count($spk_produk_nota) === 0) {
                        $spk_produk_nota = SpkProdukNota::create([
                            'spk_id' => $spk['id'],
                            'produk_id'=>$spk_produk['produk_id'],
                            'spk_produk_id' => $spk_produk['id'],
                            'nota_id' => $nota['id'],
                            'jumlah' => $jml_input,
                            'harga' => $spk_produk['harga'],
                            'harga_t' => $harga_t,
                        ]);

                        $success_logs[] = 'Create spk_produk_nota baru';
                    } else {
                        $spk_produk_nota = SpkProdukNota::find($spk_produk_nota[0]['id']);
                        $spk_produk_nota->jumlah = $jml_input;
                        $spk_produk_nota->harga = $spk_produk['harga'];
                        $spk_produk_nota->harga_t = $harga_t;
                        $spk_produk_nota->save();

                        $success_logs[] = 'Update spk_produk_nota: jumlah, harga, harga_t';
                    }
                }
                // END

                $jumlah_total_nota += $jml_input;
                $harga_total_nota += $harga_t;

                if ($show_dump) {
                    dump('spk', $spk);
                    dump('spk_produk', $spk_produk);
                    dump('spk_produk_nota', $spk_produk_nota);
                }
            }
        }

        // update nota
        if ($run_db) {
            $nota->jumlah_total = $jumlah_total_nota;
            $nota->harga_total = $harga_total_nota;
            $nota->save();

            $load_num->value += 1;
            $load_num->save();

            $success_logs[] = 'update nota: jumlah_total dan harga_total';
            $main_log = 'SUCCESS';
            $class_div_pesan_db = 'alert-success';
        }

        if ($show_dump) {
            dump('nota', $nota);
        }

        $data = [
            'go_back_number' => -3,
            'pesan_db' => $main_log,
            'class_div_pesan_db' => $class_div_pesan_db,
            'error_logs' => $error_logs,
            'success_logs' => $success_logs,
        ];

        return view('layouts.go-back-page', $data);
    }
}
