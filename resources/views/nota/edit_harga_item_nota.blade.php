@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex mt-2">
        <img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt="">
        <h2 class="ms-2">Edit Harga Item Nota {{ $nota['no_nota'] }}</h2>
    </div>

    <table class="mt-2">
        <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
        @if ($reseller !== null)
        <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk Nota ini</td></tr>
        @endif
        <tr><th>Tanggal</th><th>:</th><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
    </table>
    <br>
    <p style="font-weight:bold;font-size:1.5rem">{{ $produk['nama_nota'] }}</p>
    <table>
        <tr><td>Harga Price List (terbaru)</td><td>:</td><td class="toFormatNumber">{{ $produk_harga_terbaru['harga'] }}</td></tr>
        <tr>
            <td>Harga Khusus Pelanggan Ini (terbaru)</td><td>:</td>
            @if ($harga_khusus_pelanggan_terbaru==null)
            <td>-</td>
            @else
            <td class="toFormatNumber">{{ $harga_khusus_pelanggan_terbaru }}</td>
            @endif
        </tr>
        <tr><td>Harga Tercantum Saat Ini</td><td>:</td><td class="toFormatNumber">{{ $spk_produk_nota['harga'] }}</td></tr>
    </table>
    <br>
    {{-- UBAH HARGA Berdasarkan Histori --}}
    <form action="{{ route('edit_harga_item_nota_pilih_dari_histori') }}" method="POST" class="border border-primary rounded border-2 p-2">
        <h4>Pengubahan Harga Berdasarkan Histori Harga</h4>
        <div class="row">
            <div class="col border-end border-success border-2 p-2">
                <h5>Harga Price List</h5>
                <table>
                    <tr><th>Tgl.</th><th>Harga</th><th></th></tr>
                    @foreach ($produk_hargas as $produk_harga)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($produk_harga['created_at'])) }}</td>
                        <td class="toFormatNumber">{{ $produk_harga['harga'] }}</td>
                        <td>
                            <input type="radio" name="data_harga" id="" value="['id'=>{{ $produk_harga['id'] }},'table'=>'produk_hargas','harga'=>{{ $produk_harga['harga'] }}]">
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
            <div class="col">
                <h5>Harga Khusus Pelanggan</h5>
                <table>
                    <tr><th>Tgl.</th><th>Harga</th><th></th></tr>
                    @foreach ($pelanggan_produk_hargas as $pelanggan_produk_harga)
                    <tr>
                        <td>{{ date('d-m-Y', strtotime($pelanggan_produk_harga['created_at'])) }}</td>
                        <td class="toFormatNumber">{{ $pelanggan_produk_harga['harga_khusus'] }}</td>
                        <td>
                            <input type="radio" name="data_harga" id="" value="['id'=>{{ $pelanggan_produk_harga['id'] }},'table'=>'pelanggan_produks','harga'=>{{ $pelanggan_produk_harga['harga_khusus'] }}]">
                        </td>
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="text-center mt-2">
            <input type='hidden' name='nota_id' value={{ $nota['id'] }}>
            <input type='hidden' name='spk_produk_nota_id' value={{ $spk_produk_nota['id'] }}>
            <input type='hidden' name='spk_produk_id' value={{ $spk_produk['id'] }}>
            <input type='hidden' name='produk_id' value={{ $produk['id'] }}>
            <input type='hidden' name='jumlah_selesai' value={{ $spk_produk['jml_selesai'] }}>
            <input type='hidden' name='pelanggan_id' value={{ $pelanggan['id'] }}>
            <input type='hidden' name='reseller_id' value={{ $reseller_id }}>
            <input type='hidden' name='harga_price_list' value={{ $produk_harga['harga'] }}>
            <button type="submit" class="btn btn-warning">Konfirmasi Ubah Harga</button>
        </div>
        @csrf
    </form>

    {{-- Input Harga Baru --}}
    <form class="border border-success rounded border-2 p-2" action="{{ route('edit_harga_item_nota_input_baru') }}" method="POST" onsubmit="return isInputNumberValid('harga_baru','invalid-feedback-harga-baru');">
        @csrf
        <h4>Input Harga Baru</h4>
        <table>
            <tr>
                <td>Harga Baru</td><td>:</td>
                <td>
                    <input id="harga_baru" type='number' name='harga_baru' class="form-control" required>
                    <div class="invalid-feedback" id="invalid-feedback-harga-baru"></div>
                </td>
            </tr>
            <tr>
                <td colspan="30">
                    Apakah Anda ingin menetapkan harga ini sebagai "harga khusus" pelanggan ini?<br>
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
        <div class="text-center">
            <button class="btn btn-warning" type="submit">Konfirmasi Ubah Harga</button>
        </div>
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
