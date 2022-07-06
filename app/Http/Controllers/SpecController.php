<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class SpecController extends Controller
{
    public function specsFromProdukID(Request $request)
    {
        $get = $request->query();
        $specs = Produk::find($get['produk_id'])->specs;

        return $specs;
    }
}
