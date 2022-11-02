@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex">
        <img class="w-2rem" src="/img/icons/pencil.svg" alt="">
        <h2 class="ms-2">Tetapkan Selesai SPK: {{ $spk['no_spk'] }} </h2>
    </div>

    <table style="border-collapse:unset;border-spacing:0.5rem">
        <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan_nama }}</th></tr>
        @if ($reseller !== null)
        <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller_nama }}</span> sebagai Reseller untuk SPK ini</td></tr>
        @endif
        <tr><th>No. SPK</th><th>:</th><td>{{ $spk['no_spk'] }}</td></tr>
        <tr><th>Tanggal</th><th>:</th><td>{{ date('d-m-Y', strtotime($spk['created_at'])) }}</td></tr>
        <tr>
            <th style="vertical-align: top;">Alamat</th>
            <th style="vertical-align: top;">:</th>
            <td>
            {{-- @php
                dd($alamat)
            @endphp --}}
            @if ($cust_long_ala!==null)
            @foreach (json_decode($cust_long_ala, true) as $long)
            {{ $long }}<br>
            @endforeach
            @endif
            </td>
        </tr>
    </table>

    <table id="divDaftarItemSPK" style="width: 100%">
        <tr><th>No.</th><th>Nama SPK</th><th>Jml.</th></tr>
        @for ($i = 0; $i < count($produks); $i++)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>
                @if ($spk_produks[$i]['nama_produk']!==null)
                {{ $spk_produks[$i]['nama_produk'] }}
                @else
                {{ $produks[$i]['nama'] }}
                @endif
            </td>
            <td>{{ $spk_produks[$i]['jumlah'] }}</td>
        </tr>
        @endfor
    </table>

    <div class="text-end mt-2">
        <div class="fw-bold text-success fs-5 toFormatNumber">{{ $spk['jumlah_total'] }}</div>
        <div class="fw-bold text-danger fs-5">Total</div>
    </div>

    <form class="border border-success rounded border-2 p-2" action="{{ route('spkSelesaiDB') }}" method="POST">
        @csrf
        <h4>Input Tgl. Selesai SPK</h4>
        <table>
            <tr>
                <td>Tgl. Selesai SPK</td><td>:</td>
                <td>
                    <input id="tgl_selesai" type='datetime-local' name='tgl_selesai' class="form-control" value="{{ date('Y-m-d\TH:i:s') }}" required>
                    <div class="invalid-feedback" id="invalid-feedback-nama-baru"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='hidden' name='spk_id' value={{ $spk['id'] }}>
                    <input type='hidden' name='pelanggan_id' value={{ $pelanggan['id'] }}>
                    <input type='hidden' name='reseller_id' value={{ $reseller_id }}>
                </td>
            </tr>
        </table>
        <div class="text-center">
            <button class="btn btn-warning" type="submit">Konfirmasi Tgl. SPK Selesai</button>
        </div>
    </form>
</div>

<style>
</style>

<script>

</script>

<style>


</style>

@endsection
