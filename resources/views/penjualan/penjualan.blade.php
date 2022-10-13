@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<form class="container" action="{{ route('saleBasedOnFilter') }}" method="GET">
    {{-- diputuskan untuk memakai get, supaya tidak pusing ketika berpindah-pindah halaman --}}
    {{-- diputuskan untuk memakai post, caranya adalah langsung input ke database temp_spks --}}
    @csrf

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
            </tr>
        </table>
    </div>

    <div class="mt-2 text-center"><button type="submit" class="btn btn-danger">Tampilkan Daftar Penjualan</button></div>
</form>

@if (isset($penjualan_totals))
<div class="container mt-2">
    <h5>Total Penjualan Pelanggan</h5>
    <table class="fancy-table">
        <tr><th>No.</th><th>Customer</th><th>Kota</th><th>Total Penjualan</th></tr>
        @for ($i = 0; $i < count($penjualan_totals); $i++)
        <tr><td>{{ $i+1 }}</td><td>{{ $pelanggan_namas[$i] }}</td><td></td><td class="toFormatNumber">{{ $penjualan_totals[$i] }}</td></tr>
        @endfor
    </table>
</div>

<div class="container mt-3">
    <h5>Daftar Nota Terkait</h5>
    <table class="fancy-table w-100">
        <tr><th>No.</th><th>Pelanggan</th><th>Kota</th><th>Harga</th></tr>
        @for ($k = 0; $k < count($notas); $k++)
        <tr><td>{{ $notas[$k]['no_nota'] }}</td><td>{{ $pelanggans_v_notas[$k]['nama'] }}</td><td></td><td class="toFormatNumber">{{ $notas[$k]['harga_total'] }}</td></tr>
        @endfor
    </table>
</div>
@endif



<script>

</script>

<style>

</style>
@endsection
