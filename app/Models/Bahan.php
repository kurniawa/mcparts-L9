<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Bahan extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function label_bahans()
    {
        $sql = "SELECT bahan.id, bahan.nama AS label, bahan.nama AS value, bahan_terbaru.harga FROM bahan INNER JOIN
        (SELECT id, bahan_id, harga, MAX(tanggal) FROM bahan_hargas GROUP BY bahan_id) AS bahan_terbaru
        ON bahan.id=bahan_terbaru.bahan_id";

        $bahan_terbaru = DB::table('bahan_hargas')
            ->select('id', 'bahan_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'bahan_id', 'harga', 'created_at');

        // $bahan_terbaru = DB::table('bahan_hargas')
        //     ->selectRaw('id, bahan_id, harga, MAX(created_at) GROUP BY bahan_id');

        $label_bahans = DB::table('bahans')
            ->select('bahans.id', 'bahans.nama AS label', 'bahans.nama AS value', 'bahan_terbaru.harga', 'bahans.ktrg')
            ->joinSub($bahan_terbaru, 'bahan_terbaru', function ($join) {
                $join->on('bahans.id', '=', 'bahan_terbaru.bahan_id');
            })
            ->orderBy('bahans.nama')->get();

        return $label_bahans;
    }

    public function d_bahan_a()
    {
        $d_bahan_a = DB::table('bahans')
            ->select('bahans.id', 'bahans.nama AS label', 'bahans.nama AS value')
            ->where('grade', 'A')
            ->orderBy('bahans.nama')->get();
        return $d_bahan_a;
    }
    public function d_bahan_b()
    {
        $d_bahan_b = DB::table('bahans')
            ->select('bahans.id', 'bahans.nama AS label', 'bahans.nama AS value')
            ->where('grade', 'B')
            ->orderBy('bahans.nama')->get();
        return $d_bahan_b;
    }
}
