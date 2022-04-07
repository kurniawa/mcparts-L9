<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTankpadRequest;
use App\Http\Requests\UpdateTankpadRequest;
use App\Models\Tankpad;

class TankpadController extends Controller
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
     * @param  \App\Http\Requests\StoreTankpadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTankpadRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tankpad  $tankpad
     * @return \Illuminate\Http\Response
     */
    public function show(Tankpad $tankpad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tankpad  $tankpad
     * @return \Illuminate\Http\Response
     */
    public function edit(Tankpad $tankpad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTankpadRequest  $request
     * @param  \App\Models\Tankpad  $tankpad
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTankpadRequest $request, Tankpad $tankpad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tankpad  $tankpad
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tankpad $tankpad)
    {
        //
    }
}
