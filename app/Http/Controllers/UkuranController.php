<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUkuranRequest;
use App\Http\Requests\UpdateUkuranRequest;
use App\Models\Ukuran;

class UkuranController extends Controller
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
     * @param  \App\Http\Requests\StoreUkuranRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUkuranRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function show(Ukuran $ukuran)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function edit(Ukuran $ukuran)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateUkuranRequest  $request
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUkuranRequest $request, Ukuran $ukuran)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ukuran  $ukuran
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ukuran $ukuran)
    {
        //
    }
}
