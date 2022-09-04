<?php

namespace App\Helpers;

use App\Models\Pelanggan;
use App\Models\PelangganReseller;

class PelangganHelper {

    static function label_pelanggans()
    {
        $pelanggan_indirects = Pelanggan::where('reseller_id','!=',null)->get(['id','nama','reseller_id'])->toArray();
        $pelanggan_resellers=array();
        foreach ($pelanggan_indirects as $pelanggan) {
            $reseller = Pelanggan::find($pelanggan['reseller_id'])->toArray();
            $pelanggan_resellers[]=[
                'label'=>"$reseller[nama] - $pelanggan[nama]",
                'value'=>"$reseller[nama] - $pelanggan[nama]",
                'id'=>"$pelanggan[id]",
                'reseller_id'=>"$reseller[id]",
            ];
        }
        $pelanggans=Pelanggan::all(['id','nama as label','nama as value'])->toArray();
        $label_pelanggans = array_merge($pelanggans,$pelanggan_resellers);

        return $label_pelanggans;
    }

}

?>
