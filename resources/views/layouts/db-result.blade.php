@extends('layouts.main_layout')
@extends('layouts.navbar')
@section('content')

@if (isset($error_logs) && count($error_logs) !== 0)
<div class="alert alert-danger" role="alert">
@foreach ($error_logs as $error_log)
    {{ $error_log }}<br>
@endforeach
</div>
@endif

@if (isset($warning_logs) && count($warning_logs) !== 0)
<div class="alert alert-warning" role="alert">
@foreach ($warning_logs as $warning_log)
    {{ $warning_log }}<br>
@endforeach
</div>
@endif

@if (isset($success_logs) && count($success_logs) !== 0)
<div class="alert alert-success" role="alert">
@foreach ($success_logs as $success_log)
    {{ $success_log }}<br>
@endforeach
</div>
@endif

<div class="mt-2rem text-center">
    <a href="{{ route($route) }}" class="btn btn-info">{{ $route_btn }}</a>
</div>

<script>
    // Metode reload page dengan javascript untuk nantinya pada saat pindah halaman
    sessionStorage.setItem("reload_page", true);
    reloadable_page = false; // reloadable_page di set sebagai false, supaya halaman ini jangan di reload. Fokus reload adalah untuk halaman setelah kembali.
 </script>
@endsection
