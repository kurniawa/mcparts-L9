<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Stiker extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function label_stiker()
    {
        $stiker_terbaru = DB::table('stiker_hargas')
            ->select('id', 'stiker_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'stiker_id', 'harga', 'created_at');

        $label_stiker = DB::table('stikers')
            ->select('stikers.id', 'stikers.nama AS label', 'stikers.nama AS value', 'stiker_terbaru.harga', 'stikers.ktrg')
            ->joinSub($stiker_terbaru, 'stiker_terbaru', function ($join) {
                $join->on('stikers.id', '=', 'stiker_terbaru.stiker_id');
            })
            ->orderBy('stikers.nama')->get();

        return $label_stiker;
    }
}
