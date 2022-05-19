<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    public $timestamps = false;

    public function Harga()
    {
        return $this->hasMany(ProdukHarga::class);
    }

    public function spk()
    {
        return $this->belongsToMany(Spk::class);
    }

    public function produksThisPelanggan($pelanggan_id)
    {
        $pps = PelangganProduk::select('id', 'produk_id', DB::raw('MAX(updated_at)'))
        ->groupBy('id', 'produk_id', 'updated_at')
        ->where('pelanggan_id', $pelanggan_id)
        ->get()->toArray();

        $pelanggan_produks = $produks = $hargas = array();
        foreach ($pps as $pp) {
            $pelanggan_produk = PelangganProduk::find($pp['id'])->toArray();
            $produk = Produk::find($pp['produk_id'])->toArray();
            $harga = ProdukHarga::select('id', 'produk_id', 'harga', DB::raw('MAX(created_at)'))
            ->where('produk_id', $produk['id'])
            ->groupBy('id', 'produk_id', 'harga', 'created_at')
            ->get()->toArray();

            $produks[] = $produk;
            $pelanggan_produks[] = $pelanggan_produk;
            $hargas[] = $harga[0];
        }

        return array($pelanggan_produks, $produks, $hargas);
    }

}
