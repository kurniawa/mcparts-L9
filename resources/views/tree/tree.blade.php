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
            <tr><th>Keterangan</th><td>:</td><td>{{ $spk_produk['ktrg'] }}</td></tr>
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
                    <button class="btn btn-warning" onclick="newSPKProdukNota({{ $param['nota_id'] }},'jml_nota-{{ $param['nota_id'] }}','invalid-feedback-n_t_spk-{{ $param['nota_id'] }}')">Konfirm</button>
                </div>
            </div>
            @else
            <div class="alert alert-warning">
                <div class="form-group">
                    <label for="jml_nota-{{ $param['nota_id'] }}" class="fw-bold">N-{{ $param['nota_id'] }}</label>
                    <small>( terkait item )</small>
                    <input type="number" class="form-control" id="jml_nota-{{ $param['nota_id'] }}" value={{ $param['jumlah'] }}>
                    <div class="invalid-feedback" id="invalid-feedback-nota_terkait_item-{{ $param['nota_id'] }}"></div>
                </div>
                <div class="text-end" id='ddIconNota-{{ $param['nota_id'] }}' onclick="showDD('#ddElNota-{{ $param['nota_id'] }}','#ddIconNota-{{ $param['nota_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElNota-{{ $param['nota_id'] }}' style="display: none">
                    <button class="btn btn-danger" onclick="hapusSPKProdukNota({{ $param['spk_produk_nota_id'] }},'invalid-feedback-nota_terkait_item-{{ $param['nota_id'] }}')">Hapus</button>
                    <button class="btn btn-warning" onclick="editJmlSPKProdukNota({{ $param['nota_id'] }},{{ $param['spk_produk_nota_id'] }},'jml_nota-{{ $param['nota_id'] }}','{{ $param['jumlah'] }}','invalid-feedback-nota_terkait_item-{{ $param['nota_id'] }}','spk_produk_nota_id-{{ $param['nota_id'] }}')">Konfirm</button>
                </div>
            </div>
            @endif
        </div>
        @endforeach
        {{-- NOTA BARU PISAN --}}
        <div class="col" id="opsi-nota_baru" style="display: none">
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
                    <button class="btn btn-warning" onclick="newSPKProdukNotaSJ({{ $param['nota_id'] }},{{ $param['spk_produk_id'] }},{{ $param['srjalan_id'] }},'jml_sj-{{ $param['srjalan_id'] }}')">Konfirm</button>
                </div>
            </div>
            @else
            <div class="alert alert-danger">
                <div class="form-group">
                    <label for="jml_sj-{{ $param['srjalan_id'] }}" class="fw-bold">SJ-{{ $param['srjalan_id'] }}</label>
                    <small>( terkait item / N-{{ $param['nota_id'] }} ) </small>
                    <input type="number" class="form-control" name="jml_sj-{{ $param['srjalan_id'] }}" id="jml_sj-{{ $param['srjalan_id'] }}" value={{ $param['jumlah'] }}>
                    <div class="invalid-feedback" id="invalid-feedback-edit_spk_produk_nota_sj-{{ $param['srjalan_id'] }}"></div>
                </div>
                <div class="text-end" id='ddIconSJ-{{ $param['srjalan_id'] }}' onclick="showDD('#ddElSJ-{{ $param['srjalan_id'] }}','#ddIconSJ-{{ $param['srjalan_id'] }}');"><small>Edit</small> <img class="w-0_7rem" src="{{ asset('img/icons/dropdown.svg') }}" alt=""></div>
                <div class="text-end mt-2" id='ddElSJ-{{ $param['srjalan_id'] }}' style="display: none">
                    <button class="btn btn-danger" onclick="hapusSPKProdukNotaSJ({{ $param['spk_produk_nota_sj_id'] }})">Hapus</button>
                    <button class="btn btn-warning" onclick="editJmlSPKProdukNotaSJ({{ $param['nota_id'] }},{{ $param['srjalan_id'] }},{{ $param['spk_produk_nota_sj_id'] }},'jml_sj-{{ $param['srjalan_id'] }}',{{ $param['jumlah'] }},'invalid-feedback-edit_spk_produk_nota_sj-{{ $param['srjalan_id'] }}')">Konfirm</button>
                </div>
            </div>
            @endif
        </div>
        @endforeach
        {{-- SJ BARU PISAN --}}
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

<div class="container"><div class="alert alert-danger" id="invalid-feedback-main" style="display: none"><span class="fw-bold">Warning</span></div></div>

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
    const params_nota={!! json_encode($params_nota, JSON_HEX_TAG) !!};
    const params_sj={!! json_encode($params_sj, JSON_HEX_TAG) !!};
    const spk_produk={!! json_encode($spk_produk, JSON_HEX_TAG) !!};
    const spk_produk_nota_sjs_terkait_item={!! json_encode($spk_produk_nota_sjs_terkait_item, JSON_HEX_TAG) !!};
    const spk_produk_notas_terkait_item={!! json_encode($spk_produk_notas_terkait_item, JSON_HEX_TAG) !!};
    // console.log(spk_produk);
    document.getElementById('btn-nota-baru').addEventListener('click', function (event) {
        var jml_nota_new=parseInt(document.getElementById('jml_nota_new').value);
        // console.log(jml_nota_new);
        // cek apakah angka nya valid
        var valid=isInputNumberValid('jml_nota_new','invalid-feedback-nota-baru'); // return true apabila valid
        // cek apakah jumlah yang diinput melebihi jumlah sudah nota
        const jumlah_valid=spk_produk['jml_selesai']-spk_produk['jml_sdh_nota'];
        console.log(jumlah_valid);
        var div_invalid=document.getElementById('invalid-feedback-nota-baru');
        if (jml_nota_new>jumlah_valid) {
            div_invalid.style.display='block';
            div_invalid.textContent='Input jumlah melebihi jumlah item yang dapat diinput ke nota!';
            valid=false;return false;
        }

        if (valid) {
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

    function editJmlSPKProdukNota(nota_id,spk_produk_nota_id, el_jumlah_id, jml_spk_produk_nota,div_invalid_id) {
        // console.log(spk_produk_nota_id, el_jumlah_id);
        const jumlah=parseInt(document.getElementById(el_jumlah_id).value);
        const jml_spk_produk_nota_awal=parseInt(jml_spk_produk_nota);
        var div_invalid=document.getElementById(div_invalid_id);
        var div_invalid_main=document.getElementById('invalid-feedback-main');
        // cek apakah angka nya valid
        var valid=isInputNumberValid(el_jumlah_id,div_invalid_id); // return true apabila valid
        // cek apabila semisal item ini sudah sempat diinput ke nota lain, maka kita perlu tau jml_selesai, jml_sdh_nota dan jml_spk_produk_nota_awal nya
        // untuk menentukan jumlah valid/maks yang boleh diinput.
        const jumlah_valid=spk_produk['jml_selesai']-(spk_produk['jml_sdh_nota']-jml_spk_produk_nota_awal);
        console.log(jumlah_valid);
        if (jumlah>jumlah_valid) {
            div_invalid.style.display='block';
            div_invalid.textContent='Input jumlah melebihi jumlah item yang dapat diinput ke nota!';
            div_invalid_main.style.display='block';
            div_invalid_main='Input jumlah melebihi jumlah item yang dapat diinput ke nota! (Berdasarkan perhitungan jml_selesai-(jml_sdh_nota-jml_spk_produk_nota_awal))'
            valid=false;
            return false;
        }
        /*
        cek tingkat lanjut: Kita juga perlu tau apakah item_nota ini sudah sempat diinput ke srjalan, kalau sudah, maka kita perlu tau,
        ada berapa jumlah yang sudah diinput ke srjalan. Apakah update/edit jumlah ini memadai. Kalau tidak maka perlu penghapusan
        item yang ada di surat jalan terlebih dahulu.
        */
        var jml_sdh_sj=0;
        for (let i = 0; i < params_sj.length; i++) {
            if (params_sj[i]['spk_produk_nota_id']==spk_produk_nota_id) {
                jml_sdh_sj+=params_sj[i]['jumlah'];
            }
        }
        console.log('jml_sdh_sj:',jml_sdh_sj);
        if (jumlah<jml_sdh_sj) {
            div_invalid.style.display='block';
            div_invalid.textContent='Input jumlah tidak sesuai!';
            div_invalid_main.style.display='block';
            div_invalid_main.textContent='Input jumlah tidak sesuai! (Berdasarkan perhitungan, bahwa item ini ternyata sudah sempat diinput ke surat jalan, jadi jumlah yang di edit harus disesuaikan dengan jumlah yang sudah surat jalan)';
            valid=false;
            return false;
        }
        if (valid) {
            $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'{{ route("editJmlSpkPN") }}',
                data: {
                    spk_id:{{ $spk['id'] }},
                    spk_produk_id:{{ $spk_produk['id'] }},
                    produk_id:{{ $produk['id'] }},
                    spk_produk_nota_id:spk_produk_nota_id,
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

    function hapusSPKProdukNota(spk_produk_nota_id, div_invalid_id) {
        console.log(spk_produk_nota_id);
        var valid=false;
        var div_invalid=document.getElementById(div_invalid_id);
        var div_invalid_main=document.getElementById('invalid-feedback-main');
        /*
        cek tingkat lanjut: Kita juga perlu tau apakah item_nota ini sudah sempat diinput ke srjalan, kalau sudah, maka kita dapat menghapus nota
        spk_produk_nota ini
        */
        var jml_sdh_sj=0;
        for (let i = 0; i < params_sj.length; i++) {
            if (params_sj[i]['spk_produk_nota_id']==spk_produk_nota_id) {
                jml_sdh_sj+=params_sj[i]['jumlah'];
            }
        }
        console.log('jml_sdh_sj:',jml_sdh_sj);
        if (jml_sdh_sj!==0) {
            div_invalid.style.display='block';
            div_invalid.textContent='spk_produk_nota_ini sudah memiliki surat_jalan terkait!';
            div_invalid_main.style.display='block';
            div_invalid_main.textContent='spk_produk_nota_ini sudah memiliki surat_jalan terkait! Oleh karena itu tidak dapat menghapus spk_produk_nota ini!';
            valid=false;
            return false;
        }
        var confirm_delete=confirm('Anda yakin ingin menghapus item di nota ini?');
        console.log(confirm_delete);
        if (confirm_delete) {
            $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'{{ route("delSpkPN") }}',
                data: {
                    spk_produk_nota_id:spk_produk_nota_id,
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

    function newSPKProdukNota(nota_id,el_jumlah_id,div_invalid_id) {
        // console.log(div_invalid_id);
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

        // cek apakah input jumlah melebihi dari jumlah spk_produk sdh_nota
        var jml_sdh_nota=parseInt(document.getElementById('jml_sdh_nota').value);
        var jml_blm_nota=jml_selesai-jml_sdh_nota;
        console.log(jml_blm_nota);
        if (jumlah>jml_blm_nota) {
            div_invalid.style.display='block';
            div_invalid.textContent='Input jumlah melebihi dari jumlah item yang belum terinput ke dalam nota!';
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

        // cek apakah ada input jumlah yang invalid sekaligus apakah ada jumlah yang valid
        // cari mana index yang valid yang bisa di proses, mana index yang invalid yang tidak perlu di proses.
        var i_ready=new Array();
        for (let i = 0; i < el_jumlahs.length; i++) {
            if (isNaN(parseInt(el_jumlahs[i].value))) {
                divs_invalid_feedback[i].style.display='block';
                divs_invalid_feedback[i].textContent='Format jumlah tidak tepat!';
            } else {
                i_ready.push(i);
            }
        }
        if (i_ready.length==0) {
            return false;
        }

        var i_ready2=new Array()
        for (let j = 0; j < i_ready.length; j++) {
            if (parseInt(el_jumlahs[i_ready[j]].value)<=0) {
                divs_invalid_feedback[i_ready[j]].style.display='block';
                divs_invalid_feedback[i_ready[j]].textContent='jumlah harus lebih daripada 0!';
            } else {
                i_ready2.push(j);
            }
        }
        if (i_ready2.length==0) {
            return false;
        }

        // cek apakah ada input jumlah yang melebihi dari jumlah item yang sudah nota
        var i_ready3=new Array();
        var jml_spkProdukNotas=document.querySelectorAll('.newN_jmlSPKProNo');
        for (let k = 0; k < i_ready2.length; k++) {
            if (parseInt(el_jumlahs[i_ready2[k]].value)>parseInt(jml_spkProdukNotas[i_ready2[k]].value)) {
                divs_invalid_feedback[i_ready2[k]].style.display='block';
                divs_invalid_feedback[i_ready2[k]].textContent='Input jumlah melebihi dari pada yang seharusnya tercantum di Nota!';
            } else {
                i_ready3.push(i_ready[k]);
            }
        }
        console.log('i_ready3',i_ready3);
        if (i_ready3.length==0) {
            return false;
        }

        // setelah cek validasi, cari nota_id dan spk_produk_nota_id yang berkaitan.
        var el_notas=document.querySelectorAll('.newN_notaID');
        var el_spkPN=document.querySelectorAll('.newN_spkProNoID');
        var nota_ids=new Array();var spk_produk_nota_ids=new Array();var jumlahs_valid=new Array();
        var jml_sdh_notas=new Array();var index_ready=new Array();
        // console.log(i_ready3);
        for (let l = 0; l < i_ready3.length; l++) {
            // console.log(el_notas[i_ready3[l]]);
            // console.log(el_notas[i_ready3[l]].value);
            nota_ids.push(el_notas[i_ready3[l]].value);
            spk_produk_nota_ids.push(el_spkPN[i_ready3[l]].value);
            jumlahs_valid.push(parseInt(el_jumlahs[i_ready3[l]].value));
            jml_sdh_notas.push(parseInt(jml_spkProdukNotas[i_ready3[l]].value));
            index_ready.push(i_ready3[l]);
        }
        console.log('nota_ids');console.log(nota_ids);
        console.log('spk_produk_nota_sjs_terkait_item');console.log(spk_produk_nota_sjs_terkait_item);

        // cek apakah item ini sempat di input ke surat jalan lain, apakah masih ada sisa nya yang belum diinput ke surat jalan, dan apakah jumlah input nya sesuai dengan jumlah sisanya?
        var i_ready4=new Array();
        for (let m = 0; m < spk_produk_nota_ids.length; m++) {
            if (spk_produk_nota_sjs_terkait_item.length!==0) {
                spk_produk_nota_sjs_terkait_item.forEach(spk_pro_no_sj => {
                    if (spk_pro_no_sj['spk_produk_nota_id']==spk_produk_nota_ids[m]) {
                        var jml_blm_sj=jml_sdh_notas[m]-spk_pro_no_sj['jumlah'];
                        console.log('jml_blm_sj dari nota:',nota_ids[m],' -> ',jml_blm_sj)
                        if (jumlahs_valid[m]>jml_blm_sj) {
                            divs_invalid_feedback[index_ready[m]].style.display='block';
                            divs_invalid_feedback[index_ready[m]].textContent='jumlah sudah melebihi dari jumlah yang belum diinput ke surat jalan!';
                        } else {
                            i_ready4.push(index_ready[m]);
                        }
                    }
                });
            } else {
                // belum ada surat jalan sama sekali yang terkait item ini
                i_ready4.push(index_ready[m]);
            }
        }
        console.log('i_ready4',i_ready4);
        if (i_ready4.length==0) {
            return false;
        }

        // setelah itu, baru jalankan fungsi ajax nya.
        $.ajax({
            type:'POST',
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            url:'{{ route("SjItemBaru_DB") }}',
            data: {
                spk_produk_id:{{ $spk_produk['id'] }},
                jumlahs:jumlahs_valid,
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

        return true;
    });

    // SURAT JALAN

    function editJmlSPKProdukNotaSJ(nota_id,sj_id,spk_produk_nota_sj_id,el_jumlah_id,jml_spk_produk_nota_sj_awal,div_invalid_id) {
        const jumlah=parseInt(document.getElementById(el_jumlah_id).value);
        var div_invalid=document.getElementById(div_invalid_id);
        // cek apakah angka nya valid
        var valid=isInputNumberValid(el_jumlah_id,div_invalid_id); // return true apabila valid
        if (valid===false) {
            return false;
        }
        // cek apakah jumlah spk_produk_nota yang berkaitan, untuk menentukan berapa jumlah maksimal yang boleh diinput
        var jml_spk_p_n=null;
        spk_produk_notas_terkait_item.forEach(spk_p_n => {
            if (nota_id==spk_p_n['nota_id']) {
                jml_spk_p_n=spk_p_n['jumlah'];
            }
        });
        console.log('jml_spk_p_n:',jml_spk_p_n);
        // cari jumlah yang sudah sempat diinput ke surat_jalan, selain dari pada surat jalan ini
        var jml_item_terkait_di_sj_all=0;
        var jml_item_terkait_di_sj_lain=0;
        spk_produk_nota_sjs_terkait_item.forEach(spk_p_n_sj => {
            if (spk_p_n_sj['srjalan_id']==sj_id) {
                jml_item_terkait_di_sj_all+=spk_p_n_sj['jumlah'];
            } else {
                jml_item_terkait_di_sj_lain+=spk_p_n_sj['jumlah'];
            }
        });
        var jml_maks=jml_spk_p_n-jml_item_terkait_di_sj_lain;
        console.log('jml_item_terkait_di_sj_all:',jml_item_terkait_di_sj_all);
        console.log('jml_item_terkait_di_sj_lain:',jml_item_terkait_di_sj_lain);
        console.log('jml_spk_produk_nota_sj_awal:',jml_spk_produk_nota_sj_awal);
        console.log('jml_maks:',jml_maks);

        if (jumlah>jml_maks) {
            div_invalid.style.display='block';
            div_invalid.textContent='Input jumlah melebihi jumlah item yang dapat diinput ke nota!';
            valid=false;
            return false;
        }
        console.log('valid:',valid);

        if (valid) {
            $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'{{ route("editJmlSpkPNSJ") }}',
                data: {
                    spk_id:{{ $spk['id'] }},
                    spk_produk_id:{{ $spk_produk['id'] }},
                    produk_id:{{ $produk['id'] }},
                    spk_produk_nota_sj_id:spk_produk_nota_sj_id,
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
        // testing get url: http://127.0.0.1:8000/sj/editJmlSpkPNSJ?spk_produk_id=2&spk_produk_nota_sj_id=11&jumlah=40
    }

    function hapusSPKProdukNotaSJ(spk_produk_nota_sj_id) {
        console.log(spk_produk_nota_sj_id);
        var confirm_delete=confirm('Anda yakin ingin menghapus item di Surat Jalan ini?');
        console.log(confirm_delete);
        if (confirm_delete) {
            $.ajax({
                type:'POST',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                url:'{{ route("delSpkPNSJ") }}',
                data: {
                    spk_produk_nota_sj_id:spk_produk_nota_sj_id,
                    spk_produk_id:spk_produk['id'],
                },
                success:function (res) {
                    console.log(res);
                    setTimeout(() => {
                        location.reload();
                    }, 500);
                }
            });
        }

        // testing $get: http://127.0.0.1:8000/sj/delSpkPNSJ?spk_produk_nota_sj_id=13&spk_produk_id=2
    }

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
