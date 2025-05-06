
@extends('layouts.app')

@section('title', 'Profile - Magical Library')

@section('content')
<div class="text-center">
    <h2 style="color: #f1c40f;">Profile Penyihir: {{ $username }}</h2>
    <img src="{{ $photo }}"
         alt="Foto Profil {{ $username }}"
         class="rounded-circle my-3"
         style="max-width:200px; width:100%;">
    <p><strong>Entitas:</strong> {{ ucfirst($entity) }}</p>
    <p><strong>Asal Planet:</strong> {{ ucfirst($planet) }}</p>
</div>
@endsection
