@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <h2>Tree</h2>
    <div class="alert alert-primary">
        <table style="width: 100%">
            <tr><th>Nama</th><td>:</td><td>{{ $produk['nama'] }}</td></tr>
            <tr><th>Jumlah_t</th><td>:</td><td>{{ $spk_produk['jml_t'] }}</td></tr>
            <tr><th>Jml Sls</th><td>:</td><td>{{ $spk_produk['jml_selesai'] }}</td></tr>
            <tr><th>Jml Sudah Nota</th><td>:</td><td>{{ $spk_produk['jml_sdh_nota'] }}</td></tr>
            <tr><th>Keterangan</th><td>:</td><td>{{ $spk_produk['ktrg'] }}</td></tr>
            <tr><th>Jml blm SJ</th><td>:</td><td>{{ $jml_av }}</td></tr>
        </table>
    </div>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <div class="alert alert-success">
                <div class="fw-bold">{{ $spk['no_spk'] }}</div>
                <div class="fw-bold">spk_produk_id: {{ $spk_produk['id'] }}</div>
                <div>Jml. Selesai:</div>
                <input type="number" class="form-control" name="jumlah" value={{ $spk_produk['jml_selesai'] }} readonly>
            </div>
        </div>
        <div class="col"></div>
        <div class="col"></div>
    </div>
</div>
@endsection
