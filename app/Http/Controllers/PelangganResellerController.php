<?php

namespace App\Http\Controllers;

use App\Models\Alamat;
use App\Models\Pelanggan;
use App\Models\PelangganAlamat;
use App\Models\PelangganKontak;
use App\Models\PelangganReseller;
use Illuminate\Http\Request;

class PelangganResellerController extends Controller
{
    public function index(Request $request)
    {
        $get = $request->query();
        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $reseller = null;
        $alamat_reseller = null;
        $kontak_reseller = null;
        if ($pelanggan->reseller_id !== null) {
            $reseller = Pelanggan::find($pelanggan->reseller_id);
            $alamat_reseller = PelangganAlamat::where('pelanggan_id',$reseller->id)->first();
            if ($alamat_reseller !== null) {
                $alamat_reseller = Alamat::find($alamat_reseller->alamat_id);
            }
            $kontak_reseller = PelangganKontak::where('pelanggan_id', $reseller->id)->first();
        }

        $resellers = Pelanggan::where('id','!=',$pelanggan->id)->get();
        $list_of_resellers = [];
        foreach ($resellers as $reseller_this) {
            $list_of_resellers[] = [
                'label'=>$reseller_this->nama,
                'value'=>$reseller_this->nama,
                'id'=>$reseller_this->id,
            ];
        }

        $data = [
            'pelanggan'=>$pelanggan,
            'reseller'=>$reseller,
            'alamat_reseller'=>$alamat_reseller,
            'kontak_reseller'=>$kontak_reseller,
            'list_of_resellers'=>$list_of_resellers,
            'csrf'=>csrf_token(),
        ];
        return view('pelanggan.tetapkan-reseller', $data);
    }
    public function tetapkan_reseller_db(Request $request)
    {
        $post = $request->post();
        $request->validate(['reseller_nama'=>'required','reseller_id'=>'required','pelanggan_id'=>'required']);
        $reseller = Pelanggan::find($post['reseller_id']);
        if ($reseller === null) {
            $request->validate(['error'=>'required'],['error.required'=>'Reseller tidak ditemukan!']);
        }
        // dd($post);
        $pelanggan = Pelanggan::find($post['pelanggan_id']);
        $pelanggan->update(['reseller_id'=>$reseller->id]);
        return redirect()->route('pelanggan_detail',['pelanggan_id'=>$pelanggan->id])->with('success_','Reseller telah ditetapkan!');

    }
    public function hapus_reseller(Request $request)
    {
        $post = $request->post();
        // dd($post);
        $pelanggan=Pelanggan::find($post['pelanggan_id']);
        $pelanggan->update(['reseller_id'=>null]);
        return redirect()->route('pelanggan_detail',['pelanggan_id'=>$pelanggan->id])->with('warnings_','Relasi Reseller telah dihapus!');
    }
}
