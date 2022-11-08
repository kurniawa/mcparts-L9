<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Alamat;
use App\Models\Ekspedisi;
use App\Models\EkspedisiAlamat;
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

        // for ($i=0; $i < count($alamats); $i++) {
        //     try {
        //         $longs=json_decode($alamats[$i]['long'],true);
        //         foreach ($longs as $long) {
        //             echo $long;
        //         }
        //     } catch (\Throwable $err) {
        //         dump($err);
        //         dump($longs);
        //         dump($alamats[$i]);
        //     }
        // }
        // dd($alamats);

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
        $pelanggan_ekspedisis = PelangganEkspedisi::where('pelanggan_id', $pelanggan['id'])->get();
        $jml_ekspedisi = count($pelanggan_ekspedisis);
        $resellers = $pelanggan->resellers;

        $eks_normals=$eks_normal_alamats=$alamat_of_eks_normals=$cust_eks_normals=array();
        $eks_transits=$eks_transit_alamats=$alamat_of_eks_transits=$cust_eks_transits=array();
        if (count($pelanggan_ekspedisis) !== 0) {
            for ($i=0; $i < count($pelanggan_ekspedisis); $i++) {
                // dari ekspedisi_id, dikelompokkan apakah ekspedisi_normal atau ekspedisi_transit
                if ($pelanggan_ekspedisis[$i]['is_transit']==='no') {
                    $eks_normal = Ekspedisi::find($pelanggan_ekspedisis[$i]['ekspedisi_id']);
                    if ($eks_normal!==null) {
                        $eks_normal_alamat=EkspedisiAlamat::where('ekspedisi_id',$eks_normal['id'])->first();
                        try {
                            //code...
                            $alamat_of_eks_normal= Alamat::find($eks_normal_alamat['alamat_id']);
                        } catch (\Throwable $err) {
                            dump($eks_normal);
                            dump($eks_normal_alamat);
                            dump($err);
                        }

                        array_push($eks_normals, $eks_normal);
                        $eks_normal_alamats[]=$eks_normal_alamat;
                        $alamat_of_eks_normals[]=$alamat_of_eks_normal;
                        $cust_eks_normals[]=$pelanggan_ekspedisis[$i];
                    }
                } else {
                    $eks_transit = Ekspedisi::find($pelanggan_ekspedisis[$i]['ekspedisi_id']);
                    if ($eks_transit!==null) {
                        $eks_transit_alamat=EkspedisiAlamat::where('ekspedisi_id',$eks_transit['id'])->where('tipe','UTAMA')->first();
                        $alamat_of_eks_transit= Alamat::find($eks_transit_alamat['alamat_id']);

                        array_push($eks_transits, $eks_transit);
                        $eks_transit_alamats[]=$eks_transit_alamat;
                        $alamat_of_eks_transits[]=$alamat_of_eks_transit;
                        $cust_eks_transits[]=$pelanggan_ekspedisis[$i];
                    }
                }
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
            "pelanggan_ekspedisis" => $pelanggan_ekspedisis,
            "eks_normals" => $eks_normals,
            "eks_normal_alamats" => $eks_normal_alamats,
            "alamat_of_eks_normals" => $alamat_of_eks_normals,
            "cust_eks_normals" => $cust_eks_normals,
            "eks_transits" => $eks_transits,
            "eks_transit_alamats" => $eks_transit_alamats,
            "alamat_of_eks_transits" => $alamat_of_eks_transits,
            "cust_eks_transits" => $cust_eks_transits,
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
        // dump($data);

        return view('pelanggan.pelanggan-detail', $data);
    }
}
