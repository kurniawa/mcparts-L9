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
}
