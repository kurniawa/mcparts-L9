@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<form class="container" action="{{ route('saleBasedOnFilter') }}" method="GET">
    <div class="d-flex mt-2">
        <img class="w-2rem" src="/img/icons/pencil.svg" alt="">
        <h4 class="ms-2">Rekap Penjualan</h4>
    </div>

    <div class="border rounded border-primary border-2 p-2 mt-2">
        <h5>Filter:</h5>
        <table>
            <tr>
                <th>Tahun</th><th>:</th>
                <td>
                    <select class="form-control" name="tahun" id="tahun">
                        <option value="{{ $tahun_now }}">{{ $tahun_now }}</option>
                        @foreach ($arr_tahun as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </td>
                <th>Bulan</th><th>:</th>
                <td>
                    <select class="form-control" name="bulan" id="bulan">
                        <option value="{{ $bulan_now }}">{{ $bulan_now }}</option>
                        <option value="all">All</option>
                        @foreach ($arr_bulan as $bulan)
                        <option value="{{ $bulan }}">{{ $bulan }}</option>
                        @endforeach
                    </select>
                </td>
                <th>Tanggal</th><th>:</th>
                <td>
                    <select class="form-control" name="tanggal" id="tanggal">
                        <option value="{{ $tanggal_now }}">{{ $tanggal_now }}</option>
                        <option value="all">All</option>
                        @foreach ($arr_tanggal as $tanggal)
                        <option value="{{ $tanggal }}">{{ $tanggal }}</option>
                        @endforeach
                    </select>
                </td>
                {{-- <td>
                    <div class="form-check">
                        <input type="checkbox" name="detail" id="radio-detail" value="checked" class="form-check-input">
                        <label for="radio-detail" class="form-check-label fw-bold">Detail</label>
                    </div>
                </td> --}}
            </tr>
        </table>
    </div>

    <div class="mt-2 text-center"><button type="submit" class="btn btn-danger">Tampilkan Daftar Penjualan</button></div>
</form>

<div style="position:fixed;top:15rem;left:5rem"><button id="show-hide-sales-details" class="btn btn-sm btn-outline-warning" onclick='showSalesDetail()'>D</button></div>

@if (isset($penjualan_totals))
<div class="container mt-2">
    <h5>Total Penjualan Pelanggan</h5>
    <table class="fancy-table">
        <tr><th>No.</th><th>Customer</th><th>Total Penjualan</th></tr>
        @for ($i = 0; $i < count($penjualan_totals); $i++)
        <tr><td>{{ $i+1 }}</td><td>{{ $pelanggan_namas[$i] }}</td><td class="toFormatCurrencyRp">{{ $penjualan_totals[$i] }}</td></tr>
        @endfor
    </table>
</div>

<div class="container mt-3">
    <button class="btn btn-primary" onclick="downloadRekapPenjualan('#rekap-penjualan');">Dowload Excel</button>
</div>

<div class="container mt-3">
    <h5>Daftar Nota Terkait</h5>
    <table id="rekap-penjualan" class="fancy-table w-100">
        <tr><th>No.</th><th>Tanggal</th><th>Pelanggan</th><th>Harga</th><th>Subtotal</th></tr>
        @for ($k = 0; $k < count($sales_components); $k++)
        <tr>
            <td>{{ $sales_components[$k]['no_nota'] }}</td><td>{{ date('d-m-Y',strtotime($sales_components[$k]['created_at'])) }}</td><td>{{ $sales_components[$k]['pelanggan_nama'] }}</td><td class="toFormatCurrencyRp">{{ $sales_components[$k]['harga_total'] }}</td>
            @if ($sales_components[$k]['subtotal']!==null)
            <td class="toFormatCurrencyRp">{{ $sales_components[$k]['subtotal'] }}</td>
            @else
            <td></td>
            @endif
        </tr>
        {{-- Detail Komponen Penjualan --}}
        @if ($sales_components[$k]['spk_produk_notas']!==null)
        <tr class="sales-detail d-none">
            <td colspan="5">
                <table style="width: 100%">
                    @for ($l = 0; $l < count($sales_components[$k]['spk_produk_notas']); $l++)
                    <tr>
                        <td>{{ $sales_components[$k]['spk_produk_notas'][$l]['nama_nota'] }}</td>
                        <td>{{ $sales_components[$k]['spk_produk_notas'][$l]['jumlah'] }}</td>
                        <td class="toFormatCurrencyRp">{{ $sales_components[$k]['spk_produk_notas'][$l]['harga'] }}</td>
                        <td class="toFormatCurrencyRp">{{ $sales_components[$k]['spk_produk_notas'][$l]['harga_t'] }}</td>
                    </tr>
                    @endfor
                    @foreach ($sales_components[$k]['ekspedisis'] as $ekspedisi)
                    @endforeach
                </table>
            </td>
        </tr>
        @endif
        @if ($sales_components[$k]['srjalans']!==null)
        <tr class="sales-detail d-none">
            <td colspan="5">
                @for ($m = 0; $m < count($sales_components[$k]['srjalans']); $m++)
                <div class="d-flex">
                    <div>{{ $sales_components[$k]['srjalans'][$m]['no_srjalan'] }}:</div>
                    <div class="ms-1">{{ $sales_components[$k]['ekspedisis'][$m]['ekspedisi_nama'] }} -></div>
                    <div class="ms-1">
                        @foreach (json_decode($sales_components[$k]['ekspedisis'][$m]['eks_long_ala'],true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach
                    </div>

                    @if ($sales_components[$k]['ekspedisis'][$m]['transit_nama']!==null)
                    <div class="ms-1">via -></div>
                    <div class="ms-1">{{ $sales_components[$k]['ekspedisis'][$m]['transit_nama'] }} -></div>
                    @foreach (json_decode($sales_components[$k]['ekspedisis'][$m]['trans_long_ala'],true) as $long)
                        <div>{{ $long }}</div>
                    @endforeach
                    @endif
                </div>
                @endfor
            </td>
        </tr>
        @endif
        @endfor
    </table>
</div>

{{-- Test Table --}}
<div class="container mt-3">
    <h5>Test Table Download</h5>
    <button class="btn btn-primary" onclick="downloadRekapPenjualan('#rekap-penjualan2');">Dowload Excel</button>
</div>

<div class="container mt-3">
    <h5>Daftar Nota Terkait</h5>
    <table id="rekap-penjualan2" class="fancy-table w-100">
        <tr><th>No.</th><th>Tanggal</th><th>Pelanggan</th><th>Harga</th><th>Subtotal</th></tr>
        @for ($k = 0; $k < count($sales_components); $k++)
        <tr>
            <td>{{ $sales_components[$k]['no_nota'] }}</td><td>{{ date('d-m-Y',strtotime($sales_components[$k]['created_at'])) }}</td><td>{{ $sales_components[$k]['pelanggan_nama'] }}</td><td class="toFormatCurrencyRp">{{ $sales_components[$k]['harga_total'] }}</td>
            @if ($sales_components[$k]['subtotal']!==null)
            <td class="toFormatCurrencyRp">{{ $sales_components[$k]['subtotal'] }}</td>
            @else
            <td></td>
            @endif
        </tr>
        @endfor
    </table>
</div>

<div style="height: 5rem"></div>
@endif



<script>
function showSalesDetail(params) {
    var sales_details=document.querySelectorAll('.sales-detail');
    var btn_show_sales_detail=document.getElementById('show-hide-sales-details');

    sales_details.forEach(detail => {
        if (detail.classList.contains('d-none')) {
            detail.classList.remove('d-none');
            btn_show_sales_detail.classList.add('active');
        } else {
            detail.classList.add('d-none');
            btn_show_sales_detail.classList.remove('active');
        }
    });
}

function downloadRekapPenjualan(tableToExcelDownload) {
    $(tableToExcelDownload).table2excel({
        filename:'rekap_penjualan.xlsx'
    });
}
</script>

<style>

</style>
@endsection
