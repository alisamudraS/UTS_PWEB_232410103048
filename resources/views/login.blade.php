
@extends('layouts.guest')

@section('title', 'Login - Magical Library')

@section('content')
<div class="card p-4 shadow-lg login-form" style="width: 350px; background: rgba(182,50,222,0.1);">
    <h3 class="text-center mb-4" style="color: #f1c40f;">Login Sihir</h3>
    <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="username" class="form-label">Nama Penyihir</label>
            <input type="text" name="username" id="username"
                   class="form-control bg-transparent text-light border-light"
                   placeholder="Masukkan username" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Kata Sandi</label>
            <input type="password" name="password" id="password"
                   class="form-control bg-transparent text-light border-light"
                   placeholder="Masukkan password" required>
        </div>
        <button type="submit" class="btn btn-primary w-100">Masuk ke Dunia Magis</button>
    </form>
</div>
@endsection
