<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Daerah extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function label_daerahs()
    {
        $label_daerahs = DB::table('daerahs')
            ->select('daerahs.id', 'daerahs.nama AS label', 'daerahs.nama AS value','daerahs.pulau_id', 'daerahs.negara_id')
            // ->orderBy('daerahs.nama')->get();
            ->get();

        return $label_daerahs;
    }
}
