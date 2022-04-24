<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SpkProdukSelesai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function get_tahapan_last($spk_produk_id)
    {
        $get_tahapan_last = DB::table('spk_produk_selesais')
        ->select(DB::raw('MAX(tahapan_selesai)'))
        ->where('spk_produk_id', $spk_produk_id)
        ->get();
        return $get_tahapan_last;
    }
}
