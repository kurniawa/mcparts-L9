@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

@for ($i_copy_sj = 0; $i_copy_sj < 2; $i_copy_sj++)
<div class="containerDetailsj">
    {{-- SJ PELANGGAN TANPA RESELLER --}}
    <div class="hr-line border-top border-2 mt-1 mb-1"></div>
    <div class="row align-items-center" style="font-size: 0.8rem">
        <div class="col-3"><img class="logo-mc" src="{{ asset('img/images/logo-mc.jpg') }}" alt=""></div>
        <div class="col-3">
            <div class="fw-bold font-1_3">CV. MC-Parts</div>
            <div>Jl. Raya Karanggan No. 96</div><div>Kec. Gn. Putri/Kab. Bogor</div>
        </div>
        <div class="col-6 text-center fw-bold" style="position: relative">
            <span style="font-size:1.2rem;position:absolute;right:1rem;top:1rem">
                @if ($i_copy_sj===0)
                ( Asli )
                @else
                ( Copy )
                @endif
            </span>
            <span class="judul-sj">SURAT JALAN /</span><br><span class="judul-sj">TANDA TERIMA BARANG</span>
        </div>
    </div>

    <div class="hr-line border-top border-2 mt-1 mb-1"></div>
    <div class="row align-items-center">
        <div class="col-3">
            <div class="fw-bold">Untuk:</div>
            <div class="fw-bold">{{ $pelanggan_nama }}</div>
        </div>
        <div class="col-3" style="font-size: 0.8rem">
            <div class="fw-bold font-big">Alamat:</div>
            <div class="font-big">
                @for ($i = 0; $i < count($cust_long_ala); $i++)
                    <div>{{ $cust_long_ala[$i] }}</div>
                @endfor
                @if ($cust_kontak!=="")
                <div>
                    @if ($cust_kontak['kodearea']!==null)
                    <span>{{ $cust_kontak['kodearea'] }} </span>
                    @endif
                    <span>{{ $cust_kontak['nomor'] }}</span>
                </div>
                @endif
            </div>
        </div>
        <div class="col-6 font-1_2">
            <table style="display: inline-table;width:100%;" style="font-size: 0.8rem">
                {{-- <tr class="fw-bold" style="font-size: 0.8rem"><td>No</td><td>:</td><td id="no_sj">{{ $srjalan['no_srjalan'] }}</td></tr> --}}
                <tr style="font-size: 0.8rem"><td>Tanggal</td><td>:</td><td>{{ date("d-m-Y", strtotime($srjalan['created_at'])) }}</td></tr>
                <tr style="vertical-align: top;font-size:0.8rem"><td>Ekspedisi</td><td>:</td>
                    <td>
                        <div class="d-flex">
                            <div>
                                <span class="fw-bold">{{ $ekspedisi_nama }}</span>
                                @foreach ($eks_long_ala as $alm_ekspedisi)
                                <div>{{ $alm_ekspedisi }}</div>
                                @endforeach
                                @if ($eks_kontak!=="")
                                <div>
                                    @if ($eks_kontak['kodearea']!==null)
                                    <span>{{ $eks_kontak['kodearea'] }} </span>
                                    @endif
                                    <span>{{ $eks_kontak['nomor'] }}</span>
                                </div>
                                @endif
                            </div>

                            @if ($transit_nama!=="")
                            <div class="ms-3">
                                <div style="color: red" class="fw-bold">Via Ekspedisi:</div>
                                <span class="fw-bold">{{ $transit_nama }}</span>
                                @foreach ($trans_long_ala as $alm_transit)
                                <div>{{ $alm_transit }}</div>
                                @endforeach
                                @if ($trans_kontak!=="")
                                <div>
                                    @if ($trans_kontak['kodearea']!==null)
                                    <span>{{ $trans_kontak['kodearea'] }} </span>
                                    @endif
                                    <span>{{ $trans_kontak['nomor'] }}</span>
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

    <table class="tableItemsj">
        <tr>
            <th class="thTableItemsj " style="width: 50%;text-align: center;">Nama / Jenis Barang</th>
            <th class="thTableItemsj " style="text-align: center;">Jumlah</th>
        </tr>
        <tr>
            <td class="tdTableItemsj" style="position: relative">
                <div class="fw-bold font-3xl" style="font-size: 1.2rem">{{ $srjalan['jenis_barang'] }}</div>
                @if ($i_copy_sj===0)
                <img id="icon-edit-jenis-barang" class="icon-edit-jenis-barang" src="{{ asset('img/icons/edit.svg') }}" onclick="showHideFromIcon(this.id,'form-edit-jenis-barang')" alt="edit" style="width: 1rem;position: absolute;bottom:1rem;right:1rem;">
                <div id="form-edit-jenis-barang" class="form-edit-jenis-barang d-none">
                    <form action="{{ route('srjalanEditJenisBarang') }}" method="POST">
                        @csrf
                        <input type="text" name="jenis_barang" id="" value="{{ $srjalan['jenis_barang'] }}" class="form-control">
                        <input type="hidden" name="srjalan_id" value="{{ $srjalan['id'] }}">
                        <button type="submit" class="btn btn-warning btn-sm mt-1">Konfirmasi</button>
                    </form>
                </div>
                @endif
            </td>
            <td class="tdTableItemsj fw-bold" style="font-size: 2rem;">
                <div class="grid-2-auto grid-column-gap-0_5em">
                    <div id="divJmlKoli" class="justify-self-right">
                        @if ($srjalan['jml_colly']!==null && $srjalan['jml_colly'] !== 0)
                        <span id="jmlKoli">{{ $srjalan['jml_colly'] }}</span>
                        <img style="width: 2rem;" class="d-inline-block" src="/img/icons/koli.svg" alt="">
                        @endif
                        @if ($srjalan['jml_dus']!==null && $srjalan['jml_dus']!==0)
                        @if ($srjalan['jml_colly']!==null)
                            +
                        <span>{{ $srjalan['jml_dus'] }}</span> Dus</div>
                        @endif
                        @endif
                        @if ($srjalan['jml_rol']!==null && $srjalan['jml_rol'] !== 0)
                        {{-- {{ dump($srjalan['jml_rol']) }} --}}
                        <span id="jmlKoli"> {{ $srjalan['jml_rol'] }}</span> Rol
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
            <div class="">Penerima,</div>
            <br><br>
            <div>(....................)</div>
        </div>
        <div class="grid-1-auto justify-items-center">
            <div class="">Hormat Kami,</div>
            <br><br>
            <div>(....................)</div>
        </div>
    </div>
    <div class="hr-line border-top border-2 mt-2"></div>
</div>
@endfor


<style>
    .logo-mc {
        width: 10em;
    }

    .containerDetailsj {
        font-family: 'Roboto';
        font-weight: normal;
        font-style: normal;
    }

    .tableItemsj {
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
    .icon-edit-jenis-barang:hover{
        cursor: pointer;
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
        .icon-edit-jenis-barang,.form-edit-jenis-barang,.navbar{
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
