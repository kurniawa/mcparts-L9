<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Variasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function variasi_harga()
    {
        $variasi_terbaru = DB::table('variasi_hargas')
            ->select('id', 'variasi_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'variasi_id', 'harga', 'created_at');

        // $variasi_terbaru = DB::table('variasi_hargas')
        //     ->selectRaw('id, variasi_id, harga, MAX(created_at) GROUP BY variasi_id');

        $variasi_harga = DB::table('variasis')
            ->select('variasis.id', 'variasis.nama', 'variasi_terbaru.harga', 'variasis.keterangan')
            ->joinSub($variasi_terbaru, 'variasi_terbaru', function ($join) {
                $join->on('variasis.id', '=', 'variasi_terbaru.variasi_id');
            })
            ->get();

        return $variasi_harga;
    }
}
