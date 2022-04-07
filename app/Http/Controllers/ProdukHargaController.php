<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProdukHargaRequest;
use App\Http\Requests\UpdateProdukHargaRequest;
use App\Models\ProdukHarga;

class ProdukHargaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StoreProdukHargaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProdukHargaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ProdukHarga  $produkHarga
     * @return \Illuminate\Http\Response
     */
    public function show(ProdukHarga $produkHarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProdukHarga  $produkHarga
     * @return \Illuminate\Http\Response
     */
    public function edit(ProdukHarga $produkHarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProdukHargaRequest  $request
     * @param  \App\Models\ProdukHarga  $produkHarga
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProdukHargaRequest $request, ProdukHarga $produkHarga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProdukHarga  $produkHarga
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProdukHarga $produkHarga)
    {
        //
    }
}
