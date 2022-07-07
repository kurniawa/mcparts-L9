<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class TsixpackController extends Controller
{
    public function tsixpackFromProdukID(Request $request)
    {
        $get = $request->query();
        $tsixpack = Produk::find($get['produk_id'])->tsixpack;
        return $tsixpack;
    }
}
