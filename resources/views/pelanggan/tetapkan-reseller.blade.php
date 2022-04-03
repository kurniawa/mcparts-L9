@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div>
        <h2 style="color: white">Pelanggan: Relasi Dengan Reseller</h2>
    </div>
</header>

<form action="/pelanggan/tetapkan-reseller-db" method="POST" class="m-3">
    @csrf
    <div id="divKeteranganReseller"></div>
    <div style="font-weight:bold">Tambah Reseller:</div>
    <input name="reseller_nama" id="ipt_pilih_reseller" type="text" class="form-control" >
    {{-- <input name="pulau" id="pulau" class="form-control" type="text" placeholder="Pulau"> --}}
    <input id="ipt_id_reseller_terpilih" type="hidden" name="reseller_id">
    <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
    <br><br>

    <div>
        <button type="submit" class="h-4em bg-color-orange-2 w-100 grid-1-auto">
            <span class="justify-self-center font-weight-bold">Konfirmasi</span>
        </button>
    </div>
</form>

<script>
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const resellers = {!! json_encode($resellers, JSON_HEX_TAG) !!};
    const list_of_resellers = {!! json_encode($list_of_resellers, JSON_HEX_TAG) !!};
    // const list_of_pulaus = {-!! json_encode($list_of_pulaus, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('pelanggan');console.log(pelanggan);
        console.log('resellers');console.log(resellers);
        console.log('resellers.length');console.log(resellers.length);
        console.log('list_of_resellers');console.log(list_of_resellers);
        // console.log('list_of_pulaus');console.log(list_of_pulaus);
    }

    var htmlKetReseller = 'Pelanggan ini belum memiliki Reseller.';

    if (resellers.length !== 0) {
        var listReseller = '<ul>'
        resellers.forEach(reseller => {
            listReseller += `<li>${reseller.nama}</li>`;
        });
        listReseller += '</ul>'
        htmlKetReseller = `
        Pelanggan ini telah memiliki reseller:
        ${listReseller}
        `;
    }

    document.getElementById('divKeteranganReseller').innerHTML = htmlKetReseller;

    $('#ipt_pilih_reseller').autocomplete({
        source: list_of_resellers,
        select: function (event, ui) {
            if (show_console) {
                console.log(ui.item);
            }
            $('#ipt_id_reseller_terpilih').val(ui.item.id);
        }
    });

    // $("#pulau").autocomplete({
    //     source: list_of_pulaus,
    //     select: function(event, ui) {
    //         if (show_console) {
    //             console.log(ui.item);
    //         }
    //         $("#pulau_id").val(ui.item.id);
    //         autcompleteIptDaerah();
    //     }
    // });


</script>
@endsection
