<?php

namespace App\Http\Controllers;

use App\Models\Ekspedisi;
use App\Http\Requests\StoreEkspedisiRequest;
use App\Http\Requests\UpdateEkspedisiRequest;
use App\Models\Alamat;
use App\Models\EkspedisiAlamat;
use App\Models\Kontak;
use App\Models\SiteSetting;
use Exception;
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

        $ekspedisis = Ekspedisi::orderBy('nama')->get();
        $alamats=$kontaks=array();
        foreach ($ekspedisis as $ekspedisi) {
            $ekspedisi_alamat=EkspedisiAlamat::where('ekspedisi_id',$ekspedisi['id'])->where('tipe','UTAMA')->first();
            if ($ekspedisi_alamat!==null) {
                $alamat=Alamat::find($ekspedisi_alamat['alamat_id']);
                $alamats[]=$alamat;
            } else {
                $alamats[]=null;
            }

            $kontak=Kontak::where('ekspedisi_id',$ekspedisi['id'])->where('is_aktual','yes')->first();
            if ($kontak!==null) {
                $kontaks[]=$kontak;
            } else {
                $kontaks[]=null;
            }
        }

        $menus=[
            ['route'=>'NewEkspedisi','nama'=>'+ Ekspedisi','method'=>'get'],
        ];

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'ekspedisis' => $ekspedisis,
            'alamats' => $alamats,
            'kontaks' => $kontaks,
            'menus' => $menus,
        ];
        // for ($i=0; $i < count($alamats); $i++) {
        //     if ($alamats[$i]!==null) {
        //         if ($alamats[$i]['long']!==null) {
        //             dump($alamats[$i]['id']);
        //             try {
        //                 foreach (json_decode($alamats[$i]['long'],true) as $alamat) {
        //                     echo $alamat;
        //                 }
        //             } catch (Exception $e) {
        //                 echo $e->getMessage();
        //             }
        //         }
        //     }
        // }
        // dd($data);
        return view('ekspedisi.ekspedisis', $data);
    }

    public function ekspedisi_detail(Request $request)
    {
        $load_num = SiteSetting::find(1);
        if ($load_num !== 0) {
            $load_num->value = 0;
            $load_num->save();
        }

        $get = $request->query();

        // dd($get);

        $ekspedisi = Ekspedisi::find($get['ekspedisi_id']);
        $ekspedisi_alamats=EkspedisiAlamat::where('ekspedisi_id',$ekspedisi['id'])->get();
        $alamats =array();
        foreach ($ekspedisi_alamats as $ekspedisi_alamat) {
            $alamat=Alamat::find($ekspedisi_alamat['alamat_id']);
            $alamats[]=$alamat;
        }
        $kontaks=Kontak::where('ekspedisi_id',$ekspedisi['id'])->get();

        $menus=[
            ['route'=>'EditEkspedisi','nama'=>'Edit','method'=>'get','params'=>[['name'=>'ekspedisi_id','value'=>$ekspedisi['id']],]],
            ['route'=>'ekspedisi_tambah_alamat','nama'=>'+Alamat','method'=>'get','params'=>[['name'=>'ekspedisi_id','value'=>$ekspedisi['id']],]],
            ['route'=>'ekspedisi_tambah_kontak','nama'=>'+Kontak','method'=>'get','params'=>[['name'=>'ekspedisi_id','value'=>$ekspedisi['id']],]],
            ['route'=>'HapusEkspedisi','nama'=>'Hapus','method'=>'post','params'=>[['name'=>'ekspedisi_id','value'=>$ekspedisi['id']],],'confirm'=>'Anda yakin ingin menghapus Ekspedisi ini?'],
        ];

        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
            'menus' => $menus,
            'ekspedisi' => $ekspedisi,
            'ekspedisi_alamats' => $ekspedisi_alamats,
            'alamats' => $alamats,
            'kontaks' => $kontaks,
        ];
        // dump($data);
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
