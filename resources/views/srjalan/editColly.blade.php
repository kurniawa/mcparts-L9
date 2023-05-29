@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex mt-2">
        <img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt="">
        <h2 class="ms-2">Edit Colly/Dus Surat Jalan {{ $srjalan['no_srjalan'] }}</h2>
    </div>

    <table class="mt-2">
        <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
        @if ($reseller !== null)
        <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk Nota ini</td></tr>
        @endif
        <tr><th>Tanggal Sr.Jalan</th><th>:</th><td>{{ date('d-m-Y', strtotime($srjalan['created_at'])) }}</td></tr>
        <tr><th>Jml. Colly (sistem)</th><th>:</th><td>{{ $jml_colly_sys }}</td></tr>
        <tr><th>Jml. Dus (sistem)</th><th>:</th><td>{{ $jml_dus_sys }}</td></tr>
        <tr>
            <th>Jml. Colly (asli)</th><th>:</th>
            @if ($srjalan['jml_colly']!==null)
            <td>{{ $srjalan['jml_colly'] }}</td>
            @else
            <td>-</td>
            @endif
        </tr>
        <tr>
            <th>Jml. Dus (asli)</th><th>:</th>
            @if ($srjalan['jml_dus']!==null)
            <td>{{ $srjalan['jml_dus'] }}</td>
            @else
            <td>-</td>
            @endif
        </tr>
    </table>
    <br>

    {{-- Input Jumlah Colly / Dus --}}
    <form class="border border-success rounded border-2 p-2" action="{{ route('editCollyDB') }}" method="POST" onsubmit="return formValidation();">
        @csrf
        <h4>Input Jumlah Packing Asli</h4>
        <table>
            <tr>
                <td>Jml. Colly</td><td>:</td>
                <td>
                    <input id="jml_colly" type='text' name='jml_colly' class="form-control" value="{{ $srjalan['jml_colly'] }}">
                    <div class="invalid-feedback" id="invalid-feedback-jml-colly"></div>
                </td>
            </tr>
            <tr>
                <td>Jml. Dus</td><td>:</td>
                <td>
                    <input id="jml_dus" type='text' name='jml_dus' class="form-control" value="{{ $srjalan['jml_dus'] }}">
                    <div class="invalid-feedback" id="invalid-feedback-jml-dus"></div>
                </td>
            </tr>
            <tr>
                <td>Jml. Rol</td><td>:</td>
                <td>
                    <input id="jml_rol" type='number' name='jml_rol' class="form-control" value="{{ $srjalan['jml_rol'] }}">
                    <div class="invalid-feedback" id="invalid-feedback-jml-rol"></div>
                </td>
            </tr>

            <tr>
                <td>
                    <input type='hidden' name='srjalan_id' value={{ $srjalan['id'] }}>
                </td>
            </tr>
        </table>
        <div class="text-center">
            <button class="btn btn-warning" type="submit">Konfirmasi Jml.Packing Asli</button>
        </div>
    </form>
</div>

<script>

function formValidation() {
    var valid_1=isInputNumberValid('jml_colly', 'invalid-feedback-jml-colly');
    var valid_2=isInputNumberValid('jml_dus', 'invalid-feedback-jml-dus');
    var valid_3=isInputNumberValid('jml_rol', 'invalid-feedback-jml-rol');

    if (valid_1==false && valid_2==false && valid_3 === false) {
        return false;
    }

    return true;
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

<style>
    th,td{
        padding-right: 1rem;
    }
</style>
@endsection
