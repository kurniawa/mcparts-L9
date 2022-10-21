<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Nota;
use App\Models\Pelanggan;
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
        dd($get);
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

        // Menghitung harga total berdasarkan pelanggan
        $pelanggan_ids=$pelanggans_v_notas=array();
        foreach ($notas as $nota) {
            // dump($nota['pelanggan_id']);
            // dump($pelanggan_ids);
            // $is_pelanggan_in_array=data_get($pelanggan_ids,$nota['pelanggan_id']);
            $is_pelanggan_in_array=array_search($nota['pelanggan_id'],$pelanggan_ids);

            // dump($is_pelanggan_in_array);
            if ($is_pelanggan_in_array === false) {
                $pelanggan_ids[]=$nota['pelanggan_id'];
            }
            $pelanggan=Pelanggan::find($nota['pelanggan_id']);
            $pelanggans_v_notas[]=$pelanggan;
        }

        // dump($notas);
        // dump($pelanggan_ids);
        $pelanggan_namas=$penjualan_totals=$arr_notas_spesific_pelanggan=array();
        foreach ($pelanggan_ids as $pelanggan_id) {
            $pelanggan=Pelanggan::find($pelanggan_id);
            $pelanggan_namas[]=$pelanggan['nama'];

            $notas_spesific_pelanggan=$notas->where('pelanggan_id',$pelanggan['id']);
            $penjualan_total=0;
            foreach ($notas_spesific_pelanggan as $nota) {
                $penjualan_total+=$nota['harga_total'];
            }

            $penjualan_totals[]=$penjualan_total;
            $arr_notas_spesific_pelanggan[]=$notas_spesific_pelanggan;
        }
        array_unique($pelanggan_namas);
        // dd($pelanggan_namas);
        // dump($arr_notas_spesific_pelanggan);

        // notas + subtotal
        $notasXsubtotal=array();
        $arr_spk_produk_notas=array();
        if ($detail==='checked') {

        }
        $nota_copies=$notas->toArray();
        $pelanggan_nama_copies=$pelanggan_namas;
        for ($i=0; $i < count($pelanggan_nama_copies); $i++) {
            $res=$notas->where('pelanggan_nama',$pelanggan_nama_copies[$i])->toArray();
            $subtotal=0;
            $res=array_values($res);
            // dump($res);
            try {
                for ($j=0; $j < count($res); $j++) {
                    $subtotal+=$res[$j]['harga_total'];
                    if ($j===count($res)-1) {

                        $noXsub=[
                            "id"=>$res[$j]['id'],
                            "no_nota"=>$res[$j]['no_nota'],
                            "pelanggan_id"=>$res[$j]['pelanggan_id'],
                            "reseller_id"=>$res[$j]['reseller_id'],
                            "status_bayar"=>$res[$j]['status_bayar'],
                            "jumlah_total"=>$res[$j]['jumlah_total'],
                            "harga_total"=>$res[$j]['harga_total'],
                            "alamat_id"=>$res[$j]['alamat_id'],
                            "alamat_reseller_id"=>$res[$j]['alamat_reseller_id'],
                            "kontak_id"=>$res[$j]['kontak_id'],
                            "kontak_reseller_id"=>$res[$j]['kontak_reseller_id'],
                            "created_by"=>$res[$j]['created_by'],
                            "updated_by"=>$res[$j]['updated_by'],
                            "finished_at"=>$res[$j]['finished_at'],
                            "pelanggan_nama"=>$res[$j]['pelanggan_nama'],
                            "cust_long_ala"=>$res[$j]['cust_long_ala'],
                            "cust_kontak"=>$res[$j]['cust_kontak'],
                            "reseller_nama"=>$res[$j]['reseller_nama'],
                            "reseller_long_ala"=>$res[$j]['reseller_long_ala'],
                            "reseller_kontak"=>$res[$j]['reseller_kontak'],
                            "keterangan"=>$res[$j]['keterangan'],
                            "created_at"=>$res[$j]['created_at'],
                            "updated_at"=>$res[$j]['updated_at'],
                            "subtotal"=>$subtotal,
                        ];

                        $notasXsubtotal[]=$noXsub;
                    } else {
                        $noXsub=[
                            "id"=>$res[$j]['id'],
                            "no_nota"=>$res[$j]['no_nota'],
                            "pelanggan_id"=>$res[$j]['pelanggan_id'],
                            "reseller_id"=>$res[$j]['reseller_id'],
                            "status_bayar"=>$res[$j]['status_bayar'],
                            "jumlah_total"=>$res[$j]['jumlah_total'],
                            "harga_total"=>$res[$j]['harga_total'],
                            "alamat_id"=>$res[$j]['alamat_id'],
                            "alamat_reseller_id"=>$res[$j]['alamat_reseller_id'],
                            "kontak_id"=>$res[$j]['kontak_id'],
                            "kontak_reseller_id"=>$res[$j]['kontak_reseller_id'],
                            "created_by"=>$res[$j]['created_by'],
                            "updated_by"=>$res[$j]['updated_by'],
                            "finished_at"=>$res[$j]['finished_at'],
                            "pelanggan_nama"=>$res[$j]['pelanggan_nama'],
                            "cust_long_ala"=>$res[$j]['cust_long_ala'],
                            "cust_kontak"=>$res[$j]['cust_kontak'],
                            "reseller_nama"=>$res[$j]['reseller_nama'],
                            "reseller_long_ala"=>$res[$j]['reseller_long_ala'],
                            "reseller_kontak"=>$res[$j]['reseller_kontak'],
                            "keterangan"=>$res[$j]['keterangan'],
                            "created_at"=>$res[$j]['created_at'],
                            "updated_at"=>$res[$j]['updated_at'],
                            "subtotal"=>null,
                        ];

                        $notasXsubtotal[]=$noXsub;
                    }
                }
            } catch (\Throwable $th) {
                dump($th);
            }

        }



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
            'pelanggan_namas'=>$pelanggan_namas,
            'penjualan_totals'=>$penjualan_totals,
            'pelanggans_v_notas'=>$pelanggans_v_notas,
            'notas'=>$notas,
            'notasXsubtotal'=>$notasXsubtotal,
        ];
        // dd($data);
        // dump($data);
        return view('penjualan.penjualan', $data);
    }
}
