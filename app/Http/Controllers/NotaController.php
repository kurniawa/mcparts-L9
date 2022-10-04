<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Helpers\UpdateDataSPK;
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
    public function index()
    {

        // Metode untuk reset value pada pencegahan reload pada insert dan update DB
        SiteSettings::loadNumToZero();
        // END: metode untuk reset value: pencegahan reload pada halaman insert dan update DB
        // dump($reload_page);

        // else {
        //     $reload_page = false;
        // }


        $notas = Nota::limit(100)->orderByDesc('created_at')->get();
        $pelanggans = $resellers = $alamats=$arr_spk_produk_notas = $arr_spk_produks = $arr_produks=$bg_color_tgl= array();
        for ($i = 0; $i < count($notas); $i++) {
            $pelanggan = Nota::find($notas[$i]->id)->pelanggan;
            array_push($pelanggans, $pelanggan);
            $alamat=$pelanggan->alamat->first();
            $alamats[]=$alamat;

            if ($notas[$i]['reseller_id'] !== null) {
                $reseller = Pelanggan::find($notas[$i]['reseller_id'])->toArray();
                $resellers[] = $reseller;
            } else {
                $resellers[] = null;
            }

            $spk_produk_notas = SpkProdukNota::where('nota_id', $notas[$i]['id'])->get()->toArray();
            $spk_produks = $produks= array();
            foreach ($spk_produk_notas as $spk_produk_nota) {
                $spk_produk = SpkProduk::find($spk_produk_nota['spk_produk_id'])->toArray();
                $produk = Produk::find($spk_produk['produk_id'])->toArray();
                $spk_produks[] = $spk_produk;
                $produks[] = $produk;
            }

            $arr_spk_produk_notas[] = $spk_produk_notas;
            $arr_spk_produks[] = $spk_produks;
            $arr_produks[] = $produks;

            // BG-Color Tanggal
            $bg_color=['bg-danger bg-gradient'];
            if ($notas[$i]['finished_at']!==null) {
                $bg_color=['bg-warning bg-gradient','bg-success bg-gradient'];
            }
            $bg_color_tgl[]=$bg_color;
        }
        // $pelanggan = Pelanggan::find(3)->spk;
        // dd($pelanggans);
        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
            'notas' => $notas,
            'pelanggans' => $pelanggans,
            'alamats' => $alamats,
            'resellers' => $resellers,
            'arr_spk_produk_notas' => $arr_spk_produk_notas,
            'arr_spk_produks' => $arr_spk_produks,
            'arr_produks' => $arr_produks,
            'bg_color_tgl' => $bg_color_tgl,
        ];
        // dd($data);
        // $data = ['notas' => $notas, 'pelanggans' => $pelanggans];
        // dump($data);
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
// di fungsi not_detail ini saya akan sekaligus update harga khusus untuk pelanggan, apabila memang ada harga khusus nya.
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
        list($nota, $pelanggan,$alamat, $reseller, $spk_produk_notas, $spk_produks, $produks, $data_items) = $obj_nota->getOneNotaAndComponents($get['nota_id']);
        if ($reseller==null) {
            $reseller_id=null;
        } else {
            $reseller_id=$reseller['id'];
        }

        // Update Harga Khusus dimulai dari sini
        // Apakah sudah sempat diupdate? Kalo sudah, maka tidak perlu update lagi, tinggal di edit harga nya saja apabila ingin diubah
        for ($i=0; $i < count($spk_produk_notas); $i++) {
            if ($spk_produk_notas[$i]['is_price_updated']==='no') {
                $pelanggan_produk=PelangganProduk::where('pelanggan_id',$pelanggan['id'])->where('produk_id',$produks[$i]['id'])->latest()->first();
                // dump($pelanggan_produk);
                if ($pelanggan_produk!==null) { // kalau ternyata ada pelanggan_produk yang berkaitan dengan produk ini, maka dibandingkan harga nya
                    if ($spk_produk_notas[$i]['harga']!==$pelanggan_produk['harga_khusus']) { // kalau ternyata harga nya tidak sama, maka siap2 create PelangganProduk baru
                        $cust_produk_lain_yang_sama=PelangganProduk::where('pelanggan_id',$pelanggan['id'])->where('produk_id',$produks[$i]['id'])->where('harga_khusus',$pelanggan_produk['harga_khusus'])->first();
                        if ($cust_produk_lain_yang_sama==null) { // namun sebelum itu apakah pernah pake harga yang sama di pelanggan_produk? Kalau memang harga ini belum pernah diinput, baru kali ini benar2 dibuat pelanggan_produk yang baru.
                            PelangganProduk::create([
                                'pelanggan_id'=>$pelanggan['id'],
                                'reseller_id'=>$reseller_id,
                                'produk_id'=>$produks[$i]['id'],
                                'nota_id'=>$nota['id'],
                                'harga_price_list'=>$spk_produk_notas[$i]['harga'],
                                'harga_khusus'=>$pelanggan_produk[$i]['harga_khusus'],
                            ]);
                        }

                        $spk_produk_notas[$i]->harga=$pelanggan_produk['harga_khusus'];
                        $spk_produk_notas[$i]['is_price_updated']='yes';
                        $spk_produk_notas[$i]->save();
                    }
                }
            }
        }

        $menus=[
            ['route'=>'PrintOutNota','nama'=>'Print Out','method'=>'get','params'=>[['name'=>'nota_id','value'=>$nota['id']],]],
        ];
        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'nota' => $nota,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'reseller' => $reseller,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
            'data_items' => $data_items,
            'menus' => $menus,
        ];
        // dd($data);
        // dump($data);
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
        list($nota, $pelanggan, $alamat, $reseller, $spk_produk_notas, $spk_produks, $produks) = $pbj_nota->getOneNotaAndComponents($get['nota_id']);

        $data = [
            'csrf' => csrf_token(),
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'nota' => $nota,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'reseller' => $reseller,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
        ];
        // dump($data);
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

    public function edit_harga_item_nota(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();

        // dump('$get:', $get);

        $data_item = json_decode($get['data_item'], true);

        $spk_produk_nota = SpkProdukNota::find($data_item['spk_produk_nota_id']);
        $spk_produk = SpkProduk::find($data_item['spk_produk_id']);
        $produk = Produk::find($data_item['produk_id']);
        $produk_hargas=ProdukHarga::where('produk_id',$produk['id'])->get();
        $produk_harga_terbaru=ProdukHarga::where('produk_id',$produk['id'])->latest()->first();
        $nota = Nota::find($get['nota_id']);
        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $pelanggan_produk_hargas = PelangganProduk::where('pelanggan_id',$pelanggan['id'])->where('produk_id',$produk['id'])->get();
        $pelanggan_produk_harga_terbaru = PelangganProduk::where('pelanggan_id',$pelanggan['id'])->where('produk_id',$produk['id'])->latest()->first();
        $harga_khusus_pelanggan_terbaru=null;
        if ($pelanggan_produk_harga_terbaru!==null) {
            $harga_khusus_pelanggan_terbaru=$pelanggan_produk_harga_terbaru['harga_khusus'];
        }
        $reseller = null;
        $reseller_id=null;
        if ($nota['reseller_id'] !== null) {
            $reseller = Pelanggan::find($nota['reseller_id']);
            $reseller_id=$reseller['id'];
        }

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
            'produk_hargas' => $produk_hargas,
            'produk_harga_terbaru' => $produk_harga_terbaru,
            'pelanggan_produk_hargas' => $pelanggan_produk_hargas,
            'pelanggan_produk_harga_terbaru' => $pelanggan_produk_harga_terbaru,
            'harga_khusus_pelanggan_terbaru' => $harga_khusus_pelanggan_terbaru,
        ];

        dump($data);

        return view('nota.edit_harga_item_nota', $data);
    }

    public function edit_harga_item_nota_input_baru(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;

        $success_logs = $error_logs =$warning_logs= array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        $harga_baru=$post['harga_baru'];
        $nota_id=$post['nota_id'];
        $saveAsHargaKhusus='no';
        if (isset($post['saveAsHargaKhusus'])) {
            $saveAsHargaKhusus=$post['saveAsHargaKhusus'];
        }
        $pelanggan_id=$post['pelanggan_id'];
        $reseller_id=$post['reseller_id'];
        $produk_id=$post['produk_id'];
        $harga_price_list=$post['harga_price_list'];

        // dd('post', $post);

        $harga_baru=(int)$harga_baru;
        $harga_price_list=(int)$harga_price_list;
        if ($run_db) {
            $is_harga_exist='no';$pelanggan_produk_id=null;$produk_harga_id=null;
            $pelanggan_produk_harga=PelangganProduk::where('produk_id',$produk_id)->where('pelanggan_id',$pelanggan_id)->where('harga_khusus',$harga_baru)->first();
            $produk_harga=ProdukHarga::where('produk_id',$produk_id)->where('harga',$harga_baru)->first();
            if ($produk_harga!==null) {
                $produk_harga_id=$produk_harga['id'];
                $success_logs[]='Harga yang diinput sudah exist di table produk_harga, maka produk_harga_id menjadi bukan null.';
                $is_harga_exist='yes';
            }
            if ($pelanggan_produk_harga!==null) {
                $pelanggan_produk_id=$pelanggan_produk_harga['id'];
                $success_logs[]='Harga yang diinput sudah exist di table pelanggan_produk, maka pelanggan_produk_id menjadi bukan null.';
                $is_harga_exist='yes';
            }
            if ($is_harga_exist==='no') {
                // Simpan harga khusus pelanggan
                if ($saveAsHargaKhusus=='yes') {
                    $pelanggan_produk=PelangganProduk::where('pelanggan_id',$pelanggan_id)->where('produk_id',$produk_id)->where('harga_khusus',$harga_baru)->first();
                    if ($pelanggan_produk==null) {
                        PelangganProduk::create([
                            'pelanggan_id'=>$pelanggan_id,
                            'reseller_id'=>$reseller_id,
                            'produk_id'=>$produk_id,
                            'nota_id'=>$nota_id,
                            'harga_price_list'=>$harga_price_list,
                            'harga_khusus'=>$harga_baru,
                        ]);
                        $success_logs[]='Belum ada pelanggan_produk yang sama -> Berhasil create pelanggan_produk baru dan input harga khusus yang baru!';
                    }
                } else {
                    $success_logs[]='Harga tidak di temukan baik pada table produk_harga, maupun pada table pelanggan_produk. Maka harga yang baru diinput ini akan diinput ke dalam table produk_harga BARU dari produk ini.';
                    $produk_harga=ProdukHarga::create([
                        'produk_id'=>$produk_id,
                        'harga'=>$harga_baru,
                        'status'=>'BARU'
                    ]);
                    $produk_harga_id=$produk_harga['id'];
                }
            }

            $spk_produk_nota = SpkProdukNota::find($post['spk_produk_nota_id']);
            $spk_produk_nota->harga=$harga_baru;
            $spk_produk_nota->harga_t=$harga_baru*$spk_produk_nota['jumlah'];
            $spk_produk_nota->produk_harga_id=$produk_harga_id;
            $spk_produk_nota->pelanggan_produk_id=$pelanggan_produk_id;
            $spk_produk_nota->save();
            $success_logs[]='Berhasil update harga item dan harga_t item nota!';
            // Karena adanya perubahan harga, maka perlu update data nota
            UpdateDataSPK::Nota_JmlT_HargaT($nota_id);
            $success_logs[]='nota: Jumlah dan Harga Total Nota diupdate.';

            $main_log='SUCCESS';
            $load_num->value+=1;
            $load_num->save();
        }

        $route='Nota-Detail';
        $route_btn='Ke Detail Nota';
        $params=['nota_id'=>$nota_id];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }

    public function edit_harga_item_nota_pilih_dari_histori(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;

        $success_logs = $error_logs =$warning_logs= array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        $harga_baru=$post['harga_baru'];
        $nota_id=$post['nota_id'];
        $saveAsHargaKhusus='no';
        if (isset($post['saveAsHargaKhusus'])) {
            $saveAsHargaKhusus=$post['saveAsHargaKhusus'];
        }
        $pelanggan_id=$post['pelanggan_id'];
        $reseller_id=$post['reseller_id'];
        $produk_id=$post['produk_id'];
        $harga_price_list=$post['harga_price_list'];

        // dd('post', $post);

        $harga_baru=(int)$harga_baru;
        $harga_price_list=(int)$harga_price_list;
        if ($run_db) {

            $spk_produk_nota = SpkProdukNota::find($post['spk_produk_nota_id']);
            $spk_produk_nota->harga=$harga_baru;
            $spk_produk_nota->harga_t=$harga_baru*$spk_produk_nota['jumlah'];
            $spk_produk_nota->save();
            $success_logs[]='Berhasil update harga item dan harga_t item nota!';
            // Karena adanya perubahan harga, maka perlu update data nota
            UpdateDataSPK::Nota_JmlT_HargaT($nota_id);
            $success_logs[]='nota: Jumlah dan Harga Total Nota diupdate.';

            // Simpan harga khusus pelanggan
            if ($saveAsHargaKhusus=='yes') {
                $pelanggan_produk=PelangganProduk::where('pelanggan_id',$pelanggan_id)->where('produk_id',$produk_id)->where('harga_khusus',$harga_baru)->first();
                if ($pelanggan_produk==null) {
                    PelangganProduk::create([
                        'pelanggan_id'=>$pelanggan_id,
                        'reseller_id'=>$reseller_id,
                        'produk_id'=>$produk_id,
                        'nota_id'=>$nota_id,
                        'harga_price_list'=>$harga_price_list,
                        'harga_khusus'=>$harga_baru,
                    ]);
                    $success_logs[]='Belum ada pelanggan_produk yang sama -> Berhasil create pelanggan_produk baru dan input harga khusus yang baru!';
                }
            }

            $main_log='SUCCESS';
            $load_num->value+=1;
            $load_num->save();
        }

        $route='Nota-Detail';
        $route_btn='Ke Detail Nota';
        $params=['nota_id'=>$nota_id];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
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
