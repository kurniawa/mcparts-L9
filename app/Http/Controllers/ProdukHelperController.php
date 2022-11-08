<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use Illuminate\Http\Request;

class ProdukHelperController extends Controller
{
    public function produkEditNama(Request $request)
    {
        $_success=$_warnings=$_errors="";
        $post=$request->post();
        $produk_id=$post['produk_id'];
        $nama=$post['nama'];
        $nama_nota=$post['nama_nota'];
        // $created_at=date('d-m-Y H:i:s', strtotime($post['tgl_pembuatan']));
        // dd($post);
        $produk=Produk::find($produk_id);

        $produk->update([
            'nama'=>$nama,
            'nama_nota'=>$nama_nota,
        ]);
        $_success.="_ nama dan nama_nota untuk $produk[nama] telah diupdate!";

        $_logs=["_success"=>$_success,"_warnings"=>$_warnings,"_errors"=>$_errors];
        return back()->with($_logs);
    }
}
