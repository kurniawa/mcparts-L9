<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use App\Http\Requests\StoreEkspedisiRequest;
use App\Http\Requests\UpdateEkspedisiRequest;
use App\Models\SiteSetting;
use Illuminate\Http\Request;

class EkspedisiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }

        $ekspedisis = Ekspedisi::orderBy('nama')->get();

        if ($show_dump === true) {
            dump('ekspedisis');
            dump($ekspedisis);
        }

        $data = [
            'ekspedisis' => $ekspedisis,
        ];

        return view('ekspedisi.ekspedisis', $data);
    }

    public function ekspedisi_detail(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $show_dump = true; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $run_db = false; // true apabila siap melakukan CRUD ke DB
        $load_num_ignore = true; // false apabila proses CRUD sudah sesuai dengan ekspektasi. Ini mencegah apabila terjadi reload page.
        $show_hidden_dump = true;

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }

        $get = $request->input();

        if ($show_dump === true) {
            dump("get:");
            dd($get);
        }

        $data = [];

        return view('ekspedisi.ekspedisi-detail', $data);
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
     * @param  \App\Http\Requests\StoreEkspedisiRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreEkspedisiRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Ekspedisi  $ekspedisi
     * @return \Illuminate\Http\Response
     */
    public function show(Ekspedisi $ekspedisi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Ekspedisi  $ekspedisi
     * @return \Illuminate\Http\Response
     */
    public function edit(Ekspedisi $ekspedisi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateEkspedisiRequest  $request
     * @param  \App\Models\Ekspedisi  $ekspedisi
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateEkspedisiRequest $request, Ekspedisi $ekspedisi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Ekspedisi  $ekspedisi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ekspedisi $ekspedisi)
    {
        //
    }
}
