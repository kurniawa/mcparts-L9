@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <h2>Tree: SPK - Nota - Sr. Jalan</h2>
    <div class="alert alert-primary">
        <table style="width: 100%">
            <tr><th>Nama</th><td>:</td><td>{{ $produk['nama'] }}</td></tr>
            <tr><th>Jumlah_t</th><td>:</td><td>{{ $spk_produk['jml_t'] }}</td></tr>
            <tr><th>Jml Sls</th><td>:</td><td>{{ $spk_produk['jml_selesai'] }}</td></tr>
            <tr><th>Jml Sudah Nota</th><td>:</td><td>{{ $spk_produk['jml_sdh_nota'] }}</td></tr>
            <tr><th>Jml Sudah SJ</th><td>:</td><td>{{ $spk_produk['jumlah_sudah_srjalan'] }}</td></tr>
            <tr><th>Keterangan</th><td>:</td><td>{{ $spk_produk['keterangan'] }}</td></tr>
        </table>
    </div>
</div>

{{-- PEMBUATAN NOTA --}}
{{-- PARAMETER --}}
<input type="hidden" id="jmlSls_spkProN" value={{ $spk_produk['jml_selesai'] }}>
<input type="hidden" id="spk_id" value={{ $spk['id'] }}>
<input type="hidden" id="produk_id" value={{ $produk['id'] }}>
<input type="hidden" id="spk_produk_id" value={{ $spk_produk['id'] }}>
<input type="hidden" id="jml_sdh_nota" value={{ $spk_produk['jml_sdh_nota'] }}>
<div class="container">
    <div class="row">
        <div class="col">
            <div class="alert alert-success">
                <div class="fw-bold">{{ $spk['no_spk'] }}</div>
                <div>Jml. Selesai:</div>
                <input type="number" class="form-control" name="jumlah" value={{ $spk_produk['jml_selesai'] }} readonly>
            </div>
        </div>
    </div>
    <div class="row">
        {{-- Level Nota 1: spk_produk_nota / Nota yang berkaitan langsung dengan spk ini --}}
        @foreach ($spk_produk_notas as $spk_produk_nota)
        @if ($spk_produk_nota['spk_produk_id']===$spk_produk['id'])
        <form action="{{ route('editJmlSpkPN') }}" method="POST" class="col">
            @csrf
            <div class="alert alert-warning">
                <div class="form-group">
                    <label for="jml_nota-{{ $spk_produk_nota['nota_id'] }}" class="fw-bold">N-{{ $spk_produk_nota['nota_id'] }}</label>
                    <small>( terkait item )</small>
                    <input type="number" name="jumlah" class="form-control" id="jml_nota-{{ $spk_produk_nota['nota_id'] }}" value={{ $spk_produk_nota['jumlah'] }}>
                    <input type="hidden" name="spk_produk_nota_id" value="{{ $spk_produk_nota['id'] }}">
                    <input type="hidden" name="nota_id" value="{{ $spk_produk_nota['nota_id'] }}">
                    <input type="hidden" name="spk_produk_id" value="{{ $spk_produk['id'] }}">
                </div>
                <div class="text-end" id='ddIconNota-{{ $spk_produk_nota['id'] }}' onclick="showDD('#ddElNota-{{ $spk_produk_nota['id'] }}','#ddIconNota-{{ $spk_produk_nota['id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElNota-{{ $spk_produk_nota['id'] }}' style="display: none">
                    <div class="d-flex justify-content-end">
                        <div><button class="btn btn-danger" type="submit" name="type" value="delete">Hapus</button></div>
                        <div class="ms-1"><button class="btn btn-warning" name="type" value="edit">Konfirm</button></div>
                    </div>
                </div>
            </div>
        </form>

        @else
        <form action="{{ route('editJmlSpkPN') }}" method="POST" class="col">
            @csrf
            <div class="alert alert-warning">
                <div class="form-group">
                    <label for="jml_nota-{{ $spk_produk_nota['nota_id'] }}" class="fw-bold">N-{{ $spk_produk_nota['nota_id'] }}</label>
                    <small>( terkait SPK )</small>
                    <input type="number" name="jumlah" class="form-control" id="jml_nota-{{ $spk_produk_nota['nota_id'] }}">
                    <input type="hidden" name="spk_produk_nota_id" value="">
                    <input type="hidden" name="nota_id" value="{{ $spk_produk_nota['nota_id'] }}">
                    <input type="hidden" name="spk_produk_id" value="{{ $spk_produk['id'] }}">
                </div>
                <div class="text-end" id='ddIconNota-{{ $spk_produk_nota['nota_id'] }}' onclick="showDD('#ddElNota-{{ $spk_produk_nota['nota_id'] }}','#ddIconNota-{{ $spk_produk_nota['nota_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElNota-{{ $spk_produk_nota['nota_id'] }}' style="display: none">
                    <div class="d-flex justify-content-end">
                        <div><button class="btn btn-danger" type="submit" name="type" value="delete">Hapus</button></div>
                        <div class="ms-1"><button class="btn btn-warning" name="type" value="edit">Konfirm</button></div>
                    </div>
                </div>
            </div>
        </form>
        @endif
        @endforeach
        {{-- NOTA BARU PISAN --}}
        <form action="{{ route('NotaItemBaru_DB') }}" method="POST" class="col" id="opsi-nota_baru" style="display: none">
            <div class="alert alert-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fw-bold" style="display: inline-block">Nota Baru</div>
                    <small class="btn fw-bold" style="color: red;" onclick="showHide('btn-nota_baru', 'opsi-nota_baru')">X</small>
                </div>
                <div class="form-group">
                    <label for="jml_nota_new">Jml. Nota Baru:</label>
                    <input type="number" class="form-control" name="jml_nota_new" id="jml_nota_new">
                    <div class="invalid-feedback" id="invalid-feedback-nota-baru"></div>
                </div>
                <div class="text-end mt-2">
                    <input type="hidden" name="spk_produk_id" value="{{ $spk_produk['id'] }}">
                    <button class="btn btn-warning" type="submit">Konfirm</button>
                </div>
            </div>
            @csrf
        </form>
    </div>
</div>

{{-- PEMBUATAN SURAT JALAN --}}
<div class="container">
    <div class="row">
        {{-- Level Sr. Jalan -> sr. jalan yang berkaitan langsung dengan spk ini --}}
        @foreach ($srjalan_terkait_spk as $sj_t_spk)
        <form action="{{ route('editJmlSpkPNSJ') }}" method="POST" class="col">
            @csrf
            <div class="alert alert-danger">
                <div class="form-group">
                    <label for="jml_sj-{{ $sj_t_spk['id'] }}" class="fw-bold">SJ-{{ $sj_t_spk['srjalan_id'] }}</label>
                    <small>( terkait SPK / N-{{ $sj_t_spk['nota_id'] }} ) </small>
                    <input type="number" class="form-control" name="jumlah" id="jml_sj-{{ $sj_t_spk['id'] }}">
                    <input type="hidden" name="spk_produk_nota_sj_id" value="">
                    <input type="hidden" name="nota_id" value="{{ $sj_t_spk['nota_id'] }}">
                    <input type="hidden" name="srjalan_id" value="{{ $sj_t_spk['srjalan_id'] }}">
                    <input type="hidden" name="spk_produk_id" value="{{ $spk_produk['id'] }}">
                </div>
                <div class="text-end" id='ddIconSJ-{{ $sj_t_spk['srjalan_id'] }}' onclick="showDD('#ddElSJ-{{ $sj_t_spk['srjalan_id'] }}','#ddIconSJ-{{ $sj_t_spk['srjalan_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElSJ-{{ $sj_t_spk['srjalan_id'] }}' style="display: none">
                    <div class="d-flex justify-content-end">
                        <div><button class="btn btn-danger" type="submit" name="submit" value="delete">Hapus</button></div>
                        <div class="ms-1"><button class="btn btn-warning" type="submit" name="submit" value="edit">Konfirm</button></div>
                    </div>
                </div>
            </div>
        </form>
        @endforeach

        @foreach ($srjalan_terkait_item as $sj_t_item)
        <form action="{{ route('editJmlSpkPNSJ') }}" method="POST" class="col">
            @csrf
            <div class="alert alert-danger">
                <div class="form-group">
                    <label for="jml_sj-{{ $sj_t_item['id'] }}" class="fw-bold">SJ-{{ $sj_t_item['srjalan_id'] }}</label>
                    <small>( terkait item / N-{{ $sj_t_item['nota_id'] }} ) </small>
                    <input type="number" class="form-control" name="jumlah" id="jml_sj-{{ $sj_t_item['id'] }}" value={{ $sj_t_item['jumlah'] }}>
                    <input type="hidden" name="spk_produk_nota_sj_id" value="{{ $sj_t_item['id'] }}">
                    <input type="hidden" name="nota_id" value="{{ $sj_t_item['nota_id'] }}">
                    <input type="hidden" name="srjalan_id" value="{{ $sj_t_item['srjalan_id'] }}">
                    <input type="hidden" name="spk_produk_id" value="{{ $spk_produk['id'] }}">
                </div>
                <div class="text-end" id='ddIconSJSpkPNSJ-{{ $sj_t_item['id'] }}' onclick="showDD('#ddElSpkPNSJ-{{ $sj_t_item['id'] }}','#ddIconSJ-{{ $sj_t_item['srjalan_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElSpkPNSJ-{{ $sj_t_item['id'] }}' style="display: none">
                    <div class="d-flex justify-content-end">
                        <div><button class="btn btn-danger" type="submit" name="submit" value="delete">Hapus</button></div>
                        <div class="ms-1"><button class="btn btn-warning" type="submit" name="submit" value="edit">Konfirm</button></div>
                    </div>
                </div>
            </div>
        </form>
        @endforeach
        {{-- SJ BARU PISAN --}}
        <form action="{{ route('SjItemBaru_DB') }}" method="POST" class="col" id="opsi-sj_baru" style="display: none">
            <div class="alert alert-danger">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fw-bold" style="display: inline-block">SJ Baru</div>
                    <small class="btn fw-bold" style="color: red;" onclick="showHide('btn-sj_baru', 'opsi-sj_baru')">X</small>
                </div>
                @foreach ($spk_produk_notas as $spk_produk_nota)
                <div class="form-group mt-2">
                    <label for="jml_sj_new-{{ $spk_produk_nota['nota_id'] }}">Jml. <span>(terkait N-{{ $spk_produk_nota['nota_id'] }}) :</span></label>
                    <input type="number" name="jumlahs[]" class="form-control jml_sj_new" id="jml_sj_new-{{ $spk_produk_nota['nota_id'] }}">
                    <input type="hidden" name="nota_ids[]" class="newN_notaID" value={{ $spk_produk_nota['nota_id'] }}>
                    <input type="hidden" name="spk_produk_nota_ids[]" class="newN_spkProNoID" value={{ $spk_produk_nota['id'] }}>
                    <input type="hidden" class="newN_jmlSPKProNo" value={{ $spk_produk_nota['jumlah'] }}>
                </div>
                @endforeach
                @if (count($spk_produk_notas)!==0)
                <input type="hidden" name="spk_produk_id" value="{{ $spk_produk['id'] }}">
                <div class="text-end mt-2"><button class="btn btn-warning" id="btn-sj-baru">Konfirm</button></div>
                @endif
            </div>
            @csrf
        </form>
    </div>
</div>

<div class="container"><div class="alert alert-danger" id="invalid-feedback-main" style="display: none"><span class="fw-bold">Warning</span></div></div>

@if (session()->has('error'))
<div class="container alert alert-danger mt-2">
    {{ session('error') }}
</div>
@endif
@if (session()->has('success'))
<div class="container alert alert-success mt-2">
    {{ session('success') }}
</div>
@endif

<div class="container mt-3">
    <div>
        <label for="">Opsi:</label><br>
        <button type="button" class="btn btn-outline-info btn-sm" id="btn-nota_baru" onclick="showHide('opsi-nota_baru', this.id)">+N</button>
        <button type="button" class="btn btn-outline-info btn-sm" id="btn-sj_baru" onclick="showHide('opsi-sj_baru', this.id)">+SJ</button>
    </div>
</div>
<br><br>
<script>
    function showHide(toshow, tohide) {
        $(`#${toshow}`).show();
        $(`#${tohide}`).hide();
    }
</script>
@endsection
