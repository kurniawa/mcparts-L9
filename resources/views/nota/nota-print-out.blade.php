@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div id="containerDetailNota">
    <div class="row align-items-center">
        <div class="col-3"><img class="logo-mc" src="{{ asset('img/images/logo-mc.jpg') }}" alt="" style="width: 100%;"></div>
        <div class="col-4"><span class="fw-bold">CV. MC-Parts</span><br>Jl. Raya Karanggan No. 96<br>Kec. Gn. Putri/Kab. Bogor<br>0812 9335 218<br>0812 8655 6500</div>
        <div class="col-5 text-center fw-bold">
            <table>
                <tr><th>No. Nota</th><th>:</th><th>{{ $nota['no_nota'] }}</th></tr>
                <tr><th>Kepada</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
                <tr><td>Tanggal</td><td>:</td><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
                <tr style="vertical-align: top"><td>Alamat</td><td>:</td>
                    <td>
                        @foreach (json_decode($alamat['long'], true) as $alm)
                        {{ $alm }}<br>
                        @endforeach
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <table id="tableItemNota" style="width: 100%;" class="mt-3">
        <tr class="tr-border-bottom tr-border-left-right"><th>Jumlah</th><th>Nama Barang</th><th>Hrg./pcs</th><th>Harga</th></tr>
    </table>

    <br>
    <div class="grid-1-auto justify-items-right">
        <div class="grid-1-auto justify-items-center">
            <div class="">Hormat Kami,</div>
            <br><br><br>
            <div>(....................)</div>
        </div>
    </div>
</div>



<style>
    #containerDetailNota {
        font-family: 'Roboto';
        font-weight: normal;
        font-style: normal;
        /* font-size: 0.8em; */
    }

    #tableItemNota {
        border-collapse: collapse;
        border-top: 1px solid black;
    }

    .tr-border-bottom th {
        border-bottom: 1px solid black;
        padding-top: 1em;
        padding-bottom: 1em;
    }

    .tr-border-bottom td {
        border-bottom: 1px solid black;
    }

    .tr-border-left-right th,
    .tr-border-left-right td {
        border-left: 1px solid black;
        border-right: 1px solid black;
    }

    .height-1_5em td {
        height: 1.5em;
    }

    .blrb-total {
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: 3px solid black;
        padding-top: 1em;
        padding-bottom: 1em;
    }

    @media print {
        .bg-color-orange-1 {
            background-color: #FFED50;
            -webkit-print-color-adjust: exact;
        }
        .navbar{
            display:none;
        }

        @page {
            size: A4;
            /* DIN A4 standard, Europe */
            margin: 3mm 5mm 0 5mm;
        }

        html,
        body {
            width: 210mm;
            height: 297mm;
            /* height: 282mm; */
            /* font-size: 11px; */
            background: #FFF;
            overflow: visible;
            padding-top: 0mm;
        }

    }
</style>

<script>
    // OVERWRITE BEBERAPA VARIABLE DIATAS DENGAN VERSI BARU
    var nota = {!! json_encode($nota, JSON_HEX_TAG) !!};
    var pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    var reseller = {!! json_encode($reseller, JSON_HEX_TAG) !!};
    var spk_produk_notas = {!! json_encode($spk_produk_notas, JSON_HEX_TAG) !!};
    var spk_produks = {!! json_encode($spk_produks, JSON_HEX_TAG) !!};
    var produks = {!! json_encode($produks, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log("nota");console.log(nota);
        console.log("pelanggan");console.log(pelanggan);
        console.log("reseller");console.log(reseller);
        console.log("spk_produk_notas");console.log(spk_produk_notas);
        console.log("spk_produks");console.log(spk_produks);
        console.log("produks");console.log(produks);
    }

    var tglNota = ' $tglNota';
    var namaPelanggan = ' $namaPelanggan';
    var alamatPelanggan = ` $alamatPelanggan`;
    var totalHarga = 0;

    for (var i = 0; i < spk_produk_notas.length; i++) {
        var htmlItem =
            `
        <tr class='tr-border-left-right height-1_5em'><td>${formatHarga(spk_produk_notas[i].jumlah.toString())}</td><td>${produks[i].nama_nota}</td><td>${formatHarga(spk_produk_notas[i].harga.toString())}</td><td>${formatHarga(spk_produk_notas[i].harga_t.toString())}</td></tr>
        `;
        $('#tableItemNota').append(htmlItem);
    }

    var restRow = 16 - spk_produk_notas.length;
    console.log("restRow");
    console.log(restRow);

    for (var i = 0; i < restRow; i++) {
        var htmlRestRow =
            `
        <tr class='tr-border-left-right height-1_5em'><td></td><td></td><td></td><td></td></tr>
        `;
        $('#tableItemNota').append(htmlRestRow);
    }

    var htmlLastRow =
        `
    <tr class='tr-border-left-right tr-border-bottom'><td></td><td></td><td></td><td></td></tr>
    `;

    $('#tableItemNota').append(htmlLastRow);

    var htmlTotalHarga =
        `
        <tr><td></td><td></td>
        <th class='blrb-total'>Total Harga</th>
        <td class='blrb-total'>${formatHarga(nota.harga_total.toString())}</td>
        </tr>
        `;

    $('#tableItemNota').append(htmlTotalHarga);

    // document.querySelector('.closingGreyArea').addEventListener('click', (event) => {
    //     $('.closingGreyArea').hide();
    //     $('.lightBox').hide();
    // });

    // function showLightBox() {
    //     $('.lightBox').show();
    //     $('#closingGreyArea').show();
    //     $('.divThreeDotMenuContent').hide();
    // }

    // function closingLightBox() {
    //     $('.closingGreyArea').hide();
    //     $('.lightBox').hide();
    // }
</script>

@endsection
