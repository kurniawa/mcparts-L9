<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class JapstyleController extends Controller
{
    public function japstyleFromProdukID(Request $request)
    {
        $get = $request->query();
        $japstyle = Produk::find($get['produk_id'])->japstyle;
        return $japstyle;
    }
}
