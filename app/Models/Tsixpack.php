<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Tsixpack extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function label_tsixpacks()
    {
        $tsixpack_terbaru = DB::table('tsixpack_hargas')
            ->select('id', 'tsixpack_id', 'harga', 'tipe_bahan', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'tsixpack_id', 'harga', 'tipe_bahan', 'created_at');

        $label_tsixpacks = DB::table('tsixpacks')
            ->select('tsixpacks.id', 'tsixpacks.nama AS label', 'tsixpacks.nama AS value', 'tsixpack_terbaru.harga', 'tsixpack_terbaru.tipe_bahan', 'tsixpacks.ktrg')
            ->joinSub($tsixpack_terbaru, 'tsixpack_terbaru', function ($join) {
                $join->on('tsixpacks.id', '=', 'tsixpack_terbaru.tsixpack_id');
            })
            ->orderBy('tsixpacks.nama')->get();

        return $label_tsixpacks;
    }

    public function label_tsixpacks_a()
    {
        $tsixpack_terbaru = DB::table('tsixpack_hargas')
            ->select('id', 'tsixpack_id', 'harga', 'tipe_bahan', DB::raw('MAX(created_at)'))
            ->where('tipe_bahan', 'A')
            ->groupBy('id', 'tsixpack_id', 'harga', 'tipe_bahan', 'created_at');

        $label_tsixpacks = DB::table('tsixpacks')
            ->select('tsixpacks.id', 'tsixpacks.nama AS label', 'tsixpacks.nama AS value', 'tsixpack_terbaru.harga', 'tsixpack_terbaru.tipe_bahan', 'tsixpacks.ktrg')
            ->joinSub($tsixpack_terbaru, 'tsixpack_terbaru', function ($join) {
                $join->on('tsixpacks.id', '=', 'tsixpack_terbaru.tsixpack_id');
            })
            ->orderBy('tsixpacks.nama')->get();

        return $label_tsixpacks;
    }

    public function label_tsixpacks_b()
    {
        $tsixpack_terbaru = DB::table('tsixpack_hargas')
            ->select('id', 'tsixpack_id', 'harga', 'tipe_bahan', DB::raw('MAX(created_at)'))
            ->where('tipe_bahan', 'B')
            ->groupBy('id', 'tsixpack_id', 'harga', 'tipe_bahan', 'created_at');

        $label_tsixpacks = DB::table('tsixpacks')
            ->select('tsixpacks.id', 'tsixpacks.nama AS label', 'tsixpacks.nama AS value', 'tsixpack_terbaru.harga', 'tsixpack_terbaru.tipe_bahan', 'tsixpacks.ktrg')
            ->joinSub($tsixpack_terbaru, 'tsixpack_terbaru', function ($join) {
                $join->on('tsixpacks.id', '=', 'tsixpack_terbaru.tsixpack_id');
            })
            ->orderBy('tsixpacks.nama')->get();

        return $label_tsixpacks;
    }
}
