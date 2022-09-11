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

{{-- PEMBUATAN NOTA --}}
<input type="hidden" id="jmlSls_spkProN" value={{ $spk_produk['jml_selesai'] }}>
<input type="hidden" id="spk_id" value={{ $spk['id'] }}>
<input type="hidden" id="produk_id" value={{ $produk['id'] }}>
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
                    <div class="invalid-feedback" id="invalid-feedback-n_t_spk-{{ $param['nota_id'] }}"></div>
                </div>
                <div class="text-end" id='ddIconNota-{{ $param['nota_id'] }}' onclick="showDD('#ddElNota-{{ $param['nota_id'] }}','#ddIconNota-{{ $param['nota_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElNota-{{ $param['nota_id'] }}' style="display: none">
                    <button class="btn btn-warning" onclick="newSPKProdukNota({{ $spk_produk['id'] }},{{ $param['nota_id'] }},'jml_nota-{{ $param['nota_id'] }}','invalid-feedback-n_t_spk-{{ $param['nota_id'] }}')">Konfirm</button>
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

{{-- PEMBUATAN SURAT JALAN --}}
<div class="container">
    <div class="row">
        @foreach ($params_sj as $param)
        <div class="col">
            @if ($param['spk_produk_id']===null)
            <div class="alert alert-danger">
                <div class="form-group">
                    <label for="jml_sj-{{ $param['srjalan_id'] }}" class="fw-bold">SJ-{{ $param['srjalan_id'] }}</label>
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
                    <small>( terkait item / N-{{ $param['nota_id'] }} ) </small>
                    <input type="number" class="form-control" name="jml_sj-{{ $param['srjalan_id'] }}" id="jml_sj-{{ $param['srjalan_id'] }}" value={{ $param['jumlah'] }}>
                </div>
                <div class="text-end" id='ddIconSJ-{{ $param['srjalan_id'] }}' onclick="showDD('#ddElSJ-{{ $param['srjalan_id'] }}','#ddIconSJ-{{ $param['srjalan_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElSJ-{{ $param['srjalan_id'] }}' style="display: none">
                    <button class="btn btn-danger" onclick="hapusSPKProdukNota({{ $param['spk_produk_nota_sj_id'] }})">Hapus</button>
                    <button class="btn btn-warning" onclick="editJmlSPKProdukNota({{ $param['spk_produk_nota_sj_id'] }},'jml_sj-{{ $param['srjalan_id'] }}')">Konfirm</button>
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
                @foreach ($params_nota as $param)
                @if ($param['spk_produk_id']==$spk_produk['id'])
                <div class="form-group mt-2">
                    <label for="jml_sj_new-{{ $param['nota_id'] }}">Jml. <span>(terkait N-{{ $param['nota_id'] }}) :</span></label>
                    <input type="number" class="form-control jml_sj_new" id="jml_sj_new-{{ $param['nota_id'] }}">
                    <div class="invalid-feedback invalid-feedback-sj"></div>
                    <input type="hidden" class="newN_notaID" value={{ $param['nota_id'] }}>
                    <input type="hidden" class="newN_spkProNoID" value={{ $param['spk_produk_nota_id'] }}>
                    <input type="hidden" class="newN_jmlSPKProNo" value={{ $param['jumlah'] }}>
                </div>
                @endif
                @endforeach
                @if (count($params_nota)!==0)
                <div class="text-end mt-2"><button class="btn btn-warning" id="btn-sj-baru">Konfirm</button></div>
                @endif
            </div>
        </div>
    </div>
</div>
<input type="hidden" id="jml_sdh_nota" value="{{ $spk_produk['jml_sdh_nota'] }}">
<br><br>
<div class="container">
    <div>
        <label for="">Opsi:</label><br>
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

    function newSPKProdukNota(spk_produk_id, nota_id, el_jumlah_id,div_invalid_id) {
        // console.log(spk_produk_id,nota_id,jumlah);
        var valid=isInputNumberValid(el_jumlah_id,div_invalid_id);
        if (valid==false) {
            return false;
        }
        // cek apakah input jumlah melebihi dari jumlah item yang selesai
        var el_jmlSls_spkProN=document.getElementById('jmlSls_spkProN');
        var jml_selesai=parseInt(el_jmlSls_spkProN.value);
        var jumlah=parseInt(document.getElementById(el_jumlah_id).value);
        var div_invalid=document.getElementById(div_invalid_id);

        if (jumlah>jml_selesai) {
            div_invalid.style.display='block';
            div_invalid.textContent='Input jumlah melebihi dari jumlah item yang sudah selesai produksi!';
            valid=false;
            return false;
        }

        // fungsi ajax
        if (valid) {
            $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'{{ route("newSpkProN_to_avaN") }}',
                data: {
                    spk_id:{{ $spk['id'] }},
                    spk_produk_id:{{ $spk_produk['id'] }},
                    produk_id:{{ $produk['id'] }},
                    jumlah:jumlah,
                    nota_id:nota_id,
                },
                success:function (res) {
                    console.log(res);
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                }
            });
        }

    }

    document.getElementById('btn-sj-baru').addEventListener('click', function (event) {
        var el_jumlahs=document.querySelectorAll('.jml_sj_new');
        var divs_invalid_feedback=document.querySelectorAll('.invalid-feedback-sj');
        var jumlahs=new Array();
        var valid=false;
        var i=0;
        // cek apakah ada input jumlah yang invalid
        el_jumlahs.forEach(el_jumlah => {
            if (isNaN(parseInt(el_jumlah.value))) {
                divs_invalid_feedback[i].style.display='block';
                divs_invalid_feedback[i].textContent='Format jumlah tidak tepat!';
                valid=false;return valid;
            } else {
                if (parseInt(el_jumlah.value)<=0) {
                    divs_invalid_feedback[i].style.display='block';
                    divs_invalid_feedback[i].textContent='jumlah harus lebih daripada 0!';
                    valid=false;return valid;
                }
                jumlahs.push(el_jumlah.value);
                valid=true;
            }
            i++;
        });
        console.log(jumlahs);

        // cek apakah ada input jumlah yang melebihi dari jumlah item yang sudah nota
        var jml_spkProdukNotas=document.querySelectorAll('.newN_jmlSPKProNo');
        var j=0;
        if (valid) {
            el_jumlahs.forEach(el_jumlah => {
                if (parseInt(el_jumlah.value)>parseInt(jml_spkProdukNotas[j].value)) {
                    divs_invalid_feedback[j].style.display='block';
                    divs_invalid_feedback[j].textContent='Input jumlah melebihi dari pada yang seharusnya tercantum di Nota!';
                    valid=false;return valid;
                }
                j++;
            });
        }

        // setelah cek validasi, maka sekarang tinggal fungsi ajax nya.
        var nota_ids=new Array;
        document.querySelectorAll('.newN_notaID').forEach( el_nota=>{nota_ids.push(el_nota.value)});
        var spk_produk_nota_ids=new Array;
        document.querySelectorAll('.newN_spkProNoID').forEach( el=>{spk_produk_nota_ids.push(el.value)});
        console.log(valid);
        if (valid) {
            $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'{{ route("SjItemBaru_DB") }}',
                data: {
                    spk_produk_id:"{{ $spk_produk['id'] }}",
                    jumlahs:jumlahs,
                    nota_ids:nota_ids,
                    spk_produk_nota_ids:spk_produk_nota_ids,
                },
                success:function (res) {
                    console.log(res);
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                }
            });
        }
        return event.preventDefault();
    });

    function showHide(toshow, tohide) {
        $(`#${toshow}`).show();
        $(`#${tohide}`).hide();
    }

    function isInputNumberValid(number_id,div_invalid_id) {
        var valid=false;
        var div_invalid=document.getElementById(div_invalid_id);
        var num_element=document.getElementById(number_id);
        // console.log(div_invalid_id);
        // console.log(div_invalid);
        if (isNaN(parseInt(num_element.value))) {
            div_invalid.style.display='block';
            div_invalid.textContent='Format jumlah tidak tepat!';
            valid=false;
        } else {
            if (parseInt(num_element.value)<=0) {
                div_invalid.style.display='block';
                div_invalid.textContent='jumlah harus lebih daripada 0!';
                valid=false;return valid;
            }
            valid=true;
        }
        return valid;
    }

</script>
@endsection
