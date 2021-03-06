@extends('layouts.main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
</header>

<div class="threeDotMenu" style="z-index: 200">
    <div class="threeDot">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div class="divThreeDotMenuContent">
        <form action="/srjalan/srjalan-printOut" method='GET'>
            <button id="downloadExcel" type="submit" class="threeDotMenuItem">
                <img src="/img/icons/download.svg" alt=""><span>Print Out Surat Jalan</span>
            </button>
            <input type="hidden" name="srjalan_id" value='{{ $srjalan['id'] }}'>
        </form>
        <form action="/srjalan/srjalan-hapus" method='POST' onsubmit="return confirm('Apakah Anda yakin ingin menghapus Surat Jalan ini?');">
            @csrf
            <button id="hapussrjalan" type="submit" class="threeDotMenuItem" style="width: 100%">
                <img src="/img/icons/trash-can.svg" alt=""><span>Hapus Surat Jalan</span>
            </button>
            <input type="hidden" name="srjalan_id" value={{ $srjalan['id'] }}>
        </form>
        <!-- <div id="deleteSPK" class="threeDotMenuItem" onclick="goToDeleteSPK();">
            <img src="img/icons/trash-can.svg" alt=""><span>Cancel/Hapus SPK</span>
        </div> -->
    </div>
</div>

<div class="grid-2-10_auto p-0_5em">
    <img class="w-2em" src="/img/icons/pencil.svg" alt="">
    <h2 class="">Detail Surat Jalan: {{ $srjalan['no_srjalan'] }} </h2>
</div>

<div class="table">
    <div>
        <div class="b-1px-solid-grey" style="width: 50%">

            <div>
                <div class="grid-1-auto justify-items-center">
                    <img class="w-2_5em" src="/img/icons/boy.svg" alt="">
                </div>
                <div id="info_cust"></div>
            </div>

        </div>

        <div class='b-1px-solid-grey' style="width: 50%">

            <div>
                <div class='grid-1-auto justify-items-center'>
                    <img class='w-2_5em' src='/img/icons/truck_2.svg' alt=''>
                </div>
                <div id="info_ekspedisi"></div>
            </div>

        </div>
    </div>
</div>

<div id="divDaftarItemsrjalan" class="p-0_5em"></div>

<style>
    @media print {
        .bg-color-orange-1 {
            background-color: #FFED50;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

<script>
    const srjalan = {!! json_encode($srjalan, JSON_HEX_TAG) !!};
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const daerah = {!! json_encode($daerah, JSON_HEX_TAG) !!};
    const reseller = {!! json_encode($reseller, JSON_HEX_TAG) !!};
    const ekspedisi = {!! json_encode($ekspedisi, JSON_HEX_TAG) !!};
    const spk_produk_nota_srjalans = {!! json_encode($spk_produk_nota_srjalans, JSON_HEX_TAG) !!};
    const spk_produk_notas = {!! json_encode($spk_produk_notas, JSON_HEX_TAG) !!};
    const spk_produks = {!! json_encode($spk_produks, JSON_HEX_TAG) !!};
    const produks = {!! json_encode($produks, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log("srjalan:");console.log(srjalan);
        console.log('pelanggan');console.log(pelanggan);
        console.log('daerah');console.log(daerah);
        console.log('reseller');console.log(reseller);
        console.log('ekspedisi');console.log(ekspedisi);
        console.log('spk_produk_nota_srjalans');console.log(spk_produk_nota_srjalans);
        console.log('spk_produk_notas');console.log(spk_produk_notas);
        console.log('spk_produks');console.log(spk_produks);
        console.log('produks');console.log(produks);
    }

    var arr_alamat_pelanggan = JSON.parse(pelanggan.alamat);
    var arr_alamat_ekspedisi = JSON.parse(ekspedisi.alamat);
    var alamat_pelanggan = '';
    var alamat_ekspedisi = '';

    arr_alamat_pelanggan.forEach(alamat => {
        alamat_pelanggan += `${alamat}<br>`;
    });

    arr_alamat_ekspedisi.forEach(alamat => {
        alamat_ekspedisi += `${alamat}<br>`;
    });

    var htmlInfoCust = '';

    if (reseller !== null) {
        htmlInfoCust += `
            Reseller: <span style='font-weight:bold'>${reseller.nama}</span> =><br>akan dicantumkan sebagai Pengirim.<br>Barang akan dikirimkan ke:
            <br>
            <br>
        `;
    }

    htmlInfoCust += `
    <div><span style='font-weight:bold'>${pelanggan.nama}</span></div>
    <div>${alamat_pelanggan}</div>
    <div>${pelanggan.no_kontak}</div>
    `;

    document.getElementById("info_cust").innerHTML = htmlInfoCust;

    var htmlInfoEkspedisi = `
        <div><span style='font-weight:bold'>${ekspedisi.nama}</span></div>
        <div>${alamat_ekspedisi}</div>
        <div>${ekspedisi.no_kontak}</div>
    `;

    document.getElementById("info_ekspedisi").innerHTML = htmlInfoEkspedisi;

    // var htmlItem = `
    //     <table>
    //         <tr><th>Jml.</th><th>Nama Barang</th><th>Koli</th></tr>
    // `;

    var htmlItem = `
        <div class='table'>
            <div style='font-weight:bold'><div>Jml.</div><div>Nama Barang</div><div>Koli</div></div>

    `;
    for (var i = 0; i < spk_produk_nota_srjalans.length; i++) {
        var nomorUrutItem = i + 1;

        var opsiEditToToggle = [{
            idCheckbox: `#checkboxShowOpsiEdit-${i}`,
            elementToToggle: `#divOpsiEdit-${i}`,
            time: 300
        }];

        opsiEditToToggle = JSON.stringify(opsiEditToToggle);

        var inputJumlahToToggle = [{
            idCheckboxORLogic: [`#checkboxShowInputJumlah-${i}`, `#checkboxShowInputNamaHrg-${i}`],
            elementToToggle: `#divInputJumlah-${i}`,
            elementORLogicToToggle: `#btnEdit-${i}`,
            time: 300
        }];

        inputJumlahToToggle = JSON.stringify(inputJumlahToToggle);

        var inputNamaHrgToToggle = [{
            idCheckboxORLogic: [`#checkboxShowInputNamaHrg-${i}`, `#checkboxShowInputJumlah-${i}`],
            elementToToggle: `#divInputNamaHrg-${i}`,
            elementORLogicToToggle: `#btnEdit-${i}`,
            time: 300
        }];

        inputNamaHrgToToggle = JSON.stringify(inputNamaHrgToToggle);

        var htmlElementDropdown = `
        <div id="divOpsiEdit-${i}" style="display:none">
            <div><input id="checkboxShowInputJumlah-${i}" type="checkbox" onclick='onMultipleCheckToggleWithORLogic(${inputJumlahToToggle});'>Edit Jumlah</div>
            <div id="divInputJumlah-${i}" class="mt-0_5em" style="display:none">
                Jumlah tersedia:
                Jumlah Tambahan yang Ingin diinput: <input class="p-0_5em" type="number" value="${spk_produk_nota_srjalans[i].jumlah}">
            </div>
            <div class="mt-0_5em"><input id="checkboxShowInputNamaHrg-${i}" type="checkbox" onclick='onMultipleCheckToggleWithORLogic(${inputNamaHrgToToggle});'>Edit Nama srjalan & Hrg/pcs</div>
            <div id="divInputNamaHrg-${i}" style="display:none">
                <div class="mt-0_5em">Nama srjalan: <input class="p-0_5em w-70" type="text" value="${produks[i].nama_srjalan}"></div>
                <div class="mt-0_5em">Hrg/pcs: <input class="p-0_5em" type="number" value="${spk_produk_notas[i].harga}"></div>
            </div>
            <br>
            <div id="divBtnHapusEdit-${i}" class="text-center">
                <input type="hidden" name="srjalan_id" value="${srjalan.id}">
                <button class="btn-1 bg-color-soft-red" type="submit" name="hapus">Hapus</button>
                <button id="btnEdit-${i}" class="btn-1 bg-color-orange-1" type="submit" name="edit" style="display:none">Konfirmasi Edit</button>
            </div>
        </div>
        `;

        // console.log(`nomorUrutItem: ${nomorUrutItem}`);
        // console.log(`spk_produk_nota_srjalans[${i}].jml_item: ${spk_produk_nota_srjalans[i].jml_item}`);
        // console.log(`spk_produk_nota_srjalans[${i}].nama_srjalan: ${spk_produk_nota_srjalans[i].nama_srjalan}`);
        // console.log(`spk_produk_nota_srjalans[${i}].hrg_item: ${spk_produk_nota_srjalans[i].hrg_item}`);
        // console.log(`spk_produk_nota_srjalans[${i}].hrg_t: ${spk_produk_nota_srjalans[i].hrg_t}`);
        // <div class="mt-0_5em text-right">Tampilkan Opsi Edit <input id="checkboxShowOpsiEdit-${i}" type="checkbox" onclick='onCheckToggle(${opsiEditToToggle});'></div>

        // ${htmlElementDropdown}

        var colly_item = spk_produk_nota_srjalans[i].colly;
        if (colly_item === null) {
            colly_item = '-';
        }
        htmlItem += `
            <div class="bb-1px-solid-grey pb-0_5em pt-0_5em">
                <div>${spk_produk_nota_srjalans[i].jumlah}</div>
                <div>${produks[i].nama_nota}</div>
                <div>${colly_item}</div>
            </div>
        `;
        // console.log(htmlItem);
        // totalHarga += parseInt(spk_produk_nota_srjalans[i].hrg_t);
    }
    htmlItem += '</div>';

    $('#divDaftarItemsrjalan').append(htmlItem);


    var htmlTotalHarga =
        `
        <div class="text-right p-1em">
            <div class="font-weight-bold font-size-2em color-green">${srjalan.colly}</div>
            <div class="font-weight-bold color-red font-size-1_5em">Total</div>
        </div>
        `;

    $('#divDaftarItemsrjalan').append(htmlTotalHarga);

    // document.getElementById("konfirmasiHapussrjalan").addEventListener("click", function() {
    //     var deleteProperties = {
    //         title: "Yakin ingin menghapus srjalan ini?",
    //         yes: "Ya",
    //         no: "Batal",
    //         table: "srjalans",
    //         column: "srjalan_id",
    //         columnValue: srjalan.id,
    //         action: "/srjalan/srjalan-hapus",
    //         csrf: my_csrf,
    //         goBackNumber: -2,
    //         goBackStatement: "Daftar srjalan"
    //     };

    //     var deletePropertiesStringified = JSON.stringify(deleteProperties);
    //     showLightBoxGlobal(deletePropertiesStringified);
    // });
</script>

<style>
    .closingGreyArea {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        background-color: black;
        opacity: 0.2;
    }

    .lightBox {
        position: absolute;
        top: 25vh;
        left: 0.5em;
        right: 0.5em;
        height: 13em;
        background-color: white;
        padding: 1em;
    }
</style>

@endsection
