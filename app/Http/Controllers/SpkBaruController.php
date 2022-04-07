<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Daerah;
use App\Models\Pelanggan;
use App\Models\PelangganReseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpkBaruController extends Controller
{
    public function index()
    {
        //**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        $load_num = SiteSettings::loadNumToZero();

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = true;
        $load_num_ignore = true;
        // Pada development mode, load number boleh diignore. Yang perlu diperhatikan adalah
        // insert dan update database supaya tidak berantakan
        if ($show_hidden_dump) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && !$load_num_ignore) {
            $run_db = false;
        }
        // $pelanggan = new Pelanggan();
        // $label_pelanggans = $pelanggan->label_pelanggans();
        // $pelanggan_resellers = PelangganReseller::orderBy('reseller_id')->get();
        $pelanggans = Pelanggan::all();
        $label_pelanggans = array();
        foreach ($pelanggans as $pelanggan) {
            $pelanggan_resellers = PelangganReseller::where('pelanggan_id', $pelanggan['id'])->get();

            if ($show_dump) {
                dump('pelanggan$pelanggan_resellers:', $pelanggan_resellers);
                // dd('pelanggan$pelanggan_resellers[items]:', $pelanggan_resellers->items);
                dump('count pelanggan$pelanggan_resellers:', count($pelanggan_resellers));
            }

            if (count($pelanggan_resellers) !== 0) {
                foreach ($pelanggan_resellers as $pelanggan_reseller) {
                    $nama_reseller = Pelanggan::find($pelanggan_reseller['reseller_id'])['nama'];
                    $label_nama = "$nama_reseller: " . $pelanggan['nama'];

                    $arr_to_push = [
                        "id" => $pelanggan['id'],
                        "reseller_id" => $pelanggan_reseller['reseller_id'],
                        "label" => $label_nama,
                        "value" => $label_nama,
                    ];

                    array_push($label_pelanggans, $arr_to_push);
                }
            }

            $label_nama = $pelanggan['nama'];

            $arr_to_push = [
                "id" => $pelanggan['id'],
                "reseller_id" => null,
                "label" => $label_nama,
                "value" => $label_nama,
            ];

            array_push($label_pelanggans, $arr_to_push);
        }

        if ($show_dump === true) {
            dump("label_pelanggans");
            dump($label_pelanggans);
            // dump('$pelanggan_resellers:', $pelanggan_resellers);
        }

        // $d_nama_pelanggan_2 = $pelanggan->d_nama_pelanggan_2();
        // dd($d_label_pelanggan);
        // dd($d_label_pelanggan_2);

        $data = [
            'label_pelanggans' => $label_pelanggans,
            // 'pelanggan_resellers' => $pelanggan_resellers,
        ];

        return view('spk.spk-baru', $data);
    }

    public function inserting_spk_items(Request $request)
    {
        //**SETTINGAN AWAL PAGE NETRAL TANPA INSERT ATAU UPDATE DB */
        $load_num = SiteSettings::loadNumToZero();

        $show_dump = false;
        $show_hidden_dump = false;
        $run_db = false;
        $load_num_ignore = true;

        if ($show_hidden_dump === true) {
            dump("load_num_value: " . $load_num->value);
        }

        if ($load_num->value > 0 && $load_num_ignore === false) {
            $run_db = false;
        }
        $get = $request->query();
        // #
        // Karena akan sering bolak balik halaman ini, maka request methodnya ditetapkan menjadi GET
        $pelanggan = Pelanggan::find($get['pelanggan_id']);
        $daerah = Daerah::find($pelanggan['daerah_id']);
        $reseller = null;
        if ($get['reseller_id'] !== null) {
            $reseller = Pelanggan::find($get['reseller_id']);
        }
        $judul = $get['judul'];
        $tanggal = date('d-m-Y', strtotime($get['tanggal']));
        $spk_item = DB::table('temp_spk_produks')->get();

        if ($show_dump) {
            dump("get");
            dump($get);
            dump("pelanggan");
            dump($pelanggan);
        }

        $data = [
            'pelanggan' => $pelanggan,
            'daerah' => $daerah,
            'reseller' => $reseller,
            'judul' => $judul,
            'spk_item' => $spk_item,
            'tanggal' => $tanggal,
        ];

        return view('spk.spk_baru-inserting_spk_items', $data);
    }
}
