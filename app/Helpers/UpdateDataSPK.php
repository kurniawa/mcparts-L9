<?php

namespace App\Helpers;

use App\Models\Alamat;
use App\Models\Nota;
use App\Models\Pelanggan;
use App\Models\PelangganAlamat;
use App\Models\PelangganKontak;
use App\Models\Produk;
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
    $spk=Spk::find($spk_produk['spk_id']);
    $spk_produks=SpkProduk::where('spk_id',$spk['id'])->get();
    $jumlah_sudah_nota=0;

    foreach ($spk_produks as $spk_pro) {
        $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_pro['id'])->get();
        foreach ($spk_produk_notas as $spk_produk_nota) {
            $jumlah_sudah_nota+=$spk_produk_nota['jumlah'];
        }
    }
    // Update SPK

    $spk->jumlah_sudah_nota=$jumlah_sudah_nota;
    $spk->save();

    $status_nota="SEMUA";
    if ($spk['jumlah_sudah_nota']===0) {
        $status_nota="BELUM";
    } else if ($spk['jumlah_sudah_nota']>0 && $spk['jumlah_sudah_nota']< $spk['jumlah_total']) {
        $status_nota="SEBAGIAN";
    } else if($spk['jumlah_sudah_nota']<0){
        $status_nota="ERROR";
    }
    $spk->status_nota=$status_nota;
    $spk->save();

    // Update spk_produk
    $jumlah_sudah_nota_spk_produk=0;
    $spk_produk_notas=SpkProdukNota::where('spk_produk_id',$spk_produk['id'])->get();
    foreach ($spk_produk_notas as $spk_produk_nota) {
        $jumlah_sudah_nota_spk_produk+=$spk_produk_nota['jumlah'];
    }

    $spk_produk->jml_sdh_nota=$jumlah_sudah_nota_spk_produk;
    if ($jumlah_sudah_nota_spk_produk===$spk_produk->jml_t) {
        $spk_produk->status_nota='SELESAI';
    } else if ($jumlah_sudah_nota_spk_produk===0) {
        $spk_produk->status_nota='PROSES';
    } else if ($jumlah_sudah_nota_spk_produk>0) {
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
        $harga_total+=$spk_produk_nota['harga']*$spk_produk_nota['jumlah'];
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
    // Data Pelanggan
    $pelanggan=Pelanggan::find($spk['pelanggan_id']);
    $pelanggan_nama=$pelanggan['nama'];
    $pelanggan_alamat=PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
    $alamat_id=$cust_long_ala=$cust_short=null;
    if ($pelanggan_alamat!==null) {
        $alamat=Alamat::find($pelanggan_alamat['alamat_id']);
        $alamat_id=$alamat['id'];
        $cust_long_ala=$alamat['long'];
        $cust_short=$alamat['short'];
    }
    $pelanggan_kontak=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->where('is_aktual','yes')->first();
    $kontak_id=$cust_kontak=null;
    if ($pelanggan_kontak!==null) {
        $kontak_id=$pelanggan_kontak['id'];
        $cust_kontak=json_encode($pelanggan_kontak->toArray());
    }
    // Data Reseller
    $alamat_reseller_id=$kontak_reseller_id=$reseller_nama=$reseller_long_ala=$reseller_short=$reseller_kontak=null;
    if ($spk['reseller_id']!==null) {
        $reseller=Pelanggan::find($spk['reseller_id']);
        $reseller_nama=$reseller['nama'];
        $reseller_alamat=PelangganAlamat::where('pelanggan_id',$spk['reseller_id'])->where('tipe','UTAMA')->first();
        if ($reseller_alamat!==null) {
            $alamat_reseller=Alamat::find($reseller_alamat['alamat_id']);
            $alamat_reseller_id=$alamat_reseller['id'];
            $reseller_long_ala=$alamat_reseller['long'];
            $reseller_short=$alamat_reseller['short'];
        }
        $kontak_reseller=PelangganKontak::where('pelanggan_id',$spk['reseller_id'])->where('is_aktual','yes')->first();
        if ($reseller_kontak!==null) {
            $kontak_reseller_id=$reseller_kontak['id'];
            $reseller_kontak=json_encode($kontak_reseller->toArray());
        }
    }

    $user=auth()->user();
    $data_nota=[
        'pelanggan_id'=>$spk['pelanggan_id'],
        'reseller_id'=>$spk['reseller_id'],
        'alamat_id'=>$alamat_id,
        'alamat_reseller_id'=>$alamat_reseller_id,
        'kontak_id'=>$kontak_id,
        'kontak_reseller_id'=>$kontak_reseller_id,
        'jumlah_total'=>$spk_produk['jml_selesai'],
        'harga_total'=>$spk_produk['harga']*(int)$spk_produk['jml_selesai'],
        'created_by'=>$user['username'],
        'updated_by'=>$user['username'],
        'pelanggan_nama'=>$pelanggan_nama,
        'cust_long_ala'=>$cust_long_ala,
        'cust_short'=>$cust_short,
        'cust_kontak'=>$cust_kontak,
        'reseller_nama'=>$reseller_nama,
        'reseller_long_ala'=>$reseller_long_ala,
        'reseller_short'=>$reseller_short,
        'reseller_kontak'=>$reseller_kontak,
    ];
    $new_nota=Nota::create($data_nota);
    $success_logs[]='Nota baru telah dibuat.';
    $new_nota->no_nota="N-$new_nota[id]";
    $new_nota->save();
    $success_logs[]='Nomor Nota diupdate.';

    /**Componen nama spk_produk_nota */
    $produk=Produk::find($spk_produk['produk_id']);
    $nama_nota=$produk['nama_nota'];
    $spk_produk_nota=[
        'spk_id'=>$spk_produk['spk_id'],
        'produk_id'=>$spk_produk['produk_id'],
        'spk_produk_id'=>$spk_produk['id'],
        'nota_id'=>$new_nota['id'],
        'jumlah'=>$spk_produk['jml_selesai'],
        'nama_nota'=>$nama_nota,
        'harga'=>$spk_produk['harga'],
        'harga_t'=>$spk_produk['harga']*(int)$spk_produk['jml_selesai'],
    ];
    $new_spk_produk_nota=SpkProdukNota::create($spk_produk_nota);
    $success_logs[]='spk_produk_nota baru telah dibuat.';

    return array($success_logs,$new_nota['id']);
}

static function newNota_basedOn_spkProdukID_with_certainJumlah($spk_produk_id,$jumlah)
{
    $success_logs=array();
    $spk_produk=SpkProduk::find($spk_produk_id);
    $spk=Spk::find($spk_produk['spk_id']);
    // Data Pelanggan
    $pelanggan=Pelanggan::find($spk['pelanggan_id']);
    $pelanggan_nama=$pelanggan['nama'];
    $pelanggan_alamat=PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
    $alamat_id=$cust_long_ala=$cust_short=null;
    if ($pelanggan_alamat!==null) {
        $alamat=Alamat::find($pelanggan_alamat['alamat_id']);
        $alamat_id=$alamat['id'];
        $cust_long_ala=$alamat['long'];
        $cust_short=$alamat['short'];
    }
    $pelanggan_kontak=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->where('is_aktual','yes')->first();
    $kontak_id=$cust_kontak=null;
    if ($pelanggan_kontak!==null) {
        $kontak_id=$pelanggan_kontak['id'];
        $cust_kontak=json_encode($pelanggan_kontak->toArray());
    }
    // Data Reseller
    $alamat_reseller_id=$kontak_reseller_id=$reseller_nama=$reseller_long_ala=$reseller_short=$reseller_kontak=null;
    if ($spk['reseller_id']!==null) {
        $reseller=Pelanggan::find($spk['reseller_id']);
        $reseller_nama=$reseller['nama'];
        $reseller_alamat=PelangganAlamat::where('pelanggan_id',$spk['reseller_id'])->where('tipe','UTAMA')->first();
        if ($reseller_alamat!==null) {
            $alamat_reseller=Alamat::find($reseller_alamat['alamat_id']);
            $alamat_reseller_id=$alamat_reseller['id'];
            $reseller_long_ala=$alamat_reseller['long'];
            $reseller_short=$alamat_reseller['short'];
        }
        $kontak_reseller=PelangganKontak::where('pelanggan_id',$spk['reseller_id'])->where('is_aktual','yes')->first();
        if ($kontak_reseller!==null) {
            $kontak_reseller_id=$kontak_reseller['id'];
            $reseller_kontak=json_encode($kontak_reseller);
        }
    }

    $user=auth()->user();
    $data_nota=[
        'pelanggan_id'=>$spk['pelanggan_id'],
        'reseller_id'=>$spk['reseller_id'],
        'alamat_id'=>$alamat_id,
        'alamat_reseller_id'=>$alamat_reseller_id,
        'kontak_id'=>$kontak_id,
        'kontak_reseller_id'=>$kontak_reseller_id,
        'jumlah_total'=>$jumlah,
        'harga_total'=>$spk_produk['harga']*(int)$jumlah,
        'created_by'=>$user['username'],
        'updated_by'=>$user['username'],
        'pelanggan_nama'=>$pelanggan_nama,
        'cust_long_ala'=>$cust_long_ala,
        'cust_short'=>$cust_short,
        'cust_kontak'=>$cust_kontak,
        'reseller_nama'=>$reseller_nama,
        'reseller_long_ala'=>$reseller_long_ala,
        'reseller_short'=>$reseller_short,
        'reseller_kontak'=>$reseller_kontak,
    ];
    $new_nota=Nota::create($data_nota);
    $success_logs[]='Nota baru telah dibuat.';
    $new_nota->no_nota="N-$new_nota[id]";
    $new_nota->save();
    $success_logs[]='Nomor Nota diupdate.';
    /**Componen nama spk_produk_nota */
    $produk=Produk::find($spk_produk['produk_id']);
    $nama_nota=$produk['nama_nota'];
    $spk_produk_nota=[
        'spk_id'=>$spk_produk['spk_id'],
        'produk_id'=>$spk_produk['produk_id'],
        'spk_produk_id'=>$spk_produk['id'],
        'nota_id'=>$new_nota['id'],
        'jumlah'=>$jumlah,
        'nama_nota'=>$nama_nota,
        'harga'=>$spk_produk['harga'],
        'harga_t'=>$spk_produk['harga']*(int)$jumlah,
    ];
    $new_spk_produk_nota=SpkProdukNota::create($spk_produk_nota);
    $success_logs[]='spk_produk_nota baru telah dibuat.';

    return array($success_logs,$new_nota['id']);
}

static function NewSPKProdukNota($spk_produk_id, $nota_id)
{
    $success_logs=array();
    $spk_produk=SpkProduk::find($spk_produk_id);

    /**Componen nama spk_produk_nota */
    $produk=Produk::find($spk_produk['produk_id']);
    $nama_nota=$produk['nama_nota'];

    $spk_produk_nota=[
        'spk_id'=>$spk_produk['spk_id'],
        'produk_id'=>$spk_produk['produk_id'],
        'spk_produk_id'=>$spk_produk['id'],
        'nota_id'=>$nota_id,
        'jumlah'=>$spk_produk['jml_selesai'],
        'nama_nota'=>$nama_nota,
        'harga'=>$spk_produk['harga'],
        'harga_t'=>$spk_produk['harga']*(int)$spk_produk['jml_selesai'],
    ];
    $new_spk_produk_nota=SpkProdukNota::create($spk_produk_nota);
    $success_logs[]='spk_produk_nota baru telah dibuat.';
    return $success_logs;
}

static function newSPKProdukNota_certainJumlah($spk_produk_id,$nota_id,$jumlah)
{
    $success_logs=array();
    $spk_produk=SpkProduk::find($spk_produk_id);
    /**Componen nama spk_produk_nota */
    $produk=Produk::find($spk_produk['produk_id']);
    $nama_nota=$produk['nama_nota'];

    $spk_produk_nota=[
        'spk_id'=>$spk_produk['spk_id'],
        'produk_id'=>$spk_produk['produk_id'],
        'spk_produk_id'=>$spk_produk['id'],
        'nota_id'=>$nota_id,
        'jumlah'=>$jumlah,
        'nama_nota'=>$nama_nota,
        'harga'=>$spk_produk['harga'],
        'harga_t'=>$spk_produk['harga']*(int)$spk_produk['jml_selesai'],
    ];
    $new_spk_produk_nota=SpkProdukNota::create($spk_produk_nota);
    $success_logs[]='spk_produk_nota baru telah dibuat.';
    return $success_logs;
}

static function sjBaru_isJumlahSesuai($spk_produk_nota_ids,$jumlahs)
{
    /**Cek apakah jumlah===0 */
    $is_all_jumlah_nol=true;
    foreach ($jumlahs as $jumlah) {
        if ($jumlah!==0 || $jumlah<0) {
            $is_all_jumlah_nol=false;
        }
    }
    if ($is_all_jumlah_nol===true) {
        // return back()->with('error','Input jumlah tidak valid!');
        return array('error','Input jumlah harus lebih dari 0!');
    }
    /**Cek apakah semua input jumlah===null */
    $is_all_jumlah_null=true;
    foreach ($jumlahs as $jumlah) {
        if ($jumlah!==null) {
            $is_all_jumlah_null=false;
        }
    }
    if ($is_all_jumlah_null===true) {
        // return back()->with('error','Input jumlah tidak valid!');
        return array('error','Input jumlah tidak valid!');
    }
    /**Cek apakah jumlah sudah sesuai dengan yang tertera di nota */
    $jumlah_sudah_sjs=array();
    for ($i=0; $i < count($spk_produk_nota_ids); $i++) {
        $spk_produk_nota_srjalans=SpkProdukNotaSrjalan::where('spk_produk_nota_id',$spk_produk_nota_ids[$i])->get();
        $jumlah_sudah_sj=0;
        foreach ($spk_produk_nota_srjalans as $spk_produk_nota_srjalan) {
            $jumlah_sudah_sj+=$spk_produk_nota_srjalan['jumlah'];
        }
        $jumlah_sudah_sjs[]=$jumlah_sudah_sj;
    }
    $jumlah_avas=array();
    for ($j=0; $j < count($spk_produk_nota_ids); $j++) {
        $spk_produk_nota=SpkProdukNota::find($spk_produk_nota_ids[$j]);
        $jumlah_ava=$spk_produk_nota['jumlah']-$jumlah_sudah_sjs[$j];
        $jumlah_avas[]=$jumlah_ava;
    }
    // dd($jumlah_avas);

    for ($k=0; $k < count($jumlahs); $k++) {
        if ((int)$jumlahs[$k]>$jumlah_avas[$k]) {
            $message="Jumlah sudah melebihi dari jumlah yang belum diinput ke surat jalan! jumlahs[k]=$jumlahs[$k] > jumlah_avas[k]=$jumlah_avas[$k]?";
            return array('error',$message);
            // return back()->with('error',$message);
        }
    }
}

}

?>
