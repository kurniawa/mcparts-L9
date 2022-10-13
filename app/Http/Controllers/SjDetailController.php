<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Pelanggan;
use App\Models\SiteSetting;
use App\Models\SpkProdukNotaSrjalan;
use App\Models\Srjalan;
use Illuminate\Http\Request;

class SjDetailController extends Controller
{
    public function editColly(Request $request)
    {
        SiteSettings::loadNumToZero();

        $get = $request->query();
        // dd('$get:', $get);
        $srjalan_id=$get['srjalan_id'];

        $srjalan=Srjalan::find($srjalan_id);
        $pelanggan=Pelanggan::find($srjalan['pelanggan_id']);
        $reseller=null;
        if ($srjalan['reseller_id']!==null) {
            $reseller=Pelanggan::find($srjalan['reseller_id']);
        }
        // Hitungan Jumlah Colly dan Dus sesuai sistem
        $sProNoSjs=SpkProdukNotaSrjalan::where('srjalan_id',$srjalan['id'])->get();
        $jml_colly_sys=$jml_dus_sys=0;
        foreach ($sProNoSjs as $item) {
            if ($item['tipe_packing']==='colly' && $item['jml_packing']!==null) {
                $jml_colly_sys+=$item['colly'];
            } else if ($item['tipe_packing']==='dus' && $item['jml_packing']!==null) {
                $jml_dus_sys+=$item['dus'];
            }
        }

        $data = [
            'go_back' => true,
            'navbar_bg' => 'bg-color-orange-2',
            'srjalan' => $srjalan,
            'jml_colly_sys' => $jml_colly_sys,
            'jml_dus_sys' => $jml_dus_sys,
            'pelanggan' => $pelanggan,
            'reseller' => $reseller,
        ];

        // dump($data);

        return view('srjalan.editColly', $data);
    }

    public function editCollyDB(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true;
        $success_logs = $error_logs = $warning_logs=array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dd($post);
        $srjalan_id=$post['srjalan_id'];
        $jml_colly=$post['jml_colly'];
        $jml_dus=$post['jml_dus'];

        if ($run_db) {
            $srjalan=Srjalan::find($srjalan_id);
            $srjalan->jml_colly=$jml_colly;
            $srjalan->jml_dus=$jml_dus;
            $srjalan->save();

            $success_logs[]="Update Jumlah Packing Sr. Jalan berhasil!";
            $main_log='Success';
            $load_num->value+=1;
            $load_num->save();
        }


        $route='SJ-Detail';
        $route_btn='Ke Detail Sr. Jalan';
        $params=['srjalan_id'=>$srjalan_id];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }

    public function sjSelesai(Request $request)
    {
        SiteSettings::loadNumToZero();

        $show_dump = false;

        $get = $request->query();

        if ($show_dump) {
            dump('get', $get);
        }

        $sj = new Srjalan();
        list($srjalan, $pelanggan, $alamat, $reseller, $ekspedisi, $spk_produk_nota_srjalans, $spk_produk_notas, $spk_produks, $produks) = $sj->get_one_srjalan_and_components($get['srjalan_id']);

        $data = [
            'navbar_bg'=>'bg-color-orange-2',
            'go_back'=>true,
            'srjalan' => $srjalan,
            'pelanggan' => $pelanggan,
            'alamat' => $alamat,
            'reseller' => $reseller,
            'ekspedisi' => $ekspedisi,
            'spk_produk_nota_srjalans' => $spk_produk_nota_srjalans,
            'spk_produk_notas' => $spk_produk_notas,
            'spk_produks' => $spk_produks,
            'produks' => $produks,
        ];
        // dump($data);
        return view('srjalan.sjSelesai', $data);
    }

    public function sjSelesaiDB(Request $request)
    {

        $load_num = SiteSetting::find(1);
        $run_db = true;

        $success_logs = $error_logs =$warning_logs= array();
        $main_log = 'Ooops! Sepertinya ada kesalahan pada sistem, coba hubungi Admin atau Developer sistem ini!';

        if ($load_num->value > 0) {
            $run_db = false;
            $main_log = 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->post();
        // dump($post);
        $srjalan_id = $post['srjalan_id'];
        $finished_at=$post['tgl_selesai'];
        // dump($finished_at);
        // $finished_at=date('d-m-Y H:i:s', strtotime($finished_at));
        // dd($finished_at);

        if ($run_db) {
            $srjalan = Srjalan::find($srjalan_id);
            $srjalan->finished_at=$finished_at;
            $srjalan->save();

            $success_logs[]='Berhasil update tanggal selesai dari Sr. Jalan terkait!';

            $main_log = 'SUCCESS:';
        }

        $route='SJ-Detail';
        $route_btn='Ke Detail SJ';
        $params=['srjalan_id'=>$srjalan_id];
        $data = [
            'success_logs'=>$success_logs,'error_logs'=>$error_logs,'warning_logs'=>$warning_logs,'main_log'=>$main_log,
            'route'=>$route,'route_btn'=>$route_btn,'params'=>$params,
        ];

        return view('layouts.db-result', $data);
    }
}
