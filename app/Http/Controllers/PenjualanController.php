<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Ekspedisi;
use App\Models\Nota;
use App\Models\Pelanggan;
use App\Models\PenjualanHelper;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\Srjalan;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class PenjualanController extends Controller
{
    public function index(Request $request)
    {
        SiteSettings::loadNumToZero();
        // Definisi Tahun
        $tahun_now=date('Y');
        $tahun_awal=(int)$tahun_now-20;
        for ($i=0; $i < 100; $i++) {
            $arr_tahun[]=$tahun_awal+$i;
        }
        // Definisi Bulan
        $bulan_now=date('m');
        for ($i=1; $i < 13; $i++) {
            $arr_bulan[]=$i;
        }
        // Definisi Tanggal
        $tanggal_now=date('d');
        for ($i=1; $i < 32; $i++) {
            $arr_tanggal[]=$i;
        }

        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
            'tahun_now'=>$tahun_now,
            'arr_tahun'=>$arr_tahun,
            'bulan_now'=>$bulan_now,
            'arr_bulan'=>$arr_bulan,
            'tanggal_now'=>$tanggal_now,
            'arr_tanggal'=>$arr_tanggal,
        ];
        // dd($data);
        return view('penjualan.penjualan', $data);
    }

    public function saleBasedOnFilter(Request $request)
    {
        SiteSettings::loadNumToZero();
        // Definisi Tahun
        $tahun_now=date('Y');
        $tahun_awal=(int)$tahun_now-20;
        for ($i=0; $i < 100; $i++) {
            $arr_tahun[]=$tahun_awal+$i;
        }
        // Definisi Bulan
        $bulan_now=date('m');
        for ($i=1; $i < 13; $i++) {
            $arr_bulan[]=$i;
        }
        // Definisi Tanggal
        $tanggal_now=date('d');
        for ($i=1; $i < 32; $i++) {
            $arr_tanggal[]=$i;
        }

        $get=$request->query();
        // dd($get);
        $tahun_set=$get['tahun'];
        $bulan_set=$get['bulan'];
        $tanggal_set=$get['tanggal'];
        $detail=null;
        if (isset($get['detail'])) {
            $detail=$get['detail'];
        }

        if ($bulan_set=='all' && $tanggal_set=='all') {
            $notas=Nota::whereYear('created_at',$tahun_set)->orderBy('pelanggan_id')->get();
        } else if ($bulan_set=='all' && $tanggal_set!=='all') {
            $notas=Nota::whereYear('created_at',$tahun_set)->whereDay('created_at',$tanggal_set)->orderBy('pelanggan_id')->get();
        } else if($bulan_set!=='all' && $tanggal_set!=='all'){
            $notas=Nota::whereYear('created_at',$tahun_set)->whereMonth('created_at',$bulan_set)->whereDay('created_at',$tanggal_set)->orderBy('pelanggan_id')->get();
        } else {
            $notas=Nota::whereYear('created_at',$tahun_set)->whereMonth('created_at',$bulan_set)->orderBy('pelanggan_id')->get();
        }

        $sales_components=PenjualanHelper::getSalesComponents($notas);

        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
            'tahun_now'=>$tahun_set,
            'arr_tahun'=>$arr_tahun,
            'bulan_now'=>$bulan_set,
            'arr_bulan'=>$arr_bulan,
            'tanggal_now'=>$tanggal_set,
            'arr_tanggal'=>$arr_tanggal,
            'tahun_set'=>$tahun_set,
            'bulan_set'=>$bulan_set,
            'tanggal_set'=>$tanggal_set,
            'notas'=>$notas,
            'sales_components'=>$sales_components,
        ];
        // dd($data);
        dump($data);
        return view('penjualan.penjualan', $data);
    }
}
