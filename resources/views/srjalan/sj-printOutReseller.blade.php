@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="text-center mt-2">
    {{-- <button class="btn btn-danger" onclick="toggleSJ('#sj-reseller','#sj-pelanggan');">SJ Reseller</button>
    <button class="btn btn-danger" onclick="toggleSJ('#sj-pelanggan','#sj-reseller');">SJ Pelanggan</button> --}}
    <button class="btn btn-secondary" onclick="toggleSJ('#sj-pelanggan','#sj-reseller');">Pelanggan/Reseller</button>
</div>

<div id="containerDetailsj">
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

        <div class="col fw-bold text-center judul-sj">
            <span>SURAT JALAN /</span><br><span>TANDA TERIMA BARANG</span>
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
            <table style="display: inline-table">
                <tr><td>No</td><td>:</td><td id="no_sj">{{ $srjalan['no_srjalan'] }}</td></tr>
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

    <table id="tableItemsj">
        <tr>
            <th class="thTableItemsj font-big" style="width: 50%;text-align: center;">Nama / Jenis Barang</th>
            <th class="thTableItemsj font-big" style="text-align: center;">Jumlah</th>
        </tr>
        <tr>
            <td class="tdTableItemsj fw-bold font-3xl">Sarung Jok Motor</td>
            <td class="tdTableItemsj fw-bold" style="font-size: 3rem;">
                <div class="grid-2-auto grid-column-gap-0_5em">
                    <div id="divJmlKoli" class="justify-self-right">
                        <span id="jmlKoli">{{ $srjalan['jml_colly'] }}</span>
                    </div>
                    <img style="width: 3rem;" class="d-inline-block" src="/img/icons/koli.svg" alt="">
                </div>
            </td>
        </tr>
    </table>
    <span style="font-style: italic;" class="font-big">*Barang sudah diterima dengan baik dan sesuai, oleh:</span>

    <br><br>

    <div class="grid-2-auto">
        <div class="grid-1-auto justify-items-center">
            <div class="font-large">Penerima,</div>
            <br><br><br><br>
            <div>(....................)</div>
        </div>
        <div class="grid-1-auto justify-items-center">
            <div class="font-large">Hormat Kami,</div>
            <br><br><br><br>
            <div>(....................)</div>
        </div>
    </div>
    <br><br>
    <div class="hr-line border-top border-2"></div>
    <br>
    {{-- SJ RESELLER --}}
    <div class="hr-line border-top border-2 mt-1 mb-1"></div>
    <div class="row align-items-center">
        <div class="col-3"><img class="logo-mc" src="{{ asset('img/images/logo-mc.jpg') }}" alt=""></div>
        <div class="col-3">
            <span class="fw-bold">CV. MC-Parts</span>
            <div>Jl. Raya Karanggan No. 96</div>
            <div>Kec. Gn. Putri/Kab. Bogor</div>
            <div>0812 9335 218</div>
            <div>0812 8655 6500</div>
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
                <tr><td>No</td><td>:</td><td id="no_sj">{{ $srjalan['no_srjalan'] }}</td></tr>
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
            <br><br><br><br>
            <div>(....................)</div>
        </div>
        <div class="grid-1-auto justify-items-center">
            <div class="font-large">Hormat Kami,</div>
            <br><br><br><br>
            <div>(....................)</div>
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

    .thTableItemsj {
        height: 3em;
    }

    .tdTableItemsj {
        height: 10rem;
        text-align: center;
    }

    @media print {
        .logo-mc{
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
        .navbar{
            display:none;
        }
        .btn{
            display: none;
        }
    }
</style>

<script>

    function toggleSJ(idToShow,idToHide) {
        // console.log(id);
        $(idToShow).show(300);
        $(idToHide).hide(300);
    }

</script>

@endsection
