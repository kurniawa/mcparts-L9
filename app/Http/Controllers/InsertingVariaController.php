<?php

namespace App\Http\Controllers;

use App\Helpers\SiteSettings;
use App\Models\Bahan;
use App\Models\Jahit;
use App\Models\Ukuran;
use App\Models\Variasi;
use Illuminate\Http\Request;

class InsertingVariaController extends Controller
{
    public function inserting_varia()
    {
        SiteSettings::loadNumToZero();
        $show_dump = false;

        $bahan = new Bahan();
        $varia = new Variasi();
        $ukuran = new Ukuran();
        $jahit = new Jahit();

        $label_bahans = $bahan->label_bahans();
        $varias_harga = $varia->varias_harga();
        $ukurans_harga = $ukuran->ukurans_harga();
        $jahits_harga = $jahit->jahits_harga();

        $att_varia = [
            'label_bahans' => $label_bahans,
            'varias_harga' => $varias_harga,
            'ukurans_harga' => $ukurans_harga,
            'jahits_harga' => $jahits_harga,
        ];

        // dump($label_bahans);
        // dump($varias_harga);
        // dump($ukurans_harga);
        // dump($jahits_harga);

        $data = [
            'tipe' => 'varia',
            'bahans' => $label_bahans,
            'varias' => $varias_harga,
            'ukurans' => $ukurans_harga,
            'jahits' => $jahits_harga,
            'att_varia' => $att_varia,
            'mode' => 'SPK_BARU',
            'spk_item' => null,
            'produk' => null,
        ];
        return view('/spk/inserting_spk_item-2', $data);
    }
}
