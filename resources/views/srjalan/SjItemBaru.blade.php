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
            <tr><th>Keterangan</th><td>:</td><td>{{ $spk_produk['ktrg'] }}</td></tr>
            @foreach ($spk_produk_notas_terkait_item as $spk_produk_nota)
            <tr><th>N-{{ $spk_produk_nota['nota_id'] }}</th><td>:</td><td>{{ $spk_produk_nota['jumlah'] }}</td></tr>
            @endforeach
            @foreach ($spk_produk_nota_sjs_terkait_item as $spk_produk_nota_srjalan)
            <tr><th>SJ-{{ $spk_produk_nota_srjalan['srjalan_id'] }}</th><td>:</td>
                <td>{{ $spk_produk_nota_srjalan['jumlah'] }} -> {{ $spk_produk_nota_srjalan['jml_packing'] }} {{ $spk_produk_nota_srjalan['tipe_packing'] }}</td></tr>
            @endforeach
            <tr><th>Jml blm SJ</th><td>:</td><td>{{ $jml_av }}</td></tr>
        </table>
    </div>

    @if (count($spk_produk_notas_terkait_item)!==0)
    <form action="{{ route('SjItemBaru_DB') }}" method="POST">
        @csrf
        @if (count($spk_produk_nota_sjs_terkait_spk)!==0)
        <div class="alert alert-warning">Sudah ada SrJalan yang terkait dengan SPK ini. Kalau Anda ingin menginput ke SrJalan yang sudah ada, silahkan batalkan!</div>
        @if (count($spk_produk_nota_sjs_terkait_item)!==0)
        <div class="alert alert-info">Terutama untuk item ini juga sudah sempat diinput ke SrJalan. Diantaranya:
        @foreach ($spk_produk_nota_sjs_terkait_item as $spk_produk_nota_srjalan)
        <div>SJ-{{ $spk_produk_nota_srjalan['srjalan_id'] }} : {{ $spk_produk_nota_srjalan['jumlah'] }} -> {{ $spk_produk_nota_srjalan['jml_packing'] }} {{ $spk_produk_nota_srjalan['tipe_packing'] }}</div>
        @endforeach
        </div>
        @else
        <div class="alert alert-info">Untuk Item ini, belum ada yang diinput ke SrJalan.</div>
        @endif
        @else
        <div class="alert alert-success">Belum ada SrJalan yang terkait dengan SPK ini. Setelah konfirmasi, otomatis akan terbentuk SrJalan baru.</div>
        @endif

        @foreach ($spk_produk_notas_terkait_item as $spk_produk_nota)
        <div class="alert alert-primary">
            <span class="fw-bold">Nota-{{ $spk_produk_nota['nota_id'] }}</span>
            <div class="row"><div class="col"><label for="jumlah">Jml u. input ke SrJalan Baru:</label></div></div>
            <div class="row"><div class="col"><input class="form-control" type="number" name="jumlah[]" id="jumlah" value={{ $jml_av }}></div><div class="col"></div></div>
            <input type="hidden" name="spk_produk_nota_ids[]" value="{{ $spk_produk_nota['id'] }}">
        </div>
        @endforeach
        <div class="mt-3">
            <a href="{{ route('SPK-Detail',['spk_id'=>$spk_produk['spk_id']]) }}" class="btn btn-danger">Batal</a>
        </div>
        <div class="mt-2">
            <input type="hidden" name="spk_produk_id" value="{{ $spk_produk['id'] }}">
            <button type="submit" name="jml_av" value="{{ $jml_av }}" class="btn btn-warning">Konfirmasi</button>
        </div>
    </form>
    @else
    <div class="alert alert-danger">Item dari SPK ini belum diinput ke dalam Nota manapun. SrJalan tidak dapat dibuat.</div>
    <div class="mt-3">
        <a href="{{ route('SPK-Detail',['spk_id'=>$spk_produk['spk_id']]) }}" class="btn btn-danger">Batal</a>
    </div>
    @endif

</div>
@endsection
