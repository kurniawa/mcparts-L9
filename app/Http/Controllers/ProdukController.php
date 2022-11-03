<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Bahan;
use App\Models\Busastang;
use App\Models\Jokassy;
use App\Models\Kombinasi;
use App\Models\Motif;
use App\Models\Produk;
use App\Models\ProdukBahan;
use App\Models\ProdukBusastang;
use App\Models\ProdukHarga;
use App\Models\ProdukJokassy;
use App\Models\ProdukKombinasi;
use App\Models\ProdukMotif;
use App\Models\ProdukRol;
use App\Models\ProdukRotan;
use App\Models\ProdukSpec;
use App\Models\ProdukStandar;
use App\Models\ProdukStiker;
use App\Models\ProdukTankpad;
use App\Models\ProdukVariasiVarian;
use App\Models\Rol;
use App\Models\Rotan;
use App\Models\SiteSetting;
use App\Models\Spec;
use App\Models\Standar;
use App\Models\Stiker;
use App\Models\Tankpad;
use App\Models\Tsixpack;
use App\Models\Varian;
use App\Models\Variasi;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SiteSettings::loadNumToZero();
        $sjvariasis = Produk::where('tipe','SJ-Variasi')->orderBy('nama')->get(['id','nama'])->toArray();
        $sjkombinasis = Produk::where('tipe','SJ-Kombinasi')->orderBy('nama')->get(['id','nama'])->toArray();
        $sjmotifs = Produk::where('tipe','SJ-Motif')->orderBy('nama')->get(['id','nama'])->toArray();
        $sjtsixpacks = Produk::where('tipe','SJ-T.Sixpack')->orderBy('nama')->get(['id','nama'])->toArray();
        $sjstandars = Produk::where('tipe','SJ-Standar')->orderBy('nama')->get(['id','nama'])->toArray();
        $sjjapstyles = Produk::where('tipe','SJ-Japstyle')->orderBy('nama')->get(['id','nama'])->toArray();
        $jokassies = Produk::where('tipe','Jok Assy')->orderBy('nama')->get(['id','nama'])->toArray();
        $tankpads = Produk::where('tipe','Tankpad')->orderBy('nama')->get(['id','nama'])->toArray();
        $stikers = Produk::where('tipe','Stiker')->orderBy('nama')->get(['id','nama'])->toArray();
        $busastangs = Produk::where('tipe','Busa-Stang')->orderBy('nama')->get(['id','nama'])->toArray();
        $rols = Produk::where('tipe','Rol')->orderBy('nama')->get(['id','nama'])->toArray();
        $rotans = Produk::where('tipe','Rotan')->orderBy('nama')->get(['id','nama'])->toArray();

        $jumlah=count($sjvariasis)+count($sjkombinasis)+count($sjmotifs)+count($sjtsixpacks)+count($sjstandars)+count($sjjapstyles)+count($jokassies)+count($tankpads)+count($stikers)+count($busastangs)+count($rols)+count($rotans);

        $colors = ['primary','success','danger','info','warning','dark'];
        $btn_tipe = [
            ['short'=>'all','tipe'=>null],
            ['short'=>'var','tipe'=>'SJ-Variasi'],
            ['short'=>'komb','tipe'=>'SJ-Kombinasi'],
            ['short'=>'mot','tipe'=>'SJ-Motif'],
            ['short'=>'t-sp','tipe'=>'SJ-T.Sixpack'],
            ['short'=>'std','tipe'=>'SJ-Standar'],
            ['short'=>'jap','tipe'=>'SJ-Japstyle'],
            ['short'=>'ass','tipe'=>'Jok Assy'],
            ['short'=>'tp','tipe'=>'Tankpad'],
            ['short'=>'sti','tipe'=>'Stiker'],
            ['short'=>'bs','tipe'=>'Busa-Stang'],
            ['short'=>'rol','tipe'=>'Rol'],
            ['short'=>'rot','tipe'=>'Rotan'],
        ];
        for ($i=0,$j=0; $i < count($btn_tipe); $i++,$j++) {
            if ($j===count($colors)) {
                $j=0;
            }
            $btn_tipe[$i]['color']=$colors[$j];
        }
        // dd($btn_tipe);
        $menus=[
            ['route'=>'produkDanSpecs','nama'=>'+Tambah Produk'],
        ];
        $data = [
            // 'go_back'=>true,
            // 'navbar_bg'=>'$orange-300',
            'menus'=>$menus,
            'sjvariasis'=>$sjvariasis,
            'sjkombinasis'=>$sjkombinasis,
            'sjmotifs'=>$sjmotifs,
            'sjtsixpacks'=>$sjtsixpacks,
            'sjstandars'=>$sjstandars,
            'sjjapstyles'=>$sjjapstyles,
            'jokassies'=>$jokassies,
            'tankpads'=>$tankpads,
            'stikers'=>$stikers,
            'busastangs'=>$busastangs,
            'rols'=>$rols,
            'rotans'=>$rotans,
            'btn_tipe'=>$btn_tipe,
            'colors'=>$colors,
            'jumlah'=>$jumlah,
        ];

        return view('produk.produks', $data);
    }

    public function tipe_variasi()
    {
        SiteSettings::loadNumToZero();
        $show_dump = true;

        $data = [];

        return view('produk.tipe_variasi', $data);
    }

    public function tambahProduk($tipe)
    {
        SiteSettings::loadNumToZero();
        $bahans = Bahan::get(['nama as label','nama as value','grade'])->toArray();
        $variasis = Variasi::all();
        $varians = Varian::get(['nama as label', 'nama as value'])->toArray();
        $ukurans = Spec::where('kategori','ukuran')->get(['nama as label','nama as value','nama_nota as nama_nota'])->toArray();
        $jahits = Spec::where('kategori','jahit')->get(['nama as label','nama as value'])->toArray();
        /**T.Sixpack */
        $tsixpacks = Tsixpack::get(['nama as label','nama as value'])->toArray();
        // Kombinasi
        $kombinasis = Kombinasi::get(['nama as label','nama as value'])->toArray();
        $lists = Spec::where('kategori','list')->get(['nama as label','nama as value'])->toArray();
        /**Motif */
        $motifs = Motif::get(['nama as label','nama as value'])->toArray();
        $alass = Spec::where('kategori','alas')->get(['nama as label','nama as value'])->toArray();
        $busas = Spec::where('kategori','busa')->get(['nama as label','nama as value'])->toArray();
        /**Standar */
        $standars = Standar::get(['nama as label','nama as value'])->toArray();
        $sayaps = Spec::where('kategori','sayap')->get(['nama as label','nama as value'])->toArray();
        /**Jok Assy */
        $jokassies = Jokassy::get(['nama as label','nama as value'])->toArray();
        $tankpads = Tankpad::get(['nama as label','nama as value'])->toArray();
        $stikers = Stiker::get(['nama as label','nama as value'])->toArray();
        $busastangs = Busastang::get(['nama as label','nama as value'])->toArray();
        $rols = Rol::get(['nama as label','nama as value'])->toArray();
        $rotans = Rotan::get(['nama as label','nama as value'])->toArray();
        /**Produks: Nantinya pengen buat cekProduk supaya dapat preventDefault form */
        $produks = Produk::orderBy('nama')->get('nama')->toArray();

        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
            'tipe'=>$tipe,
            'bahans'=>$bahans,
            'variasis'=>$variasis,
            'varians'=>$varians,
            'ukurans'=>$ukurans,
            'jahits'=>$jahits,
            'alass'=>$alass,
            'busas'=>$busas,
            'lists'=>$lists,
            'sayaps'=>$sayaps,
            'kombinasis'=>$kombinasis,
            'motifs'=>$motifs,
            'jokassies'=>$jokassies,
            'standars'=>$standars,
            'tsixpacks'=>$tsixpacks,
            'tankpads'=>$tankpads,
            'stikers'=>$stikers,
            'busastangs'=>$busastangs,
            'rols'=>$rols,
            'rotans'=>$rotans,
            'produks'=>$produks,
        ];
        return view('produk.tambah-produk-start', $data);
    }

    public function tambahProdukDB(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $success_logs = $warning_logs = $error_logs="";

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $input = $request->input();
        // dd($input);
        $harga=0;
        if (isset($input['harga']) && $input['harga']!==null) {
            $harga=$input['harga'];
        }

        /**Sebelum mulai create produk baru, cek terlebih dahulu apakah spec yang diinput memang sudah terdapat di database */
        $bahan=null;
        if ($input['bahan']) {
            $bahan = Bahan::where('nama',$input['bahan'])->first();
            if ($bahan===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Jenis bahan harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $kombinasi=null;
        if ($input['kombinasi']) {
            $kombinasi = Kombinasi::where('nama',$input['kombinasi'])->first();
            if ($kombinasi===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe kombinasi harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $motif=null;
        if ($input['motif']) {
            $motif = Motif::where('nama',$input['motif'])->first();
            if ($motif===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe motif harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $standar=null;
        if ($input['standar']) {
            $standar = Standar::where('nama',$input['standar'])->first();
            if ($standar===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe standar harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $jokassy=null;
        if ($input['jokassy']) {
            $jokassy = Jokassy::where('nama',$input['jokassy'])->first();
            if ($jokassy===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe jokassy harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $tankpad=null;
        if ($input['tankpad']) {
            $tankpad = tankpad::where('nama',$input['tankpad'])->first();
            if ($tankpad===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe tankpad harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $stiker=null;
        if ($input['stiker']) {
            $stiker = Stiker::where('nama',$input['stiker'])->first();
            if ($stiker===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe stiker harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $busastang=null;
        if ($input['busastang']) {
            $busastang = Busastang::where('nama',$input['busastang'])->first();
            if ($busastang===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe busastang harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $rotan=null;
        if ($input['rotan']) {
            $rotan = Rotan::where('nama',$input['rotan'])->first();
            if ($rotan===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe rotan harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $rol=null;
        if ($input['rol']) {
            $rol = Rol::where('nama',$input['rol'])->first();
            if ($rol===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe rol harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $varian_1=$varian_1=$varian_1_id=null;
        if ($input['variasi_1']) {
            $variasi_1 = Variasi::where('nama',$input['variasi_1'])->first();
            if ($variasi_1===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe variasi_1 harus dipilih dari yang sudah terdaftar di database.']
                );
            }
            $varian_1_id=null;
            if ($input['varian_1']) {
                $varian_1 = Varian::where('nama',$input['varian_1'])->first();$varian_1_id=$varian_1['id'];
                if ($varian_1===null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Tipe varian_1 harus dipilih dari yang sudah terdaftar di database.']
                    );
                }
                $varian_1_id=$varian_1['id'];
            }
        }
        $variasi_2=$varian_2=$varian_2_id=null;
        if ($input['variasi_2']) {
            $variasi_2 = Variasi::where('nama',$input['variasi_2'])->first();
            if ($variasi_2===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe variasi_2 harus dipilih dari yang sudah terdaftar di database.']
                );
            }
            $varian_2_id=null;
            if ($input['varian_2']) {
                $varian_2 = Varian::where('nama',$input['varian_2'])->first();$varian_2_id=$varian_2['id'];
                if ($varian_2===null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Tipe varian_2 harus dipilih dari yang sudah terdaftar di database.']
                    );
                }
                $varian_2_id=$varian_2['id'];
            }
        }
        /**SPEC */
        $grade_bahan=null;
        if ($input['grade_bahan']) {
            $grade_bahan = Spec::where('nama',$input['grade_bahan'])->first();
            if ($grade_bahan===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe grade_bahan harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $ukuran=null;
        if ($input['ukuran']) {
            $ukuran = Spec::where('nama',$input['ukuran'])->first();
            if ($ukuran===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe ukuran harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $jahit=null;
        if ($input['jahit']) {
            $jahit = Spec::where('nama',$input['jahit'])->first();
            if ($jahit===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe jahit harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $busa=null;
        if ($input['busa']) {
            $busa = Spec::where('nama',$input['busa'])->first();
            if ($busa===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe busa harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $sayap=null;
        if ($input['sayap']) {
            $sayap = Spec::where('nama',$input['sayap'])->first();
            if ($sayap===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe sayap harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $list=null;
        if ($input['list']) {
            $list = Spec::where('nama',$input['list'])->first();
            if ($list===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe list harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        $alas=null;
        if ($input['alas']) {
            $alas = Spec::where('nama',$input['alas'])->first();
            if ($alas===null) {
                $request->validate(
                    ['error'=>'required'],
                    ['error.required'=>'Tipe alas harus dipilih dari yang sudah terdaftar di database.']
                );
            }
        }
        /**End Validating Specs */


        $produk = [
            'tipe'=>$input['tipe'],
            'nama'=>$input['nama'],
            'nama_nota'=>$input['nama_nota'],
            'tipe_packing'=>$input['tipe_packing'],
            'aturan_packing'=>$input['aturan_packing'],
            'keterangan'=>$input['keterangan'],
        ];

        if ($run_db) {
            $new_produk = Produk::create($produk);
            if ($input['bahan']) {
                $produk_bahan = ['produk_id'=>$new_produk['id'],'bahan_id'=>$bahan['id']];
                $newProdukBahan = ProdukBahan::create($produk_bahan);
            }
            if ($input['kombinasi']) {
                $produk_kombinasi = ['produk_id'=>$new_produk['id'],'kombinasi_id'=>$kombinasi['id']];
                $newProdukKombinasi = ProdukKombinasi::create($produk_kombinasi);
            }
            if ($input['motif']) {
                $produk_motif = ['produk_id'=>$new_produk['id'],'motif_id'=>$motif['id']];
                $newProdukmotif = ProdukMotif::create($produk_motif);
            }
            if ($input['standar']) {
                $produk_standar = ['produk_id'=>$new_produk['id'],'standar_id'=>$standar['id']];
                $newProdukstandar = ProdukStandar::create($produk_standar);
            }
            if ($input['jokassy']) {
                $produk_jokassy = ['produk_id'=>$new_produk['id'],'jokassy_id'=>$jokassy['id']];
                $newProdukJokassy = ProdukJokassy::create($produk_jokassy);
            }
            if ($input['tankpad']) {
                $produk_tankpad = ['produk_id'=>$new_produk['id'],'tankpad_id'=>$tankpad['id']];
                $newProdukTankpad = ProdukTankpad::create($produk_tankpad);
            }
            if ($input['stiker']) {
                $produk_stiker = ['produk_id'=>$new_produk['id'],'stiker_id'=>$stiker['id']];
                $newProdukStiker = ProdukStiker::create($produk_stiker);
            }
            if ($input['busastang']) {
                $produk_busastang = ['produk_id'=>$new_produk['id'],'busastang_id'=>$busastang['id']];
                $newProdukBusastang = ProdukBusastang::create($produk_busastang);
            }
            if ($input['rotan']) {
                $produk_rotan = ['produk_id'=>$new_produk['id'],'rotan_id'=>$rotan['id']];
                $newProdukRotan = ProdukRotan::create($produk_rotan);
            }
            if ($input['rol']) {
                $produk_rol = ['produk_id'=>$new_produk['id'],'rol_id'=>$rol['id']];
                $newProdukRol = ProdukRol::create($produk_rol);
            }
            if ($input['variasi_1']) {
                $produk_variasi_varian_1 = ['produk_id'=>$new_produk['id'],'variasi_id'=>$variasi_1['id'],'varian_id'=>$varian_1_id];
                $newProdukVariasi1 = ProdukVariasiVarian::create($produk_variasi_varian_1);
            }
            if ($input['variasi_2']) {
                $produk_variasi_varian_2 = ['produk_id'=>$new_produk['id'],'variasi_id'=>$variasi_2['id'],'varian_id'=>$varian_2_id];
                $newProdukVariasi1 = ProdukVariasiVarian::create($produk_variasi_varian_2);
            }
            /**SPEC */
            if ($input['grade_bahan']) {
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$grade_bahan['id']];
                $newProdukSpecGrade = ProdukSpec::create($produk_spec);
            }
            if ($input['ukuran']) {
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$ukuran['id']];
                $newProdukSpecUkuran = ProdukSpec::create($produk_spec);
            }
            if ($input['jahit']) {
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$jahit['id']];
                $newProdukSpecJahit = ProdukSpec::create($produk_spec);
            }
            if ($input['busa']) {
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$busa['id']];
                $newProdukSpecBusa = ProdukSpec::create($produk_spec);
            }
            if ($input['sayap']) {
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$sayap['id']];
                $newProdukSpecSayap = ProdukSpec::create($produk_spec);
            }
            if ($input['list']) {
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$list['id']];
                $newProdukSpecList = ProdukSpec::create($produk_spec);
            }
            if ($input['alas']) {
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$alas['id']];
                $newProdukSpecAlas = ProdukSpec::create($produk_spec);
            }
            /**END SPEC */
            $success_logs.="Berhasil input produk baru ke database!";

            /**Harga */
            $produk_harga=ProdukHarga::create([
                'produk_id'=>$new_produk['id'],
                'harga'=>$harga,
                'status'=>'DEFAULT',
            ]);
            $success_logs.="Berhasil menetapkan harga produk menjadi Rp. $harga,-";

            $load_num->value += 1;
            $load_num->save();

            $main_log="SUCCESS";

        }


        // $route='produks';
        // $route_btn='Ke Daftar Produk';
        // $params=null;
        // $data = [
        //     'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
        //     'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        // ];

        // return view('layouts.db-result', $data);
        return redirect()->route('produks')->with(['_success'=>$success_logs]);
    }

    public function getSpesifikasiProduk(Request $request)
    {
        $produk_id = $request->query('produk_id');
        $bahan = Produk::find($produk_id)->bahan->toArray();if (count($bahan)===0) {$bahan=null;}else{$bahan=$bahan[0];}
        $kombinasi = Produk::find($produk_id)->kombinasi->toArray();if (count($kombinasi)===0) {$kombinasi=null;}else{$kombinasi=$kombinasi[0];}
        $tsixpack = Produk::find($produk_id)->tsixpack->toArray();if (count($tsixpack)===0) {$tsixpack=null;}else{$tsixpack=$tsixpack[0];}
        $japstyle = Produk::find($produk_id)->japstyle->toArray();if (count($japstyle)===0) {$japstyle=null;}else{$japstyle=$japstyle[0];}
        $motif = Produk::find($produk_id)->motif->toArray();if (count($motif)===0) {$motif=null;}else{$motif=$motif[0];}
        $standar = Produk::find($produk_id)->standar->toArray();if (count($standar)===0) {$standar=null;}else{$standar=$standar[0];}
        $tankpad = Produk::find($produk_id)->tankpad->toArray();if (count($tankpad)===0) {$tankpad=null;}else{$tankpad=$tankpad[0];}
        $stiker = Produk::find($produk_id)->stiker->toArray();if (count($stiker)===0) {$stiker=null;}else{$stiker=$stiker[0];}
        $busastang = Produk::find($produk_id)->busastang->toArray();if (count($busastang)===0) {$busastang=null;}else{$busastang=$busastang[0];}
        $rol = Produk::find($produk_id)->rol->toArray();if (count($rol)===0) {$rol=null;}else{$rol=$rol[0];}
        $rotan = Produk::find($produk_id)->rotan->toArray();if (count($rotan)===0) {$rotan=null;}else{$rotan=$rotan[0];}
        $specs = Produk::find($produk_id)->specs->toArray();if (count($specs)===0) {$specs=null;}
        $variasis = $varians = array();
        $variasi_varians = ProdukVariasiVarian::where('produk_id', $produk_id)->get()->toArray();
        $i=0;
        if (count($variasi_varians) !== 0) {
            foreach ($variasi_varians as $variasi_varian) {
                $variasi = Variasi::find($variasi_varian['variasi_id'])->toArray();
                $varian = null;
                if ($variasi_varian['varian_id']!==null) {
                    $varian = Varian::find($variasi_varian['varian_id'])->toArray();
                }
                $variasis[]=$variasi;
                $varians[]=$varian;
                $i++;
            }
        } else {
            $variasis = $varians = null;
        }

        $data =[
            'bahan'=>$bahan,
            'kombinasi'=>$kombinasi,
            'tsixpack'=>$tsixpack,
            'japstyle'=>$japstyle,
            'motif'=>$motif,
            'standar'=>$standar,
            'tankpad'=>$tankpad,
            'stiker'=>$stiker,
            'busastang'=>$busastang,
            'rol'=>$rol,
            'rotan'=>$rotan,
            'specs'=>$specs,
            'variasis'=>$variasis,
            'varians'=>$varians,
        ];

        // dd($data);

        return $data;
    }

    public function produk_detail(Request $request)
    {
        SiteSettings::loadNumToZero();
        $get = $request->query();

        // dd($get);
        $produk_id=$get['produk_id'];
        $produk=Produk::find($produk_id);
        // // Cari semua properti produk
        // $produk_hargas=ProdukHarga::where('produk_id',$produk['id'])->get();
        // $bahans=Bahan::where('produk_id',$produk['id'])->get();
        // $produk_variasi_varians=ProdukVariasiVarian::where('produk_id',$produk['id'])->get();
        // $variasis=$varians=array();
        // if (count($produk_variasi_varians)!==0) {
        //     foreach ($produk_variasi_varians as $produk_variasi_varian) {
        //         $variasi=Variasi::find($produk_variasi_varian['variasi_id']);
        //         $varian=null;
        //         if ($produk_variasi_varian['varian_id']!==null) {
        //             $varian=Varian::find($produk_variasi_varian['varian_id']);
        //         }
        //         $variasis[]=$variasi;
        //         $varians[]=$varian;
        //     }
        // }
        // // Specs
        // $produk_specs=ProdukSpec::where('produk_id',$produk['id'])->get();
        // $specs=array();
        // if (count($produk_specs)!==0) {
        //     foreach ($produk_specs as $produk_spec) {
        //         $spec=Spec::find($produk_spec['spec_id']);
        //     }
        //     $specs[]=$spec;
        // }
        // $grade_bahan=$ukuran=$jahit=$list=null;
        // if (count($specs)!==0) {
        //     foreach ($specs as $spec) {
        //         if ($spec['kategori']==='grade_bahan') {
        //             $grade_bahan=$spec['nama'];
        //         } elseif ($spec['kategori']==='ukuran') {
        //             $ukuran=$spec['nama'];
        //         } elseif ($spec['kategori']==='jahit') {
        //             $jahit=$spec['nama'];
        //         } elseif ($spec['kategori']='list') {
        //             $list=$spec['list'];
        //         }
        //     }
        // }
        // // Kombinasi

        $produk_components=Produk::getProdukComponents($produk['id']);



        $menus=[
            ['route'=>'deleteProduct','nama'=>'Hapus','method'=>'POST','params'=>[['name'=>'produk_id','value'=>$produk['id']],],'confirm'=>'Anda yakin ingin menghapus produk ini?'],
        ];
        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'produk' => $produk,
            'produk_components' => $produk_components,
            'menus' => $menus,
        ];
        // dd($data);
        // dump($data);
        return view('produk.produk_detail', $data);
    }

    public function deleteProduct(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $success_logs = $warning_logs = $error_logs = array();
        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->input();
        // dd($post);
        $produk_id=$post['produk_id'];

        if ($run_db) {
            $produk=Produk::find($produk_id);
            $produk->delete();

            $success_logs[]="Berhasil menghapus produk";

            $load_num->value += 1;
            $load_num->save();

            $main_log="SUCCESS";

        }


        $route='produks';
        $route_btn='Ke Daftar Produk';
        $params=null;
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }
}
