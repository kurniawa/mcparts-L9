@extends('layouts.main_layout')
@extends('layouts.navbar_v2')
@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-1">
            <img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt="">
        </div>
        <div class="col fw-bold fs-4">
            Input Data Pelanggan Baru
        </div>
    </div>

    <form id="form-new_ekspedisi" action="{{ route('pelanggan_baru_db') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row mb-3 mt-3">
            <div class="col-5">
                <label for="bentuk" style="font-weight: bold">Bentuk:</label>
                <select name="bentuk" id="bentuk" class="form-select">
                    <option value="">-</option>
                    <option value="CV">CV</option>
                    <option value="PT">PT</option>
                </select>
            </div>

            <div class="col opsi" id="opsi-nik">
                <div class="text-end">
                    <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-nik', 'opsi-nik')">X</button>
                </div>
                <div class="form-floating">
                    <input name="nik" id="nik" class="form-control" type="text" placeholder="NIK">
                    <label for="nik" style="font-weight: bold">NIK:</label>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col">
                <label for="nama" style="font-weight: bold">Nama:</label>
                <input name="nama" id="nama" class="form-control" type="text" placeholder="Nama" required>
                <div id="nama-invalid" class="invalid-feedback">Nama harus diisi!</div>
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6 opsi" id="opsi-gender">
                <label for="gender" style="font-weight: bold">Gender:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-gender', 'opsi-gender')">X</button>
                <input name="gender" id="gender" class="form-control" type="text" placeholder="Gender">
            </div>
            <div class="col-6 opsi" id="opsi-alias">
                <label for="alias" style="font-weight: bold">Alias:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-alias', 'opsi-alias')">X</button>
                <input name="alias" id="alias" class="form-control" type="text" placeholder="Alias">
            </div>
            <div class="col-6 opsi" id="opsi-sapaan">
                <label for="sapaan" style="font-weight: bold">Sapaan:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-sapaan', 'opsi-sapaan')">X</button>
                <input name="sapaan" id="sapaan" class="form-control" type="text" placeholder="Sapaan">
            </div>
            <div class="col-6 opsi" id="opsi-gelar">
                <label for="gelar" style="font-weight: bold">Gelar:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-gelar', 'opsi-gelar')">X</button>
                <input name="gelar" id="gelar" class="form-control" type="text" placeholder="Gelar">
            </div>
        </div>

        <div class="opsi" id="opsi-alamat">
            <label style="font-weight: bold">Alamat Lengkap:</label>
            <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-alamat', 'opsi-alamat')">X</button>
            <input type="text" class="form-control ipt-long" name="long[]" placeholder="Baris 1">
            <input type="text" class="form-control ipt-long" name="long[]" placeholder="Baris 2">
            <input type="text" class="form-control ipt-long" name="long[]" placeholder="Baris 3">
            <input type="text" class="form-control ipt-long" name="long[]" placeholder="Baris 4">
            <input type="text" class="form-control ipt-long" name="long[]" placeholder="Baris 5">
        </div>
        <br>

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
            <div class="col opsi" id="opsi-short">
                <label for="short" style="font-weight: bold">Short:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-short', 'opsi-short')">X</button>
                <input name="short" id="short" class="form-control" type="text" placeholder="Short">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-6 opsi" id="opsi-initial">
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-initial', 'opsi-initial')">X</button>
                <div class="form-floating">
                    <input name="initial" id="initial" class="form-control" type="text" placeholder="Singkatan (opsional)">
                    <label for="initial" style="font-weight: bold">Initial/Singkatan:</label>
                </div>
            </div>
        </div>

        <div class="row mb-3 opsi" id="opsi-kontak">
            <div class="col-6">
                <label style="font-weight: bold">Kontak:</label>
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-kontak', 'opsi-kontak')">X</button>
                <div class="form-floating">
                    <select name="tipekontak" id="tipekontak" class="form-select">
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
            <div class="col-6">
                <div class="form-floating">
                    <input name="nomor" id="nomor" class="form-control" type="text" placeholder="No. Kontak">
                    <label for="nomor" style="font-weight: bold">No. Kontak:</label>
                </div>
            </div>
        </div>

        <div class="mb-3 opsi" id="opsi-fpelanggan">
            <label for="fpelanggan" class="form-label">Foto Pelanggan</label>
            <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-fpelanggan', 'opsi-fpelanggan')">X</button>
            <input class="form-control mb-3" type="file" id="fpelanggan" name="pathfpelanggan[]" onchange="previewImage(this.id, 'fpelanggan-preview');">
            <div class="text-center">
                {{-- @if ($post->pathfpelanggan)
                <img src="{{ asset('storage/' . $post->pathfpelanggan) }}" id="fpelanggan-preview" style="max-width: 17rem">
                @else
                <img id="fpelanggan-preview" style="max-width: 17rem">
                @endif --}}
                <img id="fpelanggan-preview" style="max-width: 17rem">
            </div>
        </div>

        <div class="mb-3 opsi" id="opsi-fktp">
            <label for="fktp" class="form-label">Foto KTP</label>
            <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-fktp', 'opsi-fktp')">X</button>
            <input class="form-control mb-3" type="file" id="fktp" name="pathfpelanggan[]" onchange="previewImage(this.id, 'fpelanggan-preview');">
            <div class="text-center">
                <img id="fktp-preview" style="max-width: 17rem">
            </div>
        </div>

        <br>
        <label for="keterangan" style="font-weight:bold">Keterangan lain:</label>
        <textarea id="keterangan" class="form-control" name="keterangan" placeholder="Keterangan lain (opsional)" rows="3"></textarea>

        <br><br>
        <div>
            <label for="">Opsional:</label><br>
            {{-- <button type="button" class="btn btn-outline-primary btn-sm" id="btn-nik" onclick="showHide('opsi-nik', this.id)">+NIK</button> --}}
            <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-alias" onclick="showHide('opsi-alias', this.id)">+Alias</button>
            {{-- <button type="button" class="btn btn-outline-success btn-sm" id="btn-gender" onclick="showHide('opsi-gender', this.id)">+Gender</button> --}}
            {{-- <button type="button" class="btn btn-outline-danger btn-sm" id="btn-gelar" onclick="showHide('opsi-gelar', this.id)">+Gelar</button> --}}
            <button type="button" class="btn btn-outline-warning btn-sm" id="btn-sapaan" onclick="showHide('opsi-sapaan', this.id)">+Sapaan</button>
            <button type="button" class="btn btn-outline-info btn-sm" id="btn-alamat" onclick="showHide('opsi-alamat', this.id)">+Alamat</button>
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
            <button type="button" class="btn btn-outline-warning btn-sm" id="btn-short" onclick="showHide('opsi-short', this.id)">+Short</button>
            <button type="button" class="btn btn-outline-info btn-sm" id="btn-initial" onclick="showHide('opsi-initial', this.id)">+Initial</button>
            <button type="button" class="btn btn-outline-success btn-sm" id="btn-kontak" onclick="showHide('opsi-kontak', this.id)">+Kontak</button>
            {{-- <button type="button" class="btn btn-outline-dark btn-sm" id="btn-fpelanggan" onclick="showHide('opsi-fpelanggan', this.id)">+Foto</button> --}}
            {{-- <button type="button" class="btn btn-outline-primary btn-sm" id="btn-fktp" onclick="showHide('opsi-fktp', this.id)">+F.KTP</button> --}}
        </div>


        <br><br>
        <div class="text-center">
            <button type="submit" class="btn btn-warning">
                <span class="justify-self-center font-weight-bold">Input Pelanggan Baru</span>
            </button>
        </div>
    </form>



</div>


<style>

</style>

<script>
    // Just use a simple button instead of a submit button. And call a JavaScript function to handle form submit:

    // <input type="button" name="submit" value="submit" onclick="submit_form();"/>
    // Function within a script tag:

    // function submit_form() {
    //     if (conditions) {
    //         document.forms['myform'].submit();
    //     }
    //     else {
    //         returnToPreviousPage();
    //     }
    // }

    function formValidation() {
        $nama = $("#nama").val();
        $alamat = $("#alamat").val();
        $peringatan = $("#peringatan");

        if ($nama === "") {
            $peringatan.html("Nama Ekspedisi harus diisi!");
            if ($peringatan.css("display") == "none") {
                $peringatan.show();
            }
            alert("Nama Ekspedisi harus diisi!");
            history.back();
            return false;
        }

        if ($alamat === '') {
            $peringatan.html("Alamat Ekspedisi harus diisi!");
            if ($peringatan.css("display") == "none") {
                $peringatan.show();
            }
            history.back();
            return false;
        }

        return true;
    }

    function showHide(toshow, tohide) {
        $(`#${toshow}`).show();
        $(`#${tohide}`).hide();
    }


</script>

<style>
    .div-filter-icon {
        justify-self: end;
    }

    .icon-small-circle {
        border-radius: 100%;
        width: 2.5em;
        height: 2.5em;
        position: relative;
    }

    .circle-medium {
        border-radius: 100%;
        width: 3em;
        height: 3em;
    }

    .icon-img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .div-cari-filter {
        border-bottom: 0.5px solid #E4E4E4;
    }
    .opsi {
        display: none;
    }
</style>
@endsection

