@extends('layouts/main_layout')

@section('content')


<header class="header grid-2-auto">
    <img class="w-0_8rem ml-1_5rem" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
    <div class="text-end pe-3">
        <a href="{{ route('tambah-produk') }}" class="btn btn-danger btn-sm">+Tambah Produk</a>
    </div>
</header>

<div class="mt-1rem ml-1rem mr-1rem pb-1rem bb-0_5px-solid-grey">
    <div class="grid-2-auto">
        <div class="justify-self-left grid-2-auto b-1px-solid-grey b-radius-50px mr-1rem pl-1rem pr-0_4rem w-11rem">
            <input class="input-2 mt-0_4rem mb-0_4rem" type="text" placeholder="Cari...">
            <div class="justify-self-right grid-1-auto justify-items-center circle-small bg-color-orange-1">
                <img class="w-0_8rem" src="img/icons/loupe.svg" alt="">
            </div>
        </div>
        <div class="div-filter-icon">
            <div class="icon-small-circle grid-1-auto justify-items-center bg-color-orange-1">
                <img class="w-0_9rem" src="img/icons/sort-by-attributes.svg" alt="sort-icon">
            </div>
        </div>
    </div>
    <br>
    <div class="mb-1">
        <button class="btn btn-sm btn-outline-primary">All</button>
        <button class="btn btn-sm btn-outline-primary">SJ Variasi</button>
        <button class="btn btn-sm btn-outline-primary">SJ Kombinasi</button>
        <button class="btn btn-sm btn-outline-primary">SJ Standar</button>
        <button class="btn btn-sm btn-outline-primary">SJ T.Sixpack</button>
        <button class="btn btn-sm btn-outline-primary">SJ Japstyle</button>
        <button class="btn btn-sm btn-outline-warning">Stiker</button>
        <button class="btn btn-sm btn-outline-warning">Tankpad</button>
        <button class="btn btn-sm btn-outline-warning">Busastang</button>
        <button class="btn btn-sm btn-outline-danger">Tipe Variasi</button>
        <button class="btn btn-sm btn-outline-danger">Tipe Ukuran</button>
        <button class="btn btn-sm btn-outline-danger">Tipe Jahit</button>
    </div>
</div>

@endsection
