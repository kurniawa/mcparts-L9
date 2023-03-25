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
                        <option value="{{ $tahun_set }}">{{ $tahun_set }}</option>
                        @foreach ($arr_tahun as $tahun)
                        <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                    </select>
                </td>
                <th>Bulan</th><th>:</th>
                <td>
                    <select class="form-control" name="bulan" id="bulan">
                        <option value="{{ $bulan_set }}">{{ $bulan_set }}</option>
                        <option value="all">All</option>
                        @foreach ($arr_bulan as $bulan)
                        <option value="{{ $bulan }}">{{ $bulan }}</option>
                        @endforeach
                    </select>
                </td>
                <th>Tanggal</th><th>:</th>
                <td>
                    <select class="form-control" name="tanggal" id="tanggal">
                        <option value="{{ $tanggal_set }}">{{ $tanggal_set }}</option>
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


{{-- if isset penjualan_totals sudah mewakili semua table yang ada --}}
@if (isset($penjualan_totals))

<div class="container mt-3">
    <div><button class="btn btn-primary btn-sm" onclick="downloadRekapPenjualan('nota_plus_subtotal-{{ $tahun_set }}_{{ $bulan_2_digit }}_{{ $tanggal_2_digit }}');">Download: Nota + Subtotal</button></div>
    <div class="mt-1"><button class="btn btn-warning btn-sm" onclick="downloadRekapPenjualan('nota_plus_detail_item-{{ $tahun_set }}_{{ $bulan_2_digit }}_{{ $tanggal_2_digit }}');">Download: Nota + Item Detail</button></div>
</div>

<div class="container mt-2">
    <h5>Total Penjualan Pelanggan</h5>
    <table class="fancy-table">
        <tr><th>No.</th><th>Customer</th><th>Total Penjualan</th></tr>
        @for ($i = 0; $i < count($penjualan_totals); $i++)
        <tr><td>{{ $i+1 }}</td><td>{{ $pelanggan_namas_unique[$i] }}</td><td class="toFormatCurrencyRp">{{ $penjualan_totals[$i] }}</td></tr>
        @endfor
        <tr><td></td><td class="fw-bold">Grand Total</td><td class="toFormatCurrencyRp">{{ $grand_total }}</td></tr>
    </table>
</div>

<div class="container mt-3">
    <h5>Nota + Subtotal</h5>
    <table id="rekap-penjualan" class="fancy-table w-100">
        <tr><th>No.</th><th>Tanggal</th><th>Pelanggan</th><th>Harga</th><th>Subtotal</th></tr>
        @for ($k = 0; $k < count($notasXsubtotal); $k++)
        <tr>
            <td>{{ $notasXsubtotal[$k]['no_nota'] }}</td><td>{{ date('d-m-Y',strtotime($notasXsubtotal[$k]['created_at'])) }}</td><td>{{ $notasXsubtotal[$k]['pelanggan_nama'] }}</td><td class="toFormatCurrencyRp">{{ $notasXsubtotal[$k]['harga_total'] }}</td>
            @if ($notasXsubtotal[$k]['subtotal']!==null)
            <td class="toFormatCurrencyRp">{{ $notasXsubtotal[$k]['subtotal'] }}</td>
            @else
            <td></td>
            @endif
        </tr>
        {{-- Detail Komponen Penjualan --}}
        @if ($notasXsubtotal[$k]['spk_produk_notas']!==null)
        <tr class="sales-detail d-none">
            <td colspan="5">
                <table style="width: 100%">
                    @for ($l = 0; $l < count($notasXsubtotal[$k]['spk_produk_notas']); $l++)
                    <tr>
                        <td>{{ $notasXsubtotal[$k]['spk_produk_notas'][$l]['nama_nota'] }}</td>
                        <td>{{ $notasXsubtotal[$k]['spk_produk_notas'][$l]['jumlah'] }}</td>
                        <td class="toFormatCurrencyRp">{{ $notasXsubtotal[$k]['spk_produk_notas'][$l]['harga'] }}</td>
                        <td class="toFormatCurrencyRp">{{ $notasXsubtotal[$k]['spk_produk_notas'][$l]['harga_t'] }}</td>
                    </tr>
                    @endfor
                    @foreach ($notasXsubtotal[$k]['ekspedisis'] as $ekspedisi)
                    @endforeach
                </table>
            </td>
        </tr>
        @endif
        @if ($notasXsubtotal[$k]['srjalans']!==null)
        <tr class="sales-detail d-none">
            <td colspan="5">
                @for ($m = 0; $m < count($notasXsubtotal[$k]['srjalans']); $m++)
                <div class="d-flex">
                    <div>{{ $notasXsubtotal[$k]['srjalans'][$m]['no_srjalan'] }}:</div>
                    <div class="ms-1">{{ $notasXsubtotal[$k]['ekspedisis'][$m]['ekspedisi_nama'] }} -></div>
                    <div class="ms-1">
                        @if ($notasXsubtotal[$k]['ekspedisis'][$m]['eks_long_ala'] !== null)
                        @foreach (json_decode($notasXsubtotal[$k]['ekspedisis'][$m]['eks_long_ala'],true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach
                        @endif
                    </div>

                    @if ($notasXsubtotal[$k]['ekspedisis'][$m]['transit_nama']!==null)
                    <div class="ms-1">via -></div>
                    <div class="ms-1">{{ $notasXsubtotal[$k]['ekspedisis'][$m]['transit_nama'] }} -></div>
                    @if ($notasXsubtotal[$k]['ekspedisis'][$m]['trans_long_ala']!==null)
                    @foreach (json_decode($notasXsubtotal[$k]['ekspedisis'][$m]['trans_long_ala'],true) as $long)
                        <div>{{ $long }}</div>
                    @endforeach
                    @endif
                    @endif
                </div>
                @endfor
            </td>
        </tr>
        @endif
        @endfor
    </table>
</div>

<div class="container mt-3">
    <h5>Nota + Detail Items</h5>
    <table id="rekap-penjualan2" class="fancy-table w-100">
        <tr><th>Tgl.</th><th>Ref.</th><th>Customer</th><th>Short</th><th>Nota Item</th><th>Jml.</th><th>Harga</th><th>Total Penjualan</th></tr>
        @for ($k = 0; $k < count($notaXdetail_item); $k++)
        @for ($l = 0; $l < count($notaXdetail_item[$k]['spk_produk_notas']); $l++)
        <tr>
            <td>{{ $notaXdetail_item[$k]['tanggal'] }}</td><td>{{ $notaXdetail_item[$k]['no_nota'] }}</td>
            <td>{{ $notaXdetail_item[$k]['nama_pelanggan'] }}</td>
            <td>{{ $notaXdetail_item[$k]['short'] }}</td>
            <td class="">{{ $notaXdetail_item[$k]['spk_produk_notas'][$l]['nama_nota'] }}</td>
            <td class="">{{ $notaXdetail_item[$k]['spk_produk_notas'][$l]['jumlah'] }}</td>
            <td class="toFormatCurrencyRp">{{ $notaXdetail_item[$k]['spk_produk_notas'][$l]['harga'] }}</td>
            <td class="toFormatCurrencyRp">{{ $notaXdetail_item[$k]['spk_produk_notas'][$l]['harga_t'] }}</td>
        </tr>
        @endfor
        @endfor
    </table>
</div>

{{-- Versi Untuk Download --}}
<div class="container mt-3 d-none">
    <h5>Nota + Subtotal - Download Version</h5>
    <table id="nota_plus_subtotal-{{ $tahun_set }}_{{ $bulan_2_digit }}_{{ $tanggal_2_digit }}" class="fancy-table w-100">
        <tr><th>No.</th><th>Tanggal</th><th>Pelanggan</th><th>Harga</th><th>Subtotal</th></tr>
        @for ($k = 0; $k < count($notasXsubtotal); $k++)
        <tr>
            <td>{{ $notasXsubtotal[$k]['no_nota'] }}</td><td>{{ date('d-m-Y',strtotime($notasXsubtotal[$k]['created_at'])) }}</td>
            <td>{{ $notasXsubtotal[$k]['pelanggan_nama'] }}</td><td class="">{{ $notasXsubtotal[$k]['harga_total'] }}</td>
            @if ($notasXsubtotal[$k]['subtotal']!==null)
            <td class="">{{ $notasXsubtotal[$k]['subtotal'] }}</td>
            @else
            <td></td>
            @endif
        </tr>
        @endfor
    </table>
</div>

<div class="container mt-3 d-none">
    <h5>Nota + Detail Items - Download Version</h5>
    <table id="nota_plus_detail_item-{{ $tahun_set }}_{{ $bulan_2_digit }}_{{ $tanggal_2_digit }}" class="fancy-table w-100">
        <tr><th>Tgl.</th><th>Ref.</th><th>Customer</th><th>Short</th><th>Nota Item</th><th>Jml.</th><th>Harga</th><th>Total Penjualan</th></tr>
        @for ($k = 0; $k < count($notaXdetail_item); $k++)
        @for ($l = 0; $l < count($notaXdetail_item[$k]['spk_produk_notas']); $l++)
        <tr>
            <td>{{ $notaXdetail_item[$k]['tanggal'] }}</td><td>{{ $notaXdetail_item[$k]['no_nota'] }}</td>
            <td>{{ $notaXdetail_item[$k]['nama_pelanggan'] }}</td>
            <td>{{ $notaXdetail_item[$k]['short'] }}</td>
            <td class="">{{ $notaXdetail_item[$k]['spk_produk_notas'][$l]['nama_nota'] }}</td>
            <td class="">{{ $notaXdetail_item[$k]['spk_produk_notas'][$l]['jumlah'] }}</td>
            <td class="">{{ $notaXdetail_item[$k]['spk_produk_notas'][$l]['harga'] }}</td>
            <td class="">{{ $notaXdetail_item[$k]['spk_produk_notas'][$l]['harga_t'] }}</td>
        </tr>
        @endfor
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

function downloadRekapPenjualan(idTableToExcelDownload) {
    $(`#${idTableToExcelDownload}`).table2excel({
        filename:`${idTableToExcelDownload}.xls`
    });
}
</script>

<style>

</style>
@endsection
