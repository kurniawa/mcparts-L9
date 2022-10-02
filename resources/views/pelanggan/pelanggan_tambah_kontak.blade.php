@extends('layouts.main_layout')
@extends('layouts.navbar')
@section('content')

<div class="container">
    <div class="d-flex align-items-center mt-3">
        <div><img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt=""></div>
        <div class="fw-bold ms-2">
            Tambah Alamat Pelanggan: {{ $pelanggan['nama'] }}
        </div>
    </div>

    <form class="mt-3" action="{{ route('pelanggan_tambah_kontak_db') }}" method="POST" enctype="multipart/form-data" onsubmit="return formValidation()">
        @csrf
        <label style="font-weight: bold">Kontak:</label>
        <div class="row mb-3 mt-3" id="opsi-kontak">
            <div class="col-6">
                <div class="form-floating">
                    <select name="tipekontak" id="tipekontak" class="form-select">
                        <option value="">-</option>
                        <option value="seluler">Seluler</option>
                        <option value="rumah">Rumah</option>
                        <option value="kantor">Kantor</option>
                    </select>
                    <label for="tipekontak" style="font-weight: bold">Tipe Kontak:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input name="kodearea" id="kodearea" class="form-control" type="text" placeholder="Kode Area">
                    <label for="kodearea" style="font-weight: bold">Kode Area:</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-floating">
                    <input name="nomor" id="nomor" class="form-control" type="text" placeholder="No. Kontak">
                    <label for="nomor" style="font-weight: bold">No. Kontak:</label>
                </div>
                <div class="invalid-feedback" id="inv_nomor"></div>
            </div>
            <div class="col-6 opsi" id="opsi-lokasi">
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-lokasi', 'opsi-lokasi')">X</button>
                <div class="form-floating">
                    <input name="lokasi" id="lokasi" class="form-control" type="text" placeholder="No. Kontak">
                    <label for="lokasi" style="font-weight: bold">Daerah/Lokasi:</label>
                </div>
            </div>
        </div>

        <br><br>
        <div>
            <label for="">Opsional:</label><br>
            <button type="button" class="btn btn-outline-danger btn-sm" id="btn-lokasi" onclick="showHide('opsi-lokasi', this.id)">+Lokasi</button>

        </div>


        <br><br>
        <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
        <div class="text-center">
            <button type="submit" class="btn btn-warning fw-bold">Tambah Kontak Baru</button>
        </div>
    </form>



</div>

<script>

    function formValidation() {
        const nomor=document.getElementById('nomor').value;
        console.log(nomor);
        var valid=true;
        if (nomor.trim()=="") {
            var inv_nomor=document.getElementById('inv_nomor');
            inv_nomor.textContent="Nomor kontak harus diisi!";
            inv_nomor.style.display='block';
            valid=false;
        }
        return valid;
    }

    function showHide(toshow, tohide) {
        $(`#${toshow}`).show();
        $(`#${tohide}`).hide();
    }


</script>

<style>
    .opsi {
        display: none;
    }
</style>
@endsection

