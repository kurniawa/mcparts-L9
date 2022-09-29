@extends('layouts.main_layout')
@extends('layouts.navbar_v2')
@section('content')

<div class="container">
    <div class="row mt-3">
        <div class="col-1">
            <img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt="">
        </div>
        <div class="col fw-bold fs-4">
            Edit Data Pelanggan
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

        <div class="row mb-3">
            <div class="col-6 opsi" id="opsi-initial">
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-initial', 'opsi-initial')">X</button>
                <div class="form-floating">
                    <input name="initial" id="initial" class="form-control" type="text" placeholder="Singkatan (opsional)">
                    <label for="initial" style="font-weight: bold">Initial/Singkatan:</label>
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
            <button type="button" class="btn btn-outline-primary btn-sm" id="btn-nik" onclick="showHide('opsi-nik', this.id)">+NIK</button>
            <button type="button" class="btn btn-outline-secondary btn-sm" id="btn-alias" onclick="showHide('opsi-alias', this.id)">+Alias</button>
            <button type="button" class="btn btn-outline-success btn-sm" id="btn-gender" onclick="showHide('opsi-gender', this.id)">+Gender</button>
            <button type="button" class="btn btn-outline-danger btn-sm" id="btn-gelar" onclick="showHide('opsi-gelar', this.id)">+Gelar</button>
            <button type="button" class="btn btn-outline-warning btn-sm" id="btn-sapaan" onclick="showHide('opsi-sapaan', this.id)">+Sapaan</button>
            <button type="button" class="btn btn-outline-info btn-sm" id="btn-initial" onclick="showHide('opsi-initial', this.id)">+Initial</button>
            {{-- <button type="button" class="btn btn-outline-dark btn-sm" id="btn-fpelanggan" onclick="showHide('opsi-fpelanggan', this.id)">+Foto</button> --}}
            {{-- <button type="button" class="btn btn-outline-primary btn-sm" id="btn-fktp" onclick="showHide('opsi-fktp', this.id)">+F.KTP</button> --}}
        </div>


        <br><br>
        <div class="text-center">
            <button type="submit" class="btn btn-warning">
                <span class="justify-self-center font-weight-bold">Simpan Perubahan</span>
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

