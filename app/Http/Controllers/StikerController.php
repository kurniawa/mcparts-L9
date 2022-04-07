<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStikerRequest;
use App\Http\Requests\UpdateStikerRequest;
use App\Models\Stiker;

class StikerController extends Controller
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
     * @param  \App\Http\Requests\StoreStikerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreStikerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stiker  $stiker
     * @return \Illuminate\Http\Response
     */
    public function show(Stiker $stiker)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stiker  $stiker
     * @return \Illuminate\Http\Response
     */
    public function edit(Stiker $stiker)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateStikerRequest  $request
     * @param  \App\Models\Stiker  $stiker
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateStikerRequest $request, Stiker $stiker)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stiker  $stiker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stiker $stiker)
    {
        //
    }
}
