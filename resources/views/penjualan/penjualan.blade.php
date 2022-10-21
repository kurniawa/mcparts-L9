@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<form class="container" action="{{ route('saleBasedOnFilter') }}" method="GET">
    <div class="d-flex mt-2">
        <img class="w-2rem" src="/img/icons/pencil.svg" alt="">
        <h4 class="ms-2">Accounting Penjualan</h4>
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
                <td>
                    <div class="form-check">
                        <input type="checkbox" name="detail" id="radio-detail" value="checked" class="form-check-input">
                        <label for="radio-detail" class="form-check-label fw-bold">Detail</label>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="mt-2 text-center"><button type="submit" class="btn btn-danger">Tampilkan Daftar Penjualan</button></div>
</form>

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
    <h5>Daftar Nota Terkait</h5>
    <table class="fancy-table w-100">
        <tr><th>No.</th><th>Tanggal</th><th>Pelanggan</th><th>Harga</th><th>Subtotal</th></tr>
        @for ($k = 0; $k < count($notasXsubtotal); $k++)
        <tr><td>{{ $notasXsubtotal[$k]['no_nota'] }}</td><td>{{ date('d-m-Y',strtotime($notasXsubtotal[$k]['created_at'])) }}</td><td>{{ $notasXsubtotal[$k]['pelanggan_nama'] }}</td><td class="toFormatCurrencyRp">{{ $notasXsubtotal[$k]['harga_total'] }}</td>
            @if ($notasXsubtotal[$k]['subtotal']!==null)
            <td class="toFormatCurrencyRp">{{ $notasXsubtotal[$k]['subtotal'] }}</td>
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

</script>

<style>

</style>
@endsection
