<?php

namespace App\Http\Controllers;

use App\Models\SpkNota;
use Illuminate\Http\Request;

class TestController extends Controller
{
    public function index()
    {
        $spk_nota = SpkNota::where('spk_id', 1)->where('nota_id', 1)->first();
        dump($spk_nota);
        $spk_nota = SpkNota::where('spk_id', 4)->where('nota_id', 1)->first();
        dump($spk_nota);
    }
}
