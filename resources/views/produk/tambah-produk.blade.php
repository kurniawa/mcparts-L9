@extends('layouts.main_layout')

@extends('layouts.navbar')

@section('content')

<div class="container">
    <h2>Produk Baru</h2>
    <h6>(Pilih Tipe Produk)</h6>

    <div class="row">
        <a class="col m-1 btn btn-primary" href="{{ route('tambahSJVariasi') }}">SJ-Variasi</a>
        <a class="col m-1 btn btn-primary" href="{{ route('tambahSJKombinasi') }}">SJ-Kombinasi</a>
        <a class="col m-1 btn btn-primary" href="{{ route('tambahSJMotif') }}">SJ-Motif</a>
    </div>
    <div class="row">
        <a class="col m-1 btn btn-warning" href="{{ route('tambahSJTSixpack') }}">SJ-T.Sixpack</a>
        <a class="col m-1 btn btn-warning" href="{{ route('tambahSJJapstyle') }}">SJ-Japstyle</a>
        <a class="col m-1 btn btn-warning" href="{{ route('tambahSJStandar') }}">SJ-Standar</a>
    </div>
    <div class="row">
        <a class="col m-1 btn btn-danger" href="{{ route('tambahTankpad') }}">Tankpad</a>
        <a class="col m-1 btn btn-danger" href="{{ route('tambahStiker') }}">Stiker</a>
        <a class="col m-1 btn btn-danger" href="{{ route('tambahBusastang') }}">Busa-Stang</a>
    </div>
    <div class="row">
        <a class="col m-1 btn btn-dark" href="{{ route('tambahJokAssy') }}">Jok Assy</a>
        <a class="col m-1 btn btn-dark" href="{{ route('tambahRol') }}">Rol</a>
        <a class="col m-1 btn btn-dark" href="{{ route('tambahRotan') }}">Rotan</a>
    </div>
</div>

<script>

</script>

<style>

</style>
@endsection


