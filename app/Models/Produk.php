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

    public function label_produks()
    {
        $produk_terbaru = DB::table('produk_hargas')
            ->select('id', 'produk_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'produk_id', 'harga', 'created_at');

        $label_produks = DB::table('produks')
            ->select('produks.id', 'produks.nama AS label', 'produks.nama AS value', 'produk_terbaru.harga', 'produks.tipe', 'produks.bahan_id', 'produks.ukuran_id', 'produks.jahit_id', 'produks.standar_id', 'produks.kombi_id', 'produks.busastang_id', 'produks.tspjap_id', 'produks.tipe_bahan', 'produks.stiker_id')
            ->joinSub($produk_terbaru, 'produk_terbaru', function ($join) {
                $join->on('produks.id', '=', 'produk_terbaru.produk_id');
            })
            ->orderBy('produks.nama')->get();

        return $label_produks;
    }

    /**
     * Halaman Produk
     * Komponen:
     * Tipe Variasi: Polos, LG. Bayang, T. Bayang, dll
     * Tipe Ukuran: JB, S-JB, Aerox
     * Tipe Jahit: Univ, JB, ABS-RV
     *
     * Sarung Jok:
     * SJ Variasi
     * SJ Kombinasi
     * SJ Standar
     * SJ T.Sixpack
     * SJ Japstyle
     *
     * Stiker:
     *
     * Tankpad:
     *
     * Busastang:
     */

}
