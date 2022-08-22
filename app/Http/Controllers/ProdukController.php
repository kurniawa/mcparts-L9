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
use App\Models\Rol;
use App\Models\Rotan;
use App\Models\Spec;
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
        $data = [
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

        $data = [
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
        ];
        return view('produk.tambah-produk-start', $data);
    }

    public function cekProduk(Request $request)
    {
        $get = $request->query();
        $produk = Produk::where('nama',$get['nama'])->first();
        return $produk;
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
     * @param  \App\Http\Requests\StoreProdukRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdukRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function show(Produk $produk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function edit(Produk $produk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdukRequest  $request
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdukRequest $request, Produk $produk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Produk  $produk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produk $produk)
    {
        //
    }
}
