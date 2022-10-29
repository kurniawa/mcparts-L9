@extends('layouts.main_layout')
@extends('layouts.navbar')

@section('content')

<div class="container mt-2">
    <div class="d-flex align-items-center">
        <img src="{{ asset('img/icons/pencil.svg') }}" alt="" style="width: 2rem">
        <span class="fs-3 ms-2">Tambah Komponen Produk: {{ $tipe }}</span>
    </div>
</div>

<div class="container mt-2">
    <form action="{{ route('tambahSpecDB') }}" method="POST">
        @csrf
        <label for="">Nama {{ $tipe }}</label>
        <input type="text" class="form-control">
        <input type="hidden" name="tipe" value="{{ $tipe }}">
        <button class="btn btn-warning mt-3">Tambah {{ $tipe }}</button>
    </form>
</div>

<script>

</script>

<style>

</style>
@endsection


