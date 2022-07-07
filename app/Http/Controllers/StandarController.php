<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreStandarRequest;
use App\Http\Requests\UpdateStandarRequest;
use App\Models\Produk;
use Illuminate\Http\Request;

class StandarController extends Controller
{
    public function standarFromProdukID(Request $request)
    {
        $get = $request->query();
        $standar = Produk::find($get['produk_id'])->standar;
        return $standar;
    }
}
