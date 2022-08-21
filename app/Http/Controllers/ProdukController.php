<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use App\Models\Bahan;
use App\Models\Produk;
use App\Models\Spec;
use App\Models\Varian;
use App\Models\Variasi;

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
        $show_dump = true;

        $data = [];

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
        $bahans = Bahan::get(['nama as label','nama as value','grade']);
        $variasis = Variasi::all();
        $varians = Varian::get(['nama as label', 'nama as value']);
        $ukurans = Spec::where('kategori','ukuran')->get(['nama as label','nama as value'])->toArray();
        $jahits = Spec::where('kategori','jahit')->get(['nama as label','nama as value'])->toArray();
        $alass = Spec::where('kategori','alas')->get(['nama as label','nama as value'])->toArray();
        $busas = Spec::where('kategori','busa')->get(['nama as label','nama as value'])->toArray();
        $lists = Spec::where('kategori','list')->get(['nama as label','nama as value'])->toArray();
        $sayaps = Spec::where('kategori','sayap')->get(['nama as label','nama as value'])->toArray();
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
        ];
        return view('produk.tambah-produk-start', $data);
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
