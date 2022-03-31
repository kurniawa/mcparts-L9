<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Http\Requests\StorePelangganResellerRequest;
use App\Http\Requests\UpdatePelangganResellerRequest;
use App\Models\Pelanggan;
use App\Models\PelangganReseller;
use Illuminate\Http\Request;

class PelangganResellerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        /**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        $load_num = SiteSettings::loadNumToZero();

        $show_dump = true; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $show_hidden_dump = true;

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        $get = $request->query();

        if ($show_dump) {
            dump('$get:');
            dd($get);
        }

        $pelanggan = Pelanggan::find($get['pelanggan_id']);

        $data = [
            'pelanggan' => $pelanggan,
        ];

        return view('pelanggan.tetapkan-reseller', $data);
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
     * @param  \App\Http\Requests\StorePelangganResellerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePelangganResellerRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PelangganReseller  $pelangganReseller
     * @return \Illuminate\Http\Response
     */
    public function show(PelangganReseller $pelangganReseller)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PelangganReseller  $pelangganReseller
     * @return \Illuminate\Http\Response
     */
    public function edit(PelangganReseller $pelangganReseller)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePelangganResellerRequest  $request
     * @param  \App\Models\PelangganReseller  $pelangganReseller
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePelangganResellerRequest $request, PelangganReseller $pelangganReseller)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PelangganReseller  $pelangganReseller
     * @return \Illuminate\Http\Response
     */
    public function destroy(PelangganReseller $pelangganReseller)
    {
        //
    }
}
