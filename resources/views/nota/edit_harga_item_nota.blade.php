@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="grid-2-10_auto p-0_5rem">
        <img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt="">
        <h2 class="">Edit Harga Item Nota {{ $nota['no_nota'] }}</h2>
    </div>

    <table>
        <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
        @if ($reseller !== null)
        <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk Nota ini</td></tr>
        @endif
        <tr><th>Tanggal</th><th>:</th><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
    </table>
    <br>
    <p style="font-weight:bold;font-size:1.5rem">{{ $produk['nama_nota'] }}</p>
    <form action="{{ route('edit_harga_item_nota_db') }}" method="POST" onsubmit="return isInputNumberValid('harga_baru','invalid-feedback-harga-baru');">
        @csrf
        <table>
            <tr><td>Harga Price List</td><td>:</td><td class="toFormatNumber">{{ $produk_harga['harga'] }}</td></tr>
            <tr>
                <td>Harga Khusus Pelanggan Ini</td><td>:</td>
                @if ($harga_khusus_pelanggan==null)
                <td>-</td>
                @else
                <td class="toFormatNumber">{{ $harga_khusus_pelanggan }}</td>
                @endif
            </tr>
            <tr><td>Harga Tercantum Saat Ini</td><td>:</td><td class="toFormatNumber">{{ $spk_produk_nota['harga'] }}</td></tr>
            <tr>
                <td>Harga Baru</td><td>:</td>
                <td>
                    <input id="harga_baru" type='number' name='harga_baru' class="form-control" required>
                    <div class="invalid-feedback" id="invalid-feedback-harga-baru"></div>
                </td>
            </tr>
            <tr>
                <td colspan="30">
                    Apakah Anda ingin menetapkan harga ini sebagai harga khusus pelanggan ini?<br>
                    <div class="form-check">
                        <input type="radio" name="saveAsHargaKhusus" id="radioSimpanYa" value="yes" class="form-check-input"><label for="radioSimpanYa" class="form-check-label">Ya</label>
                    </div>
                    <div class="form-check">
                        <input type="radio" name="saveAsHargaKhusus" id="radioSimpanNo" value="no" class="form-check-input"><label for="radioSimpanNo" class="form-check-label">Tidak</label>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <input type='hidden' name='nota_id' value={{ $nota['id'] }}>
                    <input type='hidden' name='spk_produk_nota_id' value={{ $spk_produk_nota['id'] }}>
                    <input type='hidden' name='spk_produk_id' value={{ $spk_produk['id'] }}>
                    <input type='hidden' name='produk_id' value={{ $produk['id'] }}>
                    <input type='hidden' name='jumlah_selesai' value={{ $spk_produk['jml_selesai'] }}>
                    <input type='hidden' name='pelanggan_id' value={{ $pelanggan['id'] }}>
                    <input type='hidden' name='reseller_id' value={{ $reseller_id }}>
                    <input type='hidden' name='harga_price_list' value={{ $produk_harga['harga'] }}>
                </td>
            </tr>
        </table>
        <br><br>
        <button class="btn btn-warning" type="submit">Konfirmasi Ubah Harga</button>
    </form>
</div>

<script>

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
    td{
        padding-right: 1rem;
    }
</style>
@endsection
