@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="grid-2-10_auto p-0_5rem">
        <img class="w-2rem" src="/img/icons/pencil.svg" alt="">
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
            {{-- @php
                dd($alamat)
            @endphp --}}
            @foreach (json_decode($alamat['long'], true) as $long)
            {{ $long }}<br>
            @endforeach
            </td>
        </tr>
    </table>

    <form action="{{ route('edit_harga_item_nota') }}" method="GET" class="p-0_5rem">
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
                    <button type="submit" class="btn btn-primary" name="data_item" value='{{ json_encode($data_items[$i]) }}'>E.Hrg</button>
                </td>
            </tr>
            @endfor
        </table>
        <input type="hidden" name="nota_id" value={{ $nota['id'] }}>
        <input type="hidden" name="pelanggan_id" value={{ $pelanggan['id'] }}>
    </form>
    <div class="text-end mt-2">
        <div class="fw-bold text-success fs-5 numberToFormat">{{ $nota['harga_total'] }}</div>
        <div class="fw-bold text-danger fs-5">Total</div>
    </div>
</div>

<style>
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
        left: 0.5rem;
        right: 0.5rem;
        height: 13em;
        background-color: white;
        padding: 1em;
    }
</style>

@endsection
