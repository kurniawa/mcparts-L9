<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function home()
    {
        SiteSettings::loadNumToZero();

        $user=auth()->user();

        $data = [
            'user'=>$user,
        ];
        // dd($data);
        return view('home', $data);
    }
    public function about()
    {
        SiteSettings::loadNumToZero();

        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
        ];
        // dd($data);
        return view('about.about', $data);
    }

    public function adminControlCenter()
    {
        SiteSettings::loadNumToZero();

        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
        ];
        // dd($data);
        return view('admin.control-center', $data);
    }

    public function pageInDev()
    {
        $data=[
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2'
        ];
        return view('layouts.page-in-dev',$data);
    }

}
