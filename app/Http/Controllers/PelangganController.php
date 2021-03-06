<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Http\Requests\StorePelangganRequest;
use App\Http\Requests\UpdatePelangganRequest;
use App\Models\Daerah;
use App\Models\Ekspedisi;
use App\Models\Negara;
use App\Models\Pelanggan;
use App\Models\PelangganEkspedisi;
use App\Models\Produk;
use App\Models\Pulau;
use App\Models\SiteSetting;
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

        $show_dump = false;

        $pelanggans = Pelanggan::all();

        if ($show_dump) {
            dump("pelanggans: ", $pelanggans);
        }

        /**LOOPING UNTUK DATA NEGARA, PULAU, DAERAH & RESELLER */
        $negaras = $pulaus = $daerahs = array();

        foreach ($pelanggans as $pelanggan) {
            $negara = $pulau = $daerah = $reseller = null;

            // dump('$reseller:');
            // dump($reseller);
            if ($pelanggan['negara_id'] !== null) {
                $negara = Negara::find($pelanggan['negara_id']);
            }
            if ($pelanggan['pulau_id'] !== null) {
                $pulau = Pulau::find($pelanggan['pulau_id']);
            }
            if ($pelanggan['daerah_id'] !== null) {
                $daerah = Daerah::find($pelanggan['daerah_id']);
            }
            array_push($negaras, $negara);
            array_push($pulaus, $pulau);
            array_push($daerahs, $daerah);
        }

        $data = [
            "pelanggans" => $pelanggans,
            "negaras" => $negaras,
            "pulaus" => $pulaus,
            "daerahs" => $daerahs,
        ];

        if ($show_dump) {
            dump("data: ", $data);
        }
        return view('pelanggan.pelanggans', $data);
    }

    public function pelanggan_detail(Request $request)
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $get = $request->query();
        $pelanggan = Pelanggan::find($get['cust_id']);
        $pelanggan_ekspedisi = PelangganEkspedisi::where('pelanggan_id', $pelanggan['id'])->get();
        $ekspedisis = array();
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

        if ($show_dump) {
            dump('get', $get);
            dump('pelanggan', $pelanggan);
            dump('pelanggan_ekspedisi:', $pelanggan_ekspedisi);
            dump('count(pelanggan_ekspedisi):', count($pelanggan_ekspedisi));
            dump('ekspedisis', $ekspedisis);
            dump('resellers', $resellers);
        }

        $data = [
            "cust_id" => $pelanggan['id'],
            "pelanggan" => $pelanggan,
            "pelanggan_ekspedisi" => $pelanggan_ekspedisi,
            "ekspedisis" => $ekspedisis,
            "jml_ekspedisi" => $jml_ekspedisi,
            "resellers" => $resellers,
            "pelanggan_produks" => $pelanggan_produks,
            "produks" => $produks,
            "hargas" => $hargas,
        ];

        return view('pelanggan.pelanggan-detail', $data);
    }
}
