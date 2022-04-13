<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Http\Requests\StoreSpkRequest;
use App\Http\Requests\UpdateSpkRequest;
use App\Models\Daerah;
use App\Models\Pelanggan;
use App\Models\Spk;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class SpkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        $load_num = SiteSettings::loadNumToZero();

        $show_dump = false; // false apabila mode production, supaya tidak terlihat berantakan oleh customer
        $show_hidden_dump = false;

        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        $spks = Spk::limit(100)->orderByDesc('created_at')->get();
        $pelanggans = array();
        $daerahs = array();
        $resellers = array();
        $arr_spk_produks = array();
        $arr_produks = array();
        for ($i = 0; $i < count($spks); $i++) {
            $spk = Spk::find($spks[$i]->id);
            $pelanggan = $spk->pelanggan;
            $daerah = Daerah::find($pelanggan['daerah_id']);
            if ($spks[$i]->reseller_id !== null && $spks[$i]->reseller_id !== '') {
                $reseller = Pelanggan::find($spks[$i]->reseller_id);
                array_push($resellers, $reseller);
            } else {
                array_push($resellers, 'none');
            }
            $produks = $spk->produks;
            $spk_produks = $spk->spk_produks;
            array_push($arr_produks, $produks);
            array_push($arr_spk_produks, $produks);
            array_push($pelanggans, $pelanggan);
            array_push($daerahs, $daerah);
        }

        $data = [
            'spks' => $spks,
            'pelanggans' => $pelanggans,
            'daerahs' => $daerahs,
            'resellers' => $resellers,
            'arr_produks' => $arr_produks,
            'arr_spk_produks' => $arr_spk_produks,
        ];

        return view('spk.spks', $data);
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
     * @param  \App\Http\Requests\StoreSpkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSpkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function show(Spk $spk)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function edit(Spk $spk)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSpkRequest  $request
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSpkRequest $request, Spk $spk)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Spk  $spk
     * @return \Illuminate\Http\Response
     */
    public function destroy(Spk $spk)
    {
        //
    }
}
