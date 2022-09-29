@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <h2>{{ $judul }}</h2>
    <div class="alert alert-primary">
        <table style="width: 100%">
            <tr><th>Nama</th><td>:</td><td>{{ $produk['nama'] }}</td></tr>
            <tr><th>Jumlah</th><td>:</td><td>{{ $spk_produk['jumlah'] }}</td></tr>
            <tr><th>Deviasi(+/-)</th><td>:</td><td>{{ $spk_produk['deviasi_jml'] }}</td></tr>
            <tr><th>Jumlah_t</th><td>:</td><td>{{ $spk_produk['jml_t'] }}</td></tr>
            <tr><th>Jml. Sls</th><td>:</td><td>{{ $spk_produk['jml_selesai'] }}</td></tr>
            <tr><th>Keterangan</th><td>:</td><td>{{ $spk_produk['keterangan'] }}</td></tr>
        </table>
    </div>
    <form action="{{ route('DeviasiDB') }}" method="POST">
        @csrf
        @if ($input==='keterangan')
        <label for="{{ $input }}">{{ $label }}</label>
        <textarea name="{{ $input }}" id="{{ $input }}" class="form-control"></textarea>
        @else
        <div class="row">
            <div class="col">
                <label for="{{ $input }}">{{ $label }}</label>
                <input class="form-control" type="{{ $tipe_input }}" name="{{ $input }}" id="{{ $input }}" value="{{ $spk_produk[$input] }}">
            </div>

            <div class="col"></div>
        </div>
        @endif
        <div class="mt-3">
            <input type="hidden" name="id" value="{{ $spk_produk['id'] }}">
            <button type="submit" name="tipe" value="{{ $tipe }}" class="btn btn-warning">Konfirmasi</button>
        </div>
    </form>
</div>
@endsection
