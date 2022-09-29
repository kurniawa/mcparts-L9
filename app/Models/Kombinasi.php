<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kombinasi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function label_kombinasi()
    {
        $kombinasi_terbaru = DB::table('kombinasi_hargas')
            ->select('id', 'kombinasi_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'kombinasi_id', 'harga', 'created_at');

        $label_kombinasi = DB::table('kombinasis')
            ->select('kombinasis.id', 'kombinasis.nama AS label', 'kombinasis.nama AS value', 'kombinasi_terbaru.harga', 'kombinasis.keterangan')
            ->joinSub($kombinasi_terbaru, 'kombinasi_terbaru', function ($join) {
                $join->on('kombinasis.id', '=', 'kombinasi_terbaru.kombinasi_id');
            })
            ->orderBy('kombinasis.nama')->get();

        return $label_kombinasi;
    }
}
