@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex align-items-center mt-3">
        <div><img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt=""></div>
        <div class="fw-bold ms-2">
            Tambah Ekspedisi
        </div>
    </div>
</div>

<form class="container mt-3" action="{{ route('pelanggan_tambah_ekspedisi_db') }}" method="POST" class="m-3">
    @csrf
    <div style="max-width: 10rem;display:inline-block;">
        <label for="tipe_ekspedisi">Tipe:</label>
        <select class="form-control" name="tipe_ekspedisi" id="tipe_ekspedisi">
            <option value="UTAMA">UTAMA</option>
            <option value="CADANGAN">CADANGAN</option>
            <option value="TRANSIT">TRANSIT</option>
        </select>
    </div>
    <div style="display:inline-block; max-width:70%">
        <label for="ipt_pilih_ekspedisi">Pilih Ekspedisi:</label>
        <input name="ekspedisi_nama" id="ipt_pilih_ekspedisi" type="text" class="form-control @error('ekspedisi_nama') is-invalid @enderror" >
        @error('ekspedisi_nama')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
    {{-- <input name="pulau" id="pulau" class="form-control" type="text" placeholder="Pulau"> --}}
    <input id="ipt_id_ekspedisi_terpilih" type="hidden" name="ekspedisi_id">
    <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">

    <div class="mt-3">
        <button type="submit" class="btn btn-warning">Konfirmasi</button>
    </div>
</form>

<script>
    const label_ekspedisis={!! json_encode($label_ekspedisis,JSON_HEX_TAG) !!};
    $('#ipt_pilih_ekspedisi').autocomplete(
        {
            source:label_ekspedisis,
            select:function(event,ui){
                this.value=ui.item.value;
                $('#ipt_id_ekspedisi_terpilih').val(ui.item.id);
            }
        }
    );
</script>
@endsection
