@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div>
        <h2 style="color: white">Pelanggan: Relasi Dengan Reseller</h2>
    </div>
</header>

<form action="/pelanggan/tetapkan-reseller-db" method="POST">
    @csrf
    <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
    <div class="ml-1em mr-1em mt-2em">
        <label for="nama" style="font-weight: bold">Nama:</label>
        <input name="nama_pelanggan" id="nama" class="form-control @error('nama_pelanggan') is-invalid @enderror" type="text" placeholder="Nama/Perusahaan/Pabrik" value="{{ $pelanggan['nama'] }}">
        @error('nama_pelanggan')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror

        <label style="font-weight:bold">Alamat:</label>
        <div id="div_alamat_cust"></div>
        <div id="btn_tbh_baris" class="btn btn-secondary">+ Tambah Baris Alamat</div>
        <br><br>

        <label for="ipt_negara" style="font-weight: bold">Negara:</label>
        <input id="ipt_negara" type="text" name="negara" class="form-control" placeholder="Negara">
        <input id="ipt_negara_id" type="hidden" name="negara_id">

        <div class="grid-2-auto grid-column-gap-1em mt-1em">
            <div>
                <label for="pulau" style="font-weight: bold">Pulau:</label>
                <input name="pulau" id="pulau" class="form-control @error('pulau') is-invalid @enderror" type="text" placeholder="Pulau">
                <input type="hidden" id="pulau_id" name="pulau_id">
                @error('pulau')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <label for="daerah" style="font-weight: bold">Daerah:</label>
                <input name="daerah" id="daerah" class="form-control @error('daerah') is-invalid @enderror" type="text" placeholder="Daerah">
                <input type="hidden" id="daerah_id" name="daerah_id">
                @error('daerah')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <div class="grid-2-auto grid-column-gap-1em mt-1em">
            <div>
                <label for="kontak" style="font-weight: bold">No. Kontak:</label>
                <input name="kontak_pelanggan" id="kontak" class="input-1 pb-1em" type="text" placeholder="No. Kontak">
            </div>
            <div>
                <label for="singkatan" style="font-weight: bold">Initial/Singkatan:</label>
                <input name="singkatan_pelanggan" id="singkatan" class="input-1 pb-1em" type="text" placeholder="Singkatan (opsional)">
            </div>
        </div>

        <br>
        <label for="keterangan" style="font-weight:bold">Keterangan lain:</label>
        <textarea id="keterangan" class="mt-1em pt-1em pl-1em text-area-mode-1" name="keterangan" placeholder="Keterangan lain (opsional)"></textarea>
    </div>

    <br><br>

    <div class="m-1em">
        <button type="submit" class="h-4em bg-color-orange-2 w-100 grid-1-auto">
            <span class="justify-self-center font-weight-bold">Konfirmasi Perubahan</span>
        </button>
    </div>
</form>

<script>
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};

    var iLabelDaerahs = 0;

    if (show_console) {
        console.log('pelanggan');console.log(pelanggan);
    }


</script>
@endsection
