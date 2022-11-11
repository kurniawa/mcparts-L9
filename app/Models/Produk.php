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

    public function hargas()
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

    static function getProdukComponents($produk_id)
    {
        $bahan = Produk::find($produk_id)->bahan;if (count($bahan)===0) {$bahan=null;}else{$bahan=$bahan[0];}
        $kombinasi = Produk::find($produk_id)->kombinasi;if (count($kombinasi)===0) {$kombinasi=null;}else{$kombinasi=$kombinasi[0];}
        $tsixpack = Produk::find($produk_id)->tsixpack;if (count($tsixpack)===0) {$tsixpack=null;}else{$tsixpack=$tsixpack[0];}
        $japstyle = Produk::find($produk_id)->japstyle;if (count($japstyle)===0) {$japstyle=null;}else{$japstyle=$japstyle[0];}
        $motif = Produk::find($produk_id)->motif;if (count($motif)===0) {$motif=null;}else{$motif=$motif[0];}
        $standar = Produk::find($produk_id)->standar;if (count($standar)===0) {$standar=null;}else{$standar=$standar[0];}
        $tankpad = Produk::find($produk_id)->tankpad;if (count($tankpad)===0) {$tankpad=null;}else{$tankpad=$tankpad[0];}
        $stiker = Produk::find($produk_id)->stiker;if (count($stiker)===0) {$stiker=null;}else{$stiker=$stiker[0];}
        $busastang = Produk::find($produk_id)->busastang;if (count($busastang)===0) {$busastang=null;}else{$busastang=$busastang[0];}
        $rol = Produk::find($produk_id)->rol;if (count($rol)===0) {$rol=null;}else{$rol=$rol[0];}
        $rotan = Produk::find($produk_id)->rotan;if (count($rotan)===0) {$rotan=null;}else{$rotan=$rotan[0];}
        $specs = Produk::find($produk_id)->specs;if (count($specs)===0) {$specs=null;}
        $variasis = $varians = array();
        $variasi_varians = ProdukVariasiVarian::where('produk_id', $produk_id)->get();
        $i=0;
        if (count($variasi_varians) !== 0) {
            foreach ($variasi_varians as $variasi_varian) {
                $variasi = Variasi::find($variasi_varian['variasi_id']);
                $varian = null;
                if ($variasi_varian['varian_id']!==null) {
                    $varian = Varian::find($variasi_varian['varian_id']);
                }
                $variasis[]=$variasi;
                $varians[]=$varian;
                $i++;
            }
        } else {
            $variasis = $varians = null;
        }

        $produk_harga_latest=ProdukHarga::where('produk_id',$produk_id)->latest()->first();
        $produk_hargas=ProdukHarga::where('produk_id',$produk_id)->get();

        $data =[
            'bahan'=>$bahan,
            'kombinasi'=>$kombinasi,
            'tsixpack'=>$tsixpack,
            'japstyle'=>$japstyle,
            'motif'=>$motif,
            'standar'=>$standar,
            'tankpad'=>$tankpad,
            'stiker'=>$stiker,
            'busastang'=>$busastang,
            'rol'=>$rol,
            'rotan'=>$rotan,
            'specs'=>$specs,
            'variasis'=>$variasis,
            'varians'=>$varians,
            'produk_harga_latest'=>$produk_harga_latest,
            'produk_hargas'=>$produk_hargas,
        ];

        return $data;
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
