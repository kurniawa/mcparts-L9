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
        $get = $request->query();
        $notas = collect();
        if (isset($get['filter'])) {
            $tahun_set=$get['tahun'];
            $bulan_set=$get['bulan'];
            $tanggal_set=$get['tanggal'];


            if ($bulan_set=='all' && $tanggal_set=='all') {
                $notas=Nota::whereYear('created_at',$tahun_set)->orderBy('pelanggan_id')->get();
            } else if ($bulan_set=='all' && $tanggal_set!=='all') {
                $notas=Nota::whereYear('created_at',$tahun_set)->whereDay('created_at',$tanggal_set)->orderBy('pelanggan_id')->get();
            } else if($bulan_set!=='all' && $tanggal_set!=='all'){
                $notas=Nota::whereYear('created_at',$tahun_set)->whereMonth('created_at',$bulan_set)->whereDay('created_at',$tanggal_set)->orderBy('pelanggan_id')->get();
            } else {
                $notas=Nota::whereYear('created_at',$tahun_set)->whereMonth('created_at',$bulan_set)->orderBy('pelanggan_id')->get();
            }
        } else {
            // Definisi Tahun
            $tahun_set=date('Y');
            $tahun_awal=(int)$tahun_set-20;
            for ($i=0; $i < 100; $i++) {
                $arr_tahun[]=$tahun_awal+$i;
            }
            // Definisi Bulan
            $bulan_set=date('m');
            for ($i=1; $i < 13; $i++) {
                $arr_bulan[]=$i;
            }
            // Definisi Tanggal
            $tanggal_set=date('d');
            for ($i=1; $i < 32; $i++) {
                $arr_tanggal[]=$i;
            }
        }
        // Definisi Tahun
        $tahun_set=date('Y');
        $tahun_awal=(int)$tahun_set-20;
        for ($i=0; $i < 100; $i++) {
            $arr_tahun[]=$tahun_awal+$i;
        }
        // Definisi Bulan
        $bulan_set=date('m');
        for ($i=1; $i < 13; $i++) {
            $arr_bulan[]=$i;
        }
        // Definisi Tanggal
        $tanggal_set=date('d');
        for ($i=1; $i < 32; $i++) {
            $arr_tanggal[]=$i;
        }

        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
            'tahun_set'=>$tahun_set,
            'arr_tahun'=>$arr_tahun,
            'bulan_set'=>$bulan_set,
            'arr_bulan'=>$arr_bulan,
            'tanggal_set'=>$tanggal_set,
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

        list($pelanggan_namas_unique,$penjualan_totals,$grand_total,$notasXsubtotal,$notaXdetail_item)=PenjualanHelper::getSalesComponents($notas);

        /**Format bulan dan tanggal minimal 2 digit */
        $bulan_2_digit=$bulan_set;
        if (strlen($bulan_set)===1) {
            $bulan_2_digit="0$bulan_set";
        }
        $tanggal_2_digit=$tanggal_set;
        if (strlen($tanggal_set)===1) {
            $tanggal_2_digit="0$tanggal_set";
        }
        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
            'tahun_set'=>$tahun_set,
            'arr_tahun'=>$arr_tahun,
            'bulan_set'=>$bulan_set,
            'arr_bulan'=>$arr_bulan,
            'tanggal_set'=>$tanggal_set,
            'arr_tanggal'=>$arr_tanggal,
            'tahun_set'=>$tahun_set,
            'bulan_set'=>$bulan_set,
            'tanggal_set'=>$tanggal_set,
            'notas'=>$notas,
            'notasXsubtotal'=>$notasXsubtotal,
            'notaXdetail_item'=>$notaXdetail_item,
            'penjualan_totals'=>$penjualan_totals,
            'grand_total'=>$grand_total,
            'pelanggan_namas_unique'=>$pelanggan_namas_unique,
            'bulan_2_digit'=>$bulan_2_digit,
            'tanggal_2_digit'=>$tanggal_2_digit,
        ];
        // dd($data);
        // dump($data);

        // dd($notasXsubtotal);
        return view('penjualan.penjualan', $data);
    }
}
