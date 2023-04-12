@extends('layouts.main_layout')

@extends('layouts.navbar')

@section('content')

<form action="{{ route('alter_db.fix_realsi_spk_nota_srjalan') }}">
    @csrf
    <button class="btn btn-primary mt-2 ms-2">Fix Relasi SPK-Nota-Srjalan</button>
</form>
<style>

</style>

@endsection
