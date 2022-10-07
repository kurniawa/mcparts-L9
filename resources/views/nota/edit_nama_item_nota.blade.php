@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container">
    <div class="d-flex mt-2">
        <img class="w-2rem" src="{{ asset('img/icons/pencil.svg') }}" alt="">
        <h2 class="ms-2">Edit Nama Item Nota {{ $nota['no_nota'] }}</h2>
    </div>

    <table class="mt-2">
        <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
        @if ($reseller !== null)
        <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk Nota ini</td></tr>
        @endif
        <tr><th>Tanggal Nota</th><th>:</th><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
        <tr><th>Nama Item Nota (normal)</th><th>:</th><td>{{ $produk['nama_nota'] }}</td></tr>
        <tr><th>Nama Item Nota (khusus pelanggan ini)</th><th>:</th><td>{{ $namanota_khusus_pelanggan }}</td></tr>
        <tr><th>Nama Item Nota (saat ini)</th><th>:</th><td>{{ $namanota_now }}</td></tr>
    </table>
    <br>

    {{-- Input Nama Baru --}}
    <form class="border border-success rounded border-2 p-2" action="{{ route('edit_nama_item_nota_db') }}" method="POST">
        @csrf
        <h4>Input Nama Nota Item</h4>
        <table>
            <tr>
                <td>Nama Nota Item</td><td>:</td>
                <td>
                    <input id="nama_baru" type='number' name='nama_baru' class="form-control" required>
                    <div class="invalid-feedback" id="invalid-feedback-nama-baru"></div>
                </td>
            </tr>
            <tr>
                <td colspan="3" class="alert alert-primary">Nama ini akan ditetapkan menjadi harga khusus untuk pelanggan ini.</td>
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
                </td>
            </tr>
        </table>
        <div class="text-center">
            <button class="btn btn-warning" type="submit">Konfirmasi Ubah Nama</button>
        </div>
    </form>
</div>

<script>

</script>

<style>
    th,td{
        padding-right: 1rem;
    }
</style>
@endsection
