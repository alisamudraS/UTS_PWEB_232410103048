
@extends('layouts.app')

@section('title', 'Dashboard - Magical Library')

@section('content')
<div class="text-center">
    <h2 style="color: #f1c40f;">Selamat datang, {{ $username }}!</h2>
    <p class="mt-3">Pilih menu di atas untuk menjelajah dunia buku sihir.</p>
</div>
@endsection
