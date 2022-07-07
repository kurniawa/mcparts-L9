<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class KombinasiController extends Controller
{
    public function kombinasiFromProdukID(Request $request)
    {
        $get = $request->query();
        $kombinasi = Produk::find($get['produk_id'])->kombinasi;
        return $kombinasi;
    }
}
