<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tspjap extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function label_tspjaps()
    {
        $tspjap_terbaru = DB::table('tspjap_bahan_hargas')
            ->select('id', 'tspjap_id', 'harga', 'tipe_bahan', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'tspjap_id', 'harga', 'tipe_bahan', 'created_at');

        $label_tspjaps = DB::table('tspjaps')
            ->select('tspjaps.id', 'tspjaps.nama AS label', 'tspjaps.nama AS value', 'tspjap_terbaru.harga', 'tspjap_terbaru.tipe_bahan', 'tspjaps.ktrg')
            ->joinSub($tspjap_terbaru, 'tspjap_terbaru', function ($join) {
                $join->on('tspjaps.id', '=', 'tspjap_terbaru.tspjap_id');
            })
            ->orderBy('tspjaps.nama')->get();

        return $label_tspjaps;
    }

    public function label_tspjaps_a()
    {
        $tspjap_terbaru = DB::table('tspjap_bahan_hargas')
            ->select('id', 'tspjap_id', 'harga', 'tipe_bahan', DB::raw('MAX(created_at)'))
            ->where('tipe_bahan', 'A')
            ->groupBy('id', 'tspjap_id', 'harga', 'tipe_bahan', 'created_at');

        $label_tspjaps = DB::table('tspjaps')
            ->select('tspjaps.id', 'tspjaps.nama AS label', 'tspjaps.nama AS value', 'tspjap_terbaru.harga', 'tspjap_terbaru.tipe_bahan', 'tspjaps.ktrg')
            ->joinSub($tspjap_terbaru, 'tspjap_terbaru', function ($join) {
                $join->on('tspjaps.id', '=', 'tspjap_terbaru.tspjap_id');
            })
            ->orderBy('tspjaps.nama')->get();

        return $label_tspjaps;
    }

    public function label_tspjaps_b()
    {
        $tspjap_terbaru = DB::table('tspjap_bahan_hargas')
            ->select('id', 'tspjap_id', 'harga', 'tipe_bahan', DB::raw('MAX(created_at)'))
            ->where('tipe_bahan', 'B')
            ->groupBy('id', 'tspjap_id', 'harga', 'tipe_bahan', 'created_at');

        $label_tspjaps = DB::table('tspjaps')
            ->select('tspjaps.id', 'tspjaps.nama AS label', 'tspjaps.nama AS value', 'tspjap_terbaru.harga', 'tspjap_terbaru.tipe_bahan', 'tspjaps.ktrg')
            ->joinSub($tspjap_terbaru, 'tspjap_terbaru', function ($join) {
                $join->on('tspjaps.id', '=', 'tspjap_terbaru.tspjap_id');
            })
            ->orderBy('tspjaps.nama')->get();

        return $label_tspjaps;
    }

}
