<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pelanggan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ekspedisis()
    {
        return $this->belongsToMany(Ekspedisi::class, 'pelanggan_ekspedisis');
    }

    public function get_ekspedisi_utama_id($pelanggan_id)
    {
        $ekspedisi_utama_id = PelangganEkspedisi::select('ekspedisi_id')
        ->where('pelanggan_id', $pelanggan_id)
        ->where('tipe', 'UTAMA')
        ->groupBy('pelanggan_id', 'ekspedisi_id')->get()->toArray();

        return $ekspedisi_utama_id[0]['ekspedisi_id'];
    }

    public function pelanggan_ekspedisis()
    {
        return $this->hasMany(PelangganEkspedisi::class);
    }
    public function resellers()
    {
        return $this->belongsToMany(Pelanggan::class, 'pelanggan_resellers', 'pelanggan_id', 'reseller_id', 'id', 'id');
        // return $this->belongsToMany();
    }

    public function label_pelanggans_certain_id($id)
    {
        $label_pelanggans_certain_id = DB::table('pelanggans')
            ->where('id', '=', $id)
            ->select('pelanggans.id', 'pelanggans.nama AS label', 'pelanggans.nama AS value')
            // ->orderBy('daerahs.nama')->get();
            ->get();

        return $label_pelanggans_certain_id;
    }

    public function label_pelanggans()
    {
        $label_pelanggans = DB::table('pelanggans')
        ->select('pelanggans.id', 'pelanggans.nama AS label', 'pelanggans.nama AS value')
        ->orderBy('pelanggans.nama')->get();

        return $label_pelanggans;
    }

    public function alamat()
    {
        // return $this->belongsToMany(Alamat::class,'pelanggan_alamats','alamat_id', 'pelanggan_id');
        return $this->belongsToMany(Alamat::class,'pelanggan_alamats');
    }

    public function sjSelesai_fixNamaAlamatKontakPelanggan($srjalan,$pelanggan)
    {
        // Nama Pelanggan
        $srjalan->pelanggan_nama=$pelanggan['nama'];
        // Alamat Pelanggan
        $cust_long_ala=null;
        if ($srjalan['alamat_id']!==null) {
            $alamat_pelanggan=Alamat::find($srjalan['alamat_id']);
            $cust_long_ala=$alamat_pelanggan['long'];
        }
        // else {
        //     $pelanggan_alamat=PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
        //     if ($pelanggan_alamat!==null) {
        //         $alamat_pelanggan=Alamat::find($pelanggan_alamat['alamat_id']);
        //         $cust_long_ala=$alamat_pelanggan['long'];
        //     }
        // }
        $srjalan->cust_long_ala=$cust_long_ala;
        // Kontak Pelanggan
        $cust_kontak=null;
        if ($srjalan['kontak_id']!==null) {
            $pelanggan_kontak=PelangganKontak::find($srjalan['kontak_id']);
            $cust_kontak=json_encode($pelanggan_kontak->toArray());
        }

        // else {
        //     $pelanggan_kontak=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->where('is_aktual','yes')->first();
        //     if ($pelanggan_kontak!==null) {
        //         $cust_kontak=json_encode($pelanggan_kontak->toArray());
        //     }
        // }
        $srjalan->cust_kontak=$cust_kontak;

        $srjalan->save();

    }
    public function sjSelesai_fixNamaAlamatKontakReseller($srjalan,$reseller)
    {
        // Nama Reseller
        $srjalan->reseller_nama=$reseller['nama'];
        // Alamat Reseller
        $reseller_long_ala=null;
        if ($srjalan['alamat_id']!==null) {
            $alamat_reseller=Alamat::find($srjalan['alamat_id']);
            $reseller_long_ala=$alamat_reseller['long'];
        }
        // else {
        //     $reseller_alamat=PelangganAlamat::where('pelanggan_id',$reseller['id'])->where('tipe','UTAMA')->first();
        //     if ($reseller_alamat!==null) {
        //         $alamat_reseller=Alamat::find($reseller_alamat['alamat_id']);
        //         $reseller_long_ala=$alamat_reseller['long'];
        //     }
        // }
        $srjalan->reseller_long_ala=$reseller_long_ala;
        // Kontak Reseller
        $reseller_kontak=null;
        if ($srjalan['kontak_reseller_id']!==null) {
            $kontak_reseller=PelangganKontak::find($srjalan['kontak_reseller_id']);
            $reseller_kontak=json_encode($kontak_reseller->toArray());
        }
        // else{
        //     $kontak_reseller=PelangganKontak::where('pelanggan_id'.$reseller['id'])->where('is_aktual','yes')->first();
        //     if ($kontak_reseller!==null) {
        //         $reseller_kontak=json_encode($kontak_reseller->toArray());
        //     }
        // }
        $srjalan->reseller_kontak=$reseller_kontak;

        $srjalan->save();
    }

    public function notaSelesai_fixNamaAlamatKontakPelanggan($nota,$pelanggan)
    {
        // Nama Pelanggan
        $nota->pelanggan_nama=$pelanggan['nama'];
        // Alamat Pelanggan
        $cust_long_ala=null;
        if ($nota['alamat_id']!==null) {
            $alamat_pelanggan=Alamat::find($nota['alamat_id']);
            $cust_long_ala=$alamat_pelanggan['long'];
        }
        // else {
        //     $pelanggan_alamat=PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
        //     if ($pelanggan_alamat!==null) {
        //         $alamat_pelanggan=Alamat::find($pelanggan_alamat['alamat_id']);
        //         $cust_long_ala=$alamat_pelanggan['long'];
        //     }
        // }
        $nota->cust_long_ala=$cust_long_ala;
        // Kontak Pelanggan
        $cust_kontak=null;
        if ($nota['kontak_id']!==null) {
            $pelanggan_kontak=PelangganKontak::find($nota['kontak_id']);
            $cust_kontak=json_encode($pelanggan_kontak);
        }
        // else {
        //     $cust_kontak=null;
        //     $pelanggan_kontak=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->where('is_aktual','yes')->first();
        //     if ($pelanggan_kontak!==null) {
        //         $cust_kontak=$pelanggan_kontak['nomor'];
        //     }
        // }
        $nota->cust_kontak=$cust_kontak;

        $nota->save();

    }

    public function notaSelesai_fixNamaAlamatKontakReseller($nota,$reseller)
    {
        // Nama Reseller
        $nota->reseller_nama=$reseller['nama'];
        // Alamat Reseller
        $reseller_long_ala=null;
        if ($nota['alamat_id']!==null) {
            $alamat_reseller=Alamat::find($nota['alamat_id']);
            $reseller_long_ala=$alamat_reseller['long'];
        }
        // else {
        //     $reseller_alamat=PelangganAlamat::where('pelanggan_id',$reseller['id'])->where('tipe','UTAMA')->first();
        //     if ($reseller_alamat!==null) {
        //         $alamat_reseller=Alamat::find($reseller_alamat['alamat_id']);
        //         $reseller_long_ala=$alamat_reseller['long'];
        //     }
        // }
        $nota->reseller_long_ala=$reseller_long_ala;
        // Kontak Reseller
        $reseller_kontak=null;
        if ($nota['kontak_reseller_id']!==null) {
            $kontak_reseller=PelangganKontak::find($nota['kontak_reseller_id']);
            $reseller_kontak=$kontak_reseller['nomor'];
        }
        // else{
        //     $kontak_reseller=PelangganKontak::where('pelanggan_id'.$reseller['id'])->where('is_aktual','yes')->first();
        //     if ($kontak_reseller!==null) {
        //         $reseller_kontak=$kontak_reseller['nomor'];
        //     }
        // }
        $nota->reseller_kontak=$reseller_kontak;

        $nota->save();
    }
}
