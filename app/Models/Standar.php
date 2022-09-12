<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Standar extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function label_standars()
    {

        $std_terbaru = DB::table('standar_variasis')
            ->select('id', 'standar_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'standar_id', 'harga', 'created_at');

        $label_standars = DB::table('standars')
            ->select('standars.id', 'standars.nama AS label', 'standars.nama AS value', 'std_terbaru.harga', 'standars.ktrg')
            ->joinSub($std_terbaru, 'std_terbaru', function ($join) {
                $join->on('standars.id', '=', 'std_terbaru.standar_id');
            })
            ->orderBy('standars.nama')->get();

        return $label_standars;
    }
}
