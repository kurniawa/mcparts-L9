<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ekspedisi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function label_ekspedisis()
    {
        // $sql = "SELECT pulaus.id, pulaus.nama AS label, pulaus.nama AS value, pulaus_terbaru.harga FROM pulaus INNER JOIN
        // (SELECT id, pulaus_id, harga, MAX(tanggal) FROM pulaus_harga GROUP BY pulaus_id) AS pulaus_terbaru
        // ON pulaus.id=pulaus_terbaru.pulaus_id";

        // $pulaus_terbaru = DB::table('pulaus_harga')
        //     ->selectRaw('id, pulaus_id, harga, MAX(created_at)')
        //     ->groupBy('pulaus_id');

        // $pulaus_terbaru = DB::table('pulaus_harga')
        //     ->selectRaw('id, pulaus_id, harga, MAX(created_at) GROUP BY pulaus_id');

        $label_ekspedisis = DB::table('ekspedisis')
            ->select('ekspedisis.id', 'ekspedisis.nama AS label', 'ekspedisis.nama AS value')
            ->orderBy('ekspedisis.nama')->get();

        return $label_ekspedisis;
    }

    public function sjSelesai_setEkspedisi($srjalan,$pelanggan)
    {
        // Ekspedisi
        $ekspedisi_nama=null;
        if ($srjalan['ekspedisi_id']!==null) {
            $ekspedisi=Ekspedisi::find($srjalan['ekspedisi_id']);
            $ekspedisi_nama=$ekspedisi['nama'];
        } else {
            $pelanggan_ekspedisi=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('is_transit','no')->where('tipe','UTAMA')->first();
            if ($pelanggan_ekspedisi!==null) {
                $ekspedisi=Ekspedisi::find($pelanggan_ekspedisi['ekspedisi_id']);
                $ekspedisi_nama=$ekspedisi['nama'];
            }
        }
        $srjalan->ekspedisi_nama=$ekspedisi_nama;

        // Alamat Ekspedisi
        $cust_long_ala=null;
        if ($srjalan['alamat_ekspedisi_id']!==null) {
            $alamat=Alamat::find($srjalan['alamat_ekspedisi_id']);
            $cust_long_ala=$alamat['long'];
        } else {
            $ekspedisi_alamat=EkspedisiAlamat::where('ekspedisi_id',$ekspedisi['id'])->where('tipe','UTAMA')->first();
            if ($ekspedisi_alamat!==null) {
                $alamat=Alamat::find($ekspedisi_alamat['alamat_id']);
                $cust_long_ala=$alamat['long'];
            }
        }
        $srjalan->cust_long_ala=$cust_long_ala;

        // Kontak Ekspedisi
        $eks_kontak=null;
        if ($srjalan['kontak_ekspedisi_id']!==null) {
            $eks_kontak=EkspedisiKontak::find($srjalan['kontak_ekspedisi_id']);
        } else {
            $eks_kontak=EkspedisiKontak::where('ekspedisi_id',$ekspedisi['id'])->where('is_aktual','yes')->first();
        }
        $srjalan->eks_kontak=$eks_kontak;

        // Transit
        $transit_nama=null;
        if ($srjalan['transit_id']!==null) {
            $transit=Ekspedisi::find($srjalan['transit_id']);
            $transit_nama=$transit['nama'];
        } else {
            $pelanggan_transit=PelangganEkspedisi::where('pelanggan_id',$pelanggan['id'])->where('is_transit','yes')->where('tipe','UTAMA')->first();
            if ($pelanggan_transit!==null) {
                $transit=Ekspedisi::find($pelanggan_transit['ekspedisi_id']);
                $transit_nama=$transit['nama'];
            }
        }
        $srjalan->transit_nama=$transit_nama;

        // Alamat Transit
        $trans_long_ala=null;
        if ($srjalan['transit_id']!==null) {
            if ($srjalan['alamat_transit_id']!==null) {
                $alamat_transit=Alamat::find($srjalan['alamat_transit_id']);
                $trans_long_ala=$alamat_transit['long'];
            } else {
                $transit_alamat=EkspedisiAlamat::where('ekspedisi_id',$transit['id'])->where('tipe','UTAMA')->first();
                if ($transit_alamat!==null) {
                    $alamat_transit=Alamat::find($transit_alamat['alamat_id']);
                    $cust_long_ala=$alamat_transit['long'];
                }
            }
        }
        $srjalan->trans_long_ala=$trans_long_ala;

        // Kontak Transit
        $trans_kontak=null;
        if ($srjalan['transit_id']!==null) {
            if ($srjalan['kontak_transit_id']!==null) {
                $trans_kontak=EkspedisiKontak::find($srjalan['kontak_ekspedisi_id']);
            } else {
                $trans_kontak=EkspedisiKontak::where('ekspedisi_id',$transit['id'])->where('is_aktual','yes')->first();
            }
        }
        $srjalan->trans_kontak=$trans_kontak;
        $srjalan->save();
    }

    static function updateEkspedisiSJ($srjalan_id,$ekspedisi_id,$transit_id)
    {
        $_success="";
        // Data Ekspedisi
        $ekspedisi_nama=$eks_long_ala=$eks_short=$eks_kontak=$alamat_ekspedisi_id=$kontak_ekspedisi_id=null;
        if ($ekspedisi_id!==null) {
            $ekspedisi=Ekspedisi::find($ekspedisi_id);
            $ekspedisi_nama=$ekspedisi['nama'];
            $ekspedisi_alamat=EkspedisiAlamat::where('ekspedisi_id',$ekspedisi_id)->where('tipe','UTAMA')->first();
            if ($ekspedisi_alamat!==null) {
                $alamat_ekspedisi=Alamat::find($ekspedisi_alamat['alamat_id']);
                $alamat_ekspedisi_id=$alamat_ekspedisi['id'];
                $eks_long_ala=$alamat_ekspedisi['long'];
                $eks_short=$alamat_ekspedisi['short'];
            }
            $eks_kontak=EkspedisiKontak::where('ekspedisi_id',$ekspedisi_id)->where('is_aktual','yes')->first();
        }

        // Data Transit
        $transit_nama=$trans_long_ala=$trans_short=$trans_kontak=$alamat_transit_id=$kontak_transit_id=null;
        if ($transit_id!==null) {
            $transit=Ekspedisi::find($transit_id);
            $transit_nama=$transit['nama'];
            $transit_alamat=EkspedisiAlamat::where('ekspedisi_id',$transit_id)->where('tipe','UTAMA')->first();
            if ($transit_alamat!==null) {
                $alamat_transit=Alamat::find($transit_alamat['alamat_id']);
                $alamat_transit_id=$alamat_transit['id'];
                $trans_long_ala=$alamat_transit['long'];
                $trans_short=$alamat_transit['short'];
            }
            $trans_kontak=EkspedisiKontak::where('ekspedisi_id',$transit_id)->where('is_aktual','yes')->first();
        }
        $srjalan = Srjalan::find($srjalan_id);
        $srjalan->update([
            'ekspedisi_id'=>$ekspedisi_id,
            'ekspedisi_transit_id'=>$transit_id,
            'alamat_ekspedisi_id'=>$alamat_ekspedisi_id,
            'alamat_transit_id'=>$alamat_transit_id,
            'kontak_ekspedisi_id'=>$kontak_ekspedisi_id,
            'kontak_transit_id'=>$kontak_transit_id,
            //
            'ekspedisi_nama'=>$ekspedisi_nama,
            'eks_long_ala'=>$eks_long_ala,
            'eks_short'=>$eks_short,
            'eks_kontak'=>$eks_kontak,
            'transit_nama'=>$transit_nama,
            'trans_long_ala'=>$trans_long_ala,
            'trans_short'=>$trans_short,
            'trans_kontak'=>$trans_kontak,
        ]);

        $_success.="_ Ekspedisi dari Sr. Jalan ini telah diupdate.";
        return $_success;

    }

    // public function sjSelesai_setEkspedisiReseller($srjalan,$reseller)
    // {
    //     // Ekspedisi
    //     $ekspedisi_nama=null;
    //     if ($srjalan['ekspedisi_id']!==null) {
    //         $ekspedisi=Ekspedisi::find($srjalan['ekspedisi_id']);
    //         $ekspedisi_nama=$ekspedisi['nama'];
    //     } else {
    //         $reseller_ekspedisi=PelangganEkspedisi::where('pelanggan_id',$reseller['id'])->where('is_transit','no')->where('tipe','UTAMA')->first();
    //         if ($reseller_ekspedisi!==null) {
    //             $ekspedisi=Ekspedisi::find($reseller_ekspedisi['ekspedisi_id']);
    //             $ekspedisi_nama=$ekspedisi['nama'];
    //         }
    //     }
    //     $srjalan->ekspedisi_nama=$ekspedisi_nama;

    //     // Alamat Ekspedisi
    //     $cust_long_ala=null;
    //     if ($srjalan['alamat_ekspedisi_id']!==null) {
    //         $alamat=Alamat::find($srjalan['alamat_ekspedisi_id']);
    //         $cust_long_ala=$alamat['long'];
    //     } else {
    //         $ekspedisi_alamat=EkspedisiAlamat::where('ekspedisi_id',$ekspedisi['id'])->where('tipe','UTAMA')->first();
    //         if ($ekspedisi_alamat!==null) {
    //             $alamat=Alamat::find($ekspedisi_alamat['alamat_id']);
    //             $cust_long_ala=$alamat['long'];
    //         }
    //     }
    //     $srjalan->cust_long_ala=$cust_long_ala;

    //     // Kontak Ekspedisi
    //     $ekspedisi_nomor_kontak=null;
    //     if ($srjalan['kontak_ekspedisi_id']!==null) {
    //         $ekspedisi_kontak=EkspedisiKontak::find($srjalan['kontak_ekspedisi_id']);
    //     } else {
    //         $ekspedisi_kontak=EkspedisiKontak::where('ekspedisi_id',$ekspedisi['id'])->where('is_aktual','yes')->first();
    //     }
    //     if ($ekspedisi_kontak!==null) {
    //         $ekspedisi_nomor_kontak=$ekspedisi_kontak['nomor'];
    //     }
    //     $srjalan->eks_kontak=$ekspedisi_nomor_kontak;

    // }
}
