<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Spec extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function specs_harga()
    {
        $spec_terbaru = DB::table('spec_hargas')
            ->select('id', 'spec_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'spec_id', 'harga', 'created_at');

        $specs_harga = DB::table('specs')
            ->select('specs.id', 'specs.nama', 'specs.nama_nota', 'spec_terbaru.harga')
            ->joinSub($spec_terbaru, 'spec_terbaru', function ($join) {
                $join->on('specs.id', '=', 'spec_terbaru.spec_id');
            })
            ->orderBy('specs.nama')->get();

        return $specs_harga;
    }
}
