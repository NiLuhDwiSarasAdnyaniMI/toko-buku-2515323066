@extends('layouts.app')

@section('title', ($buku->title ?? 'Buku tidak ditemukan') . ' — BookStore')

@section('content')
    @if ($buku)
        <div class="row">
            <div class="col-md-4">
                <img
                    src="{{ asset('images/sampul-placeholder.png') }}"
                    class="img-fluid rounded"
                    alt="Sampul {{ $buku->title }}"
                >
            </div>

            <div class="col-md-8">
                <span class="badge bg-secondary mb-2">
                    {{ $buku->category->name }}
                </span>

                <h1>{{ $buku->title }}</h1>

                <p class="text-muted">
                    Penulis: {{ $buku->author_name }}
                </p>

                <p class="harga-buku fs-4 mb-1">
                    Rp{{ number_format($buku->price, 0, ',', '.') }}
                </p>

                @if ($buku->stock > 0)
                    <p class="mb-3">Stok: {{ $buku->stock }}</p>
                @else
                    <p class="mb-3"><span class="badge bg-danger">Stok habis</span></p>
                @endif

                <a href="{{ url('/buku') }}" class="btn btn-outline-secondary">
                    &larr; Kembali ke daftar buku
                </a>
            </div>
        </div>

        @if ($bukuSerupa->isNotEmpty())
            <h2 class="h5 mt-5">Buku lain di kategori {{ $buku->category->name }}</h2>
            <ul class="list-unstyled">
                @foreach ($bukuSerupa as $serupa)
                    <li>
                        <a href="{{ url('/buku/' . $serupa->id) }}">{{ $serupa->title }}</a>
                        <span class="text-muted">— {{ $serupa->author_name }}</span>
                    </li>
                @endforeach
            </ul>
        @endif
    @else
        <div class="alert alert-warning">
            <h1 class="h4">Buku tidak ditemukan</h1>
            <p class="mb-0">Tidak ada buku dengan id {{ $id }}.</p>
        </div>

        <a href="{{ url('/buku') }}" class="btn btn-outline-secondary mt-3">
            &larr; Kembali ke daftar buku
        </a>
    @endif
@endsection