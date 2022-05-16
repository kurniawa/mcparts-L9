@extends('layouts.main_layout')

@section('content')


<div class="alert {{ $class_div_pesan_db }}" role="alert">{{ $pesan_db }}</div>

@if (isset($error_messages) && count($error_messages) !== 0)
<div class="alert alert-danger" role="alert">
@foreach ($error_messages as $error_message)
    {{ $error_message }}<br>
@endforeach
</div>
@endif

@if (isset($success_messages) && count($success_messages) !== 0)
<div class="alert alert-success" role="alert">
@foreach ($success_messages as $success_message)
    {{ $success_message }}<br>
@endforeach
</div>
@endif

<div class="mt-2em text-center">
    <button id='backToSPK' class="btn-1 d-inline-block bg-color-orange-1" onclick="windowHistoryGo({{ $go_back_number }});">Kembali</button>
</div>

<script>
    // Metode reload page dengan javascript untuk nantinya pada saat pindah halaman
    sessionStorage.setItem("reload_page", true);
    reloadable_page = false; // reloadable_page di set sebagai false, supaya halaman ini jangan di reload. Fokus reload adalah untuk halaman setelah kembali.
 </script>
@endsection
