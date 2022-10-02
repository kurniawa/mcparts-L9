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

    <form action="{{ route('pelanggan_tambah_alamat_db') }}" onsubmit="return formValidation()" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mt-3">
            <label style="font-weight: bold">Alamat Lengkap:</label>
            <input type="text" class="form-control ipt-long" name="long[]" placeholder="Baris 1">
            <input type="text" class="form-control ipt-long" name="long[]" placeholder="Baris 2">
            <input type="text" class="form-control ipt-long" name="long[]" placeholder="Baris 3">
            <input type="text" class="form-control ipt-long" name="long[]" placeholder="Baris 4">
            <input type="text" class="form-control ipt-long" name="long[]" placeholder="Baris 5">
        </div>
        <div class="invalid-feedback" id="inv-long"></div>

        <div class="row mb-3">
            <div class="col opsi" id="opsi-jl">
                <div class="text-end">
                    <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-jl', 'opsi-jl')">X</button>
                </div>
                <div class="form-floating">
                    <input id="jalan" type="text" name="jalan" class="form-control" placeholder="Nama Jalan">
                    <label for="jalan" style="font-weight: bold">Nama Jalan:</label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col opsi" id="opsi-komplek">
                <div class="text-end">
                    <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-komplek', 'opsi-komplek')">X</button>
                </div>
                <div class="form-floating">
                    <input id="komplek" type="text" name="komplek" class="form-control" placeholder="Nama Komplek">
                    <label for="komplek" style="font-weight: bold">Nama Komplek:</label>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col opsi" id="opsi-rt">
                <label for="rt" style="font-weight: bold">RT:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-rt', 'opsi-rt')">X</button>
                <input id="rt" type="text" name="rt" class="form-control" placeholder="RT">
            </div>
            <div class="col opsi" id="opsi-rw">
                <label for="rw" style="font-weight: bold">RW:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-rw', 'opsi-rw')">X</button>
                <input id="rw" type="text" name="rw" class="form-control" placeholder="RW">
            </div>
        </div>
        <div class="row">
            <div class="col opsi" id="opsi-desa">
                <label for="desa" style="font-weight: bold">Desa:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-desa', 'opsi-desa')">X</button>
                <input id="desa" type="text" name="desa" class="form-control" placeholder="Desa">
            </div>
            <div class="col opsi" id="opsi-kel">
                <label for="kelurahan" style="font-weight: bold">Keluarahan:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-kel', 'opsi-kel')">X</button>
                <input id="kelurahan" type="text" name="kelurahan" class="form-control" placeholder="Keluarahan">
            </div>
        </div>

        <div class="row">
            <div class="col opsi" id="opsi-kec">
                <label for="kecamatan" style="font-weight: bold">Kecamatan:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-kec', 'opsi-kec')">X</button>
                <input id="kecamatan" type="text" name="kecamatan" class="form-control" placeholder="Kecamatan">
            </div>
            <div class="col opsi" id="opsi-kota">
                <label for="kota" style="font-weight: bold">Kota:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-kota', 'opsi-kota')">X</button>
                <input id="kota" type="text" name="kota" class="form-control" placeholder="Kota">
            </div>
        </div>

        <div class="row">
            <div class="col opsi" id="opsi-kab">
                <label for="kabupaten" style="font-weight: bold">Kabupaten:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-kab', 'opsi-kab')">X</button>
                <input name="kabupaten" id="kabupaten" class="form-control" type="text" placeholder="Kabupaten">
            </div>
            <div class="col opsi" id="opsi-prov">
                <label for="provinsi" style="font-weight: bold">Provinsi:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-prov', 'opsi-prov')">X</button>
                <input id="provinsi" type="text" name="provinsi" class="form-control" placeholder="Provinsi">
            </div>
        </div>
        <div class="row">
            <div class="col opsi" id="opsi-kodepos">
                <label for="kodepos" style="font-weight: bold">Kode Pos:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-kodepos', 'opsi-kodepos')">X</button>
                <input name="kodepos" id="kodepos" class="form-control" type="text" placeholder="Kode Pos">
            </div>

            <div class="col opsi" id="opsi-pulau">
                <label for="pulau" style="font-weight: bold">Pulau:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-pulau', 'opsi-pulau')">X</button>
                <input name="pulau" id="pulau" class="form-control" type="text" placeholder="Pulau">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col opsi" id="opsi-negara">
                <label for="negara" style="font-weight: bold">Negara:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-negara', 'opsi-negara')">X</button>
                <input id="negara" type="text" name="negara" class="form-control" placeholder="Negara">
            </div>
            <div class="col">
                <label for="short" style="font-weight: bold">Short:</label>
                <input name="short" id="short" class="form-control" type="text" placeholder="Short">
                <div class="invalid-feedback" id="inv_short"></div>
            </div>
        </div>
        <br><br>
        <div>
            <label for="">Opsional:</label><br>
            <button type="button" class="btn btn-outline-dark btn-sm" id="btn-jl" onclick="showHide('opsi-jl', this.id)">+Jl.</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-komplek" onclick="showHide('opsi-komplek', this.id)">+Komplek</button>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-rt" onclick="showHide('opsi-rt', this.id)">+RT</button>
            <button type="button" class="btn btn-outline-success btn-sm" id="btn-rw" onclick="showHide('opsi-rw', this.id)">+RW</button>
            <button type="button" class="btn btn-outline-danger btn-sm" id="btn-desa" onclick="showHide('opsi-desa', this.id)">+Desa</button>
            <button type="button" class="btn btn-outline-warning btn-sm" id="btn-kel" onclick="showHide('opsi-kel', this.id)">+Kel.</button>
            <button type="button" class="btn btn-outline-info btn-sm" id="btn-kec" onclick="showHide('opsi-kec', this.id)">+Kec.</button>
            <button type="button" class="btn btn-outline-dark btn-sm" id="btn-kab" onclick="showHide('opsi-kab', this.id)">+Kab.</button>
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-prov" onclick="showHide('opsi-prov', this.id)">+Prov.</button>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-kota" onclick="showHide('opsi-kota', this.id)">+Kota</button>
            <button type="button" class="btn btn-outline-success btn-sm" id="btn-pulau" onclick="showHide('opsi-pulau', this.id)">+Pulau</button>
            <button type="button" class="btn btn-outline-danger btn-sm" id="btn-negara" onclick="showHide('opsi-negara', this.id)">+Negara</button>
        </div>
        <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
        <br><br>
        <div class="text-center">
            <button type="submit" class="fw-bold btn btn-warning">Tambah Alamat Baru</button>
        </div>
    </form>



</div>

<script>
    function formValidation() {
        const longs=document.querySelectorAll('input[name="long[]"]');
        console.log(longs);
        var valid=true;
        if (longs[0].value.trim()=="") {
            var inv_long=document.getElementById('inv-long');
            inv_long.textContent="Alamat pada baris pertama belum diisi!";
            inv_long.style.display='block';
            valid=false;
        }

        const short=document.getElementById('short').value;
        if (short.trim()=="") {
            var inv_short=document.getElementById('inv_short');
            inv_short.textContent="Short harus diisi!";
            inv_short.style.display='block';
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

