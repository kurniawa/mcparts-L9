@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex">
        <img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt="">
        <h2 class="ms-2">Tetapkan Selesai Sr. Jalan: {{ $srjalan['no_srjalan'] }} </h2>
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
    <table id="divDaftarItemsrjalan" style="width: 100%">
        <tr><th>No.</th><th>Nama</th><th>Jml.</th><th>Jml.P</th><th>Tipe.P</th><th>Opsi</th></tr>
        @for ($i = 0; $i < count($produks); $i++)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $produks[$i]['nama'] }}</td>
            <td>{{ $spk_produk_nota_srjalans[$i]['jumlah'] }}</td>
            <td class="numberToFormat">{{ $spk_produk_nota_srjalans[$i]['jml_packing'] }}</td>
            <td>{{ $spk_produk_nota_srjalans[$i]['tipe_packing'] }}</td>
            <td id='divDropdownIcon-{{ $i }}' onclick='showDropdown({{ $i }});' class="text-center"><img class='w-0_7rem' src='{{ asset('img/icons/dropdown.svg') }}'></td>
        </tr>
        <tr class="border-bottom" id='divDetailDropdown-{{ $i }}' style="display: none">
            <td colspan="6" class="text-end">
                <form action="{{ route('hapusItemSPK') }}" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                @csrf
                <button type="submit" name="spk_produk_id" value="{{ $spk_produks[$i]['id'] }}" class="btn btn-danger btn-sm" >Del</button>
                </form>
            </td>
        </tr>
        @endfor
    </table>

    <div class="text-end fw-bold fs-5">
        @if ($srjalan['jml_colly']!==null)
        <div style="color: darkgreen"><span class="numberToFormat">{{ $srjalan['jml_colly'] }}</span> Koli
        @endif
        @if ($srjalan['jml_dus']!==null)
        @if ($srjalan['jml_colly']!==null)
            +
        @endif
        <span class="numberToFormat">{{ $srjalan['jml_dus'] }}</span> Dus</div>
        @endif
        <div class="fw-bold fs-4 color-red">Total</div>
    </div>

    <form class="border border-success rounded border-2 p-2" action="{{ route('sjSelesaiDB') }}" method="POST">
        @csrf
        <h4>Input Tgl. Selesai Sr. Jalan</h4>
        <table>
            <tr>
                <td>Tgl. Selesai Sr. Jalan</td><td>:</td>
                <td>
                    <input id="tgl_selesai" type='datetime-local' name='tgl_selesai' class="form-control" value="{{ date('Y-m-d\TH:i:s') }}" required>
                    <div class="invalid-feedback" id="invalid-feedback-nama-baru"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='hidden' name='srjalan_id' value={{ $srjalan['id'] }}>
                </td>
            </tr>
        </table>
        <div class="text-center">
            <button class="btn btn-warning" type="submit">Konfirmasi Tgl. Nota Selesai</button>
        </div>
    </form>
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

</style>

@endsection
