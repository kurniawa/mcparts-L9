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
    <div class="d-flex justify-content-between">
        <div class="border border-2">
            <table style="border-collapse:unset;border-spacing:0.5rem">
                <tr><th>Pelanggan</th><th>:</th><th>@if ($pelanggan_nama!==null){{ $pelanggan_nama }}@else{{ $pelanggan['nama'] }}@endif</th></tr>
                @if ($reseller !== null)
                <tr>
                    <td></td><td></td>
                    <td><span style="font-weight: bold">@if ($reseller_nama!==null){{ $reseller_nama }}@else{{ $reseller['nama'] }}@endif</span> sebagai Reseller untuk Nota ini</td>
                </tr>
                @endif
                <tr><th>No. srjalan</th><th>:</th><td>{{ $srjalan['no_srjalan'] }}</td></tr>
                <tr><th>Tanggal</th><th>:</th><td>{{ date('d-m-Y', strtotime($srjalan['created_at'])) }}</td></tr>
                <tr>
                    <th style="vertical-align: top;">Alamat</th>
                    <th style="vertical-align: top;">:</th>
                    <td>
                        @if ($cust_long_ala!==null)
                        @foreach (json_decode($cust_long_ala,true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach
                        @else
                        @if ($alamat!==null)
                        @foreach (json_decode($alamat['long'], true) as $alm)
                        <div>{{ $alm }}</div>
                        @endforeach
                        @endif
                        @endif
                    </td>
                </tr>
                @if ($cust_kontak!==null)
                <tr>
                    <th></th><th></th>
                    <td>
                        @if ($cust_kontak['kodearea']!==null)
                        <span>({{ $cust_kontak['kodearea'] }}) </span>
                        @endif
                        <span class="toFormatPhoneNumber">{{ $cust_kontak['nomor'] }}</span>
                    </td>
                </tr>
                @endif
            </table>
        </div>
        <div class="border border-2">
            @if ($ekspedisi!==null)
            <table style="border-collapse:unset;border-spacing:0.5rem">
                <tr>
                    <th>Ekspedisi</th><th>:</th>
                    <td class="fw-bold">
                        @if ($ekspedisi_nama!==null)
                        {{ $ekspedisi_nama }}
                        @else
                        {{ $ekspedisi['nama'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th style="vertical-align: top;">Alamat</th>
                    <th style="vertical-align: top;">:</th>
                    <td>
                        @if ($eks_long_ala!==null)
                        @foreach (json_decode($eks_long_ala, true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach
                        @else
                        @if ($alamat_ekspedisi!==null)
                        @foreach (json_decode($alamat_ekspedisi['long'], true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach
                        @endif
                        @endif
                    </td>
                </tr>
                @if ($eks_kontak!==null)
                <tr>
                    <th></th><th></th>
                    <td>
                        @if ($eks_kontak['kodearea']!==null)
                        <span>({{ $eks_kontak['kodearea'] }}) </span>
                        @endif
                        <span class="toFormatPhoneNumber">{{ $eks_kontak['nomor'] }}</span>

                    </td>
                </tr>
                @else
                @if ($kontak_ekspedisi!==null)
                <tr>
                    <th></th><th></th>
                    <td>
                        @if ($kontak_ekspedisi['kodearea']!==null)
                        <span>({{ $kontak_ekspedisi['kodearea'] }}) </span>
                        @endif
                        <span class="toFormatPhoneNumber">{{ $kontak_ekspedisi['nomor'] }}</span>

                    </td>
                </tr>
                @endif
                @endif
            </table>
            @else
            <div>Ekspedisi belum ditetapkan!</div>
            @endif
            @if ($transit!==null)
            <table style="border-collapse:unset;border-spacing:0.5rem">
                <tr>
                    <th style="color: red">Via Ekspedisi</th><th>:</th>
                    <td class="fw-bold">
                        @if ($transit_nama!==null)
                        {{ $transit_nama }}
                        @else
                        {{ $transit['nama'] }}
                        @endif
                    </td>
                </tr>
                <tr>
                    <th style="vertical-align: top;">Alamat</th>
                    <th style="vertical-align: top;">:</th>
                    <td>
                        @if ($trans_long_ala!==null)
                        @foreach (json_decode($trans_long_ala, true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach
                        @else
                        @if ($alamat_transit!==null)
                        @foreach (json_decode($alamat_transit['long'], true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach
                        @endif
                        @endif
                    </td>
                </tr>
                @if ($kontak_transit!==null)
                <tr>
                    <th></th><th></th>
                    <td>
                        @if ($trans_kontak!==null)
                        @if ($trans_kontak['kodearea']!==null)
                        <span>({{ $trans_kontak['kodearea'] }}) </span>
                        @endif
                        <span class="toFormatPhoneNumber">{{ $trans_kontak['nomor'] }}</span>
                        @else
                        @if ($kontak_transit['kodearea']!==null)
                        <span>({{ $kontak_transit['kodearea'] }}) </span>
                        @endif
                        <span class="toFormatPhoneNumber">{{ $kontak_transit['nomor'] }}</span>
                        @endif
                    </td>
                </tr>
                @endif
            </table>
            @endif
        </div>
    </div>
    <table id="divDaftarItemsrjalan" style="width: 100%" class="mt-3 fancy-table">
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
        @if ($srjalan['jml_dus']!==null && $srjalan['jml_dus']!==0)
        @if ($srjalan['jml_colly']!==null)
            +
        @endif
        <span class="numberToFormat">{{ $srjalan['jml_dus'] }}</span> Dus</div>
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
