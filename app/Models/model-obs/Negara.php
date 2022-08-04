<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Negara extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public $timestamps = false;

    public function label_negaras()
    {
        $label_negaras = DB::table('negaras')
            ->select('negaras.id', 'negaras.nama AS label', 'negaras.nama AS value')
            ->orderBy('negaras.nama')->get();

        return $label_negaras;
    }
}
