<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Bahan;
use App\Models\BahanHarga;
use App\Models\Busastang;
use App\Models\BusastangHarga;
use App\Models\Jokassy;
use App\Models\JokassyHarga;
use App\Models\Kombinasi;
use App\Models\KombinasiHarga;
use App\Models\Motif;
use App\Models\MotifHarga;
use App\Models\Rol;
use App\Models\RolHarga;
use App\Models\Rotan;
use App\Models\RotanHarga;
use App\Models\SiteSetting;
use App\Models\Spec;
use App\Models\SpecHarga;
use App\Models\Standar;
use App\Models\Stiker;
use App\Models\StikerHarga;
use App\Models\Tankpad;
use App\Models\TankpadHarga;
use App\Models\Tsixpack;
use App\Models\TsixpackHarga;
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
        // dd($tankpad_hargas);
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
        // Tipe: Bahan memiliki keterangan grade_bahan
        $grade_bahan=null;
        if (isset($post['grade_bahan'])) {
            $grade_bahan=$post['grade_bahan'];
        }
        // Untuk Tipe: Varian memiliki keterangan kategori
        $kategori=null;
        if (isset($post['kategori'])) {
            $kategori=$post['kategori'];
        }

        /** Mulai Insert */
        if ($run_db) {
            if ($tipe==='Bahan') {
                $is_exist=Bahan::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama Bahan sudah ada!']
                    );
                }
                $bahan=Bahan::create([
                    'nama'=>$nama,
                    'grade_bahan'=>$grade_bahan,
                ]);
                $success_logs.="_ $tipe baru - $bahan[nama] - telah diinput ke Database.";
                $bahan_harga=BahanHarga::create([
                    'bahan_id'=>$bahan['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $bahan_harga[harga]";
            } elseif ($tipe==='Variasi') {
                $is_exist=Variasi::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama Variasi sudah ada!']
                    );
                }
                $variasi=Variasi::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru - $variasi[nama] - telah diinput ke Database.";
                $variasi_harga=VariasiHarga::create([
                    'variasi_id'=>$variasi['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $variasi_harga[harga]";
            } elseif ($tipe==='Varian') {
                $is_exist=Varian::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama Varian sudah ada!']
                    );
                }
                $varian=Varian::create([
                    'nama'=>$nama,
                    'kategori'=>$kategori,
                ]);
                $success_logs.="_ $tipe baru - $varian[nama] - telah diinput ke Database";
            } elseif ($tipe==='Ukuran') {
                $is_exist=Spec::where('kategori','ukuran')->where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama Ukuran sudah ada!']
                    );
                }
                $ukuran=Spec::create([
                    'nama'=>$nama,
                    'kategori'=>'ukuran',
                ]);
                $success_logs.="_ $tipe baru - $ukuran[nama] - telah diinput ke Database";
                $ukuran_harga=SpecHarga::create([
                    'spec_id'=>$ukuran['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $ukuran_harga[harga]";
            } elseif ($tipe==='Jahit') {
                $is_exist=Spec::where('kategori','jahit')->where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama Jahit sudah ada!']
                    );
                }
                $jahit=Spec::create([
                    'nama'=>$nama,
                    'kategori'=>'jahit',
                ]);
                $success_logs.="_ $tipe baru - $jahit[nama] - telah diinput ke Database";
                $jahit_harga=SpecHarga::create([
                    'spec_id'=>$jahit['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $jahit_harga[harga]";
            } elseif ($tipe==='Jahit') {
                $is_exist=Spec::where('kategori','jahit')->where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama Jahit sudah ada!']
                    );
                }
                $jahit=Spec::create([
                    'nama'=>$nama,
                    'kategori'=>'jahit',
                ]);
                $success_logs.="_ $tipe baru - $jahit[nama] - telah diinput ke Database";
                $jahit_harga=SpecHarga::create([
                    'spec_id'=>$jahit['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $jahit_harga[harga]";
            } elseif ($tipe==='Kombinasi') {
                $is_exist=Kombinasi::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama Kombinasi sudah ada!']
                    );
                }
                $kombinasi=Kombinasi::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru - $kombinasi[nama] - telah diinput ke Database.";
                $kombinasi_harga=KombinasiHarga::create([
                    'kombinasi_id'=>$kombinasi['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $kombinasi_harga[harga]";
            } elseif ($tipe==='Motif') {
                $is_exist=Motif::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama Motif sudah ada!']
                    );
                }
                $motif=Motif::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru - $motif[nama] - telah diinput ke Database.";
                $motif_harga=MotifHarga::create([
                    'motif_id'=>$motif['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $motif_harga[harga]";
            } elseif ($tipe==='Tsixpack') {
                $is_exist=Tsixpack::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama T.Sixpack sudah ada!']
                    );
                }
                $tsixpack=Tsixpack::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru - $tsixpack[nama] - telah diinput ke Database.";
                $tsixpack_harga=TsixpackHarga::create([
                    'tsixpack_id'=>$tsixpack['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $tsixpack_harga[harga]";
            } elseif ($tipe==='Standar') {
                $is_exist=Standar::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama T.Sixpack sudah ada!']
                    );
                }
                $standar=Standar::create([
                    'nama'=>$nama,
                    'harga_dasar'=>$harga,
                ]);
                $success_logs.="_ $tipe baru - $standar[nama] - telah diinput ke Database.";
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $standar[harga_dasar]";
            } elseif ($tipe==='Tankpad') {
                $is_exist=Tankpad::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama T.Sixpack sudah ada!']
                    );
                }
                $Tankpad=Tankpad::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru - $Tankpad[nama] - telah diinput ke Database.";
                $Tankpad_harga=TankpadHarga::create([
                    'tankpad_id'=>$Tankpad['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $Tankpad_harga[harga]";
            } elseif ($tipe==='Stiker') {
                $is_exist=Stiker::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama T.Sixpack sudah ada!']
                    );
                }
                $Stiker=Stiker::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru - $Stiker[nama] - telah diinput ke Database.";
                $Stiker_harga=StikerHarga::create([
                    'stiker_id'=>$Stiker['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $Stiker_harga[harga]";
            } elseif ($tipe==='Busastang') {
                $is_exist=Busastang::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama T.Sixpack sudah ada!']
                    );
                }
                $Busastang=Busastang::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru - $Busastang[nama] - telah diinput ke Database.";
                $Busastang_harga=BusastangHarga::create([
                    'busastang_id'=>$Busastang['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $Busastang_harga[harga]";
            } elseif ($tipe==='JokAssy') {
                $is_exist=Jokassy::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama T.Sixpack sudah ada!']
                    );
                }
                $Jokassy=Jokassy::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru - $Jokassy[nama] - telah diinput ke Database.";
                $Jokassy_harga=JokassyHarga::create([
                    'jokassy_id'=>$Jokassy['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $Jokassy_harga[harga]";
            } elseif ($tipe==='Rol') {
                $is_exist=Rol::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama T.Sixpack sudah ada!']
                    );
                }
                $Rol=Rol::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru - $Rol[nama] - telah diinput ke Database.";
                $Rol_harga=RolHarga::create([
                    'rol_id'=>$Rol['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $Rol_harga[harga]";
            } elseif ($tipe==='Rotan') {
                $is_exist=Rotan::where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama T.Sixpack sudah ada!']
                    );
                }
                $Rotan=Rotan::create([
                    'nama'=>$nama,
                ]);
                $success_logs.="_ $tipe baru - $Rotan[nama] - telah diinput ke Database.";
                $Rotan_harga=RotanHarga::create([
                    'rotan_id'=>$Rotan['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $Rotan_harga[harga]";
            } elseif ($tipe==='List') {
                $is_exist=Spec::where('kategori','list')->where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama List sudah ada!']
                    );
                }
                $List=Spec::create([
                    'nama'=>$nama,
                    'kategori'=>'list',
                ]);
                $success_logs.="_ $tipe baru - $List[nama] - telah diinput ke Database";
                $List_harga=SpecHarga::create([
                    'spec_id'=>$List['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $List_harga[harga]";
            } elseif ($tipe==='Alas') {
                $is_exist=Spec::where('kategori','alas')->where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama Alas sudah ada!']
                    );
                }
                $Alas=Spec::create([
                    'nama'=>$nama,
                    'kategori'=>'alas',
                ]);
                $success_logs.="_ $tipe baru - $Alas[nama] - telah diinput ke Database";
                $Alas_harga=SpecHarga::create([
                    'spec_id'=>$Alas['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $Alas_harga[harga]";
            } elseif ($tipe==='Busa') {
                $is_exist=Spec::where('kategori','busa')->where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama Busa sudah ada!']
                    );
                }
                $Busa=Spec::create([
                    'nama'=>$nama,
                    'kategori'=>'busa',
                ]);
                $success_logs.="_ $tipe baru - $Busa[nama] - telah diinput ke Database";
                $Busa_harga=SpecHarga::create([
                    'spec_id'=>$Busa['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $Busa_harga[harga]";
            } elseif ($tipe==='GradeBahan') {
                $is_exist=Spec::where('kategori','grade_bahan')->where('nama',$nama)->first();
                if ($is_exist!==null) {
                    $request->validate(
                        ['error'=>'required'],
                        ['error.required'=>'Nama GradeBahan sudah ada!']
                    );
                }
                $GradeBahan=Spec::create([
                    'nama'=>$nama,
                    'kategori'=>'grade_bahan',
                ]);
                $success_logs.="_ $tipe baru - $GradeBahan[nama] - telah diinput ke Database";
                $GradeBahan_harga=SpecHarga::create([
                    'spec_id'=>$GradeBahan['id'],
                    'harga'=>$harga
                ]);
                $success_logs.="_ Harga untuk $tipe baru tersebut ditetapkan menjadi: $GradeBahan_harga[harga]";
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
            } elseif ($tipe==='Varian') {
                $varian=Varian::find($id);
                $varian->delete();
                $warning_logs.="_ $tipe $varian[nama] telah dihapus dari Database!";
            } elseif ($tipe==='Ukuran') {
                $ukuran=Spec::find($id);
                $ukuran->delete();
                $warning_logs.="_ $tipe $ukuran[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Jahit') {
                $jahit=Spec::find($id);
                $jahit->delete();
                $warning_logs.="_ $tipe $jahit[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Kombinasi') {
                $kombinasi=Kombinasi::find($id);
                $kombinasi->delete();
                $warning_logs.="_ $tipe $kombinasi[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Motif') {
                $motif=Motif::find($id);
                $motif->delete();
                $warning_logs.="_ $tipe $motif[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Tsixpack') {
                $tsixpack=Tsixpack::find($id);
                $tsixpack->delete();
                $warning_logs.="_ $tipe $tsixpack[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Standar') {
                $standar=Standar::find($id);
                $standar->delete();
                $warning_logs.="_ $tipe $standar[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Tankpad') {
                $Tankpad=Tankpad::find($id);
                $Tankpad->delete();
                $warning_logs.="_ $tipe $Tankpad[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Stiker') {
                $Stiker=Stiker::find($id);
                $Stiker->delete();
                $warning_logs.="_ $tipe $Stiker[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Busastang') {
                $Busastang=Busastang::find($id);
                $Busastang->delete();
                $warning_logs.="_ $tipe $Busastang[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='JokAssy') {
                $Jokassy=Jokassy::find($id);
                $Jokassy->delete();
                $warning_logs.="_ $tipe $Jokassy[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Rol') {
                $Rol=Rol::find($id);
                $Rol->delete();
                $warning_logs.="_ $tipe $Rol[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Rotan') {
                $Rotan=Rotan::find($id);
                $Rotan->delete();
                $warning_logs.="_ $tipe $Rotan[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='List') {
                $List=Spec::find($id);
                $List->delete();
                $warning_logs.="_ $tipe $List[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Alas') {
                $Alas=Spec::find($id);
                $Alas->delete();
                $warning_logs.="_ $tipe $Alas[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='Busa') {
                $Busa=Spec::find($id);
                $Busa->delete();
                $warning_logs.="_ $tipe $Busa[nama] serta histori harganya telah dihapus dari Database!";
            } elseif ($tipe==='GradeBahan') {
                $GradeBahan=Spec::find($id);
                $GradeBahan->delete();
                $warning_logs.="_ $tipe $GradeBahan[nama] serta histori harganya telah dihapus dari Database!";
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
