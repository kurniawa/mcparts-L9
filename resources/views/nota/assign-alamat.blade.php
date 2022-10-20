@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex mt-2">
        <img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt="">
        <h2 class="ms-2">Tetapkan Alamat untuk Nota {{ $nota['no_nota'] }}</h2>
    </div>

    <table class="mt-2">
        <tr><th>No. Nota</th><th>:</th><th>{{ $nota['no_nota'] }}</th></tr>
        <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
        @if ($reseller !== null)
        <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk Nota ini</td></tr>
        @endif
        <tr><th>Tanggal Nota</th><th>:</th><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
    </table>
    <div class="mt-3 p-2 border rounded border-2">
        <h4 class="ms-2">Alamat Terpilih Saat ini:</h4>
        <table class="mt-2">
            <tr>
                <th>@if ($pelanggan_nama!==null){{ $pelanggan_nama }}@else{{ $pelanggan['nama'] }}@endif</th>
                <th>:</th>
                <td>@if ($alamat!==null)@foreach (json_decode($alamat['long'],true) as $long)<div>{{ $long }}</div>@endforeach @else-@endif</td>
            </tr>
            @if ($reseller!==null)
            <tr>
                <th>@if ($reseller_nama!==null){{ $reseller_nama }}@else{{ $reseller['nama'] }}@endif</th>
                <th>:</th>
                <td>@if ($alamat_reseller!==null)@foreach (json_decode($alamat_reseller['long'], true) as $long)<div>{{ $long }}</div>@endforeach @else-@endif</td>
            </tr>
            @endif
        </table>
    </div>

    <form action="{{ route('notaDetail_assignAlamatDB') }}" method="POST" class="mt-3 p-2 border border-2 rounded row">
        @csrf
        <div class="col">
            <span>Pilihan Alamat: <span class="fw-bold">@if ($pelanggan_nama!==null){{ $pelanggan_nama }}@else{{ $pelanggan['nama'] }}@endif</span></span>
            <div><input type="radio" name="alamat_pelanggan_id" id="alamat_pelanggan_id-none" value=""><label class="ms-2" for="alamat_pelanggan_id-none">None</label></div>
            @for ($i = 0; $i < count($alamat_avas); $i++)
            <div class="mt-2">
                <div class="d-flex align-items-center">
                    <input type="radio" name="alamat_pelanggan_id" id="alamat_pelanggan_id-{{ $i }}" value="{{ $alamat_avas[$i]['id'] }}">
                    <label class="ms-2 border rounded p-2" for="alamat_pelanggan_id-{{ $i }}">
                        @foreach (json_decode($alamat_avas[$i]['long'],true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach
                        <div class="fw-bold" style="color: gray">{{ $alamat_avas[$i]['short'] }}</div>
                    </label>
                </div>
            </div>
            @endfor
        </div>
        @if ($reseller!==null)
        <div class="col">
            Pilihan Alamat: <span class="fw-bold">@if ($reseller_nama!==null){{ $reseller_nama }}@else{{ $reseller['nama'] }}@endif</span>
            <div><input type="radio" name="alamat_reseller_id" id="alamat_reseller_id-none" value=""><label class="ms-2" for="alamat_reseller_id-none">None</label></div>
            @for ($i = 0; $i < count($alamat_reseller_avas); $i++)
            <div class="mt-2">
                <div class="d-flex align-items-center">
                    <input type="radio" name="alamat_reseller_id" id="alamat_reseller_id-{{ $i }}" value="{{ $alamat_reseller_avas[$i]['id'] }}">
                    <label class="ms-2 border rounded p-2" for="alamat_reseller_id-{{ $i }}">
                        @foreach (json_decode($alamat_reseller_avas[$i]['long'],true) as $long)
                        <div>{{ $long }}</div>
                        @endforeach
                        <div class="fw-bold" style="color: gray">{{ $alamat_reseller_avas[$i]['short'] }}</div>
                    </label>
                </div>
            </div>
            @endfor
        </div>
        @endif
        <div class="border rounded border-danger p-2 mt-3">
            Apakah alamat yang ditetapkan ini juga berlaku pada Sr. Jalan?
            <div><input type="radio" name="is_also_for_sj" id="is_also_for_sj-yes" value="yes" checked><label for="is_also_for_sj-yes" class="ms-2">Ya</label></div>
            <div><input type="radio" name="is_also_for_sj" id="is_also_for_sj-no" value="no"><label for="is_also_for_sj-no" class="ms-2">Tidak</label></div>
        </div>
        <input type="hidden" name="nota_id" value="{{ $nota['id'] }}">
        <div class="text-center mt-3"><button class="btn btn-warning">Tetapkan Alamat</button></div>
    </form>
</div>

<script>

function formValidation1() {
    var pilih_namas=document.querySelectorAll(".pilih_nama");
    var ada_terpilih='no';
    pilih_namas.forEach(pilih_nama => {
        if (pilih_nama.checked===true) {
            ada_terpilih='yes';
        }
    });

    if (ada_terpilih==='no') {
        document.getElementById('inv-pilih-nama').textContent='Salah satu nya harus dipilih terlebih dahulu!';
        $('#inv-pilih-nama').show();
        return false;
    } else {
        return true;
    }
    return false;
}

function validateNama() {
    var nama_baru=document.getElementById("nama_baru").value.trim();
    console.log(nama_baru);
    if (nama_baru==='') {
        return false;
    } else {
        return true;
    }
    return false;
}
</script>

<style>
    th,td{
        padding-right: 1rem;
    }
</style>
@endsection
