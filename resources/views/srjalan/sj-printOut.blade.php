@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div id="containerDetailsj">
    {{-- SJ PELANGGAN TANPA RESELLER --}}
    <div class="hr-line border-top border-2 mt-1 mb-1"></div>
    <div class="row align-items-center" style="font-size: 0.8rem">
        <div class="col-3"><img class="logo-mc" src="{{ asset('img/images/logo-mc.jpg') }}" alt=""></div>
        <div class="col-3"><div class="fw-bold font-1_3">CV. MC-Parts</div>
        <div>Jl. Raya Karanggan No. 96</div><div>Kec. Gn. Putri/Kab. Bogor</div>
    </div>
        <div class="col-6 text-center fw-bold"><span class="judul-sj">SURAT JALAN /</span><br><span class="judul-sj">TANDA TERIMA BARANG</span></div>
    </div>

    <div class="hr-line border-top border-2 mt-1 mb-1"></div>
    <div class="row align-items-center">
        <div class="col-3">
            <div class="fw-bold font-big">Untuk:</div>
            <div class="fw-bold font-large">{{ $pelanggan['nama'] }}</div>
        </div>
        <div class="col-3" style="font-size: 0.8rem">
            <div class="fw-bold font-big">Alamat:</div>
            <div class="font-big">
                @for ($i = 0; $i < count($alamat_long); $i++)
                    {{-- @if ($i!==0)
                    <br>
                    @endif --}}
                    <div>{{ $alamat_long[$i] }}</div>
                @endfor
                @if ($pelanggan_kontak!==null)
                <div>
                    @if ($pelanggan_kontak['kodearea']!==null)
                    <span>{{ $pelanggan_kontak['kodearea'] }} </span>
                    @endif
                    <span>{{ $pelanggan_kontak['nomor'] }}</span>
                </div>
                @endif
            </div>
        </div>
        <div class="col-6 font-1_2">
            <table style="display: inline-table;width:100%;" style="font-size: 0.8rem">
                <tr class="fw-bold" style="font-size: 0.8rem"><td>No</td><td>:</td><td id="no_sj">{{ $srjalan['no_srjalan'] }}</td></tr>
                <tr style="font-size: 0.8rem"><td>Tanggal</td><td>:</td><td>{{ date("d-m-Y", strtotime($srjalan['created_at'])) }}</td></tr>
                <tr style="vertical-align: top;font-size:0.8rem"><td>Ekspedisi</td><td>:</td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <span class="fw-bold">{{ $ekspedisi['nama'] }}</span>
                                @foreach (json_decode($alamat_ekspedisi['long'], true) as $alm_ekspedisi)
                                <div>{{ $alm_ekspedisi }}</div>
                                @endforeach
                                @if ($ekspedisi_kontak!==null)
                                <div>
                                    @if ($ekspedisi_kontak['kodearea']!==null)
                                    <span>{{ $ekspedisi_kontak['kodearea'] }} </span>
                                    @endif
                                    <span>{{ $ekspedisi_kontak['nomor'] }}</span>
                                </div>
                                @endif
                            </div>

                            @if ($transit!==null)
                            <div class="ms-3">
                                <div style="color: red">Via Ekspedisi:</div>
                                <span class="fw-bold">{{ $transit['nama'] }}</span>
                                @foreach (json_decode($alamat_transit['long'], true) as $alm_transit)
                                <div>{{ $alm_transit }}</div>
                                @endforeach
                                @if ($transit_kontak!==null)
                                <div>
                                    @if ($transit_kontak['kodearea']!==null)
                                    <span>{{ $transit_kontak['kodearea'] }} </span>
                                    @endif
                                    <span>{{ $transit_kontak['nomor'] }}</span>
                                </div>
                                @endif

                            </div>
                            @endif

                        </div>
                    </td>

                </tr>
            </table>
        </div>
    </div>

    <table id="tableItemsj">
        <tr>
            <th class="thTableItemsj font-large" style="width: 50%;text-align: center;">Nama / Jenis Barang</th>
            <th class="thTableItemsj font-large" style="text-align: center;">Jumlah</th>
        </tr>
        <tr>
            <td class="tdTableItemsj fw-bold font-3xl" style="font-size: 1.2rem">Sarung Jok Motor</td>
            <td class="tdTableItemsj fw-bold" style="font-size: 2rem;">
                <div class="grid-2-auto grid-column-gap-0_5em">
                    <div id="divJmlKoli" class="justify-self-right">
                        @if ($srjalan['jml_colly']!==null)
                        <span id="jmlKoli">{{ $srjalan['jml_colly'] }}</span>
                        <img style="width: 2rem;" class="d-inline-block" src="/img/icons/koli.svg" alt="">
                        @endif
                        @if ($srjalan['jml_dus']!==null && $srjalan['jml_dus']!==0)
                        @if ($srjalan['jml_colly']!==null)
                            +
                        <span>{{ $srjalan['jml_dus'] }}</span> Dus</div>
                        @endif
                        @endif
                    </div>
                </div>
            </td>
        </tr>
    </table>
    <span style="font-style: italic;font-size:0.8rem" class="font-big">*Barang sudah diterima dengan baik dan sesuai, oleh:</span>

    <br><br>

    <div class="grid-2-auto">
        <div class="grid-1-auto justify-items-center">
            <div class="font-large">Penerima,</div>
            <br><br>
            <div>(....................)</div>
        </div>
        <div class="grid-1-auto justify-items-center">
            <div class="font-large">Hormat Kami,</div>
            <br><br>
            <div>(....................)</div>
        </div>
    </div>
    <div class="hr-line border-top border-2 mt-2"></div>
</div>

<style>
    .logo-mc {
        width: 10em;
    }

    #containerDetailsj {
        font-family: 'Roboto';
        font-weight: normal;
        font-style: normal;
    }

    #tableItemsj {
        width: 100%;
        border-collapse: collapse;
        border: 1px solid black;
    }

    .thTableItemsj,
    .tdTableItemsj {
        border-left: 1px solid black;
        border-right: 1px solid black;
        border-bottom: 1px solid black;
    }

    .tdTableItemsj {
        height: 8rem;
        text-align: center;
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

        .judul-sj{
            font-size: 1.5rem;
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
        hr{
            display: block;
        .font-1_3 {
            font-size: 1.3rem;
        }
        .font-1_2 {
            font-size: 1.2rem;
        } */
    }
</style>

@endsection
