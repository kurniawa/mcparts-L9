@extends('layouts.main_layout')

@section('content')

<div class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">

</div>

<div class="m-0_5em">
    <form action="/nota/edit-item-nota-DB" method="POST">
        <table>
            <tr><td>Jml. sudah Nota</td><td>:</td><td>${jml_sdh_nota}<input type='hidden' name='jml_sdh_nota[${i_spks}][]' value=${jml_sdh_nota} disabled=${input_disabled}></td></tr>
            <tr><td>Jml. ingin diinput</td><td>:</td><td><input type='number' name='jml_input[${i_spks}][]' value=${jml_selesai-jml_sdh_nota} disabled=${input_disabled}></td></tr>
            <tr><td><input type='hidden' name='spk_produk_id[${i_spks}][]' value='${arr_av_nota_items[i_spks][i_arrAvNotaItems].id}' disabled=${input_disabled}></td></tr>
        </table>
    </form>
</div>

<script>
    const spks = {!! json_encode($spks, JSON_HEX_TAG) !!};
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const reseller = {!! json_encode($reseller, JSON_HEX_TAG) !!};
    const arr_av_nota_items = {!! json_encode($arr_av_nota_items, JSON_HEX_TAG) !!};
    const arr_produks = {!! json_encode($arr_produks, JSON_HEX_TAG) !!};
    const tgl_nota = {!! json_encode($tgl_nota, JSON_HEX_TAG) !!};
    const my_csrf = {!! json_encode($csrf, JSON_HEX_TAG) !!};

    if (show_console === true) {
        console.log('spks');console.log(spks);
        console.log('pelanggan');console.log(pelanggan);
        console.log("arr_av_nota_items:");console.log(arr_av_nota_items);
        console.log("arr_produks:");console.log(arr_produks);
        console.log('tgl_nota');console.log(tgl_nota);
    }

</script>
@endsection
