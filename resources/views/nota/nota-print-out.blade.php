@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div id="containerDetailNota">
    <div class="hr-line border-top border-2 mt-1 mb-1"></div>
    <div class="row align-items-center">
        <div class="col-3"><img class="logo-mc" src="{{ asset('img/images/logo-mc.jpg') }}" alt="" style="width: 10rem;"></div>
        <div class="col-4"><div class="fw-bold" style="font-size:1.3rem">NOTA</div>
        <div class="fw-bold font-1_3" style="font-size: 0.8rem">CV. MC-Parts</div>
        <div style="font-size: 0.8rem">Jl. Raya Karanggan No. 96</div>
        <div style="font-size: 0.8rem">Kec. Gn. Putri/Kab. Bogor</div>
            {{-- <br>0812 9335 218<br>0812 8655 6500 --}}
        </div>
        <div class="col-5 text-center fw-bold">
            <table style="font-size: 0.8rem">
                <tr><th>No.</th><th>:</th><th>{{ $nomor_nota }}</th></tr>
                <tr>
                    <th>Kepada</th><th>:</th>
                    <th>
                        @if ($reseller!==null)
                        @if ($reseller_nama!==null)
                        {{ $reseller_nama }}
                        @else
                        {{ $reseller['nama'] }}
                        @endif
                        @else
                        @if ($pelanggan_nama!==null)
                        {{ $pelanggan_nama }}
                        @else
                        {{ $pelanggan['nama'] }}
                        @endif
                        @endif
                    </th>
                </tr>
                <tr><td>Tanggal</td><td>:</td><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
                <tr style="vertical-align: top"><td>Alamat</td><td>:</td>
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
                        @if ($cust_kontak!==null)
                        @if ($cust_kontak['kodearea']!==null)
                        <span>({{ $cust_kontak['kodearea'] }}) </span>
                        @endif
                        <span class="toFormatPhoneNumber">{{ $cust_kontak['nomor'] }}</span>
                        @else

                        @endif
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <table id="tableItemNota" style="width: 100%;" class="mt-3">
        <tr class="tr-border-bottom tr-border-left-right font-1_3 fw-bold">
            <td class="text-center">Jumlah</td><td class="text-center">Nama Barang</td><td class="text-center">Hrg./pcs</td><td class="text-center">Harga</td>
        </tr>
        @for ($i = 0; $i < count($spk_produk_notas); $i++)
        <tr class='tr-border-left-right font-1_1' style="font-size: 0.9rem">
            <td class="toFormatNumber text-end pe-2">{{ $spk_produk_notas[$i]['jumlah'] }}</td>
            <td class="ps-2 pe-2">{{ $nama_notas[$i] }}</td>
            <td class="ps-2 pe-2">
                <div class="d-flex justify-content-between">
                    <span>Rp.</span>
                    <div><span class="toFormatNumber">{{ $spk_produk_notas[$i]['harga'] }}</span>,-</div>
                </div>
            </td>
            <td class="ps-2 pe-2">
                <div class="d-flex justify-content-between">
                    <span>Rp.</span>
                    <div><span class="toFormatNumber">{{ $spk_produk_notas[$i]['harga_t'] }}</span>,-</div>
                </div>
            </td>
        @endfor
        @for ($j = 0; $j < $rest_row; $j++)
        <tr class='tr-border-left-right' style='height:1rem'><td></td><td></td><td></td><td></td></tr>
        @endfor
        <tr class='tr-border-left-right tr-border-bottom'><td></td><td></td><td></td><td></td></tr>
        <tr>
            <td></td><td></td>
            <td class='blrb-total text-center font-1_3 fw-bold'>Total Harga</td>
            <td class="blrb-total ps-2 pe-2">
                <div class="d-flex justify-content-between font-1_2">
                    <span>Rp.</span>
                    <div><span class="toFormatNumber">{{ $nota['harga_total'] }}</span>,-</div>
                </div>
            </td>
        </tr>
    </table>

    <div class="text-end mt-3">
        <div class="text-center me-5" style="display: inline-block">
            <div class="">Hormat Kami,</div>
            <br><br>
            <div>(....................)</div>
        </div>
    </div>

    <div class="hr-line border-top border-2 mt-2"></div>

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
        /* padding-top: 1em;
        padding-bottom: 1em; */
    }

    @media print {
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
        .navbar{
            display:none;
        }
        /* .logo-mc{
            width: 15rem;
        }
        .bg-color-orange-1 {
            background-color: #FFED50;
            -webkit-print-color-adjust: exact;
        }
        .font-big {
            font-size: 1.5rem;
        }
        .font-large{
            font-size: 1.7rem;
        }
        .font-3xl{
            font-size: 2rem;
        }
        .judul-sj{
            font-size: 2rem;
        }
        hr{
            display: block;
        }
        .font-1_3 {
            font-size: 1.3rem;
        }
        .font-1_2 {
            font-size: 1.2rem;
        }
        .font-1_1 {
            font-size: 1.1rem;
        } */
    }
</style>

<script>

</script>

@endsection
