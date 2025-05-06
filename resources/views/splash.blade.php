{{-- resources/views/splash.blade.php --}}
@extends('layouts.guest')

@section('title', 'Splash - Magical Library')

@section('content')
<div class="text-center">
    <h1 style="color: #f1c40f; font-size: 2.5rem;">
        Okairi nasai, {{ $username }}...
    </h1>
</div>
@endsection

@push('scripts')
<script>
    setTimeout(function() {
        window.location.href = '{{ url("/dashboard") }}?username={{ urlencode($username) }}';
    }, 3000);
</script>
@endpush
