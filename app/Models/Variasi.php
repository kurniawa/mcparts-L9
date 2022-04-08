<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Variasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function varias_harga()
    {
        $sql = "SELECT sj_variasi.id, sj_variasi.nama, sj_variasi_terbaru.harga FROM sj_variasi INNER JOIN
        (SELECT id, id_variasi, harga, MAX(tanggal) FROM sj_variasi_harga GROUP BY id_variasi) AS sj_variasi_terbaru
        ON sj_variasi.id=sj_variasi_terbaru.id_variasi";

        $variasi_terbaru = DB::table('variasi_hargas')
            ->select('id', 'variasi_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'variasi_id', 'harga', 'created_at');

        // $variasi_terbaru = DB::table('variasi_hargas')
        //     ->selectRaw('id, variasi_id, harga, MAX(created_at) GROUP BY variasi_id');

        $varias_harga = DB::table('variasis')
            ->select('variasis.id', 'variasis.nama', 'variasi_terbaru.harga', 'variasis.ktrg')
            ->joinSub($variasi_terbaru, 'variasi_terbaru', function ($join) {
                $join->on('variasis.id', '=', 'variasi_terbaru.variasi_id');
            })
            ->get();

        return $varias_harga;
    }
}
