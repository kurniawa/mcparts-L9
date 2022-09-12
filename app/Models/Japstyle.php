<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Japstyle extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function label_japstyles()
    {
        $japstyle_terbaru = DB::table('japstyle_hargas')
            ->select('id', 'japstyle_id', 'harga', 'tipe_bahan', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'japstyle_id', 'harga', 'tipe_bahan', 'created_at');

        $label_japstyles = DB::table('japstyles')
            ->select('japstyles.id', 'japstyles.nama AS label', 'japstyles.nama AS value', 'japstyle_terbaru.harga', 'japstyle_terbaru.tipe_bahan', 'japstyles.ktrg')
            ->joinSub($japstyle_terbaru, 'japstyle_terbaru', function ($join) {
                $join->on('japstyles.id', '=', 'japstyle_terbaru.japstyle_id');
            })
            ->orderBy('japstyles.nama')->get();

        return $label_japstyles;
    }

    public function label_japstyles_a()
    {
        $japstyle_terbaru = DB::table('japstyle_hargas')
            ->select('id', 'japstyle_id', 'harga', 'tipe_bahan', DB::raw('MAX(created_at)'))
            ->where('tipe_bahan', 'A')
            ->groupBy('id', 'japstyle_id', 'harga', 'tipe_bahan', 'created_at');

        $label_japstyles = DB::table('japstyles')
            ->select('japstyles.id', 'japstyles.nama AS label', 'japstyles.nama AS value', 'japstyle_terbaru.harga', 'japstyle_terbaru.tipe_bahan', 'japstyles.ktrg')
            ->joinSub($japstyle_terbaru, 'japstyle_terbaru', function ($join) {
                $join->on('japstyles.id', '=', 'japstyle_terbaru.japstyle_id');
            })
            ->orderBy('japstyles.nama')->get();

        return $label_japstyles;
    }

    public function label_japstyles_b()
    {
        $japstyle_terbaru = DB::table('japstyle_hargas')
            ->select('id', 'japstyle_id', 'harga', 'tipe_bahan', DB::raw('MAX(created_at)'))
            ->where('tipe_bahan', 'B')
            ->groupBy('id', 'japstyle_id', 'harga', 'tipe_bahan', 'created_at');

        $label_japstyles = DB::table('japstyles')
            ->select('japstyles.id', 'japstyles.nama AS label', 'japstyles.nama AS value', 'japstyle_terbaru.harga', 'japstyle_terbaru.tipe_bahan', 'japstyles.ktrg')
            ->joinSub($japstyle_terbaru, 'japstyle_terbaru', function ($join) {
                $join->on('japstyles.id', '=', 'japstyle_terbaru.japstyle_id');
            })
            ->orderBy('japstyles.nama')->get();

        return $label_japstyles;
    }
}
