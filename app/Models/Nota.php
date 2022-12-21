<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }
    public function nota_item()
    {
        return $this->hasMany(SpkProduk::class);
    }

    public function spk_produk_notas()
    {
        return $this->hasMany(SpkProdukNota::class);
    }
    public function spk_produks()
    {
        return $this->belongsToMany(SpkProduk::class, 'spk_produk_notas');
    }

    public function SpkProdukNotaSrjalan_groupBy_nota_id($srjalan_id)
    {
        $nota_ids = SpkProdukNotaSrjalan::select('nota_id')
        ->groupBy('nota_id')
        ->where('srjalan_id', $srjalan_id)
        ->get()->toArray();

        return $nota_ids;
    }

    public function getOneNotaAndComponents($nota_id)
    {
        $nota = Nota::find($nota_id);
        // Data Pelanggan
        $pelanggan = Pelanggan::find($nota['pelanggan_id']);
        $pelanggan_nama=$nota['pelanggan_nama'];
        $cust_long_ala=$nota['cust_long_ala'];
        $alamat=null;
        if ($nota['alamat_id']!==null) {
            $alamat=Alamat::find($nota['alamat_id']);
        }
        $pelanggan_alamats=PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->get();
        $alamat_avas=array();
        foreach ($pelanggan_alamats as $pelanggan_alamat) {
            $alamat_ava=Alamat::find($pelanggan_alamat['alamat_id']);
            $alamat_avas[]=$alamat_ava;
        }

        $cust_kontak=$nota['cust_kontak'];
        $kontak=null;
        if ($nota['kontak_id'!==null]) {
            $kontak=PelangganKontak::find($nota['kontak_id']);
        }
        $kontak_avas=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->get();

        // Data Reseller
        $reseller_nama=$nota['reseller_nama'];
        $reseller=null;
        if ($nota['reseller_id']!==null) {
            $reseller = Pelanggan::find($nota['reseller_id']);
        }
        $reseller_long_ala=$nota['reseller_long_ala'];
        $alamat_reseller=null;
        if ($nota['alamat_reseller_id']!==null) {
            $alamat_reseller=Alamat::find($nota['alamat_reseller_id']);
        }
        $reseller_alamats=$alamat_reseller_avas=array();
        if ($reseller!==null) {
            $reseller_alamats=PelangganAlamat::where('pelanggan_id',$reseller['id'])->get();
            if (count($reseller_alamats)!==0) {
                foreach ($reseller_alamats as $reseller_alamat) {
                    $alamat_reseller_ava=Alamat::find($reseller_alamat['alamat_id']);
                    $alamat_reseller_avas[]=$alamat_reseller_ava;
                }
            }
        }

        $reseller_kontak=$nota['reseller_kontak'];
        $kontak_reseller=null;
        if ($nota['kontak_reseller_id']!==null) {
            $kontak_reseller=PelangganKontak::find($nota['kontak_reseller_id']);
        }
        $kontak_reseller_avas=array();
        if ($reseller!==null) {
            $kontak_reseller_avas=PelangganKontak::where('pelanggan_id',$reseller['id'])->get();
        }

        $spk_produk_notas = SpkProdukNota::where('nota_id', $nota['id'])->get();
        $spk_produks = $produks = $data_items = array();
        foreach ($spk_produk_notas as $spk_produk_nota) {
            $spk_produk = SpkProduk::find($spk_produk_nota['spk_produk_id'])->toArray();
            $produk = Produk::find($spk_produk['produk_id'])->toArray();

            $spk_produks[] = $spk_produk;
            $produks[] = $produk;
            // dump($spk_produk_nota['id'], $spk_produk['id']);

            $data_items[] = [
                'spk_produk_nota_id' => $spk_produk_nota['id'],
                'spk_produk_id' => $spk_produk['id'],
                'produk_id' => $produk['id'],
            ];
        }

        // dump('$spk_produk_notas:', $spk_produk_notas);
        // dump('$spk_produks:', $spk_produks);

        return array($nota,$pelanggan,$pelanggan_nama,$alamat,$cust_long_ala,$alamat_avas,$cust_kontak,$kontak,$kontak_avas,$reseller,$reseller_nama,$alamat_reseller,$reseller_long_ala,$alamat_reseller_avas,$reseller_kontak,$kontak_reseller,$kontak_reseller_avas,$spk_produk_notas, $spk_produks, $produks, $data_items);
    }

    public function getAvailableSPKItemFromNotaID($nota_id)
    {
        $nota = Nota::find($nota_id);
        $pelanggan = Pelanggan::find($nota['pelanggan_id']);
        $reseller = null;
        $reseller_id = null;
        if ($nota['reseller_id'] !== null) {
            $reseller = Pelanggan::find($nota['reseller_id']);
            $reseller_id = $reseller['id'];
        }

        $av_spks1 = Spk::where('pelanggan_id', $pelanggan['id'])->where('reseller_id', $reseller_id)->where(function ($query)
        {
            $query->where('status', 'SEBAGIAN')->orWhere('status', 'SELESAI');
        })->where(function ($query)
        {
            $query->where('status_nota', 'BELUM')->orWhere('status_nota', 'SEBAGIAN');
        })->get()->toArray();

        $av_spks2 = array();
        foreach ($av_spks1 as $av_spk) {
            if ($av_spk['jumlah_selesai'] !== $av_spk['jumlah_sudah_nota']) {
                $av_spks2[] = $av_spk;
            }
        }

        $arr_spk_produks = $arr_produks = $nama_spks = array();
        foreach ($av_spks2 as $av_spk) {
            $nama_spk = $pelanggan['nama'];
            if ($reseller !== null) {
                $nama_spk = "$nama_spk, Reseller: $reseller[nama]";
            }
            $spk_produks = SpkProduk::where('spk_id', $av_spk['id'])->where(function ($query)
            {
                $query->where('status_nota', 'BELUM')->orWhere('status_nota','SEBAGIAN');
            })->get()->toArray();

            $produks = array();
            foreach ($spk_produks as $spk_produk) {
                $produk = Produk::find($spk_produk['produk_id']);
                $produks[] = $produk;
            }

            $arr_spk_produks[] = $spk_produks;
            $arr_produks[] = $produks;
            $nama_spks[] = $nama_spk;
        }

        return array($pelanggan, $reseller, $reseller_id, $av_spks2, $arr_spk_produks, $arr_produks, $nama_spks);
    }

    public function getAvailableSpkItemToAddToNotaFromSPK($spk_id)
    {
        $spk = Spk::find($spk_id);
        $spk_produks = SpkProduk::where('spk_id', $spk_id)->where('jml_selesai', '!=', 0)->where(function ($query)
        {
            $query->where('status_nota', 'BELUM')->orWhere('status_nota', 'SEBAGIAN');
        })->get()->toArray();

        $produks = array();
        foreach ($spk_produks as $spk_produk) {
            $produk = Produk::find($spk_produk['produk_id']);
            $produks[] = $produk;
        }

        return array($spk, $spk_produks, $produks);
    }

    public function deletingOneSj_updateDataSPK($sj_id)
    {
        // Setelah delete, diupdate data jumlah_sudah_sj dan status_sj
        // Lalu diupdate juga yang di spk_produk
        $success_logs=array();
        $srjalan=Srjalan::find($sj_id);
        // cari spk_produk yang berkaitan
        $spk_produk_nota_sjs=SpkProdukNotaSrjalan::where('srjalan_id',$srjalan['id'])->get();
        foreach ($spk_produk_nota_sjs as $spk_produk_nota_sj) {
            // Update data spk_produk
            $spk_produk=SpkProduk::find($spk_produk_nota_sj['spk_produk_id']);
            $spk_produk->jumlah_sudah_srjalan-=$spk_produk_nota_sj['jumlah'];
            $spk_produk->save();
            $success_logs[]="spk_produk->jumlah_sudah_srjalan telah diupdate!";

            $status_srjalan="SEMUA";
            if ($spk_produk['jumlah_sudah_srjalan']===0) {
                $status_srjalan="BELUM";
            } else if ($spk_produk['jumlah_sudah_srjalan']>0 && $spk_produk['jumlah_sudah_srjalan']< $spk_produk['jml_t']) {
                $status_srjalan="SEBAGIAN";
            }

            $spk_produk->status_srjalan=$status_srjalan;
            $success_logs[]="spk_produk->status_srjalan telah diupdate!";

            // Update data SPK status_sj dan jumlah_sudah_sj
            $spk=Spk::find($spk_produk_nota_sj['spk_id']);
            // dump($spk);
            $spk->jumlah_sudah_sj-=$spk_produk_nota_sj['jumlah'];
            $spk->save();
            $success_logs[]="spk->jumlah_sudah_sj telah diupdate!";
            // dump('spk[jumlah_sudah_sj]',$spk['jumlah_sudah_sj']);

            $status_sj="SEMUA";
            if ($spk['jumlah_sudah_sj']===0) {
                $status_sj="BELUM";
            } else if ($spk['jumlah_sudah_sj']>0 && $spk['jumlah_sudah_sj']< $spk['jumlah_total']) {
                $status_sj="SEBAGIAN";
            } else if($spk['jumlah_sudah_sj']<0){
                $status_sj="ERROR";
            }
            $spk->status_sj=$status_sj;
            $spk->save();
            $success_logs[]="spk->status_sj telah diupdate!";
        }
        return $success_logs;
    }

}
