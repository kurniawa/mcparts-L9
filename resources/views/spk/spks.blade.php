@extends('layouts/main_layout')

@section('content')

<header class="header grid-3-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <h1 style="color: white">SPK</h1>
    <div class="justify-self-right pr-0_5em">
        <a href="/spk/spk-baru" id="btn-spk-baru" class="btn-atas-kanan2">
            + Buat SPK Baru
        </a>
    </div>
</header>

<div class="grid-2-auto mt-1em ml-1em mr-1em pb-1em bb-0_5px-solid-grey">
    <div class="justify-self-left grid-2-auto b-1px-solid-grey b-radius-50px mr-1em pl-1em pr-0_4em w-11em">
        <input class="input-2 mt-0_4em mb-0_4em" type="text" placeholder="Cari...">
        <div class="justify-self-right grid-1-auto justify-items-center circle-small bg-color-orange-1">
            <img class="w-0_8em" src="img/icons/loupe.svg" alt="">
        </div>
    </div>
    <div class="div-filter-icon">

        <div class="icon-small-circle grid-1-auto justify-items-center bg-color-orange-1">
            <img class="w-0_9em" src="img/icons/sort-by-attributes.svg" alt="sort-icon">
        </div>
    </div>
</div>

<div id="div-daftar-spk" class='ml-0_5em mr-0_5em'>
</div>

<script>

const spks = {!! json_encode($spks, JSON_HEX_TAG) !!};
const pelanggans = {!! json_encode($pelanggans, JSON_HEX_TAG) !!};
const daerahs = {!! json_encode($daerahs, JSON_HEX_TAG) !!};
const resellers = {!! json_encode($resellers, JSON_HEX_TAG) !!};
const arr_produks = {!! json_encode($arr_produks, JSON_HEX_TAG) !!};
const arr_spk_produks = {!! json_encode($arr_spk_produks, JSON_HEX_TAG) !!};
const arr_finished_at_last = {!! json_encode($arr_finished_at_last, JSON_HEX_TAG) !!};

if (show_console) {
    console.log("spks:");console.log(spks);
    console.log("pelanggans");console.log(pelanggans);
    console.log("daerahs");console.log(daerahs);
    console.log("resellers");console.log(resellers);
    console.log("arr_produks");console.log(arr_produks);
    console.log("arr_spk_produks");console.log(arr_spk_produks);
    console.log("arr_finished_at_last");console.log(arr_finished_at_last);
}

if (spks == undefined || spks.length == 0) {
    console.log('Belum ada daftar SPK');
} else {
    for (var i = 0; i < spks.length; i++) {
        // console.log(spks[i].created_at);
        const SPKDate = spks[i].created_at.split('T')[0];
        // const SPKDate = spks[i].created_at.split(' ')[0];
        console.log(SPKDate);
        var arrayDate = SPKDate.split('-');
        var getYear = arrayDate[0];
        var getMonth = arrayDate[1];
        var getDay = arrayDate[2];
        // console.log('getYear: ' + getYear);
        // console.log('getMonth: ' + getMonth);
        // console.log('getDay: ' + getDay);
        var subGetYear = getYear.substr(2);
        // console.log('subGetYear: ' + subGetYear);
        var warnaTglPembuatan = 'bg-color-soft-red';

        // apabila tanggal selesai telah ada
        var html_tgl_sls = "";

        var nama_pelanggan = `${pelanggans[i].nama} - ${daerahs[i].nama}`;
        if (resellers[i] !== 'none') {
            nama_pelanggan = `${resellers[i].nama}: ${nama_pelanggan}`;
        }

        if (spks[i].finished_at !== null) {
            const SPKDateSls = spks[i].finished_at.split(' ')[0];
            const arrayDateSls = SPKDateSls.split('-');
            const getYearSls = arrayDateSls[0];
            const getMonthSls = arrayDateSls[1];
            const getDaySls = arrayDateSls[2];

            // console.log('getYearSls: ' + getYearSls);
            // console.log('getMonthSls: ' + getMonthSls);
            // console.log('getDaySls: ' + getDaySls);
            subGetYearSls = getYearSls.substr(2);
            // console.log('subGetYearSls: ' + subGetYearSls);
            warnaTglSls = 'bg-color-purple-blue';
            warnaTglPembuatan = 'bg-color-orange-2';

            html_tgl_sls = `
                <div class='grid-1-auto justify-items-center ${warnaTglSls} b-radius-5px w-3_5em' style="color:white;">
                    <div style='font-size:2.5em'>${getDaySls}</div><div>${getMonthSls}-${subGetYearSls}</div>
                </div>
            `;
        } else {
            var statusColor = "";
            if (spks[i].status == "PROSES") {
                statusColor = "tomato";
            } else {
                statusColor = "slateblue";
            }
            html_tgl_sls = `
                <div style="font-weight:bold;color:${statusColor}">${spks[i].status}</div>
            `;
        }

        // // MENGHITUNG Jumlah total
        // var jumlah_total_item_spk = 0;
        // for (let j = 0; j < spk_contains_item[i].length; j++) {
        //     jumlah_total_item_spk = jumlah_total_item_spk + parseFloat(spk_contains_item[i][j].jumlah);
        // }
        // console.log("jumlah total item spk:");
        // console.log(jumlah_total_item_spk);

        // ELEMENT to toggle
        var element_to_toggle = [{
            id: `#divSPKItems-${i}`,
            time: 300
        }];
        // console.log('element_to_toggle:');
        // console.log(element_to_toggle);
        element_to_toggle = JSON.stringify(element_to_toggle);
        // console.log(element_to_toggle);

        // HTML Item each SPK
        var htmlItemsEachSPK = '';

        // const spk_item = JSON.parse(spks[i].data_spk_item);
        // console.log('spk_item');
        // console.log(spk_item);

        for (var k = 0; k < arr_spk_produks[i].length; k++) {
            var textContent_jumlah = `${arr_spk_produks[i][k].jumlah}`;
            console.log('define textContent_jumlah');
            const deviasi_jml = arr_spk_produks[i][k].deviasi_jml;

            // if (show_console) {
            //     console.log('deviasi_jml:');
            //     console.log(deviasi_jml);
            // }

            if (deviasi_jml !== 0) {
                console.log('deviasi_jml is defined!');
                if (deviasi_jml < 0) {
                    textContent_jumlah += ` ${deviasi_jml}`;
                } else if (deviasi_jml > 0) {
                    textContent_jumlah += ` +${deviasi_jml}`;
                }
            }
            htmlItemsEachSPK = htmlItemsEachSPK +
                `<div>${arr_produks[i][k].nama}</div><div>${textContent_jumlah}</div>`;
        }


        var htmlDaftarSPK =
            `<form method='GET' action='/spk/spk-detail' class='pb-0_5em pt-0_5em bb-1px-solid-grey'>
                <div class='grid-5-9_45_25_18_5'>
                <div class='circle-medium grid-1-auto justify-items-center font-weight-bold' style='background-color: ${randomColor()}'>${pelanggans[i].initial}</div>
                <div>
                    <div style="display:inline-block" class="border border-primary border-2 rounded p-1">${spks[i].no_spk}</div>
                    <div>${nama_pelanggan}</div>
                </div>
                <div class='grid-3-auto'>
                    <div class='grid-1-auto justify-items-center ${warnaTglPembuatan} b-radius-5px w-3_5em' style="color:white;">
                        <div style="font-size:2.5em">${getDay}</div><div>${getMonth}-${subGetYear}</div>
                    </div>
                -
                ${html_tgl_sls}
                </div>
                <div class='grid-1-auto'>
                <div class='justify-self-right font-size-1_2em' style="color:green;font-weight:bold;">${spks[i].jumlah_total}</div>
                <div class='justify-self-right' style='color:grey'>Jumlah</div>
                </div>
                <div id='divDropdown-${i}' class='justify-self-center'><img class='w-0_7em' src='img/icons/dropdown.svg' onclick='showDropdown(${i});'></div>
                </div>` +
            // DROPDOWN
            `<div id='divDetailDropdown-${i}' class='p-0_5em b-1px-solid-grey' style='display: none'>
            <div class='font-weight-bold color-grey'>No. ${spks[i].no_spk}</div>
            <input type='hidden' name='spk_id' value=${spks[i].id}>
            <div class='grid-2-auto'>${htmlItemsEachSPK}</div>
            <div class='text-right'>
            <button type='submit' class="d-inline-block bg-color-orange-1 pl-1em pr-1em b-radius-50px" style='border: none'>
            Lebih Detail >>
            </button>
            </div>
            </div>
            </form>`;

        $('#div-daftar-spk').append(htmlDaftarSPK);
    }
}

</script>

<style>
    .input-cari {
        border: none;
        width: 10em;
        border-radius: 25px;
        padding: 0.5em 1em 0.5em 1em;
        box-shadow: 0 0 2px gray;
    }

    .input-cari:focus {
        box-shadow: 0 0 6px #23FFAD;
    }

    .field {
        margin: 1em;
    }

    .div-filter-icon {
        justify-self: end;
    }

    .icon-small-circle {
        border-radius: 100%;
        width: 2em;
        height: 2em;
    }

    .icon-img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
@endsection
