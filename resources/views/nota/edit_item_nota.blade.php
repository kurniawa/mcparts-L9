@extends('layouts.main_layout')

@section('content')

<div class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
</div>

<div class="grid-2-10_auto p-0_5em">
    <img class="w-2em" src="/img/icons/pencil.svg" alt="">
    <h2 class="">Edit Item Nota {{ $nota['no_nota'] }}</h2>
</div>

<table style="border-collapse:unset;border-spacing:0.5rem">
    <tr><th>Pelanggan</th><th>:</th><th>{{ $pelanggan['nama'] }}</th></tr>
    @if ($reseller !== null)
    <tr><td></td><td></td><td><span style="font-weight: bold">{{ $reseller['nama'] }}</span> sebagai Reseller untuk Nota ini</td></tr>
    @endif
    <tr><th>Tanggal</th><th>:</th><td>{{ date('d-m-Y', strtotime($nota['created_at'])) }}</td></tr>
</table>
<br>
<div class="m-0_5em">
    <p style="font-weight:bold;font-size:1.5rem">{{ $produk['nama_nota'] }}</p>
    <form action="/nota/edit-item-nota-DB" method="POST">
        @csrf
        <table>
            <tr><td>Jml. sudah Nota</td><td>:</td><td>{{ $spk_produk_nota['jumlah'] }}<input type='hidden' name='jumlah_sudah_nota' value={{ $spk_produk_nota['jumlah'] }}></td></tr>
            <tr><td>Jml. yang ada di Nota lain</td><td>:</td><td>{{ $jumlahYangAdaPadaNotaLain }}<input type='hidden' name='jumlah_yang_ada_pada_nota_lain' value={{ $jumlahYangAdaPadaNotaLain }}></td></tr>
            <tr><td>Jml. tersedia untuk diinput</td><td>:</td><td>{{ $spk_produk['jml_selesai'] - $spk_produk['jml_sdh_nota'] - $jumlahYangAdaPadaNotaLain }}<input type='hidden' name='jumlah_tersedia' value={{ $spk_produk['jml_selesai'] - $spk_produk['jml_sdh_nota'] }}></td></tr>
            <tr>
                <td>Jml. input</td>
                <td>:</td>
                <td>
                    <input type='number' name='jumlah_input' value='' class="form-control @error('jumlah_input') is-invalid @enderror" required>
                    @error('jumlah_input')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </td>
            </tr>
            <tr>
                <td>
                    <input type='hidden' name='nota_id' value={{ $nota['id'] }}>
                    <input type='hidden' name='spk_produk_nota_id' value={{ $spk_produk_nota['id'] }}>
                    <input type='hidden' name='spk_produk_id' value={{ $spk_produk['id'] }}>
                    <input type='hidden' name='produk_id' value={{ $produk['id'] }}>
                    <input type='hidden' name='jumlah_selesai' value={{ $spk_produk['jml_selesai'] }}>
                </td>
            </tr>
        </table>
        <br><br>
        <button class="btn btn-primary" type="submit">Konfirmasi Perubahan Jumlah</button>
    </form>
    <div style="height: 0.5rem;"></div>
    <form action="/nota/hapus-item-nota" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus item ini?');">
        @csrf
        <button class="btn btn-danger" type="submit">Hapus Item</button>
        <input type='hidden' name='nota_id' value={{ $nota['id'] }}>
        <input type='hidden' name='spk_produk_nota_id' value={{ $spk_produk_nota['id'] }}>
        <input type='hidden' name='spk_produk_id' value={{ $spk_produk['id'] }}>
        <input type='hidden' name='produk_id' value={{ $produk['id'] }}>
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
