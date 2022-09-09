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
            <tr><th>Keterangan</th><td>:</td><td>{{ $spk_produk['ktrg'] }}</td></tr>
        </table>
    </div>
</div>

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
        @foreach ($params_nota as $param)
        <div class="col">
            @if ($param['spk_produk_id']===null)
            <div class="alert alert-warning">
                <div class="form-group">
                    <label for="jml_nota-{{ $param['nota_id'] }}" class="fw-bold">N-{{ $param['nota_id'] }}</label>
                    <small>( terkait SPK )</small>
                    <input type="number" class="form-control" name="jml_nota-{{ $param['nota_id'] }}" id="jml_nota-{{ $param['nota_id'] }}" value={{ $param['jumlah'] }}>
                </div>
                <div class="text-end" id='ddIconNota-{{ $param['nota_id'] }}' onclick="showDD('#ddElNota-{{ $param['nota_id'] }}','#ddIconNota-{{ $param['nota_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElNota-{{ $param['nota_id'] }}' style="display: none">
                    <button class="btn btn-warning" onclick="newSPKProdukNota({{ $param['spk_produk_id'] }},{{ $param['nota_id'] }},'jml_nota-{{ $param['nota_id'] }}')">Konfirm</button>
                </div>
            </div>
            @else
            <div class="alert alert-warning">
                <div class="form-group">
                    <label for="jml_nota-{{ $param['nota_id'] }}" class="fw-bold">N-{{ $param['nota_id'] }}</label>
                    <small>( terkait item )</small>
                    <input type="number" class="form-control" name="jml_nota-{{ $param['nota_id'] }}" id="jml_nota-{{ $param['nota_id'] }}" value={{ $param['jumlah'] }}>
                </div>
                <div class="text-end" id='ddIconNota-{{ $param['nota_id'] }}' onclick="showDD('#ddElNota-{{ $param['nota_id'] }}','#ddIconNota-{{ $param['nota_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElNota-{{ $param['nota_id'] }}' style="display: none">
                    <button class="btn btn-danger" onclick="hapusSPKProdukNota({{ $param['spk_produk_nota_id'] }})">Hapus</button>
                    <button class="btn btn-warning" onclick="editJmlSPKProdukNota({{ $param['spk_produk_nota_id'] }},'jml_nota-{{ $param['nota_id'] }}')">Konfirm</button>
                </div>
            </div>
            @endif
        </div>
        @endforeach
        <div class="col" id="opsi-nota_baru" style="display: none">
            <div class="alert alert-warning">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fw-bold" style="display: inline-block">Nota Baru</div>
                    <small class="btn fw-bold" style="color: red;" onclick="showHide('btn-nota_baru', 'opsi-nota_baru')">X</small>
                </div>
                <div class="form-group">
                    <label for="jml_nota_new">Jml. Nota Baru:</label>
                    <input type="number" class="form-control" name="jml_nota_new" id="jml_nota_new" value=>
                </div>
                <div class="text-end mt-2">
                    <button class="btn btn-warning" id="btn-nota-baru">Konfirm</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        @foreach ($params_sj as $param)
        <div class="col">
            @if ($param['spk_produk_id']===null)
            <div class="alert alert-danger">
                <div class="form-group">
                    <label for="jml_sj-{{ $param['srjalan_id'] }}" class="fw-bold">N-{{ $param['srjalan_id'] }}</label>
                    <small>( terkait SPK )</small>
                    <input type="number" class="form-control" name="jml_sj-{{ $param['srjalan_id'] }}" id="jml_sj-{{ $param['srjalan_id'] }}" value={{ $param['jumlah'] }}>
                </div>
                <div class="text-end" id='ddIconSJ-{{ $param['srjalan_id'] }}' onclick="showDD('#ddElSJ-{{ $param['srjalan_id'] }}','#ddIconSJ-{{ $param['srjalan_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElSJ-{{ $param['srjalan_id'] }}' style="display: none">
                    <button class="btn btn-warning" onclick="newSPKProdukNota({{ $param['spk_produk_id'] }},{{ $param['srjalan_id'] }},'jml_sj-{{ $param['srjalan_id'] }}')">Konfirm</button>
                </div>
            </div>
            @else
            <div class="alert alert-danger">
                <div class="form-group">
                    <label for="jml_sj-{{ $param['srjalan_id'] }}" class="fw-bold">SJ-{{ $param['srjalan_id'] }}</label>
                    <small>( terkait item )</small>
                    <input type="number" class="form-control" name="jml_sj-{{ $param['srjalan_id'] }}" id="jml_sj-{{ $param['srjalan_id'] }}" value={{ $param['jumlah'] }}>
                </div>
                <div class="text-end" id='ddIconSJ-{{ $param['srjalan_id'] }}' onclick="showDD('#ddElSJ-{{ $param['srjalan_id'] }}','#ddIconSJ-{{ $param['srjalan_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElSJ-{{ $param['srjalan_id'] }}' style="display: none">
                    <button class="btn btn-danger" onclick="hapusSPKProdukNota({{ $param['spk_produk_srjalan_id'] }})">Hapus</button>
                    <button class="btn btn-warning" onclick="editJmlSPKProdukNota({{ $param['spk_produk_srjalan_id'] }},'jml_sj-{{ $param['srjalan_id'] }}')">Konfirm</button>
                </div>
            </div>
            @endif
        </div>
        @endforeach
        <div class="col" id="opsi-sj_baru" style="display: none">
            <div class="alert alert-danger">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="fw-bold" style="display: inline-block">SJ Baru</div>
                    <small class="btn fw-bold" style="color: red;" onclick="showHide('btn-sj_baru', 'opsi-sj_baru')">X</small>
                </div>
                @foreach ($nota_ids_terkait_pelanggan_or_item as $nota_id)
                <div class="form-group mt-2">
                    <label for="jml_sj_new-{{ $nota_id }}">Jml. <span>(terkait N-{{ $nota_id }}) :</span></label>
                    <input type="number" class="form-control jml_sj_new" id="jml_sj_new-{{ $nota_id }}">
                    <div class="invalid-feedback invalid-feedback-sj"></div>
                    <input type="hidden" class="form-control nota_id" value={{ $nota_id }}>
                </div>
                @endforeach
                <div class="text-end mt-2">
                    <button class="btn btn-warning" id="btn-sj-baru">Konfirm</button>
                </div>
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="jml_sdh_nota" value="{{ $spk_produk['jml_sdh_nota'] }}">
<br><br>
<div class="container">
    <div>
        <label for="">Opsional:</label><br>
        <button type="button" class="btn btn-outline-info btn-sm" id="btn-nota_baru" onclick="showHide('opsi-nota_baru', this.id)">+N</button>
        <button type="button" class="btn btn-outline-info btn-sm" id="btn-sj_baru" onclick="showHide('opsi-sj_baru', this.id)">+SJ</button>
    </div>
</div>
<br><br>
<script>
    document.getElementById('btn-nota-baru').addEventListener('click', function (event) {
        var jml_nota_new=parseInt(document.getElementById('jml_nota_new').value);
        console.log(jml_nota_new);
        if (isNaN(jml_nota_new)) {
            console.log('is not a number');
            return event.preventDefault();
        } else {
            $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'{{ route("NotaItemBaru_DB") }}',
                data: {
                    spk_produk_id:"{{ $spk_produk['id'] }}",
                    jumlah:jml_nota_new,
                },
                success:function (result) {
                    console.log(result);
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                }
            });
        }
    });

    function editJmlSPKProdukNota(spk_produk_nota_id, jumlah) {
        console.log(spk_produk_nota_id, jumlah);
    }

    function hapusSPKProdukNota(spk_produk_nota_id) {
        console.log(spk_produk_nota_id);
    }

    function newSPKProdukNota(spk_produk_id, nota_id, jumlah) {
        console.log(spk_produk_id,nota_id,jumlah);
    }

    document.getElementById('btn-sj-baru').addEventListener('click', function (event) {
        var el_jumlahs=document.querySelectorAll('.jml_sj_new');
        var divs_invalid_feedback=document.querySelectorAll('.invalid-feedback-sj');
        var jumlahs=new Array();
        var i=0;
        el_jumlahs.forEach(el_jumlah => {
            if (isNaN(parseInt(el_jumlah.value))) {
                divs_invalid_feedback[i].style.display='block';
                divs_invalid_feedback[i].textContent='Format jumlah tidak tepat!';
                return false;
            } else {
                jumlahs.push(el_jumlah.value);
            }
            i++;
        });
        console.log(jumlahs);
        var jumlah_t=0;
        jumlahs.forEach(jumlah => {
            jumlah_t+=jumlah;
        });
        var jml_sdh_nota=document.getElementById('')
        if (jumlah_t<=) {

        }
        return event.preventDefault();
    });

    function showHide(toshow, tohide) {
        $(`#${toshow}`).show();
        $(`#${tohide}`).hide();
    }

</script>
@endsection
