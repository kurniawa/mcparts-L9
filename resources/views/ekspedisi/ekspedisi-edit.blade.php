@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex align-items-center">
        <img class="w-2rem" src="/img/icons/pencil.svg">
        <span class="fs-1">Edit Data Ekspedisi</span>
    </div>
</div>

<div class="container mt-3">
    <form action="{{ route('EditEkspedisiDB') }}" method="POST">
        @csrf
        <input type="hidden" name="ekspedisi_id" value="{{ $ekspedisi['id'] }}">
        <div class="row">
            <div class="col-3">
                <label for="selectBentukPerusahaan">Bentuk:</label><br>
                <select class="form-control" name="bentuk_perusahaan" id="selectBentukPerusahaan">
                    <option value="" disabled>Bentuk</option>
                    <option value="" @if ($ekspedisi['bentuk'] === '')
                        selected
                    @endif >-</option>
                    <option value="PT" @if ($ekspedisi['bentuk'] === 'PT')
                        selected
                    @endif >PT</option>
                    <option value="CV" @if ($ekspedisi['bentuk'] === 'CV')
                        selected
                    @endif >CV</option>
                </select>
            </div>
            <div class="col">
                <label for="namaEdited">Nama Ekspedisi:</label>
                <input id="namaEdited" class="form-control" name="nama_ekspedisi" type="text" placeholder="Nama Ekspedisi" value="{{ $ekspedisi['nama'] }}" required>
            </div>
        </div>
        <label for="keteranganEdited">Keterangan:</label>
        <textarea id="keteranganEdited" class="form-control" name="keterangan" rows="5" placeholder="Keterangan lain (opsional)">{{ $ekspedisi['keterangan'] }}</textarea>

        <div class="text-center mt-3">
            <button type="submit" class="btn btn-warning">Simpan Perubahan</button>
        </div>
    </form>

</div>


<script>

</script>

@endsection


