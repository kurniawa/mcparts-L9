@extends('layouts.main_layout')
@extends('layouts.navbar')
@section('content')

<div class="container">
    <div class="d-flex align-items-center mt-3">
        <div><img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt=""></div>
        <div class="fw-bold ms-2">
            Edit Kontak Pelanggan: {{ $pelanggan['nama'] }}
        </div>
    </div>

    <form class="mt-3" action="{{ route('pelanggan_edit_kontak_db') }}" method="POST" enctype="multipart/form-data" onsubmit="return formValidation()">
        @csrf
        <label style="font-weight: bold">Kontak:</label>
        <div class="row mb-3 mt-3" id="opsi-kontak">
            <div class="col-6">
                <div class="form-floating">
                    <select name="tipekontak" id="tipekontak" class="form-select">
                        <option value=""@if ($pelanggan_kontak['tipe']==null)selected @endif>-</option>
                        <option value="seluler"@if ($pelanggan_kontak['tipe']=='seluler')selected @endif>Seluler</option>
                        <option value="rumah"@if ($pelanggan_kontak['tipe']=='rumah')selected @endif>Rumah</option>
                        <option value="kantor"@if ($pelanggan_kontak['tipe']=='kantor')selected @endif>Kantor</option>
                    </select>
                    <label for="tipekontak" style="font-weight: bold">Tipe Kontak:</label>
                </div>
            </div>
            <div class="col-6">
                <div class="form-floating">
                    <input name="kodearea" id="kodearea" class="form-control" type="text" placeholder="Kode Area" value="{{ $pelanggan_kontak['kodearea'] }}">
                    <label for="kodearea" style="font-weight: bold">Kode Area:</label>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-6">
                <div class="form-floating">
                    <input name="nomor" id="nomor" class="form-control" type="text" placeholder="No. Kontak" value="{{ $pelanggan_kontak['nomor'] }}">
                    <label for="nomor" style="font-weight: bold">No. Kontak:</label>
                </div>
                <div class="invalid-feedback" id="inv_nomor"></div>
            </div>
            <div class="col-6 opsi" id="opsi-lokasi">
                <button type="button" style="color: red;" class="btn btn-outline-danger btn-sm" onclick="showHide('btn-lokasi', 'opsi-lokasi')">X</button>
                <div class="form-floating">
                    <input name="lokasi" id="lokasi" class="form-control" type="text" placeholder="No. Kontak" value="{{ $pelanggan_kontak['lokasi'] }}">
                    <label for="lokasi" style="font-weight: bold">Daerah/Lokasi:</label>
                </div>
            </div>
        </div>
        <br>
        Tetapkan sebagai nomor utama/ter-update?
        <div class="form-check">
            <input type="radio" name="is_aktual" id="is_aktual_yes" value="yes" class="form-check-input"@if($pelanggan_kontak['is_aktual']==='yes')checked="checked"@endif><label for="is_aktual_yes" class="form-check-label">Ya</label>
        </div>
        <div class="form-check">
            <input type="radio" name="is_aktual" id="is_aktual_no" value="no" class="form-check-input"@if($pelanggan_kontak['is_aktual']==='no')checked="checked"@endif><label for="is_aktual_no" class="form-check-label">Tidak</label>
        </div>
        <br><br>
        <div>
            <label for="">Opsional:</label><br>
            <button type="button" class="btn btn-outline-danger btn-sm" id="btn-lokasi" onclick="showHide('opsi-lokasi', this.id)">+Lokasi</button>

        </div>


        <br><br>
        <input type="hidden" name="pelanggan_id" value="{{ $pelanggan['id'] }}">
        <input type="hidden" name="pelanggan_kontak_id" value="{{ $pelanggan_kontak['id'] }}">
        <div class="text-center">
            <button type="submit" class="btn btn-warning fw-bold">Simpan Perubahan</button>
        </div>
    </form>



</div>

<script>
    const pelanggan_kontak={!! json_encode($pelanggan_kontak,JSON_HEX_TAG) !!};
    setTimeout(() => {
        if (pelanggan_kontak['lokasi']!==null) {
            showHide('opsi-lokasi','btn-lokasi');
        }
    }, 100);

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

