@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
</header>

<div class="m-0_5em">

    <div>
        <h2>Pilihan SPK Berdasarkan Pelanggan</h2>
    </div>
    @if (count($av_spks) === 0)
    <div class="alert alert-primary">
        Belum ada pilihan SPK atau Item dari SPK yang tersedia untuk dibuatkan Nota nya!
    </div>
    @endif

    <div id="divTitleDesc" class="grid-1-auto justify-items-center mt-0_5em"></div>

    <input id="inputHargaTotalSPK" type="hidden">

</div>
<div id="divItemList2" class="p-1em">
    <form action="/nota/notaBaru-pSPK-pItem" method="GET" name="form_pCust_pSPK">
        @csrf
        <table style="width:100%;" id="tableItemList"></table>

        <div id="divMarginBottom" style="height: 20vh;"></div>

        <button id="btnKonfirmasi" type="submit" class="btn-warning-full" style="display:">Konfirmasi</button>
    </form>
</div>

<div id="divMarginBottom" style="height: 20vh;"></div>

<script>
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const daerah = {!! json_encode($daerah, JSON_HEX_TAG) !!};
    const reseller = {!! json_encode($reseller, JSON_HEX_TAG) !!};
    const av_spks = {!! json_encode($av_spks, JSON_HEX_TAG) !!};
    const arr_spk_produks = {!! json_encode($arr_spk_produks, JSON_HEX_TAG) !!};
    const arr_produks = {!! json_encode($arr_produks, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('pelanggan');console.log(pelanggan);
        console.log('reseller');console.log(reseller);
        console.log('av_spks');console.log(av_spks);
        console.log('arr_spk_produks');console.log(arr_spk_produks);
        console.log('arr_produks');console.log(arr_produks);
    }

    // Menentukan head dari table
    var htmlCusts = ``;
    var date_today = getDateToday();
    // console.log('date_today');
    // console.log(date_today);

    /*
    htmlCusts: menampung element html untuk List Nota Item
    htmlDD: Dropdown pertama, nanti nya akan disisipkan ke htmlCusts
    htmlDD2: Dropdown kedua, nanti nya akan disisipkan ke htmlCusts
    */
    // const spks = pelanggan.spks;
    /*
    variable dinamakan dengan sebutan jamak, karena bisa jadi pelanggan tersebut dibuatkan
    beberapa nota yang memang belum ada surat jalan nya.
    */
    // console.log('spks:');
    // console.log(spks);

    var htmlCheckboxspks = '';
    for (let i_checkboxSPK = 0; i_checkboxSPK < av_spks.length; i_checkboxSPK++) {
        var htmlDataSPKItem = '';
        for (let i_spkItem = 0; i_spkItem < arr_spk_produks[i_checkboxSPK].length; i_spkItem++) {
            htmlDataSPKItem += `
            <tr>
            <td>${arr_produks[i_checkboxSPK][i_spkItem].nama_nota}</td>
            <td>${formatHarga(arr_spk_produks[i_checkboxSPK][i_spkItem].jumlah.toString())}</td>
            </tr>
            `;
        }

        var nama_spk = av_spks[i_checkboxSPK].no_spk;
        var reseller_id = null;
        if (reseller !== null) {
            nama_spk = `${av_spks[i_checkboxSPK].no_spk} Reseller: ${reseller.nama}`;
            reseller_id = reseller.id;
        }

        htmlCheckboxspks += `
        <tr>
        <td class='p-2'>
            <input type='checkbox' name='' value='' class='c${i_checkboxSPK}'>
            <input type="hidden" name="spk_id[]" value=${av_spks[i_checkboxSPK].id} class='iptHidden-${i_checkboxSPK}' disabled>
            <input type="hidden" name="reseller_id[]" value=${reseller_id} class='iptHidden${i_checkboxSPK} iptHidden_resellerID-${i_checkboxSPK}' disabled>
        </td>
        <td class='p-2'>${nama_spk}</td>
        <td class='p-2'>Jumlah.T: ${formatHarga(av_spks[i_checkboxSPK].jumlah_total.toString())}</td>
        <td class='p-2'><img class='w-0_7em' src='/img/icons/dropdown.svg' id='ddImgRotate-${i_checkboxSPK}'></td>
        </tr>
        <tr id='DD2-${i_checkboxSPK}' style='display:'>
            <td colspan=4>
                <table style='width:100%'>
                    <tr><th>Nama</th><th>Jml.</th></tr>
                    ${htmlDataSPKItem}
                </table>
            </td>
        </tr>
        `;
    }

    /*
    Parameter untuk Dropdown kedua yang akan di kirim ke function isChecked
    */

    var htmlDD = '';

    htmlDD += `
        <table style='width:100%'>
            ${htmlCheckboxspks}
        </table>
    `;

    /*
    Parameter untuk Dropdown pertama yang akan di kirim ke function isChecked
    */

    var params_dd = {
        id_dd: `#DD-`,
        class_checkbox: ".dd",
        id_checkbox: `#ddCheckbox-`,
        id_button: `#btnSelesai_new`,
        // to_uncheck: params_dd2,
    }

    params_dd = JSON.stringify(params_dd);

    var nama_pelanggan_spk = pelanggan.nama;
    htmlCusts += `
        <tr class='bb-1px-solid-grey DD'><td><input id='rad_pCust-' type='radio' name='pCust' value='${pelanggan.id}'> <label for='rad_pCust-'>${nama_pelanggan_spk} - ${daerah.nama}</label></td></tr>
        <!-- <tr class='bb-1px-solid-grey'><td><input type='radio' name='pCust' value='test'>test</td></tr> -->
        <tr id='DD-' style='display:'><td colspan=3>${htmlDD}</td></tr>
        <tr class='bb-1px-solid-grey'><td></td></tr>
    `;


    $('#tableItemList').html(htmlCusts);

    var radio_pCust = document.form_pCust_pSPK.pCust;
    console.log('radio_pCust');
    console.log(radio_pCust);

    function pSPK_showDD(DD_id, DD_index) {
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
                    // showBtnKonfirmasi(i_radio, i_cBoxes_toUncheck);
                }
            }
        }
        // console.log(`DD_id: ${DD_id}; DD_index: ${DD_index}`);
        // var nota = JSON.parse(pelanggan[DD_index].spks);
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

    function showBtnKonfirmasi(i, j) {
        // console.log(i,j);
        var jumlah_checked = 0;
        var c_boxes = document.querySelectorAll(`.c-boxPNota-${i}`);
        var ipt_hiddens = document.querySelectorAll(`.iptHidden-${i}${j}`);
        // console.log(ipt_hiddens);
        // var ipt_hidden2 = document.querySelectorAll(`.${ipt_hidden_class2}`);
        // console.log(c_boxes)
        var ipt_hidden_all = document.querySelectorAll('.iptHidden');

        ipt_hidden_all.forEach(ipt_hidden => {
            ipt_hidden.disabled = true;
        });

        for (let k = 0; k < c_boxes.length; k++) {
            // console.log(c_boxes[k]);
            if (c_boxes[k].checked === true) {
                // console.log(ipt_hiddens);
                document.querySelector(`.iptHidden_notaID-${i}${k}`).disabled = false;
                document.querySelector(`.iptHidden_resellerID-${i}${k}`).disabled = false;
                jumlah_checked++;
            }
        }


        if (jumlah_checked > 0) {
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
