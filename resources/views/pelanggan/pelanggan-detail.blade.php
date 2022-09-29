@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex align-items-center">
        <div>
            <img class="w-2_5rem" src="{{ asset('img/icons/boy.svg') }}">
        </div>
        <span class="fs-2 ms-2">Detail Pelanggan:</span>
    </div>
    <div style="text-align: center">
        <h1>{{ $pelanggan['nama'] }}</h1>
    </div>

    <div class="row">
        @for ($i = 0; $i < count($alamats); $i++)
        <div class="col">
            @if ($pelanggan_alamats[$i]['tipe']==="UTAMA")
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
                    </div>
                    <div class="ms-3 align-self-end">
                        <a href="{{ route('pelanggan_edit_alamat',['alamat_id'=>$alamats[$i]['id'],'pelanggan_id'=>$pelanggan['id']]) }}"><img style="width: 1rem;" src="{{ asset('img/icons/edit.svg') }}"></a>
                        <form action="{{ route('pelanggan_hapus_alamat') }}" method="POST" onsubmit="return confirm('Apa Anda yakin ingin menghapus alamat ini?')" class="mt-2">
                            @csrf
                            <input type="hidden" name="alamat_id" value="{{ $alamats[$i]['id'] }}">
                            <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
                            <input type="hidden" name="pelanggan_alamat_id" value="{{ $pelanggan_alamats[$i]['id'] }}">
                            <button type="submit" class="btn-no-styling"><img src="{{ asset('img/icons/delete.svg') }}" style="width: 1rem;"></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endfor
    </div>

    <div class="row mt-2">
        @foreach ($pelanggan_kontaks as $kontak)
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
                    </span>
                    <div class="ms-3 align-self-end">
                        <a href="{{ route('pelanggan_edit_kontak') }}"><img style="width: 1rem;" src="{{ asset('img/icons/edit.svg') }}"></a>
                        <form action="{{ route('pelanggan_hapus_kontak') }}" method="POST" onsubmit="return confirm('Apa Anda yakin ingin menghapus kontak ini?')" class="mt-2">
                            @csrf
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
            <textarea class="form-control" readonly>{{ $pelanggan['keterangan'] }}</textarea>
        </div>
    </div>

    <div class="d-flex flex-row mt-2 mb-2 align-items-center">
        <img class="w-2_5rem" src="{{ asset('img/icons/truck.svg') }}" alt="">
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
