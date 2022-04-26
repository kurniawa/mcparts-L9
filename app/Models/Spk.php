<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Spk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    // public $timestamps = false; tidak perlu false, karena memang terpakai
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    public function produks()
    {
        return $this->belongsToMany(Produk::class, 'spk_produks');
    }

    public function spk_produks()
    {
        return $this->hasMany(SpkProduk::class);
    }

    public function spk_produk_selesais()
    {
        return $this->hasMany(SpkProdukSelesai::class);
    }

    public function get_available_spks_dan_pelanggan_terkait()
    {
        $show_dump = false;

        $pelanggan_ids = Spk::select('pelanggan_id')->where('status', 'SEBAGIAN')->orWhere('status', 'SELESAI')
        ->groupBy('id','no_spk', 'pelanggan_id', 'reseller_id', 'status', 'judul', 'jumlah_total', 'harga_total', 'created_by', 'updated_by', 'created_at', 'finished_at', 'updated_at')
        ->get()->toArray();

        $pelanggans = $available_spks = array();
        for ($i=0; $i < count($pelanggan_ids); $i++) {
            $pelanggan = Pelanggan::find($pelanggan_ids[$i]['pelanggan_id'])->toArray();

            $available_spk = Spk::where(function ($query)
            {
                $query->where('status', 'SEBAGIAN')->orWhere('status', 'SELESAI');
            })->where('pelanggan_id', $pelanggan_ids[$i]['pelanggan_id'])->get()->toArray();

            array_push($available_spks, $available_spk);
            array_push($pelanggans, $pelanggan);
        }
        if ($show_dump) {
            dump('$pelanggans', $pelanggans);
            dd('$available_spks', $available_spks);
        }
        return array($pelanggans, $available_spks);
    }

}
