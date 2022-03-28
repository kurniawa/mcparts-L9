<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDaerahRequest;
use App\Http\Requests\UpdateDaerahRequest;
use App\Models\Daerah;

class DaerahController extends Controller
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
     * @param  \App\Http\Requests\StoreDaerahRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDaerahRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Daerah  $daerah
     * @return \Illuminate\Http\Response
     */
    public function show(Daerah $daerah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Daerah  $daerah
     * @return \Illuminate\Http\Response
     */
    public function edit(Daerah $daerah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateDaerahRequest  $request
     * @param  \App\Models\Daerah  $daerah
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDaerahRequest $request, Daerah $daerah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Daerah  $daerah
     * @return \Illuminate\Http\Response
     */
    public function destroy(Daerah $daerah)
    {
        //
    }
}
