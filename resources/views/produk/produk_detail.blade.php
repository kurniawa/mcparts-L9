@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<!-- The best way to take care of the future is to take care of the present moment. - Thich Nhat Hanh -->
{{-- Validation Feedback --}}
@if (session()->has('_success') && session('_success')!=="")
<div class="container mt-1 alert alert-success">{{ session('_success') }}</div>
@endif
@if (session()->has('_warnings') && session('_warnings')!=="")
<div class="container mt-1 alert alert-warning">{{ session('_warnings') }}</div>
@endif
@if (session()->has('_errors') && session('_errors')!=="")
<div class="container mt-1 alert alert-danger">{{ session('_errors') }}</div>
@endif

<div class="container">
    <div class="row mt-2">
        <div class="col">
            <h3>Detail Produk</h3>
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
        </div>
        <div class="col d-none">
            <h3>Histori Harga</h3>
            <table class="table-basic">
                <tr><th>Tgl.P</th><th>Harga</th><th>Opsi</th></tr>
                @foreach ($produk_components['produk_hargas'] as $produk_harga)
                <tr>
                    <td>{{ date("d-m-Y", strtotime($produk_harga['created_at'])) }}</td>
                    <td class="toFormatCurrencyRp">{{ $produk_harga['harga'] }}</td>
                    <td>
                        <div class="d-flex">
                            <img src="{{ asset('img/icons/edit.svg') }}" alt="edit" style="width: 1rem;" class="hover-cursor">
                            <form action="{{ route('produkHargaHapus') }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus harga ini dari histori harga produk ini?')" style="margin: 0;margin-left:0.1rem">
                                <button class="btn-icon">
                                    <img src="{{ asset('img/icons/delete.svg') }}" alt="edit" style="width: 1rem;">
                                </button>
                            </form>

                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="3">
                        <form action="{{ route('produkHargaEdit') }}" method="POST" class="border border-primary rounded p-1">
                            <label for="">Harga</label>
                            <input type="number" name="harga" id="" class="form-control" value="{{ $produk_harga['harga'] }}">
                            <label for="">Status</label>
                            <select name="status" id="" class="form-select">
                                <option value="DEFAULT">harga default</option>
                                <option value="BARU">harga baru</option>
                                <option value="LAMA">harga lama</option>
                            </select>
                            <div class="text-end">
                                <button class="btn btn-sm btn-warning mt-1">Konfirmasi</button>
                            </div>
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>
            <style>
                .table-basic {
                    width: 100%;
                }
                .table-basic th,td {
                    padding-left:0.5rem;
                    padding-right:0.5rem;
                }
                .hover-cursor:hover {
                    cursor: pointer;
                }
                .btn-icon {
                    border: none;
                    padding: 0;
                }
            </style>
        </div>
    </div>
</div>
<br>
<div class="container">

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
                @if ($produk_components['produk_harga_latest']!==null)
                {{ $produk_components['produk_harga_latest']->harga }}
                @endif
                </td>
            </tr>
        </table>
    </div>
</div>

    {{-- <input id="mode" type="hidden" name="mode" value="{{ $mode }}"> --}}
    {{-- Pada mode insert baru, spk_id akan bernilai null, sedangkan pada mode inserting from detail, spk_id akan diketahui --}}

@endsection
