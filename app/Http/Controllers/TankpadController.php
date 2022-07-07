<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTankpadRequest;
use App\Http\Requests\UpdateTankpadRequest;
use App\Models\Produk;
use App\Models\Tankpad;
use Illuminate\Http\Request;

class TankpadController extends Controller
{
    public function tankpadFromProdukID(Request $request)
    {
        $get = $request->query();
        $tankpad = Produk::find($get['produk_id'])->tankpad;
        return $tankpad;
    }
}
