@extends('layouts/main_layout')

@section('content')

<header class="header grid-2-auto">
    <img class="w-0_8em ml-1_5em" src="/img/icons/back-button-white.svg" alt="" onclick="goBack();">
</header>

<div class="mt-1em ml-1em mr-1em pb-1em bb-0_5px-solid-grey">
    <div class="grid-2-auto">
        <div class="justify-self-left grid-2-auto b-1px-solid-grey b-radius-50px mr-1em pl-1em pr-0_4em w-11em">
            <input class="input-2 mt-0_4em mb-0_4em" type="text" placeholder="Cari...">
            <div class="justify-self-right grid-1-auto justify-items-center circle-small bg-color-orange-1">
                <img class="w-0_8em" src="img/icons/loupe.svg" alt="">
            </div>
        </div>
        <div class="div-filter-icon">

            <div class="icon-small-circle grid-1-auto justify-items-center bg-color-orange-1">
                <img class="w-0_9em" src="img/icons/sort-by-attributes.svg" alt="sort-icon">
            </div>
        </div>
    </div>
    <br>
    <button class="btn btn-primary mb-1">All</button>
    <button class="btn btn-primary mb-1">SJ Variasi</button>
    <button class="btn btn-primary mb-1">SJ Kombinasi</button>
    <button class="btn btn-primary mb-1">SJ Standar</button>
    <button class="btn btn-primary mb-1">SJ T.Sixpack</button>
    <button class="btn btn-primary mb-1">SJ Japstyle</button>
    <button class="btn btn-warning mb-1">Stiker</button>
    <button class="btn btn-warning mb-1">Tankpad</button>
    <button class="btn btn-warning mb-1">Busastang</button>
    <button class="btn btn-danger mb-1">Tipe Variasi</button>
    <button class="btn btn-danger mb-1">Tipe Ukuran</button>
    <button class="btn btn-danger mb-1">Tipe Jahit</button>
</div>

<div class="container">
</div>

@endsection
