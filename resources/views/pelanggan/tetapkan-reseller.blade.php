@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div>
        <h2 style="color: white">Pelanggan: Relasi Dengan Reseller</h2>
    </div>
</header>

<div class="m-3">
    <h5>Relasi {{ $pelanggan['nama'] }} dengan Resellers</h5>
</div>

<div id="divReseller" class="m-3"></div>
<form action="/pelanggan/tetapkan-reseller-db" method="POST" class="m-3">
    @csrf
    {{-- <div id="divKeteranganReseller"></div> --}}
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
    const my_csrf = {!! json_encode($csrf, JSON_HEX_TAG) !!};
    // const list_of_pulaus = {-!! json_encode($list_of_pulaus, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('pelanggan');console.log(pelanggan);
        console.log('resellers');console.log(resellers);
        console.log('resellers.length');console.log(resellers.length);
        console.log('list_of_resellers');console.log(list_of_resellers);
        // console.log('list_of_pulaus');console.log(list_of_pulaus);
    }

    // var htmlKetReseller = 'Pelanggan ini belum memiliki Reseller.';

    // if (resellers.length !== 0) {
    //     var listReseller = '<ul>'
    //     resellers.forEach(reseller => {
    //         listReseller += `<li>${reseller.nama}</li>`;
    //     });
    //     listReseller += '</ul>'
    //     htmlKetReseller = `
    //     Pelanggan ini telah memiliki reseller:
    //     ${listReseller}
    //     `;
    // }

    // document.getElementById('divKeteranganReseller').innerHTML = htmlKetReseller;
    var html_reseller = 'Pelanggan ini belum memiliki Reseller';

    if (resellers.length !== 0) {
        html_reseller = `
            <span style="font-weight: bold">Pelanggan ini memiliki Reseller, yakni:</span>
        `;
        // console.log("cust_id");
        // console.log(cust_id);

        html_reseller += '<table style="width:100%">';
        i_reseller=0;
        resellers.forEach(reseller => {
            var html_alamat_reseller = '';
            var arr_alamat_reseller = JSON.parse(reseller.alamat);
            arr_alamat_reseller.forEach(baris_alamat_reseller => {
                html_alamat_reseller += baris_alamat_reseller + '<br>';
            });

            var html_reseller_dropdown = `
            <div id="dd-${i_reseller}" class='border p-2' style='display:none'>
                <table style='width:100%'>
                    <tr><td style='padding:1rem'><img src='/img/icons/address.svg' style='width:2em'></td><td>${html_alamat_reseller}</td></tr>
                    <tr>
                        <td style='padding:1rem'><img src='/img/icons/call.svg' style='width:2em'></td><td>${reseller.no_kontak}</td>
                        <td style='text-align:right'>
                            <form action='/pelanggan/pelanggan-detail' method='GET' style='display:inline-block'>
                                <input type='hidden' name='cust_id' value='${reseller.id}'>
                                <button type='submit' class='btn btn-warning'>Detail</button>
                            </form>
                            <form action='/pelanggan/hapus-reseller' method='POST' style='display:inline-block' onsubmit='return confirm("Anda yakin ingin menghapus reseller ${reseller.nama}? (${reseller.nama} nantinya tidak lagi menjadi reseller dari ${pelanggan.nama}!)")'>
                                <input type='hidden' name='_token' value='${my_csrf}'>
                                <input type='hidden' name='pelanggan_id' value='${pelanggan.id}'>
                                <input type='hidden' name='reseller_id' value='${reseller.id}'>
                                <button type='submit' class='btn btn-danger'>Hapus</button>
                            </form>
                        </td>
                    </tr>
                </table>
            </div>
            `;

            html_reseller += `
            <tr><td style="text-align:center"><img src="/img/icons/boy.svg" style="width:2rem"></td><td>${reseller.nama}<br></td><td id='dd-icon-${i_reseller}' style="text-align:center" onclick="showDD('#dd-${i_reseller}', '#dd-icon-${i_reseller}');"><img src="/img/icons/dropdown.svg" style="width:1em"></td></tr>
            <tr><td colspan='2'>${html_reseller_dropdown}</td></tr>
            `;
            i_reseller++;
        });
        html_reseller += `</table>`;


    }

    $('#divReseller').html(html_reseller);

    $('#ipt_pilih_reseller').autocomplete({
        source: list_of_resellers,
        select: function (event, ui) {
            if (show_console) {
                console.log(ui.item);
            }
            $('#ipt_id_reseller_terpilih').val(ui.item.id);
        }
    });

</script>
@endsection
