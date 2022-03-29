@extends('layouts/main_layout')

@section('content')

<div class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
</div>

<div class="threeDotMenu" style="z-index: 200">
    <div class="threeDot">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div class="divThreeDotMenuContent">
        <div class="threeDotMenuItem">
            <img class="w-1em" src="/img/icons/edit.svg" alt="">
            <div class="">Edit Informasi Pelanggan</div>
        </div>
        <form action="/pelanggan/pelanggan-ekspedisi" method="GET">
            <button style="width: 100%" class="threeDotMenuItem">
                <img class="w-1em" src="/img/icons/edit.svg" alt="">
                <span class="">Pelanggan <-> Ekspedisi</span>
            </button>
            <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
        </form>
        <div class="threeDotMenuItem" onclick="moveToEditReseller();">
            <img class="w-1em" src="/img/icons/edit.svg" alt="">
            <div class="">Tetapkan Reseller</div>
        </div>
        <form action="/sj/sj-printOut" method='POST'>
            <button id="downloadExcel" type="submit" class="threeDotMenuItem">
                <img src="/img/icons/download.svg" alt=""><span>Print Out Surat Jalan</span>
            </button>
            @csrf
        </form>
        <div id="konfirmasiHapusPelanggan" class="threeDotMenuItem">
            <img src="/img/icons/trash-can.svg" alt=""><span>Hapus Pelanggan</span>
        </div>
    </div>
</div>

<div id="areaClosingDotMenu" onclick="closingDotMenuContent();"></div>

<div class="ml-1em mr-0_5em mt-0_5em">
    <div class="grid-1-auto justify-items-center">
        <div id="customerAbbr" class="circle-medium bg-color-soft-red grid-1-auto font-weight-bold justify-items-center">{{ $pelanggan['initial'] }}</div>
        <h2 id="customerName" class="">Nama Customer</h2>
    </div>
</div>

<!-- INFO PELANGGAN DAN EKSPEDISI -->
<div class="grid-2-50_50 grid-row-gap-0_5em grid-column-gap-0_5em ml-0_5em mr-0_5em">

    <div class="b-1px-solid-grey">

        <div class="h-10em">
            <div class="grid-1-auto justify-items-center">
                <img class="w-2_5em" src="/img/icons/address.svg" alt="">
            </div>
            <div id="customerInfo" class="mt-0_5em font-size-0_9em font-weight-bold">Alamat Customer</div>
        </div>

    </div>

    <?php
    function createElementEkspedisi($index)
    {
        echo "<div class='b-1px-solid-grey'>

            <div class='h-10em'>
                <div class='grid-1-auto justify-items-center'>
                    <img class='w-2_5em' src='/img/icons/truck.svg' alt=''>
                </div>
                <div id='customerExpedition-$index' class='mt-0_5em font-size-0_9em font-weight-bold'>Data ekspedisi belum ada</div>
            </div>

            <!-- <div class='grid-1-auto justify-items-right'>
    <img class='w-1em' src='/img/icons/edit-grey.svg' alt=''>
</div> -->

        </div>";
    }
    // echo $jml_ekspedisi;
    // br_2x();
    if ($jml_ekspedisi == 0) {
        createElementEkspedisi(0);
    } elseif ($jml_ekspedisi >= 1) {
        for ($i = 0; $i < $jml_ekspedisi; $i++) {
            createElementEkspedisi($i);
        }
    }
    ?>


</div>
<!-- END - INFO PELANGGAN DAN EKSPEDISI -->

<div id="divReseller"></div>

<!-- DAFTAR PRODUK CUSTOMER INI -->
<div class="ml-0_5em mr-0_5em mt-1em">

    <div class="grid-2-10_auto grid-row-gap-0_5em">
        <img class="w-2_5em" src="/img/icons/shopping-cart.svg" alt="">
        <div style="font-weight:bold;">Daftar Produk Orderan Pelanggan ini:</div>
    </div>
</div>
<!-- END - DAFTAR PRODUK CUSTOMER INI -->

<div id="containerOrderanPelanggan" class="m-1em"></div>
</div>

<script>
// const show_console = true;

const cust_id = {!! json_encode($cust_id, JSON_HEX_TAG) !!};
var pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
var pelanggan_ekspedisi = {!! json_encode($pelanggan_ekspedisi, JSON_HEX_TAG) !!};
var ekspedisis = {!! json_encode($ekspedisis, JSON_HEX_TAG) !!};
const my_csrf = {!! json_encode($csrf, JSON_HEX_TAG) !!}

if (show_console === true) {
    console.log("pelanggan:");
    console.log(pelanggan);
    console.log("pelanggan_ekspedisi:");
    console.log(pelanggan_ekspedisi);
    console.log("DAFTAR EKSPEDISI:");
    console.log(ekspedisis);
}

const arr_alamat = pelanggan.alamat.split('[br]');
var html_alamat = '';
for (let i_arrAlamat = 0; i_arrAlamat < arr_alamat.length; i_arrAlamat++) {
    html_alamat += `${arr_alamat[i_arrAlamat]}<br>`;
}

// SET DATA CUSTOMER
$("#customerAbbr").html(pelanggan.singkatan);
$("#customerName").html(pelanggan.nama);
$("#customerInfo").html(html_alamat).append("<br>" + pelanggan.no_kontak);

// SET DATA EKSPEDISI
if (ekspedisis !== "EMPTY" && ekspedisis !== "ERROR" && ekspedisis.length !== 0) {
    for (var i = 0; i < ekspedisis.length; i++) {
        $htmlEkspedisi = "";
        var namaLengkapEkspedisi = "";

        namaLengkapEkspedisi += `${ekspedisis[i].nama} - <small style="font-weight: normal;">${pelanggan_ekspedisi[i]['tipe']}</small>`
        namaLengkapEkspedisi = namaLengkapEkspedisi.trim();

        const arr_alamat_eks = ekspedisis[i].alamat.split('[br]');
        var html_alamat_eks = '';
        for (let i_arrAlamatEks = 0; i_arrAlamatEks < arr_alamat_eks.length; i_arrAlamatEks++) {
            html_alamat_eks += `${arr_alamat_eks[i_arrAlamatEks]}<br>`;
        }

        $htmlEkspedisi +=
            `
            <span style='font-weight: 900;font-size:1.4em;'>${namaLengkapEkspedisi}</span><br>
            ${html_alamat_eks}
            <br>
            <div style="text-align:right" class="p-1em">
            <img id='btnHapusEkspedisi-${i}' src='/img/icons/trash-can.svg' style="width: 1.5em" onclick="dbDelete('pelanggan_ekspedisi', 'id', ${pelanggan_ekspedisi[i].id});">

            </div>
            `;

        $(`#customerExpedition-${i}`).html($htmlEkspedisi);
        console.log(`HTML EKSPEDISI-${i}`);
        console.log($htmlEkspedisi);
    }

}

function showMenu() {
    $("#showDotMenuContent").toggle(200);
    $("#areaClosingDotMenu").css("display", "block");

}

function closingDotMenuContent() {
    $("#showDotMenuContent").toggle();
    $("#areaClosingDotMenu").css("display", "none");

}

function backToCustomer() {
    // window.location.replace("04-01-pelanggan.php");
    window.history.back();
}

var reseller = {!! json_encode($reseller, JSON_HEX_TAG) !!};
console.log("reseller");
console.log(reseller);

if (reseller !== null) {
    var html_reseller = `
        <span style="font-weight: bold">Perhatian! Pelanggan ini memiliki Reseller, yakni:</span>
    `;
    // console.log("cust_id");
    // console.log(cust_id);
    var list_params = {
        json_obj: [reseller],
        keys: ['nama', 'daerah'],
        dd_keys: ['alamat', 'no_kontak'],
        delete: {
            table: 'pelanggan_reseller',
            input: [{
                key: 'id',
                name: 'id_reseller'
            }, {
                value: cust_id,
                name: 'cust_id'
            }],
            goBackNum: -2
        },
        detail: {
            link: `04-06-detail-pelanggan.php?id=`,
            key: 'id'
        }
    };

    var ListReseller = createList(list_params);


    document.getElementById('divReseller').classList = "m-1em";
    $('#divReseller').html(html_reseller + ListReseller);

}

document.getElementById("konfirmasiHapusPelanggan").addEventListener("click", function() {
        var deleteProperties = {
            title: "Yakin ingin menghapus Pelanggan ini?",
            yes: "Ya",
            no: "Batal",
            table: "pelanggans",
            column: "id",
            columnValue: pelanggan.id,
            action: "/pelanggan/hapus",
            csrf: my_csrf,
            goBackNumber: -2,
            goBackStatement: "Daftar Pelanggan"
        };

        var deletePropertiesStringified = JSON.stringify(deleteProperties);
        showLightBoxGlobal(deletePropertiesStringified);
    });

</script>

@endsection
