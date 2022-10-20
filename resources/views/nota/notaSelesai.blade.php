@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex">
        <img class="w-2rem" src="/img/icons/pencil.svg" alt="">
        <h2 class="ms-2">Tetapkan Selesai Nota: {{ $nota['no_nota'] }} </h2>
    </div>

    <table style="border-collapse:unset;border-spacing:0.5rem">
        <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
        @if ($reseller !== null)
        <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk Nota ini</td></tr>
        @endif
        <tr><th>No. Nota</th><th>:</th><td>{{ $nota['no_nota'] }}</td></tr>
        <tr><th>Tanggal</th><th>:</th><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
        <tr>
            <th style="vertical-align: top;">Alamat</th>
            <th style="vertical-align: top;">:</th>
            <td>
            {{-- @php
                dd($alamat)
            @endphp --}}
            @if ($alamat!==null)
            @foreach (json_decode($alamat['long'], true) as $long)
            {{ $long }}<br>
            @endforeach
            @endif
            </td>
        </tr>
    </table>

    <table id="divDaftarItemNota" style="width: 100%">
        <tr><th>No.</th><th>Nama Nota</th><th>Jml.</th><th>Hrg/Pcs</th><th>Harga</th></tr>
        @for ($i = 0; $i < count($produks); $i++)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>
                @if ($spk_produk_notas[$i]['nama_nota']!==null)
                {{ $spk_produk_notas[$i]['nama_nota'] }}
                @else
                {{ $produks[$i]['nama_nota'] }}
                @endif
            </td>
            <td>{{ $spk_produk_notas[$i]['jumlah'] }}</td>
            <td class="toFormatNumber">{{ $spk_produk_notas[$i]['harga'] }}</td>
            <td class="toFormatNumber">{{ $spk_produk_notas[$i]['harga_t'] }}</td>
        </tr>
        @endfor
    </table>

    <div class="text-end mt-2">
        <div class="fw-bold text-success fs-5 toFormatNumber">{{ $nota['harga_total'] }}</div>
        <div class="fw-bold text-danger fs-5">Total</div>
    </div>

    <form class="border border-success rounded border-2 p-2" action="{{ route('notaSelesaiDB') }}" method="POST">
        @csrf
        <h4>Input Tgl. Selesai Nota</h4>
        <table>
            <tr>
                <td>Tgl. Selesai Nota</td><td>:</td>
                <td>
                    <input id="tgl_selesai" type='datetime-local' name='tgl_selesai' class="form-control" value="{{ date('Y-m-d\TH:i:s') }}" required>
                    <div class="invalid-feedback" id="invalid-feedback-nama-baru"></div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='hidden' name='nota_id' value={{ $nota['id'] }}>
                    <input type='hidden' name='pelanggan_id' value={{ $pelanggan['id'] }}>
                    <input type='hidden' name='reseller_id' value={{ $reseller_id }}>
                </td>
            </tr>
        </table>
        <div class="text-center">
            <button class="btn btn-warning" type="submit">Konfirmasi Tgl. Nota Selesai</button>
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
