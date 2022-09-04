<?php

namespace App\Helpers;

use App\Models\Nota;
use App\Models\Spk;
use App\Models\SpkProduk;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\Srjalan;
use Illuminate\Support\Facades\DB;

class UpdateDataSPK {

static function All($spk_id)
{
    $spk_produks = SpkProduk::where('spk_id',$spk_id)->get();
        $jumlah_total=0;
        $harga_total=0;
        $jumlah_selesai_spk=0;

        foreach ($spk_produks as $spk_produk) {
            $jml_t = $spk_produk['jumlah'] + $spk_produk['deviasi_jml'];
            // dd($jml_t);
            $spk_produk->jml_t = $jml_t;
            $spk_produk->jml_blm_sls=$jml_t-$spk_produk['jml_selesai'];

            if ($spk_produk['jml_selesai']===$jml_t) {
                $spk_produk->status='SELESAI';
                $spk_produk->finished_at=date('Y-m-d H:i:s');
            } else if ($spk_produk['jml_selesai']!==0) {
                $spk_produk->status='SEBAGIAN';
                $spk_produk->finished_at=null;
            } else if ($spk_produk['jml_selesai']===0) {
                $spk_produk->status='PROSES';
                $spk_produk->finished_at=null;
            }

            $spk_produk->save();
            $jumlah_total+=$jml_t;
            $harga_total+=$jml_t*$spk_produk['harga'];
            $jumlah_selesai_spk+=$spk_produk['jml_selesai'];
        }

        $spk = Spk::find($spk_id);
        $spk->jumlah_total=$jumlah_total;
        $spk->harga_total=$harga_total;
        $spk->jumlah_selesai=$jumlah_selesai_spk;
        if ($jumlah_selesai_spk===$jumlah_total) {
            $spk->status='SELESAI';
            $spk->finished_at=date('Y-m-d H:i:s');
        }
        else if ($jumlah_selesai_spk!==0) {
            $spk->status='SEBAGIAN';
            $spk->finished_at=null;
        }
        else if ($jumlah_selesai_spk===0){
            $spk->status = 'PROSES';
            $spk->finished_at=null;
        }
        $spk->save();
}

static function SpkProduk_JmlNota_Status($spk_produk_id)
{
    $spk_produk=SpkProduk::find($spk_produk_id);
    $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
    $jumlah_sudah_nota=0;
    foreach ($spk_produk_notas as $spk_produk_nota) {
        $jumlah_sudah_nota+=$spk_produk_nota['jumlah'];
    }

    $spk_produk->jml_sdh_nota=$jumlah_sudah_nota;
    if ($jumlah_sudah_nota===$spk_produk->jml_t) {
        $spk_produk->status_nota='SELESAI';
    } else if ($jumlah_sudah_nota===0) {
        $spk_produk->status_nota='PROSES';
    } else if ($jumlah_sudah_nota>0) {
        $spk_produk->status_nota='SEBAGIAN';
    }
    $spk_produk->save();
}

static function Nota_JmlT_HargaT($nota_id)
{
    $spk_produk_notas=SpkProdukNota::where('nota_id',$nota_id)->get();

    $jumlah_total=$harga_total=0;
    foreach ($spk_produk_notas as $spk_produk_nota) {
        $jumlah_total+=$spk_produk_nota['jumlah'];
        $harga_total+=$spk_produk_nota['harga_t'];
    }

    $nota=Nota::find($nota_id);
    $nota->jumlah_total=$jumlah_total;
    $nota->harga_total=$harga_total;
    $nota->save();
}

static function NewNota($spk_produk_id)
{
    $success_logs=array();
    $spk_produk=SpkProduk::find($spk_produk_id);
    $spk=Spk::find($spk_produk['spk_id']);

    $user=auth()->user();
    $data_nota=[
        'pelanggan_id'=>$spk['pelanggan_id'],
        'reseller_id'=>$spk['reseller_id'],
        'jumlah_total'=>$spk_produk['jml_selesai'],
        'harga_total'=>$spk_produk['harga']*(int)$spk_produk['jml_selesai'],
        'created_by'=>$user['username'],
        'updated_by'=>$user['username'],
    ];
    $new_nota=Nota::create($data_nota);
    $success_logs[]='Nota baru telah dibuat.';
    $new_nota->no_nota="N-$new_nota[id]";
    $new_nota->save();
    $success_logs[]='Nomor Nota diupdate.';
    $spk_produk_nota=[
        'spk_id'=>$spk_produk['spk_id'],
        'produk_id'=>$spk_produk['produk_id'],
        'spk_produk_id'=>$spk_produk['id'],
        'nota_id'=>$new_nota['id'],
        'jumlah'=>$spk_produk['jml_selesai'],
        'harga'=>$spk_produk['harga'],
        'harga_t'=>$spk_produk['harga']*(int)$spk_produk['jml_selesai'],
    ];
    $new_spk_produk_nota=SpkProdukNota::create($spk_produk_nota);
    $success_logs[]='spk_produk_nota baru telah dibuat.';

    return array($success_logs,$new_nota['id']);
}

static function NewSPKProdukNota($spk_produk_id, $nota_id)
{
    $success_logs=array();
    $spk_produk=SpkProduk::find($spk_produk_id);

    $spk_produk_nota=[
        'spk_id'=>$spk_produk['spk_id'],
        'produk_id'=>$spk_produk['produk_id'],
        'spk_produk_id'=>$spk_produk['id'],
        'nota_id'=>$nota_id,
        'jumlah'=>$spk_produk['jml_selesai'],
        'harga'=>$spk_produk['harga'],
        'harga_t'=>$spk_produk['harga']*(int)$spk_produk['jml_selesai'],
    ];
    $new_spk_produk_nota=SpkProdukNota::create($spk_produk_nota);
    $success_logs[]='spk_produk_nota baru telah dibuat.';
    return $success_logs;
}

}

?>
