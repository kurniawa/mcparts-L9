@extends('layouts.main_layout')

@section('content')

<div class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">

</div>

<div class="m-0_5em">

    <div>
        <h2>Pilihan Nota Berdasarkan Pelanggan</h2>
    </div>

    <div id="divTitleDesc" class="grid-1-auto justify-items-center mt-0_5em"></div>

    <input id="inputHargaTotalSPK" type="hidden">

    <!-- <div id="divJmlTotal" class="text-right p-1em">
        <div id="divJmlTotal2" class="font-weight-bold font-size-2em color-green"></div>
        <div class="font-weight-bold color-red font-size-1_5em">Total</div>
    </div> -->

</div>
<div id="divItemList2" class="p-1em">
    <form action="/sj/sjBaru-pPelanggan-pProduk" method="GET" name="form_pCust_pNota">
        @csrf
        {{-- <input type='checkbox' name='main_checkbox' id='main_checkbox' onclick="checkAll(this.id, 'dd');"> Pilih Semua --}}
        <table style="width:100%;" id="tableItemList"></table>

        <div id="divMarginBottom" style="height: 20vh;"></div>

        <button id="btnKonfirmasi" type="submit" class="btn-warning-full" style="display:none">Konfirmasi</button>
    </form>
</div>

<div id="divMarginBottom" style="height: 20vh;"></div>

<script>

    const pelanggans = {!! json_encode($pelanggans, JSON_HEX_TAG) !!};
    const daerahs = {!! json_encode($daerahs, JSON_HEX_TAG) !!};
    const arr_notas = {!! json_encode($arr_notas, JSON_HEX_TAG) !!};
    const arr_resellers = {!! json_encode($arr_resellers, JSON_HEX_TAG) !!};
    const arr2_spk_produk_notas = {!! json_encode($arr2_spk_produk_notas, JSON_HEX_TAG) !!};
    const arr2_spk_produks = {!! json_encode($arr2_spk_produks, JSON_HEX_TAG) !!};
    const arr2_produks = {!! json_encode($arr2_produks, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('pelanggans');console.log(pelanggans);
        console.log('daerahs');console.log(daerahs);
        console.log('arr_notas');console.log(arr_notas);
        console.log('arr_resellers');console.log(arr_resellers);
        console.log('arr2_spk_produk_notas');console.log(arr2_spk_produk_notas);
        console.log('arr2_spk_produks');console.log(arr2_spk_produks);
        console.log('arr2_produks');console.log(arr2_produks);
    }

    // Menentukan head dari table
    var htmlCusts = ``;
    var date_today = getDateToday();
    // console.log('date_today');
    // console.log(date_today);

    let i_pelanggan = 0;
    pelanggans.forEach(pelanggan => {
        var htmlCheckboxNotas = '';

        let i_nota = 0
        arr_notas[i_pelanggan].forEach(nota => {
            // console.log('notas');console.log(notas);
            var htmlDataNotaItem = '';

            let i_spk_produk_nota = 0;
            arr2_spk_produk_notas[i_pelanggan][i_nota].forEach(spk_produk_nota => {
                htmlDataNotaItem += `
                <tr>
                <td>${arr2_produks[i_pelanggan][i_nota][i_spk_produk_nota].nama_nota}</td>
                <td>${formatHarga(spk_produk_nota.jumlah.toString())}</td>
                <td>${formatHarga(spk_produk_nota.harga.toString())}</td>
                <td>${formatHarga(spk_produk_nota.harga_t.toString())}</td>
                </tr>
                `;

                i_spk_produk_nota++;
            });

            var no_nota = nota.no_nota;
            if (arr_resellers[i_pelanggan][i_nota] !== null) {
                no_nota += `, Reseller: ${arr_resellers[i_pelanggan][i_nota].nama}`;
            }

            htmlCheckboxNotas += `
            <tr>
            <td class='p-2'>
                <input type='checkbox' name='' value='' onclick='showBtnKonfirmasi(this.className, "iptHidden_notaID-${i_pelanggan}")' class='c-boxPNota-${i_pelanggan}'>
                <input type="hidden" name="nota_id[]" value=${nota.id} class='iptHidden_notaID-${i_pelanggan}' disabled>
            </td>
            <td class='p-2'>${no_nota}</td>
            <td class='p-2'>Harga.T: Rp. ${formatHarga(nota.harga_total.toString())},-</td>
            <td class='p-2' onclick='showNotaItem("DD2-${i_pelanggan}${i_nota}", "ddImgRotate-${i_pelanggan}${i_nota}")'><img class='w-0_7em' src='/img/icons/dropdown.svg' id='ddImgRotate-${i_pelanggan}${i_nota}'></td>
            </tr>
            <tr id='DD2-${i_pelanggan}${i_nota}' style='display:none'>
                <td colspan=4>
                    <table style='width:100%'>
                        <tr><th>Nama</th><th>Jml.</th><th>Hrg./pcs</th><th>Hrg.t</th></tr>
                        ${htmlDataNotaItem}
                    </table>
                </td>
            </tr>
            `;

            i_nota++;

        });

        /*
        Parameter untuk Dropdown kedua yang akan di kirim ke function isChecked
        */

        var htmlDD = '';

        htmlDD += `
            <table style='width:100%'>
                ${htmlCheckboxNotas}
            </table>
        `;

        /*
        Parameter untuk Dropdown pertama yang akan di kirim ke function isChecked
        */

        var params_dd = {
            id_dd: `#DD-${i_pelanggan}`,
            class_checkbox: ".dd",
            id_checkbox: `#ddCheckbox-${i_pelanggan}`,
            id_button: `#btnSelesai_new`,
            // to_uncheck: params_dd2,
        }

        params_dd = JSON.stringify(params_dd);

            // <tr class='bb-1px-solid-grey'><td><input type='radio' name='pCust' value='test'>test</td></tr>
        htmlCusts += `
            <tr class='bb-1px-solid-grey DD'><td><input id='rad_pCust-${i_pelanggan}' type='radio' name='pelanggan_id' value='${pelanggan.id}' onclick='pNota_showDD("DD-${i_pelanggan}", ${i_pelanggan});'> <label for='rad_pCust-${i_pelanggan}'>${pelanggan.nama}</label></td></tr>
            <!-- <tr class='bb-1px-solid-grey'><td><input type='radio' name='pCust' value='test'>test</td></tr> -->
            <tr id='DD-${i_pelanggan}' style='display:none'><td colspan=3>${htmlDD}</td></tr>
            <tr class='bb-1px-solid-grey'><td></td></tr>
        `;

        i_pelanggan++;
    });

    $('#tableItemList').html(htmlCusts);

    var radio_pCust = document.form_pCust_pNota.pCust;
    console.log('radio_pCust');
    console.log(radio_pCust);

    function pNota_showDD(DD_id, DD_index) {
        const radioDD = document.querySelectorAll(".DD");
        for (let i_radio = 0; i_radio < radioDD.length; i_radio++) {
            // console.log('i_radio: ' + i_radio);
            // console.log('DD_index: ' + DD_index);
            if (DD_index !== i_radio) {
                $(`#DD-${i_radio}`).hide();
                var cBoxes_toUncheck = document.querySelectorAll(`#DD-${i_radio} input[type=checkbox]`);
                var inputHidden_toDisable = document.querySelectorAll(`#DD-${i_radio} input[type=hidden]`);
                for (let i_cBoxes_toUncheck = 0; i_cBoxes_toUncheck < cBoxes_toUncheck.length; i_cBoxes_toUncheck++) {
                    cBoxes_toUncheck[i_cBoxes_toUncheck].checked = false;
                    inputHidden_toDisable[i_cBoxes_toUncheck].disabled = true;
                    showBtnKonfirmasi(cBoxes_toUncheck[i_cBoxes_toUncheck].className, inputHidden_toDisable[i_cBoxes_toUncheck].className);
                }
            }
        }
        // console.log(`DD_id: ${DD_id}; DD_index: ${DD_index}`);
        // var nota = JSON.parse(pelanggans[DD_index].notas);
        // console.log(nota);
        $(`#${DD_id}`).show(300);
        // $DD.show();
    }

    function showNotaItem(idNotaItem, idRotateImg) {
        // console.log(idNotaItem);
        console.log(idRotateImg);
        $selectedElement = $(`#${idNotaItem}`);
        if ($selectedElement.css('display') === 'none') {
            $selectedElement.show(300);
            $("#" + idRotateImg).attr("src", "/img/icons/dropup.svg");
        } else {
            $selectedElement.hide();
            $("#" + idRotateImg).attr("src", "/img/icons/dropdown.svg");
        }

    }

    function showBtnKonfirmasi(c_box_class, ipt_hidden_class) {
        // console.log(c_box_class);
        var arr_indexInputToEnable = new Array();
        var c_boxes = document.querySelectorAll(`.${c_box_class}`);
        var ipt_hidden = document.querySelectorAll(`.${ipt_hidden_class}`);
        // console.log(c_boxes)
        for (let i_cBox = 0; i_cBox < c_boxes.length; i_cBox++) {
            if (c_boxes[i_cBox].checked === true) {
                arr_indexInputToEnable.push(i_cBox);
                ipt_hidden[i_cBox].disabled = false;
            }
        }
        if (arr_indexInputToEnable.length > 0) {
            document.getElementById("btnKonfirmasi").style.display = "block";
        } else {
            document.getElementById("btnKonfirmasi").style.display = "none";
        }
    }
    // for (var i = 0; i < radio_pCust.length; i++) {
    //     radio_pCust[i].addEventListener('click', function() {
    //         console.log(`i: ${i}`);
    //         console.log(this);
    //         $DD = document.getElementById(`DD-${i}`);
    //         console.log($DD);
    //         // $DD.show();

    //     });
    //     // radio_pCust[i].addEventListener('change', function() {
    //     //     (prev) ? console.log(prev.value): null;
    //     //     if (this !== prev) {
    //     //         prev = this;
    //     //     }
    //     //     console.log(this.value)
    //     // });
    // }

    $jmlTotalSPK = 0;
    var element_to_toggle = "";

    // $('#divSPKNumber').html(spk.id);
    $('#divSPKNumber').text('Ditentukan Secara Otomatis Setelah Konfirmasi Pembuatan Nota Baru');
    // $('#divItemList').html(htmlCusts);
    // $('#divTglPembuatan').html(tgl_pembuatan_dmY);

    function checkAll(mainCheckbox_id, classCheckboxChilds) {
        // console.log('mainCheckbox_id, classCheckboxChilds');
        // console.log(mainCheckbox_id, classCheckboxChilds);
        var checkboxChilds = document.querySelectorAll(`.${classCheckboxChilds}`);
        // console.log(checkboxChilds);
        // console.log(checkboxChilds[0]);
        // console.log(checkboxChilds[0].id);

        var i = 0;
        checkboxChilds.forEach(checkboxChild => {
            document.getElementById(checkboxChild.id).checked = true;

            var params_dd = {
                id_dd: `#DD-${i}`,
                class_checkbox: ".dd",
                id_checkbox: `#ddCheckbox-${i}`,
                id_button: `#btnSelesai_new`
            }

            // params_dd = JSON.stringify(params_dd);
            isChecked(params_dd);

            i++;
        });
    }

</script>
@endsection
