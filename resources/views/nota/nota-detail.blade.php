@extends('layouts.main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8rem ml-1_5rem" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
</header>

<div class="threeDotMenu" style="z-index:200">
    <div class="threeDot">
        <div class="dot"></div>
        <div class="dot"></div>
        <div class="dot"></div>
    </div>
    <div class="divThreeDotMenuContent">
        {{-- <form method='post' action="nota/nota-editNota" id="" class="threeDotMenuItem">
            <img src="/img/icons/edit.svg" alt=""><span>Edit Nota</span>
        </form> --}}
        <!-- <div id="downloadExcel" class="threeDotMenuItem" onclick="goToPrintOutSPK();">
            <img src="img/icons/download.svg" alt=""><span>Download Excel</span>
        </div> -->
        <form action="/nota/nota-print-out" method="GET">
            <button id="downloadExcel" type="submit" class="threeDotMenuItem">
                <img src="/img/icons/download.svg" alt=""><span>Print Out Nota</span>
            </button>
            <input type="hidden" name="nota_id" value={{ $nota['id'] }}>
        </form>
        <form action="/nota/tambah-item" method="GET">
            @csrf
            <button type="submit" class="threeDotMenuItem" style="width: 100%">
                <img src="/img/icons/add.svg" alt=""><span>Tambah Item</span>
            </button>
            <input type="hidden" name="nota_id" value={{ $nota['id'] }}>
        </form>
        <form action="/nota/nota-hapus" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus Nota ini?');">
            @csrf
            <button type="submit" class="threeDotMenuItem" style="width: 100%">
                <img src="/img/icons/trash-can.svg" alt=""><span>Hapus Nota</span>
            </button>
            <input type="hidden" name="nota_id" value={{ $nota['id'] }}>
        </form>
    </div>
</div>

<div class="grid-2-10_auto p-0_5em">
    <img class="w-2em" src="/img/icons/pencil.svg" alt="">
    <h2 class="">Detail Nota: {{ $nota['no_nota'] }} </h2>
</div>

<table style="border-collapse:unset;border-spacing:0.5rem">
    <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
    @if ($reseller !== null)
    <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk Nota ini</td></tr>
    @endif
    <tr><th>No. Nota</th><th>:</th><td>{{ $nota['no_nota'] }}</td></tr>
    <tr><th>Tanggal</th><th>:</th><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
    <tr>
        <th style="vertical-align: top;">Alamat</th>
        <th style="vertical-align: top;">:</th>
        <td>
        @foreach (json_decode($pelanggan['alamat'], true) as $alamat)
        {{ $alamat }}<br>
        @endforeach
        </td>
    </tr>
</table>
<form action="/nota/edit-item-nota" method="GET" class="p-0_5em">
    <table id="divDaftarItemNota" style="width: 100%">
        <tr><th>No.</th><th>Nama Nota</th><th>Jml.</th><th>Hrg/Pcs</th><th>Harga</th><th>Opsi</th></tr>
        @for ($i = 0; $i < count($produks); $i++)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $produks[$i]['nama_nota'] }}</td>
            <td>{{ $spk_produk_notas[$i]['jumlah'] }}</td>
            <td class="numberToFormat">{{ $spk_produk_notas[$i]['harga'] }}</td>
            <td class="numberToFormat">{{ $spk_produk_notas[$i]['harga_t'] }}</td>
            <td>
                <button type="submit" class="btn btn-primary" name="data_item" value='{{ json_encode($data_items[$i]) }}'>Edit</button>
            </td>
        </tr>
        @endfor
    </table>
    <input type="hidden" name="nota_id" value={{ $nota['id'] }}>
    <input type="hidden" name="pelanggan_id" value={{ $pelanggan['id'] }}>
</form>
<div class="text-right p-1em">
    <div class="font-weight-bold font-size-2em color-green numberToFormat">{{ $nota['harga_total'] }}</div>
    <div class="font-weight-bold color-red font-size-1_5em">Total</div>
</div>

<style>
    @media print {
        .bg-color-orange-1 {
            background-color: #FFED50;
            -webkit-print-color-adjust: exact;
        }
    }
</style>

<script>
    const nota = {!! json_encode($nota, JSON_HEX_TAG) !!};
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const reseller = {!! json_encode($reseller, JSON_HEX_TAG) !!};
    const spk_produk_notas = {!! json_encode($spk_produk_notas, JSON_HEX_TAG) !!};
    const spk_produks = {!! json_encode($spk_produks, JSON_HEX_TAG) !!};
    const produks = {!! json_encode($produks, JSON_HEX_TAG) !!};

    if (show_console) {
        console.log("nota");console.log(nota);
        console.log("pelanggan");console.log(pelanggan);
        console.log("reseller");console.log(reseller);
        console.log("spk_produk_notas");console.log(spk_produk_notas);
        console.log("spk_produks");console.log(spk_produks);
        console.log("produks");console.log(produks);
    }

    const numberToFormat = document.querySelectorAll('.numberToFormat');
    numberToFormat.forEach(element => {
        const unformattedNumber = element.textContent;
        // console.log(element.textContent);
        const formattedNumber = formatHarga(unformattedNumber);
        element.textContent = formattedNumber;
    });

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
