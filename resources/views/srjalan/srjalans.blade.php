@extends('layouts/main_layout')

@section('content')

<header class="header grid-3-auto">
    <img class="w-0_8em ml-1_5em" src="img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div>
        <h2 style="color: white">SJ</h2>
    </div>
    <div class="justify-self-right pr-0_5em">
        <a href="/sj/sjBaru-pCust" id="btn-spk-baru" class="btn-atas-kanan2">
            + Buat Surat Jalan Baru
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

const srjalans = {!! json_encode($srjalans, JSON_HEX_TAG) !!};
const pelanggans = {!! json_encode($pelanggans, JSON_HEX_TAG) !!};
const daerahs = {!! json_encode($daerahs, JSON_HEX_TAG) !!};
const resellers = {!! json_encode($resellers, JSON_HEX_TAG) !!};
const ekspedisis = {!! json_encode($ekspedisis, JSON_HEX_TAG) !!};
const arr_spk_produk_nota_srjalans = {!! json_encode($arr_spk_produk_nota_srjalans, JSON_HEX_TAG) !!};
const arr_spk_produk_notas = {!! json_encode($arr_spk_produk_notas, JSON_HEX_TAG) !!};
const arr_spk_produks = {!! json_encode($arr_spk_produks, JSON_HEX_TAG) !!};
const arr_produks = {!! json_encode($arr_produks, JSON_HEX_TAG) !!};

if (show_console) {
    console.log("srjalans:");console.log(srjalans);
    console.log('pelanggans');console.log(pelanggans);
    console.log('daerahs');console.log(daerahs);
    console.log('resellers');console.log(resellers);
    console.log('ekspedisis');console.log(ekspedisis);
    console.log('arr_spk_produk_nota_srjalans');console.log(arr_spk_produk_nota_srjalans);
    console.log('arr_spk_produk_notas');console.log(arr_spk_produk_notas);
    console.log('arr_spk_produks');console.log(arr_spk_produks);
    console.log('arr_produks');console.log(arr_produks);
}

if (srjalans == undefined || srjalans.length == 0) {
    console.log('Belum ada daftar Surat Jalan');
} else {
    var i_srjalan = 0;
    srjalans.forEach(srjalan => {
        const SJDate = srjalan.created_at.split(' ')[0];
        console.log(SJDate);
        var arrayDate = SJDate.split('-');
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

        if (srjalan.finished_at !== '' && srjalan.finished_at !== null) {
            const arrayDateSls = srjalan.finished_at.split('-');
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
                <div class='grid-1-auto justify-items-center ${warnaTglSls} color-white b-radius-5px w-3_5em'>
                <div class='font-size-2_5em'>${getDaySls}</div><div>${getMonthSls}-${subGetYearSls}</div></div>
            `;
        }

        // else {
        //     var statusColor = "";
        //     if (srjalan.status == "PROSES") {
        //         statusColor = "tomato";
        //     } else {
        //         statusColor = "slateblue";
        //     }
        //     html_tgl_sls = `
        //         <div style="font-weight:bold;color:${statusColor}">${srjalan.status}</div>
        //     `;
        // }

        // // MENGHITUNG Jumlah total
        // var jumlah_total_item_spk = 0;
        // for (let j = 0; j < spk_contains_item[i].length; j++) {
        //     jumlah_total_item_spk = jumlah_total_item_spk + parseFloat(spk_contains_item[i][j].jumlah);
        // }
        // console.log("jumlah total item spk:");
        // console.log(jumlah_total_item_spk);

        // ELEMENT to toggle
        var element_to_toggle = [{
            id: `#divSPKItems-${i_srjalan}`,
            time: 300
        }];
        // console.log('element_to_toggle:');
        // console.log(element_to_toggle);
        element_to_toggle = JSON.stringify(element_to_toggle);
        // console.log(element_to_toggle);

        // HTML Item each SPK
        var htmlItemsEachSPK = '<tr><th>Nama Produk</th><th>Jml.</th><th>Koli</th></tr>';

        var i_spk_produk_nota_srjalan = 0;
        arr_spk_produk_nota_srjalans[i_srjalan].forEach(spk_produk_nota_srjalan => {
            var textContent_jumlah = `${spk_produk_nota_srjalan.jumlah}`;
            console.log('define textContent_jumlah');
            if (arr_spk_produks[i_srjalan][i_spk_produk_nota_srjalan].deviasi_jml !== null) {
                console.log('deviasi_jml is defined!');
                const deviasi_jml = arr_spk_produks[i_srjalan][i_spk_produk_nota_srjalan].deviasi_jml;
                if (deviasi_jml < 0) {
                    textContent_jumlah += ` ${deviasi_jml}`;
                } else {
                    textContent_jumlah += ` +${deviasi_jml}`;
                }
            }

            var colly_item = spk_produk_nota_srjalan.colly;
            if (colly_item === null) {
                colly_item = '-';
            }
            htmlItemsEachSPK = htmlItemsEachSPK +
                `<tr>
                    <td>${arr_produks[i_srjalan][i_spk_produk_nota_srjalan].nama_nota}</td>
                    <td>${spk_produk_nota_srjalan.jumlah}</td>
                    <td>${colly_item}</td>
                </tr>`;

            i_spk_produk_nota_srjalan++;

        });

        var nama_pelanggan = `${pelanggans[i_srjalan].nama} - ${daerahs[i_srjalan].nama}`;
        if (resellers[i_srjalan] !== null) {
            nama_pelanggan = `${resellers[i_srjalan].nama}: ${nama_pelanggan}`;
        }

        var htmlDaftarSPK =
            `<form method='GET' action='/sj/sj-detailSJ' class='pb-0_5em pt-0_5em bb-1px-solid-grey'>
                <div class='grid-5-9_45_25_18_5'>
                    <div class='circle-medium grid-1-auto justify-items-center font-weight-bold' style='background-color: ${randomColor()}'>${pelanggans[i_srjalan].initial}</div>
                    <div>${nama_pelanggan}</div>
                    <div class='grid-3-auto'>
                        <div class='grid-1-auto justify-items-center ${warnaTglPembuatan} b-radius-5px w-3_5em' style="color:white;">
                            <div style="font-size:2.5em">${getDay}</div><div>${getMonth}-${subGetYear}</div>
                        </div>
                        -
                        ${html_tgl_sls}
                    </div>
                    <div class='grid-1-auto'>
                        <div class='justify-self-right font-size-1_2em' style="color:green;font-weight:bold;">${srjalan.colly}</div>
                        <div class='justify-self-right' style='color:grey'>Koli T</div>
                    </div>
                    <div id='divDropdown-${i_srjalan}' class='justify-self-center'><img class='w-0_7em' src='img/icons/dropdown.svg' onclick='showDropdown(${i_srjalan});'></div>
                </div>` +
            // DROPDOWN
            `<div id='divDetailDropdown-${i_srjalan}' class='p-0_5em b-1px-solid-grey' style='display: none'>
            <div class='font-weight-bold color-grey'>No. ${srjalan.no_srjalan}</div>
            <input type='hidden' name='srjalan_id' value=${srjalan.id}>
            <input type='hidden' name='pelanggan_id' value='${pelanggans[i_srjalan]['id']}'>
            <input type='hidden' name='daerah_id' value='${daerahs[i_srjalan]['id']}'>
            <input type='hidden' name='reseller_id' value='${resellers[i_srjalan]['id']}'>
            <input type='hidden' name='ekspedisi_id' value='${ekspedisis[i_srjalan]['id']}'>
            <table style='width:100%'>${htmlItemsEachSPK}</table>
            <div class='text-right'>
            <button type='submit' class="d-inline-block bg-color-orange-1 pl-1em pr-1em b-radius-50px" style='border: none'>
            Lebih Detail >>
            </button>
            </div>
            </div>
            </form>`;

        $('#div-daftar-spk').append(htmlDaftarSPK);

        i_srjalan++;
    });

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
