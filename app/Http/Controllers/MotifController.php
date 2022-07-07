<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMotifRequest;
use App\Http\Requests\UpdateMotifRequest;
use App\Models\Motif;
use App\Models\Produk;
use App\Models\ProdukMotif;
use Illuminate\Http\Request;

class MotifController extends Controller
{
    public function motifFromProdukID(Request $request)
    {
        $get = $request->query();
        $motif = Produk::find($get['produk_id'])->motif;
        return $motif;
    }
}
