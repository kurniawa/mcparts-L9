@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="grid-2-10_auto p-0_5rem">
        <img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt="">
        <h2 class="">Detail Surat Jalan: {{ $srjalan['no_srjalan'] }} </h2>
    </div>
</div>

<div class="container">
    <table style="border-collapse:unset;border-spacing:0.5rem">
        <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
        @if ($reseller !== null)
        <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk srjalan ini</td></tr>
        @endif
        <tr><th>No. srjalan</th><th>:</th><td>{{ $srjalan['no_srjalan'] }}</td></tr>
        <tr><th>Tanggal</th><th>:</th><td>{{ date('d-m-Y', strtotime($srjalan['created_at'])) }}</td></tr>
        <tr>
            <th style="vertical-align: top;">Alamat</th>
            <th style="vertical-align: top;">:</th>
            <td>
            {{-- @php
                dd($alamat)
            @endphp --}}
            @foreach (json_decode($alamat['long'], true) as $long)
            {{ $long }}<br>
            @endforeach
            </td>
        </tr>
    </table>
    <form action="/srjalan/edit-item-srjalan" method="GET" class="p-0_5rem">
        <table id="divDaftarItemsrjalan" style="width: 100%">
            <tr><th>No.</th><th>Nama</th><th>Jml.</th><th>Jml.P</th><th>Tipe.P</th></tr>
            @for ($i = 0; $i < count($produks); $i++)
            <tr>
                <td>{{ $i+1 }}</td>
                <td>{{ $produks[$i]['nama'] }}</td>
                <td>{{ $spk_produk_nota_srjalans[$i]['jumlah'] }}</td>
                <td class="numberToFormat">{{ $spk_produk_nota_srjalans[$i]['jml_packing'] }}</td>
                <td>{{ $spk_produk_nota_srjalans[$i]['tipe_packing'] }}</td>
            </tr>
            @endfor
        </table>
        <input type="hidden" name="srjalan_id" value={{ $srjalan['id'] }}>
        <input type="hidden" name="pelanggan_id" value={{ $pelanggan['id'] }}>
    </form>
    <div class="text-end fw-bold fs-5">
        @if ($srjalan['jml_colly']!==null)
        <div style="color: darkgreen"><span class="numberToFormat">{{ $srjalan['jml_colly'] }}</span> Koli</div>
        @endif
        @if ($srjalan['jml_dus']!==null)
        <div style="color: darkgreen"><span class="numberToFormat">{{ $srjalan['jml_dus'] }}</span> Dus</div>
        @endif
        <div class="fw-bold fs-4 color-red">Total</div>
    </div>
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
        left: 0.5rem;
        right: 0.5rem;
        height: 13em;
        background-color: white;
        padding: 1em;
    }
</style>

@endsection
