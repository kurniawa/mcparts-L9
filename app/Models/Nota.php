<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nota extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

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

        $pelanggan = Pelanggan::find($nota['pelanggan_id']);
        $daerah = Daerah::find($pelanggan['daerah_id']);

        $reseller = null;
        if ($nota['reseller_id'] !== null && $nota['reseller_id'] !== '') {
            $reseller = Pelanggan::find($nota['reseller_id']);
        }

        $spk_produk_notas = SpkProdukNota::where('nota_id', $nota['id'])->get()->toArray();
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

        return array($nota, $pelanggan, $daerah, $reseller, $spk_produk_notas, $spk_produks, $produks, $data_items);
    }

    public function getAvailableSPKItemFromNotaID($nota_id)
    {
        $nota = Nota::find($nota_id);
        $pelanggan = Pelanggan::find($nota['pelanggan_id']);
        $daerah = Daerah::find($pelanggan['daerah_id']);
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

        return array($pelanggan, $daerah, $reseller, $reseller_id, $av_spks2, $arr_spk_produks, $arr_produks, $nama_spks);
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

}
