<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Srjalan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function get_pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function get_one_srjalan_and_components($srjalan_id)
    {
        $srjalan = Srjalan::find($srjalan_id);
        $pelanggan = Pelanggan::find($srjalan['pelanggan_id']);
        $daerah = Daerah::find($srjalan['daerah_id']);
        $reseller = null;
        if ($srjalan['reseller_id'] !== null) {
            $reseller = Pelanggan::find($srjalan['reseller_id']);
        }
        $ekspedisi = Ekspedisi::find($srjalan['ekspedisi_id']);
        $spk_produk_nota_srjalans = SpkProdukNotaSrjalan::where('srjalan_id', $srjalan['id'])->get()->toArray();

        $spk_produk_notas = $spk_produks = $produks = array();

        foreach ($spk_produk_nota_srjalans as $spk_produk_nota_srjalan) {
            $spk_produk_nota = SpkProdukNota::find($spk_produk_nota_srjalan['spk_produk_nota_id']);
            $spk_produk = SpkProduk::find($spk_produk_nota_srjalan['spk_produk_id']);
            $produk = Produk::find($spk_produk_nota_srjalan['produk_id']);

            $spk_produk_notas[] = $spk_produk_nota;
            $spk_produks[] = $spk_produk;
            $produks[] = $produk;
        }

        return array($srjalan, $pelanggan, $daerah, $reseller, $ekspedisi, $spk_produk_nota_srjalans, $spk_produk_notas, $spk_produks, $produks);
    }
}
