@extends('layouts.main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div class="justify-self-right pr-0_5em">
        <!-- <a href="06-02-produk-baru.php" id="btnNewProduct" class="btn-atas-kanan2">
            + Tambah Produk Baru
        </a> -->
    </div>
</header>

<form action="/spk/edit-kop-spk-db" method="POST">
    <div class="mt-1em ml-1em grid-2-10_auto">
        <div class="">
            <img class="w-2em" src="/img/icons/pencil.svg" alt="">
        </div>
        <h3>Form Edit Kop SPK</h3>
    </div>

    <div class="ml-0_5em mr-0_5em mt-2em">

        <div class="grid-2-auto grid-column-gap-1em mt-1em">
            <div class="pb-1em">
                <label class="color-grey" for="SPKNo">No. SPK:</label>
                <input id="SPKNo" class="input-1" type="text" placeholder="No." value={{ $spk['id'] }} disabled="true">
                <input type="hidden" name="id_spk" value={{ $spk['id'] }}>
            </div>
            <div class="pb-1em">
                <label for="date" class="color-grey">Tgl.:</label>
                <input type="datetime-local" class="input-select-option-1" name="tgl_pembuatan" id="date" value="{{ date('Y-m-d\TH:i:s', strtotime($spk['created_at'])) }}">
            </div>
        </div>

        <div id="divInputCustomerName" class="mt-1em mb-1em">
            <div class="bb-1px-solid-grey">
                <div class=" pb-1em">
                    <label class="color-grey" for="inputCustomerName">Nama Pelanggan:</label>
                    <input id="inputCustomerName" class="input-1 bb-none" type="text" value="{{ $pelanggan_nama }}">
                    {{--  onkeyup="findCustomer(this.value);" --}}
                    <input id="inputPelangganID" type="hidden" name="pelanggan_id" value={{ $pelanggan['id'] }}>
                    <input id="inputResellerID" type="hidden" name="reseller_id" value={{ $reseller_id }}>
                </div>
                <div id="searchResults" class="d-none b-1px-solid-grey bb-none"></div>
            </div>
        </div>

        <div class="mt-1em">
            <label for="titleDesc" class="color-grey">Keterangan (opt.):</label>
            <input id="titleDesc" class="input-1 pb-1em" type="text" name="ket_judul" value="{{ $spk['ket_judul'] }}" placeholder="Keterangan Judul (opsional)">
        </div>


    </div>

    <input id="idChosenCustName" type="hidden">

    <br><br>
    <div class="text-center">
        <button id="btnCancel" class="d-inline-block btn-1 bg-color-orange-1" onclick="goBack();">Batalkan Perubahan</button>
    </div>

    <div id="warning" class="d-none"></div>

    <div class="m-1em">
        <button id="btnEditSPK" type="submit" class="w-100 h-4em bg-color-orange-2 grid-1-auto">
            <span class="justify-self-center font-weight-bold">Edit Data SPK >></span>
        </button>
    </div>


    <div id="closingAreaPertanyaan" class="d-none position-absolute z-index-2 w-100vw h-100vh bg-color-grey top-0 opacity-0_5">
    </div>

</form>

<script>
    const spk = {!! json_encode($spk, JSON_HEX_TAG) !!};
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const label_pelanggan_resellers = {!! json_encode($label_pelanggan_resellers, JSON_HEX_TAG) !!};
    // const spk_produks = {-!! json_encode($spk_produks, JSON_HEX_TAG) !!};
    // const produks = {-!! json_encode($produks, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log('spk:');console.log(spk);
        console.log('pelanggan:');console.log(pelanggan);
        console.log('label_pelanggan_resellers:');console.log(label_pelanggan_resellers);
        // console.log('spk_produks');console.log(spk_produks);
        // console.log('produks');console.log(produks);
    }

    $("#inputCustomerName").autocomplete({
        source: label_pelanggan_resellers,
        select: function(event, ui) {
            console.log(ui);
            $("#inputPelangganID").val(ui.item.id);
            $("#inputResellerID").val(ui.item.reseller_id);
            // console.log(event);
            // alert(ui.item.name);
        }
    });

    // // deklarasi data-data dari localStorage dataSPKToEdit
    // dataSPK = JSON.parse(localStorage.getItem('dataSPKToEdit'));
    // console.log(dataSPK);

    // // assign data-data yang ada ke html
    // // format tanggal dulu sebelum bisa assign
    // // var tglPembuatan = new Date(dataSPK.tglPembuatan);
    // // console.log(tglPembuatan);
    // $('#SPKNo').val(dataSPK.id);
    // $('#date').val(dataSPK.tglPembuatan);
    // $('#inputCustomerName').val(dataSPK.custName);
    // $('#titleDesc').val(dataSPK.ketSPK);
    // $('#idChosenCustName').val(dataSPK.custID);

    //cek apakah ada data yang diubah, apabila ada data yang diubah, maka akan muncul tombol edit
    // document.getElementById('titleDesc').addEventListener('keyup', (event) => {
    //     // console.log(this);
    //     // console.log(event);
    //     console.log(event.target.value);
    //     showHideBtnEditSPK(event.target.value, spk.ket_judul);
    // });

    // document.getElementById('date').addEventListener('change', (event) => {
    //     console.log(event.target.value);
    //     showHideBtnEditSPK(event.target.value, spk.tgl_pembuatan);
    // });

    // function showHideBtnEditSPK(valueNew, valueOld) {
    //     if (valueNew != valueOld) {
    //         if ($('#btnEditSPK').css('display') == 'none') {
    //             $('#btnEditSPK').show();
    //         }
    //     } else {
    //         $('#btnEditSPK').css('display', 'none');
    //     }
    // }

    // Apabila ingin cancel perubahan
    // document.getElementById('btnCancel').addEventListener('click', () => {
    //     window.history.back();
    // });

    // function cekEkspedisi(params) {
    //     console.log(params);
    //     $idToReturn = "";
    //     if (params != "") {
    //         $.ajax({
    //             type: "POST",
    //             url: "04-04-cek-ekspedisi.php",
    //             async: false,
    //             data: {
    //                 nama: params
    //             },
    //             success: function(responseText) {
    //                 console.log(responseText);
    //                 $idToReturn = responseText;
    //             }
    //         });
    //     }
    //     console.log($idToReturn);
    //     return $idToReturn;

    // }

    // function findCustomer(customerName) {
    //     console.log(customerName);

    //     if (customerName === "") {
    //         $("#searchResults").html("").removeClass("grid-1-auto").addClass("d-none");
    //     }

    //     let results = liveSearch(customerName, "pelanggan", "nama");
    //     console.log(results);

    //     $htmlToAppend = "";

    //     if (results === "not found!") {
    //         $htmlToAppend = $htmlToAppend +
    //             "<div class='bb-1px-solid-grey hover-bg-color-grey pt-0_5em pb-0_5em pl-0_5em color-grey'>Pelanggan tidak ditemukan!</div>";
    //         $("#searchResults").html($htmlToAppend);

    //     } else {

    //         results = JSON.parse(results);
    //         console.log(results);

    //         if (results.length > 5) {
    //             results.splice(5);
    //         }
    //         $idResult = 0;
    //         for (const result of results) {
    //             $htmlToAppend = $htmlToAppend +
    //                 "<div id='chosenValue-" + $idResult + "' class='bb-1px-solid-grey hover-bg-color-grey pt-0_5em pb-0_5em pl-0_5em' onclick='pickChoice(" + $idResult + ")'>" +
    //                 result.nama + "</div>" +
    //                 `<input id='inputChosenValue-${$idResult}' type='hidden' value='${result.id}'>`;
    //             $idResult++;
    //         }

    //         $("#searchResults").html($htmlToAppend);
    //         $("#searchResults").removeClass("d-none").addClass("grid-1-auto");

    //     }

    // }

    // function pickChoice($idResult) {
    //     $inputCustomerName = $("#inputCustomerName");
    //     $chosenValue = $("#chosenValue-" + $idResult);
    //     $idChosenValue = $(`#inputChosenValue-${$idResult}`).val();
    //     $searchResults = $("#searchResults");
    //     $inputCustomerName.val($chosenValue.html());
    //     $('#inputCustomerID-2').val($idChosenValue);
    //     // $searchResults.remove();
    //     $searchResults.removeClass("grid-1-auto").addClass("d-none");

    //     // Set juga untuk halaman berikutnya ketika mau mulai masukkan produk
    //     $("#idChosenCustName").val($idChosenValue);

    //     showHideBtnEditSPK($('#inputCustomerID').val(), $('#inputCustomerID-2').val());
    // }

    // function editDataSPK() {
    //     let idSPK = $('#SPKNo').val();
    //     let tglPembuatan = $('#date').val();
    //     let custName = $('#inputCustomerName').val();
    //     let custID = $('#idChosenCustName').val();
    //     let titleDesc = $('#titleDesc').val();

    //     if (tglPembuatan != dataSPK.tglPembuatan || custName != dataSPK.custName || titleDesc != dataSPK.ketSPK) {
    //         console.log('ada yang diubah');
    //         dataSPK.tglPembuatan = tglPembuatan;
    //         dataSPK.custName = custName;
    //         dataSPK.ketSPK = titleDesc;

    //         $.ajax({
    //             url: '01-crud.php',
    //             type: 'POST',
    //             async: false,
    //             cache: false,
    //             data: {
    //                 type: 'UPDATE',
    //                 table: 'spk',
    //                 column: ['tgl_pembuatan', 'ket_judul', 'id_pelanggan'],
    //                 value: [tglPembuatan, titleDesc, custID],
    //                 dateIndex: ,
    //                 key: 'id',
    //                 keyValue: idSPK
    //             },
    //             success: function(res) {
    //                 console.log(res);
    //                 res = JSON.parse(res);
    //                 if (res === 'UPDATE SUCCEED') {
    //                     console.log('change localStorage.setItem dari dataSPKToEdit');
    //                     console.log(dataSPK);
    //                     localStorage.setItem('dataSPKToEdit', JSON.stringify(dataSPK));
    //                     console.log('pindah halaman');
    //                     window.history.back();
    //                 }
    //             }
    //         });
    //         return;
    //     }
    //     console.log('tidak ada yang diubah');
    //     return;
    // }

    // async function insertNewSPK() {
    //     console.log('SPKNo: ' + SPKNo);
    //     let result = [];
    //     let SPKDate = formatDate($('#date').val());
    //     let customerName = $('#inputCustomerName').val();
    //     let customerID = $('#inputIDCustomer').val();
    //     let titleDesc = $('#titleDesc').val();

    //     console.log('SPKDate: ' + SPKDate);
    //     console.log('customerName: ' + customerName);
    //     console.log('customerID: ' + customerID);
    //     console.log('titleDesc: ' + titleDesc);

    //     $.ajax({
    //         type: "POST",
    //         url: "01-crud.php",
    //         async: false,
    //         data: {
    //             type: 'insert',
    //             table: 'spk',
    //             column: ['id', 'tgl_pembuatan', 'ket_judul', 'id_pelanggan'],
    //             value: [SPKNo, SPKDate, titleDesc, customerID],
    //             dateIndex: 1,
    //             idToReturn: SPKNo
    //         },
    //         success: function(res) {
    //             res = JSON.parse(res);
    //             console.log(res);
    //             result = res;
    //         }
    //     });
    //     console.log('result insertNewSPK(): ' + result);
    //     return result;
    // }
</script>

@endsection
