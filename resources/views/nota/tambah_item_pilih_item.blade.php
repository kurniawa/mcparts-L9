@extends('layouts.main_layout')

@section('content')

<div class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">

</div>

<div class="text-center">
    <h2>Tambah Item Untuk Nota: </h2>
</div>

<form action="/nota/tambah-item-db" method="POST" class="container" onsubmit="return formValidator('jml_input[][]', 'jml_av[][]')">
    @csrf
    <input type="hidden" name="nota_id" value="{{ $nota_id }}">
    <input type='checkbox' id="toggle-cbox-dd-2-pilsem"> Pilih Semua
    <table style="width:100%;" id="tableItemList">
    </table>

    <table style="width: 100%">
    <tr><th>Nama</th><th>jml.T</th><th>jml.Av</th><th><th></tr>
    @for ($i = 0; $i < count($spks); $i++)
    <tr>
        <td class="fw-bold">{{ $spks[$i]['no_spk'] }}</td>
    </tr>
    @for ($j = 0; $j < count($arr_spk_produks[$i]); $j++)
    @php
        $jml_av = $arr_spk_produks[$i][$j]['jml_selesai'] - $arr_spk_produks[$i][$j]['jml_sdh_nota'];
    @endphp
    <tr class='bb-1px-solid-grey'>
        <td style='padding-bottom:1em;padding-top:1em;' class=''>{{ $arr_produks[$i][$j]['nama'] }}</td>
        <td style='color:slateblue;font-weight:bold;'>{{ $arr_spk_produks[$i][$j]['jml_t'] }}</td>
        <td style='color:green;font-weight:bold;'>{{ $jml_av }}</td>
        <td><input type='checkbox' id="toggle-cbox-dd-2-{{ $i }}{{ $j }}" class='toggle-cbox-dd-2 toggle-cbox-dd-2-{{ $i }}'></td>
    </tr>
    <tr id="cbox-dd-2-{{ $i }}{{ $j }}" class="cbox-dd-2 cbox-dd-2-{{ $i }} cbox-dd-2-pilsem">
        <td colspan="4">
            <table>
                <tr><td>Jml.sdh.Nota</td><td>:</td><td><input class="form-control data-cbox-dd-2-{{ $i }}{{ $j }}" type="number" name="jml_sdh_nota[]" id="" value="{{ $arr_spk_produks[$i][$j]['jml_sdh_nota'] }}" readonly></td></tr>
                <tr>
                    <td>Jml. input</td>
                    <td>:</td>
                    <td>
                        <input class="form-control data-cbox-dd-2-{{ $i }}{{ $j }}" type="number" name="jml_input[][]" id="" value={{ $jml_av }}>
                    </td>
                </tr>
                <tr>
                    <td>
                        <input type='hidden' class="data-cbox-dd-2-{{ $i }}{{ $j }}" name='jml_t[][]' value={{ $arr_spk_produks[$i][$j]['jml_t'] }}>
                        <input type='hidden' class="data-cbox-dd-2-{{ $i }}{{ $j }}" name='jml_av[][]' value={{ $jml_av }}>
                        <input type='hidden' class="data-cbox-dd-2-{{ $i }}{{ $j }}" name='spk_produk_id[][]' value={{ $arr_spk_produks[$i][$j]['id'] }}>
                        <input type='hidden' class="data-cbox-dd-2-{{ $i }}{{ $j }}" name='produk_id[][]' value={{ $arr_produks[$i][$j]['id'] }}>
                        <input type="hidden" class="data-cbox-dd-2-{{ $i }}{{ $j }}" name="spk_ids[][]" value="{{ $spks[$i]['id'] }}">
                    </td>
                </tr>
            </table>
        </td>
    </tr>

    @endfor
    @endfor

    </table>
    <div id="validation_error" class="alert alert-danger" style="display: none"></div>

    <div id="divMarginBottom" style="height: 20vh;"></div>

    <button id="btnSelesai_new" type="submit" class="btn-warning-full" style="display:block">Konfirmasi</button>
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
    // console.log($cbox_dd_2);
    if ($cbox_dd_2.length !== 0) {
        for (let i = 0; i < $cbox_dd_2.length ; i++) {
            // SET DISPLAY NONE
            // console.log($cbox_dd_2[i]);
            $cbox_dd_2[i].style.display = 'none'; // dari querySelectorAll, ga bisa pake fungsi hide
            let cbox_dd_2_i = document.querySelectorAll(`.cbox-dd-2-${i}`);
            for (let j = 0; j < cbox_dd_2_i.length; j++) {
                let toggle_cbox_dd_2_i_j = document.getElementById(`toggle-cbox-dd-2-${i}${j}`);
                $cbox_dd_2[i][j] = $(`#cbox-dd-2-${i}${j}`);
                let data_cbox_dd_2 = document.querySelectorAll(`.data-cbox-dd-2-${i}${j}`);
                // console.log($data_cbox_dd_2);
                data_cbox_dd_2.forEach(data => {
                    data.disabled = true;
                });
                toggle_cbox_dd_2_i_j.addEventListener('click', function () {
                    // console.log($toggle_cbox_dd_2_i_j.is(':checked'));
                    if (toggle_cbox_dd_2_i_j.checked) {
                        $cbox_dd_2[i][j].show(300);
                        data_cbox_dd_2.forEach(data => {
                            data.disabled = false;
                        });
                    } else {
                        $cbox_dd_2[i][j].hide(300);
                        data_cbox_dd_2.forEach(data => {
                            data.disabled = true;
                        });
                    }
                });
            }
        }

    }

    /* Metode Checkbox Pilih Semua */
    $toggle_cbox_dd_2_pilsem = $('#toggle-cbox-dd-2-pilsem');
    // console.log($toggle_cbox_dd_2_pilsem);
    if ($toggle_cbox_dd_2_pilsem.length !== 0) {
        $cbox_dd_2 = $('.cbox-dd-2');
        $toggle_cbox_dd_2_pilsem.click(function () {
            if ($toggle_cbox_dd_2_pilsem.is(':checked')) {
                for (let i = 0; i < $cbox_dd_2.length; i++) {
                    let cbox_dd_2_i = document.querySelectorAll(`.cbox-dd-2-${i}`);
                    for (let j = 0; j < cbox_dd_2_i.length; j++) {
                        $toggle_cbox_dd_2_i_j = $(`#toggle-cbox-dd-2-${i}${j}`);
                        $cbox_dd_2_i_j = $(`#cbox-dd-2-${i}${j}`);
                        let data_cbox_dd_2 = document.querySelectorAll(`.data-cbox-dd-2-${i}${j}`);
                            // console.log($data_cbox_dd_2);
                        $toggle_cbox_dd_2_i_j.prop('checked', true);
                        $cbox_dd_2_i_j.show(300);
                        data_cbox_dd_2.forEach(data => {
                            data.disabled = false;
                        });
                    }
                }
            } else {
                for (let i = 0; i < $cbox_dd_2.length; i++) {
                    let cbox_dd_2_i = document.querySelectorAll(`.cbox-dd-2-${i}`);
                    for (let j = 0; j < cbox_dd_2_i.length; j++) {
                        $toggle_cbox_dd_2_i_j = $(`#toggle-cbox-dd-2-${i}${j}`);
                        $cbox_dd_2_i_j = $(`#cbox-dd-2-${i}${j}`);
                        let data_cbox_dd_2 = document.querySelectorAll(`.data-cbox-dd-2-${i}${j}`);
                            // console.log($data_cbox_dd_2);
                        $toggle_cbox_dd_2_i_j.prop('checked', false);
                        $cbox_dd_2_i_j.hide(300);
                        data_cbox_dd_2.forEach(data => {
                            data.disabled = true;
                        });
                    }
                }

            }
        });
    }

    function formValidator(input_name, max_value) {
        var inputs = document.getElementsByName(input_name);
        var max_values = document.getElementsByName(max_value);
        var tidak_sesuai = 0;
        var ada_yang_diproses = 0;
        // console.log('inputs');console.log(inputs);
        // console.log('max_values');console.log(max_values);
        for (let i = 0; i < inputs.length; i++) {
            console.log(inputs[i].disabled);
            if (inputs[i].disabled === false) {
                var input_value = parseInt(inputs[i].value);
                var max_value = parseInt(max_values[i].value);
                console.log(input_value);console.log(max_value);
                if (parseInt(inputs[i].value) < 1 || parseInt(inputs[i].value) > parseInt(max_values[i].value)) {
                    tidak_sesuai++;
                } else {
                    ada_yang_diproses++;
                }
            }
        }
        // console.log(tidak_sesuai);
        // console.log(ada_yang_diproses);

        if (tidak_sesuai === 0 && ada_yang_diproses !== 0) {
            return true;
        } else if (tidak_sesuai !== 0) {
            $('#validation_error').show();
            $('#validation_error').text('Ada data input yang tidak sesuai!');
            return false;
        } else if (ada_yang_diproses === 0) {
            $('#validation_error').show();
            $('#validation_error').text('Belum ada item yang dipilih');
            return false;
        }
    }

</script>
@endsection
