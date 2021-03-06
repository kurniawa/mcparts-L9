<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kombi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function label_kombis()
    {
        $kombi_terbaru = DB::table('kombi_hargas')
            ->select('id', 'kombi_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'kombi_id', 'harga', 'created_at');

        $label_kombis = DB::table('kombis')
            ->select('kombis.id', 'kombis.nama AS label', 'kombis.nama AS value', 'kombi_terbaru.harga', 'kombis.ktrg')
            ->joinSub($kombi_terbaru, 'kombi_terbaru', function ($join) {
                $join->on('kombis.id', '=', 'kombi_terbaru.kombi_id');
            })
            ->orderBy('kombis.nama')->get();

        return $label_kombis;
    }
}
