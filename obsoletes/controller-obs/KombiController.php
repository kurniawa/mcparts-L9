<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreKombiRequest;
use App\Http\Requests\UpdateKombiRequest;
use App\Models\Kombi;

class KombiController extends Controller
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
     * @param  \App\Http\Requests\StoreKombiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreKombiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kombi  $kombi
     * @return \Illuminate\Http\Response
     */
    public function show(Kombi $kombi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Kombi  $kombi
     * @return \Illuminate\Http\Response
     */
    public function edit(Kombi $kombi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateKombiRequest  $request
     * @param  \App\Models\Kombi  $kombi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateKombiRequest $request, Kombi $kombi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Kombi  $kombi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Kombi $kombi)
    {
        //
    }
}
