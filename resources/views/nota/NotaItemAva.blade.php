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
            @foreach ($spk_produk_notas_terkait_item as $spk_produk_nota)
            <tr><th>N-{{ $spk_produk_nota['nota_id'] }}</th><td>:</td><td>{{ $spk_produk_nota['jumlah'] }}</td></tr>
            @endforeach
        </table>
    </div>

    <form action="{{ route('NotaItemAva_DB') }}" method="POST">
        @csrf
        @if (count($params)!==0)
        <div class="alert alert-success">SPK ini sudah terkait dengan @foreach ($params as $param) Nota-{{$param['nota_id_terkait_spk']}}, @endforeach. Silahkan input ke Nota terkait.</div>
        @foreach ($params as $param)
        <div class="row">
            <div class="col">
                <label for="jumlah-{{ $param['nota_id_terkait_spk'] }}">Jumlah untuk N-{{ $param['nota_id_terkait_spk'] }}:</label>
                <input class="form-control" type="number" name="jumlah[]" id="jumlah-{{ $param['nota_id_terkait_spk'] }}" value="">
                <input type="hidden" name="nota_id_terkait_spk[]" value="{{ $param['nota_id_terkait_spk'] }}">
                <input type="hidden" name="spk_produk_nota_id_terkait_item[]" value="{{ $param['spk_produk_nota_id_terkait_item'] }}">
            </div>
            <div class="col"></div>
        </div>
        @endforeach

        @else
        <div class="alert alert-success">Belum ada Nota yang terkait dengan SPK ini. Silahkan batalkan terlebih dahulu apabila ingin membuat nota baru.</div>
        @endif
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
