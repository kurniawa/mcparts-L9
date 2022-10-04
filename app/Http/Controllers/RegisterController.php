<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $data=[
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
        ];
        return view('login.register',$data);
    }

    public function store(Request $request)
    {
        // $post=$request->post();
        // dd($post);
        $validatedData = $request->validate([
            'nama' => 'required|min:3|max:255',
            'username' => 'required|min:3|max:50|unique:users',
            'password' => 'required|min:6|max:255',
        ]);
        // dd($request->all());

        $validatedData['password'] = bcrypt($validatedData['password']);
        // ada dua metode untuk hash password, tapi keduanya sama fungsinya
        // $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);

        // $request->session()->flash('success', "Registrasi berhasil! Silahkan login!");
        // dump('User berhasil dibuat!');
        // dump($validatedData);

        return view('login.succeed')->with('success', 'Registrasi berhasil! Silahkan login!');
    }
}
