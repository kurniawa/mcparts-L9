<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukHarga;
use Illuminate\Http\Request;

class ProdukHargaController extends Controller
{
    public function produkHargaEdit(Request $request)
    {
        $_success=$_warnings=$_errors="";
        $post=$request->post();
        // dd($post);
        $produk_id=$post['produk_id'];
        $produk_harga_id=$post['produk_harga_id'];
        $harga=$post['harga'];
        $produk_harga=ProdukHarga::find($produk_harga_id);
        $harga_before=$produk_harga['harga'];
        $produk=Produk::find($produk_id);

        $produk_harga->update([
            'harga'=>$harga,
        ]);
        $_success.="_ $produk->nama - harga_before: $harga_before - harga_after: $produk_harga->harga";

        $_logs=["_success"=>$_success,"_warnings"=>$_warnings,"_errors"=>$_errors];
        return back()->with($_logs);
    }

    public function produkHargaEditHistori(Request $request)
    {
        $_success=$_warnings=$_errors="";
        $post=$request->post();
        dd($post);
        $produk_harga_id=$post['produk_harga_id'];
        $harga=$post['harga'];
        $status=$post['status'];
        // $created_at=date('d-m-Y H:i:s', strtotime($post['tgl_pembuatan']));
        // dd($post);
        $produk_harga=ProdukHarga::find($produk_harga_id);
        $produk=Produk::find($produk_harga['produk_id']);
        // apabila status di set sebagai default, maka tidak boleh ada produk_harga lain yang diset sebagai default
        if ($status==='DEFAULT') {
            $produk_harga_default_other=ProdukHarga::where('produk_id',$produk['id'])->where('id','!=',$produk_harga_id)->where('status','DEFAULT')->first();
            if ($produk_harga_default_other!==null) {
                $produk_harga_default_other->update([
                    'status'=>'LAMA'
                ]);
                $_success.="_ Ditemukan adanya produk_harga lain yang telah di set sebagi default. Status produk_harga lain itu akan diset";
            }
        }

        $produk_harga->update([
            'harga'=>$harga,
            'status'=>$status,
        ]);
        $_success.="_ nama dan nama_nota untuk $produk[nama] telah diupdate!";

        $_logs=["_success"=>$_success,"_warnings"=>$_warnings,"_errors"=>$_errors];
        return back()->with($_logs);
    }

    public function produkHargaHapus(Request $request)
    {
        $_success=$_warnings=$_errors="";
        $post=$request->post();
        $produk_harga_id=$post['produk_harga_id'];
        $harga=$post['harga'];
        $status=$post['status'];
        // $created_at=date('d-m-Y H:i:s', strtotime($post['tgl_pembuatan']));
        // dd($post);
        $produk_harga=ProdukHarga::find($produk_harga_id);
        $produk=Produk::find($produk_harga['produk_id']);
        // cek jangan2 produk_harga nya memang tinggal satu ini, pencegahan terjadinya error karena tida ada produk_harga sama sekali
        $produk->update([
        ]);
        $_success.="_ nama dan nama_nota untuk $produk[nama] telah diupdate!";

        $_logs=["_success"=>$_success,"_warnings"=>$_warnings,"_errors"=>$_errors];
        return back()->with($_logs);
    }
}
