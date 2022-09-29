@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <h2>SrJalan Item</h2>
    <div class="alert alert-primary">
        <table style="width: 100%">
            <tr><th>Nama</th><td>:</td><td>{{ $produk['nama'] }}</td></tr>
            <tr><th>Jumlah_t</th><td>:</td><td>{{ $spk_produk['jml_t'] }}</td></tr>
            <tr><th>Jml Sls</th><td>:</td><td>{{ $spk_produk['jml_selesai'] }}</td></tr>
            <tr><th>Jml Sudah Nota</th><td>:</td><td>{{ $spk_produk['jml_sdh_nota'] }}</td></tr>
            <tr><th>Keterangan</th><td>:</td><td>{{ $spk_produk['keterangan'] }}</td></tr>
            @foreach ($related_spk_produk_notas as $spk_produk_nota)
            <tr><th>N-{{ $spk_produk_nota['nota_id'] }}</th><td>:</td><td>{{ $spk_produk_nota['jumlah'] }}</td></tr>
            @endforeach
            @foreach ($related_spk_produk_nota_srjalanss as $spk_produk_nota_srjalan)
            <tr><th>SJ-{{ $spk_produk_nota_srjalan['srjalan_id'] }}</th><td>:</td>
                <td>{{ $spk_produk_nota_srjalan['jumlah'] }} -> {{ $spk_produk_nota_srjalan['jml_packing'] }} {{ $spk_produk_nota_srjalan['tipe_packing'] }}</td></tr>
            @endforeach
            <tr><th>Jml blm SJ</th><td>:</td><td>{{ $jml_av }}</td></tr>
        </table>
    </div>

    <form action="{{ route('SjItemAva_DB') }}" method="POST">
        @csrf
        @if (count($spk_produk_nota_srjalanss)!==0)
        <div class="alert alert-success">Sudah ada SrJalan yang terkait dengan SPK ini. Silahkan input ke SrJalan terkait.</div>
        @if (count($related_spk_produk_nota_srjalanss)!==0)
        <div class="alert alert-info">Terutama untuk item ini juga sudah sempat diinput ke SrJalan. Diantaranya:
        @foreach ($related_spk_produk_nota_srjalanss as $spk_produk_nota_srjalan)
        <div>SJ-{{ $spk_produk_nota_srjalan['srjalan_id'] }} : {{ $spk_produk_nota_srjalan['jumlah'] }} -> {{ $spk_produk_nota_srjalan['jml_packing'] }} {{ $spk_produk_nota_srjalan['tipe_packing'] }}</div>
        @endforeach
        </div>
        @else
        <div class="alert alert-info">Untuk Item ini, belum ada yang diinput ke SrJalan.</div>
        @endif
        @php $i=0; @endphp
        @foreach ($params as $param)
        <div class="alert alert-primary">
            <div class="fw-bold">Terkait dengan Nota-{{ $param['nota_id'] }}</div>
            <div class="row">
                <div class="col">
                    <label for="jumlah-{{ $param['srjalan_id'] }}">Jumlah untuk SJ-{{ $param['srjalan_id'] }}:</label>
                    <input class="form-control" type="number" name="jumlah[]" id="jumlah-{{ $param['srjalan_id'] }}" value="{{ $jml_av }}">
                    <input type="hidden" name="srjalan_id[]" value={{ $param['srjalan_id'] }}>
                    <input type="hidden" name="spk_produk_nota_srjalan_id[]" value={{$param['spk_produk_nota_srjalan_id']}}>
                    <input type="hidden" name="spk_produk_nota_id[]" value={{$param['spk_produk_nota_id']}}>
                    <input type="hidden" name="nota_id[]" value={{$param['nota_id']}}>
                </div>
                <div class="col"></div>
            </div>
        </div>
        @php $i++; @endphp
        @endforeach
        <div class="mt-3">
            <a href="{{ route('SPK-Detail',['spk_id'=>$spk_produk['spk_id']]) }}" class="btn btn-danger">Batal</a>
        </div>
        <div class="mt-2">
            @foreach ($spk_produk_nota_ids_basedOn_spk_produk_id as $spk_produk_nota_id)
            <input type="hidden" name="spk_produk_nota_id_basedOn_spk_produk_id[]" value={{ $spk_produk_nota_id }}>
            @endforeach
            <input type="hidden" name="spk_produk_id" value="{{ $spk_produk['id'] }}">
            <button type="submit" name="jml_av" value="{{ $jml_av }}" class="btn btn-warning">Konfirmasi</button>
        </div>
        @else
        <div class="alert alert-success">Belum ada Srjalan yang terkait dengan SPK ini. Silahkan batalkan terlebih dahulu apabila ingin membuat SrJalan baru.</div>
        <div class="mt-3">
            <a href="{{ route('SPK-Detail',['spk_id'=>$spk_produk['spk_id']]) }}" class="btn btn-danger">Batal</a>
        </div>
        @endif
    </form>


</div>
@endsection
