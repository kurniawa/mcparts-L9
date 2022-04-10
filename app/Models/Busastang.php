<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Busastang extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function label_busastangs()
    {
        $busastang_terbaru = DB::table('busastang_hargas')
            ->select('id', 'busastang_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'busastang_id', 'harga', 'created_at');

        $label_busastangs = DB::table('busastangs')
            ->select('busastangs.id', 'busastangs.nama AS label', 'busastangs.nama AS value', 'busastang_terbaru.harga', 'busastangs.ktrg')
            ->joinSub($busastang_terbaru, 'busastang_terbaru', function ($join) {
                $join->on('busastangs.id', '=', 'busastang_terbaru.busastang_id');
            })
            ->orderBy('busastangs.nama')->get();

        return $label_busastangs;
    }
}
