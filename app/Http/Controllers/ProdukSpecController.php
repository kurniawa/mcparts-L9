<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Bahan;
use App\Models\BahanHarga;
use App\Models\SiteSetting;
use App\Models\Spec;
use App\Models\Varian;
use App\Models\Variasi;
use App\Models\VariasiHarga;
use Illuminate\Http\Request;

class ProdukSpecController extends Controller
{
    public function produkDanSpecs()
    {
        SiteSettings::loadNumToZero();
        $colors=['primary','warning','danger','success','ck','info','dd'];
        $specs=['Bahan','Variasi','Varian','Ukuran','Jahit','Kombinasi','Motif','Tsixpack','Standar','Tankpad','Stiker','Busastang','JokAssy','Rol','Rotan','List','Alas','Busa','GradeBahan'];
        $data=['go_back'=>true,'navbar_bg'=>'bg-color-orange-2','colors'=>$colors,'specs'=>$specs];
        // dd($data);
        // dump($data);
        return view('produk.tambah-produk',$data);
    }

    public function daftarSpec(Request $request)
    {
        SiteSettings::loadNumToZero();
        $get=$request->query();
        $tipe=$get['tipe'];
        // dd($get);
        /**Get semua Specs yang ada berikut harganya */
        $bahans=$bahan_hargas=$variasis=$variasi_hargas=$varians=$ukurans=$ukuran_hargas=$jahits=$jahit_hargas=$kombinasis=$kombinasi_hargas=null;
        $motifs=$motif_hargas=$tsixpacks=$tsixpack_hargas=$standars=$tankpads=$tankpad_hargas=$stikers=$stiker_hargas=$busastangs=$busastang_hargas=null;
        $jokassies=$jokassy_hargas=$rols=$rol_hargas=$rotans=$rotan_hargas=$lists=$list_hargas=$alass=$alas_hargas=$busas=$busa_hargas=$grade_bahans=$grade_bahan_hargas=null;
        if ($tipe==='Bahan') {
            list($bahans,$bahan_hargas)=Spec::getBahanAll_wPrices();
        } elseif ($tipe==='Variasi') {
            list($variasis,$variasi_hargas)=Spec::getVariasiAll_wPrices();
        } elseif ($tipe==='Varian') {
            $varians=Varian::all();
        } elseif ($tipe==='Ukuran') {
            list($ukurans,$ukuran_hargas)=Spec::getUkuranAll_wPrices();
        } elseif ($tipe==='Jahit') {
            list($jahits,$jahit_hargas)=Spec::getJahitAll_wPrices();
        } elseif ($tipe==='Kombinasi') {
            list($kombinasis,$kombinasi_hargas)=Spec::getKombinasiAll_wPrices();
        } elseif ($tipe==='Motif') {
            list($motifs,$motif_hargas)=Spec::getMotifAll_wPrices();
        } elseif ($tipe==='Tsixpack') {
            list($tsixpacks,$tsixpack_hargas)=Spec::getTsixpackAll_wPrices();
        } elseif ($tipe==='Standar') {
            list($standars)=Spec::getStandarAll_wPrices();
        } elseif ($tipe==='Tankpad') {
            list($tankpads,$tankpad_hargas)=Spec::getTankpadAll_wPrices();
        } elseif ($tipe==='Stiker') {
            list($stikers,$stiker_hargas)=Spec::getStikerAll_wPrices();
        } elseif ($tipe==='Busastang') {
            list($busastangs,$busastang_hargas)=Spec::getBusastangAll_wPrices();
        } elseif ($tipe==='JokAssy') {
            list($jokassies,$jokassy_hargas)=Spec::getJokassyAll_wPrices();
        } elseif ($tipe==='Rol') {
            list($rols,$rol_hargas)=Spec::getRolAll_wPrices();
        } elseif ($tipe==='Rotan') {
            list($rotans,$rotan_hargas)=Spec::getRotanAll_wPrices();
        } elseif ($tipe==='List') {
            list($lists,$list_hargas)=Spec::getListAll_wPrices();
        } elseif ($tipe==='Alas') {
            list($alass,$alas_hargas)=Spec::getAlasAll_wPrices();
        } elseif ($tipe==='Busa') {
            list($busas,$busa_hargas)=Spec::getBusaAll_wPrices();
        } elseif ($tipe==='GradeBahan') {
            list($grade_bahans,$grade_bahan_hargas)=Spec::getGradeBahanAll_wPrices();
        }

        $menus=null;

        $data=[
            'go_back'=>true,'navbar_bg'=>'bg-color-orange-2',
            'menus'=>$menus,
            'tipe'=>$tipe,
            'bahans'=>$bahans,
            'variasis'=>$variasis,
            'varians'=>$varians,
            'ukurans'=>$ukurans,
            'jahits'=>$jahits,
            'kombinasis'=>$kombinasis,
            'motifs'=>$motifs,
            'tsixpacks'=>$tsixpacks,
            'standars'=>$standars,
            'tankpads'=>$tankpads,
            'stikers'=>$stikers,
            'busastangs'=>$busastangs,
            'jokassies'=>$jokassies,
            'rols'=>$rols,
            'rotans'=>$rotans,
            'lists'=>$lists,
            'alass'=>$alass,
            'busas'=>$busas,
            'grade_bahans'=>$grade_bahans,
            // Harga Specs
            'bahan_hargas'=>$bahan_hargas,
            'variasi_hargas'=>$variasi_hargas,
            'ukuran_hargas'=>$ukuran_hargas,
            'jahit_hargas'=>$jahit_hargas,
            'kombinasi_hargas'=>$kombinasi_hargas,
            'motif_hargas'=>$motif_hargas,
            'tsixpack_hargas'=>$tsixpack_hargas,
            'tankpad_hargas'=>$tankpad_hargas,
            'stiker_hargas'=>$stiker_hargas,
            'busastang_hargas'=>$busastang_hargas,
            'jokassy_hargas'=>$jokassy_hargas,
            'rol_hargas'=>$rol_hargas,
            'rotan_hargas'=>$rotan_hargas,
            'list_hargas'=>$list_hargas,
            'alas_hargas'=>$alas_hargas,
            'busa_hargas'=>$busa_hargas,
            'grade_bahan_hargas'=>$grade_bahan_hargas,
        ];
        // dd($data);
        // dd($motif_hargas);
        return view('produk.daftar-spec',$data);
    }

    public function tambahSpecDB(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $success_logs=$warning_logs=$error_logs='';
        $main_log=null;
        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs.= 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post = $request->input();
        // dd($post);
        if (!isset($post['nama'])) {
            $request->validate(
                ['error'=>'required'],
                ['error.required'=>'Nama perlu diisi!']
            );
        }
        $tipe=$post['tipe'];
        $nama=$post['nama'];
        $harga=0;
        if (isset($post['harga'])) {
            $harga=$post['harga'];
        }
        $grade_bahan=null;
        if (isset($post['grade_bahan'])) {
            $grade_bahan=$post['grade_bahan'];
        }

        /** Mulai Insert */
        if ($run_db) {
            if ($tipe==='Bahan') {
                $bahan=Bahan::create([
                    'nama'=>$nama,
                    'grade_bahan'=>$grade_bahan,
                ]);
                $success_logs.="_ $tipe baru telah diinput ke Database: $bahan[nama]";
                $bahan_harga=BahanHarga::create([
                    'bahan_id'=>$bahan['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $bahan_harga[harga]";
            } elseif ($tipe==='Variasi') {
                $variasi=Variasi::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru telah diinput ke Database: $variasi[nama]";
                $variasi_harga=VariasiHarga::create([
                    'variasi_id'=>$variasi['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $variasi_harga[harga]";
            }

            $load_num->value+=1;
            $load_num->save();
        }

        return back()->with(['_success'=>$success_logs,'_warning'=>$warning_logs,'_error'=>$error_logs]);
    }

    public function editSpec()
    {
        SiteSettings::loadNumToZero();

        $data=[
            'go_back'=>true,'navbar_bg'=>'bg-color-orange-2',
        ];
        // dd($data);
        // dump($data);
        return view('produk.edit-spec',$data);
    }
    public function hapusSpec(Request $request)
    {
        $load_num = SiteSetting::find(1);
        $run_db = true; // true apabila siap melakukan CRUD ke DB
        $success_logs = $warning_logs = $error_logs = '';
        $main_log=null;
        if ($load_num->value > 0) {
            $run_db = false;
            $error_logs.= 'WARNING: Laman ini telah ter load lebih dari satu kali. Apakah Anda tidak sengaja reload laman ini? Tidak ada yang di proses ke Database. Silahkan pilih tombol kembali!';
        }

        $post=$request->post();
        $tipe=$post['tipe'];
        $id=$post['id'];
        // dd($post);

        if ($run_db) {
            if ($tipe==='Bahan') {
                $bahan=Bahan::find($id);
                $bahan->delete();
                $warning_logs.="_ $tipe $bahan[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Variasi') {
                $variasi=Variasi::find($id);
                $variasi->delete();
                $warning_logs.="_ $tipe $variasi[nama] serta histori harganya telah dihapus dari Database!";
            }
            $load_num->value+=1;
            $load_num->save();
        }
        // session([
        //     '_success'=>$success_logs,
        //     '_warning'=>$warning_logs,
        //     '_error'=>$error_logs
        // ]);
        // $request->session()->put('_success',$success_logs);
        // $request->session()->put('_warning',$warning_logs);
        // $request->session()->put('_error',$error_logs);
        // $request->session()->flash('_success',$success_logs);

        return back()->with(['_success'=>$success_logs,'_warning'=>$warning_logs,'_error'=>$error_logs]);
    }
}
