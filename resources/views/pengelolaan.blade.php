
@extends('layouts.app')

@section('title', 'Pengelolaan - Magical Library')

@section('content')
<div class="mb-4 text-center">
    <h2 style="color: #f1c40f;">Pengelolaan Buku Sihir</h2>
    <p>Tambah atau hapus buku sesuai kehendak magismu.</p>
</div>

<div class="row mb-5 justify-content-center">
    <div class="col-md-6">
        <div class="card p-4" style="background: rgba(255,255,255,0.1);">
            <h5 class="mb-3" style="color: #f1c40f;">Tambah Buku Baru</h5>
            <form action="{{ url('/pengelolaan/create') }}?username={{ urlencode($username) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <input type="text" name="name"
                           class="form-control bg-transparent text-light border-light"
                           placeholder="Nama Buku" required>
                </div>
                <div class="mb-3">
                    <input type="text" name="price"
                           class="form-control bg-transparent text-light border-light"
                           placeholder="Harga (misal: 100 gold)" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Tambah Buku</button>
            </form>
        </div>
    </div>
</div>

<div class="row">
    @foreach($books as $book)
        <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card h-100 shadow-sm" style="background: rgba(255,255,255,0.1);">
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title" style="color: #f1c40f;">{{ $book['name'] }}</h5>
                    <p class="card-text text-light mb-4">Harga: {{ $book['price'] }}</p>
                    <form action="{{ url('/pengelolaan/delete/'.$book['id']) }}?username={{ urlencode($username) }}" method="POST" class="mt-auto">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm w-100">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
