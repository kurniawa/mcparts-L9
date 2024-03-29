@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex align-items-center">
        <div>
            <img class="w-2_5rem" src="{{ asset('img/icons/truck.svg') }}">
        </div>
        <span class="fs-2 ms-2">Detail Ekspedisi:</span>
    </div>
    <div style="text-align: center">
        <h1>
        @if ($ekspedisi['bentuk']!==null)
        {{ $ekspedisi['bentuk'] }}. {{ $ekspedisi['nama'] }}
        @else
        {{ $ekspedisi['nama'] }}
        @endif
        </h1>
    </div>

    <div class="row">
        @for ($i = 0; $i < count($alamats); $i++)
        <div class="col">
            @if ($ekspedisi_alamats[$i]['tipe']==="UTAMA")
            <div class="d-inline-block border border-primary rounded p-2 border-3">
            @else
            <div class="d-inline-block border border-secondary rounded p-2">
            @endif
                <div class="d-flex flex-row mt-2 mb-2 align-items-center">
                    <img class="w-2_5rem" src="{{ asset('img/icons/address.svg') }}" alt="">
                    <div class="ms-2">
                        @foreach (json_decode($alamats[$i]['long']) as $alm)
                        <div>{{ $alm }}</div>
                        @endforeach
                        @if ($alamats[$i]['short']!==null)<div style="color: gray;">{{ $alamats[$i]['short'] }}</div>@endif
                    </div>
                    <div class="ms-3 align-self-end">
                        <a href="{{ route('ekspedisi_edit_alamat',['alamat_id'=>$alamats[$i]['id'],'ekspedisi_id'=>$ekspedisi['id']]) }}"><img style="width: 1rem;" src="{{ asset('img/icons/edit.svg') }}"></a>
                        <form action="{{ route('ekspedisi_hapus_alamat') }}" method="POST" onsubmit="return confirm('Apa Anda yakin ingin menghapus alamat ini?')" class="mt-2">
                            @csrf
                            <input type="hidden" name="alamat_id" value="{{ $alamats[$i]['id'] }}">
                            <input type="hidden" name="ekspedisi_id" value="{{ $ekspedisi['id'] }}">
                            <input type="hidden" name="ekspedisi_alamat_id" value="{{ $ekspedisi_alamats[$i]['id'] }}">
                            <button type="submit" class="btn-no-styling"><img src="{{ asset('img/icons/delete.svg') }}" style="width: 1rem;"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>

    <div class="row mt-2">
        @foreach ($ekspedisi_kontaks as $kontak)
        <div class="col">
            @if ($kontak['is_aktual']=='yes')
            <div class="d-inline-block border border-success rounded p-2 border-3">
            @else
            <div class="d-inline-block border border-secondary rounded p-2">
            @endif
                <div class="d-flex flex-row mt-2 mb-2 align-items-center">
                    <img class="w-2_5rem" src="{{ asset('img/icons/call.svg') }}" alt="">
                    <span class="ms-2">
                        @if ($kontak['kodearea']!==null)
                        ({{ $kontak['kodearea'] }}) {{ $kontak['nomor'] }}
                        @else
                        {{ $kontak['nomor'] }}
                        @endif
                        @if ($kontak['lokasi']!==null)<div style="color: gray;">{{ $kontak['lokasi'] }}</div>@endif
                    </span>
                    <div class="ms-3 align-self-end">
                        <a href="{{ route('ekspedisi_edit_kontak',['ekspedisi_kontak_id'=>$kontak['id'],'ekspedisi_id'=>$ekspedisi['id']]) }}"><img style="width: 1rem;" src="{{ asset('img/icons/edit.svg') }}"></a>
                        <form action="{{ route('ekspedisi_hapus_kontak') }}" method="POST" onsubmit="return confirm('Apa Anda yakin ingin menghapus kontak ini?')" class="mt-2">
                            @csrf
                            <input type="hidden" name="ekspedisi_id" value="{{ $ekspedisi['id'] }}">
                            <input type="hidden" name="ekspedisi_kontak_id" value="{{ $kontak['id'] }}">
                            <button type="submit" class="btn-no-styling"><img src="{{ asset('img/icons/delete.svg') }}" style="width: 1rem;"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="row mt-2">
        <div class="col-1">Ktrg.:</div>
        <div class="col">
            <textarea class="form-control" readonly>{{ $ekspedisi['keterangan'] }}</textarea>
        </div>
    </div>

    <div class="d-flex flex-row mt-2 mb-2 align-items-center">
        <img class="w-2_5rem" src="{{ asset('img/icons/boy.svg') }}" alt="">
        <div class="font-weight-bold">Daftar Pelanggan dengan Ekspedisi ini:</div>
    </div>

    <div class="d-flex flex-row mt-2 mb-2 align-items-center">
        <img class="w-2_5rem" src="{{ asset('img/icons/letter.svg') }}" alt="">
        <div class="font-weight-bold">Daftar Surat Jalan dengan Ekspedisi ini:</div>
    </div>

</div>

<style>
.btn-no-styling {
	background: none;
	color: inherit;
	border: none;
	padding: 0;
	font: inherit;
	cursor: pointer;
	outline: inherit;
}
</style>

<script>

</script>

@endsection
