<?php

use App\Models\Daerah;
use App\Models\Negara;
use App\Models\Pulau;

function getLabelNegara()
{
    $negaras = new Negara();
    $label_negaras = $negaras->label_negaras();
    return $label_negaras;
}

function getLabelPulau()
{
    $pulaus = new Pulau();
    $label_pulaus = $pulaus->label_pulaus();
    // dump($label_pulaus);
    return $label_pulaus;
}

function getLabelDaerah()
{
    $daerahs = new Daerah();
    $label_daerahs = $daerahs->label_daerahs();
    $arr_label_daerahs = array();
    // lihat doc bagian collection, nanti ada helper func nya, lumayan bermanfaat
    $arr_label_daerahs[0] = $label_daerahs->where('pulau_id', 1)->toArray();
    $arr_label_daerahs[1] = $label_daerahs->where('pulau_id', 2)->toArray();
    $arr_label_daerahs[1] = array_values($arr_label_daerahs[1]);
    $arr_label_daerahs[2] = $label_daerahs->where('pulau_id', 3)->toArray();
    $arr_label_daerahs[2] = array_values($arr_label_daerahs[2]);
    $arr_label_daerahs[3] = $label_daerahs->where('pulau_id', 4)->toArray();
    $arr_label_daerahs[3] = array_values($arr_label_daerahs[3]);
    $arr_label_daerahs[4] = $label_daerahs->where('pulau_id', 5)->toArray();
    $arr_label_daerahs[4] = array_values($arr_label_daerahs[4]);
    $arr_label_daerahs[5] = $label_daerahs->where('pulau_id', 6)->toArray();
    $arr_label_daerahs[5] = array_values($arr_label_daerahs[5]);
    return $arr_label_daerahs;
}


?>
