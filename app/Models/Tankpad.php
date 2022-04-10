<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tankpad extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function label_tankpads()
    {
        $tp_terbaru = DB::table('tankpad_hargas')
            ->select('id', 'tankpad_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'tankpad_id', 'harga', 'created_at');

        $label_tankpads = DB::table('tankpads')
            ->select('tankpads.id', 'tankpads.nama AS label', 'tankpads.nama AS value', 'tp_terbaru.harga', 'tankpads.ktrg')
            ->joinSub($tp_terbaru, 'tp_terbaru', function ($join) {
                $join->on('tankpads.id', '=', 'tp_terbaru.tankpad_id');
            })
            ->orderBy('tankpads.nama')->get();

        return $label_tankpads;
    }
}
