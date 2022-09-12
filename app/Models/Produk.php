<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Produk extends Model
{
    use HasFactory;

    protected $guarded = ['id'];


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
            ->select('produks.id', 'produks.nama AS label', 'produks.nama AS value', 'produk_terbaru.harga', 'produks.tipe')
            ->joinSub($produk_terbaru, 'produk_terbaru', function ($join) {
                $join->on('produks.id', '=', 'produk_terbaru.produk_id');
            })
            ->orderBy('produks.nama')->get();

        return $label_produks;
    }

    public function bahan() { return $this->belongsToMany(Bahan::class, 'produk_bahans'); }
    public function specs() { return $this->belongsToMany(Spec::class, 'produk_specs'); }
    public function kombinasi() { return $this->belongsToMany(Kombinasi::class, 'produk_kombinasis'); }
    public function tsixpack() { return $this->belongsToMany(Tsixpack::class, 'produk_tsixpacks'); }
    public function japstyle() { return $this->belongsToMany(Japstyle::class, 'produk_japstyles'); }
    public function motif() { return $this->belongsToMany(Motif::class, 'produk_motifs'); }
    public function standar() { return $this->belongsToMany(Standar::class, 'produk_standars'); }
    public function tankpad() { return $this->belongsToMany(Tankpad::class, 'produk_tankpads'); }
    public function stiker() { return $this->belongsToMany(Stiker::class, 'produk_stikers'); }
    public function busastang() { return $this->belongsToMany(Busastang::class, 'produk_busastangs'); }
    public function rol() { return $this->belongsToMany(Rol::class, 'produk_rols'); }
    public function rotan() { return $this->belongsToMany(Rotan::class, 'produk_rotans'); }
    public function variasis() { return $this->belongsToMany(Variasi::class, 'produk_variasis'); }
    public function varians() { return $this->belongsToMany(Varian::class, 'produk_varians'); }

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
