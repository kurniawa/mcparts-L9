<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpkProdukNota extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function notaSelesai_fixNamaItemNota($nota_id)
    {
        $spk_produk_notas=SpkProdukNota::where('nota_id',$nota_id)->get();

        foreach ($spk_produk_notas as $spk_produk_nota) {
            $produk=Produk::find($spk_produk_nota['produk_id']);
            $nama_produk=$produk['nama_nota'];
            if ($spk_produk_nota['namaproduk_id']!==null) {
                $pelanggan_namaproduk=PelangganNamaproduk::find($spk_produk_nota['namaproduk_id']);
                $nama_produk=$pelanggan_namaproduk['nama_nota'];
            }

            $spk_produk_nota->nama_nota=$nama_produk;
            $spk_produk_nota->save();
        }
    }

}
