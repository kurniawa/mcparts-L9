<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Pulau extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function label_pulaus()
    {
        // $sql = "SELECT pulaus.id, pulaus.nama AS label, pulaus.nama AS value, pulaus_terbaru.harga FROM pulaus INNER JOIN
        // (SELECT id, pulaus_id, harga, MAX(tanggal) FROM pulaus_harga GROUP BY pulaus_id) AS pulaus_terbaru
        // ON pulaus.id=pulaus_terbaru.pulaus_id";

        // $pulaus_terbaru = DB::table('pulaus_harga')
        //     ->selectRaw('id, pulaus_id, harga, MAX(created_at)')
        //     ->groupBy('pulaus_id');

        // $pulaus_terbaru = DB::table('pulaus_harga')
        //     ->selectRaw('id, pulaus_id, harga, MAX(created_at) GROUP BY pulaus_id');

        $label_pulaus = DB::table('pulaus')
            ->select('pulaus.id', 'pulaus.nama AS label', 'pulaus.nama AS value', 'pulaus.negara_id')
            ->orderBy('pulaus.nama')->get();

        return $label_pulaus;
    }
}
