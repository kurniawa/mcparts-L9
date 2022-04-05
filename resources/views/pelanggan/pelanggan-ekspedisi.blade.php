@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div>
        <h2 style="color: white">Pelanggan: Relasi Dengan Ekspedisi</h2>
    </div>
</header>

<form action="/pelanggan/tetapkan-ekspedisi-db" method="POST" class="m-3">
    @csrf
    <div id="divKeteranganEkspedisi"></div>
    <div style="font-weight:bold">Tambah Ekspedisi:</div>
    <input name="ekspedisi_nama" id="ipt_pilih_ekspedisi" type="text" class="form-control" >
    {{-- <input name="pulau" id="pulau" class="form-control" type="text" placeholder="Pulau"> --}}
    <input id="ipt_id_ekspedisi_terpilih" type="hidden" name="ekspedisi_id">
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
    const ekspedisis = {!! json_encode($ekspedisis, JSON_HEX_TAG) !!};
    const list_of_ekspedisis = {!! json_encode($list_of_ekspedisis, JSON_HEX_TAG) !!};
    // const list_of_pulaus = {-!! json_encode($list_of_pulaus, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('pelanggan');console.log(pelanggan);
        console.log('ekspedisis');console.log(ekspedisis);
        console.log('ekspedisis.length');console.log(ekspedisis.length);
        console.log('list_of_ekspedisis');console.log(list_of_ekspedisis);
        // console.log('list_of_pulaus');console.log(list_of_pulaus);
    }

    var htmlKetReseller = 'Pelanggan ini belum memiliki Reseller.';

    if (ekspedisis.length !== 0) {
        var listReseller = '<ul>'
        ekspedisis.forEach(reseller => {
            listReseller += `<li>${reseller.nama}</li>`;
        });
        listReseller += '</ul>'
        htmlKetReseller = `
        Pelanggan ini telah memiliki reseller:
        ${listReseller}
        `;
    }

    document.getElementById('divKeteranganReseller').innerHTML = htmlKetReseller;

    $('#ipt_pilih_ekspedisi').autocomplete({
        source: list_of_ekspedisis,
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
