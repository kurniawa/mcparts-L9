<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ekspedisi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function label_ekspedisis()
    {
        // $sql = "SELECT pulaus.id, pulaus.nama AS label, pulaus.nama AS value, pulaus_terbaru.harga FROM pulaus INNER JOIN
        // (SELECT id, pulaus_id, harga, MAX(tanggal) FROM pulaus_harga GROUP BY pulaus_id) AS pulaus_terbaru
        // ON pulaus.id=pulaus_terbaru.pulaus_id";

        // $pulaus_terbaru = DB::table('pulaus_harga')
        //     ->selectRaw('id, pulaus_id, harga, MAX(created_at)')
        //     ->groupBy('pulaus_id');

        // $pulaus_terbaru = DB::table('pulaus_harga')
        //     ->selectRaw('id, pulaus_id, harga, MAX(created_at) GROUP BY pulaus_id');

        $label_ekspedisis = DB::table('ekspedisis')
            ->select('ekspedisis.id', 'ekspedisis.nama AS label', 'ekspedisis.nama AS value')
            ->orderBy('ekspedisis.nama')->get();

        return $label_ekspedisis;
    }
}
