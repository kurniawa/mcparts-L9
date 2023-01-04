@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="containerDetailsj">
    <div class="sj-pelanggan">

        <div class="hr-line border-top border-2 mt-1 mb-1"></div>
        <div class="row align-items-center">
            <div class="col text-center">
                <div style="display: inline-block;" class="text-start">
                    <div>Pengirim:</div>
                    <span class="fw-bold">{{ $reseller['nama'] }}</span>
                    <div>
                        @for ($i = 0; $i < count($alamat_reseller_long); $i++)
                        {{ $alamat_reseller_long[$i] }}
                        @if ($i!==count($alamat_reseller_long)-1)
                        <br>
                        @endif
                        @endfor
                    </div>
                </div>
            </div>

            <div class="col fw-bold text-center judul-sj" style="position: relative">
                <span>SURAT JALAN /</span><br><span>TANDA TERIMA BARANG</span>
                <span style="font-size: 1.2rem;position: absolute;right:1rem;top:1rem">( Asli )</span>
            </div>
        </div>

        <div class="hr-line border-top border-2 mt-1 mb-1"></div>
        <div class="row">
            <div class="col-4">
                <div class="fw-bold font-big">Untuk:</div>
                <div class="fw-bold font-large">{{ $pelanggan['nama'] }}</div>
            </div>
            <div class="col-4">
                <div class="fw-bold font-big">Alamat:</div>
                <div class="font-big">
                    @for ($i = 0; $i < count($alamat_long); $i++)
                        {{-- @if ($i!==0)
                        <br>
                        @endif --}}
                        <div>{{ $alamat_long[$i] }}</div>
                    @endfor
                </div>
            </div>
            <div class="col-4">
                <table style="display: inline-table" style="font-size: 0.8rem;">
                    {{-- Nomor Surat Jalan sementara ini masih tidak dicantumkan --}}
                    {{-- <tr><td>No</td><td>:</td><td id="no_sj">{{ $srjalan['no_srjalan'] }}</td></tr> --}}
                    <tr><td>Tanggal</td><td>:</td><td>{{ date("d-m-Y", strtotime($srjalan['created_at'])) }}</td></tr>
                    <tr style="vertical-align: top"><td>Ekspedisi</td><td>:</td>
                        <td>
                            <span class="fw-bold">{{ $ekspedisi['nama'] }}</span>
                            @foreach (json_decode($alamat_ekspedisi['long'], true) as $alm_ekspedisi)
                            <div>{{ $alm_ekspedisi }}</div>
                            @endforeach
                            <div>{{ $ekspedisi['no_kontak'] }}</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <table class="tableItemsj">
            <tr>
                <th class="thTableItemsj font-big" style="width: 50%;text-align: center;">Nama / Jenis Barang</th>
                <th class="thTableItemsj font-big" style="text-align: center;">Jumlah</th>
            </tr>
            <tr>
                <td class="tdTableItemsj" style="position: relative">
                    <div class="fw-bold font-3xl" style="font-size: 1.2rem">{{ $srjalan['jenis_barang'] }}</div>
                    <img id="icon-edit-jenis-barang" src="{{ asset('img/icons/edit.svg') }}" onclick="showHideFromIcon(this.id,'form-edit-jenis-barang')" alt="edit" style="width: 1rem;position: absolute;bottom:1rem;right:1rem;">
                    <div id="form-edit-jenis-barang" class="d-none">
                        <form action="{{ route('srjalanEditJenisBarang') }}" method="POST">
                            @csrf
                            <input type="text" name="jenis_barang" id="" value="{{ $srjalan['jenis_barang'] }}" class="form-control">
                            <input type="hidden" name="srjalan_id" value="{{ $srjalan['id'] }}">
                            <button type="submit" class="btn btn-warning btn-sm mt-1">Konfirmasi</button>
                        </form>
                    </div>
                </td>
                <td class="tdTableItemsj fw-bold" style="font-size: 2rem;">
                    <div class="grid-2-auto grid-column-gap-0_5em">
                        <div id="divJmlKoli" class="justify-self-right">
                            <span id="jmlKoli">{{ $srjalan['jml_colly'] }}</span>
                        </div>
                        <img style="width: 2rem;" class="d-inline-block" src="/img/icons/koli.svg" alt="">
                    </div>
                </td>
            </tr>
        </table>
        <span style="font-style: italic;" class="font-big">*Barang sudah diterima dengan baik dan sesuai, oleh:</span>

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
        <br><br>
        <div class="hr-line border-top border-2"></div>
    </div>

    <div class="sj-pelanggan">

        <div class="hr-line border-top border-2 mt-1 mb-1"></div>
        <div class="row align-items-center">
            <div class="col text-center">
                <div style="display: inline-block;" class="text-start">
                    <div>Pengirim:</div>
                    <span class="fw-bold">{{ $reseller['nama'] }}</span>
                    <div>
                        @for ($i = 0; $i < count($alamat_reseller_long); $i++)
                        {{ $alamat_reseller_long[$i] }}
                        @if ($i!==count($alamat_reseller_long)-1)
                        <br>
                        @endif
                        @endfor
                    </div>
                </div>
            </div>

            <div class="col fw-bold text-center judul-sj" style="position: relative">
                <span>SURAT JALAN /</span><br><span>TANDA TERIMA BARANG</span>
                <span style="font-size: 1.2rem;position: absolute;right:1rem;top:1rem">( Copy )</span>
            </div>
        </div>

        <div class="hr-line border-top border-2 mt-1 mb-1"></div>
        <div class="row">
            <div class="col-4">
                <div class="fw-bold font-big">Untuk:</div>
                <div class="fw-bold font-large">{{ $pelanggan['nama'] }}</div>
            </div>
            <div class="col-4">
                <div class="fw-bold font-big">Alamat:</div>
                <div class="font-big">
                    @for ($i = 0; $i < count($alamat_long); $i++)
                        {{-- @if ($i!==0)
                        <br>
                        @endif --}}
                        <div>{{ $alamat_long[$i] }}</div>
                    @endfor
                </div>
            </div>
            <div class="col-4">
                <table style="display: inline-table" style="font-size: 0.8rem;">
                    {{-- Nomor Surat Jalan sementara ini masih tidak dicantumkan --}}
                    {{-- <tr><td>No</td><td>:</td><td id="no_sj">{{ $srjalan['no_srjalan'] }}</td></tr> --}}
                    <tr><td>Tanggal</td><td>:</td><td>{{ date("d-m-Y", strtotime($srjalan['created_at'])) }}</td></tr>
                    <tr style="vertical-align: top"><td>Ekspedisi</td><td>:</td>
                        <td>
                            <span class="fw-bold">{{ $ekspedisi['nama'] }}</span>
                            @foreach (json_decode($alamat_ekspedisi['long'], true) as $alm_ekspedisi)
                            <div>{{ $alm_ekspedisi }}</div>
                            @endforeach
                            <div>{{ $ekspedisi['no_kontak'] }}</div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>

        <table class="tableItemsj">
            <tr>
                <th class="thTableItemsj font-big" style="width: 50%;text-align: center;">Nama / Jenis Barang</th>
                <th class="thTableItemsj font-big" style="text-align: center;">Jumlah</th>
            </tr>
            <tr>
                <td class="tdTableItemsj" style="position: relative">
                    <div class="fw-bold font-3xl" style="font-size: 1.2rem">{{ $srjalan['jenis_barang'] }}</div>
                    <img id="icon-edit-jenis-barang" src="{{ asset('img/icons/edit.svg') }}" onclick="showHideFromIcon(this.id,'form-edit-jenis-barang')" alt="edit" style="width: 1rem;position: absolute;bottom:1rem;right:1rem;">
                    <div id="form-edit-jenis-barang" class="d-none">
                        <form action="{{ route('srjalanEditJenisBarang') }}" method="POST">
                            @csrf
                            <input type="text" name="jenis_barang" id="" value="{{ $srjalan['jenis_barang'] }}" class="form-control">
                            <input type="hidden" name="srjalan_id" value="{{ $srjalan['id'] }}">
                            <button type="submit" class="btn btn-warning btn-sm mt-1">Konfirmasi</button>
                        </form>
                    </div>
                </td>
                <td class="tdTableItemsj fw-bold" style="font-size: 2rem;">
                    <div class="grid-2-auto grid-column-gap-0_5em">
                        <div id="divJmlKoli" class="justify-self-right">
                            <span id="jmlKoli">{{ $srjalan['jml_colly'] }}</span>
                        </div>
                        <img style="width: 2rem;" class="d-inline-block" src="/img/icons/koli.svg" alt="">
                    </div>
                </td>
            </tr>
        </table>
        <span style="font-style: italic;" class="font-big">*Barang sudah diterima dengan baik dan sesuai, oleh:</span>

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
        <br><br>
        <div class="hr-line border-top border-2"></div>
    </div>


    <br>
    <div class="text-center mt-2">
        <button id="btn-show-sj-reseller" class="btn btn-outline-primary" onclick="showHideActive(this.id,'sj-reseller')">Show Sr. Jalan Reseller</button>
    </div>
    {{-- SJ RESELLER --}}
    <div id="sj-reseller" class="d-none">
        <div class="hr-line border-top border-2 mt-1 mb-1"></div>
        <div class="row align-items-center">
            <div class="col-3"><img class="logo-mc" src="{{ asset('img/images/logo-mc.jpg') }}" alt=""></div>
            <div class="col-3">
                <span class="fw-bold">CV. MC-Parts</span>
                <div>Jl. Raya Karanggan No. 96</div>
                <div>Kec. Gn. Putri/Kab. Bogor</div>
            </div>
            <div class="col-6 text-center fw-bold"><span class="judul-sj">SURAT JALAN /</span><br><span class="judul-sj">TANDA TERIMA BARANG</span></div>
        </div>
        <div class="hr-line border-top border-2"></div>
        <div class="row align-items-center">
            <div class="col-4">
                <div class="fw-bold font-big">Untuk:</div>
                <div class="fw-bold font-large">{{ $reseller['nama'] }}</div>
            </div>
            <div class="col-4">
                <div class="fw-bold font-big">Alamat:</div>
                <div class="font-big">
                    @for ($i = 0; $i < count($alamat_reseller_long); $i++)
                        <div>{{ $alamat_reseller_long[$i] }}</div>
                    @endfor
                </div>
            </div>
            <div class="col-4">
                <table style="display: inline-table">
                    {{-- <tr><td>No</td><td>:</td><td id="no_sj">{{ $srjalan['no_srjalan'] }}</td></tr> --}}
                    <tr><td>Tanggal</td><td>:</td><td>{{ date("d-m-Y", strtotime($srjalan['created_at'])) }}</td></tr>
                    <tr style="vertical-align: top"><td>Ekspedisi</td><td>:</td><td>-</td>
                    </tr>
                </table>
            </div>
        </div>

        <table id="tableItemsj">
            <tr>
                <th class="thTableItemsj font-big" style="width: 50%;text-align: center;">Nama / Jenis Barang</th>
                <th class="thTableItemsj font-big" style="text-align: center;">Jumlah</th>
            </tr>
            @for ($i_produk = 0; $i_produk < $jml_baris_produk; $i_produk++)
            @if ($i_produk<count($produks))
            <tr>
                <td style="border-right: 1px solid black" class="font-big ps-3">{{ $produks[$i_produk]['nama_nota'] }}</td>
                <td style="border-right: 1px solid black" class="font-big text-center">{{ $spk_produk_nota_srjalans[$i_produk]['jumlah'] }}</td>
            </tr>
            @else
            <tr>
                <td style="border-right: 1px solid black;height:1rem;"></td>
                <td style="border-right: 1px solid black;height:1rem;"></td>
            </tr>
            @endif
            @endfor
        </table>
        <span style="font-style: italic;" class="font-big">*Barang sudah diterima dengan baik dan sesuai, oleh:</span>
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

    </div>

    <div style="height: 5rem;"></div>
</div>



<style>
    .logo-mc {
        width: 10em;
    }
    /* #closingArea {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        z-index: 1;
    } */

    /* #inputEditKoli {
        width: 2em;
        font-size: xx-large;
        position: relative;
        z-index: 3;
    } */

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
    #icon-edit-jenis-barang:hover{
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
        #btn-show-sj-reseller,#icon-edit-jenis-barang,#form-edit-jenis-barang,.navbar{
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
