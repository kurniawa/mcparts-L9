@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex">
        <img class="w-2rem" src="/img/icons/pencil.svg" alt="">
        <h2 class="ms-2">Detail Nota: {{ $nota['no_nota'] }} </h2>
    </div>

    <div class="border border-2">
        <table style="border-collapse:unset;border-spacing:0.5rem">
            <tr><th>Pelanggan</th><th>:</th><th>@if ($pelanggan_nama!==null){{ $pelanggan_nama }}@else{{ $pelanggan['nama'] }}@endif</th></tr>
            @if ($reseller!==null)
            <tr>
                <td></td><td></td>
                <td><span style="font-weight: bold">@if ($reseller_nama!==null){{ $reseller_nama }}@else{{ $reseller['nama'] }}@endif</span> sebagai Reseller untuk Nota ini</td>
            </tr>
            @endif
            <tr><th>No. Nota</th><th>:</th><td>{{ $nota['no_nota'] }}</td></tr>
            <tr><th>Tanggal</th><th>:</th><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
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
                    @if ($cust_kontak!==null)
                    @if ($cust_kontak['kodearea']!==null)
                    <span>({{ $cust_kontak['kodearea'] }}) </span>
                    @endif
                    <span class="toFormatPhoneNumber">{{ $cust_kontak['nomor'] }}</span>
                    @else

                    @endif
                </td>
            </tr>
        </table>
    </div>

    <table id="divDaftarItemNota" style="width: 100%" class="mt-3 fancy-table">
        <tr><th>No.</th><th>Nama Nota</th><th>Jml.</th><th>Hrg/Pcs</th><th>Harga</th><th>Opsi</th></tr>
        @for ($i = 0; $i < count($produks); $i++)
        <tr>
            <td class="text-end">{{ $i+1 }}</td>
            <td>{{ $nama_notas[$i] }}</td>
            <td class="text-end">{{ $spk_produk_notas[$i]['jumlah'] }}</td>
            <td>
                <div class="d-flex justify-content-between">
                    <div>Rp.</div>
                    <div><span class="numberToFormat">{{ $spk_produk_notas[$i]['harga'] }}</span><span>,-</span></div>
                </div>
            </td>
            <td>
                <div class="d-flex justify-content-between">
                    <div>Rp.</div>
                    <div><span class="numberToFormat">{{ $spk_produk_notas[$i]['harga_t'] }}</span>,-</div>
                </div>
            </td>
            <td id='divDropdownIcon-{{ $i }}' onclick='showDropdown({{ $i }});' class="text-center"><img class='w-0_7rem' src='{{ asset('img/icons/dropdown.svg') }}'></td>
        </tr>
        <tr class="border-bottom" id='divDetailDropdown-{{ $i }}' style="display: none">
            <td colspan="6" class="text-end">
                <a class="btn btn-primary btn-sm" href="{{ route('edit_harga_item_nota',['data_item'=>json_encode($data_items[$i]),'nota_id'=>$nota['id'],'pelanggan_id'=>$pelanggan['id']]) }}">E.Hrg</a>
                <a class="btn btn-dd btn-sm" href="{{ route('edit_nama_item_nota',['data_item'=>json_encode($data_items[$i]),'nota_id'=>$nota['id'],'pelanggan_id'=>$pelanggan['id']]) }}" >E.NaNo</a>
                <form action="{{ route('hapusItemSPK') }}" method="POST" class="d-inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?')">
                @csrf
                <button type="submit" name="spk_produk_id" value="{{ $spk_produks[$i]['id'] }}" class="btn btn-danger btn-sm" >Del</button>
                </form>
            </td>
        </tr>
        @endfor
    </table>

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

@endsection
