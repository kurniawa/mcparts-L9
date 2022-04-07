<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStandarRequest;
use App\Http\Requests\UpdateStandarRequest;
use App\Models\Standar;

class StandarController extends Controller
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
     * @param  \App\Http\Requests\StoreStandarRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStandarRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Standar  $standar
     * @return \Illuminate\Http\Response
     */
    public function show(Standar $standar)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Standar  $standar
     * @return \Illuminate\Http\Response
     */
    public function edit(Standar $standar)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStandarRequest  $request
     * @param  \App\Models\Standar  $standar
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStandarRequest $request, Standar $standar)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Standar  $standar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Standar $standar)
    {
        //
    }
}
