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

    public function get_available_notas_for_srjalan()
    {
        $show_dump = false;

        $pelanggan_id_sj_blm_kirim = Nota::select('pelanggan_id')->where('status_sj', 'BELUM')->orderByDesc('created_at')->groupBy('pelanggan_id')->get();
        if ($show_dump) {
            dump('pelanggan_id_sj_blm_kirim', $pelanggan_id_sj_blm_kirim);
        }

        $pelanggans = $daerahs = $arr_notas = $arr_resellers = $arr2_spk_produk_notas = $arr2_spk_produks = $arr2_produks = array();
        for ($i0 = 0; $i0 < count($pelanggan_id_sj_blm_kirim); $i0++) {
            $pelanggan = Pelanggan::find($pelanggan_id_sj_blm_kirim[$i0]['pelanggan_id']);
            $daerah = Daerah::find($pelanggan['daerah_id'])->toArray();
            $notas = Nota::where('pelanggan_id', $pelanggan['id'])->where('status_sj', 'BELUM')->orWhere('status_sj', 'SEBAGIAN')
            ->orderByDesc('created_at')->get();

            $pelanggans[] = $pelanggan;
            $daerahs[] = $daerah;
            $arr_notas[] = $notas;

            $resellers = $arr_spk_produk_notas = $arr_spk_produks = array();
            for ($i = 0; $i < count($notas); $i++) {
                if ($notas[$i]['reseller_id'] !== null) {
                    $reseller = Pelanggan::find($notas[$i]['reseller_id'])->toArray();
                    $resellers[] = $reseller;
                } else {
                    $reseller[] = null;
                }

                $spk_produk_notas = SpkProdukNota::where('nota_id', $notas[$i]['id'])->get()->toArray();
                $spk_produks = $produks = array();
                foreach ($spk_produk_notas as $spk_produk_nota) {
                    $spk_produk = SpkProduk::find($spk_produk_nota['spk_produk_id'])->toArray();
                    $produk = Produk::find($spk_produk['produk_id'])->toArray();
                    $spk_produks[] = $spk_produk;
                    $produks[] = $produk;
                }

                $arr_spk_produk_notas[] = $spk_produk_notas;
                $arr_spk_produks[] = $spk_produks;
                $arr_produks[] = $produks;
            }
            $arr_resellers[] = $resellers;
            $arr2_spk_produk_notas[] = $arr_spk_produk_notas;
            $arr2_spk_produks[] = $arr_spk_produks;
            $arr2_produks[] = $arr_produks;

        }
        return array($pelanggans, $daerahs, $arr_notas, $arr_resellers, $arr2_spk_produk_notas, $arr2_spk_produks, $arr2_produks);
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
