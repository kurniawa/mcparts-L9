@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <h2>Nota Item</h2>
    <div class="alert alert-primary">
        <table style="width: 100%">
            <tr><th>Nama</th><td>:</td><td>{{ $produk['nama'] }}</td></tr>
            <tr><th>Jumlah_t</th><td>:</td><td>{{ $spk_produk['jml_t'] }}</td></tr>
            <tr><th>Jml Sls</th><td>:</td><td>{{ $spk_produk['jml_selesai'] }}</td></tr>
            <tr><th>Jml Sudah Nota</th><td>:</td><td>{{ $spk_produk['jml_sdh_nota'] }}</td></tr>
            <tr><th>Keterangan</th><td>:</td><td>{{ $spk_produk['ktrg'] }}</td></tr>
            @foreach ($spk_produk_notas as $spk_produk_nota)
            <tr><th>N-{{ $spk_produk_nota['nota_id'] }}</th><td>:</td><td>{{ $spk_produk_nota['jumlah'] }}</td></tr>
            @endforeach
        </table>
    </div>

    <form action="{{ route('NotaItemBaru_DB') }}" method="POST">
        @csrf
        @if (count($spk_produk_notas)!==0)
        <div class="alert alert-warning">Sudah ada Nota yang terkait dengan SPK ini. Kalau Anda ingin menginput ke Nota yang sudah ada, silahkan batalkan!</div>
        @else
        <div class="alert alert-success">Belum ada Nota yang terkait dengan SPK ini. Setelah konfirmasi, otomatis akan terbentuk nota baru.</div>
        @endif
        <div class="row">
            <div class="col"><label for="jumlah">Jumlah untuk input ke Nota Baru:</label></div>
        </div>
        <div class="row">
            <div class="col">
                <input class="form-control" type="number" name="jumlah" id="jumlah" value={{ $spk_produk['jml_selesai']-$spk_produk['jml_sdh_nota'] }}>
            </div>
            <div class="col"></div>
        </div>
        <div class="mt-3">
            <a href="{{ route('SPK-Detail',['spk_id'=>$spk_produk['spk_id']]) }}" class="btn btn-danger">Batal</a>
        </div>
        <div class="mt-2">
            <input type="hidden" name="spk_produk_id" value="{{ $spk_produk['id'] }}">
            <button type="submit" name="tipe" value="" class="btn btn-warning">Konfirmasi</button>
        </div>
    </form>

</div>
@endsection
