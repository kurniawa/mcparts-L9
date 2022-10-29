<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Spec extends Model
{
    use HasFactory;
    protected $guarded = ['id'];


    public function specs_harga()
    {
        $spec_terbaru = DB::table('spec_hargas')
            ->select('id', 'spec_id', 'harga', DB::raw('MAX(created_at)'))
            ->groupBy('id', 'spec_id', 'harga', 'created_at');

        $specs_harga = DB::table('specs')
            ->select('specs.id', 'specs.nama', 'specs.nama_nota', 'spec_terbaru.harga')
            ->joinSub($spec_terbaru, 'spec_terbaru', function ($join) {
                $join->on('specs.id', '=', 'spec_terbaru.spec_id');
            })
            ->orderBy('specs.nama')->get();

        return $specs_harga;
    }

    static function getBahanAll_wPrices()
    {
        $bahans=Bahan::all();
        $bahan_hargas=array();
        foreach ($bahans as $bahan) {
            $bahan_harga=BahanHarga::where('bahan_id',$bahan['id'])->orderByDesc('created_at')->first();
            $bahan_hargas[]=$bahan_harga;
        }

        return array($bahans,$bahan_hargas);
    }
    static function getVariasiAll_wPrices()
    {
        $variasis=Variasi::all();
        $variasi_hargas=array();
        foreach ($variasis as $variasi) {
            $variasi_harga=VariasiHarga::where('variasi_id',$variasi['id'])->orderByDesc('created_at')->first();
            $variasi_hargas[]=$variasi_harga;
        }

        return array($variasis,$variasi_hargas);
    }
    static function getUkuranAll_wPrices()
    {
        $ukurans=Spec::where('kategori','ukuran')->get();
        $ukuran_hargas=array();
        foreach ($ukurans as $ukuran) {
            $ukuran_harga=SpecHarga::where('spec_id',$ukuran['id'])->orderByDesc('created_at')->first();
            $ukuran_hargas[]=$ukuran_harga;
        }

        return array($ukurans,$ukuran_hargas);
    }
    static function getJahitAll_wPrices()
    {
        $jahits=Spec::where('kategori','jahit')->get();
        $jahit_hargas=array();
        foreach ($jahits as $jahit) {
            $jahit_harga=SpecHarga::where('spec_id',$jahit['id'])->orderByDesc('created_at')->first();
            $jahit_hargas[]=$jahit_harga;
        }

        return array($jahits,$jahit_hargas);
    }
    static function getKombinasiAll_wPrices()
    {
        $kombinasis=Kombinasi::all();
        $kombinasi_hargas=array();
        foreach ($kombinasis as $kombinasi) {
            $kombinasi_harga=KombinasiHarga::where('kombinasi_id',$kombinasi['id'])->orderByDesc('created_at')->first();
            $kombinasi_hargas[]=$kombinasi_harga;
        }

        return array($kombinasis,$kombinasi_hargas);
    }
    static function getMotifAll_wPrices()
    {
        $motifs=Motif::all();
        $motif_hargas=array();
        foreach ($motifs as $motif) {
            $motif_harga=MotifHarga::where('motif_id',$motif['id'])->orderByDesc('created_at')->first();
            $motif_hargas[]=$motif_harga;
        }

        return array($motifs,$motif_hargas);
    }
    static function getTsixpackAll_wPrices()
    {
        $tsixpacks=Tsixpack::all();
        $tsixpack_hargas=array();
        foreach ($tsixpacks as $tsixpack) {
            $tsixpack_harga=TsixpackHarga::where('tsixpack_id',$tsixpack['id'])->orderByDesc('created_at')->first();
            $tsixpack_hargas[]=$tsixpack_harga;
        }

        return array($tsixpacks,$tsixpack_hargas);
    }
    static function getStandarAll_wPrices()
    {
        $standars=Standar::all();
        return array($standars);
    }
    static function getTankpadAll_wPrices()
    {
        $tankpads=Tankpad::all();
        $tankpad_hargas=array();
        foreach ($tankpads as $tankpad) {
            $tankpad_harga=TankpadHarga::where('tankpad_id',$tankpad['id'])->orderByDesc('created_at')->first();
            $tankpad_hargas[]=$tankpad_harga;
        }

        return array($tankpads,$tankpad_hargas);
    }
    static function getStikerAll_wPrices()
    {
        $stikers=Stiker::all();
        $stiker_hargas=array();
        foreach ($stikers as $stiker) {
            $stiker_harga=StikerHarga::where('stiker_id',$stiker['id'])->orderByDesc('created_at')->first();
            $stiker_hargas[]=$stiker_harga;
        }

        return array($stikers,$stiker_hargas);
    }
    static function getBusastangAll_wPrices()
    {
        $busastangs=Busastang::all();
        $busastang_hargas=array();
        foreach ($busastangs as $busastang) {
            $busastang_harga=BusastangHarga::where('busastang_id',$busastang['id'])->orderByDesc('created_at')->first();
            $busastang_hargas[]=$busastang_harga;
        }

        return array($busastangs,$busastang_hargas);
    }
    static function getJokassyAll_wPrices()
    {
        $jokassies=Jokassy::all();
        $jokassy_hargas=array();
        foreach ($jokassies as $jokassy) {
            $jokassy_harga=JokassyHarga::where('jokassy_id',$jokassy['id'])->orderByDesc('created_at')->first();
            $jokassy_hargas[]=$jokassy_harga;
        }

        return array($jokassies,$jokassy_hargas);
    }
    static function getRolAll_wPrices()
    {
        $rols=Rol::all();
        $rol_hargas=array();
        foreach ($rols as $rol) {
            $rol_harga=RolHarga::where('rol_id',$rol['id'])->orderByDesc('created_at')->first();
            $rol_hargas[]=$rol_harga;
        }

        return array($rols,$rol_hargas);
    }
    static function getRotanAll_wPrices()
    {
        $rotans=Rotan::all();
        $rotan_hargas=array();
        foreach ($rotans as $rotan) {
            $rotan_harga=RotanHarga::where('rotan_id',$rotan['id'])->orderByDesc('created_at')->first();
            $rotan_hargas[]=$rotan_harga;
        }

        return array($rotans,$rotan_hargas);
    }
    static function getListAll_wPrices()
    {
        $lists=Spec::where('kategori','list')->get();
        $list_hargas=array();
        foreach ($lists as $list) {
            $list_harga=SpecHarga::where('spec_id',$list['id'])->orderByDesc('created_at')->first();
            $list_hargas[]=$list_harga;
        }

        return array($lists,$list_hargas);
    }
    static function getAlasAll_wPrices()
    {
        $alass=Spec::where('kategori','alas')->get();
        $alas_hargas=array();
        foreach ($alass as $alas) {
            $alas_harga=SpecHarga::where('spec_id',$alas['id'])->orderByDesc('created_at')->first();
            $alas_hargas[]=$alas_harga;
        }

        return array($alass,$alas_hargas);
    }
    static function getBusaAll_wPrices()
    {
        $busas=Spec::where('kategori','busa')->get();
        $busa_hargas=array();
        foreach ($busas as $busa) {
            $busa_harga=SpecHarga::where('spec_id',$busa['id'])->orderByDesc('created_at')->first();
            $busa_hargas[]=$busa_harga;
        }

        return array($busas,$busa_hargas);
    }
    static function getGradeBahanAll_wPrices()
    {
        $grade_bahans=Spec::where('kategori','grade_bahan')->get();
        $grade_bahan_hargas=array();
        foreach ($grade_bahans as $grade_bahan) {
            $grade_bahan_harga=SpecHarga::where('spec_id',$grade_bahan['id'])->orderByDesc('created_at')->first();
            $grade_bahan_hargas[]=$grade_bahan_harga;
        }
        return array($grade_bahans,$grade_bahan_hargas);
    }

}
