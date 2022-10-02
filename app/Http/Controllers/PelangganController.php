<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Alamat;
use App\Models\Ekspedisi;
use App\Models\Pelanggan;
use App\Models\PelangganAlamat;
use App\Models\PelangganEkspedisi;
use App\Models\PelangganKontak;
use App\Models\Produk;
use Illuminate\Http\Request;

class PelangganController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        SiteSettings::loadNumToZero();

        $pelanggans = Pelanggan::all();
        $pelanggan_alamats=$alamats=$pelanggan_kontaks=array();
        foreach ($pelanggans as $pelanggan) {
            $pelanggan_alamat=PelangganAlamat::where('pelanggan_id',$pelanggan['id'])->where('tipe','UTAMA')->first();
            $alamat=null;
            if ($pelanggan_alamat!==null) {
                $alamat=Alamat::find($pelanggan_alamat['alamat_id']);
            }
            $pelanggan_kontak=PelangganKontak::where('pelanggan_id',$pelanggan['id'])->where('is_aktual','yes')->first();

            $pelanggan_alamats[]=$pelanggan_alamat;
            $alamats[]=$alamat;
            $pelanggan_kontaks[]=$pelanggan_kontak;
        }

        $menus=[
            ['route'=>'pelanggan_baru','nama'=>'+Pelanggan Baru','method'=>'get'],
        ];
        $data = [
            "menus" => $menus,
            "pelanggans" => $pelanggans,
            "pelanggan_alamats" => $pelanggan_alamats,
            "alamats" => $alamats,
            "pelanggan_kontaks" => $pelanggan_kontaks,
        ];

        return view('pelanggan.pelanggans', $data);
    }

    public function pelanggan_detail(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();
        // dd($get);
        // dump($get);
        $pelanggan_id=$get['pelanggan_id'];
        $pelanggan = Pelanggan::find($pelanggan_id);
        $pelanggan_ekspedisi = PelangganEkspedisi::where('pelanggan_id', $pelanggan['id'])->get();
        $ekspedisis=array();
        $jml_ekspedisi = count($pelanggan_ekspedisi);
        $resellers = $pelanggan->resellers;

        if (count($pelanggan_ekspedisi) !== 0) {
            for ($i_pelangganEkspedisi=0; $i_pelangganEkspedisi < count($pelanggan_ekspedisi); $i_pelangganEkspedisi++) {
                $ekspedisi = Ekspedisi::find($pelanggan_ekspedisi[$i_pelangganEkspedisi]['ekspedisi_id']);
                array_push($ekspedisis, $ekspedisi);
            }
        }

        $obj_produk = new Produk();
        list($pelanggan_produks, $produks, $hargas) = $obj_produk->produksThisPelanggan($pelanggan['id']);

        /**GET ALAMAT */
        $pelanggan_alamats=PelangganAlamat::where('pelanggan_id',$pelanggan_id)->get();
        $alamats=array();
        foreach ($pelanggan_alamats as $pelanggan_alamat) {
            $alamat=Alamat::find($pelanggan_alamat['alamat_id']);
            $alamats[]=$alamat;
        }

        /**GET KONTAK */
        $pelanggan_kontaks=PelangganKontak::where('pelanggan_id',$pelanggan_id)->get();

        $menus=[
            ['route'=>'pelanggan_edit','nama'=>'Edit','method'=>'get','params'=>[['name'=>'pelanggan_id','value'=>$pelanggan['id']],]],
            ['route'=>'pelanggan_tambah_ekspedisi','nama'=>'+Ekspedisi','method'=>'get','params'=>[['name'=>'pelanggan_id','value'=>$pelanggan['id']],]],
            ['route'=>'pelanggan_tambah_reseller','nama'=>'+Reseller','method'=>'get','params'=>[['name'=>'pelanggan_id','value'=>$pelanggan['id']],]],
            ['route'=>'pelanggan_tambah_alamat','nama'=>'+Alamat','method'=>'get','params'=>[['name'=>'pelanggan_id','value'=>$pelanggan['id']],]],
            ['route'=>'pelanggan_tambah_kontak','nama'=>'+Kontak','method'=>'get','params'=>[['name'=>'pelanggan_id','value'=>$pelanggan['id']],]],
            ['route'=>'pelanggan_hapus','nama'=>'Hapus','method'=>'post','params'=>[['name'=>'pelanggan_id','value'=>$pelanggan['id']],],'confirm'=>'Anda yakin ingin menghapus Pelanggan ini?'],
        ];

        $data = [
            'go_back'=>true,
            'navbar_bg'=>'bg-color-orange-2',
            "pelanggan_id" => $pelanggan['id'],
            "pelanggan" => $pelanggan,
            "pelanggan_ekspedisi" => $pelanggan_ekspedisi,
            "ekspedisis" => $ekspedisis,
            "jml_ekspedisi" => $jml_ekspedisi,
            "resellers" => $resellers,
            "pelanggan_produks" => $pelanggan_produks,
            "produks" => $produks,
            "hargas" => $hargas,
            "menus" => $menus,
            "alamats" => $alamats,
            "pelanggan_alamats" => $pelanggan_alamats,
            "pelanggan_kontaks" => $pelanggan_kontaks,
        ];

        // dd($data);

        return view('pelanggan.pelanggan-detail', $data);
    }
}
