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
        <form action="/pelanggan/pelanggan-edit" method="GET">
            <button style="width: 100%" class="threeDotMenuItem">
                <img class="w-1em" src="/img/icons/edit.svg" alt="">
                <span class="">Edit Informasi Pelanggan</span>
            </button>
            <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
        </form>
        <form action="/pelanggan/pelanggan-ekspedisi" method="GET">
            <button style="width: 100%" class="threeDotMenuItem">
                <img class="w-1em" src="/img/icons/edit.svg" alt="">
                <span class="">Pelanggan <-> Ekspedisi</span>
            </button>
            <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
        </form>
        <form action="/pelanggan/tetapkan-reseller" method="GET">
            <button style="width: 100%" class="threeDotMenuItem">
                <img class="w-1em" src="/img/icons/edit.svg" alt="">
                <span class="">Pelanggan <-> Reseller</span>
            </button>
            <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
        </form>
        <form action="/pelanggan/hapus" method="POST" onsubmit="return confirm('Yakin ingin menghapus Pelanggan ini?')">
            @csrf
            <button style="width: 100%" class="threeDotMenuItem">
                <img class="w-1em" src="/img/icons/trash-can.svg" alt="">
                <span class="">Hapus Pelanggan</span>
            </button>
            <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
        </form>

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

        <div class="p-2">
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

            <div class='p-2'>
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

<div id="divReseller" class="m-2"></div>

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

const arr_alamat = JSON.parse(pelanggan.alamat);
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

        const arr_alamat_eks = JSON.parse(ekspedisis[i].alamat);
        var html_alamat_eks = '';
        for (let i_arrAlamatEks = 0; i_arrAlamatEks < arr_alamat_eks.length; i_arrAlamatEks++) {
            html_alamat_eks += `${arr_alamat_eks[i_arrAlamatEks]}<br>`;
        }

        $htmlEkspedisi +=
            `
            <span style='font-weight: 900;font-size:1.4em;'>${namaLengkapEkspedisi}</span><br>
            ${html_alamat_eks}
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

var resellers = {!! json_encode($resellers, JSON_HEX_TAG) !!};
console.log("resellers");
console.log(resellers);

if (resellers.length !== 0) {
    var html_reseller = `
        <span style="font-weight: bold">Perhatian! Pelanggan ini memiliki Reseller, yakni:</span>
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
        <tr><td><span style='font-size:3rem'>&#8729;</span> ${reseller.nama}<br></td><td id='dd-icon-${i_reseller}' style="text-align:center" onclick="showDD('#dd-${i_reseller}', '#dd-icon-${i_reseller}');"><img src="/img/icons/dropdown.svg" style="width:1em"></td></tr>
        <tr><td colspan='2'>${html_reseller_dropdown}</td></tr>
        `;
        i_reseller++;
    });
    html_reseller += `</table>`;

    $('#divReseller').html(html_reseller);

    // var list_params = {
    //     json_obj: [reseller[0]],
    //     keys: ['nama', 'daerah'],
    //     dd_keys: ['alamat', 'no_kontak'],
    //     delete: {
    //         table: 'pelanggan_reseller',
    //         input: [{
    //             key: 'id',
    //             name: 'id_reseller'
    //         }, {
    //             value: cust_id,
    //             name: 'cust_id'
    //         }],
    //         goBackNum: -2
    //     },
    //     detail: {
    //         link: `/pelanggan/pelanggan-detail`,
    //         key: 'id'
    //     }
    // };

    // var ListReseller = createList(list_params);


    // document.getElementById('divReseller').classList = "m-1em";
    // $('#divReseller').html(html_reseller + ListReseller);

}


// document.getElementById("konfirmasiHapusPelanggan").addEventListener("click", function() {
//         var deleteProperties = {
//             title: "Yakin ingin menghapus Pelanggan ini?",
//             yes: "Ya",
//             no: "Batal",
//             table: "pelanggans",
//             column: "id",
//             columnValue: pelanggan.id,
//             action: "/pelanggan/hapus",
//             csrf: my_csrf,
//             goBackNumber: -2,
//             goBackStatement: "Daftar Pelanggan"
//         };

//         var deletePropertiesStringified = JSON.stringify(deleteProperties);
//         showLightBoxGlobal(deletePropertiesStringified);
//     });

</script>

@endsection
