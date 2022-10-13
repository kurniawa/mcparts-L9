<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        SiteSettings::loadNumToZero();

        $user=auth()->user();

        $data = [
            'user'=>$user,
        ];
        // dd($data);
        return view('home', $data);
    }
}
