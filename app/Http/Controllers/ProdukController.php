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
            ['route'=>'tambah-produk','nama'=>'+Tambah Produk'],
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
        $ukurans = Spec::where('kategori','ukuran')->get(['nama as label','nama as value'])->toArray();
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
        $standars = Spec::where('kategori','standar')->get(['nama as label','nama as value'])->toArray();
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

        // $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        // $ada_error = true;
        // $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';
        // $class_div_pesan_db = 'alert-danger';
        $success_logs = $warning_logs = $error_logs = array();

        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs[] = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
            // $ada_error = true;
            // $class_div_pesan_db = 'alert-danger';
        }

        $input = $request->input();
        // dump('$input', $input);

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
                $bahan = Bahan::where('nama',$input['bahan'])->first()->toArray();
                $produk_bahan = ['produk_id'=>$new_produk['id'],'bahan_id'=>$bahan['id']];
                $newProdukBahan = ProdukBahan::create($produk_bahan);
            }
            if ($input['kombinasi']) {
                $kombinasi = Kombinasi::where('nama',$input['kombinasi'])->first()->toArray();
                $produk_kombinasi = ['produk_id'=>$new_produk['id'],'kombinasi_id'=>$kombinasi['id']];
                $newProdukKombinasi = ProdukKombinasi::create($produk_kombinasi);
            }
            if ($input['motif']) {
                $motif = Motif::where('nama',$input['motif'])->first()->toArray();
                $produk_motif = ['produk_id'=>$new_produk['id'],'motif_id'=>$motif['id']];
                $newProdukmotif = ProdukMotif::create($produk_motif);
            }
            if ($input['standar']) {
                $standar = Standar::where('nama',$input['standar'])->first()->toArray();
                $produk_standar = ['produk_id'=>$new_produk['id'],'standar_id'=>$standar['id']];
                $newProdukstandar = ProdukStandar::create($produk_standar);
            }
            if ($input['jokassy']) {
                $jokassy = Jokassy::where('nama',$input['jokassy'])->first()->toArray();
                $produk_jokassy = ['produk_id'=>$new_produk['id'],'jokassy_id'=>$jokassy['id']];
                $newProdukJokassy = ProdukJokassy::create($produk_jokassy);
            }
            if ($input['tankpad']) {
                $tankpad = tankpad::where('nama',$input['tankpad'])->first()->toArray();
                $produk_tankpad = ['produk_id'=>$new_produk['id'],'tankpad_id'=>$tankpad['id']];
                $newProdukTankpad = ProdukTankpad::create($produk_tankpad);
            }
            if ($input['stiker']) {
                $stiker = Stiker::where('nama',$input['stiker'])->first()->toArray();
                $produk_stiker = ['produk_id'=>$new_produk['id'],'stiker_id'=>$stiker['id']];
                $newProdukStiker = ProdukStiker::create($produk_stiker);
            }
            if ($input['busastang']) {
                $busastang = Busastang::where('nama',$input['busastang'])->first()->toArray();
                $produk_busastang = ['produk_id'=>$new_produk['id'],'busastang_id'=>$busastang['id']];
                $newProdukBusastang = ProdukBusastang::create($produk_busastang);
            }
            if ($input['rotan']) {
                $rotan = Rotan::where('nama',$input['rotan'])->first()->toArray();
                $produk_rotan = ['produk_id'=>$new_produk['id'],'rotan_id'=>$rotan['id']];
                $newProdukRotan = ProdukRotan::create($produk_rotan);
            }
            if ($input['rol']) {
                $rol = Rol::where('nama',$input['rol'])->first()->toArray();
                $produk_rol = ['produk_id'=>$new_produk['id'],'rol_id'=>$rol['id']];
                $newProdukRol = ProdukRol::create($produk_rol);
            }
            if ($input['variasi_1']) {
                $variasi_1 = Variasi::where('nama',$input['variasi_1'])->first()->toArray();
                $varian_1_id=null;
                if ($input['varian_1']) {$varian_1 = Varian::where('nama',$input['varian_1'])->first()->toArray();$varian_1_id=$varian_1['id'];}
                $produk_variasi_varian_1 = ['produk_id'=>$new_produk['id'],'variasi_id'=>$variasi_1['id'],'varian_id'=>$varian_1_id];
                $newProdukVariasi1 = ProdukVariasiVarian::create($produk_variasi_varian_1);
            }
            if ($input['variasi_2']) {
                $variasi_2 = Variasi::where('nama',$input['variasi_2'])->first()->toArray();
                $varian_2_id=null;
                if ($input['varian_2']) {$varian_2 = Varian::where('nama',$input['varian_2'])->first()->toArray();$varian_2_id=$varian_2['id'];}
                $produk_variasi_varian_2 = ['produk_id'=>$new_produk['id'],'variasi_id'=>$variasi_2['id'],'varian_id'=>$varian_2_id];
                $newProdukVariasi1 = ProdukVariasiVarian::create($produk_variasi_varian_2);
            }
            /**SPEC */
            if ($input['grade_bahan']) {
                $spec = Spec::where('nama',$input['grade_bahan'])->first()->toArray();
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$spec['id']];
                $newProdukSpecGrade = ProdukSpec::create($produk_spec);
            }
            if ($input['ukuran']) {
                $spec = Spec::where('nama',$input['ukuran'])->first()->toArray();
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$spec['id']];
                $newProdukSpecUkuran = ProdukSpec::create($produk_spec);
            }
            if ($input['jahit']) {
                $spec = Spec::where('nama',$input['jahit'])->first()->toArray();
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$spec['id']];
                $newProdukSpecJahit = ProdukSpec::create($produk_spec);
            }
            if ($input['busa']) {
                $spec = Spec::where('nama',$input['busa'])->first()->toArray();
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$spec['id']];
                $newProdukSpecBusa = ProdukSpec::create($produk_spec);
            }
            if ($input['sayap']) {
                $spec = Spec::where('nama',$input['sayap'])->first()->toArray();
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$spec['id']];
                $newProdukSpecSayap = ProdukSpec::create($produk_spec);
            }
            if ($input['list']) {
                $spec = Spec::where('nama',$input['list'])->first()->toArray();
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$spec['id']];
                $newProdukSpecList = ProdukSpec::create($produk_spec);
            }
            if ($input['alas']) {
                $spec = Spec::where('nama',$input['alas'])->first()->toArray();
                $produk_spec = ['produk_id'=>$new_produk['id'],'spec_id'=>$spec['id']];
                $newProdukSpecAlas = ProdukSpec::create($produk_spec);
            }
            /**END SPEC */
            $success_logs[] = 'Berhasil input produk baru ke database!';
            $load_num->value += 1;
            $load_num->save();
        }


        $data = [
            'navbar_bg'=>'bg-color-orange-2',
            'route'=>'produks',
            'route_btn'=>'Ke Daftar Produk',
            'success_logs'=>$success_logs,
            'warning_logs'=>$warning_logs,
            'error_logs'=>$error_logs,
        ];

        return view('layouts.db-result', $data);
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

        dd($get);

        // $menus=[
        //     ['route'=>'PrintOutNota','nama'=>'Print Out','method'=>'get','params'=>[['name'=>'nota_id','value'=>$nota['id']],]],
        // ];
        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
        ];
        // dd($data);
        // dump($data);
        return view('produk.produk_detail', $data);
    }
}
