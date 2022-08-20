@extends('layouts.main_layout')

@section('content')

<div class="header grid-2-auto">
    <img class="w-0_8rem ml-1_5rem" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">

</div>

<div class="m-0_5em">
    <form action="/sj/sjBaru-pNota-pProduk-DB" method="POST">
        <div class="b-1px-solid-grey">
            <div class="text-center">
                <h2>SURAT JALAN BARU</h2>
            </div>
            <div class="grid-3-25_10_auto m-0_5em grid-row-gap-1em">
                <div>No.</div>
                <div>:</div>
                <div id="nomor_nota" class="font-weight-bold">Ditentukan Secara Otomatis Setelah Konfirmasi Pembuatan Nota Baru</div>
                <div>Tanggal</div>
                <div>:</div>
                <div id="divTglPembuatan" class="font-weight-bold"><input type="datetime-local" class="input-select-option-1 pb-1em" name="tgl_pembuatan" id="inputTglPembuatan" value="{{ date('Y-m-d H:i:s') }}"></div>
                <div>Untuk</div>
                <div>:</div>
                <div id="divSPKCustomer" class="font-weight-bold">
                @if ($reseller !== null)
                {{ $reseller['nama'] }}: {{ $pelanggan['nama'] }} - {{ $daerah['nama'] }}
                @else
                {{ $pelanggan['nama'] }} - {{ $daerah['nama'] }}
                @endif
                </div>
                <input id="inputIDCustomer" type="hidden" name="inputIDCustomer">
            </div>
            <div class="grid-1-auto justify-items-right m-0_5em">
                <div>
                    <img class="w-1em" src="/img/icons/edit-grey.svg" alt="">
                </div>
            </div>
        </div>

        <div id="divTitleDesc" class="grid-1-auto justify-items-center mt-0_5em"></div>

        @csrf
        <input type='checkbox' name='main_checkbox' id='main_checkbox' onclick="checkAll(this.id, 'dd_spk_items');"> Pilih Semua
        <table style="width:100%;" id="tableItemList"></table>

        <div id="divMarginBottom" style="height: 20vh;"></div>


        <button id="btnSelesai_new" type="submit" class="btn-warning-full" style="display:none">Konfirmasi</button>
    </form>
    @error('jml_input')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>



<div id="divMarginBottom" style="height: 20vh;"></div>
<style>

</style>

<script>
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const reseller = {!! json_encode($reseller, JSON_HEX_TAG) !!};
    const notas = {!! json_encode($notas, JSON_HEX_TAG) !!};
    const arr_spk_produk_notas = {!! json_encode($arr_spk_produk_notas, JSON_HEX_TAG) !!};
    const arr_spk_produks = {!! json_encode($arr_spk_produks, JSON_HEX_TAG) !!};
    const arr_produks = {!! json_encode($arr_produks, JSON_HEX_TAG) !!};

    if (show_console === true) {
        console.log('pelanggan');console.log(pelanggan);
        console.log("arr_spk_produk_notas:");console.log(arr_spk_produk_notas);
        console.log("arr_spk_produks:");console.log(arr_spk_produks);
        console.log("arr_produks:");console.log(arr_produks);
    }

    // Menentukan head dari table

    var date_today = getDateToday();
    // console.log('date_today');
    // console.log(date_today);
    var htmlAll = '';

    var i_nota = 0;
    notas.forEach(nota => {
        htmlAll += `
            <tr><td colspan=3><span style="font-weight:bold">${nota.no_nota}</span></td colspan=3></tr>
            <tr><td colspan=3><input type="hidden" name="nota_id[]" value=${nota.id}></td></tr>
        `;
        var htmlSPKItem = `<tr>
            <th>Nama</th><th>jml.T</th><th>jml.Av</th><th><th>
        </tr>`;

        var i_spk_produk_nota = 0;
        arr_spk_produk_notas[i_nota].forEach(spk_produk_nota => {
            var jml_t = arr_spk_produks[i_nota][i_spk_produk_nota].jml_t;
            var jumlah_sudah_srjalan = arr_spk_produks[i_nota][i_spk_produk_nota].jumlah_sudah_srjalan;

            var input_disabled = false;
            if (jumlah_sudah_srjalan === jml_t) {
                input_disabled = true;
            }

            var htmlDD = '';
            // var htmlDD2 = '';
            var sisa_jml = jml_t - jumlah_sudah_srjalan;
            var fColor = 'tomato';

            if (sisa_jml === 0) {
                fColor = 'slateblue';
            }
            /*
            Parameter untuk Dropdown kedua yang akan di kirim ke function isChecked
            */
           var params_dd2 = {
               id_dd: `#DD2-${i_nota}`,
               class_checkbox: ".dd_checkbox",
               id_checkbox: `#ddCheckbox2-${i_nota}`,
                id_button: `#none`
            }

            params_dd2 = JSON.stringify(params_dd2);

            htmlDD += `
                <table>
                    <tr><td>Jml. sudah Sr.Jalan</td><td>:</td><td>${jumlah_sudah_srjalan}<input type='hidden' name='jumlah_sudah_srjalan[${i_nota}][]' value=${jumlah_sudah_srjalan} disabled=${input_disabled}></td></tr>
                    <tr><td>Jml. ingin diinput</td><td>:</td><td><input type='number' name='jml_input[${i_nota}][]' value=${sisa_jml} disabled=${input_disabled}></td></tr>
                    <tr>
                        <td>
                            <input type='hidden' name='spk_produk_id[${i_nota}][]' value='${arr_spk_produks[i_nota][i_spk_produk_nota].id}' disabled=${input_disabled}>
                            <input type='hidden' name='spk_produk_nota_id[${i_nota}][]' value='${arr_spk_produk_notas[i_nota][i_spk_produk_nota].id}' disabled=${input_disabled}>
                        </td>
                    </tr>
                </table>
            `;

            var params_dd = {
                id_dd: `#DD-${i_nota}${i_spk_produk_nota}`,
                class_checkbox: ".dd_spk_items",
                id_checkbox: `#ddCheckbox-${i_nota}${i_spk_produk_nota}`,
                id_button: `#btnSelesai_new`,
                // to_uncheck: params_dd2,
            }

            params_dd = JSON.stringify(params_dd);

            htmlSPKItem += `
                <tr class='bb-1px-solid-grey'>
                    <td style='color:${fColor};font-weight:bold;font-size:1em;padding-bottom:1em;padding-top:1em;' class=''>${arr_produks[i_nota][i_spk_produk_nota].nama}</td>
                    <td style='color:slateblue;font-weight:bold;'>${jml_t}<input type='hidden' name='jml_t[${i_nota}][]' value='${jml_t}'></td>
                    <td style='color:green;font-weight:bold;'>${sisa_jml}<input type='hidden' name='jml_av[${i_nota}][]' value='${sisa_jml}'></td>
                    <td><input type='checkbox' id='ddCheckbox-${i_nota}${i_spk_produk_nota}' class='dd_spk_items' onclick='isChecked(${params_dd});'></td>
                </tr>
                <tr id='DD-${i_nota}${i_spk_produk_nota}' style='display:none'><td colspan=3>${htmlDD}</td></tr>
            `;

            i_spk_produk_nota++;
        });

        htmlAll += htmlSPKItem;

        i_nota++;
    });
    /*
    END LOOP i_nota
    */

    $('#tableItemList').html(htmlAll);

    $jmlTotalSPK = 0;
    var element_to_toggle = "";

    function checkAll(mainCheckbox_id, classCheckboxChilds) {
        var checkboxChilds = document.querySelectorAll(`.${classCheckboxChilds}`);
        if (show_console === true) {
            // console.log('mainCheckbox_id, classCheckboxChilds');
            // console.log(mainCheckbox_id, classCheckboxChilds);
            // console.log('checkboxChilds')console.log(checkboxChilds);
        }

        var i_nota = 0;
        checkboxChilds.forEach(checkboxChild => {
            document.getElementById(checkboxChild.id).checked = true;
            if (show_console === true) {
                // console.log("checkboxChild.id");
                // console.log(checkboxChild.id);
            }
            var id_number = checkboxChild.id.split("-");

            var params_dd = {
                id_dd: `#DD-${id_number[1]}`,
                class_checkbox: ".dd_spk_items",
                id_checkbox: `#ddCheckbox-${id_number[1]}`,
                id_button: `#btnSelesai_new`
            }

            // params_dd = JSON.stringify(params_dd);
            isChecked(params_dd);

            i_nota++;
        });
    }

</script>
@endsection
