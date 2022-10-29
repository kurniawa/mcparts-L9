<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PenjualanHelper extends Model
{
    use HasFactory;
    static function getSalesComponents($notas)
    {
        // mengumpulkan semua pelanggan_ids, lalu dicari nama nya
        $pelanggan_ids=$pelanggan_namas=array();
        foreach ($notas as $nota) {
            $pelanggan_ids[]=$nota['pelanggan_id'];
            $pelanggan=Pelanggan::find($nota['pelanggan_id']);
            $pelanggan_namas[]=$pelanggan['nama'];
            // Alamat pelanggan

        }
        /**Penjualan Total Spesifik Pelanggan */
        $pelanggan_ids_unique=array_unique($pelanggan_ids);
        $penjualan_totals=array();
        foreach ($pelanggan_ids_unique as $pel_id) {
            $notas_spesific_pelanggan=$notas->where('pelanggan_id',$pel_id);
            $penjualan_total=0;
            foreach ($notas_spesific_pelanggan as $nota) {
                $penjualan_total+=$nota['harga_total'];
            }
            $penjualan_totals[]=$penjualan_total;
            $arr_notas_spesific_pelanggan[]=$notas_spesific_pelanggan;
        }
        $pelanggan_namas_unique=array_unique($pelanggan_namas);
        // dump($pelanggan_namas);
        // dd($pelanggan_namas_unique);

        $notasXsubtotal=array();


        for ($i=0; $i < count($pelanggan_namas_unique); $i++) {

            $notas_filtered=$notas->where('pelanggan_nama',$pelanggan_namas_unique[$i])->toArray();
            $subtotal=0;
            $notas_filtered=array_values($notas_filtered);
            // dump($notas_filtered);
            try {
                for ($j=0; $j < count($notas_filtered); $j++) {
                    /** array level 2: spk_produk_notas, ekspedisis */
                    $spk_produk_notas=SpkProdukNota::where('nota_id',$notas_filtered[$j]['id'])->get();

                    // data ekspedisi
                    $spk_produk_nota_sjs=SpkProdukNotaSrjalan::where('nota_id',$notas_filtered[$j]['id'])->get();
                    $srjalan_ids=$srjalans=$ekspedisis=array();
                    $spk_produk_nota_sjs=$spk_produk_nota_sjs->unique('srjalan_id');
                    // dd($spk_produk_nota_sjs);
                    foreach ($spk_produk_nota_sjs as $spkpronosj) {
                        $srjalan=Srjalan::find($spkpronosj['srjalan_id']);
                        $srjalans[]=$srjalan->toArray();

                        $ekspedisi=[
                            'ekspedisi_nama'=>$srjalan['ekspedisi_nama'],
                            'eks_long_ala'=>$srjalan['eks_long_ala'],
                            'eks_kontak'=>$srjalan['eks_kontak'],
                            'transit_nama'=>$srjalan['transit_nama'],
                            'trans_long_ala'=>$srjalan['trans_long_ala'],
                            'trans_kontak'=>$srjalan['trans_kontak'],
                        ];
                        $ekspedisis[]=$ekspedisi;
                        $srjalan_ids[]=$spkpronosj['srjalan_id'];
                    }

                    $subtotal+=$notas_filtered[$j]['harga_total'];
                    if ($j===count($notas_filtered)-1) {

                        $noXsub=[
                            "id"=>$notas_filtered[$j]['id'],
                            "no_nota"=>$notas_filtered[$j]['no_nota'],
                            "pelanggan_id"=>$notas_filtered[$j]['pelanggan_id'],
                            "reseller_id"=>$notas_filtered[$j]['reseller_id'],
                            "status_bayar"=>$notas_filtered[$j]['status_bayar'],
                            "jumlah_total"=>$notas_filtered[$j]['jumlah_total'],
                            "harga_total"=>$notas_filtered[$j]['harga_total'],
                            "alamat_id"=>$notas_filtered[$j]['alamat_id'],
                            "alamat_reseller_id"=>$notas_filtered[$j]['alamat_reseller_id'],
                            "kontak_id"=>$notas_filtered[$j]['kontak_id'],
                            "kontak_reseller_id"=>$notas_filtered[$j]['kontak_reseller_id'],
                            "created_by"=>$notas_filtered[$j]['created_by'],
                            "updated_by"=>$notas_filtered[$j]['updated_by'],
                            "finished_at"=>$notas_filtered[$j]['finished_at'],
                            "pelanggan_nama"=>$notas_filtered[$j]['pelanggan_nama'],
                            "cust_long_ala"=>$notas_filtered[$j]['cust_long_ala'],
                            "cust_kontak"=>$notas_filtered[$j]['cust_kontak'],
                            "reseller_nama"=>$notas_filtered[$j]['reseller_nama'],
                            "reseller_long_ala"=>$notas_filtered[$j]['reseller_long_ala'],
                            "reseller_kontak"=>$notas_filtered[$j]['reseller_kontak'],
                            "keterangan"=>$notas_filtered[$j]['keterangan'],
                            "created_at"=>$notas_filtered[$j]['created_at'],
                            "updated_at"=>$notas_filtered[$j]['updated_at'],
                            "subtotal"=>$subtotal,
                            "spk_produk_notas"=>$spk_produk_notas->toArray(),
                            "srjalans"=>$srjalans,
                            "ekspedisis"=>$ekspedisis,
                        ];

                        $notasXsubtotal[]=$noXsub;
                    } else {
                        $noXsub=[
                            "id"=>$notas_filtered[$j]['id'],
                            "no_nota"=>$notas_filtered[$j]['no_nota'],
                            "pelanggan_id"=>$notas_filtered[$j]['pelanggan_id'],
                            "reseller_id"=>$notas_filtered[$j]['reseller_id'],
                            "status_bayar"=>$notas_filtered[$j]['status_bayar'],
                            "jumlah_total"=>$notas_filtered[$j]['jumlah_total'],
                            "harga_total"=>$notas_filtered[$j]['harga_total'],
                            "alamat_id"=>$notas_filtered[$j]['alamat_id'],
                            "alamat_reseller_id"=>$notas_filtered[$j]['alamat_reseller_id'],
                            "kontak_id"=>$notas_filtered[$j]['kontak_id'],
                            "kontak_reseller_id"=>$notas_filtered[$j]['kontak_reseller_id'],
                            "created_by"=>$notas_filtered[$j]['created_by'],
                            "updated_by"=>$notas_filtered[$j]['updated_by'],
                            "finished_at"=>$notas_filtered[$j]['finished_at'],
                            "pelanggan_nama"=>$notas_filtered[$j]['pelanggan_nama'],
                            "cust_long_ala"=>$notas_filtered[$j]['cust_long_ala'],
                            "cust_kontak"=>$notas_filtered[$j]['cust_kontak'],
                            "reseller_nama"=>$notas_filtered[$j]['reseller_nama'],
                            "reseller_long_ala"=>$notas_filtered[$j]['reseller_long_ala'],
                            "reseller_kontak"=>$notas_filtered[$j]['reseller_kontak'],
                            "keterangan"=>$notas_filtered[$j]['keterangan'],
                            "created_at"=>$notas_filtered[$j]['created_at'],
                            "updated_at"=>$notas_filtered[$j]['updated_at'],
                            "subtotal"=>null,
                            "spk_produk_notas"=>$spk_produk_notas->toArray(),
                            "srjalans"=>$srjalans,
                            "ekspedisis"=>$ekspedisis,
                        ];

                        $notasXsubtotal[]=$noXsub;
                    }
                }
            } catch (\Throwable $th) {
                dump($th);
            }

        }

        // Membuat object untuk rekap_penjualan_detail_item
        $rekap_penjualan_detail_items=array();
        $k=0;
        foreach ($notas as $nota) {
            $spk_produk_notas=SpkProdukNota::where('nota_id',$nota['id'])->get();
            $rekap_penjualan_detail_item=[
                'tanggal'=>date('d-m-Y',strtotime($nota['created_at'])),
                'no_nota'=>$nota['no_nota'],
                'nama_pelanggan'=>$pelanggan_namas[$k],
                'short'=>$nota['cust_short'],
                'spk_produk_notas'=>$spk_produk_notas,
            ];
            $rekap_penjualan_detail_items[]=$rekap_penjualan_detail_item;
            $k++;
        }

        return array($pelanggan_namas_unique,$penjualan_totals,$notasXsubtotal, $rekap_penjualan_detail_items);
    }
}
