<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBahanRequest;
use App\Http\Requests\UpdateBahanRequest;
use App\Models\Bahan;
use App\Models\Produk;
use Illuminate\Http\Request;

class BahanController extends Controller
{
    public function bahanFromProdukID(Request $request)
    {
        $get = $request->query();
        $bahan = Produk::find($get['produk_id'])->bahan;
        return $bahan;
    }
}
