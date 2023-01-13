@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="containerDetailNota">
    <div class="row align-items-center">
        <div class="col-3"><img class="logo-mc" src="{{ asset('img/images/logo-mc.jpg') }}" alt="" style="width: 100%;"></div>
        <div class="col-4"><span class="fw-bold">CV. MC-Parts</span><br>Jl. Raya Karanggan No. 96<br>Kec. Gn. Putri/Kab. Bogor
            {{-- <br>0812 9335 218<br>0812 8655 6500 --}}
        </div>
        <div class="col-5 text-center fw-bold">
            <table>
                <tr><th>No. Nota</th><th>:</th><th>{{ $nota['no_nota'] }}</th></tr>
                <tr>
                    <th>Kepada</th><th>:</th>
                    <th>
                        @if ($pelanggan_nama!==null)
                        {{ $pelanggan_nama }}
                        @else
                        {{ $pelanggan['nama'] }}
                        @endif
                    </th>
                </tr>
                <tr><td>Tanggal</td><td>:</td><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
                <tr style="vertical-align: top"><td>Alamat</td><td>:</td>
                    <td>
                        @if ($cust_short!==null)
                        {{-- @foreach (json_decode($cust_long_ala,true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach --}}
                        <div>{{ $cust_short }}</div>
                        @else
                        @if ($alamat!==null)
                        @foreach (json_decode($alamat['long'], true) as $alm)
                        <div>{{ $alm }}</div>
                        @endforeach
                        @endif
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <table style="width: 100%;" class="mt-3 tableItemNota">
        <tr class="tr-border-bottom tr-border-left-right">
            <th class="text-center">Jumlah</th><th class="text-center">Nama Barang</th><th class="text-center">Hrg./pcs</th><th class="text-center">Harga</th>
        </tr>
        @for ($i = 0; $i < count($spk_produk_notas); $i++)
        <tr class='tr-border-left-right height-1_5em'>
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
        <tr class='tr-border-left-right height-1_5em'><td></td><td></td><td></td><td></td></tr>
        @endfor
        <tr class='tr-border-left-right tr-border-bottom'><td></td><td></td><td></td><td></td></tr>
        <tr>
            <td></td><td></td>
            <th class='blrb-total text-center'>Total Harga</th>
            <td class="blrb-total ps-2 pe-2">
                <div class="d-flex justify-content-between">
                    <span>Rp.</span>
                    <div><span class="toFormatNumber">{{ $nota['harga_total'] }}</span>,-</div>
                </div>
            </td>
        </tr>
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

<div class="containerDetailNota">
    <div class="row align-items-center">
        <div class="col-3"><img class="logo-mc" src="{{ asset('img/images/logo-mc.jpg') }}" alt="" style="width: 100%;"></div>
        <div class="col-4"><span class="fw-bold">CV. MC-Parts</span><br>Jl. Raya Karanggan No. 96<br>Kec. Gn. Putri/Kab. Bogor
            {{-- <br>0812 9335 218<br>0812 8655 6500 --}}
        </div>
        <div class="col-5 text-center fw-bold">
            <table>
                <tr><th>No. Nota</th><th>:</th><th>{{ $nota['no_nota'] }}</th></tr>
                <tr>
                    <th>Kepada</th><th>:</th>
                    <th>
                        @if ($pelanggan_nama!==null)
                        {{ $pelanggan_nama }}
                        @else
                        {{ $pelanggan['nama'] }}
                        @endif
                    </th>
                </tr>
                <tr><td>Tanggal</td><td>:</td><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
                <tr style="vertical-align: top"><td>Alamat</td><td>:</td>
                    <td>
                        @if ($cust_short!==null)
                        {{-- @foreach (json_decode($cust_long_ala,true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach --}}
                        <div>{{ $cust_short }}</div>
                        @else
                        @if ($alamat!==null)
                        @foreach (json_decode($alamat['long'], true) as $alm)
                        <div>{{ $alm }}</div>
                        @endforeach
                        @endif
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <table style="width: 100%;" class="mt-3 tableItemNota">
        <tr class="tr-border-bottom tr-border-left-right">
            <th class="text-center">Jumlah</th><th class="text-center">Nama Barang</th><th class="text-center">Hrg./pcs</th><th class="text-center">Harga</th>
        </tr>
        @for ($i = 0; $i < count($spk_produk_notas); $i++)
        <tr class='tr-border-left-right height-1_5em'>
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
        <tr class='tr-border-left-right height-1_5em'><td></td><td></td><td></td><td></td></tr>
        @endfor
        <tr class='tr-border-left-right tr-border-bottom'><td></td><td></td><td></td><td></td></tr>
        <tr>
            <td></td><td></td>
            <th class='blrb-total text-center'>Total Harga</th>
            <td class="blrb-total ps-2 pe-2">
                <div class="d-flex justify-content-between">
                    <span>Rp.</span>
                    <div><span class="toFormatNumber">{{ $nota['harga_total'] }}</span>,-</div>
                </div>
            </td>
        </tr>
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
    .containerDetailNota {
        font-family: 'Roboto';
        font-weight: normal;
        font-style: normal;
        /* font-size: 0.8em; */
    }

    .tableItemNota {
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

</script>

@endsection
