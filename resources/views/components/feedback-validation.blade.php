<div>
    <!-- If you do not have a consistent goal in life, you can not live it in a consistent way. - Marcus Aurelius -->
    @if (session()->has('success_') && session('success_')!=="")
    <div class="container mt-2 alert alert-success">{{ session('success_') }}</div>
    @endif
    @if (session()->has('warnings_') && session('warnings_')!=="")
    <div class="container mt-1 alert alert-warning">{{ session('warnings_') }}</div>
    @endif
    @if (session()->has('errors_') && session('errors_')!=="")
    <div class="container mt-1 alert alert-danger">{{ session('errors_') }}</div>
    @endif
</div>
