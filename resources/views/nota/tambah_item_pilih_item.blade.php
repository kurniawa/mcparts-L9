@extends('layouts.main_layout')

@section('content')

<div class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">

</div>

<div class="text-center">
    <h2>Tambah Item Untuk Nota: </h2>
</div>

<form action="/nota/tambah-item-db" method="POST" class="container">
    @csrf
    <input type="hidden" name="nota_id" value="{{ $nota_id }}">
    <input type='checkbox' name='main_checkbox' id='main_checkbox' onclick="checkAll(this.id, 'dd_spk_items');"> Pilih Semua
    <table style="width:100%;" id="tableItemList">
    </table>

    @for ($i = 0; $i < count($spks); $i++)
    <div class="row">
        <div class="col">{{ $spks[$i]['no_spk'] }}</div>
    </div>
    <table style="width: 100%">
        <tr><th>Nama</th><th>jml.T</th><th>jml.Av</th><th><th></tr>
    @for ($j = 0; $j < count($arr_spk_produks[$i]); $j++)
    <tr class='bb-1px-solid-grey'>
        <td style='color:;font-weight:bold;font-size:1em;padding-bottom:1em;padding-top:1em;' class=''>{{ $arr_produks[$i][$j]['nama'] }}</td>
        <td style='color:slateblue;font-weight:bold;'>{{ $arr_spk_produks[$i][$j]['jml_t'] }}<input type='hidden' name='jml_t[{{$i}}][]' value={{ $arr_spk_produks[$i][$j]['jml_t'] }}></td>
        <td style='color:green;font-weight:bold;'>{{ $arr_spk_produks[$i][$j]['jml_selesai'] - $arr_spk_produks[$i][$j]['jml_sdh_nota'] }}<input type='hidden' name='jml_av[${i_spks}][]' value={{ $arr_spk_produks[$i][$j]['jml_selesai'] - $arr_spk_produks[$i][$j]['jml_sdh_nota'] }}></td>
        <td><input type='checkbox' id="toggle-cbox-dd-2-{{ $i }}{{ $j }}" class='toggle-cbox-dd-2 toggle-cbox-dd-2-{{ $i }}'></td>
    </tr>
    <tr id="cbox-dd-2-{{ $i }}{{ $j }}" class="cbox-dd-2 cbox-dd-2-{{ $i }}">
        <td colspan="3">
            <table>
                <tr><td>Jml.sdh.Nota</td><td>:</td><td><input class="form-control" type="number" name="jml_sdh_nota" id="" value="{{ $arr_spk_produks[$i][$j]['jml_sdh_nota'] }}" readonly></td></tr>
                <tr><td>Jml. input</td><td>:</td><td><input class="form-control data-cbox-dd-2-{{ $i }}{{ $j }}" type="number" name="jml_input" id=""></td></tr>
            </table>
        </td>
    </tr>

    @endfor
    </table>
    @endfor

    <div id="divMarginBottom" style="height: 20vh;"></div>

    <button id="btnSelesai_new" type="submit" class="btn-warning-full" style="display:none">Konfirmasi</button>
</form>



<div id="divMarginBottom" style="height: 20vh;"></div>
<style>

</style>

<script>
    const spks = {!! json_encode($spks, JSON_HEX_TAG) !!};

    if (show_console === true) {
        console.log('spks');console.log(spks);
    }

    $cbox_dd_2 = $('.cbox-dd-2');
    console.log($cbox_dd_2);
    if ($cbox_dd_2.length !== 0) {
        for (let i = 0; i < $cbox_dd_2.length ; i++) {
            // SET DISPLAY NONE
            // console.log($cbox_dd_2[i]);
            $cbox_dd_2[i].style.display = 'none'; // dari querySelectorAll, ga bisa pake fungsi hide
            var cbox_dd_2_i = document.querySelectorAll(`.cbox-dd-2-${i}`);
            for (let j = 0; j < cbox_dd_2_i.length; j++) {
                $toggle_cbox_dd_2_i_j = $(`#toggle-cbox-dd-2-${i}${j}`);
                $cbox_dd_2_i_j = $(`#cbox-dd-2-${i}${j}`);
                var data_cbox_dd_2 = document.querySelectorAll(`.data-cbox-dd-2-${i}${j}`);
                // console.log($data_cbox_dd_2);
                data_cbox_dd_2.forEach(data => {
                    data.disabled = true;
                });
                $toggle_cbox_dd_2_i_j.click(function () {
                    // console.log($toggle_cbox_dd_2_i_j.is(':checked'));
                    if ($toggle_cbox_dd_2_i_j.is(':checked')) {
                        $cbox_dd_2_i_j.show(300);
                        data_cbox_dd_2.forEach(data => {
                            data.disabled = false;
                        });
                    } else {
                        $cbox_dd_2_i_j.hide(300);
                        data_cbox_dd_2.forEach(data => {
                            data.disabled = true;
                        });
                    }
                });
            }
        }

    }

</script>
@endsection
