@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <h2>Detail Produk:</h2>
</div>

<form action="" method="POST" id="form_spk_item" class="m-1em" name="form_spk_item" onsubmit="return formValidation();" novalidate>
<div class="container">
    @csrf
    <label for="nama_item" class="form-label">Nama Item:</label>
    <div class="fw-bold">{{ $produk['nama'] }}</div>
    <label for="nama_item" class="form-label mt-3">Nama Nota Item:</label>
    <div class="fw-bold">{{ $produk['nama_nota'] }}</div>
    <label for="jumlah_item" class="form-label mt-3">Jumlah Stok:</label>
    <div class="row">
        <div class="col-4">
            <input id="jumlah" type="number" name="jumlah" class="form-control" min="1" readonly value="">
        </div>
    </div>

    <br>
    <p><span class="fw-bold">Specs:</span></p>
    <div id="spesifikasi-item" class="alert alert-primary" style="min-height: 20vh">
        <table>
            <tr id="tr-produk-id" class="item-spec"><td>ID-Produk</td><td>:</td><td id="produk-id">{{ $produk->id }}</td></tr>
            <tr id="tr-tipe" class="item-spec"><td>Tipe</td><td>:</td><td id="nama-tipe">{{ $produk->tipe }}</td></tr>
            <tr id="tr-bahan" class="item-spec"><td>Bahan</td><td>:</td><td id="nama-bahan">
                @if ($produk_components['bahan']!==null)
                {{ $produk_components['bahan']->nama }}
                @endif
                </td>
            </tr>
            <tr id="tr-kombinasi" class="item-spec"><td>Kombinasi</td><td>:</td><td id="nama-kombinasi">
                @if ($produk_components['kombinasi']!==null)
                {{ $produk_components['kombinasi']->nama }}
                @endif
                </td>
            </tr>
            <tr id="tr-tsixpack" class="item-spec"><td>T.Sixpack</td><td>:</td><td id="nama-tsixpack">
                @if ($produk_components['tsixpack']!==null)
                {{ $produk_components['tsixpack']->nama }}
                @endif
                </td>
            </tr>
            <tr id="tr-grade_bahan" class="item-spec"><td>Grade Bahan</td><td>:</td><td id="nama-grade_bahan">
                @if ($produk_components['bahan']!==null)
                {{ $produk_components['bahan']->grade }}
                @endif
                </td>
            </tr>
            <tr id="tr-japstyle" class="item-spec"><td>Japstyle</td><td>:</td><td id="nama-japstyle">
                @if ( $produk_components['japstyle']!==null )
                {{ $produk_components['japstyle']->nama }}
                @endif
                </td>
            </tr>
            <tr id="tr-motif" class="item-spec"><td>Motif</td><td>:</td><td id="nama-motif">
                @if ($produk_components['motif']!==null)
                {{ $produk_components['motif']->nama }}
                @endif
            </td></tr>
            <tr id="tr-standar" class="item-spec"><td>Standar</td><td>:</td><td id="nama-standar">
                @if ($produk_components['standar']!==null)
                {{ $produk_components['standar']->nama }}
                @endif
                </td>
            </tr>
            @if ($produk_components['variasis']!==null)
            @if ( count($produk_components['variasis'])!==0 )
            @php $i=0 @endphp
            @foreach ($produk_components['variasis'] as $variasi)
            <tr id="tr-variasi-{{ $i+1 }}" class="item-spec"><td>Variasi-{{ $i+1 }}</td><td>:</td><td id="nama-variasi-{{ $i+1 }}">{{ $variasi->nama }}</td></tr>
            @if ($produk_components['varians'][$i]!==null)
            <tr id="tr-varian-{{ $i+1 }}" class="item-spec"><td>Varian-{{ $i+1 }}</td><td>:</td><td id="nama-varian-{{ $i+1 }}"></td></tr>
            @endif
            @php $i++ @endphp
            @endforeach

            @endif
            @endif
            {{--  --}}
            @if ($produk_components['specs']!==null)
            @foreach ($produk_components['specs'] as $spec)
            <tr id="tr-{{ $spec['kategori'] }}" class="item-spec"><td>{{ $spec['kategori'] }}</td><td>:</td><td>{{ $spec['nama'] }}</td>
            </tr>
            @endforeach
            @endif
            {{-- <tr id="tr-ukuran" class="item-spec"><td>Ukuran</td><td>:</td><td id="nama-ukuran">
                @if ($produk_components['ukuran']!==null)
                {{ $produk_components['ukuran']->nama }}
                @endif
                </td>
            </tr> --}}
            <tr id="tr-tankpad" class="item-spec"><td>Tankpad</td><td>:</td><td id="nama-tankpad">
                @if ($produk_components['tankpad']!==null)
                {{ $produk_components['tankpad']->nama }}
                @endif
                </td>
            </tr>
            <tr id="tr-stiker" class="item-spec"><td>Stiker</td><td>:</td><td id="nama-stiker">
                @if ($produk_components['stiker']!==null)
                {{ $produk_components['stiker']->nama }}
                @endif
                </td>
            </tr>
            <tr id="tr-busastang" class="item-spec"><td>Busastang</td><td>:</td><td id="nama-busastang">
                @if ($produk_components['busastang']!==null)
                {{ $produk_components['busastang']->nama }}
                @endif
                </td>
            </tr>
            <tr id="tr-harga-pcs" class="item-spec"><td>Harga/pcs</td><td>:</td><td id="harga-pcs" class="toFormatCurrencyRp">
                @if ($produk_components['produk_harga']!==null)
                {{ $produk_components['produk_harga']->harga }}
                @endif
                </td>
            </tr>
        </table>
    </div>


    {{-- <input id="mode" type="hidden" name="mode" value="{{ $mode }}"> --}}
    {{-- Pada mode insert baru, spk_id akan bernilai null, sedangkan pada mode inserting from detail, spk_id akan diketahui --}}
</form>

@endsection
