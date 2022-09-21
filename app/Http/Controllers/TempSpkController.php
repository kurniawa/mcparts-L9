<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use App\Models\Spk;
use App\Models\TempSpk;
use Illuminate\Http\Request;

class TempSpkController extends Controller
{
    public function delete_temp_spk(Request $request)
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

        // dump('$post:', $post);

        $temp_spk = TempSpk::find($post['temp_spk_id']);

        if ($run_db) {
            $temp_spk->delete();
            $success_logs[]="temp_spk berhasil dihapus!";
            $main_log = "SUCCESS";
            $load_num->value+=1;
            $load_num->save();
        }

        $route='SPK';
        $route_btn='Ke Laman SPK';
        $data = [
            'success_logs' => $success_logs,'error_logs' => $error_logs,'warning_logs'=>$warning_logs,'main_log' => $main_log,
            'route'=>$route,'route_btn'=>$route_btn,
        ];

        return view('layouts.db-result', $data);
    }
}
