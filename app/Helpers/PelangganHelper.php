<?php

namespace App\Helpers;

use App\Models\Pelanggan;
use App\Models\PelangganReseller;

class PelangganHelper {

    static function label_pelanggan_resellers()
    {
        $show_dump = false;
        $pelanggans = Pelanggan::all();
        $label_pelanggan_resellers = array();
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

                    array_push($label_pelanggan_resellers, $arr_to_push);
                }
            }

            $label_nama = $pelanggan['nama'];

            $arr_to_push = [
                "id" => $pelanggan['id'],
                "reseller_id" => null,
                "label" => $label_nama,
                "value" => $label_nama,
            ];

            array_push($label_pelanggan_resellers, $arr_to_push);
        }

        return $label_pelanggan_resellers;
    }

}

?>
