<?php

namespace App\Http\Controllers;

use App\Models\Spk;
use App\Models\SpkNota;
use App\Models\SpkProdukNota;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\SpkSrjalan;
use Illuminate\Http\Request;

class SpkNotaController extends Controller
{
    //
    public function fix_relasi_spk_nota_srjalan()
    {
        $spks = Spk::all();
        foreach ($spks as $spk) {
            $nota_ids = SpkProdukNota::where('spk_id', $spk->id)->select('nota_id')->groupBy('nota_id')->get();
            foreach ($nota_ids as $nota_id) {
                SpkNota::create([
                    "spk_id" => $spk->id,
                    "nota_id" => $nota_id->id,
                ]);
            }
            $srjalan_ids = SpkProdukNotaSrjalan::where('spk_id', $spk->id)->select('srjalan_id')->groupBy('srjalan_id')->get();
            foreach ($srjalan_ids as $srjalan_id) {
                SpkSrjalan::create([
                    'spk_id' => $spk->id,
                    'srjalan_id' => $srjalan_id
                ]);
            }
        }
    }
}
