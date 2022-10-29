@extends('layouts.main_layout')

@extends('layouts.navbar')

@section('content')

<div class="container">
    <h2>Produk Baru</h2>
    <h6>(Pilih Tipe Produk)</h6>

    <div class="row">
        <a class="col m-1 btn btn-primary" href="{{ route('tambahProduk',['tipe'=>'SJ-Variasi']) }}">SJ-Variasi</a>
        <a class="col m-1 btn btn-primary" href="{{ route('tambahProduk',['tipe'=>'SJ-Kombinasi']) }}">SJ-Kombinasi</a>
        <a class="col m-1 btn btn-primary" href="{{ route('tambahProduk',['tipe'=>'SJ-Motif']) }}">SJ-Motif</a>
    </div>
    <div class="row">
        <a class="col m-1 btn btn-warning" href="{{ route('tambahProduk',['tipe'=>'SJ-T.Sixpack']) }}">SJ-T.Sixpack</a>
        <a class="col m-1 btn btn-warning" href="{{ route('tambahProduk',['tipe'=>'SJ-Japstyle']) }}">SJ-Japstyle</a>
        <a class="col m-1 btn btn-warning" href="{{ route('tambahProduk',['tipe'=>'SJ-Standar']) }}">SJ-Standar</a>
    </div>
    <div class="row">
        <a class="col m-1 btn btn-danger" href="{{ route('tambahProduk',['tipe'=>'Tankpad']) }}">Tankpad</a>
        <a class="col m-1 btn btn-danger" href="{{ route('tambahProduk',['tipe'=>'Stiker']) }}">Stiker</a>
        <a class="col m-1 btn btn-danger" href="{{ route('tambahProduk',['tipe'=>'Busa-Stang']) }}">Busa Stang</a>
    </div>
    <div class="row">
        <a class="col m-1 btn btn-dark" href="{{ route('tambahProduk',['tipe'=>'Jok Assy']) }}">Jok Assy</a>
        <a class="col m-1 btn btn-dark" href="{{ route('tambahProduk',['tipe'=>'Rol']) }}">Rol</a>
        <a class="col m-1 btn btn-dark" href="{{ route('tambahProduk',['tipe'=>'Rotan']) }}">Rotan</a>
    </div>
</div>

<div class="container mt-3">
    <h2>Spec/Komponen Produk</h2>
    <div class="row">
        @for ($i=0,$k=0; $i < count($specs); $i++,$k++)
        @if ($k===count($colors))
        @php $k=0 @endphp
        @endif
        <a class="col btn btn-{{ $colors[$k] }} mt-1 ms-1" href="{{ route('daftarSpec',['tipe'=>$specs[$i]]) }}">+{{ $specs[$i] }}</a>
        @endfor
    </div>
</div>

<script>

</script>

<style>

</style>
@endsection


