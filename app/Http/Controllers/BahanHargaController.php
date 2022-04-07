<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBahanHargaRequest;
use App\Http\Requests\UpdateBahanHargaRequest;
use App\Models\BahanHarga;

class BahanHargaController extends Controller
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
     * @param  \App\Http\Requests\StoreBahanHargaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBahanHargaRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BahanHarga  $bahanHarga
     * @return \Illuminate\Http\Response
     */
    public function show(BahanHarga $bahanHarga)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BahanHarga  $bahanHarga
     * @return \Illuminate\Http\Response
     */
    public function edit(BahanHarga $bahanHarga)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateBahanHargaRequest  $request
     * @param  \App\Models\BahanHarga  $bahanHarga
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateBahanHargaRequest $request, BahanHarga $bahanHarga)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BahanHarga  $bahanHarga
     * @return \Illuminate\Http\Response
     */
    public function destroy(BahanHarga $bahanHarga)
    {
        //
    }
}
