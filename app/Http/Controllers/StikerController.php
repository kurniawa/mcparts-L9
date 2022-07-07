<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStikerRequest;
use App\Http\Requests\UpdateStikerRequest;
use App\Models\Produk;
use App\Models\Stiker;
use Illuminate\Http\Request;

class StikerController extends Controller
{
    public function stikerFromProdukID(Request $request)
    {
        $get = $request->query();
        $stiker = Produk::find($get['produk_id'])->stiker;
        return $stiker;
    }
}
