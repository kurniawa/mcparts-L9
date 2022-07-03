<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Motif extends Model
{
    use HasFactory;
    protected $guarded = ["id"];
    public $timestamps = false;

    public function motif_harga()
    {
        $motif_terbaru = DB::table('motif_hargas')->select('id', 'motif_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'motif_id', 'harga', 'created_at');

        $motif_harga = DB::table('motifs')->select('motifs.id', 'motifs.nama', 'motif_terbaru.harga', 'motifs.ktrg')
            ->joinSub($motif_terbaru, 'motif_terbaru', function ($join) {
                $join->on('motifs.id', '=', 'motif_terbaru.motif_id');
            })
            ->get();

        return $motif_harga;
    }
}
