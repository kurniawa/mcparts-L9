<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class SpkProdukSelesai extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function get_tahapan_last($spk_produk_id)
    {
        $get_tahapan_last = DB::table('spk_produk_selesais')
        ->select(DB::raw('MAX(tahapan_selesai) AS tahapan_selesai'))
        ->where('spk_produk_id', $spk_produk_id)
        ->get();

        $tahapan_selesai_last = $get_tahapan_last[0]->tahapan_selesai;

        if ($tahapan_selesai_last === null) {
            $tahapan_selesai_last = 0;
        }

        return $tahapan_selesai_last;
    }


    public function get_finished_at_last($spk_id)
    {
        $finished_at_last = SpkProdukSelesai::select(DB::raw('MAX(finished_at) AS finished_at'))
        ->where('spk_id', $spk_id)->get();

        $finished_at_last = $finished_at_last[0]->finished_at;

        // dump('$finished_at_last:', $finished_at_last);

        return $finished_at_last;
    }
}
