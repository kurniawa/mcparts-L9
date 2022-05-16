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
        $show_dump = false;

        $nota = Nota::find($nota_id);

        $pelanggan = Pelanggan::find($nota['pelanggan_id']);
        $daerah = Daerah::find($pelanggan['daerah_id']);

        $reseller = null;
        if ($nota['reseller_id'] !== null && $nota['reseller_id'] !== '') {
            $reseller = Pelanggan::find($nota['reseller_id']);
        }

        $spk_produk_notas = SpkProdukNota::where('nota_id', $nota['id'])->get()->toArray();
        $spk_produks = $produks = array();
        foreach ($spk_produk_notas as $spk_produk_nota) {
            $spk_produk = SpkProduk::find($spk_produk_nota['spk_produk_id'])->toArray();
            $produk = Produk::find($spk_produk['produk_id'])->toArray();

            $spk_produks[] = $spk_produk;
            $produks[] = $produk;
        }

        return array($nota, $pelanggan, $daerah, $reseller, $spk_produk_notas, $spk_produks, $produks);
    }

}
