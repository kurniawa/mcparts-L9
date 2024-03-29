<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Jahit extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function jahits_harga()
    {
        // $sql = "SELECT jahit_kepala.id, jahit_kepala.nama, jk_terbaru.harga FROM jahit_kepala INNER JOIN
        // (SELECT id, id_jk, harga, MAX(tanggal) FROM jk_harga GROUP BY id_jk) AS jk_terbaru
        // ON jahit_kepala.id=jk_terbaru.id_jk";

        $jahit_terbaru = DB::table('jahit_hargas')
            ->select('id', 'jahit_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'jahit_id', 'harga', 'created_at');

        // $jahit_terbaru = DB::table('jahit_hargas')
        //     ->selectRaw('id, jahit_id, harga, MAX(created_at) GROUP BY jahit_id');

        $jahits_harga = DB::table('jahits')
            ->select('jahits.id', 'jahits.nama', 'jahit_terbaru.harga', 'jahits.keterangan')
            ->joinSub($jahit_terbaru, 'jahit_terbaru', function ($join) {
                $join->on('jahits.id', '=', 'jahit_terbaru.jahit_id');
            })
            ->orderBy('jahits.nama')->get();

        return $jahits_harga;
    }
}
