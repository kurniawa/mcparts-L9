@extends('layouts.main_layout')

@section('content')

<div class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">

</div>

<div class="m-0_5em">
    <form action="/nota/edit-item-nota-DB" method="POST">
        <table>
            <tr><td>Jml. sudah Nota</td><td>:</td><td>{{ $spk_produk_nota['jumlah'] }}<input type='hidden' name='jumlah_sudah_nota' value={{ $spk_produk_nota['jumlah'] }} readonly></td></tr>
            <tr><td>Jml. ingin diinput</td><td>:</td><td><input type='number' name='jumlah_input' value=''></td></tr>
            <tr><td><input type='hidden' name='nota_id' value={{ $nota['id'] }}></td></tr>
        </table>
    </form>
</div>

<script>
    const pelanggan = {!! json_encode($pelanggan, JSON_HEX_TAG) !!};
    const reseller = {!! json_encode($reseller, JSON_HEX_TAG) !!};

    if (show_console === true) {
        console.log('pelanggan');console.log(pelanggan);
    }

</script>
@endsection
