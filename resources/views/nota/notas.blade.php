@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8rem ml-1_5rem" src="img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div class="justify-self-right pr-0_5em">
        <a href="/nota/nota_baru-pilih_spk" id="btn-spk-baru" class="btn-atas-kanan2">
            + Buat Nota Baru
        </a>
    </div>
</header>

<div class="grid-2-auto mt-1rem ml-1rem mr-1rem pb-1rem bb-0_5px-solid-grey">
    <div class="justify-self-left grid-2-auto b-1px-solid-grey b-radius-50px mr-1rem pl-1rem pr-0_4rem w-11rem">
        <input class="input-2 mt-0_4rem mb-0_4rem" type="text" placeholder="Cari...">
        <div class="justify-self-right grid-1-auto justify-items-center circle-small bg-color-orange-1">
            <img class="w-0_8rem" src="img/icons/loupe.svg" alt="">
        </div>
    </div>
    <div class="div-filter-icon">

        <div class="icon-small-circle grid-1-auto justify-items-center bg-color-orange-1">
            <img class="w-0_9rem" src="img/icons/sort-by-attributes.svg" alt="sort-icon">
        </div>
    </div>
</div>

<div id="div-daftar-spk" class='ml-0_5em mr-0_5em'>
</div>

<script>

const notas = {!! json_encode($notas, JSON_HEX_TAG) !!};
const pelanggans = {!! json_encode($pelanggans, JSON_HEX_TAG) !!};
const daerahs = {!! json_encode($daerahs, JSON_HEX_TAG) !!};
const resellers = {!! json_encode($resellers, JSON_HEX_TAG) !!};
const arr_spk_produk_notas = {!! json_encode($arr_spk_produk_notas, JSON_HEX_TAG) !!};
const arr_spk_produks = {!! json_encode($arr_spk_produks, JSON_HEX_TAG) !!};
const arr_produks = {!! json_encode($arr_produks, JSON_HEX_TAG) !!};

if (show_console) {
    console.log("notas:");console.log(notas);
    console.log('pelanggans');console.log(pelanggans);
    console.log('resellers');console.log(resellers);
    console.log('arr_spk_produk_notas');console.log(arr_spk_produk_notas);
    console.log('arr_spk_produks');console.log(arr_spk_produks);
    console.log('arr_produks');console.log(arr_produks);
}

if (notas == undefined || notas.length == 0) {
    console.log('Belum ada daftar Nota');
} else {
    for (var i = 0; i < notas.length; i++) {
        // console.log(notas[i].created_at);
        // const SPKDate = notas[i].created_at.split('T')[0];
        const SPKDate = notas[i].created_at.split(' ')[0];
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

        if (notas[i].finished_at !== '' && notas[i].finished_at !== null) {
            const arrayDateSls = notas[i].finished_at.split('-');
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
        //     if (notas[i].status == "PROSES") {
        //         statusColor = "tomato";
        //     } else {
        //         statusColor = "slateblue";
        //     }
        //     html_tgl_sls = `
        //         <div style="font-weight:bold;color:${statusColor}">${notas[i].status}</div>
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
            id: `#divSPKItems-${i}`,
            time: 300
        }];
        // console.log('element_to_toggle:');
        // console.log(element_to_toggle);
        element_to_toggle = JSON.stringify(element_to_toggle);
        // console.log(element_to_toggle);

        // HTML Item each SPK
        var htmlItemsEachSPK = '<tr><th>Nama Nota</th><th>Jml.</th><th>Hrg./pcs</th><th>Hrg.t</th></tr>';

        for (var k = 0; k < arr_spk_produk_notas[i].length; k++) {
            var textContent_jumlah = `${arr_spk_produk_notas[i][k].jumlah}`;
            console.log('define textContent_jumlah');
            if (typeof arr_spk_produk_notas[i][k].deviasi_jml !== 'undefined') {
                console.log('deviasi_jml is defined!');
                const deviasi_jml = arr_spk_produk_notas[i][k].deviasi_jml;
                if (deviasi_jml < 0) {
                    textContent_jumlah += ` ${deviasi_jml}`;
                } else {
                    textContent_jumlah += ` +${deviasi_jml}`;
                }
            }
            htmlItemsEachSPK = htmlItemsEachSPK +
                `<tr>
                    <td>${arr_produks[i][k].nama_nota}</td>
                    <td>${arr_spk_produk_notas[i][k].jumlah}</td>
                    <td>${formatHarga(arr_spk_produk_notas[i][k].harga.toString())}</td>
                    <td>${formatHarga(arr_spk_produk_notas[i][k].harga_t.toString())}</td>
                </tr>`;
        }

        var nama_pelanggan = `${pelanggans[i].nama} - ${daerahs[i].nama}`;
        if (resellers[i] !== null) {
            nama_pelanggan = `${resellers[i].nama}: ${nama_pelanggan}`;
        }


        var htmlDaftarSPK =
            `<form method='GET' action='/nota/nota-detail' class='pb-0_5em pt-0_5em bb-1px-solid-grey'>
                <div class='grid-5-9_45_25_18_5'>
                    <div class='circle-medium grid-1-auto justify-items-center font-weight-bold' style='background-color: ${randomColor()}'>${pelanggans[i].initial}</div>
                    <div>${nama_pelanggan}</div>
                    <div class='grid-3-auto'>
                        <div class='grid-1-auto justify-items-center ${warnaTglPembuatan} b-radius-5px w-3_5em' style="color:white;">
                            <div style="font-size:2.5em">${getDay}</div><div>${getMonth}-${subGetYear}</div>
                        </div>
                        -
                        ${html_tgl_sls}
                    </div>
                    <div class='grid-1-auto'>
                        <div class='justify-self-right font-size-1_2em' style="color:green;font-weight:bold;">${formatHarga(notas[i].harga_total.toString())}</div>
                        <div class='justify-self-right' style='color:grey'>Rp.</div>
                    </div>
                    <div id='divDropdown-${i}' class='justify-self-center'><img class='w-0_7em' src='img/icons/dropdown.svg' onclick='showDropdown(${i});'></div>
                </div>` +
            // DROPDOWN
            `<div id='divDetailDropdown-${i}' class='p-0_5em b-1px-solid-grey' style='display: none'>
            <div class='font-weight-bold color-grey'>No. ${notas[i].no_nota}</div>
            <input type='hidden' name='nota_id' value=${notas[i].id}>
            <table style='width:100%'>${htmlItemsEachSPK}</table>
            <div class='text-right'>
            <button type='submit' class="d-inline-block bg-color-orange-1 pl-1rem pr-1em b-radius-50px" style='border: none'>
            Lebih Detail >>
            </button>
            </div>
            </div>
            </form>`;

        $('#div-daftar-spk').append(htmlDaftarSPK);
    }
}



// // set keadaan awal dimana JSON SPKToEdit dihilangkan
// if (localStorage.getItem('dataSPKToEdit') !== null || localStorage.getItem('dataSPKBefore') !== null) {
//     localStorage.removeItem('dataSPKToEdit');
//     localStorage.removeItem('dataSPKBefore');
// }

// // Reload Page
// const reload_page2 = {-!! json_encode($reload_page, JSON_HEX_TAG) !!};
// reloadPage(reload_page2);
</script>
@endsection
