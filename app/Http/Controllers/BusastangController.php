<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBusastangRequest;
use App\Http\Requests\UpdateBusastangRequest;
use App\Models\Busastang;
use App\Models\Produk;
use Illuminate\Http\Request;

class BusastangController extends Controller
{
    public function busastangFromProdukID(Request $request)
    {
        $get = $request->query();
        $busastang = Produk::find($get['produk_id'])->busastang;
        return $busastang;
    }
}
