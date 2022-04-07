<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreJahitRequest;
use App\Http\Requests\UpdateJahitRequest;
use App\Models\Jahit;

class JahitController extends Controller
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
     * @param  \App\Http\Requests\StoreJahitRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreJahitRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jahit  $jahit
     * @return \Illuminate\Http\Response
     */
    public function show(Jahit $jahit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jahit  $jahit
     * @return \Illuminate\Http\Response
     */
    public function edit(Jahit $jahit)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateJahitRequest  $request
     * @param  \App\Models\Jahit  $jahit
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateJahitRequest $request, Jahit $jahit)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jahit  $jahit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jahit $jahit)
    {
        //
    }
}
